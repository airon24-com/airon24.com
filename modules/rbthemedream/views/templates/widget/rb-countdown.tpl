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
<div class="rb-countdown row" data-expired="{l s='EXPIRED TIME' mod='rbthemedream'}">
	{if isset($instance.title) && $instance.title != ''}
		<div class="rb-coundown-title">{$instance.title}</div>
	{/if}
	<ul
		class="rb-clock"
		data-time="{if isset($instance.time) && $instance.time != ''}{$instance.time}{else}12/30/2100 00:00:00{/if}"
	>
		<li >
			<span class="rb-days"></span>
			<span>{l s='Days' mod='rbthemedream'}</span>
		</li>

		<li >
			<span class="rb-hours"></span>
			<span>{l s='Hours' mod='rbthemedream'}</span>
		</li>

		<li >
			<span class="rb-minutes"></span>
			<span>{l s='Minutes' mod='rbthemedream'}</span>
		</li>

		<li >
			<span class="rb-seconds"></span>
			<span>{l s='Seconds' mod='rbthemedream'}</span>
		</li>
	</ul>
	{if isset($instance.description) && $instance.description != ''}
		<div class="rb-coundown-description">{$instance.description nofilter}</div>
	{/if}
</div>