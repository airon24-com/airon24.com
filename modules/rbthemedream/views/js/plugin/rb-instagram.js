/**
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
/**
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
;(function($) {
    $.fn.instagramLite = function(options) {
        // return if no element was bound
        // so chained events can continue
        if(!this.length) {
            return this;
        }

        // define plugin
        plugin = this;

        // define default parameters
        plugin.defaults = {
            accessToken: null,
            limit: null,
            list: true,
            videos: false,
            urls: false,
            captions: false,
            date: false,
            likes: false,
            comments_count: false,
            element_class: '',
            error: function() {},
            success: function() {}
        }

        // vars
        var s = $.extend({}, plugin.defaults, options),
            el = $(this);

        var formatCaption = function(caption) {

            var words = caption.split(' '),
                newCaption = '';

            for(var i = 0; i < words.length; i++) {

                var word;

                if(words[i][0] == '@') {
                    var a = '<a href="http://twitter.com/'+words[i].replace('@', '').toLowerCase()+'" target="_blank" rel="noopener noreferrer">'+words[i]+'</a>';
                    word = a;
                } else if(words[i][0] == '#') {
                    var a = '<a href="http://twitter.com/hashtag/'+words[i].replace('#', '').toLowerCase()+'" target="_blank" rel="noopener noreferrer">'+words[i]+'</a>';
                    word = a;
                } else {
                    word = words[i]
                }

                newCaption += word + ' ';
            }

            return newCaption;

        };

        var constructMedia = function(data)
        {
            // for each piece of media returned
            for(var i = 0; i < data.length; i++) {

                // define media namespace
                var thisMedia = data[i],
                    item;

                // if media type is image or videos is set to false
                if(thisMedia.type === 'image' || !s.videos) {

                    // construct image
                    item = '<img class="il-photo__img slick-loading" data-lazy="'+thisMedia.media_url+'" alt="Instagram Image" data-filter="'+thisMedia.filter+'" />';

                    item += '<div class="rb-image-loading"></div>';

                    item += '<span class="il-photo__meta">';

                    if(s.captions || s.date || s.likes || s.comments_count) {
                        item += '<span class="il-photo__metainner">';
                    }

                    // if caption setting is true
                    if(s.captions && thisMedia.caption) {
                        item += '<span class="il-photo__caption" data-caption-id="'+thisMedia.caption.id+'">'+formatCaption(thisMedia.caption.text)+'</span>';
                    }

                    if(s.captions || s.date || s.likes || s.comments_count) {
                        item += '</span>';
                    }

                    item += '</span>';

                    // if url setting is true
                    if(s.urls) {
                        item = '<div><a href="'+thisMedia.permalink+'" target="_blank" rel="noopener noreferrer">'+item+'</a></div>';
                    }
                }


                // append image / video
                if(item !== '') {
                    el.append(item);
                }
            }
        }

        var loadContent = function() {
            // Gia hạn API
            $.ajax({
                type: 'GET',
                url: "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=" + s.accessToken,
                dataType: 'jsonp',
            });

            // if access token
            if(s.accessToken) {
                // construct API endpoint
                // var url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='+s.accessToken+'&count='+s.limit;

                var url = 'https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink&access_token=' +s.accessToken+'&limit='+s.limit;

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'jsonp',
                    success: function(data)
                    {
                        if (data.data.length) {
                            // construct media
                            constructMedia(data.data);

                            // execute success callback
                            s.success.call(this);
                        } else {
                            // execute error callback
                            s.error.call(this);
                        }
                    },
                    error: function()
                    {
                        // execute error callback
                        s.error.call(this);
                    }
                });
            }
        }

        // init
        loadContent();
    }
})(jQuery);