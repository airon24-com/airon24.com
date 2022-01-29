{**
  * PrestaShop and Contributors
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
  * needs please refer to https://www.prestashop.com for more information.
  *
  * @author PrestaShop SA <contact@prestashop.com>
    * @copyright PrestaShop SA and Contributors
    * @license https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
    * International Registered Trademark & Property of PrestaShop SA
    *}
  
    <div class="rb-header header-v2">
      <div class="header-desktop hidden-md-down">
        <div class="header-wrapper" data-sticky_header="0">
          <div class="container container-large">
            <div class="row header-flex">
              <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6 header-left">
                <div class="rbLogo">
                  <a href="{$urls.base_url}">
                    <img class="logo img-fluid" src="{$shop.logo}" alt="{$shop.name}">
                  </a>
                </div>
              </div>
              <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-xs-6 megamenu header-center">
                {hook h='displayRbMenu' type='horizontal'}
              </div>
              <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6 header-right">
                {hook h='displayRbSearch'}
                {hook h='displayRbTopLogin'}
                {hook h='displayRbTopCart'}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-mobile navbar-head hidden-lg-up">
        <div class="container">
          <div class="row header-flex">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-xs-3 megamenu header-left">
              {hook h='displayRbMenu' type='horizontal'}
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6 header-center ">
              <div class="rbLogo">
                <a href="{$urls.base_url}">
                  <img class="logo img-fluid" src="{$shop.logo}" alt="{$shop.name}">
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-xs-3 header-right">
              {hook h='displayRbSearch'}
            </div>
          </div>
        </div>
        <div class="header-mobile-fixed">
          <div class="shop-page">
            <a href="/">
              <i class="icon-store"></i>
            </a>
          </div>
          <div class="my-account">
            {hook h='displayRbTopLogin'}
          </div>
          <div class="home-index">
            <a href="{$urls.base_url}">
              <i class="icon-house"></i>
            </a>
          </div>
          <div class="wishlist-box">
            {hook h='displayRbTopWishlist'}
          </div>
          <div class="my-cart">
            {hook h='displayRbTopCart'}
          </div>
        </div>
      </div>
    </div>
    {block name='header_banner'}
    <div class="header-banner">
      {hook h='displayBanner'}
    </div>
    {/block}
  
    {block name='header_nav'}
    <nav class="header-nav">
      {hook h='displayNav1'}
      {hook h='displayNav2'}
    </nav>
    {/block}
  
    {block name='header_top'}
    {hook h='displayNavFullWidth'}
    {/block}