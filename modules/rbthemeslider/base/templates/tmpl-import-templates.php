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
    $rbStoreHasUpdate = null;
    $validity = null;
    $slider = null;
    $rbDefaults = null;
    $rbStoreUpdate = null;
    $rbStoreData = null;
    $postTypes = $postCategories = $postTags = $postTaxonomies = null;
    $repoUrl = null;
    $root = null;
    $version = null;
    $itemID = 0;
    $codeKey = 0;
    $authKey = 0;
    $channelKey = 0;
}

$demoSliders = RbSources::getDemoSliders(); ?>
<script>
    window.rbImportNonce = '<?php echo rb_create_nonce('rb-import-demos'); ?>';
</script>
<script type="text/html" id="tmpl-import-sliders">
    <div id="rb-import-modal-window" class="rb-modal fullpage rb-box <?php echo $rbStoreHasUpdate ? 'has-updates' : '' ?>">
        <header class="header">
            <div class="RbthemeSlider-logo"></div>
            <h1>
                <?php rb_e('RbthemeSlider', 'RbthemeSlider') ?>
                <span><?php rb_e('Templates', 'RbthemeSlider') ?></span>
            </h1>

            <div class="last-update">
                <strong><?php rb_e('Last updated: ', 'RbthemeSlider') ?></strong>
                <span>
                    <?php
                    if ($rbStoreUpdate) {
                        echo rb_human_time_diff($rbStoreUpdate), rb__(' ago', 'RbthemeSlider');
                    } else {
                        rb_e('Just now', 'RbthemeSlider');
                    }
                    ?>
                </span>
                <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=update_store', 'update_store') ?>" class="button"><?php rb_e('Force Library Update', 'RbthemeSlider') ?></a>
            </div>
             <b class="dashicons dashicons-no"></b>
        </header>
        <div class="inner">
            <nav>
                <ul>
                    <li class="uppercase active" data-group="all"><?php rb_e('All', 'RbthemeSlider') ?></li>
                    <li class="uppercase" data-group="free"><?php rb_e('All free', 'RbthemeSlider') ?></li>
                    <li class="uppercase" data-group="premium"><?php rb_e('All Premium', 'RbthemeSlider') ?></li>
                    <?php if (count($demoSliders)) : ?>
                        <li class="uppercase" data-group="bundled"><?php rb_e('Bundled', 'RbthemeSlider') ?></li>
                    <?php endif; ?>
                    <li class="uppercase separator" data-group="packs"><?php rb_e('SLIDER PACKS', 'RbthemeSlider') ?></li>

                    <li data-group="fullwidth"><?php rb_e('Full-width', 'RbthemeSlider') ?></li>
                    <li data-group="fullsize"><?php rb_e('Full-size', 'RbthemeSlider') ?></li>

                    <li data-group="landing"><?php rb_e('Landing Page', 'RbthemeSlider') ?></li>
                    <li data-group="parallax"><?php rb_e('Parallax', 'RbthemeSlider') ?></li>
                    <li data-group="loop"><?php rb_e('Loop', 'RbthemeSlider') ?></li>
                    <li data-group="text"><?php rb_e('Text Transition', 'RbthemeSlider') ?></li>
                    <li data-group="kenburns"><?php rb_e('Ken Burns', 'RbthemeSlider') ?></li>
                    <li data-group="playbyscroll"><?php rb_e('Play By Scroll', 'RbthemeSlider') ?></li>
                    <li data-group="filter"><?php rb_e('Filter Transition', 'RbthemeSlider') ?></li>
                    <li data-group="blendmode"><?php rb_e('Blend Modes', 'RbthemeSlider') ?></li>
                    <li data-group="carousel"><?php rb_e('Carousel', 'RbthemeSlider') ?></li>
                    <li data-group="media"><?php rb_e('Media', 'RbthemeSlider') ?></li>

                    <li data-group="experiments"><?php rb_e('Experimental', 'RbthemeSlider') ?></li>
                    <li data-group="specialeffects"><?php rb_e('Special Effects', 'RbthemeSlider') ?></li>

                    <li data-group="3dtransition"><?php rb_e('3D Transition', 'RbthemeSlider') ?></li>
                    <li data-group="api"><?php rb_e('API', 'RbthemeSlider') ?></li>
                </ul>
            </nav>

            <div class="items">
                <?php
                if (! empty($rbStoreData) && ! empty($rbStoreData['sliders'])) {
                    $demoSliders = array_merge($demoSliders, $rbStoreData['sliders']);
                }
                $now = time();
                foreach ($demoSliders as $handle => $item) : ?>
                    <figure class="item" data-groups="<?php echo $item['groups'] ?>" data-handle="<?php echo $handle; ?>" data-bundled="<?php echo ! empty($item['bundled']) ? 'true' : 'false' ?>" data-premium-warning="<?php echo (! $validity && ! empty($item['premium'])) ? 'true' : 'false' ?>" data-version-warning="<?php echo version_compare($item['requires'], RB_PLUGIN_VERSION, '>') ? 'true' : 'false' ?>">
                        <div class="aspect">
                            <div class="item-picture" style="background: url(<?php echo $item['preview'] ?>);">
                            </div>
                            <figcaption>
                                <span><?php echo $item['name'] ?></span>
                            </figcaption>
                            <a class="item-preview" target="_blank" href="<?php echo ! empty($item['url']) ? $item['url'] : '#' ?>" ><b class="dashicons dashicons-format-image"></b><?php rb_e('preview', 'RbthemeSlider') ?></a>
                            <a class="item-import" href="#"><?php rb_e('import', 'RbthemeSlider') ?><b class="dashicons dashicons-download"></b></a>

                            <?php if (! empty($item['released'])) : ?>
                                <?php if (strtotime($item['released']) + MONTH_IN_SECONDS > $now) :  ?>
                                <span class="badge-new"><?php rb_ex('NEW', 'Template Store', 'RbthemeSlider') ?>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                    </figure>
                <?php
                endforeach; ?>
                <figure class="coming-soon">
                    <div class="aspect">
                        <table class="absolute-wrapper">
                            <tr>
                                <td>
                                    <span><?php rb_e('Coming soon,<br>stay tuned!', 'RbthemeSlider') ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</script>