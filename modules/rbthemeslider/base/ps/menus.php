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

// Register "New" admin menu bar menu
rb_add_action('admin_bar_menu', 'rb_admin_bar', 999);
function rb_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->add_node(array(
        'parent' => 'new-content',
        'id'    => 'ab-rb-add-new',
        'title' => 'RbthemeSlider',
        'href'  => rb_admin_url('admin.php?page=AdminRbthemesliderSlider')
    ));
}

// Register sidebar menu
rb_add_action('admin_menu', 'rbthemeslider_settings_menu');
function rbthemeslider_settings_menu()
{

    $capability = 'manage_options';
    $icon = version_compare(rb_get_bloginfo('version'), '3.8', '>=') ? 'dashicons-images-alt2' : RB_VIEWS_URL.'img/admin/icon_16x16.png';

    // Add main page
    rb_add_menu_page('RbthemeSlider', 'RbthemeSlider', $capability, 'rbthemeslider', 'rbthemeslider_router', $icon);

    // Add "All Sliders" submenu
    rb_add_submenu_page('rbthemeslider', 'RbthemeSlider', rb__('All Sliders', 'RbthemeSlider'), $capability, 'rbthemeslider', 'rbthemeslider_router');

    // Add "Revisions" submenu
    rb_add_submenu_page('rbthemeslider', 'RbthemeSlider Revisions', rb__('Revisions', 'RbthemeSlider'), $capability, 'rb-revisions', 'rbthemeslider_router');

    // Add "Skin Editor" submenu
    rb_add_submenu_page('rbthemeslider', 'RbthemeSlider Skin Editor', rb__('Skin Editor', 'RbthemeSlider'), $capability, 'rb-skin-editor', 'rbthemeslider_router');

    // Add "CSS Editor submenu"
    rb_add_submenu_page('rbthemeslider', 'RbthemeSlider CSS Editor', rb__('CSS Editor', 'RbthemeSlider'), $capability, 'rb-style-editor', 'rbthemeslider_router');

    // Add "Transition Builder" submenu
    rb_add_submenu_page('rbthemeslider', 'RbthemeSlider Transition Builder', rb__('Transition Builder', 'RbthemeSlider'), $capability, 'rb-transition-builder', 'rbthemeslider_router');
}

// Help menu
rb_add_filter('contextual_help', 'rbthemeslider_help', 10, 3);
function rbthemeslider_help($contextual_help, $screen_id, $screen)
{

    if (strpos($screen->base, 'rbthemeslider') !== false && (!empty(${'_GET'}['page']) && ${'_GET'}['page'] !== 'rb-about')) {
        $screen->add_help_tab(array(
            'id' => 'help',
            'title' => 'Getting Help',
            'content' => '<p>Please read our <a href="#" target="_blank">Online Documentation</a> carefully, it will likely answer all of your questions.</p><p>You can also check the <a href="#" target="_blank">FAQs</a> for additional information.</p>'
        ));
    }
}

function rbthemeslider_router()
{

    // Get current screen details
    $screen = rb_get_current_screen();


    if (strpos($screen->base, 'rb-skin-editor') !== false) {
        include(RB_ROOT_PATH.'/views/skin_editor.php');
    } elseif (strpos($screen->base, 'rb-transition-builder') !== false) {
        include(RB_ROOT_PATH.'/views/transition_builder.php');
    } elseif (strpos($screen->base, 'rb-revisions') !== false) {
        include(RB_ROOT_PATH.'/views/revisions.php');
    } elseif (strpos($screen->base, 'rb-style-editor') !== false) {
        include(RB_ROOT_PATH.'/views/style_editor.php');
    } elseif (isset(${'_GET'}['action']) && ${'_GET'}['action'] == 'edit') {
        include(RB_ROOT_PATH.'/views/slider_edit.php');
    } else {
        include(RB_ROOT_PATH.'/views/slider_list.php');
    }
}
