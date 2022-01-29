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

// Update notice
if (strpos($_SERVER['REQUEST_URI'], '?page=AdminRbthemesliderSlider') !== false) {
    rb_add_action('admin_notices', 'RbthemeSlider_dependency_notice');
}

function RbthemeSlider_dependency_notice()
{
    if (version_compare(PHP_VERSION, '5.3.0', '<') || !class_exists('DOMDocument')) {
        ?>
        <div class="RbthemeSlider_notice">
            <img src="<?php echo RB_VIEWS_URL.'img/admin/rb_80x80.png' ?>" alt="RbthemeSlider icon">
            <h1><?php rb_e('Server configuration issues detected!', 'RbthemeSlider') ?></h1>
            <p>
                <?php rb_e('phpQuery, an external library in RbthemeSlider, have unmet dependencies. It requires PHP5 with the following extensions installed: PHP DOM extension, PHP Multibyte String extension. Please contact with your hosting provider to resolve these dependencies, as it will likely prevent RbthemeSlider from functioning properly.', 'RbthemeSlider') ?>
                <strong><?php rb_e('This issue could result a blank page in slider builder.', 'RbthemeSlider') ?></strong>
            </p>
            <div class="clear"></div>
        </div>
        <?php
    }
}
