{*
*  PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright   PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="cart-product-line no-gutters align-items-center">
    <span class="product-image media-middle">
        {if $product.cover} <a href="{$product.url}"><img src="{$product.cover.bySize.cart_default.url}"
                alt="{$product.name|escape:'quotes'}" class="img-fluid" loading="lazy"></a>{/if}
    </span>
    <div class="product-info">
        <a class="product-name" href="{$product.url}">{$product.name}</a>

        {if isset($product.attributes) && $product.attributes}
        <div class="product-attributes text-muted">
            {foreach from=$product.attributes key="attribute" item="value"}
            <div class="product-line-info">
                <span class="label">{$attribute}:</span>
                <span class="value">{$value}</span>
            </div>
            {/foreach}
        </div>
        {/if}
        <div class="product-price-quantity">
            <span class="text-muted">{$product.quantity} x</span>
            <span class="product-price">{$product.price}</span> 
        </div>
    </div>
    <div class="remove-cart">
        <a class="remove-from-cart" rel="nofollow" href="{$product.remove_from_cart_url}"
            data-link-action="delete-from-cart" data-link-place="cart-preview"
            data-id-product="{$product.id_product|escape:'javascript'}"
            data-id-product-attribute="{$product.id_product_attribute|escape:'javascript'}"
            data-id-customization="{$product.id_customization|escape:'javascript'}"
            title="{l s='remove from cart' d='Shop.Theme.Actions'}">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
    </div>
</div>