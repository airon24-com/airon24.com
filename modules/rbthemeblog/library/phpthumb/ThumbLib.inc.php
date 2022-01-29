<?php
/**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

define('THUMBLIB_BASE_PATH', dirname(__FILE__));
define('THUMBLIB_PLUGIN_PATH', THUMBLIB_BASE_PATH . '/thumb_plugins/');
define('DEFAULT_THUMBLIB_IMPLEMENTATION', 'gd');

require_once THUMBLIB_BASE_PATH . '/PhpThumb.inc.php';
require_once THUMBLIB_BASE_PATH . '/ThumbBase.inc.php';
require_once THUMBLIB_BASE_PATH . '/GdThumb.inc.php';

class PhpThumbFactory
{
    public static $defaultImplemenation = DEFAULT_THUMBLIB_IMPLEMENTATION;
    public static $pluginPath = THUMBLIB_PLUGIN_PATH;
    
    public static function create($filename = null, $options = array(), $isDataStream = false)
    {
        // map our implementation to their class names
        $implementationMap = array
        (
            'imagick'    => 'ImagickThumb',
            'gd'         => 'GdThumb'
        );
        
        // grab an instance of PhpThumb
        $pt = PhpThumb::getInstance();
        // load the plugins
        $pt->loadPlugins(self::$pluginPath);
        
        $toReturn = null;
        $implementation = self::$defaultImplemenation;
        // attempt to load the default implementation
        if ($pt->isValidImplementation(self::$defaultImplemenation)) {
            $imp = $implementationMap[self::$defaultImplemenation];
            $toReturn = new $imp($filename, $options, $isDataStream);
        } elseif ($pt->isValidImplementation('gd')) {
            $imp = $implementationMap['gd'];
            $implementation = 'gd';
            $toReturn = new $imp($filename, $options, $isDataStream);
        } else {
            throw new Exception('You must have either the GD or iMagick extension loaded to use this library');
        }
        
        $registry = $pt->getPluginRegistry($implementation);
        $toReturn->importPlugins($registry);
        
        return $toReturn;
    }
}
