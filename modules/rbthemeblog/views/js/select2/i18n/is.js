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
(function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var e=jQuery.fn.select2.amd;return e.define("select2/i18n/is",[],function(){return{inputTooLong:function(e){var t=e.input.length-e.maximum,n="Vinsamlegast styttið texta um "+t+" staf";return t<=1?n:n+"i"},inputTooShort:function(e){var t=e.minimum-e.input.length,n="Vinsamlegast skrifið "+t+" staf";return t>1&&(n+="i"),n+=" í viðbót",n},loadingMore:function(){return"Sæki fleiri niðurstöður…"},maximumSelected:function(e){return"Þú getur aðeins valið "+e.maximum+" atriði"},noResults:function(){return"Ekkert fannst"},searching:function(){return"Leita…"}}}),{define:e.define,require:e.require}})();