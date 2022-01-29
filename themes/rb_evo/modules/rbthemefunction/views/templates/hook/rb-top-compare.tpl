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
	<!-- TPL LOGIN -->
	{if isset($top) && $top == 'login'}
	<div id="rb-login" class="rb-login popup-over">
		<a href="javascript:void(0)" title="{l s='Login' d='Shop.Theme.Global'}" class="align-items-center popup-title">
			<i class="icon-Ico_User"></i>
			<span class="rb-login-title">{l s='Login or Register' d='Shop.Theme.Global'}</span>
		</a>

		{if $rb_login == 1}
		<div class="bg-over-lay"></div>
		<div class="rb-dropdown rb-login-form popup-content">
			<div class="close-menubar">
				<span id="click_off"></span>
			</div>
			<div class="indent rb-indent">
				<div class="my-info">
					<a class="rb-icon-account" href="{$my_account_url|escape:'html':'UTF-8'}"
						title="{l s='View My Account' d='Shop.Theme.Global'}" rel="nofollow">
						<i class="material-icons">&#xE853;</i>
					</a>
					<a class="rb-account" href="{$my_account_url|escape:'html':'UTF-8'}"
						title="{l s='View My Account' d='Shop.Theme.Global'}" rel="nofollow">
						<span>{l s='Hi' d='Shop.Theme.Global'} {$customerName|escape:'html':'UTF-8'}</span>
					</a>
					<a class="rb-logout" href="{$logout_url|escape:'html':'UTF-8'}" rel="nofollow">
						<span>{l s='Sign out' d='Shop.Theme.Global'}</span>
					</a>
				</div>
				<a id="identity-link" href="{$urls.pages.identity}">
					<span class="link-item">
						<i class="fa fa-user"></i>
						{l s='Information' d='Shop.Theme.Customeraccount'}
					</span>
				</a>
				{if $customer.addresses|count}
				<a id="addresses-link" href="{$urls.pages.addresses}">
					<span class="link-item">
						<i class="fa fa-map-marker"></i>
						{l s='Addresses' d='Shop.Theme.Customeraccount'}
					</span>
				</a>
				{else}
				<a id="address-link" href="{$urls.pages.address}">
					<span class="link-item">
						<i class="fa fa-map-marker"></i>
						{l s='Add first address' d='Shop.Theme.Customeraccount'}
					</span>
				</a>
				{/if}
				{if !$configuration.is_catalog}
				<a id="history-link" href="{$urls.pages.history}">
					<span class="link-item">
						<i class="fa fa-calendar"></i>
						{l s='Order history and details' d='Shop.Theme.Customeraccount'}
					</span>
				</a>
				{/if}
				{if $configuration.voucher_enabled && !$configuration.is_catalog}
				<a id="discounts-link" href="{$urls.pages.discount}">
					<span class="link-item">
						<i class="fa fa-tag"></i>
						{l s='Vouchers' d='Shop.Theme.Customeraccount'}
					</span>
				</a>
				{/if}

				{hook h='displayRbTopCompare'}
				{hook h='displayRbTopWishlist'}
				{hook h='displayRbLanguage'}
				{hook h='displayRbCurrency'}
			</div>

			{if isset($top) && $top == 'compare'}
			<div class="rb-id-compare">
				<a href="{$rb_compare}">
					<span class="rb-header-item">
						<i class="fa fa-compress"></i>
						<span class="title">Compare</span>
						<span class="rb-compare-quantity rb-amount-inline">{$rb_number_compare}</span>
					</span>
				</a>
			</div>
			{/if}
			<!-- End -->

			<!-- TPL wishlist -->
			{if isset($top) && $top == 'wishlist'}
			<div class="rb-id-wishlist">
				<a href="{$rb_wishlist}">
					<span class="rb-header-item">
						<i class="fa fa-heart"></i>
						<span class="title">Wishlist</span>
						<span class="rb-wishlist-quantity rb-amount-inline">{$rb_number_wishlist}</span>
					</span>
				</a>
			</div>
			{/if}
		</div>
		{else}
		<div class="bg-over-lay"></div>
		<div class="rb-dropdown rb-login-form rb-form-container dd-container dd-products dd-view popup-content">
			<!-- <div class="close-popup"><i class="icon_close"></i></div> -->
			<div class="close-menubar">
				<span id="click_off"></span>
			</div>
			<div class="indent rb-indent">
				<div class="title-wrap flex-container">
					<h4 class="customer-form-tab login-tab active">
						<span>{l s='Sign In' d='Shop.Theme.Global'}</span>
					</h4>

					<!-- <h4>{l s='OR' d='Shop.Theme.Global'}</h4> -->

					<h4 class="customer-form-tab register-tab">
						<span>{l s='Register' d='Shop.Theme.Global'}</span>
					</h4>
				</div>

				<div class="form-wrap">
					<form class="rb-customer-form active rb-form-login" action="{$urls.pages.authentication}"
						method="post">
						<div class="relative form-group">
							<div class="icon-true">
								<input class="form-control" name="email" type="email" value=""
									placeholder="{l s='Email' d='Shop.Theme.Global'}" required="">
								<i class="material-icons">email</i>
							</div>
						</div>
						<div class="relative form-group">
							<div class="input-group-dis js-parent-focus">
								<div class="icon-true relative">
									<input class="form-control js-child-focus js-visible-password" name="password"
										type="password" value="" placeholder="{l s='Password' d='Shop.Forms.Labels'}"
										required="">
									<i class="material-icons">vpn_key</i>
								</div>
							</div>
						</div>

						<div class="login-submit">
							<input type="hidden" name="submitLogin" value="1">
							<button class="btn btn-primary login-button" data-link-action="sign-in" type="submit">
								{l s='Sign In' d='Shop.Theme.Global'}
							</button>
							{hook h='displayFacebookLogin'}
						</div>

						<a href="{$urls.pages.password}" rel="nofollow">
							{l s='Forgot your password?' d='Shop.Theme.Global'}
						</a>
					</form>

					<form action="{$urls.pages.register}?back=identity" class="rb-customer-form rb-form-register"
						method="POST">
						<input type="hidden" value="1" name="submitCreate">
						<input type="hidden" value="0" name="newsletter">
						<input type="hidden" value="0" name="optin">
						<input type="hidden" value="" name="id_customer">
						<input type="hidden" value="1" name="id_gender">

						<div class="form-group relative">
							<div class="icon-true">
								<input class="form-control" name="email" type="email" value=""
									placeholder="{l s='Email' d='Shop.Theme.Global'}" required="">
								<i class="material-icons">email</i>
							</div>
						</div>

						<div class="form-group relative">
							<div class="input-group-dis js-parent-focus">
								<div class="icon-true relative">
									<input class="form-control" name="password"
										placeholder="{l s='Password' d='Shop.Forms.Labels'}" type="password" value=""
										required="" pattern=".{literal}{{/literal}5,{literal}}{/literal}">
									<i class="material-icons">vpn_key</i>
								</div>
							</div>
						</div>
						<div class="form-group relative">
							<div class="icon-true">
								<input class="form-control" name="firstname" type="text" value=""
									placeholder="{l s='First Name' d='Shop.Theme.Global'}" required="">
								<i class="material-icons">&#xE7FF;</i>
							</div>
						</div>
						<div class="form-group relative">
							<div class="icon-true">
								<input class="form-control" name="lastname" type="text" value=""
									placeholder="{l s='Last Name' d='Shop.Theme.Global'}" required="">
								<span class="focus-border"><i></i></span>
								<svg class="svgic input-icon">
									<use xlink:href="#si-account"></use>
								</svg>
							</div>
						</div>
						<div class="relative form-group rb-check-box">
							<input class="form-control" name="optin" id="optin" type="checkbox" value="1">
							<label for="optin">
								{l s='I agree to the' d='Shop.Theme.Global'}
							</label>
						</div>
						<div class="relative form-group rb-check-box">
							<input class="form-control" name="newsletter" id="newsletter" type="checkbox" value="1">
							<label for="newsletter">
								{l s='Sign up for our newsletter' d='Shop.Theme.Global'}
							</label>
						</div>
						<button class="btn btn-primary form-control-submit register-button" type="submit"
							data-back="{$urls.pages.identity}">
							{l s='Register' d='Shop.Theme.Global'}
						</button>
					</form>
				</div>
				{hook h='displayRbTopCompare'}
				{hook h='displayRbTopWishlist'}
				{hook h='displayRbLanguage'}
				{hook h='displayRbCurrency'}
			</div>
		</div>
		{/if}
	</div>
	{/if}
	<!-- End -->

	{if isset($top) && $top == 'compare'}
	<div class="rb-id-compare">
		<a href="{$rb_compare}">
			<span class="rb-header-item">
				<i class="fa fa-compress"></i>
				<span class="title">Compare</span>
				<span class="rb-compare-quantity rb-amount-inline">{$rb_number_compare}</span>
			</span>
		</a>
	</div>
	{/if}
	<!-- End -->

	<!-- TPL wishlist -->
	{if isset($top) && $top == 'wishlist'}
	<div class="rb-id-wishlist">
		<a href="{$rb_wishlist}">
			<span class="rb-header-item">
				<i class="fa fa-heart"></i>
				<span class="title">Wishlist</span>
				<span class="rb-wishlist-quantity rb-amount-inline">{$rb_number_wishlist}</span>
			</span>
		</a>
	</div>
	{/if}