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
?>
<script type="text/html" id="tmpl-embed-slider">
    <div id="rb-embed-modal-window">
        <header>
            <h1><?php rb_e('Embed Slider', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
        </header>
        <div class="km-ui-modal-scrollable">
            <div class="columns clearfix">
                <div class="rb-half">
                    <div>
                        <h3><?php rb_e('Easiest Method: Module Position', 'RbthemeSlider') ?></h3>
                        <p class="rb-modpos">
                            <input type="text" placeholder="<?php rb_e('- None -') ?>" class="km-combo-input" data-options='<?php echo rb_get_hook_list() ?>' data-hook /><i class="dashicons dashicons-update rb-hook-update"></i>
                        </p>
                        <p><?php rb_e("This is the most commonly used method. Just select a hook from the list, and it will appear on your frontoffice. (This can be also adjusted in the Slider Settings / Layout tab.)", 'RbthemeSlider') ?></p>
                        <p><?php rb_e("In Slider Settings / Misc tab you can also define on which Pages and Categories will it appear. There are additional filters like Shop and Language as well.", 'RbthemeSlider') ?></p>
                    </div>
                </div>
                <div class="rb-half">
                    <div>
                        <h3><?php rb_e('Alternate Method: Shortcode', 'RbthemeSlider') ?></h3>
                        <p>
                            <input type="text" class="shortcode" readonly="readonly" onclick="this.focus(); this.select();">
                        </p>
                        <p><?php rb_e("Shortcodes can be inserted into content, like CMS page, category or product description. This can help you to place a slider into a suitable area, even if there is no available hook there. To use that is quite easy, just need to place the shortcode into the content editor, where number is the ID of the slider (you can also use slug there if you set that in the slider settings).", 'RbthemeSlider') ?></p>
                    </div>
                </div>
            </div>
            <div class="rb-separator">
                <div>
                    <?php rb_e('We also have a video tutorial about how easy to embed Rb Theme Slider:', 'RbthemeSlider') ?>
                    [ <a href="https://youtu.be/FF7_wd0vYTM" target="_blank"><?php rb_e('Tutorial Video', 'RbthemeSlider') ?></a> ]
                </div>
            </div>
        </div>
    </div>
</script>