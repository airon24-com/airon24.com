{*
* 2007-2021 PrestaShop
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
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="rb-widget-container">
	<div class="rb-category-sub-rating-wrapper rb-align-center row">
		{foreach $rb_sub_categories item=$category}
			<div class="col-md-3 d-flex">
				<div class="rb-content">
					<a class="btn btn-link" href="{$category.url}">
						<h3>{$category.name}</h3>
					</a>

					<ul class="rb-sub-cate">
						{if !empty($category.sub_cate)}
							{foreach $category.sub_cate item=$sub_cate}
								<li><a href="{$sub_cate.url}">{$sub_cate.name}</a></li>
							{/foreach}
						{/if}
					</ul>
				</div>

				<div class="rb-image-cate">
					<a href="{$category.url}" title="{$category.name}">
						<img src="{$category.src}" alt="{$category.name}">
					</a>
				</div>
			</div>
		{/foreach}
	</div>
</div>