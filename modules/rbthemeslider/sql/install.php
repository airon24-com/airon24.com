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
$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rbthemeslider` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `author` int(11) NOT NULL,
    `name` varchar(100) NULL DEFAULT NULL,
    `slug` varchar(100) NULL DEFAULT NULL,
    `data` mediumtext NOT NULL,
    `date_c` int(11) NOT NULL,
    `date_m` int(11) NOT NULL,
    `schedule_start` int(11) NOT NULL DEFAULT 0,
    `schedule_end` int(11) NOT NULL DEFAULT 0,
    `flag_hidden` tinyint(1) NOT NULL DEFAULT 0,
    `flag_deleted` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY  (id)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rbthemeslider_module` (
    `id_slider` int(11) NOT NULL,
    `id_shop` int(11) NOT NULL,
    `id_lang` int(11) NOT NULL,
    `hook` varchar(64) NOT NULL,
    `position` tinyint(2) NOT NULL DEFAULT 0,
    `pages` text NULL,
    PRIMARY KEY  (`id_slider`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'rbthemeslider_revisions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `slider_id` int(11) NOT NULL,
    `author` int(11) NOT NULL DEFAULT 0,
    `data` mediumtext NOT NULL,
    `date_c` int(11) NOT NULL,
    PRIMARY KEY  (id)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
