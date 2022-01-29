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

class RbProduct extends RbControl
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
    	$slidesToShow = range(1, 6);
        $slidesToShow = array_combine($slidesToShow, $slidesToShow);

        $itemsPerColumn = range(1, 6);
        $itemsPerColumn = array_combine($itemsPerColumn, $itemsPerColumn);

        $categories = array();
        $brandsOptions = array();

        if ($this->editMode) {
            $categories = $this->generateCategoriesOption(
            	$this->customGetNestedCategories(
            		$this->context->shop->id,
                	null,
                	(int)$this->context->language->id,
                	false
                )
            );

            $brands = Manufacturer::getManufacturers();
            foreach ($brands as $brand) {
                $brandsOptions[$brand['id_manufacturer']] = $brand['name'];
            }
        }

        $productSourceOptions['ms'] = $module->l('Manual selection');
        $productSourceOptions['bb'] = $module->l('By brand');
        $productSourceOptions['np'] = $module->l('New products');
        $productSourceOptions['pd'] = $module->l('Price drops');
        $productSourceOptions['bs'] = $module->l('Best sellers');
        $productSourceOptions = array_merge($productSourceOptions, $categories);
        $product_list = array();
        $product_list_carousel = array();
        $product_list_sly = array();
        $dirname = _PS_ALL_THEMES_DIR_._THEME_NAME_ . '/templates/';

        if (is_dir($dirname . 'catalog/_partials/miniatures/product-list/')) {
            $total_product = 0;
            $dp = opendir($dirname . 'catalog/_partials/miniatures/product-list/');

            if ($dp) {
                while (($filename=readdir($dp)) == true) {
                    if (($filename !=".") && ($filename !="..")) {
                        if ($total_product != 0) {
                            $product_list[$total_product] = $module->l('Product - ') . $total_product;
                        }

                        $total_product++;
                    }
                }
            }
        }

        if (is_dir($dirname . 'catalog/_partials/miniatures/product-slick/')) {
            $total_product = 0;
            $dp = opendir($dirname . 'catalog/_partials/miniatures/product-slick/');

            if ($dp) {
                while (($filename=readdir($dp)) == true) {
                    if (($filename !=".") && ($filename !="..")) {
                        if ($total_product != 0) {
                            $product_list_carousel[$total_product] = $module->l('Carousel - ') . $total_product;
                        }

                        $total_product++;
                    }
                }
            }
        }

        if (is_dir($dirname . 'catalog/_partials/miniatures/product-sly/')) {
            $total_product = 0;
            $dp = opendir($dirname . 'catalog/_partials/miniatures/product-sly/');

            if ($dp) {
                while (($filename=readdir($dp)) == true) {
                    if (($filename !=".") && ($filename !="..")) {
                        if ($total_product != 0) {
                            $product_list_sly[$total_product] = $module->l('Sly - ') . $total_product;
                        }

                        $total_product++;
                    }
                }
            }
        }

        $this->addPresControl(array(
        	'section_pswidget_options' => array(
                'label' => $module->l('Widget settings'),
                'type' => 'section',
            ),
            'product_title' => array(
                'label' => $module->l('Title'),
                'type' => 'text',
                'default' => 'Title',
                'label_block' => true,
                'section' => 'section_pswidget_options',
            ),
            'product_sub_title' => array(
                'label' => $module->l('Sub Title'),
                'type' => 'text',
                'default' => 'Sub Title',
                'label_block' => true,
                'section' => 'section_pswidget_options',
            ),
            'product_source' => array(
                'label' => $module->l('Products source'),
                'type' => 'select',
                'default' => 'np',
                'label_block' => true,
                'section' => 'section_pswidget_options',
                'options' => $productSourceOptions,
            ),
            'products_ids' => array(
                'label' => $module->l('Search for products'),
                'placeholder' => $module->l('Product name, id, ref'),
                'type' => 'autocomplete_products',
                'label_block' => true,
                'condition' => array(
                    'product_source' => array('ms'),
                ),
                'section' => 'section_pswidget_options',
            ),
            'brand_list' => array(
                'label' => $module->l('Select brand'),
                'type' => 'select',
                'default' => 0,
                'label_block' => true,
                'section' => 'section_pswidget_options',
                'condition' => array(
                    'product_source' => array('bb'),
                ),
                'options' => $brandsOptions,
            ),
            'products_limit' => array(
                'label' => $module->l('Limit'),
                'type' => 'number',
                'default' => '10',
                'condition' => array(
                    'product_source!' => array('ms'),
                ),
                'section' => 'section_pswidget_options',
            ),
            'products_col' => array(
                'label' => $module->l('Col'),
                'type' => 'text',
                'default' => 'col-md-3',
                'min' => '1',
                'condition' => array(
                    'product_source!' => array('ms'),
                ),
                'section' => 'section_pswidget_options',
            ),
            'order_by' => array(
                'label' => $module->l('Order by'),
                'type' => 'select',
                'default' => 'position',
                'condition' => array(
                    'product_source!' => array('np', 'bs', 'ms'),
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'position' => $module->l('Position'),
                    'name' => $module->l('Name'),
                    'date_add' => $module->l('Date add'),
                    'price' => $module->l('Price'),
                    'random' => $module->l('Random (works only with categories)'),
                ),
            ),
            'order_way' => array(
                'label' => $module->l('Order way'),
                'type' => 'select',
                'default' => 'asc',
                'section' => 'section_pswidget_options',
                'condition' => array(
                    'product_source!' => array('np', 'bs', 'ms'),
                ),
                'options' => array(
                    'asc' => $module->l('Ascending'),
                    'desc' => $module->l('Descending'),
                ),
            ),
            'view' => array(
                'label' => $module->l('View'),
                'type' => 'select',
                'default' => 'carousel',
                'condition' => array(
                    'view!' => 'default',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'carousel' => $module->l('Carousel'),
                    'list' => $module->l('List'),
                    'sly' => $module->l('Sly')
                ),
            ),
            'product_list_sly' => array(
                'label' => $module->l('Select Product Sly'),
                'type' => 'select',
                'default' => 1,
                'condition' => array(
                    'view' => 'sly',
                ),
                'section' => 'section_pswidget_options',
                'options' => $product_list_sly,
            ),
            'products_display_sly' => array(
                'label' => $module->l('Products On Row (992-4,768-3)'),
                'type' => 'text',
                'condition' => array(
                    'view' => array('sly'),
                ),
                'section' => 'section_pswidget_options',
            ),
            'sly_to_show' => array(
                'responsive' => true,
                'label' => $module->l('Show per line'),
                'type' => 'select',
                'default' => '6',
                'label_block' => true,
                'section' => 'section_pswidget_options',
                'options' => $slidesToShow,
                'condition' => array(
                    'view' => array('sly'),
                ),
            ),
            'product_list' => array(
                'label' => $module->l('Select Product List'),
                'type' => 'select',
                'default' => 1,
                'condition' => array(
                    'view' => 'list',
                ),
                'section' => 'section_pswidget_options',
                'options' => $product_list,
            ),
            'use_animation' => array(
                'label' => $module->l('Use Animation'),
                'type' => 'select',
                'default' => 1,
                'condition' => array(
                    'view' => 'list',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    1 => $module->l('Yes'),
                    0 => $module->l('No'),
                ),
            ),
            'show_more_button' => array(
                'label' => $module->l('Button Show More'),
                'type' => 'select',
                'default' => 1,
                'condition' => array(
                    'view' => 'list',
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    1 => $module->l('Yes'),
                    0 => $module->l('No'),
                ),
            ),
            'product_list_carousel' => array(
                'label' => $module->l('Select Product Carousel'),
                'type' => 'select',
                'default' => 1,
                'condition' => array(
                    'view' => 'carousel',
                ),
                'section' => 'section_pswidget_options',
                'options' => $product_list_carousel,
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
                    'view' => array('carousel', 'grid'),
                ),
            ),
            'products_display' => array(
                'label' => $module->l('Products On Row (992-4,768-3)'),
                'type' => 'text',
                'condition' => array(
                    'view' => array('carousel'),
                ),
                'section' => 'section_pswidget_options',
            ),
            'items_per_column' => array(
                'label' => $module->l('Items per column'),
                'type' => 'select',
                'default' => '1',
                'condition' => array(
                    'view' => array('carousel'),
                ),
                'section' => 'section_pswidget_options',
                'options' => $itemsPerColumn,
            ),
            'navigation' => array(
                'label' => $module->l('Navigation'),
                'type' => 'select',
                'default' => 'both',
                'condition' => array(
                    'view' => array('carousel'),
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'both' => $module->l('Arrows and Dots'),
                    'arrows' => $module->l('Arrows'),
                    'dots' => $module->l('Dots'),
                    'none' => $module->l('None'),
                ),
            ),
            'autoplay' => array(
                'label' => $module->l('Autoplay'),
                'type' => 'select',
                'default' => 'yes',
                'condition' => array(
                    'view' => array('carousel'),
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            ),
            'infinite' =>  array(
                'label' => $module->l('Infinite Loop'),
                'type' => 'select',
                'default' => 'yes',
                'condition' => array(
                    'view' => array('carousel'),
                ),
                'section' => 'section_pswidget_options',
                'options' => array(
                    'yes' => $module->l('Yes'),
                    'no' => $module->l('No'),
                ),
            ),
            'section_style_navigation' => array(
                'label' => $module->l('Navigation'),
                'type' => 'section',
                'tab' => 'style',
            ),
            'arrows_position' => array(
                'label' => $module->l('Arrows position'),
                'type' => 'select',
                'default' => 'middle',
                'tab' => 'style',
                'condition' => array(
                    'view' => array('carousel'),
                    'navigation' => array('both', 'arrows'),
                ),
                'section' => 'section_style_navigation',
                'options' => array(
                    'middle' => $module->l('Middle'),
                    'above' => $module->l('Above'),
                ),
            ),
        ));
    }

    public function getDataProduct()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'List Product',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('prestashop'),
    		'keywords' => '',
    		'icon' => 'product'
    	);

    	return $data;
    }

    public function rbRender($instance = array())
    {
        if (Tools::getIsset('controller') &&
            Tools::getValue('controller') == 'index' ||
            Tools::getValue('controller') == 'AdminRbthemedreamLive' ||
            Tools::getValue('controller') == 'live'
        ) {
            $optionsSource = $this->getWidgetValues($instance);
            $source = $optionsSource['product_source'];
            $products = array();
            $check = 0;

            if ($source == 'ms') {
                $products = $this->getProductsByIds($optionsSource['products_ids']);
            } else{
                $products = $this->getProducts(
                    $source,
                    $optionsSource['products_limit'],
                    $optionsSource['order_by'],
                    $optionsSource['order_way'],
                    $optionsSource['brand_list']
                );
                $product_limits = $this->getProducts(
                    $source,
                    (int)($optionsSource['products_limit'] + 1),
                    $optionsSource['order_by'],
                    $optionsSource['order_way'],
                    $optionsSource['brand_list']
                );

                if (count($product_limits) > count($products)) {
                    $check = 1;
                } else {
                    $check = 0;
                }
            }

            $return = array(
                'products' => $products,
                'view' => $optionsSource['view'],
                'products_col' => isset($optionsSource['products_col']) ? $optionsSource['products_col'] : 'col-md-3',
                'row' => isset($optionsSource['items_per_column']) ? $optionsSource['items_per_column'] : 1,
                'product_list' => isset($optionsSource['product_list']) ? $optionsSource['product_list'] : 1,
                'product_list_carousel' => isset($optionsSource['product_list_carousel']) ? $optionsSource['product_list_carousel'] : 1,
                'title' => isset($optionsSource['product_title']) ? $optionsSource['product_title'] : '',
                'sub_title' => isset($optionsSource['product_sub_title']) ? $optionsSource['product_sub_title'] : '',
                'use_animation' => isset($optionsSource['use_animation']) ? $optionsSource['use_animation'] : 0,
                'show_more_button' => isset($optionsSource['show_more_button']) ? $optionsSource['show_more_button'] : 0,
                'load_more' => $check,
                'limit' => $optionsSource['products_limit'],
                'source' => $source,
                'orderBy' => $optionsSource['order_by'],
                'order_way' => $optionsSource['order_way'],
                'brand_list' => $optionsSource['brand_list'],
            );

            if ($optionsSource['view'] == 'sly') {
                $return['product_list_sly'] = isset($optionsSource['product_list_sly']) ? $optionsSource['product_list_sly'] : 1;
                $return['sly_to_show'] = isset($optionsSource['sly_to_show']) ? $optionsSource['sly_to_show'] : 6;
                $return['sly_to_show_tablet'] = isset($optionsSource['sly_to_show_tablet']) ? $optionsSource['sly_to_show_tablet'] : 3;
                $return['sly_to_show_mobile'] = isset($optionsSource['sly_to_show_mobile']) ? $optionsSource['product_list_sly'] : 2;
                $config_obj = array();

                if (isset($optionsSource['products_display_sly']) &&
                    $optionsSource['products_display_sly'] != ''
                ) {
                    $configs = explode(',', $optionsSource['products_display_sly']);

                    foreach ($configs as $config) {
                        $config = explode('-', $config);

                        $config_obj[] = array(
                            'breakpoint' => abs($config[0]),
                            'show' => $config[1],
                        );
                    }
                } else {
                    $config_obj = array(
                        array(
                            'breakpoint' => 1200,
                            'show' => isset($optionsSource['sly_to_show']) ? $optionsSource['sly_to_show'] : 4,
                        ),
                        array(
                            'breakpoint' => 992,
                            'show' => isset($optionsSource['sly_to_show_tablet']) ? $optionsSource['sly_to_show_tablet'] : 3,
                        ),
                        array(
                            'breakpoint' => 768,
                            'show' => isset($optionsSource['sly_to_show_mobile']) ? $optionsSource['sly_to_show_mobile'] : 2,
                        ),
                    );
                }

                $return['options_sly'] = Tools::jsonEncode($config_obj);
            }

            if ($optionsSource['view'] == 'grid' || $optionsSource['view'] == 'grid_s'){
                $optionsSource['slides_to_show'] = $this->calculateGrid($optionsSource['slides_to_show']);
                $optionsSource['slides_to_show_tablet'] = $this->calculateGrid($optionsSource['slides_to_show_tablet']);
                $optionsSource['slides_to_show_mobile'] = $this->calculateGrid($optionsSource['slides_to_show_mobile']);

                $return['slidesToShow'] = array(
                    'desktop' => $optionsSource['slides_to_show'],
                    'tablet' => $optionsSource['slides_to_show_tablet'],
                    'mobile' => $optionsSource['slides_to_show_mobile'],
                );

            } else if ($optionsSource['view'] == 'carousel' || $optionsSource['view'] == 'carousel_s'){
                $return['arrows_position'] = $optionsSource['arrows_position'];
                $show_dots = (in_array($optionsSource['navigation'], array('dots', 'both')));
                $show_arrows = (in_array($optionsSource['navigation'], array('arrows', 'both')));
                $config_obj = array();

                if (isset($optionsSource['products_display']) &&
                    $optionsSource['products_display'] != ''
                ) {
                    $configs = explode(',', $optionsSource['products_display']);

                    foreach ($configs as $config) {
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
                                'slidesToShow' => abs($optionsSource['slides_to_show_tablet']),
                                'slidesToScroll' => abs($optionsSource['slides_to_show_tablet']),
                            ),
                        ),
                        array(
                            'breakpoint' => 576,
                            'settings' => array(
                                'slidesToShow' => abs($optionsSource['slides_to_show_mobile']),
                                'slidesToScroll' => abs($optionsSource['slides_to_show_mobile']),
                            ),
                        ),
                    );
                }

                $return['options'] = array(
                    'responsive' => $config_obj,
                    'dots' => true,
                    'infinite' => false,
                    'rows' => abs($optionsSource['items_per_column']),
                    'slidesToShow' => abs($optionsSource['slides_to_show']),
                    'slidesToScroll' => abs($optionsSource['slides_to_show']),
                    'autoplay' => ('yes' === $optionsSource['autoplay']),
                    'infinite' => ('yes' === $optionsSource['infinite']),
                    'arrows' => $show_arrows,
                    'dots' => $show_dots,
                );
            }

            $module = new Rbthemedream();

            if (Tools::getValue('controller') == 'AdminRbthemedreamLive') {
                $obj_curr = Currency::getDefaultCurrency();

                $this->context->smarty->assign(array(
                    'urls' => array(
                        'pages' => array(
                            'cart' => '#'
                        ),
                    ),
                    'page' => array(
                        'page_name' => '#'
                    ),
                    'currency' => array(
                        'iso_code' => isset($obj_curr->iso_code) ? $obj_curr->iso_code : '$',
                    ),
                ));
            }

            $this->context->smarty->assign(array(
                'products' => $return,
                'url_ajax' => $this->context->link->getModuleLink('rbthemedream', 'view'),
            ));

            return $module->fetch('module:rbthemedream/views/templates/widget/rb-product.tpl');
        } else {
            return;
        }
    }
}
