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
{include file='./rb-base.tpl' type='vertical-tabs'}

<div class="rb-widget-container">
  <div class="rb-vertical-tab-wrapper rb-align-center">
    <# if ( settings.tabs.length > 0 ) { #>
      <div class="row">
        <div class="col-md-3">
          <ul class="nav nav-pills flex-column" role="tablist">
            <#
              let ran_id = (Math.random() + 1).toString(36).substring(7)
              let counter = 1;
              _.each(settings.tabs, function(item) {
            #>
              <a
                class="nav-link {{ counter == 1 ? 'active' : '' }}"
                id="{{ ran_id }}_{{ counter }}-tab"
                data-toggle="tab"
                href="#{{ ran_id }}_{{ counter }}"
                role="tab"
                aria-controls="{{ ran_id }}_{{ counter }}"
                aria-selected="true"
              >
                {{{ item.tab_title }}}
              </a>
            <#
                counter++;
              });
            #>
          </ul>
        </div>

        <div class="col-md-9">
          <div class="tab-content">
            <#
              let counter_1 = 1;
              _.each(settings.tabs, function(item) {
            #>
              <div
                class="tab-pane {{ counter_1 == 1 ? 'active' : '' }}"
                id="{{ ran_id }}_{{ counter_1 }}"
                role="tabpanel"
                aria-labelledby="{{ ran_id }}_{{ counter_1 }}-tab"
              >
                {{{ item.tab_content }}}
              </div>
            <#
                counter_1++;
              });
            #>
          </div>
        </div>
      </div>
    <# } else { #>
      <h2>{l s='No tabs' mod='rbthemedream'}</h2>
    <# } #>
  </div>
</div>