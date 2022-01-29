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

rb_add_action('init', 'rb_register_form_actions');
function rb_register_form_actions()
{
    rb_add_action('save_post', 'layerthemeslider_delete_caches');
    if (rb_current_user_can(rb_get_option('rbthemeslider_custom_capability', 'manage_options'))) {
        // Sliders list layout
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'layout') {
            $type = (${'_GET'}['type'] === 'list') ? 'list' : 'grid';
            rb_update_user_meta(rb_get_current_user_id(), 'rb-sliders-layout', $type);
            rb_redirect('admin.php?page=AdminRbthemesliderSlider');
        }

        // Remove slider
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'remove') {
            if (rb_check_admin_referer('remove_'.${'_GET'}['id'])) {
                rb_add_action('admin_init', 'rbthemeslider_removeslider');
            }
        }

        // Restore slider
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'restore') {
            if (rb_check_admin_referer('restore_'.${'_GET'}['id'])) {
                rb_add_action('admin_init', 'rbthemeslider_restoreslider');
            }
        }

        // Duplicate slider
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'duplicate') {
            if (rb_check_admin_referer('duplicate_'.${'_GET'}['id'])) {
                rb_add_action('admin_init', 'rbthemeslider_duplicateslider');
            }
        }

        // Export slider
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'export') {
            if (rb_check_admin_referer('export-sliders')) {
                ${'_POST'}['sliders'] = array((int) ${'_GET'}['id']);
                ${'_POST'}['rb-export'] = true;
            }
        }

        // Empty caches
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'empty_caches') {
            if (rb_check_admin_referer('empty_caches')) {
                rb_add_action('admin_init', 'rbthemeslider_empty_caches');
            }
        }

        // Update Library
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'update_store') {
            if (rb_check_admin_referer('update_store')) {
                rb_delete_option('rb-store-last-updated');
                rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=updateStore');
            }
        }

        // Slider list bulk actions
        if (isset(${'_POST'}['rb-bulk-action'])) {
            if (rb_check_admin_referer('bulk-action')) {
                rb_add_action('admin_init', 'rb_sliders_bulk_action');
            }
        }

        // Add new slider
        if (isset(${'_POST'}['rb-add-new-slider'])) {
            if (rb_check_admin_referer('add-slider')) {
                rb_add_action('admin_init', 'rb_add_new_slider');
            }
        }

        // Google Fonts
        if (isset(${'_POST'}['rb-save-google-fonts'])) {
            if (rb_check_admin_referer('save-google-fonts')) {
                rb_add_action('admin_init', 'rb_save_google_fonts');
            }
        }

        // Advanced settings
        if (isset(${'_POST'}['rb-save-advanced-settings'])) {
            if (rb_check_admin_referer('save-advanced-settings')) {
                rb_add_action('admin_init', 'rb_save_advanced_settings');
            }
        }

        // Access permission
        if (isset(${'_POST'}['rb-access-permission'])) {
            if (rb_check_admin_referer('save-access-permissions')) {
                rb_add_action('admin_init', 'rb_save_access_permissions');
            }
        }

        // Import sliders
        if (isset(${'_POST'}['rb-import'])) {
            if (rb_check_admin_referer('import-sliders')) {
                rb_add_action('admin_init', 'rb_import_sliders');
            }
        }

        // Export sliders
        if (isset(${'_POST'}['rb-export'])) {
            if (rb_check_admin_referer('export-sliders')) {
                rb_add_action('admin_init', 'rb_export_sliders');
            }
        }

        // Revisions Options
        if (isset(${'_POST'}['rb-revisions-options'])) {
            rb_add_action('admin_init', 'rb_save_revisions_options');
        }

        // Revert slider
        if (isset(${'_POST'}['rb-revert-slider'])) {
            rb_add_action('admin_init', 'rb_revert_slider');
        }

        // Custom CSS editor
        if (isset(${'_POST'}['rb-user-css'])) {
            if (rb_check_admin_referer('save-user-css')) {
                rb_add_action('admin_init', 'rb_save_user_css');
            }
        }

        // Skin editor
        if (isset(${'_POST'}['rb-user-skins'])) {
            if (rb_check_admin_referer('save-user-skin')) {
                rb_add_action('admin_init', 'rb_save_user_skin');
            }
        }

        // Transition builder
        if (isset(${'_POST'}['rb-user-transitions'])) {
            if (rb_check_admin_referer('save-user-transitions')) {
                rb_add_action('admin_init', 'rb_save_user_transitions');
            }
        }

        // Compatibility: convert old sliders to new data storage since 3.6
        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'convert') {
            if (rb_check_admin_referer('convertoldsliders')) {
                rb_add_action('admin_init', 'rbthemeslider_convert');
            }
        }

        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'hide-important-notice') {
            if (rb_check_admin_referer('hide-important-notice')) {
                $storeData = rb_get_option('rb-store-data', false);
                if (!empty($storeData) && !empty($storeData['important_notice']['date'])) {
                    rb_update_option('rb-last-important-notice', $storeData['important_notice']['date']);
                }

                rb_redirect('admin.php?page=AdminRbthemesliderSlider');
            }
        }

        if (isset(${'_GET'}['page']) && ${'_GET'}['page'] == 'rbthemeslider' && isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'hide-support-notice') {
            if (rb_check_admin_referer('hide-support-notice')) {
                rb_update_option('rb-show-support-notice', 0);
                rb_redirect('admin.php?page=AdminRbthemesliderSlider');
            }
        }

        // AJAX functions
        rb_add_action('wp_ajax_rb_save_slider', 'rb_save_slider');
        rb_add_action('wp_ajax_rb_import_bundled', 'rb_import_bundled');
        rb_add_action('wp_ajax_rb_import_online', 'rb_import_online');
        rb_add_action('wp_ajax_rb_parse_date', 'rb_parse_date');
        rb_add_action('wp_ajax_rb_save_screen_options', 'rb_save_screen_options');
        rb_add_action('wp_ajax_rb_get_mce_sliders', 'rb_get_mce_sliders');
        rb_add_action('wp_ajax_rb_get_mce_slides', 'rb_get_mce_slides');
        rb_add_action('wp_ajax_rb_get_mce_layers', 'rb_get_mce_layers');
        rb_add_action('wp_ajax_rb_get_post_details', 'rb_get_post_details');
        rb_add_action('wp_ajax_rb_get_search_posts', 'rb_get_search_posts');
        rb_add_action('wp_ajax_rb_get_taxonomies', 'rb_get_taxonomies');
        rb_add_action('wp_ajax_rb_upload_from_url', 'rb_upload_from_url');
        rb_add_action('wp_ajax_rb_store_opened', 'rb_store_opened');
    }
}


// Template store last viewed
function rb_store_opened()
{
    rb_update_user_meta(rb_get_current_user_id(), 'rb-store-last-viewed', date('Y-m-d'));
    die();
}


function layerthemeslider_delete_caches()
{
    try {
        RbCache::getInstance()->delete('rb-slider-data-*');
    } catch (Exception $ex) {
        // TODO
    }
}


function rbthemeslider_empty_caches()
{
    layerthemeslider_delete_caches();
    rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=cacheEmpty');
}


function rb_add_new_slider()
{
    $id = RbSliders::add(${'_POST'}['title']);
    rb_redirect('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.$id.'&showsettings=1');
}


function rb_sliders_bulk_action()
{

    // Export
    if (${'_POST'}['action'] === 'export') {
        rb_export_sliders();


    // Remove
    } elseif (${'_POST'}['action'] === 'remove') {
        if (!empty(${'_POST'}['sliders']) && is_array(${'_POST'}['sliders'])) {
            foreach (${'_POST'}['sliders'] as $item) {
                RbSliders::remove((int)$item);
                rb_delete_transient('rb-slider-data-'.(int)$item);
            }
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=removeSuccess');
        } else {
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=removeSelectError&error=1');
        }


    // Delete
    } elseif (${'_POST'}['action'] === 'delete') {
        if (!empty(${'_POST'}['sliders']) && is_array(${'_POST'}['sliders'])) {
            foreach (${'_POST'}['sliders'] as $item) {
                RbSliders::delete((int)$item);
                RbRevisions::clear((int)$item);
                rb_delete_transient('rb-slider-data-'.(int)$item);
            }
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=deleteSuccess');
        } else {
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=deleteSelectError&error=1');
        }


    // Restore
    } elseif (${'_POST'}['action'] === 'restore') {
        if (!empty(${'_POST'}['sliders']) && is_array(${'_POST'}['sliders'])) {
            foreach (${'_POST'}['sliders'] as $item) {
                RbSliders::restore((int)$item);
            }
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=restoreSuccess');
        } else {
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=restoreSelectError&error=1');
        }



    // Merge
    } elseif (${'_POST'}['action'] === 'merge') {
        // Error check
        if (!isset(${'_POST'}['sliders'][1]) || !is_array(${'_POST'}['sliders'])) {
            rb_redirect('admin.php?page=AdminRbthemesliderSlider&error=1&message=mergeSelectError');
        }

        if ($sliders = RbSliders::find(${'_POST'}['sliders'])) {
            $ids = array();
            foreach ($sliders as $key => $item) {
                // Get IDs
                $ids[] = '#' . $item['id'];

                // Merge slides
                if ($key === 0) {
                    $data = $item['data'];
                } else {
                    $data['layers'] = array_merge($data['layers'], $item['data']['layers']);
                }
            }

            // Save as new
            $name = 'Merged sliders of ' . implode(', ', $ids);
            $data['properties']['title'] = $name;
            RbSliders::add($name, $data);
        }

        rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=mergeSuccess');
    }
}


function rb_save_google_fonts()
{


    // Build object to save
    $fonts = array();
    if (!empty(${'_POST'}['fontsData']) && is_array(${'_POST'}['fontsData'])) {
        foreach (${'_POST'}['fontsData'] as $key => $val) {
            if (!empty($val['urlParams'])) {
                $fonts[] = array(
                    'param' => $val['urlParams'],
                    'admin' => isset($val['onlyOnAdmin']) ? true : false
                );
            }
        }
    }

    // Google Fonts character sets
    array_shift(${'_POST'}['scripts']);
    rb_update_option('rb-google-font-scripts', ${'_POST'}['scripts']);

    // Save & redirect back
    rb_update_option('rb-google-fonts', $fonts);
    rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=googleFontsUpdated');
}


function rb_save_advanced_settings()
{

    $options = array(
        'use_cache',
        'load_unpacked',
        'load_fontawesome',
        'save_history',
        'gsap_sandboxing',
        'force_load_origami',
        'rocketscript_ignore',
    );
    foreach ($options as $item) {
        rb_update_option('rb_'.$item, (int) array_key_exists($item, ${'_POST'}));
    }

    rb_update_option('rb_scripts_priority', (int)${'_POST'}['scripts_priority']);

    rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=generalUpdated');
}


function rb_save_screen_options()
{
    ${'_POST'}['options'] = !empty(${'_POST'}['options']) ? ${'_POST'}['options'] : array();
    rb_update_option('rb-screen-options', ${'_POST'}['options']);
    die();
}


function rb_get_mce_sliders()
{

    $sliders = RbSliders::find(array('limit' => 100));
    foreach ($sliders as $key => $item) {
        $sliders[$key]['preview'] = rb_apply_filters('rb_preview_for_slider', $item);
        $sliders[$key]['name'] = ! empty($item['name']) ? htmlspecialchars($item['name']) : 'Unnamed';
    }

    die(Tools::jsonEncode($sliders));
}


function rb_get_mce_slides()
{
    $sliderID = (int) ${'_GET'}['sliderID'];

    $slider = RbSliders::find($sliderID);
    $slider = $slider['data'];
    $slides = array();

    foreach ($slider['layers'] as $key => $slide) {
        if (!empty($slide['properties']['backgroundId'])) {
            $slides[$key]['preview'] = rb_apply_filters('rb_get_image', $slide['properties']['backgroundId'], $slide['properties']['background']);
        }

        $slides[$key]['name'] = !empty($slide['properties']['title']) ? htmlspecialchars(_ss($slide['properties']['title'])) : 'Slide #' . ($key + 1);
    }

    die(json_encode($slides));
}


function rb_get_mce_layers()
{
    $sliderID = (int) ${'_GET'}['sliderID'];
    $slideIndex = (int) ${'_GET'}['slideIndex'];
    $layers = array();

    $slider = RbSliders::find($sliderID);
    $slider = $slider['data'];

    foreach ($slider['layers'][$slideIndex]['sublayers'] as $key => $layer) {
        // Ensure that magic quotes will not mess with JSON data
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $layer['styles'] = _ss($layer['styles']);
            $layer['transition'] = _ss($layer['transition']);
        }

        // Parse embedded JSON data
        $layer['styles'] = !empty($layer['styles']) ? (object) json_decode(_ss($layer['styles']), true) : new stdClass;
        $layer['transition'] = !empty($layer['transition']) ? (object) json_decode(_ss($layer['transition']), true) : new stdClass;
        $layer['html'] = !empty($layer['html']) ? _ss($layer['html']) : '';

        // Add 'top', 'left' and 'wordwrap' to the styles object
        if (isset($layer['top'])) {
            $layer['styles']->top = $layer['top'];
            unset($layer['top']);
        }
        if (isset($layer['left'])) {
            $layer['styles']->left = $layer['left'];
            unset($layer['left']);
        }
        if (isset($layer['wordwrap'])) {
            $layer['styles']->wordwrap = $layer['wordwrap'];
            unset($layer['wordwrap']);
        }

        if (!empty($layer['transition']->showuntil)) {
            $layer['transition']->startatout = 'transitioninend + ' . $layer['transition']->showuntil;
            $layer['transition']->startatouttiming = 'transitioninend';
            $layer['transition']->startatoutvalue = $layer['transition']->showuntil;
            unset($layer['transition']->showuntil);
        }

        if (!empty($layer['transition']->parallaxlevel)) {
            $layer['transition']->parallax = true;
        }

        // Custom attributes
        $layer['innerAttributes'] = !empty($layer['innerAttributes']) ? (object) $layer['innerAttributes'] : new stdClass;
        $layer['outerAttributes'] = !empty($layer['outerAttributes']) ? (object) $layer['outerAttributes'] : new stdClass;

        // v6.5.6: Convert old checkbox media settings to the new
        // select based options.
        if (isset($layer['transition']->controls)) {
            if (true === $layer['transition']->controls) {
                $layer['transition']->controls = 'auto';
            } elseif (false === $layer['transition']->controls) {
                $layer['transition']->controls = 'disabled';
            }
        }

        $layers[$key] = $layer;

        if (!empty($layer['imageId'])) {
            $layers[$key]['image'] = rb_apply_filters('rb_get_image', $layer['imageId'], $layer['image']);
        }

        if (!empty($layer['posterId'])) {
            $layers[$key]['poster'] = rb_apply_filters('rb_get_image', $layer['posterId'], $layer['poster']);
        }

        $layers[$key]['name'] = !empty($layer['subtitle']) ? Tools::substr(htmlspecialchars(_ss($layer['subtitle'])), 0, 32) : 'Layer #' . ($key + 1);
    }

    die(json_encode($layers));
}


function rb_save_slider()
{

    // Vars
    $id     = (int) ${'_POST'}['id'];
    $data     = ${'_POST'}['sliderData'];

    // Security check
    if (!rb_check_admin_referer('rb-save-slider-' . $id)) {
        return false;
    }

    // Parse slider settings
    $data['properties'] = Tools::jsonDecode(_ss(html_entity_decode($data['properties'])), true);

    // Parse slide data
    if (!empty($data['layers']) && is_array($data['layers'])) {
        foreach ($data['layers'] as $slideKey => $slideData) {
            $slideData = Tools::jsonDecode(_ss($slideData), true);

            if (! empty($slideData['sublayers'])) {
                foreach ($slideData['sublayers'] as $layerKey => $layerData) {
                    if (! empty($layerData['transition'])) {
                        $slideData['sublayers'][$layerKey]['transition'] = addslashes($layerData['transition']);
                    }

                    if (! empty($layerData['styles'])) {
                        $slideData['sublayers'][$layerKey]['styles'] = addslashes($layerData['styles']);
                    }
                }
            }

            $data['layers'][$slideKey] = $slideData;
        }
    }

    $title = rb_esc_sql($data['properties']['title']);
    $slug = !empty($data['properties']['slug']) ? rb_esc_sql($data['properties']['slug']) : '';


    // Relative URL
    if (isset($data['properties']['relativeurls'])) {
        $data = rbthemeslider_convert_urls($data);
    }

    rb_delete_transient('rb-slider-data-'.$id);

    // Update the slider
    if (empty($id)) {
        $id = RbSliders::add($title, $data, $slug);
    } else {
        RbSliders::update($id, $title, $data, $slug);
    }

    // Revisions handling
    if (RbRevisions::$active) {
        $lastRevision = RbRevisions::last($id);

        if (empty($lastRevision->date_c) || $lastRevision->date_c < time() - 60 * RbRevisions::$interval) {
            RbRevisions::add($id, json_encode($data));

            if (RbRevisions::count($id) > RbRevisions::$limit) {
                RbRevisions::shift($id);
            }
        }
    }

    die(Tools::jsonEncode(array('status' => 'ok')));
}


function rb_save_revisions_options()
{
    // Security check
    rb_check_admin_referer('rb-save-revisions-options');

    rb_update_option('rb-revisions-enabled', (int)isset(${'_POST'}['rb-revisions-enabled']));
    rb_update_option('rb-revisions-limit', ${'_POST'}['rb-revisions-limit']);
    rb_update_option('rb-revisions-interval', ${'_POST'}['rb-revisions-interval']);

    if (empty(${'_POST'}['rb-revisions-enabled'])) {
        RbRevisions::truncate();
    }

    rb_redirect('admin.php?page=rb-revisions');
}


function rb_revert_slider()
{
    $sliderId = (int)${'_POST'}['slider-id'];
    $revisionId = (int)${'_POST'}['revision-id'];

    // Security check
    rb_check_admin_referer('rb-revert-slider-'.$sliderId);

    RbRevisions::revert($sliderId, $revisionId);

    rb_redirect('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.$sliderId);
}


function rb_parse_date()
{
    die(Tools::jsonEncode(array('errorCount' => 1, 'dateStr' => '')));
}


/********************************************************/
/*               Action to duplicate slider             */
/********************************************************/
function rbthemeslider_duplicateslider()
{

    // Check and get the ID
    $id = (int) ${'_GET'}['id'];
    if (!isset(${'_GET'}['id'])) {
        return;
    }

    // Get the original slider
    $slider = RbSliders::find((int)${'_GET'}['id']);
    $data = $slider['data'];

    // Name check
    if (empty($data['properties']['title'])) {
        $data['properties']['title'] = 'Unnamed';
    }

    // Insert the duplicate
    $data['properties']['title'] .= ' copy';
    unset($data['properties']['hook']);
    unset($data['properties']['shop']);
    unset($data['properties']['lang']);
    unset($data['properties']['cats']);
    unset($data['properties']['pages']);
    unset($data['properties']['position']);
    RbSliders::add($data['properties']['title'], $data);

    // Success
    rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=duplicateSuccess');
}


/********************************************************/
/*                Action to remove slider               */
/********************************************************/
function rbthemeslider_removeslider()
{

    // Check received data
    if (empty(${'_GET'}['id'])) {
        return false;
    }

    // Remove the slider
    RbSliders::remove((int)${'_GET'}['id']);

    // Delete transient cache
    rb_delete_transient('rb-slider-data-'.(int)${'_GET'}['id']);

    // Reload page
    rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=removeSuccess');
}


/********************************************************/
/*                Action to restore slider              */
/********************************************************/
function rbthemeslider_restoreslider()
{

    // Check received data
    if (empty(${'_GET'}['id'])) {
        return false;
    }

    // Remove the slider
    RbSliders::restore((int) ${'_GET'}['id']);

    // Delete transient cache
    rb_delete_transient('rb-slider-data-'.(int)${'_GET'}['id']);

    // Reload page
    if (! empty(${'_GET'}['ref'])) {
        rb_redirect(urldecode(${'_GET'}['ref']));
    } else {
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=restoreSuccess');
    }

    exit;
}


/********************************************************/
/*            Actions to import sample slider            */
/********************************************************/
function rb_import_bundled()
{

    // Check nonce
    if (! ls_check_ajax_referer('rb-import-demos', 'security')) {
        return false;
    }

    // Get samples and importUtil
    $sliders = RbSources::getDemoSliders();
    include RB_ROOT_PATH.'/classes/class.rb.importutil.php';

    if (! empty(${'_GET'}['slider']) && is_string(${'_GET'}['slider'])) {
        if ($item = RbSources::getDemoSlider(${'_GET'}['slider'])) {
            if (file_exists($item['file'])) {
                $import = new RbImportUtil($item['file']);
                $id = $import->lastImportId;
            }
        }
    }

    die(Tools::jsonEncode(array(
        'success' => !! $id,
        'slider_id' => $id,
        'url' => ls_admin_url('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.$id)
    )));
}


function rb_import_online()
{
}


// PLUGIN USER PERMISSIONS
//-------------------------------------------------------
function rb_save_access_permissions()
{
    // Get capability
    $capability = (${'_POST'}['custom_role'] == 'custom') ? ${'_POST'}['custom_capability'] : ${'_POST'}['custom_role'];

    // Test value
    if (empty($capability) || !rb_current_user_can($capability)) {
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&error=1&message=permissionError');
    } else {
        rb_update_option('rbthemeslider_custom_capability', $capability);
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=permissionSuccess');
    }
}


// IMPORT SLIDERS
//-------------------------------------------------------
function rb_import_sliders()
{
    // Check export file if any
    if (!is_uploaded_file($_FILES['import_file']['tmp_name'])) {
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&error=1&message=importSelectError');
    }

    include RB_ROOT_PATH.'/classes/class.rb.importutil.php';
    $import = new RbImportUtil($_FILES['import_file']['tmp_name'], $_FILES['import_file']['name']);

    if (! empty($import->lastImportId) && (int)$import->sliderCount === 1) {
        // One slider, redirect to editor
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.$import->lastImportId);
    } else {
        // Multiple sliders, redirect to slider list
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&message=importSuccess&sliderCount='.$import->sliderCount);
    }
}


// EXPORT SLIDERS
//-------------------------------------------------------
function rb_export_sliders($sliderId = 0)
{
    // Get sliders
    if (! empty($sliderId)) {
        $sliders = RbSliders::find($sliderId);
    } elseif (isset(${'_POST'}['sliders'][0]) && ${'_POST'}['sliders'][0] == -1) {
        $sliders = RbSliders::find(array('limit' => 500));
    } elseif (!empty(${'_POST'}['sliders'])) {
        $sliders = RbSliders::find(${'_POST'}['sliders']);
    } else {
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&error=1&message=exportSelectError');
    }

    // Check results
    if (empty($sliders)) {
        rb_redirect('admin.php?page=AdminRbthemesliderSlider&error=1&message=exportNotFound');
    }

    if (class_exists('ZipArchive')) {
        include RB_ROOT_PATH.'/classes/class.rb.exportutil.php';
        $zip = new RbExportUtil;
    }

    // Gather slider data
    $data = array();
    foreach ($sliders as $item) {
        // init PS specific props
        unset($item['data']['properties']['hook']);
        unset($item['data']['properties']['shop']);
        unset($item['data']['properties']['lang']);
        unset($item['data']['properties']['cats']);
        unset($item['data']['properties']['pages']);
        unset($item['data']['properties']['position']);

        // Gather Google Fonts used in slider
        $item['data']['googlefonts'] = $zip->fontsForSlider($item['data']);

        // Slider settings array for fallback mode
        $data[] = $item['data'];

        // If ZipArchive is available
        if (class_exists('ZipArchive')) {
            // Add slider folder and settings.json
            $name = empty($item['name']) ? 'slider_' . $item['id'] : $item['name'];
            $name = rb_sanitize_file_name($name);
            $zip->addSettings(Tools::jsonEncode($item['data']), $name);

            // Add images?
            if (!isset(${'_POST'}['skip_images'])) {
                $images = $zip->getImagesForSlider($item['data']);
                $images = $zip->getFSPaths($images);
                $zip->addImage($images, $name);
            }
        }
    }

    if (class_exists('ZipArchive')) {
        $zip->download();
    } else {
        $name = 'RbthemeSlider Export '.date('Y-m-d').' at '.date('H.i.s').'.json';
        header('Content-type: application/force-download');
        header('Content-Disposition: attachment; filename="'.str_replace(' ', '_', $name).'"');
        die(call_user_func('base'.'64_encode', Tools::jsonEncode($data)));
    }
}


// TRANSITION BUILDER
//-------------------------------------------------------
function rb_save_user_css()
{
    // Get target file and content
    $file = _PS_MODULE_DIR_.'rbthemeslider/views/css/custom.css';

    // Attempt to save changes
    if (is_writable(dirname($file))) {
        file_put_contents($file, _ss(${'_POST'}['contents']));
        rb_redirect('admin.php?page=rb-style-editor&edited=1');

    // File isn't writable
    } else {
        rb_die(rb__("It looks like your files isn't writable, so PHP couldn't make any changes (CHMOD).", "RbthemeSlider"), rb__('Cannot write to file', 'RbthemeSlider'), array('back_link' => true));
    }
}


// SKIN EDITOR
//-------------------------------------------------------
function rb_save_user_skin()
{
    // Error checking
    if (empty(${'_POST'}['skin']) || strpos(${'_POST'}['skin'], '..') !== false) {
        rb_die(rb__("It looks like you haven't selected any skin to edit.", "RbthemeSlider"), rb__('No skin selected.', 'RbthemeSlider'), array('back_link' => true));
    }

    // Get skin file and contents
    $skin = RbSources::getSkin(${'_POST'}['skin']);
    $file = $skin['file'];

    // Attempt to write the file
    if (is_writable($file)) {
        file_put_contents($file, _ss(${'_POST'}['contents']));
        rb_redirect('admin.php?page=rb-skin-editor&skin='.$skin['handle'].'&edited=1');
    } else {
        rb_die(rb__("It looks like your files isn't writable, so PHP couldn't make any changes (CHMOD).", "RbthemeSlider"), rb__('Cannot write to file', 'RbthemeSlider'), array('back_link' => true));
    }
}


// TRANSITION BUILDER
//-------------------------------------------------------
function rb_save_user_transitions()
{
    $custom_trs = _PS_MODULE_DIR_.'rbthemeslider/views/js/custom.transitions.js';
    $data = 'var rbthemeSliderCustomTransitions = '._ss(${'_POST'}['rb-transitions']).';';
    file_put_contents($custom_trs, $data);
    die('SUCCESS');
}


// --
function rb_get_post_details()
{
    $params = ${'_POST'}['params'];

    $queryArgs = array(
        'post_status' => 'publish',
        'limit' => 100,
        'posts_per_page' => 100,
        'post_type' => $params['post_type'],
        'img_size' => null,
    );

    if (!empty($params['post_orderby'])) {
        $queryArgs['orderby'] = $params['post_orderby'];
    }

    if (!empty($params['post_order'])) {
        $queryArgs['order'] = $params['post_order'];
    }

    if (!empty($params['post_categories'][0])) {
        $queryArgs['category__in'] = $params['post_categories'];
    }

    if (!empty($params['post_tags'][0])) {
        $queryArgs['tag__in'] = $params['post_tags'];
    }

    if (!empty($params['post_tax_terms'])) {
        $queryArgs['img_size'] = $params['post_tax_terms'];
    }

    $posts = RbPosts::find($queryArgs)->getParsedObject();

    die(Tools::jsonEncode($posts));
}


function rbthemeslider_convert_urls($arr)
{
    // Global BG
    if (!empty($arr['properties']['backgroundimage']) && Tools::strpos($arr['properties']['backgroundimage'], 'http://') !== false) {
        $arr['properties']['backgroundimage'] = parse_url($arr['properties']['backgroundimage'], PHP_URL_PATH);
    }

    // YourLogo img
    if (!empty($arr['properties']['yourlogo']) && Tools::strpos($arr['properties']['yourlogo'], 'http://') !== false) {
        $arr['properties']['yourlogo'] = parse_url($arr['properties']['yourlogo'], PHP_URL_PATH);
    }

    if (!empty($arr['layers'])) {
        foreach ($arr['layers'] as $key => $slide) {
            // Layer BG
            if (Tools::strpos($slide['properties']['background'], 'http://') !== false) {
                $arr['layers'][$key]['properties']['background'] = parse_url($slide['properties']['background'], PHP_URL_PATH);
            }

            // Layer Thumb
            if (Tools::strpos($slide['properties']['thumbnail'], 'http://') !== false) {
                $arr['layers'][$key]['properties']['thumbnail'] = parse_url($slide['properties']['thumbnail'], PHP_URL_PATH);
            }

            // Image sublayers
            if (!empty($slide['sublayers'])) {
                foreach ($slide['sublayers'] as $subkey => $layer) {
                    if ($layer['media'] == 'img' && Tools::strpos($layer['image'], 'http://') !== false) {
                        $arr['layers'][$key]['sublayers'][$subkey]['image'] = parse_url($layer['image'], PHP_URL_PATH);
                    }
                }
            }
        }
    }

    return $arr;
}
