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

class RbProductTab extends RbControl
{
	public $editMode = false;

	public function __construct()
    {
    	parent::__construct();

    	$this->context = Context::getContext();

    	if (isset(Context::getContext()->controller->controller_name) &&
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
        $itemsPerColumn = range(1, 10);
        $itemsPerColumn = array_combine($itemsPerColumn, $itemsPerColumn);
        $categories = array();
        $brandsOptions = array();

        if ($this->editMode) {
            $categories = $this->generateCategoriesOption($this->customGetNestedCategories(
            	$this->context->shop->id,
            	null,
            	(int)$this->context->language->id,
            	false
            ));

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
            'tabs' => array(
                'label' => $module->l('Tabs items'),
                'type' => 'repeater',
                'section' => 'section_pswidget_options',
                'default' => array(),
                'fields' => array(
                    array(
                        'name' => 'select_type',
                        'label' => $module->l('Select Icon'),
                        'type' => 'select',
                        'default' => 'icon',
                        'options' => array(
                            'icon' => $module->l('Icon'),
                            'image' => $module->l('Image Icon')
                        ),
                    ),
                    array(
                        'name' => 'type_icon',
                        'label' => $module->l('Icon'),
                        'type' => 'text',
                        'condition' => array(
                            'select_type' => 'icon',
                        ),
                    ),
                    array(
                        'name' => 'type_image',
                        'label' => $module->l('Image Icon'),
                        'type' => 'media',
                        'default' => array(
                            'url' => _MODULE_DIR_ . 'rbthemedream/views/img/img.jpg',
                        ),
                        'condition' => array(
                            'select_type' => 'image',
                        ),
                    ),
                    array(
                        'name' => 'tab_title',
                        'label' => $module->l('Title'),
                        'type' => 'text',
                        'default' => $module->l('Tab Title'),
                        'placeholder' => $module->l('Tab Title'),
                        'label_block' => true,
                    ),
                    array(
                        'name' =>  'product_source',
                        'label' => $module->l('Products source'),
                        'type' => 'select',
                        'default' => 'np',
                        'label_block' => true,
                        'options' => $productSourceOptions,
                    ),
                    array(   
                    	'name' => 'products_ids',
                        'label' => $module->l('Search for products'),
                        'placeholder' => $module->l('Product name, id, ref'),
                        'type' => 'autocomplete_products',
                        'label_block' => true,
                        'condition' => array(
                            'product_source' => array('ms'),
                        ),
                    ),
                    array(
                        'name' => 'products_limit',
                        'label' => $module->l('Limit'),
                        'type' => 'number',
                        'default' => '10',
                        'min' => '1',
                        'condition' => array(
                            'product_source!' => array('ms'),
                        ),
                    ),
                    array(
                        'name' => 'products_col',
                        'label' => $module->l('Col'),
                        'type' => 'text',
                        'default' => 'col-md-3',
                        'condition' => array(
                            'product_source!' => array('ms'),
                        ),
                    ),
                    array(
                        'name' =>  'brand_list',
                        'label' => $module->l('Select brand'),
                        'type' => 'select',
                        'default' => 0,
                        'label_block' => true,
                        'options' => $brandsOptions,
                        'condition' => array(
                            'product_source' => array('bb'),
                        ),
                    ),
                    array(
                        'name' => 'order_by',
                        'label' => $module->l('Order by'),
                        'type' => 'select',
                        'default' => 'position',
                        'condition' => [
                            'product_source!' => array('np', 'bs', 'ms'),
                        ],
                        'options' => array(
                            'position' => $module->l('Position'),
                            'name' => $module->l('Name'),
                            'date_add' => $module->l('Date add'),
                            'price' => $module->l('Price'),
                            'random' => $module->l('Random (works only with categories)'),
                        ),
                    ),
                    array(
                        'name' => 'order_way',
                        'label' => $module->l('Order way'),
                        'type' => 'select',
                        'default' => 'asc',
                        'condition' => array(
                            'product_source!' => array('np', 'bs', 'ms'),
                        ),
                        'options' => array(
                            'asc' => $module->l('Ascending'),
                            'desc' => $module->l('Descending'),
                        ),
                    ),
                    array(
                        'name' => 'view',
                        'label' => $module->l('View'),
                        'type' => 'select',
                        'default' => 'carousel',
                        'condition' => array(
                            'view!' => 'default',
                        ),
                        'options' => array(
                            'carousel' => $module->l('Carousel'),
                            'list' => $module->l('List'),
                            'sly' => $module->l('Sly')
                        ),
                    ),
                    array(
                        'name' => 'product_list_sly',
                        'label' => $module->l('Select Product Sly'),
                        'type' => 'select',
                        'default' => 1,
                        'condition' => array(
                            'view' => 'sly',
                        ),
                        'options' => $product_list_sly,
                    ),
                    array(
                        'name' => 'products_display_sly',
                        'label' => $module->l('Products On Row (992-4,768-3)'),
                        'type' => 'text',
                        'condition' => array(
                            'view' => array('sly'),
                        ),
                    ),
                    array(
                        'name' => 'sly_to_show',
                        'label' => $module->l('Show per line (desktop)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('sly'),
                        ),
                    ),
                    array(
                        'name' => 'sly_to_show_tablet',
                        'label' => $module->l('Show per line (tablet)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('sly'),
                        ),
                    ),
                    array(
                        'name' => 'sly_to_show_mobile',
                        'label' => $module->l('Show per line (phone)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('sly'),
                        ),
                    ),
                    array(
                        'name' => 'product_list',
                        'label' => $module->l('Select Product List'),
                        'type' => 'select',
                        'default' => 1,
                        'label_block' => true,
                        'options' => $product_list,
                        'condition' => array(
                            'view' => array('list'),
                        ),
                    ),
                    array(
                        'name' => 'use_animation',
                        'label' => $module->l('Use Animation'),
                        'type' => 'select',
                        'default' => 1,
                        'condition' => array(
                            'view' => 'list',
                        ),
                        'options' => array(
                            1 => $module->l('Yes'),
                            0 => $module->l('No'),
                        ),
                    ),
                    array(
                        'name' => 'show_more_button',
                        'label' => $module->l('Button Show More'),
                        'type' => 'select',
                        'default' => 1,
                        'condition' => array(
                            'view' => 'list',
                        ),
                        'options' => array(
                            1 => $module->l('Yes'),
                            0 => $module->l('No'),
                        ),
                    ),
                    array(
                        'name' => 'product_list_carousel',
                        'label' => $module->l('Select Product Carousel'),
                        'type' => 'select',
                        'default' => 1,
                        'label_block' => true,
                        'options' => $product_list_carousel,
                        'condition' => array(
                            'view' => array('carousel'),
                        ),
                    ),
                    array(
                        'name' => 'slides_to_show',
                        'label' => $module->l('Show per line (desktop)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('carousel', 'grid'),
                        ),
                    ),
                    array(
                        'name' => 'slides_to_show_tablet',
                        'label' => $module->l('Show per line (tablet)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('carousel', 'grid'),
                        ),
                    ),
                    array(
                        'name' => 'slides_to_show_mobile',
                        'label' => $module->l('Show per line (phone)'),
                        'type' => 'select',
                        'default' => '6',
                        'label_block' => true,
                        'options' => $slidesToShow,
                        'condition' => array(
                            'view' => array('carousel', 'grid'),
                        ),
                    ),
                    array(
                        'name' => 'products_display',
                        'label' => $module->l('Products On Row (992-4,768-3)'),
                        'type' => 'text',
                        'condition' => array(
                            'view' => 'carousel',
                        ),
                        'options' => $itemsPerColumn,
                    ),
                    array(
                    	'name' => 'items_per_column',
                        'label' => $module->l('Items per column'),
                        'type' => 'select',
                        'default' => '1',
                        'condition' => array(
                            'view' => 'carousel',
                        ),
                        'options' => $itemsPerColumn,
                    ),
                    array(
                    	'name' => 'navigation',
                        'label' => $module->l('Navigation'),
                        'type' => 'select',
                        'default' => 'both',
                        'condition' => array(
                            'view' => 'carousel',
                        ),
                        'options' => array(
                            'both' => $module->l('Arrows and Dots'),
                            'arrows' => $module->l('Arrows'),
                            'dots' => $module->l('Dots'),
                            'none' => $module->l('None'),
                        ),
                    ),
                    array(
                    	'name' => 'autoplay',
                        'label' => $module->l('Autoplay'),
                        'type' => 'select',
                        'default' => 'yes',
                        'condition' => array(
                            'view' => 'carousel',
                        ),
                        'options' => array(
                            'yes' => $module->l('Yes'),
                            'no' => $module->l('No'),
                        ),
                    ),
                    array(
                    	'name' => 'infinite',
                        'label' => $module->l('Infinite Loop'),
                        'type' => 'select',
                        'condition' => array(
                            'view' => 'carousel',
                        ),
                        'default' => 'yes',
                        'options' => array(
                            'yes' => $module->l('Yes'),
                            'no' => $module->l('No'),
                        ),
                    ),
                ),
                'title_field' => 'tab_title',
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
                'section' => 'section_style_navigation',
                'options' => array(
                    'middle' => $module->l('Middle'),
                    'above' => $module->l('Above'),
                ),
            ),
        ));
    }

    public function getDataProductTab()
    {
    	$controls = $this->getControls();

        $data = array(
    		'title' => 'List Product Tab',
    		'controls' => $controls,
    		'tabs_controls' => $this->tabs_controls,
    		'categories' => array('prestashop'),
    		'keywords' => '',
    		'icon' => 'product-tab'
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
            $tabs = array();
            $parsedOptions = array();
            $uid = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            $check = 0;

            if (isset($optionsSource['tabs'])){
                foreach ($optionsSource['tabs'] as $tab) {
                    $source = $tab['product_source'];

                    if ($source == 'ms') {
                        $products = $this->getProductsByIds($tab['products_ids']);
                    } else{
                        $products = $this->getProducts(
                            $source,
                            $tab['products_limit'],
                            $tab['order_by'],
                            $tab['order_way'],
                            $tab['brand_list']
                        );

                        $product_limits = $this->getProducts(
                            $source,
                            (int)($tab['products_limit'] + 1),
                            $tab['order_by'],
                            $tab['order_way'],
                            $tab['brand_list']
                        );

                        if (count($product_limits) > count($products)) {
                            $check = 1;
                        } else {
                            $check = 0;
                        }
                    }

                    $new_url = '';

                    if (isset($tab['type_image']['url'])) {
                        $new_url = strstr($tab['type_image']['url'], '/img/cms/');
                        $new_url = Context::getContext()->shop->getBaseURL(true, true) . $new_url;
                    }

                    $parsedTab = array(
                        'products' => $products,
                        'uid' => $uid,
                        'type_image' => $new_url,
                        'type_icon' => isset($tab['type_icon']) ? $tab['type_icon'] : '',
                        'select_type_icon' => isset($tab['select_type']) ? $tab['select_type'] : '',
                        'title' => $tab['tab_title'],
                        'view' => $tab['view'],
                        'products_col' => isset($tab['products_col']) ? $tab['products_col'] : 'col-md-3',
                        'row' => isset($tab['items_per_column']) ? $tab['items_per_column'] : 1,
                        'product_list' => isset($tab['product_list']) ? $tab['product_list'] : 1,
                        'product_list_carousel' => isset($tab['product_list_carousel']) ? $tab['product_list_carousel'] : 1,
                        'use_animation' => isset($tab['use_animation']) ? $tab['use_animation'] : 0,
                        'show_more_button' => isset($tab['show_more_button']) ? $tab['show_more_button'] : 0,
                        'load_more' => $check,
                        'limit' => $tab['products_limit'],
                        'source' => $source,
                        'orderBy' => $tab['order_by'],
                        'order_way' => $tab['order_way'],
                        'brand_list' => $tab['brand_list']
                    );

                    if ($tab['view'] == 'sly') {
                        $parsedTab['product_list_sly'] = isset($tab['product_list_sly']) ? $tab['product_list_sly'] : 1;
                        $parsedTab['sly_to_show'] = isset($tab['sly_to_show']) ? $tab['sly_to_show'] : 6;
                        $parsedTab['sly_to_show_tablet'] = isset($tab['sly_to_show_tablet']) ? $tab['sly_to_show_tablet'] : 3;
                        $parsedTab['sly_to_show_mobile'] = isset($tab['sly_to_show_mobile']) ? $tab['product_list_sly'] : 2;
                        $config_obj = array();

                        if (isset($tab['products_display_sly']) &&
                            $tab['products_display_sly'] != ''
                        ) {
                            $configs = explode(',', $tab['products_display_sly']);

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
                                    'show' => isset($tab['sly_to_show']) ? $tab['sly_to_show'] : 4,
                                ),
                                array(
                                    'breakpoint' => 992,
                                    'show' => isset($tab['sly_to_show_tablet']) ? $tab['sly_to_show_tablet'] : 3,
                                ),
                                array(
                                    'breakpoint' => 768,
                                    'show' => isset($tab['sly_to_show_mobile']) ? $tab['sly_to_show_mobile'] : 2,
                                ),
                            );
                        }

                        $parsedTab['options_sly'] = Tools::jsonEncode($config_obj);
                    }

                    if ($tab['view'] == 'grid') {
                        $tab['slides_to_show'] = $this->calculateGrid($tab['slides_to_show']);
                        $tab['slides_to_show_tablet'] = $this->calculateGrid($tab['slides_to_show_tablet']);
                        $tab['slides_to_show_mobile'] = $this->calculateGrid($tab['slides_to_show_mobile']);

                        $parsedTab['slidesToShow'] = array(
                            'desktop' => $tab['slides_to_show'],
                            'tablet' => $tab['slides_to_show_tablet'],
                            'mobile' => $tab['slides_to_show_mobile'],
                        );

                    } else if ($tab['view'] == 'carousel') {
                        $parsedTab['arrows_position'] = $optionsSource['arrows_position'];
                        $show_dots = (in_array($tab['navigation'], ['dots', 'both' ]));
                        $show_arrows = (in_array($tab['navigation'], ['arrows', 'both']));
                        $config_obj = array();

                        if (isset($tab['products_display']) && $tab['products_display'] != '') {
                            $configs = explode(',', $tab['products_display']);

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
                                        'slidesToShow' => abs($tab['slides_to_show_tablet']),
                                        'slidesToScroll' => abs($tab['slides_to_show_tablet']),
                                    ),
                                ),
                                array(
                                    'breakpoint' => 576,
                                    'settings' => array(
                                        'slidesToShow' => abs($tab['slides_to_show_mobile']),
                                        'slidesToScroll' => abs($tab['slides_to_show_mobile']),
                                    ),
                                ),
                            );
                        }

                        $parsedTab['options'] = array(
                            'responsive' => $config_obj,
                            'dots' => true,
                            'infinite' => false,
                            'slidesToShow' => abs($tab['slides_to_show']),
                            'slidesToScroll' => abs($tab['slides_to_show']),
                            'rows' => abs($tab['items_per_column']),
                            'autoplay' => ('yes' === $tab['autoplay']),
                            'infinite' => ('yes' === $tab['infinite']),
                            'arrows' => $show_arrows,
                            'dots' => $show_dots,
                        );
                    }

                    $tabs[] = $parsedTab;
                }
            }

            $parsedOptions['tabs'] = $tabs;
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
                'tabs' => $parsedOptions,
                'url_ajax' => $this->context->link->getModuleLink('rbthemedream', 'view'),
            ));

            return $module->fetch('module:rbthemedream/views/templates/widget/rb-product-tab.tpl');
        } else {
            return;
        }
    }
}
