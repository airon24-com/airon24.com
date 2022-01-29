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

class RbSliderDD extends RbControl
{
	public $editMode = false;
	public $revModule;

	public function __construct()
    {
    	parent::__construct();
    	$this->context = Context::getContext();

    	if (isset($this->context->controller->controller_name) &&
    		$this->context->controller->controller_name == 'AdminRbthemedreamLive'
    	) {
            $this->editMode = true;
        }

    	$this->setControl();
    }

    public function setControl()
    {
    	$module = new Rbthemedream();

    	$sliders = array();
        $sliders[0] = $module->l('-- None --');

        if ($this->editMode) {
            $this->revModule = Module::getInstanceByName('rbthemeslider');

            if (Validate::isLoadedObject($this->revModule)) {
                $slidersData = $this->getSliders();

                if ($slidersData) {
                    foreach ($slidersData as $slide) {
                        $sliders[$slide['id']] = isset($slide['name']) ? $slide['name'] : '';
                    }
                }
            }
        }

        $this->addPresControl(array(
            'section_pswidget_options' => array(
                'label' => $module->l('Widget settings'),
                'type' => 'section',
            ),
            'slider' => array(
                'label' => $module->l('Slider'),
                'type' => 'select',
                'default' => 0,
                'section' => 'section_pswidget_options',
                'options' => $sliders,
            ),
        ));
    }

    public function getSliders()
    {
        $sql = 'SELECT *
		FROM  `' . _DB_PREFIX_ . 'rbthemeslider`';

        if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql)) {
            return false;
        }

        return $result;
    }

    public function getDataSlider()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'Slider',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('prestashop'),
    		'keywords' => '',
    		'icon' => 'image-carousel'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
        if (Tools::getIsset('controller') &&
            Tools::getValue('controller') == 'index' ||
            Tools::getValue('controller') == 'live'
        ) {
            $instance = $this->getWidgetValues($instance);
            $module = new Rbthemedream();
            $slider = '';
            $sliderId = array((int)$instance['slider'], (int)$instance['slider']);

            if ($sliderId != 0) {
                $rbslider = Module::getInstanceByName('rbthemeslider');

                if (Validate::isLoadedObject($rbslider)) {
                    $slider = $rbslider->generateSlider($sliderId);
                }
            }

            $this->context->smarty->assign(array(
                'slider' => $slider,
            ));

            return $module->fetch('module:rbthemedream/views/templates/widget/rb-slider.tpl');
        } else {
            return;
        }
    }

    public function renderAdmin($instance = array())
    {
        $instance = $this->getWidgetValues($instance);
        $module = new Rbthemedream();
        $sliders = array();

        $sql = 'SELECT *
        FROM `'._DB_PREFIX_.'rbthemeslider`
        WHERE `id` = ' . (int)$instance['slider'];
        $data_sliders = Db::getInstance()->getRow($sql);

        if (!empty($data_sliders)) {
            $data_sliders = Tools::jsonDecode($data_sliders['data'], true);

            foreach ($data_sliders['layers'] as $layer) {
                $item_layer = array(
                    'image' => $layer['properties']['background'],
                );

                $layers = array();

                if (!empty($layer['sublayers'])) {
                    $index = 0;
                    foreach ($layer['sublayers'] as $sub_layer) {
                        if ($sub_layer['media'] == 'text') {
                            $layers[$index]['text'] = $sub_layer['html'];
                        } else {
                            $layers[$index]['button'] = $sub_layer['html'];
                        }

                        $styles = 'position:absolute;';
                        $data_style = Tools::jsonDecode(call_user_func('strip'.'slashes', $sub_layer['styles']), true);
                        $styles .= 'top:' . $data_style['top'] . ';';
                        $styles .= 'left:' . $data_style['left'] . ';';
                        $styles .= 'text-align:' . $data_style['text-align'] . ';';
                        $styles .= 'font-weight:' . $data_style['font-weight'] . ';';
                        $styles .= 'font-style:' . $data_style['font-style'] . ';';
                        $styles .= 'font-size:' . isset($data_style['font-size']) ? $data_style['font-size'] : $data_style['font-size'] . ';';
                        $layers[$index]['rb_styles'] = $styles;

                        $index++;
                    }
                }

                $item_layer['layers'] = $layers;
                $sliders[] = $item_layer;
            }
        }

        $this->context->smarty->assign(array(
            'sliders' => $sliders,
        ));

        return $module->fetch('module:rbthemedream/views/templates/admin/widget/rb-widget-prestashop-widget-rbthemeslider-content.tpl');
    }

    // public function rbRender($instance = array())
    // {
    //     if (Tools::getIsset('controller') &&
    //         Tools::getValue('controller') == 'index' ||
    //         Tools::getValue('controller') == 'live'
    //     ) {
    //         $instance = $this->getWidgetValues($instance);
    //         $module = new Rbthemedream();
    //         $slider = '';
    //         $sliderId = (int)$instance['slider'];

    //         if ($sliderId != 0) {
    //             $rbslider = Module::getInstanceByName('rbthemeslider');

    //             if (Validate::isLoadedObject($rbslider)) {
    //                 $rbslider->_prehook();
    //                 $slider = $rbslider->generateSliderById($sliderId);
    //             }
    //         }

    //         $this->context->smarty->assign(array(
    //             'slider' => $slider,
    //         ));

    //         return $module->fetch('module:rbthemedream/views/templates/widget/rb-slider.tpl');
    //     } else {
    //         return;
    //     }
    // }

    // public function renderAdmin($instance = array())
    // {
    //     if (empty($instance)) {
    //        return;
    //     }

    //     $module = new Rbthemedream();
    //     $sliderId = (int)$instance['slider'];
    //     $sql = 'SELECT *
    //     FROM `'._DB_PREFIX_.'rbslider_slides`
    //     WHERE `slider_id` = ' . (int)$sliderId;
    //     $sliders = Db::getInstance()->executeS($sql);

    //     if (!empty($sliders)) {
    //         foreach ($sliders as $key_sl => $slider) {
    //             $params = Tools::jsonDecode($slider['params'], true);
    //             $sliders[$key_sl]['image'] = $this->context->shop->getBaseURL(true, true) . strstr($params['image'], 'modules/rbthemeslider/uploads/');
    //             $layers = Tools::jsonDecode($slider['layers'], true);
    //             $data_layers = array();


    //             if ($layers) {
    //                 $j = 1;

    //                 foreach ($layers as $layer) {
    //                     $left = RbSliderFunctions::getVal($layer, 'left', 0);
    //                     $top = RbSliderFunctions::getVal($layer, 'top', 0);

    //                     if (isset($top['desktop']) && $top['desktop'] < 0) {
    //                         $top['desktop'] = 300 + (int)$top['desktop'];
    //                     }

    //                     $static_styles = RbSliderFunctions::getVal($layer, 'static_styles', 0);
    //                     $styles = 'position:absolute;';

    //                     if (isset($left['desktop'])) {
    //                         $styles .= 'left:' . $left['desktop'] . 'px;';
    //                     }

    //                     if (isset($top['desktop'])) {
    //                         $styles .= 'top:' . $top['desktop'] . 'px;';
    //                     }

    //                     if (isset($static_styles['font-size']['desktop'])) {
    //                         $styles .= 'font-size:' . $static_styles['font-size']['desktop'] . ';';
    //                     }

    //                     if (isset($static_styles['line-height']['desktop'])) {
    //                         if (strpos($static_styles['line-height']['desktop'], 'px')) {
    //                             $styles .= 'line-height:' . $static_styles['line-height']['desktop'] . ';';
    //                         } else {
    //                             $styles .= 'line-height:' . $static_styles['line-height']['desktop'] . 'px;';
    //                         }
    //                     }

    //                     if (isset($static_styles['font-weight']['desktop'])) {
    //                         $styles .= 'font-weight:' . $static_styles['font-weight']['desktop'] . ';';
    //                     }

    //                     if (isset($static_styles['colort']['desktop'])) {
    //                         $styles .= 'color:' . $static_styles['color']['desktop'];
    //                     }

    //                     if ($layer['type'] == 'text') {
    //                         $data_layers[$j]['text'] = $layer['text'];
    //                         $data_layers[$j]['rb_styles'] = $styles;
    //                         $j ++;
    //                     } elseif ($layer['type'] == 'button') {
    //                         $data_layers[$j]['button'] = $layer['text'];
    //                         $data_layers[$j]['rb_styles'] = $styles;
    //                         $j ++;
    //                     }
    //                 }
    //             }

    //             $sliders[$key_sl]['layers'] = $data_layers;
    //             unset($sliders[$key_sl]['params']);
    //             unset($sliders[$key_sl]['settings']);
    //         }

    //         $this->context->smarty->assign(array(
    //             'sliders' => $sliders,
    //         ));

    //         return $module->fetch('module:rbthemedream/views/templates/admin/widget/rb-widget-prestashop-widget-rbthemeslider-content.tpl');
    //     } else {
    //         return;
    //     }
    // }
}
