<?php
/**
* 2007-2021 PrestaShop
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
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

defined('_PS_VERSION_') or exit;

class RbPosts
{
    // Stores the last query results
    public $post = null;
    public $posts = null;
    public $args = null;

    /**
     * Returns posts that matches the query params
     * @param  array      $args Array of WP_Query attributes
     * @return bool           Success of the query
     */
    public static function find($args = array())
    {
        // Crate new instance
        $instance = new self;
        $instance->args = $args;
        if ($instance->posts = rb_get_posts($args)) {
            $instance->post = $instance->posts[0];
        }
        return $instance;
    }

    public static function getPostTypes()
    {

        // Get post types
        $postTypes = rb_get_post_types();

        // Remove some defalt post types
        if (isset($postTypes['revision'])) {
            unset($postTypes['revision']);
        }
        if (isset($postTypes['nav_menu_item'])) {
            unset($postTypes['nav_menu_item']);
        }

        // Convert names to plural
        foreach ($postTypes as $key => $item) {
            if (!empty($item)) {
                $postTypes[$key] = array();
                $postTypes[$key]['slug'] = $item;
                $postTypes[$key]['obj'] = rb_get_post_type_object($item);
                $postTypes[$key]['name'] = $postTypes[$key]['obj']->labels->name;
            }
        }

        return $postTypes;
    }


    public function getParsedObject()
    {

        if (!$this->posts) {
            return array();
        }
        $link = Context::getContext()->link;
        $small = rb_get_image_type_name('small');
        $ret = array();
        foreach ($this->posts as $key => $val) {
            $ret[$key] = array();
            $ret[$key]['id'] = $val['id_product'];
            $ret[$key]['url'] = $link->getProductLink($val['id_product'], $val['link_rewrite']);
            $ret[$key]['date-published'] = $val['date_add'];
            $ret[$key]['date-modified'] = $val['date_upd'];
            $image = Image::getCover($val['id_product']);
            $ret[$key]['thumbnail'] = $link->getImageLink($val['link_rewrite'], $image['id_image'], $small);
            $ret[$key]['image-url'] = $link->getImageLink($val['link_rewrite'], $image['id_image'], $this->args['img_size']);
            if (empty($ret[$key]['thumbnail'])) {
                $ret[$key]['thumbnail'] = $ret[$key]['image-url'];
            }
            $ret[$key]['image'] = '<img src="'.$ret[$key]['image-url'].'" alt="">';
            $ret[$key]['price'] = Tools::displayPrice(Product::getPriceStatic($val['id_product']));
            $ret[$key]['old-price'] = Tools::displayPrice(Product::getPriceStatic($val['id_product'], true, null, 6, null, false, false));
            if ($ret[$key]['price'] === $ret[$key]['old-price']) {
                $ret[$key]['old-price'] = '';
            }
            $ret[$key]['name'] = $val['name'];
            $ret[$key]['title'] = $ret[$key]['name'].' '.$ret[$key]['price'];
            $ret[$key]['description'] = strip_tags($val['description']);
            $ret[$key]['description-short'] = strip_tags($val['description_short']);
            $ret[$key]['author'] = $val['manufacturer'];
            $ret[$key]['manufacturer'] = $val['manufacturer'];

            $catlinks = array();
            $cats = self::_getCategory($val['id_category_default'])->getParentsCategories();
            foreach ($cats as &$cat) {
                array_unshift($catlinks, '<a href="'.$link->getCategoryLink($cat['id_category'], $cat['link_rewrite']).'">'.$cat['name'].'</a>');
            }
            $ret[$key]['breadcrumbs'] = '<div>'.implode(' / ', $catlinks).'</div>';
            $ret[$key]['category'] = array_pop($catlinks);
        }
        return $ret;
    }


    public function getWithFormat($str, $textlength = 0)
    {
        if (!is_array($this->post)) {
            return $str;
        }
        $context = Context::getContext();

        // Post ID
        if (stripos($str, '[id]') !== false) {
            $str = str_replace('[id]', $this->post['id_product'], $str);
        }
        // Post URL
        if (stripos($str, '[url]') !== false) {
            $url = $context->link->getProductLink($this->post['id_product'], $this->post['link_rewrite']);
            $str = str_replace('[url]', $url, $str);
        }
        // Date published
        if (stripos($str, '[date-published]') !== false) {
            $str = str_replace('[date-published]', date(rb_get_option('date_format'), strtotime($this->post['date_add'])), $str);
        }
        // Date modified
        if (stripos($str, '[date-modified]') !== false) {
            $str = str_replace('[date-modified]', date(rb_get_option('date_format'), strtotime($this->post['date_upd'])), $str);
        }
        // Featured image
        if (stripos($str, '[image]') !== false) {
            $cover = Image::getCover($this->post['id_product']);
            $image = $context->link->getImageLink($this->post['link_rewrite'], $cover['id_image'], $this->args['img_size']);
            if (!empty($image)) {
                $str = str_replace('[image]', '<img src="'.$image.'" alt="'.$this->post['name'].'">', $str);
            }
        }
        // Featured image URL
        if (stripos($str, '[image-url]') !== false) {
            $cover = Image::getCover($this->post['id_product']);
            $image = $context->link->getImageLink($this->post['link_rewrite'], $cover['id_image'], $this->args['img_size']);
            if (!empty($image)) {
                $str = str_replace('[image-url]', $image, $str);
            }
        }
        // Name
        if (stripos($str, '[name]') !== false) {
            $str = str_replace('[name]', $this->getTitle($textlength), $str);
        }
        // Price & old price
        $priceTag = stripos($str, '[price]') !== false;
        $oldPriceTag = stripos($str, '[old-price]') !== false;

        if ($priceTag || $oldPriceTag) {
            $price = Tools::displayPrice(Product::getPriceStatic($this->post['id_product']));

            if ($priceTag) {
                $str = str_replace('[price]', $price, $str);
            }
            if ($oldPriceTag) {
                $oldPrice = Tools::displayPrice(Product::getPriceStatic($this->post['id_product'], true, null, 6, null, false, false));

                if ($price === $oldPrice) {
                    $oldPrice = '';
                }
                $str = str_replace('[old-price]', $oldPrice, $str);
            }
        }
        // Description
        if (stripos($str, '[description]') !== false) {
            $str = str_replace('[description]', $this->getDescription($textlength), $str);
        }
        // Description short
        if (stripos($str, '[description-short]') !== false) {
            $str = str_replace('[description-short]', $this->getDescriptionShort($textlength), $str);
        }
        // Manufacturer
        if (stripos($str, '[manufacturer]') !== false) {
            $str = str_replace('[manufacturer]', $this->post['manufacturer'], $str);
        }
        // Category
        if (stripos($str, '[category]') !== false) {
            $str = str_replace('[category]', $this->getCategory(), $str);
        }
        // Category list
        if (stripos($str, '[breadcrumbs]') !== false) {
            $str = str_replace('[breadcrumbs]', $this->getCategoryList(), $str);
        }

        return $str;
    }


    /**
     * Returns the lastly selected post's title
     * @return string The title of the post
     */
    public function getTitle($length = 0)
    {

        if (!is_array($this->post)) {
            return false;
        }

        $title = $this->post['name'];
        if (!empty($length)) {
            $title = Tools::substr($title, 0, $length);
        }

        return $title;
    }

    protected static function _getCategory($id)
    {
        static $cats = array();

        if (!empty($cats[$id])) {
            $cat = $cats[$id];
        } else {
            $cat = new Category($id, Context::getContext()->language->id);
            $cats[$id] = $cat;
        }
        return $cat;
    }

    public function getCategory($post = null)
    {
        if (empty($post)) {
            $post = $this->post;
        }

        $cat = self::_getCategory($post['id_category_default']);
        return empty($cat->name) ? '' : '<a href="'.$cat->getLink().'">'.$cat->name.'</a>';
    }

    public function getCategoryList($post = null)
    {
        if (empty($post)) {
            $post = $this->post;
        }

        $cat = self::_getCategory($post['id_category_default']);

        if (!empty($cat->name)) {
            $cats = $cat->getParentsCategories();
            $link = Context::getContext()->link;
            $list = array();
            foreach ($cats as &$cat) {
                array_unshift($list, '<a href="'.$link->getCategoryLink($cat['id_category'], $cat['link_rewrite']).'">'.$cat['name'].'</a>');
            }
            return '<div>'.implode(' / ', $list).'</div>';
        } else {
            return '';
        }
    }

    /**
     * Returns a subset of the post's content,
     * or the first paragraph if isn't specified
     * @param  integer $length The subset's length
     * @return string          The content
     */
    public function getDescription($length = false)
    {
        if (!is_array($this->post)) {
            return false;
        }

        $content = $this->post['description'];
        if (!empty($length)) {
            return Tools::substr(strip_tags($content), 0, $length);
        }
        return strip_tags($content);
    }

    public function getDescriptionShort($length = false)
    {

        if (!is_array($this->post)) {
            return false;
        }

        $content = rb__($this->post['description_short']);
        if (!empty($length)) {
            return Tools::substr(strip_tags($content), 0, $length);
        }
        return strip_tags($content);
    }
}
