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

class RbSliders
{
    public static $results = array();
    public static $count = null;

    private function __construct()
    {
    }

    public static function count()
    {
        return self::$count;
    }



    /**
     * Find sliders with the provided filters
     *
     * @since 5.0.0
     * @access public
     * @param mixed $args Find any slider with the provided filters
     * @return mixed Array on success, false otherwise
     */
    public static function find($args = array())
    {

        // Find by slider ID
        if (is_numeric($args) && (int)$args == $args) {
            return self::_getById((int) $args);

        // Random slider
        } elseif ($args === 'random') {
            return self::_getRandom();

        // Find by slider slug
        } elseif (is_string($args)) {
            return self::_getBySlug($args);

        // Find by list of slider IDs
        } elseif (is_array($args) && isset($args[0]) && is_numeric($args[0])) {
            return self::_getByIds($args);

        // Find by query
        } else {
            // Defaults
            $defaults = array(
                'columns' => '*',
                'where' => '',
                'exclude' => array('removed'),
                'orderby' => 'date_c',
                'order' => 'DESC',
                'limit' => 10,
                'page' => 1,
                'data' => true
            );

            // Merge user data with defaults
            foreach ($defaults as $key => $val) {
                if (!isset($args[$key])) {
                    $args[$key] = $val;
                }
            }

            // Escape user data
            foreach ($args as $key => $val) {
                if ($key !== 'where') {
                    $args[$key] = rb_esc_sql($val);
                }
            }

            $columns = array('id', 'author', 'name', 'slug', 'data', 'date_c', 'date_m', 'flag_hidden', 'flag_deleted', 'schedule_start', 'schedule_end');

            $args['orderby'] = in_array($args['orderby'], $columns) ? $args['orderby'] : 'date_c';
            $args['order'] = ($args['order'] === 'DESC') ? 'DESC' : 'ASC';
            $args['limit'] = (int) $args['limit'];
            $args['page'] = (int) $args['page'];
            $args['data'] = (bool) $args['data'];

            // Exclude
            if (!empty($args['exclude'])) {
                $exclude = array();
                if (in_array('hidden', $args['exclude'])) {
                    $exclude[] = "flag_hidden = '0'";
                }

                if (in_array('removed', $args['exclude'])) {
                    $exclude[] = "flag_deleted = '0'";
                }

                $args['exclude'] = implode(' AND ', $exclude);
            }

            // Where
            $where = '';
            if (!empty($args['where']) && !empty($args['exclude'])) {
                $where = "WHERE ({$args['exclude']}) AND ({$args['where']}) ";
            } elseif (!empty($args['where'])) {
                $where = "WHERE {$args['where']} ";
            } elseif (!empty($args['exclude'])) {
                $where = "WHERE {$args['exclude']} ";
            }

            // Some adjustments
            $args['limit'] = ($args['limit'] * $args['page'] - $args['limit']).', '.$args['limit'];

            // Build the query
            $wpdb = $GLOBALS['rb_db'];
            $table = $wpdb->prefix.RB_DB_TABLE;
            $sliders = $wpdb->getResults("SELECT SQL_CALC_FOUND_ROWS {$args['columns']} FROM $table $where ORDER BY {$args['orderby']} {$args['order']} LIMIT {$args['limit']}", ARRAY_A);

            // Set counter
            $found = $wpdb->getCol("SELECT FOUND_ROWS()");
            self::$count = (int) $found[0];

            // Return original value on error
            if (!is_array($sliders)) {
                return $sliders;
            }

            // Parse slider data
            if ($args['data']) {
                foreach ($sliders as $key => $val) {
                    $sliders[$key]['data'] = Tools::jsonDecode($val['data'], true);
                }
            }

            // Return sliders
            return $sliders;
        }
    }



    /**
     * Add slider with the provided name and optional slider data
     *
     * @since 5.0.0
     * @access public
     * @param string $title The title of the slider to create
     * @param array $data The settings of the slider to create
     * @return int The slider database ID inserted
     */
    public static function add($title = 'Unnamed', $data = array(), $slug = '')
    {

        $wpdb = $GLOBALS['rb_db'];

        // Slider data
        $data = !empty($data) ? $data : array(
            'properties' => array(
                'createdWith' => RB_PLUGIN_VERSION,
                'sliderVersion' => RB_PLUGIN_VERSION,
                'title' => $title,
                'new' => true,
            ),
            'layers' => array(array()),
        );

        // Fix WP 4.2 issue with longer varchars
        // than the column length
        if (Tools::strlen($title) > 99) {
            $title = Tools::substr($title, 0, (99-Tools::strlen($title)));
        }

        // Insert slider, WPDB will escape data automatically
        $wpdb->insert($wpdb->prefix.RB_DB_TABLE, array(
            'author' => rb_get_current_user_id(),
            'name' => $title,
            'slug' => $slug,
            'data' => Tools::jsonEncode($data),
            'date_c' => time(),
            'date_m' => time()
        ), array(
            '%d', '%s', '%s', '%s', '%d', '%d'
        ));
        Db::getInstance()->insert('rbthemeslider_module', array('id_slider' => (int)$wpdb->insert_id));

        // Return insert database ID
        return $wpdb->insert_id;
    }



    /**
     * Updates sliders
     *
     * @since 5.2.0
     * @access public
     * @param int $id The database ID of the slider to be updated
     * @param string $title The new title of the slider
     * @param array $data The new settings of the slider
     * @return bool Returns true on success, false otherwise
     */
    public static function update($id = 0, $title = 'Unnamed', $data = array(), $slug = '')
    {

        $wpdb = $GLOBALS['rb_db'];

        // Slider data
        $data = !empty($data) ? $data : array(
            'properties' => array('title' => $title),
            'layers' => array(array()),
        );

        // Fix WP 4.2 issue with longer varchars
        // than the column length
        if (Tools::strlen($title) > 99) {
            $title = Tools::substr($title, 0, (99-Tools::strlen($title)));
        }

        // Status
        $status = 0;
        if (empty($data['properties']['status']) || $data['properties']['status'] === 'false') {
            $status = 1;
        }

        // Schedule
        $schedule = array('schedule_start' => 0, 'schedule_end' => 0);
        foreach ($schedule as $key => $val) {
            if (! empty($data['properties'][$key])) {
                if (is_numeric($data['properties'][$key])) {
                    $schedule[$key] = (int) $data['properties'][$key];
                } else {
                    $tz = date_default_timezone_get();
                    date_default_timezone_set(rb_get_option('timezone_string'));
                    $schedule[$key] = (int) strtotime($data['properties'][$key]);
                    date_default_timezone_set($tz);
                }
            }
        }

        // Insert slider, WPDB will escape data automatically
        $wpdb->update(
            $wpdb->prefix.RB_DB_TABLE,
            array(
                'name' => $title,
                'slug' => $slug,
                'data' => Tools::jsonEncode($data),
                'schedule_start' => $schedule['schedule_start'],
                'schedule_end' => $schedule['schedule_end'],
                'date_m' => time(),
                'flag_hidden' => $status
            ),
            array('id' => $id),
            array('%s', '%s', '%s', '%d', '%d', '%d', '%d')
        );

        // Return insert database ID
        return true;
    }


    /**
     * Marking a slider as removed without deleting it
     * with its database ID.
     *
     * @since 5.0.0
     * @access public
     * @param int $id The database ID if the slider to remove
     * @return bool Returns true on success, false otherwise
     */
    public static function remove($id = null)
    {

        // Check ID
        if (!is_int($id)) {
            return false;
        }

        // Remove
        $wpdb = $GLOBALS['rb_db'];
        $wpdb->update(
            $wpdb->prefix.RB_DB_TABLE,
            array('flag_deleted' => 1),
            array('id' => $id),
            '%d',
            '%d'
        );
        $db = Db::getInstance();
        $table = $wpdb->prefix.'rbthemeslider_module';
        $row = $db->getRow("SELECT COUNT(m.hook) AS count, s.hook FROM $table m, (SELECT hook FROM $table WHERE id_slider = $id) s WHERE m.id_shop > -1 AND s.hook = m.hook");
        if ($row && $row['hook'] && $row['count'] == 1) {
            RBSlider::$instance->unregisterHook($row['hook']);
        }
        $db->update('rbthemeslider_module', array('id_shop' => -1), 'id_slider = '.$id);

        return true;
    }


    /**
     * Delete a slider by its database ID
     *
     * @since 5.0.0
     * @access public
     * @param int $id The database ID if the slider to delete
     * @return bool Returns true on success, false otherwise
     */
    public static function delete($id = null)
    {

        // Check ID
        if (!is_int($id)) {
            return false;
        }

        // Delete
        $wpdb = $GLOBALS['rb_db'];
        $wpdb->delete($wpdb->prefix.RB_DB_TABLE, array('id' => $id), '%d');

        $db = Db::getInstance();
        $table = $wpdb->prefix.'rbthemeslider_module';
        $row = $db->getRow("SELECT COUNT(m.hook) AS count, s.hook FROM $table m, (SELECT hook FROM $table WHERE id_slider = $id) s WHERE m.id_shop > -1 AND s.hook = m.hook");
        if ($row && $row['hook'] && $row['count'] == 1) {
            RbSlider::$instance->unregisterHook($row['hook']);
        }
        Db::getInstance()->delete('rbthemeslider_module', 'id_slider = '.(int)$id);

        return true;
    }



    /**
     * Restore a slider marked as removed previously by its database ID.
     *
     * @since 5.0.0
     * @access public
     * @param int $id The database ID if the slider to restore
     * @return bool Returns true on success, false otherwise
     */
    public static function restore($id = null)
    {

        // Check ID
        if (!is_int($id)) {
            return false;
        }

        // Remove
        $wpdb = $GLOBALS['rb_db'];
        $wpdb->update(
            $wpdb->prefix.RB_DB_TABLE,
            array('flag_deleted' => 0),
            array('id' => $id),
            '%d',
            '%d'
        );
        $db = Db::getInstance();
        $table = $wpdb->prefix.'rbthemeslider_module';
        $row = $db->getRow("SELECT COUNT(m.hook) AS count, s.hook FROM $table m, (SELECT hook FROM $table WHERE id_slider = $id) s WHERE m.id_shop > -1 AND s.hook = m.hook");
        if ($row && $row['hook'] && $row['count'] == 0) {
            RbSlider::$instance->registerHook($row['hook']);
        }
        $db->update('rbthemeslider_module', array('id_shop' => 0), 'id_slider = '.$id);

        return true;
    }




    private static function _getById($id = null)
    {

        // Check ID
        if (!is_int($id)) {
            return false;
        }

        // Get Sliders
        $wpdb = $GLOBALS['rb_db'];
        $table = $wpdb->prefix.RB_DB_TABLE;
        $result = $wpdb->getRow("SELECT * FROM $table WHERE id = '$id' ORDER BY id DESC LIMIT 1", ARRAY_A);

        // Check return value
        if (!is_array($result)) {
            return false;
        }

        // Return result
        $result['data'] = Tools::jsonDecode($result['data'], true);
        return $result;
    }



    private static function _getByIds($ids = null)
    {

        // Check ID
        if (!is_array($ids)) {
            return false;
        }

        // DB stuff
        $wpdb = $GLOBALS['rb_db'];
        $table = $wpdb->prefix.RB_DB_TABLE;
        $limit = count($ids);

        // Collect IDs
        if (is_array($ids) && !empty($ids)) {
            $tmp = array();
            foreach ($ids as $id) {
                $tmp[] = 'id = \''.(int)$id.'\'';
            }
            $ids = implode(' OR ', $tmp);
            unset($tmp);
        }

        // Make the call
        $result = $wpdb->getResults("SELECT * FROM $table WHERE $ids ORDER BY id DESC LIMIT $limit", ARRAY_A);

        // Decode slider data
        if (is_array($result) && !empty($result)) {
            foreach ($result as $key => $slider) {
                $result[$key]['data'] = Tools::jsonDecode($slider['data'], true);
            }

            return $result;

        // Failed query
        } else {
            return false;
        }
    }

    private static function _getBySlug($slug)
    {
        if (empty($slug)) {
            return false;
        } else {
            $slug = rb_esc_sql($slug);
        }

        // Get DB stuff
        $wpdb = $GLOBALS['rb_db'];
        $table = $wpdb->prefix.RB_DB_TABLE;

        // Make the call
        $result = $wpdb->getRow("SELECT * FROM $table WHERE slug = '$slug' ORDER BY id DESC LIMIT 1", ARRAY_A);

        // Check return value
        if (!is_array($result)) {
            return false;
        }

        // Return result
        $result['data'] = Tools::jsonDecode($result['data'], true);
        return $result;
    }

    private static function _getRandom()
    {
        $wpdb = $GLOBALS['rb_db'];
        $table = $wpdb->prefix.RB_DB_TABLE;

        // Make the call
        $result = $wpdb->getRow("SELECT * FROM $table WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY RAND() LIMIT 1", ARRAY_A);

        // Check return value
        if (!is_array($result)) {
            return false;
        }

        $result['data'] = Tools::jsonDecode($result['data'], true);
        return $result;
    }
}
