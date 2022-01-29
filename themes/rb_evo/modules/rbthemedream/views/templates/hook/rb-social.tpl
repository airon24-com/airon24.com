{*
* PrestaShop
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
* @author PrestaShop SA <contact@prestashop.com>
	* @copyright PrestaShop SA
	* @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
	* International Registered Trademark & Property of PrestaShop SA
	*}
	<div class="rb-social-block ">
		<h3 class="rb-title hidden-sm-down">{l s='Follow us' d='Shop.Theme.Global'}</h3>
		<div id="footer_social_block">
			{if $facebook != ''}
			<a href="{$facebook}">
				<i class="fa fa-facebook-square" aria-hidden="true"></i>
			</a>
			{/if}

			{if $twitter != ''}
			<a href="{$twitter}">
				<i class="fa fa-twitter-square" aria-hidden="true"></i>
			</a>
			{/if}

			{if $instagram != ''}
			<a href="{$instagram}">
				<i class="fa fa-instagram" aria-hidden="true"></i>
			</a>
			{/if}

			{if $pinterest != ''}
			<a href="{$pinterest}">
				<i class="fa fa-pinterest-square" aria-hidden="true"></i>
			</a>
			{/if}

			{if $youtube != ''}
			<a href="{$youtube}">
				<i class="fa fa-youtube-square" aria-hidden="true"></i>
			</a>
			{/if}

			{if $vimeo != ''}
			<a href="{$vimeo}">
				<i class="fa fa-vimeo-square" aria-hidden="true"></i>
			</a>
			{/if}
		</div>
	</div>