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

class RbPrestashopWidgetCategorySub extends RbControl
{
    public $module;
    public $number_default = 5;
    public $number_max = 10;
    public $id_lang;

    public function __construct()
    {
        parent::__construct();

        $this->module = new Rbthemedream();
        $this->id_lang = Context::getContext()->language->id;
        $this->context = Context::getContext();
        $this->setControl();
    }

    public function setControl()
    {
        $categories = array();
        $id_category = 0;

        foreach ($this->getChildrenCate(Configuration::get('PS_HOME_CATEGORY'), $this->id_lang, $this->number_max) as $category) {
            $categories[$category['id_category']] = $category['name'];
            $id_category = $category['id_category'];
        }

        $this->startControlsSection(
            'section_title',
            array(
                'label' => $this->module->l('Category && Sub'),
            )
        );

        $this->addControl(
            'section_category_sub',
            array(
                'label' => $this->module->l('List'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'cate_list',
            array(
                'label' => '',
                'type' => 'repeater',
                'default' => array(),
                'section' => 'section_category_sub',
                'fields' => array(
                    array(
                        'max' => $this->number_max,
                        'name' => 'number_sub',
                        'label' => $this->module->l('Number sub categories'),
                        'type' => 'number',
                        'label_block' => true,
                        'default' => $this->number_default,
                    ),
                    array(
                        'name' => 'id_category',
                        'label' => $this->module->l('Categories'),
                        'type' => 'select',
                        'default' => $id_category,
                        'options' => $categories,
                    ),
                ),
            )
        );
    }

    public function getDataCategorySub()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Category && Sub Cate',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('prestashop'),
            'keywords' => '',
            'icon' => 'category-sub'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {
        if (!empty($instance['cate_list'])) {
            $categories = array();

            foreach ($instance['cate_list'] as $item_cate) {
                $obj_cate =  new Category($item_cate['id_category'], (int)$this->context->language->id);

                $sub_cate = $this->getChildrenCate(
                    $item_cate['id_category'],
                    $this->id_lang,
                    isset($item_cate['number_sub']) && (int)$item_cate['number_sub'] <= 10 && (int)$item_cate['number_sub'] > 0 ? (int)$item_cate['number_sub'] : $this->$this->number_max
                );

                if (!empty($sub_cate)) {
                    foreach ($sub_cate as $index => $sub) {
                        $sub_cate[$index]['url'] = $this->context->link->getCategoryLink($sub['id_category']);
                    }
                }

                $item = array(
                    'name' => $obj_cate->name,
                    'url' => $this->context->link->getCategoryLink($item_cate['id_category']),
                    'src' => $this->context->link->getCatImageLink($obj_cate->link_rewrite, $obj_cate->id_category, 'category_default'),
                    'sub_cate' => $sub_cate,
                );

                $categories[] = $item;
            }

            $this->context->smarty->assign(array(
                'rb_sub_categories' => $categories,
            ));

            return $this->module->fetch('module:rbthemedream/views/templates/widget/rb-category-sub.tpl');
        }

        return;
    }

    public function getChildrenCate($idParent, $idLang, $number_max, $active = true, $idShop = false)
    {
        if (!Validate::isBool($active)) {
            die(Tools::displayError());
        }

        $cacheId = 'Category::getChildren_' . (int) $idParent . '-' . (int) $idLang . '-' . (bool) $active . '-' . (int) $idShop;
        if (!Cache::isStored($cacheId)) {
            $query = 'SELECT c.`id_category`, cl.`name`, cl.`link_rewrite`, category_shop.`id_shop`
            FROM `' . _DB_PREFIX_ . 'category` c
            LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (c.`id_category` = cl.`id_category`' . Shop::addSqlRestrictionOnLang('cl') . ')
            ' . Shop::addSqlAssociation('category', 'c') . '
            WHERE `id_lang` = ' . (int) $idLang . '
            AND c.`id_parent` = ' . (int) $idParent . '
            ' . ($active ? 'AND `active` = 1' : '') . '
            GROUP BY c.`id_category`
            ORDER BY category_shop.`position` ASC LIMIT ' . (int)$number_max;
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            Cache::store($cacheId, $result);

            return $result;
        }

        return Cache::retrieve($cacheId);
    }
}
