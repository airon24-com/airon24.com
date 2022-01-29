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

function rbthemeslider_convert()
{

    // Get old sliders if any
    $sliders = rb_get_option('rbthemeslider-slides', array());
    $sliders = is_array($sliders) ? $sliders : unserialize($sliders);

    // Create new storage in DB
    rbthemeslider_create_db_table();

    // Iterate over them
    if (!empty($sliders) && is_array($sliders)) {
        foreach ($sliders as $key => $slider) {
            RbSliders::add($slider['properties']['title'], $slider);
        }
    }

    // Remove old data and exit
    rb_delete_option('rbthemeslider-slides');
    rb_redirect('admin.php?page=AdminRbthemesliderSlider');
}


function rbSliderById($id)
{
    $args = is_numeric($id) ? (int) $id : array('limit' => 1);
    $slider = RbSliders::find($args);

    if ($slider == null) {
        return false;
    }

    return $slider;
}

function RbSliders($limit = 50, $desc = true, $withData = false)
{

    $args = array();
    $args['limit'] = $limit;
    $args['order'] = ($desc === true) ? 'DESC' : 'ASC';
    $args['data'] = ($withData === true) ? true : false;

    $sliders = RbSliders::find($args);

    // No results
    if ($sliders == null) {
        return array();
    }

    return $sliders;
}
