<?php
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
*/

defined('_PS_VERSION_') or exit;

require_once _PS_MODULE_DIR_.'rbthemeslider/classes/PSOpts.php';

$rbDefaults = array(

    'slider' => array(

        'createdWith' => array(
            'value' => '',
            'keys' => 'createdWith'
        ),

        'sliderVersion' => array(
            'value' => '',
            'keys' => 'sliderVersion',
            'props' => array(
                'forceoutput' => true
            )
        ),

        'status' => array(
            'value' => true,
            'name' => rb__('Status', 'RbthemeSlider'),
            'keys' => 'status',
            'desc' => rb__('Unpublished sliders will not be visible for your visitors until you re-enable this option. This also applies to scheduled sliders, thus leaving this option enabled is recommended in most cases.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'scheduleStart' => array(
            'value' => '',
            'name' => rb__('Schedule From', 'RbthemeSlider'),
            'keys' => 'schedule_start',
            'desc' => rb__("<ul>
    <li>Scheduled sliders will only be visible to your visitors between the time period you set here.</li>
    <li>We're using international date and time format to avoid ambiguity.</li>
    <li>Clear the text field above and left it empty if you want to cancel the schedule.</li>
</ul>

<span>IMPORTANT:</span>
<ul>
    <li>You will still need to set the slider status as published,</li>
    <li>and insert the slider to the target page with one of the methods described in the <a href=\"#\" target=\"_blank\">documentation</a>.</li>
</ul>", 'RbthemeSlider'),
            'attrs' => array(
                'placeholder' => rb__('No schedule', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),


        'scheduleEnd' => array(
            'value' => '',
            'name' => rb__('Schedule Until', 'RbthemeSlider'),
            'keys' => 'schedule_end',
            'desc' => '',
            'attrs' => array(
                'placeholder' => rb__('No schedule', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),


        // ============= //
        // |   Layout  | //
        // ============= //

        'hook' => array(
            'value' => '',
            'name' => rb__('Module Position'),
            'keys' => 'hook',
            'desc' => rb__('Slider will appear on the selected position.'),
            'props' => array('meta' => true),
            'attrs' => array(
                'type' => 'text',
                'placeholder' => rb__('- None -'),
                'data-options' => rb_get_hook_list()
            )
        ),

        // responsive | fullwidth | fullsize | fixedsize
        'type' => array(
            'value' => 'responsive',
            'name' => rb__('Slider type', 'RbthemeSlider'),
            'keys' => 'type',
            'desc' => '',
            'attrs' => array(
                'type' => 'hidden'
            )

        ),

        // The width of a new slider.
        'width' => array(
            'value' => 1280,
            'name' => rb__('Canvas width', 'RbthemeSlider'),
            'keys' => 'width',
            'desc' => rb__('The width of the slider canvas in pixels.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'text',
                'placeholder' => 1280
            ),
            'props' => array(
                'meta' => true
            )
        ),

        // The height of a new slider.
        'height' => array(
            'value' => 720,
            'name' => rb__('Canvas height', 'RbthemeSlider'),
            'keys' => 'height',
            'desc' => rb__('The height of the slider canvas in pixels.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'text',
                'placeholder' => 720
            ),
            'props' => array(
                'meta' => true
            )
        ),


        // The maximum width that the slider can get in responsive mode.
        'maxWidth' => array(
            'value' => '',
            'name' => rb__('Max-width', 'RbthemeSlider'),
            'keys' => 'maxwidth',
            'desc' => rb__('The maximum width your slider can take in pixels when responsive mode is enabled.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'min' => 0,
                'placeholder' => '100%'
            ),
            'props' => array(
                'meta' => true
            )
        ),


        // Turn on responsiveness under a given width of the slider.
        // Depends on: enabled fullWidth option. Defaults to: 0
        'responsiveUnder' => array(
            'value' => '',
            'name' => rb__('Responsive under', 'RbthemeSlider'),
            'keys' => array('responsiveunder', 'responsiveUnder'),
            'desc' => rb__('Turns on responsive mode in a full-width slider under the specified value in pixels. Can only be used with full-width mode.', 'RbthemeSlider'),
            'advanced' => true,
            'attrs' => array(
                'type' => 'number',
                'min' => 0,
                'placeholder' => rb__('Canvas width', 'RbthemeSlider')
            )
        ),

        'layersContrainer' => array(
            'value' => '',
            'keys' => array('sublayercontainer', 'layersContainer')
        ),


        'fullSizeMode' => array(
            'value' => 'normal',
            'name' => rb__('Mode', 'RbthemeSlider'),
            'keys' => 'fullSizeMode',
            'desc' => rb__('Select the sizing behavior of your full size sliders (e.g. hero scene).', 'RbthemeSlider'),
            'options' => array(
                'normal' => rb__('Normal', 'RbthemeSlider'),
                'hero' => rb__('Hero scene', 'RbthemeSlider'),
                'fitheight' => rb__('Fit to parent height', 'RbthemeSlider')
            ),
            'attrs' => array(
                'min' => 0
            )
        ),

        'allowFullscreen' => array(
            'value' => false,
            'name' => rb__('Allow fullscreen mode', 'RbthemeSlider'),
            'keys' => 'allowFullscreen',
            'desc' => rb__('Visitors can enter OS native full-screen mode when double clicking on the slider.', 'RbthemeSlider')
        ),

        'maxRatio' => array(
            'value' => '',
            'name' => rb__('Maximum responsive ratio', 'RbthemeSlider'),
            'keys' => 'maxRatio',
            'desc' => rb__('The slider will not enlarge your layers above the target ratio. The value 1 will keep your layers in their initial size, without any upscaling.', 'RbthemeSlider'),
            'advanced' => true
        ),

        'fitScreenWidth' => array(
            'value' => true,
            'name' => rb__('Fit to screen width', 'RbthemeSlider'),
            'keys' => 'fitScreenWidth',
            'desc' => rb__('If enabled, the slider will always have the same width as the viewport, even if a theme uses a boxed layout, unless you choose the "Fit to parent height" full size mode.', 'RbthemeSlider'),
            'advanced' => true
        ),

        'preventSliderClip' => array(
            'value' => true,
            'name' => rb__('Prevent slider clipping', 'RbthemeSlider'),
            'keys' => 'preventSliderClip',
            'desc' => rb__('Ensures that the theme cannot clip parts of the slider when used in a boxed layout.', 'RbthemeSlider'),
            'advanced' => true
        ),


        'insertMethod' => array(
            'value' => 'prependTo',
            'name' => rb__('Move the slider by', 'RbthemeSlider'),
            'keys' => 'insertMethod',
            'desc' => rb__('Move your slider to a different part of the page by providing a jQuery DOM manipulation method & selector for the target destination.', 'RbthemeSlider'),
            'options' => array(
                'prependTo' => 'prepending to',
                'appendTo' => 'appending to',
                'insertBefore' => 'inserting before',
                'insertAfter' => 'inserting after'
            )
        ),

        'insertSelector' => array(
            'value' => '',
            'keys' => 'insertSelector',
            'attrs' => array(
                'placeholder' => '#id, .class',
            )
        ),

        'clipSlideTransition' => array(
            'value' => 'disabled',
            'name' => rb__('Clip slide transition', 'RbthemeSlider'),
            'keys' => 'clipSlideTransition',
            'desc' => rb__('Choose on which axis (if any) you want to clip the overflowing content (i.e. that breaks outside of the slider bounds).', 'RbthemeSlider'),
            'advanced' => true,
            'options' => array(
                'disabled' => rb__('Do not hide', 'RbthemeSlider'),
                'enabled' => rb__('Hide on both axis', 'RbthemeSlider'),
                'x' => rb__('X Axis', 'RbthemeSlider'),
                'y' => rb__('Y Axis', 'RbthemeSlider')
            )
        ),

        // == COMPATIBILITY ==

        'responsiveness' => array(
            'value' => true,
            'keys' => 'responsive',
            'props' => array(
                'meta' => true,
                'output' => true
            )
        ),
        'fullWidth' => array(
            'value' => false,
            'keys' => 'forceresponsive',
            'props' => array(
                'meta' => true,
                'output' => true
            )
        ),

        // == END OF COMPATIBILITY ==

        'slideBGSize' => array(
            'value' => 'cover',
            'name' => rb__('Background size', 'RbthemeSlider'),
            'keys' => 'slideBGSize',
            'desc' => rb__('This will be used as a default on all slides, unless you choose to explicitly override it on a per slide basis.', 'RbthemeSlider'),
            'options' => array(
                'auto' => rb__('Auto', 'RbthemeSlider'),
                'cover' => rb__('Cover', 'RbthemeSlider'),
                'contain' => rb__('Contain', 'RbthemeSlider'),
                '100% 100%' => rb__('Stretch', 'RbthemeSlider')
            )
        ),

        'slideBGPosition' => array(
            'value' => '50% 50%',
            'name' => rb__('Background position', 'RbthemeSlider'),
            'keys' => 'slideBGPosition',
            'desc' => rb__('This will be used as a default on all slides, unless you choose the explicitly override it on a per slide basis.', 'RbthemeSlider'),
            'options' => array(
                '0% 0%' => rb__('left top', 'RbthemeSlider'),
                '0% 50%' => rb__('left center', 'RbthemeSlider'),
                '0% 100%' => rb__('left bottom', 'RbthemeSlider'),
                '50% 0%' => rb__('center top', 'RbthemeSlider'),
                '50% 50%' => rb__('center center', 'RbthemeSlider'),
                '50% 100%' => rb__('center bottom', 'RbthemeSlider'),
                '100% 0%' => rb__('right top', 'RbthemeSlider'),
                '100% 50%' => rb__('right center', 'RbthemeSlider'),
                '100% 100%' => rb__('right bottom', 'RbthemeSlider')
            )
        ),


        'parallaxSensitivity' => array(
            'value' => 10,
            'name' => rb__('Parallax sensitivity', 'RbthemeSlider'),
            'keys' => 'parallaxSensitivity',
            'desc' => rb__('Increase or decrease the sensitivity of parallax content when moving your mouse cursor or tilting your mobile device.', 'RbthemeSlider')
        ),


        'parallaxCenterLayers' => array(
            'value' => 'center',
            'name' => rb__('Parallax center layers', 'RbthemeSlider'),
            'keys' => 'parallaxCenterLayers',
            'desc' => rb__('Choose a center point for parallax content where all layers will be aligned perfectly according to their original position.', 'RbthemeSlider'),
            'options' => array(
                'center' => rb__('At center of the viewport', 'RbthemeSlider'),
                'top' => rb__('At the top of the viewport', 'RbthemeSlider')
            )
        ),

        'parallaxCenterDegree' => array(
            'value' => 40,
            'name' => rb__('Parallax center degree', 'RbthemeSlider'),
            'keys' => 'parallaxCenterDegree',
            'desc' => rb__('Provide a comfortable holding position (in degrees) for mobile devices, which should be the center point for parallax content where all layers should align perfectly.', 'RbthemeSlider')
        ),

        'parallaxScrollReverse' => array(
            'value' => false,
            'name' => 'Reverse scroll direction',
            'keys' => 'parallaxScrollReverse',
            'desc' => rb__('Your parallax layers will move to the opposite direction when scrolling the page.', 'RbthemeSlider')
        ),


        // ================= //
        // |    Mobile    | //
        // ================= //

        'optimizeForMobile' => array(
            'value' => true,
            'name' => rb__('Optimize for mobile', 'RbthemeSlider'),
            'keys' => 'optimizeForMobile',
            'advanced' => true,
            'desc' => rb__('Enable optimizations on mobile devices to avoid performance issues (e.g. fewer tiles in slide transitions, reducing performance-heavy effects with very similar results, etc).', 'RbthemeSlider')
        ),


        // Disable the slider on mobile devices.
        // Defaults to: false
        'disableOnMobile' => array(
            'value' => false,
            'name' => rb__('Disable on mobile', 'RbthemeSlider'),
            'keys' => 'disableonmobile',
            'desc' => rb__('Disable the slider on mobile devices.', 'RbthemeSlider'),
            'props' => array('meta' => true)
        ),

        // Disable the slider on tablet devices.
        // Defaults to: false
        'disableOnTablet' => array(
            'value' => false,
            'name' => rb__('Disable on tablet', 'RbthemeSlider'),
            'keys' => 'disableontablet',
            'desc' => rb__('Disable the slider on tablet devices.', 'RbthemeSlider'),
            'props' => array('meta' => true)
        ),

        // Disable the slider on desktop devices.
        // Defaults to: false
        'disableOnDesktop' => array(
            'value' => false,
            'name' => rb__('Disable on desktop', 'RbthemeSlider'),
            'keys' => 'disableondesktop',
            'desc' => rb__('Disable the slider on desktop devices.', 'RbthemeSlider'),
            'props' => array('meta' => true)
        ),

        // Hides the slider under the given value of browser width in pixels.
        // Defaults to: 0
        'hideUnder' => array(
            'value' => '',
            'name' => rb__('Hide under', 'RbthemeSlider'),
            'keys' => array('hideunder', 'hideUnder'),
            'desc' => rb__('Hides the slider when the viewport width goes under the specified value.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'min' => -1
            )
        ),

        // Hides the slider over the given value of browser width in pixel.
        // Defaults to: 100000
        'hideOver' => array(
            'value' => '',
            'name' => rb__('Hide over', 'RbthemeSlider'),
            'keys' => array('hideover', 'hideOver'),
            'desc' => rb__('Hides the slider when the viewport becomes wider than the specified value.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'min' => -1
            )
        ),

        'slideOnSwipe' => array(
            'value' => true,
            'name' => rb__('Use slide effect when swiping', 'RbthemeSlider'),
            'keys' => 'slideOnSwipe',
            'desc' => rb__('Ignore selected slide transitions and use sliding effects only when users are changing slides with a swipe gesture on mobile devices.', 'RbthemeSlider')
        ),

        // ================ //
        // |   Slideshow  | //
        // ================ //

        // Automatically start slideshow.
        'autoStart' => array(
            'value' => true,
            'name' => rb__('Auto-start slideshow', 'RbthemeSlider'),
            'keys' => array('autostart', 'autoStart'),
            'desc' => rb__('Slideshow will automatically start after page load.', 'RbthemeSlider')
        ),

        'startInViewport' => array(
            'value' => true,
            'name' => rb__('Start only in viewport', 'RbthemeSlider'),
            'keys' => array('startinviewport', 'startInViewport'),
            'desc' => rb__('The slider will not start until it becomes visible.', 'RbthemeSlider')
        ),

        'hashChange' => array(
            'value' => false,
            'name' => rb__('Change URL hash', 'RbthemeSlider'),
            'keys' => 'hashChange',
            'desc' => rb__('Updates the hash in the page URL when changing slides based on the deeplinks you’ve set to your slides. This makes it possible to share URLs that will start the slider with the currently visible slide.', 'RbthemeSlider'),
            'advanced' => true
        ),

        'pauseLayers' => array(
            'value' => false,
            'name' => rb__('Pause layers', 'RbthemeSlider'),
            'keys' => 'pauseLayers',
            'desc' => rb__('If you enable this option, layer transitions will not start playing as long the slideshow is in a paused state.', 'RbthemeSlider'),
            'advanced' => true
        ),

        'pauseOnHover' => array(
            'value' => 'enabled',
            'name' => rb__('Pause on hover', 'RbthemeSlider'),
            'keys' => array('pauseonhover', 'pauseOnHover'),
            'options' => array(
                'disabled' => rb__('Do nothing', 'RbthemeSlider'),
                'enabled' => rb__('Pause slideshow', 'RbthemeSlider'),
                'layers' => rb__('Pause slideshow and layer transitions', 'RbthemeSlider'),
                'looplayers' => rb__('Pause slideshow and layer transitions, including loops', 'RbthemeSlider')
            ),
            'desc' => rb__('Decide what should happen when you move your mouse cursor over the slider.', 'RbthemeSlider')
        ),

        // The starting slide of a slider. Non-index value, starts with 1.
        'firstSlide' => array(
            'value' => 1,
            'name' => rb__('Start with slide', 'RbthemeSlider'),
            'keys' => array('firstlayer', 'firstSlide'),
            'desc' => rb__('The slider will start with the specified slide. You can also use the value "random".', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '["random"]')
        ),

        // Use global shortcuts to control the slider.
        'keybNavigation' => array(
            'value' => true,
            'name' => rb__('Keyboard navigation', 'RbthemeSlider'),
            'keys' => array('keybnav', 'keybNav'),
            'desc' => rb__('You can navigate through slides with the left and right arrow keys.', 'RbthemeSlider')
        ),

        // Accepts touch gestures if enabled.
        'touchNavigation' => array(
            'value' => true,
            'name' => rb__('Touch navigation', 'RbthemeSlider'),
            'keys' => array('touchnav', 'touchNav'),
            'desc' => rb__('Gesture-based navigation when swiping on touch-enabled devices.', 'RbthemeSlider')
        ),

        'playByScroll' => array(
            'value' => false,
            'name' => rb__('Play By Scroll', 'RbthemeSlider'),
            'keys' => 'playByScroll',
            'desc' => rb__('Play the slider by scrolling the web page. <a href="#" target="_blank">Click here</a> to see a live example.', 'RbthemeSlider'),
            'premium' => true
        ),


        'playByScrollSpeed' => array(
            'value' => 1,
            'name' => rb__('Play By Scroll Speed', 'RbthemeSlider'),
            'keys' => 'playByScrollSpeed',
            'desc' => rb__('Play By Scroll speed multiplier.', 'RbthemeSlider'),
            'premium' => true
        ),

        'playByScrollStart' => array(
            'value' => false,
            'name' => rb__('Start immediately', 'RbthemeSlider'),
            'keys' => 'playByScrollStart',
            'desc' => rb__('Instead of freezing the slider until visitors start scrolling, the slider will automatically start playback and will only pause at the first keyframe.', 'RbthemeSlider'),
            'premium' => true
        ),

        // Number of loops taking by the slideshow.
        // Depends on: shuffle. Defaults to: 0 => infinite
        'loops' => array(
            'value' => 0,
            'name' => rb__('Cycles', 'RbthemeSlider'),
            'keys' => array('loops', 'cycles'),
            'desc' => rb__('Number of cycles if slideshow is enabled.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'min' => 0
            )
        ),

        // The slideshow will always stop at the given number of
        // loops, even when the user restarts slideshow.
        // Depends on: loop. Defaults to: true
        'forceLoopNumber' => array(
            'value' => true,
            'name' => rb__('Force number of cycles', 'RbthemeSlider'),
            'keys' => array('forceloopnum', 'forceCycles'),
            'advanced' => true,
            'desc' => rb__('The slider will always stop at the given number of cycles, even if the slideshow restarts.', 'RbthemeSlider')
        ),

        // The slideshow will change slides in random order.
        'shuffle' => array(
            'value' => false,
            'name' => rb__('Shuffle mode', 'RbthemeSlider'),
            'keys' => array('randomslideshow', 'shuffleSlideshow'),
            'desc' => rb__('Slideshow will proceed in random order. This feature does not work with looping.', 'RbthemeSlider')
        ),

        // Whether slideshow should goind backwards or not
        // when you switch to a previous slide.
        'twoWaySlideshow' => array(
            'value' => false,
            'name' => rb__('Two way slideshow', 'RbthemeSlider'),
            'keys' => array('twowayslideshow', 'twoWaySlideshow'),
            'advanced' => true,
            'desc' => rb__('Slideshow can go backwards if someone switches to a previous slide.', 'RbthemeSlider')
        ),

        'forceLayersOutDuration' => array(
            'value' => 750,
            'name' => rb__('Forced animation duration', 'RbthemeSlider'),
            'keys' => 'forceLayersOutDuration',
            'advanced' => true,
            'desc' => rb__('The animation speed in milliseconds when the slider forces remaining layers out of scene before swapping slides.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0
            )
        ),

        // ================= //
        // |   Appearance  | //
        // ================= //

        // The default skin.
        'skin' => array(
            'value' => 'v6',
            'name' => rb__('Skin', 'RbthemeSlider'),
            'keys' => 'skin',
            'desc' => rb__("The skin used for this slider. The 'noskin' skin is a border- and buttonless skin. Your custom skins will appear in the list when you create their folders.", "RbthemeSlider"),
            'props' => array(
                'output' => true
            )
        ),


        'sliderFadeInDuration' => array(
            'value' => 350,
            'name' => rb__('Initial fade duration', 'RbthemeSlider'),
            'keys' => array('sliderfadeinduration', 'sliderFadeInDuration'),
            'advanced' => true,
            'desc' => rb__('Change the duration of the initial fade animation when the page loads. Enter 0 to disable fading.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0
            )
        ),

        'sliderClasses' => array(
            'value' => '',
            'name' => rb__('Slider Classes', 'RbthemeSlider'),
            'keys' => 'sliderclass',
            'desc' => rb__('One or more space-separated class names to be added to the slider container element.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        // Some CSS values you can append on each slide individually
        // to make some adjustments if needed.
        'sliderStyle' => array(
            'value' => 'margin-bottom: 0px;',
            'name' => rb__('Slider CSS', 'RbthemeSlider'),
            'keys' => array('sliderstyle', 'sliderStyle'),
            'desc' => rb__('You can enter custom CSS to change some style properties on the slider wrapper element. More complex CSS should be applied with the Custom Styles Editor.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),


        // Global background color on all slides.
        'globalBGColor' => array(
            'value' => '',
            'name' => rb__('Background color', 'RbthemeSlider'),
            'keys' => array('backgroundcolor', 'globalBGColor'),
            'desc' => rb__('Global background color of the slider. Slides with non-transparent background will cover this one. You can use all CSS methods such as HEX or RGB(A) values.', 'RbthemeSlider')
        ),

        // Global background image on all slides.
        'globalBGImage' => array(
            'value' => '',
            'name' => rb__('Background image', 'RbthemeSlider'),
            'keys' => array('backgroundimage', 'globalBGImage'),
            'desc' => rb__('Global background image of the slider. Slides with non-transparent backgrounds will cover it. This image will not scale in responsive mode.', 'RbthemeSlider')
        ),

        'globalBGImageId' => array(
            'value' => '',
            'keys' => array('backgroundimageId', 'globalBGImageId'),
            'props' => array(
                'meta' => true
            )
        ),

        // Global background image repeat
        'globalBGRepeat' => array(
            'value' => 'no-repeat',
            'name' => rb__('Background repeat', 'RbthemeSlider'),
            'keys' => 'globalBGRepeat',
            'desc' => rb__('Global background image repeat.', 'RbthemeSlider'),
            'options' => array(
                'no-repeat' => rb__('No-repeat', 'RbthemeSlider'),
                'repeat' => rb__('Repeat', 'RbthemeSlider'),
                'repeat-x' => rb__('Repeat-x', 'RbthemeSlider'),
                'repeat-y' => rb__('Repeat-y', 'RbthemeSlider')
            )
        ),

        // Global background image behavior
        'globalBGAttachment' => array(
            'value' => 'scroll',
            'name' => rb__('Background behavior', 'RbthemeSlider'),
            'keys' => 'globalBGAttachment',
            'desc' => rb__('Choose between a scrollable or fixed global background image.', 'RbthemeSlider'),
            'options' => array(
                'scroll' => rb__('Scroll', 'RbthemeSlider'),
                'fixed' => rb__('Fixed', 'RbthemeSlider')
            )
        ),

        // Global background image position
        'globalBGPosition' => array(
            'value' => '50% 50%',
            'name' => rb__('Background position', 'RbthemeSlider'),
            'keys' => 'globalBGPosition',
            'desc' => rb__('Global background image position of the slider. The first value is the horizontal position and the second value is the vertical.', 'RbthemeSlider')
        ),

        // Global background image size
        'globalBGSize' => array(
            'value' => 'auto',
            'name' => rb__('Background size', 'RbthemeSlider'),
            'keys' => 'globalBGSize',
            'desc' => rb__('Global background size of the slider. You can set the size in pixels, percentages, or constants: auto | cover | contain ', 'RbthemeSlider'),
            'attrs' => array('data-options' => '[{
                "name": "auto",
                "value": "auto"
            }, {
                "name": "cover",
                "value": "cover"
            }, {
                "name": "contain",
                "value": "contain"
            }, {
                "name": "stretch",
                "value": "100% 100%"
            }]')
        ),



        // ================= //
        // |   Navigation  | //
        // ================= //

        // Show the next and previous buttons.
        'navPrevNextButtons' => array(
            'value' => true,
            'name' => rb__('Show Prev & Next buttons', 'RbthemeSlider'),
            'keys' => array('navprevnext', 'navPrevNext'),
            'desc' => rb__('Disabling this option will hide the Prev and Next buttons.', 'RbthemeSlider')
        ),

        // Show the next and previous buttons
        // only when hovering over the slider.
        'hoverPrevNextButtons' => array(
            'value' => true,
            'name' => rb__('Show Prev & Next buttons on hover', 'RbthemeSlider'),
            'keys' => array('hoverprevnext', 'hoverPrevNext'),
            'desc' => rb__('Show the buttons only when someone moves the mouse cursor over the slider. This option depends on the previous setting.', 'RbthemeSlider')
        ),

        // Show the start and stop buttons
        'navStartStopButtons' => array(
            'value' => true,
            'name' => rb__('Show Start & Stop buttons', 'RbthemeSlider'),
            'keys' => array('navstartstop', 'navStartStop'),
            'desc' => rb__('Disabling this option will hide the Start & Stop buttons.', 'RbthemeSlider')
        ),

        // Show the slide buttons or thumbnails.
        'navSlideButtons' => array(
            'value' => true,
            'name' => rb__('Show slide navigation buttons', 'RbthemeSlider'),
            'keys' => array('navbuttons', 'navButtons'),
            'desc' => rb__('Disabling this option will hide slide navigation buttons or thumbnails.', 'RbthemeSlider')
        ),

        // Show the slider buttons or thumbnails
        // ony when hovering over the slider.
        'hoverSlideButtons' => array(
            'value' => false,
            'name' => rb__('Slide navigation on hover', 'RbthemeSlider'),
            'keys' => array('hoverbottomnav', 'hoverBottomNav'),
            'desc' => rb__('Slide navigation buttons (including thumbnails) will be shown on mouse hover only.', 'RbthemeSlider')
        ),

        // Show bar timer
        'barTimer' => array(
            'value' => false,
            'name' => rb__('Show bar timer', 'RbthemeSlider'),
            'keys' => array('bartimer', 'showBarTimer'),
            'desc' => rb__('Show the bar timer to indicate slideshow progression.', 'RbthemeSlider')
        ),

        // Show circle timer. Requires CSS3 capable browser.
        // This setting will overrule the 'barTimer' option.
        'circleTimer' => array(
            'value' => true,
            'name' => rb__('Show circle timer', 'RbthemeSlider'),
            'keys' => array('circletimer', 'showCircleTimer'),
            'desc' => rb__('Use circle timer to indicate slideshow progression.', 'RbthemeSlider')
        ),

        'slideBarTimer' => array(
            'value' => false,
            'name' => rb__('Show slidebar timer', 'RbthemeSlider'),
            'keys' => array('slidebartimer', 'showSlideBarTimer'),
            'desc' => rb__('You can grab the slidebar timer playhead and seek the whole slide real-time like a movie.', 'RbthemeSlider')
        ),

        // ========================== //
        // |  Thumbnail navigation  | //
        // ========================== //

        // Use thumbnails for slide buttons
        // Depends on: navSlideButtons.
        // Possible values: 'disabled', 'hover', 'always'
        'thumbnailNavigation' => array(
            'value' => 'hover',
            'name' => rb__('Thumbnail navigation', 'RbthemeSlider'),
            'keys' => array('thumb_nav', 'thumbnailNavigation'),
            'desc' => rb__('Use thumbnail navigation instead of slide bullet buttons.', 'RbthemeSlider'),
            'options' => array(
                'disabled' => rb__('Disabled', 'RbthemeSlider'),
                'hover' => rb__('Hover', 'RbthemeSlider'),
                'always' => rb__('Always', 'RbthemeSlider')
            )
        ),

        // The width of the thumbnail area in percents.
        'thumbnailAreaWidth' => array(
            'value' => '60%',
            'name' => rb__('Thumbnail container width', 'RbthemeSlider'),
            'keys' => array('thumb_container_width', 'tnContainerWidth'),
            'desc' => rb__('The width of the thumbnail area relative to the slider size.', 'RbthemeSlider')
        ),

        // Thumbnails' width in pixels.
        'thumbnailWidth' => array(
            'value' => 100,
            'name' => rb__('Thumbnail width', 'RbthemeSlider'),
            'keys' => array('thumb_width', 'tnWidth'),
            'desc' => rb__('The width of thumbnails in the navigation area.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0
            )
        ),

        // Thumbnails' height in pixels.
        'thumbnailHeight' => array(
            'value' => 60,
            'name' => rb__('Thumbnail height', 'RbthemeSlider'),
            'keys' => array('thumb_height', 'tnHeight'),
            'desc' => rb__('The height of thumbnails in the navigation area.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0
            )
        ),


        // The opacity of the active thumbnail in percents.
        'thumbnailActiveOpacity' => array(
            'value' => 35,
            'name' => rb__('Active thumbnail opacity', 'RbthemeSlider'),
            'keys' => array('thumb_active_opacity', 'tnActiveOpacity'),
            'desc' => rb__("Opacity in percentage of the active slide's thumbnail.", "RbthemeSlider"),
            'attrs' => array(
                'min' => 0,
                'max' => 100
            )
        ),

        // The opacity of inactive thumbnails in percents.
        'thumbnailInactiveOpacity' => array(
            'value' => 100,
            'name' => rb__('Inactive thumbnail opacity', 'RbthemeSlider'),
            'keys' => array('thumb_inactive_opacity', 'tnInactiveOpacity'),
            'desc' => rb__('Opacity in percentage of inactive slide thumbnails.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0,
                'max' => 100
            )
        ),

        // ============ //
        // |  Videos  | //
        // ============ //

        // Automatically starts vidoes on the given slide.
        'autoPlayVideos' => array(
            'value' => true,
            'name' => rb__('Automatically play videos', 'RbthemeSlider'),
            'keys' => array('autoplayvideos', 'autoPlayVideos'),
            'desc' => rb__('Videos will be automatically started on the active slide.', 'RbthemeSlider')
        ),

        // Automatically pauses the slideshow when a video is playing.
        // Auto means it only pauses the slideshow while the video is playing.
        // Possible values: 'auto', 'enabled', 'disabled'
        'autoPauseSlideshow' => array(
            'value' => 'auto',
            'name' => rb__('Pause slideshow', 'RbthemeSlider'),
            'keys' => array('autopauseslideshow', 'autoPauseSlideshow'),
            'desc' => rb__('The slideshow can temporally be paused while videos are playing. You can choose to permanently stop the pause until manual restarting.', 'RbthemeSlider'),
            'options' => array(
                'auto' => rb__('While playing', 'RbthemeSlider'),
                'enabled' => rb__('Permanently', 'RbthemeSlider'),
                'disabled' => rb__('No action', 'RbthemeSlider')
            )
        ),

        // The preview image quality of a YouTube video.
        // Some videos doesn't have HD preview images and
        // you may have to lower the quality settings.
        // Possible values:
            // 'maxresdefault.jpg',
            // 'hqdefault.jpg',
            // 'mqdefault.jpg',
            // 'default.jpg'
        'youtubePreviewQuality' => array(
            'value' => 'maxresdefault.jpg',
            'name' => rb__('Youtube preview', 'RbthemeSlider'),
            'keys' => array('youtubepreview', 'youtubePreview'),
            'desc' => rb__('The automatically fetched preview image quaility for YouTube videos when you do not set your own. Please note, some videos do not have HD previews, and you may need to choose a lower quaility.', 'RbthemeSlider'),
            'options' => array(
                'maxresdefault.jpg' => rb__('Maximum quality', 'RbthemeSlider'),
                'hqdefault.jpg' => rb__('High quality', 'RbthemeSlider'),
                'mqdefault.jpg' => rb__('Medium quality', 'RbthemeSlider'),
                'default.jpg' => rb__('Default quality', 'RbthemeSlider')
            )
        ),

        // ========== //
        // |  Misc  | //
        // ========== //


        // Ignores the host/domain names in URLS by converting the to
        // relative format. Useful when you move your site.
        // Prevents linking content from 3rd party servers.
        'relativeURLs' => array(
            'value' => false,
            'name' => rb__('Use relative URLs', 'RbthemeSlider'),
            'keys' => 'relativeurls',
            'desc' => rb__('Use relative URLs for local images. This setting could be important when moving your PS installation.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'allowRestartOnResize' => array(
            'value' => false,
            'name' => rb__('Allow restarting slides on resize', 'RbthemeSlider'),
            'keys' => 'allowRestartOnResize',
            'desc' => rb__('Certain transformation and transition options cannot be updated on the fly when the browser size or device orientation changes. By enabling this option, the slider will automatically detect such situations and will restart the itself to preserve its appearance.', 'RbthemeSlider'),
            'advanced' => true
        ),

        'useSrcset' => array(
            'value' => true,
            'name' => rb__('Use srcset attribute', 'RbthemeSlider'),
            'keys' => 'useSrcset',
            'desc' => rb__('The srcset attribute allows loading dynamically scaled images based on screen resolution. It can save bandwidth and allow using retina-ready images on high resolution devices. In some rare edge cases, this option might cause blurry images.', 'RbthemeSlider')
        ),

        'preferBlendMode' => array(
            'value' => 'disabled',
            'name' => rb__('Prefer Blend Mode', 'RbthemeSlider'),
            'keys' => 'preferBlendMode',
            'desc' => rb__('Enable this option to avoid blend mode issues with slide transitions. Due to technical limitations, this will also clip your slide transitions regardless of your settings.', 'RbthemeSlider'),
            'options' => array(
                'enabled' => rb__('Enabled', 'RbthemeSlider'),
                'disabled' => rb__('Disabled', 'RbthemeSlider')
            ),
            'advanced' => true
        ),


        // ============== //
        // |  YourLogo  | //
        // ============== //

        // Places a fixed image on the top of the slider.
        'yourLogoImage' => array(
            'value' => '',
            'name' => rb__('YourLogo', 'RbthemeSlider'),
            'keys' => array('yourlogo', 'yourLogo'),
            'desc' => rb__('A fixed image layer can be shown above the slider that remains still throughout the whole slider. Can be used to display logos or watermarks.', 'RbthemeSlider')
        ),

        // Custom CSS style settings for the YourLogo image.
        // Depends on: yourLogoImage
        'yourLogoStyle' => array(
            'value' => 'left: -10px; top: -10px;',
            'name' => rb__('YourLogo style', 'RbthemeSlider'),
            'keys' => array('yourlogostyle', 'yourLogoStyle'),
            'desc' => rb__('CSS properties to control the image placement and appearance.', 'RbthemeSlider')
        ),

        // Linking the YourLogo image to a given URL.
        // Depends on: yourLogoImage
        'yourLogoLink' => array(
            'value' => '',
            'name' => rb__('YourLogo link', 'RbthemeSlider'),
            'keys' => array('yourlogolink', 'yourLogoLink'),
            'desc' => rb__('Enter a URL to link the YourLogo image.', 'RbthemeSlider')
        ),

        // Link target for yourLogoLink.
        // Depends on: yourLogoLink
        'yourLogoTarget' => array(
            'value' => '_self',
            'name' => rb__('Link target', 'RbthemeSlider'),
            'keys' => array('yourlogotarget', 'yourLogoTarget'),
            'desc' => '',
            'options' => array(
                '_self' => rb__('Open on the same page', 'RbthemeSlider'),
                '_blank' => rb__('Open on new page', 'RbthemeSlider'),
                '_parent' => rb__('Open in parent frame', 'RbthemeSlider'),
                '_top' => rb__('Open in main frame', 'RbthemeSlider')
            ),
        ),

        // Post options
        'postType' => array(
            'value' => '',
            'keys' => 'post_type',
            'props' => array(
                'meta' => true
            )
        ),

        'postOrderBy' => array(
            'value' => 'date',
            'keys' => 'post_orderby',
            'options' => array(
                'date' => rb__('Date Created', 'RbthemeSlider'),
                'modified' => rb__('Last Modified', 'RbthemeSlider'),
                'ID' => rb__('Post ID', 'RbthemeSlider'),
                'title' => rb__('Post Title', 'RbthemeSlider'),
                'comment_count' => rb__('Number of Comments', 'RbthemeSlider'),
                'rand' => rb__('Random', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'postOrder' => array(
            'value' => 'DESC',
            'keys' => 'post_order',
            'options' => array(
                'ASC' => rb__('Ascending', 'RbthemeSlider'),
                'DESC' => rb__('Descending', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'postCategories' => array(
            'value' => '',
            'keys' => 'post_categories',
            'props' => array(
                'meta' => true
            )
        ),

        'postTags' => array(
            'value' => '',
            'keys' => 'post_tags',
            'props' => array(
                'meta' => true
            )
        ),

        'postTaxonomy' => array(
            'value' => '',
            'keys' => 'post_taxonomy',
            'props' => array(
                'meta' => true
            )
        ),

        'postTaxTerms' => array(
            'value' => '',
            'keys' => 'post_tax_terms',
            'options' => PSOpts::getProductImgTypes(),
            'props' => array(
                'meta' => true
            )
        ),

        // Old and obsolete API
        'cbInit' => array(
            'value' => "function(element) {\r\n\r\n}",
            'keys' => array('cbinit','cbInit'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbStart' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbstart','cbStart'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbStop' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbstop','cbStop'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbPause' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbpause','cbPause'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbAnimStart' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbanimstart','cbAnimStart'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbAnimStop' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbanimstop','cbAnimStop'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbPrev' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbprev','cbPrev'),
            'props' => array(
                'meta' => true
            )
        ),

        'cbNext' => array(
            'value' => "function(data) {\r\n\r\n}",
            'keys' => array('cbnext','cbNext'),
            'props' => array(
                'meta' => true
            )
        ),
    ),

    'slides' => array(

        // The background image of slides
        // Defaults to: void
        'image' => array (
            'value' => '',
            'name' => rb__('Set a slide image', 'RbthemeSlider'),
            'keys' => 'background',
            'tooltip' => rb__('The slide image/background. Click on the image to open the Image Manager to choose or upload an image.', 'RbthemeSlider'),
            'props' => array('meta' => true)
        ),

        'imageId' => array (
            'value' => '',
            'keys' => 'backgroundId',
            'props' => array('meta' => true)
        ),

        'imageSize' => array(
            'value' => 'inherit',
            'name' => rb__('Size', 'RbthemeSlider'),
            'keys' => 'bgsize',
            'tooltip' => rb__('The size of the slide background image. Leave this option on inherit if you want to set it globally from Slider Settings.', 'RbthemeSlider'),
            'options' => array(
                'inherit' => rb__('Inherit', 'RbthemeSlider'),
                'auto' => rb__('Auto', 'RbthemeSlider'),
                'cover' => rb__('Cover', 'RbthemeSlider'),
                'contain' => rb__('Contain', 'RbthemeSlider'),
                '100% 100%' => rb__('Stretch', 'RbthemeSlider')
            )
        ),

        'imagePosition' => array(
            'value' => 'inherit',
            'name' => rb__('Position', 'RbthemeSlider'),
            'keys' => 'bgposition',
            'tooltip' => rb__('The position of the slide background image. Leave this option on inherit if you want to set it globally from Slider Settings.', 'RbthemeSlider'),
            'options' => array(
                'inherit' => rb__('Inherit', 'RbthemeSlider'),
                '0% 0%' => rb__('left top', 'RbthemeSlider'),
                '0% 50%' => rb__('left center', 'RbthemeSlider'),
                '0% 100%' => rb__('left bottom', 'RbthemeSlider'),
                '50% 0%' => rb__('center top', 'RbthemeSlider'),
                '50% 50%' => rb__('center center', 'RbthemeSlider'),
                '50% 100%' => rb__('center bottom', 'RbthemeSlider'),
                '100% 0%' => rb__('right top', 'RbthemeSlider'),
                '100% 50%' => rb__('right center', 'RbthemeSlider'),
                '100% 100%' => rb__('right bottom', 'RbthemeSlider')
            )
        ),

        'imageColor' => array(
            'value' => '',
            'name' => rb__('Color', 'RbthemeSlider'),
            'keys' => 'bgcolor',
            'tooltip' => rb__('The slide background color. You can use color names, hexadecimal, RGB or RGBA values.', 'RbthemeSlider')
        ),

        'thumbnail' => array (
            'value' => '',
            'name' => rb__('Set a slide thumbnail', 'RbthemeSlider'),
            'keys' => 'thumbnail',
            'tooltip' => rb__('The thumbnail image of this slide. Click on the image to open the Image Manager to choose or upload an image. If you leave this field empty, the slide image will be used.', 'RbthemeSlider'),
            'props' => array('meta' => true)
        ),

        'thumbnailId' => array (
            'value' => '',
            'keys' => 'thumbnailId',
            'props' => array('meta' => true)
        ),

        // Default slide delay in millisecs.
        // Defaults to: 4000 (ms) => 4secs
        'delay' => array(
            'value' => '',
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => array('slidedelay', 'duration'),
            'tooltip' => rb__("Here you can set the time interval between slide changes, this slide will stay visible for the time specified here. This value is in millisecs, so the value 1000 means 1 second. Please don't use 0 or very low values.", "RbthemeSlider"),
            'attrs' => array(
                'type' => 'number',
                'min' => 0,
                'step' => 500,
                'placeholder' => 'auto'
            )
        ),

        '2dTransitions' => array(
            'value' => '',
            'keys' => array('2d_transitions', 'transition2d')
        ),

        '3dTransitions' => array(
            'value' => '',
            'keys' => array('3d_transitions', 'transition3d')
        ),

        'custom2dTransitions' => array(
            'value' => '',
            'keys' => array('custom_2d_transitions', 'customtransition2d')
        ),

        'custom3dTransitions' => array(
            'value' => '',
            'keys' => array('custom_3d_transitions', 'customtransition3d')
        ),

        'transitionOrigami' => array(
            'value' => false,
            'keys' => 'transitionorigami',
            'premium' => true
        ),

        'transitionDuration' => array(
            'value' => '',
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => 'transitionduration',
            'tooltip' => rb__("We've made our pre-defined slide transitions with special care to fit in most use cases. However, if you would like to increase or decrease the speed of these transitions, you can override their timing here by providing your own transition length in milliseconds. (1 second = 1000 milliseconds)", "RbthemeSlider"),
            'attrs' => array(
                'type' => 'number',
                'min' => 0,
                'step' => 500,
                'placeholder' => rb__('custom duration', 'RbthemeSlider')
            )

        ),

        'timeshift' => array(
            'value' => 0,
            'name' => rb__('Time Shift', 'RbthemeSlider'),
            'keys' => 'timeshift',
            'tooltip' => rb__("You can shift the starting point of the slide animation timeline, so layers can animate in an earlier time after a slide change. This value is in milliseconds. A second is 1000 milliseconds. You can only use a negative value.", 'RbthemeSlider'),
            'attrs' => array(
                'step' => 50
            )
        ),

        'linkUrl' => array(
            'value' => '',
            'name' => rb__('Enter URL', 'RbthemeSlider'),
            'keys' => array('layer_link', 'linkUrl'),
            'tooltip' => rb__('If you want to link the whole slide, type the URL here. You can choose one of the pre-defined options from the dropdown list when you click into this field. You can also type a hash mark followed by a number to link this layer to another slide. Example: #3 - this will switch to the third slide.', 'RbthemeSlider'),
            'attrs' => array(
                'data-options' => '[{
                    "name": "Switch to the next slide",
                    "value": "#next"
                }, {
                    "name": "Switch to the previous slide",
                    "value": "#prev"
                }, {
                    "name": "Stop the slideshow",
                    "value": "#stop"
                }, {
                    "name": "Resume the slideshow",
                    "value": "#start"
                }, {
                    "name": "Replay the slide from the start",
                    "value": "#replay"
                }, {
                    "name": "Reverse the slide, then pause it",
                    "value": "#reverse"
                }, {
                    "name": "Reverse the slide, then replay it",
                    "value": "#reverse-replay"
                }]'
            ),
            'props' => array(
                'meta' => true
            )

        ),

        'linkId' => array(
            'value' => '',
            'keys' => 'linkId',
            'props' => array( 'meta' => true )
        ),

        'linkTarget' => array(
            'value' => '_self',
            'name' => rb__('Link Target', 'RbthemeSlider'),
            'keys' => array('layer_link_target', 'linkTarget'),
            'options' => array(
                '_self' => rb__('Open on the same page', 'RbthemeSlider'),
                '_blank' => rb__('Open on new page', 'RbthemeSlider'),
                '_parent' => rb__('Open in parent frame', 'RbthemeSlider'),
                '_top' => rb__('Open in main frame', 'RbthemeSlider'),
                'ls-scroll' => rb__('Scroll to element (Enter selector)', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )

        ),

        'linkType' => array(
            'value' => 'over',
            'keys' => array('layer_link_type', 'linkType'),
            'tooltip' => rb__('Choose whether the slide link should be on top or underneath your layers. The later option makes the link clickable only at empty spaces where the slide background is visible, and enables you to link both slides and layers independently from each other.', 'RbthemeSlider'),
            'options' => array(
                'over' => rb__('On top of layers', 'RbthemeSlider'),
                'under' => rb__('Underneath layers', 'RbthemeSlider'),
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'ID' => array(
            'value' => '',
            'name' => rb__('#ID', 'RbthemeSlider'),
            'keys' => 'id',
            'tooltip' => rb__('You can apply an ID attribute on the HTML element of this slide to work with it in your custom CSS or Javascript code.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'deeplink' => array(
            'value' => '',
            'name' => rb__('Deeplink', 'RbthemeSlider'),
            'keys' => 'deeplink',
            'tooltip' => rb__('You can specify a slide alias name which you can use in your URLs with a hash mark, so RbthemeSlider will start with the correspondig slide.', 'RbthemeSlider')
        ),

        'globalHover' => array(
            'value' => false,
            'name' => rb__('Global Hover', 'RbthemeSlider'),
            'keys' => 'globalhover',
            'tooltip' => rb__('By turning this option on, all layers will trigger their Hover Transitions at the same time when you hover over the slider with your mouse cursor. It’s useful to create spectacular effects that involve multiple layer transitions and activate on hovering over the slider instead of individual layers.', 'RbthemeSlider'),
            'premium' => true
        ),

        'postContent' => array(
            'value' => null,
            'keys' => 'post_content',
            'props' => array(
                'meta' => true
            )
        ),


        'postOffset' => array(
            'value' => '',
            'keys' => 'post_offset',
            'props' => array(
                'meta' => true
            )
        ),

        'skipSlide' => array(
            'value' => false,
            'name' => rb__('Hidden', 'RbthemeSlider'),
            'keys' => 'skip',
            'tooltip' => rb__("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),


        'overflow' => array(
            'value' => false,
            'name' => rb__('Overflow layers', 'RbthemeSlider'),
            'keys' => 'overflow',
            'tooltip' => rb__('By default the slider clips the layers outside of its bounds. Enable this option to allow overflowing content.', 'RbthemeSlider')
        ),

        'scheduleStart' => array(
            'value' => '',
            'name' => rb__('Start on'),
            'keys' => 'schedule_start',
            'desc' => rb__("Scheduled slide will only be visible to your visitors between the time period you set here.<br>We're using international date and time format to avoid ambiguity."),
            'attrs' => array(
                'placeholder' => rb__('No schedule')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'scheduleEnd' => array(
            'value' => '',
            'name' => rb__('Stop on'),
            'keys' => 'schedule_end',
            'desc' => 'Clear the text field above and left it empty if you want to cancel the schedule.',
            'attrs' => array(
                'placeholder' => rb__('No schedule')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'title' => array(
            'value' => '',
            'name' => rb__('Title', 'RbthemeSlider'),
            'keys' => 'title',
            'props' => array('meta' => true),
        ),

        'alt' => array(
            'value' => '',
            'name' => rb__('Alt', 'RbthemeSlider'),
            'keys' => 'alt',
            'tooltip' => rb__('Name or describe your slide image, so search engines and VoiceOver softwares can properly identify it.', 'RbthemeSlider'),
            'props' => array('meta' => true),
        ),

        // Ken Burns effect
        'kenBurnsZoom' => array(
            'value' => 'disabled',
            'name' => rb__('Zoom', 'RbthemeSlider'),
            'keys' => 'kenburnszoom',
            'options' => array(
                'disabled' => rb__('Disabled', 'RbthemeSlider'),
                'in' => rb__('Zoom In', 'RbthemeSlider'),
                'out' => rb__('Zoom Out', 'RbthemeSlider'),
            )
        ),

        'kenBurnsRotate' => array(
            'value' => '',
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'kenburnsrotate',
            'tooltip' => rb__('The amount of rotation (if any) in degrees used in the Ken Burns effect. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider'),

        ),

        'kenBurnsScale' => array(
            'value' => 1.2,
            'name' => rb__('Scale', 'RbthemeSlider'),
            'keys' => 'kenburnsscale',
            'tooltip' => rb__('Increase or decrease the size of the slide background image in the Ken Burns effect. The default value is 1, the value 2 will double the image, while 0.5 results half the size. Negative values will flip the image.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 0.1
            ),
            'props' => array(
                'output' => true
            )
        ),


        // Parallax
        'parallaxType' => array(
            'value' => '2d',
            'name' => rb__('Type', 'RbthemeSlider'),
            'keys' => 'parallaxtype',
            'tooltip' => rb__('The default value for parallax layers on this slide, which they will inherit, unless you set it otherwise on the affected layers.', 'RbthemeSlider'),
            'options' => array(
                '2d' => rb__('2D', 'RbthemeSlider'),
                '3d' => rb__('3D', 'RbthemeSlider')
             )
        ),

        'parallaxEvent' => array(
            'value' => 'cursor',
            'name' => rb__('Event', 'RbthemeSlider'),
            'keys' => 'parallaxevent',
            'tooltip' => rb__('You can trigger the parallax effect by either scrolling the page, or by moving your mouse cursor / tilting your mobile device. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'options' => array(
                'cursor' => rb__('Cursor or Tilt', 'RbthemeSlider'),
                'scroll' => rb__('Scroll', 'RbthemeSlider')
             )
        ),

        'parallaxAxis' => array(
            'value' => 'both',
            'name' => rb__('Axes', 'RbthemeSlider'),
            'keys' => 'parallaxaxis',
            'tooltip' => rb__('Choose on which axes parallax layers should move. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'options' => array(
                'none' => rb__('None', 'RbthemeSlider'),
                'both' => rb__('Both axes', 'RbthemeSlider'),
                'x' => rb__('Horizontal only', 'RbthemeSlider'),
                'y' => rb__('Vertical only', 'RbthemeSlider')
            )
        ),


        'parallaxTransformOrigin' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'keys' => 'parallaxtransformorigin',
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center.', 'RbthemeSlider')
        ),

        'parallaxDurationMove' => array(
            'value' => 1500,
            'name' => rb__('Move duration', 'RbthemeSlider'),
            'keys' => 'parallaxdurationmove',
            'tooltip' => rb__('Controls the speed of animating layers when you move your mouse cursor or tilt your mobile device. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 100,
                'min' => 0
            )
        ),

        'parallaxDurationLeave' => array(
            'value' => 1200,
            'name' => rb__('Leave duration', 'RbthemeSlider'),
            'keys' => 'parallaxdurationleave',
            'tooltip' => rb__('Controls how quickly your layers revert to their original position when you move your mouse cursor outside of a parallax slider. This value is in milliseconds. 1 second = 1000 milliseconds. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 100,
                'min' => 0
            )
        ),

        'parallaxDistance' => array(
            'value' => 10,
            'name' => rb__('Distance', 'RbthemeSlider'),
            'keys' => 'parallaxdistance',
            'tooltip' => rb__('Increase or decrease the amount of layer movement when moving your mouse cursor or tilting on a mobile device. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 1
            )

        ),

        'parallaxRotate' => array(
            'value' => 10,
            'name' => rb__('Rotation', 'RbthemeSlider'),
            'keys' => 'parallaxrotate',
            'tooltip' => rb__('Increase or decrease the amount of layer rotation in the 3D space when moving your mouse cursor or tilting on a mobile device. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 1
            )
        ),

        'parallaxPerspective' => array(
            'value' => 500,
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'parallaxtransformperspective',
            'tooltip' => rb__('Changes the perspective of layers in the 3D space. This is the default value on this slide, which parallax layers will inherit, unless you set it otherwise directly on them.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 100
            )
        ),
    ),

    'layers' => array(

        // ======================= //
        // |  Content  | //
        // ======================= //

        'uuid' => array(
            'value' => '',
            'keys' => 'uuid',
            'props' => array(
                'meta' => true
            )
        ),

        'type' => array(
            'value' => '',
            'keys' => 'type',
            'props' => array(
                'meta' => true
            )
        ),

        'hide_on_desktop' => array(
            'value' => false,
            'keys' => 'hide_on_desktop',
            'props' => array(
                'meta' => true
            )
        ),

        'hide_on_tablet' => array(
            'value' => false,
            'keys' => 'hide_on_tablet',
            'props' => array(
                'meta' => true
            )
        ),

        'hide_on_phone' => array(
            'value' => false,
            'keys' => 'hide_on_phone',
            'props' => array(
                'meta' => true
            )
        ),

        'media' => array(
            'value' => '',
            'keys' => 'media',
            'props' => array(
                'meta' => true
            )
        ),

        'image' => array(
            'value' => '',
            'keys' => 'image',
            'props' => array(
                'meta' => true
            )
        ),

        'imageId' => array(
            'value' => '',
            'keys' => 'imageId',
            'props' => array('meta' => true)
        ),

        'html' => array(
            'value' => '',
            'keys' => 'html',
            'props' => array(
                'meta' => true
            )
        ),

        'mediaAutoPlay' => array(
            'value' => 'inherit',
            'name' => rb__('Autoplay', 'RbthemeSlider'),
            'keys' => 'autoplay',
            'options' => array(
                'inherit' => rb__('Inherit', 'RbthemeSlider'),
                'enabled' => rb__('Enabled', 'RbthemeSlider'),
                'disabled' => rb__('Disabled', 'RbthemeSlider')
            )
        ),

        'mediaInfo' => array(
            'value' => true,
            'name' => rb__('Show Info', 'RbthemeSlider'),
            'keys' => 'showinfo',
            'options' => array(
                'auto' => rb__('Auto', 'RbthemeSlider'),
                'enabled' => rb__('Enabled', 'RbthemeSlider'),
                'disabled' => rb__('Disabled', 'RbthemeSlider')
            )
        ),

        'mediaControls' => array(
            'value' => true,
            'name' => rb__('Controls', 'RbthemeSlider'),
            'keys' => 'controls',
            'options' => array(
                'auto' => rb__('Auto', 'RbthemeSlider'),
                'enabled' => rb__('Enabled', 'RbthemeSlider'),
                'disabled' => rb__('Disabled', 'RbthemeSlider')
            )
        ),


        'mediaPoster' => array(
            'value' => '',
            'keys' => 'poster',
        ),


        'mediaFillMode' => array(
            'value' => 'cover',
            'name' => rb__('Fill mode', 'RbthemeSlider'),
            'keys' => 'fillmode',
            'options' => array(
                'contain'  => rb__('Contain', 'RbthemeSlider'),
                'cover'  => rb__('Cover', 'RbthemeSlider')
            )
        ),


        'mediaVolume' => array(
            'value' => '',
            'name' => rb__('Volume', 'RbthemeSlider'),
            'keys' => 'volume',
            'attrs' => array(
                'type' => 'number',
                'min' => 0,
                'max' => 100,
                'placeholder' => 'auto'
            )
        ),

        'mediaBackgroundVideo' => array(
            'value' => false,
            'name' => rb__('Use this video as slide background', 'RbthemeSlider'),
            'keys' => 'backgroundvideo',
            'tooltip' => rb__('Forces this layer to act like the slide background by covering the whole slider and ignoring some transitions. Please make sure to provide your own poster image with the option above, so the slider can display it immediately on page load.', 'RbthemeSlider')
        ),

        'mediaOverlay' => array(
            'value' => 'disabled',
            'name' => rb__('Choose an overlay image:', 'RbthemeSlider'),
            'keys' => 'overlay',
            'tooltip' => rb__('Cover your videos with an overlay image to have dotted or striped effects on them.', 'RbthemeSlider')
        ),


        'postTextLength' => array(
            'value' => '',
            'keys' => 'post_text_length',
            'props' => array(
                'meta' => true
            )
        ),


        // ======================= //
        // |  Animation options  | //
        // ======================= //
        'transition' => array('value' => '', 'keys' => 'transition', 'props' => array('meta' => true)),

        'transitionIn' => array(
            'value' => true,
            'keys' => 'transitionin'
        ),

        'transitionInOffsetX' => array(
            'value' => '0',
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'keys' => 'offsetxin',
            'tooltip' => rb__("Shifts the layer starting position from its original on the horizontal axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'left' or 'right' position the layer out the staging area, so it enters the scene from either side when animating to its destination location.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Enter the stage from left",
                "value": "left"
            }, {
                "name": "Enter the stage from right",
                "value": "right"
            }, {
                "name": "100% layer width",
                "value": "100lw"
            }, {
                "name": "-100% layer width",
                "value": "-100lw"
            }, {
                "name": "50% slider width",
                "value": "50sw"
            }, {
                "name": "-50% slider width",
                "value": "-50sw"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'transitionInOffsetY' => array(
            'value' => '0',
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'keys' => 'offsetyin',
            'tooltip' => rb__("Shifts the layer starting position from its original on the vertical axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the height of this layer. The values 'top' or 'bottom' position the layer out the staging area, so it enters the scene from either vertical side when animating to its destination location.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Enter the stage from top",
                "value": "top"
            }, {
                "name": "Enter the stage from bottom",
                "value": "bottom"
            }, {
                "name": "100% layer height",
                "value": "100lh"
            }, {
                "name": "-100% layer height",
                "value": "-100lh"
            }, {
                "name": "50% slider height",
                "value": "50sh"
            }, {
                "name": "-50% slider height",
                "value": "-50sh"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        // Duration of the transition in millisecs when a layer animates in.
        // Original: durationin
        // Defaults to: 1000 (ms) => 1sec
        'transitionInDuration' => array(
            'value' => 1000,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => 'durationin',
            'tooltip' => rb__('The length of the transition in milliseconds when the layer enters the scene. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 50)
        ),

        // Delay before the transition in millisecs when a layer animates in.
        // Original: delayin
        // Defaults to: 0 (ms)
        'transitionInDelay' => array(
            'value' => 0,
            'name' => rb__('Start at', 'RbthemeSlider'),
            'keys' => 'delayin',
            'tooltip' => rb__('Delays the transition with the given amount of milliseconds before the layer enters the scene. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 50)
        ),

        // Easing of the transition when a layer animates in.
        // Original: easingin
        // Defaults to: 'easeInOutQuint'
        'transitionInEasing' => array(
            'value' => 'easeInOutQuint',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'keys' => 'easingin',
            'tooltip' => rb__("The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "RbthemeSlider")
        ),

        'transitionInFade' => array(
            'value' => true,
            'name' => rb__('Fade', 'RbthemeSlider'),
            'keys' => 'fadein',
            'tooltip' => rb__('Fade the layer during the transition.', 'RbthemeSlider'),
        ),

        // Initial rotation degrees when a layer animates in.
        // Original: rotatein
        // Defaults to: 0 (deg)
        'transitionInRotate' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'rotatein',
            'tooltip' => rb__('Rotates the layer by the given number of degrees. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionInRotateX' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'keys' => 'rotatexin',
            'tooltip' => rb__('Rotates the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionInRotateY' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'keys' => 'rotateyin',
            'tooltip' => rb__('Rotates the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionInSkewX' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'keys' => 'skewxin',
            'tooltip' => rb__('Skews the layer along the X (horizontal) by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionInSkewY' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'keys' => 'skewyin',
            'tooltip' => rb__('Skews the layer along the Y (vertical) by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionInScaleX' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys' => 'scalexin',
            'tooltip' => rb__("Scales the layer along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'transitionInScaleY' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys' => 'scaleyin',
            'tooltip' => rb__("Scales the layer along the Y (vertical) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'transitionInTransformOrigin' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'keys' => 'transformoriginin',
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center, slidercenter, slidermiddle, slidertop, sliderright, sliderbottom, sliderleft.', 'RbthemeSlider'),
        ),

        'transitionInClip' => array(
            'value' => '',
            'name' => rb__('Mask', 'RbthemeSlider'),
            'keys' => 'clipin',
            'tooltip' => rb__("Clips (cuts off) the sides of the layer by the given amount specified in pixels or percentages. The 4 value in order: top, right, bottom and the left side of the layer.", "RbthemeSlider"),
            'attrs' => array('data-options' => '[{
                "name": "From top",
                "value": "0 0 100% 0"
            }, {
                "name": "From right",
                "value": "0 0 0 100%"
            }, {
                "name": "From bottom",
                "value": "100% 0 0 0"
            }, {
                "name": "From left",
                "value": "0 100% 0 0"
            }]')
        ),

        'transitionInBGColor' => array(
            'value' => '',
            'name' => rb__('Background', 'RbthemeSlider'),
            'keys' => 'bgcolorin',
            'tooltip' => rb__("The background color of your layer. You can use color names, hexadecimal, RGB or RGBA values as well as the 'transparent' keyword. Example: #FFF", 'RbthemeSlider'),
        ),

        'transitionInColor' => array(
            'value' => '',
            'name' => rb__('Color', 'RbthemeSlider'),
            'keys' => 'colorin',
            'tooltip' => rb__("The color of your text. You can use color names, hexadecimal, RGB or RGBA values. Example: #333", 'RbthemeSlider'),
        ),

        'transitionInRadius' => array(
            'value' => '',
            'name' => rb__('Rounded Corners', 'RbthemeSlider'),
            'keys' => 'radiusin',
            'tooltip' => rb__('If you want rounded corners, you can set its radius here in pixels. Example: 5px', 'RbthemeSlider'),
        ),

        'transitionInWidth' => array(
            'value' => '',
            'name' => rb__('Width', 'RbthemeSlider'),
            'keys' => 'widthin',
            'tooltip' => rb__('The initial width of this layer from which it will be animated to its proper size during the transition.', 'RbthemeSlider'),
        ),

        'transitionInHeight' => array(
            'value' => '',
            'name' => rb__('Height', 'RbthemeSlider'),
            'keys' => 'heightin',
            'tooltip' => rb__('The initial height of this layer from which it will be animated to its proper size during the transition.', 'RbthemeSlider'),
        ),

        'transitionInFilter' => array(
            'value' => '',
            'name' => rb__('Filter', 'RbthemeSlider'),
            'keys' => 'filterin',
            'tooltip' => rb__('Filters provide effects like blurring or color shifting your layers. Click into the text field to see a selection of filters you can use. Although clicking on the pre-defined options will reset the text field, you can apply multiple filters simply by providing a space separated list of all the filters you would like to use. Click on the "Filter" link for more information.', 'RbthemeSlider'),
            'premium' => true,
            'attrs' => array(
                'data-options' => '[{
                    "name": "Blur",
                    "value": "blur(5px)"
                }, {
                    "name": "Brightness",
                    "value": "brightness(40%)"
                }, {
                    "name": "Contrast",
                    "value": "contrast(200%)"
                }, {
                    "name": "Grayscale",
                    "value": "grayscale(50%)"
                }, {
                    "name": "Hue-rotate",
                    "value": "hue-rotate(90deg)"
                }, {
                    "name": "Invert",
                    "value": "invert(75%)"
                }, {
                    "name": "Saturate",
                    "value": "saturate(30%)"
                }, {
                    "name": "Sepia",
                    "value": "sepia(60%)"
                }]'
            )
        ),

        'transitionInPerspective' => array(
            'value' => '500',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'transformperspectivein',
            'tooltip' => rb__('Changes the perspective of this layer in the 3D space.', 'RbthemeSlider')
        ),

        // ======

        'transitionOut' => array(
            'value' => true,
            'keys' => 'transitionout'
        ),

        'transitionOutOffsetX' => array(
            'value' => 0,
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'keys' => 'offsetxout',
            'tooltip' => rb__("Shifts the layer from its original position on the horizontal axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'left' or 'right' animate the layer out the staging area, so it can leave the scene on either side.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Leave the stage on left",
                "value": "left"
            }, {
                "name": "Leave the stage on right",
                "value": "right"
            }, {
                "name": "100% layer width",
                "value": "100lw"
            }, {
                "name": "-100% layer width",
                "value": "-100lw"
            }, {
                "name": "50% slider width",
                "value": "50sw"
            }, {
                "name": "-50% slider width",
                "value": "-50sw"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'transitionOutOffsetY' => array(
            'value' => 0,
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'keys' => 'offsetyout',
            'tooltip' => rb__("Shifts the layer from its original position on the vertical axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the height of this layer. The values 'top' or 'bottom' animate the layer out the staging area, so it can leave the scene on either vertical side.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Leave the stage on top",
                "value": "top"
            }, {
                "name": "Leave the stage on bottom",
                "value": "bottom"
            }, {
                "name": "100% layer height",
                "value": "100lh"
            }, {
                "name": "-100% layer height",
                "value": "-100lh"
            }, {
                "name": "50% slider height",
                "value": "50sh"
            }, {
                "name": "-50% slider height",
                "value": "-50sh"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        // Duration of the transition in millisecs when a layer animates out.
        // Original: durationout
        // Defaults to: 1000 (ms) => 1sec
        'transitionOutDuration' => array(
            'value' => 1000,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => 'durationout',
            'tooltip' => rb__('The length of the transition in milliseconds when the layer leaves the slide. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 50)
        ),

        'showUntil' => array(
            'value' => '0',
            'keys' => 'showuntil'
        ),

        'transitionOutStartAt' => array(
            'value' => 'slidechangeonly',
            'name' => rb__('Start at', 'RbthemeSlider'),
            'keys' => 'startatout',
            'tooltip' => rb__('You can set the starting time of this transition. Use one of the pre-defined options to use relative timing, which can be shifted with custom operations.', 'RbthemeSlider'),
            'attrs' => array('type' => 'hidden')
        ),


        'transitionOutStartAtTiming' => array(
            'value' => 'slidechangeonly',
            'keys' => 'startatouttiming',
            'props' => array('meta' => true),
            'options' => array(
                'slidechangeonly' => rb__('Slide change starts (ignoring modifier)', 'RbthemeSlider'),
                'transitioninend' => rb__('Opening Transition completes', 'RbthemeSlider'),
                'textinstart' => rb__('Opening Text Transition starts', 'RbthemeSlider'),
                'textinend' => rb__('Opening Text Transition completes', 'RbthemeSlider'),
                'allinend' => rb__('Opening and Opening Text Transition complete', 'RbthemeSlider'),
                'loopstart' => rb__('Loop starts', 'RbthemeSlider'),
                'loopend' => rb__('Loop completes', 'RbthemeSlider'),
                'transitioninandloopend' => rb__('Opening and Loop Transitions complete', 'RbthemeSlider'),
                'textinandloopend' => rb__('Opening Text and Loop Transitions complete', 'RbthemeSlider'),
                'allinandloopend' => rb__('Opening, Opening Text and Loop Transitions complete', 'RbthemeSlider'),
                'textoutstart' => rb__('Ending Text Transition starts', 'RbthemeSlider'),
                'textoutend' => rb__('Ending Text Transition completes', 'RbthemeSlider'),
                'textoutandloopend' => rb__('Ending Text and Loop Transitions complete', 'RbthemeSlider')
            )
        ),

        'transitionOutStartAtOperator' => array(
            'value' => '+',
            'keys' => 'startatoutoperator',
            'props' => array('meta' => true),
            'options' => array('+', '-', '/', '*')
        ),

        'transitionOutStartAtValue' => array(
            'value' => 0,
            'keys' => 'startatoutvalue',
            'props' => array('meta' => true)
        ),

        // Easing of the transition when a layer animates out.
        // Original: easingout
        // Defaults to: 'easeInOutQuint'
        'transitionOutEasing' => array(
            'value' => 'easeInOutQuint',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'keys' => 'easingout',
            'tooltip' => rb__("The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "RbthemeSlider")
        ),

        'transitionOutFade' => array(
            'value' => true,
            'name' => rb__('Fade', 'RbthemeSlider'),
            'keys' => 'fadeout',
            'tooltip' => rb__('Fade the layer during the transition.', 'RbthemeSlider'),
        ),


        // Initial rotation degrees when a layer animates out.
        // Original: rotateout
        // Defaults to: 0 (deg)
        'transitionOutRotate' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'rotateout',
            'tooltip' => rb__('Rotates the layer by the given number of degrees. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionOutRotateX' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'keys' => 'rotatexout',
            'tooltip' => rb__('Rotates the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionOutRotateY' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'keys' => 'rotateyout',
            'tooltip' => rb__('Rotates the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionOutSkewX' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'keys' => 'skewxout',
            'tooltip' => rb__('Skews the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionOutSkewY' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'keys' => 'skewyout',
            'tooltip' => rb__('Skews the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'transitionOutScaleX' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys' => 'scalexout',
            'tooltip' => rb__("Scales the layer along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'transitionOutScaleY' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys' => 'scaleyout',
            'tooltip' => rb__("Scales the layer along the Y (vertical) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'transitionOutTransformOrigin' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'keys' => 'transformoriginout',
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center, slidercenter, slidermiddle, slidertop, sliderright, sliderbottom, sliderleft.', 'RbthemeSlider'),
        ),

        'transitionOutClip' => array(
            'value' => '',
            'name' => rb__('Mask', 'RbthemeSlider'),
            'keys' => 'clipout',
            'tooltip' => rb__("Clips (cuts off) the sides of the layer by the given amount specified in pixels or percentages. The 4 value in order: top, right, bottom and the left side of the layer.", "RbthemeSlider"),
            'attrs' => array('data-options' => '[{
                "name": "From top",
                "value": "0 0 100% 0"
            }, {
                "name": "From right",
                "value": "0 0 0 100%"
            }, {
                "name": "From bottom",
                "value": "100% 0 0 0"
            }, {
                "name": "From left",
                "value": "0 100% 0 0"
            }]')
        ),

        'transitionOutFilter' => array(
            'value' => '',
            'name' => rb__('Filter', 'RbthemeSlider'),
            'keys' => 'filterout',
            'tooltip' => rb__('Filters provide effects like blurring or color shifting your layers. Click into the text field to see a selection of filters you can use. Although clicking on the pre-defined options will reset the text field, you can apply multiple filters simply by providing a space separated list of all the filters you would like to use. Click on the "Filter" link for more information.', 'RbthemeSlider'),
            'premium' => true,
            'attrs' => array(
                'data-options' => '[{
                    "name": "Blur",
                    "value": "blur(5px)"
                }, {
                    "name": "Brightness",
                    "value": "brightness(40%)"
                }, {
                    "name": "Contrast",
                    "value": "contrast(200%)"
                }, {
                    "name": "Grayscale",
                    "value": "grayscale(50%)"
                }, {
                    "name": "Hue-rotate",
                    "value": "hue-rotate(90deg)"
                }, {
                    "name": "Invert",
                    "value": "invert(75%)"
                }, {
                    "name": "Saturate",
                    "value": "saturate(30%)"
                }, {
                    "name": "Sepia",
                    "value": "sepia(60%)"
                }]'
            )
        ),

        'transitionOutPerspective' => array(
            'value' => '500',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'transformperspectiveout',
            'tooltip' => rb__('Changes the perspective of this layer in the 3D space.', 'RbthemeSlider')
        ),

        // -----

        'skipLayer' => array(
            'value' => false,
            'name' => rb__('Hidden', 'RbthemeSlider'),
            'keys' => 'skip',
            'tooltip' => rb__("If you don't want to use this layer, but you want to keep it, you can hide it with this switch.", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'transitionOutBGColor' => array(
            'value' => '',
            'name' => rb__('Background', 'RbthemeSlider'),
            'keys' => 'bgcolorout',
            'tooltip' => rb__('Animates the background toward the color you specify here when the layer leaves the slider canvas.', 'RbthemeSlider'),
        ),

        'transitionOutColor' => array(
            'value' => '',
            'name' => rb__('Color', 'RbthemeSlider'),
            'keys' => 'colorout',
            'tooltip' => rb__('Animates the text color toward the color you specify here when the layer leaves the slider canvas.', 'RbthemeSlider'),
        ),

        'transitionOutRadius' => array(
            'value' => '',
            'name' => rb__('Rounded Corners', 'RbthemeSlider'),
            'keys' => 'radiusout',
            'tooltip' => rb__('Animates rounded corners toward the value you specify here when the layer leaves the slider canvas.', 'RbthemeSlider'),
        ),

        'transitionOutWidth' => array(
            'value' => '',
            'name' => rb__('Width', 'RbthemeSlider'),
            'keys' => 'widthout',
            'tooltip' => rb__('Animates the layer width toward the value you specify here when the layer leaves the slider canvas.', 'RbthemeSlider'),
        ),

        'transitionOutHeight' => array(
            'value' => '',
            'name' => rb__('Height', 'RbthemeSlider'),
            'keys' => 'heightout',
            'tooltip' => rb__('Animates the layer height toward the value you specify here when the layer leaves the slider canvas.', 'RbthemeSlider'),
        ),


        // == Compatibility ==
        'transitionInType' => array(
            'value' => 'auto',
            'keys' => 'slidedirection'
        ),
        'transitionOutType' => array(
            'value' => 'auto',
            'keys' => 'slideoutdirection'
        ),

        'transitionOutDelay' => array(
            'value' => 0,
            'keys' => 'delayout'
        ),

        'transitionInScale' => array(
            'value' => '1.0',
            'keys' => 'scalein'
        ),

        'transitionOutScale' => array(
            'value' => '1.0',
            'keys' => 'scaleout'
        ),



        // Text Animation IN
        // -----------------

        'textTransitionIn' => array(
            'value' => false,
            'keys' => 'texttransitionin'
        ),

        'textTypeIn' => array(
            'value' => 'chars_asc',
            'name' => rb__('Text Animation', 'RbthemeSlider'),
            'keys' => 'texttypein',
            'tooltip' => rb__('Select how your text should be split and animated.', 'RbthemeSlider'),
            'options' => array(
                'chars_asc'  => rb__('by chars ascending', 'RbthemeSlider'),
                'chars_desc' => rb__('by chars descending', 'RbthemeSlider'),
                'chars_rand' => rb__('by chars random', 'RbthemeSlider'),
                'chars_center' => rb__('by chars center to edge', 'RbthemeSlider'),
                'chars_edge' => rb__('by chars edge to center', 'RbthemeSlider'),
                'words_asc'  => rb__('by words ascending', 'RbthemeSlider'),
                'words_desc' => rb__('by words descending', 'RbthemeSlider'),
                'words_rand' => rb__('by words random', 'RbthemeSlider'),
                'words_center' => rb__('by words center to edge', 'RbthemeSlider'),
                'words_edge' => rb__('by words edge to center', 'RbthemeSlider'),
                'lines_asc'  => rb__('by lines ascending', 'RbthemeSlider'),
                'lines_desc' => rb__('by lines descending', 'RbthemeSlider'),
                'lines_rand' => rb__('by lines random', 'RbthemeSlider'),
                'lines_center' => rb__('by lines center to edge', 'RbthemeSlider'),
                'lines_edge' => rb__('by lines edge to center', 'RbthemeSlider'),
            ),
            'props' => array(
                'output' => true
            )
        ),

        'textShiftIn' => array(
            'value' => 50,
            'name' => rb__('Shift In', 'RbthemeSlider'),
            'tooltip' => rb__('Delays the transition of each text nodes relative to each other. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'keys'  => 'textshiftin',
            'attrs' => array('type' => 'number')
        ),

        'textOffsetXIn' => array(
            'value' => 0,
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'tooltip' => rb__("Shifts the starting position of text nodes from their original on the horizontal axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'left' or 'right' position text nodes out the staging area, so they enter the scene from either side when animating to their destination location. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'keys'  => 'textoffsetxin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Enter the stage from left",
                "value": "left"
            }, {
                "name": "Enter the stage from right",
                "value": "right"
            }, {
                "name": "100% layer width",
                "value": "100lw"
            }, {
                "name": "-100% layer width",
                "value": "-100lw"
            }, {
                "name": "50% slider width",
                "value": "50sw"
            }, {
                "name": "-50% slider width",
                "value": "-50sw"
            }, {
                "name": "Cycle between values",
                "value": "50|-50"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'textOffsetYIn' => array(
            'value' => 0,
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'tooltip' => rb__("Shifts the starting position of text nodes from their original on the vertical axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'top' or 'bottom' position text nodes out the staging area, so they enter the scene from either vertical side when animating to their destination location. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'keys'  => 'textoffsetyin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Enter the stage from top",
                "value": "top"
            }, {
                "name": "Enter the stage from bottom",
                "value": "bottom"
            }, {
                "name": "100% layer height",
                "value": "100lh"
            }, {
                "name": "-100% layer height",
                "value": "-100lh"
            }, {
                "name": "50% slider height",
                "value": "50sh"
            }, {
                "name": "-50% slider height",
                "value": "-50sh"
            }, {
                "name": "Cycle between values",
                "value": "50|-50"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'textDurationIn' => array(
            'value' => 1000,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'tooltip' => rb__('The transition length in milliseconds of the individual text fragments. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'keys'  => 'textdurationin',
            'attrs' => array('min' => 0, 'step' => 50)
        ),

        'textEasingIn' => array(
            'value' => 'easeInOutQuint',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'tooltip' => rb__("The timing function of the animation. With this function you can manipulate the movement of animated text fragments. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "RbthemeSlider"),
            'keys'  => 'texteasingin',
        ),

        'textFadeIn' => array(
            'value' => true,
            'name' => rb__('Fade', 'RbthemeSlider'),
            'tooltip' => rb__('Fade the text fragments during their transition.', 'RbthemeSlider'),
            'keys'  => 'textfadein'
        ),

        'textStartAtIn' => array(
            'value' => 'transitioninend',
            'name' => rb__('StartAt', 'RbthemeSlider'),
            'tooltip' => rb__('You can set the starting time of this transition. Use one of the pre-defined options to use relative timing, which can be shifted with custom operations.', 'RbthemeSlider'),
            'keys'  => 'textstartatin',
            'attrs' => array('type' => 'hidden')
        ),

        'textStartAtInTiming' => array(
            'value' => 'transitioninend',
            'keys'  => 'textstartatintiming',
            'props' => array('meta' => true),
            'options' => array(
                'transitioninstart' => rb__('Opening Transition starts', 'RbthemeSlider'),
                'transitioninend' => rb__('Opening Transition completes', 'RbthemeSlider'),
                'loopstart' => rb__('Loop starts', 'RbthemeSlider'),
                'loopend' => rb__('Loop completes', 'RbthemeSlider'),
                'transitioninandloopend' => rb__('Opening and Loop Transitions complete', 'RbthemeSlider')
            )
        ),

        'textStartAtInOperator' => array(
            'value' => '+',
            'keys'  => 'textstartatinoperator',
            'props' => array('meta' => true),
            'options' => array('+', '-', '/', '*')
        ),

        'textStartAtInValue' => array(
            'value' => 0,
            'keys'  => 'textstartatinvalue',
            'props' => array('meta' => true)
        ),



        'textRotateIn' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments clockwise by the given number of degrees. Negative values are allowed for counterclockwise rotation. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotatein',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textRotateXIn' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotatexin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textRotateYIn' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotateyin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textScaleXIn' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys'  => 'textscalexin',
            'tooltip' => rb__("Scales text fragments along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks text fragments compared to their original size. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'textScaleYIn' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys'  => 'textscaleyin',
            'tooltip' => rb__("Scales text fragments along the Y (vertical) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks text fragments compared to their original size. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'textSkewXIn' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'tooltip' => rb__('Skews text fragments along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textskewxin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textSkewYIn' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'tooltip' => rb__('Skews text fragments along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textskewyin',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),



        'textTransformOriginIn' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center, slidercenter, slidermiddle, slidertop, sliderright, sliderbottom, sliderleft.', 'RbthemeSlider'),
            'keys'  => 'texttransformoriginin',
            'attrs' => array('data-options' => '[{
                "name": "Cycle between values",
                "value": "50% 50% 0|100% 100% 0"
            }]')
        ),

        'textPerspectiveIn' => array(
            'value' => '500',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'texttransformperspectivein',
            'tooltip' => rb__('Changes the perspective of this layer in the 3D space.', 'RbthemeSlider')
        ),




        // Text Animation OUT
        // -----------------

        'textTransitionOut' => array(
            'value' => false,
            'keys' => 'texttransitionout'
        ),

        'textTypeOut' => array(
            'value' => 'chars_desc',
            'name' => rb__('Text Animation', 'RbthemeSlider'),
            'keys' => 'texttypeout',
            'tooltip' => rb__('Select how your text should be split and animated.', 'RbthemeSlider'),
            'options' => array(
                'chars_asc'  => rb__('by chars ascending', 'RbthemeSlider'),
                'chars_desc' => rb__('by chars descending', 'RbthemeSlider'),
                'chars_rand' => rb__('by chars random', 'RbthemeSlider'),
                'chars_center' => rb__('by chars center to edge', 'RbthemeSlider'),
                'chars_edge' => rb__('by chars edge to center', 'RbthemeSlider'),
                'words_asc'  => rb__('by words ascending', 'RbthemeSlider'),
                'words_desc' => rb__('by words descending', 'RbthemeSlider'),
                'words_rand' => rb__('by words random', 'RbthemeSlider'),
                'words_center' => rb__('by words center to edge', 'RbthemeSlider'),
                'words_edge' => rb__('by words edge to center', 'RbthemeSlider'),
                'lines_asc'  => rb__('by lines ascending', 'RbthemeSlider'),
                'lines_desc' => rb__('by lines descending', 'RbthemeSlider'),
                'lines_rand' => rb__('by lines random', 'RbthemeSlider'),
                'lines_center' => rb__('by lines center to edge', 'RbthemeSlider'),
                'lines_edge' => rb__('by lines edge to center', 'RbthemeSlider'),
            ),
            'props' => array(
                'output' => true
            )
        ),

        'textShiftOut' => array(
            'value' => '',
            'name' => rb__('Shift Out', 'RbthemeSlider'),
            'tooltip' => rb__('Delays the transition of each text nodes relative to each other. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'keys'  => 'textshiftout',
            'attrs' => array('type' => 'number')
        ),

        'textOffsetXOut' => array(
            'value' => 0,
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'tooltip' => rb__("Shifts the ending position of text nodes from their original on the horizontal axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'left' or 'right' position text nodes out the staging area, so they leave the scene from either side when animating to their destination location. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'keys'  => 'textoffsetxout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Leave the stage on left",
                "value": "left"
            }, {
                "name": "Leave the stage on right",
                "value": "right"
            }, {
                "name": "100% layer width",
                "value": "100lw"
            }, {
                "name": "-100% layer width",
                "value": "-100lw"
            }, {
                "name": "50% slider width",
                "value": "50sw"
            }, {
                "name": "-50% slider width",
                "value": "-50sw"
            }, {
                "name": "Cycle between values",
                "value": "50|-50"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'textOffsetYOut' => array(
            'value' => 0,
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'tooltip' => rb__("Shifts the ending position of text nodes from their original on the vertical axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'top' or 'bottom' position text nodes out the staging area, so they leave the scene from either vertical side when animating to their destination location. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'keys'  => 'textoffsetyout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Leave the stage on top",
                "value": "top"
            }, {
                "name": "Leave the stage on bottom",
                "value": "bottom"
            }, {
                "name": "100% layer height",
                "value": "100lh"
            }, {
                "name": "-100% layer height",
                "value": "-100lh"
            }, {
                "name": "50% slider height",
                "value": "50sh"
            }, {
                "name": "-50% slider height",
                "value": "-50sh"
            }, {
                "name": "Cycle between values",
                "value": "50|-50"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'textDurationOut' => array(
            'value' => 1000,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'tooltip' => rb__('The transition length in milliseconds of the individual text fragments. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'keys'  => 'textdurationout',
            'attrs' => array('min' => 0, 'step' => 50)
        ),

        'textEasingOut' => array(
            'value' => 'easeInOutQuint',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'tooltip' => rb__("The timing function of the animation. With this function you can manipulate the movement of animated text fragments. Please click on the link next to this select field to open easings.net for more information and real-time examples.", "RbthemeSlider"),
            'keys'  => 'texteasingout',
            'attrs' => array('type' => 'hidden')
        ),

        'textFadeOut' => array(
            'value' => true,
            'name' => rb__('Fade', 'RbthemeSlider'),
            'tooltip' => rb__('Fade the text fragments during their transition.', 'RbthemeSlider'),
            'keys'  => 'textfadeout'
        ),

        'textStartAtOut' => array(
            'value' => 'allinandloopend',
            'name' => rb__('StartAt', 'RbthemeSlider'),
            'tooltip' => rb__('You can set the starting time of this transition. Use one of the pre-defined options to use relative timing, which can be shifted with custom operations.', 'RbthemeSlider'),
            'keys'  => 'textstartatout',
            'attrs' => array('type' => 'hidden')
        ),

        'textStartAtOutTiming' => array(
            'value' => 'allinandloopend',
            'keys'  => 'textstartatouttiming',
            'props' => array('meta' => true),
            'options' => array(
                'transitioninend' => rb__('Opening Transition completes', 'RbthemeSlider'),
                'textinstart' => rb__('Opening Text Transition starts', 'RbthemeSlider'),
                'textinend' => rb__('Opening Text Transition completes', 'RbthemeSlider'),
                'allinend' => rb__('Opening and Opening Text Transition complete', 'RbthemeSlider'),
                'loopstart' => rb__('Loop starts', 'RbthemeSlider'),
                'loopend' => rb__('Loop completes', 'RbthemeSlider'),
                'transitioninandloopend' => rb__('Opening and Loop Transitions complete', 'RbthemeSlider'),
                'textinandloopend' => rb__('Opening Text and Loop Transitions complete', 'RbthemeSlider'),
                'allinandloopend' => rb__('Opening, Opening Text and Loop Transitions complete', 'RbthemeSlider')
            )
        ),

        'textStartAtOutOperator' => array(
            'value' => '+',
            'keys'  => 'textstartatoutoperator',
            'props' => array('meta' => true),
            'options' => array('+', '-', '/', '*')
        ),

        'textStartAtOutValue' => array(
            'value' => 0,
            'keys'  => 'textstartatoutvalue',
            'props' => array('meta' => true)
        ),

        'textRotateOut' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments clockwise by the given number of degrees. Negative values are allowed for counterclockwise rotation. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotateout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
            "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textRotateXOut' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotatexout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textRotateYOut' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'tooltip' => rb__('Rotates text fragments along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textrotateyout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textScaleXOut' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys'  => 'textscalexout',
            'tooltip' => rb__("Scales text fragments along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks text fragments compared to their original size. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'textScaleYOut' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys'  => 'textscaleyout',
            'tooltip' => rb__("Scales text fragments along the Y (vertical) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks text fragments compared to their original size. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'textSkewXOut' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'tooltip' => rb__('Skews text fragments along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textskewxout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'textSkewYOut' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'tooltip' => rb__('Skews text fragments along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction. By listing multiple values separated with a | character, the slider will use different transition variations on each text node by cycling between the provided values.', 'RbthemeSlider'),
            'keys'  => 'textskewyout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "30|-30"
            }, {
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),



        'textTransformOriginOut' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center, slidercenter, slidermiddle, slidertop, sliderright, sliderbottom, sliderleft.', 'RbthemeSlider'),
            'keys'  => 'texttransformoriginout',
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Cycle between values",
                "value": "50% 50% 0|100% 100% 0"
            }]')
        ),


        'textPerspectiveOut' => array(
            'value' => '500',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'texttransformperspectiveout',
            'tooltip' => rb__('Changes the perspective of this layer in the 3D space.', 'RbthemeSlider')
        ),







        // ======


        // LOOP

        'loop' => array(
            'value' => false,
            'keys' => 'loop'
        ),

        'loopOffsetX' => array(
            'value' => 0,
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'keys' => 'loopoffsetx',
            'tooltip' => rb__("Shifts the layer starting position from its original on the horizontal axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. The values 'left' or 'right' position the layer out the staging area, so it can leave and re-enter the scene from either side during the transition.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Move out of stage on left",
                "value": "left"
            }, {
                "name": "Move out of stage on right",
                "value": "right"
            }, {
                "name": "100% layer width",
                "value": "100lw"
            }, {
                "name": "-100% layer width",
                "value": "-100lw"
            }, {
                "name": "50% slider width",
                "value": "50sw"
            }, {
                "name": "-50% slider width",
                "value": "-50sw"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'loopOffsetY' => array(
            'value' => 0,
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'keys' => 'loopoffsety',
            'tooltip' => rb__("Shifts the layer starting position from its original on the vertical axis with the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the height of this layer. The values 'top' or 'bottom' position the layer out the staging area, so it can leave and re-enter the scene from either vertical side during the transition.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Move out of stage on top",
                "value": "top"
            }, {
                "name": "Move out of stage on bottom",
                "value": "bottom"
            }, {
                "name": "100% layer height",
                "value": "100lh"
            }, {
                "name": "-100% layer height",
                "value": "-100lh"
            }, {
                "name": "50% slider height",
                "value": "50sh"
            }, {
                "name": "-50% slider height",
                "value": "-50sh"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'loopDuration' => array(
            'value' => 1000,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => 'loopduration',
            'tooltip' => rb__('The length of the transition in milliseconds. A second is equal to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 100)
        ),

        'loopStartAt' => array(
            'value' => 'allinend',
            'name' => rb__('Start at', 'RbthemeSlider'),
            'keys' => 'loopstartat',
            'tooltip' => rb__('You can set the starting time of this transition. Use one of the pre-defined options to use relative timing, which can be shifted with custom operations.', 'RbthemeSlider'),
            'attrs' => array('type' => 'hidden', 'step' => 100),
        ),

        'loopStartAtTiming' => array(
            'value' => 'allinend',
            'keys'  => 'loopstartattiming',
            'props' => array('meta' => true),
            'options' => array(
                'transitioninstart' => rb__('Opening Transition starts', 'RbthemeSlider'),
                'transitioninend' => rb__('Opening Transition completes', 'RbthemeSlider'),
                'textinstart' => rb__('Opening Text Transition starts', 'RbthemeSlider'),
                'textinend' => rb__('Opening Text Transition completes', 'RbthemeSlider'),
                'allinend' => rb__('Opening and Opening Text Transition complete', 'RbthemeSlider')
            )
        ),

        'loopStartAtOperator' => array(
            'value' => '+',
            'keys'  => 'loopstartatoperator',
            'props' => array('meta' => true),
            'options' => array('+', '-', '/', '*')
        ),

        'loopStartAtValue' => array(
            'value' => 0,
            'keys'  => 'loopstartatvalue',
            'props' => array('meta' => true)
        ),

        'loopEasing' => array(
            'value' => 'linear',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'keys' => 'loopeasing',
            'tooltip' => rb__("The timing function of the animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "RbthemeSlider")
        ),

        'loopOpacity' => array(
            'value' => 1,
            'name' => rb__('Opacity', 'RbthemeSlider'),
            'keys' => 'loopopacity',
            'tooltip' => rb__('Fades the layer. You can use values between 1 and 0 to set the layer fully opaque or transparent respectively. For example, the value 0.5 will make the layer semi-transparent.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'max' => 1, 'step' => 0.01)
        ),

        'loopRotate' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'looprotate',
            'tooltip' => rb__('Rotates the layer by the given number of degrees. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'loopRotateX' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'keys' => 'looprotatex',
            'tooltip' => rb__('Rotates the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'loopRotateY' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'keys' => 'looprotatey',
            'tooltip' => rb__('Rotates the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'loopSkewX' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'keys' => 'loopskewx',
            'tooltip' => rb__('Skews the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'loopSkewY' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'keys' => 'loopskewy',
            'tooltip' => rb__('Skews the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'loopScaleX' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys' => 'loopscalex',
            'tooltip' => rb__("Scales the layer along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'loopScaleY' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys' => 'loopscaley',
            'tooltip' => rb__("Scales the layer along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'loopTransformOrigin' => array(
            'value' => '50% 50% 0',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'keys' => 'looptransformorigin',
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center, slidercenter, slidermiddle, slidertop, sliderright, sliderbottom, sliderleft.', 'RbthemeSlider')
        ),

        'loopClip' => array(
            'value' => '',
            'name' => rb__('Mask', 'RbthemeSlider'),
            'keys' => 'loopclip',
            'tooltip' => rb__('Clips (cuts off) the sides of the layer by the given amount specified in pixels or percentages. The 4 value in order: top, right, bottom and the left side of the layer.', 'RbthemeSlider'),
            'attrs' => array('data-options' => '[{
                "name": "From top",
                "value": "0 0 100% 0"
            }, {
                "name": "From right",
                "value": "0 0 0 100%"
            }, {
                "name": "From bottom",
                "value": "100% 0 0 0"
            }, {
                "name": "From left",
                "value": "0 100% 0 0"
            }]')
        ),

        'loopCount' => array(
            'value' => 1,
            'name' => rb__('Count', 'RbthemeSlider'),
            'keys' => 'loopcount',
            'tooltip' => rb__('The number of times repeating the Loop transition. The count includes the reverse part of the transitions when you use the Yoyo feature. Use the value -1 to repeat infinitely or zero to disable looping.', 'RbthemeSlider'),
            'attrs' => array(
                'step' => 1,
                'data-options' => '[{
                    "name": "Infinite",
                    "value": -1
                }]'
            ),
            'props' => array(
                'output' => true
            )
        ),

        'loopWait' => array(
            'value' => 0,
            'name' => rb__('Wait', 'RbthemeSlider'),
            'keys' => 'looprepeatdelay',
            'tooltip' => rb__('Waiting time between repeats in milliseconds. A second is 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 100)
        ),

        'loopYoyo' => array(
            'value' => false,
            'name' => rb__('Yoyo', 'RbthemeSlider'),
            'keys' => 'loopyoyo',
            'tooltip' => rb__('Enable this option to allow reverse transition, so you can loop back and forth seamlessly.', 'RbthemeSlider')
        ),

        'loopPerspective' => array(
            'value' => '500',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'looptransformperspective',
            'tooltip' => rb__('Changes the perspective of this layer in the 3D space.', 'RbthemeSlider')
        ),

        'loopFilter' => array(
            'value' => '',
            'name' => rb__('Filter', 'RbthemeSlider'),
            'keys' => 'loopfilter',
            'tooltip' => rb__('Filters provide effects like blurring or color shifting your layers. Click into the text field to see a selection of filters you can use. Although clicking on the pre-defined options will reset the text field, you can apply multiple filters simply by providing a space separated list of all the filters you would like to use. Click on the "Filter" link for more information.', 'RbthemeSlider'),
            'premium' => true,
            'attrs' => array(
                'data-options' => '[{
                    "name": "Blur",
                    "value": "blur(5px)"
                }, {
                    "name": "Brightness",
                    "value": "brightness(40%)"
                }, {
                    "name": "Contrast",
                    "value": "contrast(200%)"
                }, {
                    "name": "Grayscale",
                    "value": "grayscale(50%)"
                }, {
                    "name": "Hue-rotate",
                    "value": "hue-rotate(90deg)"
                }, {
                    "name": "Invert",
                    "value": "invert(75%)"
                }, {
                    "name": "Saturate",
                    "value": "saturate(30%)"
                }, {
                    "name": "Sepia",
                    "value": "sepia(60%)"
                }]'
            )
        ),





        // HOVER

        'hover' => array(
            'value' => false,
            'keys' => 'hover'
        ),


        'hoverOffsetX' => array(
            'value' => 0,
            'name' => rb__('OffsetX', 'RbthemeSlider'),
            'keys' => 'hoveroffsetx',
            'tooltip' => rb__("Moves the layer horizontally by the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. ", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "20% layer width",
                "value": "20lw"
            }, {
                "name": "-20% layer width",
                "value": "-20lw"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'hoverOffsetY' => array(
            'value' => 0,
            'name' => rb__('OffsetY', 'RbthemeSlider'),
            'keys' => 'hoveroffsety',
            'tooltip' => rb__("Moves the layer vertically by the given number of pixels. Use negative values for the opposite direction. Percentage values are relative to the width of this layer. ", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "20% layer height",
                "value": "20lh"
            }, {
                "name": "-20% layer height",
                "value": "-20lh"
            }, {
                "name": "Random",
                "value": "random(-100,100)"
            }]')
        ),

        'hoverInDuration' => array(
            'value' => 500,
            'name' => rb__('Duration', 'RbthemeSlider'),
            'keys' => 'hoverdurationin',
            'tooltip' => rb__('The length of the transition in milliseconds. A second is equal to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 100)
        ),

        'hoverOutDuration' => array(
            'value' => '',
            'name' => rb__('Reverse<br>duration', 'RbthemeSlider'),
            'keys' => 'hoverdurationout',
            'tooltip' => rb__('The duration of the reverse transition in milliseconds. A second is equal to 1000 milliseconds.', 'RbthemeSlider'),
            'attrs' => array('min' => 0, 'step' => 100, 'placeholder' => 'same')
        ),

        'hoverInEasing' => array(
            'value' => 'easeInOutQuint',
            'name' => rb__('Easing', 'RbthemeSlider'),
            'keys' => 'hovereasingin',
            'tooltip' => rb__("The timing function of the animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "RbthemeSlider")
        ),

        'hoverOutEasing' => array(
            'value' => '',
            'name' => rb__('Reverse<br>easing', 'RbthemeSlider'),
            'keys' => 'hovereasingout',
            'tooltip' => rb__("The timing function of the reverse animation to manipualte the layer's movement. Click on the link next to this field to open easings.net for examples and more information", "RbthemeSlider"),
            'attrs' => array('placeholder' => 'same')
        ),

        'hoverOpacity' => array(
            'value' => '',
            'name' => rb__('Opacity', 'RbthemeSlider'),
            'keys' => 'hoveropacity',
            'tooltip' => rb__('Fades the layer. You can use values between 1 and 0 to set the layer fully opaque or transparent respectively. For example, the value 0.5 will make the layer semi-transparent.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0,
                'max' => 1,
                'step' => 0.1
            )
        ),

        'hoverRotate' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'hoverrotate',
            'tooltip' => rb__('Rotates the layer clockwise by the given number of degrees. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'hoverRotateX' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'keys' => 'hoverrotatex',
            'tooltip' => rb__('Rotates the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'hoverRotateY' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'keys' => 'hoverrotatey',
            'tooltip' => rb__('Rotates the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'hoverSkewX' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'keys' => 'hoverskewx',
            'tooltip' => rb__('Skews the layer along the X (horizontal) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'hoverSkewY' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'keys' => 'hoverskewy',
            'tooltip' => rb__('Skews the layer along the Y (vertical) axis by the given number of degrees. Negative values are allowed for reverse direction.', 'RbthemeSlider'),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(-45,45)"
            }]')
        ),

        'hoverScaleX' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys' => 'hoverscalex',
            'tooltip' => rb__("Scales the layer along the X (horizontal) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'hoverScaleY' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys' => 'hoverscaley',
            'tooltip' => rb__("Scales the layer along the Y (vertical) axis by the specified vector. Use the value 1 for the original size. The value 2 will double, while 0.5 shrinks the layer compared to its original size.", "RbthemeSlider"),
            'attrs' => array('type' => 'text', 'data-options' => '[{
                "name": "Random",
                "value": "random(2,4)"
            }]')
        ),

        'hoverTransformOrigin' => array(
            'value' => '50% 50% 0',
              'attrs' => array('placeholder' => 'inherit'),
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'keys' => 'hovertransformorigin',
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center.', 'RbthemeSlider'),
        ),

        'hoverBGColor' => array(
            'value' => '',
            'name' => rb__('Background', 'RbthemeSlider'),
            'keys' => 'hoverbgcolor',
            'tooltip' => rb__("The background color of this layer. You can use color names, hexadecimal, RGB or RGBA values as well as the 'transparent' keyword. Example: #FFF", "RbthemeSlider")
        ),

        'hoverColor' => array(
            'value' => '',
            'name' => rb__('Color', 'RbthemeSlider'),
            'keys' => 'hovercolor',
            'tooltip' => rb__('The text color of this text. You can use color names, hexadecimal, RGB or RGBA values. Example: #333', 'RbthemeSlider')
        ),

        'hoverBorderRadius' => array(
            'value' => '',
            'name' => rb__('Rounded corners', 'RbthemeSlider'),
            'keys' => 'hoverborderradius',
            'tooltip' => rb__('If you want rounded corners, you can set here its radius in pixels. Example: 5px', 'RbthemeSlider')
        ),

        'hoverTransformPerspective' => array(
            'value' => 500,
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'keys' => 'hovertransformperspective',
            'tooltip' => rb__('Changes the perspective of layers in the 3D space.', 'RbthemeSlider')
        ),

        'hoverTopOn' => array(
            'value' => true,
            'name' => rb__('Always on top', 'RbthemeSlider'),
            'keys' => 'hoveralwaysontop',
            'tooltip' => rb__('Show this layer above every other layer while hovering.', 'RbthemeSlider')
        ),





        // Parallax
        'parallax' => array(
            'value' => false,
            'keys' => 'parallax'
        ),

        'parallaxLevel' => array(
            'value' => 10,
            'name' => rb__('Parallax Level', 'RbthemeSlider'),
            'tooltip' => rb__('Set the intensity of the parallax effect. Use negative values to shift layers in the opposite direction.', 'RbthemeSlider'),
            'keys' => 'parallaxlevel',
            'props' => array(
                'output' => true
            )
        ),

        'parallaxType' => array(
            'value' => 'inherit',
            'name' => rb__('Type', 'RbthemeSlider'),
            'tooltip' => rb__('Choose if you want 2D or 3D parallax layers.', 'RbthemeSlider'),
            'keys' => 'parallaxtype',
            'options' => array(
                'inherit' => rb__('Inherit from Slide Options', 'RbthemeSlider'),
                '2d' => rb__('2D', 'RbthemeSlider'),
                '3d' => rb__('3D', 'RbthemeSlider')
             )
        ),

        'parallaxEvent' => array(
            'value' => 'inherit',
            'name' => rb__('Event', 'RbthemeSlider'),
            'tooltip' => rb__('You can trigger the parallax effect by either scrolling the page, or by moving your mouse cursor / tilting your mobile device.', 'RbthemeSlider'),
            'keys' => 'parallaxevent',
            'options' => array(
                'inherit' => rb__('Inherit from Slide Options', 'RbthemeSlider'),
                'cursor' => rb__('Cursor or Tilt', 'RbthemeSlider'),
                'scroll' => rb__('Scroll', 'RbthemeSlider')
             )
        ),

        'parallaxAxis' => array(
            'value' => 'inherit',
            'name' => rb__('Axes', 'RbthemeSlider'),
            'tooltip' => rb__('Choose on which axes parallax layers should move.', 'RbthemeSlider'),
            'keys' => 'parallaxaxis',
            'options' => array(
                'inherit' => rb__('Inherit from Slide Options', 'RbthemeSlider'),
                'none' => rb__('None', 'RbthemeSlider'),
                'both' => rb__('Both', 'RbthemeSlider'),
                'x' => rb__('Horizontal only', 'RbthemeSlider'),
                'y' => rb__('Vertical only', 'RbthemeSlider')
            )
        ),


        'parallaxTransformOrigin' => array(
            'value' => '',
            'name' => rb__('Transform Origin', 'RbthemeSlider'),
            'tooltip' => rb__('Sets a point on canvas from which transformations are calculated. For example, a layer may rotate around its center axis or a completely custom point, such as one of its corners. The three values represent the X, Y and Z axes in 3D space. Apart from the pixel and percentage values, you can also use the following constants: top, right, bottom, left, center.', 'RbthemeSlider'),
            'keys' => 'parallaxtransformorigin',
            'attrs' => array(
                'placeholder' => 'Inherit from Slide Options'
            )
        ),

        'parallaxDurationMove' => array(
            'value' => '',
            'name' => rb__('Move Duration', 'RbthemeSlider'),
            'tooltip' => rb__('Controls the speed of animating layers when you move your mouse cursor or tilt your mobile device.', 'RbthemeSlider'),
            'keys' => 'parallaxdurationmove',
            'attrs' => array(
                'type' => 'number',
                'step' => 100,
                'min' => 0,
                'placeholder' => 'Inherit from Slide Options'
            )
        ),

        'parallaxDurationLeave' => array(
            'value' => '',
            'name' => rb__('Leave Duration', 'RbthemeSlider'),
            'tooltip' => rb__('Controls how quickly parallax layers revert to their original position when you move your mouse cursor outside of the slider. This value is in milliseconds. A second equals to 1000 milliseconds.', 'RbthemeSlider'),
            'keys' => 'parallaxdurationleave',
            'attrs' => array(
                'type' => 'number',
                'step' => 100,
                'min' => 0,
                'placeholder' => 'Inherit from Slide Options'
            )
        ),

        'parallaxRotate' => array(
            'value' => '',
            'name' => rb__('Rotation', 'RbthemeSlider'),
            'tooltip' => rb__('Increase or decrease the amount of layer rotation in the 3D space when moving your mouse cursor or tilting on a mobile device.', 'RbthemeSlider'),
            'keys' => 'parallaxrotate',
            'attrs' => array(
                'type' => 'number',
                'step' => 1,
                'placeholder' => 'Inherit from Slide Options'
            )
        ),

        'parallaxDistance' => array(
            'value' => '',
            'name' => rb__('Distance', 'RbthemeSlider'),
            'tooltip' => rb__('Increase or decrease the amount of layer movement when moving your mouse cursor or tilting on a mobile device.', 'RbthemeSlider'),
            'keys' => 'parallaxdistance',
            'attrs' => array(
                'type' => 'number',
                'step' => 1,
                'placeholder' => 'Inherit from Slide Options'
            )
        ),

        'parallaxPerspective' => array(
            'value' => '',
            'name' => rb__('Perspective', 'RbthemeSlider'),
            'tooltip' => rb__('Changes the perspective of layers in the 3D space.', 'RbthemeSlider'),
            'keys' => 'parallaxtransformperspective',
            'attrs' => array(
                'type' => 'number',
                'step' => 100,
                'placeholder' => 'Inherit from Slide Options'
            )
        ),


        // TRANSITON MISC
        'transitionStatic' => array(
            'value' => 'none',
            'name' => rb__('Static layer', 'RbthemeSlider'),
            'keys' => 'static',
            'tooltip' => rb__("You can keep this layer on top of the slider across multiple slides. Just select the slide on which this layer should animate out. Alternatively, you can make this layer global on all slides after it transitioned in.", "RbthemeSlider"),
            'options' => array(
                'none' => rb__('Disabled (default)', 'RbthemeSlider'),
                'forever' => rb__('Enabled (never animate out)', 'RbthemeSlider')
            )
        ),

        'transitionKeyframe' => array(
            'value' => false,
            'name' => rb__('Play By Scroll Keyframe', 'RbthemeSlider'),
            'keys' => 'keyframe',
            'tooltip' => rb__('A Play by Scroll slider will pause when this layer finished its opening transition.', 'RbthemeSlider')
        ),


// Attributes


        'linkURL' => array(
            'value' => '',
            'name' => rb__('Enter URL', 'RbthemeSlider'),
            'keys' => 'url',
            'tooltip' => rb__('If you want to link your layer, type here the URL. You can use a hash mark followed by a number to link this layer to another slide. Example: #3 - this will switch to the third slide.', 'RbthemeSlider'),
            'attrs' => array(
                'data-options' => '[{
                    "name": "Switch to the next slide",
                    "value": "#next"
                }, {
                    "name": "Switch to the previous slide",
                    "value": "#prev"
                }, {
                    "name": "Stop the slideshow",
                    "value": "#stop"
                }, {
                    "name": "Resume the slideshow",
                    "value": "#start"
                }, {
                    "name": "Replay the slide from the start",
                    "value": "#replay"
                }, {
                    "name": "Reverse the slide, then pause it",
                    "value": "#reverse"
                }, {
                    "name": "Reverse the slide, then replay it",
                    "value": "#reverse-replay"
                }]'
            ),
            'props' => array(
                'meta' => true
            )
        ),


        'linkTarget' => array(
            'value' => '_self',
            'name' => rb__('URL target', 'RbthemeSlider'),
            'keys' => 'target',
            'options' => array(
                '_self' => rb__('Open on the same page', 'RbthemeSlider'),
                '_blank' => rb__('Open on new page', 'RbthemeSlider'),
                '_parent' => rb__('Open in parent frame', 'RbthemeSlider'),
                '_top' => rb__('Open in main frame', 'RbthemeSlider'),
                'ls-scroll' => rb__('Scroll to element (Enter selector)', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'innerAttributes' => array(
            'value' => '',
            'name' => rb__('Custom Attributes', 'RbthemeSlider'),
            'keys' => 'innerAttributes',
            'desc' => rb__('Your list of custom attributes. Use this feature if your needs are not covered by the common attributes above or you want to override them. You can use data-* as well as regular attribute names. Empty attributes (without value) are also allowed. For example, to make a FancyBox gallery, you may enter "data-fancybox-group" and "gallery1" for the attribute name and value, respectively.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'outerAttributes' => array(
            'value' => '',
            'name' => rb__('Custom Attributes', 'RbthemeSlider'),
            'keys' => 'outerAttributes',
            'desc' => rb__('Your list of custom attributes. Use this feature if your needs are not covered by the common attributes above or you want to override them. You can use data-* as well as regular attribute names. Empty attributes (without value) are also allowed. For example, to make a FancyBox gallery, you may enter "data-fancybox-group" and "gallery1" for the attribute name and value, respectively.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        // Styles

        'width' => array(
            'value' => '',
            'name' => rb__('Width', 'RbthemeSlider'),
            'keys' => 'width',
            'tooltip' => rb__("You can set the width of your layer. You can use pixels, percentage, or the default value 'auto'. Examples: 100px, 50% or auto.", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'height' => array(
            'value' => '',
            'name' => rb__('Height', 'RbthemeSlider'),
            'keys' => 'height',
            'tooltip' => rb__("You can set the height of your layer. You can use pixels, percentage, or the default value 'auto'. Examples: 100px, 50% or auto", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'top' => array(
            'value' => '10px',
            'name' => rb__('Top', 'RbthemeSlider'),
            'keys' => 'top',
            'tooltip' => rb__("The layer position from the top of the slide. You can use pixels and percentage. Examples: 100px or 50%. You can move your layers in the preview above with a drag n' drop, or set the exact values here.", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'left' => array(
            'value' => '10px',
            'name' => rb__('Left', 'RbthemeSlider'),
            'keys' => 'left',
            'tooltip' => rb__("The layer position from the left side of the slide. You can use pixels and percentage. Examples: 100px or 50%. You can move your layers in the preview above with a drag n' drop, or set the exact values here.", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'paddingTop' => array(
            'value' => '',
            'name' => rb__('Top', 'RbthemeSlider'),
            'keys' => 'padding-top',
            'tooltip' => rb__('Padding on the top of the layer. Example: 10px', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'paddingRight' => array(
            'value' => '',
            'name' => rb__('Right', 'RbthemeSlider'),
            'keys' => 'padding-right',
            'tooltip' => rb__('Padding on the right side of the layer. Example: 10px', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'paddingBottom' => array(
            'value' => '',
            'name' => rb__('Bottom', 'RbthemeSlider'),
            'keys' => 'padding-bottom',
            'tooltip' => rb__('Padding on the bottom of the layer. Example: 10px', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'paddingLeft' => array(
            'value' => '',
            'name' => rb__('Left', 'RbthemeSlider'),
            'keys' => 'padding-left',
            'tooltip' => rb__('Padding on the left side of the layer. Example: 10px', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'borderTop' => array(
            'value' => '',
            'name' => rb__('Top', 'RbthemeSlider'),
            'keys' => 'border-top',
            'tooltip' => rb__('Border on the top of the layer. Example: 5px solid #000', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'borderRight' => array(
            'value' => '',
            'name' => rb__('Right', 'RbthemeSlider'),
            'keys' => 'border-right',
            'tooltip' => rb__('Border on the right side of the layer. Example: 5px solid #000', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'borderBottom' => array(
            'value' => '',
            'name' => rb__('Bottom', 'RbthemeSlider'),
            'keys' => 'border-bottom',
            'tooltip' => rb__('Border on the bottom of the layer. Example: 5px solid #000', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'borderLeft' => array(
            'value' => '',
            'name' => rb__('Left', 'RbthemeSlider'),
            'keys' => 'border-left',
            'tooltip' => rb__('Border on the left side of the layer. Example: 5px solid #000', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'fontFamily' => array(
            'value' => '',
            'name' => rb__('Family', 'RbthemeSlider'),
            'keys' => 'font-family',
            'tooltip' => rb__('List of your chosen fonts separated with a comma. Please use apostrophes if your font names contains white spaces. Example: Helvetica, Arial, sans-serif', 'RbthemeSlider')
        ),

        'fontSize' => array(
            'value' => '',
            'name' => rb__('Font size', 'RbthemeSlider'),
            'keys' => 'font-size',
            'tooltip' => rb__('The font size in pixels. Example: 16px.', 'RbthemeSlider'),
            'attrs' => array('data-options' => '["9", "10", "11", "12", "13", "14", "18", "24", "36", "48", "64", "96"]'),
            'props' => array(
                'meta' => true
            )
        ),

        'lineHeight' => array(
            'value' => '',
            'name' => rb__('Line height', 'RbthemeSlider'),
            'keys' => 'line-height',
            'tooltip' => rb__("The line height of your text. The default setting is 'normal'. Example: 22px", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'fontWeight' => array(
            'value' => 400,
            'name' => rb__('Font weight', 'RbthemeSlider'),
            'keys' => 'font-weight',
            'tooltip' => rb__('Sets the font boldness. Please note, not every font supports all the listed variants, thus some settings may have the same result.', ''),
            'options' => array(
                '100' => rb__('100 (UltraLight)', 'RbthemeSlider'),
                '200' => rb__('200 (Thin)', 'RbthemeSlider'),
                '300' => rb__('300 (Light)', 'RbthemeSlider'),
                '400' => rb__('400 (Regular)', 'RbthemeSlider'),
                '500' => rb__('500 (Medium)', 'RbthemeSlider'),
                '600' => rb__('600 (Semibold)', 'RbthemeSlider'),
                '700' => rb__('700 (Bold)', 'RbthemeSlider'),
                '800' => rb__('800 (Heavy)', 'RbthemeSlider'),
                '900' => rb__('900 (Black)', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'fontStyle' => array(
            'value' => 'normal',
            'name' => rb__('Font style', 'RbthemeSlider'),
            'keys' => 'font-style',
            'tooltip' => rb__('Oblique is an auto-generated italic version of your chosen font and can force slating even if there is no italic font variant available. However, you should use the regular italic option whenever is possible. Please double check to load italic font variants when using Google Fonts.', ''),
            'options' => array(
                'normal' => rb__('Normal', 'RbthemeSlider'),
                'italic' => rb__('Italic', 'RbthemeSlider'),
                'oblique' => rb__('Oblique (Forced slant)', 'RbthemeSlider')
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'textDecoration' => array(
            'value' => 'none',
            'name' => rb__('Text decoration', 'RbthemeSlider'),
            'keys' => 'text-decoration',
            'options' => array(
                'none' => 'None',
                'underline' => rb__('Underline', 'RbthemeSlider'),
                'overline' => rb__('Overline', 'RbthemeSlider'),
                'line-through' => rb__('Line through', 'RbthemeSlider')

            ),
            'props' => array(
                'meta' => true
            )
        ),

        'letterSpacing' => array(
            'value' => '',
            'name' => rb__('Letter spacing', 'RbthemeSlider'),
            'keys' => 'letter-spacing',
            'tooltip' => rb__('Controls the amount of space between each character. Useful the change letter density in a line or block of text. Negative values and decimals can be used.', 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'step' => 0.5
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'textAlign' => array(
            'value' => 'none',
            'name' => rb__('Text align', 'RbthemeSlider'),
            'keys' => 'text-align',
            'options' => array(
                'initial' => rb__('Initial (Language default)', 'RbthemeSlider'),
                'left' => rb__('Left', 'RbthemeSlider'),
                'right' => rb__('Right', 'RbthemeSlider'),
                'center' => rb__('Center', 'RbthemeSlider'),
                'justify' => rb__('Justify', 'RbthemeSlider')

            ),
            'props' => array(
                'meta' => true
            )
        ),

        'opacity' => array(
            'value' => 1,
            'name' => rb__('Opacity', 'RbthemeSlider'),
            'keys' => 'opacity',
            'tooltip' => rb__('Fades the layer. You can use values between 1 and 0 to set the layer fully opaque or transparent respectively. For example, the value 0.5 will make the layer semi-transparent.', 'RbthemeSlider'),
            'attrs' => array(
                'min' => 0,
                'max' => 1,
                'step' => 0.1
            ),
            'props' => array(
                'meta' => true
            )
        ),

        'minFontSize' => array(
            'value' => '',
            'name' => rb__('Min. font size', 'RbthemeSlider'),
            'keys' => 'minfontsize',
            'tooltip' => rb__('The minimum font size in a responsive slider. This option allows you to prevent your texts layers becoming too small on smaller screens.', 'RbthemeSlider')
        ),

        'minMobileFontSize' => array(
            'value' => '',
            'name' => rb__('Min. mobile font size', 'RbthemeSlider'),
            'keys' => 'minmobilefontsize',
            'tooltip' => rb__('The minimum font size in a responsive slider on mobile devices. This option allows you to prevent your texts layers becoming too small on smaller screens.', 'RbthemeSlider')
        ),



        'color' => array(
            'value' => '',
            'name' => rb__('Color', 'RbthemeSlider'),
            'keys' => 'color',
            'tooltip' => rb__('The color of your text. You can use color names, hexadecimal, RGB or RGBA values. Example: #333', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'background' => array(
            'value' => '',
            'name' => rb__('Background', 'RbthemeSlider'),
            'keys' => 'background',
            'tooltip' => rb__("The background color of your layer. You can use color names, hexadecimal, RGB or RGBA values as well as the 'transparent' keyword. Example: #FFF", "RbthemeSlider"),
            'props' => array(
                'meta' => true
            )
        ),

        'borderRadius' => array(
            'value' => '',
            'name' => rb__('Rounded corners', 'RbthemeSlider'),
            'keys' => 'border-radius',
            'tooltip' => rb__('If you want rounded corners, you can set its radius here. Example: 5px', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'wordWrap' => array(
            'value' => false,
            'name' => 'Word-wrap',
            'keys' => 'wordwrap',
            'tooltip' => 'Enable this option to allow line breaking if your text content does not fit into one line. By default, layers have auto sizes based on the text length. If you set custom sizes, it\'s recommended to enable this option in most cases.',
            'props' => array(
                'meta' => true
            )
        ),

        'style' => array(
            'value' => '',
            'name' => rb__('Custom styles', 'RbthemeSlider'),
            'keys' => 'style',
            'tooltip' => rb__('If you want to set style settings other than above, you can use here any CSS codes. Please make sure to write valid markup.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'styles' => array(
            'value' => '',
            'keys' => 'styles',
            'props' => array(
                'meta' => true,
                'raw' => true
            )
        ),

        'rotate' => array(
            'value' => 0,
            'name' => rb__('Rotate', 'RbthemeSlider'),
            'keys' => 'rotation',
            'tooltip' => rb__('The rotation angle where this layer animates toward when entering into the slider canvas. Negative values are allowed for counterclockwise rotation.', 'RbthemeSlider')
        ),

        'rotateX' => array(
            'value' => 0,
            'name' => rb__('RotateX', 'RbthemeSlider'),
            'keys' => 'rotationX',
            'tooltip' => rb__('The rotation angle on the horizontal axis where this animates toward when entering into the slider canvas. Negative values are allowed for reversed direction.', 'RbthemeSlider')
        ),

        'rotateY' => array(
            'value' => 0,
            'name' => rb__('RotateY', 'RbthemeSlider'),
            'keys' => 'rotationY',
            'tooltip' => rb__('The rotation angle on the vertical axis where this layer animates toward when entering into the slider canvas. Negative values are allowed for reversed direction.', 'RbthemeSlider')
        ),

        'scaleX' => array(
            'value' => 1,
            'name' => rb__('ScaleX', 'RbthemeSlider'),
            'keys' => 'scaleX',
            'tooltip' => rb__('The layer horizontal scale where this layer animates toward when entering into the slider canvas.', 'RbthemeSlider')
        ),

        'scaleY' => array(
            'value' => 1,
            'name' => rb__('ScaleY', 'RbthemeSlider'),
            'keys' => 'scaleY',
            'tooltip' => rb__('The layer vertical scale where this layer animates toward when entering into the slider canvas.', 'RbthemeSlider')
        ),

        'skewX' => array(
            'value' => 0,
            'name' => rb__('SkewX', 'RbthemeSlider'),
            'keys' => 'skewX',
            'tooltip' => rb__('The layer horizontal skewing angle where this layer animates toward when entering into the slider canvas.', 'RbthemeSlider')
        ),

        'skewY' => array(
            'value' => 0,
            'name' => rb__('SkewY', 'RbthemeSlider'),
            'keys' => 'skewY',
            'tooltip' => rb__('The layer vertical skewing angle where this layer animates toward when entering into the slider canvas.', 'RbthemeSlider')
        ),

        'position' => array(
            'value' => 'relative',
            'name' => rb__('Calculate positions from', 'RbthemeSlider'),
            'keys' => 'position',
            'tooltip' => rb__('Sets the layer position origin from which top and left values are calculated. The default is the upper left corner of the slider canvas. In a full width and full size slider, your content is centered based on the screen size to achieve the best possible fit. By selecting the "sides of the screen" option in those scenarios, you can allow layers to escape the centered inner area and stick to the sides of the screen.', 'RbthemeSlider'),
            'options' => array(
                'relative' => rb__('sides of the slider', 'RbthemeSlider'),
                'fixed' => rb__('sides of the screen', 'RbthemeSlider'),
            )
        ),

        'zIndex' => array(
            'value' => '',
            'name' => rb__('Stacking order', 'RbthemeSlider'),
            'keys' => 'z-index',
            'tooltip' => rb__("This option controls the vertical stacking order of layers that overlap. In CSS, it's commonly called as z-index. Elements with a higher value are stacked in front of elements with a lower one, effectively covering them. By default, this value is calculated automatically based on the order of your layers, thus simply re-ordering them can fix overlap issues. Use this option only if you want to set your own value manually in special cases like using static layers.<br><br>On each slide, the stacking order starts counting from 100. Providing a number less than 100 will put the layer behind every other layer on all slides. Specifying a much greater number, for example 500, will make the layer to be on top of everything else.", 'RbthemeSlider'),
            'attrs' => array(
                'type' => 'number',
                'min' => 1,
                'placeholder' => 'auto'
            )
        ),

        'blendMode' => array(
            'value' => 'normal',
            'name' => rb__('Blend mode', 'RbthemeSlider'),
            'keys' => 'mix-blend-mode',
            'tooltip' => rb__('Choose how layers and the slide background should blend into each other. Blend modes are an easy way to add eye-catching effects and is one of the most frequently used features in graphic and print design.', 'RbthemeSlider'),
            'premium' => true,
            'options' => array(
                'normal' => 'Normal',
                'multiply' => 'Multiply',
                'screen' => 'Screen',
                'overlay' => 'Overlay',
                'darken' => 'Darken',
                'lighten' => 'Lighten',
                'color-dodge' => 'Color-dodge',
                'color-burn' => 'Color-burn',
                'hard-light' => 'Hard-light',
                'soft-light' => 'Soft-light',
                'difference' => 'Difference',
                'exclusion' => 'Exclusion',
                'hue' => 'Hue',
                'saturation' => 'Saturation',
                'color' => 'Color',
                'luminosity' => 'Luminosity'
            )
        ),

        'filter' => array(
            'value' => '',
            'name' => rb__('Filter', 'RbthemeSlider'),
            'keys' => 'filter',
            'tooltip' => rb__('Filters provide effects like blurring or color shifting your layers. Click into the text field to see a selection of filters you can use. Although clicking on the pre-defined options will reset the text field, you can apply multiple filters simply by providing a space separated list of all the filters you would like to use. Click on the "Filter" link for more information.', 'RbthemeSlider'),
            'premium' => true,
            'attrs' => array(
                'data-options' => '[{
                    "name": "Blur",
                    "value": "blur(5px)"
                }, {
                    "name": "Brightness",
                    "value": "brightness(40%)"
                }, {
                    "name": "Contrast",
                    "value": "contrast(200%)"
                }, {
                    "name": "Grayscale",
                    "value": "grayscale(50%)"
                }, {
                    "name": "Hue-rotate",
                    "value": "hue-rotate(90deg)"
                }, {
                    "name": "Invert",
                    "value": "invert(75%)"
                }, {
                    "name": "Saturate",
                    "value": "saturate(30%)"
                }, {
                    "name": "Sepia",
                    "value": "sepia(60%)"
                }]'
            )
        ),



        // Attributes

        'ID' => array(
            'value' => '',
            'name' => rb__('ID', 'RbthemeSlider'),
            'keys' => 'id',
            'tooltip' => rb__("You can apply an ID attribute on the HTML element of this layer to work with it in your custom CSS or Javascript code.", 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'class' => array(
            'value' => '',
            'name' => rb__('Classes', 'RbthemeSlider'),
            'keys' => 'class',
            'tooltip' => rb__('You can apply classes on the HTML element of this layer to work with it in your custom CSS or Javascript code.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'title' => array(
            'value' => '',
            'name' => rb__('Title', 'RbthemeSlider'),
            'keys' => 'title',
            'tooltip' => rb__('You can add a title to this layer which will display as a tooltip if someone holds his mouse cursor over the layer.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'alt' => array(
            'value' => '',
            'name' => rb__('Alt', 'RbthemeSlider'),
            'keys' => 'alt',
            'tooltip' => rb__('Name or describe your image layer, so search engines and VoiceOver softwares can properly identify it.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        ),

        'rel' => array(
            'value' => '',
            'name' => rb__('Rel', 'RbthemeSlider'),
            'keys' => 'rel',
            'tooltip' => rb__('Plugins and search engines may use this attribute to get more information about the role and behavior of a link.', 'RbthemeSlider'),
            'props' => array(
                'meta' => true
            )
        )

    ),

    'easings' => array(
        'linear',
        'swing',
        'easeInQuad',
        'easeOutQuad',
        'easeInOutQuad',
        'easeInCubic',
        'easeOutCubic',
        'easeInOutCubic',
        'easeInQuart',
        'easeOutQuart',
        'easeInOutQuart',
        'easeInQuint',
        'easeOutQuint',
        'easeInOutQuint',
        'easeInSine',
        'easeOutSine',
        'easeInOutSine',
        'easeInExpo',
        'easeOutExpo',
        'easeInOutExpo',
        'easeInCirc',
        'easeOutCirc',
        'easeInOutCirc',
        'easeInElastic',
        'easeOutElastic',
        'easeInOutElastic',
        'easeInBack',
        'easeOutBack',
        'easeInOutBack',
        'easeInBounce',
        'easeOutBounce',
        'easeInOutBounce'
    )
);
