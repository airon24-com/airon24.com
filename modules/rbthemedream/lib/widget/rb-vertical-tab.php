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

class RbVerticalTabs extends RbControl
{
    public function __construct()
    {
        parent::__construct();
        $this->setControl();
    }

    public function setControl()
    {
        $module = new Rbthemedream();

        $this->addControl(
            'section_title',
            array(
                'label' => $module->l('Tabs'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'tabs',
            array(
                'label' => $module->l('Tabs Items'),
                'type' => 'repeater',
                'section' => 'section_title',
                'default' => array(
                    array(
                        'tab_title' => $module->l('Tab #1'),
                        'tab_content' => $module->l('This is tab content. Click edit button to change this text'),
                    ),
                    array(
                        'tab_title' => $module->l('Tab #2'),
                        'tab_content' => $module->l('This is tab content. Click edit button to change this text' ),
                    ),
                ),
                'fields' => array(
                    array(
                        'name' => 'tab_title',
                        'label' => $module->l('Title & Content'),
                        'type' => 'text',
                        'default' => $module->l('Tab Title'),
                        'placeholder' => $module->l('Tab Title'),
                        'label_block' => true,
                    ),
                    array(
                        'name' => 'tab_content',
                        'label' => $module->l('Content'),
                        'default' => $module->l('Tab Content'),
                        'placeholder' => $module->l('Tab Content'),
                        'type' => 'wysiwyg',
                        'show_label' => false,
                    ),
                ),
                'title_field' => 'tab_title',
            )
        );
    }

    public function getDataVerticalTab()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Vertical Tabs',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'vertical-tab'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        $context = Context::getContext();
        $module = new Rbthemedream();

        $context->smarty->assign(array(
            'instance' => $instance,
            'string_id' => Tools::substr(md5(mt_rand()), 0, 7),
        ));

        return $module->fetch('module:rbthemedream/views/templates/widget/rb-vertical-tab.tpl');
    }
}
