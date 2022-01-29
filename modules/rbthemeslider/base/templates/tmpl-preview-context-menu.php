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
<script type="text/html" id="tmpl-rb-preview-context-menu">
    <div class="rb-preview-context-menu">
        <ul>
            <li class="group">
                <i class="dashicons dashicons-plus"></i>
                <?php rb_e('Add Layer', 'RbthemeSlider') ?>
                <div>
                    <ul class="rb-context-add-layer">
                        <li data-type="img">
                            <i class="dashicons dashicons-format-image"></i>
                            <?php rb_e('Image', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="text">
                            <i class="dashicons dashicons-text"></i>
                            <?php rb_e('Text', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="button">
                            <i class="dashicons dashicons-marker"></i>
                            <?php rb_e('Button', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="media">
                            <i class="dashicons dashicons-video-alt3"></i>
                            <?php rb_e('Video / Audio', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="html">
                            <i class="dashicons dashicons-editor-code"></i>
                            <?php rb_e('HTML', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="post">
                            <i class="dashicons dashicons-admin-post"></i>
                            <?php rb_e('Dynamic Layer', 'RbthemeSlider') ?>
                        </li>
                        <li data-type="import">
                            <i class="dashicons dashicons-upload"></i>
                            <?php rb_e('Import Layer', 'RbthemeSlider') ?>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="group rb-context-overlapping-layers">
                <i class="dashicons dashicons-menu"></i>
                <?php rb_e('Overlapping Layers', 'RbthemeSlider') ?>
                <div>
                    <ul></ul>
                </div>
            </li>
            <li class="rb-context-menu-duplicate">
                <i class="dashicons dashicons-admin-page"></i>
                <?php rb_e('Duplicate Layer', 'RbthemeSlider') ?>
            </li>
            <li class="rb-context-menu-remove">
                <i class="dashicons dashicons-trash"></i>
                <?php rb_e('Remove Layer', 'RbthemeSlider') ?>
            </li>
            <li class="divider"></li>
            <li class="rb-context-menu-copy-layer">
                <i class="dashicons dashicons-clipboard"></i>
                <?php rb_e('Copy Layer') ?>
            </li>
            <li class="rb-context-menu-paste-layer">
                <i class="dashicons dashicons-admin-page"></i>
                <?php rb_e('Paste Layer') ?>
            </li>
            <li class="divider"></li>
            <li class="rb-context-menu-hide">
                <i class="dashicons dashicons-visibility"></i>
                <?php rb_e('Toggle Layer Visibility', 'RbthemeSlider') ?>
            </li>
            <li class="rb-context-menu-lock">
                <i class="dashicons dashicons-lock"></i>
                <?php rb_e('Toggle Layer Locking', 'RbthemeSlider') ?>
            </li>
            <li class="divider"></li>
            <li class="rb-context-menu-copy-styles">
                <i class="dashicons dashicons-clipboard"></i>
                <?php rb_e('Copy Layer Styles') ?>
            </li>
            <li class="rb-context-menu-paste-styles">
                <i class="dashicons dashicons-admin-page"></i>
                <?php rb_e('Paste Layer Styles') ?>
            </li>
        </ul>
    </div>
</script>