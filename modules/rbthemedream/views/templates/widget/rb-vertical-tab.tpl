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
<div class="rb-vertical-tabs vertical-tabs">
  {$counter1 = 1}
  {$counter2 = 1}
  <div class="row">
    <div class="col-md-3">
      <ul class="nav nav-pills flex-column" role="tablist">
        {foreach $instance.tabs item=item}
          <a
            class="nav-link {if $counter1 == 1}active{/if}"
            id="{$string_id}_{$counter1}-tab"
            data-toggle="tab"
            href="#{$string_id}_{$counter1}"
            role="tab"
            aria-controls="{$string_id}_{$counter1}"
            aria-selected="true"
          >
            {$item.tab_title nofilter}
          </a>

          {$counter1 = $counter1 + 1}
        {/foreach}
      </ul>
    </div>
    <div class="col-md-9">
      <div class="rb-tabs-content-wrapper tab-content">
        {foreach $instance.tabs item=item}
          <div
            class="tab-pane {if $counter2 == 1}active{/if}"
            id="{$string_id}_{$counter2}"
            role="tabpanel"
            aria-labelledby="{$string_id}_{$counter2}-tab"
          >
            {RbControl::parseTextEditor($item.tab_content, $item) nofilter}
          </div>

          {$counter2 = $counter2 + 1}
        {/foreach}
      </div>
    </div>
  </div>
</div>