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
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function (searchElement /*, fromIndex */ ) {
		"use strict";
		if (this === null) {
			throw new TypeError();
		}
		var t = Object(this);
		var len = t.length >>> 0;
		if (len === 0) {
			return -1;
		}
		var n = 0;
		if (arguments.length > 1) {
			n = Number(arguments[1]);
			if (n != n) { // shortcut for verifying if it's NaN
				n = 0;
			} else if (n != 0 && n != Infinity && n != -Infinity) {
				n = (n > 0 || -1) * Math.floor(Math.abs(n));
			}
		}
		if (n >= len) {
			return -1;
		}
		var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
		for (; k < len; k++) {
			if (k in t && t[k] === searchElement) {
				return k;
			}
		}
		return -1;
	};
}

Array.prototype.fill = function(value, length){
	while(length--){
		this[length] = value;
	}
	return this;
};

Storage.prototype.setObject = function(key, value) {
	this.setItem(key, JSON.stringify(value));
};

Storage.prototype.getObject = function(key) {
	var value = this.getItem(key);
	return value && JSON.parse(value);
};




function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function ucFirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}


var rbLogo = {

	append: function( to, animated ){


		if( !(to instanceof jQuery) ){
			to = jQuery(to);
		}
		to.addClass( 'RbSlider-logo' ).attr('data-l10n-importing', RB_l10n.SLImporting );

		if ( animated ){
			to.addClass( 'RbSlider-logo-animated' );
		}

		jQuery( '<div class="RbSlider-logo-setheight"></div><div class="RbSlider-logo-layer"><div class="RbSlider-logo-inner"><div class="RbSlider-logo-color"></div></div></div><div class="RbSlider-logo-layer"><div class="RbSlider-logo-inner"><div class="RbSlider-logo-color"></div></div></div><div class="RbSlider-logo-layer"><div class="RbSlider-logo-inner"><div class="RbSlider-logo-color"></div></div></div>' ).appendTo( to );
	},

	remove: function( from ){

		if( !(from instanceof jQuery) ){
			from = jQuery(to);
		}

		from.removeClass( 'RbSlider-logo RbSlider-logo-animated').empty();
	}
};



(function( $ ) {
	$.fn.appendToWithIndex = function(to, index) {

		if( !( to instanceof jQuery ) ) { to = $(to); }

		if(index == 0) {
			this.prependTo(to);
		} else {
			this.insertAfter( to.children(':eq('+(index-1)+')') );
		}

		return this;
	};
})( jQuery );



(function( $ ) {

	$.fn.customCheckbox = function() {
		return this.each(function() {

			// Get element & hide it
			var $el = $(this).hide();

			// Create replacement element
			var $rep = $('<a href="#"><span></span></a>').addClass('rb-checkbox').insertAfter(this);
				$rep.addClass( $el.attr('class') );

			// Add data-* params to replacement element
			$.each( $el.data(), function( key, val ) {
				$rep.attr('data-'+key, val);
			});

			// Set default state
			if($el.prop('checked')) {
				$rep.addClass('on');
			} else {
				$rep.addClass('off');
			}
		});
	};
})( jQuery );


(function( $ ) {

	$.fn.kmTabs = function(p) {

		var properties = $.extend({}, p);

		return this.each(function(){

			var $tabs = $(this);
			var $content =  properties.content ? $(properties.content) : $(this).next('.km-tabs-content');

			$tabs.on('click', 'a', function(event){

				event.preventDefault();

				if( $(this).hasClass('active') ) {
					return false;
				}

				$tabs.children().removeClass('active');
				$(this).addClass('active');

				var index = $(this).index();
				var $iContent = $content.children().eq(index);

				$iContent.find('.km-tabs-inner').css({
					display : 'block'
				});
				var targetedHeight = $iContent.outerHeight();
				$iContent.find('.km-tabs-inner').css({
					display : 'none'
				});

				$content.find('> .active .km-tabs-inner').fadeOut(200,function(){
					$iContent.find('.km-tabs-inner').fadeIn(200);
					$content.children().removeClass('active').eq(index).addClass('active');
				});

				$content.animate({
					height: targetedHeight
				},400, function(){
					$content.css('height','auto');
				});

			});
		});
	};

}( jQuery ));



(function( $ ) {

	$.fn.kmAccordion = function() {

		this.children().each(function(){

			var $aOuter =  $(this),
				$aHead = $(this).children(':first-child'),
				$aBody = $(this).children(':last-child');

			$aHead.on('click', function(event){

				// Don't trigger .click() on accordion controls
				if($(event.target).is('.dashicons, .rb-checkbox, .rb-checkbox > span')) {
					return;
				}

				if( $aOuter.hasClass('km-accordion-opened') ){
					$aBody.css('overflow', 'hidden').slideUp(function(){
						$aBody.css('overflow', 'visible');
						$aOuter.removeClass('km-accordion-opened');
					});
				}else{
					$aBody.css('overflow', 'hidden').slideDown(function(){
						$aBody.css('overflow', 'visible');
						$aOuter.addClass('km-accordion-opened');
					});
					if( !$aOuter.parent().hasClass('km-accordion-multiple') ){
						var $siblingBody = $aOuter.siblings('.km-accordion-opened').children(':last-child');
						$siblingBody.css('overflow', 'hidden').slideUp(function(){
							$siblingBody.css('overflow', 'visible');
							$(this).parent().removeClass('km-accordion-opened');
						});
					}
				}

			});
		});

		return this;
	};

}( jQuery ));



var RB_CodeMirror = {

	init : function(settings) {

		var defaults = {
			mode: 'css',
			theme: 'solarized',
			lineNumbers: true,
			lineWrapping: true,
			autofocus: true,
			indentUnit: 4,
			indentWithTabs: true,
			foldGutter: true,
			gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
			styleActiveLine: true,
			extraKeys: {
				"Ctrl-Q": function(cm) {
					cm.foldCode(cm.getCursor());
				}
			}
		};


		jQuery('.rb-codemirror').each(function() {

			var options = jQuery.extend(true, {}, defaults, settings || {});

			if( jQuery(this).prop('readonly') ) {
				options.readOnly = true;
				options.theme += ' readonly';
			}

			var cm = CodeMirror.fromTextArea(this, options);

			cm.on('change', function( cm ) {

				cm.save();
				jQuery( cm.getTextArea() ).trigger('updated.rb', cm);
			});


			if( jQuery(this).closest('.rb-callback-box').length ) {

				cm.on('beforeChange',function( cm, change ) {

					// Select all
					if( change.from.line === 0 && change.to.line === cm.lastLine() ) {

						cm.setSelection({ line: 1, ch: 0 }, { line: cm.lastLine()-1, ch: 99999 });
						cm.replaceSelection( change.text[0] );
						change.cancel();

					} else {

						if( change.from.line === 0) {
							change.from.line = 1;
						}

						if( change.to.line === cm.lastLine() ) {
							change.to.line = cm.lastLine()-1;
						}
					}
				});
			}
		});
	}
};



jQuery(function($) {

	var rbScreenOptionsActions = {

		init : function() {

			// Form submit
			$(document).on('submit', '#rb-screen-options-form', function(e) {
				e.preventDefault(); rbScreenOptionsActions.saveSettings(this, true);
			});

			// Checkboxes
			$(document).on('click', '#rb-screen-options-form input:checkbox', function() {

				var reload 	= false,
					option 	= $(this).attr('name'),
					value 	= $(this).prop('checked');

				if(typeof rbScreenOptionsActions[ option ] != "undefined") {
					rbScreenOptionsActions[ option ](this);
				}

				if( typeof rbScreenOptions !== 'undefined') {
					rbScreenOptions[ option ] = value.toString();
				}

				if($(this).hasClass('reload')) { reload = true; }

				rbScreenOptionsActions.saveSettings( $(this).closest('form'), reload );
			});
		},

		saveSettings : function(form, reload) {

			var options = {};
			$(form).find('input:not([type="hidden"])').each(function() {
				if( $(this).is(':checkbox')) {
					options[$(this).attr('name')] = $(this).prop('checked');
				} else {
					options[$(this).attr('name')] = $(this).val();
				}
			});

			var data = $.param({
				action : 'rb_save_screen_options',
				_wpnonce: jQuery('input[name="_wpnonce"]', form).val(),
				_wp_http_referer: jQuery('input[name="_wp_http_referer"]', form).val(),
				options : options,

			});

			// Save settings
			$.post(ajaxurl, data, function() {
				if(typeof reload != "undefined" && reload === true) {
					document.location.href = 'admin.php?page=RbSlider';
				}
			});
		},

		showTooltips : function(el) {

			if( $(el).prop('checked') === true ) {
				kmUI.popover.init();
			} else {
				kmUI.popover.destroy();
			}
		}
	};

	var rbSlideUnder = {

		init : function(){

			$(document).on('click', '[data-rb-su]', function() {
				//if( $(this).parent().find('.rb-su').length == 0 ){
					rbSlideUnder.open($(this));
				//}
			});
		},

		create : function($el){

			// rbSlideUnder container is positioned absolute so we need a relative or absolute position parent element

			if( $el.parent().css('position') == 'static' ){
				$el.parent().css('position','relative');
			}

			if( $el.css('position') == 'static' ){
				$el.css('position','relative');
			}

			// Creating rbSlideUnder HTML markup

			var $su = $('<div>'),
				$sui = $('<div>'),
				$suc = $('<div>');

			$su.addClass('rb-su');
			$sui.addClass('rb-su-inner');
			$suc.addClass('rb-su-content');

			// Appending into the parent of the opener element

			$el.parent().prepend( $su
					.append( $sui
				.append( $suc
					)
				)
			);

			// Copying some CSS properties from the opener element

			var suiProps = [
				'borderRightStyle',
				'borderRightWidth',
				'borderRightColor',
				'borderLeftStyle',
				'borderLeftWidth',
				'borderLeftColor',
				'borderBottomStyle',
				'borderBottomWidth',
				'borderBottomColor',
				'backgroundColor'
			];

			for(i=0;i<suiProps.length;i++){
				$sui.css( suiProps[i], $el.css(suiProps[i]) );
			}

			$suc.css({
				'paddingTop' : $el.css('paddingLeft'),
				'paddingLeft' : $el.css('paddingLeft'),
				'paddingBottom' : $el.css('paddingLeft'),
				'paddingRight' : $el.css('paddingRight')
			});

			// Sizing and positioning

			$su.css({
				left: $el.position().left + parseInt( $el.css('marginLeft') ),
				top: $el.position().top + parseInt( $el.css('marginTop') ) + $el.outerHeight(),
				width: $el.width() + parseInt( $el.css('paddingLeft') ) + parseInt( $el.css('paddingRight') ) + parseInt( $el.css('borderLeftWidth')) + parseInt( $el.css('borderRightWidth'))
			});

			// Inserting data to content

			$suc.append( $el.siblings('.rb-su-data').html() );
		},

		open : function( $el ){

			if( !$el.parent().find( '.rb-su' ).length ){
				rbSlideUnder.create( $el );
			}

			$su = $el.parent().find( '.rb-su' );
			$sui = $el.parent().find( '.rb-su-inner' );

			if( $su.hasClass( 'rb-su-opened') ){
				return;
			}

			$su.addClass( 'rb-su-opened' );

			TweenLite.set( $su.parent()[0], {
					z:100
			});

			TweenLite.set( $su[0],
				{
					opacity: .7,
					height: 'auto',
					transformOrigin: 'center top',
					rotationX: 90,
					transformPerspective: 500
				}
			);

			TweenLite.set( $sui[0],
				{
					top: 0
				}
			);

			TweenLite.to(
				$su[0],
				2,
				{
					opacity: 1,
					rotationX: 0,
					ease: 'Elastic.easeOut'
				}
			);

			// Creating close function

			$(document).one( 'click', function(e){
				rbSlideUnder.close($su, $sui);
			});
		},

		close : function($su, $sui){

			TweenLite.to(
				$sui[0],
				.3,
				{
					top: -$sui.outerHeight(),
					ease: 'Quart.easeIn'
				}
			);

			TweenLite.to(
				$su[0],
				.3,
				{
					opacity: .7,
					height: 0,
					ease: 'Quart.easeIn',
					onComplete : function(){
						$su.removeClass( 'rb-su-opened' );
					}
				}
			);
		}
	};

	rbSlideUnder.init();

	var rbUIDependencies = {

		init : function() {

			$(document).on('change input click', '[data-toggleitems], [data-showitems], [data-hideitems]', function( event ) {

				var $el = jQuery( this );


				if( event.type === 'click' && $el.is('select,input,textarea,.rb-checkbox') ) {
					return;
				}


				if( $el.is('select') ) {
					$el = $el.children(':selected');
				}

				if( $el.data('showitems') ) {
					jQuery( $el.data('showitems') ).addClass('rb-hidden');
				}

				if ( $el.data('hideitems') ) {
					jQuery( $el.data('hideitems') ).removeClass('rb-hidden');
				}

				if( $el.data('toggleitems') ) {

					var $targets = jQuery( $el.data('toggleitems') );

					if( $el.data('opened') ) {
						$el.data('opened', false);
						$targets.addClass('rb-hidden');
					} else {
						$el.data('opened', true);
						$targets.removeClass('rb-hidden');
					}
				}
			});
		},
	};




	// Popovers
	if(typeof rbScreenOptions != 'undefined' && rbScreenOptions['showTooltips'] == 'true') {
		kmUI.popover.init();
	}

	rbUIDependencies.init();

	// Screen options
	$('#rb-screen-options, #rb-guides').children(':first-child').appendTo('#screen-meta');
	$('#rb-screen-options, #rb-guides').children(':last-child').appendTo('#screen-meta-links');
	rbScreenOptionsActions.init();


	// CodeMirror
	if(document.location.href.indexOf('&action=edit') === -1) {
		RB_CodeMirror.init();
	}


	// Skin/CSS Editor
	if(document.location.href.indexOf('rb-skin-editor') != -1 ||
		document.location.href.indexOf('rb-style-editor') != -1) {
		$('select[name="skin"]').change(function() {
			document.location.href = 'admin.php?page=rb-skin-editor&skin=' + $(this).children(':selected').val();
		});
	}


	// Checkbox event
	$(document).on('click', '.rb-checkbox', function(e){
		e.preventDefault();

		// Get checkbox
		var el = $(this).prev()[0];

		// Disabled, exit quietly
		if( el.disabled ) { return; }

		if( $(el).is(':checked') && ! $(this).is('.indeterminate') ) {
			$(el).prop('checked', false);
			$(this).removeClass('on indeterminate').addClass('off');
		} else {
			$(el).prop('checked', true);
			$(this).removeClass('off indeterminate').addClass('on');
		}

		// Trigger events
		$(el).trigger('change');
		$('#rb-layers').trigger( $.Event('click', { target : el } ) );
		$(document).trigger( $.Event('click', { target : el } ) );
	});


	// Share sheet
	$('#rb-share-template .inner a').click(function(e) {
		e.preventDefault();

		var newWindow = window.open('', '_blank', 'width=700,height=400');
			newWindow.location.href = $(this).attr('href');
			newWindow.focus();
	});


	$('#rb-share-template h3 a').click(function(e) {
		e.preventDefault();
		$('#rb-share-template, .rb-overlay').remove();
	});
});

var kmComboBox = {

	init: function() {

		jQuery(document).on('focus', '.km-combo-input:not(.opened)', function() {
			RB_comboBoxIsDirty = false;
			kmComboBox.show( jQuery(this) );

		}).on('click', '.km-combo-box li', function(){
			RB_comboBoxIsDirty = false;
			kmComboBox.select( jQuery(this) );

		}).on('blur', '.km-combo-input.opened', function() {
			var $input = jQuery(this);
			setTimeout(function($input) {
				kmComboBox.hide( $input );
			}, 200, $input);

			setTimeout(function() {
				if( RB_comboBoxIsDirty ) {
					RbSlider.generateSelectedPreviewItems();
				}
			}, 100);

		}).on('mouseenter', '.km-combo-box li', function() {
			var $item 		= jQuery(this),
				cssProp 	= $item.parent().data('css-property'),
				cssVal 		= $item.text(),
				fontFamily 	= $item.data('font-family');


			if( fontFamily || cssProp ) {
				RB_previewArea
					.children('.ui-selected')
					.css( cssProp || 'font-family', fontFamily || parseInt(cssVal));

				RbSlider.updatePreviewSelection();
				RB_comboBoxIsDirty = true;
			}
		});
	},


	show: function( $input ) {

		var $wrapper,
			$list,
			$parent = $input.parent(),
			options,
			width,
			input,
			list,
			paddingTop;

		$parent.addClass( 'km-combo-parent' );

		input = {
			width: $input.outerWidth(),
			height: $input.outerHeight( true ),
			left: $input.position().left - parseInt( $parent.css( 'padding-left') ),
			top: $input.position().top,
			margins: parseInt( $input.css( 'margin-top' ) ) + parseInt( $input.css( 'margin-bottom' ) )
		};

		$parent.removeClass( 'km-combo-parent' );

		// Retrieve list options
		options = $input.data('options');

		// Create wrapper
		$wrapper = jQuery('<div class="km-combo-box"></div>').insertAfter( $input.addClass( 'opened' ) );

		// Insert combo-list after the input
		$list = jQuery('<ul class="km-combo-list">').appendTo( $wrapper );
		$list.data('css-property', $input.data('css-property') );


		// Populate list
		jQuery.each(options, function(index, option) {
			var optionName = jQuery.type(option) == 'string' ? option : option.name || option.value,
				optionValue = 'value' in option ? option.value : optionName,
				listItem = jQuery('<li>').data('value', optionValue);
				listItem.text(optionName).appendTo($list);

			if( option.font ) {
				listItem
					.data('font-family', optionValue)
					.css('font-family', optionValue);
			}
		});

		// set styles
		list = {
			paddingLeft: parseInt( $list.css( 'padding-left' ) ),
			paddingRight: parseInt( $list.css( 'padding-right' ) ),
			paddingTop: parseInt( $list.css( 'padding-top' ) ),
			paddingBottom: parseInt( $list.css( 'padding-bottom' ) ),
			width: $list.outerWidth()
		};
		$list.css({
			paddingTop: list.paddingTop * 2 + input.height
		});
		list.height = $list.outerHeight();
		wrapper = {
			width: Math.max( input.width + list.paddingLeft + list.paddingRight, list.width ) + 4
		};

		$wrapper.css({
			width: wrapper.width,
			height: list.height
		});

		// blur fix
		$wrapper[0].attributes.style.value += ' margin: '+( - input.height - list.paddingTop )+'px '+( ( input.left + input.width / 2 ) - wrapper.width / 2 )+'px !important;';
	},


	hide: function( $input ) {

		// Remove the list and wrapper
		$input.removeClass( 'opened' ).next('.km-combo-box').remove();
	},


	select: function( $li ) {

		var $wrapper 	= $li.closest('.km-combo-box'),
			$input 		= $wrapper.prev('input');

		// Enter value into input & trigger event
		$input.val( $li.data('value') ).trigger('input').trigger('change');
	}

};

kmComboBox.init();
