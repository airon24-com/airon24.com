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
(function($) {

	window.rbTransitionWindowIsOpen = false;
	window.rbTransitionGalleryTimeout = null;

	window.rbStartTransitionPreview = function( el, options ){

		// Parse settings
		var settings = $.extend( true, {}, {
			width: 300,
			height: 150,
			delay: 100,
			imgPath: '../assets/img/',
			skinPath: '../rbthemeslider/skins/',
			transitionType: '2d',
			transitionObject: null,
			showCircleTimer: false,
			pauseOnHover: false,
			skin: 'noskin',
			slidedelay: 100,
			startInViewport: false
		}, options );

		settings.slideTransition = {
			type: settings.transitionType,
			obj: settings.transitionObject
		};

		// Add slider HTML markup
		$('<div class="transitionpreview" style="width: '+settings.width+'px; height: '+settings.height+'px;"> \
				<div class="rb-slide" data-rb="slidedelay: '+settings.delay+';"> \
					<img src="'+settings.imgPath+'sample_slide_1.png" class="rb-bg"> \
				</div> \
				<div class="rb-slide" data-rb="slidedelay: '+settings.delay+';"> \
					<img src="'+settings.imgPath+'sample_slide_2.png" class="rb-bg"> \
				</div> \
			</div>').appendTo(el);



		// Initialize the slider
		$(el).find('.transitionpreview').RbSlider(settings);
	};

	window.rbShowTransition = function( el ) {

		var $el = $( el ),

		// Create popup
		popup = $('<div class="km-ui-popup"> \
			<div class="inner rb-transition-preview"></div> \
		</div>').prependTo('body'),

		// Get transition index
		index = parseInt( $el.data('key') ) - 1,

		// Get viewport dimensions
		v_w = $(window).width(),

		// Get element dimensions
		e_w = $el.width(),

		// Get element position
		e_l = $el.offset().left,
		e_t = $el.offset().top,

		// Get toolip dimensions
		t_w = popup.outerWidth(),
		t_h = popup.outerHeight();

		// Position tooltip
		popup.css({ top: e_t - t_h - 14, left: e_l - (t_w - e_w) / 2  });

		// Fix top
		if(popup.offset().top - $(window).scrollTop() < 20) { // !!! slide preview position fix
			popup.css('top', e_t + 26);
		}

		// Fix left
		if(popup.offset().left < 20) {
			popup.css('left', 20);
		}

		// Get transition class
		var trclass = $el.closest('section').data('tr-type'),
			trtype, trObj;

		// Built-in 3D
		if(trclass == '3d_transitions') {
			trtype = '3d';
			trObj = rbSliderTransitions['t'+trtype+''][index];

		// Built-in 2D
		} else if(trclass == '2d_transitions') {
			trtype = '2d';
			trObj = rbSliderTransitions['t'+trtype+''][index];

		// Custom 3D
		} else if(trclass == 'custom_3d_transitions') {
			trtype = '3d';
			trObj = rbSliderCustomTransitions['t'+trtype+''][index];

		// Custom 3D
		} else if(trclass == 'custom_2d_transitions') {
			trtype = '2d';
			trObj = rbSliderCustomTransitions['t'+trtype+''][index];
		}

		// Init transition
		rbStartTransitionPreview( popup.find('.inner'), {
			transitionType: trtype,
			transitionObject: trObj,
			imgPath: rbTrImgPath,
			skinsPath: pluginPath+'rbthemeslider/skins/',
			delay: 100
		});
	};


	window.rbHideTransition = function( $parent ) {

		if( ! $parent || ! $parent.length ) {
			$parent = $('.km-ui-popup');
		}

		// Stop transition
		var $target = $('.rb-transition-preview', $parent);
		if( $target.length ) {
			$target.find('.transitionpreview').RbSlider( 'destroy', true );
			$target.parent().remove();
		}
	};

})(jQuery);