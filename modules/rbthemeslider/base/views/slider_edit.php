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

// Attempt to avoid memory limit issues
@ini_set('memory_limit', '256M');

// Get the IF of the slider
$id = (int) ${'_GET'}['id'];

// Get slider
$sliderItem = RbSliders::find($id);
$slider = $sliderItem['data'];
// Get screen options
$rbScreenOptions = rb_get_option('rb-screen-options', '0');
$rbScreenOptions = ($rbScreenOptions == 0) ? array() : $rbScreenOptions;
$rbScreenOptions = is_array($rbScreenOptions) ? $rbScreenOptions : unserialize($rbScreenOptions);

// Defaults: tooltips
if (! isset($rbScreenOptions['showTooltips'])) {
    $rbScreenOptions['showTooltips'] = 'true';
}

// Deafults: keyboard shortcuts
if (! isset($rbScreenOptions['useKeyboardShortcuts'])) {
    $rbScreenOptions['useKeyboardShortcuts'] = 'true';
}

// Deafults: keyboard shortcuts
if (! isset($rbScreenOptions['useNotifyOSD'])) {
    $rbScreenOptions['useNotifyOSD'] = 'true';
}

// Get phpQuery
if (! defined('RB_PHPQUERY')) {
    libxml_use_internal_errors(true);
    include RB_ROOT_PATH.'/helpers/phpQuery.php';
}

// Get defaults
include RB_ROOT_PATH . '/config/defaults.php';
include RB_ROOT_PATH . '/helpers/admin.ui.tools.php';

// Run filters

if (rb_has_filter('rbthemeslider_override_defaults')) {

    $newDefaults = rb_apply_filters('rbthemeslider_override_defaults', $rbDefaults);
    if (!empty($newDefaults) && is_array($newDefaults)) {
        $rbDefaults = $newDefaults;
        unset($newDefaults);
    }
}

// Show tab
$settingsTabClass = isset(${'_GET'}['showsettings']) ? 'active' : '';
$slidesTabClass = !isset(${'_GET'}['showsettings']) ? 'active' : '';

// Fixes
if (!isset($slider['layers'][0]['properties'])) {
    $slider['layers'][0]['properties'] = array();
}

// Get google fonts
$googleFonts = rb_get_option('rb-google-fonts', array());

// Get post types
$postTypes = RbPosts::getPostTypes();
$postCategories = rb_get_categories();
$postTags = rb_get_tags();
$postTaxonomies = rb_get_taxonomies(array('_builtin' => false), 'objects');
?>
<div id="rb-screen-options" class="metabox-prefs hidden">
    <div id="screen-options-wrap" class="hidden">
        <form id="rb-screen-options-form" method="post">
            <?php rb_nonce_field('rb-save-screen-options'); ?>
            <h5><?php rb_e('Use features', 'RbthemeSlider') ?></h5>
            <label>
                <input type="checkbox" name="showTooltips"<?php echo $rbScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> Tooltips
            </label>
            <label>
                <input type="checkbox" name="useKeyboardShortcuts"<?php echo $rbScreenOptions['useKeyboardShortcuts'] == 'true' ? ' checked="checked"' : ''?>> Keyboard shortcuts
            </label>
            <label>
                <input type="checkbox" name="useNotifyOSD"<?php echo $rbScreenOptions['useNotifyOSD'] == 'true' ? ' checked="checked"' : ''?>> On Screen Notifications
            </label>
        </form>
    </div>
    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="show-settings-link" class="button show-settings" aria-controls="screen-options-wrap" aria-expanded="false"><?php rb_e('Screen Options', 'RbthemeSlider') ?></button>
    </div>
</div>

<!-- Load templates -->
<?php
include RB_ROOT_PATH . '/templates/tmpl-share-sheet.php';
include RB_ROOT_PATH . '/templates/tmpl-layer-item.php';
include RB_ROOT_PATH . '/templates/tmpl-static-layer-item.php';
include RB_ROOT_PATH . '/templates/tmpl-layer.php';
include RB_ROOT_PATH . '/templates/tmpl-preview-context-menu.php';
include RB_ROOT_PATH . '/templates/tmpl-transition-window.php';
include RB_ROOT_PATH . '/templates/tmpl-post-chooser.php';
include RB_ROOT_PATH . '/templates/tmpl-insert-icons-modal.php';
include RB_ROOT_PATH . '/templates/tmpl-import-layer.php';
?>

<!-- Load slide template -->
<script type="text/html" id="rb-slide-template">
    <?php include RB_ROOT_PATH . '/templates/tmpl-slide.php'; ?>
</script>

<!-- Slider JSON data source -->
<?php

if (! isset($slider['properties']['status'])) {
    $slider['properties']['status'] = true;
}

// COMPAT: If old and non-fullwidth slider
if (! isset($slider['properties']['slideBGSize']) && ! isset($slider['properties']['new'])) {
    if (empty($slider['properties']['forceresponsive'])) {
        $slider['properties']['slideBGSize'] = 'auto';
    }
}

$slider['properties']['schedule_start'] = '';
$slider['properties']['schedule_end'] = '';

if (! empty($sliderItem['schedule_start'])) {
    $slider['properties']['schedule_start'] = (int) $sliderItem['schedule_start'];
}

if (! empty($sliderItem['schedule_end'])) {
    $slider['properties']['schedule_end'] = (int) $sliderItem['schedule_end'];
}

// Get yourLogo
if (! empty($slider['properties']['yourlogoId'])) {
    $slider['properties']['yourlogo'] = rb_apply_filters('rb_get_image', $slider['properties']['yourlogoId'], $slider['properties']['yourlogo']);
    $slider['properties']['yourlogoThumb'] = rb_apply_filters('rb_get_thumbnail', $slider['properties']['yourlogoId'], $slider['properties']['yourlogo']);
}


$slider['properties']['cbinit'] = !empty($slider['properties']['cbinit']) ? _ss($slider['properties']['cbinit']) : $rbDefaults['slider']['cbInit']['value'];
$slider['properties']['cbstart'] = !empty($slider['properties']['cbstart']) ? _ss($slider['properties']['cbstart']) : $rbDefaults['slider']['cbStart']['value'];
$slider['properties']['cbstop'] = !empty($slider['properties']['cbstop']) ? _ss($slider['properties']['cbstop']) : $rbDefaults['slider']['cbStop']['value'];
$slider['properties']['cbpause'] = !empty($slider['properties']['cbpause']) ? _ss($slider['properties']['cbpause']) : $rbDefaults['slider']['cbPause']['value'];
$slider['properties']['cbanimstart'] = !empty($slider['properties']['cbanimstart']) ? _ss($slider['properties']['cbanimstart']) : $rbDefaults['slider']['cbAnimStart']['value'];
$slider['properties']['cbanimstop'] = !empty($slider['properties']['cbanimstop']) ? _ss($slider['properties']['cbanimstop']) : $rbDefaults['slider']['cbAnimStop']['value'];
$slider['properties']['cbprev'] = !empty($slider['properties']['cbprev']) ? _ss($slider['properties']['cbprev']) : $rbDefaults['slider']['cbPrev']['value'];
$slider['properties']['cbnext'] = !empty($slider['properties']['cbnext']) ? _ss($slider['properties']['cbnext']) : $rbDefaults['slider']['cbNext']['value'];


if (empty($slider['properties']['new']) && empty($slider['properties']['type'])) {
    if (!empty($slider['properties']['forceresponsive'])) {
        $slider['properties']['type'] = 'fullwidth';

        if (strpos($slider['properties']['width'], '%') !== false) {
            if (! empty($slider['properties']['responsiveunder'])) {
                $slider['properties']['width'] = $slider['properties']['responsiveunder'];
            } elseif (! empty($slider['properties']['sublayercontainer'])) {
                $slider['properties']['width'] = $slider['properties']['sublayercontainer'];
            }
        }
    } elseif (empty($slider['properties']['responsive'])) {
        $slider['properties']['type'] = 'fixedsize';
    } else {
        $slider['properties']['type'] = 'responsive';
    }
}

if (! empty($slider['properties']['width'])) {
    if (strpos($slider['properties']['width'], '%') !== false) {
        $slider['properties']['width'] = 1000;
    }
}

if (! empty($slider['properties']['sublayercontainer'])) {
    unset($slider['properties']['sublayercontainer']);
}

if (! empty($slider['properties']['width'])) {
    $slider['properties']['width'] = (int) $slider['properties']['width'];
}

if (! empty($slider['properties']['width'])) {
    $slider['properties']['height'] = (int) $slider['properties']['height'];
}

if (empty($slider['properties']['pauseonhover'])) {
    $slider['properties']['pauseonhover'] = 'enabled';
}

if (empty($slider['properties']['sliderVersion']) && empty($slider['properties']['circletimer'])) {
    $slider['properties']['circletimer'] = false;
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

            $layerVal['styles'] = Tools::stripslashes($layerVal['styles']);
            $layerVal['transition'] = Tools::stripslashes($layerVal['transition']);

            // Parse embedded JSON data
            $layerVal['styles'] = !empty($layerVal['styles']) ? (object) Tools::jsonDecode(_ss($layerVal['styles']), true) : new stdClass;
            $layerVal['transition'] = !empty($layerVal['transition']) ? (object) Tools::jsonDecode(_ss($layerVal['transition']), true) : new stdClass;
            $layerVal['html'] = !empty($layerVal['html']) ? _ss($layerVal['html']) : '';

            // Add 'top', 'left' and 'wordwrap' to the styles object
            if (isset($layerVal['top'])) {
                $layerVal['styles']->top = $layerVal['top'];
                unset($layerVal['top']);
            }
            if (isset($layerVal['left'])) {
                $layerVal['styles']->left = $layerVal['left'];
                unset($layerVal['left']);
            }
            if (isset($layerVal['wordwrap'])) {
                $layerVal['styles']->wordwrap = $layerVal['wordwrap'];
                unset($layerVal['wordwrap']);
            }

            if (! empty($layerVal['transition']->showuntil)) {
                $layerVal['transition']->startatout = 'transitioninend + '.$layerVal['transition']->showuntil;
                $layerVal['transition']->startatouttiming = 'transitioninend';
                $layerVal['transition']->startatoutvalue = $layerVal['transition']->showuntil;
                unset($layerVal['transition']->showuntil);
            }

            if (! empty($layerVal['transition']->parallaxlevel)) {
                $layerVal['transition']->parallax = true;
            }

            // Custom attributes
            $layerVal['innerAttributes'] = !empty($layerVal['innerAttributes']) ?  (object) $layerVal['innerAttributes'] : new stdClass;
            $layerVal['outerAttributes'] = !empty($layerVal['outerAttributes']) ?  (object) $layerVal['outerAttributes'] : new stdClass;

            // v6.5.6: Convert old checkbox media settings to the new
            // select based options.
            if (isset($layerVal['transition']->controls)) {
                if (true === $layerVal['transition']->controls) {
                    $layerVal['transition']->controls = 'auto';
                } elseif (false === $layerVal['transition']->controls) {
                    $layerVal['transition']->controls = 'disabled';
                }
            }

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

// Slider version
$slider['properties']['sliderVersion'] = RB_PLUGIN_VERSION;
?>

<!-- Get slider data from DB -->
<script type="text/javascript">

    // Slider data
    window.rbSliderData = <?php echo Tools::jsonEncode($slider) ?>;

    // Plugin path
    var pluginPath = '<?php echo RB_VIEWS_URL ?>';
    var rbTrImgPath = '<?php echo RB_VIEWS_URL ?>img/admin/';

    // Screen options
    var rbScreenOptions = <?php echo Tools::jsonEncode($rbScreenOptions) ?>;
</script>



<form method="post" id="rb-slider-form" novalidate="novalidate" autocomplete="off">

    <input type="hidden" name="slider_id" value="<?php echo $id ?>">
    <input type="hidden" name="action" value="rb_save_slider">
    <?php rb_nonce_field('rb-save-slider-' . $id); ?>

    <div class="wrap">

        <!-- Title -->
        <h2>
            <?php rb_e('Editing slider:', 'RbthemeSlider') ?>
            <?php $sliderName = !empty($slider['properties']['title']) ? $slider['properties']['title'] : 'Unnamed'; ?>
            <?php echo rb_apply_filters('rb_slider_title', $sliderName, 30) ?>
            <a href="?page=AdminRbthemesliderSlider" class="add-new-h2"><?php rb_e('Back to the list', 'RbthemeSlider') ?></a>
        </h2>

        <!-- Version number -->
        <?php include RB_ROOT_PATH . '/templates/tmpl-beta-feedback.php'; ?>

        <div class="rb-notify-osd">
            <span class="icon"></span>
            <span class="text"></span>
        </div>

        <!-- Main menu bar -->
        <div id="rb-main-nav-bar">
            <a href="#slider-settings" data-deeplink="slider-settings" class="settings <?php echo $settingsTabClass ?>">
                <i class="dashicons dashicons-admin-tools"></i>
                <?php rb_e('Slider Settings', 'RbthemeSlider') ?>
            </a>
            <a href="#" class="layers <?php echo $slidesTabClass ?>">
                <i class="dashicons dashicons-images-alt"></i>
                <?php rb_e('Slides', 'RbthemeSlider') ?>
            </a>
            <a href="#callbacks" data-deeplink="callbacks" class="callbacks">
                <i class="dashicons dashicons-redo"></i>
                <?php rb_e('Event Callbacks', 'RbthemeSlider') ?>
            </a>
            <a href="#" target="_blank" class="faq right unselectable">
                <i class="dashicons dashicons-sos"></i>
                <?php rb_e('FAQ', 'RbthemeSlider') ?>
            </a>
            <a href="#" target="_blank" class="support right unselectable">
                <i class="dashicons dashicons-editor-help"></i>
                <?php rb_e('Documentation', 'RbthemeSlider') ?>
            </a>
            <a href="#" class="clear unselectable"></a>
        </div>

    </div>

    <!-- Post options -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-post-options.php'; ?>

    <!-- Pages -->
    <div id="rb-pages">

        <!-- Slider Settings -->
        <div class="rb-page rb-settings rb-slider-settings <?php echo $settingsTabClass ?>">
            <?php include RB_ROOT_PATH . '/templates/tmpl-slider-settings.php'; ?>
        </div>

        <!-- Slides -->
        <div class="rb-page <?php echo $slidesTabClass ?>">

            <!-- Slide tabs -->
            <div id="rb-layer-tabs">
            <?php
            foreach ($slider['layers'] as $key => $layer) :
                $active = empty($key) ? 'active' : '';
                $name = !empty($layer['properties']['title']) ? $layer['properties']['title'] : 'Slide #'.($key+1);
                $bgImage = !empty($layer['properties']['background']) ? $layer['properties']['background'] : null;
                $bgImageId = !empty($layer['properties']['backgroundId']) ? $layer['properties']['backgroundId'] : null;
                $image = rb_apply_filters('rb_get_image', $bgImageId, $bgImage, true);
                ?>
                <a href="#" class="<?php echo $active ?>" data-help="<div style='background-image: url(<?php echo $image?>);'></div>" data-help-class="rb-slide-preview-tooltip popover-light rb-popup" data-help-delay="1" data-help-transition="false">
                    <span><?php echo $name ?></span>
                    <span class="dashicons dashicons-dismiss"></span>
                </a>
            <?php
            endforeach ?>
                <a href="#"  title="<?php rb_e('Add new slide', 'RbthemeSlider') ?>" class="unsortable" id="rb-add-layer"><i class="dashicons dashicons-plus"></i></a>
                <div class="unsortable clear"></div>
            </div>

            <!-- Slides -->
            <div id="rb-layers" class="clearfix">
                <?php include RB_ROOT_PATH . '/templates/tmpl-slide.php'; ?>
            </div>
        </div>

        <!-- Event Callbacks -->
        <div class="rb-page rb-callback-page">

            <div class="rb-notification-info">
                <i class="dashicons dashicons-info"> </i>
                <?php echo sprintf(rb__('Please read our %sonline documentation%s before start using the API. RbthemeSlider 6 introduced an entirely new API model with different events and methods.', 'RbthemeSlider'), '<a href="#">', '</a>') ?>
            </div>


            <div class="rb-callback-separator">Init Events</div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    sliderWillLoad
                    <figure><span>|</span> <?php rb_e('Fires before parsing user settings and rendering the UI.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderWillLoad" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    sliderDidLoad
                    <figure><span>|</span> <?php rb_e('Fires when the slider is fully initialized and its DOM nodes become accessible.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderDidLoad" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-callback-separator"><?php rb_e('Resize Events', 'RbthemeSlider') ?></div>


            <div class="rb-box rb-callback-box side">
                <h3 class="header">
                    sliderWillResize
                    <figure><span>|</span> <?php rb_e('Fires before the slider renders resize events.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderWillResize" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    sliderDidResize
                    <figure><span>|</span> <?php rb_e('Fires after the slider has rendered resize events.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderDidResize" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-callback-separator"><?php rb_e('Slideshow Events', 'RbthemeSlider') ?></div>


            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideshowStateDidChange
                    <figure><span>|</span> <?php rb_e('Fires upon every slideshow state change, which may not influence the playing status.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideshowStateDidChange" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideshowDidPause
                    <figure><span>|</span> <?php rb_e('Fires when the slideshow pauses from playing status.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideshowDidPause" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box side">
                <h3 class="header">
                    slideshowDidResume
                    <figure><span>|</span> <?php rb_e('Fires when the slideshow resumes from paused status.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideshowDidResume" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>


            <div class="rb-callback-separator"><?php rb_e('Slide Change Events', 'RbthemeSlider') ?></div>


            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideChangeWillStart
                    <figure><span>|</span> <?php rb_e('Signals when the slider wants to change slides, and is your last chance to divert it or intervene in any way.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideChangeWillStart" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideChangeDidStart
                    <figure><span>|</span> <?php rb_e('Fires when the slider has started a slide change.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideChangeDidStart" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideChangeWillComplete
                    <figure><span>|</span> <?php rb_e('Fires before completing a slide change.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideChangeWillComplete" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideChangeDidComplete
                    <figure><span>|</span> <?php rb_e('Fires after a slide change has completed and the slide indexes have been updated. ', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideChangeDidComplete" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>


            <div class="rb-callback-separator"><?php rb_e('Slide Timeline Events', 'RbthemeSlider') ?></div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideTimelineDidCreate
                    <figure><span>|</span> <?php rb_e("Fires when the current slide's animation timeline (e.g. your layers) becomes accessible for interfacing.", 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideTimelineDidCreate" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, data) {\n\t\n}" ?></textarea>
                </div>
            </div>


            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideTimelineDidUpdate
                    <figure><span>|</span> <?php rb_e("Fires rapidly (at each frame) throughout the entire slide while playing, including reverse playback.", 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideTimelineDidUpdate" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, timeline) {\n\t\n}" ?></textarea>
                </div>
            </div>


            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideTimelineDidStart
                    <figure><span>|</span> <?php rb_e("Fires when the current slide's animation timeline (e.g. your layers) has started playing.", 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideTimelineDidStart" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideTimelineDidComplete
                    <figure><span>|</span> <?php rb_e("Fires when the current slide's animation timeline (e.g. layer transitions) has completed.", 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideTimelineDidComplete" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    slideTimelineDidReverseComplete
                    <figure><span>|</span> <?php rb_e('Fires when all reversed animations have reached the beginning of the current slide.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="slideTimelineDidReverseComplete" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event, slider) {\n\t\n}" ?></textarea>
                </div>
            </div>


            <div class="rb-callback-separator"><?php rb_e('Destroy Events', 'RbthemeSlider') ?></div>


            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    sliderDidDestroy
                    <figure><span>|</span> <?php rb_e('Fires when the slider destructor has finished and it is safe to remove the slider from the DOM.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderDidDestroy" data-event-data="false" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event) {\n\t\n}" ?></textarea>
                </div>
            </div>

            <div class="rb-box rb-callback-box">
                <h3 class="header">
                    sliderDidRemove
                    <figure><span>|</span> <?php rb_e('Fires when the slider has been removed from the DOM when using the <i>destroy</i> API method.', 'RbthemeSlider') ?></figure>
                </h3>
                <div>
                    <textarea name="sliderDidRemove" data-event-data="false" cols="20" rows="5" class="rb-codemirror"><?php echo "function(event) {\n\t\n}" ?></textarea>
                </div>
            </div>


        </div>
    </div>

    <div class="rb-publish">
        <button type="submit" class="button button-primary button-hero"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
        <div class="rb-save-shortcode">
            <?php
            $revisions = RbRevisions::count($id);
            if ($revisions > 1) : ?>
                <p class="revisions"><span><i class="dashicons dashicons-backup"></i><?php echo sprintf(rb__('Revisions Available:', 'RbthemeSlider'), $revisions) ?></span><br><a href="<?php echo rb_admin_url('admin.php?page=rb-revisions&id='.$id) ?>"><?php echo sprintf(rb__('Browse %d Revisions', 'RbthemeSlider'), $revisions) ?></a></p>
            <?php
            endif ?>
            <p><span><?php rb_e('Use shortcode:', 'RbthemeSlider') ?></span><br><span>[RbthemeSlider id="<?php echo !empty($slider['properties']['slug']) ? $slider['properties']['slug'] : $id ?>"]</span></p>
            <p><span><?php rb_e('Use PHP function:', 'RbthemeSlider') ?></span><br><span>&lt;?php RbthemeSlider(<?php echo !empty($slider['properties']['slug']) ? "'{$slider['properties']['slug']}'" : $id ?>) ?&gt;</span></p>
        </div>
    </div>
</form>