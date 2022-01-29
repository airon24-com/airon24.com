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

class RbImage360 extends RbControl
{
    public $img_width_df = 1000;
    public $img_height_df = 597;

    public function __construct()
    {
        parent::__construct();
        $this->setControl();
    }

    public function setControl()
    {
        $module = new Rbthemedream();

        $this->startControlsSection(
            'section_title',
            array(
                'label' => $module->l('Images 360'),
            )
        );

        $this->addControl(
            'section_image_360',
            array(
                'label' => $module->l('Images list'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'images_list',
            array(
                'label' => '',
                'type' => 'repeater',
                'default' => array(),
                'section' => 'section_image_360',
                'fields' => array(
                    array(
                        'name' => 'text',
                        'label' => $module->l('Image alt'),
                        'type' => 'text',
                        'label_block' => true,
                        'placeholder' => $module->l('Image alt'),
                        'default' => $module->l('Image alt'),
                    ),
                    array(
                        'name' => 'image',
                        'label' => $module->l('Choose Image'),
                        'type' => 'media',
                        'placeholder' => $module->l('Image'),
                        'label_block' => true,
                        'default' => array(
                            'url' => _MODULE_DIR_ . 'rbthemedream/views/img/img.jpg',
                        ),
                    ),
                ),
                'title_field' => 'text',
            )
        );

        $this->addControl(
            'image_size',
            array(
                'label' => $module->l('Image width'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'image_width',
            array(
                'label' => $module->l('Image width'),
                'text' => 'text',
                'placeholder' => $module->l('Enter image width'),
                'section' => 'image_size',
                'default' => $this->img_width_df,
            )
        );

        $this->addControl(
            'image_height',
            array(
                'label' => $module->l('Image height'),
                'text' => 'text',
                'placeholder' => $module->l('Enter image height'),
                'section' => 'image_size',
                'default' => $this->img_height_df,
            )
        );

        $this->addControl(
            'navigation',
            array(
                'label' => $module->l('Navigation'),
                'type' => 'select',
                'default' => 'true',
                'section' => 'image_size',
                'options' => array(
                    'true' => $module->l('Yes'),
                    'false' => $module->l('No'),
                ),
            )
        );

        $this->addControl(
            'disableSpin',
            array(
                'label' => $module->l('DisableSpin'),
                'type' => 'select',
                'default' => 'false',
                'section' => 'image_size',
                'options' => array(
                    'true' => $module->l('Yes'),
                    'false' => $module->l('No'),
                ),
            )
        );

        $this->endControlsSection();
    }

    public function getDataImage360()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Image 360',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'image-360'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        if (isset($instance['images_list']) && !empty($instance['images_list'])) {
            $img_arr = array();

            $config_img = array(
                'image_width' =>  $instance['image_width'] != '' ? $instance['image_width'] : $this->img_width_df,
                'image_height' =>  $instance['image_height'] ? $instance['image_height'] : $this->img_height_df,
                'image_navigation' =>  $instance['navigation'],
                'image_disableSpin' =>  $instance['disableSpin'],
            );

            foreach($instance['images_list'] as $arr_img) {
                $img_arr[] = $this->displayImage($arr_img['image']['url']);
            }

            $module = new Rbthemedream();

            $this->context->smarty->assign(array(
                'config_img' => "data-config='".Tools::jsonEncode($config_img)."'",
                'img_arr' => "data-image='".Tools::jsonEncode($img_arr)."'",
            ));

            return $module->fetch('module:rbthemedream/views/templates/widget/rb-img-360.tpl');
        }

        return;
    }
} 
