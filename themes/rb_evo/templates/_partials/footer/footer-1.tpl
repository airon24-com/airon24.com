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
  <div class="footer-container footer-v1">
    <div class="footer-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
            {hook h='displayRbEmail'}
            {hook h='displayRbSocial'}
            <p>{l s='Don’t worry. We don’t spam' d='Shop.Theme.Global'}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container-large">
        <div class="row">
          <div class="col-md-3 col-sp-12">
            <a href="{$urls.base_url}">
              <img class="logo img-fluid" src="{$urls.base_url}themes/rb_evo/assets/img/logo_white.png"
                alt="{$shop.name}">
            </a>
          </div>
          <div class="col-md-6 col-sp-12 text-xs-center footer-copyright">
            {block name='copyright_link'}
            <a class="_blank" href="http://www.prestashop.com" target="_blank">
              {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™',
              '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
            </a>
            {/block}
          </div>
          <div class="col-md-3 col-sp-12 text-md-right">
            <img class="img-fluid" src="{$urls.base_url}themes/rb_evo/assets/img/payment.png" alt="payment">
          </div>
        </div>
      </div>
    </div>
    {hook h='displayFooterDetail'}
  </div>