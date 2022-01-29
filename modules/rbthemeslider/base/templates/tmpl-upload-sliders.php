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
<script type="text/html" id="tmpl-upload-sliders">
    <div id="rb-upload-modal-window">
        <header>
            <h1><?php rb_e('Upload Slider', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
        </header>
        <form method="post" enctype="multipart/form-data" class="km-ui-modal-scrollable">
            <p><?php rb_e('Here you can upload your previously exported sliders. To import them to your site, you just need to choose and select the appropriate export file (files with .zip or .json extensions), then press the Import Sliders button.', 'RbthemeSlider') ?></p>
            <div class="rb-notification updated info"><div><?php echo sprintf(rb__('Looking for the importable demo content? Check out the %sTemplate Store%s.', 'RbthemeSlider'), '<a href="#" class="rb-open-template-store" data-delay="750"><i class="dashicons dashicons-star-filled"></i>', '</a>') ?></div></div>
            <p class="small italic dim"><?php rb_e('Notice: In order to import from outdated versions (pre-v3.0.0), you need to create a new file and paste the export code into it. The file needs to have a .json extension, then you will be able to upload it.', 'RbthemeSlider') ?></p>
            <?php rb_nonce_field('import-sliders'); ?>
            <input type="hidden" name="rb-import" value="1">
            <p class="centered center file">
                <input type="file" name="import_file">
            </p>
            <button class="button button-primary button-hero"><?php rb_e('Import Sliders', 'RbthemeSlider') ?></button><br>
        </form>
    </div>
</script>