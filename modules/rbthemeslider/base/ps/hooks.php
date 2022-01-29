<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
defined('_PS_VERSION_') or exit;

// Private filters, can change at any time
rb_add_filter('rb_slider_title', 'rb_filter_slider_title', 10, 2);
rb_add_filter('rb_preview_for_slider', 'rb_preview_for_slider', 10, 1);
rb_add_filter('rb_get_thumbnail', 'rb_get_thumbnail', 10, 3);
rb_add_filter('rb_get_image', 'rb_get_image', 10, 2);

// Public filters
rb_add_filter('rb_parse_defaults', 'rb_parse_defaults', 10, 2);

function rb_filter_slider_title($sliderName = '', $maxLength = 50)
{
    $name = empty($sliderName) ? 'Unnamed' : htmlspecialchars(_ss($sliderName));
    return isset($name[$maxLength]) ? Tools::substr($name, 0, $maxLength) . ' ...' : $name;
}

function rb_preview_for_slider($slider = array())
{
    // Attempt to find pre-defined slider banner
    if (! empty($slider['data']['meta']) && ! empty($slider['data']['meta']['preview'])) {
        return $slider['data']['meta']['preview'];
    }

    // Find an image
    if (isset($slider['data']['layers'])) {
        foreach ($slider['data']['layers'] as $layer) {
            if (!empty($layer['properties']['thumbnail'])) {
                $image = $layer['properties']['thumbnail'];
                break;
            }
            if (!empty($layer['properties']['background']) && $layer['properties']['background'] !== '[image-url]') {
                $image = $layer['properties']['background'];
                break;
            }
        }
    }

    return ! empty($image) ? $image : '';
}


function rb_get_thumbnail($id = null, $url = null, $blankPlaceholder = false)
{
    // Image ID
    if (!empty($id)) {
        if ($image = rb_get_attachment_thumb_url($id, 'thumbnail')) {
            return $image;
        }
    }

    if (!empty($url)) {
        $thumb = substr_replace($url, '-150x150.', strrpos($url, '.'), 1);
        $file = RB_ROOT_PATH.'/sampleslider/'.basename($thumb);

        if (file_exists($file)) {
            return $thumb;
        } else {
            return $url;
        }
    }

    return RB_VIEWS_URL.'img/admin/blank.gif';
}

function rb_get_image($id = null, $url = null)
{
    if (! empty($id)) {
    } elseif (! empty($url)) {
        return $url;
    }

    return RB_VIEWS_URL.'img/admin/blank.gif';
}


function rb_parse_defaults($defaults = array(), $raw = array())
{
    $activated = rb_get_option('rbthemeslider-authorized-site', false);
    $permission = rb_current_user_can('publish_posts');
    $ret = array();

    foreach ($defaults as $key => $default) {
        $phpKey = is_string($default['keys']) ? $default['keys'] : $default['keys'][0];
        $jsKey  = is_string($default['keys']) ? $default['keys'] : $default['keys'][1];
        $retKey = isset($default['props']['meta']) ? 'props' : 'attrs';

        // Check premium features
        $isPremium = false;
        if (! empty($default['premium']) && ! $activated) {
            if (! $permission) {
                if (! empty($raw['styles'][$phpKey])) {
                    unset($ret['props']['styles'][$jsKey]);
                }
                continue;
            }
            $isPremium = true;
        }

        if (isset($default['props']['forceoutput'])) {
            if (! isset($raw[$phpKey])) {
                $ret[$retKey][$jsKey] = $default['value'];
            } else {
                $ret[$retKey][$jsKey] = $raw[$phpKey];
            }
        } elseif (isset($raw[$phpKey]) && isset($default['props']['output'])) {
            $ret[$retKey][$jsKey] = $raw[$phpKey];
        } elseif (isset($raw[$phpKey]) && is_array($raw[$phpKey])) {
            $ret[$retKey][$jsKey] = $raw[$phpKey];
        } elseif (isset($raw[$phpKey]) && is_bool($default['value'])) {
            if ($default['value'] == true && empty($raw[$phpKey])) {
                $ret[$retKey][$jsKey] = false;
            } elseif ($default['value'] == false && !empty($raw[$phpKey])) {
                $ret[$retKey][$jsKey] = true;
            }
        } elseif (isset($raw[$phpKey])) {
            if (isset($default['props']['meta']) || ((string)$default['value'] !== (string)$raw[$phpKey] && (string)$raw[$phpKey] !== '')) {
                $raw[$phpKey] = isset($default['props']['raw']) ? addslashes($raw[$phpKey]) : $raw[$phpKey];
                $ret[$retKey][$jsKey] = _ss($raw[$phpKey]);
            }
        }

        if (! $activated && empty($GLOBALS['rbPremiumNotice'])) {
            if ($isPremium && isset($ret[$retKey][$jsKey])) {
                $GLOBALS['rbPremiumNotice'] = true;
            }
        }
    }

    return $ret;
}

function rb_array_to_attr($arr, $mode = '')
{
    if (!empty($arr) && is_array($arr)) {
        $ret = array();
        foreach ($arr as $key => $val) {
            if ($mode == 'css' && is_numeric($val)) {
                $ret[] = ''.$key.':'.rbthemeslider_check_unit($val, $key).';';
            } elseif (is_bool($val)) {
                $bool = $val ? 'true' : 'false';
                $ret[] = "$key:$bool;";
            } else {
                $ret[] = "$key:$val;";
            }
        }
        return implode('', $ret);
    }
}

function rbthemeslider_loaded()
{
    if (rb_has_action('rbthemeslider_ready')) {
        rb_do_action('rbthemeslider_ready');
    }
}
