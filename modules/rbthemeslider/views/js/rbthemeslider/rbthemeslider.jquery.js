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
window._RbSlider = {
    globals: {
        youTubeIsReady: false,
        vimeoIsReady: false
    },

    GSAP: typeof RB_GSAP !== 'undefined' ? RB_GSAP : false,

    pluginsLoaded: [],
    pluginsNotLoaded: [],
    pluginsBeingLoaded: [],

    plugins: {},

    slidersList: {},

    currentScript: document.currentScript,
    rbScript: jQuery( 'script[src*="rbthemeslider.jquery"]' )[0],
    scriptPath: '',
    pluginsPath: false,

    showNotice: function( id, issue, curVer, reqVer ){

        var $slider = typeof id === 'string' ? jQuery( '#' + id ).first() : id,
            errorText,
            errorTitle;

        // ERROR: Multiple or Old jQuery Issues
        switch(issue ){
            case 'jquery':
            errorTitle = 'Multiple jQuery issue';
            errorText = 'It looks like that another module or your theme loads an extra copy of the jQuery library causing problems for Rbthemeslider to show your sliders.';
            break;
            case 'oldjquery':
            errorTitle = 'Old jQuery issue';
            errorText = 'It looks like you are using an old version (' + curVer + ') of the jQuery library. Rbthemeslider requires at least version ' + reqVer + ' or newer.';
            break;
        }

        jQuery( '<div class="rb-notification"><i class="rb-notification-logo">!</i><strong>' + errorTitle + '</strong><span>' + errorText + '</span></div>' ).insertBefore( $slider );
    },

    removeSlider: function( sliderUID ){
        this.slidersList[sliderUID] = null;
        delete this.slidersList[sliderUID];
    },

    checkVersions: function( required, current ){

        var v1parts = required.split( '.' );
        var v2parts = current.split( '.' );

        for( var i = 0; i < v1parts.length; ++i ){
            if( v2parts.length == i ){
                return false;
            }
            if( parseInt( v1parts[i] ) == parseInt( v2parts[i] ) ){
                continue;
            }else if( parseInt( v1parts[i] ) > parseInt( v2parts[i] ) ){
                return false;
            }else{
                return true;
            }
        }

        if( v1parts.length != v2parts.length ){
            return true;
        }
        return true;
    }
};

// EXTEND: indexOf function to work with numeric values
Number.prototype.indexOf = function( string ){
    return ( '' + this ).indexOf( string );
};

(function( $) {

    'use strict';

    window._RbSliders = {};

    $.fn.RbSlider = function( userSettings, param, param2, param3 ){

        userSettings = userSettings || {};

        // CHECK: jQuery version
        var reqVer = '1.7.2',
            curVer = $.fn.jquery,
            _sliderUID;

        if( !window._RbSlider.checkVersions( reqVer, curVer, reqVer  ) ){

            window._RbSlider.showNotice( $(this), 'oldjquery', curVer, reqVer );
        }else{
            if( (typeof userSettings).match( 'object|undefined' ) ){
                _sliderUID = 'RB' + Math.random().toString(36).substr(2, 9);

                return this.each(function( i ){
                    if( !$(this).data( 'rbSliderUID' ) ){
                        window._RbSliders[_sliderUID] = new RbSlider( this, $(this), userSettings, _sliderUID );
                    }
                });

            }else{

                if( userSettings === 'data' ){
                    // RETURN: ls object
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ];

                }else if( userSettings === 'eventData' ){
                    // RETURN: event data object
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ].api.eventData();

                }else if( userSettings === 'defaultInitOptions' ){
                    // RETURN: rb.defaults.init.options object
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ].defaults.init.options || false;

                }else if( userSettings === 'userInitOptions' ){
                    // RETURN: ls.o object
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ].userInitOptions || false;

                }else if( userSettings === 'sliderInitOptions' ){
                    // RETURN: ls.o object
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ].o || false;

                }else if( userSettings === 'originalMarkup' ){
                    // RETURN: original slider markup
                    return window._RbSliders[ this.data( 'rbSliderUID' ) ].originalMarkup || false;

                }else{
                    return this.each(function( i ){

                        // SET: API methods
                        var rbData = window._RbSliders[ $(this).data( 'rbSliderUID' ) ];

                        if( rbData ){
                            rbData.api.methods( userSettings, param, param2, param3 );
                        }

                        rbData = null;
                    });
                }
            }
        }
    };

    var RbSlider = function( slider, $slider, userSettings, sliderUID ) {

        // SAVE: sliderUID to $slider data
        $slider.data( 'rbSliderUID', sliderUID ).attr( 'data-rbthemeslider-uid', sliderUID );

        var rb = this,
            gsap = rb.gsap = window._RbSlider.GSAP ? window._RbSlider.GSAP : window;

        rb.defaults = {

            init: {

                rbDataArraySplitChar: '|',
                dataKey: '_RB',
                controls: ['#start','#stop','#prev','#next','#replay','#reverse','#reverse-replay'],

                options: {

                    // Layout
                    type                        : 'responsive',
                    fullSizeMode                : 'normal',
                    fitScreenWidth              : true,
                    preventSliderClip           : true,
                    allowFullscreen             : false,
                    responsiveUnder             : -1,
                    layersContainerWidth        : -1,
                    layersContainerHeight       : -1,
                    maxRatio                    : -1,
                    insertMethod                : 'prependTo',
                    insertSelector              : null,
                    clipSlideTransition         : false,
                    slideBGSize                 : 'cover',
                    slideBGPosition             : '50% 50%',
                    preferBlendMode             : false,

                    // Slideshow
                    autoStart                   : true,
                    startInViewport             : true,
                    playByScroll                : false,
                    playByScrollSpeed           : 1,
                    playByScrollStart           : false,
                    playByScrollSkipSlideBreaks : false,
                    pauseOnHover                : 'slideshowOnly',
                    pauseLayers                 : false,
                    firstSlide                  : 1,
                    sliderFadeInDuration        : 350,
                    cycles                      : -1,
                    forceCycles                 : true,
                    twoWaySlideshow             : false,
                    shuffleSlideshow            : false,
                    forceLayersOutDuration      : 750,

                    // Appearance
                    skin                        : 'v6',
                    skinsPath                   : '/rbthemeslider/skins/',
                    globalBGColor               : 'transparent',
                    globalBGImage               : false,
                    globalBGRepeat              : 'no-repeat',
                    globalBGAttachment          : 'scroll',
                    globalBGSize                : 'cover',
                    globalBGPosition            : '50% 50%',

                    // Navigation Area
                    navPrevNext                 : true,
                    navStartStop                : true,
                    navButtons                  : true,
                    keybNav                     : true,
                    touchNav                    : true,
                    hoverPrevNext               : true,
                    hoverBottomNav              : false,
                    showBarTimer                : false,
                    showCircleTimer             : true,
                    showSlideBarTimer           : false,

                    // Thumbnail Navigation
                    thumbnailNavigation         : 'hover',
                    tnContainerWidth            : '60%',
                    tnWidth                     : 100,
                    tnHeight                    : 60,
                    tnActiveOpacity             : 35,
                    tnInactiveOpacity           : 100,

                    // Other Navigation
                    scrollModifier              : 0,

                    // Media
                    autoPlayVideos              : true,
                    autoPauseSlideshow          : 'auto',
                    youtubePreview              : 'maxresdefault.jpg',

                    // Parallax
                    parallaxCenterDegree        : 40,
                    parallaxSensitivity         : 10,
                    parallaxCenterLayers        : 'center',
                    parallaxScrollReverse       : false,

                    // YourLogo
                    yourLogo                    : false,
                    yourLogoStyle               : 'left: -10px; top: -10px;',
                    yourLogoLink                : false,
                    yourLogoTarget              : '_self',

                    // Optimize for Mobiles by reduce the amount of tiles in slide transitions
                    optimizeForMobile           : true,

                    // Mobile features
                    hideOnMobile                : false,
                    hideUnder                   : -1,
                    hideOver                    : -1,
                    slideOnSwipe                : true,

                    // Misc
                    allowRestartOnResize        : false,
                    useSrcset                   : true,
                    hashChange                  : false,

                    // Not Available
                    staticImage                 : ''
                }
            },

            slider: {
                errorText: 'RbThemeSlider (UID: ' + sliderUID + ') error:'
            },

            slide: {

                keys: {

                    // Timing
                    slidedelay:                     ['data','duration'],
                    duration:                       ['data','duration'],
                    timeshift:                      ['data','timeShift'],

                    // Slide transition
                    transition2d:                   ['data','transition2d'],
                    transition3d:                   ['data','transition3d'],
                    transitionorigami:              ['data','transitionorigami'],
                    customtransition2d:             ['data','customtransition2d'],
                    customtransition3d:             ['data','customtransition3d'],
                    transitionduration:             ['data','transitionDuration'],

                    // Background & thumbnail
                    backgroundsize:                 ['data','backgroundSize'],
                    bgsize:                         ['data','backgroundSize'],
                    backgroundposition:             ['data','backgroundPosition'],
                    bgposition:                     ['data','backgroundPosition'],
                    backgroundcolor:                ['data','backgroundColor'],
                    bgcolor:                        ['data','backgroundColor'],
                    thumbnail:                      ['data','thumbnail'],

                    // Other settings
                    deeplink:                       ['data','deeplink'],
                    overflow:                       ['data','overflow'],

                    // Ken Burns | working with slide background
                    kenburnspan:                    ['kenBurns','pan'],
                    kenburnszoom:                   ['kenBurns','zoom'],
                    kenburnsrotation:               ['kenBurns','rotation'],
                    kenburnsrotate:                 ['kenBurns','rotation'],
                    kenburnsscale:                  ['kenBurns','scale'],

                    // Filters | working with also slide background
                    filterfrom:                     ['filter','from'],
                    filterto:                       ['filter','to'],

                    // Parallax settings | global for all layers on slide
                    parallaxtype:                   ['parallax','type'],
                    parallaxevent:                  ['parallax','event'],
                    parallaxaxis:                   ['parallax','axis'],
                    parallaxtransformorigin:        ['parallax','transformOrigin'],
                    parallaxdurationmove:           ['parallax','durationMove'],
                    parallaxdurationleave:          ['parallax','durationLeave'],
                    parallaxrotate:                 ['parallax','rotation'],
                    parallaxrotation:               ['parallax','rotation'],
                    parallaxdistance:               ['parallax','distance'],
                    parallaxtransformperspective:   ['parallax','transformPerspective'],

                    // Global hover
                    globalhover:                    ['data','globalhover']
                },

                options: {
                    data: {
                        duration: -1,
                        timeShift: 0
                    }
                }
            },

            layer: {

                keys: {

                    // Layer settings

                            keyframe:                       ['is'],
                            responsive:                     ['is'],

                            position:                       ['settings'],
                            static:                         ['settings'],
                            mirrortransitions:              ['settings'],

                    // Layer style settings

                            minfontsize:                    ['styleSettings'],
                            minmobilefontsize:              ['styleSettings'],
                            overlay:                        ['styleSettings'],

                    // Media settings

                            autoplay:                       ['mediaSettings'],
                            controls:                       ['mediaSettings'],
                            showinfo:                       ['mediaSettings'],
                            fillmode:                       ['mediaSettings'],
                            thumbnail:                      ['mediaSettings'],
                            volume:                         ['mediaSettings'],
                            backgroundvideo:                ['mediaSettings'],

                    // Transition porperties

                        // Transition in

                            // Layer from
                            fadein:                         ['opacity','inLayerFromCSS'],
                            opacityin:                      ['opacity','inLayerFromCSS'],
                            rotatein:                       ['rotation','inLayerFromCSS'],
                            rotatexin:                      ['rotationX','inLayerFromCSS'],
                            rotateyin:                      ['rotationY','inLayerFromCSS'],
                            rotationin:                     ['rotation','inLayerFromCSS'],
                            rotationxin:                    ['rotationX','inLayerFromCSS'],
                            rotationyin:                    ['rotationY','inLayerFromCSS'],
                            scalein:                        ['scale','inLayerFromCSS'],
                            scalexin:                       ['scaleX','inLayerFromCSS'],
                            scaleyin:                       ['scaleY','inLayerFromCSS'],
                            skewxin:                        ['skewX','inLayerFromCSS'],
                            skewyin:                        ['skewY','inLayerFromCSS'],

                            // Layer style from
                            bgcolorin:                      ['backgroundColor','inLayerStyleFromCSS'],
                            colorin:                        ['color','inLayerStyleFromCSS'],
                            radiusin:                       ['borderRadius','inLayerStyleShouldBeConvertedFrom'],
                            widthin:                        ['width','inLayerStyleShouldBeConvertedFrom'],
                            heightin:                       ['height','inLayerStyleShouldBeConvertedFrom'],
                            filterin:                       ['filter','inLayerStyleShouldBeConvertedFrom'],

                            // Layer to
                            rotate:                         ['rotation','inLayerToCSS'],
                            rotatex:                        ['rotationX','inLayerToCSS'],
                            rotatey:                        ['rotationY','inLayerToCSS'],
                            rotation:                       ['rotation','inLayerToCSS'],
                            rotationx:                      ['rotationX','inLayerToCSS'],
                            rotationy:                      ['rotationY','inLayerToCSS'],
                            scale:                          ['scale','inLayerToCSS'],
                            scalex:                         ['scaleX','inLayerToCSS'],
                            scaley:                         ['scaleY','inLayerToCSS'],
                            skewx:                          ['skewX','inLayerToCSS'],
                            skewy:                          ['skewY','inLayerToCSS'],

                            // Should be converted
                            transformoriginin:              ['transformOrigin','inLayerShouldBeConverted'],
                            offsetxin:                      ['x','inLayerShouldBeConverted'],
                            offsetyin:                      ['y','inLayerShouldBeConverted'],
                            clipin:                         ['clip','inClipShouldBeConverted'],

                            // Timing & easing
                            delayin:                        ['startAt','in'],
                            startatin:                      ['startAt','in'],
                            instartat:                      ['startAt','in'],
                            durationin:                     ['duration','in'],
                            easein:                         ['ease','in'],
                            easingin:                       ['ease','in'],

                            // Enabled
                            transitionin:                   ['enabled','in'],

                        // Text transition in

                            // Nodes from
                            textfadein:                     ['opacity','textInNodesFrom'],
                            textopacityin:                  ['opacity','textInNodesFrom'],
                            textrotatein:                   ['rotation','textInNodesFrom'],
                            textrotatexin:                  ['rotationX','textInNodesFrom'],
                            textrotateyin:                  ['rotationY','textInNodesFrom'],
                            textrotationin:                 ['rotation','textInNodesFrom'],
                            textrotationxin:                ['rotationX','textInNodesFrom'],
                            textrotationyin:                ['rotationY','textInNodesFrom'],
                            textscalein:                    ['scale','textInNodesFrom'],
                            textscalexin:                   ['scaleX','textInNodesFrom'],
                            textscaleyin:                   ['scaleY','textInNodesFrom'],
                            textskewxin:                    ['skewX','textInNodesFrom'],
                            textskewyin:                    ['skewY','textInNodesFrom'],

                            // Nodes to
                            texteasein:                     ['ease','textInNodesTo'],
                            texteasingin:                   ['ease','textInNodesTo'],

                            // Should be converted
                            texttransformoriginin:          ['transformOrigin','textInShouldBeConverted'],
                            textoffsetxin:                  ['x','textInShouldBeConverted'],
                            textoffsetyin:                  ['y','textInShouldBeConverted'],

                            // Type
                            texttypein:                     ['type','textIn'],

                            // Timing
                            textshiftin:                    ['shiftNodes','textIn'],
                            textdelayin:                    ['startAt','textIn'],
                            textstartatin:                  ['startAt','textIn'],
                            textinstartat:                  ['startAt','textIn'],
                            textdurationin:                 ['duration','textIn'],

                            // Enabled
                            texttransitionin:               ['enabled','textIn'],

                        // Transition out

                            // Layer to
                            fadeout:                        ['opacity','outLayerToCSS'],
                            opacityout:                     ['opacity','outLayerToCSS'],
                            rotateout:                      ['rotation','outLayerToCSS'],
                            rotatexout:                     ['rotationX','outLayerToCSS'],
                            rotateyout:                     ['rotationY','outLayerToCSS'],
                            rotationout:                    ['rotation','outLayerToCSS'],
                            rotationxout:                   ['rotationX','outLayerToCSS'],
                            rotationyout:                   ['rotationY','outLayerToCSS'],
                            scaleout:                       ['scale','outLayerToCSS'],
                            scalexout:                      ['scaleX','outLayerToCSS'],
                            scaleyout:                      ['scaleY','outLayerToCSS'],
                            skewxout:                       ['skewX','outLayerToCSS'],
                            skewyout:                       ['skewY','outLayerToCSS'],

                            // Layer style to
                            bgcolorout:                     ['backgroundColor','outLayerStyleToCSS'],
                            colorout:                       ['color','outLayerStyleToCSS'],
                            radiusout:                      ['borderRadius','outLayerStyleShouldBeConvertedTo'],
                            widthout:                       ['width','outLayerStyleShouldBeConvertedTo'],
                            heightout:                      ['height','outLayerStyleShouldBeConvertedTo'],
                            filterout:                      ['filter','outLayerStyleShouldBeConvertedTo'],

                            // Should be converted
                            transformoriginout:             ['transformOrigin','outLayerShouldBeConverted'],
                            offsetxout:                     ['x','outLayerShouldBeConverted'],
                            offsetyout:                     ['y','outLayerShouldBeConverted'],
                            clipout:                        ['clip','outClipShouldBeConverted'],

                            // Timing
                            showuntil:                      ['showUntil','out'],
                            startatout:                     ['startAt','out'],
                            outstartat:                     ['startAt','out'],
                            durationout:                    ['duration','out'],
                            easeout:                        ['ease','out'],
                            easingout:                      ['ease','out'],

                            // Enabled
                            transitionout:                  ['enabled','out'],

                        // Text transition out

                            // Nodes To
                            textfadeout:                    ['opacity','textOutNodesTo'],
                            textopacityout:                 ['opacity','textOutNodesTo'],
                            textrotateout:                  ['rotation','textOutNodesTo'],
                            textrotatexout:                 ['rotationX','textOutNodesTo'],
                            textrotateyout:                 ['rotationY','textOutNodesTo'],
                            textrotationout:                ['rotation','textOutNodesTo'],
                            textrotationxout:               ['rotationX','textOutNodesTo'],
                            textrotationyout:               ['rotationY','textOutNodesTo'],
                            textscaleout:                   ['scale','textOutNodesTo'],
                            textscalexout:                  ['scaleX','textOutNodesTo'],
                            textscaleyout:                  ['scaleY','textOutNodesTo'],
                            textskewxout:                   ['skewX','textOutNodesTo'],
                            textskewyout:                   ['skewY','textOutNodesTo'],

                            // Nodes to
                            texteaseout:                    ['ease','textOutNodesTo'],
                            texteasingout:                  ['ease','textOutNodesTo'],

                            // Should be converted
                            texttransformoriginout:         ['transformOrigin','textOutShouldBeConverted'],
                            textoffsetxout:                 ['x','textOutShouldBeConverted'],
                            textoffsetyout:                 ['y','textOutShouldBeConverted'],

                            // Type
                            texttypeout:                    ['type','textOut'],

                            // Timing
                            textshiftout:                   ['shiftNodes','textOut'],
                            textdelayout:                   ['startAt','textOut'],
                            textstartatout:                 ['startAt','textOut'],
                            textoutstartat:                 ['startAt','textOut'],
                            textdurationout:                ['duration','textOut'],

                            // Enabled
                            texttransitionout:              ['enabled','textOut'],

                        // Loop transition

                            // Layer to
                            loopopacity:                    ['opacity','loopToCSS'],
                            looprotate:                     ['rotation','loopToCSS'],
                            looprotatex:                    ['rotationX','loopToCSS'],
                            looprotatey:                    ['rotationY','loopToCSS'],
                            looprotation:                   ['rotation','loopToCSS'],
                            looprotationx:                  ['rotationX','loopToCSS'],
                            looprotationy:                  ['rotationY','loopToCSS'],
                            loopscale:                      ['scale','loopToCSS'],
                            loopscalex:                     ['scaleX','loopToCSS'],
                            loopscaley:                     ['scaleY','loopToCSS'],
                            loopskewx:                      ['skewX','loopToCSS'],
                            loopskewy:                      ['skewY','loopToCSS'],

                            // Should be converted
                            looptransformorigin:            ['transformOrigin','loopLayerShouldBeConverted'],
                            loopoffsetx:                    ['x','loopLayerShouldBeConverted'],
                            loopoffsety:                    ['y','loopLayerShouldBeConverted'],
                            loopfilter:                     ['filter','loopLayerShouldBeConverted'],
                            loopclip:                       ['clip','loopClipShouldBeConverted'],

                            // Timing & easing
                            loopdelay:                      ['startAt','loop'],
                            loopstartat:                    ['startAt','loop'],
                            loopduration:                   ['duration','loop'],
                            loopcount:                      ['count','loop'],
                            looprepeatdelay:                ['repeatDelay','loop'],
                            loopyoyo:                       ['yoyo','loop'],
                            loopease:                       ['ease','loop'],
                            loopeasing:                     ['ease','loop'],

                            // Enabled
                            loop:                           ['enabled','loop'],

                        // Hover transition

                            hoveropacity:                   ['opacity','hoverToCSS'],
                            hoverrotate:                    ['rotation','hoverToCSS'],
                            hoverrotatex:                   ['rotationX','hoverToCSS'],
                            hoverrotatey:                   ['rotationY','hoverToCSS'],
                            hoverrotation:                  ['rotation','hoverToCSS'],
                            hoverrotationx:                 ['rotationX','hoverToCSS'],
                            hoverrotationy:                 ['rotationY','hoverToCSS'],
                            hoverscale:                     ['scale','hoverToCSS'],
                            hoverscalex:                    ['scaleX','hoverToCSS'],
                            hoverscaley:                    ['scaleY','hoverToCSS'],
                            hoverskewx:                     ['skewX','hoverToCSS'],
                            hoverskewy:                     ['skewY','hoverToCSS'],

                            hoverbgcolor:                   ['backgroundColor','hoverToCSS'],
                            hovercolor:                     ['color','hoverToCSS'],

                            hoverease:                      ['easeIn','hover'],
                            hovereasing:                    ['easeIn','hover'],
                            hovereasein:                    ['easeIn','hover'],
                            hovereasingin:                  ['easeIn','hover'],
                            hovereaseout:                   ['easeOut','hover'],
                            hovereasingout:                 ['easeOut','hover'],
                            hoverduration:                  ['durationIn','hover'],
                            hoverdurationin:                ['durationIn','hover'],
                            hoverdurationout:               ['durationOut','hover'],
                            hoveralwaysontop:               ['alwaysOnTop','hover'],

                            hoveroffsetx:                   ['x','hoverShouldBeConverted'],
                            hoveroffsety:                   ['y','hoverShouldBeConverted'],
                            hoverfilter:                    ['filter','hoverShouldBeConverted'],
                            hoverborderradius:              ['borderRadius','hoverShouldBeConverted'],
                            hoverradius:                    ['borderRadius','hoverShouldBeConverted'],
                            hovertransformorigin:           ['transformOrigin','hoverShouldBeConverted'],

                            // Enabled
                            hover:                          ['enabled','hover'],

                        // Ken Burns | working with slide background
                            kenburnspan:                    ['pan','kenBurns'],
                            kenburnszoom:                   ['zoom','kenBurns'],
                            kenburnsrotation:               ['rotation','kenBurns'],
                            kenburnsrotate:                 ['rotation','kenBurns'],
                            kenburnsscale:                  ['scale','kenBurns'],

                        // Parallax transition

                            parallaxlevel:                  ['level','parallax'],
                            parallaxtype:                   ['type','parallax'],
                            parallaxevent:                  ['event','parallax'],
                            parallaxaxis:                   ['axis','parallax'],
                            parallaxtransformorigin:        ['transformOrigin','parallax'],
                            parallaxdurationmove:           ['durationMove','parallax'],
                            parallaxdurationleave:          ['durationLeave','parallax'],
                            parallaxrotate:                 ['rotation','parallax'],
                            parallaxrotation:               ['rotation','parallax'],
                            parallaxdistance:               ['distance','parallax'],

                            // Enabled
                            parallax:                       ['enabled','parallax'],

                        // transformPerspective

                            transformperspective:           ['layer','transformPerspective'],
                            transformperspectivein:         ['layer','transformPerspective'],
                            transformperspectiveout:        ['layer','transformPerspective'],
                            texttransformperspective:       ['text','transformPerspective'],
                            texttransformperspectivein:     ['text','transformPerspective'],
                            texttransformperspectiveout:    ['text','transformPerspective'],
                            looptransformperspective:       ['loop','transformPerspective'],
                            hovertransformperspective:      ['hover','transformPerspective'],
                            parallaxtransformperspective:   ['parallax','transformPerspective']
                },

                splitTypeKeys: [
                    'chars_asc',
                    'chars_desc',
                    'chars_rand',
                    'chars_center',
                    'chars_edge',
                    'words_asc',
                    'words_desc',
                    'words_rand',
                    'words_center',
                    'words_edge',
                    'lines_asc',
                    'lines_desc',
                    'lines_rand',
                    'lines_center',
                    'lines_edge'
                ],

                timelineHierarchy: {
                    transitioninstart: [ 1 ],
                    transitioninend: [ 2 ],
                    textinstart: [ 3, [1,2,6,7,8] ],
                    textinend: [ 4 ],
                    allinend: [ 5 ],
                    loopstart: [ 6, [1,2,3,4,5] ],
                    loopend: [ 7 ],
                    transitioninandloopend: [ 8 ],
                    textinandloopend: [ 9 ],
                    allinandloopend: [ 10 ],
                    textoutstart: [ 11, [2,3,4,5,6,7,8,9,10] ],
                    textoutend: [ 12 ],
                    textoutandloopend: [ 13 ],
                    transitionoutstart: [ 14, [2,3,4,5,6,7,8,9,10,11,12,13] ],
                    transitionoutend: [ 15 ],
                    alloutend: [ 16 ],
                    alloutandloopend: [ 17 ]
                },

                properties: {

                    filter: function(){

                        return {
                            'blur': 0,
                            'brightness': 100,
                            'contrast': 100,
                            'grayscale': 0,
                            'hue-rotate': 0,
                            'invert': 0,
                            'saturate': 100,
                            'sepia': 0
                        };
                    }
                },

                options: function( $layer, slideIndex ){

                    var layerData = {

                        is: {
                            slideBackground: $layer.is( 'img.rb-bg' ) ? true : false,
                            backgroundVideo: $layer.is( '.rb-bg-video' ) ? true : false,
                            imageLayer: $layer.is( 'img.rb-layer' ) ? true : false,
                            mediaLayer: false,
                            textLayer: false,
                            responsive: true,
                            onSlide: slideIndex
                        },

                        should: {},

                        elements: {},

                        settings: {
                            position: 'relative',
                            slideIn: slideIndex,
                            slideOut: slideIndex
                        },

                        styleSettings: {
                            minfontsize: 0,
                            minmobilefontsize: 0
                        },

                        mediaSettings: {
                            controls: null,
                            autoplay: null,
                            showinfo: null,
                            fillmode: 'cover',
                            thumbnail: null,
                            volume: null,
                            backgroundVideo: false
                        },

                        timeline: {
                            transitioninstart: 0,
                            transitioninend: 0,
                            textinstart: 0,
                            textinend: 0,
                            allinend: function( layerData ){ return Math.max( this.transitioninend, this.textinend ); },
                            loopstart: 0,
                            loopend: 0,
                            transitioninandloopend: function( layerData ){
                                // IF: loop transition is enabled but loop timings are not yet calculated
                                //     and loop transition has not dependency of text transition in
                                if( this.loopend === 0 &&
                                    layerData.loop.enabled &&
                                    (   typeof layerData.loop.startAt === 'number' ||
                                        (   layerData.loop.startAt.indexOf( 'textinstart' ) !== -1 &&
                                            layerData.loop.startAt.indexOf( 'textinend' ) !== -1 &&
                                            layerData.loop.startAt.indexOf( 'allinend' ) !== -1
                                        )
                                    )
                                ){
                                    // Calculate loop timings
                                    this.loopstart = rb.transitions.layers.timeline.getTiming( layerData, layerData.loop.startAt, 'loopstart' );
                                    this.loopend = layerData.loop.count === -1 ? false : layerData.timeline.loopstart + ( layerData.loop.repeat + 1 ) * layerData.loop.duration + layerData.loop.repeat * layerData.loop.repeatDelay
                                }
                                return Math.max( this.transitioninend, this.loopend );
                            },
                            textinandloopend: function( layerData ){ return Math.max( this.textinend, this.loopend ); },
                            allinandloopend: function( layerData ){ return Math.max( this.allinend(), this.loopend ); },
                            textoutstart: 0,
                            textoutend: 0,
                            textoutandloopend: function( layerData ){ return Math.max( this.textoutend, this.loopend ); },
                            transitionoutstart: function( layerData ){ return Math.max( this.allinandloopend(), this.textoutend ); },
                            transitionoutend: 0,
                            alloutend: function( layerData ){ return Math.max( this.transitionoutend, this.textoutend, this.allinend() ); },
                            alloutandloopend: function( layerData ){ return Math.max( this.transitionoutend, this.textoutandloopend(), this.allinend() ); },
                            staticfrom: false,
                            staticto: false
                        },

                        transitionProperties: {

                            in: {

                                enabled: true,

                                layerFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                        opacity: 0
                                    }
                                },

                                layerTo: {
                                    autoCSS: false,
                                    onStart: function(){
                                        rb.transitions.layers.in.onStart( $layer );
                                    },
                                    onComplete: function(){
                                        rb.transitions.layers.in.onComplete( $layer );
                                    },
                                    css: {
                                        display: 'block',
                                        opacity: 1,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scaleX: 1,
                                        scaleY: 1,
                                        skewX: 0,
                                        skewY: 0,
                                        x: 0,
                                        y: 0
                                    }
                                },

                                layerStyleFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                layerStyleTo: {
                                    autoCSS: false,
                                    css: {
                                    }
                                },

                                clipFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                clipTo: {
                                    autoCSS: false,
                                    css: {
                                    }
                                },

                                layerShouldBeConverted: {
                                    transformOrigin: '50% 50% 0',
                                    x: 0,
                                    y: 0
                                },

                                layerStyleShouldBeConvertedFrom: {},
                                layerStyleShouldBeConvertedTo: {},

                                clipShouldBeConverted: {},

                                startAt: 0,
                                duration: 1,
                                ease: 'easeInOutQuint'
                            },

                            textIn: {

                                enabled: null,

                                nodesFrom: {
                                    cycle: {},
                                    random: {},
                                    opacity: 0
                                },

                                nodesTo: {
                                    ease: 'easeInOutQuint',
                                    css: {
                                        opacity: 1,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scaleX: 1,
                                        scaleY: 1,
                                        skewX: 0,
                                        skewY: 0,
                                        x: 0,
                                        y: 0
                                    }
                                },

                                shouldBeConverted: {
                                    cycle: {},
                                    random: {},
                                    transformOrigin: '50% 50% 0',
                                    x: 0,
                                    y: 0
                                },

                                split: '',

                                shiftNodes: 0.05,
                                startAt: 'transitioninend',
                                duration: 1
                            },

                            out: {

                                enabled: true,

                                layerFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                layerTo: {
                                    autoCSS: false,
                                    onStart: function(){
                                        rb.transitions.layers.out.onStart( $layer );
                                    },
                                    onComplete: function(){
                                        rb.transitions.layers.out.onComplete( $layer );
                                    },
                                    css: {
                                        opacity: 0,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scaleX: 1,
                                        scaleY: 1,
                                        skewX: 0,
                                        skewY: 0
                                    }
                                },

                                layerStyleFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                layerStyleTo: {
                                    autoCSS: false,
                                    css: {
                                    }
                                },

                                clipFrom: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                clipTo: {
                                    autoCSS: false,
                                    css: {
                                    }
                                },

                                layerShouldBeConverted: {
                                    x: 0,
                                    y: 0
                                },

                                layerStyleShouldBeConvertedFrom: {},
                                layerStyleShouldBeConvertedTo: {},

                                clipShouldBeConverted: {},

                                startAt: 'slidechangeonly',
                                duration: 1,
                                ease: 'easeInOutQuint'
                            },

                            textOut: {

                                enabled: null,

                                nodesFrom: {
                                    immediateRender: false,
                                    cycle: {},
                                    opacity: 1
                                },

                                nodesTo: {
                                    ease: 'easeInOutQuint',
                                    immediateRender: false,
                                    cycle: {},
                                    random: {},
                                    opacity: 0
                                },

                                shouldBeConverted: {
                                    cycle: {},
                                    random: {},
                                    x: 0,
                                    y: 0
                                },

                                split: '',

                                startAt: 'allinandloopend',
                                shiftNodes: 0.05,
                                duration: 1
                            },

                            loop: {

                                enabled: null,

                                from: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                to: {
                                    autoCSS: false,
                                    css: {}
                                },

                                clipTo: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                layerShouldBeConverted: {
                                    transformOrigin: '50% 50% 0',
                                    x: 0,
                                    y: 0
                                },

                                clipShouldBeConverted: {},

                                ease: 'linear',

                                startAt: 'allinend',
                                repeatDelay: 0,
                                duration: 1,
                                count: 0,
                                yoyo: false
                            },

                            hover: {

                                enabled: null,

                                from: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                    }
                                },

                                to: {
                                    autoCSS: false,
                                    css: {}
                                },

                                shouldBeConverted: {
                                    transformOrigin: '50% 50% 0'
                                },

                                alwaysOnTop: true,
                                easeIn: 'easeInOutQuint',
                                durationIn: 0.5
                            },

                            parallax: {

                                enabled: null
                            },

                            kenBurns: {
                                scale: 1.2
                            },

                            clip: {

                                enabled: false,
                                min: '0 0 0 0',
                                max: '-9999 9999 9999 -9999'
                            },

                            filter: {

                                values: {

                                    style: {},

                                    in: {},
                                    out: {},
                                    loop: {},
                                    hover: {},

                                    afterIn: {},
                                    afterLoop: {},

                                    bgFrom: {},
                                    bgTo: {}
                                },

                                transitions: {

                                    bg: null,
                                    in: null,
                                    out: null,
                                    loop: null,
                                    hover: null,
                                }
                            },

                            init: {

                                wrapper: {
                                    autoCSS: false,
                                    immediateRender: false,
                                    css: {
                                        display: 'block'
                                    }
                                }
                            },

                            transformPerspective: {
                                layer: 500,
                                text: 500,
                                loop: 500,
                                hover: 500
                            },

                            reset: {

                                wrapperOnTimelineEnd: {
                                    autoCSS: false,
                                    css: {
                                        opacity: 1,
                                        display: 'none'
                                    }
                                },

                                wrapperOnSlideChange: {
                                    autoCSS: false,
                                    css: {
                                        x: 0,
                                        y: 0,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scaleX: 1,
                                        scaleY: 1,
                                        skewX: 0,
                                        skewY: 0,
                                        opacity: 1,
                                        display: 'none'
                                    }
                                },

                                loopWrapperOnSlideChange: {
                                    autoCSS: false,
                                    css: {
                                        x: 0,
                                        y: 0,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scaleX: 1,
                                        scaleY: 1,
                                        skewX: 0,
                                        skewY: 0,
                                        opacity: 1
                                    }
                                }
                            }
                        }
                    };

                    return {

                        is: layerData.is,
                        should: layerData.should,
                        elements: layerData.elements,
                        settings: layerData.settings,
                        styleSettings : layerData.styleSettings,
                        mediaSettings: layerData.mediaSettings,
                        mediaProperties: layerData.mediaProperties,
                        timeline: layerData.timeline,

                        in: layerData.transitionProperties.in,
                        inLayerFrom: layerData.transitionProperties.in.layerFrom,
                        inLayerFromCSS: layerData.transitionProperties.in.layerFrom.css,
                        inLayerStyleFrom: layerData.transitionProperties.in.layerStyleFrom,
                        inLayerStyleFromCSS: layerData.transitionProperties.in.layerStyleFrom.css,
                        inClipFrom: layerData.transitionProperties.in.clipFrom,
                        inClipFromCSS: layerData.transitionProperties.in.clipFrom.css,
                        inLayerTo: layerData.transitionProperties.in.layerTo,
                        inLayerToCSS: layerData.transitionProperties.in.layerTo.css,
                        inLayerStyleTo: layerData.transitionProperties.in.layerStyleTo,
                        inLayerStyleToCSS: layerData.transitionProperties.in.layerStyleTo.css,
                        inClipTo: layerData.transitionProperties.in.clipTo,
                        inClipToCSS: layerData.transitionProperties.in.clipTo.css,
                        inClipShouldBeConverted: layerData.transitionProperties.in.clipShouldBeConverted,
                        inLayerShouldBeConverted: layerData.transitionProperties.in.layerShouldBeConverted,
                        inLayerStyleShouldBeConvertedFrom: layerData.transitionProperties.in.layerStyleShouldBeConvertedFrom,
                        inLayerStyleShouldBeConvertedTo: layerData.transitionProperties.in.layerStyleShouldBeConvertedTo,

                        textIn: layerData.transitionProperties.textIn,
                        textInNodesFrom: layerData.transitionProperties.textIn.nodesFrom,
                        textInNodesTo: layerData.transitionProperties.textIn.nodesTo,
                        textInNodesToCSS: layerData.transitionProperties.textIn.nodesTo.css,
                        textInShouldBeConverted: layerData.transitionProperties.textIn.shouldBeConverted,

                        out: layerData.transitionProperties.out,
                        outLayerFrom: layerData.transitionProperties.out.layerFrom,
                        outLayerFromCSS: layerData.transitionProperties.out.layerFrom.css,
                        outLayerStyleFrom: layerData.transitionProperties.out.layerStyleFrom,
                        outLayerStyleFromCSS: layerData.transitionProperties.out.layerStyleFrom.css,
                        outLayerTo: layerData.transitionProperties.out.layerTo,
                        outLayerToCSS: layerData.transitionProperties.out.layerTo.css,
                        outLayerStyleTo: layerData.transitionProperties.out.layerStyleTo,
                        outLayerStyleToCSS: layerData.transitionProperties.out.layerStyleTo.css,
                        outClipTo: layerData.transitionProperties.out.clipTo,
                        outClipToCSS: layerData.transitionProperties.out.clipTo.css,
                        outClipShouldBeConverted: layerData.transitionProperties.out.clipShouldBeConverted,
                        outLayerShouldBeConverted: layerData.transitionProperties.out.layerShouldBeConverted,
                        outLayerStyleShouldBeConvertedFrom: layerData.transitionProperties.out.layerStyleShouldBeConvertedFrom,
                        outLayerStyleShouldBeConvertedTo: layerData.transitionProperties.out.layerStyleShouldBeConvertedTo,

                        textOut: layerData.transitionProperties.textOut,
                        textOutNodesFrom: layerData.transitionProperties.textOut.nodesFrom,
                        textOutNodesTo: layerData.transitionProperties.textOut.nodesTo,
                        textOutShouldBeConverted: layerData.transitionProperties.textOut.shouldBeConverted,

                        loop: layerData.transitionProperties.loop,
                        loopFrom: layerData.transitionProperties.loop.from,
                        loopFromCSS: layerData.transitionProperties.loop.from.css,
                        loopTo: layerData.transitionProperties.loop.to,
                        loopToCSS: layerData.transitionProperties.loop.to.css,
                        loopClipTo: layerData.transitionProperties.loop.clipTo,
                        loopClipToCSS: layerData.transitionProperties.loop.clipTo.css,
                        loopClipShouldBeConverted: layerData.transitionProperties.loop.clipShouldBeConverted,
                        loopLayerShouldBeConverted: layerData.transitionProperties.loop.layerShouldBeConverted,

                        hover: layerData.transitionProperties.hover,
                        hoverFrom: layerData.transitionProperties.hover.from,
                        hoverFromCSS: layerData.transitionProperties.hover.from.css,
                        hoverTo: layerData.transitionProperties.hover.to,
                        hoverToCSS: layerData.transitionProperties.hover.to.css,
                        hoverShouldBeConverted: layerData.transitionProperties.hover.shouldBeConverted,

                        parallax: layerData.transitionProperties.parallax,
                        kenBurns: layerData.transitionProperties.kenBurns,
                        clip: layerData.transitionProperties.clip,
                        filter: layerData.transitionProperties.filter,

                        transformPerspective: layerData.transitionProperties.transformPerspective,

                        init: layerData.transitionProperties.init,
                        reset: layerData.transitionProperties.reset
                    };
                }
            }
        };

        rb.slides = {

            count: 0,
            first: {},
            prev: {},
            current: {},
            next: {},

            // INIT: Slides and save all data of slides
            init: function(){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                var $slides = $slider.find( '> .rb-layer, > .rb-slide' ),
                    curSlideIndex = 0,
                    defaultKeys = rb.defaults.slide.keys;

                for( var slide=0, len=$slides.length; slide<len; slide++ ){

                    var $slide = $($slides[slide]),
                        style = $slide[0].style,
                        settings = {
                            $link: false,
                            index: -1,
                            data: {
                                timeShift: 0,
                                calculatedTimeShift: 0
                            },
                            parallax: {},
                            kenBurns: {
                                scale: 1.2
                            },
                            filter: {}
                        };

                    // SET: number of slides
                    rb.slides.count++;

                    // CHANGE: slide class name if necessary (old slider markup)
                    $slide.removeClass( 'rb-layer' ).addClass( 'rb-slide' ).css({
                        width: rb.slider.initial.originalWidth,
                        height: rb.slider.initial.originalHeight
                    }).appendTo( rb.slider.$hiddenWrapper );

                    // GET: slide properties
                    if( $slide.data( 'rb' ) ){

                        var properties = $slide.data( 'rb' ).toLowerCase().split( ';' );

                        for( var x=0; x<properties.length; x++ ){

                            var prop = properties[x].split( ':' ),
                                prop1,
                                val;

                            prop[0] = $.trim( prop[0] );
                            prop[1] = $.trim( prop[1] );

                            if( prop[0] !== '' && typeof defaultKeys[prop[0]] !== 'undefined' ){

                                prop1 = typeof defaultKeys[prop[0]][1] === 'undefined' ? prop[0] : defaultKeys[prop[0]][1];
                                val = rb.functions.convert.properties( prop[1] );

                                // SET: times to seconds for GSAP
                                if( prop1.toLowerCase().indexOf( 'duration' ) !== -1 || prop1.toLowerCase().indexOf( 'delay' ) !== -1 || prop1 == 'timeShift' ){
                                    val /= 1000;
                                }

                                // SAVE: slide settings into settings object
                                settings[defaultKeys[prop[0]][0]][prop1] = val;
                            }
                        }
                    }

                    // SET: linked slide
                    if( $slide.children( 'a.rb-link' ).length ){
                        settings.data.$link = $slide.children( 'a.rb-link' ).first().css({
                            zIndex: 5
                        }).attr( 'data-rb-slide-link', curSlideIndex + 1 ).appendTo( rb.slider.$layersWrapper );
                        rb.layers.set.smartLinks( settings.data.$link );
                    }

                    // GET: background video
                    // SET: sizes and overlay
                    settings.data.$backgroundVideo = $slide.children( '[data-rb*="backgroundvideo"]' ).first();

                    if( settings.data.$backgroundVideo.length ){

                        if( settings.data.$backgroundVideo.attr( 'data-rb' ).split( 'backgroundvideo' )[1].split( ';' )[0].match(/(true|enabled|on|1)/i) !== null ){

                            settings.data.$backgroundVideo.addClass( 'rb-bg-video').css({
                                width: 'auto',
                                height: 'auto'
                            }).children( 'video, audio, iframe' ).css({
                                width: '100%',
                                height: '100%'
                            });

                            settings.data.$backgroundVideo.append( $( '<div class="rb-bg-video-overlay"></div>' ) );
                        }else{
                            settings.data.$backgroundVideo = false;
                        }
                    }

                    // GET: slide background
                    if( $slide.find( '> .rb-bg' ).length ){
                        settings.data.$background = $slide.find( '> .rb-bg' ).first();
                    }

                    if( !settings.data.thumbnail ){

                        var tnImage;

                        if( $slide.find( '> .rb-tn' ).length ){
                            tnImage = $slide.find( '> .rb-tn' ).first();
                        }else if( $slide.find( '> .rb-bg' ).length ){
                            tnImage = $slide.find( '> .rb-bg' ).first();
                        }

                        if( tnImage ){
                            settings.data.thumbnail = rb.functions.getURL( tnImage );
                            settings.data.tnAlt = rb.functions.getALT( tnImage );
                        }else{
                            settings.data.thumbnail = rb.o.skinsPath.replace('/views/css/', '/views/img/')+(~rb.o.skin.indexOf('dark') ? 'nothumb-dark.png' : 'nothumb.png');
                        }
                    }

                    // CHECK: custom slide transitions
                    if( ( settings.data.customtransition2d || settings.data.customtransition3d ) && typeof RbSliderCustomTransitions == 'undefined' ){
                        delete settings.data.customtransition2d;
                        delete settings.data.customtransition3d;
                    }

                    // GET: special style properties and apply them into data object
                    if( style.overflow === 'visible' ){
                        settings.data.overflow = 'visible';
                    }

                    if( !settings.data.backgroundColor ){
                        settings.data.backgroundColor = $slide[0].style.backgroundColor === '' ? 'transparent' : $slide[0].style.backgroundColor;
                    }

                    // CREATE: slide object in rb.slides
                    rb.slides[++curSlideIndex] = {};

                    // SAVE: slide settings to slide object
                    rb.slides[curSlideIndex].data = $.extend( true, {}, rb.defaults.slide.options.data, settings.data );
                    rb.slides[curSlideIndex].parallax = settings.parallax;
                    rb.slides[curSlideIndex].kenBurns = settings.kenBurns;
                    rb.slides[curSlideIndex].filter = settings.filter;
                    rb.slides[curSlideIndex].index = curSlideIndex;
                    rb.slides[curSlideIndex].$layers = $();

                    // SAVE: slide thumbnail
                    rb.slider.thumbnails.push( settings.data.thumbnail );

                    // INIT: layers of current slide
                    rb.layers.init( $slide, curSlideIndex );
                }
            },

            set: {

                slideIndexes: function(){

                    var self = rb.slides;

                    self.prev.index = self.current.index;
                    self.current.index = self.next.index;
                    self.next.index = rb.slideshow.get.slideInSequence( rb.slideshow.direction );

                    // CALL: set.slidesData function
                    self.set.slidesData();
                },

                nextSlideIndex: function( nextSlideIndex ){

                    var self = rb.slides;

                    self.next.index = nextSlideIndex;

                    // CALL: set.slidesData function
                    self.set.slidesData();
                },

                slidesData: function(){

                    var self = rb.slides;

                    self.prev = self.prev.index !== -1 ? $.extend( true, {}, self[self.prev.index] ) : {};
                    self.current = self.current.index !== -1 ? $.extend( true, {}, self[self.current.index] ) : {};
                    self.next = self.next.index !== -1 ? $.extend( true, {}, self[self.next.index] ) : {};
                },

                firstSlide: function(){

                    var self = rb.slides;

                    self.first.index = rb.o.firstSlide === 'random' ? rb.o.firstSlide : Math.max( rb.functions.convert.properties( rb.o.firstSlide, true ), 1 );

                    // SET: shuffleSlideshow
                    if( rb.o.shuffleSlideshow && rb.slides.count  > 2 ){
                        rb.o.twoWaySlideshow = false;
                    }else{
                        rb.o.shuffleSlideshow= false;
                    }

                    // SET: random first slide
                    self.first.index = self.first.index == 'random' ? Math.floor(Math.random() * rb.slides.count +1) : self.first.index;

                    // SET: deep linked slide
                    if( document.location.hash ){
                        for( var slideWithDeepLink=1; slideWithDeepLink<self.count + 1; slideWithDeepLink++ ){
                            if( self[slideWithDeepLink].data.deeplink == document.location.hash.split( '#' )[1] ){
                                self.first.index = slideWithDeepLink;
                            }
                        }
                    }

                    // CHECK: if first index is valid or not
                    self.first.index = self.first.index < 1 || self.first.index > rb.slides.count ? 1 : self.first.index;

                    //SET: first index of random slideshow without random first slide
                    if( rb.o.shuffleSlideshow && rb.o.firstSlide != 'random' ){
                        self.first.index = rb.o.firstSlide;
                    }

                    // IF: slider should play by scroll
                    if( rb.o.playByScroll ){
                        // CREATE: normalized sequence
                        rb.slideshow.set.normalizedSequence();
                    }

                    // SET: current index for API
                    // self.current.index = self.first.index;
                }
            },

            get: {

                deeplink: function( index ){

                    if( index && rb.slides[index] && rb.slides[index].data && rb.slides[index].data.deeplink ){
                        return rb.slides[index].data.deeplink;
                    }

                    return null;
                }
            },

            slide: []
        };

        rb.layers = {

            // CONTAINS: all layers and slide backgrounds
            $all: $(),

            getStyle: function( value, percentPixels ){

                if( value.indexOf( '%' ) != -1 ){
                    return parseFloat( value ) * percentPixels;
                }else{
                    return parseFloat( value );
                }
            },

            init: function( $slide, slideIndex ){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                var $layersOfSlide = $slide.find( '.rb-bg, .rb-l, .rb-layer, *[class^="rb-s"]' ),
                    $wrapMe,
                    layerData;

                // GET: all layers
                for( var l=0, len=$layersOfSlide.length; l<len; l++ ){

                    var $layer = $($layersOfSlide[l]),
                        layer = $layer[0],
                        $children = $layer.children();

                    // SET: classnames of layers
                    if( $layer.attr( 'class' ).indexOf( 'rb-s' ) != -1 ){
                        // SET: classnames of layers (earlier slider markup)
                        var oldDistanceNum = $layer.attr( 'class' ).split( 'rb-s' )[1].split( ' ' )[0];
                        $layer.removeClass( 'rb-s'+oldDistanceNum).addClass( 'rb-layer' );

                    }else if( $layer.hasClass( 'rb-l' ) ){
                        // SET: classnames of layers (5.x slider markup)
                        $layer.removeClass( 'rb-l' ).addClass( 'rb-layer' );

                    }else if( !$layer.is( '.rb-bg, .rb-layer' ) ){
                        // REMOVE: not a valid layer!
                        $layer.remove();
                        continue;
                    }

                    // IF: layer is an anchor element > fallback mode | version 5.x and earlier
                    // SET: child element as layer
                    if( $layer.is('a') && $children.length === 1 ){
                        $layer = $layer.children().first();
                        layer = $layer[0];
                        layer.setAttribute( 'data-rb', layer.parentNode.getAttribute( 'data-rb' ) );
                        layer.parentNode.removeAttribute( 'data-rb' );
                        $layer.parent().removeClass( 'rb-layer' );
                        $layer.addClass( 'rb-layer' );
                    }

                    // CREATE: empty data object for storing layer data
                    $layer.data( rb.defaults.init.dataKey, new rb.defaults.layer.options( $layer, slideIndex ) );

                    // SET: linkTo | deprecated in v6.0.0
                    if( $layer.attr( 'class' ).indexOf( 'rb-linkto-' ) !== -1 ){
                        this.set.linkTo( $layer );
                    }

                    if( $layer.parent().is('a') ){
                        $wrapMe = $layer.parent();
                        // SET: smartLinks
                        this.set.smartLinks( $wrapMe );
                    }else{
                        $wrapMe = $layer;
                    }

                    rb.slides[slideIndex].$layers = rb.slides[slideIndex].$layers.add( $wrapMe );
                }
            },

            set: {

                smartLinks: function( $anchor ){

                    var href = $anchor.attr( 'href' ),
                        target= $anchor.attr( 'target' );

                    if( target && target.indexOf( 'rb-scroll') !== -1 ){

                        $anchor.on( 'click.' + sliderUID, function( event ){
                            event.preventDefault();

                            var scrollTop,
                                scrollMax = document.body.scrollHeight - rb.device.viewportHeight;

                            if( href !== undefined ){
                                switch( href ){
                                    case 'pagetop':
                                        scrollTop = 0;
                                    break;
                                    case 'pagebottom':
                                        scrollTop = rb.device.docHeight - rb.device.viewportHeight;
                                    break;
                                    case 'slidertop':
                                        scrollTop = rb.slider.offsetTop;
                                    break;
                                    case '':
                                    case 'sliderbottom':
                                        scrollTop = rb.slider.offsetTop + rb.slider.height;
                                    break;
                                    default:
                                        scrollTop = $( href ).first().length ? $( href ).last().offset().top : rb.slider.offsetTop + rb.slider.height;
                                    break;
                                }
                            }

                            scrollTop += rb.o.scrollModifier;
                            scrollTop = Math.min( scrollTop, scrollMax );
                            scrollTop = Math.max( 0, scrollTop );

                            gsap.TweenMax.to([document.documentElement, document.body], 1, {
                                scrollTop: scrollTop,
                                ease: gsap.Quint.easeInOut
                            });
                        });
                    }

                    if( rb.defaults.init.controls.indexOf( href ) !== -1 || href.match(/^\#[0-9]/) ){

                        var prop = $.trim( href.toLowerCase().split( '#' )[1] ),
                            parsedProp = parseInt( prop );

                        $anchor.on( 'click.' + sliderUID, function( event ){
                            event.preventDefault();

                            if( ['prev','next','start','stop'].indexOf( prop ) !== -1 ){
                                rb.navigation[prop]( 'clicked' );
                            }else if( typeof parsedProp == 'number' && parsedProp === parsedProp ){
                                rb.slideshow.changeTo( parsedProp, true, true );
                            }else if( !rb.slider.state.changingSlides ){

                                switch( prop ){
                                    case 'replay':
                                        rb.api.methods( 'replay' );
                                    break;
                                    case 'reverse':
                                        rb.api.methods( 'reverse' );
                                    break;
                                    case 'reverse-replay':
                                        rb.api.methods( 'reverse', true );
                                    break;
                                }
                            }
                        });
                    }
                },

                linkTo: function( $layer ){

                    var classes = $layer.attr( 'class' ).split( ' ' ),
                        slideNum = 1;

                    for( var ll=0; ll<classes.length; ll++ ){
                        if( classes[ll].indexOf( 'rb-linkto-' ) != -1 ){
                            slideNum = parseInt( classes[ll].split( 'rb-linkto-' )[1] );
                        }
                    }

                    $layer.data( rb.defaults.init.dataKey ).settings.linkedToSlide = slideNum;

                    $layer.css({
                        cursor: 'pointer'
                    }).on( 'click.' + sliderUID, function( e ){
                        e.preventDefault();
                        $slider.RbSlider( $(this).data( rb.defaults.init.dataKey ).settings.linkedToSlide );
                    });
                },

                wrappers: function( $layer, layerData, slideIndex ){

                    // IF: layer is not slide background...
                    if( !layerData.is.slideBackground && !layerData.is.backgroundVideo ){
                        // SAVE: wrapper elements into layer data
                        // CREATE: empty data object for storing wrapper data
                        layerData.elements.$wrapper = $layer.closest( '.rb-in-out' );
                        layerData.elements.$wrapper.data( rb.defaults.init.dataKey, {} );
                        layerData.settings.wrapperData = layerData.elements.$wrapper.data( rb.defaults.init.dataKey );

                        layerData.elements.$clipWrapper = $layer.closest( '.rb-clip' );
                        layerData.elements.$clipWrapper.data( rb.defaults.init.dataKey, {} );
                        layerData.settings.clipWrapperData = layerData.elements.$clipWrapper.data( rb.defaults.init.dataKey );

                        layerData.elements.$loopWrapper = $layer.closest( '.rb-loop' );
                        layerData.elements.$loopWrapper.data( rb.defaults.init.dataKey, {} );
                        layerData.settings.loopWrapperData = layerData.elements.$loopWrapper.data( rb.defaults.init.dataKey );
                    }else{
                        layerData.elements.$bgWrapper = $layer.closest( '.rb-bg-wrap' );
                        layerData.elements.$bgOuterWrapper = $layer.closest( '.rb-bg-outer' );
                    }

                    // SET: parallax transition
                    if( layerData.parallax.enabled ){
                        layerData.elements.$parallaxWrapper = $layer.closest( '.rb-parallax' );
                        layerData.elements.$parallaxWrapper.data( rb.defaults.init.dataKey, { parallax: {} } );
                        layerData.settings.parallaxWrapperData = layerData.elements.$parallaxWrapper.data( rb.defaults.init.dataKey );
                        rb.transitions.layers.parallax.addLayer( layerData.elements.$parallaxWrapper, layerData.settings.parallaxWrapperData.parallax, layerData, slideIndex );
                    }

                    // SET: hover transition
                    if( layerData.hover.enabled && !rb.slides[slideIndex].data.globalhover ){
                        rb.transitions.layers.hover.set( $layer, layerData );
                    }

                    // SET: outer wrapper
                    if( rb.browser.isSafari ){
                        layerData.elements.$outerWrapper = $layer.closest( '.rb-z' );
                    }else{
                        layerData.elements.$outerWrapper =  layerData.parallax.enabled ?
                                                            layerData.elements.$parallaxWrapper : (
                                                                layerData.elements.$bgWrapper ?
                                                                layerData.elements.$bgOuterWrapper :
                                                                layerData.elements.$wrapper
                                                            );
                    }
                },

                style: function( $layer ){

                    var layer = $layer[0],
                        layerData = $layer.data( rb.defaults.init.dataKey ),
                        s = layer.style,
                        self = rb.layers,
                        $wrapMe,
                        opacity, clip,
                        width, height,
                        preWidth, preHeight,
                        percentWidth = 0,
                        percentHeight = 0,
                        outerWidth, outerHeight,
                        paddingLeft, paddingTop, paddingRight, paddingBottom,
                        marginLeft, marginTop,
                        filter,
                        borderLeftWidth, borderTopWidth, borderRightWidth, borderBottomWidth, borderRadius,
                        mediaRatio = false,
                        preRatio,
                        ratio,
                        rect = layer.getBoundingClientRect(),
                        rWidth, rHeight;

                    paddingLeft = s.paddingLeft !== '' ? self.getStyle( s.paddingLeft, rb.slider.initial.percW ) : parseFloat( $layer.css( 'padding-left' ) );
                    paddingRight = s.paddingRight !== '' ? self.getStyle( s.paddingRight, rb.slider.initial.percW ) : parseFloat( $layer.css( 'padding-right' ) );
                    paddingTop = s.paddingTop !== '' ? self.getStyle( s.paddingTop, rb.slider.initial.percH ) : parseFloat( $layer.css( 'padding-top' ) );
                    paddingBottom = s.paddingBottom !== '' ? self.getStyle( s.paddingBottom, rb.slider.initial.percH ) : parseFloat( $layer.css( 'padding-bottom' ) );

                    marginLeft = s.marginLeft !== '' ? self.getStyle( s.marginLeft, rb.slider.initial.percW ) : parseFloat( $layer.css( 'margin-left' ) );
                    marginTop = s.marginTop !== '' ? self.getStyle( s.marginTop, rb.slider.initial.percH ) : parseFloat( $layer.css( 'margin-top' ) );

                    layer.style.margin = '0';

                    //GET: borders
                    borderLeftWidth = s.borderLeftWidth !== '' ? parseFloat( s.borderLeftWidth ) : parseFloat( $layer.css( 'border-left-width') );
                    borderRightWidth = s.borderRightWidth !== '' ? parseFloat( s.borderRightWidth ) : parseFloat( $layer.css( 'border-right-width') );
                    borderTopWidth = s.borderTopWidth !== '' ? parseFloat( s.borderTopWidth ) : parseFloat( $layer.css( 'border-top-width') );
                    borderBottomWidth = s.borderBottomWidth !== '' ? parseFloat( s.borderBottomWidth ) : parseFloat( $layer.css( 'border-bottom-width') );

                    // CHECK: if current layer is a media layer
                    if( rb.media.$allMediaLayers.filter( $layer ).length === 1 || $layer.children( 'iframe' ).length ){

                        var $mediaElement = $layer.children(),
                            mediaWidth = $mediaElement.attr( 'width' ) ? $mediaElement.attr( 'width' ) : $mediaElement.width(),
                            mediaHeight = $mediaElement.attr( 'height' ) ? $mediaElement.attr( 'height' ) : $mediaElement.height();

                        if( parseInt( mediaWidth ) === 300 && parseInt( mediaHeight ) === 150 ){
                            // Seems like that the media element has default size > no size specified by user > switching to a default size with 16:9 aspect ratio
                            mediaWidth = 640;
                            mediaHeight = 360;
                        }

                        if( layer.style.width === '' || layer.style.width === 'auto' ){
                            $layer.css( 'width', mediaWidth );
                        }

                        if( layer.style.height === '' || layer.style.height === 'auto' ){
                            $layer.css( 'height', mediaHeight );
                        }

                        if( s.width === '100%' && s.height === '100%' ){
                            s.left = '50%';
                            s.top = '50%';
                            layerData.mediaSettings.fullsize = true;
                        }

                        mediaRatio = mediaWidth / mediaHeight;

                        $mediaElement.css({
                            width: '100%',
                            height: '100%'
                        });
                    }

                    var attributes = layerData.attributes;

                    // CHECK: if layer is an image layer
                    if( $layer.is( 'img' ) ){

                        // GET: preloaded values
                        preWidth = $layer.data( 'preloadedWidth' );
                        preHeight = $layer.data( 'preloadedHeight' );
                        preRatio = preWidth / preHeight;

                        // IF: image has no width / height specified in style attribute
                        if( ( !s.width && !s.height ) || ( s.width === 'auto' && s.height === 'auto' ) ){

                            // IF: image has attributes -> possible WP site
                            if( attributes ){

                                if( attributes.width && attributes.height ){
                                    if( attributes.width.indexOf( '%' ) === -1 ){
                                        width = parseInt( attributes.width );
                                    }else{
                                        percentWidth = parseInt( attributes.width );
                                        width = self.getStyle( attributes.width, rb.slider.initial.percW );
                                    }
                                    if( attributes.height.indexOf( '%' ) === -1){
                                        height = parseInt( attributes.height );
                                    }else{
                                        percentHeight = parseInt( attributes.height );
                                        height = self.getStyle( attributes.height, rb.slider.initial.percH );
                                    }
                                }else if( attributes.maxWidth ){
                                    $layer[0].style.width = attributes.maxWidth + 'px';
                                    width = attributes.maxWidth;
                                    height = $layer.height();
                                }
                            }
                        }
                    }

                    // GET: element bounding client dimensions
                    if( rect.width ){
                      rWidth = rect.width;
                    }else{
                      rWidth = rect.right - rect.left;
                    }

                    if( rect.height ){
                      rHeight = rect.height;
                    }else{
                      rHeight = rect.bottom - rect.top;
                    }

                    if( !width ){
                        //percentWidth = width.indexOf( '%' ) !== -1 ? parseInt( width );
                        width = s.width;
                        if( s.width.indexOf( '%' ) !== -1 ){ percentWidth = parseInt( s.width ); }
                        width = width !== '' && width !== 'auto' ? self.getStyle( width, rb.slider.initial.percW ) : rWidth - paddingLeft - paddingRight - borderLeftWidth - borderRightWidth;
                        width = width ? width : 'auto';
                    }

                    if( !height ){
                        height = s.height;
                        if( s.height.indexOf( '%' ) !== -1 ){ percentHeight = parseInt( s.height ); }
                        height = height !== '' && height !== 'auto' ? self.getStyle( height, rb.slider.initial.percH ) : rHeight - paddingTop - paddingBottom - borderTopWidth - borderBottomWidth;
                        height = height ? height : 'auto';
                    }

                    // SET: ratio
                    ratio = mediaRatio ? mediaRatio : width / height;

                    // FIX: image preload issue under IE
                    if( $layer.is( 'img' ) &&
                        !s.width && !s.height &&
                        ( !attributes ||
                        ( attributes && !attributes.width && !attributes.height ) ) &&
                        ( preWidth !== width || preHeight !== height ) ){

                        if( preWidth !== width ){

                            width = preWidth > 5 ? preWidth : width;
                            ratio = preWidth > 5 ? preRatio : ratio;
                            height = width / ratio;

                        }else if( preHeight !== height ){

                            height = preHeight > 5 ? preHeight : height;
                            ratio = preHeight > 5 ? preRatio : ratio;
                            width = height * ratio;
                        }
                    }

                    // SET: opacity
                    opacity = parseFloat( $layer.css( 'opacity' ) );

                    // SET: outer dimensions
                    outerWidth = borderLeftWidth + paddingLeft + width + paddingRight + borderRightWidth;
                    outerHeight = borderTopWidth + paddingTop + height + paddingBottom + borderBottomWidth;

                    // SET: clip
                    clip = s.clip !== '' ? s.clip : false;
                    // REMOVE: clip from layer | should be specified on wrapper
                    s.clip = '';

                    // SET: filter
                    filter = s.webkitFilter || s.filter;

                    var setBorderRadius = function( borderRadius ){

                        var fixedBorderRadius = borderRadius;

                        if( borderRadius && borderRadius.indexOf( 'px ') !== -1 ){
                            borderRadius = borderRadius.replace( 'px', '' ).split( ' ' );
                            fixedBorderRadius = Math.round( parseInt( borderRadius[0] ) / width * 100 ) + '%';
                        }

                        return fixedBorderRadius;
                    };

                    // SAVE: original layer style to layerData.original
                    layerData.original = {

                        clip: clip,
                        clipShouldBeConverted: false,

                        left: s.left ? s.left : '0',
                        top: s.top ? s.top : '0',

                        width: Math.ceil( width ),
                        height: Math.ceil( height ),
                        percentWidth: percentWidth,
                        percentHeight: percentHeight,
                        outerWidth: outerWidth,
                        outerHeight: outerHeight,
                        styleWidth: s.width,
                        styleHeight: s.height,

                        ratio: ratio,

                        paddingLeft: paddingLeft,
                        paddingTop: paddingTop,
                        paddingRight: paddingRight,
                        paddingBottom: paddingBottom,

                        marginLeft: marginLeft,
                        marginTop: marginTop,

                        borderLeftWidth: borderLeftWidth,
                        borderTopWidth: borderTopWidth,
                        borderRightWidth: borderRightWidth,
                        borderBottomWidth: borderBottomWidth,

                        borderRadius: setBorderRadius( $layer.css( 'borderTopLeftRadius' ) ) + ' ' + setBorderRadius( $layer.css( 'borderTopRightRadius' ) ) + ' ' + setBorderRadius(  $layer.css( 'borderBottomRightRadius' ) ) + ' ' + setBorderRadius(  $layer.css( 'borderBottomLeftRadius' ) ),

                        fontSize: parseFloat( $layer.css( 'font-size' ) ),
                        lineHeight: $layer.css( 'line-height' ),
                        letterSpacing: $layer.css( 'letter-spacing' ),
                        color: $layer.css( 'color' ),

                        zIndex: parseInt( $layer.css( 'z-index' ) ) || 'auto',

                        filter: filter,

                        backgroundColor: $layer.css( 'background-color' ),

                        dataRB: $layer.attr( 'data-rb' ) || '',
                        styles: $layer.attr( 'style' ) || ''
                    };

                    // Remove z-index from the layer
                    s.zIndex = 'auto';

                    // FIX: must be set because of browser timing issues
                    layerData.responsive = {
                        left: s.left ? s.left : '0',
                        top: s.top ? s.top : '0',
                        width: width,
                        height: height
                    };
                },

                properties: function( $layer, slideIndex, update ){

                    var layerData = $layer.data( rb.defaults.init.dataKey ),
                        layerDataOriginal = $layer.data( 'rb' );

                    layerData.is.textLayer = !$layer.is( 'img' ) && !layerData.is.mediaLayer ? true : false;
                    layerData.self = $layer;

                    // GET: layer options
                    if( $layer.data( 'rb' ) ){

                        var defaultKeys = rb.defaults.layer.keys,
                            originalProperties = $layer.data( 'rb' ).split( ';' ),
                            properties = $layer.data( 'rb' ).toLowerCase().split( ';' );

                        // GET: settings from data-rb
                        for( var x=0; x<properties.length; x++ ){

                            if( !$.trim( properties[x] ) ){
                                continue;
                            }

                            var splitPos = properties[x].indexOf( ':' ),
                                prop = [ properties[x].substring( 0, splitPos ), properties[x].substring( splitPos + 1 ) ],
                                originalPropertyName = null,
                                propertyName = null,
                                convertedValue = null,
                                propInDefaultKeys = null,
                                value = null,
                                random = null;

                            originalPropertyName = $.trim( prop[0] );

                            // If property is exist
                            if( originalPropertyName !== '' ){

                                // Compatibility with offlajn release
                                originalPropertyName = originalPropertyName.replace( 'split', 'text' );

                                // If property is valid
                                if( typeof defaultKeys[originalPropertyName] !== 'undefined' ){

                                    propertyName = defaultKeys[originalPropertyName][0];

                                    if( originalPropertyName === 'overlay' ){
                                        value = $.trim( originalProperties[x].substring( splitPos + 1 ) );
                                    }else{
                                        value = rb.functions.convert.properties( $.trim( prop[1] ) );
                                    }

                                    // SET: layer data should be updated after transition out if it has a random transition property
                                    if( prop[1] && prop[1].indexOf( 'random' ) !== -1 ){

                                        // CONVERT: random values only if transition is NOT a text transition
                                        // random text transition properties will be converted when creating a splitType transition
                                        if( !originalPropertyName.match(/(text)/) ){
                                            value = rb.functions.convert.randomProperties( value, propertyName );
                                        }

                                        if( !layerData.should.update ){
                                            layerData.should.update = true;
                                        }
                                    }

                                    // SET: correct timings to seconds for GSAP
                                    if( typeof value === 'number' && propertyName.match(/(duration|startat|shift|delay)/i) ){
                                        value /= 1000;
                                    }

                                    // CONVERT: fade properties to opacity
                                    if( originalPropertyName.match(/(fade)(.+)/) ){
                                        switch( value ){
                                            case true:
                                                value = 0;
                                            break;
                                            case false:
                                                value = 1;
                                            break;
                                        }
                                    }

                                    propInDefaultKeys = defaultKeys[originalPropertyName][1];

                                    // SAVE: property into layerData object
                                    if( typeof propInDefaultKeys !== 'undefined' ){

                                        if( value !== '' ){

                                            // IF: value is object -> it is possible a cycle value for text transitions
                                            if( typeof value === 'object' ){
                                                // IF: cycle value is added to non-text transitions, ignorind it and set the first value
                                                if( !originalPropertyName.match(/(text)/) ){
                                                    convertedValue = rb.functions.convert.properties( $.trim( value[0] ) );

                                                    // SET: correct timings to seconds for GSAP
                                                    if( typeof convertedValue === 'number' && propertyName.match(/(duration|startat|shift|delay)/i) ){
                                                        convertedValue /= 1000;
                                                    }

                                                    layerData[propInDefaultKeys][propertyName] = convertedValue;
                                                }else{
                                                    // SAVE: cycle properties for text transitions
                                                    // IF: property should be converted, there is no need to use the cycle object
                                                    if( propInDefaultKeys.match(/(converted)/i) ){
                                                        // IF: property won't be converted, property will be saved into the cycle object
                                                        layerData[propInDefaultKeys][propertyName] = value;
                                                    }else{
                                                        layerData[propInDefaultKeys].cycle[propertyName] = value;
                                                    }
                                                }
                                            }else{
                                                if( originalPropertyName.match(/(text)/) &&  value.toString().indexOf( 'random') !== -1 ){
                                                    layerData[propInDefaultKeys].random[propertyName] = value;
                                                }else{
                                                    layerData[propInDefaultKeys][propertyName] = value;
                                                }
                                            }
                                        }
                                    }else{
                                        layerData[propertyName][originalPropertyName] = value;
                                    }

                                // IF: default clip property is added in data-rb instead of style attribute...
                                }else if( originalPropertyName === 'clip' ){
                                    layerData.original.clip = prop[1];
                                    layerData.original.clipShouldBeConverted = true;
                                }
                            }
                        }
                    }

                    if( rb.browser.isOld ){
                        layerData.in.enabled = true;
                        layerData.textIn.enabled = false;
                        layerData.textOut.enabled = false;
                        layerData.textIn.type = null;
                        layerData.textOut.type = null;
                    }

                    // SET: Transition in
                    if( layerData.in.enabled ){
                        layerData.inLayerTo.ease =
                        layerData.inLayerStyleTo.ease =
                        layerData.inClipTo.ease =
                        rb.functions.convert.easing( layerData.in.ease );
                    }

                    // SET: Transition in & out style properties
                    if( typeof layerData.inLayerStyleShouldBeConvertedFrom.borderRadius !== 'undefined' ){
                        layerData.inLayerStyleShouldBeConvertedTo.borderRadius = layerData.original.borderRadius;
                    }
                    if( typeof layerData.outLayerStyleShouldBeConvertedTo.borderRadius !== 'undefined'  ){
                        layerData.outLayerStyleShouldBeConvertedFrom.borderRadius = layerData.original.borderRadius;
                    }
                    if( layerData.inLayerStyleFromCSS.backgroundColor ){
                        layerData.inLayerStyleToCSS.backgroundColor = layerData.original.backgroundColor;
                    }
                    if( layerData.outLayerStyleToCSS.backgroundColor ){
                        layerData.outLayerStyleFromCSS.backgroundColor = layerData.original.backgroundColor;
                    }
                    if( layerData.inLayerStyleFromCSS.color ){
                        layerData.inLayerStyleToCSS.color = layerData.original.color;
                    }
                    if( layerData.outLayerStyleToCSS.color ){
                        layerData.outLayerStyleFromCSS.color = layerData.original.color;
                    }
                    if( typeof layerData.inLayerStyleShouldBeConvertedFrom.width !== 'undefined' ){
                        layerData.inLayerStyleShouldBeConvertedTo.width = layerData.original.width;
                    }
                    if( typeof layerData.outLayerStyleShouldBeConvertedTo.width !== 'undefined' ){
                        layerData.outLayerStyleShouldBeConvertedFrom.width = layerData.original.width;
                    }
                    if( typeof layerData.inLayerStyleShouldBeConvertedFrom.height !== 'undefined' ){
                        layerData.inLayerStyleShouldBeConvertedTo.height = layerData.original.height;
                    }
                    if( typeof layerData.outLayerStyleShouldBeConvertedTo.height !== 'undefined' ){
                        layerData.outLayerStyleShouldBeConvertedFrom.height = layerData.original.height;
                    }

                    // SET: Transition out
                    // showuntil compatibility | 0 means that layer will transition out only at slide change
                    // any other numeric value means that layer will slide out after showuntil ms of transition in

                    if( typeof layerData.out.showUntil !== 'undefined' && layerData.out.showUntil !== 0 ){
                        layerData.out.startAt = 'transitioninend + ' + layerData.out.showUntil;
                    }

                    if( layerData.out.startAt.indexOf( 'slidechangeonly' ) !== -1 && layerData.out.startAt !== 'slidechangeonly' ){
                        layerData.out.startAt = 'slidechangeonly';
                    }

                    if( layerData.out.enabled ){
                        layerData.outLayerTo.ease =
                        layerData.outLayerStyleTo.ease =
                        layerData.outClipTo.ease =
                        rb.functions.convert.easing( layerData.out.ease );
                    }

                    // SET: Loop transition
                    if( $.isNumeric( layerData.loop.count ) && ( layerData.loop.count > 0 || layerData.loop.count === -1 ) && layerData.loop.enabled !== false ){
                        layerData.loop.enabled = true;
                        layerData.loopTo.ease = layerData.loopClipTo.ease = rb.functions.convert.easing( layerData.loop.ease );
                        // SET: repeat regarding to yoyo
                        if( layerData.loop.count !== -1 ){
                            if( layerData.loop.yoyo ){
                                layerData.loop.repeat = 2 * layerData.loop.count - 1;
                            }else{
                                layerData.loop.repeat = layerData.loop.count - 1;
                            }
                        }else{
                            layerData.loop.repeat = -1;
                        }
                    }else{
                        layerData.loop.enabled = false;
                    }

                    // SET: Hover transition
                    if( ( !$.isEmptyObject( layerData.hoverToCSS ) ||
                        (
                            layerData.hoverShouldBeConverted.x ||
                            layerData.hoverShouldBeConverted.y ||
                            layerData.hoverShouldBeConverted.borderRadius ||
                            layerData.hoverShouldBeConverted.filter
                        )
                    ) && layerData.hover.enabled !== false ){
                        layerData.hover.enabled = true;
                        if( !layerData.hover.easeOut ){
                            layerData.hover.easeOut = layerData.hover.easeIn;
                        }
                        layerData.hover.easeIn = rb.functions.convert.easing( layerData.hover.easeIn );
                        layerData.hover.easeOut = rb.functions.convert.easing( layerData.hover.easeOut, true );

                        // SET: Hover duration
                        if( !layerData.hover.durationOut ){
                            layerData.hover.durationOut = layerData.hover.durationIn;
                        }

                        // SET: Hover tween
                        gsap.TweenMax.set( $layer[0], {
                            autoCSS: false,
                            css: {
                                transformPerspective: layerData.hoverShouldBeConverted.transformPerspective
                            }
                        });

                    }else{
                        layerData.hover.enabled = false;
                    }

                    // SET: Parallax transition
                    if( layerData.parallax.level && $.isNumeric( layerData.parallax.level ) && layerData.parallax.level !== 0 && layerData.parallax.enabled !== false ){
                        layerData.parallax.enabled = true;
                    }else{
                        layerData.parallax.enabled = false;
                    }

                    // SET: Ken Burns & filter transitions of slide background
                    if( layerData.is.slideBackground ){

                        var normal = {
                            scale: 1,
                            rotation: 0
                        };

                        // GET: Ken Burns settings from slide data
                        if( rb.slides[slideIndex].kenBurns.zoom ){
                            layerData.kenBurns = rb.slides[slideIndex].kenBurns;
                        }

                        if( layerData.kenBurns.zoom ){

                            layerData.kenBurns.from = {};
                            layerData.kenBurns.to = {};

                            switch( layerData.kenBurns.zoom ){

                                case 'out':
                                    layerData.kenBurns.from.scale = layerData.kenBurns.scale || 1;
                                    layerData.kenBurns.from.rotation = layerData.kenBurns.rotation || 0;
                                    layerData.kenBurns.to = normal;
                                break;

                                case 'in':
                                    layerData.kenBurns.from = normal;
                                    layerData.kenBurns.to.scale = layerData.kenBurns.scale || 1;
                                    layerData.kenBurns.to.rotation = layerData.kenBurns.rotation || 0;
                                break;
                            }

                            delete layerData.kenBurns.scale;
                            delete layerData.kenBurns.rotation;
                        }else{

                            layerData.kenBurns.from = normal;
                            layerData.kenBurns.to = normal;
                        }

                        // GET: Filter settings from slide data
                        if( !$.isEmptyObject( rb.slides[slideIndex].filter ) ){
                            if( rb.slides[slideIndex].filter.from ){
                                layerData.filter.values.bgFrom = rb.transitions.layers.filters.convert( rb.slides[slideIndex].filter.from );
                            }
                            if( rb.slides[slideIndex].filter.to ){
                                layerData.filter.values.bgTo = rb.transitions.layers.filters.convert( rb.slides[slideIndex].filter.to );
                            }
                        }
                    }

                    // SET: text transitions
                    if( layerData.textIn.type && rb.defaults.layer.splitTypeKeys.indexOf( layerData.textIn.type ) === -1 ){
                        delete layerData.textIn.type;
                        delete layerData.textIn.ns;
                        layerData.textIn.enabled = false;
                    }

                    if( layerData.textOut.type && rb.defaults.layer.splitTypeKeys.indexOf( layerData.textOut.type ) === -1 ){
                        delete layerData.textOut.type;
                        delete layerData.textOut.ns;
                        layerData.textOut.enabled = false;
                    }

                    if( layerData.textIn.type || layerData.textOut.type ){

                        if( layerData.is.textLayer ){

                            if( layerData.textIn.type ){

                                // SET: text transition in to enabled
                                layerData.textIn.enabled = true;
                                // SET: easing
                                layerData.textInNodesTo.ease = rb.functions.convert.easing( layerData.textInNodesTo.ease );
                                // SET: split
                                layerData.textIn.split = layerData.textIn.type.split( '_' )[0];
                            }

                            if( layerData.textOut.type ){

                                // SET: text transition in to enabled
                                layerData.textOut.enabled = true;
                                // SET: easing
                                layerData.textOutNodesTo.ease = rb.functions.convert.easing( layerData.textOutNodesTo.ease );
                            }

                            if( layerData.textOut.enabled && layerData.textOut.type.split( '_' )[0] !== layerData.textIn.split ){
                                // SET: split
                                layerData.textIn.split += ', ' + layerData.textOut.type.split( '_' )[0];
                            }

                            if( layerData.textIn.split.indexOf( 'chars' ) !== -1 && layerData.textIn.split.indexOf( 'words' ) === -1 ){
                                layerData.textIn.split += ', words';
                            }
                            if( layerData.textIn.split.indexOf( 'words' ) !== -1 && layerData.textIn.split.indexOf( 'lines' ) === -1 ){
                                layerData.textIn.split += ', lines';
                            }
                        }else{
                            delete layerData.textIn.type;
                            delete layerData.textOut.type;
                            delete layerData.textIn.ns;
                            delete layerData.textOut.ns;
                        }

                    }

                    // SET: clip
                    if( layerData.original.clip || layerData.inClipShouldBeConverted.clip || layerData.outClipShouldBeConverted.clip|| layerData.loopClipShouldBeConverted.clip ){
                        layerData.clip.enabled = true;
                    }

                    // SET: scale
                    if( layerData.in.enabled && layerData.inLayerToCSS.scale ){
                        delete layerData.inLayerToCSS.scaleX;
                        delete layerData.inLayerToCSS.scaleY;
                    }
                    if( layerData.out.enabled && layerData.outLayerToCSS.scale ){
                        delete layerData.outLayerToCSS.scaleX;
                        delete layerData.outLayerToCSS.scaleY;
                    }

                    // SET: filters
                    if( layerData.inLayerStyleShouldBeConvertedFrom.filter ){
                        layerData.filter.values.in = rb.transitions.layers.filters.convert( layerData.inLayerStyleShouldBeConvertedFrom.filter );
                    }

                    layerData.filter.values.style = rb.transitions.layers.filters.convert( layerData.original.filter );

                    if( layerData.outLayerStyleShouldBeConvertedTo.filter ){
                        layerData.filter.values.out = rb.transitions.layers.filters.convert( layerData.outLayerStyleShouldBeConvertedTo.filter );
                    }

                    if( layerData.loopLayerShouldBeConverted.filter ){
                        layerData.filter.values.loop = rb.transitions.layers.filters.convert( layerData.loopLayerShouldBeConverted.filter );
                    }

                    if( layerData.hoverShouldBeConverted.filter ){
                        layerData.filter.values.hover = rb.transitions.layers.filters.convert( layerData.hoverShouldBeConverted.filter );
                    }

                    // SET: duartions of disabled transitions to 0
                    if( !layerData.in.enabled ){ layerData.in.duration = 0; }
                    if( !layerData.textIn.enabled ){ layerData.textIn.duration = 0; }
                    if( !layerData.loop.enabled ){ layerData.loop.duration = 0; }
                    if( !layerData.textOut.enabled ){ layerData.textOut.duration = 0; }
                    if( !layerData.out.enabled ){ layerData.out.duration = 0; }

                    // SET & ADD: rb-slidein & rb-slideout data attributes
                    // These attributes tell the slider which Layer should animate in and out on which Slides
                    // Layers with no rb-slideout ClassName will not animate out at all, they remain static

                    $layer.attr( 'data-rb-slidein', slideIndex );

                    if( typeof layerData.settings.static !== 'undefined' && layerData.settings.static !== 'none' ){
                        var i = parseInt( layerData.settings.static );
                        if( i !== 0 && layerData.settings.static !== 'forever' ){
                            $layer.attr( 'data-rb-slideout', i );
                            layerData.settings.slideOut = i;
                        }else{
                            layerData.settings.slideOut = 0;
                        }
                        layerData.is.static = true;
                        $layer.attr( 'data-rb-static', '1' );
                    }else{
                        $layer.attr( 'data-rb-slideout', slideIndex );
                    }

                    if( layerData.is.mediaLayer ){

                        var $media = $layer.children( 'video, audio' ).eq(0);

                        //SET: controls
                        if( layerData.mediaSettings.controls !== null  ){

                            switch( layerData.mediaSettings.controls ){
                                case true:
                                    $media.prop( 'controls', true );
                                    $media.removeProp( 'nocontrols' ).removeAttr( 'nocontrols' );
                                break;
                                case false:
                                    $media.prop( 'controls', false );
                                break;
                            }
                        }

                        // SET: Media volume
                        if( layerData.mediaSettings.volume ){
                            if( layerData.mediaSettings.volume < 0 ){
                                layerData.mediaSettings.volume = 0;
                            }else if( layerData.mediaSettings.volume > 100 ){
                                layerData.mediaSettings.volume = 100;
                            }
                        }

                        // SET: background video
                        if( layerData.is.backgroundVideo ){
                            rb.media.setBackgroundVideo( layerData, $layer );

                            if( layerData.styleSettings.overlay ){
                                $layer.find( '.rb-bg-video-overlay' ).css({
                                    backgroundImage: 'url(' + layerData.styleSettings.overlay + ')'
                                });
                            }
                        }
                    }

                    // SET: font sizes
                    if( layerData.styleSettings.minfontsize ){
                        layerData.styleSettings.minfontsize = parseFloat( layerData.styleSettings.minfontsize );
                    }

                    if( layerData.styleSettings.minmobilefontsize ){
                        layerData.styleSettings.minmobilefontsize = parseFloat( layerData.styleSettings.minmobilefontsize );
                    }
                }
            },

            // RETURN: selected Layer elements by various filters
            get: function( options ){

                var $elements = this.$all;

                if( options ){

                    options = options.toLowerCase();
                    var inOrOut = 'in',
                        filter = '',
                        media = '',
                        bg = ':not(".rb-bg")',
                        bgvideo = ':not(".rb-bg-video")';

                    //SET: background video
                    if( options.indexOf( 'bgvideo' ) != -1 || options.indexOf( 'backgroundvideo' ) != -1 ){
                        bgvideo = '';
                        options = options.replace( 'bgvideo','' ).replace( 'backgroundvideo', '' );
                    }

                    // SELECT: media elements
                    if( options.indexOf( 'video' ) != -1 ){

                        media += ', > video';
                        options = options.replace( 'video','' );
                    }
                    if( options.indexOf( 'audio' ) != -1 ){

                        media += ', > audio';
                        options = options.replace( 'audio','' );
                    }
                    if( options.indexOf( 'html5' ) != -1 ){

                        media += ', > video, > audio';
                        options = options.replace( 'html5','' );
                    }
                    if( options.indexOf( 'youtube' ) != -1 ){

                        media += ', > iframe[src*="youtube-nocookie.com"], > iframe[src*="youtube.com"], > iframe[src*="youtu.be"], > iframe[data-src*="youtube-nocookie.com"], > iframe[data-src*="youtube.com"], > iframe[data-src*="youtu.be"]';
                        options = options.replace( 'youtube','' );
                    }
                    if( options.indexOf( 'vimeo' ) != -1 ){

                        media += ', > iframe[src*="player.vimeo"], > iframe[data-src*="player.vimeo"]';
                        options = options.replace( 'vimeo','' );
                    }
                    if( media.charAt(0) == ',' ){
                        media = media.substring(2, media.length);
                    }

                    // SELECT: transition direction
                    if( options.indexOf( 'out' ) != -1 ){
                        inOrOut = 'out';
                    }

                    // SET: filter
                    if( options.indexOf( 'img' ) != -1 || options.indexOf( 'image' ) != -1 ){
                        filter = 'img';
                    }

                    //SET: bg
                    if( options.indexOf( 'bg' ) != -1 || options.indexOf( 'background' ) != -1 || options.indexOf( 'bgonly' ) != -1 ){
                        bg = '';
                    }

                    // SELECT: Layers
                    if( options.indexOf( 'current' ) != -1 ){

                        $elements = $elements.filter( filter + '[data-rb-slide' + inOrOut + '="' + rb.slides.current.index + '"]' + bg + bgvideo );

                    }else if( options.indexOf( 'next' ) != -1 ){

                        $elements = $elements.filter( filter + '[data-rb-slide' + inOrOut + '="' + rb.slides.next.index + '"]' + bg + bgvideo );

                    }else{

                        $elements = $elements.filter( filter + bg + bgvideo );
                    }

                    // SELECT: only not active Layers
                    if( options.indexOf( 'notactive' ) != -1 ){
                        $elements = $elements.filter( '.rb-bg, .rb-bg-video, :hidden' );
                        options = options.replace( 'notactive','' );
                    }

                    // SELECT: only active Layers
                    if( options.indexOf( 'active' ) != -1 ){
                        $elements = $elements.filter( ':visible:not(.rb-bg, .rb-bg-video)' );
                        options = options.replace( 'active','' );
                    }

                    // SELECT: only not static layers
                    if( options.indexOf( 'notstatic' ) != -1 ){
                        $elements = $elements.filter(':not([data-rb-static="1"])');
                        options = options.replace( 'notstatic','' );
                    }

                    // SELECT: only static layers
                    if( options.indexOf( 'static' ) != -1 ){
                        $elements = $elements.filter('[data-rb-static="1"]');
                        options = options.replace( 'static','' );
                    }

                    // SELECT: only slide backgrounds
                    if( options.indexOf( 'bgonly' ) != -1 ){
                        $elements = $elements.filter('.rb-bg');
                        options = options.replace( 'bgonly','' );
                    }

                    // SELECT: Media $Elements in specified Layers
                    if( media !== '' ){
                        $elements = $elements.find( media );
                    }
                }

                return $elements;
            },

            // UPDATE: layer with new data-rb properties
            update: {

                // IMPORTANT: the whole data-rb shluld be set again with also the non-changing properties
                data: function( $layer, type, data ){

                    var slideIndex,
                        layerData,
                        original;

                    // IF: $layer is a selector, convert it into jQuery element
                    if( !( $layer instanceof jQuery ) ){
                        $layer = $( $layer );
                    }

                    // IF: data has been set, change data-rb (if not set, user should manually change the data-rb attribute)
                    if( data ){
                        $layer.attr( 'data-rb', data ).data( 'rb', data );
                    }

                    // SAVE: old properties
                    layerData = $layer.data( rb.defaults.init.dataKey );
                    slideIndex = layerData.is.onSlide;
                    original = layerData.original;

                    switch( type ){
                        default:
                        case 'transitions':
                            layerData.settings.timelineIsCalculated = false;
                            // SET: layer properties
                            rb.layers.set.properties( $layer, slideIndex, true );
                        break;
                        case 'all':
                            // SET: clean layer data
                            $layer.data( rb.defaults.init.dataKey, new rb.defaults.layer.options( $layer, slideIndex ) );
                            layerData = $layer.data( rb.defaults.init.dataKey );

                            // PUT: original properties to new layer data
                            layerData.original = original;

                            // SET: layer properties
                            rb.layers.set.properties( $layer, slideIndex, true );
                            rb.layers.set.wrappers( $layer, layerData, slideIndex );
                        break;
                    }
                }
            },

            // CREATE: new HTML markup | wrap layers into necessary wrapper elements
            wrap: function( slideIndex, lazy ){

                if( !rb.slides[slideIndex].wrapped && rb.slides[slideIndex].wrapped !== 'wrapping' ){

                    rb.slides[slideIndex].wrapped = 'wrapping';

                    var timeout = lazy ? 25 : 0;

                    // GET: layers of slide
                    var $layers = rb.slides[slideIndex].$layers,
                        len = $layers.length;

                    // Wrap them > new slider HTML Markup
                    $layers.each(function( w, layer ){

                        rb.timeouts['slide-' + slideIndex + '-layer-' + w] = setTimeout( function(){

                            // REMOVE: from rb.timeouts object
                            delete rb.timeouts['slide-' + slideIndex + '-layer-' + w];

                            var $layer = $(layer),
                                $anchorElement = $layer,
                                markup = '',
                                $wrapTo,
                                anchorShouldWrap = false,
                                hideClasses = '';

                            // SET: classes
                            if( $layer.hasClass( 'rb-hide-phone' ) ){
                                hideClasses += ' rb-hide-on-phone';
                            }
                            if( $layer.hasClass( 'rb-hide-tablet' ) ){
                                hideClasses += ' rb-hide-on-tablet';
                            }
                            if( $layer.hasClass( 'rb-hide-desktop' ) ){
                                hideClasses += ' rb-hide-on-desktop';
                            }
                            $layer.removeClass( 'rb-hide-phone rb-hide-tablet rb-hide-desktop' );

                            // SET: anchor element
                            if( $anchorElement.is( 'a' ) && $anchorElement.children().length === 1 ){
                                anchorShouldWrap = true;
                                $layer = $anchorElement.find( '.rb-layer' );
                            }

                            var layerData = $layer.data( rb.defaults.init.dataKey );

                            if( !layerData ){
                                return true;
                            }

                            // SET: wrapTo element
                            $wrapTo = rb.slider.$layersWrapper;

                            if( layerData.is.backgroundVideo ){
                                $wrapTo = rb.slider.$bgVideosWrapper;
                            }else if( layerData.is.slideBackground ){
                                $wrapTo = rb.slider.$slideBGWrapper;
                            }

                            // SET: layer style
                            rb.layers.set.style( $layer );

                            // SET: layer data
                            rb.layers.set.properties( $layer, slideIndex );

                            // IF: layer should be splitted...
                            if( layerData.textIn.split ){

                                var text = new SplitType( $layer[0], { split: layerData.textIn.split } );

                                // SAVE: nodes list into layer data
                                if( layerData.textIn.type ){
                                    layerData.textIn.ns = text[ layerData.textIn.type.split( '_' )[0] ];
                                }

                                if( layerData.textOut.type ){
                                    layerData.textOut.ns = text[ layerData.textOut.type.split( '_' )[0] ];
                                }
                            }

                            // SET: markup
                            // IF: layer is slide background image
                            if( layerData.is.slideBackground || layerData.is.backgroundVideo ){
                                markup = '<div class="rb-wrapper rb-bg-outer"><div class="rb-wrapper rb-bg-wrap"></div></div>';

                            // IF: layer is not slide background image
                            }else{
                                if( layerData.clip.enabled ){
                                    markup = '<div class="rb-wrapper rb-clip"></div>';
                                }
                                if( layerData.loop.enabled ){
                                    markup = '<div class="rb-wrapper rb-loop">' + markup + '</div>';
                                }
                                markup = '<div class="rb-wrapper rb-in-out">' + markup + '</div>';
                            }

                            if( layerData.parallax.enabled ){
                                markup = '<div class="rb-wrapper rb-parallax">' + markup + '</div>';
                            }

                            // FIX: Safari z-bug
                            if( rb.browser.isSafari ){
                                markup = '<div class="rb-wrapper rb-z">' + markup + '</div>';
                            }

                            // CREATE: markup
                            if( markup !== '' ){
                                // WRAP: layer
                                $layer.appendTo( $wrapTo ).wrap( markup );
                            }else{
                                // WRAP: layer
                                $layer.appendTo( $wrapTo );
                            }

                            if( anchorShouldWrap === true ){
                                $anchorElement.addClass( 'rb-layer-link' ).appendTo( $layer.parent() );
                            }

                            var css = {},
                                blend = $layer.css( 'mix-blend-mode' );

                            // SET: mix-blend-mode to the outer wrapper
                            if( blend && blend !== 'normal' ){
                                css['mix-blend-mode'] = blend;
                                $layer.css( 'mix-blend-mode', 'normal' );
                            }

                            layerData.original.customZIndex = 1;
                            var z = parseInt( layerData.original.zIndex );

                            // SET: z-indexes
                            if( layerData.is.backgroundVideo ){
                                css = {
                                    zIndex: layerData.original.customZIndex
                                };
                            }else if( layerData.is.slideBackground ){
                                css = {
                                    zIndex: layerData.original.customZIndex
                                };
                            }else{
                                if( !z ){
                                    z = w + 101;
                                }
                                css.zIndex = z;
                                layerData.original.customZIndex = z;
                            }

                            if( rb.browser.isSafari ){
                                css.transform = 'translateZ(' + ( z * 3000 ) + 'px )';
                            }

                            // SET: wrappers
                            rb.layers.set.wrappers( $layer, layerData, slideIndex );

                            // APPLY: style settings and classes to outer wrapper element
                            layerData.elements.$outerWrapper.css( css ).addClass( hideClasses );

                            // APPLY: slide background color
                            if( layerData.is.slideBackground ){
                                layerData.elements.$bgWrapper.css({
                                    backgroundColor: rb.slides[slideIndex].data.backgroundColor
                                });
                            }

                            // ADD: Layer > rb.layers.$all
                            rb.layers.$all = rb.layers.$all.add( $layer );

                            // REMOVE: layer from rb.slides[slideIndex] jQuery collection
                            rb.slides[slideIndex].$layers = rb.slides[slideIndex].$layers.not( $anchorElement );

                            // IF: the last layer has been wrapped...
                            if( w === len-1 ){
                                // EMPTY: slide element
                                $slider.children( '.rb-slide' ).eq( slideIndex - 1 ).empty();
                                // SET: slide wrapped to true
                                rb.slides[slideIndex].wrapped = true;
                            }

                        }, timeout * ( w+1 ) );
                    });
                }
            }
        };

        rb.slideshow = {

            direction: 'next',
            nextLoop: 0,
            firstStart: true,

            sequence: {
                normal: [],
                randomized: []
            },

            state: {
                running: true,
                paused: false,
                pausedByVideo: false,
                pausedByHover: false,
                pausedByLastCycle: false
            },

            should: {
                change: false,
                start: false,
                stop: false
            },

            isPaused: function(){

                return this.state.paused || this.state.pausedByVideo || this.state.pausedByHover;
            },

            init: function(){

                // SET: Slider with only one Slide
                if( rb.slides.count  == 1 ){
                    rb.o.autoStart = false;
                    rb.o.navPrevNext = false;
                    rb.o.navStartStop = false;
                    rb.o.navButtons = false;
                    rb.o.cycles = -1;
                    rb.o.forceLoopNum = false;
                    rb.o.autoPauseSlideshow = true;
                    rb.o.firstSlide = 1;
                    rb.o.thumbnailNavigation = 'disabled';
                }

                // If slider should not start
                if( !rb.o.autoStart || rb.slides.count == 1 ){

                    // SET: slideshow states
                    rb.functions.setStates( this, {
                        running: false,
                        paused: true
                    });
                }

                this.set.pauseOnHover();
                this.set.sequences();
            },

            set: {

                pauseOnHover: function(){

                    rb.o.pauseOnHover = rb.o.pauseOnHover === true ? rb.defaults.init.options.pauseOnHover : rb.o.pauseOnHover;

                    // SET: pause on hover
                    if( rb.o.pauseOnHover !== false ){

                        $slider.on( 'mouseenter.' + sliderUID, function(){

                            if( !rb.slider.state.inFullscreen ){

                                // SET: slideshow state
                                rb.functions.setStates( rb.slideshow, {
                                    pausedByHover: true
                                });

                                if( rb.o.pauseOnHover !== 'slideshowOnly' ){
                                    rb.transitions.layers.timeline.pause();
                                }
                            }
                        }).on( 'mouseleave.' + sliderUID, function(){

                            var maxProgress = 1;

                            if( rb.transitions._slideTimeline && rb.transitions._slideTimeline.duration() > rb.transitions.layers.timeline.totalDuration ){
                                maxProgress = rb.transitions.layers.timeline.totalDuration / rb.transitions._slideTimeline.duration();
                            }
                            // SET: slideshow state
                            rb.functions.setStates( rb.slideshow, {
                                pausedByHover: false
                            });

                            if( !$( 'body' ).hasClass( 'rb-unselectable' ) && rb.o.pauseOnHover !== 'slideshowOnly' && ( !rb.o.pauseLayers || !rb.slideshow.isPaused() ) ){
                                rb.transitions.layers.timeline.resume();
                            }

                            if( rb.transitions._slideTimeline && rb.transitions.layers.timeline.state.finished && rb.transitions._slideTimeline.progress() < maxProgress ){
                                // SET: timeline state
                                rb.functions.setStates( rb.transitions.layers.timeline, {
                                    finished: false
                                });
                            }

                            rb.slideshow.start();
                        });
                    }
                },

                sequences: function(){

                    for( var s=0; s<rb.slides.count; s++ ){

                        rb.slideshow.sequence.normal[s] = s + 1;
                    }

                    rb.slideshow.sequence.randomized = rb.functions.shuffleArray( $.merge( [], rb.slideshow.sequence.normal ) );
                },

                normalizedSequence: function(){

                    var sequenceType = rb.o.shuffleSlideshow? 'randomized' : 'normal',
                        sequence = rb.slideshow.sequence[sequenceType],
                        seqLength = rb.slideshow.sequence[sequenceType].length,
                        firstIndex = sequence.indexOf( rb.slides.first.index );

                    rb.slideshow.sequence.normalized = [];

                    for( var n1=firstIndex; n1<seqLength; n1++ ){
                        rb.slideshow.sequence.normalized.push( sequence[n1] );
                    }

                    for( var n2=0; n2<firstIndex; n2++ ){
                        rb.slideshow.sequence.normalized.push( sequence[n2] );
                    }
                },

                prevNext: function( prevOrNext ){

                    switch( prevOrNext ){

                        case 'prev':

                            // IF: twoWaySlideshow is set and the user clicks to prev
                            if( rb.o.twoWaySlideshow ){
                                // SET: slideshow direction to 'prev'
                                rb.slideshow.direction = 'prev';
                            }

                            rb.slideshow.changeTo( rb.slideshow.get.slideInSequence( 'prev' ), true );

                        break;

                        case 'next':

                            rb.slideshow.direction = 'next';
                            rb.slideshow.changeTo( rb.slideshow.get.slideInSequence( 'next' ), true );

                        break;
                    }
                }
            },

            get: {

                sequence: function(){

                    var sequence = 'normal';

                    if( !rb.o.playByScroll ){
                        if( rb.o.shuffleSlideshow){
                            sequence = 'randomized';
                        }
                    }else{
                        // Can be randomized but the first slide index will be in the first place
                        sequence = 'normalized';
                    }

                    return sequence;
                },

                // RETURN: slide ordinal depending on action
                slideInSequence: function( action ){

                    var curSequence = rb.slideshow.sequence[this.sequence()],
                        curIndex = curSequence.indexOf( rb.slides.current.index );

                    switch( action ){
                        case 'prev': return curIndex === 0 ? curSequence[curSequence.length-1] : curSequence[curIndex-1];
                        case 'next': return curIndex === curSequence.length-1 ? curSequence[0] : curSequence[curIndex+1];
                        default: return curSequence[action];
                    }
                },

                // RETURN: index in sequence of a slide
                indexOfSlideInSequence: function( slide ){

                    return rb.slideshow.sequence[this.sequence()].indexOf( slide );
                }
            },

            cycles: {

                set: function(){

                    if( rb.o.cycles > 0 ){

                        rb.slideshow.curCycle = 1;
                        rb.slideshow.cycleSlideIndex = rb.slideshow.get.indexOfSlideInSequence( rb.slides.first.index );
                    }
                },

                check: function ( slideIndex ){

                    if( rb.slideshow.get.indexOfSlideInSequence( slideIndex ) === rb.slideshow.cycleSlideIndex ){
                        return ++rb.slideshow.curCycle === rb.o.cycles + 1;
                    }
                }
            },

            start: function( forceChange ){

                if( !this.isPaused() && rb.transitions._slideTimeline && rb.transitions.layers.timeline.state.finished ){
                    this.changeTo( rb.slides.next.index );
                }
            },

            stop: function(){

                // SET: slideshow states
                rb.functions.setStates( this, {
                    running: false,
                    paused: true
                });
            },

            changeTo: function( slideIndex, changedByUser, changedByBullets ){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                // CHECK: if current and next slides are the same
                if( rb.slides.current.index === slideIndex ){ return false; }

                // API CALL: slideChangeWillStart
                if( !this.firstStart && rb.api.hasEvent( 'slideChangeWillStart' ) ){

                    var _slideChangeWillStart = $slider.triggerHandler( 'slideChangeWillStart', rb.api.eventData() );

                    if( _slideChangeWillStart === false ){
                        return;
                    }else if( $.isNumeric( _slideChangeWillStart ) ){
                        slideIndex = parseInt( _slideChangeWillStart );
                    }
                }

                // IF: slideIndex is invalid
                if( slideIndex > rb.slides.count || slideIndex < 1 ){
                    return;
                }

                // Start slide change only if slider is not busy
                if( !rb.slider.isBusy() && ( !rb.slideshow.state.pausedByVideo || changedByUser ) ){

                    rb.functions.setStates( rb.transitions.layers.timeline, {
                        finished: false
                    });

                    // SET: FORCE slide change to false
                    rb.slideshow.should.change = false;

                    // IF: slideshow is changed by user
                    if( changedByUser ){

                        if( rb.navigation.direction === 'prev' && rb.o.twoWaySlideshow ){
                            rb.slideshow.direction = 'prev';
                        }

                    }else{
                        rb.navigation.direction = rb.slideshow.direction;
                    }

                    // STOP: timers
                    rb.transitions.timers.reverse();

                    // STOP: media
                    rb.media.stop( true );

                    // SET: next slide
                    rb.slides.set.nextSlideIndex( slideIndex );

                    // SET: slideshow state
                    rb.functions.setStates( this, {
                        pausedByVideo: false
                    });

                    // SET: slider state
                    rb.functions.setStates( rb.slider, {
                        changingSlides: true
                    });

                    // CALL: image preload
                    rb.preload.imagesOfSlide( rb.slides.next.index, function(){
                        rb.transitions.start();
                    });

                }else if( !rb.slider.state.preloadingImages && rb.slider.state.animatingSlides && rb.transitions._slideTransition ){
                    // FORCE: slide change
                    rb.slideshow.should.change = true;
                    rb.transitions._slideTransition.progress( 1 );
                    if( rb.transitions._forceLayersOut ){
                        rb.transitions._forceLayersOut.progress( 1 );
                    }
                }
            },

            forceStop: function(){

                // STOP: slideshow
                rb.navigation.stop();

                // CLEAR: timeouts
                $.each(rb.timeouts, function(index, value) {
                    clearTimeout( rb.timeouts[index] );
                });

                // STOP: timers
                rb.transitions.timers.stop();

                // STOP: slide timeline
                rb.transitions._slideTimeline.stop();

                // SET: timeline states
                rb.functions.setStates( rb.transitions.layers.timeline, {
                    stopped: true,
                    running: false
                });

                // STOP: all jquery animations on all elements
                $slider.find( '*' ).stop( true, false ).dequeue();
            },

            restart: function(){

                $slider.find( '*' ).stop();
                rb.navigation.change( rb.slides.current.index, rb.slideshow.direction );
            }
        };

        rb.media = {

            errors: {},
            $allMediaLayers: $(),
            protocol: 'http:',
            playingInCurSlide: 0,
            endedInCurSlide: 0,

            init: function(){

                // SET: protocol
                if( document.location.href.indexOf( 'https:' ) != -1 ){
                    this.protocol = 'https:';
                }

                // SET: slider states
                rb.functions.setStates( rb.slider, {
                    waitingForYouTube: false,
                    waitingForVimeo: false
                });

                // CALL: media init functions
                rb.media.youtube.init();
                rb.media.vimeo.init();
                rb.media.html5.init();
            },

            youtube: {

                // INIT: embedded videos
                init: function(){

                    var count = 0,
                        checkYouTubeIsReady;

                    // GET: all YouTube videos in the slider
                    this.$videos = rb.slider.$hiddenWrapper.find( 'iframe[src*="youtube-nocookie.com"], iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[data-src*="youtube-nocookie.com"], iframe[data-src*="youtube.com"], iframe[data-src*="youtu.be"]' ).each(function(){

                        var $video = $(this),
                            $layer = $video.parent(),
                            layerData = $layer.data( rb.defaults.init.dataKey ),
                            src = ( $video.attr( 'src' ) || $video.attr( 'data-src' ) ).replace( /&amp;/g, '&' ).replace( 'autoplay=1','autoplay=0' ).replace( '?','?smart=true&' ),
                            protocol = src.indexOf( 'http' ) === -1 ? rb.media.protocol : '',
                            sep = src.indexOf( '?' ) === -1 ? '?' : '&',
                            saved = {
                                $videoElement: $video,
                                videoURL: protocol + src + sep + 'wmode=opaque&html5=1&enablejsapi=1&version=3&rel=0',
                                videoThumbnailURL: rb.media.protocol + '//img.youtube.com/vi/' + src.split( 'embed/' )[1].split( '?' )[0] + '/' + rb.o.youtubePreview
                            };

                        // mute automatically if autoplay is enabled
                        var d = ($layer.data().rb || '').replace(/\s+/g, '');
                        if (rb.o.autoPlayVideos && d.indexOf('autoplay:disabled') < 0 || !rb.o.autoPlayVideos && d.indexOf('autoplay:enabled') >= 0) {
                            saved.videoURL += '&mute=1';
                        }

                        $video.attr( 'id', 'rb-youtube-' + (++count) );

                        // SAVE: media properties into layer data
                        layerData.mediaProperties = {
                            type: 'youtube',
                            saved: saved
                        };

                        // SET: properties
                        rb.media.setProperties( layerData );

                        if( layerData.is.backgroundVideo ){
                            // SET: background video properties
                            rb.media.setBackgroundVideo( layerData, $layer );
                        }

                        if( !layerData.is.backgroundVideo ){
                            rb.media.setMediaElements( $layer, $video, saved.videoURL, saved.videoThumbnailURL, layerData );
                        }
                    });

                    // ADD: YouTube video parent layers
                    rb.media.$allMediaLayers = rb.media.$allMediaLayers.add( this.$videos.parent() );

                    // IF: there are any YouTube videos in the slider...
                    if( this.$videos.length ){

                        rb.timeouts.loadYouTube = Math.floor( Date.now() / 1000 );

                        if( !window.YT && !$('script[src*="youtube.com/iframe_api"]').length ){
                            // LOAD: YouTube iframe API
                            $( '<script>' ).appendTo( 'head' )
                                .attr('src', 'https://www.youtube.com/iframe_api');
                        }

                        var YTR = 'onYouTubeIframeAPIReady';
                        var onYTReady = function(){
                            // WHEN: YouTube iframe API is ready...
                            window._RbSlider.globals.youTubeIsReady = true;
                        };
                        window[YTR] = window[YTR] ? (function(parent) {
                            return function() {
                                parent();
                                onYTReady();
                            }
                        })(window[YTR]) : onYTReady;

                        rb.intervals.isYouTubeReady = setInterval( function(){

                            if( ( window.YT && window.YT.loaded === 1 ) || window._RbSlider.globals.youTubeIsReady || Math.floor( Date.now() / 1000 ) - rb.timeouts.loadYouTube > 3 ){

                                // CLEAR & REMOVE: interval from rb.intervals object
                                clearInterval( rb.intervals.isYouTubeReady );
                                delete rb.intervals.isYouTubeReady;
                                delete rb.timeouts.loadYouTube;

                                window._RbSlider.globals.youTubeIsReady = true;

                                // SET: video events on each videos
                                rb.media.youtube.$videos.parent().each(function(){

                                    var $layer = $(this),
                                        layerData = $layer.data( rb.defaults.init.dataKey ),
                                        saved = layerData.mediaProperties.saved;

                                    $layer.on( 'playMedia.' + sliderUID + ' click.' + sliderUID, '.rb-vpcontainer', function(){

                                        // HIDE: video thumbnail
                                        rb.media.hideThumbnail( $(this) );

                                        // CHECK: slideshow state
                                        rb.media.checkSlideshowState( $layer, layerData );

                                        // REMOVE: media layer from timeline (if it has showUntil property for example) if the media is starting to play
                                        rb.media.removeFromTimeline( $layer );

                                        // START: playing video
                                        rb.media.youtube.play( $layer, saved.$videoElement, saved.videoURL, layerData );
                                    }).on( 'playBackgroundVideo.' + sliderUID, function(){

                                        // START: playing video
                                        rb.media.youtube.play( $layer, saved.$videoElement, saved.videoURL, layerData );
                                    }).on( 'stopBackgroundVideo.' + sliderUID, function(){

                                        // STOP: playing video
                                        rb.media.youtube.stop( $layer, saved.$videoElement, layerData, true );
                                    }).on( 'preloadBackgroundVideo.' + sliderUID, function(){

                                        // PRELOAD: video for smooth transitions
                                        rb.media.youtube.createPlayer( $layer, saved.$videoElement, saved.videoURL, layerData, true );
                                    });
                                });

                                // SET: slider state
                                rb.functions.setStates( rb.slider, {
                                    waitingForYouTube: false
                                });

                            }else{

                                // SET: slider state
                                rb.functions.setStates( rb.slider, {
                                    waitingForYouTube: true
                                });
                            }
                        }, 25 );
                    }
                },

                // CREATE: player
                createPlayer: function( $layer, $video, videoURL, layerData, preloadOnly ){

                    // SET: player ready function
                    var playerReady = function(){

                        // SET: volume
                        if( layerData.mediaSettings.volume !== null ){
                            layerData.mediaProperties.player.setVolume( layerData.mediaSettings.volume );
                        }

                        if( !preloadOnly || layerData.mediaProperties.shouldPlay ){
                            // START: playing for the first time
                            layerData.mediaProperties.player.playVideo();

                            layerData.mediaProperties.shouldPlay = false;
                        }
                    };

                    // SET: video ended function
                    var videoEnded = function( event ){
                        if( event.data === 0 ){
                            if( layerData.is.backgroundVideo ){
                                layerData.mediaProperties.player.seekTo(0);
                            }else{
                                rb.media.videoEnded( $layer, layerData );
                            }
                        }
                    };

                    // SET: showinfo
                    if( layerData.mediaSettings.showinfo !== null ){

                        videoURL = videoURL.replace('&showinfo=0','').replace('&showinfo=1','');

                        switch( layerData.mediaSettings.showinfo ){
                            case true:
                                videoURL += '&showinfo=1';
                            break;
                            case false:
                                videoURL += '&showinfo=0';
                            break;
                        }
                    }

                    // SET: controls
                    if( layerData.mediaSettings.controls !== null ){

                        videoURL = videoURL.replace('&controls=0','').replace('&controls=1','');

                        switch( layerData.mediaSettings.controls ){
                            case true:
                                videoURL += '&controls=1';
                            break;
                            case false:
                                videoURL += '&controls=0';
                            break;
                        }
                    }

                    // SET: video url
                    $video.attr( 'src', videoURL );

                    // CREATE: YT.Player
                    layerData.mediaProperties.player = new YT.Player( $video[0], {
                        events: {
                            'onReady': playerReady,
                            'onStateChange': videoEnded
                        }
                    });
                },

                // PLAY | RESUME: video
                play: function( $layer, $video, videoURL, layerData ){

                    // IF: player is not exist...
                    if( !layerData.mediaProperties.player ){
                        // CREATE: player
                        this.createPlayer( $layer, $video, videoURL, layerData );
                    }else if( layerData.mediaProperties.player.playVideo ){
                        // START: playing video
                        layerData.mediaProperties.player.playVideo();
                    }else{
                        layerData.mediaProperties.shouldPlay = true;
                    }
                },

                // STOP: video | seek to 0
                // @ slide change
                // Must use .pauseVideo() instead of .stopVideo(), because .stopVideo() could put the player in different states
                // and because of this in some cases the video would start after .seekTo(0)!!!
                stop: function( $layer, $video, layerData, resetMedia  ){

                    // IF: player is exist...
                    if( layerData.mediaProperties.player ){
                        // STOP: video
                        layerData.mediaProperties.player.pauseVideo();
                        if( resetMedia ){
                            layerData.mediaProperties.player.seekTo(0);
                        }
                        // IF: not a background video
                        if( !layerData.is.backgroundVideo ){
                            // SHOW: video thumbnail
                            rb.media.showThumbnail( $layer.find( '.rb-vpcontainer' ) );
                        }
                    }
                }
            },

            vimeo: {

                // INIT: embedded videos
                init: function(){

                    // GET: all Vimeo videos in the slider
                    var $vimeoVideos = this.$videos = rb.slider.$hiddenWrapper.find( 'iframe[src*="player.vimeo"], iframe[data-src*="player.vimeo"]' );

                    // IF: there are any Vimeo videos in the slider...
                    if( $vimeoVideos.length ){

                        rb.timeouts.loadVimeo = Math.floor( Date.now() / 1000 );

                        // ADD: Vimeo video parent layers
                        rb.media.$allMediaLayers = rb.media.$allMediaLayers.add( $vimeoVideos.parent() );

                        var count = 0;

                        // LOAD: Vimeo player API
                        $( '<script>' ).attr({
                            'src' : rb.media.protocol + '//f.vimeocdn.com/js/froogaloop2.min.js',
                            'type' : 'text/javascript'
                        }).appendTo( 'head' );

                        // CHECK: if Vimeo player API is ready
                        rb.intervals.isVimeoReady = setInterval( function(){

                            // SET: slider state
                            rb.functions.setStates( rb.slider, {
                                waitingForVimeo: true
                            });

                            if( window.Froogaloop || Math.floor( Date.now() / 1000 ) - rb.timeouts.loadVimeo > 3 ){
                                // CLEAR & REMOVE: interval from rb.intervals object
                                clearInterval( rb.intervals.isVimeoReady );
                                delete rb.intervals.isVimeoReady;
                                delete rb.timeouts.loadVimeo;

                                window._RbSlider.globals.vimeoIsReady = true;
                                onVimeoPlayerAPIReady();
                            }
                        }, 25 );

                        // WHEN: Vimeo player API is ready...
                        var onVimeoPlayerAPIReady = function(){

                            // ON EACH: videos
                            rb.media.vimeo.$videos.each(function(){

                                // SET: variables
                                var $video = $(this).attr( 'id', 'rb-vimeo-' + ( ++count ) ),
                                    $layer = $video.parent(),
                                    layerData = $layer.data( rb.defaults.init.dataKey ),
                                    src = ( $video.attr( 'src' ) || $video.attr( 'data-src' ) ).replace( /&amp;/g, '&' ).replace( 'autoplay=1','autoplay=0' ).replace( '?','?smart=true&' ),
                                    sep = src.indexOf( '?' ) === -1 ? '?' : '&',
                                    protocol = src.indexOf( 'http' ) === -1 ? rb.media.protocol : '',
                                    options = 'wmode=opaque&api=1&player_id=rb-vimeo-' + count,
                                    jsonURL = rb.media.protocol + '//vimeo.com/api/v2/video/'+ ( src.split('video/')[1].split('?')[0] ) +'.json?callback=?',
                                    videoURL = protocol + src + sep + options;

                                // SAVE: media properties into layer data
                                layerData.mediaProperties = {
                                    type: 'vimeo',
                                    saved: {}
                                };

                                // SET: properties
                                rb.media.setProperties( layerData );

                                if( layerData.is.backgroundVideo ){
                                    // SET: background video properties
                                    rb.media.setBackgroundVideo( layerData, $layer );
                                }

                                // SET: video elements
                                $.getJSON( jsonURL, function( data ){

                                    if( !layerData.is.backgroundVideo ){
                                        rb.media.setMediaElements( $layer, $video, videoURL, data[0].thumbnail_large, layerData );
                                    }
                                });

                                // SET: video events
                                $layer.on( 'playMedia.' + sliderUID + ' click.' + sliderUID, '.rb-vpcontainer', function(){

                                    // FADE OUT: video thumbnail
                                    rb.media.hideThumbnail( $(this) );

                                    // CHECK: slideshow state
                                    rb.media.checkSlideshowState( $layer, layerData );

                                    // REMOVE: media layer from timeline (if it has showUntil property for example) if the media is starting to play
                                    rb.media.removeFromTimeline( $layer );

                                    // START: playing video
                                    rb.media.vimeo.play( $layer, $video, videoURL, layerData );
                                }).on( 'playBackgroundVideo.' + sliderUID, function(){

                                    // START: playing video
                                    rb.media.vimeo.play( $layer, $video, videoURL, layerData );
                                }).on( 'stopBackgroundVideo.' + sliderUID, function(){

                                    // STOP: playing video
                                    rb.media.vimeo.stop( $layer, $video, layerData, true );
                                }).on( 'preloadBackgroundVideo.' + sliderUID, function(){

                                    // PRELOAD: video for smooth transitions
                                    rb.media.vimeo.createPlayer( $layer, $video, videoURL, layerData, true );
                                });
                            });

                            // SET: slider state
                            rb.functions.setStates( rb.slider, {
                                waitingForVimeo: false
                            });
                        };
                    }
                },

                // CREATE: player
                createPlayer: function( $layer, $video, videoURL, layerData, preloadOnly ){

                    // SET: showinfo
                    if( layerData.mediaSettings.showinfo !== null ){

                        videoURL = videoURL.replace('&title=0','').replace('&title=1','').replace('&byline=0','').replace('&byline=1','').replace('&portrait=0','').replace('&portrait=1','');

                        switch( layerData.mediaSettings.showinfo ){
                            case true:
                                videoURL = videoURL.replace('title=0','title=1','').replace('byline=0','byline=1','').replace('portrait=0','portrait=1','');
                            break;
                            case false:
                                videoURL = videoURL.replace('title=1','title=0','').replace('byline=1','byline=0','').replace('portrait=1','portrait=0','');
                            break;
                        }
                    }

                    // SET: video url for the first time
                    $video.attr( 'src', videoURL );

                    // SET: video ended function
                    var videoEnded = function(){
                        if( layerData.is.backgroundVideo ){
                            layerData.mediaProperties.player.api( 'seekTo', 0 ).api( 'play' );
                        }else{
                            rb.media.videoEnded( $layer, layerData );
                        }
                    };

                    // CREATE: vimeo player
                    layerData.mediaProperties.player = $f( $video[0] );

                    // SET: player events
                    layerData.mediaProperties.player.addEvent('ready', function(){

                        layerData.mediaProperties.player.addEvent('finish', videoEnded );
                        // SET: volume
                        if( layerData.mediaSettings.volume !== null ){
                            layerData.mediaProperties.player.api( 'setVolume', layerData.mediaSettings.volume / 100 );
                        }

                        if( !preloadOnly ){
                            // START: playing video for the first time
                            layerData.mediaProperties.player.api( 'play' );
                        }
                    });
                },

                // PLAY | RESUME: video
                play: function( $layer, $video, videoURL, layerData ){

                    // IF: player is not exist...
                    if( !layerData.mediaProperties.player ){
                        // CREATE: player
                        this.createPlayer( $layer, $video, videoURL, layerData );
                    }else{
                        // START: playing video
                        layerData.mediaProperties.player.api( 'play' );
                    }
                },

                // STOP: video | seek to 0
                // @ slide change
                stop: function( $layer, $video, layerData, resetMedia ){

                    // IF: player is exist...
                    if( layerData.mediaProperties.player ){
                        // STOP: video
                        layerData.mediaProperties.player.api( 'pause' );
                        if( resetMedia ){
                            layerData.mediaProperties.player.api( 'seekTo', 0 );
                        }
                        // IF: not a background video
                        if( !layerData.is.backgroundVideo ){
                            // SHOW: video thumbnail
                            rb.media.showThumbnail( $layer.find( '.rb-vpcontainer' ) );
                        }
                    }
                }
            },

            html5: {

                init: function(){

                    // GET: all HTML5 video and audio elements in the slider
                    this.$elements = rb.slider.$hiddenWrapper.find( 'video, audio' );

                    // ADD: HTML5 media element parent layers
                    rb.media.$allMediaLayers = rb.media.$allMediaLayers.add( this.$elements.parent() );

                    // If there are any HTML5 video and audio elements in the slider...
                    if( this.$elements.length ){

                        var count = 0;

                        rb.media.html5.$elements.each(function(){

                            var $media = $(this).attr( 'id', 'rb-html5-' + ( ++count ) ),
                                $layer = $(this).parent(),
                                layerData = $layer.data( rb.defaults.init.dataKey );

                            // SAVE: media properties into layer data
                            layerData.mediaProperties = {
                                type: 'html5',
                                saved: {}
                            };

                            // SET: properties
                            rb.media.setProperties( layerData );

                            if( layerData.is.backgroundVideo ){
                                // SET: background video properties
                                rb.media.setBackgroundVideo( layerData, $layer );
                            }

                            // FIX: HTML5 media element with autoplay atttribute
                            if( $media.attr( 'autoplay' ) ){
                                var $newMedia = $media.removeAttr( 'autoplay' ).clone( true, true );
                                $media.remove();
                                $media = $newMedia.appendTo( $layer );
                                $layer.data( 'rb', $layer.data( 'rb' ) + ' autoplay: true;' );
                            }

                            if( !layerData.is.backgroundVideo ){
                                rb.media.setMediaElements( $layer, $media, false, false, layerData );
                            }

                            $media.on( 'ended.' + sliderUID, function(){
                                if( layerData.is.backgroundVideo ){
                                    $media[0].currentTime = 0;
                                    $media[0].play();
                                }else{
                                    rb.media.videoEnded( $layer, layerData );
                                }
                            });

                            // SET: normal media events
                            $layer.on( 'playMedia.' + sliderUID + ' click.' + sliderUID, '.rb-vpcontainer', function( e ){

                                // FADE OUT: video thumbnail
                                rb.media.hideThumbnail( $(this) );

                                // CHECK: slideshow state
                                rb.media.checkSlideshowState( $layer, layerData );

                                // REMOVE: media layer from timeline (if it has showUntil property for example) if the media is starting to play
                                rb.media.removeFromTimeline( $layer );

                                // START: playing video
                                rb.media.html5.play( $layer, $media, layerData );
                            }).on( 'playBackgroundVideo.' + sliderUID, function(){

                                // START: playing video
                                rb.media.html5.play( $layer, $media, layerData );
                            }).on( 'stopBackgroundVideo.' + sliderUID, function(){

                                // STOP: playing video
                                rb.media.html5.stop( $layer, $media, layerData, true );
                            });
                        });
                    }
                },

                // PLAY | RESUME: media
                play: function( $layer, $media, layerData ){

                    // SET: volume
                    if( layerData.mediaSettings.volume !== null && !layerData.mediaProperties.volumeIsSet ){
                        $media[0].volume = layerData.mediaSettings.volume / 100;
                        layerData.mediaProperties.volumeIsSet = true;
                    }

                    // START: playing media
                    $media[0].play();
                },

                stop: function( $layer, $media, layerData, resetMedia ){

                    // STOP: media & seek to 0
                    $media[0].pause();
                    if( resetMedia ){
                        $media[0].currentTime = 0;
                    }

                    // IF: not a background video
                    if( !layerData.is.backgroundVideo ){
                        // SHOW: video thumbnail
                        rb.media.showThumbnail( $layer.find( '.rb-vpcontainer' ) );
                    }
                }
            },

            setBackgroundVideo: function( layerData, $layer ){

                layerData.mediaSettings = {
                    controls: false,
                    autoplay: false,
                    showinfo: false,
                    fillmode: 'cover',
                    thumbnail: false,
                    volume: layerData.mediaSettings.volume ? layerData.mediaSettings.volume : 0
                };

                // GET: custom thumbnail if specified
                if( $layer.data( 'rb' ) && $layer.data( 'rb' ).indexOf( 'poster:' ) !== -1 && $layer.children( '.rb-vpcontainer' ).length == 0 ){

                    var vpContainer = $( '<div>' ).addClass( 'rb-vpcontainer' ).appendTo( $layer ),
                        videoThumbnailURL = $layer.data( 'rb' ).split( 'poster:' )[1].split( ';')[0].trim();

                    // APPEND: video thumbnail
                    $( '<div>' ).appendTo( vpContainer ).addClass( 'rb-videopreview' ).attr({
                        style: 'background-image: url(' + videoThumbnailURL + ')'
                    });
                }
            },

            setProperties: function( layerData ){

                layerData.is.mediaLayer = true;
            },

            setMediaElements: function( $layer, $el, videoURL, videoThumbnailURL, layerData ){

                var vpContainer = $( '<div>' ).addClass( 'rb-vpcontainer' ).appendTo( $layer ),
                    url = false,
                    mediaWidth,
                    mediaHeight;

                if( ( layerData.mediaSettings.autoplay === null && rb.o.autoPlayVideos ) || layerData.mediaSettings.autoplay ){
                    $layer.addClass( 'rb-autoplay' );
                }else{
                    // APPEND: play button
                    $( '<div>' ).appendTo( vpContainer ).addClass( 'rb-playvideo' );
                }

                // GET: custom thumbnail if specified
                if( $layer.data( 'rb' ) && $layer.data( 'rb' ).indexOf( 'poster:' ) !== -1 ){
                    videoThumbnailURL = $layer.data( 'rb' ).split( 'poster:' )[1].split( ';')[0].trim();
                }

                // IF: element is YouTube or Vimeo video
                if( $el.is( 'iframe' ) ){

                    // APPEND: video thumbnail
                    $( '<div>' ).appendTo( vpContainer ).addClass( 'rb-videopreview' ).attr({
                        style: 'background-image: url(' + videoThumbnailURL + ')'
                    });

                // IF: element is HTML5 video or audio
                }else{

                    // SET: video thumbnail url
                    if( !videoThumbnailURL && typeof $el.attr( 'poster' ) !== 'undefined' ){
                        videoThumbnailURL = $el.attr( 'poster' );
                        $el.removeAttr( 'poster' );
                    }

                    if( videoThumbnailURL ){
                        // APPEND: video thumbnail image
                        $( '<div>' ).appendTo( vpContainer ).addClass( 'rb-videopreview' ).attr({
                            style: 'background-image: url(' + videoThumbnailURL + ')'
                        });
                    }
                }
            },

            checkSlideshowState: function( $layer, layerData ){

                // SET: slideshow state and stop slideshow if needed
                // Static video layer cannot pause slideshow
                if( !layerData.is.static && rb.o.autoPauseSlideshow ){

                    // SET: slideshow state
                    rb.functions.setStates( rb.slideshow, {
                        pausedByVideo: true
                    });

                    if( rb.o.autoPauseSlideshow == 'auto' ){
                        this.playingInCurSlide++;
                    }
                }
            },

            hideThumbnail: function( $videoThumbnail ){

                // FADE OUT: video thumbnail
                $videoThumbnail.delay( rb.transitions.media.defaults.delay ).fadeOut( rb.transitions.media.defaults.fadeOut );
            },

            showThumbnail: function( $videoThumbnail ){

                // FADE IN: video thumbnail
                $videoThumbnail.fadeIn( rb.transitions.media.defaults.fadeIn );
            },

            videoEnded: function( $layer, layerData ){

                // If the slideshow should start after video ends...
                if( rb.o.autoPauseSlideshow == 'auto' && !layerData.is.backgroundVideo ){

                    // If the currently ended video is not in a static layer
                    if( !layerData.is.static ){
                        this.endedInCurSlide ++;
                    }

                    // If the number of ended videos equals the number of played videos in the current slide
                    if( this.endedInCurSlide == this.playingInCurSlide && this.playingInCurSlide !== 0 ){

                        // SET: slideshow state
                        rb.functions.setStates( rb.slideshow, {
                            pausedByVideo: false
                        });

                        // SET: slideshow remaining slide duration to 1
                        rb.slideshow.remainingSlideDuration = 1;

                        // START: slideshow
                        rb.slideshow.start();
                    }
                }
            },

            playIfAllowed: function( $layer ){

                var layerData = $layer.data( rb.defaults.init.dataKey );

                if( layerData.is.mediaLayer  ){

                    // IF: media element is hidden on a mobile phone or tablet
                    if(
                        rb.device.isMobile &&
                        (
                            ( $slider.hasClass( 'rb-device-is-phone' ) && layerData.elements.$outerWrapper.hasClass( 'rb-hide-on-phone' ) ) ||
                            ( $slider.hasClass( 'rb-device-is-tablet' ) && layerData.elements.$outerWrapper.hasClass( 'rb-hide-on-tablet' ) )
                        )
                    ){
                        // do NOT play background video
                    }else if(
                        // IF: local autoplay is true or local autoplay is not defined but global autoplay is true...
                        ( layerData.mediaSettings.autoplay === null && rb.o.autoPlayVideos ) ||
                        layerData.mediaSettings.autoplay
                    ){
                        $layer.find( '.rb-vpcontainer' ).trigger( 'playMedia' );
                    }
                }
            },

            stop: function( resetMedia ){

                var self = this;
                resetMedia = typeof resetMedia !== 'undefined' ? resetMedia : true;

                rb.layers.get('current,out,youtube').each(function(){
                    var $video = $(this),
                        $layer = $video.closest('.rb-layer'),
                        layerData = $layer.data( rb.defaults.init.dataKey );

                    self.youtube.stop( $layer, $video, layerData, resetMedia );
                });

                rb.layers.get('current,out,vimeo').each(function(){
                    var $video = $(this),
                        $layer = $video.closest('.rb-layer'),
                        layerData = $layer.data( rb.defaults.init.dataKey );

                    self.vimeo.stop( $layer, $video, layerData, resetMedia );
                });

                rb.layers.get('current,out,html5').each(function(){
                    var $video = $(this),
                        $layer = $video.closest('.rb-layer'),
                        layerData = $layer.data( rb.defaults.init.dataKey );

                    self.html5.stop( $layer, $video, layerData, resetMedia );
                });

                // RESET: counters on slide change
                this.playingInCurSlide = 0;
                this.endedInCurSlide = 0;
            },

            removeFromTimeline: function( $layer ){

                rb.transitions._slideTimeline.kill( null, $layer.closest( '.rb-in-out' )[0] );
            }
        };

        rb.yourLogo = {

            init: function(){

                if( rb.o.yourLogo ){
                    this.$element = $( '<img>' ).addClass( 'rb-yourlogo' ).appendTo($slider).attr( 'style', rb.o.yourLogoStyle ).css({
                        visibility: 'hidden',
                        display: 'bock'
                    }).on( 'load.' + sliderUID, function(){

                        var logoTimeout = rb.yourLogo.$element ? 500 : 0;

                        rb.timeouts.yourLogo = setTimeout( function(){

                            // REMOVE: from rb.timeouts object
                            delete rb.timeouts.yourLogo;

                            rb.yourLogo.$element.data( 'originalWidth', rb.yourLogo.$element.width() );
                            rb.yourLogo.$element.data( 'originalHeight', rb.yourLogo.$element.height() );
                            if( rb.yourLogo.$element.css( 'left' ) != 'auto' ){
                                rb.yourLogo.$element.data( 'originalLeft', rb.yourLogo.$element[0].style.left );
                            }
                            if( rb.yourLogo.$element.css( 'right' ) != 'auto' ){
                                rb.yourLogo.$element.data( 'originalRight', rb.yourLogo.$element[0].style.right );
                            }
                            if( rb.yourLogo.$element.css( 'top' ) != 'auto' ){
                                rb.yourLogo.$element.data( 'originalTop', rb.yourLogo.$element[0].style.top );
                            }
                            if( rb.yourLogo.$element.css( 'bottom' ) != 'auto' ){
                                rb.yourLogo.$element.data( 'originalBottom', rb.yourLogo.$element[0].style.bottom );
                            }

                            // NEW FEATURES v1.8 added yourLogoLink & yourLogoTarget

                            if( rb.o.yourLogoLink !== false ){
                                $( '<a>' ).appendTo($slider).attr( 'href', rb.o.yourLogoLink ).attr( 'target', rb.o.yourLogoTarget ).css({
                                    textDecoration : 'none',
                                    outline : 'none'
                                }).append( rb.yourLogo.$element );
                            }

                            rb.yourLogo.$element.css({
                                display: 'none',
                                visibility: 'visible'
                            });

                            rb.yourLogo.resize();

                        }, logoTimeout );

                    }).attr( 'src', rb.o.yourLogo );
                }
            },

            resize: function(){

                this.$element.css({
                    width : this.$element.data( 'originalWidth' ) * rb.resize.ratio,
                    height : this.$element.data( 'originalHeight' ) * rb.resize.ratio
                });

                this.$element.fadeIn(300);

                var oL = 'auto',
                    oR = 'auto',
                    oT = 'auto',
                    oB = 'auto';

                if( this.$element.data( 'originalLeft' ) && this.$element.data( 'originalLeft' ).indexOf( '%' ) != -1 ){
                    oL = $slider.width() / 100 * parseFloat( this.$element.data( 'originalLeft' ) ) - this.$element.width() / 2 + parseInt( $slider.css( 'padding-left' ) );
                }else{
                    oL = parseInt( this.$element.data( 'originalLeft' ) ) * rb.resize.ratio;
                }

                if( this.$element.data( 'originalRight' ) && this.$element.data( 'originalRight' ).indexOf( '%' ) != -1 ){
                    oR = $slider.width() / 100 * parseFloat( this.$element.data( 'originalRight' ) ) - this.$element.width() / 2 + parseInt( $slider.css( 'padding-right' ) );
                }else{
                    oR = parseInt( this.$element.data( 'originalRight' ) ) * rb.resize.ratio;
                }

                if( this.$element.data( 'originalTop' ) && this.$element.data( 'originalTop' ).indexOf( '%' ) != -1 ){
                    oT = $slider.height() / 100 * parseFloat( this.$element.data( 'originalTop' ) ) - this.$element.height() / 2 + parseInt( $slider.css( 'padding-top' ) );
                }else{
                    oT = parseInt( this.$element.data( 'originalTop' ) ) * rb.resize.ratio;
                }

                if( this.$element.data( 'originalBottom' ) && this.$element.data( 'originalBottom' ).indexOf( '%' ) != -1 ){
                    oB = $slider.height() / 100 * parseFloat( this.$element.data( 'originalBottom' ) ) - this.$element.height() / 2 + parseInt( $slider.css( 'padding-bottom' ) );
                }else{
                    oB = parseInt( this.$element.data( 'originalBottom' ) ) * rb.resize.ratio;
                }

                this.$element.css({
                    left : oL,
                    right : oR,
                    top : oT,
                    bottom : oB
                });
            }
        };

        rb.gui = {

            navigation: {

                init: function(){

                    if( rb.o.navPrevNext ){

                        // SET: Navigation (prev, next)
                        this.prevNext.init();
                    }

                    if( rb.o.navStartStop || rb.o.navButtons ){

                        // SET: Navigation (bottom)
                        this.bottom.init();
                    }
                },

                prevNext: {

                    init: function(){

                        $( '<a class="rb-gui-element rb-nav-prev" href="#" />' ).on( 'click.' + sliderUID, function( e ){
                            e.preventDefault();
                            $slider.RbSlider( 'prev' );
                        }).appendTo($slider);

                        $( '<a class="rb-gui-element rb-nav-next" href="#" />' ).on( 'click.' + sliderUID, function( e ){
                            e.preventDefault();
                            $slider.RbSlider( 'next' );
                        }).appendTo($slider);

                        if( rb.o.hoverPrevNext ){

                            this.setHover();
                        }
                    },

                    setHover: function(){

                        $slider.find( '.rb-nav-prev, .rb-nav-next' ).css({
                            display: 'none'
                        });

                        $slider.on( 'mouseenter.' + sliderUID, function(){
                            if( !rb.gui.navigation.forceHide ){
                                $slider.find( '.rb-nav-prev, .rb-nav-next' ).stop(true,true).fadeIn(300);
                            }
                        }).on( 'mouseleave.' + sliderUID, function(){
                            $slider.find( '.rb-nav-prev, .rb-nav-next' ).stop(true,true).fadeOut(300);
                        });
                    }
                },

                bottom: {

                    init: function(){

                        this.wrapper = $( '<div class="rb-gui-element rb-bottom-nav-wrapper" />' ).appendTo( $slider );

                        if( rb.o.navButtons && rb.o.thumbnailNavigation != 'always' ){
                            this.bullets.init();
                        }

                        if( rb.o.navStartStop ){
                            this.createStartStop();

                        }else if( rb.o.thumbnailNavigation != 'always' ){
                            this.createSides();
                        }

                        if( rb.o.hoverBottomNav && rb.o.thumbnailNavigation != 'always' ){
                            this.setHover();
                        }

                        // SET: Navigation (bottom, thumbnails)
                        if( rb.o.thumbnailNavigation == 'always' ){
                            this.wrapper.addClass( 'rb-above-thumbnails' );
                            this.thumbnails.init();
                        }
                    },

                    bullets: {

                        init: function(){

                            var self = this;

                            $( '<span class="rb-bottom-slidebuttons" />' ).appendTo( $slider.find( '.rb-bottom-nav-wrapper' ) );

                            // NEW FEATURE v3.5 thumbnailNavigation ( 'hover' )

                            for( var x=0; x<rb.slides.count; x++ ){

                                var bullet = $( '<a href="#" />' ).appendTo( $slider.find( '.rb-bottom-slidebuttons' ) ).data( 'index',x+1).on( 'click.' + sliderUID, function( e ){
                                    e.preventDefault();
                                    $slider.RbSlider( $(this).data( 'index' ) );
                                });

                                // NEW FEATURE v3.5 thumbnailNavigation ( 'hover' )

                                if( rb.o.thumbnailNavigation == 'hover' ){

                                    bullet.on( 'mouseenter.' + sliderUID, function(){

                                        var bullet = $(this);

                                        $slider.find( '.rb-thumbnail-hover-img' ).css({
                                            left: parseInt( self.hoverWrapper.css( 'padding-left' ) ),
                                            top: parseInt( self.hoverWrapper.css( 'padding-top' ) )
                                        });

                                        self.hoverImage.on( 'load.' + sliderUID, function(){

                                            if( $(this).width() === 0 ){
                                                self.hoverImage.css({
                                                    position: 'relative',
                                                    margin: '0 auto',
                                                    left: 'auto'
                                                });
                                            }else{
                                                self.hoverImage.css({
                                                    position: 'absolute',
                                                    marginLeft : - $(this).width() / 2,
                                                    left: '50%'
                                                });
                                            }

                                            self.hoverImage.css( 'display','none' ).stop(true,true).fadeIn(250);

                                        }).attr( 'src', rb.slides[bullet.data( 'index' )].data.thumbnail );

                                        self.hoverWrapper.css({
                                            display: 'block'
                                        }).stop().animate({
                                            left: $(this).position().left + ( $(this).width() - self.hoverWrapper.outerWidth() ) / 2
                                        }, 250 );

                                        self.hoverWrapperInner.css({
                                            display : 'none',
                                            visibility : 'visible'
                                        }).stop().fadeIn(250);
                                    }).on( 'mouseleave.' + sliderUID, function(){

                                        self.hoverWrapperInner.stop().fadeOut(250, function(){
                                            self.hoverWrapper.css({
                                                visibility : 'hidden',
                                                display: 'block'
                                            });
                                        });
                                    });
                                }
                            }

                            self.set.active( rb.slides.first.index );

                            if( rb.o.thumbnailNavigation == 'hover' ){

                                self.set.hover();
                            }
                        },

                        set: {

                            active: function( index ){

                                if( typeof index === 'undefined' ){
                                    index = rb.slides.current.index;
                                }

                                index--;

                                $slider.find( '.rb-bottom-slidebuttons a' ).removeClass( 'rb-nav-active' );
                                $slider.find( '.rb-bottom-slidebuttons a:eq( '+( index )+' )' ).addClass( 'rb-nav-active' );
                            },

                            hover: function(){

                                var self = rb.gui.navigation.bottom.bullets;

                                var thumbs = $( '<div class="rb-thumbnail-hover"><div class="rb-thumbnail-hover-inner"><div class="rb-thumbnail-hover-bg"></div><div class="rb-thumbnail-hover-img"><img></div><span></span></div></div>' ).appendTo( $slider.find( '.rb-bottom-slidebuttons' ) );

                                $slider.find( '.rb-thumbnail-hover, .rb-thumbnail-hover-img' ).css({
                                    width : rb.o.tnWidth,
                                    height : rb.o.tnHeight
                                });

                                self.hoverWrapper = $slider.find( '.rb-thumbnail-hover' );

                                self.hoverImage = self.hoverWrapper.find( 'img' ).css({
                                    height : rb.o.tnHeight
                                });

                                self.hoverWrapperInner = $slider.find( '.rb-thumbnail-hover-inner' ).css({
                                    visibility : 'hidden',
                                    display: 'block'
                                });

                                thumbs.appendTo( $slider.find( '.rb-bottom-slidebuttons' ) );
                            }
                        }
                    },

                    createStartStop: function(){

                        this.buttonStart = $( '<a class="rb-nav-start" href="#" />' ).on( 'click.' + sliderUID, function( e ){
                            e.preventDefault();
                            $slider.RbSlider( 'start' );
                        }).prependTo( $slider.find( '.rb-bottom-nav-wrapper' ) );

                        this.buttonStop = $( '<a class="rb-nav-stop" href="#" />' ).on( 'click.' + sliderUID, function( e ){
                            e.preventDefault();
                            $slider.RbSlider( 'stop' );
                        }).appendTo( $slider.find( '.rb-bottom-nav-wrapper' ) );

                        if( rb.o.autoStart ){
                            this.setStartStop( 'start' );
                        }else{
                            this.setStartStop( 'stop' );
                        }
                    },

                    setStartStop: function( state ){

                        if( rb.o.navStartStop ){

                            switch( state ){
                                case 'start':
                                    this.buttonStart.addClass( 'rb-nav-start-active' );
                                    this.buttonStop.removeClass( 'rb-nav-stop-active' );
                                break;
                                case 'stop':
                                    this.buttonStart.removeClass( 'rb-nav-start-active' );
                                    this.buttonStop.addClass( 'rb-nav-stop-active' );
                                break;
                            }
                        }
                    },

                    createSides: function(){

                        $( '<span class="rb-nav-sides rb-nav-sideleft" />' ).prependTo( $slider.find( '.rb-bottom-nav-wrapper' ) );
                        $( '<span class="rb-nav-sides rb-nav-sideright" />' ).appendTo( $slider.find( '.rb-bottom-nav-wrapper' ) );
                    },

                    setHover: function(){

                        var self = this;

                        self.wrapper.css({
                            display: 'none'
                        });

                        $slider.on( 'mouseenter.' + sliderUID, function(){
                            if( !rb.gui.navigation.forceHide ){
                                self.wrapper.stop(true,true).fadeIn(300);
                            }
                        }).on( 'mouseleave.' + sliderUID, function(){
                            self.wrapper.stop(true,true).fadeOut(300);
                        });
                    },

                    switchHelper: function( val ){

                        if( rb.o.hoverBottomNav && !$slider.hasClass( 'rb-hover' ) ){

                            switch( val ){
                                case 'on':
                                    rb.gui.navigation.bottom.thumbnails.wrapper.css({
                                        visibility: 'hidden',
                                        display: 'block'
                                    });
                                break;
                                case 'off':
                                    rb.gui.navigation.bottom.thumbnails.wrapper.css({
                                        visibility: 'visible',
                                        display: 'none'
                                    });
                                break;
                            }
                        }
                    },

                    thumbnails: {

                        init: function(){

                            var self = this;

                            this.wrapper = $( '<div class="rb-gui-element rb-thumbnail-wrapper"></div>' ).appendTo( $slider );
                            $( '<div class="rb-thumbnail"><div class="rb-thumbnail-inner"><div class="rb-thumbnail-slide-container"><div class="rb-thumbnail-slide"></div></div></div></div>' ).appendTo( this.wrapper );
                            this.$element = $slider.find( '.rb-thumbnail-slide-container' );

                            if( !( 'ontouchstart' in window) ){
                                this.$element.on( 'mouseenter.' + sliderUID, function(){
                                    $(this).addClass( 'rb-thumbnail-slide-hover' );
                                }).on( 'mouseleave.' + sliderUID, function(){
                                    $(this).removeClass( 'rb-thumbnail-slide-hover' );
                                    rb.gui.navigation.bottom.thumbnails.scroll();
                                }).on( 'mousemove.' + sliderUID, function( e ){
                                    var mL = parseInt(e.pageX - $(this).offset().left ) / $(this).width() * ( $(this).width() - $(this).find( '.rb-thumbnail-slide' ).width() );
                                    $(this).find( '.rb-thumbnail-slide' ).stop().css({
                                        marginLeft : mL
                                    });
                                });
                            }else{
                                this.$element.addClass( 'rb-touchscroll' );
                            }

                            for( var x=0; x<rb.slides.count; x++ ){

                                var index = x + 1,
                                    thumb = $( '<a href="#" class="rb-thumb-' + ( x + 1 ) + '"><img src="' + rb.slides[index].data.thumbnail + '"></a>' );

                                if( rb.slides[index].data.tnAlt ){
                                    thumb.find( 'img' ).attr( 'alt', rb.slides[index].data.tnAlt );
                                }

                                thumb.data( 'index', index ).on( 'click.' + sliderUID, function( e ){
                                    e.preventDefault();
                                    $slider.RbSlider( $(this).data( 'index' ) );
                                }).appendTo( $slider.find( '.rb-thumbnail-slide' ) );

                                if( !( 'ontouchstart' in window) ){

                                    thumb.on( 'mouseenter.' + sliderUID, function(){
                                        $(this).children().stop().fadeTo(300,rb.o.tnActiveOpacity/100);
                                    }).on( 'mouseleave.' + sliderUID, function(){
                                        if( !$(this).children().hasClass( 'rb-thumb-active' ) ){
                                            $(this).children().stop().fadeTo(300,rb.o.tnInactiveOpacity/100);
                                        }
                                    });
                                }
                            }

                            if( rb.gui.navigation.bottom.buttonStart && rb.gui.navigation.bottom.buttonStop ){

                                rb.gui.navigation.bottom.wrapper = $( '<div class="rb-bottom-nav-wrapper rb-below-thumbnails"></div>' ).appendTo( $slider );

                                rb.gui.navigation.bottom.buttonStart.clone().on( 'click.' + sliderUID, function( e ){
                                    e.preventDefault();
                                    $slider.RbSlider( 'start' );
                                }).appendTo( rb.gui.navigation.bottom.wrapper );
                                rb.gui.navigation.bottom.buttonStop.clone().on( 'click.' + sliderUID, function( e ){
                                    e.preventDefault();
                                    $slider.RbSlider( 'stop' );
                                }).appendTo( rb.gui.navigation.bottom.wrapper );
                            }

                            if( rb.o.hoverBottomNav ){
                                self.setHover();
                            }
                        },

                        setHover: function(){

                            var self = this;

                            self.wrapper.css( 'display','none' );

                            if( rb.gui.navigation.bottom.wrapper ){
                                rb.gui.navigation.bottom.wrapper = rb.gui.navigation.bottom.wrapper.css( 'display' ) == 'block' ? rb.gui.navigation.bottom.wrapper : $slider.find( '.rb-above-thumbnails' );
                                rb.gui.navigation.bottom.wrapper.css( 'display' , 'none' );
                            }

                            $slider.on( 'mouseenter.' + sliderUID, function(){
                                $slider.addClass( 'rb-hover' );
                                if( !rb.gui.navigation.forceHide ){
                                    self.wrapper.stop(true,true).fadeIn(300);
                                    if( rb.gui.navigation.bottom.wrapper ){
                                        rb.gui.navigation.bottom.wrapper.stop(true,true).fadeIn(300);
                                    }
                                }
                            }).on( 'mouseleave.' + sliderUID, function(){
                                $slider.removeClass( 'rb-hover' );
                                self.wrapper.stop(true,true).fadeOut(300);
                                if( rb.gui.navigation.bottom.wrapper ){
                                    rb.gui.navigation.bottom.wrapper.stop(true,true).fadeOut(300);
                                }
                            });
                        },

                        change: function( index ){

                            var curIndex = index ? index : rb.slides.next.index;

                            $slider.find( '.rb-thumbnail-slide a:not(.rb-thumb-'+curIndex+' )' ).children().each(function(){
                                $(this).removeClass( 'rb-thumb-active' ).stop().fadeTo(750,rb.o.tnInactiveOpacity/100);
                            });

                            $slider.find( '.rb-thumbnail-slide a.rb-thumb-'+curIndex).children().addClass( 'rb-thumb-active' ).stop().fadeTo(750,rb.o.tnActiveOpacity/100);
                        },

                        scroll: function(){

                            if( !$slider.find( '.rb-thumbnail-slide-container' ).hasClass( 'rb-thumbnail-slide-hover' ) ){
                                var curThumb = $slider.find( '.rb-thumb-active' ).length ? $slider.find( '.rb-thumb-active' ).parent() : false;
                                if( curThumb ){
                                    var thumbCenter = curThumb.position().left + curThumb.width() / 2;
                                    var mL = $slider.find( '.rb-thumbnail-slide-container' ).width() / 2 - thumbCenter;
                                    mL = mL < $slider.find( '.rb-thumbnail-slide-container' ).width() - $slider.find( '.rb-thumbnail-slide' ).width() ? $slider.find( '.rb-thumbnail-slide-container' ).width() - $slider.find( '.rb-thumbnail-slide' ).width() : mL;
                                    mL = mL > 0 ? 0 : mL;
                                    $slider.find( '.rb-thumbnail-slide' ).animate({
                                        marginLeft : mL
                                    }, 600 );
                                }
                            }
                        },

                        resize: function(){

                            rb.gui.navigation.bottom.switchHelper( 'on' );

                            var sliderWidth = rb.slider.initial.width.indexOf( '%' ) == -1 ? parseInt( rb.slider.initial.originalWidth ) : $slider.width(),
                                thumbNails = $slider.find( '.rb-thumbnail' ),
                                originalWidth = rb.o.tnContainerWidth.indexOf( '%' ) == -1 ? parseInt( rb.o.tnContainerWidth ) : parseInt( sliderWidth / 100 * parseInt( rb.o.tnContainerWidth ) );

                            $slider.find( '.rb-thumbnail-slide a' ).css({
                                width : parseInt( rb.o.tnWidth * rb.resize.ratio ),
                                height : parseInt( rb.o.tnHeight * rb.resize.ratio )
                            });

                            $slider.find( '.rb-thumbnail-slide a:last' ).css({
                                margin: 0
                            });

                            $slider.find( '.rb-thumbnail-slide' ).css({
                                height : parseInt( rb.o.tnHeight * rb.resize.ratio )
                            });

                            thumbNails.css({
                                width : originalWidth * Math.floor( rb.resize.ratio * 100 ) / 100
                            });

                            if( thumbNails.width() > $slider.find( '.rb-thumbnail-slide' ).width() ){
                                thumbNails.css({
                                    width : $slider.find( '.rb-thumbnail-slide' ).width()
                                });
                            }

                            rb.gui.navigation.bottom.switchHelper( 'off' );
                        }
                    }
                }
            },

            skin: {

                load: function(){

                    $slider.addClass( 'rb-'+rb.o.skin);

                    var skinStyle = rb.o.skinsPath+rb.o.skin+'/skin.css',
                        cssContainer = $( 'head' ).length ? $( 'head' ) : $( 'body' ),
                        curSkin = $( '#rb-skin-'+rb.o.skin+', link[href^="'+skinStyle+'"]' );

                    if( curSkin.length ){
                        // curSkin = $( 'link[href="'+skinStyle+'"]' );

                        if( !rb.gui.skin.isLoaded ){
                            rb.gui.skin.isLoaded = true;
                            // SET: delay because of caching bugs
                            rb.timeouts.skinLoad1 = setTimeout(function(){
                                // REMOVE: from rb.timeouts object
                                delete rb.timeouts.skinLoad1;
                                // INIT: slider
                                rb.slider.init();
                            },150);
                        }
                    }else{
                        if (document.createStyleSheet ){
                            document.createStyleSheet(skinStyle);
                            curSkin = $( 'link[href="'+skinStyle+'"]' );
                        }else{
                            curSkin = $( '<link rel="stylesheet" href="'+skinStyle+'" type="text/css" />' ).appendTo( cssContainer );
                        }
                    }

                    // CALL: curSkin.load() function (working in most of the browsers)
                    curSkin.on( 'load.' + sliderUID, function(){
                        if( !rb.gui.skin.isLoaded ){
                            rb.gui.skin.isLoaded = true;
                            // SET: delay because of caching bugs
                            rb.timeouts.skinLoad2 = setTimeout(function(){
                                // REMOVE: from rb.timeouts object
                                delete rb.timeouts.skinLoad2;
                                // INIT: slider
                                rb.slider.init();
                            },150);
                        }
                    });

                    // CALL: $( window ).load() function (working in older webkit browsers ( < v536 ))
                    $( window ).on( 'load.' + sliderUID, function(){
                        if( !rb.gui.skin.isLoaded ){
                            rb.gui.skin.isLoaded = true;
                            // SET: delay because of caching bugs
                            rb.timeouts.skinLoad3 = setTimeout(function(){
                                // REMOVE: from rb.timeouts object
                                delete rb.timeouts.skinLoad3;
                                // INIT: slider
                                rb.slider.init();
                            },150);
                        }
                    });

                    // CALL: rb.slider.init() manually, if $( window ).load() not fired in a sec after $(document).ready(),
                    // curSkin.load() not fired at all or the name of the skin and / or the skinsPath
                    // mistyped
                    rb.timeouts.skinLoad4 = setTimeout( function(){
                        if( !rb.gui.skin.isLoaded ){
                            rb.gui.skin.isLoaded = true;
                            // REMOVE: from rb.timeouts object
                            delete rb.timeouts.skinLoad4;
                            // INIT: slider
                            rb.slider.init();
                        }
                    }, 1000);
                }
            },

            shadow: {

                init: function(){

                    this.set();
                    this.resize();
                },

                set: function(){

                    this.$element = $( '<div class="rb-gui-element rb-shadow"></div>' ).appendTo( $slider );
                    if( this.$element.css( 'display' ) == 'block' && !this.$element.find( 'img' ).length ){
                        this.show = function(){
                            rb.gui.shadow.$element.css({
                                display: 'none',
                                visibility: 'visible'
                            }).fadeIn( 500, function(){
                                rb.gui.shadow.show = false;
                            });
                        };

                        this.image = $( '<img>' ).attr( 'src',rb.o.skinsPath.replace('/views/css/', '/views/img/')+rb.o.skin+'/shadow.png' ).appendTo( this.$element );
                        this.btmMod = typeof parseInt( $slider.css( 'padding-bottom' ) ) == 'number' ? parseInt( $slider.css( 'padding-bottom' ) ) : 0;
                    }
                },

                resize: function(){

                    if( this.image ){
                        if( this.image.height() > 0 ){
                            if( this.btmMod > 0 ){
                                this.$element.css({
                                    height: this.image.height() / 2
                                });
                            }else{
                                this.$element.css({
                                    height: this.image.height(),
                                    marginTop: - this.image.height() / 2
                                });
                            }
                        }else{
                            rb.timeouts.resizeShadow = setTimeout(function(){
                                // REMOVE: from rb.timeouts object
                                delete rb.timeouts.resizeShadow;
                                rb.gui.shadow.resize();
                            },50);
                        }
                    }
                }
            },

            timers: {

                init: function(){

                    // SET: barTimer
                    if( rb.o.showBarTimer ){
                        this.bar.create();
                    }

                    // SET: circleTimer
                    if( rb.o.showCircleTimer ){
                        this.circle.create();
                    }

                    // SET: slideBarTimer
                    var $slideBarContainerElement = false;

                    if( rb.o.showSlideBarTimer ){
                        // GET: from init code
                        $slideBarContainerElement = $( '<div>').insertAfter( $slider );
                    }else{
                        // GET: from HTML markup
                        $slideBarContainerElement = $( '[data-slidebar-for="' + $slider.attr( 'id' ) + '"], [data-slidebar-for="' + sliderUID + '"]' );
                    }

                    if( $slideBarContainerElement.length ){
                        $slideBarContainerElement.addClass( 'rb-gui-element' );
                        this.slidebar.create( $slideBarContainerElement );
                    }
                },

                bar: {

                    create: function(){

                        this.$element = $( '<div>' ).addClass( 'rb-gui-element rb-bar-timer' ).appendTo( $slider );
                    }
                },

                circle: {

                    create: function(){

                        this.$element = $( '<div>' ).addClass( 'rb-gui-element rb-circle-timer' ).appendTo( $slider );
                        this.$element.append( $( '<div class="rb-ct-center"></div><div class="rb-ct-left"><div class="rb-ct-rotate"><div class="rb-ct-hider"><div class="rb-ct-half"></div></div></div></div><div class="rb-ct-right"><div class="rb-ct-rotate"><div class="rb-ct-hider"><div class="rb-ct-half"></div></div></div></div>' ) );
                        this.$element.data( 'original', {
                            opacity: this.$element.css('opacity')
                        });
                    }
                },

                slidebar: {

                    // all indexes of arrays with starting of $ are containing jQuery collections
                    $containerElement: [],
                    $element: [],
                    $progressBarElement: [],
                    $sliderContainerElement: [],
                    $sliderElement: [],

                    elementWidth: [],
                    containerElementWidth: [],
                    sliderContainerElementWidth: [],

                    create: function( $slideBarContainerElement ){

                        var $dragStopElements = $( document ),
                            left,
                            self = this,
                            drag = function( e, index ){
                                left = ( e.pageX ? e.pageX : rb.device.touchX ) - self.$element[index].offset().left - self.sliderContainerElementWidth[index] / 2;
                                if( left < 0 ){ left = 0; }
                                if( left > self.containerElementWidth[index] - self.sliderContainerElementWidth[index] ){ left = 'calc( 100% - ' + rb.gui.timers.slidebar.sliderContainerElementWidth[index] + 'px )'; }
                                self.$sliderContainerElement[index].css({
                                    left: left
                                });
                                if( rb.transitions._slideTimeline ){
                                    rb.transitions._slideTimeline.progress( typeof left === 'string' ? rb.transitions.layers.timeline.progress : left / ( self.containerElementWidth[index] - self.sliderContainerElementWidth[index] ) * rb.transitions.layers.timeline.progress );
                                }
                            },
                            stopDrag = function( e, index ){
                                $( document ).off( 'mousemove.' + sliderUID );
                                $( 'body' ).prop( 'unselectable', false ).removeClass( 'rb-unselectable' );

                                if( ( !rb.o.pauseLayers || rb.slideshow.state.running ) && !rb.slider.isPaused && rb.transitions._slideTimeline && !rb.o.playByScroll ){
                                    if( rb.transitions.layers.timeline.state.started === true ){
                                        rb.transitions.layers.timeline.resume();
                                    }else{
                                        rb.transitions.layers.timeline.play();
                                    }
                                }
                            };


                        $.each( $slideBarContainerElement, function( index, el ){

                            self.$containerElement[index] = $(el).addClass( 'rb-slidebar-container ' + sliderUID );
                            self.$element[index] = $( '<div>' ).addClass( 'rb-slidebar' ).appendTo( self.$containerElement[index] );
                            self.$progressBarElement[index] = $( '<div>' ).addClass( 'rb-progressbar' ).appendTo( self.$element[index] );
                            self.$sliderContainerElement[index] = $( '<div>' ).addClass( 'rb-slidebar-slider-container' ).appendTo( self.$containerElement[index] );
                            self.$sliderElement[index] = $( '<div>' ).addClass( 'rb-slidebar-slider' ).appendTo( self.$sliderContainerElement[index] );

                            self.sliderContainerElementWidth[index] = self.$sliderContainerElement[index].width();

                            // SET: style
                            self.$sliderContainerElement[index].css({
                                marginTop: -self.$sliderElement[index].outerHeight() / 2
                            });

                            self.$containerElement[index].on( 'touchmove.' + sliderUID, function( e ){
                                drag( e, index );
                            });

                            self.$containerElement[index].on( 'mousedown.' + sliderUID + ' touchstart.' + sliderUID, function( e ){
                                rb.transitions.layers.timeline.pause( 0 );
                                $( 'body' ).prop( 'unselectable', true ).addClass( 'rb-unselectable' );
                                $( document ).on( 'mousemove.' + sliderUID, function( e ){
                                    drag( e, index );
                                });
                                drag( e, index );
                            });

                            $dragStopElements = $dragStopElements.add( self.$sliderElement[index] );
                        });

                        $dragStopElements.on( 'mouseup.' + sliderUID + 'touchend.' + sliderUID, function( e ){
                            if( !$(e.target).closest( $slider ).length ){
                                if( rb.transitions._slideTimeline && rb.transitions.layers.timeline.state.finished && rb.transitions._slideTimeline.progress() !== rb.transitions.layers.timeline.progress ){
                                    // SET: timeline state
                                    rb.functions.setStates( rb.transitions.layers.timeline, {
                                        finished: false
                                    });
                                }
                                stopDrag( e );
                            }
                        });
                    }
                }
            },

            loadingIndicator: {

                init: function(){

                    this.$element = $( '<div>' ).css({
                        display: 'none'
                    }).addClass( 'rb-gui-element rb-loading-container' ).appendTo( $slider );

                    $( '<div>' ).addClass( 'rb-loading-indicator' ).appendTo( this.$element );
                },

                show: function(){

                    this.$element.delay(400).fadeIn(300);
                },

                hide: function(){

                    this.$element.stop(true,true).fadeOut(300);
                }
            }
        };

        rb.navigation = {

            direction: 'next',

            init: function(){

                if( rb.slides.count > 1 ){

                    // SET: Touch navigation
                    this.set.keyboard();

                    // SET: Keyboard navigation
                    this.set.touch();
                }
            },

            set: {

                keyboard: function(){

                    if( rb.o.keybNav ){

                        $( 'body' ).on( 'keydown.' + sliderUID, function( e ){
                            if( !rb.slider.isAnimating && !rb.slider.isPreloading ){
                                if( e.which == 37 ){
                                    rb.navigation.prev();
                                }else if( e.which == 39 ){
                                    rb.navigation.next();
                                }
                            }
                        });
                    }
                },

                touch: function(){

                    if( 'ontouchstart' in window && rb.o.touchNav ){

                        rb.slider.$innerWrapper.on( 'touchstart.' + sliderUID, function( e) {
                            var t = e.touches ? e.touches : e.originalEvent.touches;
                            if( t.length == 1 ){
                                rb.device.touchStartX = rb.device.touchEndX = t[0].clientX;
                            }
                        });

                        rb.slider.$innerWrapper.on( 'touchmove.' + sliderUID, function( e) {
                            var t = e.touches ? e.touches : e.originalEvent.touches;
                            if( t.length == 1 ){
                                rb.device.touchEndX = t[0].clientX;
                            }
                            if( Math.abs( rb.device.touchStartX - rb.device.touchEndX ) > 45 ){
                                e.preventDefault();
                            }
                        });

                        rb.slider.$innerWrapper.on( 'touchend.' + sliderUID, function( e ){
                            if( Math.abs( rb.device.touchStartX - rb.device.touchEndX ) > 45 ){
                                if( rb.device.touchStartX - rb.device.touchEndX > 0 ){
                                    $slider.RbSlider( 'touchNext' );
                                }else{
                                    $slider.RbSlider( 'touchPrev' );
                                }
                            }
                        });
                    }
                }
            },

            prev: function(){

                // IF: slider is NOT popup or visible popup
                if( !rb.slider.isPopup || ( rb.slider.isPopup && rb.slider.state.popupIsVisible ) ){

                    // SET: navigation direction to 'prev'
                    this.direction = 'prev';
                    this.forceDirection = 'prev';

                    rb.slideshow.set.prevNext( 'prev' );
                }
            },

            next: function(){

                // IF: slider is NOT popup or visible popup
                if( !rb.slider.isPopup || ( rb.slider.isPopup && rb.slider.state.popupIsVisible ) ){

                    // SET: navigation direction to 'next'
                    this.direction = 'next';
                    this.forceDirection = 'next';

                    rb.slideshow.set.prevNext( 'next' );
                }
            },

            start: function(){

                // SET: slideshow states
                rb.functions.setStates( rb.slideshow, {
                    running: true,
                    paused: false
                });

                if( rb.slideshow.state.pausedByLastCycle === true ){
                    // SET: slideshow state
                    rb.functions.setStates( rb.slideshow, {
                        pausedByLastCycle: false
                    });
                }

                // SET: gui elements
                rb.gui.navigation.bottom.setStartStop( 'start' );

                if( !rb.slideshow.state.pausedByHover ){
                    // RESUME: playing layers timeline
                    if( rb.transitions._slideTimeline.timeScale() !== 1 ){
                        rb.transitions.layers.timeline.resume();
                    }
                }

                // START: slideshow
                rb.slideshow.start();
            },

            stop: function(){

                // SET: gui elements
                rb.gui.navigation.bottom.setStartStop( 'stop' );

                // PAUSE: layers timeline
                if( rb.o.pauseLayers ){
                    rb.transitions.layers.timeline.pause();
                }

                // STOP: slideshow
                rb.slideshow.stop();
            }
        };

        rb.preload = {

            init: function(){

                // GET: all images inside the slider | image layers and images inside non-image layers
                rb.slider.$hiddenWrapper.find( '.rb-slide img' ).each(function(){

                    var $img = $(this),
                        img = $img[0],
                        attributes = {};

                    // IF: image is a layer or slide background
                    if( $img.is( '.rb-layer, .rb-bg' ) ){

                        if( img.getAttribute( 'width' ) ){
                            attributes.width = img.getAttribute( 'width' );
                        }
                        if( img.getAttribute( 'height' ) ){
                            attributes.height = img.getAttribute( 'height' );
                        }
                        if( img.sizes ){
                            attributes.sizes = img.sizes;
                        }
                        if( img.srcset && rb.o.useSrcset ){
                            attributes.srcSet = img.srcset;
                            attributes.curSrc = img.currentSrc;

                            // GET: largest image width size
                            var widthValues = attributes.srcSet.split( ',').map( function( item ){
                                return parseInt( $.trim( item ).split( ' ' )[1] );
                            });

                            attributes.maxWidth = Math.max.apply( null, widthValues );
                        }

                        // REMOVE: unnecessary attributes from image layers
                        $img.removeAttr( 'width' ).removeAttr( 'height' ).removeAttr( 'sizes' ).removeAttr( 'srcset' );

                        // SAVE: removed attributes to image layer data | needed for detecting original image sizes with srcset
                        if( !$.isEmptyObject( attributes ) ){
                            $img.data( rb.defaults.init.dataKey ).attributes = attributes;
                        }
                    }

                    // Trying to fix / disable lazy-loader scripts
                    if( $img.data( 'lazy-src' ) ){
                        $img.data( 'src', $img.data( 'lazy-src' ) );
                    }

                    // IF: image has no data( 'src' )...
                    if( !$img.data( 'src' ) ){
                        // SET: data( 'src' )
                        $img.data( 'src', attributes.curSrc ? attributes.curSrc : img.src );
                    }else if( attributes.curSrc ){
                        // SET: data( 'src' )
                        $img.data( 'src', attributes.curSrc );
                    }

                    // SET: image src to a base64 blank image
                    $img.attr( 'src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' );
                });
            },

            imagesOfSlide: function( slideIndex, onCompleteCallback ){

                if( rb.slides[slideIndex].wrapped !== true ){

                    this.slideIndex = slideIndex;

                    // IF: no onCompleteCallback exist, we don't need to put the slider in preloading state,
                    // because in this case the slider is just finished a slide transition and it's preloading
                    // the images of the next slide without slide change
                    if( onCompleteCallback ){
                        // SAVE: onComplete function
                        this.onCompleteCallback = onCompleteCallback;
                        // SET: slider state
                        rb.functions.setStates( rb.slider, {
                            preloadingImages: true
                        });
                        // SHOW: loading indicator
                        rb.gui.loadingIndicator.show();

                    }else{
                        this.onCompleteCallback = false;
                    }

                    // Showing slider for the first time
                    if( rb.slider.canShow ){
                        $slider.css({
                            visibility : 'visible'
                        });
                    }

                    // CREATE: variables
                    this.preImages = [];
                    var self = this,
                        $el,
                        el;

                    // GET: all elements from the slide
                    rb.slider.$hiddenWrapper.find('.rb-slide:eq(' + ( self.slideIndex - 1 ) + ') *').each(function(){

                        $el = $(this);
                        el = this;

                        var data = $el.data( rb.defaults.init.dataKey );

                        if( $el.is( 'img' ) ){

                            if( $el.data( 'src' ) ){
                                $el.attr( 'src', $el.data( 'src' ) );
                            }

                            if( data && data.attributes && data.attributes.srcSet && rb.o.useSrcset ){
                                el.srcset = data.attributes.srcSet;
                            }

                            var src = el.src,
                                curSrc = data && data.attributes && data.attributes.curSrc ? data.attributes.curSrc : false;

                            if( curSrc && src !== curSrc && $el.is( '.rb-bg') ){
                                src = curSrc;
                                rb.slides[self.slideIndex].data.$background.attr( 'src', src );
                            }

                            rb.preload.preImages.push( [src, $el] );

                        }else{
                            if( $el.css( 'background-image' ) !== 'none' && $el.css( 'background-image' ).indexOf( 'url' ) !== -1 ){
                                rb.preload.preImages.push( [$el.css( 'background-image' ).match(/url\((.*)\)/)[1].replace(/"/gi, '' ), $el] );
                            }
                        }
                    });

                    if( rb.transitions.firstSlide && rb.o.globalBGImage ){
                        rb.preload.preImages.push( [rb.o.globalBGImage, $()] );
                    }

                    // IF: slide thumbnails are not loaded...
                    if( !this.thumbnailsAreLoaded ){
                        this.thumbnails();
                    }

                    // CALL: start or finished function
                    if(this.preImages.length === 0 ){
                        this.onComplete();
                    }else{
                        this.start();
                    }

                // On slide change | all layers on this slide have already wrapped
                }else if( rb.slider.shouldResize && onCompleteCallback ){

                    // SET: layers to resize
                    rb.resize.setLayers( rb.layers.get( 'next, bg' ) );

                    // RESIZE: layers
                    rb.resize.layers( onCompleteCallback );
                }
            },

            thumbnails: function(){

                var thumbnails = rb.slider.thumbnails.filter(function(item, pos, self) {
                        return self.indexOf(item) == pos;
                    }),
                    length = thumbnails.length;

                for( var t=0; t<length; t++ ){
                    var img = new Image();
                    img.src = thumbnails[t];
                }

                this.thumbnailsAreLoaded = true;
            },

            start: function(){

                this.preloadedImagesCount = 0;

                var self = this,
                    src,
                    checkComplete = function(){

                        // SET: preloadedImagesCount | we must increment the value of preloadedImagesCount even is the image could not be loaded,
                        // because rthe slider should not stop in this case!
                        // IF: all images assigned to the layer has been preloaded
                        if( ++self.preloadedImagesCount == self.preImages.length ){
                            self.onComplete();
                        }
                    },
                    loadEvent = function(){
                        // FIX: image preload
                        this.originalLayer.data( 'preloadedWidth', this.width );
                        this.originalLayer.data( 'preloadedHeight', this.height );

                        checkComplete();
                    },
                    errorEvent = function(){
                        checkComplete();
                    };

                for( var x=0; x<this.preImages.length; x++ ){

                    var img = new Image();

                    img.addEventListener( 'error', errorEvent, false );
                    img.addEventListener( 'load', loadEvent, false );
                    img.src = this.preImages[x][0];
                    img.originalLayer = this.preImages[x][1];
                }
            },

            onComplete: function(){

                var self = this;

                // IF: no onCompleteCallback exist, we don't need to call rb.resize functions,
                // because in this case the slider is just finished a slide transition and it's preloading
                // the images of the next slide without slide change
                if( this.onCompleteCallback ){

                    // START: wrap layers of slide
                    rb.layers.wrap( this.slideIndex );

                    (function waitForWrap(){

                        if( rb.slides[self.slideIndex].$layers.length !== 0 ){
                            rb.timeouts.waitForWrap = setTimeout( waitForWrap, 100 );

                        }else{

                            // REMOVE: from rb.timeouts object
                            delete rb.timeouts.waitForWrap;

                            // SET: parallax state
                            rb.functions.setStates( rb.transitions.layers.parallax, {
                                ready: true
                            });

                            // SHOW: navigation
                            $( '.rb-thumbnail-wrapper, .rb-nav-next, .rb-nav-prev, .rb-bottom-nav-wrapper' ).css({
                                visibility : 'visible'
                            });

                            rb.slides[self.slideIndex].wrapped = true;

                            var youTubeIsReady = !window._RbSlider.globals.youTubeIsReady && rb.layers.get( 'next,in,youtube,bgvideo' ).length ? false : true,
                                vimeoIsReady = !window._RbSlider.globals.vimeoIsReady && rb.layers.get( 'next,in,vimeo,bgvideo' ).length ? false : true,
                                afterJSApisLoaded = function(){

                                    // HIDE: loading indicator
                                    rb.gui.loadingIndicator.hide();

                                    // BUGFIX: IE needs delay due to caching bugs...
                                    //var delay = navigator.userAgent.indexOf( 'Trident/7' ) !== -1 ? 100 : 0;

                                    // rb.timeouts.resizeIE =  setTimeout(function(){
                                    //  // REMOVE: from rb.timeouts object
                                    //  delete rb.timeouts.resizeIE;

                                        if( rb.slider.shouldResize ){

                                            // SET: layers to resize
                                            rb.resize.setLayers( rb.layers.get( 'next, bg' ) );

                                            // RESIZE: layers
                                            rb.resize.layers( self.onCompleteCallback );
                                        }else{

                                            self.onCompleteCallback();
                                        }
                                    // }, delay );
                                };

                            // CHECK: if there are any embedded videos on the next slide which should wait for its own API to load...
                            if( !youTubeIsReady || !vimeoIsReady ){

                                rb.intervals.waitForJSApisLoaded = setInterval( function(){

                                    if( ( youTubeIsReady || window._RbSlider.globals.youTubeIsReady ) && ( vimeoIsReady || window._RbSlider.globals.vimeoIsReady ) ){

                                        clearInterval( rb.intervals.waitForJSApisLoaded );
                                        delete rb.intervals.waitForJSApisLoaded;

                                        afterJSApisLoaded();
                                    }
                                }, 50 );
                            }else{
                                afterJSApisLoaded();
                            }
                        }
                    })();
                }else{
                    // START: lazy wrap layers of slide
                    rb.layers.wrap( this.slideIndex, true );
                }

                // SET: slider state
                rb.functions.setStates( rb.slider, {
                    preloadingImages: false
                });
            }
        };

        rb.resize = {

            setLayers: function( layers ){

                this.$responsiveLayers = layers.add( rb.layers.get( 'active') );
                if( rb.slides.next.data.$backgroundVideo.length ){
                    this.$responsiveLayers = this.$responsiveLayers.add( rb.slides.next.data.$backgroundVideo );
                }
            },

            all: function(){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                // API CALL: sliderWillResize
                if( rb.api.hasEvent( 'sliderWillResize' ) ){
                    $slider.triggerHandler( 'sliderWillResize', rb.api.eventData() );
                }

                // SET: slider
                this.slider();

                // SET: navigation
                this.navigation();

                // SET: layers
                this.layers();

                // SET: wrappers | called from this.layers()
                // this.wrappers();

                // SET: yourLogo
                this.yourLogo();

                //SET: shadow
                this.shadow();

                //SET: timers
                this.timers();

                // IF: slide timeline should restart...
                if( rb.transitions.layers.timeline.shouldRestart && rb.o.allowRestartOnResize ){
                    // RESET & RESTART: slide timeline
                    rb.functions.resetSlideTimelines();
                    rb.transitions.layers.timeline.create( true );
                }

                // RESET & RESTART: slide timeline
                // if( rb.transitions._slideTimeline ){
                //  rb.transitions.layers.timeline.create( true );
                // }

                // API CALL: sliderDidResize
                if( rb.api.hasEvent( 'sliderDidResize' ) ){
                    $slider.triggerHandler( 'sliderDidResize', rb.api.eventData() );
                }
            },

            viewport: function(){

                // SET: slider into the middle of the viewport
                $( window ).scrollTop( Math.round( rb.slider.offsetTop ) - ( rb.device.viewportHeight - rb.slider.height ) / 2 );
            },

            slider: function(){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                var $parent = rb.slider.$parentWithNumericWidthValue ? rb.slider.$parentWithNumericWidthValue : rb.functions.getSliderClosestParentElementWidthNumericValueOfProperty( 'width' ),
                    i = rb.slider.initial,
                    sliderWidth = rb.slider.$parentWithNumericWidthValuePercent ? $parent.width() / 100 * rb.slider.$parentWithNumericWidthValuePercent : $parent.width(),
                    sliderHeight,
                    sliderType = i.type,
                    sliderRatio,
                    curMaxWidth = i.maxWidth !== 0 ? i.maxWidth : sliderWidth,
                    marginLeft = i.marginLeft === 'auto' ? 0 : i.marginLeft,
                    marginRight = i.marginRight === 'auto' ? 0 : i.marginRight;

                if( rb.slider.state.inFullscreen ){
                    $slider[0].style.maxWidth = '';
                }else if( i.maxWidth !== 0 ){
                    $slider[0].style.maxWidth = i.maxWidth + 'px';
                }

                // CHECK: if maxWidth has a percentage value
                if( curMaxWidth.indexOf('%') !== -1 ){
                    // SET: current maxWidth
                    curMaxWidth = sliderWidth / 100 * parseInt( curMaxWidth );
                }

                // SET: sliderWidth with margins
                sliderWidth -= ( marginLeft + marginRight );

                // SET: sliderWidth regarding to maxWidth
                if( sliderWidth > curMaxWidth && curMaxWidth >= 0 ){
                    sliderWidth = curMaxWidth;
                }

                // SET: sliderWidth if fitScreenWidth is enabled in fullwidth / fullsize modes
                if( rb.o.fitScreenWidth && ( sliderType === 'fullwidth' || ( sliderType === 'fullsize' && rb.o.fullSizeMode !== 'fitheight' && rb.o.fullSizeMode !== 'fitwidth' ) ) ){
                    var $sParent = $slider.parent(),
                        oLeft = $parent.offset().left,
                        pLeft = parseInt( $parent.css( 'padding-left' ) ) || 0,
                        bLeft = parseInt( $parent.css( 'border-left-width' ) ) || 0;

                    $slider[0].style.maxWidth = 'none';
                    $slider[0].style.marginLeft = -( oLeft + pLeft + bLeft ) + 'px';
                    sliderWidth = rb.device.viewportWidth || $( window ).width();
                }

                // SET: sliderWidth with skins
                sliderWidth -= i.skinWidth;

                // SET: sliderWidth in fullscreen mode
                if( rb.slider.state.inFullscreen ){
                    sliderWidth = rb.device.width;
                }

                // SET: minimum slider width to 100
                // if( sliderWidth < 100 ){
                //  sliderWidth = 100;
                // }

                switch( sliderType ){

                    case 'responsive':
                        if( rb.slider.state.inFullscreen ){
                            if( rb.device.ratio > i.ratio ){
                                this.ratio = rb.device.height / i.height;
                            }else{
                                this.ratio = rb.device.width / i.width;
                            }
                            sliderWidth = Math.round( i.width * this.ratio );
                            sliderHeight = Math.round( i.height * this.ratio );
                        }else{
                            this.ratio = sliderWidth / i.width;
                            sliderHeight = Math.round( i.height * this.ratio );
                        }
                    break;

                    case 'fullwidth':
                        if( sliderWidth < rb.o.responsiveUnder ){
                            this.ratio = sliderWidth / rb.o.responsiveUnder;
                            sliderHeight = Math.round( i.height * this.ratio );
                        }else{
                            if( rb.slider.state.inFullscreen ){
                                if( rb.device.ratio > i.layersWidth / i.height ){
                                    this.ratio = rb.device.height / i.height;
                                    sliderHeight = rb.device.height;
                                }else{
                                    this.ratio = rb.device.width / i.layersWidth;
                                    sliderHeight = i.height * this.ratio;
                                }
                            }else{
                                this.ratio = 1;
                                sliderHeight = i.height;
                            }
                        }
                    break;

                    case 'fullsize':
                        switch( rb.o.fullSizeMode.toLowerCase() ){
                            case 'normal':
                                sliderHeight = rb.device.viewportHeight - i.skinHeight;
                            break;
                            case 'hero':
                                sliderHeight = rb.device.viewportHeight - i.skinHeight;
                                if( !rb.slider.state.inFullscreen ){
                                    sliderHeight -= rb.slider.heroTop ? rb.slider.heroTop : rb.slider.offsetTop;
                                }
                            break;
                            case 'fitheight':
                                sliderWidth = $slider.parent().width() - i.skinWidth;
                                sliderHeight = $slider.parent().height() - i.skinHeight;
                            break;
                            case 'fitwidth':
                                sliderWidth = $slider.parent().width() - i.skinWidth;
                                sliderHeight = rb.device.viewportHeight - i.skinHeight;
                            break;
                        }
                        sliderRatio = sliderWidth / sliderHeight;
                        if( sliderRatio < i.ratio ){
                            this.ratio = sliderWidth / i.layersWidth;
                        }else{
                            this.ratio = sliderHeight / i.layersHeight;
                        }
                    break;

                    case 'fixed':
                    case 'fixedsize':
                        this.ratio = 1;
                        sliderWidth = i.width;
                        sliderHeight = i.height;
                        rb.o.maxRatio = 1;
                        slider.style.maxWidth = 'none';
                    break;
                }

                // SET maxRatio
                this.ratio = rb.o.maxRatio && rb.o.maxRatio > 0 && this.ratio > rb.o.maxRatio ? rb.o.maxRatio : this.ratio;

                // SET: slider style
                slider.style.width = sliderWidth + 'px';
                slider.style.height = sliderHeight + 'px';

                // SET: slider dimensions and offsets as global variables for performance
                rb.slider.width = sliderWidth;
                rb.slider.height = sliderHeight;

                var sliderOffset = $slider.offset();
                rb.slider.offsetX = sliderOffset.left;
                rb.slider.offsetY = sliderOffset.top;

                // SET: slider class name by mobile device
                if( rb.device.isMobile ){

                    if( rb.device.viewportWidth < 1025 && rb.device.viewportWidth > 767 ){
                        $slider.removeClass( 'rb-device-is-phone').addClass( 'rb-device-is-tablet' );
                    }else if( rb.device.viewportWidth < 768 ){
                        $slider.removeClass( 'rb-device-is-tablet').addClass( 'rb-device-is-phone' );
                    }
                }else{
                    $slider.removeClass( 'rb-device-is-phone rb-device-is-tablet' ).addClass( 'rb-device-is-desktop' );
                }
            },

            borderRadius: function( borderRadius ){

                var bR = ( '' + borderRadius ).split( ' ' ),
                    responsiveBorderRadius = '',
                    ratio = rb.o.maxRatio && rb.o.maxRatio > 0 && this.ratio > rb.o.maxRatio ? rb.o.maxRatio : this.ratio;

                for( var b=0, len=bR.length; b<len; b++ ){

                    if( bR[b].indexOf( '%') === -1 ){
                        responsiveBorderRadius += Math.ceil( parseInt( bR[b] ) * ratio ) + 'px ';
                    }else{
                        responsiveBorderRadius += bR[b] + ' ';
                    }
                }

                return $.trim( responsiveBorderRadius );
            },

            layers: function( onCompleteCallback ){

                if( this.$responsiveLayers ){

                    var self = this,
                        ratio = this.ratio,
                        $responsiveLayers = this.$responsiveLayers,
                        i = rb.slider.initial,
                        sliderWidth = rb.slider.width,
                        sliderHeight = rb.slider.height,
                        sliderRatio = sliderWidth / sliderHeight,
                        rStyle = [], rWStyle = [], rlWStyle = [], rSStyle = [],
                        cLeft = 0, cTop = 0,
                        cW = i.type === 'responsive' && rb.o.maxRatio !== -1 ? i.width : i.layersWidth,
                        cH = i.type === 'responsive' && rb.o.maxRatio !== -1 ? i.height : i.layersHeight;

                    // SET: left and top starting points regarding to layersContainer size
                    if( i.type === 'fullsize' || i.type === 'fullwidth' || i.type === 'responsive' ){
                        cLeft = cW > 0 ? ( sliderWidth - cW * ratio ) / 2 : 0;
                        cTop = cH > 0 ? ( sliderHeight - cH * ratio ) / 2 : 0;
                    }else{
                        cLeft = cLeft < 0 ? 0 : cLeft;
                        cTop = cTop < 0 ? 0 : cTop;
                    }

                    for( var set=0, len=$responsiveLayers.length; set<len; set++ ){

                        var $layer = $($responsiveLayers[set]),
                            layer = $responsiveLayers[set],
                            layerData = $layer.data( rb.defaults.init.dataKey ),
                            o = layerData.original,
                            bgSize, bgPos,
                            fontRatio,
                            layerIsFixed = layerData.settings.position === 'fixed' ? true : false,
                            posLeft = layerIsFixed ? 0 : cLeft,
                            posTop = layerIsFixed ? 0 : cTop,
                            r = {
                                width: layerIsFixed && o.percentWidth !== 0 ? sliderWidth / 100 * o.percentWidth : o.width * ratio,
                                height: layerIsFixed && o.percentHeight !== 0 ? sliderHeight / 100 * o.percentHeight : o.height * ratio,
                                paddingLeft: o.paddingLeft * ratio,
                                paddingTop: o.paddingTop * ratio,
                                paddingRight: o.paddingRight * ratio,
                                paddingBottom: o.paddingBottom * ratio,
                                borderLeftWidth: Math.ceil( o.borderLeftWidth * ratio ),
                                borderTopWidth: Math.ceil( o.borderTopWidth * ratio ),
                                borderRightWidth: Math.ceil( o.borderRightWidth * ratio ),
                                borderBottomWidth: Math.ceil( o.borderBottomWidth * ratio ),
                                borderRadius: this.borderRadius( o.borderRadius )
                            },
                            rW = {
                                marginLeft: o.marginLeft * ratio,
                                marginTop: o.marginTop * ratio
                            },
                            rlW = {},
                            rS = {
                                borderRadius: r.borderRadius
                            };

                        // FIX: sizes in special cases | original width or height has percentage value and the other property is auto
                        if( layerIsFixed && ( o.percentHeight || o.percentWidth ) && layerData.is.imageLayer ){
                            if( o.percentHeight && !o.percentWidth ){
                                r.width = o.width * ( r.height / o.height );
                            }
                            if( o.percentWidth && !o.percentHeight ){
                                r.height = o.height * ( r.width / o.width );
                            }
                        }

                        // IF: layer is not image, fontSize and lineHeight should be also added
                        if( layerData.is.textLayer ){

                            // SET: font-size
                            r.fontSize = o.fontSize * ratio;

                            if( rb.device.isMobile && r.fontSize < layerData.styleSettings.minmobilefontsize ){
                                r.fontSize = layerData.styleSettings.minmobilefontsize;
                            }else if( r.fontSize < layerData.styleSettings.minfontsize ){
                                r.fontSize = layerData.styleSettings.minfontsize;
                            }

                            fontRatio = r.fontSize / o.fontSize;

                            r.fontSize += 'px';

                            // SET: line-height & letter-spacing | should multiply with fontRatio which is could be different from ratio
                            if( o.lineHeight !== 'normal' ){
                                r.lineHeight = parseFloat( o.lineHeight ) * fontRatio + 'px';
                            }

                            if( o.letterSpacing !== 'normal' ){
                                r.letterSpacing = parseFloat( o.letterSpacing ) * fontRatio + 'px';
                            }
                        }

                        // If it is not a slide background image layer
                        if( !layerData.is.slideBackground && !layerData.is.backgroundVideo ){

                            // Media elements with cover / contain fillmodes
                            if( layerData.mediaSettings.fullsize ){
                                    switch( layerData.mediaSettings.fillmode ){
                                        default:
                                        case 'cover':
                                            if( o.ratio < sliderRatio ){
                                                r.width = sliderWidth;
                                                r.height = r.width / o.ratio;
                                            }else{
                                                r.height = sliderHeight;
                                                r.width = r.height * o.ratio;
                                            }
                                        break;
                                        case 'contain':
                                            if( o.ratio > sliderRatio ){
                                                r.width = sliderWidth;
                                                r.height = r.width / o.ratio;
                                            }else{
                                                r.height = sliderHeight;
                                                r.width = r.height * o.ratio;
                                            }
                                        break;
                                    }
                            }

                            // SAVE: outerWidth & outerHeight
                            r.outerWidth = r.width + r.paddingLeft + r.paddingRight + r.borderLeftWidth + r.borderRightWidth;
                            r.outerHeight = r.height + r.paddingTop + r.paddingBottom + r.borderTopWidth + r.borderBottomWidth;

                            // SET: wrapper dimensions to layer's outer dimensions
                            rW.width = rlW.width = r.outerWidth;
                            rW.height = rlW.height = r.outerHeight;

                            // Layers with percentage values of left / top will be positioned from ( 0, 0 ) coordinates
                            // while layers with pixel values will be positioned from ( cLeft, cTop ) coordinates
                            if( o.left.indexOf('%') != -1 ){
                                if( o.left === '100%' ){
                                    if( posLeft === 0 ){
                                        // position to right fixed percentage
                                        r.left = rb.slider.width / 100 * parseFloat( o.left ) - r.outerWidth;
                                    }else{
                                        // position to right relative percentage
                                        r.left = posLeft + cW * ratio / 100 * parseFloat( o.left ) - r.outerWidth;
                                    }
                                }else if( o.left === '0%' ){
                                    if( posLeft === 0 ){
                                        // position to left fixed percentage
                                        r.left = 0;
                                    }else{
                                        // position to left relative percentage
                                        r.left = posLeft;
                                    }
                                }else{
                                    if( posLeft === 0 ){
                                        // fixed percentage
                                        r.left = rb.slider.width / 100 * parseFloat( o.left ) - r.outerWidth / 2;
                                    }else{
                                        // relative percentage
                                        r.left = posLeft + cW * ratio / 100 * parseFloat( o.left ) - r.outerWidth / 2;
                                    }
                                }
                            }else{
                                // fixed / relative pixels
                                r.left = posLeft + parseFloat( o.left ) * ratio;
                            }

                            rW.left = r.left;

                            if( o.top.indexOf('%') != -1 ){
                                if( o.top === '100%' ){
                                    if( posTop === 0 ){
                                        // position to bottom fixed percentage
                                        r.top = rb.slider.height / 100 * parseFloat( o.top ) - r.outerHeight;
                                    }else{
                                        // position to bottom relative percentage
                                        r.top = posTop + cH * ratio / 100 * parseFloat( o.top ) - r.outerHeight;
                                    }
                                }else if( o.top === '0%' ){
                                    if( posTop === 0 ){
                                        // position to top fixed percentage
                                        r.top = 0;
                                    }else{
                                        // position to top relative percentage
                                        r.top = posTop + 0;
                                    }
                                }else{
                                    if( posTop === 0 ){
                                        // fixed percentage
                                        r.top = rb.slider.height / 100 * parseFloat( o.top ) - r.outerHeight / 2;
                                    }else{
                                        // relative percentage
                                        r.top = posTop + cH * ratio / 100 * parseFloat( o.top ) - r.outerHeight / 2;
                                    }
                                }
                            }else{
                                // fixed / relative pixels
                                r.top = posTop + parseFloat( o.top ) * ratio;
                            }

                            rW.top = r.top;

                        }else if( layerData.is.slideBackground ){

                            // SET: slide background size
                            var slideBGSize = rb.slides[ layerData.is.onSlide ].data.backgroundSize;
                            bgSize = typeof slideBGSize !== 'undefined' && slideBGSize !== 'inherit' ? slideBGSize : rb.o.slideBGSize;

                            bgSize = bgSize.replace( '100% 100%', 'stretch' );

                            switch( bgSize ){

                                case 'auto':
                                break;

                                case 'cover':
                                    if( o.ratio < sliderRatio ){
                                        r.width = sliderWidth;
                                        r.height = r.width / o.ratio;
                                    }else{
                                        r.height = sliderHeight;
                                        r.width = r.height * o.ratio;
                                    }

                                break;

                                case 'contain':
                                    if( o.ratio < sliderRatio ){
                                        r.height = sliderHeight;
                                        r.width = r.height * o.ratio;
                                    }else{
                                        r.width = sliderWidth;
                                        r.height = r.width / o.ratio;
                                    }
                                break;

                                case 'stretch':
                                    r.width = sliderWidth;
                                    r.height = sliderHeight;
                                break;

                                default:
                                break;
                            }

                            r.width = Math.round( r.width );
                            r.height = Math.round( r.height );

                            // SET: slide background position
                            var bgPosSlide = rb.slides[ layerData.is.onSlide ].data.backgroundPosition;
                            bgPos = typeof bgPosSlide !== 'undefined' ? bgPosSlide.split(' ') : rb.o.slideBGPosition.split(' ');

                            switch( bgPos[0] ){

                                case 'left':
                                    r.x = 0;
                                break;

                                case 'center':
                                    r.x = ( rb.slider.width - r.width ) / 2;
                                break;

                                case 'right':
                                    r.x = rb.slider.width - r.width;
                                break;

                                default:
                                    if( bgPos[0].indexOf('%') !== -1 ){
                                        r.x = ( rb.slider.width - r.width ) / 100 * parseInt( bgPos[0] );
                                    }else{
                                        r.x = parseInt( bgPos[0]    );
                                    }
                                break;
                            }

                            if( typeof bgPos[1] !== 'undefined' ){
                                switch( bgPos[1] ){

                                    case 'top':
                                        r.y = 0;
                                    break;

                                    case 'center':
                                        r.y = ( rb.slider.height - r.height ) / 2;
                                    break;

                                    case 'bottom':
                                        r.y = rb.slider.height - r.height;
                                    break;

                                    default:
                                        if( bgPos[1].indexOf('%') !== -1 ){
                                            r.y = ( rb.slider.height - r.height ) / 100 * parseInt( bgPos[1] );
                                        }else{
                                            r.y = parseInt( bgPos[1]    );
                                        }
                                    break;
                                }
                            }

                            // UPDATE: properties
                            r['transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';
                            r['-ms-transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';
                            r['-webkit-transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';

                        }else if( layerData.is.backgroundVideo ){

                            if( o.ratio < sliderRatio ){
                                r.width = sliderWidth;
                                r.height = r.width / o.ratio;
                            }else{
                                r.height = sliderHeight;
                                r.width = r.height * o.ratio;
                            }

                            r.x = ( rb.slider.width - r.width ) / 2;
                            r.y = ( rb.slider.height - r.height ) / 2;
                            r.width = Math.round( r.width );
                            r.height = Math.round( r.height );

                            // UPDATE: properties
                            r['transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';
                            r['-ms-transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';
                            r['-webkit-transform'] = 'translateX(' + r.x + 'px) translateY(' + r.y + 'px)';
                        }

                        layerData.responsive = r;
                        rStyle[set] = r;

                        if( !layerData.is.slideBackground && !layerData.is.backgroundVideo ){
                            layerData.settings.wrapperData.responsive = rW;
                            rWStyle[set] = rW;
                            rlWStyle[set] = rlW;
                            rSStyle[set] = rS;
                        }
                    }

                    // APPLY: responsive properties
                    for( var put=0, _len=rStyle.length; put<_len; put++ ){

                        var $_layer = $( $responsiveLayers[put] ),
                            _layerData = $_layer.data( rb.defaults.init.dataKey);

                        // APPLY: responsive style properties on layer and split items
                        $_layer.css( rStyle[put] );

                        // APPLE: responsive properties on nodes and wrappers
                        if( !_layerData.is.slideBackground && !_layerData.is.backgroundVideo ){
                            $_layer.find( '.split-item' ).css( rSStyle[put] );
                            self.wrappers( $_layer, _layerData, rWStyle[put], rlWStyle[put] );
                        }else if( _layerData.is.slideBackground || _layerData.is.backgroundVideo ){
                            _layerData.elements.$bgOuterWrapper.css({
                                width: rb.slider.width,
                                height: rb.slider.height
                            });
                            _layerData.elements.$outerWrapper.css({
                                width: rb.slider.width,
                                height: rb.slider.height
                            });
                        }
                    }

                    // RUN: callback is exist
                    if( typeof onCompleteCallback != 'undefined' ){
                        onCompleteCallback();
                    }

                }
            },

            wrappers: function( $layer, layerData, wrapperStyle, loopWrapperStyle ){

                if( wrapperStyle){
                    layerData.elements.$wrapper.css( wrapperStyle );
                }

                if( loopWrapperStyle && layerData.loop.enabled ){
                    layerData.elements.$loopWrapper.css( loopWrapperStyle );
                }

                // SET: transformPerspective
                gsap.TweenMax.set( layerData.elements.$wrapper[0], { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.layer * rb.resize.ratio } } );

                if( layerData.loop.enabled ){
                    gsap.TweenMax.set( layerData.elements.$loopWrapper[0], { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.loop * rb.resize.ratio } } );
                }
                if( layerData.hover.enabled ){
                    gsap.TweenMax.set( $layer[0], { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.hover * rb.resize.ratio } } );
                }
                if( layerData.textIn.nodes ){
                    gsap.TweenMax.set( layerData.textIn.nodes, { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.text * rb.resize.ratio } } );
                }
                if( layerData.textOut.nodes ){
                    gsap.TweenMax.set( layerData.textOut.nodes, { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.text * rb.resize.ratio } } );
                }
                if( layerData.parallax.enabled ){
                    gsap.TweenMax.set( layerData.elements.$parallaxWrapper[0], { autoCSS: false, css: { transformPerspective: layerData.transformPerspective.parallax * rb.resize.ratio } } );
                }
            },

            transformProperties: function( $layer, m, o, mT ){

                // m = modified object
                // o = original object
                // mT = modofied object for transformOrigin

                // SET: x & y
                if( typeof o.x === 'object' ){
                    var mx = [];
                    for( var ox = 0; ox < o.x.length; ox++ ){
                        if( typeof o.x[ox] === 'string' ){
                            mx[ox] = this.getXY( $layer, o.x[ox], 'Width' );
                        }else{
                            mx[ox] = o.x[ox] * rb.resize.ratio;
                        }
                    }
                    // SAVE: property into cycle object for text transitions
                    m.cycle.x = mx;
                }else if( typeof o.x === 'string' ){
                    m.x = this.getXY( $layer, o.x, 'Width' );
                }else if( typeof o.x !== 'undefined' ){
                    m.x = o.x * rb.resize.ratio;
                }

                if( typeof o.y === 'object' ){
                    var my = [];
                    for( var oy = 0; oy < o.y.length; oy++ ){
                        if( typeof o.y[oy] === 'string' ){
                            my[oy] = this.getXY( $layer, o.y[oy], 'Height' );
                        }else{
                            my[oy] = o.y[oy] * rb.resize.ratio;
                        }
                    }
                    // SAVE: property into cycle object for text transitions
                    m.cycle.y = my;
                }else if( typeof o.y === 'string' ){
                    m.y = this.getXY( $layer, o.y, 'Height' );
                }else if( typeof o.y !== 'undefined' ){
                    m.y = o.y * rb.resize.ratio;
                }

                // IF: modified object added, transformorigin must be saved into there
                if( mT ){ m = mT; }

                if( typeof o.transformOrigin === 'object' ){
                    var mt = [];
                    for( var ot = 0; ot < o.transformOrigin.length; ot++ ){
                        mt[ot] = rb.functions.convert.transformOrigin( o.transformOrigin[ot], $layer );
                    }
                    m.cycle.transformOrigin = mt;
                }else if( typeof o.transformOrigin === 'string' ){
                    m.transformOrigin = rb.functions.convert.transformOrigin( o.transformOrigin, $layer );
                }
            },

            styleProperties: function( m, o ){

                if( typeof o.width !== 'undefined' ){
                    if( $.isNumeric( o.width ) ){
                        m.width = parseInt( o.width ) * rb.resize.ratio;
                    }else if( typeof o.width === 'string' && o.width.indexOf( '%') !== -1 ){
                        m.width = rb.slider.width / 100 * parseInt( o.width );
                    }
                }

                if( typeof o.height !== 'undefined' ){
                    if( $.isNumeric( o.height ) ){
                        m.height = parseInt( o.height ) * rb.resize.ratio;
                    }else if( typeof o.height === 'string' && o.height.indexOf( '%') !== -1 ){
                        m.height = rb.slider.height / 100 * parseInt( o.height );
                    }
                }

                if( o.borderRadius ){
                    m.borderRadius = rb.resize.borderRadius( o.borderRadius );
                }
            },

            clip: function( $layer, clip, shouldBeConverted ){

                clip = $.trim( clip.replace( 'rect(', '' ).replace( ')', '' ) );

                var r = $layer.data( rb.defaults.init.dataKey ).responsive,
                    w = Math.ceil( r.outerWidth ),
                    h = Math.ceil( r.outerHeight ),
                    cl = clip.indexOf( ',' ) === -1 ? clip.split( ' ' ) : clip.split( ',' ),
                    CL = '',
                    rClip;

                for( var c=0; c < cl.length; c++ ){
                    if( cl[c].indexOf( '%') !== -1 ){
                        switch( c ){
                            case 0:
                                CL += parseInt( h / 100 * parseInt( cl[c] ) * 100 ) / 100 + 'px ';
                            break;
                            case 1:
                                if( shouldBeConverted ){
                                    CL += parseInt( ( w - w / 100 * parseInt( cl[c] ) ) * 100 ) / 100 + 'px ';
                                }else{
                                    CL += parseInt( w / 100 * parseInt( cl[c] ) * 100 ) / 100 + 'px ';
                                }
                            break;
                            case 2:
                                if( shouldBeConverted ){
                                    CL += parseInt( ( h - h / 100 * parseInt( cl[c] ) ) * 100 ) / 100 + 'px ';
                                }else{
                                    CL += parseInt( h / 100 * parseInt( cl[c] ) * 100 ) / 100 + 'px ';
                                }
                            break;
                            case 3:
                                CL += parseInt( w / 100 * parseInt( cl[c] ) * 100 ) / 100 + 'px';
                            break;
                        }
                    }else{

                        rClip = parseInt( cl[c] ) * rb.resize.ratio;

                        switch( c ){
                            case 0:
                                CL += rClip + 'px ';
                            break;
                            case 1:
                                if( shouldBeConverted ){
                                    CL += w - rClip + ' ';
                                }else{
                                    CL += rClip + 'px ';
                                }
                            break;
                            case 2:
                                if( shouldBeConverted ){
                                    CL += h - rClip + 'px ';
                                }else{
                                    CL += rClip + 'px ';
                                }
                            break;
                            case 3:
                                CL += rClip + 'px';
                            break;
                        }
                    }
                }

                return 'rect(' + CL + ')';
            },

            getXY: function( $layer, value, dimension ){

                var valueInPixels = 0,
                    layerData = $layer.data( rb.defaults.init.dataKey ),
                    original = layerData.original,
                    responsive = layerData.responsive,
                    responsiveWrapper = layerData.settings.wrapperData.responsive;

                // FIX: must be checked because of some browsers timing issues
                if( original && responsive && responsiveWrapper ){

                    switch( value ){
                        case 'left':
                            if( original.left.indexOf('%') != -1 ){
                                if( original.left === '100%' ){
                                    valueInPixels = -responsive.left - responsive.outerWidth - responsiveWrapper.marginLeft;
                                }else{
                                    valueInPixels = -parseInt( original.left ) / 100 * rb.slider.width - responsive.outerWidth / 2 - responsiveWrapper.marginLeft;
                                }
                            }else{
                                valueInPixels = -responsive.left - responsive.outerWidth - responsiveWrapper.marginLeft;
                            }
                        break;
                        case 'right':
                            if( original.left.indexOf('%') != -1 ){
                                if( original.left === '100%' ){
                                    valueInPixels = rb.slider.width - responsive.left - responsiveWrapper.marginLeft;
                                }else{
                                    valueInPixels = ( 1 - parseInt( original.left ) / 100 ) * rb.slider.width + responsive.outerWidth / 2 - responsiveWrapper.marginLeft;
                                }
                            }else{
                                valueInPixels = rb.slider.width - responsive.left - responsiveWrapper.marginLeft;
                            }
                        break;
                        case 'top':
                            if( original.top.indexOf('%') != -1 ){
                                if( original.top === '100%' ){
                                    valueInPixels = -responsive.top - responsive.outerHeight - responsiveWrapper.marginTop;
                                }else{
                                    valueInPixels = -parseInt( original.top ) / 100 * rb.slider.height - responsive.outerHeight / 2 - responsiveWrapper.marginTop;
                                }
                            }else{
                                valueInPixels = -responsive.top - responsive.outerHeight - responsiveWrapper.marginTop;
                            }
                        break;
                        case 'bottom':
                            if( original.top.indexOf('%') != -1 ){
                                if( original.top === '100%' ){
                                    valueInPixels = rb.slider.height - responsive.top - responsiveWrapper.marginTop;
                                }else{
                                    valueInPixels = ( 1 - parseInt( original.top ) / 100 ) * rb.slider.height + responsive.outerHeight / 2 - responsiveWrapper.marginTop;
                                }
                            }else{
                                valueInPixels = rb.slider.height - responsive.top - responsiveWrapper.marginTop;
                            }
                        break;
                        case 'width':
                            valueInPixels = responsive.outerWidth;
                        break;
                        case '-width':
                            valueInPixels = -responsive.outerWidth;
                        break;
                        case 'height':
                            valueInPixels = responsive.outerHeight;
                        break;
                        case '-height':
                            valueInPixels = -responsive.outerHeight;
                        break;
                        default:
                            if( value.indexOf('%') !== -1 ){
                                valueInPixels = responsive[ 'outer' + dimension ] / 100 * parseInt( value );
                            }else if( value.indexOf( 'sw' ) !== -1 ){
                                valueInPixels = parseInt( value.split( 'sw' )[0] ) / 100 * rb.slider.width;
                            }else if( value.indexOf( 'sh' ) !== -1 ){
                                valueInPixels = parseInt( value.split( 'lw' )[0] ) / 100 * rb.slider.height;
                            }else if( value.indexOf( 'lw' ) !== -1 ){
                                valueInPixels = responsive.outerWidth / 100 * parseInt( value.split( 'lw' )[0] );
                            }else if( value.indexOf( 'lh' ) !== -1 ){
                                valueInPixels = responsive.outerHeight / 100 * parseInt( value.split( 'lj' )[0] );
                            }else{
                                valueInPixels = parseInt( value ) * rb.resize.ratio;
                            }
                        break;
                    }
                }
                return valueInPixels;
            },

            navigation: function(){

                if( rb.o.thumbnailNavigation == 'always' ){
                    rb.gui.navigation.bottom.thumbnairb.resize();
                }
            },

            shadow: function(){

                if( rb.gui.shadow.show ){
                    rb.gui.shadow.show();
                }

                if( rb.gui.shadow.$element ){
                    rb.gui.shadow.resize();
                }
            },

            yourLogo: function(){

                if( rb.yourLogo.$element ){
                    rb.yourLogo.resize();
                }
            },

            timers: function(){
                if( rb.gui.timers.slidebar.$containerElement.length > 0 ){
                    for( var index=0, length=rb.gui.timers.slidebar.$containerElement.length; index<length; index++ ){
                        rb.gui.timers.slidebar.containerElementWidth[index] = rb.gui.timers.slidebar.$containerElement[index].width();
                        rb.gui.timers.slidebar.elementWidth[index] = rb.gui.timers.slidebar.$element[index].width();
                    }
                }
            }
        };

        rb.transitions = {

            firstSlide: true,

            start: function(){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                // SAVE: scroll direction
                rb.device.scroll.directionAtSlideTransitionStart = rb.device.scroll.direction;

                // SET: thumbnails
                if( rb.o.thumbnailNavigation == 'always' ){

                    // CHANGE: thumbnail
                    rb.gui.navigation.bottom.thumbnails.change();

                    // SCROLL: thumbnails if needed
                    if( !( 'ontouchstart' in window) ){
                        rb.gui.navigation.bottom.thumbnails.scroll();
                    }
                }

                // START: layers transition out (forced)
                this.layers.out.forced();

                // INIT: slide transition
                this.slide.init();
            },

            slide: {

                $wrapper: $(),

                init: function(){

                    var curGS,
                        curSlideBGData;

                    // SET: slider state
                    rb.functions.setStates( rb.slider, {
                        animatingSlides: true
                    });

                    // RESET: parallax layers
                    rb.transitions.layers.parallax.reset();

                    // DISABLE: parallax effect on layers of current slide
                    rb.slider.$layersWrapper.children( '.rb-parallax[data-rb-parallax="active"]').each(function(){
                        if( $( this ).find( '.rb-layer' ).data( rb.defaults.init.dataKey ).settings.slideOut === rb.slides.current.index ){
                            $( this ).attr( 'data-rb-parallax', 'disbaled' );
                        }
                    });

                    // SAVE: current and next slide indexes into temporary variables | required for doing extra long slide transitions while time-shifting layers, etc.
                    rb.transitions.curSlide = rb.slides.current;
                    rb.transitions.nextSlide = rb.slides.next;

                    // CREATE: slideTransition timeline
                    rb.transitions._slideTransition = new gsap.TimelineMax({
                        paused: true,
                        onComplete: function(){ rb.transitions.slide.onComplete(); }
                    });

                    // IF: this is the first slide
                    if( rb.transitions.firstSlide ){

                        // IF: the first slide has slide background image...
                        if( typeof rb.transitions.nextSlide.data.$background != 'undefined' ){

                            var bgData = rb.transitions.nextSlide.data.$background.data( rb.defaults.init.dataKey ),
                                kbScale = bgData.kenBurns.zoom ? bgData.kenBurns.from.scale : 1,
                                kbRotation = bgData.kenBurns.zoom ? bgData.kenBurns.from.rotation : 0,
                                filterFrom = rb.transitions.nextSlide.filter.from || 'none';

                            // SET: filter on first slide background
                            rb.transitions._slideTransition.set( rb.transitions.nextSlide.data.$background[0], {
                                '-webkit-filter': filterFrom,
                                filter: filterFrom
                            }, 0 );

                            // SET: slide transition timeline to fade in first background image
                            rb.transitions._slideTransition.fromTo( rb.transitions.nextSlide.data.$background.closest('.rb-bg-wrap')[0], rb.o.sliderFadeInDuration,
                                {
                                    autoCSS: false,
                                    css: {
                                        scale: kbScale,
                                        rotation: kbRotation,
                                        opacity: 0,
                                        display: 'block'
                                    }
                                },
                                {
                                    autoCSS: false,
                                    css: {
                                        opacity: 1
                                    }
                                }, 0 );
                        }

                        // RUN: callback
                        this.start( true );
                    }else if( typeof RbSliderTransitions === 'undefined' && typeof RbSliderCustomTransitions === 'undefined' ){

                        // RUN: callback
                        this.start( true );

                    // IF: both the current and next slide have neighter slide background images nor background colors specified
                    }else if(
                        typeof rb.transitions.curSlide.data.$background == 'undefined' &&
                        typeof rb.transitions.nextSlide.data.$background == 'undefined' &&
                        rb.transitions.curSlide.data.backgroundColor == 'transparent' &&
                        rb.transitions.nextSlide.data.backgroundColor == 'transparent'
                    ){
                        // RUN: callback
                        this.start( true );

                    }else{
                        // SET: overflowWrapper element overflow properties
                        if( rb.o.clipSlideTransition === 'x' ){
                            rb.device.$overflowWrapper.addClass('rb-overflowx-hidden');
                        }else if( rb.o.clipSlideTransition === 'y' ){
                            rb.device.$overflowWrapper.addClass('rb-overflowy-hidden');
                        }else if( rb.o.clipSlideTransition === true ){
                            rb.device.$overflowWrapper.addClass('rb-overflow-hidden');
                        }

                        // GET: transform style of current slide background image | required by Ken Burns zoom effect
                        if( typeof rb.transitions.curSlide.data.$background != 'undefined' ){

                            curGS = rb.transitions.curSlide.data.$background.closest('.rb-bg-wrap')[0]._gsTransform;
                            curSlideBGData = rb.transitions.curSlide.data.$background.data( rb.defaults.init.dataKey );

                            curSlideBGData.responsive.filter = rb.transitions.curSlide.data.$background[0].style.filter;
                            curSlideBGData.responsive.kbRotation = typeof curGS !== 'undefined' ? ' rotate(' + curGS.rotation + 'deg)' : ' rotate(0deg)';
                            curSlideBGData.responsive.kbScale = typeof curGS !== 'undefined' ? ' scale(' + curGS.scaleX + ')' : ' scale(1)';
                        }

                        // CREATE: slide transition wrapper
                        rb.transitions.slide.$wrapper = $( '<div>' ).addClass( 'rb-slide-transition-wrapper' ).css({
                            width : rb.slider.width,
                            height : rb.slider.height
                        });

                        // SELECT: slide transition
                        this.select.slideTransitionType();
                    }
                },

                select: {

                    slideTransitionType: function(){
                        rb.transitions.slide.normal.select.transitionType();
                    }
                },

                start: function( fallback ){

                    var curSlideBGData,
                        curSlideBGVideo = rb.slides.current.index && rb.slides.current.data.$backgroundVideo.length ? true : false,
                        nextSlideBGVideo = rb.slides.next.index && rb.slides.next.data.$backgroundVideo.length ? true : false;

                    if( !rb.slideshow.firstStart && rb.api.hasEvent( 'slideChangeDidStart' ) ){
                        // API CALL: slideChangeDidStart
                        $slider.triggerHandler( 'slideChangeDidStart', rb.api.eventData() );
                    }

                    // IF: there is slide transition and this is not the first slide
                    if( !fallback ){

                        // SET: slide transition duration
                        if( typeof rb.transitions.nextSlide.data.transitionDuration != 'undefined' ){
                            rb.transitions._slideTransition.duration( rb.transitions.nextSlide.data.transitionDuration );
                        }

                        // SET: transition duration regarding to timeScaleModifier of playByScroll sliders
                        if( rb.transitions.layers.timeline.timeScaleModifier > 0.25 ){
                            var modifiedDuration = rb.transitions._slideTransition.duration() / ( 0.75 + rb.transitions.layers.timeline.timeScaleModifier );
                            // SET: minimum value of modifiedDuration
                            modifiedDuration = modifiedDuration < 0.5 ? 0.5 : modifiedDuration;
                            // APPLY: modifiedDuration
                            rb.transitions._slideTransition.duration( modifiedDuration );
                        }
                    }

                    var duration = rb.transitions._slideTransition.duration() / rb.transitions._slideTransition.timeScale(),
                        nextLayersStartInstance = duration,
                        timeShift = rb.transitions.nextSlide.data.timeShift,
                        layersStartInstance;

                    // SET: timeshift
                    // cannot be greater than 0 | layer transitions can be shifted only to negative value
                    if( timeShift > 0 ){
                        timeShift = 0;
                    }else if( timeShift < 0 && Math.abs( timeShift ) > duration ){
                        timeShift = -duration;
                    }

                    // SET: calculated timeshift | needed for set the starting time & duration of the slide bg ken burns transition
                    rb.transitions.nextSlide.data.calculatedTimeShift = timeShift;

                    // Calculate the time when layer transitions on the next slide should start
                    layersStartInstance = rb.transitions.firstSlide ? rb.o.sliderFadeInDuration + 0.01 : ( nextLayersStartInstance + timeShift ) * rb.transitions._slideTransition.timeScale();

                    // SET: background video
                    if( curSlideBGVideo || nextSlideBGVideo ){
                        rb.transitions.media.changeBackgroundVideo( rb.transitions.firstSlide, curSlideBGVideo && nextSlideBGVideo ? true : false );
                    }

                    // this event will be called @ layersStartInstance
                    rb.transitions._slideTransition.call( function(){

                        if( !rb.slideshow.firstStart && rb.api.hasEvent( 'slideChangeWillComplete' ) ){
                            // API CALL: slideChangeWillComplete
                            $slider.triggerHandler( 'slideChangeWillComplete', rb.api.eventData() );
                        }

                        // FORCE: slide change
                        if( !rb.slideshow.should.change ){
                            // CREATE: layer transitions
                            rb.transitions.layers.timeline.prepare();
                        }

                        // STOP: media #2
                        rb.media.stop( true );

                        // SET: slide indexes
                        rb.slides.set.slideIndexes();

                        // CHANGE: location hash
                        if( rb.o.hashChange ){
                            document.location.hash = rb.slides[ rb.slides.current.index ].data.deeplink || '_no-deeplink-found_';
                        }

                        // START: slideshow
                        rb.slideshow.start();

                        // STOP: background video on previous slide if necessary
                        if( !rb.transitions.firstSlide && rb.slides.prev.index && rb.slides.prev.data.$backgroundVideo.length && !rb.slides.prev.data.$backgroundVideo.data( rb.defaults.init.dataKey ).mediaProperties.willBePaused ){
                            rb.slides.prev.data.$backgroundVideo.trigger( 'stopBackgroundVideo' );
                            rb.slides.prev.data.$backgroundVideo.data( rb.defaults.init.dataKey ).elements.$bgWrapper.css({
                                display: 'none'
                            });
                        }

                        // FORCE: slide change
                        if( !rb.slideshow.should.change ){
                            // PRELOAD: background video on next slide if necessary
                            if( rb.slides.next.data.$backgroundVideo.length && !rb.slides.next.data.$backgroundVideo.data( rb.defaults.init.dataKey ).mediaProperties.isPreloaded ){
                                rb.slides.next.data.$backgroundVideo.trigger( 'preloadBackgroundVideo' );
                                rb.slides.next.data.$backgroundVideo.data( rb.defaults.init.dataKey ).mediaProperties.isPreloaded = true;
                            }
                        }

                        // SET: firstSlide to false
                        rb.transitions.firstSlide = false;

                    }, [], this, layersStartInstance );

                    // START: playing slide transition
                    rb.transitions._slideTransition.play();

                    // HIDE: current slide background image
                    if( typeof rb.transitions.curSlide.data != 'undefined' && typeof rb.transitions.curSlide.data.$background != 'undefined' ){

                        // GET: slide background data
                        curSlideBGData = rb.transitions.curSlide.data.$background.data( rb.defaults.init.dataKey );
                        // We must use setTimeout due to a Safari bug
                        rb.timeouts.applyBG = setTimeout(function(){
                            // REMOVE: from rb.timeouts object
                            delete rb.timeouts.applyBG;

                            rb.transitions.curSlide.data.$background.closest('.rb-bg-wrap').hide();
                            if( curSlideBGData.kenBurns.zoom ){
                                gsap.TweenMax.set( rb.transitions.curSlide.data.$background[0], {
                                    autoCSS: false,
                                    css: curSlideBGData.kenBurns.from
                                });
                            }
                        }, 5 );
                    }
                },

                onComplete: function(){

                    var curSlideBGData;

                    // SHOW: next slide background image
                    if( typeof rb.transitions.nextSlide.data.$background != 'undefined' ){
                        rb.transitions.nextSlide.data.$background.closest('.rb-bg-wrap').show();
                    }

                    // SET: next slide background color
                    if( rb.transitions.nextSlide.data.backgroundColor !== 'transparent' ){
                        rb.slider.$innerWrapper.css( 'background-color', rb.transitions.nextSlide.data.backgroundColor );
                    }else{
                        rb.slider.$innerWrapper.css( 'background-color', rb.o.globalBGColor );
                    }

                    if( !rb.o.leaveOverflow ){
                        // SET: overflowWrapper element overflow properties to default
                        rb.device.$overflowWrapper.removeClass('rb-overflowx-hidden rb-overflowy-hidden rb-overflow-hidden');
                    }

                    // REMOVE: slide transition wrapper if exist
                    if( this.$wrapper ){
                        this.$wrapper.html( '' ).remove();
                        this.$wrapper = false;
                    }

                    // SET: active bullet
                    rb.gui.navigation.bottom.bullets.set.active();

                    // CHECK: cycles
                    if( rb.o.cycles > 0 ){
                        if( !rb.slideshow.hasOwnProperty( 'cycleSlideIndex' ) ){
                            rb.slideshow.cycles.set();
                        }else if( rb.slideshow.cycles.check( rb.transitions.nextSlide.index ) ){
                            rb.navigation.stop();
                            //SET: slideshow state
                            rb.functions.setStates( rb.slideshow, {
                                pausedByLastCycle: true
                            });
                            if( rb.o.forceCycles ){
                                rb.slideshow.curCycle = 1;
                            }
                        }
                    }

                    // SET: slider states
                    rb.functions.setStates( rb.slider, {
                        animatingSlides: false,
                        changingSlides: false
                    });

                    if( !rb.slideshow.firstStart && rb.api.hasEvent( 'slideChangeDidComplete' ) ){
                        // API CALL: slideChangeDidComplete
                        $slider.triggerHandler( 'slideChangeDidComplete', rb.api.eventData() );
                    }

                    // SET: firstStart to false
                    rb.slideshow.firstStart = false;

                    // FORCE: slide change
                    if( rb.slideshow.should.change !== false && rb.navigation.forceDirection ){
                        if( typeof rb.transitions.curSlide.data != 'undefined' && typeof rb.transitions.curSlide.data.$background != 'undefined' ){

                            // GET: slide background data
                            curSlideBGData = rb.transitions.curSlide.data.$background.data( rb.defaults.init.dataKey );

                            rb.transitions.curSlide.data.$background.closest('.rb-bg-wrap').hide();
                            if( curSlideBGData.kenBurns.zoom ){
                                gsap.TweenMax.set( rb.transitions.curSlide.data.$background[0], {
                                    autoCSS: false,
                                    css: curSlideBGData.kenBurns.from
                                });
                            }
                        }
                        rb.slideshow.changeTo( rb.slideshow.get.slideInSequence( rb.navigation.forceDirection ), true );
                    }else{
                        // START: preloading images of next slide
                        rb.preload.imagesOfSlide( rb.slides.next.index );
                    }
                },

                normal: {

                    select: {

                        transitionType: function(){

                            // GET: transition type | transition gallery
                            if( rb.o.slideTransition ){
                                rb.transitions.slide.normal.setTransition( rb.o.slideTransition.type, rb.o.slideTransition.obj );
                                return;
                            }

                            var rnd,
                                rndT,
                                fallback = rb.transitions.nextSlide.data.transition2d ? rb.transitions.nextSlide.data.transition2d.toString().split(',') : false;

                            if( rb.device.touchPrev && rb.o.slideOnSwipe ){
                                rb.device.touchPrev = false;
                                this.transition( '2d','1' );
                            }else if( rb.device.touchNext && rb.o.slideOnSwipe ){
                                rb.device.touchNext = false;
                                this.transition( '2d','1' );
                            }else if(
                                !rb.slides.next.data.$background &&
                                ( !fallback ||
                                    ( fallback &&
                                    ( fallback.indexOf('1') == -1 && fallback.indexOf('2') == -1 && fallback.indexOf('3') == -1 && fallback.indexOf('4') == -1 ) )
                                )
                            ){
                                this.transition( '2d','5' );
                            }else if( rb.browser.supports3D() && ( rb.transitions.nextSlide.data.transition3d || rb.transitions.nextSlide.data.customtransition3d ) ){

                                if( rb.transitions.nextSlide.data.transition3d && rb.transitions.nextSlide.data.customtransition3d ){
                                    rnd = Math.floor( Math.random() * 2 );
                                    rndT = [['3d',rb.transitions.nextSlide.data.transition3d],['custom3d', rb.transitions.nextSlide.data.customtransition3d]];
                                    this.transition( rndT[rnd][0], rndT[rnd][1] );

                                }else if( rb.transitions.nextSlide.data.transition3d ){
                                    this.transition( '3d', rb.transitions.nextSlide.data.transition3d );

                                }else{
                                    this.transition( 'custom3d', rb.transitions.nextSlide.data.customtransition3d );
                                }

                            }else{

                                if( rb.transitions.nextSlide.data.transition2d && rb.transitions.nextSlide.data.customtransition2d ){
                                    rnd = Math.floor( Math.random() * 2 );
                                    rndT = [['2d',rb.transitions.nextSlide.data.transition2d],['custom2d',rb.transitions.nextSlide.data.customtransition2d]];
                                    this.transition(rndT[rnd][0],rndT[rnd][1]);

                                }else if( rb.transitions.nextSlide.data.transition2d ){
                                    this.transition( '2d',rb.transitions.nextSlide.data.transition2d );

                                }else if( rb.transitions.nextSlide.data.customtransition2d ){
                                    this.transition( 'custom2d', rb.transitions.nextSlide.data.customtransition2d );

                                }else{
                                    this.transition( '2d','1' );
                                }
                            }
                        },

                        transition: function( type, transitionlist ){

                            transitionlist += '';

                            var tr = type.indexOf('custom') == -1 ? rb.t : rb.ct,
                                tt = '3d', lt, number;

                            if( type.indexOf('2d') != -1 ){
                                tt = '2d';
                            }

                            if( transitionlist.indexOf('last') != -1 ){
                                number = tr['t'+tt].length-1;
                                lt = 'last';

                            }else if( transitionlist.indexOf('all') != -1){
                                number = Math.floor(Math.random() * rb.functions.countProp(tr['t'+tt]) );
                                lt = 'random from all';

                            }else{
                                var t = transitionlist.split(',');
                                var l = t.length;
                                number = parseInt(t[Math.floor(Math.random() * l)])-1;
                                lt = 'random from specified';
                            }

                            // IF: slide transition is not found
                            if( typeof tr['t'+tt][number] === 'undefined' ){
                                // SET: slide transition properties to default
                                tr = ls.t;
                                type = tt = '2d';
                                number = 0;
                            }

                            rb.transitions.slide.normal.setTransition( tt, tr['t'+tt][number] );
                        }

                    },

                    setTransition: function( type, transitionProperties ){

                        var proppp = $.extend( true, {
                            cols: 1,
                            rows: 1
                        }, transitionProperties ),
                            cols = typeof proppp.cols,
                            rows = typeof proppp.rows,
                            tileWidth, tileHeight,
                            restW, restH,
                            tileSequence = [],
                            pn = rb.navigation.direction,
                            curRow = 0,
                            curCol = 0,
                            curBGSrc = rb.transitions.curSlide.data.$background ? rb.functions.getURL( rb.transitions.curSlide.data.$background ) : false,
                            nextBGSrc = rb.transitions.nextSlide.data.$background ? rb.functions.getURL( rb.transitions.nextSlide.data.$background ) : false,
                            kbFromTo = rb.o.playByScroll && rb.device.scroll.direction === 'up' ? 'to' : 'from';

                        // CALCULATE: cols & rows
                        switch( cols ){
                            case 'number':
                                cols = proppp.cols;
                            break;
                            case 'string':
                                cols = Math.floor( Math.random() * ( parseInt( proppp.cols.split(',')[1] ) - parseInt( proppp.cols.split(',')[0] ) + 1) ) + parseInt( proppp.cols.split(',')[0] );
                            break;
                            default:
                                cols = Math.floor( Math.random() * ( proppp.cols[1] - proppp.cols[0] + 1) ) + proppp.cols[0];
                            break;
                        }

                        switch( rows ){
                            case 'number':
                                rows = proppp.rows;
                            break;
                            case 'string':
                                rows = Math.floor( Math.random() * ( parseInt( proppp.rows.split(',')[1] ) - parseInt( proppp.rows.split(',')[0] ) + 1) ) + parseInt( proppp.rows.split(',')[0] );
                            break;
                            default:
                                rows = Math.floor( Math.random() * ( proppp.rows[1] - proppp.rows[0] + 1) ) + proppp.rows[0];
                            break;
                        }

                        // REDUCE: cols & rows if needed
                        if( rb.device.isMobile && rb.o.optimizeForMobile ){

                            if( cols >= 15 ){
                                cols = 7;
                            }else if( cols >= 5 ){
                                cols = 4;
                            }else if( cols >= 4 ){
                                cols = 3;
                            }else if( cols > 2 ){
                                cols = 2;
                            }

                            if( rows >= 15 ){
                                rows = 7;
                            }else if( rows >= 5 ){
                                rows = 4;
                            }else if( rows >= 4 ){
                                rows = 3;
                            }else if( rows > 2 ){
                                rows = 2;
                            }

                            if( rows > 2 && cols > 2 ){
                                rows = 2;
                                if( cols > 4){
                                    cols = 4;
                                }
                            }
                        }else{

                            // REDUCE: cols & rows
                            cols = cols > 35 ? 35 : cols;
                            rows = rows > 35 ? 35 : rows;
                        }

                        // SET: dimensions of tiles
                        tileWidth = Math.floor( rb.slider.width / cols );
                        tileHeight = Math.floor( rb.slider.height / rows );

                        // SET: rest values
                        restW = rb.slider.width - tileWidth * cols;
                        restH = rb.slider.height - tileHeight * rows;

                        // SWITCH: direction
                        if( pn == 'prev' ){

                            var switchSequence = {
                                'random': 'random',
                                'forward': 'reverse',
                                'reverse': 'forward',
                                'col-forward': 'col-reverse',
                                'col-reverse': 'col-forward'
                            };

                            if( proppp.tile && proppp.tile.sequence ){
                                proppp.tile.sequence = switchSequence[proppp.tile.sequence];
                            }

                            $.each( ['animation','before','after'], function( i, propName ){

                                if( proppp[propName] && proppp[propName].transition ){
                                    var t = proppp[propName].transition;
                                    if( t.rotateX && Math.abs( t.rotateX ) > 44 ){
                                        t.rotateX *= -1;
                                    }
                                    if( t.rotateY && Math.abs( t.rotateY ) > 44 ){
                                        t.rotateY *= -1;
                                    }
                                    if( t.rotate  ){
                                        t.rotate *= -1;
                                    }
                                }
                            });
                        }

                        // CREATE: tileSequence array
                        for( var ts=0; ts<cols * rows; ts++ ){
                            tileSequence.push(ts);
                        }

                        // SET: tileSequence
                        switch( proppp.tile.sequence ){
                            case 'reverse':
                                tileSequence.reverse();
                            break;
                            case 'col-forward':
                                tileSequence = rb.functions.sortArray(rows,cols,'forward');
                            break;
                            case 'col-reverse':
                                tileSequence = rb.functions.sortArray(rows,cols,'reverse');
                            break;
                            case 'random':
                                tileSequence = rb.functions.shuffleArray( tileSequence );
                            break;
                        }

                        // SET: slide transition background colors
                        if( rb.transitions.curSlide.data.backgroundColor === 'transparent' ){
                            rb.transitions.curSlide.data.backgroundColor = rb.o.globalBGColor;
                        }
                        if( rb.transitions.nextSlide.data.backgroundColor === 'transparent' ){
                            rb.transitions.nextSlide.data.backgroundColor = rb.o.globalBGColor;
                        }

                        if( type == '2d' ){

                                // SET: carousel transition | transition name must have the 'carousel' string
                            var carousel = proppp.name.toLowerCase().indexOf('carousel') == -1 ? false : true,
                                // SET: crossfade transition | transition name must have the 'crossfad' string
                                crossfade = proppp.name.toLowerCase().indexOf('crossfad') == -1 ? false : true;

                            this.$curTiles = $('<div>').addClass('rb-curtiles').appendTo( rb.transitions.slide.$wrapper );
                            this.$nextTiles = $('<div>').addClass('rb-nexttiles').appendTo( rb.transitions.slide.$wrapper );
                        }

                        for( var tiles=0; tiles<cols*rows; tiles++ ){

                            var rW = ( tiles + 1 )%cols ===  0 ? restW : 0,
                                rH = tiles > (rows-1)*cols-1 ? restH : 0,
                                $tile = $('<div>').addClass('rb-slide-transition-tile').css({
                                    width: tileWidth + rW,
                                    height: tileHeight + rH
                                }).data( 'style', {
                                    width: tileWidth + rW,
                                    height: tileHeight + rH
                                }).appendTo( rb.transitions.slide.$wrapper ),
                                $curTile, $nextTile,
                                startLeft, startTop,
                                bgLeft, bgTop,
                                curSlideBGData, nextSlideBGData, nextSlideBGKenBurnsData,
                                onComplete = tileSequence[tiles] == cols * rows -1 ? function(){ rb.transitions.slide.onComplete(); }: false;

                            curRow = tiles%cols === 0 ? curRow + 1 : curRow;
                            curCol = tiles%cols === 0 ? 1 : curCol + 1;

                            // IF: 3D transition
                            if( type == '3d' ){

                                $tile.addClass( 'rb-3d-container' );

                                var W = tileWidth + rW,
                                    H = tileHeight + rH,
                                    D, W2, H2, D2,
                                    backRotX = 0, topRotX = 0, bottomRotX = 0,
                                    curCubDelay, curCub,
                                    zV, zH, zIndex,
                                    _cuboidTimeline = new gsap.TimelineMax();

                                zIndex = Math.abs( Math.abs( curCol - cols / 2 - 0.5 ) - cols / 2 - 0.5 ) * Math.abs( Math.abs( curRow - rows / 2 - 0.5 ) - rows / 2 - 0.5 );

                                $tile.css({
                                    zIndex: zIndex
                                });

                                if( proppp.animation.direction == 'horizontal' ){
                                    if( Math.abs(proppp.animation.transition.rotateY) > 90 && proppp.tile.depth != 'large' ){
                                        D = Math.floor( W / 7 ) + rW;
                                    }else{
                                        D = W;
                                    }
                                }else{
                                    if( Math.abs(proppp.animation.transition.rotateX) > 90 && proppp.tile.depth != 'large' ){
                                        D = Math.floor( H / 7 ) + rH;
                                    }else{
                                        D = H;
                                    }
                                }

                                W2 = W/2;
                                H2 = H/2;
                                D2 = D/2;

                                this.createCuboids( 'rb-3d-box', $tile,0,0,0,0,-D2,0,0, W2 + 'px ' + H2 + 'px 0px' );
                                this.createCuboids( 'rb-3d-front',$tile.find( '.rb-3d-box' ),W,H,0,0,D2,0,0);
                                if( proppp.animation.direction == 'vertical' && Math.abs(proppp.animation.transition.rotateX) > 90 ){
                                    this.createCuboids( 'rb-3d-back',$tile.find( '.rb-3d-box' ),W,H,0,0,-D2,180,0);
                                }else{
                                    this.createCuboids( 'rb-3d-back',$tile.find( '.rb-3d-box' ),W,H,0,0,-D2,0,180);
                                }
                                this.createCuboids( 'rb-3d-left',$tile.find( '.rb-3d-box' ),D,H,-D2,0,0,0,-90);
                                this.createCuboids( 'rb-3d-right',$tile.find( '.rb-3d-box' ),D,H,W-D2,0,0,0,90);
                                this.createCuboids( 'rb-3d-top',$tile.find( '.rb-3d-box' ),W,D,0,-D2,0,90,0);
                                this.createCuboids( 'rb-3d-bottom',$tile.find( '.rb-3d-box' ),W,D,0,H-D2,0,-90,0);

                                $curTile = $tile.find( '.rb-3d-front' );

                                if( proppp.animation.direction == 'horizontal' ){
                                    if( Math.abs( proppp.animation.transition.rotateY ) > 90 ){
                                        $nextTile = $tile.find( '.rb-3d-back' );
                                    }else{
                                        if( proppp.animation.transition.rotateY > 0 ){
                                            $nextTile = $tile.find( '.rb-3d-left' );
                                        }else{
                                            $nextTile = $tile.find( '.rb-3d-right' );
                                        }
                                    }
                                }else{
                                    if( Math.abs(proppp.animation.transition.rotateX ) > 90 ){
                                        $nextTile = $tile.find( '.rb-3d-back' );
                                    }else{
                                        if( proppp.animation.transition.rotateX > 0 ){
                                            $nextTile = $tile.find( '.rb-3d-bottom' );
                                        }else{
                                            $nextTile = $tile.find( '.rb-3d-top' );
                                        }
                                    }
                                }

                                curCubDelay = tileSequence[tiles] * proppp.tile.delay;
                                curCub = rb.transitions.slide.$wrapper.find( '.rb-3d-container:eq( '+tiles+' ) .rb-3d-box' );

                                if( proppp.before && proppp.before.transition ){
                                    proppp.before.transition.delay = proppp.before.transition.delay ? (proppp.before.transition.delay + curCubDelay) / 1000 : curCubDelay / 1000;
                                    _cuboidTimeline.to( curCub[0],proppp.before.duration / 1000, rb.functions.convert.transition( proppp.before.transition, proppp.before.easing ) );
                                }else{
                                    proppp.animation.transition.delay = proppp.animation.transition.delay ? (proppp.animation.transition.delay + curCubDelay) / 1000 : curCubDelay / 1000;
                                }

                                _cuboidTimeline.to( curCub[0],proppp.animation.duration / 1000, rb.functions.convert.transition( proppp.animation.transition, proppp.animation.easing ) );

                                if( proppp.after ){
                                    if( !proppp.after.transition ){
                                        proppp.after.transition = {};
                                    }
                                    _cuboidTimeline.to( curCub[0],proppp.after.duration / 1000, rb.functions.convert.transition( proppp.after.transition, proppp.after.easing, 'after' ) );
                                }

                                rb.transitions._slideTransition.add( _cuboidTimeline, 0 );

                            // IF: 2D transition
                            }else{

                                var T1 = 'auto',
                                    L1 = 'auto',
                                    T2 = 'auto',
                                    L2 = 'auto',
                                    O1 = 1, O2 = 1,
                                    dir, direction,
                                    $tileInCur, $tileInNext,
                                    curTileDelay,
                                    r, rX, rY,
                                    curTileTween = {};

                                if( proppp.transition.direction == 'random' ){
                                    dir = ['top','bottom','right','left'];
                                    direction = dir[Math.floor(Math.random() * dir.length )];
                                }else{
                                    direction = proppp.transition.direction;
                                }

                                if( proppp.name.toLowerCase().indexOf('mirror') != -1 && tiles%2 === 0 ){
                                    if( pn == 'prev' ){
                                        pn = 'next';
                                    }else{
                                        pn = 'prev';
                                    }
                                }

                                if( pn == 'prev' ){

                                    direction = {
                                        top: 'bottom',
                                        bottom: 'top',
                                        left: 'right',
                                        right: 'left',
                                        topleft: 'bottomright',
                                        topright: 'bottomleft',
                                        bottomleft: 'topright',
                                        bottomright: 'topleft'
                                    }[direction];
                                }

                                switch( direction ){
                                    case 'top':
                                        T1 = T2 = -$tile.data( 'style' ).height;
                                        L1 = L2 = 0;
                                    break;
                                    case 'bottom':
                                        T1 = T2 = $tile.data( 'style' ).height;
                                        L1 = L2 = 0;
                                    break;
                                    case 'left':
                                        T1 = T2 = 0;
                                        L1 = L2 = -$tile.data( 'style' ).width;
                                    break;
                                    case 'right':
                                        T1 = T2 = 0;
                                        L1 = L2 = $tile.data( 'style' ).width;
                                    break;
                                    case 'topleft':
                                        T1 = $tile.data( 'style' ).height;
                                        T2 = 0;
                                        L1 = $tile.data( 'style' ).width;
                                        L2 = 0;
                                    break;
                                    case 'topright':
                                        T1 = $tile.data( 'style' ).height;
                                        T2 = 0;
                                        L1 = - $tile.data( 'style' ).width;
                                        L2 = 0;
                                    break;
                                    case 'bottomleft':
                                        T1 = - $tile.data( 'style' ).height;
                                        T2 = 0;
                                        L1 = $tile.data( 'style' ).width;
                                        L2 = 0;
                                    break;
                                    case 'bottomright':
                                        T1 = - $tile.data( 'style' ).height;
                                        T2 = 0;
                                        L1 = - $tile.data( 'style' ).width;
                                        L2 = 0;
                                    break;
                                }

                                this.scale2D = proppp.transition.scale ? proppp.transition.scale : 1;

                                if( carousel == true && this.scale2D != 1 ){

                                    T1 = T1 / 2;
                                    T2 = T2 / 2;
                                    L1 = L1 / 2;
                                    L2 = L2 / 2;
                                }

                                switch( proppp.transition.type ){
                                    case 'fade':
                                        T1 = T2 = L1 = L2 = 0;
                                        O1 = 0;
                                        O2 = 1;
                                    break;
                                    case 'mixed':
                                        O1 = 0;
                                        O2 = 1;
                                        if( this.scale2D == 1 ){
                                            T2 = L2 = 0;
                                        }
                                    break;
                                }

                                // IMPROVEMENT v4.5.0 Implemented Rotation and Scale into 2D Transitions

                                if((( proppp.transition.rotate || proppp.transition.rotateX || proppp.transition.rotateY ) || this.scale2D != 1 ) && proppp.transition.type != 'slide' ){
                                    $tile.css({
                                        overflow : 'visible'
                                    });
                                }else{
                                    $tile.css({
                                        overflow : 'hidden'
                                    });
                                }

                                if( carousel == true){
                                    this.$curTiles.css({
                                        overflow: 'visible'
                                    });
                                }else{
                                    this.$curTiles.css({
                                        overflow: 'hidden'
                                    });
                                }

                                if( crossfade === true || proppp.transition.type == 'slide' || carousel === true ){
                                    $tileInCur = $tile.appendTo( this.$curTiles );
                                    $tileInNext = $tile.clone().appendTo( this.$nextTiles );
                                    $curTile = $('<div>').addClass('rb-curtile').appendTo( $tileInCur );
                                }else{
                                    $tileInNext = $tile.appendTo( this.$nextTiles );
                                }

                                $nextTile = $('<div>').addClass('rb-nexttile').appendTo( $tileInNext );

                                // GET: delay time of current tile
                                curTileDelay = tileSequence[tiles] * proppp.tile.delay / 1000;

                                // GET: rotations
                                r = proppp.transition.rotate ? proppp.transition.rotate : 0;
                                rX = proppp.transition.rotateX ? proppp.transition.rotateX : 0;
                                rY = proppp.transition.rotateY ? proppp.transition.rotateY : 0;

                                // SET: rotation direction
                                if( pn == 'prev' ){
                                    r = -r;
                                    rX = -rX;
                                    rY = -rY;
                                }

                                // ADD TO TIMELINE: slide transition timeline | next tile @ curTileDelay
                                rb.transitions._slideTransition.fromTo( $nextTile[0], proppp.transition.duration / 1000, {
                                    immediateRender: false,
                                    autoCSS: false,
                                    css: {
                                        x: -L1,
                                        y: -T1,
                                        display: 'block',
                                        opacity: O1,
                                        rotation: r,
                                        rotationX: rX,
                                        rotationY: rY,
                                        scale: this.scale2D
                                    }
                                },{
                                    autoCSS: false,
                                    css: {
                                        x: 0,
                                        y: 0,
                                        opacity: O2,
                                        rotation: 0,
                                        rotationX: 0,
                                        rotationY: 0,
                                        scale: 1
                                    },
                                    ease: rb.functions.convert.easing( proppp.transition.easing )
                                }, curTileDelay );

                                // IMPROVEMENT v5.0.0 Smart crossfading for semi-transparent PNG and different size JPG backgrounds

                                if(
                                    crossfade == true && (
                                        typeof rb.transitions.nextSlide.data.$background == 'undefined' || (
                                            typeof rb.transitions.nextSlide.data.$background != 'undefined' && (
                                                rb.transitions.nextSlide.data.$background.attr('src').toLowerCase().indexOf('png') != -1 || (
                                                    rb.transitions.nextSlide.data.$background.width() < rb.slider.width || rb.transitions.nextSlide.data.$background.height() < rb.slider.height
                                                )
                                            )
                                        )
                                    )
                                ){
                                    curTileTween['opacity'] = 0;
                                }

                                if( ( proppp.transition.type == 'slide' || carousel == true ) && proppp.name.toLowerCase().indexOf('mirror') == -1 ){

                                    var r2 = 0;

                                    if( r !== 0 ){
                                        r2 = -r;
                                    }

                                    curTileTween['x'] = L2;
                                    curTileTween['y'] = T2;
                                    curTileTween['rotation'] = r2;
                                    curTileTween['scale'] = this.scale2D;
                                    curTileTween['opacity'] = O1;
                                }

                                // IF: $curTile is exist
                                if( typeof $curTile !== 'undefined' ){

                                    // ADD TO TIMELINE: slide transition timeline | current tile @ curTileDelay
                                    rb.transitions._slideTransition.to( $curTile[0], proppp.transition.duration / 1000, {
                                        autoCSS: false,
                                        css: curTileTween,
                                        ease: rb.functions.convert.easing( proppp.transition.easing )
                                    }, curTileDelay );
                                }
                            }

                            startLeft = tiles%cols*tileWidth;
                            startTop = Math.floor(tiles/cols)*tileHeight;

                            // ADD: current slide background image to current tiles
                            if( typeof rb.transitions.curSlide.data.$background != 'undefined' ){
                                curSlideBGData = rb.transitions.curSlide.data.$background.data( rb.defaults.init.dataKey );

                                if( type === '3d' || ( type === '2d' && ( crossfade === true || proppp.transition.type === 'slide' || carousel === true ) ) ){
                                    $curTile.append( $( '<img>' ).attr( 'src', curBGSrc ).css({
                                        width: curSlideBGData.responsive.width,
                                        height: curSlideBGData.responsive.height,
                                        '-webkit-filter': curSlideBGData.responsive.filter,
                                        filter: curSlideBGData.responsive.filter,
                                        '-ms-transform': 'translateX(' + ( curSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( curSlideBGData.responsive.y - startTop ) + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale,
                                        '-webkit-transform': 'translateX(' + ( curSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( curSlideBGData.responsive.y - startTop ) + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale,
                                        transform: 'translateX(' + ( curSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( curSlideBGData.responsive.y - startTop ) + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale
                                    }));
                                }else if( this.$curTiles.children().length === 0 ){
                                    this.$curTiles.css('background-color',rb.transitions.curSlide.data.backgroundColor ).append($( '<img>' ).attr( 'src', curBGSrc ).css({
                                        width: curSlideBGData.responsive.width,
                                        height: curSlideBGData.responsive.height,
                                        '-webkit-filter': curSlideBGData.responsive.filter,
                                        filter: curSlideBGData.responsive.filter,
                                        '-ms-transform': 'translateX(' + curSlideBGData.responsive.x + 'px) translateY(' + curSlideBGData.responsive.y + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale,
                                        '-webkit-transform': 'translateX(' + curSlideBGData.responsive.x + 'px) translateY(' + curSlideBGData.responsive.y + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale,
                                        transform: 'translateX(' + curSlideBGData.responsive.x + 'px) translateY(' + curSlideBGData.responsive.y + 'px)' + curSlideBGData.responsive.kbRotation + curSlideBGData.responsive.kbScale
                                    }));
                                }
                            }

                            // ADD: current slide background color to current tiles
                            if( rb.transitions.curSlide.data.backgroundColor !== 'transparent' && !rb.transitions.curSlide.data.$backgroundVideo.length ){
                                if( type === '3d' || ( type === '2d' && ( crossfade === true || proppp.transition.type === 'slide' || carousel === true ) ) ){
                                    $curTile.css( 'background-color', rb.transitions.curSlide.data.backgroundColor );
                                }else if( this.$curTiles.children().length === 0 ){
                                    this.$curTiles.css('background-color',rb.transitions.curSlide.data.backgroundColor );
                                }
                            }

                            // ADD: next slide background image to next tiles
                            if( typeof rb.transitions.nextSlide.data.$background != 'undefined' ){
                                nextSlideBGData = rb.transitions.nextSlide.data.$background.data( rb.defaults.init.dataKey );
                                nextSlideBGKenBurnsData = nextSlideBGData.kenBurns[kbFromTo];

                                $nextTile.append( $( '<img>' ).attr( 'src', nextBGSrc ).css({
                                    width: nextSlideBGData.responsive.width,
                                    height: nextSlideBGData.responsive.height,
                                    '-webkit-filter': rb.transitions.nextSlide.filter.from || 'none',
                                    filter: rb.transitions.nextSlide.filter.from || 'none',
                                    '-ms-transform': 'translateX(' + ( nextSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( nextSlideBGData.responsive.y - startTop ) + 'px) rotate(' + nextSlideBGKenBurnsData.rotation + 'deg) scale(' + nextSlideBGKenBurnsData.scale + ')',
                                    '-webkit-transform': 'translateX(' + ( nextSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( nextSlideBGData.responsive.y - startTop ) + 'px) rotate(' + nextSlideBGKenBurnsData.rotation + 'deg) scale(' + nextSlideBGKenBurnsData.scale + ')',
                                    transform: 'translateX(' + ( nextSlideBGData.responsive.x - startLeft ) + 'px) translateY(' + ( nextSlideBGData.responsive.y - startTop ) + 'px) rotate(' + nextSlideBGKenBurnsData.rotation + 'deg) scale(' + nextSlideBGKenBurnsData.scale + ')'
                                }));
                            }
                            // ADD: next slide background color to next tiles
                            if( rb.transitions.nextSlide.data.backgroundColor !== 'transparent' && !rb.transitions.nextSlide.data.$backgroundVideo.length ){
                                $nextTile.css( 'background-color', rb.transitions.nextSlide.data.backgroundColor );
                            }
                        }

                        // APPEND: slide transition wrapper into layers wrapper or inner wrapper
                        rb.transitions.slide.$wrapper.prependTo( rb.o.preferBlendMode ? rb.slider.$layersWrapper : rb.slider.$innerWrapper );
                        rb.transitions.slide.start();
                    },

                    createCuboids: function( className, $tile, w, h, tx, ty, tz, rx, ry, tO ){

                        var transform = 'translate3d( '+tx+'px, '+ty+'px, '+tz+'px)';
                            if( rx !== 0 ){
                                transform += 'rotateX( '+rx+'deg)';
                            }
                            if( ry !== 0 ){
                                transform += 'rotateY( '+ry+'deg)';
                            }

                        var style = {
                            width: w,
                            height: h,
                            'transform': transform,
                            '-ms-transform': transform,
                            '-webkit-transform': transform
                        };

                        if( tO ){
                            style['transform-origin'] = tO;
                            style['-ms-transform-origin'] = tO;
                            style['-webkit-transform-origin'] = tO;
                        }

                        $( '<div>' ).addClass( className ).css( style ).appendTo( $tile );
                    }
                }
            },

            layers: {

                in: {

                    onStart: function( $layer ){

                        var layerData = $layer.data( rb.defaults.init.dataKey );

                        // ENABLE: hover on active layer
                        if( layerData.hover.enabled ){
                            rb.transitions.layers.hover.enable( $layer );
                        }
                    },

                    onComplete: function( $layer ){

                        rb.media.playIfAllowed( $layer );
                    }
                },

                out: {

                    forced: function(){

                        // IF: forceLayersOut timeline is exist...
                        if( rb.transitions._forceLayersOut ){

                            // IF: slide timeline is exist...
                            if( rb.transitions._slideTimeline ){

                                var _staticLayers = new gsap.TimelineMax({
                                        paused: true,
                                        autoRemoveChildren: true
                                    }),
                                    nodes,
                                    tween,
                                    tweens = [],
                                    playedDuration,
                                    centerTime = 100,
                                    staticLayers = rb.layers.get( 'current, in, static, active' ).add( rb.layers.get( 'current, out, static, active' ) ),
                                    notStaticLayers = rb.layers.get( 'current, out, notstatic, active' ),
                                    outLayers = rb.layers.get( 'current, out, active' ),
                                    allLayers = $().add( staticLayers ).add( notStaticLayers ),
                                    addTween = function( tween ){
                                        // ADD: tween to _staticLayers timeline
                                        _staticLayers.add( tween, centerTime - tween.duration() * tween.progress() );
                                    };

                                allLayers.each(function(){

                                    var $layer = $(this),
                                        layerData = $layer.data( rb.defaults.init.dataKey );

                                    // SET: playing loop transitions...
                                    if( layerData.loop._timeline ){
                                        rb.transitions._slideTimeline.remove( layerData.loop._timeline );
                                        layerData.loop._timeline.play();
                                    }

                                    if( layerData.is.static ){

                                        nodes = [layerData.elements.$wrapper[0]];
                                        if( layerData.elements.$clipWrapper ){
                                            nodes = nodes.concat( layerData.elements.$clipWrapper[0] );
                                        }
                                        if( layerData.textIn.nodes ){
                                            nodes = nodes.concat( layerData.textIn.nodes );
                                        }

                                        for( var n=0; n<nodes.length; n++ ){
                                            tweens = tweens.concat( rb.transitions._slideTimeline.getTweensOf( nodes[n], true ) );
                                        }

                                        for( var t=0; t<tweens.length; t++ ){
                                            if( tweens[t].duration && tweens[t].duration() !== 0 ){
                                                tween = tweens[t];
                                                addTween( tween );
                                            }
                                        }
                                    }
                                });

                                outLayers.each(function(){

                                    var $layer = $(this),
                                        layerData = $layer.data( rb.defaults.init.dataKey );

                                    layerData.should.reset = true;
                                });

                                // START: playing staticLayers timeline
                                _staticLayers.play().seek( centerTime );

                                // STOP: and clear slide timeline
                                rb.transitions._slideTimeline.stop().clear();
                            }

                            // START: forceLayersOut timeline > force transition out of current layers
                            rb.transitions._forceLayersOut.play();
                        }

                        // SET: layer links to invisible
                        rb.slider.$layersWrapper.find( '.rb-link' ).css({
                            display: 'none'
                        });
                    },

                    onStart: function( $layer ){

                        //var layerData = $layer.data( rb.defaults.init.dataKey );
                    },

                    onComplete: function( $layer ){

                        var layerData = $layer.data( rb.defaults.init.dataKey );

                        // Layer wrappers & timelines should be set to the default only on slide changes
                        if( rb.slider.state.changingSlides || layerData.settings.slideOut !== rb.slides.current.index ){

                            rb.transitions.layers.reset( $layer, layerData );
                        }

                        // DISABLE: hover on non active layer
                        if( layerData.hover.enabled ){
                            rb.transitions.layers.hover.disable( $layer );
                        }
                    }
                },

                reset: function( $layer, layerData ){

                    // STOP: and clear loop timeline
                    if( layerData.loop._timeline ){

                        layerData.loop._timeline.stop().clear();
                        delete layerData.loop._timeline;

                        // SET: loop wrapper to default
                        gsap.TweenMax.set( layerData.elements.$loopWrapper[0], layerData.reset.loopWrapperOnSlideChange );
                    }

                    // SET: in-out wrapper & layer to default
                    gsap.TweenMax.set( layerData.elements.$wrapper[0], layerData.reset.wrapperOnSlideChange );
                    gsap.TweenMax.set( $layer[0], {
                        '-webkit-filter': 'none',
                        filter: 'none'
                    } );

                    // IF: layer should be updated (if it has any random transition values)
                    if( layerData.should.update ){
                        // RE-CREATE: empty random objects
                        layerData.textInNodesFrom.random = {};
                        layerData.textOutNodesTo.random = {};
                        // UPDATE: layer data
                        rb.layers.update.data( $layer );
                    }

                    layerData.should.reset = false;
                },

                timeline: {

                    shouldRestart: false,

                    create: function( restart ){

                        var layersIn,
                            layersOut,
                            slideBackground,
                            layersOnSlideTimeline,
                            curNext = restart ? 'current' : 'next';

                        rb.transitions.curNext = curNext;
                        rb.transitions.layers.timeline.shouldRestart = false;

                        // SET: timeline states
                        rb.transitions.layers.timeline.resetStates();

                        // CREATE: two timelines:
                        // slide timeline is the normal timeline without user interaction
                        // forceLayersOut contains only tweens of layers with slide out transitions
                        // if the user force the slider to change slides timeline will be cleared
                        // and forceLayersOut will be played immediately!

                        // CREATE: slide timeline with layer transitions

                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.pause().progress( 0 ).kill().clear( true );
                            rb.transitions._slideTimeline = null;
                        }

                        rb.transitions._slideTimeline = new gsap.TimelineMax({
                            paused: true,
                            onStart: function(){
                                // API CALL: slideTimelineDidStart
                                if( rb.api.hasEvent( 'slideTimelineDidStart' ) ){
                                    $slider.triggerHandler( 'slideTimelineDidStart', rb.api.eventData() );
                                }
                            },
                            onComplete: function(){
                                if( rb.o.playByScroll && rb.o.playByScrollSkipSlideBreaks ){
                                    if( rb.slideshow.direction === 'next' ){
                                        rb.transitions.layers.timeline.scrollForward( true );
                                    }else{
                                        rb.transitions.layers.timeline.scrollBackwards( true, true );
                                    }
                                }
                            },
                            onReverseComplete: function(){
                                // API CALL: slideTimelineDidReverseComplete
                                if( rb.api.hasEvent( 'slideTimelineDidReverseComplete' ) ){
                                    $slider.triggerHandler( 'slideTimelineDidReverseComplete', rb.api.eventData() );
                                }
                                // SET: replay after reversed
                                if( rb.transitions.layers.timeline.shouldReplay ){
                                    rb.transitions.layers.timeline.shouldRestart = false;
                                    rb.transitions._slideTimeline.play();
                                }
                                if( rb.o.playByScroll && rb.o.playByScrollSkipSlideBreaks ){
                                    rb.transitions.layers.timeline.scrollBackwards( true, false );
                                }
                            },
                            onUpdate: function( timeline ){
                                // API CALL: slideTimelineDidUpdate
                                if( rb.api.hasEvent( 'slideTimelineDidUpdate' ) ){
                                    $slider.triggerHandler( 'slideTimelineDidUpdate', timeline );
                                }
                            },
                            onUpdateParams: ['{self}']
                        });

                        this.totalDuration = 0;
                        this.progress = 1;

                        // CREATE: force layers out timeline
                        rb.transitions._forceLayersOut = new gsap.TimelineMax({
                            paused: true,
                            autoRemoveChildren: true
                        });

                        // GET: layers which will be shown on the next slide
                        layersIn = rb.layers.get( curNext + ', in, notactive' );
                        // GET: layers which will be hidden on the next slide
                        layersOut = rb.layers.get( curNext + ', out, notstatic' ).add( rb.layers.get( curNext + ', out, active, static' ) );
                        // GET: slide background of the next slide
                        slideBackground = rb.layers.get( curNext + ', in, bgonly, notactive' );

                        layersOnSlideTimeline = $().add( layersIn ).add( layersOut ).add( slideBackground );

                        // ADD: all layers to slide timeline, except slide background | slide duration must be caluclated first
                        this.addLayers( layersIn, 'in', rb.transitions._slideTimeline, rb.transitions._forceLayersOut );
                        this.addLayers( layersOut, 'out', rb.transitions._slideTimeline, rb.transitions._forceLayersOut );

                        // SET: progress for slidebar timer
                        if( rb.slides[curNext].data.duration !== -1 && rb.slides[curNext].data.duration < this.totalDuration ){
                            this.progress = rb.slides[curNext].data.duration / this.totalDuration;

                        // If a layer has infinite loop with a long delay, the callback function which will call loopstart is stretching the timeline!
                        }else if( rb.transitions._slideTimeline.duration() > this.totalDuration ){
                            this.progress = this.totalDuration / rb.transitions._slideTimeline.duration();
                        }

                        // SET: slide duration to calculatedDuration if it is not set by user
                        if( rb.slides[curNext].data.duration === -1 ){
                            // UPDATE: temporary duration
                            rb.slides[curNext].data.duration = this.totalDuration;
                            // UPDATE: saved slide duration
                            rb.slides[rb.slides[curNext].index].data.duration = this.totalDuration;
                        }else{
                            this.totalDuration = rb.slides[curNext].data.duration;
                        }

                        // ADD: slide background to slide timeline
                        this.addLayers( slideBackground, 'in', rb.transitions._slideTimeline, rb.transitions._forceLayersOut );

                        for( var p=0; p<layersOnSlideTimeline.length; p++ ){
                            if( $( layersOnSlideTimeline[p] ).data( rb.defaults.init.dataKey ).parallax.enabled ){
                                $( layersOnSlideTimeline[p] ).data( rb.defaults.init.dataKey ).elements.$parallaxWrapper.attr( 'data-rb-parallax', 'active' );
                            }
                        }

                        // SET: parallax wrappers on current slide
                        // TRIGGER: parallax effect at slide start
                        rb.transitions.layers.parallax.trigger();

                        // API CALL: slideTimelineDidCreate
                        if( rb.api.hasEvent( 'slideTimelineDidCreate' ) ){
                            $slider.triggerHandler( 'slideTimelineDidCreate', {
                                slideTimeline: rb.transitions._slideTimeline,
                                layersOnSlideTimeline: layersOnSlideTimeline,
                                slideTimelineDuration: this.totalDuration
                            });
                        }

                        // CREATE: timer transitions
                        rb.transitions.timers.create();

                        // ADD TO TIMELINE: slide timeline | bar timer transition @ 0
                        if( rb.transitions.timers.bar._transition ){
                            rb.transitions._slideTimeline.add( rb.transitions.timers.bar._transition.play(), 0 );
                        }

                        // ADD TO TIMELINE: slide timeline | circle timer transition @ 0
                        if( rb.transitions.timers.circle._transition ){
                            rb.transitions._slideTimeline.add( rb.transitions.timers.circle._transition.play(), 0 );
                        }

                        // ADD TO TIMELINE: slide timeline | slide timer transition @ 0
                        if( rb.transitions.timers.slidebar._transition ){
                            rb.transitions._slideTimeline.add( rb.transitions.timers.slidebar._transition.play(), 0 );
                        }

                        // ADD TO TIMELINE: slide timeline | end of the slide @ rb.slides.next.data.duration
                        rb.transitions._slideTimeline.call( function(){

                            if( !rb.transitions._slideTimeline.reversed() ){

                                // API CALL: slideTimelineDidComplete
                                if( rb.api.hasEvent( 'slideTimelineDidComplete' ) ){
                                    if( false === $slider.triggerHandler( 'slideTimelineDidComplete', rb.api.eventData() ) ){
                                        return;
                                    }
                                }

                                // SET: timeline state
                                rb.functions.setStates( rb.transitions.layers.timeline, {
                                    finished: true
                                });

                                if( !rb.slideshow.isPaused() && rb.slideshow.state.running ){
                                    rb.slideshow.changeTo( rb.slides.next.index );
                                }else if( rb.slideshow.state.pausedByLastCycle ){
                                    // SET: timers to starting position
                                    rb.transitions.timers.reverse();
                                }
                            }
                        }, [], this, rb.slides[curNext].data.duration );

                        // SET: layer link to visible (if any)
                        if( rb.slides.next.data.$link ){
                            rb.slides.next.data.$link.css({
                                display: 'block'
                            });
                        }

                        // START: playing current slide timeline
                        if(
                            ( ( rb.o.startInViewport && ( rb.slider.positionToViewport === 'inside' || rb.o.playByScrollStart ) ) || !rb.o.startInViewport ) &&
                            ( ( rb.slider.isPopup && rb.slider.state.popupIsVisible && rb.slider.state.popupShouldStart ) || !rb.slider.isPopup )
                        ){
                            if( rb.o.pauseLayers && rb.slideshow.isPaused() ){
                                rb.transitions._slideTimeline.timeScale( 0 );
                            }
                            rb.transitions.layers.timeline.play();
                            // SET: timeline starting progress to the end if scrolling up on a playByScroll slider
                            if( rb.o.playByScroll && rb.device.scroll.directionAtSlideTransitionStart === 'up' ){
                                rb.transitions._slideTimeline.progress( 1 );
                            }
                        }

                        // REMOVE: global hover events and reset global hover layers in all cases
                        $slider.trigger( 'mouseleave.globalhover' + sliderUID );
                        $slider.off( 'mouseenter.globalhover' + sliderUID + ' mouseleave.globalhover' + sliderUID + ' mousemove.globalhover' + sliderUID );

                        // SET: global hover
                        if( rb.slides[curNext].data.globalhover ){

                            var $hoverLayers = rb.layers.get( curNext + ',in,notactive' ).add( rb.layers.get( 'static,active' ) );

                            $slider.on( 'mouseenter.globalhover' + sliderUID, function(){
                                $hoverLayers.each(function(){
                                    rb.transitions.layers.hover.mouseEnter( $(this), $(this).data( rb.defaults.init.dataKey ) );
                                });
                            });

                            $slider.on( 'mouseleave.globalhover' + sliderUID, function(){
                                $hoverLayers.each(function(){
                                    rb.transitions.layers.hover.mouseLeave( $(this), $(this).data( rb.defaults.init.dataKey ) );
                                });
                            });

                            $slider.on( 'mousemove.globalhover' + sliderUID, function(){
                                $hoverLayers.each(function(){
                                    rb.transitions.layers.hover.mouseMove( $(this), $(this).data( rb.defaults.init.dataKey ) );
                                });
                            });
                        }
                    },

                    prepare: function(){

                        // SET: layers container overflow to visible / hidden
                        if( rb.slides.next.data.overflow && rb.slides.next.data.overflow !== 'hidden' ){
                            rb.slider.$layersWrapper.addClass( 'ls-visible' );
                            rb.slider.$slideBGWrapper.addClass( 'ls-visible' );
                        }else{
                            rb.slider.$layersWrapper.removeClass( 'ls-visible' );
                            rb.slider.$slideBGWrapper.removeClass( 'ls-visible' );
                        }

                        this.create();
                    },

                    getTiming: function( layerData, requestedTiming, timelineLabelKey, timingOnly ){

                        if( typeof requestedTiming === 'number' ){

                            return requestedTiming;

                        }else{

                            requestedTiming = requestedTiming.toLowerCase();

                            var timelineHierarchy = rb.defaults.layer.timelineHierarchy,
                                requestedLabelKey,
                                timelineTiming,
                                numericValue,
                                operation,
                                operator,
                                timing = 0;

                            if( requestedTiming.indexOf( '*') !== -1 ){ operator = '*'; }
                            if( requestedTiming.indexOf( '/') !== -1 ){ operator = '/'; }
                            if( requestedTiming.indexOf( '+') !== -1 ){ operator = '+'; }
                            if( requestedTiming.indexOf( '-') !== -1 ){ operator = '-'; }

                            if( operator ){

                                operation = requestedTiming.split( operator );
                                requestedLabelKey = $.trim( operation[0] );
                                numericValue = parseInt( $.trim( operation[1] ) );

                                if( timelineHierarchy[requestedLabelKey] &&
                                    timelineHierarchy[timelineLabelKey][1].indexOf( timelineHierarchy[requestedLabelKey][0] ) !== -1
                                ){
                                    timelineTiming = typeof layerData.timeline[requestedLabelKey] === 'number' ? layerData.timeline[requestedLabelKey] : layerData.timeline[requestedLabelKey]( layerData );

                                    // on static layers, when they animate out
                                    if( timingOnly ){
                                        timing = numericValue / 1000;
                                    }else{
                                        switch( operator ){
                                            case '*':
                                                timing = timelineTiming * numericValue;
                                            break;
                                            case '/':
                                                timing = timelineTiming / numericValue;
                                            break;
                                            case '+':
                                                timing = timelineTiming + numericValue / 1000;
                                            break;
                                            case '-':
                                                timing = timelineTiming - numericValue / 1000;
                                            break;
                                        }
                                    }
                                }else{
                                    // on static layers, when they animate out
                                    if( operator === '+' || timingOnly ){
                                        timing = numericValue / 1000;
                                    }
                                }

                            }else{

                                requestedLabelKey = $.trim( requestedTiming );

                                if( timelineHierarchy[requestedLabelKey] &&
                                    timelineHierarchy[timelineLabelKey][1].indexOf( timelineHierarchy[requestedLabelKey][0] ) !== -1
                                ){

                                    // on static layers, when they animate out
                                    if( timingOnly ){
                                        timing = 0;
                                    }else{
                                        timing = typeof layerData.timeline[requestedLabelKey] === 'number' ? layerData.timeline[requestedLabelKey] : layerData.timeline[requestedLabelKey]( layerData );
                                    }

                                }
                            }

                            // CHECK: timing must be a numeric value and it cannot be smaller than 0 which is the starting point of the slide timeline
                            if( timing !== timing || timing < 0 ){
                                timing = 0;
                            }

                            return timing;
                        }
                    },

                    addLayers: function( layers, transitionType, _slideTimeline, _forceLayersOut ){

                        for( var l=0, length = layers.length; l<length; l++ ){

                            var $layer = $( layers[l] ),
                                layerData = $layer.data( rb.defaults.init.dataKey ),
                                $wrapper = layerData.elements.$wrapper,
                                $clipWrapper = layerData.elements.$clipWrapper,
                                $loopWrapper = layerData.elements.$loopWrapper,
                                totalLayerDuration;

                            // IF: layer transitions should reseted
                            if( layerData.should.reset ){
                                rb.transitions.layers.reset( $layer, layerData );
                            }

                            if( $layer.hasClass( 'rb-bg' ) ){
                                // Ken Burns zoom effect on slide background images
                                if( layerData.kenBurns.zoom ){

                                    // ADD TO TIMELINE: slide timeline
                                    _slideTimeline.fromTo( $layer.closest('.rb-bg-wrap'), rb.transitions.nextSlide.data.duration + rb.transitions.nextSlide.data.calculatedTimeShift, {
                                        autoCSS: false,
                                        css: layerData.kenBurns.from
                                    },{
                                        autoCSS: false,
                                        css: layerData.kenBurns.to,
                                        ease: gsap.Quad.easeInOut
                                    }, -rb.transitions.nextSlide.data.calculatedTimeShift );
                                }
                                // Filter transitions on slide background images
                                if( !$.isEmptyObject( layerData.filter.values.bgFrom ) || !$.isEmptyObject( layerData.filter.values.bgTo ) ){
                                    if( !layerData.filter.transitions.bg ){
                                        layerData.filter.transitions.bg = rb.transitions.layers.filters.createTransition(
                                            layerData,
                                            'bg',
                                            layerData.filter.values.bgFrom,
                                            layerData.filter.values.bgTo
                                        );
                                    }

                                    // ADD TO TIMELINE: slide timeline | set filter properties & start transition @ layerData.timeline.transitioninstart
                                    _slideTimeline.to( [ { p: 0 }, $layer[0] ], rb.transitions.nextSlide.data.duration, {
                                        p: 1,
                                        autoCSS: false,
                                        ease: gsap.Sine.easeInOut,
                                        onUpdate: rb.transitions.layers.filters.animate,
                                        onUpdateParams: [ '{self}', layerData.filter.transitions.bg ]
                                    }, 0 );
                                }
                            }else{

                                switch( transitionType ){

                                    case 'in':

                                        // Transition in

                                            if( layerData.in.enabled ){

                                                // SET: starting and ending time of transition in
                                                if( !layerData.settings.timelineIsCalculated ){
                                                    if( typeof layerData.in.startAt !== 'number' ){
                                                        layerData.in.startAt = 0;
                                                    }
                                                    layerData.timeline.transitioninstart = layerData.in.startAt;
                                                    layerData.timeline.transitioninend = layerData.timeline.transitioninstart + layerData.in.duration;
                                                }

                                                // SET: convert x, y, transformOrigin
                                                rb.resize.transformProperties( $layer, layerData.inLayerFromCSS, layerData.inLayerShouldBeConverted );

                                                // SET: convert width, height, borderRadius
                                                rb.resize.styleProperties( layerData.inLayerStyleFromCSS, layerData.inLayerStyleShouldBeConvertedFrom );
                                                rb.resize.styleProperties( layerData.inLayerStyleToCSS, layerData.inLayerStyleShouldBeConvertedTo );
                                                // SET: transformPerspective
                                                layerData.inLayerFromCSS.transformPerspective = layerData.transformPerspective.layer * rb.resize.ratio;

                                                // IF: clip property should be animated
                                                if( layerData.clip.enabled ){

                                                    // IF: no original clip property, using default for clip to
                                                    if( !layerData.original.clip ){
                                                        layerData.original.clip = layerData.clip.min;
                                                        layerData.original.clipShouldBeConverted = true;
                                                    }

                                                    // IF: no clip transiton needed, but default clip property should be added to wrapper element...
                                                    if( !layerData.inClipShouldBeConverted.clip ){
                                                        gsap.TweenMax.set( $clipWrapper[0], { clip: rb.resize.clip( $layer, layerData.original.clip, layerData.original.clipShouldBeConverted ) } );
                                                    }else{
                                                        // SET: clip from and to
                                                        layerData.inClipFromCSS.clip = rb.resize.clip( $layer, layerData.inClipShouldBeConverted.clip, true );
                                                        layerData.inClipToCSS.clip = rb.resize.clip( $layer, layerData.original.clip, layerData.original.clipShouldBeConverted );

                                                        // ADD TO TIMELINE: slide timeline | set clip property & start clip transition @ layerData.timeline.transitioninstart
                                                        _slideTimeline.fromTo( $clipWrapper[0], layerData.in.duration, layerData.inClipFrom, layerData.inClipTo, layerData.timeline.transitioninstart );
                                                    }

                                                    // SET: retart slide timeline when resizing
                                                    rb.transitions.layers.timeline.shouldRestart = true;
                                                }

                                                // IF: any filter property should be animated
                                                if( !$.isEmptyObject( layerData.filter.values.in ) ){
                                                    // IF: filter transition has not been created
                                                    if( !layerData.filter.transitions.in ){
                                                        layerData.filter.transitions.in = rb.transitions.layers.filters.createTransition(
                                                            layerData,
                                                            'in',
                                                            layerData.filter.values.in,
                                                            layerData.filter.values.style
                                                        );
                                                    }

                                                    // ADD TO TIMELINE: slide timeline | set filter properties & start transition @ layerData.timeline.transitioninstart
                                                    _slideTimeline.to( [ { p: 0 }, $layer[0] ], layerData.in.duration,{
                                                        p: 1,
                                                        autoCSS: false,
                                                        ease: layerData.inLayerTo.ease,
                                                        onUpdate: rb.transitions.layers.filters.animate,
                                                        onUpdateParams: [ '{self}', layerData.filter.transitions.in ]
                                                    }, layerData.timeline.transitioninstart );
                                                }else if( !$.isEmptyObject( layerData.filter.values.out ) ){
                                                    $layer.css( 'filter', layerData.original.filter );
                                                }

                                                // ADD TO TIMELINE: slide timeline | set layer properties & start transition @ layerData.timeline.transitioninstart
                                                _slideTimeline.fromTo( $wrapper[0], layerData.in.duration, layerData.inLayerFrom, layerData.inLayerTo, layerData.timeline.transitioninstart );
                                                // ADD TO TIMELINE: slide timeline | set layer style properties & start transition @ layerData.timeline.transitioninstart
                                                _slideTimeline.fromTo( $layer[0], layerData.in.duration, layerData.inLayerStyleFrom, layerData.inLayerStyleTo, layerData.timeline.transitioninstart );
                                            }

                                        // Text transition in

                                            // IF: layer has text transition in or out
                                            if( layerData.is.textLayer ){

                                                if( layerData.textIn.type || layerData.textOut.type ){
                                                    // RESET: nodes
                                                    rb.transitions.layers.splitType.resetNodes( $layer, layerData );
                                                }

                                                if( layerData.textIn.enabled ){

                                                    if( !layerData.in.enabled ){
                                                        // RESET: wrapper element to default | needed for split the layer into lines properly
                                                        // Must be extended because of default transform properties
                                                        _slideTimeline.to( $wrapper[0], 0, $.extend( true, {}, layerData.inLayerTo, layerData.init.wrapper ), layerData.timeline.textinstart );
                                                    }

                                                    // SET: nodes sequence
                                                    layerData.textIn.nodes = rb.transitions.layers.splitType.setNodesSequence( layerData.textIn.type.split( '_' ), layerData.textIn.ns );

                                                    // SET: convert x, y & transformOrigin
                                                    rb.resize.transformProperties( $layer, layerData.textInNodesFrom, layerData.textInShouldBeConverted );
                                                    // SET: transformPerspective
                                                    layerData.textInNodesFrom.transformPerspective = layerData.transformPerspective.text * rb.resize.ratio;

                                                    // CALCULATE: random properties for nodes
                                                    if( !$.isEmptyObject( layerData.textInShouldBeConverted.random ) ){
                                                        rb.transitions.layers.splitType.setRandomProperties( layerData, layerData.textInShouldBeConverted.random, layerData.textInNodesFrom );
                                                    }
                                                    if( !$.isEmptyObject( layerData.textInNodesFrom.random ) ){
                                                        rb.transitions.layers.splitType.setRandomProperties( layerData, layerData.textInNodesFrom.random, layerData.textInNodesFrom );
                                                    }
                                                    // Must be removed otherwise GS will drop an error
                                                    delete layerData.textInNodesFrom.random;

                                                    // SET: starting and ending time of split transition in
                                                    if( !layerData.settings.timelineIsCalculated ){
                                                        layerData.timeline.textinstart = this.getTiming( layerData, layerData.textIn.startAt, 'textinstart' );
                                                        layerData.timeline.textinend = layerData.timeline.textinstart + ( layerData.textIn.nodes.length - 1 ) * layerData.textIn.shiftNodes + layerData.textIn.duration;
                                                    }

                                                    // ADD TO TIMELINE: slide timeline | set node properties & start transition in of the first node @ layerData.timeline.textinstart
                                                    _slideTimeline.staggerFromTo( layerData.textIn.nodes, layerData.textIn.duration, layerData.textInNodesFrom, layerData.textInNodesTo, layerData.textIn.shiftNodes, layerData.timeline.textinstart, function( $_layer ){
                                                        rb.transitions.layers.in.onComplete( $_layer );
                                                    }, [ $layer ]);
                                                }
                                            }

                                        // playByScroll keyframe
                                            if( layerData.is.keyframe && rb.o.playByScroll ){

                                                // ADD TO TIMELINE: slide timeline | pause @ layerData.timeline.transitioninend
                                                _slideTimeline.addPause( layerData.timeline.allinend(), function(){
                                                    setTimeout( function(){
                                                        // REMOVE: from rb.timeouts object
                                                        delete rb.timeouts.scroll;

                                                        rb.transitions.layers.timeline.timeScaleModifier = 0;
                                                        rb.device.scroll.timeout = 250;
                                                    }, 500 );
                                                });
                                            }

                                        // Loop transition

                                            if( layerData.loop.enabled ){

                                                var _loopTimeline = new gsap.TimelineMax({
                                                        repeat: layerData.loop.repeat,
                                                        repeatDelay: layerData.loop.repeatDelay,
                                                        yoyo: layerData.loop.yoyo,
                                                        paused: true
                                                    }),
                                                    loopDelay;

                                                // SET: starting and ending time of loop transition
                                                if( !layerData.settings.timelineIsCalculated || layerData.is.static ){
                                                    layerData.timeline.loopstart = this.getTiming( layerData, layerData.loop.startAt, 'loopstart' );
                                                    layerData.timeline.loopend = layerData.loop.count === -1 ? false : layerData.timeline.loopstart + ( layerData.loop.repeat + 1 ) * layerData.loop.duration + layerData.loop.repeat * layerData.loop.repeatDelay;
                                                }

                                                // SAVE: loop timeline into layer data
                                                layerData.loop._timeline = _loopTimeline;

                                                // SET: convert x, y
                                                rb.resize.transformProperties( $layer, layerData.loopToCSS, {
                                                    x: layerData.loopLayerShouldBeConverted.x,
                                                    y: layerData.loopLayerShouldBeConverted.y
                                                });

                                                // IF: loop transition is animating x or y...
                                                if(
                                                    ( layerData.loopToCSS.x && layerData.loopToCSS.x !== 0 ) ||
                                                    ( layerData.loopToCSS.y && layerData.loopToCSS.y !== 0 )
                                                 ){
                                                    // SET: retart slide timeline when resizing
                                                    rb.transitions.layers.timeline.shouldRestart = true;
                                                }

                                                // SET: transformorigin
                                                layerData.loopFromCSS.transformOrigin = rb.functions.convert.transformOrigin( layerData.loopLayerShouldBeConverted.transformOrigin, $layer );
                                                // SET: transformPerspective
                                                layerData.loopFromCSS.transformPerspective = layerData.transformPerspective.loop * rb.resize.ratio;

                                                // IF: any filter property should be animated
                                                if( !$.isEmptyObject( layerData.filter.values.loop ) ){
                                                    // IF: filter transition has not been created
                                                    if( !layerData.filter.transitions.loop ){
                                                        layerData.filter.transitions.loop = rb.transitions.layers.filters.createTransition(
                                                            layerData,
                                                            'loop',
                                                            // IF: ther was a filter in transition, using its ending properties as loop filter starting properties
                                                            !$.isEmptyObject( layerData.filter.values.afterIn ) ? layerData.filter.values.afterIn : layerData.filter.values.style,
                                                            layerData.filter.values.loop
                                                        );
                                                    }

                                                    // ADD TO TIMELINE: loop timeline | set filter properties & start transition @ layerData.timeline.transitioninstart
                                                    _loopTimeline.to( [ { p: 0 }, $layer[0] ], layerData.loop.duration, {
                                                        p: 1,
                                                        autoCSS: false,
                                                        ease: layerData.loopTo.ease,
                                                        onUpdate: rb.transitions.layers.filters.animate,
                                                        onUpdateParams: [ '{self}', layerData.filter.transitions.loop ]
                                                    }, 0 );
                                                }

                                                // ADD TO TIMELINE: loop timeline | loop transition tween
                                                _loopTimeline.fromTo( $loopWrapper[0], layerData.loop.duration, layerData.loopFrom, layerData.loopTo, 0 );

                                                // SET: clip
                                                if( layerData.loopClipShouldBeConverted.clip ){
                                                    // SET: loop clip to
                                                    layerData.loopClipToCSS.clip = rb.resize.clip( $layer, layerData.loopClipShouldBeConverted.clip, true );
                                                    // ADD TO TIMELINE: loop timeline | set clip property & start clip transition @ 0
                                                    _loopTimeline.to( $clipWrapper[0], layerData.loop.duration, layerData.loopClipTo, 0 );

                                                    // SET: retart slide timeline when resizing
                                                    rb.transitions.layers.timeline.shouldRestart = true;
                                                }

                                                // IF: loop has infinite repeats, loop transition will not be added to slide timeline
                                                if( layerData.loop.repeat !== -1 && ( rb.o.pauseOnHover === 'looplayers' || rb.gui.timers.slidebar.$element || rb.o.playByScroll ) ){
                                                    // ADD TO TIMELINE: slide timeline | loop timeline @ layerData.timeline.loopstart
                                                    _slideTimeline.add( _loopTimeline, layerData.timeline.loopstart );
                                                    _loopTimeline.play();
                                                }else{
                                                    // SET: loop timeline play callback function will be fired @ layerData.timeline.loopstart
                                                    _slideTimeline.addCallback( function( _loopTimeline ){ _loopTimeline.play(); }, layerData.timeline.loopstart, [ _loopTimeline ] );
                                                }
                                            }

                                        if( layerData.is.static ){
                                            layerData.timeline.staticfrom = layerData.timeline.transitioninend;
                                            layerData.timeline.staticto = '100%';

                                            // Must be calculated here becaue of static layers
                                            if( !layerData.settings.timelineIsCalculated ){
                                                totalLayerDuration = Math.max( layerData.timeline.allinandloopend(), 0 );
                                                this.totalDuration = Math.max( this.totalDuration, totalLayerDuration );
                                            }
                                        }

                                    break;

                                    case 'out':

                                        // Text transition out
                                            if( layerData.is.textLayer && layerData.textOut.enabled ){

                                                // SET: nodes sequence
                                                layerData.textOut.nodes = rb.transitions.layers.splitType.setNodesSequence( layerData.textOut.type.split( '_' ), layerData.textOut.ns );

                                                // SET: convert x, y, transformOrigin
                                                rb.resize.transformProperties( $layer, layerData.textOutNodesTo, layerData.textOutShouldBeConverted, layerData.textOutNodesFrom );
                                                // SET: transformPerspective
                                                layerData.textOutNodesFrom.transformPerspective = layerData.transformPerspective.text * rb.resize.ratio;

                                                // CALCULATE: random properties for nodes
                                                if( !$.isEmptyObject( layerData.textOutShouldBeConverted.random ) ){
                                                    rb.transitions.layers.splitType.setRandomProperties( layerData, layerData.textOutShouldBeConverted.random, layerData.textOutNodesTo );
                                                }
                                                if( !$.isEmptyObject( layerData.textOutNodesTo.random ) ){
                                                    rb.transitions.layers.splitType.setRandomProperties( layerData, layerData.textOutNodesTo.random, layerData.textOutNodesTo );
                                                }
                                                // Must be removed otherwise GS will drop an error
                                                delete layerData.textOutNodesTo.random;

                                                // SET: starting and ending time of (not forced) split out
                                                if( !layerData.settings.timelineIsCalculated ){
                                                    layerData.timeline.textoutstart = this.getTiming( layerData, layerData.textOut.startAt, 'textoutstart' );
                                                    layerData.timeline.textoutend = layerData.timeline.textoutstart + ( layerData.textOut.nodes.length - 1 ) * layerData.textOut.shiftNodes + layerData.textOut.duration;
                                                }

                                                // IF: clip property should be animated
                                                if( layerData.clip.enabled ){

                                                    if( typeof layerData.outClipShouldBeConverted.clip === 'undefined' ){
                                                        // ADD TO TIMELINE: slide timeline | set clip property & start clip transition @ layerData.timeline.transitionoutstart
                                                        _slideTimeline.to( $clipWrapper[0], 0, { immediateRender: false, css: { clip: rb.resize.clip( $layer, layerData.clip.max ) } }, layerData.timeline.textoutstart );
                                                    }
                                                    // SET: retart slide timeline when resizing
                                                    rb.transitions.layers.timeline.shouldRestart = true;
                                                }

                                                // ADD TO TIMELINE: slide timeline | set node properties & start transition out of the first node @ layerData.timeline.textoutstart
                                                _slideTimeline.staggerFromTo( layerData.textOut.nodes, layerData.textOut.duration, layerData.textOutNodesFrom, layerData.textOutNodesTo, layerData.textOut.shiftNodes, layerData.timeline.textoutstart );
                                            }

                                        // Transition out

                                            // SET: convert x, y & transformOrigin
                                            rb.resize.transformProperties( $layer, layerData.outLayerToCSS, layerData.outLayerShouldBeConverted, layerData.outLayerFromCSS );
                                            // SET: convert width, height, borderRadius
                                            rb.resize.styleProperties( layerData.outLayerStyleFromCSS, layerData.outLayerStyleShouldBeConvertedFrom );
                                            rb.resize.styleProperties( layerData.outLayerStyleToCSS, layerData.outLayerStyleShouldBeConvertedTo );
                                            // SET: transformPerspective
                                            layerData.outLayerFromCSS.transformPerspective = layerData.transformPerspective.layer * rb.resize.ratio;

                                            // Only layers with showuntil will be added to the normal slider timeline,
                                            // any other layers will be added to the forceLayersOut timeline

                                            if( layerData.out.startAt !== 'slidechangeonly' ){

                                                // SET: starting and ending time of (not forced) transition out > layers with showUntil
                                                // IF: layer is static, ignorig negative values of showUntil
                                                if( !layerData.settings.timelineIsCalculated || layerData.is.static ){
                                                    if( layerData.is.static ){
                                                        layerData.timeline.staticfrom = 0;
                                                        layerData.timeline.transitionoutstart = this.getTiming( layerData, layerData.out.startAt, 'transitionoutstart', true );
                                                        layerData.timeline.staticto = layerData.timeline.transitionoutstart;
                                                    }else{
                                                        layerData.timeline.transitionoutstart = Math.max( this.getTiming( layerData, layerData.out.startAt, 'transitionoutstart' ), layerData.timeline.transitioninend );
                                                    }
                                                    layerData.timeline.transitionoutend = layerData.timeline.transitionoutstart + layerData.out.duration;
                                                }

                                                // IF: clip property should be animated
                                                if( layerData.clip.enabled ){

                                                    if( typeof layerData.outClipShouldBeConverted.clip === 'undefined' ){
                                                        // ADD TO TIMELINE: slide timeline | set clip property & start clip transition @ layerData.timeline.transitionoutstart
                                                        _slideTimeline.to( $clipWrapper[0], 0, { immediateRender: false, css: { clip: rb.resize.clip( $layer, layerData.clip.max ) } }, layerData.timeline.transitionoutstart );
                                                    }else{
                                                        // SET: clip to
                                                        layerData.outClipToCSS.clip = rb.resize.clip( $layer, layerData.outClipShouldBeConverted.clip, true );
                                                        // ADD TO TIMELINE: slide timeline | set clip property & start clip transition @ layerData.timeline.transitionoutstart
                                                        _slideTimeline.to( $clipWrapper[0], layerData.out.duration, layerData.outClipTo, layerData.timeline.transitionoutstart );
                                                    }

                                                    // SET: retart slide timeline when resizing
                                                    rb.transitions.layers.timeline.shouldRestart = true;
                                                }

                                                // IF: any filter property should be animated
                                                if( !$.isEmptyObject( layerData.filter.values.out ) ){
                                                    // IF: filter transition has not been created
                                                    if( !layerData.filter.transitions.out ){
                                                        layerData.filter.transitions.out = rb.transitions.layers.filters.createTransition(
                                                            layerData,
                                                            'out',
                                                            // IF: ther was a filter in transition or a loop filter tranition, using their ending properties as filter out starting properties
                                                            !$.isEmptyObject( layerData.filter.values.afterLoop ) ? layerData.filter.values.afterLoop : (
                                                            !$.isEmptyObject( layerData.filter.values.afterIn ) ? layerData.filter.values.afterIn :
                                                            layerData.filter.values.style ),
                                                            layerData.filter.values.out
                                                        );
                                                    }
                                                    // ADD TO TIMELINE: slide timeline | set filter properties & start transition @ layerData.timeline.transitioninstart
                                                    _slideTimeline.to( [ { p: 0 }, $layer[0] ], layerData.out.duration, {
                                                        p: 1,
                                                        autoCSS: false,
                                                        ease: layerData.outLayerTo.ease,
                                                        onUpdate: rb.transitions.layers.filters.animate,
                                                        onUpdateParams: [ '{self}', layerData.filter.transitions.out ]
                                                    }, layerData.timeline.transitionoutstart );
                                                }

                                                // ADD TO TIMELINE: slide timeline | set wrapper properties & start transition out @ layerData.timeline.transitionoutstart
                                                _slideTimeline.fromTo( $wrapper[0], layerData.out.duration, layerData.outLayerFrom, layerData.outLayerTo, layerData.timeline.transitionoutstart );
                                                // ADD TO TIMELINE: slide timeline | set layer properties & start transition out @ layerData.timeline.transitionoutstart
                                                _slideTimeline.fromTo( $layer[0], layerData.out.duration, layerData.outLayerStyleFrom, layerData.outLayerStyleTo, layerData.timeline.transitionoutstart );
                                                // ADD TO TIMELINE: slide timeline | reset wrapper @ layerData.timeline.transitionoutend
                                                _slideTimeline.fromTo( $wrapper[0], 0, layerData.init.wrapper, layerData.reset.wrapperOnTimelineEnd, layerData.timeline.transitionoutend );
                                            }else{
                                                layerData.timeline.staticfrom = 0;
                                                layerData.timeline.staticto = '100%';
                                            }

                                            if( !layerData.is.static || ( layerData.is.static && layerData.settings.slideOut === rb.slides.next.index ) ){

                                                // ADD TO TIMELINE: slide timeline | set wrapper properties & start transition out @ 0
                                                _forceLayersOut.fromTo( $wrapper[0], rb.o.forceLayersOutDuration, layerData.outLayerFrom, layerData.outLayerTo, 0 );
                                                // ADD TO TIMELINE: slide timeline | set layer properties & start transition out @ 0
                                                _forceLayersOut.fromTo( $layer[0], rb.o.forceLayersOutDuration, layerData.outLayerStyleFrom, layerData.outLayerStyleTo, 0 );

                                                // IF: clip property should be animated
                                                if( layerData.clip.enabled && typeof layerData.outClipShouldBeConverted.clip !== 'undefined' ){
                                                    // SET: clip to
                                                    layerData.outClipToCSS.clip = rb.resize.clip( $layer, layerData.outClipShouldBeConverted.clip, true );
                                                    // ADD TO TIMELINE: slide timeline | set clip property & start clip transition @ 0
                                                    _forceLayersOut.to( $clipWrapper[0], rb.o.forceLayersOutDuration, layerData.outClipTo, 0 );
                                                }
                                            }

                                        totalLayerDuration = Math.max( layerData.timeline.alloutandloopend(), 0 );
                                        this.totalDuration = Math.max( this.totalDuration, totalLayerDuration );
                                        layerData.settings.timelineIsCalculated = true;

                                    break;
                                }
                            }
                        }
                    },

                    play: function(){

                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.play();
                            // SET: timeline states
                            rb.functions.setStates( this, {
                                started: true,
                                running: true,
                                stopped: false,
                                paused: false
                            });
                        }
                    },

                    pause: function( duration ){

                        var duration = $.isNumeric( duration ) ? duration : 0.75;

                        if( rb.transitions._slideTimeline ){
                            gsap.TweenMax.to( rb.transitions._slideTimeline, duration, { timeScale: 0 });
                            // SET: timeline states
                            rb.functions.setStates( this, {
                                paused: true,
                                stopped: false
                            });
                        }
                    },

                    resume: function(){

                        if( rb.transitions._slideTimeline ){
                            gsap.TweenMax.to( rb.transitions._slideTimeline, 0.75, { timeScale: 1 });
                            // SET: timeline states
                            rb.functions.setStates( this, {
                                paused: false,
                                stopped: false
                            });
                        }
                    },

                    reverse: function(){

                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.reverse();
                        }
                    },

                    scrollForward: function( skipSlideBreaks ){

                        if( !skipSlideBreaks ){
                            this.play();
                            this.modifyTimeScale();
                        }

                        if( rb.transitions._slideTimeline ){

                            if( !rb.slider.isBusy() && ( rb.transitions._slideTimeline.totalDuration() === 0 || rb.transitions._slideTimeline.progress() === 1 ) && rb.device.scroll.direction === 'down' ){

                                rb.slideshow.direction = 'next';

                                var sequence = rb.slideshow.sequence.normalized,
                                    curSlideInSequence = sequence.indexOf(rb.slides.current.index);

                                // IF: this is the last slide of the slider
                                if( curSlideInSequence === sequence.length - 1 ){
                                    rb.slider.positionToViewport = 'under';
                                    rb.device.scroll.enable();
                                    rb.slideshow.direction = 'prev';
                                }else{
                                    rb.navigation.next();
                                }
                            }
                        }
                    },

                    scrollBackwards: function( skipSlideBreaks, forceStartReversedTimeline ){

                        if( !skipSlideBreaks || forceStartReversedTimeline ){
                            this.reverse();
                            this.modifyTimeScale();
                        }

                        if( rb.transitions._slideTimeline ){

                            if( !rb.slider.isBusy() && ( rb.transitions._slideTimeline.totalDuration() === 0 || rb.transitions._slideTimeline.progress() === 0 ) && rb.device.scroll.direction === 'up' ){

                                rb.slideshow.direction = 'prev';

                                var sequence = rb.slideshow.sequence.normalized,
                                    curSlideInSequence = sequence.indexOf(rb.slides.current.index);

                                // IF: this is the last slide of the slider
                                if( curSlideInSequence === 0 ){
                                    rb.slider.positionToViewport = 'over';
                                    rb.device.scroll.enable();
                                    rb.slideshow.direction = 'next';
                                }else{
                                    rb.navigation.prev();
                                }
                            }
                        }
                    },

                    modifyTimeScale: function(){

                        if( rb.transitions._slideTimeline ){
                            var self = this;
                            gsap.TweenMax.to( rb.transitions._slideTimeline, 0.25, { timeScale: 1 + self.timeScaleModifier } );
                        }
                    },

                    resetStates: function(){

                        this.state = {
                            started: false,
                            running: false,
                            paused: false,
                            stopped: false,
                            finished: false
                        };
                    }
                },

                hover: {

                    enable: function( $layer ){

                        $layer.attr( 'data-rb-canhover', '1' );
                    },

                    disable: function( $layer ){

                        $layer.attr( 'data-rb-canhover', '0' );
                    },

                    set: function( $layer, layerData ){

                        layerData.elements.$wrapper.on( 'mouseenter.' + sliderUID, function(){
                            rb.transitions.layers.hover.mouseEnter( $layer, layerData );
                        });
                        layerData.elements.$wrapper.on( 'mouseleave.' + sliderUID, function(){
                            rb.transitions.layers.hover.mouseLeave( $layer, layerData );
                        });
                        layerData.elements.$wrapper.on( 'mousemove.' + sliderUID, function(){
                            rb.transitions.layers.hover.mouseMove( $layer, layerData );
                        });
                    },

                    createTimeline: function( $layer, layerData ){

                        layerData.hover._timeline = new gsap.TimelineMax({
                            paused: true,
                            onReverseComplete: function( $_layer, _layerData ){
                                if( _layerData.hover._timeline._reversed ){
                                    _layerData.hover._timeline.stop().clear();
                                    delete _layerData.hover._timeline;
                                }
                            },
                            onReverseCompleteParams: [$layer,layerData]
                        });

                        // SET: convert x, y, transformOrigin
                        rb.resize.transformProperties( $layer, layerData.hoverToCSS, layerData.hoverShouldBeConverted, layerData.hoverFromCSS );
                        // SET: convert width, height, borderRadius
                        rb.resize.styleProperties( layerData.hoverToCSS, layerData.hoverShouldBeConverted );
                        // SET: transformPerspective
                        layerData.hoverFromCSS.transformPerspective = layerData.transformPerspective.hover * rb.resize.ratio;

                        // CREATE: hover tween
                        layerData.hover._tween = gsap.TweenMax.fromTo( $layer[0], layerData.hover.durationIn, layerData.hoverFrom, layerData.hoverTo );

                        // ADD TO TIMELINE: hover timeline | hover tween @ 0
                        layerData.hover._timeline.add( layerData.hover._tween, 0 );

                        if( $layer.next().is('.rb-layer-link') ){

                            var $link = $layer.next(),
                                linkHoverFrom = $.extend( true, {}, layerData.hoverFrom, {
                                    css: {
                                        opacity: 1,
                                        color: 'transparent',
                                        background: 'transparent',
                                        z: 0
                                    }
                                }),
                                linkHoverTo = $.extend( true, {}, layerData.hoverTo, {
                                    css: {
                                        opacity: 1,
                                        color: 'transparent',
                                        background: 'transparent',
                                        z: 0
                                    }
                                });

                                layerData.hover._linkTween = gsap.TweenMax.fromTo( $link[0], layerData.hover.durationIn, linkHoverFrom, linkHoverTo );
                                layerData.hover._timeline.add( layerData.hover._linkTween, 0 );
                        }else{
                            layerData.hover._linkTween = null;
                        }

                        // IF: layer should stay always on top while hovering...
                        if( layerData.hover.alwaysOnTop ){

                            var wrapperCSS = {
                                zIndex: 9999
                            };

                            if( rb.browser.isSafari ){
                                wrapperCSS.transform = 'translateZ(999999px)';
                            }

                            // ADDT TO TIMELINE: hover timeline | outer wrapper element @ 0
                            layerData.hover._timeline.to( layerData.elements.$outerWrapper[0], layerData.hover.durationIn, {
                                autoCSS: false,
                                css: wrapperCSS
                            }, 0 );
                        }

                        layerData.hover.reverseTimeScale = layerData.hover.durationIn / layerData.hover.durationOut === 1 ? 1 : layerData.hover.durationIn / layerData.hover.durationOut;

                        this.hoverIn( $layer, layerData );
                    },

                    mouseEnter: function( $layer, layerData ){

                        if( $layer.attr( 'data-rb-canhover' ) === '1' ){

                            $layer.attr( 'data-rb-hovered', 1 );

                            layerData.elements.$wrapper.off( 'mousemove.' + sliderUID );

                            if( !layerData.hover._timeline ){
                                this.createTimeline( $layer, layerData );

                            }else{
                                // Must be called in this way because timeline._reversed should switched to false state
                                layerData.hover._timeline.play().stop().progress( 0 );
                                this.hoverIn( $layer, layerData );
                            }
                        }
                    },

                    mouseLeave: function( $layer, layerData ){

                        if( layerData.hover._timeline ){
                            layerData.hover._timeline.stop().progress( 1 );
                            this.hoverOut( $layer, layerData );
                        }

                        $layer.removeAttr( 'data-rb-hovered' );
                    },

                    mouseMove: function( $layer, layerData ){

                        if( !$layer.attr( 'data-rb-hovered' ) ){
                            this.mouseEnter( $layer, layerData );
                        }
                    },

                    hoverIn: function( $layer, layerData ){

                        // UPDATE: easing to normal hover easing
                        layerData.hover._tween.updateTo({
                            ease: layerData.hover.easeIn
                        });

                        if( layerData.hover._linkTween ){
                            layerData.hover._linkTween.updateTo({
                                ease: layerData.hover.easeIn
                            });
                        }

                        // ANIMATE: hover
                        layerData.hover._timeline.play().timeScale( 1 );
                    },

                    hoverOut: function( $layer, layerData ){

                        // UPDATE: easing to reversed hover easing
                        layerData.hover._tween.updateTo({
                            ease: layerData.hover.easeOut
                        });

                        if( layerData.hover._linkTween ){
                            layerData.hover._linkTween.updateTo({
                                ease: layerData.hover.easeOut
                            });
                        }

                        // ANIMATE: hover
                        layerData.hover._timeline.reverse().timeScale( layerData.hover.reverseTimeScale );
                    }
                },

                parallax: {

                    defaultProperties: {
                        type: '2d',
                        'event': 'cursor',
                        x: true,
                        y: true,
                        rotation: 10,
                        distance: 10,
                        durationMove: 1.5,
                        durationLeave: 1.2,
                        transformOrigin: '50% 50% 0',
                        transformPerspective: 500
                    },

                    defaults: {
                        scrollModifier: 5,
                        centerLayers: 'center',
                        centerDegree: 40,
                        sensitive: 10
                    },

                    state: {
                        enabled: false,
                        ready: false
                    },

                    wrappers: {
                        cursor: {
                            $2d: $(),
                            $3d: $()
                        },
                        scroll: {
                            $2d: $(),
                            $3d: $()
                        }
                    },

                    init: function(){

                        var self = this;

                        // SET: functions
                        $slider.on( 'mouseenter.' + sliderUID, function(){
                            if( self.wrappers.cursor.$2d.length || self.wrappers.cursor.$3d.length ){
                                self.calculateTransformProperties();
                            }
                        });

                        $slider.on( 'mousemove.' + sliderUID, function( e ){
                            if( self.wrappers.cursor.$2d.length || self.wrappers.cursor.$3d.length ){
                                self.mouseMove( e );
                            }
                        });

                        $slider.on( 'mouseleave.' + sliderUID, function(){
                            if( self.wrappers.cursor.$2d.length || self.wrappers.cursor.$3d.length ){
                                self.reset();
                            }
                        });

                        // IF dvice is mobile and supports orientation
                        if( rb.device.isMobile && rb.device.supportOrientation ){
                            // ADD: event for turning mobile device
                            $( window ).on( 'deviceorientation.' + sliderUID, function(){
                                if( self.state.ready ){
                                    self.deviceTurn( event );
                                }
                            });
                            // ADD: event for change mobile devce orientation | must recalculate transformorigin & transformperspective
                            $( window ).on( 'orientationchange.' + sliderUID, function(){
                                self.calculateTransformProperties();
                            });
                        }

                        $( window ).on( 'scroll.parallax' + sliderUID + ' touchmove.parallax' + sliderUID, function(){
                            if( self.wrappers.scroll.$2d.length || self.wrappers.scroll.$3d.length ){
                                self.scroll();
                            }
                        });

                        // SET: parallax scroll direction
                        self.defaults.scrollModifier *= rb.o.parallaxScrollReverse ? -1 : 1;
                    },

                    addLayer: function( $parallaxWrapper, parallaxData, layerData, slideIndex ){

                        // SET: self state to enabled if there is a parallax layer in the slider
                        if( !this.state.enabled ){
                            // SET: parallax state
                            rb.functions.setStates( this, {
                                enabled: true
                            });
                            this.init();
                        }

                        // SET: parallax data by extending global slide parallax properties with local layer parallax properties
                        $.extend( true, parallaxData, this.defaultProperties, rb.slides[slideIndex].parallax, layerData.parallax );
                        // UPDATE: transformPerspective property from / or to layer data
                        if( layerData.transformPerspective.parallax ){
                            parallaxData.transformPerspective = layerData.transformPerspective.parallax;
                        }else{
                            layerData.transformPerspective.parallax = parallaxData.transformPerspective;
                        }

                        if( !parallaxData['event'].match(/(cursor|scroll)/) ){
                            parallaxData['event'] = 'cursor';
                        }

                        if( !!parallaxData.type.match(/(2d,3d)/) ){
                            parallaxData.type = '2d';
                        }

                        switch( parallaxData.axis ){
                            case 'none':
                                parallaxData.x = false;
                                parallaxData.y = false;
                            break;
                            case 'x':
                                parallaxData.y = false;
                            break;
                            case 'y':
                                parallaxData.x = false;
                            break;
                        }

                        // SAVE: wrapper element
                        this.wrappers[parallaxData['event']]['$'+parallaxData.type] = this.wrappers[parallaxData['event']]['$'+parallaxData.type].add( $parallaxWrapper );
                    },

                    addShadow: function(){

                        var $shadow = rb.gui.shadow.$element,
                            curNext = rb.slides.current && rb.slides.current.parallax ? rb.slides.current.index : rb.slides.next.index;

                        // IF: the slide background has parallaxlevel property & the slide has overflow visible property
                        if(
                            rb.slides[curNext].data.$background &&
                            rb.slides[curNext].data.$background.data( rb.defaults.init.dataKey ).parallax.enabled &&
                            ( !!rb.slides[curNext].data.overflow && rb.slides[curNext].data.overflow !== 'hidden' )
                        ){

                            // SET: transformorigin and rotation
                            var tOrigin = '50% -' + ( rb.slider.height * 0.25 ) + 'px 0',
                                parallaxData = rb.slides[curNext].data.$background.data( rb.defaults.init.dataKey ).parallax,
                                rotation;

                                // SET: rotation to double as the slide background (or slider) to achieve 3D effect
                                if( typeof parallaxData.rotation !== 'undefined' ){
                                    rotation = parallaxData.rotation * 2;
                                }else if( typeof rb.slides[curNext].parallax.rotation !== 'undefined' ){
                                    rotation = rb.slides[curNext].parallax.rotation * 2;
                                }else{
                                    rotation = this.defaultProperties.rotation * 2;
                                }

                            $shadow.data( rb.defaults.init.dataKey, { parallax: ( $.extend( true, {}, this.defaultProperties, rb.slides[curNext].parallax, {
                                level: parallaxData.level,
                                transformOrigin: tOrigin,
                                rotation: rotation,
                            }))});

                            $shadow.attr( 'data-rb-parallax', 'active' );

                            gsap.TweenMax.set( $shadow[0],{
                                transformOrigin: tOrigin,
                                transformPerspective: $shadow.data( rb.defaults.init.dataKey ).parallax.transformPerspective * rb.resize.ratio
                            });

                            // IF: the slide or the slide background has 3d parallaxtype property
                            if(
                                rb.slides[curNext].parallax.type === '3d' ||
                                parallaxData.type === '3d'
                            ){
                                this.wrappers.cursor.$3d = this.wrappers.cursor.$3d.add( $shadow );
                            }else{
                                this.wrappers.cursor.$2d = this.wrappers.cursor.$2d.add( $shadow );
                            }
                        }

                        this.shadowIsChecked = true;
                    },

                    removeShadow: function(){

                        var $shadow = rb.gui.shadow.$element;

                        // REMOVE: shadow element from both wrappers collection
                        this.wrappers.cursor.$2d = this.wrappers.cursor.$2d.not( $shadow );
                        this.wrappers.cursor.$3d = this.wrappers.cursor.$3d.not( $shadow );

                        $shadow.attr( 'data-rb-parallax', 'disabled' );

                        this.shadowIsChecked = false;
                    },

                    calculateTransformProperties: function(){

                        var $wrappers = $().add( this.wrappers.cursor.$2d ).add( this.wrappers.cursor.$3d ).add( this.wrappers.scroll.$2d ).add( this.wrappers.scroll.$3d );

                        // SET: transition properties of parallax layers
                        $wrappers.each(function(){
                            var parallaxData = $(this).data( rb.defaults.init.dataKey ).parallax;
                            gsap.TweenMax.set( $(this)[0],{
                                transformOrigin: rb.functions.convert.transformOrigin( parallaxData.transformOrigin, $(this), rb.slider.$layersWrapper ),
                                transformPerspective: parallaxData.transformPerspective * rb.resize.ratio
                            });
                        });

                        this.transformPropertiesCalculated = true;
                    },

                    deviceTurn: function( e ){

                        if( this.transformPropertiesCalculated ){

                            // CALCULATE: mobile device orientation & turn
                            var orientation = window.orientation,
                                turnX, turnY;

                            if( orientation === 0 ){
                                turnX = - parseInt( e.gamma ) * 5 * this.defaults.sensitive * rb.resize.ratio;
                                turnY = ( this.defaults.centerDegree - parseInt( e.beta ) ) * 5 * this.defaults.sensitive * rb.resize.ratio ;
                            }else if( orientation === 90 ){
                                turnX = - parseInt( e.beta ) * 5 * this.defaults.sensitive * rb.resize.ratio;
                                turnY = ( parseInt( e.gamma ) + this.defaults.centerDegree ) * 5 * this.defaults.sensitive * rb.resize.ratio ;
                            }else{
                                turnX = parseInt( e.beta ) * 5 * this.defaults.sensitive * rb.resize.ratio;
                                turnY = ( this.defaults.centerDegree - parseInt( e.gamma ) ) * 5 * this.defaults.sensitive * rb.resize.ratio ;
                            }

                            // ANIMATE: parallax elements
                            this.animate2D( turnX, turnY, 'cursor' );
                            this.animate3D( turnX, turnY, 'cursor' );

                        }else{
                            // CALCULATE: transform properties if necessary (after slide change, etc)
                            this.calculateTransformProperties();
                        }

                        // IF: slider has shadow and slider is currently not changing slides,
                        // shadow element will be checked and maybe added to one of the wrappers array
                        if( !rb.slider.state.animatingSlides && !this.shadowIsChecked && rb.gui.shadow.$element ){
                            this.addShadow();
                        }
                    },

                    trigger: function(){
                        $( window ).trigger( 'scroll.parallax' + sliderUID );
                        $( window ).trigger( 'touchmove.parallax' + sliderUID );
                    },

                    scroll: function(){

                        var center = this.defaults.centerLayers === 'top' ? rb.device.winScrollTop : rb.device.winScrollTop + ( rb.device.viewportHeight - rb.slider.height ) / 2,
                            y = ( center - rb.slider.offsetTop ) * rb.resize.ratio * this.defaults.scrollModifier;

                        // DISABLE: parallax scroll in fullscreen mode
                        if( rb.slider.state.inFullscreen ){ y = 0; }

                        // SET: transform origins, etc.
                        if( !this.transformPropertiesCalculated ){
                            this.calculateTransformProperties();
                        }

                        this.animate2D( 0, y, 'scroll' );
                        this.animate3D( 0, y, 'scroll' );
                    },

                    mouseMove: function( e ){

                        if( this.transformPropertiesCalculated ){

                            // IF: slider has shadow and slider is currently not changing slides,
                            // shadow element will be checked and maybe added to one of the wrappers array
                            if( !rb.slider.state.animatingSlides && !this.shadowIsChecked && rb.gui.shadow.$element ){
                                this.addShadow();
                            }

                            // CALCULATE: X and Y mouse movement
                            var self = this,
                                mX0 = rb.slider.offsetLeft + rb.slider.width / 2,
                                mY0 = rb.slider.offsetTop + rb.slider.height / 2,
                                mX = e.pageX - mX0,
                                mY = e.pageY - mY0;

                            // ANIMATE: parallax elements
                            this.animate2D( mX, mY, 'cursor' );
                            this.animate3D( mX, mY, 'cursor' );

                        }else{
                            // CALCULATE: transform properties if necessary (after slide change, etc)
                            this.calculateTransformProperties();
                        }
                    },

                    animate2D: function( axisX, axisY, eventName ){

                        this.wrappers[eventName].$2d.each(function(){

                            var $wrapper = $(this);

                            if( $wrapper.attr( 'data-rb-parallax' ) === 'active' ){

                                var parallaxData = $wrapper.data( rb.defaults.init.dataKey ).parallax,
                                    _x = parallaxData.x ? -axisX * ( parallaxData.distance / 2000 ) * parseInt( parallaxData.level ) : 0,
                                    _y = parallaxData.y ? -axisY * ( parallaxData.distance / 2000 ) * parseInt( parallaxData.level ) : 0;

                                // ANIMATE: 2D parallax wrappers by mouse move
                                gsap.TweenMax.to( $wrapper[0], parallaxData.durationMove, {
                                    x: _x,
                                    y: _y
                                });
                            }
                        });
                    },

                    animate3D: function( axisX, axisY, eventName ){

                        this.wrappers[eventName].$3d.each(function(){

                            var $wrapper = $(this);

                            if( $wrapper.attr( 'data-rb-parallax' ) === 'active' ){

                                var parallaxData = $wrapper.data( rb.defaults.init.dataKey ).parallax,
                                    _rotationX,
                                    _rotationY,
                                    _x,
                                    _y;

                                if( parallaxData.x ){
                                    _rotationY = -axisX / ( 4000 / parallaxData.rotation );
                                    _x = -axisX * ( parallaxData.distance / 2000 ) * parseInt( parallaxData.level );
                                }else{
                                    _rotationY = 0;
                                    _x = 0;
                                }

                                if( parallaxData.y ){
                                    _rotationX = axisY / ( 4000 / parallaxData.rotation );
                                    _y = -axisY * ( parallaxData.distance / 2000 ) * parseInt( parallaxData.level );
                                }else{
                                    _rotationX = 0;
                                    _y = 0;
                                }

                                // ANIMATE: 3D parallax wrappers by mouse move
                                gsap.TweenMax.to( $wrapper[0], parallaxData.durationMove, {
                                    rotationX: _rotationX,
                                    rotationY: _rotationY,
                                    x: _x,
                                    y: _y
                                });
                            }
                        });
                    },

                    reset: function(){

                        var self = this,
                            wrappers = $().add( this.wrappers.cursor.$2d ).add( this.wrappers.cursor.$3d );

                        // GET: parallax wrappers
                        wrappers.each(function(){

                            var $wrapper = $(this);

                            if( $wrapper.attr( 'data-rb-parallax' ) === 'active' ){

                                // ANIMATE: parallax wrappers to their default positions
                                gsap.TweenMax.to( $wrapper[0], $(this).data( rb.defaults.init.dataKey ).parallax.durationLeave, {
                                    x : 0,
                                    y : 0,
                                    rotationX : 0,
                                    rotationY : 0
                                });

                            }else{

                                // SET: not active parallax wrappers to their default positions (on not active slides)
                                gsap.TweenMax.set( $wrapper[0], {
                                    x : 0,
                                    y : 0,
                                    rotationX : 0,
                                    rotationY : 0
                                });
                            }
                        });

                        // IF: slider has shadow, we must remove it from both of the wrappers collections
                        if( rb.gui.shadow.$element ){
                            this.removeShadow();
                        }

                        this.transformPropertiesCalculated = false;
                    }
                },

                filters: {

                    createTransition: function( layerData, type, from, to ){

                        var defaults = new rb.defaults.layer.properties.filter(),
                            filters = {},
                            propertyName;

                        for( propertyName in defaults ){

                            switch( type ){

                                case 'in':

                                    filters[propertyName] = [defaults[propertyName],defaults[propertyName]];
                                    filters[propertyName][0] = from.hasOwnProperty( propertyName ) ? from[propertyName] : ( to.hasOwnProperty( propertyName ) ? to[propertyName] : defaults[propertyName] );
                                    filters[propertyName][1] = to.hasOwnProperty( propertyName ) ? to[propertyName] : defaults[propertyName];

                                    // FILL: layerData.filter.values.afterIn with all filter properties for using as from object in loop filter
                                    layerData.filter.values.afterIn[propertyName] = filters[propertyName][1];

                                break;

                                case 'hover':
                                case 'loop':
                                case 'out':

                                    filters[propertyName] = [];
                                    filters[propertyName][0] = from.hasOwnProperty( propertyName ) ? from[propertyName] : defaults[propertyName];
                                    filters[propertyName][1] = to.hasOwnProperty( propertyName ) ? to[propertyName] : ( from.hasOwnProperty( propertyName ) && from[propertyName] !== defaults[propertyName] ? from[propertyName] : defaults[propertyName] );

                                    if( type === 'loop' && layerData.loop.yoyo !== true && layerData.loop.count !== -1 ){
                                        // FILL: layerData.filter.values.afterLoop with all filter properties for using as from object in out filter
                                        layerData.filter.values.afterLoop[propertyName] = filters[propertyName][1];
                                    }

                                break;

                                case 'bg':

                                    filters[propertyName] = [ defaults[propertyName], defaults[propertyName] ];
                                    if( from.hasOwnProperty( propertyName ) ){
                                        filters[propertyName][0] = from[propertyName];
                                    }
                                    if( to.hasOwnProperty( propertyName ) ){
                                        filters[propertyName][1] = to[propertyName];
                                    }

                                break;
                            }
                        }

                        return filters;
                    },

                    convert: function( cssFilterList ){

                        cssFilterList = cssFilterList.split( ' ' );

                        var filters = {},
                            propertyName,
                            propertyValue,
                            split,
                            appliedFilters = /(blur|brightness|contrast|grayscale|hue-rotate|invert|saturate|sepia)/i;

                            for( var f=0, fl=cssFilterList.length; f<fl; f++ ){
                                split = cssFilterList[f].split( '(' );
                                propertyName = split[0];
                                if( propertyName.match(appliedFilters) ){
                                    propertyValue = parseInt( split[1] );
                                    filters[propertyName] = propertyValue;
                                }
                            }

                        return filters;
                    },

                    animate: function( tween, filters ){

                        var progress = tween.target[0].p * 100,
                            filterValue;

                        if( typeof filters === 'object' ){

                            var calculatedFilters = '';

                            for( var propertyName in filters ){
                                if( typeof filters[propertyName] === 'object' && filters[propertyName].length === 2 ){

                                    switch( propertyName ){

                                        case 'blur':
                                            if ( filters[propertyName][0] < filters[propertyName][1] ){
                                                filterValue = filters[propertyName][0] + Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }else {
                                                filterValue = filters[propertyName][0] - Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }
                                            calculatedFilters += ' blur( ' + filterValue + 'px' + ' )';
                                        break;

                                        case 'hue-rotate':
                                            if ( filters[propertyName][0] < filters[propertyName][1] ){
                                                filterValue = filters[propertyName][0] + Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }else {
                                                filterValue = filters[propertyName][0] - Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }
                                            calculatedFilters += ' hue-rotate( ' + filterValue + 'deg' + ' )';
                                        break;

                                        default:
                                            if ( filters[propertyName][0] < filters[propertyName][1] ){
                                                filterValue = filters[propertyName][0] + Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }else {
                                                filterValue = filters[propertyName][0] - Math.abs( filters[propertyName][0] - filters[propertyName][1] ) / 100 * progress;
                                            }
                                            calculatedFilters += ' ' + propertyName + '( ' + filterValue + '%' + ' )';
                                        break;
                                    }
                                }
                            }

                            gsap.TweenMax.set( tween.target, { '-webkit-filter': calculatedFilters, 'filter': calculatedFilters } );
                        }
                    }
                },

                splitType: {

                    setNodesSequence: function( splitType, ns ){

                        var nodes = ns;

                        if( splitType[1] == 'desc' ){
                            nodes = ns.slice(0).reverse();
                        }else if( splitType[1] == 'rand' ){
                            nodes = ns.slice(0).sort(
                                function(){
                                    return 0.5 - Math.random();
                                }
                            );
                        }else if( splitType[1] == 'center' ){
                            var i, c = Math.floor( ns.length / 2 );
                            nodes = [ns[c]];
                            for( i = 1; i <= c; i++ ){
                                nodes.push( ns[c - i], ns[c + i] );
                            }
                            nodes.length = ns.length;
                        }else if( splitType[1] == 'edge' ){
                            var j,
                                d = Math.floor( ns.length / 2 );
                            nodes = [ns[0]];
                            for( j = 1; j <= d; j++ ){
                                nodes.push( ns[ns.length - j], ns[j] );
                            }
                            nodes.length = ns.length;
                        }

                        return nodes;
                    },

                    resetNodes: function( $layer, layerData ){
                        $( '.char, .word, .line', $layer ).add( layerData.elements.$wrapper ).css({
                            transform: 'none',
                            opacity: 1
                        }).each( function(){
                            delete this._gsTransform;
                        });
                    },

                    setRandomProperties: function( layerData, source, target ){

                        for( var rKey in source ){
                            var propCycle = [];
                            for( var rIndex=0, rLength=layerData.textIn.nodes.length; rIndex < rLength; rIndex++ ){
                                propCycle[rIndex] = rb.functions.convert.randomProperties( source[rKey], rKey );
                            }
                            delete target[rKey];
                            target.cycle[rKey] = propCycle;
                        }

                        source = null;
                    }
                }
            },

            media: {

                // DEFAULTS: transition properties of video preview images
                defaults: {

                    delay: 500,
                    fadeIn: 500,
                    fadeOut: 750
                },

                changeBackgroundVideo: function( firstSlide, forceTransition ){

                    if( rb.slides.current.index && rb.slides.current.data.$backgroundVideo.length ){

                        var $curBGVideo = rb.slides.current.data.$backgroundVideo,
                            $curBGWrapper = $curBGVideo.data( rb.defaults.init.dataKey ).elements.$bgWrapper;

                        if( forceTransition ){

                            $curBGVideo.data( rb.defaults.init.dataKey ).mediaProperties.willBePaused = true;
                            $curBGWrapper.fadeOut( rb.transitions.media.defaults.fadeOut, function(){
                                $curBGVideo.trigger( 'stopBackgroundVideo' );
                                $curBGVideo.data( rb.defaults.init.dataKey ).mediaProperties.willBePaused = false;
                            });
                        }
                    }

                    if( rb.slides.next.data.$backgroundVideo.length ){

                        var $nextBGVideo = rb.slides.next.data.$backgroundVideo,
                            $nextBGWrapper = $nextBGVideo.data( rb.defaults.init.dataKey ).elements.$bgWrapper,
                            $nextBGOuterWrapper = $nextBGVideo.data( rb.defaults.init.dataKey ).elements.$bgOuterWrapper

                        // IF: background video is hidden on a mobile phone or tablet
                        if(
                            rb.device.isMobile &&
                            (
                                ( $slider.hasClass( 'rb-device-is-phone' ) && $nextBGOuterWrapper.hasClass( 'rb-hide-on-phone' ) ) ||
                                ( $slider.hasClass( 'rb-device-is-tablet' ) && $nextBGOuterWrapper.hasClass( 'rb-hide-on-tablet' ) )
                            )
                        ){
                            // do NOT play background video
                        }else{
                            setTimeout( function(){
                                $nextBGVideo.trigger( 'playBackgroundVideo' );
                            }, firstSlide ? 50 : 0 );
                        }

                        if( firstSlide || forceTransition ){
                            $nextBGWrapper.fadeIn( rb.transitions.media.defaults.fadeOut );
                        }else{
                            $nextBGWrapper.css({
                                display: 'block'
                            });
                        }

                        $nextBGVideo.data( rb.defaults.init.dataKey ).mediaProperties.isPreloaded = true;
                    }
                }
            },

            timers: {

                defaults: {
                    fadeInDuration: 0.35,
                    reverseDuration: 0.3
                },

                create: function( curNext ){

                    // SET: curNext | required for restarting slide timeline by resize slider
                    this.curNext = curNext || 'next';

                    // RESET: timers
                    this.reset();

                    // CREATE: bar, circle and slide timer transitions
                    if( rb.gui.timers.bar.$element ){
                        this.bar.createTransition();
                    }

                    if( rb.gui.timers.circle.$element ){
                        this.circle.createTransition();
                    }

                    if( rb.gui.timers.slidebar.$element ){
                        this.slidebar.createTransition();
                    }
                },

                reverse: function(){

                    if( rb.slides.current && rb.slides.current.data && rb.transitions._slideTimeline ){

                        // SET: reverseTimeScale | calculated from current layers transition
                        var progress = rb.transitions._slideTimeline.progress(),
                            reverseTimeScale = rb.slides.current.data.duration * progress / this.defaults.reverseDuration;

                        // CREATE: bar, circle and slide timer transitions
                        if( rb.gui.timers.bar.$element && this.bar._transition ){
                            rb.transitions._slideTimeline.remove( rb.transitions.timers.bar._transition );
                            this.bar._transition.reverse().timeScale( reverseTimeScale );
                        }

                        if( rb.gui.timers.circle.$element && this.circle._transition ){
                            rb.transitions._slideTimeline.remove( rb.transitions.timers.circle._transition );
                            this.circle._transition.reverse().timeScale( reverseTimeScale );
                        }

                        if( rb.gui.timers.slidebar.$element && this.slidebar._transition ){
                            rb.transitions._slideTimeline.remove( rb.transitions.timers.slidebar._transition );
                            this.slidebar._transition.reverse().timeScale( reverseTimeScale );
                        }
                    }
                },

                reset: function(){

                    if( rb.gui.timers.bar.$element && this.bar._transition ){
                        this.bar.reset();
                    }

                    if( rb.gui.timers.circle.$element && this.circle._transition ){
                        this.circle.reset();
                    }

                    if( rb.gui.timers.slidebar.$element && this.slidebar._transition ){
                        this.slidebar.reset();
                    }
                },

                bar: {

                    reset: function(){

                        if( this._transition ){
                            this._transition.kill();
                            this._transition = false;
                        }
                    },

                    createTransition: function(){

                        this._transition = gsap.TweenMax.fromTo( rb.gui.timers.bar.$element[0], rb.slides[rb.transitions.curNext].data.duration, {
                            autoCSS: false,
                            paused: true,
                            css: {
                                width: 0
                            }
                        },{
                            autoCSS: false,
                            css: {},
                            ease : gsap.Linear.easeNone,
                            onReverseComplete: function(){
                                rb.transitions.timers.bar._transition = false;
                            },
                            onComplete: function( tween ){
                                tween.target.style.width = '100%';
                                tween.target.style.width = 'calc( 100% - ' + rb.slider.initial.skinWidth + 'px )';
                            },
                            onCompleteParams: ['{self}'],
                            onUpdate: function( tween ){
                                tween.target.style.width = Math.min( rb.slider.width, rb.slider.width * tween.progress() ) + 'px';
                            },
                            onUpdateParams: ['{self}']
                        });
                    }
                },

                circle: {

                    reset: function(){

                        if( this._transition ){
                            rb.gui.timers.circle.$element.stop(true,true);
                            this._transition.kill();
                            this._transition = false;
                        }
                    },

                    createTransition: function(){

                        var ctr = rb.gui.timers.circle.$element.find( '.rb-ct-right .rb-ct-rotate' )[0],
                            ctl = rb.gui.timers.circle.$element.find( '.rb-ct-left .rb-ct-rotate' )[0],
                            slideDuration = rb.slides[rb.transitions.curNext].data.duration;

                        this._transition = new gsap.TimelineMax({
                            paused: true
                        }).fromTo( rb.gui.timers.circle.$element[0], rb.transitions.timers.defaults.fadeInDuration, {
                            autoCSS: false,
                            immediateRender: true,
                            css: {
                                opacity: 0,
                                display: 'block'
                            }
                        },{
                            autoCSS: false,
                            css: {
                                opacity: rb.gui.timers.circle.$element.data( 'original' ).opacity
                            }

                            // onReverseComplete: function(){
                            //  rb.transitions.timers.circle.transition = false;
                            // }
                        }).fromTo( ctr, slideDuration / 2, {
                            autoCSS: false,
                            css: {
                                rotation: 0
                            }
                        },{
                            autoCSS: false,
                            css: {
                                rotation: 180
                            },
                            ease: gsap.Linear.easeNone
                        }, 0 ).fromTo( ctl, slideDuration / 2, {
                            autoCSS: false,
                            css: {
                                rotation: 0
                            }
                        },{
                            autoCSS: false,
                            css: {
                                rotation: 180
                            },
                            ease: gsap.Linear.easeNone
                        }, slideDuration / 2 );
                    }
                },

                slidebar: {

                    reset: function(){

                        if( this._transition ){
                            this._transition.kill();
                            this._transition = false;
                        }
                    },

                    createTransition: function(){

                        var self = this;

                        self._transition = new gsap.TimelineMax({
                            paused: true,
                            onReverseComplete: function(){
                                rb.transitions.timers.slidebar._transition = false;
                            }
                        });

                        $.each( rb.gui.timers.slidebar.$sliderContainerElement, function( index, $el ){

                            self._transition.add( gsap.TweenMax.fromTo( rb.gui.timers.slidebar.$sliderContainerElement[index][0], rb.slides[rb.transitions.curNext].data.duration, {
                                autoCSS: false,
                                css: {
                                    left: 0
                                }
                            },{
                                autoCSS: false,
                                css: {},
                                ease: gsap.Linear.easeNone,
                                onComplete: function( tween ){
                                    tween.target.style.left = 'calc( 100% - ' + rb.gui.timers.slidebar.sliderContainerElementWidth[index] + 'px )';
                                },
                                onCompleteParams: ['{self}'],
                                onUpdate: function( tween ){
                                    tween.target.style.left = ( rb.gui.timers.slidebar.containerElementWidth[index] - rb.gui.timers.slidebar.sliderContainerElementWidth[index] ) * tween.progress() + 'px'
                                },
                                onUpdateParams: ['{self}']
                            }), 0 );
                            self._transition.add( gsap.TweenMax.fromTo( rb.gui.timers.slidebar.$progressBarElement[index][0], rb.slides[rb.transitions.curNext].data.duration, {
                                autoCSS: false,
                                css: {
                                    width: 0
                                }
                            },{
                                autoCSS: false,
                                css: {},
                                ease: gsap.Linear.easeNone,
                                onComplete: function( tween ){
                                    tween.target.style.width = '100%';
                                },
                                onCompleteParams: ['{self}'],
                                onUpdate: function( tween ){
                                    tween.target.style.width = rb.gui.timers.slidebar.elementWidth[index] * tween.progress() + 'px'
                                },
                                onUpdateParams: ['{self}']
                            }), 0 );
                        });
                    }
                }
            }
        };

        rb.plugins = {

            load: function(){

                // USAGE (not working on file protocol):
                //
                // plugins: [ {
                //  namespace: 'plugin_name',
                //  js: 'script url',
                //  css: 'stylesheet url'
                // }, {
                //  namespace: 'plugin_name',
                //  js: 'script url',
                //  css: 'stylesheet url'
                // } ]

                if( rb.o.plugins && rb.o.plugins.length !== 0 ){

                    var curPlugin = rb.o.plugins[0],
                        curPluginNameSpace = typeof curPlugin === 'object' ? curPlugin.namespace : curPlugin;

                    if( window._RbSlider.plugins[curPluginNameSpace] ){
                        rb.plugins.init( curPluginNameSpace, curPlugin, true );
                        rb.plugins.load();
                    }else if( !rb.browser.usesFileProtocol && typeof curPlugin === 'object' ){

                        if( window._RbSlider.pluginsBeingLoaded.indexOf( curPluginNameSpace ) !== -1 ){

                            rb.plugins.checkLoaded( curPluginNameSpace );
                            return;
                        }

                        if( window._RbSlider.pluginsLoaded.indexOf( curPluginNameSpace ) === -1 &&
                            window._RbSlider.pluginsNotLoaded.indexOf( curPluginNameSpace ) === -1 ){

                            window._RbSlider.pluginsBeingLoaded.push( curPluginNameSpace );

                            $.ajax({
                                url:    curPlugin.js.indexOf( 'http://' ) === -1 &&
                                        curPlugin.js.indexOf( 'https://' ) === -1 ?
                                        ( window._RbSlider.pluginsPath ? window._RbSlider.pluginsPath : window._RbSlider.scriptPath + '/../plugins/' ) + curPlugin.js :
                                        curPlugin.js,
                                dataType: 'script',
                                success: function(){
                                    rb.plugins.init( curPlugin.namespace, curPlugin, true );
                                    window._RbSlider.pluginsLoaded.push( curPluginNameSpace );
                                },
                                error: function( jqXHR, textStatus, errorThrown ){

                                    if( window.console ){
                                        console.error( rb.defaults.slider.errorText, curPluginNameSpace, 'plugin has not been loaded!' );
                                        console.error( 'Additional error info:', errorThrown );
                                    }
                                    window._RbSlider.pluginsNotLoaded.push( curPluginNameSpace );
                                },
                                complete: function(){
                                    window._RbSlider.pluginsBeingLoaded.splice( window._RbSlider.pluginsBeingLoaded.indexOf( curPluginNameSpace ), 1 );
                                    rb.plugins.load();
                                }
                            });
                        }else{
                            if( !rb[curPluginNameSpace] && window._RbSlider.pluginsNotLoaded.indexOf( curPluginNameSpace ) === -1 ){
                                rb.plugins.init( curPluginNameSpace, curPlugin );
                            }else{
                                rb.o.plugins.splice( 0, 1 );
                            }
                            rb.plugins.load();
                        }
                    }else if( rb.browser.usesFileProtocol ){
                        if( window.console ){
                            console.error( rb.defaults.slider.errorText, 'Cannot load plugins on file:// protocol.' );
                            console.info( 'Please include the plugin files manually.' );
                        }
                        rb.o.plugins.splice( 0, 1 );
                        rb.plugins.load();
                    }else{
                        if( window.console ){
                            console.error( rb.defaults.slider.errorText, 'Plugin files are missing!' );
                            console.info( 'Plugin "' + curPluginNameSpace + '" has been added in slider init options, but the source files are not found on page.' );
                        }
                        rb.o.plugins.splice( 0, 1 );
                        rb.plugins.load();
                    }

                }else{
                    rb.slider.check.initialized();
                }
            },

            init: function( curPluginNameSpace, curPlugin, loadPluginStyle ){

                rb.initializedPlugins[curPluginNameSpace] = new window._RbSlider.plugins[curPluginNameSpace]( rb, $slider, sliderUID, curPlugin.settings );
                if( window._RbSlider.checkVersions( rb.initializedPlugins[curPluginNameSpace].pluginData.requiredLSVersion, rb.plugin.version ) ){
                    if( curPlugin.css && loadPluginStyle ){
                        $( '<link rel="stylesheet" href="' + ( curPlugin.css.indexOf( 'http://' ) === -1 &&
                                    curPlugin.css.indexOf( 'https://' ) === -1 ?
                                    ( window._RbSlider.pluginsPath ? window._RbSlider.pluginsPath : window._RbSlider.scriptPath.replace('/views/js/', '/views/css/') + '/../plugins/' ) + curPlugin.css :
                                    curPlugin.css ) + '">' ).appendTo( 'head' );
                    }
                    if( rb.initializedPlugins[curPluginNameSpace].init ){
                        rb.initializedPlugins[curPluginNameSpace].init();
                    }
                }else if( window.console ){
                    console.error( rb.defaults.slider.errorText, curPluginNameSpace, 'plugin has not been loaded! Required RbThemeSlider version:', rb.initializedPlugins[curPluginNameSpace].pluginData.requiredLSVersion, '(you have:', rb.plugin.version + ')'  );
                }
                rb.o.plugins.splice( 0, 1 );
            },

            checkLoaded: function( curPluginNameSpace ){

                rb.intervarb.pluginLoaded = setInterval(function(){
                    if( ( window._RbSlider.pluginsLoaded.indexOf( curPluginNameSpace ) !== -1 ||
                        window._RbSlider.pluginsNotLoaded.indexOf( curPluginNameSpace ) !== -1 ) &&
                        window._RbSlider.pluginsBeingLoaded.indexOf( curPluginNameSpace ) === -1 ){
                            clearInterval( rb.intervarb.pluginLoaded );
                            delete rb.intervarb.pluginLoaded;
                            rb.plugins.load();
                    }
                }, 100 );
            }
        };

        rb.slider = {

            shouldResize: true,
            thumbnails: [],

            // STORE: slider states
            state: {
                preloadingImages: false,
                changingSlides: false,
                animatingSlides: false
            },

            isPaused: false,

            // If slider is busy, user is not allowed to change slides
            isBusy: function(){
                return this.state.preloadingImages || this.state.changingSlides || this.state.animatingSlides;
            },

            // Load slider
            load: function(){

                // CHECK: if slider is in the document
                if( !document.body.contains( slider ) ){ return false; }

                // API CALL: sliderWillLoad
                if( rb.api.hasEvent( 'sliderWillLoad' ) ){
                    $slider.triggerHandler( 'sliderWillLoad' );
                }

                rb.slider.set.global();
            },

            // Set slider data
            set: {

                // SET: Global Arrays
                global: function(){

                    /*
                        rb.defaults.init.options    : Default slider settings (already defined)
                        rb.userInitOptions          : User settings (from init code or data-rb attribute)
                        rb.meta                     : Slider meta data
                        ls.o                        : Working slider settings (user settings merged with defaults)
                    */

                    rb.originalMarkup   = $slider[0].outerHTML;
                    rb.userInitOptions  = rb.functions.convert.properties( rb.functions.convert.oldProperties( userSettings ) );
                    rb.meta             = {};
                    rb.o                = $.extend( true, {}, rb.defaults.init.options, rb.userInitOptions );

                    rb.o.forceLayersOutDuration /= 1000;
                    rb.o.forceLayersOutDuration = rb.o.forceLayersOutDuration > 0 ? rb.o.forceLayersOutDuration : 0.75;
                    rb.o.sliderFadeInDuration /= 1000;

                    // SHOW: welcome message in browser console | only once
                    if( window.console && rb.o.hideWelcomeMessage !== true && window._RbSlider.hideWelcomeMessage !== true ){
                        window._RbSlider.hideWelcomeMessage = true;
                        var method = window.console.info ? 'info' : 'log';
                        console[method]( 'Rbthemeslider', 'v' + rb.plugin.version, 'initialized' );
                        console[method]( 'Find updates and docs @ http://docs.webshopworks.com/creative-slider' );
                    }

                    // SET: scriptPath
                    if( window._RbSlider.currentScript || window._RbSlider.rbScript ){
                        window._RbSlider.scriptPath = ( window._RbSlider.currentScript || window._RbSlider.rbScript ).src.replace( /\\/g, '/' ).replace( /\/[^\/]*$/, '' );
                    }

                    // IF: there are any plugins, load them
                    if( typeof rb.o.plugins === 'object' ){
                        rb.plugins.load();
                    }else{
                        rb.slider.check.initialized();
                    }
                },

                // SET: global and slider styles & html markup changes
                styles: function(){

                    var self = rb.slider,
                        $parent = $slider.parent(),
                        s = slider.style,
                        cS = window.getComputedStyle( slider, null ),
                        sliderWidth, sliderHeight,
                        originalWidth, originalHeight,
                        clientWidth = parseInt( slider.clientWidth ),
                        clientHeight = parseInt( slider.clientHeight ),
                        parentWidth = parseInt( $parent.width() ),
                        parentHeight = parseInt( $parent.height() ),
                        maxWidth, tempW, tempH,
                        conWidth = rb.o.layersContainerWidth,
                        conHeight = rb.o.layersContainerHeight,
                        ratioW, ratioH,
                        skinWidth, skinHeight,
                        sliderType = rb.o.type.toLowerCase(),
                        marginLeft, marginRight, mL, mR,
                        styleHasMarginLeft, styleHasMarginRight, originalMargins,
                        paddingLeft, paddingTop, paddingRight, paddingBottom,
                        borderLeftWidth, borderTopWidth, borderRightWidth, borderBottomWidth;

                    // GET: initial width
                    if( rb.o.width ){
                        sliderWidth = rb.o.width.indexOf( '%' ) == -1 ? parseInt( rb.o.width ) : rb.o.width;
                    }else if( s.width ){
                        sliderWidth = s.width.indexOf( '%' ) == -1 ? parseInt( s.width ) : s.width;
                    }else if( conWidth > 0 ){
                        sliderWidth = conWidth;
                    }else{
                        sliderWidth = clientWidth;
                    }

                    originalWidth = sliderWidth;

                    // GET: initial height
                    if( rb.o.height ){
                        sliderHeight = rb.o.height.indexOf( '%' ) == -1 ? parseInt( rb.o.height ) : rb.o.height;
                    }else if( s.height ){
                        sliderHeight = s.height.indexOf( '%' ) == -1 ? parseInt( s.height ) : s.height;
                    }else if( conHeight > 0 ){
                        sliderHeight = conHeight;
                    }else{
                        sliderHeight = clientHeight;
                    }

                    originalHeight = sliderHeight;

                    // GET: maximum width
                    if( s.maxWidth !== '' ){
                        if( s.maxWidth.indexOf('%') === -1 ){
                            maxWidth = parseInt( s.maxWidth );
                        }else{
                            maxWidth = s.maxWidth;
                        }
                    }else{
                        maxWidth = 0;
                    }

                    // IF: rb.userInitOptions.type is not exist > fallback mode (version 5x and earlier)
                    if( typeof rb.userInitOptions.type == 'undefined' ){
                        // trying to find out slider type
                        if( ( conWidth > 0 && conHeight > 0 ) || ( sliderWidth === '100%' && sliderHeight === '100%' ) ){
                            sliderType = 'fullsize';
                        }else if( conWidth <= 0 && conHeight <= 0 && ( rb.o.responsiveUnder <= 0 || ( rb.o.responsiveUnder > 0 && rb.o.sliderVersion  ) ) ){
                            if( typeof rb.o.responsive !== 'undefined' && rb.o.responsive === false ){
                                sliderType = 'fixedsize';
                            }else{
                                sliderType = 'responsive';
                            }
                        }else if( rb.o.responsiveUnder > 0 ){
                            sliderType = 'fullwidth';
                        }
                    }

                    // CHECK: if slider type is wrong
                    switch( sliderType ){

                        case 'fullwidth':
                            if( sliderWidth.indexOf( '%' ) !== -1 ){
                                sliderWidth = clientWidth;
                            }
                            if( conWidth <= 0 ){
                                conWidth = sliderWidth;
                            }
                            if( rb.o.responsiveUnder <= 0 ){
                                rb.o.responsiveUnder = conWidth;
                            }
                            if( sliderHeight.indexOf('%') !== -1 ){
                                tempH = parentHeight / ( 100 / parseInt( sliderHeight ) );
                                sliderHeight = tempH;
                            }
                            if( conHeight <= 0 ){
                                conHeight = sliderHeight;
                            }
                        break;

                        case 'fullsize':
                            if( sliderWidth.indexOf('%') !== -1 ){
                                tempW = conWidth > 0 ? conWidth : parentWidth;
                                sliderWidth = tempW;
                            }
                            if( conWidth <= 0 ){
                                conWidth = sliderWidth;
                            }
                            if( sliderHeight.indexOf('%') !== -1 ){
                                tempH = conHeight > 0 ? conHeight : $(window).height() / ( 100 / parseInt( sliderHeight ) );
                                sliderHeight = tempH;
                            }
                            if( conHeight <= 0 ){
                                conHeight = sliderHeight;
                            }
                        break;

                        case 'fixedsize':
                        break;

                        default:

                            // FALLBACK mode
                            rb.userInitOptions.type = rb.o.type = sliderType = 'responsive';

                            // SET: responsive under to default
                            rb.o.responsiveUnder = -1;

                            if( sliderWidth.indexOf( '%' ) !== -1 ){
                                sliderWidth = clientWidth;
                            }
                            if( sliderHeight.indexOf( '%' ) !== -1 ){
                                sliderWidth = clientHeight;
                            }
                        break;
                    }

                    // ADD: classes to slider
                    $slider.addClass( 'rb-container rb-' + sliderType );
                    $slider.parent().addClass( 'rb-direction-fix' );

                    if( rb.o.preventSliderClip && rb.o.fitScreenWidth && ( sliderType === 'fullwidth' || ( sliderType === 'fullsize' && rb.o.fullSizeMode !== 'fitheight' ) ) ){
                        $slider.parents( ':not(body, html)').each(function(){
                            $(this).addClass( 'rb-overflow-visible' );
                        });
                    }

                    // IF: backgroundSize is not specified by user, set it to auto for responsive sliders
                    if( !rb.userInitOptions.slideBGSize && sliderType === 'responsive' && rb.userInitOptions.hasOwnProperty( 'sliderVersion' ) && !rb.userInitOptions.sliderVersion ){
                        rb.o.slideBGSize = 'auto';
                    }

                    rb.o.slideBGSize = rb.o.slideBGSize.replace( '100% 100%', 'stretch' );

                    // SET: slider initial ratio | this is not the same as rb.resize.ratio!
                    // slider initial ratio is slider (or layers container) initial width / slider (or layers container) initial height
                    ratioW = conWidth > 0 ? conWidth : sliderWidth;
                    ratioH = conHeight > 0 ? conHeight : sliderHeight;

                    // GET: slider horizontal margins
                    mL = slider.style.marginLeft;
                    if( mL === 'auto' ){
                        marginLeft = 'auto';
                    }else if( mL === '' ){
                        marginLeft = parseInt( cS.getPropertyValue( 'margin-left' ) );
                    }else{
                        marginLeft = parseInt( slider.style.marginLeft );
                        styleHasMarginLeft = true;
                    }

                    mR = slider.style.marginRight;
                    if( mR === 'auto' ){
                        marginRight = 'auto';
                    }else if( mR === '' ){
                        marginRight = parseInt( cS.getPropertyValue( 'margin-right' ) );
                    }else{
                        marginRight = parseInt( slider.style.marginRight );
                        styleHasMarginRight = true;
                    }

                    if( marginLeft === marginRight ){
                        // IF: no margins added in $slider style attribute
                        if( mL === '' && mR === '' ){
                            originalMargins = marginLeft;
                            marginLeft = 'auto';
                            marginRight = 'auto';
                        }
                        // IF: left and right margins are the same, but not auto, add auto margins to slider element
                        $slider.css({
                            marginLeft: 'auto',
                            marginRight: 'auto'
                        });
                    }

                    // GET: slider padding and border | required to use skins
                    paddingLeft = s.paddingLeft !== '' ? parseInt( s.paddingLeft ) : parseInt( $slider.css( 'padding-left' ) );
                    paddingRight = s.paddingRight !== '' ? parseInt( s.paddingRight ) : parseInt( $slider.css( 'padding-right' ) );
                    paddingTop = s.paddingTop !== '' ? parseInt( s.paddingTop ) : parseInt( $slider.css( 'padding-top' ) );
                    paddingBottom = s.paddingBottom !== '' ? parseInt( s.paddingBottom ) : parseInt( $slider.css( 'padding-bottom' ) );

                    borderLeftWidth = s.borderLeftWidth !== '' ? parseInt( s.borderLeftWidth ) : parseInt( $slider.css( 'border-left-width') );
                    borderRightWidth = s.borderRightWidth !== '' ? parseInt( s.borderRightWidth ) : parseInt( $slider.css( 'border-right-width') );
                    borderTopWidth = s.borderTopWidth !== '' ? parseInt( s.borderTopWidth ) : parseInt( $slider.css( 'border-top-width') );
                    borderBottomWidth = s.borderBottomWidth !== '' ? parseInt( s.borderBottomWidth ) : parseInt( $slider.css( 'border-bottom-width') );

                    // SAVE: initial slider data
                    self.initial = {
                        type: sliderType,
                        width: sliderWidth,
                        height: sliderHeight,
                        originalWidth: originalWidth,
                        originalHeight: originalHeight,
                        percW: sliderWidth / 100,
                        percH: sliderHeight / 100,
                        layersWidth: conWidth,
                        layersHeight: conHeight,
                        ratio: ratioW / ratioH,
                        maxWidth: maxWidth,
                        marginLeft: marginLeft,
                        marginRight: marginRight,
                        paddingLeft: paddingLeft,
                        paddingTop: paddingTop,
                        paddingRight: paddingRight,
                        paddingBottom: paddingBottom,
                        borderLeftWidth: borderLeftWidth,
                        borderTopWidth: borderTopWidth,
                        borderRightWidth: borderRightWidth,
                        borderBottomWidth: borderBottomWidth,
                        skinWidth: paddingLeft + paddingRight + borderLeftWidth + borderRightWidth,
                        skinHeight: paddingTop + paddingBottom + borderTopWidth + borderBottomWidth
                    };

                    // SET: Global Styles
                    // Trying to add special ID to <body> or <html>
                    // (required to overwrite WordPresss global styles)
                    if( !$( 'html' ).attr( 'id' ) ){
                        $( 'html' ).attr( 'id','rb-global' );
                    }else if( !$( 'body' ).attr( 'id' ) ){
                        $( 'body' ).attr( 'id','rb-global' );
                    }

                    // SET: Slider Styles
                    if( s.position !== 'static' && s.position !== 'absolute' ){
                        slider.style.position = 'relative';
                    }

                    // CALL: insert slider into / before / after a specified element
                    if( rb.o.insertSelector ){
                        $slider[rb.o.insertMethod]( rb.o.insertSelector );
                    }

                    // CREATE & SET: Wrapper Containers
                    rb.slider.$hiddenWrapper = $( '<div class="rb-wp-container fitvidsignore rb-hidden" data-rbthemeslider-uid="' + sliderUID + '"></div>' ).addClass( $slider.attr( 'class' ) ).prependTo( 'body' );

                    rb.slider.$innerWrapper = $( '<div class="rb-inner"></div>' );
                    rb.slider.$layersWrapper = $( '<div class="rb-layers"></div>' ).appendTo( rb.slider.$innerWrapper );
                    rb.slider.$bgVideosWrapper = $( '<div class="rb-background-videos"></div>' ).appendTo( rb.slider.$layersWrapper );
                    rb.slider.$slideBGWrapper = $( '<div class="rb-slide-backgrounds"></div>' ).appendTo( rb.slider.$layersWrapper );

                    rb.slider.$innerWrapper.appendTo( $slider );

                    // SET: hideOnMobile & CHECK: hideUnder, hideOver
                    if( rb.o.hideOnMobile === true && rb.device.isMobile ){
                        $slider.addClass( 'rb-forcehide' );
                        $slider.closest( '.rb-wp-fullwidth-container' ).addClass( 'rb-forcehide' );
                        rb.o.autoStart = false;
                    }else{
                        rb.slider.check.showHide();
                    }

                    // SET: globalBGImage & globalBGColor
                    if( rb.o.globalBGImage ){
                        rb.slider.$innerWrapper.css({
                            backgroundImage: 'url( '+rb.o.globalBGImage+' )',
                            backgroundRepeat: rb.o.globalBGRepeat,
                            backgroundAttachment: rb.o.globalBGAttachment,
                            backgroundSize: rb.o.globalBGSize,
                            backgroundPosition: rb.o.globalBGPosition
                        });
                    }
                    rb.slider.$innerWrapper.css({
                        backgroundColor : rb.o.globalBGColor
                    });

                    if( rb.o.globalBGColor == 'transparent' && rb.o.globalBGImage === false ){
                        rb.slider.$innerWrapper.css({
                            background : 'none transparent'
                        });
                    }
                },

                // SET: slider options using defaults and user options
                options: function(){

                    var eventType,
                        normalized,
                        scrollY;

                    // SAVE: version informations
                    if( $( 'html' ).find( 'meta[content*="WordPress"]' ).length ){
                        rb.meta.wpVersion = $( 'html' ).find( 'meta[content*="WordPress"]' ).attr( 'content' ).split( 'WordPress' )[1];
                    }

                    if( $( 'html' ).find( 'script[src*="rbthemeslider"]' ).length ){
                        if( $( 'html' ).find( 'script[src*="rbthemeslider"]' ).attr( 'src' ).indexOf( '?' ) != -1 ){
                            rb.meta.rbwpVersion = $( 'html' ).find( 'script[src*="rbthemeslider"]' ).attr( 'src' ).split( '?' )[1].split( '=' )[1];
                        }
                    }

                    // CHECK: if modified transitions list is loaded or not
                    if( typeof RbSliderTransitions !== 'undefined' ){
                        rb.t = $.extend({},RbSliderTransitions);
                    }

                    // CHECK: if custom transitions list is loaded or not
                    if( typeof RbSliderCustomTransitions !== 'undefined' ){
                        rb.ct = $.extend({},RbSliderCustomTransitions);
                    }

                    // SET: global parallax settings
                    if( typeof rb.o.parallaxCenterDegree == 'number' ){
                        rb.transitions.layers.parallax.defaults.centerDegree = rb.o.parallaxCenterDegree;
                    }
                    if( typeof rb.o.parallaxSensitivity == 'number' ){
                        rb.transitions.layers.parallax.defaults.sensitive = rb.o.parallaxSensitivity;
                    }
                    if( rb.o.parallaxCenterLayers ){
                        rb.transitions.layers.parallax.defaults.centerLayers = rb.o.parallaxCenterLayers;
                    }

                    // SET: playByScroll
                    if( rb.o.playByScroll ){
                        // SET: cycles to -1 in playByScroll slider
                        rb.o.cycles = -1;
                        // SET: startInViewport to true in playByScroll slider
                        rb.o.startInViewport = true;
                        // SET: pauseOnHover to false
                        rb.o.pauseOnHover = false;
                        // SET: autoStart to false
                        rb.o.autoStart = false;
                    }

                    // SET: startInViewport
                    if( rb.o.startInViewport ){

                        // SET: positionToViewport for the first time
                        rb.slider.positionToViewport = rb.device.winScrollTop > rb.slider.offsetTop - ( rb.device.viewportHeight - rb.slider.height ) / 2 ? 'under' : 'over';

                        // IF: slider should play by scroll
                        if( rb.o.playByScroll ){

                            var canBeModified = true,
                                maxTimeScaleModifier = 4 * rb.o.playByScrollSpeed,
                                currentY, lastY,
                                eventSensitivy;

                            rb.device.scroll.timeout = 250;
                            rb.transitions.layers.timeline.timeScaleModifier = 0;

                            // CREATE: wheel event for the slider
                            $(document).on( 'wheel.' + sliderUID + ' touchmove.' + sliderUID, function( event ) {

                                if( rb.device.isMobile ){
                                    currentY = event.originalEvent.touches[0].clientY;
                                    if( currentY > lastY ){
                                        rb.device.scroll.direction = 'up';
                                    }else if( currentY < lastY ){
                                        rb.device.scroll.direction = 'down';
                                    }
                                    eventSensitivy = ( lastY - currentY );
                                    lastY = currentY;
                                }else{
                                    if( event.originalEvent.deltaY > 0 ){
                                        rb.device.scroll.direction = 'down';
                                    }else{
                                        rb.device.scroll.direction = 'up';
                                    }
                                    eventSensitivy = event.originalEvent.deltaY;
                                }

                                if( Math.abs( eventSensitivy ) === 0 ){
                                    return;
                                }

                                if( !rb.device.scroll.lastDirection ){
                                    rb.device.scroll.lastDirection = rb.device.scroll.direction;
                                }else if( rb.device.scroll.lastDirection !== rb.device.scroll.direction ){
                                    rb.device.scroll.lastDirection = rb.device.scroll.direction;
                                    rb.transitions.layers.timeline.timeScaleModifier = 0;
                                }

                                if( rb.slider.positionToViewport === 'inside' ){

                                    rb.resize.viewport();

                                    if( eventSensitivy >= 0 ){
                                        rb.transitions.layers.timeline.scrollForward();
                                    }else{
                                        rb.transitions.layers.timeline.scrollBackwards();
                                    }

                                    if( canBeModified ){

                                        clearTimeout( rb.timeouts.scroll );

                                        canBeModified = false;

                                        rb.transitions.layers.timeline.timeScaleModifier = rb.transitions.layers.timeline.timeScaleModifier < maxTimeScaleModifier ? rb.transitions.layers.timeline.timeScaleModifier + 0.25 : maxTimeScaleModifier;
                                        rb.timeouts.scroll2 = setTimeout( function(){
                                            // REMOVE: from rb.timeouts object
                                            delete rb.timeouts.scroll2;

                                            canBeModified = true;
                                            rb.device.scroll.timeout = rb.device.scroll.timeout > 50 ? rb.device.scroll.timeout - 50 : 50;
                                        }, rb.device.scroll.timeout );
                                    }
                                }
                            });
                        }

                        // CREATE: window scroll function for the slider
                        $( window ).on( 'scroll.' + sliderUID, function(){

                            rb.slider.check.positionToViewport();
                        });

                        rb.timeouts.checkPosition = setTimeout( function(){ rb.slider.check.positionToViewport(); }, 25);
                    }

                    // SET: slider can be visible now
                    rb.slider.canShow = true;
                }
            },

            check: {

                // CHECK: if the slider is already initialized or not
                initialized: function(){

                    if( !rb.slider.initialized ){
                        rb.slider.initialized = true;
                        this.skins();
                    }
                },

                // CHECK: if the selected skin is already loaded, CALL: rb.slider.init(), otherwise LOAD: selected skin
                skins: function(){

                    if( !rb.o.skin || rb.o.skin === '' || !rb.o.skinsPath || rb.o.skinsPath === '' ){
                        rb.slider.init();
                    }else{
                        rb.gui.skin.load();
                    }
                },

                showHide: function(){

                    if( !rb.device.isMobile || rb.o.hideOnMobile === false ){
                        if( rb.device.viewportWidth < rb.o.hideUnder || ( rb.device.viewportWidth > rb.o.hideOver && rb.o.hideOver > 0 ) ){
                            rb.slider.hide();
                        }else{
                            rb.slider.show();
                        }
                    }
                },

                positionToViewport: function(){

                    // REMOVE: from rb.timeouts object
                    delete rb.timeouts.checkPosition;

                    // IF: slider should play by scroll
                    if( rb.o.playByScroll ){

                        if( rb.device.scroll.direction ){

                            var param1 = rb.device.scroll.direction === 'down' ? rb.device.winScrollTop : rb.slider.offsetTop - ( rb.device.viewportHeight - rb.slider.height ) / 2,
                                param2 = rb.device.scroll.direction === 'down' ? rb.slider.offsetTop - ( rb.device.viewportHeight - rb.slider.height ) / 2 : rb.device.winScrollTop;

                            // IF: slider is in viewport
                            if( param1 > param2 && ( ( rb.device.scroll.direction === 'up' && rb.slider.positionToViewport === 'under' ) || ( rb.device.scroll.direction === 'down' && rb.slider.positionToViewport === 'over' ) ) ){

                                // SET: positinToViewport
                                rb.slider.positionToViewport = 'inside';

                                // SET: slider into the middle of the viewport
                                rb.resize.viewport();
                                // DISABLE: scroll event
                                rb.device.scroll.disable();
                            }
                        }

                    // ELSE: normal sliders with startInViewport enabled
                    }else{

                        var param3 = rb.device.winScrollTop + rb.device.viewportHeight / 2,
                            param4 = rb.slider.offsetTop + rb.slider.height / 2;

                        // IF: slider is in viewport
                        if( Math.abs( param3 - param4 ) < rb.device.viewportHeight / 2 || ( rb.device.winScrollTop < rb.slider.offsetTop && rb.device.winScrollTop + rb.device.viewportHeight > rb.slider.offsetTop + rb.slider.height ) ){

                            // SET: positinToViewport
                            rb.slider.positionToViewport = 'inside';
                            // REMOVE: event
                            $( window ).off( 'scroll.' + sliderUID );

                            // IF: timeline is exist
                            if( rb.transitions._slideTimeline ){
                                // START: playing layer transitions
                                rb.transitions.layers.timeline.play();
                            }
                        }
                    }
                }
            },

            init: function(){

                // CLEAR: skinload timeouts
                clearTimeout( rb.timeouts.skinLoad1 );
                clearTimeout( rb.timeouts.skinLoad2 );
                clearTimeout( rb.timeouts.skinLoad3 );
                clearTimeout( rb.timeouts.skinLoad4 );

                // SET: basic resize & scroll events
                rb.device.setBasicEvents();

                // SET: global and slider styles & html markup changes
                rb.slider.set.styles();

                // SET: slider options using defaults and user options
                rb.slider.set.options();

                // INIT: slides and layers
                rb.slides.init();

                // SET: browser fullscreen functions
                rb.device.fullscreen.set();

                // INIT: media elements
                rb.media.init();

                // INIT: timers
                rb.gui.timers.init();

                // INIT: Loading Indicator
                rb.gui.loadingIndicator.init();

                // INIT: Preload
                rb.preload.init();

                // INIT: Shadow
                rb.gui.shadow.init();

                // INIT: keyboard and touch control navigation
                rb.navigation.init();

                // INIT: slideshow
                rb.slideshow.init();

                // SET: first slide
                rb.slides.set.firstSlide();

                // INIT: Navigation
                rb.gui.navigation.init();

                // CALL: resize slider
                rb.resize.slider();

                // INIT: yourLogo
                rb.yourLogo.init();

                // ADD: window resize event
                $( window ).on( 'resize.' + sliderUID, function(){
                    // CHECK: if the slider should be hidden or not
                    rb.slider.check.showHide();

                    if( rb.slider.positionToViewport === 'inside' && rb.o.playByScroll ){
                        rb.resize.viewport();
                    }

                    // SET: responsive the whole slider
                    if( rb.slider.shouldResize ){
                        rb.resize.all();
                    }
                });

                // SET: Window Orientation Change function
                $( window ).on( 'orientationchange.' + sliderUID, function(){

                    // GET: device dimensions
                    rb.device.getDimensions();

                    // Must be called due to a bug on some mobile devices
                    rb.resize.all();
                });

                // GET: device dimensions
                rb.device.getDimensions();

                // SET: the slider responsive for the first time:
                // $( window ).trigger( 'resize' );
                // $( window ).trigger( 'orientationchange' );
                // NOTE: should we trigger our own event handlers only (THEMECO)
                $( window ).trigger( 'resize.' + sliderUID );
                $( window ).trigger( 'orientationchange.' + sliderUID );

                // API CALL: sliderDidLoad
                if( rb.api.hasEvent( 'sliderDidLoad' ) ){
                    $slider.triggerHandler( 'sliderDidLoad', rb.api.eventData() );
                }

                rb.functions.setStates( rb.slider, {
                    isLoaded: true
                });

                if( rb.slider.state.shouldBeDestroyed ){
                    rb.api.methods( 'destroy' );
                    return;
                }

                // CALL: change function to start the first slide transition
                rb.slideshow.changeTo( rb.slides.first.index );
            },

            hide: function(){

                $slider.addClass( 'rb-forcehide' );
                $slider.closest( '.rb-wp-fullwidth-container' ).addClass( 'rb-forcehide' );
            },

            show: function(){

                $slider.removeClass( 'rb-forcehide' );
                $slider.closest( '.rb-wp-fullwidth-container' ).removeClass( 'rb-forcehide' );
            }
        };

        rb.functions = {

            // FUNCTIONS: convert specific data
            convert: {

                transformOrigin: function( t, $el, $baseEl ){

                    var original = $.trim( t ),
                        saved = original.split( ' ' ),
                        converted = '',
                        pos = [ 'Left', 'Top' ],
                        dim = [ rb.slider.width, rb.slider.height ];

                    original = original
                    .replace( 'sliderleft', '0' )
                    .replace( 'sliderright', '100%' )
                    .replace( 'slidercenter', '50%' )
                    .replace( 'slidermiddle', '50%' )
                    .replace( 'slidertop', '0' )
                    .replace( 'sliderbottom', '100%' )
                    .replace( 'left', '0' )
                    .replace( 'right', '100%' )
                    .replace( 'center', '50%' )
                    .replace( 'middle', '50%' )
                    .replace( 'top', '0' )
                    .replace( 'bottom', '100%' )
                    .split( ' ' );

                    for( var x=0; x<original.length; x++ ){

                        if( saved[x].indexOf( 'slider') !== -1 ){

                            // SET: retart slide timeline when resizing
                            rb.transitions.layers.timeline.shouldRestart = true;
                            var style = $el.data( rb.defaults.init.dataKey ).elements.$wrapper[0].style;
                            if( x < 2 ){
                                converted +=  dim[x] / ( 100 / parseInt( original[x] ) ) - parseInt( style[ pos[x].toLowerCase() ] ) - parseInt( style[ 'margin' + pos[x] ] )  + 'px ';
                            }else{
                                converted += '0px';
                            }
                        }else{

                            if( x < 2 && $el && $baseEl ){
                                switch(x ){
                                    case 0:
                                        dim = $baseEl.width();
                                    break;
                                    case 1:
                                        dim = $baseEl.height();
                                    break;
                                }
                            }

                            if( original[x].indexOf( '%' ) !== -1 ){
                                if( x < 2 && $el && $baseEl ){
                                    converted +=  dim / ( 100 / parseInt( original[x] ) ) + 'px ';
                                }else{
                                    converted += original[x] + ' ';
                                }
                            }else{
                                converted += ( parseInt( original[x] ) * rb.resize.ratio ) + 'px ';
                            }
                        }
                    }

                    return $.trim( converted );
                },

                easing: function( easing, reverse ){

                    // Must check because layers with updated transition properties don't need to convert their easings again
                    if( typeof easing === 'string' ){

                        var ease,
                            split,
                            easeType;

                        easing = easing.toLowerCase();

                        if( easing.indexOf('swing') !== -1 || easing.indexOf('linear') !== -1 ){
                            ease = gsap.Linear.easeNone;
                        }else{
                            split = easing.match(/(easeinout|easein|easeout)(.+)/)[2];
                            easeType = gsap[ split.charAt(0).toUpperCase() + split.slice(1) ];
                            if( easing.indexOf('easeinout') !== -1 ){
                                ease = easeType.easeInOut;
                            }else if( easing.indexOf('easeout') !== -1 ){
                                ease = reverse ? easeType.easeIn : easeType.easeOut;
                            }else if( easing.indexOf('easein') !== -1 ){
                                ease = reverse ? easeType.easeOut : easeType.easeIn;
                            }
                        }

                        return ease;
                    }else{
                        return easing;
                    }
                },

                transition: function( t, easing, type, undef ){

                    var transition = $.extend( {}, t ),
                        properties = {
                            rotate: 'rotation',
                            rotateX: 'rotationX',
                            rotateY: 'rotationY'
                        };

                    $.each( properties, function( index, value ){

                        if( index in transition ){

                            transition[value] = transition[index];
                            delete transition[index];
                        }
                    });

                    if( type === 'after' ){
                        transition.scaleX = transition.scaleY = transition.scaleZ = 1;
                    }else if( transition.scale3d !== undef ){
                        transition.scaleX = transition.scaleY = transition.scaleZ = transition.scale3d;
                        delete transition.scale3d;
                    }

                    if( transition.delay ){
                        transition.delay = type === 'after' ? transition.delay / 1000 : transition.delay;
                    }

                    if( typeof easing === 'undefined' ){
                        easing = 'easeInOutQuart';
                    }

                    transition.ease = rb.functions.convert.easing(easing);

                    return transition;
                },

                randomProperties: function( value, propertyName ){

                    if( value && value.indexOf( '(') !== -1 && value.indexOf( ',') !== -1 && value.indexOf( ')') !== -1 ){

                        var rand = value.split( '(' )[1].split( ')' )[0].split( ',' ),
                            divider = 1;

                        rand[0] = parseFloat( rand[0] );
                        rand[1] = parseFloat( rand[1] );

                        // IF: property with random values is scale, using also integers
                        if( propertyName.indexOf( 'scale' ) !== -1 ){
                            divider = 100;
                            rand[0] *= divider;
                            rand[1] *= divider;
                        }

                        return Math.floor(Math.random() * ( ( rand[1]-rand[0] ) + 1 ) + rand[0] ) / divider;
                    }else{
                        return value;
                    }
                },

                properties: function( options, forceToNum ){

                    if( typeof options === 'string' ){
                        return( rb.functions.convert._properties( options, forceToNum ) );
                    }else if(typeof options === 'object' ){
                        for( var property in options ){
                            options[property] = rb.functions.convert._properties( options[property], forceToNum );
                        }
                        return options;
                    }else{
                        return options;
                    }
                },

                _properties: function( string, forceToNum ){

                    if( string == 'enable' || string == 'enabled' || string == 'true' ){
                        return true;
                    }else if( string == 'disable' || string == 'disabled' || string == 'false' ){
                        return false;
                    }else if( typeof string === 'string' && string.indexOf( rb.defaults.init.rbDataArraySplitChar ) !== -1 ){
                        var str = string.split( rb.defaults.init.rbDataArraySplitChar ),
                            arr = [];
                        for( var s = 0; s < str.length; s++){
                            arr[s] = $.isNumeric( str[s] ) ?  parseFloat( $.trim( str[s] ) ) : $.trim( str[s] );
                        }
                        return arr;
                    }else if( forceToNum ){
                        return '' + parseInt( string ) == 'NaN' ? 0 : parseInt( string );
                    }else{
                        return $.isNumeric( string ) ? parseFloat( string ) : string;
                    }
                },

                oldProperties: function( userSettings ){

                    var properties = {
                        firstLayer: 'firstSlide',
                        loops: 'cycles',
                        forceLoopNum: 'forceCycles',
                        layersContainer: 'layersContainerWidth',
                        sublayerContainer: 'layersContainerWidth',
                        randomSlideshow: 'shuffleSlideshow'
                    };

                    $.each( properties, function( index, value ){

                        if( index in userSettings ){

                            userSettings[value] = userSettings[index];
                            delete userSettings[index];
                        }
                    });

                    return userSettings;
                }
            },

            // FUNCTION: gets slider closest parent element with numeric value of given style property | 'auto' and percentage values will be skipped
            getSliderClosestParentElementWidthNumericValueOfProperty: function( styleProperty ){

                var $parents = $slider.parents(),
                    pLength = $parents.length,
                    value,
                    percent = 100;

                for( var p = 0; p < pLength; p++ ){

                    value = window.getComputedStyle( $parents[p] ).getPropertyValue( styleProperty);
                    if( value !== 'auto' ){
                        if( value.indexOf( 'px' ) !== -1 ){
                            rb.slider.$parentWithNumericWidthValue = $( $parents[p] );
                            return $( $parents[p] );
                        }else if( value.indexOf( '%' ) !== -1 ){
                            percent = percent / 100 * parseInt( value );
                            rb.slider.$parentWithNumericWidthValuePercent = percent;
                        }
                    }
                }
            },

            // FUNCTION: sorts properties in an array
            sortArray: function( x, y, dir ) {
                var i = [];
                if(dir=='forward' ){
                    for( var a=0; a<x; a++ ){
                        for( var b=0; b<y; b++ ){
                            i.push(a+b*x);
                        }
                    }
                }else{
                    for( var aa=x-1; aa>-1; aa-- ){
                        for( var bb=y-1; bb>-1; bb-- ){
                            i.push(aa+bb*x);
                        }
                    }
                }
                return i;
            },

            // FUNCTION: randomize properties in an array
            shuffleArray: function( array ){

                var currentIndex = array.length,
                    temporaryValue,
                    randomIndex ;

                while (0 !== currentIndex) {

                    randomIndex = Math.floor( Math.random() * currentIndex );
                    currentIndex -= 1;

                    temporaryValue = array[currentIndex];
                    array[currentIndex] = array[randomIndex];
                    array[randomIndex] = temporaryValue;
                }

                return array;
            },

            // FUNCTION: counts properties in an object
            countProp: function( obj ) {
                var count = 0;

                for( var prop in obj ) {
                    if( obj.hasOwnProperty( prop ) ){
                        ++count;
                    }
                }
                return count;
            },

            // FUNCTION: returns URL of an image | automatically working with src, currentSrc and .data( 'src' )
            getURL: function( $image ){
                return $image[0].currentSrc ? $image[0].currentSrc : ( $image.data( 'src ' ) ? $image.data( 'src ' ) : $image.attr( 'src' ) );
            },

            // FUNCTION: returns the ALT attribute of an image (if it is exist)
            getALT: function( $image ){
                return $image.attr( 'alt' ) ? $image.attr( 'alt' ) : false;
            },

            // FUNCTION: sets slider, slideshow, parallax or slide timeline states
            setStates: function( target, stateName, value ){

                if( target && target.state ){

                    var slideshowWasPaused = rb.slideshow.isPaused();

                    if( value ){
                        target.state[stateName] = value;
                    }else{
                        for( var key in stateName ){
                            target.state[key] = stateName[key] ;
                        }
                    }

                    var slideshowIsPaused = rb.slideshow.isPaused();

                    if( target == rb.slideshow ){
                        if( rb.api.hasEvent( 'slideshowStateDidChange' ) ){
                            $slider.triggerHandler( 'slideshowStateDidChange', rb.api.eventData() );
                        }
                        if( slideshowIsPaused != slideshowWasPaused ){
                            if( !slideshowIsPaused ){
                                if( rb.api.hasEvent( 'slideshowDidResume' ) ){
                                    $slider.triggerHandler( 'slideshowDidResume', rb.api.eventData() );
                                }
                            }else if( rb.api.hasEvent( 'slideshowDidPause' ) ){
                                $slider.triggerHandler( 'slideshowDidPause', rb.api.eventData() );
                            }
                        }
                    }
                }
            },

            clearTimers: function(){

                for( var t_key in rb.timeouts ){
                    clearTimeout( rb.timeouts[t_key] );
                    delete rb.timeouts[t_key];
                }

                for( var i_key in rb.intervals ){
                    clearInterval( rb.intervals[i_key] );
                    delete rb.intervals[i_key];
                }
            },

            clearTimelines: function(){

                if( rb.transitions._slideTimeline ){
                    rb.transitions._slideTimeline.pause().clear().kill();
                    delete rb.transitions._slideTimeline;
                }
                if( rb.transitions._forceLayersOut ){
                    rb.transitions._forceLayersOut.kill();
                    delete rb.transitions._forceLayersOut;
                }
                if( rb.transitions._slideTransition ){
                    rb.transitions._slideTransition.pause().clear().kill();
                    delete rb.transitions._slideTransition;
                }

                // In some cases we should clear some tweens from elements that are not parts of the above timelines
                gsap.TweenMax.killTweensOf( $slider.find( '.rb-bg, .rb-layer, .rb-wrapper, .rb-curtile, .rb-nexttile' ).get() );
            },

            resetSlideTimelines: function(){

                if( rb.transitions._slideTimeline ){
                    rb.transitions._slideTimeline.pause().progress(0).clear().kill();
                    delete rb.transitions._slideTimeline;
                }
                if( rb.transitions._forceLayersOut ){
                    rb.transitions._forceLayersOut.pause().progress(1).clear().kill();
                    delete rb.transitions._forceLayersOut;
                }

                $slider.find( '.rb-layer:not(.rb-bg-video)' ).each( function(){

                    var layerData = $(this).data( rb.defaults.init.dataKey );

                    // STOP: and clear loop timeline
                    if( layerData.loop._timeline ){

                        layerData.loop._timeline.stop().clear();
                        delete layerData.loop._timeline;

                        // SET: loop wrapper to default
                        gsap.TweenMax.set( layerData.elements.$loopWrapper[0], layerData.reset.loopWrapperOnSlideChange );
                    }

                    // SET: in-out wrapper to default
                    gsap.TweenMax.set( layerData.elements.$wrapper[0], layerData.reset.wrapperOnSlideChange );
                });
            },

            clearEvents: function(){
                $( window ).add( 'body' ).add( $slider ).add( $slider.find( '*') ).add( '.' + sliderUID ).off( '.' + sliderUID + ' .parallax' + sliderUID + ' .setter' + sliderUID );
                $slider.off();
            }
        };

        rb.device = {

            $overflowWrapper: $( 'body' ).length ? $( 'body' ) : $( 'html' ),

            isMobile: !!navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|webOS|Windows Phone|mobi|opera mini|nexus 7)/i),

            //isTablet: (/ipad/i.test(navigator.userAgent.toLowerCase())) || ( (/android|android 3.0|xoom|sch-i800|playbook|tablet|kindle/i.test(navigator.userAgent.toLowerCase())) && !(/mobile/i.test(navigator.userAgent.toLowerCase())) ),

            supportOrientation: !!window.DeviceOrientationEvent,

            scroll: {

                keys: [32,33,34,35,36,37,38,39,40],

                disable: function(){
                    if( window.addEventListener ){
                        window.addEventListener('DOMMouseScroll', this.preventDefault, false);
                    }
                    window.onwheel = this.preventdefault;
                    window.onmousewheel = document.onmousewheel = this.preventDefault;
                    window.ontouchmove  = this.preventDefault;
                    document.onkeydown  = this.preventDefaultForScrollKeys;
                },

                enable: function(){
                    if( window.removeEventListener ){
                        window.removeEventListener( 'DOMMouseScroll', this.preventDefault, false );
                    }
                    window.onmousewheel = document.onmousewheel = null;
                    window.onwheel = null;
                    window.ontouchmove = null;
                    document.onkeydown = null;
                },

                preventDefault: function( e ) {
                    e = e || window.event;
                    if( e.preventDefault ){
                        e.preventDefault();
                    }
                    e.returnValue = false;
                },

                preventDefaultForScrollKeys: function( e ){
                    if( rb.device.scroll.keys.indexOf(e.keyCode) !== -1 ){
                        rb.device.scroll.preventDefault( e );
                        return false;
                    }
                }
            },

            removeSelection: function(){

                if( window.getSelection ){
                    if( window.getSelection().empty ){
                        window.getSelection().empty();
                    }else if( window.getSelection().removeAllRanges ){
                        window.getSelection().removeAllRanges();
                    }
                }else if( document.selection ){  // IE?
                    document.selection.empty();
                }
            },

            fullscreen: {

                enter: function(){
                    if( rb.slider.initial.type == 'fullsize' && rb.o.fullSizeMode == 'hero' ){
                        rb.slider.heroTop = rb.slider.offsetTop;
                    }
                    rb.functions.setStates( rb.slider, {
                        inFullscreen: true
                    });
                    $( 'body, html' ).addClass( 'rb-fullscreen' );

                    rb.slider.fullscreenWrapper.requestFullscreen();
                    $slider.trigger( 'mouseleave' );
                    rb.device.removeSelection();
                },

                exit: function(){
                    rb.functions.setStates( rb.slider, {
                        inFullscreen: false
                    });
                    rb.resize.all();
                    $( 'body, html' ).removeClass( 'rb-fullscreen' );
                    rb.device.removeSelection();
                },

                toggle: function(){

                    if( !rb.device.fullscreen.element() ){
                        rb.device.fullscreen.enter();
                    }else{
                        rb.device.fullscreen.exit();
                        document.exitFullscreen();
                    }
                },

                set: function(){

                    if( rb.o.allowFullscreen && ( document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled ) ){

                        $slider.wrap( '<div class="rb-fullscreen-wrapper"></div>' );

                        rb.slider.$fullscreenWrapper = $slider.closest( '.rb-fullscreen-wrapper' );
                        rb.slider.fullscreenWrapper = rb.slider.$fullscreenWrapper[0];

                        rb.slider.fullscreenWrapper.requestFullscreen = rb.slider.fullscreenWrapper.requestFullscreen || rb.slider.fullscreenWrapper.webkitRequestFullscreen || rb.slider.fullscreenWrapper.mozRequestFullScreen || rb.slider.fullscreenWrapper.msRequestFullscreen;
                        document.exitFullscreen = document.exitFullscreen || document.webkitExitFullscreen || document.mozCancelFullScreen || document.msExitFullscreen;
                        $( document ).on( 'fullscreenchange.' + sliderUID + ' webkitfullscreenchange.' + sliderUID + ' mozfullscreenchange.' + sliderUID + ' msfullscreenchange.' + sliderUID, function(){
                            if( !rb.device.fullscreen.element() ){
                                rb.device.fullscreen.exit();
                            }
                        });

                        rb.slider.$fullscreenWrapper.on( 'dblclick.' + sliderUID, function(){
                            rb.device.fullscreen.toggle();
                        });
                    }
                },

                element: function(){ return document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement; }
            },

            getDimensions: function(){
                this.width = screen.width;
                this.height = screen.height;
                this.viewportWidth = $( window ).width();
                this.viewportHeight = $( window ).height();
                this.docWidth = $( document ).width();
                this.docHeight = $( document ).height();
                this.winScrollTop = $( window ).scrollTop();
                this.winScrollLeft = $( window ).scrollLeft();
                this.ratio = this.width / this.height;
                rb.slider.offsetTop = $slider.offset().top;
                rb.slider.offsetLeft = $slider.offset().left;
            },

            setBasicEvents: function(){

                var self = this,
                    touchEvent;

                $( window ).on( 'resize.setter' + sliderUID, function(){
                    self.viewportWidth = $( window ).width();
                    self.viewportHeight = $( window ).height();
                    self.ratio = self.width / self.height;
                    rb.slider.offsetTop = $slider.offset().top;
                    rb.slider.offsetLeft = $slider.offset().left;
                });

                $( window ).on( 'scroll.setter' + sliderUID, function(){
                    self.winScrollTop = $( window ).scrollTop();
                    self.winScrollLeft = $( window ).scrollLeft();
                    rb.slider.offsetTop = $slider.offset().top;
                    rb.slider.offsetLeft = $slider.offset().left;
                });

                $( window ).on( 'touchmove', function( event ){
                    self.winScrollTop = window.pageYOffset;
                    self.winScrollLeft = window.pageXOffset;
                    touchEvent = event.touches ? event.touches : event.originalEvent.touches;
                    if( touchEvent.length == 1 ){
                        self.touchX = touchEvent[0].clientX;
                    }
                });
            }
        };

        rb.api = {

            hasEvent: function( eventName, el ){
                var events = $._data( el || slider, 'events' );
                if( events && events[eventName] ){
                    return true;
                }
                return false;
            },

            methods: function( userSettings, param, param2, param3 ){

                if( !rb.slider.isBusy() ){

                    if( typeof userSettings == 'number' ){
                        if( userSettings > 0 && userSettings < rb.slides.count + 1 && userSettings != rb.slides.current.index ){
                            rb.slideshow.changeTo( userSettings, true, true );
                        }
                    }else{
                        switch( userSettings ){

                            case 'touchPrev':
                                rb.device.touchPrev = true;
                            case 'previousSlide':
                            case 'prev':
                                rb.navigation.prev();
                            break;

                            case 'touchNext':
                                rb.device.touchNext = true;
                            case 'nextSlide':
                            case 'next':
                                rb.navigation.next();
                            break;

                            case 'startSlideshow':
                            case 'start':
                                rb.navigation.start();
                            break;
                        }
                    }
                }

                switch( userSettings ){

                    case 'openPopup':
                        if( rb.initializedPlugins.popup ){
                            rb.initializedPlugins.popup.events.show();
                        }
                    break;

                    case 'closePopup':
                        if( rb.initializedPlugins.popup ){
                            rb.initializedPlugins.popup.events.hide();
                        }
                    break;

                    case 'updateLayerData':
                        if( param ){
                            rb.layers.update.data( param, param2, param3 );
                        }
                    break;

                    // case 'updateSlideTransition':
                    //  if( param && param2 ){
                    //      rb.slides.update.transition( param, param2 );
                    //  }
                    // break;

                    case 'redrawSlider':
                    case 'redraw':
                        rb.resize.all();
                    break;

                    case 'replaySlide':
                    case 'replay':
                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.progress( 0 );
                            rb.transitions._slideTimeline.play();
                        }
                    break;

                    case 'reverseSlide':
                    case 'reverse':
                        if( rb.transitions._slideTimeline ){
                            if( rb.transitions._slideTimeline.reversed() ){
                                rb.transitions._slideTimeline.play();
                            }else{
                                rb.transitions._slideTimeline.reverse();
                            }

                            if( param ){
                                rb.transitions.layers.timeline.shouldReplay = true;
                            }
                        }
                    break;

                    case 'stopSlideshow':
                    case 'stop':
                        rb.navigation.stop();
                    break;

                    case 'pauseSlider':
                    case 'pause':
                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.stop();
                        }
                        if( rb.transitions._slideTransition ){
                            rb.transitions._slideTransition.stop();
                        }
                        rb.media.stop( false );
                    break;

                    case 'resumePopup':
                        var $activeLayers = rb.layers.get( 'active' );
                        $activeLayers.each(function(){
                            rb.media.playIfAllowed( $(this) );
                        });

                    case 'resumeSlider':
                    case 'resume':
                        if( rb.transitions._slideTimeline ){
                            if( rb.transitions._slideTimeline.timeScale() < 0.001 ){

                                rb.transitions.layers.timeline.resume();
                            }
                            rb.transitions._slideTimeline.play();
                        }
                        if( rb.transitions._slideTransition ){
                            rb.transitions._slideTransition.play();
                        }
                    break;

                    case 'toggleSlider':
                    case 'toggle':
                        if( rb.slider.isPaused ){
                            $slider.RbSlider( 'resume' );
                            rb.slider.isPaused = false;
                        }else{
                            $slider.RbSlider( 'pause' );
                            rb.slider.isPaused = true;
                        }
                    break;

                    case 'reset':
                    case 'resetSlider':
                        // FUTURE FEATURE
                    break;

                    case 'resetSlide':
                    case 'resetCurrentSlide':
                        if( rb.transitions._slideTimeline ){
                            rb.transitions._slideTimeline.progress( 0 );
                            rb.transitions._slideTimeline.stop();
                        }
                        rb.media.stop( true );
                    break;

                    case 'destroy':
                    case 'kill':
                        if( rb.slider.state.isLoaded ){
                            rb.functions.clearTimers();
                            rb.functions.clearTimelines();
                            rb.layers.$all.removeData();
                            // API CALL: sliderDidDestroy
                            if( rb.api.hasEvent( 'sliderDidDestroy' ) ){
                                $slider.triggerHandler( 'sliderDidDestroy' );
                            }
                            if( rb.slider.state.sholudBeRemoved || param ){
                                // REMOVE: slider and related elements from DOM
                                rb.slider.$hiddenWrapper.remove();

                                if( rb.gui.timers.slidebar.$containerElement ){
                                    for( var e=0; e<rb.gui.timers.slidebar.$containerElement.length; e++ ){
                                        if( rb.gui.timers.slidebar.$containerElement[e] instanceof jQuery ){
                                            rb.gui.timers.slidebar.$containerElement[e].remove();
                                        }
                                    }
                                }
                                // API CALL: sliderDidRemove
                                if( rb.api.hasEvent( 'sliderDidRemove' ) ){
                                    $slider.triggerHandler( 'sliderDidRemove' );
                                }
                                $slider.parent( '.rb-fullscreen-wrapper' ).remove();
                            }
                            rb.functions.clearEvents();
                            window._RbSlider.removeSlider( sliderUID );
                        }else{
                            rb.functions.setStates( rb.slider, {
                                shouldBeDestroyed: true,
                                sholudBeRemoved: param ? param : false
                            });
                        }
                        // FIX: PlayByScroll
                        rb.slider.positionToViewport = 'under';
                        rb.device.scroll.enable();
                    break;
                }
            },

            eventData: function(){

                return {

                    data: rb,

                    userData: rb.o,

                    uid: sliderUID,
                    target: slider,
                    slider: $slider,
                    state: rb.slider.state,
                    isBusy: rb.slider.isBusy(),

                    api: function( command ){
                        $slider.RbSlider( command );
                    },

                    slides: {

                        first: {
                            index: rb.slides.first.index,
                            deeplink: rb.slides.get.deeplink( rb.slides.first.index )
                        },

                        prev: {
                            index: rb.slides.prev.index,
                            deeplink: rb.slides.get.deeplink( rb.slides.prev.index )
                        },

                        current: {
                            index: rb.slides.current.index || rb.slides.first.index,
                            deeplink: rb.slides.get.deeplink( rb.slides.current.index ),
                            layersIn: rb.layers.get( 'current,in' ),
                            layersOut: rb.layers.get( 'current,out' ),
                            timeline: rb.transitions._slideTimeline
                        },

                        next: {
                            index: rb.slides.next.index,
                            deeplink: rb.slides.get.deeplink( rb.slides.next.index ),
                            layersIn: rb.layers.get( 'next,in' ),
                            layersOut: rb.layers.get( 'next,out' )
                        },

                        count: rb.slides.count
                    },

                    slideChangeTimeline: rb.transitions._slideTransition,

                    slideshow: {
                        state: rb.slideshow.state,
                        sequence: rb.slideshow.sequence,
                        direction: rb.slideshow.direction,
                        isPaused: rb.slideshow.isPaused()
                    },

                    cycles: {
                        max: rb.o.cycles,
                        current: rb.slideshow.curCycle
                    }
                };
            }
        };

        rb.browser = {

            isSafari: !!navigator.userAgent.match(/(iPhone|iPod|iPad|Safari)/i) && !navigator.userAgent.match(/(Opera|Chrome|Edge)/i),

            usesFileProtocol: document.location.href.indexOf('file://') === -1 ? false : true,

            supports3D: function(){

                var testEl = $('<div>'),
                    s3d1 = false,
                    s3d2 = false,
                    properties = ['perspective', 'OPerspective', 'msPerspective', 'MozPerspective', 'WebkitPerspective'],
                    transform = ['transformStyle','OTransformStyle','msTransformStyle','MozTransformStyle','WebkitTransformStyle'];

                for (var i = properties.length - 1; i >= 0; i--){
                    s3d1 = s3d1 ? s3d1 : testEl[0].style[properties[i]] !== undefined;
                }

                // preserve 3D test

                for (var j = transform.length - 1; j >= 0; j--){
                    testEl.css( 'transform-style', 'preserve-3d' );
                    s3d2 = s3d2 ? s3d2 : testEl[0].style[transform[j]] == 'preserve-3d';
                }

                // If browser has perspective capability and it is webkit, we must check it with this solution because Chrome can give false positive result if GPU acceleration is disabled

                if (s3d1 && testEl[0].style[properties[4]] !== undefined){
                    testEl.attr('id','rb-test3d').appendTo( $slider );
                    s3d1 = testEl[0].offsetHeight === 3 && testEl[0].offsetLeft === 9;
                    testEl.remove();
                }

                return (s3d1 && s3d2);
            },

            isOld: navigator.userAgent.indexOf( 'rident/5' ) === -1 ? false : true
        };

        rb.initializedPlugins = {};

        rb.timeouts = {};

        rb.intervals = {};

        rb.plugin = {
            version: '1.0.0'
        };

        rb.slider.load();
    };

})(jQuery);