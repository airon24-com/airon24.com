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

class RbsizeguideList extends ObjectModel
{
    public $id_rbsizeguide_list;
    public $title;
    public $content;
    public $active;

    public static $definition = array(
        'table' => 'rbsizeguide_list',
        'primary' => 'id_rbsizeguide_list',
        'multilang' => true,
        'multilang_shop' => true,
        'fields' => array(
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
            'content' => array('type' => self::TYPE_HTML,'lang' => true, 'validate' => 'isCleanHtml'),
            'active' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 1, 'required' => true),
        ),
    );

    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
        $this->context = Context::getContext();
        $this->def['table'] = self::$definition['table'];
        ShopCore::addTableAssociation($this->def['table'], array('type' => 'shop'));
        
        parent::__construct($id, $id_lang, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        if (!parent::add($autodate, $null_values)) {
            return false;
        }

        return true;
    }

    public function getSizeListActive($active = 1)
    {
        return Db::getInstance()->executeS(
            'SELECT size.*, size_lang.`title`, size_lang.`content`
            FROM `'._DB_PREFIX_.'rbsizeguide_list` size
            LEFT JOIN `'._DB_PREFIX_.'rbsizeguide_list_lang` size_lang
            ON size.`id_rbsizeguide_list` = size_lang.`id_rbsizeguide_list`
            WHERE size_lang.`id_lang` = '. (int)$this->context->language->id .'
            AND size_lang.`id_shop` = '. (int)$this->context->shop->id .'
            AND size.`active` = ' . (int)$active
        );
    }
}
