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

// Get all skins
$skins = RbSources::getSkins();
$skin = (!empty(${'_GET'}['skin']) && strpos(${'_GET'}['skin'], '..') === false) ? ${'_GET'}['skin'] : '';
if (empty($skin)) {
    $skin = reset($skins);
    $skin = $skin['handle'];
}
$skin = RbSources::getSkin($skin);
$file = $skin['file'];

// Get screen options
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
        <?php rb_e('Skin Editor', 'RbthemeSlider') ?>
        <a href="<?php echo Context::getContext()->link->getAdminLink('AdminRbthemesliderSlider') ?>" class="add-new-h2"><?php rb_e('Back to the list', 'RbthemeSlider') ?></a>
    </h2>

    <!-- Error messages -->
    <?php if (isset(${'_GET'}['edited'])) : ?>
        <div class="rb-notification updated">
            <div><?php rb_e('Your changes has been saved!', 'RbthemeSlider') ?></div>
        </div>
    <?php endif ?>
    <!-- End of error messages -->

    <!-- Editor box -->
    <form method="post" class="rb-box rb-skin-editor-box">
        <input type="hidden" name="rb-user-skins" value="1">
        <?php rb_nonce_field('save-user-skin'); ?>
        <h3 class="header medium">
            <?php rb_e('Skin Editor', 'RbthemeSlider') ?>
            <figure><span>|</span><?php rb_e('Ctrl+Q to fold/unfold a block', 'RbthemeSlider') ?></figure>
            <p>
                <span><?php rb_e('Choose a skin:', 'RbthemeSlider') ?></span>
                <select name="skin" class="rb-skin-editor-select">
                <?php foreach ($skins as $item) : ?>
                    <?php if ($item['handle'] == $skin['handle']) : ?>
                        <option value="<?php echo $item['handle'] ?>" selected="selected"><?php echo $item['name'] ?></option>
                    <?php else : ?>
                        <option value="<?php echo $item['handle'] ?>"><?php echo $item['name'] ?></option>
                    <?php endif ?>
                <?php endforeach ?>
                </select>
            </p>
        </h3>
        <p class="inner"><?php rb_e('Built-in skins will be overwritten by plugin updates. Making changes should be done through the Custom Styles Editor.', 'RbthemeSlider') ?></p>
        <div class="inner">
            <textarea rows="10" cols="50" name="contents" class="rb-codemirror"><?php echo htmlentities(Tools::file_get_contents($file)); ?></textarea>
            <p class="footer">
            <?php if (!is_writable($file)) : ?>
                <?php rb_e('You need to make this file writable in order to save your changes.', 'RbthemeSlider') ?>
            <?php else : ?>
                <button class="button-primary"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
                <?php rb_e("Modifying a skin with invalid code can break your sliders' appearance. Changes cannot be reverted after saving.", "RbthemeSlider") ?>
            <?php endif ?>
            </p>
        </div>
    </form>
</div>
<script type="text/javascript">
    // Screen options
    var rbScreenOptions = <?php echo Tools::jsonEncode($rbScreenOptions) ?>;
</script>
