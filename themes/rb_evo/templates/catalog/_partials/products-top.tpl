{** * Copyright since 2007 PrestaShop SA and Contributors * PrestaShop is an International Registered Trademark &
Property of PrestaShop SA * * NOTICE OF LICENSE * * This source file is subject to the Academic Free License 3.0
(AFL-3.0) * that is bundled
with this package in the file LICENSE.md. * It is also available through the world-wide-web at this URL: *
https://opensource.org/licenses/AFL-3.0 * If you did not receive a copy of the license and are unable to * obtain it
through the world-wide-web,
please send an email * to license@prestashop.com so we can send you a copy immediately. * * DISCLAIMER * * Do not edit
or add to this file if you wish to upgrade PrestaShop to newer * versions in the future. If you wish to customize
PrestaShop for your
* needs please refer to https://devdocs.prestashop.com/ for more information. * * @author PrestaShop SA and Contributors
<contact@prestashop.com>
    * @copyright Since 2007 PrestaShop SA and Contributors * @license https://opensource.org/licenses/AFL-3.0 Academic
    Free License 3.0 (AFL-3.0) *}
    <div id="js-product-list-top" class="products-selection">
        {foreach from=$listing.pagination.pages item=sort_order name=sort_order_name} {if $sort_order.current} {if
        $smarty.foreach.sort_order_name.first} {if !$sort_order.url|strpos:"?"}
        {$sort_order.url="`$sort_order.url`?page=1"} {/if} {/if} {assign var="currentSortUrl"
        value=$sort_order.url|regex_replace:"/&shop_view=(grid|list)/":""} {if
        isset($opThemect.category_product_infinite) && $opThemect.category_product_infinite} {assign
        var="currentSortUrl" value=$currentSortUrl|regex_replace:"/page=\d+/":"page=1"}
        {/if} {break} {/if} {/foreach}
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-3 total-products">
                {block name='rb_gird_list'}
                <div class="rb_display">
                    <div id="rb_view_one" class="rb-view-one type-view hidden-lg-up">
                        <a rel="nofollow" href="#" title="{l s='List One' d='Shop.Theme.Global'}">
                            <span class="icon-column">
                                <span class="layer first">
                                    <span></span>
                                </span>
                                <span class="layer middle">
                                    <span></span>
                                </span>
                                <span class="layer last">
                                    <span></span>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div id="rb_list" class="rb-list type-view">
                        <a rel="nofollow" href="#" title="{l s='List' d='Shop.Theme.Global'}">
                            <span class="icon-column">
                                <span class="layer first">
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer middle">
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer last">
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div id="rb_view_column" class="rb-view-column type-view hidden-md-down">
                        <a rel="nofollow" href="#" title="{l s='View Column' d='Shop.Theme.Global'}">
                            <span class="icon-column">
                                <span class="layer first">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer middle">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer last">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div id="rb_view_module" class="rb-view-module type-view hidden-lg-down">
                        <a rel="nofollow" href="#" title="{l s='View Module' d='Shop.Theme.Global'}">
                            <span class="icon-column">
                                <span class="layer first">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer middle">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer last">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                        </a>
                    </div>

                    <div id="rb_grid" class="rb-grid type-view hidden-md-down">
                        <a rel="nofollow" href="#" title="{l s='Grid' d='Shop.Theme.Global'}">
                            <span class="icon-column">
                                <span class="layer first">
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer middle">
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="layer last">
                                    <span></span>
                                    <span></span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
                {/block} {*{if $listing.pagination.total_items > 1}
                <p class="products-counter hidden-md-down">{l s='There are %product_count% products.'
                    d='Shop.Theme.Catalog' sprintf=['%product_count%' => $listing.pagination.total_items]}</p>
                {else if $listing.pagination.total_items > 0}
                <p class="products-counter hidden-md-down">{l s='There is 1 product.' d='Shop.Theme.Catalog'}</p>
                {/if}*}
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-9">
                <div class="sort-by-row">

                    {block name='sort_by'} {include file='catalog/_partials/sort-orders.tpl'
                    sort_orders=$listing.sort_orders} {/block} {if !empty($listing.rendered_facets)}
                    <div class="hidden-md-up filter-button">
                        <button id="search_filter_toggler" class="btn btn-secondary js-search-toggler">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                    {/if}
                </div>
            </div>
            <div class="col-sm-12 hidden-md-up text-sm-center showing">
                {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=[ '%from%' =>
                $listing.pagination.items_shown_from , '%to%' => $listing.pagination.items_shown_to, '%total%' =>
                $listing.pagination.total_items ]}
            </div>
        </div>
    </div>