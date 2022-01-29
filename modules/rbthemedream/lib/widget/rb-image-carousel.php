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

class RbImageCarousel extends RbControl
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
				'label' => $module->l('Images Carousel'),
			)
		);

    	$this->addControl(
			'section_image_carousel',
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
                'section' => 'section_image_carousel',
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
                    array(
                        'name' => 'img_description',
                        'label' => $module->l('Image Description'),
                        'type' => 'textarea',
                        'label_block' => true,
                    ),
                    array(
                        'name' => 'link',
                        'label' => $module->l('Link'),
                        'type' => 'url',
                        'label_block' => true,
                        'placeholder' => 'https://www.youtube.com/watch?v=yikCzp_OB50',
                    ),
                ),
                'title_field' => 'text',
            )
        );

		$this->addControl(
			'view',
			array(
				'label' => $module->l('View'),
				'type' => 'hidden',
				'default' => 'traditional',
				'section' => 'section_image_carousel',
			)
		);

		$this->addControl(
			'section_additional_options',
			array(
				'label' => $module->l('Carousel settings'),
				'type' => 'section',
			)
		);

		$slides_to_show = range(1, 10);
		$slides_to_show = array_combine($slides_to_show, $slides_to_show);

		$this->addControl(
			'slides_to_show',
			array(
				'label' => $module->l('Show per line'),
				'type' => 'select',
				'default' => '3',
				'section' => 'section_title',
				'options' => $slides_to_show,
			)
		);

		$this->addControl(
			'slides_to_show_tablet',
			array(
				'label' => $module->l('Show per line tablet'),
				'type' => 'select',
				'default' => '3',
				'section' => 'section_title',
				'options' => $slides_to_show,
			)
		);

		$this->addControl(
			'slides_to_show_phone',
			array(
				'label' => $module->l('Show per line phone'),
				'type' => 'select',
				'default' => '3',
				'section' => 'section_title',
				'options' => $slides_to_show,
			)
		);

		$this->addControl(
			'slides_to_show_img',
			array(
				'label' => $module->l('Image On Row (992-4,768-3)'),
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
			'arrows_position',
			array(
				'label' => $module->l('Arrows Position'),
				'type' => 'select',
				'default' => 'inside',
				'section' => 'section_style_navigation',
				'tab' => 'style',
				'options' => array(
					'inside' => $module->l('Inside'),
					'outside' => $module->l('Outside'),
				),
				'condition' => array(
					'navigation' => array('arrows', 'both'),
				),
			)
		);

		$this->addControl(
			'dots_position',
			array(
				'label' => $module->l('Dots Position'),
				'type' => 'select',
				'default' => 'outside',
				'tab' => 'style',
				'section' => 'section_style_navigation',
				'options' => array(
					'outside' => $module->l('Outside'),
					'inside' => $module->l('Inside'),
				),
				'condition' => array(
					'navigation' => array('dots', 'both'),
				),
			)
		);

		$this->endControlsSection();
    }

    public function getDataImageCarousel()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Image Carousel',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('basic'),
    		'keywords' => '',
    		'icon' => 'image-carousel'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
    	if (empty($instance['images_list']))
			return;

		$slides = array();
		$lazy = 'data-lazy';
		$is_slideshow = '1' === $instance['slides_to_show'];

		foreach ($instance['images_list'] as $item) {
			$image_url = $this->displayImage($item['image']['url']);
			$image_html = '<img class="slick-slide-image" '.$lazy.'="' . Tools::safeOutput(RbControl::getImage($image_url)) . '"/>';
			$image_html .= '<div class="rb-image-loading"></div>';

            if (!empty($item['link']['url'])) {
                $target = isset($item['link']['is_external']) ? ' target="_blank" rel="noopener noreferrer"' : '';
                $image_html = '<a href="'.$item['link']['url'].'" '.$target.'>'.$image_html.'</a>';
            }

            if (isset($item['img_description']) && $item['img_description']!= '') {
				$image_html .= '<div>'.$item['img_description'].'</div>';
			}

			$slides[] = '<div><div class="slick-slide-inner">' . $image_html . '</div></div>';
		}

		if (empty($slides)) {
			return;
		}

		$show_dots = (in_array($instance['navigation'], array('dots', 'both')));
		$show_arrows = (in_array($instance['navigation'], array('arrows', 'both')));

		if (isset($instance['slides_to_show_img']) && $instance['slides_to_show_img'] != '') {
			$configs = explode(',', $instance['slides_to_show_img']);

			foreach ($configs as $config) {
				$config = explode('-', $config);

				$config_obj[] = array(
					'breakpoint' => abs($config[0]),
					'settings' => array(
						'slidesToShow' => abs(1),
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
			'slidesToScroll' => abs(1),
			'autoplaySpeed' => abs(intval($instance['autoplay_speed'])),
			'autoplay' => ('yes' === $instance['autoplay']),
			'infinite' => ('yes' === $instance['infinite']),
			'pauseOnHover' => ('yes' === $instance['pause_on_hover']),
			'arrows' => $show_arrows,
			'dots' => $show_dots,
		);

		$carousel_classes = array('rb-image-carousel');

		if ($show_arrows) {
			$carousel_classes[] = 'slick-arrows-' . $instance['arrows_position'];
		}

		if ($show_dots) {
			$carousel_classes[] = 'slick-dots-' . $instance['dots_position'];
		}

		$html = '<div class="rb-image-carousel-wrapper rb-slick-slider">';
		$html .= "<div class='".implode(' ', $carousel_classes)."' data-slider_options='".Tools::jsonEncode($slick_options)."'>";
		$html .= implode( '', $slides );
		$html .= '</div>';
		$html .= '</div>';

		return $html;
    }
} 
