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
<div class="rb-user-rating-wrapper">
	<span class="heading">
		{l s='User Rating' mod='rbthemedream'}
	</span>

	{for $i=1 to 5}
		{if $i <= $rb_medium}
			<span class="fa fa-star checked"></span>
		{else}
			<span class="fa fa-star"></span>
		{/if}
	{/for}

	<p>
		{$rb_medium} {l s='average based on' mod='rbthemedream'} {$rb_total} {l s='reviews.' mod='rbthemedream'}
	</p>

	<div class="hr"></div>

	<div class="row content">
		<div class="side col-md-3">
			<div>{l s='5 star' mod='rbthemedream'}</div>
		</div>

		<div class="middle col-md-6">
			<div class="bar-container">
				<div class="bar-5" style="width:{$star_5/$rb_total * 100}%; background:{$instance.star_color_5}"></div>
			</div>
		</div>

		<div class="side right col-md-3">
			<div>{$star_5}</div>
		</div>

		<div class="side col-md-3">
			<div>{l s='4 star' mod='rbthemedream'}</div>
		</div>

		<div class="middle col-md-6">
			<div class="bar-container">
				<div class="bar-4" style="width:{$star_4/$rb_total * 100}%; background:{$instance.star_color_4}"></div>
			</div>
		</div>

		<div class="side right col-md-3">
			<div>{$star_4}</div>
		</div>

		<div class="side col-md-3">
			<div>{l s='3 star' mod='rbthemedream'}</div>
		</div>

		<div class="middle col-md-6">
			<div class="bar-container">
				<div class="bar-3" style="width:{$star_3/$rb_total * 100}%; background:{$instance.star_color_3}"></div>
			</div>
		</div>

		<div class="side right col-md-3">
			<div>{$star_3}</div>
		</div>

		<div class="side col-md-3">
			<div>{l s='2 star' mod='rbthemedream'}</div>
		</div>

		<div class="middle col-md-6">
			<div class="bar-container">
				<div class="bar-2" style="width:{$star_2/$rb_total * 100}%; background:{$instance.star_color_2}"></div>
			</div>
		</div>

		<div class="side right col-md-3">
			<div>{$star_2}</div>
		</div>

		<div class="side col-md-3">
			<div>{l s='1 star' mod='rbthemedream'}</div>
		</div>

		<div class="middle col-md-6">
			<div class="bar-container">
				<div class="bar-1" style="width:{$star_1/$rb_total * 100}%; background:{$instance.star_color_1}"></div>
			</div>
		</div>

		<div class="side right col-md-3">
			<div>{$star_1}</div>
		</div>
	</div>
</div>