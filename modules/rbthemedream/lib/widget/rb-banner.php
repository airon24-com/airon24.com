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

class RbBanner extends RbControl
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
                'label' => $module->l('Banner'),
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
            'above_title_text',
            array(
                'label' => $module->l('Subtitle'),
                'type' => 'text',
                'default' => $module->l('Above title'),
                'placeholder' => $module->l('Your subtitle'),
                'section' => 'section_image',
                'label_block' => true,
            )
        );

        $this->addControl(
            'title_text',
            array(
                'label' => $module->l('Title'),
                'type' => 'text',
                'default' => $module->l('This is the heading'),
                'placeholder' => $module->l('Your Title'),
                'section' => 'section_image',
                'label_block' => true,
            )
        );

        $this->addControl(
            'title_size',
            array(
                'label' => $module->l('Title HTML Tag'),
                'type' => 'select',
                'options' => array(
                    'h1' => $module->l('H1'),
                    'h2' => $module->l('H2'),
                    'h3' => $module->l('H3'),
                    'h4' => $module->l('H4'),
                    'h5' => $module->l('H5'),
                    'h6' => $module->l('H6'),
                    'div' => $module->l('div'),
                    'span' => $module->l('span'),
                    'p' => $module->l('p'),
                ),
                'default' => 'h4',
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'description_text',
            array(
                'label' => $module->l('Description'),
                'type' => 'textarea',
                'default' => $module->l('I am text block. Click edit button to change this text.'),
                'section' => 'section_image',
            )
        );
        $this->addControl(
            'button_text',
            array(
                'label' => $module->l('Button txt'),
                'type' => 'text',
                'default' => $module->l('Click'),
                'placeholder' => $module->l('View'),
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'button_icon',
            array(
                'label' => $module->l('Button icon'),
                'type' => 'icon',
                'label_block' => true,
                'default' => '',
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'button_icon_align',
            array(
                'label' => $module->l('Button icon Position'),
                'type' => 'select',
                'default' => 'left',
                'options' => array(
                    'left' => $module->l('Before'),
                    'right' => $module->l('After'),
                ),
                'condition' => array(
                    'button_icon!' => '',
                ),
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'button_icon_indent',
            array(
                'label' => $module->l('Button icon Spacing'),
                'type' => 'slider',
                'range' => array(
                    'px' => array(
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'button_icon!' => '',
                ),
                'selectors' => array(
                    '{{WRAPPER}} .rb-button .rb-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rb-button .rb-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                ),
                'section' => 'section_image',
            )
        );

        $this->addControl(
            'link',
            array(
                'label' => $module->l('Link to'),
                'type' => 'url',
                'placeholder' => $module->l('https://www.youtube.com/watch?v=Kuz0A-wvx5c'),
                'section' => 'section_image',
                'separator' => 'before',
            )
        );

        $this->addControl(
            'view',
            array(
                'label' => $module->l('View'),
                'type' => 'hidden',
                'default' => 'traditional',
                'section' => 'section_content',
            )
        );
    }

    public function getDataBanner()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Banner',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'banner'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        $instance['image']['url'] = $this->displayImage($instance['image']['url']);
        $has_content = !empty($instance['title_text']) || ! empty($instance['description_text']);

        if (!empty($instance['button_icon']))  {
            $this->addRenderAttribute(
                'button-icon-align',
                'class',
                'rb-align-icon-' . $instance['button_icon_align']
            );

            $this->addRenderAttribute('button-icon-align', 'class', 'rb-button-icon');
        }

        $html = '<div class="rb-dd-banner">';

        if (!empty($instance['link']['url'])) {
            $target = '';

            if (!empty($instance['link']['is_external'])) {
                $target = ' target="_blank" rel="noopener noreferrer"';
            }

            $html .= sprintf('<a href="%s"%s>', $instance['link']['url'], $target);
        }

        if (!empty($instance['image']['url'])) {
            $this->addRenderAttribute(
                'image',
                'src',
                RbControl::getImage($instance['image']['url'])
            );

            $this->addRenderAttribute(
                'image',
                'alt',
                Tools::safeOutput($instance['caption'])
            );

            $image_html = '<img ' . $this->getRenderAttributeString('image') . '>';
            $html .= '<figure class="rb-dd-banner-img"><span class="rb-dd-banner-overlay"></span>' . $image_html . '</figure>';
        }

        if ($has_content) {
            $html .= '<div class="rb-dd-banner-content">';

            if (!empty($instance['above_title_text'])) {
                $html .= '<span class="rb-dd-banner-subtitle rb-dd-banner-description">'
                . $instance['above_title_text'] . '</span>' ;
            }

            if (!empty( $instance['title_text'])) {
                $title_html = $instance['title_text'];
                $html .= sprintf( '<%1$s class="rb-dd-banner-title">%2$s</%1$s>', $instance['title_size'], $title_html);
            }

            if (!empty( $instance['description_text'])) {
                $html .= '<div class="rb-dd-banner-description">' . $instance['description_text'] . '</div>';
            }

            if (!empty( $instance['button_text'])) {
                $html .= '<div><span class="rb-button-link rb-button btn btn-primary">';

                if (!empty( $instance['button_icon'])) {
                    $html .= '<span '. $this->getRenderAttributeString('button-icon-align') . '>
                    <i class="'. Tools::safeOutput($instance['button_icon']). '"></i>
                    </span>';
                }

                $html .= '<span class="rb-button-text">'.$instance['button_text'] .'</span></span></div>' ;
            }

            $html .= '</div>';
        }

        if (!empty($instance['link']['url'])) {
            $html .= '</a>';
        }

        $html .= '</div>';

        return $html;
    }
}       
