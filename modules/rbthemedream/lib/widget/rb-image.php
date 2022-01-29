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

class RbImage extends RbControl
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
            'image',
            array(
                'label' => $module->l('Choose Image'),
                'type' => 'media',
                'default' => array(
                    'url' => _MODULE_DIR_ . 'rbthemedream/views/img/img.jpg',
                ),
                'section' => 'section_image',
            )
        );

        $this->addResponsiveControl(
            'align',
            array(
                'label' => $module->l('Alignment'),
                'type' => 'choose',
                'options' => array(
                    'left' => array(
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
                ),
                'default' => 'center',
                'section' => 'section_image',
                'selectors' => array(
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->addControl(
            'caption',
            array(
                'label' => $module->l('Alt text'),
                'type' => 'text',
                'default' => '',
                'placeholder' => $module->l('Enter your Alt about the image'),
                'title' => $module->l('Input image Alt here'),
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'link_to',
            array(
                'label' => $module->l('Link to'),
                'type' => 'select',
                'default' => 'none',
                'section' => 'section_image',
                'options' => array(
                    'none' => $module->l('None'),
                    'file' => $module->l('Media File'),
                    'custom' => $module->l('Custom URL'),
                ),
            )
        );

        $this->addControl(
            'link',
            array(
                'label' => $module->l('Link to'),
                'type' => 'url',
                'placeholder' => $module->l('https://www.youtube.com/watch?v=Kuz0A-wvx5c'),
                'section' => 'section_image',
                'condition' => array(
                    'link_to' => 'custom',
                ),
                'show_label' => false,
            )
        );

        $this->addControl(
            'view',
            array(
                'label' => $module->l('View'),
                'type' => 'hidden',
                'default' => 'traditional',
                'section' => 'section_image',
            )
        );
    }

    public function getDataImage()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Image',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('basic'),
    		'keywords' => '',
    		'icon' => 'img'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
        if (empty($instance['image']['url'])) {
            return;
        }

        $instance['image']['url'] = $this->displayImage($instance['image']['url']);
        $has_caption = ! empty($instance['caption']);
        $image_html = '<div class="rb-image">';
        $image_class_html = '';

        $image_html .= sprintf(
            '<img src="%s" alt="%s"%s />',
            Tools::safeOutput(RbControl::getImage($instance['image']['url'])),
            Tools::safeOutput($instance['caption']),
            $image_class_html
        );

        $link = $this->getLinkUrl($instance);

        if ($link) {
            $target = '';

            if (!empty( $link['is_external'])) {
                $target = ' target="_blank" rel="noopener noreferrer"';
            }
            $image_html = sprintf('<a href="%s"%s>%s</a>', $link['url'], $target, $image_html);
        }

        $image_html .= '</div>';

        return $image_html;
    }

    public function getLinkUrl($instance)
    {
        if ('none' === $instance['link_to']) {
            return false;
        }

        if ('custom' === $instance['link_to']) {
            if (empty($instance['link']['url'])) {
                return false;
            }
            
            return $instance['link'];
        }

        return array(
            'url' => $instance['image']['url'],
        );
    }
}
