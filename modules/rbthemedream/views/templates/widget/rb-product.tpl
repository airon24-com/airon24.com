{*
* 2007-2020 PrestaShop
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
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{assign var=theme_dir value=_PS_THEME_DIR_}

<section id="products" class="rb-products rb-products-list {if $products.view == 'sly'}scroll-list{/if}">
    {if isset($products.title) && $products.title != ''}
        <h4 class="title_block">{$products.title}</h4>
    {/if}

    {if isset($products.sub_title) && $products.sub_title != ''}
        <p class="sub_title_block">{$products.sub_title}</p>
    {/if}

    {if $products.view == 'carousel'}
        <div
            class="products rb-products-carousel slick-products-carousel products-grid slick-arrows-{$products.arrows_position}"  data-slider_options='{$products.options|@json_encode nofilter}'
        >
    {else if $products.view == 'sly'}
        <div
            class="products rb-products-sly products-sly"
            data-desktop="{$products.sly_to_show}"
            data-tablet="{$products.sly_to_show_tablet}"
            data-mobile="{$products.sly_to_show_mobile}"
            data-options_sly="{$products.options_sly}"
        >
            <div class="product-content products-list products-list-sly grid">    
    {else}
        <div class="products row {if $products.view == 'list'}products-list{else}products-grid{/if}">
    {/if}

    {foreach from=$products.products item="product"}
        {if $products.view == 'list'}
            <div class="{if isset($products.use_animation) && $products.use_animation == 1}rb-animation{/if}">
               {include file="$theme_dir/templates/catalog/_partials/miniatures/product.tpl" product=$product config=$products.products_col row=$products.row rb_list=$products.product_list}
            </div>
        {else if $products.view == 'sly'}
            {assign var=product_list_sly value=$products.product_list_sly}

            {include
                file="$theme_dir/templates/catalog/_partials/miniatures/product-sly/product-sly-$product_list_sly.tpl"
                product=$product
                config=$products.products_col
                row=$products.row
            }
        {else}
            {if isset($products.product_list_carousel) && $products.product_list_carousel != ''}
                {assign var=product_list_carousel value=$products.product_list_carousel}

                {include
                    file="$theme_dir/templates/catalog/_partials/miniatures/product-slick/product-slick-$product_list_carousel.tpl"
                    product=$product
                    config=$products.products_col
                    row=$products.row
                }
            {else}
                {include file="$theme_dir/templates/catalog/_partials/miniatures/product-slick.tpl" product=$product config=$products.products_col row=$products.row}
            {/if}
        {/if}
    {/foreach}

    {if $products.view == 'sly'}
        </div>
    {/if}
    </div>

    {if $products.view == 'sly'}
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea">
                    {l s='Scroll Me' mod='rbthemedream'}
                    <span class="material-icons">arrow_forward</span>
                </div>
            </div>
        </div>

        <div class="controls">
            <button class="btn prev">
                <span class="material-icons">keyboard_arrow_left</span>
            </button>

            <button class="btn next">
                <span class="material-icons">keyboard_arrow_right</span>
            </button>
        </div>
    {/if}

    {if isset($products.load_more) && $products.load_more == 1 && $products.view == 'list' && isset($products.show_more_button) && $products.show_more_button == 1}
        <div class="rb-show-more">
            <a
                class="btn"
                href="javascript:void(0)"
                title="{l s='View More' mod='rbthemedream'}"
                data-url="{$url_ajax}"
                data-token="{Tools::getToken(false)}"
                data-list="{$products.product_list}"
                data-col="{$products.products_col}"
                data-row="{$products.row}"
                data-page="2"
                data-animation="{if isset($products.use_animation) && $products.use_animation == 1}1{else}0{/if}"
                data-source="{if isset($products.source) && $products.source != ''}{$products.source}{/if}"
                data-orderBy="{if isset($products.orderBy) && $products.orderBy != ''}{$products.orderBy}{/if}"
                data-orderWay="{if isset($products.order_way) && $products.order_way != ''}{$products.order_way}{/if}"
                data-brand_list="{if isset($products.brand_list) && $products.brand_list != ''}{$products.brand_list}{/if}"
                data-limit="{if isset($products.limit) && $products.limit != ''}{$products.limit}{else}10{/if}"
            >
            {l s='View More' mod='rbthemedream'}
        </a>
        
        </div>
    {/if}
</section>