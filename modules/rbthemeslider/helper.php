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

define('RB_CONTENT_DIR', _PS_ROOT_DIR_);
define('RB_VIEWS_URL', _MODULE_DIR_.'rbthemeslider/views/');
define('RB_PRIORITY', (int) rb_get_option('rb_scripts_priority', 50));
define('RB_UNPACKED', (int) rb_get_option('rb_load_unpacked', 0));
define('RB_JS_THEME_CACHE', (int) Configuration::get('PS_JS_THEME_CACHE', 0));
define('RB_CSS_THEME_CACHE', (int) Configuration::get('PS_CSS_THEME_CACHE', 0));

function rb_create_nonce($action = -1)
{
    return '1';
}

function rb_nonce_field($action = -1, $name = "_wpnonce", $referer = true, $echo = true)
{
    return '';
}

function rb_check_admin_referer($action = -1, $query_arg = '_wpnonce')
{
    return true;
}

function rb_check_ajax_referer($action = -1, $query_arg = false, $die = true)
{
    return 1;
}

function rb_nonce_url($actionurl, $action = -1, $name = '_wpnonce')
{
    return str_replace('?page=AdminRbthemesliderSlider', '?controller=AdminRbthemesliderSlider', $actionurl).(!empty($GLOBALS['rb_token']) ? '&token='.$GLOBALS['rb_token'] : '');
}

function rb_current_user_can($capability)
{
    return !empty(Context::getContext()->employee->id);
}

function rb_plugin_basename($file)
{
    return basename(dirname($file)).'/'.basename($file);
}

function rb_plugins_url($path = '', $plugin = '')
{
    return rtrim(_MODULE_DIR_.'rbthemeslider/base/'.$path, '/');
}

function rb_content_url($path = '')
{
    return rtrim(_MODULE_DIR_.'rbthemeslider/base/'.$path, '/');
}

function rb_get_attachment_thumb_url($attachment_id)
{
    return false;
}

function rb_get_permalink($post = 0, $leavename = false)
{
    return '';
}

function rb_get_posts($params = null)
{
    $context = Context::getContext();
    $id_lang = $context->language->id;
    if (!empty($params['post_type'])) {
        foreach ($params['post_type'] as &$id_manufacturer) {
            $id_manufacturer = (int)$id_manufacturer;
        }
    }
    $manufacturers = !empty($params['post_type']) ? implode(', ', $params['post_type']) : '';
    $categories = !empty($params['category__in']) ? implode(', ', $params['category__in']) : '';
    $tags = !empty($params['tag__in']) ? implode(', ', $params['tag__in']) : '';
    $order_by = !empty($params['orderby']) ? $params['orderby'] : 'date_add';
    // compatibility fix
    if ($order_by == 'date') {
        $order_by = 'date_add';
    }
    $order_way = !empty($params['order']) ? $params['order'] : 'DESC';
    $limit = !empty($params['limit']) ? (int)$params['limit'] : 100;
    $offset = !empty($params['offset']) ? (int)$params['offset'] : 0;

    if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)) {
        die(Tools::displayError());
    }
    if ($order_by == 'date_add' || $order_by == 'date_upd' || $order_by == 'price') {
        $order_by_prefix = 'p';
    } elseif ($order_by == 'name') {
        $order_by_prefix = 'pl';
    } elseif ($order_by == 'position') {
        $order_by_prefix = 'c';
        $order_way = $order_way == 'ASC' ? 'DESC' : 'ASC';
    } elseif ($order_by == 'quantity') {
        $order_by_prefix = 'ps';
    } elseif ($order_by == 'reduction') {
        $order_by_prefix = 'sp';
    } elseif ($order_by == 'rand') {
        $order_by = 'RAND()';
    }

    if (strpos($order_by, '.') > 0) {
        $order_by = explode('.', $order_by);
        $order_by_prefix = $order_by[0];
        $order_by = $order_by[1];
    }

    // , s.`name` AS supplier
    // LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)
    $sql = 'SELECT DISTINCT p.id_product, p.date_add, p.date_upd, p.id_category_default, pl.name, pl.link_rewrite, pl.description, pl.description_short, m.name AS manufacturer
        FROM `'._DB_PREFIX_.'product` p'.Shop::addSqlAssociation('product', 'p').'
        LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang('pl').')
        LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
        LEFT JOIN `'._DB_PREFIX_.'category_product` c ON (c.`id_product` = p.`id_product`)
        LEFT JOIN `'._DB_PREFIX_.'product_tag` pt ON (pt.`id_product` = p.`id_product`)'.
        ($order_by == 'quantity' ? ' LEFT JOIN `'._DB_PREFIX_.'product_sale` ps ON ps.id_product = p.id_product' : '').
        ($order_by == 'reduction' ? ' INNER JOIN `'._DB_PREFIX_.'specific_price` sp ON sp.id_product = p.id_product' : '').'
        WHERE pl.`id_lang` = '.(int)$id_lang.
            ' AND product_shop.`active` = 1'.
            ' AND product_shop.`visibility` IN ("both", "catalog")'.
            ($manufacturers ? ' AND m.`id_manufacturer` IN ('.$manufacturers.')' : '').
            ($categories ? ' AND c.`id_category` IN ('.$categories.')' : '').
            ($tags ? ' AND pt.`id_tag` IN ('.$tags.')' : '').
            ($order_by == 'reduction' ? ' AND sp.from <= NOW() AND (sp.to >= NOW() OR sp.to = "0000-00-00 00:00:00")' : '').'
        ORDER BY '.(isset($order_by_prefix) ? pSQL($order_by_prefix).'.' : '').pSQL($order_by).' '.pSQL($order_way).
            ($limit > 0 ? " LIMIT $offset, $limit" : '');
    $res = Db::getInstance()->executeS($sql);
    return $res;
}

function rb_get_post_type_object($post_type)
{
    return (object) array(
        'labels' => (object) array('name' => $post_type['name'])
    );
}

class ManufacturerArray extends ArrayObject
{
    public function __toString()
    {
        return isset($this['slug']) ? (string)$this['slug'] : '';
    }
}

function rb_get_post_types()
{
    $mans = Manufacturer::getManufacturers();
    foreach ($mans as &$man) {
        $man = new ManufacturerArray($man);
        $man['slug'] = $man['id_manufacturer'];
    }
    array_unshift($mans, new ManufacturerArray(array(
        'name' => rb__("Don't filter manufacturers", 'rbthemeslider'),
        'slug' => 0,
    )));
    return $mans;
}
function rb_get_categories()
{
    require_once _PS_MODULE_DIR_.'rbthemeslider/classes/PSOpts.php';
    return PSOpts::getCategoryList();
}
function rb_get_tags()
{
    require_once _PS_MODULE_DIR_.'rbthemeslider/classes/PSOpts.php';
    $tags = PSOpts::getTagList();
    foreach ($tags as &$tag) {
        $tag = (object) $tag;
    }
    return $tags;
}
function rb_get_taxonomies()
{
    return array();
}
function rb_get_post_thumbnail_id($post_id)
{
    return $post_id;
}

function rb_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '')
{
    $attrs = array(
        'src' => $attachment_id,
        'alt' => 'Slide background'
    );
    if (is_array($attr)) {
        $attrs = array_merge($attrs, $attr);
    }
    $img = '<img';
    foreach ($attrs as $key => &$value) {
        $img .= ' '.$key.'="'.$value.'"';
    }
    $img .= '>';
    return $img;
}
function rb_get_attachment_image_url($attachment_id, $size = 'thumbnail', $icon = false)
{
    return false;
}
function rb_get_attachment_image_src($attachment_id, $size = 'thumbnail', $icon = false)
{
    return false;
}

$GLOBALS['rb_action'] = array();

function rb_add_action($tag, $func)
{
    if (!isset($GLOBALS['rb_action'][$tag])) {
        $GLOBALS['rb_action'][$tag] = array();
    }
    $GLOBALS['rb_action'][$tag][] = $func;
}

function rb_do_action($tag, $arg = array())
{
    if (isset($GLOBALS['rb_action'][$tag])) {
        foreach ($GLOBALS['rb_action'][$tag] as $func) {
            call_user_func_array($func, $arg);
        }
    }
}

function rb_has_action($tag, $func_to_check = '')
{
    return isset($GLOBALS['rb_action'][$tag]);
}

$GLOBALS['rb_filter'] = array();

function rb_add_filter($tag, $func)
{
    if (!isset($GLOBALS['rb_filter'][$tag])) {
        $GLOBALS['rb_filter'][$tag] = array();
    }
    $GLOBALS['rb_filter'][$tag][] = $func;
}

function rb_apply_filters($tag, $value, $var = null)
{
    if (isset($GLOBALS['rb_filter'][$tag])) {
        foreach ($GLOBALS['rb_filter'][$tag] as $func) {
            if ($var === null) {
                $value = is_string($func) ? call_user_func($func, $value) : $func[0]->{$func[1]}($value);
            } else {
                $value = is_string($func) ? call_user_func($func, $value, $var) : $func[0]->{$func[1]}($value, $var);
            }
        }
    }
    return $value;
}

function rb_has_filter($tag, $func_to_check = '')
{
    return isset($GLOBALS['rb_filter'][$tag]);
}

$GLOBALS['rb_shortcode'] = array();

function rb_add_shortcode($tag, $func)
{
    $GLOBALS['rb_shortcode'][$tag] = $func;
}

function rb_shortcode_parse_atts($text)
{
    $atts = array();
    $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
    $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
    if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
        foreach ($match as $m) {
            if (!empty($m[1])) {
                $atts[Tools::strtolower($m[1])] = stripcslashes($m[2]);
            } elseif (!empty($m[3])) {
                $atts[Tools::strtolower($m[3])] = stripcslashes($m[4]);
            } elseif (!empty($m[5])) {
                $atts[Tools::strtolower($m[5])] = stripcslashes($m[6]);
            } elseif (isset($m[7]) and Tools::strlen($m[7])) {
                $atts[] = stripcslashes($m[7]);
            } elseif (isset($m[8])) {
                $atts[] = stripcslashes($m[8]);
            }
        }
    } else {
        $atts = ltrim($text);
    }
    return $atts;
}

function rb_do_shortcode_tag($m)
{
    // allow [[foo]] syntax for escaping a tag
    if ($m[1] == '[' && $m[6] == ']') {
        return Tools::substr($m[0], 1, -1);
    }

    $tag = $m[2];
    $attr = rb_shortcode_parse_atts($m[3]);

    if (isset($m[5])) {
        // enclosing tag - extra parameter
        return $m[1] . call_user_func($GLOBALS['rb_shortcode'][$tag], $attr, $m[5], $tag) . $m[6];
    } else {
        // self-closing tag
        return $m[1] . call_user_func($GLOBALS['rb_shortcode'][$tag], $attr, null, $tag) . $m[6];
    }
}

function rb_do_shortcode($content)
{
    if (false === strpos($content, '[')) {
        return $content;
    }

    if (empty($GLOBALS['rb_shortcode'])) {
        return $content;
    }

    $pattern = '\[(\[?)(' . addcslashes(implode('|', array_keys($GLOBALS['rb_shortcode'])), '-') .
        ')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
    return preg_replace_callback("/$pattern/s", 'rb_do_shortcode_tag', $content);
}

function rb_shortcode_exists($tag)
{
    return isset($GLOBALS['rb_shortcode'][$tag]);
}

function rb_insert_attachment($attachment, $filename, $parent_post_id)
{
    return 0;
}

require_once _PS_MODULE_DIR_.'rbthemeslider/classes/RbDb.php';
$GLOBALS['rb_db'] = new RbDb();

function Rb_esc_sql($data)
{
    $wpdb = $GLOBALS['rb_db'];
    return $wpdb->escape($data);
}

function rb_dbDelta($sql)
{
    $db = Db::getInstance();
    $sql = preg_replace('~CREATE\s+TABLE(?!\s+IF\s+NOT\s+EXISTS)~i', 'CREATE TABLE IF NOT EXISTS', $sql);
    $res = $db->execute($sql);

    if (preg_match('~\b'._DB_PREFIX_.'rbthemeslider\s*\(~', $sql)) {
        // search for missing columns
        $fields = array();
        $columns = $db->executeS('SHOW COLUMNS FROM `'._DB_PREFIX_.'rbthemeslider`');
        foreach ($columns as &$col) {
            $fields[$col['Field']] = true;
        }
        // alter table if necessary
        if (!isset($fields['schedule_start'])) {
            $db->execute('ALTER TABLE `'._DB_PREFIX_.'rbthemeslider` ADD `schedule_start` INT(11) NOT NULL DEFAULT 0, ADD `schedule_end` INT(11) NOT NULL DEFAULT 0');
        }
    }

    return $res;
}

function rb_get_userdata($userid)
{
    $user = Context::getContext()->employee;
    $user->user_nicename = $user->firstname.' '.$user->lastname;
    return $user;
}

function rb_get_avatar_url($id_or_email, $args = null)
{
    $emp = Context::getContext()->employee;
    return method_exists($emp, 'getImage') ? $emp->getImage() : 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
}

function rb_get_user_option($option, $user = 0)
{
    // TODO
    return true;
}

function rb_get_bloginfo($show = '', $filter = 'raw')
{
    // TODO
    return '';
}

function rb_add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null)
{
    $screen_id = 'toplevel_page_' . $menu_slug;
    rb_add_action($screen_id, $function);
    return $screen_id;
}

function rb_add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function)
{
    $screen_id = $parent_slug . '_page_' . $menu_slug;
    rb_add_action($screen_id, $function);
    return $screen_id;
}

function rb_menu_page_url($menu_slug, $echo)
{
    return '?controller=AdminRbthemesliderSlider'.(!empty($GLOBALS['rb_token']) ? '&token='.$GLOBALS['rb_token'] : '');
}

function rb_is_ssl()
{
    return strpos(_PS_BASE_URL_SSL_, 'https') === 0;
}

defined('MINUTE_IN_SECONDS') or define('MINUTE_IN_SECONDS', 60);
defined('HOUR_IN_SECONDS') or define('HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS);
defined('DAY_IN_SECONDS') or define('DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS);
defined('WEEK_IN_SECONDS') or define('WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS);
defined('MONTH_IN_SECONDS') or define('MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);
defined('YEAR_IN_SECONDS') or define('YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS);

function rb_human_time_diff($from, $to = '')
{
    if (empty($to)) {
        $to = time();
    }

    $diff = (int) abs($to - $from);

    if ($diff < HOUR_IN_SECONDS) {
        $mins = round($diff / MINUTE_IN_SECONDS);
        if ($mins <= 1) {
            $mins = 1;
        }
        $since = sprintf(rb_n('%s min', '%s mins', $mins), $mins);
    } elseif ($diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS) {
        $hours = round($diff / HOUR_IN_SECONDS);
        if ($hours <= 1) {
            $hours = 1;
        }
        $since = sprintf(rb_n('%s hour', '%s hours', $hours), $hours);
    } elseif ($diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS) {
        $days = round($diff / DAY_IN_SECONDS);
        if ($days <= 1) {
            $days = 1;
        }
        $since = sprintf(rb_n('%s day', '%s days', $days), $days);
    } elseif ($diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS) {
        $weeks = round($diff / WEEK_IN_SECONDS);
        if ($weeks <= 1) {
            $weeks = 1;
        }
        $since = sprintf(rb_n('%s week', '%s weeks', $weeks), $weeks);
    } elseif ($diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS) {
        $months = round($diff / MONTH_IN_SECONDS);
        if ($months <= 1) {
            $months = 1;
        }
        $since = sprintf(rb_n('%s month', '%s months', $months), $months);
    } elseif ($diff >= YEAR_IN_SECONDS) {
        $years = round($diff / YEAR_IN_SECONDS);
        if ($years <= 1) {
            $years = 1;
        }
        $since = sprintf(rb_n('%s year', '%s years', $years), $years);
    }

    return rb_apply_filters('rb_human_time_diff', $since, $diff, $from, $to);
}

function rb_add_user_meta($user_id, $key, $value, $unique = false)
{
    return rb_add_option('u'.(int)$user_id.'_'.$key, $value);
}

function rb_get_user_meta($user_id, $key = '', $single = false)
{
    return rb_get_option('u'.(int)$user_id.'_'.$key);
}

function rb_update_user_meta($user_id, $key, $value, $prev_value = '')
{
    return rb_update_option('u'.(int)$user_id.'_'.$key, $value);
}

function rb_remote_retrieve_body($response)
{
    return $response['body'];
}

function rb_remote_get($url, $args = array())
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array('body' => $resp);
}

function rb_get_current_screen()
{
    return isset($GLOBALS['rb_screen']) ? $GLOBALS['rb_screen'] : (object) array('id' => '', 'base' => '');
}

function rb_register_activation_hook($file, $func)
{
    // TODO
}
function rb_register_deactivation_hook($file, $func)
{
    // TODO
}
function rb_register_uninstall_hook($file, $func)
{
    // TODO
}

function rb_die($string)
{
    die($string);
}

function rb__($text, $domain = 'default')
{
    return _ss(Translate::getModuleTranslation('rbthemeslider', $text, '', null, true));
}

function rb_e($text, $domain = 'default')
{
    echo _ss(Translate::getModuleTranslation('rbthemeslider', $text, '', null, true));
}

function rb_x($text, $context, $domain = 'default')
{
    // TODO
    return _ss(Translate::getModuleTranslation('rbthemeslider', $text, '', null, true));
}

function rb_ex($text, $context, $domain = 'default')
{
    // TODO
    echo _ss(Translate::getModuleTranslation('rbthemeslider', $text, '', null, true));
}

function rb_n($single, $plural, $number, $domain = 'default')
{
    return _ss(Translate::getModuleTranslation('rbthemeslider', $number > 1 ? $plural : $single, '', null, true));
}

function rb_get_allowed_mime_types()
{
    return rb_apply_filters('allowed_mime_types', rb_get_mime_types());
}

function rb_get_mime_types()
{
    return array(
        // Image formats.
        'webp' => 'image/webp',
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'bmp' => 'image/bmp',
        'tiff|tif' => 'image/tiff',
        'ico' => 'image/x-icon',
        // Video formats.
        'asf|asx' => 'video/x-ms-asf',
        'wmv' => 'video/x-ms-wmv',
        'wmx' => 'video/x-ms-wmx',
        'wm' => 'video/x-ms-wm',
        'avi' => 'video/avi',
        'divx' => 'video/divx',
        'flv' => 'video/x-flv',
        'mov|qt' => 'video/quicktime',
        'mpeg|mpg|mpe' => 'video/mpeg',
        'mp4|m4v' => 'video/mp4',
        'ogv' => 'video/ogg',
        'webm' => 'video/webm',
        'mkv' => 'video/x-matroska',
        '3gp|3gpp' => 'video/3gpp', // Can also be audio
        '3g2|3gp2' => 'video/3gpp2', // Can also be audio
        // Text formats.
        'txt|asc|c|cc|h|srt' => 'text/plain',
        'csv' => 'text/csv',
        'tsv' => 'text/tab-separated-values',
        'ics' => 'text/calendar',
        'rtx' => 'text/richtext',
        'css' => 'text/css',
        'htm|html' => 'text/html',
        'vtt' => 'text/vtt',
        'dfxp' => 'application/ttaf+xml',
        // Audio formats.
        'mp3|m4a|m4b' => 'audio/mpeg',
        'ra|ram' => 'audio/x-realaudio',
        'wav' => 'audio/wav',
        'ogg|oga' => 'audio/ogg',
        'mid|midi' => 'audio/midi',
        'wma' => 'audio/x-ms-wma',
        'wax' => 'audio/x-ms-wax',
        'mka' => 'audio/x-matroska',
        // Misc application formats.
        'rtf' => 'application/rtf',
        'js' => 'application/javascript',
        'pdf' => 'application/pdf',
        'swf' => 'application/x-shockwave-flash',
        'class' => 'application/java',
        'tar' => 'application/x-tar',
        'zip' => 'application/zip',
        'gz|gzip' => 'application/x-gzip',
        'rar' => 'application/rar',
        '7z' => 'application/x-7z-compressed',
        'exe' => 'application/x-msdownload',
        'psd' => 'application/octet-stream',
        'xcf' => 'application/octet-stream',
        // MS Office formats.
        'doc' => 'application/msword',
        'pot|pps|ppt' => 'application/vnd.ms-powerpoint',
        'wri' => 'application/vnd.ms-write',
        'xla|xls|xlt|xlw' => 'application/vnd.ms-excel',
        'mdb' => 'application/vnd.ms-access',
        'mpp' => 'application/vnd.ms-project',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'docm' => 'application/vnd.ms-word.document.macroEnabled.12',
        'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
        'dotm' => 'application/vnd.ms-word.template.macroEnabled.12',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
        'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
        'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
        'xltm' => 'application/vnd.ms-excel.template.macroEnabled.12',
        'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'pptm' => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
        'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
        'ppsm' => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
        'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
        'potm' => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
        'ppam' => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
        'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
        'sldm' => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
        'onetoc|onetoc2|onetmp|onepkg' => 'application/onenote',
        'oxps' => 'application/oxps',
        'xps' => 'application/vnd.ms-xpsdocument',
        // OpenOffice formats.
        'odt' => 'application/vnd.oasis.opendocument.text',
        'odp' => 'application/vnd.oasis.opendocument.presentation',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        'odg' => 'application/vnd.oasis.opendocument.graphics',
        'odc' => 'application/vnd.oasis.opendocument.chart',
        'odb' => 'application/vnd.oasis.opendocument.database',
        'odf' => 'application/vnd.oasis.opendocument.formula',
        // WordPerfect formats.
        'wp|wpd' => 'application/wordperfect',
        // iWork formats.
        'key' => 'application/vnd.apple.keynote',
        'numbers' => 'application/vnd.apple.numbers',
        'pages' => 'application/vnd.apple.pages',
    );
}

function rb_check_filetype($filename, $mimes = null)
{
    if (empty($mimes)) {
        $mimes = rb_get_allowed_mime_types();
    }
    $type = false;
    $ext = false;

    foreach ($mimes as $ext_preg => $mime_match) {
        $ext_preg = '!\.(' . $ext_preg . ')$!i';
        if (preg_match($ext_preg, $filename, $ext_matches)) {
            $type = $mime_match;
            $ext = $ext_matches[1];
            break;
        }
    }

    return compact('ext', 'type');
}

function rb_sanitize_file_name($filename)
{
    $filename_raw = $filename;
    $special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}", "%", "+", chr(0));
    $special_chars = rb_apply_filters('rb_sanitize_file_name_chars', $special_chars, $filename_raw);
    $filename = preg_replace("#\x{00a0}#siu", ' ', $filename);
    $filename = str_replace($special_chars, '', $filename);
    $filename = str_replace(array('%20', '+'), '-', $filename);
    $filename = preg_replace('/[\r\n\t -]+/', '-', $filename);
    $filename = trim($filename, '.-_');

    if (false === strpos($filename, '.')) {
        $mime_types = rb_get_mime_types();
        $filetype = rb_check_filetype('test.' . $filename, $mime_types);
        if ($filetype['ext'] === $filename) {
            $filename = 'unnamed-file.' . $filetype['ext'];
        }
    }

    // Split the filename into a base and extension[s]
    $parts = explode('.', $filename);

    // Return if only one extension
    if (count($parts) <= 2) {
        return rb_apply_filters('rb_sanitize_file_name', $filename, $filename_raw);
    }

    // Process multiple extensions
    $filename = array_shift($parts);
    $extension = array_pop($parts);
    $mimes = rb_get_allowed_mime_types();

    // Loop over any intermediate extensions. Postfix them with a trailing underscore
    // if they are a 2 - 5 character long alpha string not in the extension whitelist.
    foreach ((array) $parts as $part) {
        $filename .= '.' . $part;

        if (preg_match("/^[a-zA-Z]{2,5}\d?$/", $part)) {
            $allowed = false;
            foreach ($mimes as $ext_preg => $mime_match) {
                $ext_preg = '!^(' . $ext_preg . ')$!i';
                if (preg_match($ext_preg, $part)) {
                    $allowed = true;
                    break;
                }
            }
            if (!$allowed) {
                $filename .= '_';
            }
        }
    }
    $filename .= '.' . $extension;
    // This filter is documented in wp-includes/formatting.php
    return rb_apply_filters('rb_sanitize_file_name', $filename, $filename_raw);
}

// MAGIC QUOTES
function rb_map_deep($value, $callback)
{
    if (is_array($value)) {
        foreach ($value as $index => $item) {
            $value[ $index ] = rb_map_deep($item, $callback);
        }
    } elseif (is_object($value)) {
        $object_vars = get_object_vars($value);
        foreach ($object_vars as $property_name => $property_value) {
            $value->$property_name = rb_map_deep($property_value, $callback);
        }
    } else {
        $value = call_user_func($callback, $value);
    }

    return $value;
}
function _ss($value)
{
    return call_user_func('strip'.'slashes', $value);
}
function rb_stripslashes_from_strings_only($value)
{
    return is_string($value) ? _ss($value) : $value;
}
function rb_stripslashes_deep($value)
{
    return rb_map_deep($value, 'rb_stripslashes_from_strings_only');
}
function rb_add_magic_quotes($array)
{
    foreach ((array) $array as $k => $v) {
        if (is_array($v)) {
            $array[$k] = rb_add_magic_quotes($v);
        } else {
            $array[$k] = addslashes($v);
        }
    }
    return $array;
}
function rb_magic_quotes()
{
    // If already slashed, strip.
    if (get_magic_quotes_gpc()) {
        ${'_GET'}    = rb_stripslashes_deep(${'_GET'});
        ${'_POST'}   = rb_stripslashes_deep(${'_POST'});
        $_COOKIE = rb_stripslashes_deep($_COOKIE);
    }

    // Escape with wpdb.
    ${'_GET'}    = rb_add_magic_quotes(${'_GET'});
    ${'_POST'}   = rb_add_magic_quotes(${'_POST'});
    $_COOKIE = rb_add_magic_quotes($_COOKIE);
    $_SERVER = rb_add_magic_quotes($_SERVER);

    // Force REQUEST to be GET + POST.
    $_REQUEST = array_merge(${'_GET'}, ${'_POST'});
}

defined('NL') or define("NL", "\r\n");
defined('TAB') or define("TAB", "\t");

function rb_load_plugin_textdomain($domain, $abs_rel_path, $plugin_rel_path)
{
    // TODO
}

function rb_is_admin()
{
    $ct = Context::getContext()->controller->controller_type;
    return $ct == 'moduleadmin' || $ct == 'admin';
}

function rb_get_current_user()
{
    return Context::getContext()->employee;
}

function rb_get_current_user_id()
{
    $context = Context::getContext();
    return $context->employee ? $context->employee->id : 0;
}

function rb_get_option_key($option)
{
    if (version_compare(_PS_VERSION_, '1.6', '<') && Tools::strlen($option) > 32) {
        // option key must have max 32 chars on PS v1.5.x
        return Tools::strtoupper(md5($option));
    }
    return Tools::strtoupper(str_replace('-', '_', $option));
}

function rb_get_option($option, $default = false)
{
    if ('rbthemeslider-authorized-site' == $option) {
        // premium features fix
        return true;
    }
    if ('timezone_string' == $option) {
        return date_default_timezone_get();
    }
    $res = Configuration::get(rb_get_option_key($option));
    return $res === false ? $default : Tools::jsonDecode($res, true);
}

function rb_add_option($option, $value)
{
    return Configuration::updateValue(rb_get_option_key($option), Tools::jsonEncode($value));
}

function rb_update_option($option, $value)
{
    return Configuration::updateValue(rb_get_option_key($option), Tools::jsonEncode($value));
}

function rb_delete_option($option)
{
    return Configuration::deleteByName(rb_get_option_key($option));
}

$GLOBALS['rb_style'] = array();

function rb_enqueue_style($handle, $src = false, $deps = array(), $ver = false, $media = 'all')
{
    if ($src) {
        $css = array('src' => $src, 'ver' => $ver, 'media' => $media);
        $GLOBALS['rb_style'][$handle] = $css;
    } elseif (isset($GLOBALS['rb_style'][$handle])) {
        $css = $GLOBALS['rb_style'][$handle];
    }
    if (isset($css)) {
        $ctrl = Context::getContext()->controller;
        $v = $css['ver'] ? '?v='.$css['ver'] : '';

        if (method_exists($ctrl, 'registerStylesheet')) {
            if (RB_CSS_THEME_CACHE && strpos($css['src'], '://') === false) {
                $src = Tools::substr($css['src'], Tools::strlen(__PS_BASE_URI__));
            } else {
                $css['server'] = 'remote';
                $src = $css['src'].$v;
            }
            $ctrl->registerStylesheet($handle, $src, $css);
        } else {
            $ctrl->css_files[ $css['src'].$v ] = $css['media'];
        }
    }
}

function rb_register_style($handle, $src, $deps = array(), $ver = false, $media = 'all')
{
    $GLOBALS['rb_style'][$handle] = array('src' => $src, 'ver' => $ver, 'media' => $media);
}

$GLOBALS['rb_script'] = array();

function rb_enqueue_script($handle, $src = false, $deps = array(), $ver = false, $in_footer = false)
{
    if ($src) {
        $js = array('src' => $src, 'ver' => $ver, 'priority' => RB_PRIORITY);
        $GLOBALS['rb_script'][$handle] = $js;
    } elseif (isset($GLOBALS['rb_script'][$handle])) {
        $js = $GLOBALS['rb_script'][$handle];
    }
    if (isset($js) && !isset($js['added'])) {
        $GLOBALS['rb_script'][$handle]['added'] = true;
        $ctrl = Context::getContext()->controller;
        $v = $js['ver'] ? '?v='.$js['ver'] : '';

        if (RB_UNPACKED && preg_match('~/js/rbthemeslider/(\w+/)*rbthemeslider\.~', $js['src'])) {
            $js['src'] = str_replace('.js', '.unpacked.js', $js['src']);
        }
        if (method_exists($ctrl, 'registerJavascript')) {
            if (RB_JS_THEME_CACHE) {
                $src = Tools::substr($js['src'], Tools::strlen(__PS_BASE_URI__));
            } else {
                $js['server'] = 'remote';
                $src = $js['src'].$v;
            }
            $ctrl->registerJavascript($handle, $src, $js);
        } else {
            if (!rb_is_admin() && preg_match('~/(\w+\.)?((?:\w+\.)+js)$~', $js['src'], $match)) {
                foreach ($ctrl->js_files as $jsFile) {
                    if (strpos($jsFile, $match[2]) !== false) {
                        return;
                    }
                }
            }
            $ctrl->js_files[] = $js['src'] . $v;
        }
    }
}

function rb_register_script($handle, $src, $deps = array(), $ver = false, $in_footer = false)
{
    $GLOBALS['rb_script'][$handle] = array('src' => $src, 'ver' => $ver, 'priority' => RB_PRIORITY);
}

$GLOBALS['rb_local'] = array();

function rb_localize_script($handle, $name, $data)
{
    if (version_compare(_PS_VERSION_, '1.6.0.11', '>=')) {
        Media::addJsDef(array($name => $data));
    } else {
        $GLOBALS['rb_local'][] = "var $name = ".Tools::jsonEncode($data).';';
    }
}

function convert2psurl($path)
{
    $path = str_replace('admin.php', 'index.php', $path);
    $path = preg_replace_callback('/page=([-\w]+)/', 'convert2psurl_helper', $path);
    return $path;
}
function convert2psurl_helper($match)
{
    $context = Context::getContext();
    switch ($match[1]) {
        case 'rbthemeslider':
            return parse_url(@$context->link->getAdminLink('AdminRbthemesliderSlider'), PHP_URL_QUERY);
        case 'rb-skin-editor':
            return parse_url($context->link->getAdminLink('AdminRbthemesliderSkin'), PHP_URL_QUERY);
        case 'rb-style-editor':
            return parse_url($context->link->getAdminLink('AdminRbthemesliderStyle'), PHP_URL_QUERY);
        case 'rb-transition-builder':
            return parse_url($context->link->getAdminLink('AdminRbthemesliderTransition'), PHP_URL_QUERY);
        case 'rb-revisions':
            return parse_url($context->link->getAdminLink('AdminRbthemesliderRevisions'), PHP_URL_QUERY);
        default:
            return parse_url($context->link->getAdminLink($match[1]), PHP_URL_QUERY);
    }
}

function rb_admin_url($path = '', $scheme = 'admin')
{
    return convert2psurl($path);
}

function rb_parse_str($string, &$array)
{
    parse_str($string, $array);
    if (get_magic_quotes_gpc()) {
        $array = rb_stripslashes_deep($array);
    }

    $array = rb_apply_filters('rb_parse_str', $array);
}

function rb_urlencode_deep($value)
{
    $value = is_array($value) ? array_map('rb_urlencode_deep', $value) : urlencode($value);
    return $value;
}

function rb_add_query_arg()
{
    $args = func_get_args();
    if (is_array($args[0])) {
        if (count($args) < 2 || false === $args[1]) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[1];
        }
    } else {
        if (count($args) < 3 || false === $args[2]) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[2];
        }
    }

    if ($frag = strstr($uri, '#')) {
        $uri = Tools::substr($uri, 0, -Tools::strlen($frag));
    } else {
        $frag = '';
    }

    if (0 === stripos($uri, 'http://')) {
        $protocol = 'http://';
        $uri = Tools::substr($uri, 7);
    } elseif (0 === stripos($uri, 'https://')) {
        $protocol = 'https://';
        $uri = Tools::substr($uri, 8);
    } else {
        $protocol = '';
    }

    if (strpos($uri, '?') !== false) {
        list($base, $query) = explode('?', $uri, 2);
        $base .= '?';
    } elseif ($protocol || strpos($uri, '=') === false) {
        $base = $uri . '?';
        $query = '';
    } else {
        $base = '';
        $query = $uri;
    }

    $qs = array();
    rb_parse_str($query, $qs);
    $qs = rb_urlencode_deep($qs); // this re-URL-encodes things that were already in the query string
    if (is_array($args[0])) {
        $kayvees = $args[0];
        $qs = array_merge($qs, $kayvees);
    } else {
        $qs[ $args[0] ] = $args[1];
    }

    foreach ($qs as $k => $v) {
        if ($v === false) {
            unset($qs[$k]);
        }
    }

    $ret = rb_build_query($qs);
    $ret = trim($ret, '?');
    $ret = preg_replace('#=(&|$)#', '$1', $ret);
    $ret = $protocol . $base . $ret . $frag;
    $ret = rtrim($ret, '?');
    return $ret;
}

function rb_http_build_query($data, $prefix = null, $sep = null, $key = '', $urlencode = true)
{
    $ret = array();

    foreach ((array) $data as $k => $v) {
        if ($urlencode) {
            $k = urlencode($k);
        }
        if (is_int($k) && $prefix != null) {
            $k = $prefix.$k;
        }
        if (!empty($key)) {
            $k = $key . '%5B' . $k . '%5D';
        }
        if ($v === null) {
            continue;
        } elseif ($v === false) {
            $v = '0';
        }

        if (is_array($v) || is_object($v)) {
            array_push($ret, rb_http_build_query($v, '', $sep, $k, $urlencode));
        } elseif ($urlencode) {
            array_push($ret, $k.'='.urlencode($v));
        } else {
            array_push($ret, $k.'='.$v);
        }
    }

    if (null === $sep) {
        $sep = '&';
    }

    return implode($sep, $ret);
}

function rb_build_query($data)
{
    return rb_http_build_query($data, null, '&', '', false);
}

function rb_redirect($location, $status = 302)
{
    Tools::redirectAdmin(convert2psurl($location));
}

require_once _PS_MODULE_DIR_.'rbthemeslider/classes/RbCache.php';

function rb_set_transient($transient, $value, $expiration = 0)
{
    $expiration = (int) $expiration;
    try {
        $result = RbCache::getInstance()->set($transient, $value, $expiration);
    } catch (Exception $ex) {
        $result = false;
    }
    return $result;
}

function rb_get_transient($transient)
{
    try {
        $result = RBCache::getInstance()->get($transient);
    } catch (Exception $ex) {
        $result = false;
    }
    return $result;
}

function rb_delete_transient($transient)
{
    try {
        $result = RBCache::getInstance()->delete($transient);
    } catch (Exception $ex) {
        $result = false;
    }
    return $result;
}

function rb_upload_dir()
{
    return array(
        'basedir' => _PS_IMG_DIR_,
        'baseurl' => _PS_IMG_
    );
}

function rb_get_image_type_name($name)
{
    return method_exists('ImageType', 'getFormattedName') ? ImageType::getFormattedName($name) :
        (method_exists('ImageType', 'getFormatedName') ? ImageType::getFormatedName($name) : $name.'_default');
}

/* ADD ACTIONS / FILTERS */

function rb_get_hook_list()
{
    if (version_compare(_PS_VERSION_, '1.7.0', '<')) {
        $hooks = array(
            array('name' => rb__('- None -'), 'value' => ''),
            array('name' => rb__('Home'), 'value' => 'displayHome'),
            array('name' => rb__('Top of pages'), 'value' => 'displayTop'),
            array('name' => rb__('Banner'), 'value' => 'displayBanner'),
            array('name' => rb__('Navigation'), 'value' => 'displayNav'),
            array('name' => rb__('Top column blocks'), 'value' => 'displayTopColumn'),
            array('name' => rb__('Left column blocks'), 'value' => 'displayLeftColumn'),
            array('name' => rb__('Right column blocks'), 'value' => 'displayRightColumn'),
            array('name' => rb__('Footer'), 'value' => 'displayFooter'),
            array('name' => rb__('Rb Theme Slider'), 'value' => 'displayRbThemeSlider'),
        );
    } else {
        $hooks = array(
            array('name' => rb__('- None -'), 'value' => ''),
            array('name' => rb__('Home'), 'value' => 'displayHome'),
            array('name' => rb__('Top of pages'), 'value' => 'displayTop'),
            array('name' => rb__('Banner'), 'value' => 'displayBanner'),
            array('name' => rb__('Navigation 1'), 'value' => 'displayNav1'),
            array('name' => rb__('Navigation 2'), 'value' => 'displayNav2'),
            array('name' => rb__('Navigation full-width'), 'value' => 'displayNavFullWidth'),
            array('name' => rb__('Top wrapper'), 'value' => 'displayWrapperTop'),
            array('name' => rb__('Top content wrapper'), 'value' => 'displayContentWrapperTop'),
            array('name' => rb__('Top column blocks'), 'value' => 'displayTopColumn'),
            array('name' => rb__('Left column blocks'), 'value' => 'displayLeftColumn'),
            array('name' => rb__('Right column blocks'), 'value' => 'displayRightColumn'),
            array('name' => rb__('Bottom content wrapper'), 'value' => 'displayContentWrapperBottom'),
            array('name' => rb__('Bottom wrapper'), 'value' => 'displayWrapperBottom'),
            array('name' => rb__('Footer before'), 'value' => 'displayFooterBefore'),
            array('name' => rb__('Footer'), 'value' => 'displayFooter'),
            array('name' => rb__('Footer after'), 'value' => 'displayFooterAfter'),
            array('name' => rb__('After body opening tag'), 'value' => 'displayAfterBodyOpeningTag'),
            array('name' => rb__('Before body closing tag'), 'value' => 'displayBeforeBodyClosingTag'),
            array('name' => rb__('Rb Theme Slider'), 'value' => 'displayRbThemeSlider'),
        );
    }
    return json_encode($hooks);
}

function rb_update_hook()
{
    $id = (int) Tools::getValue('id', 0);
    $hook = preg_replace('/\W/', '', Tools::getValue('hook', ''));
    $db = Db::getInstance();
    $row = $db->getRow('SELECT data, flag_deleted FROM '._DB_PREFIX_.'rbthemeslider WHERE id = '.$id);
    $data = Tools::jsonDecode($row['data'], true);
    if (!$data) {
        $data = _ss(Tools::jsonDecode($row['data'], true));
    }
    if ($data && isset($data['properties'])) {
        $old_hook = isset($data['properties']['hook']) ? preg_replace('/\W/', '', $data['properties']['hook']) : '';
        $data['properties']['hook'] = $hook;

        $res = $db->update('rbthemeslider', array('data' => $db->_escape(Tools::jsonEncode($data)), 'date_m' => time()), 'id = '.$id);
        if ($res) {
            if (!$row['flag_deleted']) {
                if ($old_hook && $db->getValue("SELECT COUNT(hook) FROM "._DB_PREFIX_."rbthemeslider_module WHERE hook = '$old_hook' AND id_shop > -1") == 1) {
                    Rbthemeslider::$instance->unregisterHook($old_hook);
                }
                if ($hook && $db->getValue("SELECT COUNT(hook) FROM "._DB_PREFIX_."rbthemeslider_module WHERE hook = '$hook' AND id_shop > -1") == 0) {
                    Rbthemeslider::$instance->registerHook($hook);
                }
            }
            $db->update('rbthemeslider_module', array('hook' => $hook), 'id_slider = '.$id);
            die(Tools::jsonEncode(array('hook' => $hook, 'success' => true)));
        }
    }
    die(Tools::jsonEncode(array('errorMsg' => rb__("Database error, can't update hook!", 'rbthemeslider'), 'success' => false)));
}
rb_add_action('wp_ajax_rb_update_hook', 'rb_update_hook');

function rb_get_shop_params()
{
    require_once _PS_MODULE_DIR_.'rbthemeslider/classes/PSOpts.php';
    $lang = (object) array(
        'name' => 'lang',
        'title' => rb__('Language', 'rbthemeslider'),
        'desc' => rb__('Slider will appear only on the selected language. (In case of multilanguage)', 'rbthemeslider'),
        'opts' => array((object) array('name' => rb__('- All -', 'rbthemeslider'), 'id_lang' => 0, 'active' => 1)),
    );
    $lang->opts = array_merge($lang->opts, Language::getLanguages());
    $shop = (object) array(
        'name' => 'shop',
        'title' => rb__('Shop', 'rbthemeslider'),
        'desc' => rb__('Slider will appear only on the selected shop. (In case of Multi-shops)', 'rbthemeslider'),
        'opts' => array((object) array('name' => rb__('- All -', 'rbthemeslider'), 'id_shop' => 0, 'active' => 1)),
    );
    $shop->opts = array_merge($shop->opts, Shop::getShops());
    $cats = (object) array(
        'name' => 'cats',
        'title' => rb__('Show slider on these <br> Categories &amp; Pages', 'rbthemeslider'),
        'desc' => rb__('Use Ctrl to select multiple categories or pages.', 'rbthemeslider'),
        'opts' => PSOpts::getCategories(),
    );
    $pages = (object) array(
        'name' => 'pages',
        'title' => rb__('Show slider on these <br> Categories &amp; Pages', 'rbthemeslider'),
        'desc' => rb__('Use Ctrl to select multiple categories or pages.', 'rbthemeslider'),
        'opts' => PSOpts::getCMSCategories(),
    );
    $position = (object) array(
        'name' => 'position',
        'title' => rb__('Ordering', 'rbthemeslider'),
        'desc' => rb__('Sliders in the same module position can be ordered with this option. Use lower value if you want to move this slider in above the others.', 'rbthemeslider'),
    );
    $groups = (object) array(
        'name' => 'groups',
        'title' => rb__('Groups', 'rbthemeslider'),
        'desc' => rb__('PrestaShop has three default customer groups<br><i>Visitor</i> - All persons without a customer account or customers that are not logged in.<br><i>Guest</i> - All persons who placed an order through Guest Checkout.<br><i>Customer</i> - All persons who created an account on this site.'),
        'opts' => array((object) array('name' => rb__('- All -', 'rbthemeslider'), 'id_group' => 0)),
    );
    $groups->opts = array_merge($groups->opts, Group::getGroups(Context::getContext()->language->id));

    $params = new stdClass();
    $params->lang = $lang;
    $params->shop = $shop;
    $params->cats = $cats;
    $params->pages = $pages;
    $params->position = $position;
    $params->groups = $groups;
    die(Tools::jsonEncode($params));
}
rb_add_action('wp_ajax_rb_get_shop_params', 'rb_get_shop_params');

// override post defaults
function rb_override_post_defaults($defaults)
{
    $defaults['slider']['postOrderBy'] = array(
        'value' => 'date_add',
        'keys' => 'post_orderby',
        'options' => array(
            'date_add' => rb__('Date Created', 'rbthemeslider'),
            'date_upd' => rb__('Last Modified', 'rbthemeslider'),
            'position' => rb__('Popularity', 'rbthemeslider'),
            'quantity' => rb__('Sold quantity', 'rbthemeslider'),
            'reduction' => rb__('Special offer', 'rbthemeslider'),
            'name' => rb__('Product name', 'rbthemeslider'),
            'price' => rb__('Product price', 'rbthemeslider'),
            'rand' => rb__('Random', 'rbthemeslider'),
        ),
        'props' => array('meta' => 1),
    );
    // $defaults['slider']['hook'] = array(
    //     'value' => '',
    //     'keys' => 'hook',
    //     'props' => array('meta' => 1),
    // );

    return $defaults;
}
rb_add_filter('rbthemeslider_override_defaults', 'rb_override_post_defaults');

function rb_get_media_link($filepath)
{
    if (version_compare(_PS_VERSION_, '1.6', '>=')) {
        return Context::getContext()->link->getMediaLink($filepath);
    }
    // PS v1.5
    static $ssl = null;

    if ($ssl === null) {
        $ssl = (bool) Configuration::get('PS_SSL_ENABLED');
    }
    return Tools::getProtocol($ssl).Tools::getMediaServer($filepath).$filepath;
}

function rb_pre_parse_defaults($data)
{
    if (!empty($data['properties']['yourlogo']) && $data['properties']['yourlogo'][0] == '/') {
        $data['properties']['yourlogo'] = rb_get_media_link($data['properties']['yourlogo']);
    }
    if (!empty($data['properties']['backgroundimage']) && $data['properties']['backgroundimage'][0] == '/') {
        $data['properties']['backgroundimage'] = rb_get_media_link($data['properties']['backgroundimage']);
    }
    foreach ($data['layers'] as &$slide) {
        if (!empty($slide['properties']['background']) && $slide['properties']['background'][0] == '/') {
            $slide['properties']['background'] = rb_get_media_link($slide['properties']['background']);
        }
        if (!empty($slide['properties']['thumbnail']) && $slide['properties']['thumbnail'][0] == '/') {
            $slide['properties']['thumbnail'] = rb_get_media_link($slide['properties']['thumbnail']);
        }
        if (!empty($slide['sublayers'])) {
            foreach ($slide['sublayers'] as &$layer) {
                if (!empty($layer['image']) && $layer['image'][0] == '/') {
                    $layer['image'] = rb_get_media_link($layer['image']);
                }
                if (!empty($layer['poster']) && $layer['poster'][0] == '/') {
                    $layer['poster'] = rb_get_media_link($layer['poster']);
                }
            }
        }
    }
    return $data;
}
rb_add_filter('rbthemeslider_pre_parse_defaults', 'rb_pre_parse_defaults');

function rb_post_parse_defaults($data)
{
    if (!empty($data['properties']['attrs'])) {
        $data['properties']['attrs']['skinsPath'] = rb_get_media_link(_MODULE_DIR_.'rbthemeslider/views/css/rbthemeslider/skins/');
    }
    return $data;
}
rb_add_filter('rbthemeslider_post_parse_defaults', 'rb_post_parse_defaults');

function rb_add_hook($id, $data)
{
    $db = Db::getInstance();

    if ($data['hook']) {
        $hook_count = (int)$db->getValue('SELECT COUNT(*) FROM '._DB_PREFIX_.'rbthemeslider_module WHERE hook = "'.pSQL($data['hook']).'" AND id_shop > -1');
        if ($hook_count == 0) {
            Rbthemeslider::$instance->registerHook($data['hook']);
        }
    }
    $db->update('rbthemeslider_module', $data, 'id_slider = '.(int)$id);
}

function rb_remove_hook($id, $hook)
{
    $db = Db::getInstance();
    $old = $db->getRow(
        'SELECT h.id_hook, m.hook FROM '._DB_PREFIX_.'rbthemeslider_module AS m '.'LEFT JOIN '._DB_PREFIX_.
        "hook AS h ON m.hook = h.name WHERE id_slider = $id"
    );
    if ($old && $old['hook'] && $old['hook'] != $hook) {
        $old_hook_count = (int)$db->getValue('SELECT COUNT(*) FROM '._DB_PREFIX_."rbthemeslider_module WHERE hook = '{$old['hook']}' AND id_shop > -1");
        if ($old_hook_count == 1) {
            Rbthemeslider::$instance->unregisterHook($old['id_hook']);
        }
    }
}

function rb_get_pages(&$cats, &$pages, &$groups)
{
    $obj = array(
        'cat' => array(),
        'prod' => array(),
        'cms' => array(),
        'page' => array(),
        'groups' => $groups,
    );

    if (in_array('all', $cats)) {
        $obj['cat'] = $obj['prod'] = 'all';
    } else {
        foreach ($cats as $val) {
            if (preg_match('/^[cp]-\d+$/', $val)) {
                $v = explode('-', $val);
                $obj[$v[0] == 'c' ? 'cat' : 'prod'][] = $v[1];
            } elseif ($val) {
                $obj[$val] = 1;
            }
        }
    }

    if (in_array('all', $pages)) {
        $obj['cms'] = $obj['page'] = 'all';
    } else {
        foreach ($pages as $val) {
            if (preg_match('/^(\w+)-\d+$/', $val)) {
                $v = explode('-', $val);
                switch ($v[0]) {
                    case 'c':
                        $obj['cms'][] = $v[1];
                        break;
                    case 'p':
                        $obj['page'][] = $v[1];
                        break;
                    default:
                        $obj[ $v[0] ][] = $v[1];
                        break;
                }
            } elseif ($val) {
                $obj[$val] = 1;
            }
        }
    }
    return Tools::jsonEncode($obj);
}

function rb_before_save_slider()
{
    $id = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;
    $sd = isset($_REQUEST['sliderData']) ? $_REQUEST['sliderData'] : array();
    if (!$id || empty($sd)) {
        return;
    }

    $props = isset($sd['properties']) ? Tools::jsonDecode(_ss(html_entity_decode($sd['properties'])), true) : array();
    $cats = isset($props['cats']) ? $props['cats'] : array();
    $pages = isset($props['pages']) ? $props['pages'] : array();
    $groups = isset($props['groups']) ? $props['groups'] : array();

    $data = array(
        'hook' => isset($props['hook']) ? $props['hook'] : '',
        'id_shop' => isset($props['shop']) ? $props['shop'] : 0,
        'id_lang' => isset($props['lang']) ? $props['lang'] : 0,
        'position' => isset($props['position']) ? $props['position'] : 10,
        'pages' => rb_get_pages($cats, $pages, $groups),
    );

    rb_remove_hook($id, $data['hook']);
    rb_add_hook($id, $data);
}
rb_add_action('wp_ajax_rb_save_slider', 'rb_before_save_slider');

function rb_addons_request()
{
    $context = Context::getContext();
    $postData = http_build_query(array(
        'version' => _PS_VERSION_,
        'iso_lang' => $context->language->iso_code,
        'iso_code' => Tools::strtolower(Country::getIsoById(Configuration::get('PS_COUNTRY_DEFAULT'))),
        'shop_url' => Tools::getShopDomain(),
        'mail' => Configuration::get(version_compare(_PS_VERSION_, '1.6', '<') ? 'email' : 'PS_SHOP_EMAIL'),
        'format' => 'xml',
        'method' => 'listing',
        'action' => 'customer',
    ));
    $postData .= '&username='.urlencode(trim($context->cookie->username_addons));
    $postData .= '&password='.urlencode(trim($context->cookie->password_addons));

    $streamContext = stream_context_create(array(
        'http' => array(
            'method'=> 'POST',
            'content' => $postData,
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'timeout' => 60,
        )
    ));
    return Tools::file_get_contents('https://api.addons.prestashop.com', false, $streamContext);
}

function rb_get_modules()
{
    $modules = array();
    $dirs = glob(_PS_MODULE_DIR_.'*', GLOB_ONLYDIR);
    foreach ($dirs as $dir) {
        $modules[basename($dir)] = 1;
    }
    return $modules;
}

function rb_test_template_store()
{
    $context = Context::getContext();
    if (!empty($context->cookie->rb_key)) {
        die(json_encode(array('key' => $context->cookie->rb_key, 'success' => 1)));
    }
    if (empty($context->cookie->username_addons) || empty($context->cookie->password_addons)) {
        $msg = rb__('Please first connect your shop to PrestaShop Addons', 'rbthemeslider');
        $btn = ' <a href="'.$context->link->getAdminLink('AdminModules').'" style="float:none; display:inline-block">'.rb__('HERE', 'rbthemeslider').'</a>';
        die(json_encode(array('msg' => $msg.$btn, 'success' => 0)));
    }
    if ($res = rb_addons_request()) {
        $xml = simplexml_load_string($res);
        foreach ($xml->module as $mod) {
            if ($mod->name == 'rbthemeslider') {
                $context->cookie->rb_key = md5("{$mod->id}");
                $context->cookie->write();
                die(json_encode(array('key' => $context->cookie->rb_key, 'success' => 1)));
            }
        }
    }
    $msg = rb__('Please purchase the product to get the premium sliders', 'rbthemeslider');
    $btn = ' <a href="#" target="_blank" style="float:none; display:inline-block">'.rb__('HERE', 'rbthemeslider').'</a>';
    die(json_encode(array('msg' => $msg.$btn, 'success' => 0)));
}
rb_add_action('wp_ajax_rb_test_template_store', 'rb_test_template_store');

function rb_download_slider()
{
    $context = Context::getContext();
    $id = Tools::getValue('id');
    $source = '#';
    $destination = _PS_UPLOAD_DIR_.'rbimport.zip';
    $data = Tools::file_get_contents($source, false, null, 300);

    if ($data) {
        if (file_put_contents($destination, $data)) {
            // import file
            require_once _PS_MODULE_DIR_.'rbthemeslider/base/rbthemeslider.php';
            require_once _PS_MODULE_DIR_.'rbthemeslider/base/classes/class.rb.importutil.php';
            $import = new LsImportUtil($destination);
            try {
                method_exists('Tools', 'deleteFile') ? Tools::deleteFile($destination) : unlink($destination);
            } catch (Exception $ex) {
                // TODO
            }
            // redirect after import
            Tools::redirectAdmin($context->link->getAdminLink('Adminrbthemeslider').'&action=edit&id='.$import->lastImportId);
        } else {
            $context->cookie->rb_error = 'Unable to write file: '.$destination;
        }
    } else {
        $context->cookie->rb_error = 'Tools::file_get_contents returned without data!';
    }
    Tools::redirectAdmin($context->link->getAdminLink('Adminrbthemeslider'));
}

if (Tools::getValue('action', '') == 'download_slider') {
    rb_download_slider();
}