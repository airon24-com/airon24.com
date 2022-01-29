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
    $init = null;
    $rbInit = null;
    $rbPlugins = null;
    $sliderID = 0;
}

// Preload Skin
$skin = empty($slides['properties']['attrs']['skin']) ? 'v6' : $slides['properties']['attrs']['skin'];
if (empty($GLOBALS['rb_style']['skin-'.$skin])) {
    $GLOBALS['rb_style']['skin-'.$skin] = true;

    $rbInit[] = '<link id="rb-skin-'.$skin.'" rel="stylesheet" href="'.RB_VIEWS_URL."css/rbthemeslider/skins/$skin/skin.css?v=".RB_PLUGIN_VERSION.'">' . NL;
}

// Get init code
foreach ($slides['properties']['attrs'] as $key => $val) {
    if (is_bool($val)) {
        $val = $val ? 'true' : 'false';
        $init[] = $key.': '.$val;
    } elseif (is_numeric($val)) {
        $init[] = $key.': '.$val;
    } else {
        $init[] = "$key: '$val'";
    }
}

// Full-size sliders
if ((!empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'fullsize') && (empty($slides['properties']['attrs']['fullSizeMode']) || $slides['properties']['attrs']['fullSizeMode'] !== 'fitheight')) {
    $init[] = 'height: '.$slides['properties']['props']['height'].'';
}

if (! empty($rbPlugins)) {
    $init[] = 'plugins: ' . Tools::jsonEncode(array_unique($rbPlugins));
}

if (!RB_UNPACKED) {
    $init[] = "hideWelcomeMessage: true";
}

$init = implode(', ', $init);
$attr = rb_get_option('rb_rocketscript_ignore', false) ? ' data-cfasync="false"' : '';

$rbInit[] = "<script$attr>" . NL;
    $rbInit[] = 'document.addEventListener("DOMContentLoaded", function() {' . NL;
        $rbInit[] = 'if (typeof jQuery.fn.RbSlider == "undefined") {' . NL;
            $rbInit[] = 'if (window._RbSlider && window._RbSlider.showNotice) { ' . NL;
                $rbInit[] = 'window._RbSlider.showNotice(\''.$sliderID.'\',\'jquery\');' . NL;
            $rbInit[] = '}' . NL;
        $rbInit[] = '} else {' . NL;
            $rbInit[] = 'jQuery("#'.$sliderID.' .fancybox > img").unwrap();' . NL;
            $rbInit[] = 'jQuery("#'.$sliderID.'")';
if (!empty($slides['callbacks']) && is_array($slides['callbacks'])) {
    foreach ($slides['callbacks'] as $event => $function) {
        $rbInit[] = '.on("'.$event.'", '._ss($function).')';
    }
}
            $rbInit[] = '.RbSlider({'.$init.'});' . NL;
        $rbInit[] = '}' . NL;
    $rbInit[] = '});' . NL;
$rbInit[] = '</script>';
