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
<div class="rb-category">
	{if isset($cate_title) && $cate_title != ''}
        <h4 class="title_block">{$cate_title}</h4>
    {/if}

	{if $cate_view == 'grid'}
		{foreach $cate_categories item=$category}
			<div class="col-md-{$cate_desktop} col-sm-{$cate_tablet} col-{$cate_phone}">
				<a class="rb-category-item" href="{$category.url}">
					<img src="{$category.src}" class="img-fluid" alt="{$category.name}">
					<h3>{$category.name}</h3>
					<p class="rb-category-product">{$category.product} {l s='Product' mod='rbthemedream'}</p>
				</a>
			</div>
		{/foreach}
	{else}
		<div class="rb-category-carousel" data-slider_options='{$options|@json_encode nofilter}'>
			{foreach $cate_categories item=$category}
				<div class="rb-category-item">
					<a class="slick-slide-inner" href="{$category.url}">
		                <img class="img-fluid slick-loading" data-lazy="{$category.src}" alt="{$category.name}"/>
		                <div class="rb-image-loading"></div>
		                <h3>{$category.name}</h3>
		                <p class="rb-category-product">{$category.product} {l s='Product' mod='rbthemedream'}</p>
		            </a>
				</div>
			{/foreach}
		</div>
	{/if}
</div>