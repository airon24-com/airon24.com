<?php
/**
 * 2007-2021 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2021 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

defined('_PS_VERSION_') or exit;

class PSOpts
{
    private static $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
    private static $products = array();

    private static function getProducts($lang, $id_category)
    {
        if (empty(self::$products[$lang])) {
            self::$products[$lang] = array();
            $products = &self::$products[$lang];

            $lang = (int) $lang;
            $id_category = (int) $id_category;

            $ps_ = _DB_PREFIX_;
            $res = Db::getInstance()->executeS("
                SELECT p.id_product, p.id_category_default, pl.name FROM {$ps_}product AS p
                LEFT JOIN {$ps_}product_lang AS pl ON p.id_product = pl.id_product
                WHERE pl.id_lang = $lang
                ORDER BY p.id_category_default, pl.name
            ");

            foreach ($res as &$product) {
                $cat = $product['id_category_default'];
                if (!isset($products[$cat])) {
                    $products[$cat] = array();
                }
                $products[$cat][] = &$product;
            }
        }

        return isset(self::$products[$lang][$id_category]) ? self::$products[$lang][$id_category] : array();
    }

    public static function getNestedCategories($root_category = null, $id_lang = false, $active = true)
    {
        $id_shop = Context::getContext()->shop->id;

        if (isset($root_category) && !Validate::isInt($root_category)) {
            die(Tools::displayError());
        }

        if (!Validate::isBool($active)) {
            die(Tools::displayError());
        }

        $result = Db::getInstance()->executeS('
            SELECT c.*, cl.* FROM `'._DB_PREFIX_.'category` c
            INNER JOIN '._DB_PREFIX_.'category_shop category_shop ON (category_shop.id_category = c.id_category AND category_shop.id_shop = 1)
            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON c.`id_category` = cl.`id_category` AND cl.id_shop = '.(int)$id_shop.'
            '.(isset($root_category) ? 'RIGHT JOIN `'._DB_PREFIX_.'category` c2 ON c2.`id_category` = '.(int)$root_category.
            ' AND c.`nleft` >= c2.`nleft` AND c.`nright` <= c2.`nright`' : '').'
            WHERE 1 '.($id_lang ? 'AND `id_lang` = '.(int)$id_lang : '').'
            '.($active ? ' AND c.`active` = 1' : '').'
            '.(!$id_lang ? ' GROUP BY c.`id_category`' : '').'
            '.' ORDER BY c.`level_depth` ASC, category_shop.`position` ASC');

        $categories = array();
        $buff = array();

        $root = (array)Category::getRootCategory();
        array_unshift($result, $root);

        if (!isset($root_category)) {
            $root_category = $root['id'];
        }

        foreach ($result as $row) {
            $current = &$buff[$row['id_category']];
            $current = $row;

            if ($row['id_category'] == $root_category) {
                $categories[$row['id_category']] = &$current;
            } else {
                $buff[$row['id_parent']]['children'][$row['id_category']] = &$current;
            }
        }

        return $categories;
    }

    private static function generateCategories(&$cats, &$a, $tabs = '')
    {
        foreach ($cats as &$cat) {
            if (empty($a)) {
                $a[] = array('value' => 'all', 'option' => '- All -');
                $a[] = array('value' => '', 'option' => '- None -');
                $a[] = array('value' => 'index', 'option' => $tabs.'▾ '.$cat['name']);
            } else {
                $a[] = array('value' => 'c-'.$cat['id_category'], 'option' => $tabs.'▾ '.$cat['name']);
            }

            if (isset($cat['children'])) {
                self::generateCategories($cat['children'], $a, $tabs.self::$tab);
            }

            $lang = (int)Context::getContext()->language->id;
            $prods = self::getProducts($lang, $cat['id_category']);
            foreach ($prods as &$prod) {
                $a[] = array('value' => 'p-'.$prod['id_product'], 'option' => $tabs.self::$tab.'▸ '.$prod['name']);
            }
        }
    }

    private static function generateCategoryList(&$cats, &$a, $tabs = '')
    {
        foreach ($cats as &$cat) {
            $a[] = (object) array('term_id' => $cat['id_category'], 'name' => $tabs.$cat['name']);

            if (isset($cat['children'])) {
                self::generateCategoryList($cat['children'], $a, $tabs.self::$tab);
            }
        }
    }

    private static function generateCMSCategories(&$e, &$a, $tabs = '')
    {
        if (empty($a)) {
            $a[] = array('value' => 'all', 'option' => '- All -');
            $a[] = array('value' => '', 'option' => '- None -');
            if (file_exists(dirname(__FILE__).'/../../psblog')) {
                $a[] = array('value' => 'psblogpostsmodulefront', 'option' => $tabs.'▸ '.'Blog home');
            }
            $a[] = array('value' => 'newproducts', 'option' => $tabs.'▸ '.'New products');
            $a[] = array('value' => 'bestsales', 'option' => $tabs.'▸ '.'Best sellers');
            $a[] = array('value' => 'pricesdrop', 'option' => $tabs.'▸ '.'Price drop');
            $a[] = array('value' => 'manufacturer-0', 'option' => $tabs.'▾ '.'Brands');
            $manufacturers = Manufacturer::getManufacturers();
            foreach ($manufacturers as &$manufacturer) {
                $a[] = array('value' => 'manufacturer-'.$manufacturer['id_manufacturer'], 'option' => self::$tab.$tabs.'▸ '.$manufacturer['name']);
            }
            $a[] = array('value' => 'supplier', 'option' => $tabs.'▸ '.'Suppliers');
            $a[] = array('value' => 'cart', 'option' => $tabs.'▾ '.'Cart');
            $a[] = array('value' => 'order', 'option' => self::$tab.$tabs.'▸ '.'Order');
            $a[] = array('value' => 'order-confirmation', 'option' => self::$tab.$tabs.'▸ '.'Order confirmation');
            $a[] = array('value' => 'contact', 'option' => $tabs.'▸ '.'Contact us');
            $a[] = array('value' => 'search', 'option' => $tabs.'▸ '.'Search');
            $a[] = array('value' => 'sitemap', 'option' => $tabs.'▸ '.'Sitemap');
            $a[] = array('value' => 'stores', 'option' => $tabs.'▸ '.'Stores');
            $a[] = array('value' => 'c-'.$e['id_cms_category'], 'option' => $tabs.'▾ '.'Pages');
        } else {
            $a[] = array('value' => 'c-'.$e['id_cms_category'], 'option' => $tabs.'▾ '.$e['name']);
        }

        if (isset($e['children'])) {
            foreach ($e['children'] as &$child) {
                self::generateCMSCategories($child, $a, $tabs.self::$tab);
            }
        }

        foreach ($e['cms'] as &$c) {
            $a[] = array('value' => 'p-'.$c['id_cms'], 'option' => $tabs.self::$tab.'▸ '.$c['meta_title']);
        }
    }

    private static function generatePBCategories(&$cats, &$news, &$a, $tabs = '')
    {
        foreach ($cats as &$e) {
            $a[] = array('value' => 'bc-'.$e['id'], 'option' => $tabs.'▾ '.$e['title']);

            if (isset($e['children'])) {
                self::generatePBCategories($e['children'], $news, $a, $tabs.self::$tab);
            }

            foreach ($news as &$n) {
                foreach ($n['categories'] as $cid => &$c) {
                    if ($e['id'] == $cid) {
                        $a[] = array('value' => 'bn-'.$n['id'], 'option' => $tabs.self::$tab.'▸ '.$n['title']);
                    }
                }
            }
        }
    }

    public static function getCategoryList()
    {
        $opts = array();
        $cats = method_exists('Category', 'getNestedCategories') ? Category::getNestedCategories() : self::getNestedCategories();
        if (empty($cats)) {
            $cats = self::getNestedCategories();
        }
        self::generateCategoryList($cats, $opts);
        return $opts;
    }

    public static function getCategories()
    {
        $opts = array();
        $cats = method_exists('Category', 'getNestedCategories') ? Category::getNestedCategories() : self::getNestedCategories();
        if (empty($cats)) {
            $cats = self::getNestedCategories();
        }
        self::generateCategories($cats, $opts);
        return $opts;
    }

    public static function getCMSCategories()
    {
        $opts = array();
        $cats = CMSCategory::getRecurseCategory();
        self::generateCMSCategories($cats, $opts);

        if (class_exists('CategoriesClass')) {
            $opts[] = array('value' => 'bc-0', 'option' => '▾ PrestaBlog');
            $blogcats = call_user_func(array('CategoriesClass', 'getListe'), null, true);
            $blognews = call_user_func(array('NewsClass', 'getListe'), null, true, 0, 0, null, 'NULL', 'ASC');
            self::generatePBCategories($blogcats, $blognews, $opts, self::$tab);
        }

        return $opts;
    }

    public static function getTagList()
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        
        if (Group::isFeatureActive()) {
            $groups = FrontController::getCurrentCustomerGroups();
            return $db->executeS('
                SELECT t.name, t.id_tag AS term_id
                FROM `'._DB_PREFIX_.'tag_count` pt
                LEFT JOIN `'._DB_PREFIX_.'tag` t ON (t.id_tag = pt.id_tag)
                WHERE pt.`id_group` '.(count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1').'
                AND pt.`id_lang` = '.(int)$id_lang.' AND pt.`id_shop` = '.(int)$context->shop->id.'
                ORDER BY t.name ASC');
        }
        return $db->executeS('
            SELECT t.name, t.id_tag AS term_id
            FROM `'._DB_PREFIX_.'tag_count` pt
            LEFT JOIN `'._DB_PREFIX_.'tag` t ON (t.id_tag = pt.id_tag)
            WHERE pt.id_group = 0 AND pt.`id_lang` = '.(int)$id_lang.' AND pt.`id_shop` = '.(int)$context->shop->id.'
            ORDER BY t.name ASC');
    }

    public static function getProductImgTypes()
    {
        $types = array('' => rb__('original size'));

        foreach (ImageType::getImagesTypes('products') as $type) {
            $types[$type['name']] = $type['name'] . ' (' . $type['width'] . ' x ' . $type['height'] . ')';
        }

        return $types;
    }
}
