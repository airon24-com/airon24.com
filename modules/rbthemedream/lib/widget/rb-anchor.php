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

require_once(_PS_MODULE_DIR_.'rbthemedream/lib/control/rb-control.php');

class RbAnChor extends RbControl
{
    public $module;

    public function __construct()
    {
        parent::__construct();

        $this->module = new Rbthemedream();
        $this->setControl();
    }

    public function setControl()
    {
        $this->addControl(
            'section_anchor',
            array(
                'label' => $this->module->l('Anchor'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'anchor_id',
            array(
                'label' => $this->module->l('The ID of Menu Anchor'),
                'type' => 'text',
                'placeholder' => $this->module->l('The ID of Menu Anchor'),
                'label_block' => true,
                'section' => 'section_anchor',
                'description' => $this->module->l('This ID will be the CSS ID you will have to use in your own page, Without'),
            )
        );
    }

    public function getDataAnchor()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Anchor',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'anchor'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {   
        if (isset($instance['anchor_id']) && $instance['anchor_id'] != '') {
            $this->context->smarty->assign(array(
                'rb_anchor' => $instance,
            ));

            return $this->module->fetch('module:rbthemedream/views/templates/widget/rb-anchor.tpl');
        }

        return;
    }
}