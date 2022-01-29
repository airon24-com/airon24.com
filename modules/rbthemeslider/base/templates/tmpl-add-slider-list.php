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
<script type="text/html" id="tmpl-rb-add-slider-list">
    <form method="post" id="rb-add-slider-template-list" class="rb-pointer rb-box">
        <?php rb_nonce_field('add-slider'); ?>
        <input type="hidden" name="rb-add-new-slider" value="1">
        <span class="rb-mce-arrow"></span>
        <h3 class="header"><?php rb_e('Name your new slider', 'RbthemeSlider') ?></h3>
        <div class="inner">
            <input type="text" name="title" placeholder="<?php rb_e('e.g. Homepage slider', 'RbthemeSlider') ?>">
            <button class="button"><?php rb_e('Add slider', 'RbthemeSlider') ?></button>
        </div>
    </form>
</script>