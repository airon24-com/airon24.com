{**
 *  PrestaShop and Contributors
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright  PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{if isset($page.page_name) && $page.page_name !== 'index'}
<nav data-depth="{$breadcrumb.count}" class="breadcrumb">
  <div class="container">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="p-a-0">
      {if ($breadcrumb.count == 1) && ($page.page_name != 'index')}
        {$breadcrumb.links.1.title = $page.meta.title}
        {$breadcrumb.links.1.url = '#'}
      {/if}
      {foreach from=$breadcrumb.links item=path name=breadcrumb}
      {if !empty($path)}
      {block name='breadcrumb_item'}
        {if not $smarty.foreach.breadcrumb.last}
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
          <a itemprop="item" href="{$path.url}">
            <span itemprop="name">{$path.title}</span>
          </a>
          <meta itemprop="position" content="{$smarty.foreach.breadcrumb.iteration}">
        </li>
        {elseif isset($path.title)}
          <li>
            <span>{$path.title}</span>
          </li>
        {/if}
      {/block}
      {/if}
      {/foreach}
    </ol>
  </div>
</nav>
{/if}