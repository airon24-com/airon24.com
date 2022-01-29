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

$rbPriority = RB_PRIORITY;

rb_add_action('rb_enqueue_scripts', 'rbthemeslider_enqueue_content_res', $rbPriority);
rb_add_action('admin_enqueue_scripts', 'rbthemeslider_enqueue_admin_res', $rbPriority);
rb_add_action('admin_enqueue_scripts', 'rb_load_google_fonts', $rbPriority);
rb_add_action('rb_enqueue_scripts', 'rb_load_google_fonts', ($rbPriority+1));


function rbthemeslider_enqueue_content_res()
{

    $condsc = rb_get_option('rb_conditional_script_loading', false) ? true : false;
    $footer = rb_get_option('rb_include_at_footer', false) ? true : false;
    $footer = $condsc ? true : $footer;


    rb_register_script('rbthemeslider-greensock', RB_VIEWS_URL.'js/rbthemeslider/greensock.js', false, '1.19.0', $footer);
    rb_register_script('rbthemeslider', RB_VIEWS_URL.'js/rbthemeslider/rbthemeslider.jquery.js', array('jquery'), RB_PLUGIN_VERSION, $footer);
    rb_register_script('rbthemeslider-transitions', RB_VIEWS_URL.'js/rbthemeslider/rbthemeslider.transitions.js', false, RB_PLUGIN_VERSION, $footer);
    rb_enqueue_style('rbthemeslider', RB_VIEWS_URL.'css/rbthemeslider/rbthemeslider.css', false, RB_PLUGIN_VERSION);

    // rbthemeslider Origami plugin
    rb_register_script('rbthemeslider-origami', RB_VIEWS_URL.'js/rbthemeslider/plugins/origami/rbthemeslider.origami.js', array('jquery'), RB_PLUGIN_VERSION, $footer);
    rb_register_style('rbthemeslider-origami', RB_VIEWS_URL.'css/rbthemeslider/plugins/origami/rbthemeslider.origami.css', false, RB_PLUGIN_VERSION);

    // 3rd-party: Font Awesome
    rb_register_style('ce-font-awesome', RB_VIEWS_URL.'lib/font-awesome/css/font-awesome.min.css', false, '4.7.0');

    // Build RB_Meta object
    $RB_Meta = array('v' => RB_PLUGIN_VERSION);

    if (!rb_is_admin() && rb_get_option('rb_gsap_sandboxing', false)) {
        $RB_Meta['fixGSAP'] = true;
    }

    // Print RB_Meta object
    rb_localize_script('rbthemeslider-greensock', 'RB_Meta', $RB_Meta);

    // User resources
    $uploads = rb_upload_dir();
    if (file_exists(_PS_MODULE_DIR_.'rbthemeslider/views/js/custom.transitions.js')) {
        rb_register_script('rb-user-transitions', RB_VIEWS_URL.'js/custom.transitions.js', false, RB_PLUGIN_VERSION, $footer);
    } elseif (file_exists($uploads['basedir'].'rbthemeslider.custom.transitions.js')) {
        // depricated
        rb_register_script('rb-user-transitions', $uploads['baseurl'].'rbthemeslider.custom.transitions.js', false, RB_PLUGIN_VERSION, $footer);
    }

    if (file_exists(_PS_MODULE_DIR_.'rbthemeslider/views/css/custom.css')) {
        rb_enqueue_style('rb-user', RB_VIEWS_URL.'css/custom.css', false, RB_PLUGIN_VERSION);
    } elseif (file_exists($uploads['basedir'].'rbthemeslider.custom.css')) {
        // depricated
        rb_enqueue_style('rb-user', $uploads['baseurl'].'rbthemeslider.custom.css', false, RB_PLUGIN_VERSION);
    }

    if (! $footer) {
        rb_enqueue_script('rbthemeslider-greensock');
        rb_enqueue_script('rbthemeslider');
        rb_enqueue_script('rbthemeslider-transitions');
        rb_enqueue_script('rb-user-transitions');
    }

    if (rb_get_option('rb_force_load_origami', false)) {
        rb_enqueue_script('rbthemeslider-origami');
        rb_enqueue_style('rbthemeslider-origami');
    }

    if (rb_get_option('rb_load_fontawesome', true)) {
        rb_enqueue_style('ce-font-awesome');
    }
}


function rbthemeslider_enqueue_admin_res()
{
    $l10n_rb_mce = null;
    $l10n_rb = null;

    // Load global rbthemeslider CSS
    rb_enqueue_style('rbthemeslider-global', RB_VIEWS_URL.'css/admin/global.css', false, RB_PLUGIN_VERSION);

    // Load global rbthemeslider JS
    include RB_ROOT_PATH.'/ps/tinymce_l10n.php';
    rb_localize_script('rbthemeslider-global', 'RB_MCE_l10n', $l10n_rb_mce);

    // Embed CSS. Hides the admin menu bar and the sidebar.
    if (! empty(${'_GET'}['rb-embed'])) {
        rb_enqueue_style('rbthemeslider-embed', RB_VIEWS_URL.'css/admin/embed.css', false, RB_PLUGIN_VERSION);
    }

    $screen = rb_get_current_screen();
    if (strpos($screen->base, 'rbthemeslider') !== false) {
        rb_enqueue_script('thickbox');
        rb_enqueue_style('thickbox');
        rb_enqueue_script('wp-pointer');
        rb_enqueue_style('wp-pointer');

        rb_localize_script('ps-modules', 'PS_Modules', rb_get_modules());

        // Dashicons
        if (version_compare(rb_get_bloginfo('version'), '3.8', '<')) {
            rb_enqueue_style('dashicons', RB_VIEWS_URL.'css/dashicons/dashicons.css', false, RB_PLUGIN_VERSION);
        }

        // Global scripts & stylesheets
        rb_enqueue_script('rbthemeslider-greensock', RB_VIEWS_URL.'js/rbthemeslider/greensock.js', false, '1.19.0');
        rb_enqueue_script('kreaturamedia-ui', RB_VIEWS_URL.'js/admin/km-ui.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('rb-admin-global', RB_VIEWS_URL.'js/admin/rb-admin-common.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_style('rbthemeslider-admin', RB_VIEWS_URL.'css/admin/admin.css', false, RB_PLUGIN_VERSION);
        rb_enqueue_style('rbthemeslider-admin-new', RB_VIEWS_URL.'css/admin/admin_new.css', false, RB_PLUGIN_VERSION);
        rb_enqueue_style('kreaturamedia-ui', RB_VIEWS_URL.'css/admin/km-ui.css', false, RB_PLUGIN_VERSION);

        // 3rd-party: Font Awesome
        rb_enqueue_style('ce-font-awesome', RB_VIEWS_URL.'lib/font-awesome/css/font-awesome.min.css', false, '4.7.0');

        // 3rd-party: CodeMirror
        rb_enqueue_style('codemirror', RB_VIEWS_URL.'css/codemirror/lib/codemirror.css', false, RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror', RB_VIEWS_URL.'js/codemirror/lib/codemirror.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_style('codemirror-solarized', RB_VIEWS_URL.'css/codemirror/theme/solarized.mod.css', false, RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-syntax-css', RB_VIEWS_URL.'js/codemirror/mode/css/css.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-syntax-javascript', RB_VIEWS_URL.'js/codemirror/mode/javascript/javascript.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-foldcode', RB_VIEWS_URL.'js/codemirror/addon/fold/foldcode.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-foldgutter', RB_VIEWS_URL.'js/codemirror/addon/fold/foldgutter.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-brace-fold', RB_VIEWS_URL.'js/codemirror/addon/fold/brace-fold.js', array('jquery'), RB_PLUGIN_VERSION);
        rb_enqueue_script('codemirror-active-line', RB_VIEWS_URL.'js/codemirror/addon/selection/active-line.js', array('jquery'), RB_PLUGIN_VERSION);

        // Localize admin scripts
        include RB_ROOT_PATH.'/ps/scripts_l10n.php';
        rb_localize_script('rb-admin-global', 'RB_l10n', $l10n_rb);

        // Sliders list page
        if (!empty(${'_GET'}['page']) && ${'_GET'}['page'] != 'rb-transition-builder' && ${'_GET'}['page'] != 'rb-revisions' && empty(${'_GET'}['action'])) {
            rb_enqueue_script('rb-admin-sliders', RB_VIEWS_URL.'js/admin/rb-admin-sliders.js', array('jquery'), RB_PLUGIN_VERSION);
        } else {
            // Load some bundled WP resources
            rb_enqueue_script('jquery-ui-sortable');
            rb_enqueue_script('jquery-ui-selectable');
            rb_enqueue_script('jquery-ui-draggable');
            rb_enqueue_script('jquery-ui-resizable');
            rb_enqueue_script('jquery-ui-slider');

            rb_register_script('rbthemeslider-admin', RB_VIEWS_URL.'js/admin/rb-admin-slider-builder.js', array('jquery', 'json2'), RB_PLUGIN_VERSION);

            // Slider Builder JS. Don't load automatically other than the Slider Builder
            if (!empty(${'_GET'}['page']) && ${'_GET'}['page'] != 'rb-transition-builder' && ${'_GET'}['page'] != 'rb-revisions') {
                rb_enqueue_script('rbthemeslider-admin');
            }

            // rbthemeslider includes for preview
            rb_enqueue_script('rbthemeslider', RB_VIEWS_URL.'js/rbthemeslider/rbthemeslider.jquery.js', array('jquery'), RB_PLUGIN_VERSION);
            rb_enqueue_script('rbthemeslider-transitions', RB_VIEWS_URL.'js/rbthemeslider/rbthemeslider.transitions.js', false, RB_PLUGIN_VERSION);
            rb_enqueue_script('rbthemeslider-tr-gallery', RB_VIEWS_URL.'js/admin/rbthemeslider.transition.gallery.js', array('jquery'), RB_PLUGIN_VERSION);
            rb_enqueue_style('rbthemeslider', RB_VIEWS_URL.'css/rbthemeslider/rbthemeslider.css', false, RB_PLUGIN_VERSION);
            rb_enqueue_style('rbthemeslider-tr-gallery', RB_VIEWS_URL.'css/admin/rbthemeslider.transitiongallery.css', false, RB_PLUGIN_VERSION);

            // rbthemeslider Timeline plugin
            rb_enqueue_script('rbthemeslider-timeline', RB_VIEWS_URL.'js/rbthemeslider/plugins/timeline/rbthemeslider.timeline.js', array('jquery'), RB_PLUGIN_VERSION);
            rb_enqueue_style('rbthemeslider-timeline', RB_VIEWS_URL.'css/rbthemeslider/plugins/timeline/rbthemeslider.timeline.css', false, RB_PLUGIN_VERSION);

            // rbthemeslider Origami plugin
            rb_enqueue_script('rbthemeslider-origami', RB_VIEWS_URL.'js/rbthemeslider/plugins/origami/rbthemeslider.origami.js', array('jquery'), RB_PLUGIN_VERSION);
            rb_enqueue_style('rbthemeslider-origami', RB_VIEWS_URL.'css/rbthemeslider/plugins/origami/rbthemeslider.origami.css', false, RB_PLUGIN_VERSION);

            // 3rd-party: MiniColor
            rb_enqueue_script('minicolor', RB_VIEWS_URL.'js/minicolors/jquery.minicolors.js', array('jquery'), RB_PLUGIN_VERSION);
            rb_enqueue_style('minicolor', RB_VIEWS_URL.'css/minicolors/jquery.minicolors.css', false, RB_PLUGIN_VERSION);

            // 3rd-party: CC Image Editor
            rb_enqueue_script('cc-image-sdk', 'https://dme0ih8comzn4.cloudfront.net/imaging/v3/editor.js', false, RB_PLUGIN_VERSION);

            // 3rd-party: Air Datepicker
            rb_enqueue_style('air-datepicker', RB_VIEWS_URL.'css/air-datepicker/air-datepicker.min.css', false, '2.1.0');
            rb_enqueue_script('air-datepicker', RB_VIEWS_URL.'js/air-datepicker/air-datepicker.min.js', array('jquery'), '2.1.0en');

            // 3rd party: html2canvas
            rb_enqueue_script('html2canvas', RB_VIEWS_URL.'js/html2canvas/html2canvas.min.js', array('jquery'), '1.0.0a9');

            // User transitions
            $uploads = rb_upload_dir();
            if (file_exists(_PS_MODULE_DIR_.'rbthemeslider/views/js/custom.transitions.js')) {
                rb_enqueue_script('rb-user-transitions', RB_VIEWS_URL.'js/custom.transitions.js', false, RB_PLUGIN_VERSION);
            } elseif (file_exists($uploads['basedir'].'rbthemeslider.custom.transitions.js')) {
                // depricated
                rb_enqueue_script('rb-user-transitions', $uploads['baseurl'].'rbthemeslider.custom.transitions.js', false, RB_PLUGIN_VERSION);
            }

            // User CSS
            if (file_exists(_PS_MODULE_DIR_.'rbthemeslider/views/css/custom.css')) {
                rb_enqueue_style('rb-user', RB_VIEWS_URL.'css/custom.css', false, RB_PLUGIN_VERSION);
            } elseif (file_exists($uploads['basedir'].'rbthemeslider.custom.css')) {
                // depricated
                rb_enqueue_style('rb-user', $uploads['baseurl'].'rbthemeslider.custom.css', false, RB_PLUGIN_VERSION);
            }
        }
    }

    // Transition builder
    if (strpos($screen->base, 'rb-transition-builder') !== false) {
        rb_enqueue_script('rbthemeslider_tr_builder', RB_VIEWS_URL.'js/admin/rb-admin-transition-builder.js', array('jquery'), RB_PLUGIN_VERSION);
    }

    // Revisions
    if (strpos($screen->base, 'rb-revisions') !== false) {
        rb_enqueue_style('rb-revisions', RB_VIEWS_URL.'css/admin/revisions.css', false, RB_PLUGIN_VERSION);
        rb_enqueue_script('rb-revisions', RB_VIEWS_URL.'js/admin/rb-admin-revisions.js', array('jquery'), RB_PLUGIN_VERSION);
    }

    // Skin editor
    if (strpos($screen->base, 'rb-skin-editor') !== false || strpos($screen->base, 'rb-style-editor') !== false) {
        rb_enqueue_style('rb-skin-editor', RB_VIEWS_URL.'css/admin/skin.editor.css', false, RB_PLUGIN_VERSION);
    }

    // About page
    if (strpos($screen->base, 'rb-about') !== false) {
        rb_enqueue_style('rb-about-page', RB_VIEWS_URL.'css/admin/about.css', false, RB_PLUGIN_VERSION);
    }
}



function rb_load_google_fonts()
{

    // Get font list
    $fonts = rb_get_option('rb-google-fonts', array());
    $scripts = rb_get_option('rb-google-font-scripts', array('latin', 'latin-ext'));

    // Check fonts if any
    if (!empty($fonts) && is_array($fonts)) {
        $rbFonts = array();
        foreach ($fonts as $item) {
            if (rb_is_admin() || !$item['admin']) {
                $rbFonts[] = htmlspecialchars($item['param']);
            }
        }

        if (!empty($rbFonts)) {
            $rbFonts = implode('%7C', $rbFonts);
            $protocol = rb_is_ssl() ? 'https' : 'http';
            $query_args = array(
                'family' => $rbFonts,
                'subset' => implode('%2C', $scripts),
            );

            rb_enqueue_style(
                'rb-google-fonts',
                rb_add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"),
                array(),
                null
            );
        }
    }
}

function rb_meta_generator()
{
    $str = '<meta name="generator" content="Powered by Rubikthem'.RB_PLUGIN_VERSION.' - Multi-Purpose, Responsive, Parallax, Mobile-Friendly Slider Module for PrestaShop." />' . NL;

    return rb_apply_filters('rb_meta_generator', $str);
}
