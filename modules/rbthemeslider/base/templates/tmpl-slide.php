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
    $rbDefaults = null;
}
?>
<div class="rb-box rb-layer-box active">
    <input type="hidden" name="layerkey" value="0">
    <table>
        <thead class="rb-layer-options-thead">
            <tr>
                <td colspan="4">
                    <i class="dashicons dashicons-welcome-write-blog"></i>
                    <h4><?php rb_e('Slide Options', 'RbthemeSlider') ?>
                        <button type="button" class="button rb-layer-duplicate"><span class="dashicons dashicons-admin-page"></span><?php rb_e('Duplicate slide', 'RbthemeSlider') ?></button>
                    </h4>
                </td>
            </tr>
        </thead>
        <tbody class="rb-slide-options">
            <input type="hidden" name="post_offset" value="-1">
            <input type="hidden" name="3d_transitions">
            <input type="hidden" name="2d_transitions">
            <input type="hidden" name="custom_3d_transitions">
            <input type="hidden" name="custom_2d_transitions">
            <tr>
                <td class="slide-image">
                    <h3 class="subheader"><?php rb_e('Slide Background Image', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <div class="float">
                            <input type="hidden" name="backgroundId">
                            <input type="hidden" name="background">
                            <div class="rb-image rb-upload rb-bulk-upload rb-slide-image not-set" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>" data-help="<?php echo $rbDefaults['slides']['image']['tooltip'] ?>">
                                <div><img src="<?php echo RB_VIEWS_URL.'img/admin/blank.gif' ?>" alt=""></div>
                                <a href="#" class="aviary dashicons dashicons-image-crop"></a>
                                <a href="#" class="dashicons dashicons-dismiss"></a>
                            </div>
                            <span class="indent">
                                <?php rb_e('or', 'RbthemeSlider') ?> <a href="#" class="rb-url-prompt"><?php rb_e('enter URL', 'RbthemeSlider') ?></a>
                                | <a href="#" class="rb-post-image"><?php rb_e('use product img', 'RbthemeSlider') ?></a>
                            </span>
                        </div>
                        <div class="float">
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['imageSize']['name'] ?>
                                <?php rbGetSelect($rbDefaults['slides']['imageSize'], null, array('class' => 'slideprop')) ?>
                            </div>
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['imagePosition']['name'] ?>
                                <?php rbGetSelect($rbDefaults['slides']['imagePosition'], null, array('class' => 'slideprop')) ?>
                            </div>
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['imageColor']['name'] ?>
                                <?php rbGetInput($rbDefaults['slides']['imageColor'], null, array('class' => 'slideprop rb-colorpicker')) ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="slide-thumb">
                    <h3 class="subheader"><?php rb_e('Slide Thumbnail', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <input type="hidden" name="thumbnailId">
                        <input type="hidden" name="thumbnail">
                        <div class="rb-image rb-upload rb-slide-thumbnail not-set" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>" data-help="<?php echo $rbDefaults['slides']['thumbnail']['tooltip'] ?>">
                            <div><img src="<?php echo RB_VIEWS_URL.'img/admin/blank.gif' ?>" alt=""></div>
                            <a href="#" class="aviary dashicons dashicons-image-crop"></a>
                            <a href="#" class="dashicons dashicons-dismiss"></a>
                        </div>
                        <span class="indent">
                            <?php rb_e('or') ?> <a href="#" class="rb-url-prompt"><?php rb_e('enter URL') ?></a> | <a href="#" class="rb-capture-slide"><?php rb_e('capture slide') ?></a>
                        </span>
                    </div>
                </td>
                <td class="slide-timing">
                    <h3 class="subheader"><?php rb_e('Slide Timing', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['delay']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['delay'], null, array('class' => 'slideprop')) ?> ms<br>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['timeshift']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['timeshift'], null, array('class' => 'slideprop')) ?> ms
                        </div>
                    </div>
                </td>
                <td class="slide-transition">
                    <h3 class="subheader"><?php rb_e('Slide Transition', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <button type="button" class="button rb-select-transitions new" data-help="<?php rb_e('You can select your desired slide transitions by clicking on this button.', 'RbthemeSlider') ?>">Select transitions</button> <br>
                        <div class="row-helper">
                            <?php rbGetInput($rbDefaults['slides']['transitionDuration'], null, array('class' => 'slideprop')) ?>
                            <span>ms</span>
                        </div>
                    </div>
                    <span class="rb-hide-slide">
                        <?php rb_e('Hide this slide', 'RbthemeSlider') ?>
                        <input type="checkbox" name="skip" class="checkbox large slideprop" data-help="<?php rb_e("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", "RbthemeSlider") ?>">
                    </span>
                </td>
            </tr>
            <tr class="rb-advanced rb-hidden">
                <td class="rb-slide-link">
                    <h3 class="subheader"><?php rb_e('Slide Linking', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php rbGetInput($rbDefaults['slides']['linkUrl'], null, array('class' => 'slideprop url', 'placeholder' => $rbDefaults['slides']['linkUrl']['name'])) ?>
                            <span><a href="#" class="dyn"><?php rb_e('use product URL', 'RbthemeSlider') ?></a></span>
                        </div>
                        <div class="row-helper">
                            <?php rbGetSelect($rbDefaults['slides']['linkTarget'], null, array('class' => 'slideprop')) ?>
                            <?php rbGetSelect($rbDefaults['slides']['linkType'], null, array('class' => 'slideprop')) ?>
                        </div>
                    </div>
                </td>
                <td class="slide-schedule">
                    <h3 class="subheader"><?php rb_e('Slide Schedule') ?></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['scheduleStart']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['scheduleStart'], null, array('class' => 'rb-datepicker-input', 'data-schedule-key' => 'schedule_start')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['scheduleEnd']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['scheduleEnd'], null, array('class' => 'rb-datepicker-input', 'data-schedule-key' => 'schedule_end')) ?>
                        </div>
                    </div>
                </td>
                <td class="additional-settings">
                    <h3 class="subheader"><?php rb_e('Additional Slide Settings', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['deeplink']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['deeplink'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <button type="button" class="button rb-configure-posts"><?php rb_e('Configure dynamic content', 'RbthemeSlider') ?></button>
                    </div>
                </td>
                <td class="slide-actions">
                    <h3 class="subheader"></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <span>
                                <a href="#" target="_blank"><?php echo $rbDefaults['slides']['globalHover']['name'] ?></a>
                            </span>
                            <?php rbGetCheckbox($rbDefaults['slides']['globalHover'], null, array('class' => 'slideprop large')) ?>
                        </div>
                        <div class="row-helper">
                            <span>
                                <?php echo $rbDefaults['slides']['overflow']['name'] ?>
                            </span>
                            <?php rbGetCheckbox($rbDefaults['slides']['overflow'], null, array('class' => 'slideprop large')) ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="rb-advanced rb-hidden">
                <td class="slide-ken-burns" style="text-align: center;">
                    <div style="display: inline-block; vertical-align: top;">
                        <h3 class="subheader"><?php rb_e('Slide Attributes', 'RbthemeSlider') ?></h3>
                        <div class="inner" style="padding-left: 0;">
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['title']['name'] ?>
                                <?php rbGetInput($rbDefaults['slides']['title'], null, array('class' => 'slideprop')) ?>
                            </div>
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['alt']['name'] ?>
                                <?php rbGetInput($rbDefaults['slides']['alt'], null, array('class' => 'slideprop')) ?>
                            </div>
                        </div>
                    </div>
                    <div style="display: inline-block;">
                        <h3 class="subheader"><?php rb_e('Ken Burns Effect', 'RbthemeSlider') ?></h3>
                        <div class="inner">
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['kenBurnsZoom']['name'] ?>
                                <?php rbGetSelect($rbDefaults['slides']['kenBurnsZoom'], null, array('class' => 'slideprop')) ?>
                            </div>
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['kenBurnsScale']['name'] ?>
                                <?php rbGetInput($rbDefaults['slides']['kenBurnsScale'], null, array('class' => 'slideprop')) ?>
                            </div>
                            <div class="row-helper">
                                <?php echo $rbDefaults['slides']['kenBurnsRotate']['name'] ?>
                                <?php rbGetInput($rbDefaults['slides']['kenBurnsRotate'], null, array('class' => 'slideprop')) ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="slide-parallax">
                    <h3 class="subheader"></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxType']['name'] ?>
                            <?php rbGetSelect($rbDefaults['slides']['parallaxType'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxEvent']['name'] ?>
                            <?php rbGetSelect($rbDefaults['slides']['parallaxEvent'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxAxis']['name'] ?>
                            <?php rbGetSelect($rbDefaults['slides']['parallaxAxis'], null, array('class' => 'slideprop')) ?>
                        </div>
                    </div>
                </td>
                <td class="slide-parallax">
                    <h3 class="subheader"><?php rb_e('Parallax Defaults', 'RbthemeSlider') ?></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxTransformOrigin']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxTransformOrigin'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxDurationMove']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxDurationMove'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxDurationLeave']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxDurationLeave'], null, array('class' => 'slideprop')) ?>
                        </div>
                    </div>
                </td>
                <td class="slide-parallax">
                    <h3 class="subheader"></h3>
                    <div class="inner">
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxDistance']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxDistance'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxRotate']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxRotate'], null, array('class' => 'slideprop')) ?>
                        </div>
                        <div class="row-helper">
                            <?php echo $rbDefaults['slides']['parallaxPerspective']['name'] ?>
                            <?php rbGetInput($rbDefaults['slides']['parallaxPerspective'], null, array('class' => 'slideprop')) ?>
                        </div>
                    </div>
                </td>
            </tr>
       </tbody>
    </table>

    <div id="rb-more-slide-options" class="button">
        <div>
            <strong>
                <?php rb_e('Show More Options', 'RbthemeSlider') ?>
                <small><?php rb_e('Linking, Ken Burns, Parallax', 'RbthemeSlider') ?></small>
            </strong>
            <strong><?php rb_e('Show Less Options', 'RbthemeSlider') ?></strong>
        </div>

    </div>

    <table id="rb-preview-table">
        <thead>
            <tr>
                <td>
                    <i class="dashicons dashicons-editor-video rb-preview-icon"></i>
                    <h4>
                        <span><?php rb_e('Preview', 'RbthemeSlider') ?></span>
                    </h4>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr id="slider-editor-toolbar">
                <td>
                    <div class="rb-editor-zoom">
                        <!-- <span class="dashicons dashicons-editor-expand rb-layers-icon"></span> -->
                        <div class="rb-editor-slider" ></div>
                        <span class="rb-editor-slider-val">100%</span>
                        |
                        <?php rb_e('Auto-Fit', 'RbthemeSlider') ?>
                        <input id="zoom-fit" class="rb-checkbox checkbox small" type="checkbox" checked>
                    </div>
                    <div class="rb-editor-alignment">
                        <button type="button" class="button" data-rb-su>
                            <span class="dashicons dashicons-align-right rb-layers-icon"></span>
                            <?php rb_e('Align Layer to...', 'RbthemeSlider') ?>
                        </button>
                        <div class="rb-su-data">
                            <table id="rb-layer-alignment" class="rb-layer-alignment">
                                <tr>
                                    <td data-move="top left"><i><?php rb_e('top left', 'RbthemeSlider') ?></i></td>
                                    <td data-move="top center"><i><?php rb_e('top center', 'RbthemeSlider') ?></i></td>
                                    <td data-move="top right"><i><?php rb_e('top right', 'RbthemeSlider') ?></i></td>
                                </tr>
                                <tr>
                                    <td data-move="middle left"><i><?php rb_e('middle left', 'RbthemeSlider') ?></i></td>
                                    <td data-move="middle center"><i><?php rb_e('middle center', 'RbthemeSlider') ?></i></td>
                                    <td data-move="middle right"><i><?php rb_e('middle right', 'RbthemeSlider') ?></i></td>
                                </tr>
                                <tr>
                                    <td data-move="bottom left"><i><?php rb_e('bottom left', 'RbthemeSlider') ?></i></td>
                                    <td data-move="bottom center"><i><?php rb_e('bottom center', 'RbthemeSlider') ?></i></td>
                                    <td data-move="bottom right"><i><?php rb_e('bottom right', 'RbthemeSlider') ?></i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="rb-editor-undo-redo">
                        <div class="rb-editor-undo disabled">
                            <button type="button" class="button-left button">
                                <span class="dashicons dashicons-undo rb-layers-icon"></span>
                            </button>
                            <?php rb_e('Undo', 'RbthemeSlider') ?>
                        </div>
                        |
                        <div class="rb-editor-redo disabled">
                            <?php rb_e('Redo', 'RbthemeSlider') ?>
                            <button type="button" class="button-right button">
                                <span class="dashicons dashicons-redo rb-layers-icon"></span>
                            </button>
                        </div>
                    </div>

                    <div class="rb-editor-preview">
                        <?php rb_e('Preview', 'RbthemeSlider') ?>
                        <button type="button" class="button rb-preview-button"><?php rb_ex('Slide', 'noun', 'RbthemeSlider') ?></button><!--
                     --><button type="button" class="button rb-layer-preview-button"><?php rb_e('Layer', 'RbthemeSlider') ?></button>
                    </div>


                    <div class="rb-editor-layouts">
                        <button data-type="desktop" class="button dashicons dashicons-desktop playing" data-help="<?php rb_e('Show layers that are visible on desktop.', 'RbthemeSlider') ?>"></button><!--
                    --><button data-type="tablet" class="button dashicons dashicons-tablet" data-help="<?php rb_e('Show layers that are visible on tablets.', 'RbthemeSlider') ?>"></button><!--
                    --><button data-type="phone"  class="button dashicons dashicons-smartphone" data-help="<?php rb_e('Show layers that are visible on mobile phones.', 'RbthemeSlider') ?>"></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="rb-preview-td">
        <div class="rb-preview-wrapper rb-preview-size" data-dragover="<?php rb_e('Drop image(s) here', 'RbthemeSlider') ?>">
            <div class="rb-preview rb-preview-size">
                <div id="rb-preview-layers" class="draggable rb-layer rb-preview-transform">
                    <div id="rb-static-preview" class="disabled"></div>
                </div>
            </div>
            <div class="rb-real-time-preview rb-preview-size"></div>
        </div>
    </div>

    <div class="rb-sublayer-wrapper">
        <div class="rb-box rb-pointer rb-layer-types">
            <h3 class="header"><?php rb_e('Choose layer type', 'RbthemeSlider') ?></h3>
            <div>
                <ul class="inner">
                    <li data-type="img">
                        <i class="dashicons dashicons-format-image"></i>
                        <strong><?php rb_e('Image', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="text">
                        <i class="dashicons dashicons-text"></i>
                        <strong><?php rb_e('Text', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="button">
                        <i class="dashicons dashicons-marker"></i>
                        <strong><?php rb_e('Button', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="media">
                        <i class="dashicons dashicons-video-alt3"></i>
                        <strong><?php rb_e('Video / Audio', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="html">
                        <i class="dashicons dashicons-editor-code"></i>
                        <strong><?php rb_e('HTML', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="post">
                        <i class="dashicons dashicons-admin-post"></i>
                        <strong><?php rb_e('Dynamic Layer', 'RbthemeSlider') ?></strong>
                    </li>
                    <li data-type="import">
                        <i class="dashicons dashicons-upload"></i>
                        <strong><?php rb_e('Import Layer', 'RbthemeSlider') ?></strong>
                    </li>
                </ul>
            </div>
        </div>
        <h4>
            <span class="dashicons dashicons-images-alt2 rb-layers-icon"></span>
            <span class="rb-layers-text"><?php rb_e('Layers', 'RbthemeSlider') ?></span>
            <a href="#" class="rb-add-sublayer">
                <span class="dashicons dashicons-plus"></span><?php rb_e('Add New', 'RbthemeSlider') ?>
            </a>
            <div class="rb-timeline-switch filters">
                <ul>
                    <li class="active"><?php rb_e('Layer options', 'RbthemeSlider') ?></li>
                    <li><?php rb_e('Timeline', 'RbthemeSlider') ?></li>
                </ul>
            </div>
        </h4>
        <table class="rb-layers-table">
            <tr>
                <td class="rb-layers-list">
                    <div class="rb-layers-wrapper">
                        <div class="subheader"><?php rb_e('Static layers from other slides', 'RbthemeSlider') ?></div>
                        <ul class="rb-static-sublayers rb-sublayer-sortable"></ul>
                        <div class="subheader"><?php rb_e('Layers on this slide', 'RbthemeSlider') ?></div>
                        <ul class="rb-sublayers rb-sublayer-sortable"></ul>
                        <div class="rb-empty-layer-notification">
                            <i class="dashicons dashicons-info"></i><br>
                            <?php rb_e('This slide has no layers') ?><br>
                            <?php printf(rb__('Click %sAdd New%s to add your first layer.', 'RbthemeSlider'), '<span><span class="dashicons dashicons-plus"></span>', '</span>') ?>
                        </div>
                    </div>
                </td>
                <td class="rb-layers-settings">
                    <div id="rb-layers-settings-popout" data-km-ui-resize="600,950,1300">

                        <div id="rb-layers-settings-popout-handler"
                            data-help="<?php rb_e('You can grab me here and drag where you need.', 'RbthemeSlider') ?>"
                            data-km-ui-popover-once="true"
                            data-km-ui-popover-autoclose="3"
                            data-km-ui-popover-distance="20"
                            data-km-ui-popover-theme="red">
                            <?php rb_e('Layer editor', 'RbthemeSlider') ?>
                            <b id="menu-set-putback">
                                <i class="dashicons dashicons-external"></i>
                                <?php rb_e('Put back', 'RbthemeSlider') ?>
                            </b>
                        </div>

                        <div class="rb-multi-select-notice">
                            <h5>
                                <span class="dashicons dashicons-info"></span>
                                <?php rb_e('Multiple Selection Mode', 'RbthemeSlider') ?>
                                <sup><?php rb_e('BETA', 'RbthemeSlider') ?></sup>
                            </h5>
                            <span><?php rb_e('In Multiple Selection Mode you can override specific options on all selected layers. Each option field has been reset, only the options you change will be updated on the selected layers. This feature is currently in beta phase, use it cautiously.', 'RbthemeSlider') ?></span>
                            <small><?php rb_e('Changes will be applied on all selected layers.', 'RbthemeSlider') ?></small>
                        </div>
                        <div class="rb-sublayer-pages-wrapper">
                            <div class="rb-sublayer-nav">
                                <a href="#" class="active"><?php rb_e('Content', 'RbthemeSlider') ?></a>
                                <a href="#"><?php rb_e('Transitions', 'RbthemeSlider') ?></a>
                                <a href="#"><?php rb_e('Link & Attributes', 'RbthemeSlider') ?></a>
                                <a href="#"><?php rb_e('Styles', 'RbthemeSlider') ?></a>
                                <b id="rb-easy-view">
                                    <span><?php rb_e('EASY MODE') ?></span>
                                </b>
                                <b id="menu-set-float">
                                    <i class="dashicons dashicons-external"></i>
                                    <?php rb_e('Pop out editor', 'RbthemeSlider') ?>
                                </b>
                            </div>
                            <div class="rb-sublayer-pages">
                            </div>
                        </div>

                    </div>
                </td>
            </tr>
        </table>
        <div class="rb-preview-timeline" data-timeline-for="rb-preview-timeline"></div>
    </div>
</div>