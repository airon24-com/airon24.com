{**
 *  PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright  PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='page.tpl'}

{block name='page_content_container'}
    <section id="content" class="page-home">
        {block name='page_content_top'}{/block}

        {block name='page_content'}
            {block name='hook_home'}
                {$HOOK_HOME nofilter}
            {/block}
        {/block}
    </section>
{/block}

{block name='head' append}
    {assign var="searchUrl" value=$urls.pages.search|regex_replace:"/\?controller=search+$/":""}
    <script type="application/ld+json">
        {literal}
		{
			"@context": "http://schema.org",
			"@type": "WebSite",
			"url": "{/literal}{$urls.base_url}{literal}",
			"potentialAction": {
			    "@type": "SearchAction",
			    "target": "{/literal}{$searchUrl}{literal}?controller=search&s={s}",
			    "query-input": "required name=s"
			}
		}
		{/literal}
    </script>
{/block}