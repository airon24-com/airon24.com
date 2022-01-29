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

rb_enqueue_style('wp-pointer', RB_VIEWS_URL.'css/wp-pointer.min.css', false, ${'this'}->module->version);
rb_enqueue_style('wp-specs', RB_VIEWS_URL.'css/wp-specs.css', false, ${'this'}->module->version);

rb_enqueue_script('jquery-ui', RB_VIEWS_URL.'js/jquery-ui.min.js', false, ${'this'}->module->version);
rb_enqueue_script('wp-pointer', RB_VIEWS_URL.'js/wp-pointer.min.js', false, ${'this'}->module->version);
rb_enqueue_script('wp-specs', RB_VIEWS_URL.'js/wp-specs.js', false, ${'this'}->module->version);

function rb_before_die()
{
    $headers = headers_list();
    foreach ($headers as $header) {
        if (strpos($header, 'Location: admin.php') === 0) {
            $location = str_replace(array(
                'admin.php?page=AdminRbthemesliderSlider',
                'admin.php?page=rb-style-editor',
                'admin.php?page=rb-skin-editor',
                'admin.php?page=rb-revisions',
            ), array(
                'index.php?controller=AdminRbthemesliderSlider&token='.$GLOBALS['rb_token'],
                'index.php?controller=AdminRbthemesliderStyle&token='.$GLOBALS['rb_token'],
                'index.php?controller=AdminRbthemesliderSkin&token='.$GLOBALS['rb_token'],
                'index.php?controller=AdminRbthemesliderRevisions&token='.$GLOBALS['rb_token'],
            ), $header);
            Tools::redirectAdmin(Tools::substr($location, 10));
        }
    }
}
register_shutdown_function('rb_before_die');

rb_magic_quotes(); // magic quotes fix

function rb_init_screen_meta()
{
    ?>
    <div id="screen-meta" class="metabox-prefs">
        <div id="contextual-help-wrap" class="hidden no-sidebar" tabindex="-1" aria-label="Contextual Help Tab">
            <div id="contextual-help-back"></div>
            <div id="contextual-help-columns">
                <div class="contextual-help-tabs"><ul></ul></div>
                <div class="contextual-help-tabs-wrap"></div>
            </div>
        </div>
    </div>
    <div id="screen-meta-links"></div>
    <?php
}
rb_add_action(rb_get_current_screen()->id, 'rb_init_screen_meta');

function init_admin_scripts()
{
    $context = Context::getContext();
    $mediamanagerurl = preg_replace('~^https?:~', '', $context->link->getAdminLink('AdminRbthemesliderMedia'));
    $adminmodulesurl = preg_replace('~^https?:~', '', $context->link->getAdminLink('AdminModules').'&configure=rbthemeslider&module_name=rbthemeslider');
    $ajaxurl = 'index.php?controller=AdminRbthemesliderSlider&ajax=1&token='.$GLOBALS['rb_token'];
    $rbVersion = RB_PLUGIN_VERSION;
    $rbSaveHistory = rb_get_option('rb_save_history', false) ? 1 : 0;
    $userSettings = Tools::jsonEncode(array(
        'time' => time(),
        'uid' => $context->employee->id,
        'url' => __PS_BASE_URI__
    ));
    $_wpPluploadSettings = Tools::jsonEncode(array(
        'defaults' => array(
            'multipart_params' => array(
                '_wpnonce' => $GLOBALS['rb_token']
            )
        )
    ));
    echo "<script>
        mediamanagerurl = '$mediamanagerurl';
        admin_modules_link = '$adminmodulesurl';
        ajaxurl = '$ajaxurl';
        rbVersion = '$rbVersion';
        rbSaveHistory = $rbSaveHistory;
        userSettings = $userSettings;
        _wpPluploadSettings = $_wpPluploadSettings;
    </script>";
}
rb_add_action('admin_enqueue_scripts', 'init_admin_scripts');

ob_start();
require_once(_PS_MODULE_DIR_.'rbthemeslider/base/rbthemeslider.php');

rb_do_action('init');

if (isset(${'_GET'}['ajax']) && isset($_REQUEST['action'])) {
    // handle AJAX requests
    if ($_REQUEST['action'] == 'upload-attachment') {
        // handle AJAX image upload
        if (isset($_FILES['async-upload'])) {
            $name = $_FILES['async-upload']['name'];
            $destination = _PS_IMG_DIR_.$name;
            $reldestination = _PS_IMG_.$name;
            if (move_uploaded_file($_FILES['async-upload']['tmp_name'], $destination)) {
                $res = array(
                    'data' => array('id' => '', 'sizes' => array(), 'url' => $reldestination),
                    'success' => true
                );
                die(Tools::jsonEncode($res));
            }
        }
        die(Tools::jsonEncode(array('success' => false)));
    }
    rb_do_action('wp_ajax_'.$_REQUEST['action']);
    die(ob_get_clean());
}
rb_do_action('admin_menu');
rb_do_action('admin_init');
rb_do_action('admin_enqueue_scripts');
rb_do_action('rb_enqueue_scripts');
rb_do_action('admin_notices');
rb_do_action(rb_get_current_screen()->id);

function rb_replace_url($match)
{
    $url = str_replace(array(
        'page=AdminRbthemesliderSlider',
        'page=rb-skin-editor',
        'page=rb-style-editor',
        'page=rb-transition-builder',
        'page=rb-revisions',
    ), array(
        'controller=AdminRbthemesliderSlider&amp;token='.$GLOBALS['rb_token'],
        'controller=AdminRbthemesliderSkin&amp;token='.$GLOBALS['rb_token'],
        'controller=AdminRbthemesliderStyle&amp;token='.$GLOBALS['rb_token'],
        'controller=AdminRbthemesliderTransition&amp;token='.$GLOBALS['rb_token'],
        'controller=AdminRbthemesliderRevisions&amp;token='.$GLOBALS['rb_token'],
    ), $match[1]);
    return 'href="'. $url .'"';
}

$script = empty($GLOBALS['rb_local']) ? '' : "\n<script>\n".implode("\n", $GLOBALS['rb_local'])."\n</script>";
${'this'}->content = $script.preg_replace_callback('/href="(?:admin\.php)?(\?page=.*?)"/', 'rb_replace_url', ob_get_clean());
