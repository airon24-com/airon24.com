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
{extends file=$layout}

{block name='head' append}
  <meta property="og:type" content="product">
  {if $product.cover}
    <meta property="og:image" content="{$product.cover.large.url}">
  {/if}

  {if $product.show_price}
    <meta property="product:pretax_price:amount" content="{$product.price_tax_exc}">
    <meta property="product:pretax_price:currency" content="{$currency.iso_code}">
    <meta property="product:price:amount" content="{$product.price_amount}">
    <meta property="product:price:currency" content="{$currency.iso_code}">
  {/if}
  {if isset($product.weight) && ($product.weight != 0)}
  <meta property="product:weight:value" content="{$product.weight}">
  <meta property="product:weight:units" content="{$product.weight_unit}">
  {/if}
{/block}

{block name='head_microdata_special'}
  {include file='_partials/microdata/product-jsonld.tpl'}
{/block}

{block name='content'}

  <section id="main">
    <meta content="{$product.url}">

    <div class="row js-product-container">
      <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">
        {block name='page_content_container'}
        <section class="page-content" id="content">
          {block name='page_content'}
          {block name='product_flags'}
          <ul class="product-flags">
            {foreach from=$product.flags item=flag}
            <li class="product-flag {$flag.type}">{$flag.label}</li>
            {/foreach}
          </ul>
          {/block}

          {block name='product_cover_thumbnails'}
          {include file='catalog/_partials/product-cover-thumbnails.tpl'}
          {/block}
          {/block}
        </section>
        {/block}
      </div>
      <div class="detail-padding-left col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">
        {block name='product_discounts'}
        {hook h='displayNextPrevProduct' product=$product}
        {/block}

        {block name='page_header_container'}
        {block name='page_header'}
        <p>{if $category->id == 2}KLIMATYZATOR{/if}</p>
        <h1 class="h1 product-detail-name">{block name='page_title'}{$product.name}{/block}</h1>
        {/block}
        {/block}
        

        {block name='product_countdown'}
        {hook h='displayRbProductCountDown' product=$product}
        {/block}

        {block name='product-review'}
        {hook h='displayRbReviewProduct' product=$product type='edit'}
        {/block}

        <div class="product-information">
          

          {if $product.is_customizable && count($product.customizations.fields)}
          {block name='product_customization'}
          {include file="catalog/_partials/product-customization.tpl" customizations=$product.customizations}
          {/block}
          {/if}

            <div class="product-actions js-product-actions">
            {include file='module:rbthemefunction/views/templates/rb-ajax-loading.tpl'}
            {block name='product_buy'}
            <form action="{$urls.pages.cart}" method="post" id="add-to-cart-or-refresh">
              <input type="hidden" name="token" value="{$static_token}">
              <input type="hidden" name="id_product" value="{$product.id}" id="product_page_product_id">
                  <input type="hidden" name="id_customization" value="{$product.id_customization}" id="product_customization_id" class="js-product-customization-id">

                  {block name='product_variants'}
                    {include file='catalog/_partials/product-variants.tpl'}
                  {/block}

                  {block name='product_pack'}
                    {if $packItems}
                      <section class="product-pack">
                        <p class="h4">{l s='This pack contains' d='Shop.Theme.Catalog'}</p>
                        {foreach from=$packItems item="product_pack"}
                          {block name='product_miniature'}
                            {include file='catalog/_partials/miniatures/pack-product.tpl' product=$product_pack showPackProductsPrice=$product.show_price}
                          {/block}
                        {/foreach}
                    </section>
                    {/if}
                  {/block}

                  {block name='product_discounts'}
                    {include file='catalog/_partials/product-discounts.tpl'}
                  {/block}

                  {block name='product_description_short'}
              <div id="product-description-short-{$product.id}" class="product-description">{$product.description_short nofilter}</div>
          {/block}
                  {block name='product_prices'}
        {include file='catalog/_partials/product-prices.tpl'}
        {/block}

        <div class="m-accordion is-variation-1 mt-10">
                            <h3 class="m-accordion-header js-toggle is-active" data-id="accordion-1" data-animation="200" data-watcher-off="true">Usługa montażu klimatyzacji</h3>
                            <div id="accordion-1" class="m-accordion-contents">
                                <div class="fs-14px text-left mb-5 mt-5"><p>W skład poniższych cen wchodzi wybrany klimatyzator&nbsp;z <strong>usługą montażu&nbsp;podstawowego.</strong> Termin montażu do 14 dni.&nbsp;Skontaktujemy się do 48 godzin po złożeniu zamówienia w celu ustalenia dogodnego terminu.</p>

<p><a class="primary-color" href="#" target="_self" title="Sprawdź warunki usługi">Sprawdź cennik i warunki świadczenia usług</a></p>
</div>
                                <div class="flex flex-wrap mx-n10">
                                    <div class="col-6">
                                    <div class="m-checkable-tile">
                                        <input id="extraServiceForm-1_2" type="radio" value="1_2" name="service_ids[1][]">
                                        <label for="extraServiceForm-1_2" class="m-checkable-tile-inner-box">
                                            <p class="fs-16px text-left mb-5"><b>Montaż B2C</b></p>
                                            <p class="fs-14px text-left"><b class="fs-18px">3 945,46</b> zł</p>
                                            <div class="fs-12px gray-3 text-left mt-5"><p>klimatyzator z&nbsp;montażem&nbsp;dla konsumenta (8% VAT)</p>
</div>   
                                        </label>
                                    </div>
                                </div><div class="col-6">
                                    <div class="m-checkable-tile">
                                        <input id="extraServiceForm-1_3" type="radio" value="1_3" name="service_ids[1][]">
                                        <label for="extraServiceForm-1_3" class="m-checkable-tile-inner-box">
                                            <p class="fs-16px text-left mb-5"><b>Montaż B2B</b></p>
                                            <p class="fs-14px text-left"><b class="fs-18px">4 493,49</b> zł</p>
                                            <div class="fs-12px gray-3 text-left mt-5"><p>klimatyzator&nbsp;z montażem&nbsp;dla firmy (23% VAT)</p>
</div>   
                                        </label>
                                    </div>
                                </div>
                                </div>
                                <label class="c-radio primary-theme flex align-center">
                                <input class="c-radio-input" type="radio" value="1_1" name="service_ids[1][]">
                                <span class="c-radio-label fs-14px">Bez montażu (wymagane oświadczenie z nr F-GAZ instalatora) (2 899,00 zł)</span>
                            </label>
                            </div>
                        </div>

                  {block name='product_add_to_cart'}
                    {include file='catalog/_partials/product-add-to-cart.tpl'}
                  {/block}

                  {block name='product_additional_info'}
                    {include file='catalog/_partials/product-additional-info.tpl'}
                  {/block}

              {block name='product-print'}
              {if Configuration::get('RBTHEMEFUNCTION_BUTTON_PRINT') == 1}
              <a class="rb-print rb-btn-product" href="javascript:print();">
                <i class="fa fa-print"></i>
                {l s='Print' d='Shop.Theme.Catalog'}
              </a>
              {/if}
              {/block}
              {block name='product-print'}
              {hook h='displayTagCateProduct' product=$product}
              {/block}

              {* Input to refresh product HTML removed, block kept for compatibility with themes *}
              {block name='product_refresh'}{/block}
            </form>
            {/block}

            </div>

          {block name='hook_display_reassurance'}
          {hook h='displayReassurance'}
          {/block}
        </div>
      </div>

      <div class="col-xs-12">
        {block name='product_tabs'}
        {include file='catalog/_partials/product-tab.tpl'}
        {/block}
      </div>
    </div>

    {block name='product_accessories'}
    {if $accessories}
    <section class="product-accessories clearfix mt-3">
      <p class="h5 products-section-title">{l s='You might also like' d='Shop.Theme.Catalog'}</p>
      <div class="products featured-products-slick" itemscope itemtype="http://schema.org/ItemList">
            {foreach from=$accessories item="product_accessory" key="position"}
        {block name='product_miniature'}
        {include file='catalog/_partials/miniatures/product-slick.tpl' product=$product_accessory position=$position}
        {/block} 
        {/foreach}
      </div>
    </section>
    {/if}
    {/block}


    {block name='product_footer'}
    {hook h='displayFooterProduct' product=$product category=$category}
    {/block}

    {block name='product_images_modal'}
    {include file='catalog/_partials/product-images-modal.tpl'}
    {/block}

    {block name='page_footer_container'}
    <footer class="page-footer">
      {block name='page_footer'}
      <!-- Footer content -->
      {/block}
    </footer>
    {/block}
    <div class="page-loading-overlay main-product-details-loading"></div>
  </section>

  {/block}