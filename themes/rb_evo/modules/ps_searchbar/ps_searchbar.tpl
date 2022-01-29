{**
* PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License 3.0 (AFL-3.0)
* that is bundled with this package in the file LICENSE.txt.
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
* needs please refer to http://www.prestashop.com for more information.
*
* @author PrestaShop SA <contact@prestashop.com>
	* @copyright PrestaShop SA
	* @license https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
	* International Registered Trademark & Property of PrestaShop SA
	*}
	<div id="search-widget" class="search-widget popup-over">
		<a id="click_show_search" href="javascript:void(0)" data-toggle="dropdown" class="float-xs-right popup-title">
			<i class="icon-Ico_Search"></i>
		</a>
		<div class="rb-search-name popup-content">
			<div class="container">
				<div class="search-top">
					<h2>what are you looking for?</h2>
					<div class="close-search">close<i class="icon_close"></i></div>
				</div>
				<div class="search-box">
					<div class="rb-search-widget">
						<form method="get" action="{$search_controller_url}">
							<input type="text" name="s" placeholder="{l s='Search' d='Shop.Theme.Global'}"
								class="rb-search" autocomplete="off">
							<button class="rb-search-btn" type="submit">
								<i class="icon_search"></i>
								<span class="hidden-xl-down">{l s='Search' d='Shop.Theme.Global'}</span>
							</button>
							<div class="cssload-container rb-ajax-loading">
								<div class="cssload-double-torus"></div>
							</div>
						</form>
					</div>

					<div class="resuilt-search">
						<div class="rb-resuilt"></div>
					</div>
					<p class="rb-resuilt-error"></p>
				</div>
			</div>
		</div>
	</div>