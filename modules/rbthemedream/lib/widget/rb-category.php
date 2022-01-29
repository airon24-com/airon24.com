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

class RbCategory extends RbControl
{
	public $editMode = false;

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
    	$slidesToShow = range(1, 12);
        $slidesToShow = array_combine($slidesToShow, $slidesToShow);
        $itemsPerColumn = range(1, 6);
        $itemsPerColumn = array_combine($itemsPerColumn, $itemsPerColumn);

        $this->addPresControl(array(
        	'section_pswidget_options' => array(
                'label' => $module->l('Widget settings'),
                'type' => 'section',
            ),
            'cate_title' => array(
                'label' => $module->l('Title'),
                'type' => 'text',
                'default' => 'Category title',
                'section' => 'section_pswidget_options',
            ),
            'posts_limit' => array(
                'label' => $module->l('Limit'),
                'type' => 'number',
                'default' => '10',
                'min' => '1',
                'section' => 'section_pswidget_options',
            ),
            'view' => array(
                'label' => $module->l('View'),
                'type' => 'select',
                'default' => 'grid',
                'condition' => array(
                    'view!' => 'default',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'carousel' => $module->l('Carousel'),
                    'grid' => $module->l('Grid'),
                ),
            ),
            'slides_to_show' => array(
                'responsive' => true,
                'label' => $module->l('Show per line'),
                'type' => 'select',
                'default' => '6',
                'label_block' => true,
                'section' => 'section_pswidget_options',
                'options' => $slidesToShow,
                'condition' => array(
                    'view' => 'carousel',
                ),
            ),
            'slides_to_show_g' => array(
                'responsive' => true,
                'label' => $module->l('Show per line'),
                'type' => 'select',
                'default' => '3',
                'label_block' => true,
                'section' => 'section_pswidget_options',
                'options' => $slidesToShow,
                'condition' => array(
                    'view' => 'grid',
                ),
            ),
            'items_per_column' => array(
                'label' => $module->l('Items per column'),
                'type' => 'select',
                'default' => '1',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => $itemsPerColumn,
            ),
            'cate_to_display' => array(
                'label' => $module->l('Cate On Row (992-4,768-3)'),
                'type' => 'text',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
            ),
            'navigation' => array(
                'label' => $module->l('Navigation'),
                'type' => 'select',
                'default' => 'both',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'both' => $module->l('Arrows and Dots'),
                    'arrows' => $module->l('Arrows'),
                    'dots' => $module->l('Dots'),
                    'none' => $module->l('None'),
                ),
            ),
            'pause_on_hover' => array(
                'label' => $module->l('Pause on Hover'),
                'type' => 'select',
                'default' => 'yes',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            ),
            'autoplay' => array(
                'label' => $module->l('Autoplay'),
                'type' => 'select',
                'default' => 'yes',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            ),
            'autoplay_speed' => array(
                'label' => $module->l( 'Autoplay Speed'),
                'type' => 'number',
                'default' => 5000,
                'section' => 'section_pswidget_options',
                'condition' => array(
                    'view' => 'carousel',
                ),
            ),
            'infinite' => array(
                'label' => $module->l('Infinite Loop'),
                'type' => 'select',
                'default' => 'yes',
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            ),
        ));
    }

    public function getDataCategory()
    {
    	$controls = $this->getControls();

    	return array(
    		'title' => 'Category',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('prestashop'),
    		'keywords' => '',
    		'icon' => 'rb-category'
    	);
    }

    public function rbRender($instance = array())
    {
    	if (Tools::getValue('controller') == 'index' ||
            Tools::getValue('controller') == 'AdminRbthemedreamLive' ||
    		Tools::getValue('controller') == 'live'
    	) {
    		$categories = Category::getAllCategoriesName(
	    		Configuration::get('PS_HOME_CATEGORY'),
	    		(int)$this->context->language->id,
	    		true,
	    		true,
	    		'',
	    		'',
	    		'LIMIT ' . $instance['posts_limit']
    		);

    		$options = array();

	    	if (!empty($categories)) {
	    		foreach ($categories as $key_cate => $category) {
                    $obj_cate =  new Category($category['id_category'], (int)$this->context->language->id);
                    $categories[$key_cate]['product'] = $this->totalProductByIDCategory($category['id_category']);
	    			$categories[$key_cate]['url'] = $this->context->link->getCategoryLink($category['id_category']);
	    			$categories[$key_cate]['src'] = $this->context->link->getCatImageLink($obj_cate->link_rewrite, $category['id_category'], 'category_default');
	    		}

	    		if ($instance['view'] == 'carousel') {
	    			$show_dots = (in_array( $instance['navigation'], array('dots', 'both')));
                	$show_arrows = (in_array( $instance['navigation'], array('arrows', 'both')));

                	if (isset($instance['cate_to_display']) && $instance['cate_to_display'] != '') {
                		$configs = explode(',', $instance['cate_to_display']);

	                    foreach ($configs as $key_cf => $config) {
	                        $config = explode('-', $config);

	                        $config_obj[] = array(
	                            'breakpoint' => abs($config[0]),
	                            'settings' => array(
	                                'slidesToShow' => abs($config[1]),
	                                'slidesToScroll' => abs($config[1]),
	                            )
	                        );
	                    }
                	} else {
                		$config_obj = array(
	                        array(
	                            'breakpoint' => 992,
	                            'settings' => array(
	                                'slidesToShow' => abs($instance['slides_to_show_tablet']),
	                                'slidesToScroll' => abs(2),
	                            ),
	                        ),
	                        array(
	                            'breakpoint' => 576,
	                            'settings' => array(
	                                'slidesToShow' => abs($instance['slides_to_show_mobile']),
	                                'slidesToScroll' => abs(2),
	                            ),
	                        ),
                    	);
                	}

                	$options  = array(
                    	'responsive' => $config_obj,
                        'rows' => isset($instance['items_per_column']) ? abs($instance['items_per_column']) : abs(1),
                    	'slidesToShow' => abs($instance['slides_to_show']),
                    	'slidesToScroll' => abs(2),
                    	'autoplaySpeed' => abs($instance['autoplay_speed']),
                    	'autoplay' => ('yes' === $instance['autoplay']),
                    	'infinite' => ('yes' === $instance['infinite']),
                    	'pauseOnHover' => ('yes' === $instance['pause_on_hover']),
                    	'arrows' => $show_arrows,
                    	'dots' => $show_dots,
                	);
	    		}

	    		$module = new Rbthemedream();

	    		$this->context->smarty->assign(array(
                    'cate_title' => isset($instance['cate_title']) ? $instance['cate_title'] : '',
	    			'cate_view' =>  $instance['view'],
	    			'cate_categories' => $categories,
	    			'cate_desktop' => (int) (12 / $instance['slides_to_show_g']),
	    			'cate_tablet' => (int) (12 / $instance['slides_to_show_g_tablet']),
	    			'cate_phone' => (int) (12 / $instance['slides_to_show_g']),
	    			'options' => $options,
	    		));

	    		return $module->fetch('module:rbthemedream/views/templates/widget/rb-category.tpl');
	    	} else {
	    		return;
	    	}
    	} else {
    		return;
    	}
    }
}
