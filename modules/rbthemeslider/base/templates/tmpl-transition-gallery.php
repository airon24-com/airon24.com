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
?>
<script type="text/html" id="tmpl-rb-transition-modal">
    <div id="rb-transition-window">
        <header>
            <h1><?php rb_e('Choose a slide transition to import', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
            <div id="transitionmenu" class="filters buildermenu">
                <span><?php rb_e('Show Transitions:', 'RbthemeSlider') ?></span>
                <ul>
                    <li class="active"><?php rb_e('2D', 'RbthemeSlider') ?></li>
                    <li><?php rb_e('3D', 'RbthemeSlider') ?></li>
                </ul>
            </div>
        </header>
        <div class="km-ui-modal-scrollable inner">
            <div id="rb-transitions-list">

                <!-- 2D -->
                <section data-tr-type="2d_transitions"></section>

                <!-- 3D -->
                <section data-tr-type="3d_transitions"></section>
            </div>
        </div>
    </div>
</script>