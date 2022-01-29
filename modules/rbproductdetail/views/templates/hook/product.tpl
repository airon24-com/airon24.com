{*
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="rb-product-cart" class="rb-hidden-detail hidden-md-down">
  <div class="container">
    <div class="rb-product-thumb">
      <div class="product-cover-img">
        {if $product.cover}
              <img
                class="js-qv-product-cover img img-thumb"
                src="{$product.cover.bySize.small_default.url}"
                alt="{$product.cover.legend}"
                title="{$product.cover.legend}"
                itemprop="image"
              >
            {else}
              <img src="{$urls.no_picture_image.bySize.small_default.url}">
            {/if}
      </div>

      <div class="rb-description-sticky">
        {block name='page_header'}
          <h1 class="h1 product-detail-name" itemprop="name">
            {block name='page_title'}{$product.name}{/block}
          </h1>
        {/block}

        {block name='product_prices'}
          {include file='catalog/_partials/product-prices.tpl'}
        {/block}
      </div>
    </div>
      
    <div class="product-actions">
        {block name='product_variants'}
          {include file='catalog/_partials/product-variants.tpl'}
        {/block}

        {block name='product_add_to_cart'}
          <div class="rb-product-add-to-cart">
            <span class="control-label">{l s='Quantity' mod='rbproductdetail'}</span>

            <div class="rb-product-quantity clearfix">
              <div class="qty">
               <div class="input-group bootstrap-touchspin">
                  <input
                    type="number"
                    name="qty"
                    id="quantity_wanted"
                    value="{$product.minimal_quantity}"
                    class="input-group form-control"
                    min="{$product.minimal_quantity}"
                    aria-label="Quantity"
                  >

                  <span class="input-group-btn-vertical">
                    <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">
                      <i class="material-icons touchspin-up"></i>
                    </button>
                    <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">
                      <i class="material-icons touchspin-down"></i>
                    </button>
                  </span>
                </div>
              </div>

              <div class="add">
                <a class="btn btn-primary add-to-cart">
                  <i class="material-icons shopping-cart"></i>
                  {l s='Add to cart' mod='rbproductdetail'}
                </a>
              </div>
            </div>
          </div>
        {/block}

        {block name='product_discounts'}
          {include file='catalog/_partials/product-discounts.tpl'}
        {/block}    
    </div>
  </div>
</div>