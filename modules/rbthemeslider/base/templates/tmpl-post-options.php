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
    $slider = null;
    $postTypes = $postCategories = $postTags = $postTaxonomies = null;
    $rbDefaults = null;
}

$queryArgs = array(
    'post_status' => 'publish',
    'limit' => 100,
    'posts_per_page' => 100,
    'suppress_filters' => false,
    'img_size' => null,
);

if (!empty($slider['properties']['post_orderby'])) {
    $queryArgs['orderby'] = $slider['properties']['post_orderby'];
}
if (!empty($slider['properties']['post_order'])) {
    $queryArgs['order'] = $slider['properties']['post_order'];
}
if (!empty($slider['properties']['post_type'])) {
    $queryArgs['post_type'] = $slider['properties']['post_type'];
}
if (!empty($slider['properties']['post_categories'][0])) {
    $queryArgs['category__in'] = $slider['properties']['post_categories'];
}
if (!empty($slider['properties'][0])) {
    $queryArgs['tag__in'] = $slider['properties']['post_tags'];
}
if (!empty($slider['properties']['post_tax_terms'])) {
    $queryArgs['img_size'] = $slider['properties']['post_tax_terms'];
}

$posts = RbPosts::find($queryArgs)->getParsedObject();
?>
<script type="text/javascript" class="rb-hidden" id="rb-posts-json">window.RbPostsJSON = <?php echo $posts ? Tools::jsonEncode($posts) : '[]' ?>;</script>
<div id="rb-post-options">
    <div class="rb-box rb-modal rb-configure-posts-modal">
        <h2 class="header">
            <?php rb_e('Find products with the filters below', 'RbthemeSlider') ?>
            <a href="#" class="dashicons dashicons-no"></a>
        </h2>
        <div style="text-align: right; padding: 5px;">
            <label><?php rb_e('Advanced', 'RbthemeSlider') ?></label><input type="checkbox" id="rb-post-settings-adv">
        </div>
        <div class="rb-post-basic" style="width: 140px; margin: 0 auto 10px;">
            <label><input type="radio" name="post_basic" value="date_add"> <?php rb_e('New Arrivals', 'RbthemeSlider') ?></label><br>
            <label><input type="radio" name="post_basic" value="position"> <?php rb_e('Popular', 'RbthemeSlider') ?></label><br>
            <label><input type="radio" name="post_basic" value="quantity"> <?php rb_e('Best Sellers', 'RbthemeSlider') ?></label><br>
            <label><input type="radio" name="post_basic" value="reduction"> <?php rb_e('Special', 'RbthemeSlider') ?></label>
        </div>
        <div class="rb-post-advanced">
            <div class="inner clearfix">
                <div class="rb-post-filters clearfix">

                    <!-- Post types -->
                    <select data-param="post_type" name="post_type" class="multiple" multiple="multiple">
                    <?php foreach ($postTypes as $item) : ?>
                        <?php if (isset($slider['properties']['post_type']) &&  in_array($item['slug'], $slider['properties']['post_type'])) : ?>
                            <option value="<?php echo $item['slug'] ?>" selected="selected"><?php echo Tools::ucfirst($item['name']) ?></option>
                        <?php else : ?>
                            <option value="<?php echo $item['slug'] ?>"><?php echo Tools::ucfirst($item['name']) ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                    </select>

                    <!-- Post categories -->
                    <select data-param="post_categories" name="post_categories" class="multiple" multiple="multiple">
                        <option value="0"><?php rb_e("Don't filter categories", "RbthemeSlider") ?></option>
                    <?php foreach ($postCategories as $item) : ?>
                        <?php if (isset($slider['properties']['post_categories']) && in_array($item->term_id, $slider['properties']['post_categories'])) : ?>
                            <option value="<?php echo $item->term_id ?>" selected="selected"><?php echo $item->name ?></option>
                        <?php else : ?>
                            <option value="<?php echo $item->term_id ?>"><?php echo $item->name ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                    </select>

                    <!-- Post tags -->
                    <select data-param="post_tags" name="post_tags" class="multiple" multiple="multiple">
                        <option value="0"><?php rb_e("Don't filter tags", "RbthemeSlider") ?></option>
                    <?php foreach ($postTags as $item) : ?>
                        <?php if (isset($slider['properties']['post_tags']) && in_array($item->term_id, $slider['properties']['post_tags'])) : ?>
                            <option value="<?php echo $item->term_id ?>" selected="selected"><?php echo Tools::ucfirst($item->name) ?></option>
                        <?php else : ?>
                            <option value="<?php echo $item->term_id ?>"><?php echo Tools::ucfirst($item->name) ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                    </select>

                    <!-- Post taxonomies -->
                    <select data-param="post_taxonomy" name="post_taxonomy" class="rb-post-taxonomy">
                        <option value="0"><?php rb_e("Don't filter taxonomies", "RbthemeSlider") ?></option>
                    <?php foreach ($postTaxonomies as $key => $item) : ?>
                        <?php if (isset($slider['properties']['post_taxonomy']) && $slider['properties']['post_taxonomy'] == $key) : ?>
                            <option value="<?php echo $item->name ?>" selected="selected"><?php echo $item->laberb->name ?></option>
                        <?php else : ?>
                            <option value="<?php echo $item->name ?>"><?php echo $item->laberb->name ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                    </select>
                </div>
            </div>
            <h3 class="subheader clearfix">
                <div class="half"><?php rb_e('Order results by', 'RbthemeSlider') ?></div>
                <div class="half">
                    <div class="half"><?php rb_e('Image size', 'RbthemeSlider') ?></div>
                    <div class="half"><?php rb_e('On this slide', 'RbthemeSlider') ?></div>
                </div>
            </h3>
            <div class="rb-post-adv-settings clearfix">

                <!-- Order  -->
                <div class="half">
                    <?php rbGetSelect($rbDefaults['slider']['postOrderBy'], $slider['properties'], array('data-param' => $rbDefaults['slider']['postOrderBy']['keys'])) ?>
                    <?php rbGetSelect($rbDefaults['slider']['postOrder'], $slider['properties'], array('data-param' => $rbDefaults['slider']['postOrder']['keys'])) ?>
                </div>

                <div class="half" style="padding:0">
                    <div class="half">
                        <!-- Taxonomy terms -->
                        <?php rbGetSelect($rbDefaults['slider']['postTaxTerms'], $slider['properties'], array('data-param' => $rbDefaults['slider']['postTaxTerms']['keys'])) ?>
                    </div>
                    <div class="half">
                        <!-- Post offset -->
                        <?php rb_e('Get the ', 'RbthemeSlider') ?>
                        <select data-param="post_offset" name="post_offset" class="offset">
                            <option value="-1"><?php rb_e('following', 'RbthemeSlider') ?></option>
                        <?php for ($c = 0; $c < 50; $c++) : ?>
                            <option value="<?php echo $c ?>"><?php echo rb_ordinal_number($c+1) ?></option>
                        <?php endfor ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="subheader preview-subheader"><?php rb_e('Preview from currenty matched elements', 'RbthemeSlider') ?></h3>
        <div class="rb-post-previews"><ul></ul></div>
    </div>
</div>
