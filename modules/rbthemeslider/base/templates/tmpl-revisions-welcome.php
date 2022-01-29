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

if (defined('RB_INCLUDE')) {
    $notification = '';
}
?>
<div id="rb-revisions-welcome">

    <div class="wrap">

        <?php if (! empty($notification)) : ?>
        <div class="rb-notification-info">
            <i class="dashicons dashicons-info"></i>
            <?php echo $notification ?>
        </div>
        <?php endif ?>

        <?php if (! rb_get_option('RbthemeSlider-authorized-site', false)) : ?>
        <div class="rb-notification">
            <i class="dashicons dashicons-warning"></i>
            <?php echo sprintf(rb__('Slider Revisions is a premium feature. Activate your copy of RbthemeSlider in order to enjoy our premium benefits. %sPurchase a license%s or %sread the documentation%s to learn more. %sGot RbthemeSlider in a theme?%s', 'RbthemeSlider'), '<a href="http://codecanyon.net/cart/add_items?ref=kreatura&item_ids=1362246" target="_blank">', '</a>', '<a href="https://support.kreaturamedia.com/docs/RbthemeSliderwp/documentation.html#activation" target="_blank">', '</a>', '<a href="https://support.kreaturamedia.com/docs/RbthemeSliderwp/documentation.html#activation-bundles" target="_blank">', '</a>') ?>
        </div>
        <?php endif ?>

        <h1><?php rb_e('You Can Now Rewind Time', 'RbthemeSlider') ?></h1>
        <p class="center">
            <?php rb_e('Have a peace of mind knowing that your slider edits are always safe and you can revert back unwanted changes or faulty saves at any time. This feature serves not just as a backup solution, but a complete version control system where you can visually compare the changes you have made along the way.', 'RbthemeSlider') ?>
            <br><br>
            <a href="#" class="rb-revisions-options"><?php rb_e('Customize Revisions Preferences', 'RbthemeSlider') ?></a>
            <a target="_blank" href="#" class="rb-revisions-more-info"><?php rb_e('More Information', 'RbthemeSlider') ?></a>
        </p>
        <div class="center">
            <video autoplay loop muted>
                <source src="https://cdn1.kreaturamedia.com/media/revisions.mp4" type="video/mp4">
            </video>
        </div>
    </div>


    <script type="text/html" id="tmpl-revisions-options">
        <div id="rb-revisions-modal-window">
            <header>
                <h1><?php rb_e('Revisions Preferences', 'RbthemeSlider') ?></h1>
                <b class="dashicons dashicons-no"></b>
            </header>
            <form method="post" class="km-ui-modal-scrollable">
                <?php rb_nonce_field('rb-save-revisions-options'); ?>
                <input type="hidden" name="rb-revisions-options" value="1">
                <table>
                    <tr>
                        <td><input type="checkbox" name="rb-revisions-enabled" class="hero" data-warning="<?php rb_e('Disabling Slider Revisions will also remove all revisions saved so far. Are you sure you want to continue?', 'RbthemeSlider') ?>" <?php echo RbRevisions::$enabled ? 'checked' : '' ?>></td>
                        <td><?php rb_e('Enable Revisions', 'RbthemeSlider') ?></td>
                    </tr>
                </table>


                <div>
                    <h2 class="rb-revisions-h2"><?php rb_e('Update Frequency', 'RbthemeSlider') ?></h2>
                    <?php echo sprintf(rb__('Limit the total number of revisions per slider to %s.', 'RbthemeSlider'), '<input type="number" name="rb-revisions-limit" min="2" max="500" value="'.RbRevisions::$limit.'">') ?> <br>
                    <?php echo sprintf(rb__('Wait at least %s minutes between edits before adding a new revision.', 'RbthemeSlider'), '<input type="number" name="rb-revisions-interval" min="0" max="500" value="'.RbRevisions::$interval.'">') ?>
                </div>

                <div class="rb-notification-info">
                    <i class="dashicons dashicons-info"></i>
                    <?php rb_e('Slider Revisions also stores the undo/redo controls. There is no reason using very frequent saves since you will be able to undo the changes in-between.', 'RbthemeSlider') ?>
                </div>

                <button class="button button-primary button-hero"><?php rb_e('Update Revisions Preferences', 'RbthemeSlider') ?></button>
            </form>
        </div>
    </script>
</div>