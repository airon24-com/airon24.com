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

class RbRevisions
{
    public static $active   = false;
    public static $enabled  = true;
    public static $limit    = 100;
    public static $interval = 10;


    /**
     * Private constructor to prevent instantiate static class
     *
     * @since 6.3.0
     * @access private
     * @return void
     */
    private function __construct()
    {
    }


    public static function init()
    {
        if (rb_get_option('rbthemeslider-authorized-site', false) && rb_get_option('rb-revisions-enabled', true)) {
                self::$active = true;
        }

        $option = rb_get_option('rb-revisions-enabled', true);
        self::$enabled = ! empty($option);
        self::$limit = rb_get_option('rb-revisions-limit', 100);
        self::$interval = rb_get_option('rb-revisions-interval', 10);
    }


    /**
     * Counts the number of revisions saved for the specified slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @return int The number of revisions available for the slider
     */
    public static function count($sliderId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId)) {
            return false;
        }

        $result = $wpdb->getCol($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}rbthemeslider_revisions WHERE slider_id = %d LIMIT 1", $sliderId));

        return (int) $result[0];
    }


    /**
     * Finds and returns revisions for a specified slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @return array Array of found slider revisions, or false on error
     */
    public static function snapshots($sliderId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId)) {
            return false;
        }

        return $wpdb->getResults($wpdb->prepare("SELECT * FROM {$wpdb->prefix}rbthemeslider_revisions WHERE slider_id = %d ORDER BY id ASC LIMIT 500", $sliderId));
    }


    /**
     * Retrieve a specific revision by its database ID
     *
     * @since 6.3.0
     * @access public
     * @param int $revisionId The revision database ID
     * @return object The chosen revision data, or false on error
     */
    public static function get($revisionId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $revisionId = (int)$revisionId;

        if (empty($revisionId) || !is_numeric($revisionId)) {
            return false;
        }

        return $wpdb->getRow($wpdb->prepare("SELECT * FROM {$wpdb->prefix}rbthemeslider_revisions WHERE id = %d ORDER BY id ASC LIMIT 1", $revisionId));
    }


    /**
     * Retrieve the last revision for a particular slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @return object The last revision, or false on error
     */
    public static function last($sliderId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId)) {
            return false;
        }

        return $wpdb->getRow($wpdb->prepare("SELECT * FROM {$wpdb->prefix}rbthemeslider_revisions WHERE slider_id = %d ORDER BY id DESC LIMIT 1", $sliderId));
    }


    /**
     * Adds a new revision for a specified slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @param string $sliderData The serialized data of the slider
     * @return array Array of found slider revisions, or false on error
     */
    public static function add($sliderId, $sliderData)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId) || empty($sliderData)) {
            return false;
        }

        $wpdb->insert(
            $wpdb->prefix.'rbthemeslider_revisions',
            array(
                'slider_id' => $sliderId,
                'author' => rb_get_current_user_id(),
                'data' => $sliderData,
                'date_c' => time()
            ),
            array(
                '%d',
                '%d',
                '%s',
                '%d'
            )
        );

        return $wpdb->insert_id;
    }


    /**
     * Removes a revision
     *
     * @since 6.3.0
     * @access public
     * @param int $revisionId The revision database ID
     * @return mixed Returns the number of rows affected, or false on error
     */
    public static function remove($revisionId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $revisionId = (int)$revisionId;

        if (empty($revisionId) || !is_numeric($revisionId)) {
            return false;
        }

        return $wpdb->delete(
            $wpdb->prefix.'rbthemeslider_revisions',
            array('id' => $revisionId),
            array('%d')
        );
    }


    /**
     * Removes the last revision of the specified slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The revision database ID
     * @return mixed Returns the number of rows affected, or false on error
     */
    public static function shift($sliderId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId)) {
            return false;
        }

        return $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}rbthemeslider_revisions WHERE slider_id = %d ORDER BY id ASC LIMIT 1", $sliderId));
    }


    /**
     * Removes all revisions for a chosen slider
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @return mixed Returns the number of rows affected, or false on error
     */
    public static function clear($sliderId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;

        if (empty($sliderId) || !is_numeric($sliderId)) {
            return false;
        }

        return $wpdb->delete(
            $wpdb->prefix.'rbthemeslider_revisions',
            array('slider_id' => $sliderId),
            array('%d')
        );
    }


    /**
     * Truncates the entire database table.
     *
     * @since 6.3.0
     * @access public
     * @return mixed Returns the number of rows affected, or false on error
     */
    public static function truncate()
    {
        $wpdb = $GLOBALS['rb_db'];

        return $wpdb->query("TRUNCATE {$wpdb->prefix}rbthemeslider_revisions;");
    }


    /**
     * Reverts the specified slider to a chosen revision
     *
     * @since 6.3.0
     * @access public
     * @param int $sliderId The slider database ID
     * @param int $revisionId The revision database ID
     * @return bool True on success, false on error
     */
    public static function revert($sliderId, $revisionId)
    {
        $wpdb = $GLOBALS['rb_db'];
        $sliderId = (int)$sliderId;
        $revisionId = (int)$revisionId;

        if (empty($sliderId) || !is_numeric($sliderId) || empty($revisionId) || !is_numeric($revisionId)) {
            return false;
        }

        $slider = LsSliders::find($sliderId);
        $revision = self::get($revisionId);
        $data = $revision->data;

        if ($revision &&  $data) {
            self::add($sliderId, $data);
            LsSliders::update($sliderId, $slider['name'], json_decode($data, true), $slider['slug']);
        }

        return true;
    }
}
