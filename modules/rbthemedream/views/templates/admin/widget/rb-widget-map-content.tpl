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
{include file='./rb-base.tpl' type='google_maps'}

<div class="rb-widget-container">
	<#
		if (settings.address && settings.address != '') {
			let zoom = Number(settings.zoom.size) == 0 ? 10 : Number(settings.zoom.size);
			let map = settings.height.size && settings.height.size != '' ? settings.height.size + settings.height.unit : '400px';
	#>
	<div class="rb-custom-embed">
		<iframe
			height="{{ map }}"
			frameborder="0"
			scrolling="{{ settings.prevent_scroll }}"
			marginheight="0"
			marginwidth="0"
			src="https://maps.google.com/maps?q={{ encodeURI(settings.address) }}&amp;t=m&amp;z={{ Number(settings.zoom.size) }}&amp;output=embed&amp;iwloc=near"
		></iframe>
	</div>
	<#
		}
	#>
</div>