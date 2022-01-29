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
<script type="text/html" id="rb-layer-item-template">
    <li>
        <span class="rb-sublayer-sortable-handle dashicons dashicons-menu"></span>
        <span class="rb-sublayer-controls">
            <span class="rb-icon-eye dashicons dashicons-visibility" data-help="<?php rb_e('Toggle layer visibility.', 'RbthemeSlider') ?>"></span>
            <span class="rb-icon-lock dashicons dashicons-lock disabled" data-help="<?php rb_e('Prevent layer dragging in the editor.', 'RbthemeSlider') ?>"></span>
        </span>
        <div class="rb-sublayer-thumb"></div>
        <input type="text" name="subtitle" class="rb-sublayer-title" value="<?php echo sprintf(rb__('Layer #%d', 'RbthemeSlider'), '1') ?>">
        <a href="#" title="<?php rb_e('Duplicate this layer', 'RbthemeSlider') ?>" class="dashicons dashicons-admin-page duplicate"></a>
        <a href="#" title="<?php rb_e('Remove this layer', 'RbthemeSlider') ?>" class="dashicons dashicons-trash remove"></a>
    </li>
</script>
