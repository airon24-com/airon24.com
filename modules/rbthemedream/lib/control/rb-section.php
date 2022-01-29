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

class RbSection extends RbControl
{
	public function __construct()
    {
    	parent::__construct();
    	$this->setControl();
    	$this->presets = array();
        $this->context = Context::getContext();
        $this->module = new Rbthemedream();
    }

    public function setControl()
    {
    	$module = new Rbthemedream();

    	$this->startControlsSection(
            'section_layout',
            array(
                'label' => $module->l('Layout'),
                'tab' => 'layout',
            )
        );

        $this->addControl(
            'rb_class',
            array(
                'label' => $module->l('Class'),
                'type' => 'text',
                'placeholder' => $module->l('Enter Class Name'),
                'section' => 'section_class',
            )
        );

        $this->addControl(
            'rb_class_container',
            array(
                'label' => $module->l('Class Container'),
                'type' => 'text',
                'placeholder' => $module->l('Enter Class Name'),
                'section' => 'section_class',
            )
        );

        $this->addControl(
            'stretch_section',
            array(
                'label' => $module->l('Stretch Section'),
                'type' => 'switcher',
                'default' => '',
                'label_on' => $module->l('Yes'),
                'label_off' => $module->l('No'),
                'return_value' => 'section-stretched',
                'prefix_class' => 'rb-',
                'force_render' => true,
                'hide_in_inner' => true,
                'description' => $module->l('Stretch the section to the full width of the page using JS.'),
            )
        );

        $this->addControl(
            'layout',
            array(
                'label' => $module->l('Content Width'),
                'type' => 'select',
                'default' => 'boxed',
                'options' => array(
                    'boxed' => $module->l('Boxed'),
                    'full_width' => $module->l('Full Width'),
                ),
                'prefix_class' => 'rb-section-',
            )
        );

        $this->addControl(
            'content_width',
            array(
                'label' => $module->l('Content Width'),
                'type' => 'slider',
                'range' => array(
                    'px' => array(
                        'min' => 500,
                        'max' => 1600,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} > .rb-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'layout' => array('boxed'),
                ),
                'show_label' => false,
                'separator' => 'none',
            )
        );

        $this->addControl(
            'gap',
            array(
                'label' => $module->l('Columns Gap'),
                'type' => 'select',
                'default' => 'default',
                'options' => array(
                    'default' => $module->l('Default'),
                    'no' => $module->l('No Gap'),
                    'narrow' => $module->l('Narrow'),
                    'extended' => $module->l('Extended'),
                    'wide' => $module->l('Wide'),
                    'wider' => $module->l('Wider'),
                ),
            )
        );

        $this->addControl(
            'height',
            array(
                'label' => $module->l('Height'),
                'type' => 'select',
                'default' => 'default',
                'options' => array(
                    'default' => $module->l('Default'),
                    'full' => $module->l('Fit To Screen'),
                    'min-height' => $module->l('Min Height'),
                ),
                'prefix_class' => 'rb-section-height-',
                'hide_in_inner' => true,
            )
        );

        $this->addControl(
            'custom_height',
            array(
                'label' => $module->l('Minimum Height'),
                'type' => 'slider',
                'default' => array(
                    'size' => 400,
                ),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 1440,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} > .rb-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'height' => array('min-height'),
                ),
                'hide_in_inner' => true,
            )
        );

        $this->addControl(
            'height_inner',
            array(
                'label' => $module->l('Height'),
                'type' => 'select',
                'default' => 'default',
                'options' => array(
                    'default' => $module->l('Default'),
                    'min-height' => $module->l('Min Height'),
                ),
                'prefix_class' => 'rb-section-height-',
                'hide_in_top' => true,
            )
        );

        $this->addControl(
            'custom_height_inner',
            array(
                'label' => $module->l('Minimum Height'),
                'type' => 'slider',
                'default' => array(
                    'size' => 400,
                ),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 1440,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} > .rb-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'height_inner' => array('min-height'),
                ),
                'hide_in_top' => true,
            )
        );

        $this->addControl(
            'column_position',
            array(
                'label' => $module->l('Column Position'),
                'type' => 'select',
                'default' => 'middle',
                'options' => array(
                    'stretch' => $module->l('Stretch'),
                    'top' => $module->l('Top'),
                    'middle' => $module->l('Middle'),
                    'bottom' => $module->l('Bottom'),
                ),
                'prefix_class' => 'rb-section-items-',
                'condition' => array(
                    'height' => array('full', 'min-height'),
                ),
            )
        );

        $this->addControl(
            'content_position',
            array(
                'label' => $module->l('Content Position'),
                'type' => 'select',
                'default' => '',
                'options' => array(
                    '' => $module->l('Default'),
                    'top' => $module->l('Top'),
                    'middle' => $module->l('Middle'),
                    'bottom' => $module->l('Bottom'),
                ),
                'prefix_class' => 'rb-section-content-',
            )
        );

        $this->addControl(
            'structure',
            array(
                'label' => $module->l('Structure'),
                'type' => 'structure',
                'default' => '10',
            )
        );

        $this->endControlsSection();
    }

    public function createPresets()
    {
        $additional_presets = array(
            2 => array(
                array(
                    'preset' => array(33, 66),
                ),
                array(
                    'preset' => array(66, 33),
                ),
            ),
            3 => array(
                array(
                    'preset' => array(25, 25, 50),
                ),
                array(
                    'preset' => array(50, 25, 25),
                ),
                array(
                    'preset' => array(25, 50, 25),
                ),
                array(
                    'preset' => array(16, 66, 16),
                ),
            ),
        );

        foreach (range( 1, 10 ) as $columns_count) {
            $this->presets[$columns_count] = array(
                array(
                    'preset' => array(),
                ),
            );

            $preset_unit = floor(1 / $columns_count * 100);

            for ($i = 0; $i < $columns_count; $i++) {
                $this->presets[$columns_count][0]['preset'][] = $preset_unit;
            }

            if (!empty($additional_presets[$columns_count])) {
                $this->presets[ $columns_count ] = array_merge($this->presets[$columns_count], $additional_presets[$columns_count]);
            }

            foreach ($this->presets[ $columns_count ] as $preset_index => & $preset ) {
                $preset['key'] = $columns_count . $preset_index;
            }
        }
    }

    public function getPresets($columns_count = null, $preset_index = null)
    {

        if (!$this->presets) {
            $this->createPresets();
        }

        $presets = $this->presets;

        if ($columns_count !==  null) {
            $presets = $presets[$columns_count];
        }

        if ($preset_index !==  null) {
            $presets = $presets[$preset_index];
        }

        return $presets;
    }

    public function getSectionValues($instance = array())
    {
        $controls = $this->getControls();

        if (!empty($controls)) {
            foreach ($controls as $control) {
                $instance[$control['name']] = $this->getValue($control, $instance);
            }
        }

        return $instance;
    }

    public function beforeRender($instance, $element_id, $element_data = array())
    {
        $section_type = !empty($element_data['isInner']) ? 'inner' : 'top';

        $class_default = array(
            'rb-section',
            'rb-element',
            'rb-element-' . $element_id,
            'rb-' . $section_type . '-section',
        );

        if (isset($instance['rb_class']) && $instance['rb_class'] != '') {
            $rb_class = explode(' ', $instance['rb_class']);

            $class_default = array_merge($rb_class,$class_default);
        }

        $this->addRenderAttribute('wrapper', 'class', $class_default);

        foreach ($this->getClassControls() as $control) {
            if (empty($instance[$control['name']]))
                continue;

            if (!$this->isControlVisible($instance, $control))
                continue;

            $this->addRenderAttribute(
                'wrapper',
                'class',
                $control['prefix_class'] . $instance[$control['name']]
            );
        }

        if (!empty($instance['animation'])) {
            $this->addRenderAttribute(
                'wrapper',
                'data-animation',
                $instance['animation']
            );
        }

        $this->addRenderAttribute(
            'wrapper',
            'data-element_type',
            'section'
        );

        $attribute_string = $this->getRenderAttributeString('wrapper');

        $this->context->smarty->assign(array(
            'attribute_string' => $attribute_string,
            'instance' => $instance,
        ));

        return $this->module->fetch('module:rbthemedream/views/templates/section.tpl');
    }

    public function afterRender()
    {
        return "</div></div></div>";
    }

    public function getDataSection()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Section',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('basic'),
    		'keywords' => '',
    		'icon' => 'columns',
    		'presets' => $this->getPresets()
    	);

    	return $data;
    }
}
