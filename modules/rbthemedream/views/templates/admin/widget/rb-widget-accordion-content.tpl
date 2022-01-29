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
{include file='./rb-base.tpl' type='accordion'}

<div class="rb-widget-container" >
	<#
		if (settings.active_first && settings.active_first != '') {
			let counter = 1;
	#>
	<div class="rb-accordion" data-active-first="{{ settings.active_first }}">
		<#
			_.each( settings.tabs, function(item) {
		#>
		<div class="rb-accordion-item">
			<div class="rb-accordion-title" data-section="{{ counter }}">
				<span class="rb-accordion-icon rb-accordion-icon-{{ settings.icon_align }}">
					<i class="material-icons rb-open">add</i>
				</span>

				{{ item.tab_title }}
			</div>

			<div class="rb-accordion-content" data-section="{{ counter }}">
				{{ item.tab_content }}
			</div>
		</div>
		<#
				counter++;
			})
		#>
	</div>
	<#
		}
	#>
</div>