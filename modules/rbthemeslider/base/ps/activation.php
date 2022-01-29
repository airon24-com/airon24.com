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

// Activation events
rb_add_action('admin_init', 'rbthemeslider_activation_redirect');

// Activation and de-activation hooks
rb_add_action('admin_init', 'rbthemeslider_activation_routine');
rb_register_activation_hook(RB_ROOT_FILE, 'rbthemeslider_activation');
rb_register_deactivation_hook(RB_ROOT_FILE, 'rbthemeslider_deactivation_scripts');
rb_register_uninstall_hook(RB_ROOT_FILE, 'rbthemeslider_uninstall_scripts');


// Update handler
if (rb_get_option('rb-plugin-version', '1.0.0') !== RB_PLUGIN_VERSION) {
    rb_update_option('rb-plugin-version', RB_PLUGIN_VERSION);
    rbthemeslider_update_scripts();
}

function rbthemeslider_activation_redirect()
{
    if (rb_get_option('rbthemeslider_do_activation_redirect', false)) {
        rb_delete_option('rbthemeslider_do_activation_redirect');
        if (isset(${'_GET'}['activate']) && !isset(${'_GET'}['activate-multi'])) {
            rb_redirect(rb_admin_url('admin.php?page=rb-about'));
        }
    }
}

function rbthemeslider_activation()
{
    rbthemeslider_create_db_table();

    if (rb_has_action('rbthemeslider_activated')) {
        rb_do_action('rbthemeslider_activated');
    }

    rb_update_option('rbthemeslider_do_activation_redirect', 1);
}

function rbthemeslider_activation_routine()
{
    if (! version_compare(rb_get_option('rb-db-version', '1.0.0'), RB_DB_VERSION, '<')) {
        return;
    }

    // Update database
    rbthemeslider_create_db_table();
    rb_update_option('rb-db-version', RB_DB_VERSION);

    // Fresh installation
    if (! rb_get_option('rb-installed')) {
        rb_update_option('rb-installed', 1);

        // Call "installed" hook
        if (rb_has_action('rbthemeslider_installed')) {
            rb_do_action('rbthemeslider_installed');
        }
    }

    // Install date
    if (! rb_get_option('rb-date-installed', 0)) {
        rb_update_option('rb-date-installed', time());
    }
}

function rbthemeslider_update_scripts()
{
    // Make sure database is up-to-date,
    // perform any changes that might be
    // required by an update.
    rbthemeslider_activation_routine();

    // Make sure to empty all caches due
    // to any potential data handling changes
    // introduced in an update.
    if (function_exists('rbthemeslider_delete_caches')) {
        rbthemeslider_delete_caches();
    }

    // Trigger 'rbthemeslider_updated' action
    // hook, so 3rd parties can run their own
    // updates scripts (if any).
    if (rb_has_action('rbthemeslider_updated')) {
        rb_do_action('rbthemeslider_updated');
    }
}


function rbthemeslider_create_db_table()
{
    return true;
}


function rbthemeslider_deactivation_scripts()
{
    if (rb_has_action('rbthemeslider_deactivated')) {
        rb_do_action('rbthemeslider_deactivated');
    }
}

function rbthemeslider_uninstall_scripts()
{

    // Call user hooks
    rb_update_option('rb-installed', 0);
    if (rb_has_action('rbthemeslider_uninstalled')) {
        rb_do_action('rbthemeslider_uninstalled');
    }
}
