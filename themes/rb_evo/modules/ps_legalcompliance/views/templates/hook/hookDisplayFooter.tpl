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
 *  @author 	PrestaShop SA <contact@prestashop.com>
 *  @copyright   PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 *}

<div class="col col-md block block-toggle euAboutUsCMS  block-links js-block-toggle">
	<h5 class="block-title"><span>{l s='Information' d='Modules.Legalcompliance.Shop'}</span></h5>
	<div class="block-content">
		<ul>
			{foreach from=$cms_links item=cms_link}
				<li>
					<a href="{$cms_link.link}"  title="{$cms_link.description|default:''}" id="{$cms_link.id}"> {$cms_link.title} </a>
				</li>
			{/foreach}
		</ul>
	</div>
</div>