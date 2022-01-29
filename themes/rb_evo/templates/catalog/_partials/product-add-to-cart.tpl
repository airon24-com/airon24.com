{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
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
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div class="product-add-to-cart js-product-add-to-cart flex-yc flex-wrap space-between my-10">
  {if !$configuration.is_catalog}
    {block name='product_quantity'}
      <div class="product-quantity clearfix flex-yc my-10">
        <div class="qty">
          <span class="control-label hidden-xl-down">{l s='Quantity' d='Shop.Theme.Catalog'}</span>
          <input
            type="number"
            name="qty"
            id="quantity_wanted"
            inputmode="numeric"
            pattern="[0-9]*"
            {if $product.quantity_wanted}
              value="{$product.quantity_wanted}"
              min="{$product.minimal_quantity}"
            {else}
              value="1"
              min="1"
            {/if}
            class="input-group"
            aria-label="{l s='Quantity' d='Shop.Theme.Actions'}"
          >
        </div>

        <div class="add">
          <button
            class="btn btn-primary add-to-cart"
            data-button-action="add-to-cart"
            type="submit"
            {if !$product.add_to_cart_url}
              disabled
            {/if}
          >
            <i class="rub-shopping-cart"></i>
            {l s='Add to cart' d='Shop.Theme.Actions'}
          </button>
	  <div class="page-loading-overlay add-to-cart-loading"></div>
      </div>
        </div>
        <div class="compare-wishlist-button">
          {block name='product-compare'}
            {hook h='displayRbWishListProduct' product=$product}
          {/block}  
          {block name='product-compare'}
            {hook h='displayRbCompareProduct' product=$product}
          {/block}   
        </div>
    {/block}
    <div class="flex-yc max-w-200 my-10" style="max-width: 50%; justify-content: end;">
                        <img class="max-w-50 mr-15 js-iao-url-built lazyloaded" src="https://static.aero7.pl/imgv-webp-480x-width/assets/publicarea/images/poland-gradient-contour.png" data-src="https://static.aero7.pl/imgv-webp-480x-width/assets/publicarea/images/poland-gradient-contour.png" alt="">
                        <div class="fs-12px uppercase">Oferujemy montaż<br> w całej Polsce</div>
                    </div>

    {*{block name='product_availability'}
      <span id="product-availability" class="js-product-availability">
        {if $product.show_availability && $product.availability_message}
          {if $product.availability == 'available'}
            <i class="material-icons rtl-no-flip product-available">&#xE5CA;</i>
          {elseif $product.availability == 'last_remaining_items'}
            <i class="material-icons product-last-items">&#xE002;</i>
          {else}
            <i class="material-icons product-unavailable">&#xE14B;</i>
          {/if}
          {$product.availability_message}
        {/if}
      </span>
    {/block}*}
    
    {block name='product_minimal_quantity'}
      <p class="product-minimal-quantity js-product-minimal-quantity">
        {if $product.minimal_quantity > 1}
          {l
          s='The minimum purchase order quantity for the product is %quantity%.'
          d='Shop.Theme.Checkout'
          sprintf=['%quantity%' => $product.minimal_quantity]
          }
        {/if}
      </p>
    {/block}
  {/if}
</div>

<div class="flex-xyc flex-wrap gray-bg radius py-5 px-20 lh-1d5">
                <span class="fs-16px uppercase mx-10 my-5 text-center">Profesjonalna porada</span><img class="max-w-22 mr-10 ls-is-cached lazyloaded" src="http://greenwat.eu/shop/img/call.png" alt="call">
                <a class="c-phone-number mx-10 my-5 icube-icon-phone js-is-clickable js-send-google-event" href="tel:(+48) 22 487 55 27" title="Skontaktuj się z nami" data-eventcategory="phone" data-eventaction="phone_click" data-eventlabel="product_card_924_1020">(+48) 22 487 55 27</a>
            </div>