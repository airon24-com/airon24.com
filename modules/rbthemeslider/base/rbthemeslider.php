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
define('RB_DB_TABLE', 'rbthemeslider');
define('RB_DB_VERSION', '1.0.0');
define('RB_PLUGIN_VERSION', '1.0.0');

// Path info
define('RB_ROOT_FILE', __FILE__);
define('RB_ROOT_PATH', dirname(__FILE__));
define('RB_ROOT_URL', rb_plugins_url('', __FILE__));

// Other constants
define('RB_WP_ADMIN', true);
define('RB_PLUGIN_SLUG', basename(dirname(__FILE__)));
define('RB_PLUGIN_BASE', rb_plugin_basename(__FILE__));
define('RB_MARKETPLACE_ID', '1362246');
define('RB_TEXTDOMAIN', 'Rbthemeslider');
define('RB_REPO_BASE_URL', '#');

defined('NL') or define("NL", "\r\n");
defined('TAB') or define("TAB", "\t");

// Shared
include RB_ROOT_PATH.'/ps/scripts.php';
include RB_ROOT_PATH.'/ps/menus.php';
include RB_ROOT_PATH.'/ps/hooks.php';
include RB_ROOT_PATH.'/ps/shortcodes.php';
include RB_ROOT_PATH.'/ps/compatibility.php';
include RB_ROOT_PATH.'/includes/slider_utils.php';
include RB_ROOT_PATH.'/classes/class.rb.posts.php';
include RB_ROOT_PATH.'/classes/class.rb.sliders.php';
include RB_ROOT_PATH.'/classes/class.rb.sources.php';


// Back-end only
if (rb_is_admin()) {
    include RB_ROOT_PATH.'/ps/actions.php';
    include RB_ROOT_PATH.'/ps/activation.php';
    include RB_ROOT_PATH.'/ps/tinymce.php';
    include RB_ROOT_PATH.'/ps/notices.php';
    include RB_ROOT_PATH.'/classes/class.rb.revisions.php';

    RbRevisions::init();
}

RBShortcode::registerShortcode();
RBSources::addSkins(_PS_MODULE_DIR_.'rbthemeslider/views/css/rbthemeslider/skins/');
