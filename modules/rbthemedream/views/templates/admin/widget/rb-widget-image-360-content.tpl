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
{include file='./rb-base.tpl' type='rb-image-360'}

<#
	if (settings.images_list.length > 0) {
#>
	<div class="rb-widget-container">
		<div class="rb-image-360-wrapper">
			<div class="row">
	        	<#
	        		_.each( settings.images_list, function(item) {
	        	#>
	        		<div class="col-md-3">
	        			<img style="height: {{ settings.image_height }}px !important" 
	        				src="{{ item.image.url }}"
	        				width="{{ settings.image_width }}"
	        			>
	        		</div>
	        	<#		
					})
				#>
			</div>
		</div>
	</div>
<#
	} else {
#>
	<h3>{l s='Image 360' mod='rbthemedream'}</h3>
<#		
	}
#>