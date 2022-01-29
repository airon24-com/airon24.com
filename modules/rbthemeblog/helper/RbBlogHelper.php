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

require_once _PS_MODULE_DIR_.'rbthemeblog/rbthemeblog.php';

class RbBlogHelper
{
    public static function uploadImage()
    {
        // Nothing to do here atm
    }

    public static function now($str_user_timezone)
    {
        $date = new DateTime('now');
        // $date->setTimezone(new DateTimeZone($str_user_timezone));
        $str_server_now = $date->format('Y.m.d H:i:s');

        return $str_server_now;
    }

    public static function checkForArchives($type)
    {
        $id_shop = Context::getContext()->shop->id;

        switch ($type) {
            case 'year':
                $sql = new DbQuery();
                $sql->select('YEAR(sbp.date_add) as year, MONTH(sbp.date_add) as month, COUNT(sbp.id_rbblog_post) as nbPosts');
                $sql->from('rbblog_post', 'sbp');
                $sql->innerJoin('rbblog_post_shop', 'sbps', 'sbp.id_rbblog_post = sbps.id_rbblog_post AND sbps.id_shop = '.(int) $id_shop);
                $sql->where('sbp.date_add <= \''.RbBlogHelper::now(Configuration::get('RBTHEME_BLOG_TIMEZONE')).'\'');
                $sql->where('sbp.active = 1');
                $sql->groupBy('YEAR(sbp.date_add)');
                $sql->orderBy('year DESC');

                $result = Db::getInstance()->executeS($sql);

                return $result;

                break;

            case 'month':
                # code...
                break;
        }
    }
}
