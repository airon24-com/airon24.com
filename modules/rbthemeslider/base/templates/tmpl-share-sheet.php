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

$time = time();
$installed = rb_get_option('rb-date-installed', 0);
$level = rb_get_option('rb-share-displayed', 1);

switch ($level) {
    case 1:
        $time = $time-60*60*24*14;
        $odds = 100;
        break;

    case 2:
        $time = $time-60*60*24*30*2;
        $odds = 200;
        break;

    case 3:
        $time = $time-60*60*24*30*6;
        $odds = 300;
        break;

    default:
        $time = $time-60*60*24*30*6;
        $odds = 1000;
        break;
}

if ($installed && $time > $installed) {
    if (mt_rand(1, $odds) == 3) {
        rb_update_option('rb-share-displayed', ++$level);
        ?>
        <div class="rb-overlay" data-manualclose="true"></div>
        <div id="rb-share-template" class="rb-modal rb-box">
            <h3>
                <?php rb_e('Enjoy using Creative Slider?', 'RbthemeSlider') ?>
                <a href="#" class="dashicons dashicons-no-alt"></a>
            </h3>
            <div class="inner desc">
                <?php rb_e("If so, please consider recommending it to your friends on your favorite social network!", "RbthemeSlider"); ?>
            </div>
            <div class="inner">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://addons.prestashop.com/sliders-galleries/19062-creative-slider-responsive-slideshow.html" target="_blank">
                    <i class="dashicons dashicons-facebook-alt"></i> <?php rb_e('Share', 'RbthemeSlider') ?>
                </a>

                <a href="#" target="_blank">
                    <i class="dashicons dashicons-twitter"></i> <?php rb_e('Tweet', 'RbthemeSlider') ?>
                </a>
            </div>
        </div>
        <?php
    }
}
