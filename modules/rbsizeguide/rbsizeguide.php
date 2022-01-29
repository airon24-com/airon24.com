<?php
/**
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_ . 'rbsizeguide/classes/RbsizeguideList.php';

class Rbsizeguide extends Module
{
    protected $config_form = false;
    const RB_WIDTH = 618;
    const RB_HEIGHT = 924;

    public function __construct()
    {
        $this->name = 'rbsizeguide';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'R_B';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Rb Size Guide');
        $this->description = $this->l('This is great module for customer select product.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        $res = true;
        $class = 'Admin'.Tools::ucfirst($this->name).'Management';
        $id_parent = Tab::getIdFromClassName('IMPROVE');
        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = $id_parent;
        $langs = Language::getLanguages(false);
        Configuration::updateValue('RBSIZEGUIDE_GUIDE_ACTIVE', 1);
        Configuration::updateValue('RBSIZEGUIDE_GUIDE_IMG', 1);
        Configuration::updateValue('RBSIZEGUIDE_GUIDE_DEFAULT', 1);
        $rb_text = array();

        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('Rb Size Guize');
            $rb_text[$l['id_lang']] = '<table class="table table-sizegudie" style="height:36px;" width="1215"><tbody><tr><td style="text-align:left;">CLOTHES</td></tr></tbody></table><p></p><table class="table table-sizegudie" style="height:157px;" width="1217"><thead><tr><th>MEASURE</th><th>XS/34</th><th>S/36</th><th>M/38-40</th><th>L/40-42</th></tr></thead><tbody><tr class="background-odd"><td>UK</td><td>6</td><td>8</td><td>10</td><td>12</td></tr><tr><td>USA</td><td>4</td><td>6</td><td>8</td><td>10</td></tr><tr class="background-odd"><td>FRA</td><td>36</td><td>38</td><td>40</td><td>42</td></tr><tr><td>Waist (cm)</td><td>64</td><td>68</td><td>72</td><td>76</td></tr><tr class="background-odd"><td>Chest (cm)</td><td>81</td><td>85</td><td>89</td><td>93</td></tr><tr><td>Seat (cm)</td><td>89</td><td>93</td><td>97</td><td>101</td></tr><tr class="background-odd"><td>Inseam (cm)</td><td>81</td><td>82</td><td>83</td><td>84</td></tr></tbody></table>';
        }

        Configuration::updateValue('RBSIZEGUIDE_SIZE_GUIDE', $rb_text, true);

        $tab1->add(true, false);

        Db::getInstance()->execute(
            'UPDATE `'._DB_PREFIX_.'tab`
            SET `icon` = "show_chart"
            WHERE `id_tab` = "'.(int)$tab1->id.'"'
        );

        $this->installModuleTab('Setting', 'setting', 'AdminRbSizeGuideManagement');
        $this->installModuleTab('List', 'list', 'AdminRbSizeGuideManagement');

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() && $this->rbRegisterHook();
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

        if ($class_sfx == 'live') {
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

    public function uninstall()
    {
        $this->uninstallModuleTab('management');
        $this->uninstallModuleTab('setting');
        $this->uninstallModuleTab('list');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall() ;
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

    public function rbRegisterHook()
    {
        $this->registerHook('header');
        $this->registerHook('displayBeforeBodyClosingTag');
        $this->registerHook('displayProductAdditionalInfo');

        return true;
    }

    public function getContent()
    {
        $output = '';
        $errors = array();

        if (((bool)Tools::isSubmit('submitRbsizeguideModule')) == true) {
            if (isset($errors) && count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                $this->postProcess();

                $output = $this->displayConfirmation(
                    $this->trans(
                        'The settings have been updated.',
                        array(),
                        'Admin.Notifications.Success'
                    )
                );
            }
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        return $output.$this->renderForm();
    }

    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRbsizeguideModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    protected function getConfigForm()
    {
        $switch = array(
            array(
                'id' => 'active_on',
                'value' => '1',
                'label' => $this->l('Yes')
            ),
            array(
                'id' => 'active_off',
                'value' => '0',
                'label' => $this->l('No')
            )
        );

        $url_img = '';

        if (file_exists(dirname(__FILE__).'/views/img/img.jpg')) {
            $url_img = $this->_path."/views/img/img.jpg";
        }

        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Active'),
                        'name' => 'RBSIZEGUIDE_GUIDE_ACTIVE',
                        'is_bool' => true,
                        'desc' => $this->l('Active'),
                        'values' => $switch,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Guide Default'),
                        'name' => 'RBSIZEGUIDE_GUIDE_DEFAULT',
                        'is_bool' => true,
                        'desc' => $this->l('Guide Default'),
                        'values' => $switch,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->l('Size Guide'),
                        'name' => 'RBSIZEGUIDE_SIZE_GUIDE',
                        'autoload_rte' => true,
                        'lang' => true,
                        'cols' => 60,
                        'rows' => 30,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Guide Image'),
                        'name' => 'RBSIZEGUIDE_GUIDE_IMG',
                        'is_bool' => true,
                        'desc' => $this->l('Use Guide Image'),
                        'values' => $switch,
                    ),
                    array(
                        'label' => $this->l('Image'),
                        'col' => 6,
                        'type' => 'file',
                        'name' => 'img',
                        'thumb' => $url_img ? $url_img : '',
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    protected function getConfigFormValues()
    {
        $rb_text = array();

        foreach (Language::getLanguages(false) as $lang) {
            $rb_text[$lang['id_lang']] = Configuration::get('RBSIZEGUIDE_SIZE_GUIDE', $lang['id_lang']);
        }

        return array(
            'RBSIZEGUIDE_GUIDE_ACTIVE' => Configuration::get('RBSIZEGUIDE_GUIDE_ACTIVE'),
            'RBSIZEGUIDE_GUIDE_IMG' => Configuration::get('RBSIZEGUIDE_GUIDE_IMG'),
            'RBSIZEGUIDE_GUIDE_DEFAULT' => Configuration::get('RBSIZEGUIDE_GUIDE_DEFAULT'),
            'RBSIZEGUIDE_SIZE_GUIDE' => $rb_text,
        );
    }

    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            if ($key == 'RBSIZEGUIDE_SIZE_GUIDE') {
                $rb_text = array();
                
                foreach (Language::getLanguages(false) as $lang) {
                    $rb_text[$lang['id_lang']] = Tools::getValue('RBSIZEGUIDE_SIZE_GUIDE_' . $lang['id_lang']);
                }

                Configuration::updateValue($key, $rb_text, true);
            } else {
                Configuration::updateValue($key, Tools::getValue($key));
            }
        }

        if (isset($_FILES['img']) &&
            isset($_FILES['img']['tmp_name']) &&
            !empty($_FILES['img']['tmp_name'])
        ) {
            $img = dirname(__FILE__).'/views/img/img.jpg';

            if (file_exists($img)) {
                unlink($img);
            }

            if ($error = ImageManager::validateUpload($_FILES['img'])) {
                Tools::displayError($error);
            } elseif (!($tmp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS')) ||
                !move_uploaded_file($_FILES['img']['tmp_name'], $tmp_name)
            ) {
                return false;
            } elseif (!ImageManager::resize($tmp_name, $img, self::RB_WIDTH, self::RB_HEIGHT)) {
                Tools::displayError(($this->l('An error occurred while attempting to upload the image')));
            }

            if (isset($tmp_name)) {
                unlink($tmp_name);
            }
        }
    }

    public function hookHeader()
    {
        if (Configuration::get('RBSIZEGUIDE_GUIDE_ACTIVE') == 1 && Tools::getValue('controller') == 'product') {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        }
    }

    public function hookdisplayBeforeBodyClosingTag($params)
    {
        if (Configuration::get('RBSIZEGUIDE_GUIDE_ACTIVE') != 1 || Tools::getValue('controller') != 'product') {
            return;
        }

        $img = dirname(__FILE__).'/views/img/img.jpg';
        $obj_list = new RbsizeguideList();
        $lists = $obj_list->getSizeListActive();

        $this->context->smarty->assign(array(
            'show_img' => Configuration::get('RBSIZEGUIDE_GUIDE_IMG'),
            'url_img' => (file_exists($img)) ? $this->context->shop->getBaseURL(true, true)
            . 'modules/rbsizeguide/views/img/img.jpg' : '',
            'show_default' => Configuration::get('RBSIZEGUIDE_GUIDE_DEFAULT'),
            'content_default' => Configuration::get('RBSIZEGUIDE_SIZE_GUIDE', $this->context->language->id),
            'lists' => $lists,
        ));

        return $this->display(__FILE__, 'views/templates/hook/modal.tpl');
    }

    public function hookdisplayProductAdditionalInfo($params)
    {
        if (Configuration::get('RBSIZEGUIDE_GUIDE_ACTIVE') != 1 || Tools::getValue('controller') != 'product') {
            return;
        }

        return $this->display(__FILE__, 'views/templates/hook/button.tpl');
    }
}
