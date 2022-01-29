/**
* 2007-2020 PrestaShop
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
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
(function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var e=jQuery.fn.select2.amd;return e.define("select2/i18n/sk",[],function(){var e={2:function(e){return e?"dva":"dve"},3:function(){return"tri"},4:function(){return"štyri"}};return{inputTooLong:function(t){var n=t.input.length-t.maximum;return n==1?"Prosím, zadajte o jeden znak menej":n>=2&&n<=4?"Prosím, zadajte o "+e[n](!0)+" znaky menej":"Prosím, zadajte o "+n+" znakov menej"},inputTooShort:function(t){var n=t.minimum-t.input.length;return n==1?"Prosím, zadajte ešte jeden znak":n<=4?"Prosím, zadajte ešte ďalšie "+e[n](!0)+" znaky":"Prosím, zadajte ešte ďalších "+n+" znakov"},loadingMore:function(){return"Loading more results…"},maximumSelected:function(t){return t.maximum==1?"Môžete zvoliť len jednu položku":t.maximum>=2&&t.maximum<=4?"Môžete zvoliť najviac "+e[t.maximum](!1)+" položky":"Môžete zvoliť najviac "+t.maximum+" položiek"},noResults:function(){return"Nenašli sa žiadne položky"},searching:function(){return"Vyhľadávanie…"}}}),{define:e.define,require:e.require}})();