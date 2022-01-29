{**
* PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License 3.0 (AFL-3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/AFL-3.0
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
* @author PrestaShop SA <contact@prestashop.com>
  * @copyright PrestaShop SA
  * @license https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
  * International Registered Trademark & Property of PrestaShop SA
  *}
{assign var=theme_dir value=_PS_THEME_DIR_}
  {block name='product_miniature_item'}
  <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    {if isset($position)}
    <meta itemprop="position" content="{$position}" />{/if}
    <article
      class="product-miniature js-product-miniature{if isset($config)} {$config}{else if Configuration::get('RBTHEMEDREAM_COL_PRODUCT_LIST') != ''} {Configuration::get('RBTHEMEDREAM_COL_PRODUCT_LIST')}{else} col-md-3{/if}"
      data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope
      itemtype="http://schema.org/Product">
      <div class="thumbnail-container">
        <div class="product-image">
          {block name='product_thumbnail'}
          {if $product.cover}
          <a href="{$product.url}" class="thumbnail product-thumbnail">
            <img 
              class="img-fluid rb-cover" 
              src="{$product.cover.bySize.home_default.url}"
              alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
              data-full-size-image-url="{$product.cover.large.url}"
              loading="lazy"
              width="{$product.cover.bySize.home_default.width}"
              height="{$product.cover.bySize.home_default.height}"
            >
            {if !empty($product.images)}
            {$count = 1}

            {foreach from=$product.images item=image}
            {if $count == 1 && $image.cover != 1 && $image.id_image != $product.cover.id_image}
            <div class="product-hover">
              <img 
                class="img-fluid rb-image image-hover" 
                src="{$image.bySize.home_default.url}"
                alt = "{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                title="{$product.name|truncate:30:'...'}" 
                loading="lazy"
                width="{$image.bySize.home_default.width}"
                height="{$image.bySize.home_default.height}"
              >
            </div>

            {$count = $count + 1}
            {/if}
            {/foreach}
            {/if}
          </a>
          {else}
          <a href="{$product.url}" class="thumbnail product-thumbnail">
            <img
              class="img-fluid"
              src="{$urls.no_picture_image.bySize.home_default.url}"
              alt = "{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
              loading="lazy"
              width="{$urls.no_picture_image.bySize.home_default.width}"
              height="{$urls.no_picture_image.bySize.home_default.height}"
            />
          </a>
          {/if}
          {/block}

          {block name='product_flags'}
          <ul class="product-flags">
            {foreach from=$product.flags item=flag}
            <li class="product-flag {$flag.type}">{$flag.label}</li>
            {/foreach}
          </ul>
          {/block}

          {include file="$theme_dir/templates/catalog/rb-ajax-load.tpl"}

          <div class="functional-buttons clearfix">
            {block name='add_to_cart'}
            <div class="product-add-cart">
              {hook h='displayRbAddToCart' product=$product}
            </div>
            {/block}
            {block name='product-wishlist'}
            {hook h='displayRbWishListProduct' product=$product}
            {/block}

            {block name='quick_view'}
            <div class="product-quickview hidden-sm-down">
              <a class="rb-quick-view rb-btn-product" href="#" data-link-action="quickview">
                <i class="icon-Icon_Quick-view"></i>
                <span class="icon-title">{l s='Quick view' d='Shop.Theme.Actions'}</span>
              </a>
            </div>

            <div class="product-quick-view" style="display:none;">
              <a class="quick-view rb-btn-product" href="#" data-link-action="quickview">
                <i class="icon-Icon_Quick-view search"></i>
                <span class="icon-title">{l s='Quick view' d='Shop.Theme.Actions'}</span>
              </a>
            </div>
            {/block}

            {*{block name='rb_compare'}
            <div class="product-compare">
              {hook h='displayRbCompareProduct' product=$product}
            </div>
            {/block}*}
          </div>

          {block name='product_countdown'}
          {hook h='displayRbProductCountDown' product=$product}
          {/block}
        </div>


        <div class="product-meta">
          <div class="meta-top">
            {block name='product-brand'}
            {hook h='displayRbBrandProduct' product=$product}
            {/block}

            {block name='product_reviews'}
            {hook h='displayRbReviewProduct' product=$product type='num_star'}
            {hook h='displayProductListReviews' product=$product}
            {/block}
          </div>

          {block name='product_name'}
          {if $page.page_name == 'index'}
          <h3 class="h3 product-title" itemprop="name"><a href="{$product.url}" itemprop="url"
              content="{$product.url}">{$product.name|truncate:40:'...'}</a></h3>
          {else}
          <h2 class="h3 product-title" itemprop="name"><a href="{$product.url}" itemprop="url"
              content="{$product.url}">{$product.name|truncate:40:'...'}</a></h2>
          {/if}
          {/block}

          {block name='product_price_and_shipping'}
          {if $product.show_price}
          <div class="product-price-and-shipping">
            {if $product.has_discount}
            {hook h='displayProductPriceBlock' product=$product type="old_price"}

            <span class="regular-price"
              aria-label="{l s='Regular price' d='Shop.Theme.Catalog'}">{$product.regular_price}</span>
            {*{if $product.discount_type === 'percentage'}
            <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
            {elseif $product.discount_type === 'amount'}
            <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
            {/if}*}
            {/if}

            {hook h='displayProductPriceBlock' product=$product type="before_price"}

            <span class="price" aria-label="{l s='Price' d='Shop.Theme.Catalog'}">{$product.price}</span>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="invisible">
              <meta itemprop="priceCurrency" content="{$currency.iso_code}" />
              <meta itemprop="price" content="{$product.price_amount}" />
            </div>

            {hook h='displayProductPriceBlock' product=$product type='unit_price'}

            {hook h='displayProductPriceBlock' product=$product type='weight'}
          </div>
          {/if}
          {/block}
          <div class="list-buttons clearfix">
            {block name='add_to_cart'}
            <div class="product-add-cart">
              {hook h='displayRbAddToCart' product=$product}
            </div>
            {/block}
            {block name='product-wishlist'}
            {hook h='displayRbWishListProduct' product=$product}
            {/block}
          </div>
          {block name='product_description_short'}
          <div class="product-description-short" itemprop="description">{$product.description_short nofilter}</div>
          {/block}
        </div>



        {*<div class="highlighted-informations{if !$product.main_variants} no-variants{/if} hidden-sm-down">
          {block name='product_variants'}
          {if $product.main_variants}
          {include file="$theme_dir/templates/catalog/_partials/variant-links.tpl" variants=$product.main_variants}
          {/if}
          {/block}
        </div>*}
      </div>
    </article>
  </div>
  {/block}