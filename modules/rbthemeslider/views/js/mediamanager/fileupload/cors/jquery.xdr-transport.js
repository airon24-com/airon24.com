/**
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
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // Register as an anonymous AMD module:
        define(['jquery'], factory);
    } else {
        // Browser globals:
        factory(window.jQuery);
    }
}(function ($) {
    'use strict';
    if (window.XDomainRequest && !$.support.cors) {
        $.ajaxTransport(function (s) {
            if (s.crossDomain && s.async) {
                if (s.timeout) {
                    s.xdrTimeout = s.timeout;
                    delete s.timeout;
                }
                var xdr;
                return {
                    send: function (headers, completeCallback) {
                        function callback(status, statusText, responses, responseHeaders) {
                            xdr.onload = xdr.onerror = xdr.ontimeout = $.noop;
                            xdr = null;
                            completeCallback(status, statusText, responses, responseHeaders);
                        }
                        xdr = new XDomainRequest();
                        // XDomainRequest only supports GET and POST:
                        if (s.type === 'DELETE') {
                            s.url = s.url + (/\?/.test(s.url) ? '&' : '?') +
                                '_method=DELETE';
                            s.type = 'POST';
                        } else if (s.type === 'PUT') {
                            s.url = s.url + (/\?/.test(s.url) ? '&' : '?') +
                                '_method=PUT';
                            s.type = 'POST';
                        }
                        xdr.open(s.type, s.url);
                        xdr.onload = function () {
                            callback(
                                200,
                                'OK',
                                {text: xdr.responseText},
                                'Content-Type: ' + xdr.contentType
                            );
                        };
                        xdr.onerror = function () {
                            callback(404, 'Not Found');
                        };
                        if (s.xdrTimeout) {
                            xdr.ontimeout = function () {
                                callback(0, 'timeout');
                            };
                            xdr.timeout = s.xdrTimeout;
                        }
                        xdr.send((s.hasContent && s.data) || null);
                    },
                    abort: function () {
                        if (xdr) {
                            xdr.onerror = $.noop();
                            xdr.abort();
                        }
                    }
                };
            }
        });
    }
}));
