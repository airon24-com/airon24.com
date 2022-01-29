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

// Get uploads dir
$file = _PS_MODULE_DIR_.'rbthemeslider/views/css/custom.css';

// Get contents
if (file_exists($file)) {
    $contents = Tools::file_get_contents($file);
} else {
    $upload_dir = rb_upload_dir();
    $file = $upload_dir['basedir'].'rbthemeslider.custom.css';
    $contents = file_exists($file) ? Tools::file_get_contents($file) : '';
}

$rbScreenOptions = rb_get_option('rb-screen-options', '0');
$rbScreenOptions = ($rbScreenOptions == 0) ? array() : $rbScreenOptions;
$rbScreenOptions = is_array($rbScreenOptions) ? $rbScreenOptions : unserialize($rbScreenOptions);

// Defaults
if (!isset($rbScreenOptions['showTooltips'])) {
    $rbScreenOptions['showTooltips'] = 'true';
}
?>

<div id="rb-screen-options" class="metabox-prefs hidden">
    <div id="screen-options-wrap" class="hidden">
        <form id="rb-screen-options-form" method="post">
            <?php rb_nonce_field('rb-save-screen-options'); ?>
            <h5><?php rb_e('Show on screen', 'RbthemeSlider') ?></h5>
            <label>
                <input type="checkbox" name="showTooltips"<?php echo $rbScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php rb_e('Tooltips', 'RbthemeSlider') ?>
            </label>
        </form>
    </div>
    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="show-settings-link" class="button show-settings" aria-controls="screen-options-wrap" aria-expanded="false"><?php rb_e('Screen Options', 'RbthemeSlider') ?></button>
    </div>
</div>
<div class="wrap">

    <!-- Page title -->
    <h2>Rb Theme Slider -
        <?php rb_e('CSS Editor', 'RbthemeSlider') ?>
        <a href="<?php echo Context::getContext()->link->getAdminLink('AdminRbthemesliderSlider') ?>" class="add-new-h2"><?php rb_e('Back to the list', 'RbthemeSlider') ?></a>
    </h2>

    <!-- Error messages -->
    <?php if (isset(${'_GET'}['edited'])) : ?>
        <div class="rb-notification updated">
            <div><?php rb_e('Your changes has been saved!', 'RbthemeSlider') ?></div>
        </div>
    <?php endif; ?>
    <!-- End of error messages -->

    <!-- Editor box -->
    <div class="rb-box rb-skin-editor-box">
        <h3 class="header medium">
            <?php rb_e('Contents of your custom CSS file', 'RbthemeSlider') ?>
            <figure><span>|</span><?php rb_e('Ctrl+Q to fold/unfold a block', 'RbthemeSlider') ?></figure>
        </h3>
        <form method="post" class="inner">
            <input type="hidden" name="rb-user-css" value="1">
            <?php rb_nonce_field('save-user-css'); ?>
            <textarea rows="10" cols="50" name="contents" class="rb-codemirror"
           ><?php
            if (!empty($contents)) :
                echo htmlentities($contents);
            else :
                echo '/*' . NL . rb__('You can type here custom CSS code, which will be loaded both on your admin and front-end pages. Please make sure to not override layout properties (positions and sizes), as they can interfere with the sliders built-in responsive functionality. Here are few example targets to help you get started:', 'RbthemeSlider');
                echo NL . '*/' . NL . NL;
                echo '.rb-container { /* Slider container */' . NL . NL . '}' .NL.NL;
                echo '.rb-layers { /* Layers wrapper */ ' . NL  . NL . '}' . NL.NL;
                echo '.rb-3d-box div { /* Sides of 3D transition objects */ ' . NL  . NL . '}';
            endif ?></textarea>
            <p class="footer">
            <?php if (!is_writable(dirname($file))) : ?>
                <?php rb_e('You need to make your uploads folder writable in order to save your changes.', 'RbthemeSlider') ?>
            <?php else : ?>
                <button class="button-primary"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
                <?php rb_e('Using invalid CSS code could break the appearance of your site or your sliders. Changes cannot be reverted after saving.', 'RbthemeSlider') ?>
            <?php endif ?>
            </p>
        </form>
    </div>
</div>
<script type="text/javascript">
    // Screen options
    var rbScreenOptions = <?php echo Tools::jsonEncode($rbScreenOptions) ?>;
</script>
