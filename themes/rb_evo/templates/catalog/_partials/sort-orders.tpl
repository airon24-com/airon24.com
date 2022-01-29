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

  <div class="perpage dropdown">
    <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="tabpanel" aria-expanded="false">   
      <span>
        {if isset($opThemect.category_product_infinite) && $opThemect.category_product_infinite}
          {$listing.pagination.items_shown_to}
        {else}
          {$listing.products|count}
        {/if}
      </span>
      <span class="las la-angle-down"></span>
    </div>
    {assign var="currentSortUrl" value=$currentSortUrl|regex_replace:"/page=\d+/":"page=1"}
    <div class="dropdown-menu">
      <a rel="nofollow" href="{$currentSortUrl}&resultsPerPage=12" class="{['js-search-link' => true]|classnames}">12</a>
      <a rel="nofollow" href="{$currentSortUrl}&resultsPerPage=24" class="{['js-search-link' => true]|classnames}">24</a>
      <a rel="nofollow" href="{$currentSortUrl}&resultsPerPage=36" class="{['js-search-link' => true]|classnames}">36</a>
      <a rel="nofollow" href="{$currentSortUrl}&resultsPerPage=100" class="{['js-search-link' => true]|classnames}">100</a>
      <a rel="nofollow" href="{$currentSortUrl}&resultsPerPage=200" class="{['js-search-link' => true]|classnames}">200</a>
    </div>
  </div>
{*<span class="col-sm-4 col-md-4 col-lg-4 hidden-md-down sort-by">{l s='Sort by:' d='Shop.Theme.Global'}</span>*}
<div class="products-sort-order dropdown">
  <button
    class="dropdown-toggle select-title"
    rel="nofollow"
    data-toggle="dropdown"
    aria-label="{l s='Sort by selection' d='Shop.Theme.Global'}"
    aria-haspopup="true"
    aria-expanded="false">
    {if $listing.sort_selected}{$listing.sort_selected}{else}{l s='Select' d='Shop.Theme.Actions'}{/if}
  </button>
  <div class="dropdown-menu">
    {foreach from=$listing.sort_orders item=sort_order}
      <a
        rel="nofollow"
        href="{$sort_order.url}"
        class="select-list {['current' => $sort_order.current, 'js-search-link' => true]|classnames}"
      >
        {$sort_order.label}
      </a>
    {/foreach}
  </div>
</div>
