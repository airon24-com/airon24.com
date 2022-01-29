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

require_once(_PS_MODULE_DIR_.'rbthemedream/lib/control/rb-control.php');

class RbMenu extends RbControl
{
	public $editMode = false;

	public function __construct()
    {
    	parent::__construct();
    	$this->context = Context::getContext();

    	if (isset($this->context->controller->controller_name) &&
    		$this->context->controller->controller_name == 'AdminRbthemedreamLive'
    	) {
            $this->editMode = true;
        }

    	$this->setControl();
    }

    public function setControl()
    {
    	$module = new Rbthemedream();

    	$this->addPresControl(array(
            'section_pswidget_options' => array(
                'label' => $module->l('Widget settings'),
                'type' => 'section',
            ),
            'menu' => array(
                'label' => $module->l('Menu'),
                'type' => 'select',
                'default' => 'all',
                'section' => 'section_pswidget_options',
                'options' => array(
                    'all' => $module->l('All'),
                    'horizontal' => $module->l('Horizontal'),
                    'vertical' => $module->l('Vertical'),
                ),
            ),
            'cart' => array(
                'label' => $module->l('Cart in Menu'),
                'type' => 'select',
                'default' => '0',
                'section' => 'section_pswidget_options',
                'options' => array(
                    '0' => $module->l('No'),
                    '1' => $module->l('Yes'),
                ),
            ),
        ));
    }

    public function getDataMenu()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Menu',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('prestashop'),
    		'keywords' => '',
    		'icon' => 'menu'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
        if (Tools::getIsset('controller') &&
            Tools::getValue('controller') == 'index' ||
            Tools::getValue('controller') == 'AdminRbthemedreamLive' ||
            Tools::getValue('controller') == 'live'
        ) {
            $optionsSource = $this->getWidgetValues($instance);
            $module = Module::getInstanceByName('rbthememenu');

            if (isset($optionsSource['menu']) && $optionsSource['menu'] != '') {
                $module->type_menu = $optionsSource['menu'];
            }

            if (isset($optionsSource['cart']) && $optionsSource['cart'] != '') {
                $module->cart_menu = $optionsSource['cart'];
            }

            return $module->displayMenuFrontend();
        } else {
            return;
        }
    }
}
