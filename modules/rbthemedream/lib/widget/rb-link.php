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

class RbLink extends RbControl
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
            'section_image',
            array(
                'label' => $module->l('Image'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'caption',
            array(
                'label' => $module->l('Add class widget'),
                'type' => 'text',
                'default' => '',
                'placeholder' => $module->l('class-1 class-2 class-3'),
                'title' => $module->l('Input class widget here'),
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'section_icon',
            array(
                'label' => $module->l('List Item'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'icon_list',
            array(
                'label' => '',
                'type' => 'repeater',
                'default' => array(
                    array(
                        'text' => $module->l('List Item'),
                        'icon' => 'fa fa-check',
                        'type' => 'product',
                        'left' => 10,
                        'top' => 10,
                    ),
                ),
                'section' => 'section_icon',
                'fields' => array(
                    array(
                        'name' => 'title_link',
                        'label' => $module->l('Title'),
                        'type' => 'text',
                        'label_block' => true,
                        'placeholder' => $module->l('Title'),
                        'default' => $module->l('Title'),
                    ),
                    array(
                        'name' => 'url_link',
                        'label' => $module->l('Link'),
                        'type' => 'text',
                        'placeholder' => 'https://www.youtube.com/watch?v=SqkxCkL6hSU',
                        'default' => 'https://www.youtube.com/watch?v=SqkxCkL6hSU',
                        'label_block' => true,
                    ),
                ),
                'title_field' => 'title_link',
            )
        );
    }

    public function getDataLink()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Link',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'link'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        $links = array();

        if (isset($instance['icon_list']) && !empty($instance['icon_list'])) {
            $links = $instance['icon_list'];
            $module = new Rbthemedream();

            $this->context->smarty->assign(array(
                'links' => $links,
                'class_custom' => isset($instance['caption']) ? $instance['caption'] : '',
            ));

            return $module->fetch('module:rbthemedream/views/templates/widget/rb-link.tpl');
        }

        return;
    }
}