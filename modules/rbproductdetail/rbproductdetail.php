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

require_once(_PS_MODULE_DIR_ . 'rbproductdetail/RbProductExtend.php');

class Rbproductdetail extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'rbproductdetail';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'R_B';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Rb Product Detail');
        $this->description = $this->l('This is great module for product detail');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('RBPRODUCTDETAIL_LIVE_MODE', 1);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayFooterDetail') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()
    {
        Configuration::deleteByName('RBPRODUCTDETAIL_LIVE_MODE');

        return parent::uninstall();
    }

    public function getContent()
    {
        $output = '';
        $errors = array();

        if (((bool)Tools::isSubmit('submitRbproductdetailModule')) == true) {
            $this->postProcess();

            $output = $this->displayConfirmation(
                $this->trans(
                    'The settings have been updated.',
                    array(),
                    'Admin.Notifications.Success'
                )
            );
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRbproductdetailModule';
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
                        'name' => 'RBPRODUCTDETAIL_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
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
        return array(
            'RBPRODUCTDETAIL_LIVE_MODE' => Configuration::get('RBPRODUCTDETAIL_LIVE_MODE', true),
        );
    }

    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookdisplayFooterDetail()
    {
        if (Configuration::get('RBPRODUCTDETAIL_LIVE_MODE') != 1 || Tools::getValue('controller') != 'product') {
            return;
        }

        $obj_product = new RbProductExtend();
        $id_product = Tools::getValue('id_product');
        $product = array();

        if (Tools::getIsset('id_product_attribute') && Tools::getValue('id_product_attribute') != 0) {
            $product = $obj_product->getTemplateVarProductCombi($id_product, Tools::getValue('id_product_attribute'));
        } else {
            $product = $obj_product->getTemplateVarProduct1($id_product);
        }

        $this->smarty->assign(array(
            'product' => $product,
        ));

        return $this->display(__FILE__, 'views/templates/hook/product.tpl');
    }
}
