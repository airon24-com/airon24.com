<?php
/**
* 2007-2020 PrestaShop
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
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2020 PrestaShop SA
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*/

class PhpThumb
{
    protected static $_instance;
    protected $_registry;
    protected $_implementations;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    private function __construct()
    {
        $this->_registry        = array();
        $this->_implementations    = array('gd' => false, 'imagick' => false);
        
        $this->getImplementations();
    }
    
    private function getImplementations()
    {
        foreach ($this->_implementations as $extension => $loaded) {
            if ($loaded) {
                continue;
            }
            
            if (extension_loaded($extension)) {
                $this->_implementations[$extension] = true;
            }
        }
    }
    
    public function isValidImplementation($implementation)
    {
        if ($implementation == 'n/a') {
            return true;
        }
        
        if ($implementation == 'all') {
            foreach ($this->_implementations as $imp => $value) {
                if ($value == false) {
                    return false;
                }
            }
            
            return true;
        }
        
        if (array_key_exists($implementation, $this->_implementations)) {
            return $this->_implementations[$implementation];
        }
        
        return false;
    }
    
    public function registerPlugin($pluginName, $implementation)
    {
        if (!array_key_exists($pluginName, $this->_registry) &&
            $this->isValidImplementation($implementation)
        ) {
            $this->_registry[$pluginName] = array('loaded' => false, 'implementation' => $implementation);
            return true;
        }
        
        return false;
    }
    
    public function loadPlugins($pluginPath)
    {
        // strip the trailing slash if present
        if (Tools::substr($pluginPath, Tools::strlen($pluginPath) - 1, 1) == '/') {
            $pluginPath = Tools::substr($pluginPath, 0, Tools::strlen($pluginPath) - 1);
        }
        
        if ($handle = opendir($pluginPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == '.' || $file == '..' || $file == '.svn') {
                    continue;
                }
                
                if ($file != 'index.php') {
                    include_once($pluginPath . '/' . $file);
                }
            }
        }
    }
    
    public function getPluginRegistry($implementation)
    {
        $returnArray = array();
        
        foreach ($this->_registry as $plugin => $meta) {
            if ($meta['implementation'] == 'n/a' || $meta['implementation'] == $implementation) {
                $returnArray[$plugin] = $meta;
            }
        }
        
        return $returnArray;
    }
}
