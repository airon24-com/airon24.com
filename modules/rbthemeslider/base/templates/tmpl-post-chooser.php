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
<script type="text/html" id="tmpl-post-chooser">
    <div id="rb-post-chooser-modal-window">
        <header>
            <h1><?php rb_e('Select the Post, Page or Attachment you want to use', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
        </header>
        <div class="km-ui-modal-scrollable">
            <form method="post">
                <?php rb_nonce_field('rb_get_search_posts') ?>
                <input type="hidden" name="action" value="rb_get_search_posts">
                <div class="search-holder">
                    <input type="search" name="s" placeholder="<?php rb_e('Type here to search ...', 'RbthemeSlider') ?>">
                </div>
                <select name="post_type">
                    <option value="page"><?php rb_e('Pages', 'RbthemeSlider') ?></option>
                    <option value="post"><?php rb_e('Posts', 'RbthemeSlider') ?></option>
                    <option value="attachment"><?php rb_e('Attachments', 'RbthemeSlider') ?></option>
                </select>
            </form>

            <div class="results rb-post-previews">
                <ul>

                </ul>
            </div>

        </div>
    </div>
</script>