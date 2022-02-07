/*
 *  @Website: rubiktheme.com - prestashop template provider
 *  @author rubiktheme <rubiktheme@gmail.com>
 *  @copyright rubiktheme
 *  @description: Rb Theme Dream is module help you can build content for your shop
 */
/*
 * Custom code goes here.
 * A template should always ship with an empty custom.js
 */

/**************** CUSTOM ************/


// clik search
$(document).ready(function () {
    backtotop();
    ajaxLoading();
    $('#search-widget #click_show_search,#rb-login .popup-title, #gr-lang .popup-title').click(function () {
        var check = 0;
        if ($(this).parent().hasClass('active')) {
            check = 1;
        }
        $('.popup-title').parent().removeClass('active');
        if (check == 0) {
            $(this).parent().addClass('active');
        }
    });
    $('.close-campbar').click(function (e) {
        e.stopPropagation();
        $('.header-campbar').addClass('hidden')
    });
    $('.close-search,#click_off').click(function (e) {
        e.stopPropagation();
        $('.search-widget').removeClass('active')
        $('.rb-login').removeClass('active')
    });
    $('.bg-over-lay').click(function (e) {
        e.stopPropagation();
        $('.rb-login').removeClass('active')
        $('#blockcart').removeClass('open')
    });
});

// Back to top
function backtotop() {
    $('#rb-back-top a').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 800);

        return false;
    });


    // scroll body to 0px on click
    $('#rb-back-top a').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
}
(function ($) {
    "use strict";

    $(document).ready(function () {
        "use strict";

        //Scroll back to top

        var progressPath = document.querySelector('.progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function () {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('.progress-wrap').addClass('active-progress');
            } else {
                jQuery('.progress-wrap').removeClass('active-progress');
            }
        });
        jQuery('.progress-wrap').on('click', function (event) {
            event.preventDefault();
            jQuery('html, body').animate({ scrollTop: 0 }, duration);
            return false;
        })


    });

})(jQuery)

// Loading Product
function ajaxLoading() {
    if ($('#product').length > 0) {
        $(document).ajaxSend(function (event, jqxhr, settings) {
            if (typeof settings.data != 'undefined' &&
                settings.data.indexOf('qty=1&add=1&action=update') != -1) {
                $('.add-to-cart-loading').show();
            }

            if (typeof settings.data != 'undefined' &&
                settings.data.indexOf('ajax=1&action=refresh&quantity_wanted=1') != -1) {
                $('.main-product-details-loading').show();
            }
        });

        $(document).ajaxComplete(function (event, jqxhr, settings) {
            if (typeof settings.data != 'undefined' &&
                settings.data.indexOf('qty=1&add=1&action=update') != -1) {
                $('.add-to-cart-loading').hide();
            }
            if (typeof settings.data != 'undefined' &&
                settings.data.indexOf('ajax=1&action=refresh&quantity_wanted=1') != -1) {
                $('.main-product-details-loading').hide();
            }
        });
    }

}

// clik showmenu
$(function () {
    $('.show-menu').click(function (e) {
        e.stopPropagation();
        if ($('.menu-sidebar').hasClass('active')) {
            $('.menu-sidebar').removeClass('active');
        }
        else {
            $('.menu-sidebar').addClass('active');
        }
        if ($('body').hasClass('off-canvas-active')) {
            $('body').removeClass('off-canvas-active');
        }
        else {
            $('body').addClass('off-canvas-active');
        }
        if ($('.bg-over-lay').hasClass('show-over-lay')) {
            $('.bg-over-lay').removeClass('show-over-lay');
        }
        else {
            $('.bg-over-lay').addClass('show-over-lay');
        }
    });
    $('#click_off_menu').click(function (e) {
        e.stopPropagation();
        if ($('.menu-sidebar').hasClass('active')) {
            $('.menu-sidebar').removeClass('active');
        }
        if ($('.bg-over-lay').hasClass('show-over-lay')) {
            $('.bg-over-lay').removeClass('show-over-lay');
        }
        if ($('body').hasClass('off-canvas-active')) {
            $('body').removeClass('off-canvas-active');
        }
    });
    //close menu when click out
    $(document).click(function (event) {
        if (!$(event.target).closest('.menu-sidebar.active').length) {
            if ($('.menu-sidebar.active').is(":visible")) {
                $('.menu-sidebar.active').removeClass('active');
                $('.bg-over-lay.show-over-lay').removeClass('show-over-lay');
            }
        }
    });
});
// mobile
if (screen.width >= 992) {
    $('.header-mobile').remove();

    $(window).on('resize', function () {
        if (screen.width < 992) {
            location.reload();
        }
    });
} else {
    $('.header-desktop').remove();

    $(window).on('resize', function () {
        if (screen.width >= 992) {
            location.reload();
        }
    });
}

let root = document.documentElement;
let hasClipPathSupport = false;

if ('CSS' in window) {
  hasClipPathSupport =
    CSS.supports('clip-path: polygon(0% 0%, 100% 0%, 100% 0px, 0% 0px)') ||
    CSS.supports('-webkit-clip-path: polygon(0% 0%, 100% 0%, 100% 0px, 0% 0px)');
}

const elStickyExclude = document.getElementById('js-sticky-exclude');
const elStickyNext = document.getElementById('js-sticky-next');
const stickyExcludeHeight = elStickyExclude.offsetHeight;

function lookForStickyExclude() {
  const extraTop = elStickyExclude.getBoundingClientRect().top + stickyExcludeHeight;
  const nextTop = elStickyNext.getBoundingClientRect().top;
  const diff = nextTop - extraTop;
  const pathHeight = stickyExcludeHeight + diff;
  
  const value = `${pathHeight}px`;

  if(hasClipPathSupport) {
    root.style.setProperty('--js-sticky-exclude-path-height', value);
  } else {
    // IE or Edge: ¯\_(ツ)_/¯
    elStickyExclude.style.maxHeight = value;
    elStickyExclude.style.overflow = 'hidden';
    // WIP: Working on another solution with SVG clip-path
    // elStickyExclude.style.clipPath = "url(#clipPath)";
  } 
}


window.addEventListener('scroll', lookForStickyExclude)