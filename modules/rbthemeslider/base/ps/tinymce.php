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

function rb_mce_hooks()
{
    if (rb_current_user_can('edit_posts') || rb_current_user_can('edit_pages')) {
        if (rb_get_user_option('rich_editing')) {
            rb_add_filter('mce_buttons', 'rb_register_mce_buttons');
            rb_add_filter('mce_external_plugins', 'rb_register_mce_js');
        }
    }
}

function rb_register_mce_buttons($buttons)
{
    array_push($buttons, 'rbthemeslider_button');
    return $buttons;
}

function rb_register_mce_js($plugins)
{
    $plugins['rbthemeslider_button'] = RB_VIEWS_URL.'js/admin/rb-admin-tinymce.js';
    return $plugins;
}

rb_add_action('init', 'rb_mce_hooks');
