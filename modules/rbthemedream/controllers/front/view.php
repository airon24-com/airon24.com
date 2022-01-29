<?php
/**
* 2007-2020 PrestaShop
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
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once(_PS_MODULE_DIR_.'rbthemedream/classes/RbthemedreamHome.php');
require_once(_PS_MODULE_DIR_.'rbthemedream/lib/rb-front.php');
require_once(_PS_MODULE_DIR_.'rbthemedream/lib/control/rb-control.php');

class RbthemedreamviewModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        $this->context = Context::getContext();
        $this->id_lang = $this->context->language->id;
        $this->id_shop = $this->context->shop->id;

        parent::__construct();
    }

    public function setMedia()
    {
        parent::setMedia();

        $this->context->controller->registerStylesheet(
            'modules-rbthemedream-view',
            'modules/'.$this->module->name.'/views/css/view.css',
            array(
                'media' => 'all',
                'priority' => 150
            )
        );
    }

    public function initContent()
    {
        parent::initContent();
        
        if (Tools::isSubmit('ajax')) {
            $action = Tools::getValue('action');

            if (!empty($action) && method_exists($this, 'ajaxProcess'.Tools::toCamelCase($action))) {
                $this->{'ajaxProcess'.Tools::toCamelCase($action)}();
            } else {
                die(Tools::jsonEncode(array(
                    'error' => $this->trans(
                        'Method doesn\'t exist',
                        array(),
                        'Shop.Theme.Catalog'
                    )
                )));
            }
        }

        $content = '';

        if (Tools::getIsset('id_rbthemedream_home') &&
            Tools::getIsset('page') &&
            Tools::getValue('page') == 'home'
        ) {
            $id_rbthemedream_home = Tools::getValue('id_rbthemedream_home');
            $home = new RbthemedreamHome($id_rbthemedream_home, $this->id_lang);

            if ($home->data != '') {
                $front = new RbFront(Tools::jsonDecode($home->data, true));
                $content = $front->applyBuilderInContent();
            }
        }

        $this->context->smarty->assign(array(
            'content' => $content,
        ));

        $this->setTemplate('module:rbthemedream/views/templates/front/view.tpl');
    }

    public function ajaxProcessLoadMoreProduct()
    {
        $token = Tools::getToken(false);

        if ($token != Tools::getValue('token')) {
            die(Tools::jsonEncode(array(
                'success' => 0,
                'message' => $this->l('Invalid Token')
            )));
        }

        $obj_control = new RbControl();
        $show_more = 1;
        
        $products = $obj_control->getProducts(
            Tools::getValue('source'),
            Tools::getValue('limit'),
            Tools::getValue('orderBy'),
            Tools::getValue('orderWay'),
            Tools::getValue('brand_list'),
            Tools::getValue('page')
        );

        $product_limits = $obj_control->getProducts(
            Tools::getValue('source'),
            Tools::getValue('limit') + 1,
            Tools::getValue('orderBy'),
            Tools::getValue('orderWay'),
            Tools::getValue('brand_list'),
            Tools::getValue('page')
        );

        if (count($product_limits) == count($products)) {
            $show_more = 0;
        }

        $this->context->smarty->assign(array(
            'page' => $this->getTemplateVarPage(),
            'rb_ajax' => 1,
            'urls' => array(
                'pages' => array(
                    'cart' => $this->context->link->getPageLink('cart', true),
                ),
            ),
            'show_more' => $show_more,
            'use_animation' => Tools::getValue('use_animation'),
            'products' => $products,
            'product_list' => Tools::getValue('list'),
            'products_col' => Tools::getValue('col'),
            'row' => Tools::getValue('row'),
        ));

        die(Tools::jsonEncode(array(
            'success' => 1,
            'show_more' => $show_more,
            'page' => Tools::getValue('page') + 1,
            'message' => $this->module->fetch('module:rbthemedream/views/templates/widget/rb-product-tab.tpl'),
        )));
    }
}
