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
jQuery(function($) {

	var RB_GoogleFontsAPI = {

		results : 0,
		fontName : null,
		fontIndex : null,

		init : function() {

			// Prefetch fonts
			$('.rb-font-search input').focus(function() {
				RB_GoogleFontsAPI.getFonts();
			});

			// Search
			$('.rb-font-search > button').click(function(e) {
				e.preventDefault();
				var input = $(this).prev()[0];
				RB_GoogleFontsAPI.timeout = setTimeout(function() {
					RB_GoogleFontsAPI.search(input);
				}, 500);
			});

			$('.rb-font-search input').keydown(function(e) {
				if(e.which === 13) {
					e.preventDefault();
					var input = this;
					RB_GoogleFontsAPI.timeout = setTimeout(function() {
						RB_GoogleFontsAPI.search(input);
					}, 500);
				}
			});

			// Form save
			$('form.rb-google-fonts').submit(function() {
				$('ul.rb-font-list li', this).each(function(idx) {
					$('input', this).each(function() {
						$(this).attr('name', 'fontsData['+idx+']['+$(this).data('name')+']');
					});
				});

				return true;
			});

			// Select font
			$('.rb-google-fonts .fonts').on('click', 'li:not(.unselectable)', function() {
				RB_GoogleFontsAPI.showVariants(this);
			});

			// Add font event
			$('.rb-font-search').on('click', 'button.add-font', function(e) {
				e.preventDefault();
				RB_GoogleFontsAPI.addFonts(this);
			});

			// Back to results event
			$('.rb-google-fonts .variants').on('click', 'button:last', function(e) {
				e.preventDefault();
				RB_GoogleFontsAPI.showFonts(this);
			});

			// Close event
			$(document).on( 'click', '.rb-overlay', function() {

				if($(this).data('manualclose')) {
					return false;
				}

				if($('.rb-pointer').length) {
					$(this).remove();
					$('.rb-pointer').children('div.fonts').show().next().hide();
					$('.rb-pointer').animate({ marginTop : 40, opacity : 0 }, 150, function() {
						this.style.display = 'none';
					});
				}
			});

			// Remove font
			$('.rb-font-list').on('click', 'a.remove', function(e) {
				e.preventDefault();
				$(this).parent().animate({ height : 0, opacity : 0 }, 300, function() {

					// Add notice if needed
					if($(this).siblings().length < 2) {
						$(this).parent().append(
							$('<li>', { 'class' : 'rb-notice', 'text' : RB_l10n.GFEmptyList })
						);
					}

					$(this).remove();
				});
			});

			// Add script
			$('.rb-google-fonts .footer select').change(function() {

				// Prevent adding the placeholder option tag
				if($('option:selected', this).index() !== 0) {

					// Selected item
					var item = $('option:selected', this);
					var hasDuplicate = false;

					// Prevent adding duplicates
					$('.rb-google-font-scripts input').each(function() {
						if($(this).val() === item.val()) {
							hasDuplicate = true;
							return false;
						}
					});

					// Add item
					if(!hasDuplicate) {
						var clone = $('.rb-google-font-scripts li:first').clone();
							clone.find('span').text( item.text() );
							clone.find('input').val( item.val() );
							clone.removeClass('rb-hidden').appendTo('.rb-google-font-scripts');
					}

					// Show the placeholder option tag
					$('option:first', this).prop('selected', true);
				}
			});

			// Remove script
			$('.rb-google-font-scripts').on('click', 'li a', function(event) {
				event.preventDefault();

				if($('.rb-google-font-scripts li').length > 2) {
					$(this).closest('li').remove();
				} else {
					alert(RB_l10n.GFEmptyCharset);
				}
			});
		},

		getFonts : function() {

			if(RB_GoogleFontsAPI.results == 0) {
				var API_KEY = 'AIzaSyC_iL-1h1jz_StV_vMbVtVfh3h2QjVUZ8c';
				$.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key=' + API_KEY, function(data) {
					RB_GoogleFontsAPI.results = data;
				});
			}
		},

		search : function(input) {

			// Hide overlay if any
			$('.rb-overlay').remove();

			// Get search field
			var searchValue = $(input).val().toLowerCase();

			// Wait until fonts being fetched
			if(RB_GoogleFontsAPI.results != 0 && searchValue.length > 2 ) {

				// Search
				var indexes = [];
				var found = $.grep(RB_GoogleFontsAPI.results.items, function(obj, index) {
					if(obj.family.toLowerCase().indexOf(searchValue) !== -1) {
						indexes.push(index);
						return true;
					}
				});

				// Get list
				var list = $('.rb-font-search .rb-pointer .fonts ul');

				// Remove previous contents and append new ones
				list.empty();
				if(found.length) {
					for(c = 0; c < found.length; c++) {
						list.append( $('<li>', { 'data-key' : indexes[c], 'text' : found[c]['family'] }));
					}
				} else {
					list.append($('<li>', { 'class' : 'unselectable' })
						.append( $('<h4>', { 'text' : 'No results were found' }))
					);
				}

				// Show pointer and append overlay
				$('.rb-font-search .rb-pointer').show().animate({ marginTop : 15, opacity : 1 }, 150);
				$('<div>', { 'class' : 'rb-overlay dim'}).prependTo('body');
			}
		},

		showVariants : function(li) {

			// Get selected font
			var fontName = $(li).text();
			var fontIndex = $(li).data('key');
			var fontObject = RB_GoogleFontsAPI.results.items[fontIndex]['variants'];
			RB_GoogleFontsAPI.fontName = fontName;
			RB_GoogleFontsAPI.fontIndex = fontIndex;

			// Get and empty list
			var list = $(li).closest('div').next().children('ul');
				list.empty();


			// Change header
			var title = RB_l10n.GFFontVariant.replace('%s', fontName);
			$(li).closest('.rb-box').children('.header').text(title);

			// Append variants
			for(c = 0; c < fontObject.length; c++) {
				list.append( $('<li>', { 'class' : 'unselectable' })
					.append( $('<input>', { 'type' : 'checkbox'} ))
					.append( $('<span>', { 'text' : ucFirst(fontObject[c]) }))
				);
			}

			// Init checkboxes
			list.find(':checkbox').customCheckbox();

			// Show variants
			$(li).closest('.fonts').hide().next().show();
		},

		showFonts : function(button) {
			$(button).closest('.rb-box').children('.header').text(RB_l10n.GFFontFamily);
			$(button).closest('.variants').hide().prev().show();
		},

		addFonts: function(button) {

			// Get variants
			var variants = $(button).parent().prev().find('input:checked');

			var apiUrl = [];
			var urlVariants = [];
			apiUrl.push(RB_GoogleFontsAPI.fontName.replace(/ /g, '+'));

			if(variants.length) {
				apiUrl.push(':');
				variants.each(function() {
					urlVariants.push( $(this).siblings('span').text().toLowerCase() );
				});
				apiUrl.push(urlVariants.join(','));
			}

			RB_GoogleFontsAPI.appendToFontList( apiUrl.join('') );
		},

		appendToFontList : function(url) {

			// Empty notice if any
			$('ul.rb-font-list li.rb-notice').remove();

			var index = $('ul.rb-font-list li').length - 1;

			// Append list item
			var item = $('ul.rb-font-list li.rb-hidden').clone();
				item.children('input:text').val(url);
				item.appendTo('ul.rb-font-list').attr('class', '');

			// Reset search field
			$('.rb-font-search input').val('');

			// Close pointer
			$('.rb-overlay').click();
		}
	};


	// Checkboxes
	$('.rb-global-settings :checkbox').customCheckbox();
	$('.rb-google-fonts :checkbox').customCheckbox();

	// Tabs
	$('.km-tabs').kmTabs();

	// Google Fonts API
	RB_GoogleFontsAPI.init();

	$('.rb-sliders-grid').on('click', '.slider-actions', function() {

		var $this 		= $(this),
			$item 		= $this.closest('.slider-item'),
			$wrapper 	= $item.children(),
			$sheet 		= $item.find('.slider-actions-sheet');

			$item.addClass('rb-opened');
			$sheet.removeClass('rb-hidden');
			$('.rb-hover', $item).hide();
			TweenLite.to($sheet[0], 0.3, {
				y: 0
			});
	});

	$('.rb-sliders-grid').on('mouseleave', '.slider-item', function() {

		var $this 	= $(this),
			$item 	= $this.closest('.slider-item'),
			$sheet 	= $item.find('.slider-actions-sheet');

			if( $item.hasClass('rb-opened') ) {

				$item.removeClass('rb-opened');
				$sheet.removeClass('rb-hidden');
				$('.rb-hover', $item).show();

				TweenLite.to($sheet[0], 0.4, {
					y: -150
				});
			}

	// Add sliderls-add-slider-template
	}).on('click', '#rb-add-slider-button', function(e) {
		e.preventDefault();

		var $button = $(this),
			$wrap 	= $button.closest('.slider-item-wrapper'),
			$sheet 	= $('#rb-add-slider-template');

		if( ! $sheet.length ) {
			$sheet = $( $('#tmpl-rb-add-slider-grid').text() ).appendTo( $wrap );
		}

		$sheet.find('input').focus();
		TweenLite.set( $sheet, { x: 240 });
		TweenLite.to( [ $button[0], $sheet[0] ], 0.5, {
			x: '-=240'
		});
	});


	$('.rb-sliders-list').on('click', '#rb-add-slider-button', function(e) {
		e.preventDefault();

		var offsets = $(this).offset();
		var popup = $('#rb-add-slider-template-list').length ?
					$('#rb-add-slider-template-list') :
					$( $('#tmpl-rb-add-slider-list').html() ).prependTo('body');

		popup.css({
			top : offsets.top + 35,
			left : offsets.left - popup.outerWidth() / 2 + $(this).width() / 2 + 7
		}).show().animate({ marginTop : 0, opacity : 1 }, 150, function() {
			$(this).find('.inner input').focus();
		});

		$('<div>', { 'class' : 'rb-overlay dim'}).prependTo('body');


	}).on('click', '.slider-actions', function() {

		var $this = $(this);
		setTimeout(function() {
			var offsets = $this.position(),
				height 	= $('#rb-slider-actions-template').removeClass('rb-hidden').show().height();

			$('#rb-slider-actions-template').css({
				top : offsets.top + 15 - height / 2,
				right : 40,
				marginTop : 0,
				opacity : 1
			});

			$('#rb-slider-actions-template a:eq(0)').data('id', $this.data('id') );
			$('#rb-slider-actions-template a:eq(0)').data('slug', $this.data('slug') );

			$('#rb-slider-actions-template a:eq(1)').attr('href', $this.data('export-url') );
			$('#rb-slider-actions-template a:eq(2)').attr('href', $this.data('duplicate-url') );
			$('#rb-slider-actions-template a:eq(3)').attr('href', $this.data('revisions-url') );
			$('#rb-slider-actions-template a:eq(4)').attr('href', $this.data('remove-url') );


			setTimeout(function() {
				$('body').one('click', function() {
					$('#rb-slider-actions-template').addClass('rb-hidden');
				});
			}, 200);
		}, 100);
	});

	// Slider remove
	$('.rb-slider-list-form').on('click', 'a.remove', function(e) {
		e.preventDefault();
		if(confirm(RB_l10n.SLRemoveSlider)){
			document.location.href = $(this).attr('href');
		}


	// Upload
	}).on('click', '#rb-import-button', function(e) {
		e.preventDefault();
		kmUI.modal.open('#tmpl-upload-sliders', { width: 700, height: 500 });

	// Embed
	}).on('click', 'a.embed', function(e) {
		e.preventDefault();

		var $this 	= $(this),
			$modal 	= kmUI.modal.open('#tmpl-embed-slider', { width: 900, height: 600 }),
			id 		= $this.data('id'),
			slug 	= $this.data('slug') || id;

		$modal.find('input.shortcode').val('[rbthemeslider id="'+slug+'"]');
	});

	// Pagivation
	$('.pagination-links a.disabled').click(function(e) {
		e.preventDefault();
	});


	// Import sample slider
	$( '#rb-import-samples-button' ).on( 'click', function( event ) {

		event.preventDefault();

		var	$modal,
			width = jQuery( window ).width(),
			tl;

		if( jQuery( '#rb-import-modal-window' ).length ){

			$modal = jQuery( '#rb-import-modal-window' );

		}else{

			$modal = jQuery( jQuery('#tmpl-import-sliders').text() ).hide().prependTo('body');

			// Update last store view date
			if( $modal.hasClass('has-updates') ) {
				jQuery.get( window.ajaxurl, { action: 'rb_store_opened' });
			}

			rbLogo.append( '#rb-import-modal-window .rbthemeslider-logo', true );

			setTimeout(function(){

				var	Shuffle = window.shuffle,
					element = jQuery( '#rb-import-modal-window .inner .items' )[0];
					shuffle = new Shuffle(element, {
						itemSelector: '.item',
						speed: 400,
						easing:'ease-in-out',
						delimeter: ','
					}),
					$comingSoon = jQuery( '.coming-soon' );

				jQuery( '#rb-import-modal-window .inner nav li' ).on( 'click', function(){
					jQuery(this).addClass('active').siblings().removeClass('active');
					shuffle.filter( jQuery(this).data( 'group' ) );
					if( !jQuery( '.shuffle .shuffle-item--visible' ).length ){
						$comingSoon.addClass( 'visible' );
					}else{
						$comingSoon.removeClass( 'visible' );
					}
				});

			}, 100 );
		}

		tl = new TimelineMax({
			onStart: function(){
				jQuery( 'html, body' ).addClass( 'rb-body-black' );
				jQuery( '<div>' ).addClass( 'rb-overlay-transparent' ).css({
					position: 'fixed',
					left: 0,
					top: 0,
					right: 0,
					bottom: 0
				}).appendTo( '#wpwrap' );
				jQuery( '#wpwrap' ).addClass( 'rb-wp-wrap-white' );
				jQuery(document).on( 'keyup.RB', function( e ) {
					if( e.keyCode === 27 ){
						jQuery( '#rb-import-samples-button' ).data( 'rbModalTimeline' ).reverse();
					}
				});
			},
			onReverseComplete: function(){
				jQuery( 'html, body' ).removeClass( 'rb-body-black' );
				jQuery( '#wpwrap' ).removeClass( 'rb-wp-wrap-white' );
				jQuery( '#wpwrap' ).attr( 'style', '' );
				jQuery( '#rb-import-samples-button' ).data( 'rbModalTimeline' ).clear().kill();
				jQuery( '#rb-import-samples-button' ).removeData( 'rbModalTimeline' );
				jQuery(document).off( 'keyup.RB' );
				jQuery( '#rb-import-modal-window' ).css({
					display: 'none'
				});
				jQuery( '.rb-overlay-transparent' ).remove();
			},
			paused: true
		});

		$(this).data( 'rbModalTimeline', tl );

		tl.fromTo( $modal[0], 1, {
			autoCSS: false,
			css: {
				position: 'fixed',
				display: 'block',
				x: width,
				rotationY: 45,
				opacity: .4,
				transformPerspective: width,
				transformOrigin: '0% 50%'
			}
		},{
			autoCSS: false,
			css: {
				x: 0,
				opacity: 1,
				rotationY: 0
			},
			ease: Quint.easeInOut
		}, 0 );

		tl.fromTo( $( '#wpwrap' )[0], 1, {
			autoCSS: false,
			css: {
				transformPerspective: width,
				transformOrigin: '100% 50%'
			}
		},{
			autoCSS: false,
			css: {
				x: -width,
				rotationY: -45,
				opacity: .4
			},
			ease: Quint.easeInOut
		}, 0 );

		tl.add( function(){
			shuffle.update();
		}, 0.15 );

		tl.play();
	});

	$( document ).on( 'click', '#rb-import-modal-window > header b', function(){
		$( '#rb-import-samples-button' ).data( 'rbModalTimeline' ).reverse();
	});

	// Close add slider window
	$(document).on( 'click', '.rb-overlay', function() {

		if($(this).data('manualclose')) {
			return false;
		}

		if($('.rb-pointer').length) {
			$('.rb-overlay').remove();
			$('.rb-pointer').animate({ marginTop : 40, opacity : 0 }, 150);
		}

	// Upload window
	}).on('submit', '#rb-upload-modal-window form', function(e) {

		jQuery('.button', this).text(RB_l10n.SLUploadSlider).addClass('saving');

	}).on('click', '.rb-open-template-store', function(e) {

		kmUI.modal.close();
		kmUI.overlay.close();

		setTimeout(function() {
			$('#rb-import-samples-button').click();
		}, $(this).data('delay') || 0);
	});

	// Auto-update setup screen
	$('.button-activation').click(function(e) {
		e.preventDefault();

		var $wrapper 	= $(this).closest('.rb-box'),
			$guide 		= $wrapper.find('.guide'),
			$form 		= $wrapper.find('form'),
			width 		= $wrapper.outerWidth(true) + 10;

		$form.show().find('.key input').focus();

		TweenLite.set( $form, { x: width });
		TweenLite.to( [ $guide[0], $form[0] ], 0.5, {
			x: '-='+width,
			onComplete: function() {
				$guide.hide();
			}
		});
	});

	// Auto-update authorization
	$('.rb-auto-update form').submit(function(e) {

		// Prevent browser default submission
		e.preventDefault();

		var $form 	= $(this),
			$key 	= $form.find('.key input'),
			$button = $form.find('.button-save:visible');

		if( $key.val().length < 10 ) {
			alert(RB_l10n.SLEnterCode);
			return false;
		}

		// Send request and provide feedback message
		$button.data('text', $button.text() ).text(RB_l10n.working).addClass('saving');

		// Post it
		$.post( ajaxurl, $(this).serialize(), function(data) {

			// Parse response and set message
			data = $.parseJSON(data);

			// Success
			if(data && ! data.errCode ) {

				// Apply activated state to GUI
				$form.closest('.rb-box').addClass('active');

				// Display activation message
				$('p.note', $form).css('color', '#74bf48').text( data.message );

				// Make sure that features requiring activation will
				// work without refreshing the page.
				window.rbSiteActivation = true;

			// Alert message (if any)
			} else if(typeof data.message !== "undefined") {
				alert(data.message);
			}

			$button.removeClass('saving').text( $button.data('text') );
		});
	});


	// Auto-update deauthorization
	$('.rb-auto-update a.rb-deauthorize').click(function(event) {
		event.preventDefault();

		if( confirm(RB_l10n.SLDeactivate) ) {

			var $form = $(this).closest('form');

			$.get( ajaxurl, $.param({ action: 'rbthemeslider_deauthorize_site'}), function(data) {

				// Parse response and set message
				var data = $.parseJSON(data);

				if( data && ! data.errCode ) {

					var $box 	= $form.closest('.rb-box'),
						$guide 	= $box.find('.guide'),
						$notice = $form.find('p.note');

					$notice.css('color', '#666').text('');

					$form.find('.key input').val('');
					$box.removeClass('active');

					$form.hide();
					$guide.css('transform', 'translateX(0px)').show();

					window.rbSiteActivation = false;
				}

				// Alert message (if any)
				if(typeof data.message !== "undefined") {
					alert(data.message);
				}
			});
		}
	});

	$('.rb-product-banner .unlock').click(function(e) {
		e.preventDefault();

		var $box 	= $('.rb-product-banner.rb-auto-update'),
			$window = $(window),
			wh 		= $window.height(),
			bt 		= $box.offset().top,
			bh 		= $box.height(),
			top 	= bt + (bh / 2) - (wh / 2);

			$('html,body').animate({ scrollTop: top }, 200, function() {
				setTimeout(function() {

					TweenMax.to( $box[0], 0.2, {
						yoyo: true,
						repeat: 3,
						ease: Quad.easeInOut,
						scale: 1.1
					});
				}, 100);
			});
	});

	// Permission form
	$('#rb-permission-form').submit(function(e) {
		e.preventDefault();
		if(confirm(RB_l10n.SLPermissions)) {
			this.submit();
		}
	});


	// Google CDN version warning
	$('#rb_use_custom_jquery').on('click', '.rb-checkbox', function(e) {
		if( $(this).hasClass('off') ) {
			if( ! confirm(RB_l10n.SLJQueryConfirm) ) {
				e.preventDefault();
				return false;

			}

			alert(RB_l10n.SLJQueryReminder);
		}
	});


	// News filters
	$('.rb-news .filters li').click(function() {

		// Highlight
		$(this).siblings().attr('class', '');
		$(this).attr('class', 'active');

		// Get stuff
		var page = $(this).data('page');
		var frame = $(this).closest('.rb-box').find('iframe');
		var baseUrl = frame.attr('src').split('#')[0];

		// Set filter
		frame.attr('src', baseUrl+'#'+page);

	});


	// Shortcode
	$('input.rb-shortcode').click(function() {
		this.focus();
		this.select();
	});

	// Importing demo sliders
	$( document ).on('click', '#rb-import-modal-window .item-import', function( event ) {
		event.preventDefault();

		var $item 	= jQuery(this),
			$figure = $item.closest('figure'),
			handle 	= $figure.data('handle'),
			bundled = !! $figure.data('bundled'),
			action 	= bundled ? 'rb_import_bundled' : 'rb_import_online';

		// Premium notice
		if( $figure.data('premium') && ! window.rbSiteActivation ) {
			kmUI.modal.open( {
				into: '#rb-import-modal-window',
				title: RB_l10n.TSImportWarningTitle,
				content: RB_l10n.TSImportWarningContent,
				width: 700,
				height: 200,
				overlayAnimate: 'fade'
			});
			return;

		} else if( $figure.data('version-warning') ) {
			kmUI.modal.open( {
				into: '#rb-import-modal-window',
				title: RB_l10n.TSVersionWarningTitle,
				content: RB_l10n.TSVersionWarningContent,
				width: 700,
				height: 200,
				overlayAnimate: 'fade'
			});
			return;
		}

		kmUI.modal.open( '#tmpl-importing', {
			into: '#rb-import-modal-window',
			width: 300,
			height: 300,
			close: false
		});
		rbLogo.append( '#rb-importing-modal-window .rbthemeslider-logo', true );

		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: action,
				slider: handle,
				security: window.rbImportNonce
			},
			success: function(data, textStatus, jqXHR) {
				data = JSON.parse( data );
				if( data && data.success ) {
					document.location.href = data.url;

				} else if(data.message) {
					setTimeout(function() {
						alert(data.message);
						setTimeout(function() {
							kmUI.modal.close();
							kmUI.overlay.close();
						}, 1000);
					}, 600);

					if( data.reload ) {
						window.location.reload( true );
					}

				} else {
					setTimeout(function() {
						alert(RB_l10n.SLImportError);
						setTimeout(function() {
							kmUI.modal.close();
							kmUI.overlay.close();
						}, 1000);
					}, 600);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				setTimeout(function() {
					kmUI.modal.close();
							kmUI.overlay.close();
					alert(RB_l10n.SLImportHTTPError.replace('%s', errorThrown) );
					setTimeout(function() {
						kmUI.modal.close();
						kmUI.overlay.close();
					}, 1000);
				}, 600);
			},
			complete: function() {
				$item.css('color', '#0073aa');
			}
		});
	});

});

var addRBOverlay = function() {

	var $overlay = jQuery('<div class="rb-overlay"></div>').prependTo('body');

	TweenLite.fromTo( $overlay[0], 0.4, {
		autoCSS: false,
		css: {
			y: -jQuery( window ).height()
		}
	},{
		autoCSS: false,
		ease: Quart.easeInOut,
		css: {
			y: 0
		}
	});

	setTimeout(function() {
		jQuery( '.rb-overlay' ).one( 'click', function() {
			jQuery('.rb-overlay,.rb-modal').remove();
			jQuery('body').css('overflow', 'auto');
		});

		jQuery( '.rb-modal b' ).one( 'click', function() {
			jQuery( '.rb-overlay' ).click();
		});

	}, 300);
};
