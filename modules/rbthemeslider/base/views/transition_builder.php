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

// Custom transitions file
$custom_trs = _PS_MODULE_DIR_.'rbthemeslider/views/js/custom.transitions.js';
$sample_trs = _PS_MODULE_DIR_.'rbthemeslider/views/js/demos/transitions.js';

// Get transition file
if (file_exists($custom_trs)) {
    $data = Tools::file_get_contents($custom_trs);
} else {
    $upload_dir = rb_upload_dir();
    $custom_trs = $upload_dir['basedir'] . 'rbthemeslider.custom.transitions.js';
    $data = Tools::file_get_contents(file_exists($custom_trs) ? $custom_trs : $sample_trs);
}

// Get JSON data
if (!empty($data)) {
    $data = Tools::substr($data, 35);
    $data = Tools::substr($data, 0, -1);
    $data = Tools::jsonDecode($data, true);
}

// Get screen options
$rbScreenOptions = rb_get_option('rb-screen-options', '0');
$rbScreenOptions = ($rbScreenOptions == 0) ? array() : $rbScreenOptions;
$rbScreenOptions = is_array($rbScreenOptions) ? $rbScreenOptions : unserialize($rbScreenOptions);

// Defaults
if (!isset($rbScreenOptions['showTooltips'])) {
    $rbScreenOptions['showTooltips'] = 'true';
}

// Function to convert array keys to property names
function rbTrGetProperty($key)
{
    switch ($key) {
        case 'scale3d':
            return 'Scale3D';
        case 'rotateX':
            return 'RotateX';
        case 'rotateY':
            return 'RotateY';
        case 'x':
            return 'MoveX';
        case 'y':
            return 'MoveY';
        case 'delay':
            return 'Delay';
        default:
            return $key;
    }
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


<!-- Import sample markup of transitions -->
<?php include RB_ROOT_PATH . '/templates/tmpl-2d-transition.php'; ?>
<?php include RB_ROOT_PATH . '/templates/tmpl-3d-transition.php'; ?>

<!-- Import Transition Gallery markup -->
<?php include RB_ROOT_PATH . '/templates/tmpl-transition-gallery.php'; ?>

<div class="wrap">

    <!-- Page title -->
    <h2>Rb Theme Slider -
        <?php rb_e('Transition Settings', 'RbthemeSlider') ?>
        <a href="<?php echo Context::getContext()->link->getAdminLink('AdminRbthemesliderSlider') ?>" class="add-new-h2"><?php rb_e('Back to the list', 'RbthemeSlider') ?></a>
    </h2>

    <?php if (isset(${'_GET'}['edited'])) : ?>
        <div class="updated"><?php rb_e('Your changes has been saved!', 'RbthemeSlider') ?></div>
    <?php endif; ?>

    <!-- Editor box -->
    <form method="post" id="rb-tr-builder-form">
        <?php rb_nonce_field('save-user-transitions'); ?>
        <input type="hidden" name="rb-user-transitions" value="1">
        <input type="hidden" name="rb-transitions">


        <div class="rb-slider-settings rb-transition-settings">
            <div class="rb-box rb-settings">
                <div class="inner">
                    <div class="rb-settings-sidebar rb-transitions-sidebar">
                        <h3 class="subheader">
                            <?php rb_e('2D Transitions', 'RbthemeSlider') ?>
                            <a href="#" class="rb-import-transition">
                                <span class="dashicons dashicons-update"></span>
                                <?php rb_e('Import', 'RbthemeSlider') ?>
                            </a>
                            <a href="#" class="rb-add-transition">
                                <span class="dashicons dashicons-plus"></span>
                                <?php rb_e('Add New', 'RbthemeSlider') ?>
                            </a>
                        </h3>
                        <ul class="2d" data-type="2d">
                        <?php $hidenClass = ''; ?>
                        <?php if (!empty($data['t2d']) && is_array($data['t2d'])) : ?>
                            <?php $hidenClass = 'rb-hidden' ?>
                            <?php foreach ($data['t2d'] as $tr) : ?>
                                <li>
                                    <span class="dashicons dashicons-menu"></span>
                                    <input type="text" value="<?php echo htmlspecialchars(html_entity_decode($tr['name'])) ?>" placeholder="<?php rb_e('Type transition name', 'RbthemeSlider') ?>">
                                    <a href="#" title="<?php rb_e('Remove transition', 'RbthemeSlider') ?>" class="dashicons dashicons-trash remove"></a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        </ul>
                        <p class="rb-no-transition <?php echo $hidenClass ?>"><?php rb_e('No 2D transitions yet.', 'RbthemeSlider') ?></p>
                        <h3 class="subheader">
                            <?php rb_e('3D Transitions', 'RbthemeSlider') ?>
                            <a href="#" class="rb-import-transition">
                                <span class="dashicons dashicons-update"></span>
                                <?php rb_e('Import', 'RbthemeSlider') ?>
                            </a>
                            <a href="#" class="rb-add-transition">
                                <span class="dashicons dashicons-plus"></span>
                                <?php rb_e('Add New', 'RbthemeSlider') ?>
                            </a>
                        </h3>
                        <ul class="3d" data-type="3d">
                        <?php $hidenClass = ''; ?>
                        <?php if (!empty($data['t3d']) && is_array($data['t3d'])) : ?>
                            <?php $hidenClass = 'rb-hidden'; ?>
                            <?php foreach ($data['t3d'] as $tr) : ?>
                                <li>
                                    <span class="dashicons dashicons-menu"></span>
                                    <input type="text" value="<?php echo htmlspecialchars(html_entity_decode($tr['name'])) ?>" placeholder="<?php rb_e('Type transition name', 'RbthemeSlider') ?>">
                                    <a href="#" title="<?php rb_e('Remove transition', 'RbthemeSlider') ?>" class="dashicons dashicons-trash remove"></a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                        </ul>
                        <p class="rb-no-transition <?php echo $hidenClass ?>"><?php rb_e('No 3D transitions yet.', 'RbthemeSlider') ?></p>
                    </div>
                    <div class="rb-settings-contents rb-transition-contents">
                        <div class="rb-box rb-tr-builder">

                            <div class="rb-tr-options clearfix">
                                <div class="rb-builder-left rb-tr-list-3d">
                                <?php if (!empty($data['t3d']) && is_array($data['t3d'])) : ?>
                                    <?php foreach ($data['t3d'] as $key => $tr) : ?>
                                        <?php $activeClass = ($key == 0) ? ' active' : '' ?>
                                        <div class="rb-transition-item<?php echo $activeClass ?>">
                                            <table class="rb-box rb-tr-settings">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2"><?php rb_e('Preview', 'RbthemeSlider') ?></td>
                                                        <td colspan="2"><?php rb_e('Tiles', 'RbthemeSlider') ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="rb-builder-preview rb-transition-preview">
                                                                <img src="<?php echo RB_VIEWS_URL ?>img/admin/sample_slide_1.png" alt="preview image">
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <table class="tiles">
                                                                <tbody>
                                                                    <tr>
                                                                        <?php $tr['rows'] = is_array($tr['rows']) ? implode(',', $tr['rows']) : $tr['rows']; ?>
                                                                        <?php $tr['cols'] = is_array($tr['cols']) ? implode(',', $tr['cols']) : $tr['cols']; ?>
                                                                        <td class="right"><?php rb_e('Rows', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="rows" value="<?php echo $tr['rows'] ?>" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many rows of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                                                        <td class="right"><?php rb_e('Cols', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="cols" value="<?php echo $tr['cols'] ?>" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many columns of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                                                    </tr>
                                                                </tbody>
                                                                <tbody class="tile">
                                                                    <tr>
                                                                        <td class="right"><?php rb_e('Delay', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="delay" value="<?php echo $tr['tile']['delay'] ?>" data-help="<?php rb_e('You can apply a delay between the tiles and postpone their animation relative to each other.', 'RbthemeSlider') ?>"></td>
                                                                        <td class="right"><?php rb_e('Sequence', 'RbthemeSlider') ?></td>
                                                                        <td>
                                                                            <select name="sequence" data-help="<?php rb_e('You can control the animation order of the tiles here.', 'RbthemeSlider') ?>">
                                                                                <option value="forward"<?php echo ($tr['tile']['sequence'] == 'forward') ? ' selected="selected"' : '' ?>><?php rb_e('Forward', 'RbthemeSlider') ?></option>
                                                                                <option value="reverse"<?php echo ($tr['tile']['sequence'] == 'reverse') ? ' selected="selected"' : '' ?>><?php rb_e('Reverse', 'RbthemeSlider') ?></option>
                                                                                <option value="col-forward"<?php echo ($tr['tile']['sequence'] == 'col-forward') ? ' selected="selected"' : '' ?>><?php rb_e('Col-forward', 'RbthemeSlider') ?></option>
                                                                                <option value="col-reverse"<?php echo ($tr['tile']['sequence'] == 'col-reverse') ? ' selected="selected"' : '' ?>><?php rb_e('Col-reverse', 'RbthemeSlider') ?></option>
                                                                                <option value="random"<?php echo ($tr['tile']['sequence'] == 'random') ? ' selected="selected"' : '' ?>><?php rb_e('Random', 'RbthemeSlider') ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="right"><?php rb_e('Depth', 'RbthemeSlider') ?></td>
                                                                        <td colspan="3">
                                                                            <label data-help="<?php rb_e('The script tries to identify the optimal depth for your rotated objects (tiles). With this option you can force your objects to have a large depth when performing 180 degree (and its multiplies) rotation.', 'RbthemeSlider') ?>">
                                                                                <input type="checkbox" class="checkbox" name="depth" value="large"<?php echo isset($tr['tile']['depth']) ? ' checked="checked"' : '' ?>>
                                                                                <?php rb_e('Large depth', 'RbthemeSlider') ?>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                    $checkboxProp = isset($tr['before']) ? ' checked="checked"' : '';
                                                    $collapseClass = !isset($tr['before']) ? ' rb-builder-collapsed' : '';
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4">
                                                            <?php rb_e('Before animation', 'RbthemeSlider') ?>
                                                            <p class="rb-builder-checkbox">
                                                                <label><input type="checkbox"<?php echo $checkboxProp ?> class="rb-builder-collapse-toggle"> <?php rb_e('Enabled', 'RbthemeSlider') ?></label>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody class="before<?php echo $collapseClass ?>">
                                                    <tr>
                                                        <td class="right"><?php rb_e('Duration', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="duration" value="<?php echo isset($tr['before']['duration']) ? $tr['before']['duration'] : '1000' ?>" data-help="<?php rb_e('The duration of your animation. This value is in millisecs, so the value 1000 means 1 second.', 'RbthemeSlider') ?>"></td>
                                                        <td class="right"><a href="http://easings.net/" target="_blank"><?php rb_e('Easing', 'RbthemeSlider') ?></a></td>
                                                        <td>
                                                            <?php $tr['before']['easing'] = isset($tr['before']['easing']) ? $tr['before']['easing'] : 'easeInOutBack' ?>
                                                            <select name="easing" data-help="<?php rb_e('The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.', 'RbthemeSlider') ?>">
                                                                <option<?php echo ($tr['before']['easing'] == 'linear') ? ' selected="selected"' : '' ?>>linear</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInQuad') ? ' selected="selected"' : '' ?>>easeInQuad</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutQuad') ? ' selected="selected"' : '' ?>>easeOutQuad</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutQuad') ? ' selected="selected"' : '' ?>>easeInOutQuad</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInCubic') ? ' selected="selected"' : '' ?>>easeInCubic</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutCubic') ? ' selected="selected"' : '' ?>>easeOutCubic</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutCubic') ? ' selected="selected"' : '' ?>>easeInOutCubic</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInQuart') ? ' selected="selected"' : '' ?>>easeInQuart</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutQuart') ? ' selected="selected"' : '' ?>>easeOutQuart</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutQuart') ? ' selected="selected"' : '' ?>>easeInOutQuart</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInQuint') ? ' selected="selected"' : '' ?>>easeInQuint</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutQuint') ? ' selected="selected"' : '' ?>>easeOutQuint</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutQuint') ? ' selected="selected"' : '' ?>>easeInOutQuint</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInSine') ? ' selected="selected"' : '' ?>>easeInSine</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutSine') ? ' selected="selected"' : '' ?>>easeOutSine</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutSine') ? ' selected="selected"' : '' ?>>easeInOutSine</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInExpo') ? ' selected="selected"' : '' ?>>easeInExpo</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutExpo') ? ' selected="selected"' : '' ?>>easeOutExpo</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutExpo') ? ' selected="selected"' : '' ?>>easeInOutExpo</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInCirc') ? ' selected="selected"' : '' ?>>easeInCirc</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutCirc') ? ' selected="selected"' : '' ?>>easeOutCirc</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutCirc') ? ' selected="selected"' : '' ?>>easeInOutCirc</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInBack') ? ' selected="selected"' : '' ?>>easeInBack</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeOutBack') ? ' selected="selected"' : '' ?>>easeOutBack</option>
                                                                <option<?php echo ($tr['before']['easing'] == 'easeInOutBack') ? ' selected="selected"' : '' ?>>easeInOutBack</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="transition">
                                                        <td colspan="4">
                                                            <ul class="rb-tr-tags">
                                                            <?php if (isset($tr['before']['transition']) && !empty($tr['before']['transition'])) : ?>
                                                                <?php foreach ($tr['before']['transition'] as $pkey => $prop) : ?>
                                                                    <li>
                                                                        <p>
                                                                            <span><?php echo rbTrGetProperty($pkey) ?></span>
                                                                            <input type="text" name="<?php echo $pkey ?>" value="<?php echo $prop ?>">
                                                                        </p>
                                                                        <a href="#" class="dashicons dashicons-dismiss"></a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            </ul>
                                                            <p class="rb-tr-add-property">
                                                                <a href="#" class="rb-icon-tr-add"><i class="dashicons dashicons-plus"></i><?php rb_e('Add new', 'RbthemeSlider') ?></a>
                                                                <select>
                                                                    <option value="scale3d,0.8"><?php rb_e('Scale3D', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateX,90"><?php rb_e('RotateX', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateY,90"><?php rb_e('RotateY', 'RbthemeSlider') ?></option>
                                                                    <option value="delay,200"><?php rb_e('Delay', 'RbthemeSlider') ?></option>
                                                                </select>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4">
                                                            <?php rb_e('Animation', 'RbthemeSlider') ?>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody class="animation">
                                                    <tr>
                                                        <td class="right"><?php rb_e('Duration', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="duration" value="<?php echo $tr['animation']['duration'] ?>" data-help="<?php rb_e('The duration of your animation. This value is in millisecs, so the value 1000 means 1 second.', 'RbthemeSlider') ?>"></td>
                                                        <td class="right"><a href="http://easings.net/" target="_blank"><?php rb_e('Easing', 'RbthemeSlider') ?></a></td>
                                                        <td>
                                                            <select name="easing" data-help="<?php rb_e('The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.', 'RbthemeSlider') ?>">
                                                                <option<?php echo ($tr['animation']['easing'] == 'linear') ? ' selected="selected"' : '' ?>>linear</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInQuad') ? ' selected="selected"' : '' ?>>easeInQuad</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutQuad') ? ' selected="selected"' : '' ?>>easeOutQuad</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutQuad') ? ' selected="selected"' : '' ?>>easeInOutQuad</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInCubic') ? ' selected="selected"' : '' ?>>easeInCubic</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutCubic') ? ' selected="selected"' : '' ?>>easeOutCubic</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutCubic') ? ' selected="selected"' : '' ?>>easeInOutCubic</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInQuart') ? ' selected="selected"' : '' ?>>easeInQuart</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutQuart') ? ' selected="selected"' : '' ?>>easeOutQuart</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutQuart') ? ' selected="selected"' : '' ?>>easeInOutQuart</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInQuint') ? ' selected="selected"' : '' ?>>easeInQuint</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutQuint') ? ' selected="selected"' : '' ?>>easeOutQuint</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutQuint') ? ' selected="selected"' : '' ?>>easeInOutQuint</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInSine') ? ' selected="selected"' : '' ?>>easeInSine</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutSine') ? ' selected="selected"' : '' ?>>easeOutSine</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutSine') ? ' selected="selected"' : '' ?>>easeInOutSine</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInExpo') ? ' selected="selected"' : '' ?>>easeInExpo</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutExpo') ? ' selected="selected"' : '' ?>>easeOutExpo</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutExpo') ? ' selected="selected"' : '' ?>>easeInOutExpo</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInCirc') ? ' selected="selected"' : '' ?>>easeInCirc</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutCirc') ? ' selected="selected"' : '' ?>>easeOutCirc</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutCirc') ? ' selected="selected"' : '' ?>>easeInOutCirc</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInBack') ? ' selected="selected"' : '' ?>>easeInBack</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeOutBack') ? ' selected="selected"' : '' ?>>easeOutBack</option>
                                                                <option<?php echo ($tr['animation']['easing'] == 'easeInOutBack') ? ' selected="selected"' : '' ?>>easeInOutBack</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="right"><?php rb_e('Direction', 'RbthemeSlider') ?></td>
                                                        <td>
                                                            <select name="direction" data-help="<?php rb_e('The direction of rotation.', 'RbthemeSlider') ?>">
                                                                <option value="vertical"<?php echo ($tr['animation']['direction'] == 'vertical') ? ' selected="selected"' : '' ?>><?php rb_e('Vertical', 'RbthemeSlider'); ?></option>
                                                                <option value="horizontal"<?php echo ($tr['animation']['direction'] == 'horizontal') ? ' selected="selected"' : '' ?>><?php rb_e('Horizontal', 'RbthemeSlider') ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="transition">
                                                        <td colspan="4">

                                                            <ul class="rb-tr-tags">
                                                            <?php if (isset($tr['animation']['transition']) && !empty($tr['animation']['transition'])) : ?>
                                                                <?php foreach ($tr['animation']['transition'] as $pkey => $prop) : ?>
                                                                    <li>
                                                                        <p>
                                                                            <span><?php echo rbTrGetProperty($pkey) ?></span>
                                                                            <input type="text" name="<?php echo $pkey ?>" value="<?php echo $prop ?>">
                                                                        </p>
                                                                        <a href="#" class="dashicons dashicons-dismiss"></a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            </ul>
                                                            <p class="rb-tr-add-property">
                                                                <a href="#" class="rb-icon-tr-add"><i class="dashicons dashicons-plus"></i><?php rb_e('Add new', 'RbthemeSlider') ?></a>
                                                                <select>
                                                                    <option value="scale3d,0.8"><?php rb_e('Scale3D', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateX,90"><?php rb_e('RotateX', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateY,90"><?php rb_e('RotateY', 'RbthemeSlider') ?></option>
                                                                    <option value="delay,200"><?php rb_e('Delay', 'RbthemeSlider') ?></option>
                                                                </select>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                    $checkboxProp = isset($tr['after']) ? ' checked="checked"' : '';
                                                    $collapseClass = !isset($tr['after']) ? ' rb-builder-collapsed' : '';
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4">
                                                            <?php rb_e('After animation', 'RbthemeSlider') ?>
                                                            <p class="rb-builder-checkbox">
                                                                <label><input type="checkbox"<?php echo $checkboxProp ?> class="rb-builder-collapse-toggle"> <?php rb_e('Enabled', 'RbthemeSlider') ?></label>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody class="after<?php echo $collapseClass ?>">
                                                    <tr>
                                                        <td class="right"><?php rb_e('Duration', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="duration" value="<?php echo isset($tr['after']['duration']) ? $tr['after']['duration'] : '1000' ?>" data-help="<?php rb_e('The duration of your animation. This value is in millisecs, so the value 1000 means 1 second.', 'RbthemeSlider') ?>"></td>
                                                        <td class="right"><a href="http://easings.net/" target="_blank"><?php rb_e('Easing', 'RbthemeSlider') ?></a></td>
                                                        <td>
                                                            <?php $tr['after']['easing'] = isset($tr['after']['easing']) ? $tr['after']['easing'] : 'easeInOutBack' ?>
                                                            <select name="easing" data-help="<?php rb_e('The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.', 'RbthemeSlider') ?>">
                                                                <option<?php echo ($tr['after']['easing'] == 'linear') ? ' selected="selected"' : '' ?>>linear</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInQuad') ? ' selected="selected"' : '' ?>>easeInQuad</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutQuad') ? ' selected="selected"' : '' ?>>easeOutQuad</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutQuad') ? ' selected="selected"' : '' ?>>easeInOutQuad</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInCubic') ? ' selected="selected"' : '' ?>>easeInCubic</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutCubic') ? ' selected="selected"' : '' ?>>easeOutCubic</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutCubic') ? ' selected="selected"' : '' ?>>easeInOutCubic</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInQuart') ? ' selected="selected"' : '' ?>>easeInQuart</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutQuart') ? ' selected="selected"' : '' ?>>easeOutQuart</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutQuart') ? ' selected="selected"' : '' ?>>easeInOutQuart</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInQuint') ? ' selected="selected"' : '' ?>>easeInQuint</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutQuint') ? ' selected="selected"' : '' ?>>easeOutQuint</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutQuint') ? ' selected="selected"' : '' ?>>easeInOutQuint</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInSine') ? ' selected="selected"' : '' ?>>easeInSine</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutSine') ? ' selected="selected"' : '' ?>>easeOutSine</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutSine') ? ' selected="selected"' : '' ?>>easeInOutSine</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInExpo') ? ' selected="selected"' : '' ?>>easeInExpo</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutExpo') ? ' selected="selected"' : '' ?>>easeOutExpo</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutExpo') ? ' selected="selected"' : '' ?>>easeInOutExpo</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInCirc') ? ' selected="selected"' : '' ?>>easeInCirc</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutCirc') ? ' selected="selected"' : '' ?>>easeOutCirc</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutCirc') ? ' selected="selected"' : '' ?>>easeInOutCirc</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInBack') ? ' selected="selected"' : '' ?>>easeInBack</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeOutBack') ? ' selected="selected"' : '' ?>>easeOutBack</option>
                                                                <option<?php echo ($tr['after']['easing'] == 'easeInOutBack') ? ' selected="selected"' : '' ?>>easeInOutBack</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="transition">
                                                        <td colspan="4">
                                                            <ul class="rb-tr-tags">
                                                            <?php if (isset($tr['after']['transition']) && !empty($tr['after']['transition'])) : ?>
                                                                <?php foreach ($tr['after']['transition'] as $pkey => $prop) : ?>
                                                                    <li>
                                                                        <p>
                                                                            <span><?php echo rbTrGetProperty($pkey) ?></span>
                                                                            <input type="text" name="<?php echo $pkey ?>" value="<?php echo $prop ?>">
                                                                        </p>
                                                                        <a href="#" class="dashicons dashicons-dismiss"></a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            </ul>
                                                            <p class="rb-tr-add-property">
                                                                <a href="#" class="rb-icon-tr-add"><i class="dashicons dashicons-plus"></i><?php rb_e('Add new', 'RbthemeSlider') ?></a>
                                                                <select>
                                                                    <option value="scale3d,0.8"><?php rb_e('Scale3D', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateX,90"><?php rb_e('RotateX', 'RbthemeSlider') ?></option>
                                                                    <option value="rotateY,90"><?php rb_e('RotateY', 'RbthemeSlider') ?></option>
                                                                    <option value="delay,200"><?php rb_e('Delay', 'RbthemeSlider') ?></option>
                                                                </select>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </div>
                                <div class="rb-builder-right rb-tr-list-2d">

                                <?php if (!empty($data['t2d']) && is_array($data['t2d'])) : ?>
                                    <?php foreach ($data['t2d'] as $key => $tr) : ?>
                                        <?php $activeClass = ($key == 0) ? ' active' : '' ?>
                                        <div class="rb-transition-item<?php echo $activeClass ?>">
                                            <table class="rb-box rb-tr-settings bottomborder">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2"><?php rb_e('Preview', 'RbthemeSlider') ?></td>
                                                        <td colspan="2"><?php rb_e('Tiles', 'RbthemeSlider') ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="rb-builder-preview rb-transition-preview">
                                                                <img src="<?php echo RB_VIEWS_URL ?>img/admin/sample_slide_1.png" alt="preview image">
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <table class="tiles">
                                                                <tbody>
                                                                    <tr>
                                                                        <?php $tr['rows'] = is_array($tr['rows']) ? implode(',', $tr['rows']) : $tr['rows']; ?>
                                                                        <?php $tr['cols'] = is_array($tr['cols']) ? implode(',', $tr['cols']) : $tr['cols']; ?>
                                                                        <td class="right"><?php rb_e('Rows', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="rows" value="<?php echo $tr['rows'] ?>" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many rows of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                                                        <td class="right"><?php rb_e('Cols', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="cols" value="<?php echo $tr['cols'] ?>" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many columns of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                                                    </tr>
                                                                </tbody>
                                                                <tbody class="tile">
                                                                    <tr>
                                                                        <td class="right"><?php rb_e('Delay', 'RbthemeSlider') ?></td>
                                                                        <td><input type="text" name="delay" value="<?php echo $tr['tile']['delay'] ?>" data-help="<?php rb_e('You can apply a delay between the tiles and postpone their animation relative to each other.', 'RbthemeSlider') ?>"></td>
                                                                        <td class="right"><?php rb_e('Sequence', 'RbthemeSlider') ?></td>
                                                                        <td>
                                                                            <select name="sequence" data-help="<?php rb_e('You can control the animation order of the tiles here.', 'RbthemeSlider') ?>">
                                                                                <option value="forward"<?php echo ($tr['tile']['sequence'] == 'forward') ? ' selected="selected"' : '' ?>><?php rb_e('Forward', 'RbthemeSlider') ?></option>
                                                                                <option value="reverse"<?php echo ($tr['tile']['sequence'] == 'reverse') ? ' selected="selected"' : '' ?>><?php rb_e('Reverse', 'RbthemeSlider') ?></option>
                                                                                <option value="col-forward"<?php echo ($tr['tile']['sequence'] == 'col-forward') ? ' selected="selected"' : '' ?>><?php rb_e('Col-forward', 'RbthemeSlider') ?></option>
                                                                                <option value="col-reverse"<?php echo ($tr['tile']['sequence'] == 'col-reverse') ? ' selected="selected"' : '' ?>><?php rb_e('Col-reverse', 'RbthemeSlider') ?></option>
                                                                                <option value="random"<?php echo ($tr['tile']['sequence'] == 'random') ? ' selected="selected"' : '' ?>><?php rb_e('Random', 'RbthemeSlider') ?></option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4"><?php rb_e('Transition', 'RbthemeSlider') ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody class="transition">
                                                    <tr>
                                                        <td class="right"><?php rb_e('Duration', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="duration" value="<?php echo $tr['transition']['duration'] ?>" data-help="<?php rb_e('The duration of the animation. This value is in millisecs, so the value 1000 measn 1 second.', 'RbthemeSlider') ?>"></td>
                                                        <td class="right"><a href="http://easings.net/" target="_blank"><?php rb_e('Easing', 'RbthemeSlider') ?></a></td>
                                                        <td>
                                                            <select name="easing" data-help="<?php rb_e('The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.', 'RbthemeSlider') ?>">
                                                                <option<?php echo ($tr['transition']['easing'] == 'linear') ? ' selected="selected"' : '' ?>>linear</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'swing') ? ' selected="selected"' : '' ?>>swing</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInQuad') ? ' selected="selected"' : '' ?>>easeInQuad</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutQuad') ? ' selected="selected"' : '' ?>>easeOutQuad</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutQuad') ? ' selected="selected"' : '' ?>>easeInOutQuad</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInCubic') ? ' selected="selected"' : '' ?>>easeInCubic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutCubic') ? ' selected="selected"' : '' ?>>easeOutCubic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutCubic') ? ' selected="selected"' : '' ?>>easeInOutCubic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInQuart') ? ' selected="selected"' : '' ?>>easeInQuart</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutQuart') ? ' selected="selected"' : '' ?>>easeOutQuart</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutQuart') ? ' selected="selected"' : '' ?>>easeInOutQuart</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInQuint') ? ' selected="selected"' : '' ?>>easeInQuint</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutQuint') ? ' selected="selected"' : '' ?>>easeOutQuint</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutQuint') ? ' selected="selected"' : '' ?>>easeInOutQuint</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInSine') ? ' selected="selected"' : '' ?>>easeInSine</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutSine') ? ' selected="selected"' : '' ?>>easeOutSine</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutSine') ? ' selected="selected"' : '' ?>>easeInOutSine</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInExpo') ? ' selected="selected"' : '' ?>>easeInExpo</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutExpo') ? ' selected="selected"' : '' ?>>easeOutExpo</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutExpo') ? ' selected="selected"' : '' ?>>easeInOutExpo</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInCirc') ? ' selected="selected"' : '' ?>>easeInCirc</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutCirc') ? ' selected="selected"' : '' ?>>easeOutCirc</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutCirc') ? ' selected="selected"' : '' ?>>easeInOutCirc</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInElastic') ? ' selected="selected"' : '' ?>>easeInElastic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutElastic') ? ' selected="selected"' : '' ?>>easeOutElastic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutElastic') ? ' selected="selected"' : '' ?>>easeInOutElastic</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInBack') ? ' selected="selected"' : '' ?>>easeInBack</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutBack') ? ' selected="selected"' : '' ?>>easeOutBack</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutBack') ? ' selected="selected"' : '' ?>>easeInOutBack</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInBounce') ? ' selected="selected"' : '' ?>>easeInBounce</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeOutBounce') ? ' selected="selected"' : '' ?>>easeOutBounce</option>
                                                                <option<?php echo ($tr['transition']['easing'] == 'easeInOutBounce') ? 'selected="selected"' : '' ?>>easeInOutBounce</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="right"><?php rb_e('Type', 'RbthemeSlider') ?></td>
                                                        <td>
                                                            <select name="type" data-help="<?php rb_e('The type of the animation, either slide, fade or both (mixed).', 'RbthemeSlider') ?>">
                                                                <option value="slide"<?php echo ($tr['transition']['type'] == 'slide') ? ' selected="selected"' : '' ?>><?php rb_e('Slide', 'RbthemeSlider') ?></option>
                                                                <option value="fade"<?php echo ($tr['transition']['type'] == 'fade') ? ' selected="selected"' : '' ?>><?php rb_e('Fade', 'RbthemeSlider') ?></option>
                                                                <option value="mixed"<?php echo ($tr['transition']['type'] == 'mixed') ? ' selected="selected"' : '' ?>><?php rb_e('Mixed', 'RbthemeSlider') ?></option>
                                                            </select>
                                                        </td>
                                                        <td class="right"><?php rb_e('Direction', 'RbthemeSlider') ?></td>
                                                        <td>
                                                            <select name="direction" data-help="<?php rb_e('The direction of the slide or mixed animation if you\'ve chosen this type in the previous settings.', 'RbthemeSlider') ?>">
                                                                <option value="top"<?php echo ($tr['transition']['direction'] == 'top') ? ' selected="selected"' : '' ?>><?php rb_e('Top', 'RbthemeSlider') ?></option>
                                                                <option value="right"<?php echo ($tr['transition']['direction'] == 'right') ? ' selected="selected"' : '' ?>><?php rb_e('Right', 'RbthemeSlider') ?></option>
                                                                <option value="bottom"<?php echo ($tr['transition']['direction'] == 'bottom') ? ' selected="selected"' : '' ?>><?php rb_e('Bottom', 'RbthemeSlider') ?></option>
                                                                <option value="left"<?php echo ($tr['transition']['direction'] == 'left') ? ' selected="selected"' : '' ?>><?php rb_e('Left', 'RbthemeSlider') ?></option>
                                                                <option value="random"<?php echo ($tr['transition']['direction'] == 'random') ? ' selected="selected"' : '' ?>><?php rb_e('Random', 'RbthemeSlider') ?></option>
                                                                <option value="topleft"<?php echo ($tr['transition']['direction'] == 'topleft') ? ' selected="selected"' : '' ?>><?php rb_e('Top left', 'RbthemeSlider') ?></option>
                                                                <option value="topright"<?php echo ($tr['transition']['direction'] == 'topright') ? ' selected="selected"' : '' ?>><?php rb_e('Top right', 'RbthemeSlider') ?></option>
                                                                <option value="bottomleft"<?php echo ($tr['transition']['direction'] == 'bottomleft') ? ' selected="selected"' : '' ?>><?php rb_e('Bottom left', 'RbthemeSlider') ?></option>
                                                                <option value="bottomright"<?php echo ($tr['transition']['direction'] == 'bottomright') ? ' selected="selected"' : '' ?>><?php rb_e('Bottom right', 'RbthemeSlider') ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="right"><?php rb_e('RotateX', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="rotateX" value="<?php echo !empty($tr['transition']['rotateX']) ? $tr['transition']['rotateX'] : '0' ?>" data-help="The initial rotation of the individual tiles which will be animated to the default (0deg) value around the X axis. You can use negatuve values."></td>
                                                        <td class="right"><?php rb_e('RotateY', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="rotateY" value="<?php echo !empty($tr['transition']['rotateY']) ? $tr['transition']['rotateY'] : '0' ?>" data-help="The initial rotation of the individual tiles which will be animated to the default (0deg) value around the Y axis. You can use negatuve values."></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="right"><?php rb_e('RotateZ', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="rotate" value="<?php echo !empty($tr['transition']['rotate']) ? $tr['transition']['rotate'] : '0' ?>" data-help="The initial rotation of the individual tiles which will be animated to the default (0deg) value around the Z axis. You can use negatuve values."></td>
                                                        <td class="right"><?php rb_e('Scale', 'RbthemeSlider') ?></td>
                                                        <td><input type="text" name="scale" value="<?php echo !empty($tr['transition']['scale']) ? $tr['transition']['scale'] : '1.0' ?>" data-help="The initial scale of the individual tiles which will be animated to the default (1.0) value."></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="rb-publish">
            <?php if (is_writable(dirname($custom_trs))) : ?>
                <button class="button button-primary button-hero"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
            <?php else : ?>
                <?php printf(rb__('Before you can save your changes, you need to make your "%s" folder writable.', 'RbthemeSlider'), $upload_dir['basedir']) ?>
            <?php endif; ?>
        </div>
    </form>
</div>
<script type="text/javascript">
    var pluginPath = '<?php echo RB_VIEWS_URL ?>';
    var rbTrImgPath = '<?php echo RB_VIEWS_URL ?>img/admin/';
    var rbScreenOptions = <?php echo Tools::jsonEncode($rbScreenOptions) ?>;
</script>

<!-- Help menu WP Pointer -->
<?php
if (rb_get_user_meta(rb_get_current_user_id(), 'RbthemeSlider_builder_help_wp_pointer', true) != '1') {
    rb_add_user_meta(rb_get_current_user_id(), 'RbthemeSlider_builder_help_wp_pointer', '1'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#contextual-help-link-wrap').pointer({
                pointerClass : 'rb-help-pointer',
                pointerWidth : 320,
                content: '<h3><?php rb_e('Transition Builder documentation', 'RbthemeSlider') ?></h3><div class="inner"><?php rb_e('To get started with the RbthemeSlider Transition Builder, please read our online documentation by clicking on this help menu.', 'RbthemeSlider') ?></div>',
                position: {
                    edge : 'top',
                    align : 'right'
                }
            }).pointer('open');
        });
    </script>
    <?php
}
