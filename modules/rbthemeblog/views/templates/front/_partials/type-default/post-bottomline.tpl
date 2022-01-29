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
{if Configuration::get('RBTHEMEBLOG_BLOG_DISPLAY_MORE')}
	<div class="rbblog__listing__post__wrapper__content__footer">
		{if Configuration::get('RBTHEMEBLOG_BLOG_DISPLAY_DATE')}
			<div class="rbblog__listing__post__wrapper__footer__block">
				<i class="material-icons">date_range</i>

				<span class="day">
					{assign var='blog_day' value=strtotime($post.date_add)|date_format:"%e"}	
					{l s=$blog_day mod='rbthemeblog'}			
				</span>

				<span class="month">
					{assign var='blog_month' value=strtotime($post.date_add)|date_format:"%b"}
					{l s=$blog_month mod='rbthemeblog'}
				</span>

				<span class="year">
					{assign var='blog_year' value=strtotime($post.date_add)|date_format:"%Y"}		
					{l s=$blog_year mod='rbthemeblog'}
				</span>
			</div>
		{/if}
	    <a href="{$post.url}" class="btn btn-primary">
	        {l s='Read more' mod='rbthemeblog'}
	    </a>

		<meta itemprop="datePublished" content="{$post.date_add}">
		<meta itemprop="dateModified" content="{$post.date_upd}">
		<meta itemprop="mainEntityOfPage" content="{$urls.shop_domain_url}">
	</div>
{/if}