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

// Attempt to avoid memory limit issues
@ini_set('memory_limit', '256M');

// Get the IF of the slider
$id = (int) ${'_GET'}['id'];

// Get slider
$sliderItem = RbSliders::find($id);
$slider = $sliderItem['data'];

rb_enqueue_script('RbthemeSlider-admin');

$revisions = RbRevisions::snapshots($id);
$revisionsCount = count($revisions);

foreach ($revisions as $key => $revision) {
    $revisions[$key]->avatar = rb_get_avatar_url($revisions[$key]->author);
    $revisions[$key]->nickname = rb_get_userdata($revisions[$key]->author)->user_nicename;
    $revisions[$key]->time_diff = sprintf(rb__(' %s ago', 'RbthemeSlider'), rb_human_time_diff($revision->date_c));
    $revisions[$key]->created = date('M j @ H:i', $revision->date_c);

    $slider = json_decode($revision->data, true);

    // Fixes
    if (!isset($slider['layers'][0]['properties'])) {
        $slider['layers'][0]['properties'] = array();
    }


    // Get yourLogo
    if (! empty($slider['properties']['yourlogoId'])) {
        $slider['properties']['yourlogo'] = rb_apply_filters('rb_get_image', $slider['properties']['yourlogoId'], $slider['properties']['yourlogo']);
        $slider['properties']['yourlogoThumb'] = rb_apply_filters('rb_get_thumbnail', $slider['properties']['yourlogoId'], $slider['properties']['yourlogo']);
    }


    if (! empty($slider['properties']['width'])) {
        if (strpos($slider['properties']['width'], '%') !== false) {
            $slider['properties']['width'] = 1000;
        }
    }

    if (! empty($slider['properties']['width'])) {
        $slider['properties']['width'] = (int) $slider['properties']['width'];
    }

    if (! empty($slider['properties']['width'])) {
        $slider['properties']['height'] = (int) $slider['properties']['height'];
    }

    // Convert old checkbox values
    foreach ($slider['properties'] as $optionKey => $optionValue) {
        switch ($optionValue) {
            case 'on':
                $slider['properties'][$optionKey] = true;
                break;
            case 'off':
                $slider['properties'][$optionKey] = false;
                break;
        }
    }

    foreach ($slider['layers'] as $slideKey => $slideVal) {
        // Get slide background
        if (! empty($slideVal['properties']['backgroundId'])) {
            $slideVal['properties']['background'] = rb_apply_filters('rb_get_image', $slideVal['properties']['backgroundId'], $slideVal['properties']['background']);
            $slideVal['properties']['backgroundThumb'] = rb_apply_filters('rb_get_thumbnail', $slideVal['properties']['backgroundId'], $slideVal['properties']['background']);
        }

        // Get slide thumbnail
        if (! empty($slideVal['properties']['thumbnailId'])) {
            $slideVal['properties']['thumbnail'] = rb_apply_filters('rb_get_image', $slideVal['properties']['thumbnailId'], $slideVal['properties']['thumbnail']);
            $slideVal['properties']['thumbnailThumb'] = rb_apply_filters('rb_get_thumbnail', $slideVal['properties']['thumbnailId'], $slideVal['properties']['thumbnail']);
        }


        // v6.3.0: Improve compatibility with *really* old sliders
        if (! empty($slideVal['sublayers']) && is_array($slideVal['sublayers'])) {
            $slideVal['sublayers'] = array_values($slideVal['sublayers']);
        }


        $slider['layers'][$slideKey] = $slideVal;

        if (!empty($slideVal['sublayers']) && is_array($slideVal['sublayers'])) {
            // v6.0: Reverse layers list
            $slideVal['sublayers'] = array_reverse($slideVal['sublayers']);

            foreach ($slideVal['sublayers'] as $layerKey => $layerVal) {
                if (! empty($layerVal['imageId'])) {
                    $layerVal['image'] = rb_apply_filters('rb_get_image', $layerVal['imageId'], $layerVal['image']);
                    $layerVal['imageThumb'] = rb_apply_filters('rb_get_thumbnail', $layerVal['imageId'], $layerVal['image']);
                }

                if (! empty($layerVal['posterId'])) {
                    $layerVal['poster'] = rb_apply_filters('rb_get_image', $layerVal['posterId'], $layerVal['poster']);
                    $layerVal['posterThumb'] = rb_apply_filters('rb_get_thumbnail', $layerVal['posterId'], $layerVal['poster']);
                }

                // Ensure that magic quotes will not mess with JSON data
                $layerVal['styles'] = Tools::stripslashes($layerVal['styles']);
                $layerVal['transition'] = Tools::stripslashes($layerVal['transition']);

                // Parse embedded JSON data
                $layerVal['styles'] = !empty($layerVal['styles']) ? (object) json_decode(_ss($layerVal['styles']), true) : new stdClass;
                $layerVal['transition'] = !empty($layerVal['transition']) ? (object) json_decode(_ss($layerVal['transition']), true) : new stdClass;
                $layerVal['html'] = !empty($layerVal['html']) ? _ss($layerVal['html']) : '';

                // Custom attributes
                $layerVal['innerAttributes'] = !empty($layerVal['innerAttributes']) ? (object) $layerVal['innerAttributes'] : new stdClass;
                $layerVal['outerAttributes'] = !empty($layerVal['outerAttributes']) ? (object) $layerVal['outerAttributes'] : new stdClass;

                $slider['layers'][$slideKey]['sublayers'][$layerKey] = $layerVal;
            }
        } else {
            $slider['layers'][$slideKey]['sublayers'] = array();
        }
    }

    if (! empty($slider['callbacks'])) {
        foreach ($slider['callbacks'] as $key => $callback) {
            $slider['callbacks'][$key] = _ss($callback);
        }
    }

    $revisions[$key]->data = $slider;
}
?>

<!-- Get slider data from DB -->
<script type="text/javascript">

    // Revisions
    window.rbRevisions = <?php echo json_encode($revisions); ?>;

    // Slider data
    window.rbSliderData = <?php echo json_encode($slider) ?>;

    window.rbPostsJSON = [];

    // Plugin path
    var pluginPath = '<?php echo RB_VIEWS_URL ?>';
    var rbTrImgPath = '<?php echo RB_VIEWS_URL ?>img/admin/';

</script>


<div id="rb-revisions">

    <div class="wrap">
        <h2>
            <?php rb_e('Revisions for Slider:', 'RbthemeSlider') ?>
            <?php $sliderName = !empty($slider['properties']['title']) ? $slider['properties']['title'] : 'Unnamed'; ?>
            <?php echo rb_apply_filters('rb_slider_title', $sliderName, 30) ?>
            <a href="<?php echo rb_admin_url('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.$id) ?>" class="add-new-h2"><?php rb_e('Back to Slider', 'RbthemeSlider') ?></a>
        </h2>
        <form method="post" id="rb-revisions-form">
            <?php rb_nonce_field('rb-revert-slider-' . $id); ?>
            <input type="hidden" name="rb-revert-slider" value="1">
            <input type="hidden" name="slider-id" value="<?php echo $id ?>">
            <input type="hidden" id="revision-id" name="revision-id" value="<?php echo $revision->id ?>">
            <span class="rb-revisions-oldest"><?php echo date('M j, Y', $revisions[0]->date_c) ?></span>
            <span class="rb-revisions-now"><?php rb_e('Now') ?></span>

            <div id="rb-revisions-selected">
                <table>
                    <tr>
                        <td class="avatar" rowspan="2">
                            <img src="<?php echo $revision->avatar ?>">
                        </td>
                        <td>
                            <?php echo sprintf(rb__('Selected Revision by %s', 'RbthemeSlider'), '<strong class="author">'.$revision->nickname.'</strong>')  ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="time-diff"><?php echo $revision->time_diff ?></span>
                            (<span class="date"><?php echo $revision->created ?></span>)
                        </td>
                    </tr>
                </table>
                <button class="button button-primary button-hero"><?php rb_e('Revert to This Revision', 'RbthemeSlider') ?></button>
            </div>

            <input type="range" id="rb-revisions-range" min="1" max="<?php echo $revisionsCount ?>" value="<?php echo $revisionsCount ?>" name="revision" list="rb-revisions-timeline">
            <datalist id="rb-revisions-timeline">
                <?php for ($c = 1; $c <= $revisionsCount; $c++) : ?>
                <option><?php echo $c ?></option>
                <?php endfor ?>
            </datalist>
        </form>

        <div class="rb-notification-info">
            <i class="dashicons dashicons-info"></i>
            <?php rb_e('Reverting a slider to an earlier version adds another snapshot to Revisions, which can also be reverted if you change your mind and would rather return to the original copy.', 'RbthemeSlider') ?>
            <?php rb_e('Slider Revisions also saves the undo/redo controls. Even if there is no perfect snapshot, you will be able to undo the changes in-between to find what you are looking for.', 'RbthemeSlider') ?>
        </div>

        <h2 class="rb-revisions-h2"><?php rb_e('Preview for Selected Revision', 'RbthemeSlider') ?></h2>
        <div id="rb-slider-form">
            <div id="rb-layer-tabs">
                <?php
                foreach ($slider['layers'] as $key => $layer) :
                    $active = empty($key) ? 'active' : '';
                    $name = !empty($layer['properties']['title']) ? $layer['properties']['title'] : sprintf(rb__('Slide #%d', 'RbthemeSlider'), ($key+1));
                    $bgImage = !empty($layer['properties']['background']) ? $layer['properties']['background'] : null;
                    $bgImageId = !empty($layer['properties']['backgroundId']) ? $layer['properties']['backgroundId'] : null;
                    $image = rb_apply_filters('rb_get_image', $bgImageId, $bgImage, true);
                    ?>
                    <a href="#" class="<?php echo $active ?>" data-help="<div style='background-image: url(<?php echo $image?>);'></div>" data-help-class="rb-slide-preview-tooltip popover-light km-ui-popup" data-help-delay="1" data-help-transition="false">
                        <span><?php echo $name ?></span>
                        <span class="dashicons dashicons-dismiss"></span>
                    </a>
                <?php
                endforeach; ?>
                <div class="unsortable clear"></div>
            </div>

            <!-- Slides -->
            <div id="rb-layers" class="clearfix">
                <div class="rb-box rb-layer-box active">
                    <table id="rb-preview-table">
                        <tbody>
                            <tr id="slider-editor-toolbar">
                                <td >
                                    <div class="rb-editor-zoom">
                                        <!-- <span class="dashicons dashicons-editor-expand rb-layers-icon"></span> -->
                                        <div class="rb-editor-slider" ></div>
                                        <span class="rb-editor-slider-val">100%</span>
                                        |
                                        <?php rb_e('Auto-Fit', 'RbthemeSlider') ?>
                                        <input id="zoom-fit" class="rb-checkbox checkbox small" type="checkbox" checked>
                                    </div>


                                    <div class="rb-editor-preview">
                                        <button type="button" class="button rb-preview-button"><?php rb_e('Preview Slide', 'RbthemeSlider') ?></button>
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
                </div>
            </div>
        </div>
    </div>
</div>
