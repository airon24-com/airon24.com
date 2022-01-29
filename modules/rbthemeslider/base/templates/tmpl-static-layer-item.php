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
<script type="text/html" id="rb-static-layer-item-template">
    <li>
        <a href="#" class="dashicons dashicons-redo rb-icon-jump" data-help="<?php rb_e('Click this icon to jump to the slide where this layer was added on, so you can quickly edit its settings.', 'RbthemeSlider') ?>"></a>
        <div class="rb-sublayer-thumb"></div>
        <span class="rb-sublayer-title"><?php echo sprintf(rb__('Layer #%d', 'RbthemeSlider'), '1') ?></span>
    </li>
</script>
