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
jQuery(document).ready(function($) {

	tinymce.create('tinymce.plugins.rbthemeslider_plugin', {

		init : function(ed, url) {

			// Close event
			$(document).on('click', '.mce-rbthemeslider-overlay', $.proxy(function() {
				this.closePopup();
			}, this));

			$(document).on('click', '.mce-rbthemeslider-window .close-modal', $.proxy(function(e) {

				e.preventDefault();
				this.closePopup();
			}, this));

			$(document).on('keydown', $.proxy(function(e) {

				if( e.which === 27 ) {
					this.closePopup();
				}

			}, this)).on('keyup', $.proxy(function(e) {


			}));

			// Select slider
			$(document).on('click', '.mce-rbthemeslider-window .slider-item', $.proxy(function(e) {
				this.selectSlider( e, $(e.currentTarget) );
			}, this));


			// Insert slider
			$(document).on('click', '.mce-rbthemeslider-insert-button', $.proxy(function(e) {
				this.insertSlider();
				this.closePopup();
			}, this));

			// Button props
			ed.addButton('rbthemeslider_button', {
				title : RB_MCE_l10n.MCEAddRbSlider,
				cmd : 'rbthemeslider_insert_shortcode',
				onClick : $.proxy(this.openPopup, this)
			});
		},


		openPopup : function(e) {

			// Get the popup
			var $modal = $('.mce-rbthemeslider-window');

			// If the popup isn't already open, create it and load its content using ajax
			if( ! $('.mce-rbthemeslider-window').length ) {

				var modalMarkup =
				'<div class="mce-rbthemeslider-window" tabindex="-1">\
					<a href="#" class="close-modal"></a>\
					<h3 class="header" tabindex="0">'+RB_MCE_l10n.MCEInsertSlider+'</h3>\
					<div class="inner"></div>\
					<div class="footer">\
						<div class="options">\
							<strong>'+RB_MCE_l10n.MCEEmbedOptions+'</strong>\
							<span>'+RB_MCE_l10n.MCEStartingSlide+'</span>\
							<input type="text" data-option="firstslide" placeholder="'+RB_MCE_l10n.MCENoOverride+'">\
						</div>\
						<button class="button button-primary mce-rbthemeslider-insert-button" disabled>'+RB_MCE_l10n.MCEInsertButton+'</button>\
					</div>\
				</div>';

				// Prepend modal
				$modal = $( modalMarkup ).prependTo('body');
				var $inner = $('.inner', $modal);

				// Set focus on the window to allow keyboard shortcuts
				setTimeout(function() {
					$modal.focus();
				}, 100);

				// Add overlay
				$('<div>', { 'class' : 'mce-rbthemeslider-overlay'}).prependTo('body');

				var itemMarkup =
				'<div class="slider-item">\
					<div class="slider-item-wrapper">\
						<div class="preview">\
							<div class="no-preview">\
								<h5>'+RB_MCE_l10n.MCENoPreview+'</h5>\
								<small>'+RB_MCE_l10n.MCENoPreviewText+'</small>\
							</div>\
						</div>\
						<div class="info">\
							<div class="name"></div>\
						</div>\
					</div>\
					<div class="selection">\
						<span class="dashicons dashicons-yes"></span>\
					</div>\
				</div>';

				// Get sliders
				$.getJSON(ajaxurl, { action : 'rb_get_mce_sliders' }, function(data) {
					$.each(data, function(index, item) {
						var $item = $(itemMarkup);

						$item.data({
							'id': item.id,
							'slug': item.slug
						});

						if( item.preview ) {
							$('.preview', $item).empty().css({
								'background-image': 'url('+item.preview+')'
							});
						}

						$('.name', $item).html( item.name );

						$item.appendTo( $inner );
					});

				});
			}
		},

		searchSlider : function() {

		},

		selectSlider : function( event, $item ) {

			// Add to multi-select
			if( event.ctrlKey || event.metaKey ) {
				$item.toggleClass('selected');

			// Single select
			} else {
				$item.addClass('selected').siblings().removeClass('selected');
			}

			// Enable insert button
			$('.mce-rbthemeslider-insert-button').attr('disabled', false);
		},


		insertSlider: function() {

			// Get modal window
			var $modal = $('.mce-rbthemeslider-window');

			// Get selected element
			$('.slider-item.selected', $modal).each(function() {

				// Get options
				var $item 		= $(this),
					sliderId 	= $item.data('id'),
					sliderSlug 	= $item.data('slug'),
					embedId 	= sliderSlug ? sliderSlug : sliderId,
					firstSlide 	= $('input[data-option="firstslide"]', $modal).val();

				if( firstSlide ) {
					firstSlide = ' firstslide="'+firstSlide+'"';
				}

				tinymce.execCommand('mceInsertContent', false, '[rbthemeslider id="'+embedId+'"'+firstSlide+']');
			});
		},

		closePopup : function() {

			if($('.mce-rbthemeslider-window').length) {
				$('.mce-rbthemeslider-overlay').remove();
				$('.mce-rbthemeslider-window').remove();
			}
		}
	});

	// Add button
	tinymce.PluginManager.add('rbthemeslider_button', tinymce.plugins.rbthemeslider_plugin);
});
