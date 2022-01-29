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

{if isset($rb_ajax) && $rb_ajax == 1}
    {if !empty($products)}
        {foreach from=$products item=product}
            <div class="{if isset($use_animation) && $use_animation == 1}rb-animation{/if}">
                {include file="$theme_dir/templates/catalog/_partials/miniatures/product.tpl" page=$page rb_list=$product_list product=$product config=$products_col row=$row}
            </div>
        {/foreach}
    {/if}
{else}
    {if isset($tabs.tabs)}
        <div class="tabs rb-products-tabs">
            <ul class="nav nav-tabs">
                {foreach from=$tabs.tabs item="tab" name=productTabs}
                    <li class="nav-item">
                        <a
                            class="nav-link{if $smarty.foreach.productTabs.first} active{/if}"
                            data-toggle="tab"
                            href="#ie-{$tab.uid}-ptab-{$smarty.foreach.productTabs.iteration}"
                        >
                            {if isset($tab.select_type_icon)}
                                {if $tab.select_type_icon == 'icon'}
                                    {if isset($tab.type_icon) && $tab.type_icon != ''}
                                        <i class="{$tab.type_icon}"></i>
                                    {/if}
                                {/if}

                                {if $tab.select_type_icon == 'image'}
                                    {if isset($tab.type_image) && $tab.type_image != ''}
                                        <img src="{$tab.type_image}" >
                                    {/if}
                                {/if}
                            {/if}
                            
                            {$tab.title}
                        </a>
                    </li>
                {/foreach}
            </ul>

            <div id="products" class="tab-content">
                {foreach from=$tabs.tabs item="tab" name=productTabs}
                    <div class="{if $tab.view == 'sly'}scroll-list{/if} rb-products-list tab-pane {if $smarty.foreach.productTabs.first} active{/if}" id="ie-{$tab.uid}-ptab-{$smarty.foreach.productTabs.iteration}">
                        {if $tab.view == 'carousel'}
                            <div class="products rb-products-carousel slick-products-carousel products-grid slick-arrows-{$tab.arrows_position}"  data-slider_options='{$tab.options|@json_encode nofilter}'>
                        {else if $tab.view == 'sly'}
                            <div
                                class="products rb-products-sly products-sly"
                                data-desktop="{$tab.sly_to_show}"
                                data-tablet="{$tab.sly_to_show_tablet}"
                                data-mobile="{$tab.sly_to_show_mobile}"
                                data-options_sly="{$tab.options_sly}"
                            >
                                <div class="product-content products-list products-list-sly grid">        
                        {else}
                            <div class="products row {if $tab.view == 'list'}products-list{else}products-grid {/if}">
                        {/if}
                                {if !empty($tab.products)}
                                    {foreach from=$tab.products item="product"}
                                        {if $tab.view == 'list'}
                                            <div class="{if isset($tab.use_animation) && $tab.use_animation == 1}rb-animation{/if}">
                                                {include file="$theme_dir/templates/catalog/_partials/miniatures/product.tpl" rb_list=$tab.product_list product=$product config=$tab.products_col row=$tab.row}
                                            </div>
                                        {else if $tab.view == 'sly'}
                                            {assign var=product_list_sly value=$tab.product_list_sly}

                                            {include
                                                file="$theme_dir/templates/catalog/_partials/miniatures/product-sly/product-sly-$product_list_sly.tpl"
                                                product=$product
                                                config=$tab.products_col
                                                row=$tab.row
                                            }    
                                        {else}
                                            {if isset($tab.product_list_carousel) && $tab.product_list_carousel != ''}
                                                {assign var=product_list_carousel value=$tab.product_list_carousel}

                                                {include file="$theme_dir/templates/catalog/_partials/miniatures/product-slick/product-slick-$product_list_carousel.tpl" product=$product config=$tab.products_col row=$tab.row}
                                            {else}
                                                {include file="$theme_dir/templates/catalog/_partials/miniatures/product-slick.tpl" product=$product config=$tab.products_col row=$tab.row}
                                            {/if}
                                        {/if}
                                    {/foreach}
                                {/if}
                                {if $tab.view == 'sly'}
                                </div>
                                {/if}
                            </div>

                            {if $tab.view == 'sly'}
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

                            {if isset($tab.load_more) && $tab.load_more == 1 && $tab.view == 'list' && isset($tab.show_more_button) && $tab.show_more_button == 1}
                                <div class="rb-show-more">
                                    <a
                                        class="btn"
                                        href="javascript:void(0)"
                                        title="{l s='View More' mod='rbthemedream'}"
                                        data-url="{$url_ajax}"
                                        data-token="{Tools::getToken(false)}"
                                        data-list="{$tab.product_list}"
                                        data-col="{$tab.products_col}"
                                        data-row="{$tab.row}"
                                        data-page="2"
                                        data-animation="{if isset($tab.use_animation) && $tab.use_animation == 1}1{else}0{/if}"
                                        data-source="{if isset($tab.source) && $tab.source != ''}{$tab.source}{/if}"
                                        data-orderBy="{if isset($tab.orderBy) && $tab.orderBy != ''}{$tab.orderBy}{/if}"
                                        data-orderWay="{if isset($tab.order_way) && $tab.order_way != ''}{$tab.order_way}{/if}"
                                        data-brand_list="{if isset($tab.brand_list) && $tab.brand_list != ''}{$tab.brand_list}{/if}"
                                        data-limit="{if isset($tab.limit) && $tab.limit != ''}{$tab.limit}{else}10{/if}"
                                    >
                                        {l s='View More' mod='rbthemedream'}
                                    </a>
                                </div>
                            {/if}
                    </div>
                {/foreach}
            </div>
        </div>
    {/if}
{/if}