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

class RbUserRating extends RbControl
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
            'section_user_rating',
            array(
                'label' => $this->module->l('User Rating'),
                'type' => 'section',
            )
        );

        for ($i = 5; $i > 0 ; $i--) { 
            $this->addControl(
                'star_' . $i,
                array(
                    'label' => $this->module->l($i . ' star'),
                    'type' => 'number',
                    'min' => 0,
                    'default' => 0,
                    'section' => 'section_user_rating',
                )
            );

            $this->addControl(
                'star_color_' . $i,
                array(
                    'label' => $this->module->l($i . ' star color'),
                    'type' => 'color',
                    'section' => 'section_user_rating',
                )
            );
        }
    }

    public function getDataUserRating()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'User Rating',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'user-rating'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {   
        $context = Context::getContext();
        $star_5 = $instance['star_5'] != '' ? $instance['star_5'] : 0;
        $star_4 = $instance['star_4'] != '' ? $instance['star_4'] : 0;
        $star_3 = $instance['star_3'] != '' ? $instance['star_3'] : 0;
        $star_2 = $instance['star_2'] != '' ? $instance['star_2'] : 0;
        $star_1 = $instance['star_1'] != '' ? $instance['star_1'] : 0;
        $rb_total = $star_5 + $star_4 + $star_3 + $star_2 + $star_1;
        $rb_medium = ($star_5 * 5 + $star_4 * 4 + $star_3 * 3 + $star_2 * 2 + $star_1) / $rb_total;
        $rb_medium = round($rb_medium, 1);

        $context->smarty->assign(array(
            'instance' => $instance,
            'star_5' => $star_5,
            'star_4' => $star_4,
            'star_3' => $star_3,
            'star_2' => $star_2,
            'star_1' => $star_1,
            'rb_medium' => $rb_medium,
            'rb_total' => $rb_total,
        ));

        return $this->module->fetch('module:rbthemedream/views/templates/widget/rb-user-rating.tpl');
    }
}