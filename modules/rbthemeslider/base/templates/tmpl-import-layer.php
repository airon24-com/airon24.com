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
<script type="text/html" id="tmpl-import-layer">
    <div id="tmpl-import-layer-modal-window">
        <header>
            <h1><?php rb_e('Import Layer', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
        </header>
        <div class="km-ui-modal-scrollable">
            <div class="columns clearfix">
                    <div class="third third-1">
                        <h3><?php rb_e('Select slider', 'RbthemeSlider') ?></h3>
                    </div>
                    <div class="third third-2">
                        <h3><?php rb_e('Choose a Slide', 'RbthemeSlider') ?></h3>
                    </div>
                    <div class="third third-3">
                        <h3><?php rb_e('Click to import', 'RbthemeSlider') ?></h3>
                    </div>
            </div>
            <div class="columns clearfix">
                <div class="third third-1 rb-import-layer-sliders">
                    <?php rb_e('Loading ...', 'RbthemeSlider') ?>
                </div>
                <div class="third third-2 rb-import-layer-slides">
                    <?php rb_e('Select a slider first.', 'RbthemeSlider') ?>
                </div>
                <div class="third third-3 rb-import-layer-layers">
                    <?php rb_e('Select a slide first.', 'RbthemeSlider') ?>
                </div>
            </div>
        </div>
    </div>
</script>
