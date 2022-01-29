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

class RbButton extends RbControl
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
			'section_button',
			array(
				'label' => $module->l('Button'),
				'type' => 'section',
			)
		);

		$this->addControl(
			'button_type',
			array(
				'label' => $module->l('Type'),
				'type' => 'select',
				'default' => 'secondary',
				'section' => 'section_button',
				'options' => array(
					'secondary' => $module->l('Default'),
					'primary' => $module->l('Action'),
					'info' => $module->l('Info'),
					'success' => $module->l('Success'),
					'warning' => $module->l('Warning'),
					'danger' => $module->l('Danger'),
				),
			)
		);

		$this->addControl(
			'text',
			array(
				'label' => $module->l('Text'),
				'type' => 'text',
				'default' => $module->l('Click me'),
				'placeholder' => $module->l('Click me'),
				'section' => 'section_button',
			)
		);

		$this->addControl(
			'link',
			array(
				'label' => $module->l('Link'),
				'type' => 'url',
				'placeholder' => 'https://www.youtube.com/watch?v=Kuz0A-wvx5c',
				'default' => array(
					'url' => '#',
				),
				'section' => 'section_button',
			)
		);

		$this->addResponsiveControl(
			'align',
			array(
				'label' => $module->l('Alignment'),
				'type' => 'choose',
				'section' => 'section_button',
				'options' => array(
					'left'    => array(
						'title' => $module->l('Left'),
						'icon' => 'align-left',
					),
					'center' => array(
						'title' => $module->l('Center'),
						'icon' => 'align-center',
					),
					'right' => array(
						'title' => $module->l('Right'),
						'icon' => 'align-right',
					),
					'justify' => array(
						'title' => $module->l('Justified'),
						'icon' => 'align-justify',
					),
				),
				'prefix_class' => 'rb%s-align-',
				'default' => '',
			)
		);

		$this->addControl(
			'size',
			array(
				'label' => $module->l('Size'),
				'type' => 'select',
				'default' => 'medium',
				'options' => array(
					'small' => $module->l('Small'),
					'medium' => $module->l('Medium'),
					'large' => $module->l('Large'),
					'xl' => $module->l('XL'),
					'xxl' => $module->l('XXL'),
				),
				'section' => 'section_button',
			)
		);

		$this->addControl(
			'view',
			array(
				'label' => $module->l('View'),
				'type' => 'select',
				'default' => 'traditional',
				'section' => 'section_button',
				'options' => array(
					'traditional' => $module->l('Default'),
					'block' => $module->l('Block'),
				),
			)
		);

		$this->addControl(
			'icon',
			array(
				'label' => $module->l('Icon'),
				'type' => 'icon',
				'label_block' => true,
				'default' => '',
				'section' => 'section_button',
			)
		);

		$this->addControl(
			'icon_align',
			array(
				'label' => $module->l('Icon Position'),
				'type' => 'select',
				'default' => 'left',
				'options' => array(
					'left' => $module->l('Before'),
					'right' => $module->l('After'),
				),
				'condition' => array(
					'icon!' => '',
				),
				'section' => 'section_button',
			)
		);
    }

    public function getDataButton()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Button',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('basic'),
    		'keywords' => '',
    		'icon' => 'button'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
    	$this->addRenderAttribute(
    		'wrapper',
    		'class',
    		'rb-button-wrapper'
    	);

		if (!empty($instance['link']['url'])) {
			$this->addRenderAttribute('button', 'href', $instance['link']['url']);
			$this->addRenderAttribute('button', 'class', 'rb-button-link');

			if (!empty($instance['link']['is_external'])) {
				$this->addRenderAttribute('button', 'target', '_blank');
				$this->addRenderAttribute('button', 'rel', 'noopener noreferrer');
			}
		}

		$this->addRenderAttribute('button', 'class', 'rb-button');
		$this->addRenderAttribute('button', 'class', 'btn');

		if (!empty($instance['size'])) {
			$this->addRenderAttribute('button', 'class', 'rb-size-' . $instance['size']);
		}

		if (!empty( $instance['button_type'])) {
			$this->addRenderAttribute('button', 'class', 'btn-' . $instance['button_type']);
		}

		if (!empty( $instance['view'])) {
			$this->addRenderAttribute( 'button', 'class', 'btn-' . $instance['view']);
		}

		$this->addRenderAttribute('content-wrapper', 'class', 'rb-button-content-wrapper');


		if (!empty( $instance['icon']))  {
			$this->addRenderAttribute('icon-align', 'class', 'rb-align-icon-' . $instance['icon_align']);
			$this->addRenderAttribute('icon-align', 'class', 'rb-button-icon');
		}

		$context = Context::getContext();
        $module = new Rbthemedream();

        $context->smarty->assign(array(
            'instance' => $instance,
            'rb_wrapper' => $this->getRenderAttributeString('wrapper'),
            'rb_button' => $this->getRenderAttributeString('button'),
            'rb_content_wrapper' => $this->getRenderAttributeString('content-wrapper'),
            'rb_icon_align' => $this->getRenderAttributeString('icon-align'),
        ));

        return $module->fetch('module:rbthemedream/views/templates/widget/rb-button.tpl');
    }
}
