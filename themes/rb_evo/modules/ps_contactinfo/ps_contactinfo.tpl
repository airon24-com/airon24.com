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

  <div class="block-contact block links">
    <h3 class="h3 title_block">{l s='Contact' d='Shop.Theme.Global'}</h3>
    <ul id="footer_block_contact">
      <li class="address"><span class="title">Address:</span><span> {$contact_infos.address.formatted nofilter}</span></li>
      {if $contact_infos.phone}
      <li class="phone">
        <span class="title">Phone:</span>
        {* [1][/1] is for a HTML tag. *}
        {l s='[1]%phone%[/1]'
        sprintf=[
        '[1]' => "<a href='tel:{$contact_infos['phone']|replace:' ':''}'>",
          '[/1]' => '</a>',
        '%phone%' => $contact_infos.phone
        ]
        d='Shop.Theme.Global'
        }
      </li>
      {/if}
      {if $contact_infos.fax}
      <li class="fax">
        <span class="title">Fax:</span>
        {* [1][/1] is for a HTML tag. *}
        {l
        s='[1]%fax%[/1]'
        sprintf=[
        '[1]' => '<span>',
          '[/1]' => '</span>',
        '%fax%' => $contact_infos.fax
        ]
        d='Shop.Theme.Global'
        }
      </li>
      {/if}
      {if $contact_infos.email && $display_email}
      <li class="email">
        <span class="title">Email:</span>
        {mailto address=$contact_infos.email encode="javascript"}
      </li>
      {/if}
    </ul>
  </div>