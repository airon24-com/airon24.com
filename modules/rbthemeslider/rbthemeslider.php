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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Rbthemeslider extends Module
{
    public static $instance;
    protected $init = false;
    const INSTALL_SQL_FILE = '/sql/same.sql';

    public function __construct()
    {
        $this->name = 'rbthemeslider';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'R_B';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Rb Theme Slider');
        $this->description = $this->l('This is a great module create a slider Prestashop');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        self::$instance = $this;

        if (!empty($this->context->controller)) {
            $this->controllerClass = str_replace(
                'controller',
                '',
                Tools::strtolower(get_class($this->context->controller))
            );
        }
    }

    public function install()
    {
        $class = 'Admin'.Tools::ucfirst($this->name).Tools::ucfirst('Management');
        $id_parent = Tab::getIdFromClassName('IMPROVE');
        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = $id_parent;
        $langs = Language::getLanguages(false);

        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('Rb Theme Slider');
        }

        $tab1->add(true, false);

        Db::getInstance()->execute(
            'UPDATE `'._DB_PREFIX_.'tab`
            SET `icon` = "collections"
            WHERE `id_tab` = "'.(int)$tab1->id.'"'
        );

        $this->installModuleTab('Sliders', 'slider', 'AdminRbThemeSliderManagement');
        $this->installModuleTab('List Media', 'media', 'AdminRbThemeSliderManagement');
        $this->installModuleTab('Transition', 'transition', 'AdminRbThemeSliderManagement');
        $this->installModuleTab('Skin Css', 'skin', 'AdminRbThemeSliderManagement');
        $this->installModuleTab('Custom Css', 'style', 'AdminRbThemeSliderManagement');

        include(dirname(__FILE__).'/sql/install.php');
        $this->createDataSame();

        return parent::install() && $this->rbRegisterHook();
    }

    public function rbRegisterHook()
    {
        $this->registerHook('displayHeader');
        $this->registerHook('backOfficeHeader');

        return true;
    }

    public function createDataSame()
    {
        if (!file_exists(dirname(__FILE__) . self::INSTALL_SQL_FILE)) {
            return false;
        }

        if (!$sqls = Tools::file_get_contents(dirname(__FILE__) . self::INSTALL_SQL_FILE)) {
            return false;
        }

        $replace = array(
            'PREFIX' => _DB_PREFIX_,
            'ENGINE_DEFAULT' => _MYSQL_ENGINE_,
        );

        $sqls = strtr($sqls, $replace);
        $sqls = preg_split("/;\s*[\r\n]+/", $sqls);

        foreach ($sqls as &$sql) {
            if ($sql != '' && !Db::getInstance()->Execute(trim($sql))) {
                return false;
            }
        }
    }

    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');
        
        $this->uninstallModuleTab('management');
        $this->uninstallModuleTab('slider');
        $this->uninstallModuleTab('media');
        $this->uninstallModuleTab('transition');
        $this->uninstallModuleTab('skin');
        $this->uninstallModuleTab('style');

        return parent::uninstall();
    }

    private function installModuleTab($title, $class_sfx = '', $parent = '')
    {
        $class = 'Admin'.Tools::ucfirst($this->name).Tools::ucfirst($class_sfx);
        @copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'t/'.$class.'.gif');

        if ($parent == '') {
            $position = Tab::getCurrentTabId();
        } else {
            $position = Tab::getIdFromClassName($parent);
        }

        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = (int)$position;

        if ($class_sfx == 'media') {
            $tab1->id_parent = -1;
        } else {
            $tab1->id_parent = (int)$position;
        }

        $langs = Language::getLanguages(false);

        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $title;
        }

        $tab1->add(true, false);
    }

    private function uninstallModuleTab($class_sfx = '')
    {
        $tab_class = 'Admin'.Tools::ucfirst($this->name).Tools::ucfirst($class_sfx);
        $id_tab = Tab::getIdFromClassName($tab_class);

        if ($id_tab != 0) {
            $tab = new Tab($id_tab);
            $tab->delete();
            return true;
        }

        return false;
    }

    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminRbthemesliderSlider'));
    }

    public function generateSlider($id)
    {
        if (is_array($id)) {
            $id = empty($id[2]) ? $id[1] : $id[2];
        }

        require_once _PS_MODULE_DIR_.'rbthemeslider/helper.php';
        require_once _PS_MODULE_DIR_.'rbthemeslider/base/rbthemeslider.php';

        return RbShortcode::handleShortcode(array('id' => $id, 'filters' => ''));
    }

    protected function isOnPage(&$mod)
    {
        $pages = Tools::jsonDecode($mod['pages'], true);

        if ($pages['cat'] === 'all') {
            return true;
        }

        return isset($pages['index']);
    }

    protected function displaySliders($hook)
    {
        $content = '';

        $modules = Db::getInstance()->executeS(
            'SELECT * FROM '._DB_PREFIX_.'rbthemeslider_module
            WHERE hook = "'.pSQL($hook).'" ORDER BY position'
        );

        foreach ($modules as &$mod) {
            if ($this->isOnPage($mod)) {
                $content .= $this->generateSlider($mod['id_slider']);
            }
        }

        return $content;
    }

    public function __call($method, $args)
    {
        if (stripos($method, 'hookdisplay') === 0) {
            $hook = 'display'.Tools::substr($method, 11);
            return $this->displaySliders($hook);
        }
    }

    public function hookActionOutputHTMLBefore($params)
    {
        $this->filterShortcode($params['html']);
    }

    public function filterShortcode(&$content)
    {
        if (Tools::strpos($content, '[rbthemeslider id="') !== false) {
            require_once _PS_MODULE_DIR_.'rbthemeslider/helper.php';
            require_once _PS_MODULE_DIR_.'rbthemeslider/base/rbthemeslider.php';
            $content = preg_replace_callback(
                '~<p>\s*\[rbthemeslider id="(\w+)"\]\s*</p>|\[rbthemeslider id="(\w+)"\]~',
                array($this, 'generateSlider'),
                $content
            );
        }
        if (Tools::strpos($content, '[cs-navigate id="') !== false) {
            $content = preg_replace(
                '~\[cs-navigate id="(\w+)" action="(\w+)"\](.*?)\[/cs-navigate\]~',
                '<a class="rb-navigate" href="javascript:;" onclick="$(\'#rbthemeslider_$1\').rbthemeslider(parseInt(\'$2\') || \'$2\')">$3</a>',
                $content
            );
        }

        return $content;
    }

    public function hookDisplayHeader()
    {
        require_once _PS_MODULE_DIR_.'rbthemeslider/helper.php';
        require_once _PS_MODULE_DIR_.'rbthemeslider/base/rbthemeslider.php';

        rb_do_action('rb_enqueue_scripts');

        if (empty($this->controllerClass)) {
            $this->controllerClass = str_replace(
                'controller',
                '',
                Tools::strtolower(get_class($this->context->controller))
            );
        }

        return rb_meta_generator();
    }

    public function hookDisplayBackOfficeHeader()
    {
        return $this->display(__FILE__, 'views/templates/admin/header.tpl');
    }
}
