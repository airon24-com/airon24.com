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

class RbTestimonial extends RbControl
{
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
                'label' => $module->l('Testimonial'),
            )
        );

        $this->addControl(
            'testimonials_list',
            array(
                'label' => '',
                'type' => 'repeater',
                'default' => array(),
                'section' => 'section_testimonial',
                'fields' => array(
                    array(
                        'name' => 'name',
                        'label' => $module->l('Name'),
                        'type' => 'text',
                        'default' => 'Paul Pogba',
                    ),
                    array(
                        'name' => 'job',
                        'label' => $module->l('Job'),
                        'type' => 'text',
                        'default' => 'Designer',
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
                    array(
                        'label' => $module->l('Content'),
                        'type' => 'textarea',
                        'rows' => '10',
                        'name' => 'content',
                        'default' => 'Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit.',
                    )
                ),
                'title_field' => 'name',
            )
        );

        $this->addControl(
            'section_additional_options',
            array(
                'label' => $module->l('Settings'),
                'type' => 'section',
            )
        );

        $slides_to_show = range(1, 10);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $this->addControl(
            'slides_to_show',
            array(
                'label' => $module->l('Slides to Show'),
                'type' => 'select',
                'default' => '3',
                'section' => 'section_additional_options',
                'options' => $slides_to_show,
            )
        );

        $this->addControl(
            'slides_to_show_tablet',
            array(
                'label' => $module->l('Slides to show tablet'),
                'type' => 'select',
                'default' => '3',
                'section' => 'section_additional_options',
                'options' => $slides_to_show,
            )
        );

        $this->addControl(
            'slides_to_show_phone',
            array(
                'label' => $module->l('Slides to show phone'),
                'type' => 'select',
                'default' => '3',
                'section' => 'section_additional_options',
                'options' => $slides_to_show,
            )
        );

        $this->addControl(
            'slides_to_show_item',
            array(
                'label' => $module->l('Item On Row (992-4,768-3)'),
                'type' => 'text',
                'section' => 'section_title',
            )
        );

        $this->addControl(
            'navigation',
            array(
                'label' => $module->l('Navigation'),
                'type' => 'select',
                'default' => 'both',
                'section' => 'section_additional_options',
                'options' => array(
                    'both' => $module->l('Arrows and Dots'),
                    'arrows' => $module->l('Arrows'),
                    'dots' => $module->l('Dots'),
                    'none' => $module->l('None'),
                ),
            )
        );

        $this->addControl(
            'pause_on_hover',
            array(
                'label' => $module->l('Pause on Hover'),
                'type' => 'select',
                'default' => 'yes',
                'section' => 'section_additional_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            )
        );

        $this->addControl(
            'autoplay',
            array(
                'label' => $module->l('Autoplay'),
                'type' => 'select',
                'default' => 'yes',
                'section' => 'section_additional_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            )
        );

        $this->addControl(
            'autoplay_speed',
            array(
                'label' => $module->l('Autoplay Speed'),
                'type' => 'number',
                'default' => 5000,
                'section' => 'section_additional_options',
            )
        );

        $this->addControl(
            'infinite',
            array(
                'label' => $module->l('Infinite Loop'),
                'type' => 'select',
                'default' => 'yes',
                'section' => 'section_additional_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            )
        );

        $this->addControl(
            'effect',
            array(
                'label' => $module->l('Effect'),
                'type' => 'select',
                'default' => 'slide',
                'section' => 'section_additional_options',
                'options' => array(
                    'slide' => $module->l('Slide'),
                    'fade' => $module->l('Fade'),
                ),
                'condition' => array(
                    'slides_to_show' => '1',
                ),
            )
        );

        $this->endControlsSection();
    }

    public function getDataTestimonial()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Testimonial',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'testimonial'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        if (empty($instance['testimonials_list'])) {
            return;
        }

        $show_dots = (in_array($instance['navigation'], array('dots', 'both')));
        $show_arrows = (in_array($instance['navigation'], array('arrows', 'both')));

        if (isset($instance['slides_to_show_item']) && $instance['slides_to_show_item'] != '') {
            $configs = explode(',', $instance['slides_to_show_item']);

            foreach ($configs as $config) {
                $config = explode('-', $config);

                $config_obj[] = array(
                    'breakpoint' => abs($config[0]),
                    'settings' => array(
                        'slidesToShow' => isset($config[1]) ? abs($config[1]) : abs(1),
                        'slidesToScroll' => abs(1),
                    )
                );
            }
        } else {
            $config_obj = array(
                array(
                    'breakpoint' => 992,
                    'settings' => array(
                        'slidesToShow' => abs($instance['slides_to_show_tablet']),
                        'slidesToScroll' => abs(1),
                    ),
                ),
                array(
                    'breakpoint' => 576,
                    'settings' => array(
                        'slidesToShow' => abs($instance['slides_to_show_phone']),
                        'slidesToScroll' => abs(1),
                    ),
                ),
            );
        }

        $slick_options = array(
            'responsive' => $config_obj,
            'slidesToShow' => abs(intval($instance['slides_to_show'])),
            'slidesToScroll' => abs(2),
            'autoplaySpeed' => abs(intval($instance['autoplay_speed'])),
            'autoplay' => ('yes' === $instance['autoplay']),
            'infinite' => ('yes' === $instance['infinite']),
            'pauseOnHover' => ('yes' === $instance['pause_on_hover']),
            'arrows' => $show_arrows,
            'dots' => $show_dots,
        );

        $context = Context::getContext();
        $module = new Rbthemedream();

        $context->smarty->assign(array(
            'testimonials_lists' => isset($instance['testimonials_list']) && !empty($instance['testimonials_list'])
            ? $instance['testimonials_list'] : array(),
            'slick_options' => Tools::jsonEncode($slick_options),
        ));

        return $module->fetch('module:rbthemedream/views/templates/widget/rb-testimonial.tpl');
    }
}
