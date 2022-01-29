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
(function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var e=jQuery.fn.select2.amd;return e.define("select2/i18n/ca",[],function(){return{errorLoading:function(){return"La càrrega ha fallat"},inputTooLong:function(e){var t=e.input.length-e.maximum,n="Si us plau, elimina "+t+" car";return t==1?n+="àcter":n+="àcters",n},inputTooShort:function(e){var t=e.minimum-e.input.length,n="Si us plau, introdueix "+t+" car";return t==1?n+="àcter":n+="àcters",n},loadingMore:function(){return"Carregant més resultats…"},maximumSelected:function(e){var t="Només es pot seleccionar "+e.maximum+" element";return e.maximum!=1&&(t+="s"),t},noResults:function(){return"No s'han trobat resultats"},searching:function(){return"Cercant…"}}}),{define:e.define,require:e.require}})();