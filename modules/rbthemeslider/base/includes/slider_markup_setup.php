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

if (defined('RB_INCLUDE')) {
    $slides = null;
    $rbDefaults = null;
    $embed = null;
}

$slider = array();

// Filter to override the defaults
if (rb_has_filter('rbthemeslider_override_defaults')) {
    $newDefaults = rb_apply_filters('rbthemeslider_override_defaults', $rbDefaults);
    if (!empty($newDefaults) && is_array($newDefaults)) {
        $rbDefaults = $newDefaults;
        unset($newDefaults);
    }
}

// Hook to alter slider data *before* filtering with defaults
if (rb_has_filter('rbthemeslider_pre_parse_defaults')) {
    $result = rb_apply_filters('rbthemeslider_pre_parse_defaults', $slides);
    if (!empty($result) && is_array($result)) {
        $slides = $result;
    }
}

// Filter slider data with defaults
$slides['properties'] = rb_apply_filters('rb_parse_defaults', $rbDefaults['slider'], $slides['properties']);
$skin = !empty($slides['properties']['attrs']['skin']) ? $slides['properties']['attrs']['skin'] : $rbDefaults['slider']['skin']['value'];
$slides['properties']['attrs']['skinsPath'] = dirname(RbSources::urlForSkin($skin)) . '/';
if (isset($slides['properties']['autoPauseSlideshow'])) {
    switch ($slides['properties']['autoPauseSlideshow']) {
        case 'auto':
            $slides['properties']['autoPauseSlideshow'] = 'auto';
            break;
        case 'enabled':
            $slides['properties']['autoPauseSlideshow'] = true;
            break;
        case 'disabled':
            $slides['properties']['autoPauseSlideshow'] = false;
            break;
    }
}

if (!empty($slides['properties']['props']['globalBGImageId'])) {
    $tempSrc = rb_get_attachment_image_src($slides['properties']['props']['globalBGImageId'], 'full');
    $slides['properties']['attrs']['globalBGImage'] = $tempSrc[0];
}

// Old and without type
if (empty($slides['properties']['attrs']['sliderVersion']) && empty($slides['properties']['attrs']['type'])) {
    if (!empty($slides['properties']['props']['forceresponsive'])) {
        $slides['properties']['attrs']['type'] = 'fullwidth';
    } elseif (empty($slides['properties']['props']['responsive'])) {
        $slides['properties']['attrs']['type'] = 'fixedsize';
    } else {
        $slides['properties']['attrs']['type'] = 'responsive';
    }
}

// Override firstSlide if it is specified in embed params
if (! empty($embed['firstslide'])) {
    $slides['properties']['attrs']['firstSlide'] = '[firstSlide]';
}

// Make sure that width & height are set correctly
if (empty($slides['properties']['props']['width'])) {
    $slides['properties']['props']['width'] = 1280;
}
if (empty($slides['properties']['props']['height'])) {
    $slides['properties']['props']['height'] = 720;
}

// Slides and layers
if (isset($slides['layers']) && is_array($slides['layers'])) {
    foreach ($slides['layers'] as $slidekey => $slide) {
        if (!empty($slide['properties'])) {
            $slider['slides'][$slidekey] = rb_apply_filters('rb_parse_defaults', $rbDefaults['slides'], $slide['properties']);
        }
        if (isset($slide['sublayers']) && is_array($slide['sublayers'])) {
            foreach ($slide['sublayers'] as $layerkey => $layer) {
                $layer['styles'] = Tools::stripslashes($layer['styles']);
                $layer['transition'] = Tools::stripslashes($layer['transition']);

                if (! empty($layer['transition'])) {
                    $layer = array_merge($layer, Tools::jsonDecode(_ss($layer['transition']), true));
                }

                if (! empty($layer['styles'])) {
                    $layerStyles = Tools::jsonDecode($layer['styles'], true);
                    if ($layerStyles === null) {
                        $layerStyles = Tools::jsonDecode(_ss($layer['styles']), true);
                    }
                    $layer['styles'] = $layerStyles;
                }

                if (! empty($layer['top'])) {
                    $layer['styles']['top']  = $layer['top'];
                }

                if (! empty($layer['left'])) {
                    $layer['styles']['left']  = $layer['left'];
                }

                // v6.5.6: Compatibility mode for media layers that used the
                // old checkbox based media settings.
                if (isset($layer['controls'])) {
                    if (true === $layer['controls']) {
                        $layer['controls'] = 'auto';
                    } elseif (false === $layer['controls']) {
                        $layer['controls'] = 'disabled';
                    }
                }

                $slider['slides'][$slidekey]['layers'][$layerkey] = rb_apply_filters('rb_parse_defaults', $rbDefaults['layers'], $layer);
            }
        }
    }
}

// Hook to alter slider data *after* filtering with defaults
if (rb_has_filter('rbthemeslider_post_parse_defaults')) {
    $result = rb_apply_filters('rbthemeslider_post_parse_defaults', $slides);
    if (!empty($result) && is_array($result)) {
        $slides = $result;
    }
}

// Fix circle timer
if (empty($slides['properties']['attrs']['sliderVersion']) && empty($slides['properties']['attrs']['showCircleTimer'])) {
    $slides['properties']['attrs']['showCircleTimer'] = false;
}
