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
var RB_sliderID = 0,


// Store the indexes of currently
// selected items on the interface.
RB_activeSlideIndex = 0,
RB_activeLayerIndexSet = [0],
RB_activeLayerPageIndex = 0,
RB_activeLayerTransitionTab = 0,
RB_activeScreenType = 'desktop',

RB_lastSelectedLayerIndex = 0,

// Stores all preview items using an object
// to easily add and modify items.
//
// NOTE: it's not a jQuery collection, but a
// collection of jQuery-enabled elements.
RB_previewItems = [],


// Object references, pointing to the currently selected
// slide/layer data. These are not working copies, any
// change made will affect the main data object. This makes
// possible to avoid issues caused by inconsistent data.
RB_activeSlideData = {},
RB_activeLayerDataSet = [],
RB_activeStaticLayersDataSet = [],


// These objects will be filled with the default slide/layer
// properties when needed. They purpose as a caching mechanism
// for bulk slide/layer creation.
RB_defaultSliderData = {},
RB_defaultSlideData = {},
RB_defaultLayerData = {},


// Stores all previous editing sessions
// to cache results and speed up operations.
RB_editorSessions = [],

// Flag for unsaved changes on site.
// We use this to display a warning
// for the user when leaving the page.
RB_editorIsDirty = false,


// Flag for transformed layers due to
// combo box preview, which needs to
// be updated after closing the combo box.
RB_comboBoxIsDirty = false,


// Flag for dragging operations to better
// handle layer selection in a group-select
// scenario.
RB_layerWasDragged = false,


// Stores default UI settings of
// editing sessions.
RB_defaultEditorSession = {
	slideIndex: RB_activeSlideIndex,
	layerIndex: RB_activeLayerIndexSet,
	zoomSlider: 100,
	zoomAutoFit: true
},


// Stores temporary data for all
// copy & pate operations.
RB_clipboard = {},


// Stores the main UI elements
RB_previewZoom = 1,
RB_previewArea,
RB_previewHolder,
RB_previewWrapper,

// Context menu
RB_contextMenuTop = 10,
RB_contextMenuLeft = 10,

RB_transformStyles = [
	'rotation',
	'rotationX',
	'rotationY',
	'scaleX',
	'scaleY',
	'skewX',
	'skewY'
];

var $lasso = jQuery();

// Utility functions to perform
// commonly used tasks.
var RB_Utils = {

	convertDateToUTC: function(date) {
		return new Date(
				date.getUTCFullYear(),
				date.getUTCMonth(),
				date.getUTCDate(),
				date.getUTCHours(),
				date.getUTCMinutes(),
				date.getUTCSeconds()
		);
	},

	dataURItoBlob: function(dataURI) {
		var binary = atob(dataURI.split(',')[1]);
		var array = [];
		for(var i = 0; i < binary.length; i++) {
			array.push(binary.charCodeAt(i));
		}
		return new Blob([new Uint8Array(array)], {type: 'image/png'});
	},

	moveArrayItem: function(array, from, to) {
		if( to === from ) return;

		var target = array[from];
		var increment = to < from ? -1 : 1;

		for(var k = from; k != to; k += increment){
			array[k] = array[k + increment];
		}
		array[to] = target;
	},


	toAbsoluteURL: function(url) {
		// Handle absolute URLs (with protocol-relative prefix)
		// Example: //domain.com/file.png
		if (url.search(/^\/\//) != -1) {
			return window.location.protocol + url;
		}

		// Handle absolute URLs (with explicit origin)
		// Example: http://domain.com/file.png
		if (url.search(/:\/\//) != -1) {
			return url;
		}

		// Handle absolute URLs (without explicit origin)
		// Example: /file.png
		if (url.search(/^\//) != -1) {
			return window.location.origin + url;
		}

		// Handle relative URLs
		// Example: file.png
		var base = window.location.href.match(/(.*\/)/)[0];
		return base + url;
	},

	// credits: http://phpjs.org/functions/strip_tags/
	stripTags: function(input, allowed) {

		allowed = (((allowed || '') + '')
			.toLowerCase()
			.match(/<[a-z][a-z0-9]*>/g) || [])
			.join('');
		var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
			commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
		return input.replace(commentsAndPhpTags, '')
			.replace(tags, function($0, $1) {
				return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
			});
	},

	// credits: http://phpjs.org/functions/nl2br/
	nl2br: function(str, is_xhtml) {
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
		return (str + '')
			.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	},

	// credits: http://stackoverflow.com/questions/3169786/clear-text-selection-with-javascript
	removeTextSelection: function() {
		var selection = window.getSelection ? window.getSelection() : document.selection ? document.selection : null;
		if(!!selection) selection.empty ? selection.empty() : selection.removeAllRanges();
	},

	// credits: http://locutus.io/php/stripslashes/
	stripslashes: function(str) {
	  return (str + '')
		.replace(/\\(.?)/g, function (s, n1) {
		switch (n1) {
			case '\\':
			  return '\\'
			case '0':
			  return '\u0000'
			case '':
			  return ''
			default:
			  return n1
		  }
		});
	},


	// credits: http://locutus.io/php/parse_url/
	parse_url: function(str, component) {
		var query;

		var mode = (typeof require !== 'undefined' ? require('../info/ini_get')('locutus.parse_url.mode') : undefined) || 'php';

		var key = [
			'source',
			'scheme',
			'authority',
			'userInfo',
			'user',
			'pass',
			'host',
			'port',
			'relative',
			'path',
			'directory',
			'file',
			'query',
			'fragment'
		];

		// For loose we added one optional slash to post-scheme to catch file:/// (should restrict this)
		var parser = {
			php: new RegExp([
				'(?:([^:\\/?#]+):)?',
				'(?:\\/\\/()(?:(?:()(?:([^:@\\/]*):?([^:@\\/]*))?@)?([^:\\/?#]*)(?::(\\d*))?))?',
				'()',
				'(?:(()(?:(?:[^?#\\/]*\\/)*)()(?:[^?#]*))(?:\\?([^#]*))?(?:#(.*))?)'
			].join('')),
			strict: new RegExp([
				'(?:([^:\\/?#]+):)?',
				'(?:\\/\\/((?:(([^:@\\/]*):?([^:@\\/]*))?@)?([^:\\/?#]*)(?::(\\d*))?))?',
				'((((?:[^?#\\/]*\\/)*)([^?#]*))(?:\\?([^#]*))?(?:#(.*))?)'
			].join('')),
			loose: new RegExp([
				'(?:(?![^:@]+:[^:@\\/]*@)([^:\\/?#.]+):)?',
				'(?:\\/\\/\\/?)?',
				'((?:(([^:@\\/]*):?([^:@\\/]*))?@)?([^:\\/?#]*)(?::(\\d*))?)',
				'(((\\/(?:[^?#](?![^?#\\/]*\\.[^?#\\/.]+(?:[?#]|$)))*\\/?)?([^?#\\/]*))',
				'(?:\\?([^#]*))?(?:#(.*))?)'
			].join(''))
		};

		var m = parser[mode].exec(str);
		var uri = {};
		var i = 14;

		while (i--) {
			if (m[i]) {
				uri[key[i]] = m[i];
			}
		}

		if (component) {
			return uri[component.replace('PHP_URL_', '').toLowerCase()];
		}

		if (mode !== 'php') {
			var name = (typeof require !== 'undefined' ? require('../info/ini_get')('locutus.parse_url.queryKey') : undefined) || 'queryKey';
			parser = /(?:^|&)([^&=]*)=?([^&]*)/g;
			uri[name] = {};
			query = uri[key[12]] || '';
			query.replace(parser, function ($0, $1, $2) {
				if ($1) {
					uri[name][$1] = $2;
				}
			});
		}

		delete uri.source;
		return uri;
	}
};


var RB_GUI = {

	updateImagePicker: function( $picker, image, updateProperties ) {

		updateProperties = updateProperties || {};

		if( typeof $picker === 'string' ) {
			$picker = jQuery('input[name="'+$picker+'"]').next();
		}

		if( image === 'useCurrent' ) {
			image = $picker.find('img').attr('src');
		}

		if( image && image.indexOf('blank.gif') !== -1 ) {
			if( ! updateProperties.fromPost ) {
				image = false;
			}
		}

		$picker
			.removeClass('has-image not-set')
			.addClass( image ? 'has-image' : 'not-set' )
			.find('img').attr('src', image ||  rbTrImgPath+'blank.gif' );
	},


	updateLinkPicker: function( $input, data ) {
		return;

		var $holder = $input.closest('.rb-slide-link'),
			postId, postName, postType, l10nKey;

		if( ! data ) {

			postId 		= $holder.find('input[name="linkId"]').val();
			postName 	= $holder.find('input[name="linkName"]').val();
			postType 	= $holder.find('input[name="linkType"]').val();
		}

		if( ( postId && '[url]' === postId ) || '[url]' === $input.val() ) {
			$holder.addClass('has-link');
			$input.val( RB_l10n.SBLinkPostDynURL ).prop('disabled', true);
			$holder.find('input[name="linkId"]').val('[url]');

		} else if( postId && postName && postType ) {

			l10nKey = 'SBLinkText'+ucFirst( postType );

			$holder.addClass('has-link');
			$input.val( RB_l10n[l10nKey].replace('%s', postName) ).prop('disabled', true);
		}

		$holder.find('input').trigger('input');
	},

	deeplinkSection: function() {
		var hash 		= document.location.hash.replace('#', ''),
			$target 	= jQuery('[data-deeplink="'+hash+'"]');

		if( $target.length ) {
			$target.click();
		}
	}
};



// Slide specific undo & redo operations.
// Uses callbacks to run any code stored by
// other methods. Supports custom parameters.
var RB_UndoManager = {

	index: -1,
	stack: [],
	limit: 50,

	add: function(cmd, name, updateInfo) {

		// Invalidate items higher on the stack when
		// called from an undo-ed position
		this.stack.splice(this.index + 1, this.stack.length - this.index);
		this.index = this.stack.length - 1;

		// Maintain stack limit
		if(this.stack.length > this.limit) {
			this.stack.shift();
		}

		// Verify 'history' object in slide
		if(!RB_activeSlideData.hasOwnProperty('history')) {
			RB_activeSlideData.history = [];
		}

		// Prepare updateInfo
		this.prepareUpdateInfo( updateInfo );

		// Add item
		this.stack.push({
			cmd: cmd,
			name: name,
			updateInfo: updateInfo
		});

		// Maintain buttons and stack index
		this.index = this.stack.length - 1;
		this.maintainButtons();

		// Mark unsaved changes on page
		RB_editorIsDirty = true;
	},


	// Replace this.stack when switching slides
	// to support slide-specific history.
	update: function() {

		// Verify 'history' object in slide
		if(!RB_activeSlideData.hasOwnProperty('history')) {
			RB_activeSlideData.history = [];
		}

		this.stack = RB_activeSlideData.history;
		this.index = this.stack.length - 1;

		if( RB_activeSlideData.meta && RB_activeSlideData.meta.undoStackIndex ) {
			this.index = RB_activeSlideData.meta.undoStackIndex;
		}

		this.maintainButtons();
	},


	// Merges new changes into the last item in
	// the UndoManager stack.
	merge: function( cmd, name, updateInfo ) {
		var lastItem = this.stack[ this.stack.length - 1 ];
		this.prepareUpdateInfo( updateInfo );
		jQuery.extend(true, lastItem.updateInfo, updateInfo);
	},


	// Empties the current slide's history and reset
	// every UndoManager-related properties
	empty: function() {
		RB_activeSlideData.history = [];

		if( RB_activeSlideData.meta && RB_activeSlideData.meta.undoStackIndex ) {
			RB_activeSlideData.meta.undoStackIndex = -1;
		}

		this.update();
	},


	undo: function() {
		if(this.stack[this.index]) {
			this.execute('undo', this.stack[this.index], this.stack[this.index-1]);
			this.index--;
			this.maintainButtons();
		}
	},


	redo: function() {
		if(this.stack[this.index+1]) {
			this.index++;
			this.execute('redo', this.stack[this.index], this.stack[this.index+1]);
			this.maintainButtons();
		}
	},


	prepareUpdateInfo: function( updateInfo ) {

		if( updateInfo && typeof updateInfo === 'object') {
			jQuery.each(updateInfo, function(key, val) {

				if( typeof val === 'object') {
					RB_UndoManager.prepareUpdateInfo( val );
					return true;
				}

				if( val === null || typeof val === 'undefined') {
					updateInfo[key] = '';
				}
			});
		}
	},

	maintainButtons: function(itemIndex) {

		var undoButton = jQuery('.rb-editor-undo'),
			redoButton = jQuery('.rb-editor-redo');

		RB_activeSlideData.meta.undoStackIndex = this.index;

		if(this.index !== -1) { undoButton.removeClass('disabled'); }
			else { undoButton.addClass('disabled'); }

		if(this.index < this.stack.length-1) { redoButton.removeClass('disabled'); }
			else { redoButton.addClass('disabled'); }
	},

	execute: function(action, item, followingItem) {

		var layerIndexSet = [];

		// Convert object to array to easily
		// handle multi-action steps.
		if( jQuery.type(item.updateInfo) === 'object' ) {
			item.updateInfo = [item.updateInfo];
		}

		// Iterate through actions in step.
		for(var c = 0; c < item.updateInfo.length; c++) {

			this.executeItem(
				item.cmd,
				item.updateInfo[c].itemIndex,
				item.updateInfo[c][action],
				item.updateInfo[c]
			);

			layerIndexSet.push( item.updateInfo[c].itemIndex );
		}

		this.restoreSelection( action, layerIndexSet, followingItem );
	},


	restoreSelection: function(action, layerIndexSet, followingItem) {

		if( followingItem && action === 'undo'  ) {

			var followingIndexSet = [];

			if( jQuery.type(followingItem.updateInfo) === 'object' ) {
				followingItem.updateInfo = [followingItem.updateInfo];
			}

			for(var c = 0; c < followingItem.updateInfo.length; c++) {
				followingIndexSet.push( followingItem.updateInfo[c].itemIndex );
			}
		}

		// Re-select affected layers if the selection has changed
		if( JSON.stringify( followingIndexSet || layerIndexSet) !== JSON.stringify(RB_activeLayerIndexSet)  ) {
			if( RB_activeSlideData.sublayers.length-1 < Math.max.apply(Math, followingIndexSet || layerIndexSet) ) {
				RbSlider.selectLayer( [ RB_activeSlideData.sublayers.length-1] );
			} else {
				RbSlider.selectLayer( followingIndexSet || layerIndexSet );
			}
		}
	},


	executeItem: function(command, itemIndex, updateInfo, item) {

		switch(command) {

			case 'slide.general':
				this.updateOptions(RB_activeSlideData.properties, itemIndex, updateInfo, 'slide');
				RbSlider.updateSlideInterfaceItems();
				RbSlider.generatePreview();
				break;


			case 'slide.layers':
				if(jQuery.isEmptyObject(updateInfo.data)) {
					RbSlider.removeLayer(itemIndex, { histroyEvent: true, requireConfirmation: false });
				} else {
					RbSlider.addLayer(updateInfo.data, itemIndex, { histroyEvent: true });
					RbSlider.selectLayer( item.selectIndex );
				}
				RB_DataSource.buildLayersList();
				RbSlider.generatePreview();
				break;


			case 'layer.order':
				RB_Utils.moveArrayItem(RB_activeSlideData.sublayers, updateInfo.from, updateInfo.to);
				RB_DataSource.buildLayersList();
				RbSlider.generatePreview();
				break;


			case 'layer.general':
				this.updateOptions(RB_activeSlideData.sublayers[itemIndex], itemIndex, updateInfo);
				RbSlider.updateLayerInterfaceItems(itemIndex);
				RbSlider.generatePreviewItem(itemIndex);
				RbSlider.updatePreviewSelection();
				break;


			case 'layer.transition':
				this.updateOptions(RB_activeSlideData.sublayers[itemIndex].transition, itemIndex, updateInfo);
				RbSlider.generatePreviewItem(itemIndex);
				break;


			case 'layer.style':
				this.updateOptions(RB_activeSlideData.sublayers[itemIndex].styles, itemIndex, updateInfo);
				RbSlider.generatePreviewItem(itemIndex);
				RbSlider.updatePreviewSelection();
				break;
		}
		jQuery(RB_UndoManager).trigger('afterExecuteItem', arguments);
	},


	// Iterates over the updateInfo object,
	// overrides the keys in the provided
	// data object.
	updateOptions: function( data, index, updateInfo, area ) {

		area = area || 'layers';
		var parent = (area === 'slide') ? '.rb-slide-options' : '.rb-layers-table';

		jQuery.each(updateInfo, function(key, val) {

			//if( data.hasOwnProperty(key) ) {

				if( typeof val === 'object' ) {
					RB_UndoManager.updateOptions( data[key], index, updateInfo[key], area);
					return true;
				}

				// Update data
				data[key] = val;

				// Handle UI if it's the active layer
				if( area === 'slide' || (RB_activeLayerIndexSet.length == 1 && index == RB_activeLayerIndexSet[0]) ) {

					var $target = jQuery(parent+' '+'[name="'+key+'"]'),
						eventType = 'input';

					if( ! $target.is(':checkbox') ) {
						$target.val(val).trigger('input').trigger('keyup');
					}

					if($target.is(':checkbox')) {
						if(val) {
							$target.prop('checked', true);
							$target.next().addClass('on').removeClass('off');
						} else {
							$target.prop('checked', false);
							$target.next().addClass('off').removeClass('on');
						}
						return;

					} else if($target.is('select')) {
						eventType = 'change';
					}
					var jqEvent = jQuery.Event(eventType, { target: $target[0], UndoManagerAction: true });
					jQuery('#rb-layers').triggerHandler(jqEvent);
				}

			//}
		});
	},


	saveOriginalInputValues: function( $input ) {

		var prevVals 	= [],
			type 		= null,
			optionName 	= $input.attr('name'),
			optionValue = $input.is(':checkbox') ? ! $input.prop('checked') : $input.val();

		// Save input value as a generic solution
		$input.data('prevVal', optionValue );

		// Override saved data if it's a layer option
		if( $input.closest('.rb-sublayer-pages').length ) {

			if( $input.hasClass('sublayerprop') ) { type = 'transition'; }
				else if( $input.hasClass('auto') ) { type = 'styles'; }

			jQuery.each(RB_activeLayerDataSet, function(item, layerData) {
				var area = layerData;
				if( type ) { area = area[type]; }

				prevVals.push( area[optionName] );
			});

			$input.data('prevVal', prevVals );
		}
	},


	trackInputs: function( event, element ) {

		event = event || { type: 'change' };

		if( event.UndoManagerAction ) { return false; }

		var $input = jQuery(element),
			cmd, name, index;

		if( event.type.toLowerCase() == 'click' && $input.is('input,textarea') ) {
			return;
		}

		if( event.type.toLowerCase() !== 'change' ) {
			this.saveOriginalInputValues( $input );
			return;
		} else if( event.type.toLowerCase() === 'change' && $input.is(':checkbox') ) {
			this.saveOriginalInputValues( $input );
		}

		// Skip colorpickers, as they rapidly send change events
		if( $input.hasClass('rb-colorpicker') ) {
			return;
		}

		if( $input.closest('.rb-sublayer-pages').length ) {
			cmd = 'layer.general';
			name = RB_l10n.SBUndoLayer;
			index = RB_activeLayerIndexSet[0];

			if($input.hasClass('sublayerprop')) { cmd = 'layer.transition'; }
				else if($input.hasClass('auto')) { cmd = 'layer.style'; }

		} else if( $input.closest('.rb-slide-options').length ) {
			cmd = 'slide.general';
			name = RB_l10n.SBUndoSlide;
			index = RB_activeSlideIndex;

		} else {
			return true;
		}

		var updateInfo 	= [],
			optionName 	= $input.attr('name'),
			optionValue = $input.is(':checkbox') ? $input.prop('checked') : $input.val(),
			prevValue 	= $input.data('prevVal'),
			action 		= $input.hasClass('undomanager-merge') ? 'merge': 'add';

		if( ! optionName ) {
			return false;
		}

		// Layer option change, handle multiple
		// selection (if any).
		if( typeof prevValue === 'object' ) {

			jQuery.each(RB_activeLayerIndexSet, function( index, layerIndex ) {
				var undo = {}, redo = {};
					undo[ optionName ] = prevValue[ index ];
					redo[ optionName ] = optionValue;

				if( prevValue[ index ] !== optionValue ) {
					updateInfo.push({
						itemIndex: layerIndex,
						undo: undo,
						redo: redo
					});
				}
			});

		// Slide option change
		} else {

			if( prevValue !== optionValue ) {

				var undo = {}, redo = {};
					undo[ optionName ] = prevValue;
					redo[ optionName ] = optionValue;

				updateInfo.push({
					itemIndex: index,
					undo: undo,
					redo: redo
				});
			}
		}

		RB_UndoManager[action](cmd, name, updateInfo);
	}
};


var RbSlider = {

	uploadInput: null,
	dragIndex: 0,
	timeout: 0,
	mediaCheckTimeout: 0,
	isSlidePreviewActive: false,
	isLayerPreviewActive: false,
	selectableTimeout: 0,

	getSliderSize: function() {

		var sliderProps = window.rbSliderData.properties, width, height;

		if( sliderProps.type && sliderProps.type === 'popup' ) {
			width 	= sliderProps.popupWidth  || 640;
			height 	= sliderProps.popupHeight || 360;
		} else {
			width 	= parseInt(sliderProps.sublayercontainer) || sliderProps.width || 1280;
			height 	= sliderProps.height || 720;
		}

		return {
			width: parseInt(width),
			height: parseInt(height)
		};
	},

	sliderIsEmpty: function( length ) {

		var isEmpty = true;

		jQuery.each(window.rbSliderData.layers, function(slideKey, slide) {

			if( jQuery.trim( slide.properties.background ) ) {
				isEmpty = false; return false;
			}

			jQuery.each(slide.sublayers, function(layerKey, layer) {

				// Has image
				if( layer.media === 'img' ) {
					if( layer.image ) {
						isEmpty = false; return false;
					}

				// Has textual content
				} else if( layer.html ) {
					isEmpty = false; return false;

				// Has visual content
				} else if( layer.styles.width || layer.styles.height ) {

					if( layer.html || layer.styles.background ) {
						isEmpty = false; return false;

					} else if( layer.styles['border-top'] || layer.styles['border-right'] || layer.styles['border-bottom'] || layer.styles['border-left'] ) {
						isEmpty = false; return false;
					}
				}
			});

			if( length && length === slideKey+1 ) {
				return false;
			}
		});

		return isEmpty;
	},


	selectMainTab: function(el) {

		var $tab = jQuery(el);

		// Select new tab
		$tab.addClass('active').siblings().removeClass('active');

		// Show new tab contents
		jQuery('#rb-pages .rb-page').removeClass('active');
		jQuery('#rb-pages .rb-page').eq( $tab.index() ).addClass('active');

		// Make sure to properly resize the transition options
		if( $tab.hasClass('layers') ) {
			kmUI.smartResize.set();
		}

		// Init CodeMirror
		if($tab.hasClass('callbacks')) {
			if(jQuery('.rb-callback-page .CodeMirror-code').length === 0) {
				RB_CodeMirror.init({ mode: 'javascript', autofocus : false, styleActiveLine : false });
				jQuery(window).scrollTop(0);
			}
		}
	},


	selectSettingsTab: function(li) {
		var index = jQuery(li).index();
		jQuery(li).addClass('active').siblings().removeClass('active');
		jQuery('div.rb-settings-contents > table > tbody.active').removeClass('active');
		jQuery('div.rb-settings-contents > table > tbody').eq(index).addClass('active');

		// Make sure that the Slider Settings section is selected
		jQuery('#rb-main-nav-bar .settings').click();

		// Update hash for deeplinking
		document.location.hash = jQuery(li).data('deeplink');
	},


	addSlide: function() {

		// Get default data objects for slides and layers
		var newSlideData = jQuery.extend(true, {}, RB_DataSource.getDefaultSlideData());

		// Add new slide data to data source
		window.rbSliderData.layers.push({
			properties: newSlideData,
			sublayers: []
		});

		// Add new slide tab
		var newIndex 	= window.rbSliderData.layers.length + 1,
			title 		= RB_l10n.SBSlideTitle.replace('%d', newIndex),
			tab 		= jQuery('<a href="#"><span>'+title+'</span><img src="'+(pluginPath+'img/admin/blank.gif')+'"><span class="dashicons dashicons-dismiss"></span>').insertBefore('#rb-add-layer');

		// Name new slide properly
		RbSlider.reindexSlides();
		RbSlider.addSlideSortables();
		RB_activeLayerPageIndex = 0;

		// Show new slide, re-initialize
		// interactive features
		tab.click();
		RbSlider.addLayerSortables();
	},


	removeSlide: function(el) {

		if(confirm(RB_l10n.SBRemoveSlide)) {

			// Get tab and menu item index
			var index = RB_activeSlideIndex;
			var $tab = jQuery(el).parent();
			var $newTab = null;

			// Open next or prev layer
			if($tab.next(':not(.unsortable)').length > 0) {
				$newTab = $tab.next();

			} else if($tab.prev().length > 0) {
				$newTab = $tab.prev();
			}

			// Remove tab and slide data
			window.rbSliderData.layers.splice(index, 1);
			$tab.remove();

			// Create a new slide if the last one
			// was removed
			if(window.rbSliderData.layers < 1) {
				RbSlider.addSlide();
				return true;
			}

			// Select new slide. The .click() event will
			// maintain the active slide index and data.
			RbSlider.reindexSlides();
			$newTab.click();
		}
	},


	selectSlide: function(slideIndex, selectProperties) {

		// Set selectProperties to an empty object by default
		selectProperties = selectProperties || {};

		// Bail out early if it's the currently active layer
		if( !selectProperties.forceSelect && RB_activeSlideIndex === slideIndex) { return false; }

		// Set active slide, highlight new tab
		jQuery('#rb-layer-tabs a')
			.eq(slideIndex)
			.addClass('active')
			.attr('data-help-disabled', '1')

			.siblings()
			.removeClass('active')
			.removeAttr('data-help-disabled');

		// Stop live preview
		RbSlider.stopSlidePreview();
		RbSlider.stopLayerPreview();

		// Set new slide index & data
		RB_activeSlideIndex = slideIndex;
		RB_activeSlideData = window.rbSliderData.layers[ slideIndex ];

		// Create the 'meta' object if not set
		if(!RB_activeSlideData.meta) {
			RB_activeSlideData.meta = {};
		}

		// Make sure to include new slide options in all cases
		var defaults = jQuery.extend( true, {}, RB_DataSource.getDefaultSlideData() );
		RB_activeSlideData.properties = jQuery.extend( true, defaults, RB_activeSlideData.properties );

		// Set active layer index set
		RB_activeLayerIndexSet = RB_activeSlideData.meta.activeLayers || [0];
		RB_lastSelectedLayerIndex = RB_activeLayerIndexSet[0];

		// Add static layers
		RB_activeStaticLayersDataSet = RbSlider.staticLayersForSlide( slideIndex );

		// Build slide
		RB_DataSource.buildSlide();
		RbSlider.generatePreview();
		RbSlider.selectLayer(RB_activeLayerIndexSet);
		RbSlider.updatePreviewSelection();
		RB_UndoManager.update();
	},


	renameSlide: function(el) {

		if( ~ location.href.indexOf('AdminRbThemeSliderRevisions') ) {
			return;
		}

		var $el = jQuery(el);
		var name = jQuery('span:first-child', el).text();

		if($el.hasClass('editing')) { return false; }

		// Add input
		$el.addClass('editing');
		$input = jQuery('<input type="text">').appendTo($el).val(name);
		$input.focus().select();

		// Save changes on Enter
		$input.on('keydown', function(e) {
			if(e.which == 13) { RbSlider.renameSlideEnd(el); }
		});

		// Save changes by clicking away
		jQuery('body').one('click', ':not(#rb-layer-tabs a input)', function() {
			RbSlider.renameSlideEnd(el);
		});
	},


	renameSlideEnd: function(el) {

		var $el 	= jQuery(el),
			$input 	= jQuery('input', el),
			index 	= $el.index();

		if($el.hasClass('editing')) {

			window.rbSliderData.layers[ index ].properties.title = $input.val();
			jQuery('span', $el).first().text( $input.val());
			$input.remove();
			$el.removeClass('editing');
		}
	},


	duplicateSlide: function(el) {


		// Duplicate slide by using jQuery.extend()
		// to make sure it's a copy instead of an
		// object reference.
		var newSlideData = jQuery.extend(true, {}, RB_activeSlideData);

		// Assign new UUID
		newSlideData.properties.uuid = RB_DataSource.generateUUID();

		// Rename slide
		if(!!newSlideData.properties.title) {
			newSlideData.properties.title += ' copy';
		} else {
			newSlideData.properties.title = RB_l10n.SBSlideCopyTitle.replace('%d', RB_activeSlideIndex+1);
		}

		// Duplicate slide by using jQuery.extend()
		// to make sure it's a copy instead of an
		// object reference.
		window.rbSliderData.layers.splice(
			RB_activeSlideIndex + 1, 0, newSlideData
		);

		// Insert the duplicate slide tab after the original
		var tab = jQuery('<a href="#"><span>'+newSlideData.properties.title+'</span><span class="dashicons dashicons-dismiss"></span></a>').insertAfter('#rb-layer-tabs a.active');
		RbSlider.reindexSlides();
		RbSlider.reindexStaticLayers();

		// Select new slide
		tab.click();
	},

	toggleAdvancedSlideOptions: function( el ) {

		var $el 	= jQuery(el),
			$target = jQuery('.rb-slide-options tr.rb-advanced');

		if( $el.hasClass('rb-opened') ) {
			$el.removeClass('rb-opened');
			$target.addClass('rb-hidden');
		} else {
			$el.addClass('rb-opened');
			$target.removeClass('rb-hidden');
		}
	},


	setPreviewZoom: function( value ) {

		RB_previewZoom = value;

		jQuery('.rb-editor-slider-val').text(''+Math.round(value * 100)+'%');

		jQuery( '.rb-preview-transform' ).css({
			transform: 'scale('+value+')'
		}).parent().trigger('zoom');

		var sliderSize = RbSlider.getSliderSize();

		jQuery( '.rb-preview-size' ).css({
			width: sliderSize.width * value,
			height: sliderSize.height * value
		});

		RbSlider.updatePreviewSelection();
	},


	addPreviewSlider: function(target, value) {

		jQuery(target).slider({
			value: value, min: 0.5, max: 1.5, step: 0.01,
			range: 'min', orientation: 'horizontal',
			slide: function(event, ui) {

				// Disable auto-fit when resizing manually
				if( jQuery('#zoom-fit').prop('checked') ){
					jQuery('#zoom-fit').next().click();
				}

				RbSlider.setPreviewZoom(ui.value);

				// Restart previews (if any)
				if( RbSlider.isSlidePreviewActive ) {
					RbSlider.stopSlidePreview( );
				}

				if( RbSlider.isLayerPreviewActive ) {
					RbSlider.stopLayerPreview( true );
				}
			},

			change: function(event, ui) {
				RB_previewZoom = ui.value;
				RbSlider.updatePreviewSelection();
			}
		});


		// Resize preview on page load
		if( jQuery('#zoom-fit').prop('checked') ) {
			RbSlider.autoFitPreview(target);

		// Slide value on page load
		} else if(typeof value != "undefined" && value != 1 ) {
			jQuery(target).slider('value', parseInt(value));
			RbSlider.setPreviewZoom(value);
		}

		jQuery(document).on('click','#zoom-fit',function(){

			if( jQuery(this).prop('checked') ){
				RbSlider.autoFitPreview(target, 0.75);
			}
		});

		jQuery(window).resize(function( event ){
			if( event.target === window ) {
				RbSlider.autoFitPreview(target);
			}
		});


		jQuery('#collapse-menu').click(function() {
			RbSlider.autoFitPreview(target);
		});
	},


	autoFitPreview: function(target, duration){

		if( jQuery('#zoom-fit').prop('checked') ){

			var sliderSize 	= RbSlider.getSliderSize(),
				width 		= sliderSize.width,
				height 		= sliderSize.height,
				// 905(px) is the minimum width to keep the slider settings table organized
				smallestRatio = 916 / width > 0.5 ? 916 / width : 0.5,
				padding = ~ location.href.indexOf('AdminRbSliderRevisions') ? 0 : 32,
				ratio = ( jQuery('.wrap').eq(0).outerWidth() - padding ) / width;


			if( ratio < smallestRatio ){
				ratio = smallestRatio;
			} else if( ratio > 1 ){
				ratio = 1;
			}

			jQuery(target).slider('value', ratio );
			RbSlider.setPreviewZoom( ratio );
		}
	},


	addLayer: function(layerDataSet, atIndexSet, addProperties) {

		var c, len, selectIndexSet = [], updateInfo = [], emptyData, emptyIndex;

		// Set removeProperties to an empty object by default
		addProperties = addProperties || { selectLayer: true };

		// Get default layer data if not provided
		emptyData 	 = !layerDataSet;
		layerDataSet = layerDataSet || jQuery.extend(true, {}, RB_DataSource.getDefaultLayerData() );
		layerDataSet = jQuery.makeArray( layerDataSet );

		c = layerDataSet.length;

		// Add layer to the top if
		// not specified otherwise.
		emptyIndex = ! atIndexSet;
		atIndexSet = ! emptyIndex ? atIndexSet : [].fill(0, c);
		atIndexSet = jQuery.makeArray( atIndexSet );

		// Iterate backwards to keep indexes consistent throughout
		// the sequence. Don't use .revert() on data sets reference,
		// as it will change the original set as well.
		while(c--) {

			// Add new layer data to data source
			RB_activeSlideData.sublayers.splice(atIndexSet[c], 0, layerDataSet[c]);

			// Offsetting indexes to follow data storage
			// changes in case of multiple additions.
			selectIndexSet.push( atIndexSet[c] + c );

			// UndoManager
			updateInfo.push({
				itemIndex: atIndexSet[c],
				selectIndex: selectIndexSet[c],
				undo: { data: {} },
				redo: { data: layerDataSet[c] }
			});
		}

		// Maintain undoManager
		if( ! addProperties.histroyEvent) {
			RB_UndoManager.add(
				'slide.layers',
				updateInfo.length > 1 ? RB_l10n.SBUndoNewLayers : RB_l10n.SBUndoNewLayer,
				updateInfo
			);
		}

		// Update layers list and preview
		RB_DataSource.buildLayersList();
		RbSlider.generatePreview();

		// Select new layers
		if( addProperties.selectLayer ) {

			if( addProperties.hasOwnProperty('selectPage') ) {
				RB_activeLayerPageIndex = addProperties.selectPage;
			}

			RbSlider.selectLayer( selectIndexSet );

			if( emptyData && updateInfo.length === 1 ) {
				jQuery('.rb-sublayers  li.active .rb-sublayer-title').focus().select();
			}
		}
	},


	addFormattedLayer: function( el, layerProperties ) {

		// Hide add layer modal
		jQuery('.rb-overlay.dim').remove();
		jQuery('.rb-layer-types').animate({ marginTop : 40, opacity : 0 }, 150, function() {
			jQuery(this).hide();
		});

		var layerType = jQuery(el).data('type'),
			layerData;

		if( layerType === 'import' ) {
			RB_ImportLayer.open();
			return;
		}


		// Get default layer data
		layerData = jQuery.extend(true, {}, RB_DataSource.getDefaultLayerData() );

		// Set layer type
		layerData.media = layerType;


		// Set font size to 18 pixels for text based layers
		if( ['text', 'html', 'post'].indexOf( layerType ) !== -1 ) {
			jQuery.extend( layerData.styles, {
				'font-size': 18
			});
		}

		switch( layerType ) {

			case 'text':
				layerData.html = RB_l10n.SBPreviewTextPlaceholder;
				break;

			case 'html':
				layerData.html = RB_l10n.SBPreviewHTMLPlaceholder;
				break;

			case 'button':
				layerData.html = RB_l10n.SBPreviewButtonPlaceholder;
				jQuery.extend( layerData.styles, {
					'padding-top': 8,
					'padding-right': 20,
					'padding-bottom': 8,
					'padding-left': 20,
					'font-size': 18,
					'background': '#0073aa',
					'color': '#fff',
					'border-radius': 5
				});
				break;

			case 'post':
				layerData.html = RB_l10n.SBPreviewPostPlaceholder;
				break;

		}

		// Merge provided layer properties (if any)
		if( layerProperties ) {
			jQuery.extend(true, layerData, layerProperties);
		}

		// Add formatted layer
		RbSlider.addLayer( layerData, null, {
			selectLayer: true,
			selectPage: 0
		});

		// Bring up Media Library when adding
		// image layer
		if( layerType === 'img') {
			jQuery('.rb-layer-image').click();
		}
	},


	selectLayer: function(layerIndexSet, selectProperties) {

		// Bail out early if the current slide has no layers
		if( ! RB_activeSlideData.sublayers.length ) {
			jQuery('.rb-timeline-switch, .rb-sublayer-nav').hide();
			jQuery('.rb-sublayer-pages').empty();
			return false;

		} else {
			jQuery('.rb-timeline-switch, .rb-sublayer-nav').show();
		}

		// Bail out early if there's no active layer selection
		if( ! layerIndexSet || ! layerIndexSet.length ) { return false; }

		// Bail out if the new selection exceeds array range
		if( RB_activeSlideData.sublayers.length-1 < Math.max.apply(Math, layerIndexSet) ) {
			return;
		}

		selectProperties = selectProperties || {};

		var $layersList 	= jQuery('.rb-sublayers li'),
			$layerOptions 	= jQuery('.rb-sublayer-pages-wrapper');

		// Stop layer preview session (if any)
		RbSlider.stopLayerPreview();

		// Update stored data & preview based on
		// the passed selection index set.
		RB_activeLayerIndexSet = [];
		RB_activeLayerDataSet = [];
		$layersList.removeClass('active');
		jQuery('#rb-preview-layers > *').removeClass('ui-selected');
		jQuery.each(layerIndexSet, function(idx, layerIndex) {
			if (!RB_previewItems[layerIndex]) layerIndex = 0;
			RB_activeLayerIndexSet.push(layerIndex);
			RB_activeLayerDataSet.push(
				RB_activeSlideData.sublayers[layerIndex]
			);
			RB_previewItems[layerIndex].addClass('ui-selected');
			$layersList.eq(layerIndex).addClass('active');
		});

		jQuery.each(RB_activeLayerDataSet, function(index, layerData) {
			if( ! layerData.meta) {
				layerData.meta = {};
			}
		});

		// Show/Hide layer options depending on
		// the number of selected layers
		if(RB_activeLayerIndexSet.length > 1) {
			RbSlider.startMultipleSelection();
		} else {
			RbSlider.stopMultipleSelection();
		}

		// Build new layer ...
		if(RB_activeLayerIndexSet.length === 1) {
			RB_DataSource.buildLayer();
			RB_lastSelectedLayerIndex = RB_activeLayerIndexSet[0];
		}

		// Store selection
		RB_Utils.removeTextSelection();
		RbSlider.updatePreviewSelection();
		RB_activeSlideData.meta.activeLayers = RB_activeLayerIndexSet;
		jQuery('.rb-timeline-switch, .rb-sublayer-nav').show();

		// Create layer transition preview animations
		layerTransitionPreview.create();
	},


	startMultipleSelection: function() {

		var $layerOptions 	= jQuery('.rb-sublayer-pages-wrapper'),
			$layerNav 		= jQuery('.rb-sublayer-nav'),
			$contentTab 	= $layerNav.children().eq(0);

		// Hide 'Content' and select the 'Transitions'
		// layer tab if needed.
		$contentTab.hide();
		if( $contentTab.hasClass('active') ) {
			$contentTab.next().click();
		}


		jQuery('#rb-layers-settings-popout').addClass('rb-multiple-selection');

		// Reset input field
		jQuery('input,textarea', $layerOptions).filter('.sublayerprop,.auto').val('');
		jQuery('.rb-sublayer-pages .minicolors-swatch-color').css('background', 'transparent');


		// Prepend empty option to select fields
		jQuery('select:not(.rb-multi-selected)', $layerOptions)
			.filter('.sublayerprop,.auto')
			.add('.rb-slide-link select')
			.addClass('rb-multi-selected')
			.prepend('<option></option>');

		// Select the empty option in select fields
		jQuery('select', $layerOptions)
			.filter('.sublayerprop,.auto')
			.add('.rb-slide-link select')
			.children().prop('selected', false)
			.eq(0).prop('selected', true);

		// Reset checkboxes
		jQuery('.rb-checkbox', $layerOptions)
			.removeClass('on off')
			.addClass('indeterminate');

		// Reset transition selection
		jQuery('#rb-transition-selector-table .active').removeClass('active');
		jQuery('#rb-layer-transitions .rb-h-button .rb-checkbox').removeClass('on');

		// Reset custom attributes field
		jQuery('.rb-sublayer-custom-attributes tr:not(:last-child)').remove();

		jQuery(RbSlider).trigger('afterStartMultipleSelection');
	},


	stopMultipleSelection: function() {

		var $layerOptions 	= jQuery('.rb-sublayer-pages-wrapper'),
			$layerNav 		= jQuery('.rb-sublayer-nav');

		// Show the Content layer tab
		$layerNav.children().eq(0).show();

		jQuery('#rb-layers-settings-popout').removeClass('rb-multiple-selection');

		jQuery(RbSlider).trigger('afterStopMultipleSelection');
	},


	selectLayerPage: function(pageIndex) {

		// Select new tab
		jQuery('.rb-sublayer-nav a').removeClass('active')
			.eq(pageIndex).addClass('active');

		// Show the corresponding page
		jQuery('#rb-layers .rb-sublayer-page').removeClass('active')
			.eq( pageIndex ).addClass('active');

		// Store lastly selected layer page
		RB_activeLayerPageIndex = pageIndex;

		// SET: styles
		kmUI.smartResize.set();
	},


	selectTransitionPage: function( td ) {

		var $td = jQuery(td),
			index = ($td.index() - 1)  / 2,
			$target = jQuery('#rb-layer-transitions').children().eq(index);

		$target.addClass('active').siblings().removeClass('active');
		$td.addClass('selected').siblings().removeClass('selected');

		jQuery( '#rb-transition-selector' ).val( index );

		RB_activeLayerTransitionTab = index;

		$target.removeClass('disabled');
		if( ! $target.find('.rb-h-button input').prop('checked') ) {
			$target.addClass('disabled');
		}
	},

	enableTransitionPage: function( input ) {

		RbSlider.reorderTransitionProperties(
			jQuery( input ).closest('section').index()
		);

		RbSlider.checkForOpeningTransition();

	},


	checkForOpeningTransition: function() {

		// Don't show the warning in multi-select
		if( RB_activeLayerIndexSet.length === 1 ) {

			$table 			= jQuery('#rb-transition-selector-table');
			$transitions 	= jQuery('.rb-opening-transition.active', $table);
			$warning 		= jQuery('#rb-transition-warning');

			$warning[ $transitions.length ? 'removeClass' : 'addClass' ]('visible');
		}
	},


	reorderTransitionProperties: function( sectionIndex ) {

		// if( RB_activeLayerIndexSet.length > 1) {
		// 	return;
		// }

		var media 		= RB_activeLayerDataSet[0].media || '',
			index,
			$sections 	= jQuery('#rb-layer-transitions').children(),
			$section,
			$input,
			$td;

		if( typeof sectionIndex !== 'undefined' ) {
			$sections = $sections.eq( sectionIndex );
		}


		$sections.each(function() {

			$section 	= jQuery(this);
			index 		= $section.index();
			$input 		= $section.find('input.toggle').eq(0);
			$td 		= jQuery('#rb-transition-selector-table td:not(.rb-padding)').eq( index );

			// Disabled
			if( ! $input.prop('checked') ) {
				$td.removeClass('active');
				$section.addClass('disabled');
				$section.find(':input').each(function() {
					var $this 	= jQuery(this),
						name 	= $this.attr('name'),
						value 	= $this.is(':checkbox') ? $this.prop('checked') : $this.val();

					if( name && ! $this.is('.toggle') ) {
						$this.data('value', value );
						delete RB_activeLayerDataSet[0].transition[ name ];
					}
				});

			// Active
			} else {
				$td.addClass('active');
				$section.removeClass('disabled');
				$section.find(':input').each(function() {
					var $this 	= jQuery(this),
						name 	= $this.attr('name'),
						value 	= $this.data('value');

					if( name && ! $this.is('.toggle') ) {
						RB_activeLayerDataSet[0].transition[ name ] = value;
					}
				});
			}
		});

	},


	removeLayer: function(layerIndexSet, removeProperties) {

		// Set removeProperties to an empty object by default
		removeProperties = removeProperties || { requireConfirmation: true };

		// Require confirmation from user
		// if it's not a history event.
		if( removeProperties.requireConfirmation ) {
			if( !confirm( RB_l10n.SBRemoveLayer ) ) {
				return false;
			}
		}

		// Get active layers if no index was provided
		if( ! layerIndexSet  && layerIndexSet !== 0 ) {
			layerIndexSet = RB_activeLayerIndexSet;

		// Convert a single index to an index set
		} else if( typeof layerIndexSet === 'number') {
			layerIndexSet = [layerIndexSet];
		}

		// Get layer(s)
		var c = layerIndexSet.length, $layers = jQuery('.rb-sublayers li'),
			updateInfo = [], $layer, $newLayer, layerIndex, layerData;

		// Iterate backwards to keep indexes consistent throughout the sequence.
		// Don't use .revert() on a RB_activeLayerIndexSet reference, as it will
		// change the original set as well.
		while(c--) {
			layerIndex 	= layerIndexSet[c];
			$layer 		= $layers.eq(layerIndex);
			layerData 	= jQuery.extend(true, {}, RB_activeSlideData.sublayers[layerIndex]);

			// Get the next or prev layer
			if($layer.next().length > 0) { $newLayer = $layer.next(); }
				else if($layer.prev().length > 0) { $newLayer = $layer.prev(); }

			// Setup UndoManager updateInfo object
			updateInfo.push({
				itemIndex: layerIndex,
				undo: { data: layerData },
				redo: { data: {} }
			});

			// Remove layer from data source and UI
			RB_activeSlideData.sublayers.splice(layerIndex, 1);
			$layer.remove();
		}

		// Empty slide, hide UI items
		if( ! RB_activeSlideData.sublayers.length ) {
			jQuery('.rb-timeline-switch, .rb-sublayer-nav').hide();
			jQuery('.rb-multi-select-notice').hide();
			jQuery('.rb-sublayer-pages').empty();

		// Update UI otherwise
		// Select new layer. The .click() event will
		// maintain the active layer index and data.
		} else if( $newLayer ) {
			RbSlider.selectLayer( [ $newLayer.index() ] );
			RbSlider.reindexLayers();
		}


		// Update preview
		RbSlider.generatePreview();
		RbSlider.updatePreviewSelection();

		// Maintain undoManager only if
		// it wasn't a history action
		if( !removeProperties.histroyEvent && updateInfo.length) {
			RB_UndoManager.add('slide.layers', RB_l10n.SBUndoRemoveLayer, updateInfo);
		}
	},


	hideLayer: function( el ) {

		var layerIndexSet 	= RB_activeLayerIndexSet,
			layerDataSet 	= RB_activeLayerDataSet,
			updateInfo 		= [],
			layerData,
			$control;

		// Get layer data if provided
		if( el ) {
			layerIndexSet 	= [ jQuery(el).closest('li').index() ];
			layerDataSet 	= [ RB_activeSlideData.sublayers[ layerIndexSet[0] ] ];
		}


		jQuery.each( layerIndexSet, function( index, layerIndex ) {

			layerData 	= layerDataSet[ index ];
			$control 	= jQuery('.rb-sublayers .rb-icon-eye').eq(layerIndex);

			updateInfo.push({
				itemIndex: layerIndex,
				undo: { skip: !!layerData.skip },
				redo: { skip: !layerData.skip }
			});

			// Hide/show layer
			layerData.skip = !layerData.skip;
			if( layerData.skip ) { $control.addClass('disabled'); }
				else { $control.removeClass('disabled'); }

			// Update preview
			RbSlider.generatePreviewItem( layerIndex );
		});

		// Maintain history
		RB_UndoManager.add('layer.general', RB_l10n.SBUndoHideLayer, updateInfo);
	},


	lockLayer: function(el) {

		var layerIndexSet 	= RB_activeLayerIndexSet,
			layerDataSet 	= RB_activeLayerDataSet,
			updateInfo 		= [],
			layerData,
			$previewItem,
			$control;

		// Get layer data if provided
		if( el ) {
			layerIndexSet 	= [ jQuery(el).closest('li').index() ];
			layerDataSet 	= [ RB_activeSlideData.sublayers[ layerIndexSet[0] ] ];
		}


		jQuery.each( layerIndexSet, function( index, layerIndex ) {

			layerData 		= layerDataSet[ index ];
			$previewItem 	= RbSlider.previewItemAtIndex( layerIndex );
			$control 		= jQuery('.rb-sublayers .rb-icon-lock').eq(layerIndex);

			updateInfo.push({
				itemIndex: layerIndex,
				undo: { locked: !!layerData.locked },
				redo: { locked: !layerData.locked }
			});

			// Lock layer
			layerData.locked = !layerData.locked;
			if( layerData.locked ) {
				$control.removeClass('disabled');
				$previewItem.addClass('disabled');
				$lasso.hide();

			// Unlock layer
			} else {

				$control.addClass('disabled');
				$previewItem.removeClass('disabled');
			}

			// Update preview
			RbSlider.generatePreviewItem( layerIndex );

		});

		// Maintain history
		RB_UndoManager.add('layer.general', RB_l10n.SBUndoHideLayer, updateInfo);
	},


	setLayerMedia: function(mediaType, $mediaEl, layerData) {

		switch(mediaType) {
			case 'img':

			var src = layerData.imageThumb || pluginPath+'img/admin/blank.gif',
				classes = layerData.imageThumb ? '' : ' dashicons dashicons-format-image';

				$mediaEl.attr('class', 'rb-sublayer-thumb'+classes).html('<img src="'+(layerData.imageThumb || pluginPath+'img/admin/blank.gif')+'">');
				break;

			case 'html':
				$mediaEl.addClass('dashicons dashicons-editor-code');
				break;

			case 'button':
				$mediaEl.addClass('dashicons dashicons-marker');
				break;

			case 'media':
				$mediaEl.addClass('dashicons dashicons-video-alt3');
				break;

			case 'post':
				$mediaEl.addClass('dashicons dashicons-admin-post');
				break;

			default:
				$mediaEl.addClass('dashicons dashicons-text');
				break;
		}
	},


	setLayerAttributes: function( event, element ) {

		if( event.type === 'change' && ! jQuery(element).is(':checkbox') ) {
			return;
		}

		var $tr = jQuery(element).closest('tr'),
			$inputs = jQuery('input', $tr );

		if( ! $inputs.eq(0).val() && ! $inputs.eq(1).val() ) {
			$tr.remove();
		}

		jQuery.each(RB_activeLayerDataSet, function(index, layerData) {

			var innerAttrs = layerData.innerAttributes = {},
				outerAttrs = layerData.outerAttributes = {};

			jQuery('.rb-sublayer-custom-attributes tr:not(:last-child)').each(function() {

				var $key = jQuery('td.first input', this),
					$val = jQuery('td.second input', this),
					$chb = jQuery('td.third input', this),
					key  = $key.val(),
					val  = $val.val();

				if( key && /^[a-zA-Z]([a-zA-Z0-9_-]+)$/.test( key ) ) {
					$key.removeClass('error');

					if( $chb.prop('checked') ) {

						outerAttrs[ key ] = val;
					} else {
						innerAttrs[ key ] = val;
					}

				} else {
					$key.addClass('error');
				}
			});
		});
	},


	updateLayerAttributes: function( layerData ) {

		// Make sure to have objects for data
		layerData.innerAttributes = layerData.innerAttributes || {};
		layerData.outerAttributes = layerData.outerAttributes || {};

		var customAttrs = jQuery.extend( {}, layerData.innerAttributes, layerData.outerAttributes),
			$customAttributes = jQuery('.rb-sublayer-custom-attributes');

		// Sort keys
		Object.keys(customAttrs).sort().forEach(function(key) {
			var value = customAttrs[key];
			delete customAttrs[key];
			customAttrs[key] = value;
		});

		jQuery.each(customAttrs, function(key, val) {
			jQuery('tr:last-child input:eq(2)', $customAttributes).prop('checked', key in layerData.outerAttributes );
			jQuery('tr:last-child input:eq(1)', $customAttributes).val( val );
			jQuery('tr:last-child input:eq(0)', $customAttributes).val( key ).trigger('keyup');
		});
	},

	updateLayerBorderPadding: function(el) {

		var $input 	= jQuery(el),
			value 	= parseInt( $input.val() ),
			type 	= ($input.parent().index() === 1) ? 'border' : 'padding',
			edge 	= $input.closest('tr').data('edge');
			sel 	= '.rb-'+type+'-'+edge+'-value';

		jQuery(sel).text( value || '–' );
	},

	// Iterate through all slides and their layers to
	// find the ones appearing on the target slide.
	staticLayersForSlide: function( targetSlideIndex ) {

		var staticLayers = [];

		jQuery.each(window.rbSliderData.layers, function(slideIndex, slideData) {
			jQuery.each(slideData.sublayers, function(layerIndex, layerData) {

				if( layerData.transition.static ) {
					var staticOut = layerData.transition.static;
					if( ( staticOut > targetSlideIndex || staticOut === 'forever' ) && slideIndex < targetSlideIndex ) {

						staticLayers.push({
							slideIndex: slideIndex,
							slideData: 	slideData,
							layerIndex: layerIndex,
							layerData: 	layerData
						});
					}
				}
			});
		});

		return staticLayers;
	},


	reindexStaticLayers: function() {

		jQuery.each(window.rbSliderData.layers, function(slideIndex, slideData) {
			jQuery.each(slideData.sublayers, function(layerIndex, layerData) {

				if( layerData.transition.staticUUID ) {
					var staticOut = RB_DataSource.slideForUUID( layerData.transition.staticUUID );
					if( staticOut ) {
						layerData.transition.static = staticOut + 1;
					}
				}
			});
		});
	},

	setupStaticLayersChooser: function( select ) {

		var $select = jQuery(select);

			// Remove previously added options
			$select.children(':gt(1)').remove();

			// Gather slide data
			var sliderData 	= window.rbSliderData,
				slideCount 	= sliderData.layers ? sliderData.layers.length : 0,
				markup 		= '<option value="-2" disabled>–</option>',
				slideName;

			// Generate markup
			for( var s = 0; s < slideCount; s++) {
				slideName 	= sliderData.layers[s].properties.title;
				slideName 	= slideName ? ' ('+slideName+')' : '';
				markup += '<option value="'+(s+1)+'">'+RB_l10n.SBStaticUntil.replace('%d', (s+1))+' '+slideName+'</option>';
			}

			// Append select options
			$select.append(markup);

			var staticVal = parseInt( RB_activeLayerDataSet[0].transition.static );
			if( staticVal ) {
				$select.children('[value="'+staticVal+'"]').prop('selected', true)
					.siblings().prop('selected', false);
			}

	},


	revealStaticLayer: function( el ) {

		var $target = jQuery(el).closest('li'),
			index 	= $target.index(),
			data 	= RB_activeStaticLayersDataSet[ index ];

		RbSlider.selectSlide( data.slideIndex );
		RbSlider.selectLayer( [data.layerIndex] );
	},


	addColorPicker: function(el) {
		jQuery(el).minicolors({
			opacity: true,
			changeDelay: 100,
			position: 'bottom right',
			change: function(hex, opacity) {
				//RbSlider.willGeneratePreview();
			}
		}).blur(function( event ) {
			event.stopImmediatePropagation();

			jQuery(this)
				.removeClass('rb-colorpicker')
				.trigger('change')
				.addClass('rb-colorpicker');

		});
	},


	duplicateLayer: function( ) {
		this.pasteLayer( this.copyLayer( false).layers );
	},


	copyLayer: function(useStorage, layerDataSet, layerIndexSet, copyProperties) {

		// Defaults
		useStorage 		= useStorage 	|| true;
		layerDataSet 	= layerDataSet 	|| RB_activeLayerDataSet;
		layerIndexSet 	= layerIndexSet || RB_activeLayerIndexSet;
		copyProperties 	= copyProperties || { shiftLayers: true };

		// Iterate over the data set, clone objects and
		// make some visual adjustments on items
		var clipboardData = [];
		jQuery.each(layerDataSet, function(key, item) {

			// Copy layer data object
			var copy = jQuery.extend(true, {}, item);
			copy.subtitle += ' copy';

			// Add copy to the new set
			clipboardData.push(copy);
		});

		// Build clipboard data
		clipboardData = {
			layers: clipboardData,
			sliderID: copyProperties.sliderID || RB_sliderID,
			slideIndex: copyProperties.slideIndex || RB_activeSlideIndex,
			layerIndexSet: layerIndexSet
		};

		// Save to storage and return copies
		useStorage && localStorage.setObject('rb-layer-clipboard', clipboardData);
		return clipboardData;
	},


	pasteLayer: function(layerDataSet, layerIndexSet, pasteProperties) {

		// Check for provided data, fetch from clipboard if not
		var isDataProvided 	= layerDataSet ? true : false,
			clipboardData 	= localStorage.getObject('rb-layer-clipboard'),
			addIndexSet;

		if( ! clipboardData ) {
			alert(RB_l10n.SBPasteLayerError);
			return;
		}

		layerDataSet 		= layerDataSet 	|| clipboardData.layers;
		layerIndexSet 		= layerIndexSet || clipboardData.layerIndexSet;

		// Warn users when there's nothing on the clipboard
		// and halt execution.
		if( ! layerDataSet ) {
			alert(RB_l10n.SBPasteLayerError);
			return;
		}

		// Set pasteProperties to an empty object by default
		pasteProperties = pasteProperties || {};

		// If the layer is from the same slide, then
		// find the uppermost selected layer index
		// and insert everything into that position.
		// Otherwise insert at the beginning of the layers list.
		// -
		// Trying to insert layers before their parents
		// individually is complex, and it will fragment
		// dupe selection.
		if(clipboardData.sliderID !== RB_sliderID || clipboardData.slideIndex !== RB_activeSlideIndex) {
			addIndexSet = [].fill( 0, layerIndexSet.length);
		} else {
			addIndexSet = [].fill( Math.min.apply(Math, layerIndexSet), layerIndexSet.length);
		}


		// Generate UUIDs for the new layers
		jQuery.each( layerDataSet, function( index, layerData ) {
			layerData.uuid = RB_DataSource.generateUUID();
		});

		// Insert new layers
		RbSlider.addLayer(layerDataSet, addIndexSet, { selectLayer: true } );

		// Copy pasted layer to make a new reference
		// and update settings like position and name
		if( ! isDataProvided) {
			this.copyLayer(true, layerDataSet, layerIndexSet, {
				sliderID: clipboardData.sliderID,
				slideIndex: clipboardData.slideIndex
			});
		}
	},


	selectMediaType: function(el, layerIndex) {

		// Gather layer data
		layerIndex = layerIndex ? layerIndex : RB_activeLayerIndexSet;
		layerIndex = (typeof layerIndex === 'object') ? layerIndex[0] : layerIndex;
		var layerData  	= RB_activeSlideData.sublayers[layerIndex],
			layer 		= jQuery(el).closest('.rb-sublayer-page'),
			$layerItem 	= jQuery('.rb-sublayers li').eq(layerIndex),
			section 	= jQuery(el).data('section'),
			placeholder = jQuery(el).data('placeholder'),
			sections 	= jQuery('.rb-layer-sections', layer).children();

		// Set active class
		jQuery(el).attr('class', 'active').siblings().removeClass('active');

		// Store selection
		if( section ) {
			layerData.media = section;
		}

		// Show the corresponding sections
		sections.hide().removeClass('rb-hidden');
		jQuery('.rb-sublayer-element', layer).hide().removeClass('rb-hidden');
		jQuery('.rb-html-code .rb-options, .rb-html-code .rb-insert-media', layer).addClass('rb-hidden');
		jQuery('.rb-html-code .rb-insert-icon', layer).removeClass('rb-hidden');

		switch(section) {
			case 'img':
				sections.eq(0).show();
				var src 	= layerData.imageThumb || pluginPath+'img/admin/blank.gif',
					classes = layerData.imageThumb ? '' : ' dashicons dashicons-format-image';

				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb'+classes).html('<img src="'+(layerData.imageThumb || pluginPath+'img/admin/blank.gif')+'">');
				break;

			case 'text':
				sections.eq(1).show();
				layer.find('.rb-sublayer-element').show();
				jQuery('.rb-html-code textarea').attr('placeholder', placeholder );
				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb dashicons dashicons-text').html('');
				break;

			case 'button':
				sections.eq(1).show();
				jQuery('.rb-html-code .rb-options, .rb-html-code .rb-insert-media', layer).addClass('rb-hidden');
				jQuery('.rb-html-code textarea').attr('placeholder', placeholder );
				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb dashicons dashicons-marker').html('');
				break;

			case 'html':
				sections.eq(1).show();
				jQuery('.rb-html-code .rb-options, .rb-html-code .rb-insert-media', layer).addClass('rb-hidden');
				jQuery('.rb-html-code textarea').attr('placeholder', placeholder );
				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb dashicons dashicons-editor-code').html('');
				break;

			case 'media':
				sections.eq(1).show();
				jQuery('.rb-html-code .rb-options, .rb-html-code .rb-insert-media', layer).removeClass('rb-hidden');
				jQuery('.rb-html-code .rb-insert-icon', layer).addClass('rb-hidden');
				jQuery('.rb-html-code textarea').attr('placeholder', placeholder );
				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb dashicons dashicons-video-alt3').html('');
				break;

			case 'post':
				sections.eq(1).show();
				sections.eq(2).show();
				jQuery('.rb-html-code textarea').attr('placeholder', placeholder );
				jQuery('.rb-sublayer-thumb', $layerItem).attr('class', 'rb-sublayer-thumb dashicons dashicons-admin-post').html('');
				break;
		}

		if( section === 'img' || section === 'media' ) {
			jQuery('#rb-layer-transitions .rb-text-transition .rb-checkbox.toggle.on').click();
		}

		jQuery('.rb-sublayer-pages-wrapper').attr('class', 'rb-sublayer-pages-wrapper rb-layer-type-' + layerData.media);

		jQuery(RbSlider).trigger('afterSelectMediaType');
	},


	selectElementType: function(el, layerIndex) {

		// Layer and properties
		layerIndex = layerIndex ? layerIndex : RB_activeLayerIndexSet;
		layerIndex = (typeof layerIndex === 'object') ? layerIndex[0] : layerIndex;

		var layerData  = RB_activeSlideData.sublayers[layerIndex],
			layer = jQuery(el).closest('.rb-sublayer-page'),
			element = jQuery(el).data('element');

		// Set active class
		jQuery(el).siblings().removeClass('active');
		jQuery(el).addClass('active');

		// Store selection
		if( element ) {
			layerData.type = element;
		}

	},


	copyLayerSettings: function(el) {

		var $el 		= jQuery(el),
			$wrapper 	= $el.closest('[data-storage]'),
			storage 	= $wrapper.attr('data-storage'),
			data 		= { styles: {}, transition: {} };

		// Iterate over options, store values
		$wrapper.find(':input').each(function() {
			if(this.name) {
				var $item 	= jQuery(this),
					area 	= $item.hasClass('sublayerprop') ? 'transition' : 'styles';

				data[area][this.name] = $item.is(':checkbox') ? $item.prop('checked') : $item.val();
			}
		});

		// Add data to clipboard
		var RB_clipboard = localStorage.getObject('rb-options-clipboard') || {};
		RB_clipboard[ storage ] = {
			timestamp: Math.floor(Date.now() / 1000),
			data: data
		};
		localStorage.setObject('rb-options-clipboard', RB_clipboard);

		// Send feedback to users
		$el.css('color', '#fcd116');
		setTimeout(function() {
			$el.css('color', '#00a0d2');
		}, 1000);
	},


	pasteLayerSettings: function(el) {

		var $el 		= jQuery(el),
			$wrapper 	= $el.closest('[data-storage]'),
			storage 	= $wrapper.attr('data-storage'),
			updateInfo 	= [];



		// Don't allow pasting options when the corresponding
		// transition sections is disabled
		if( $wrapper.closest('#rb-layer-transitions').length ) {
			if( ! $wrapper.find('.rb-h-button input').prop('checked') ) {
				$wrapper.find('.overlay').click();
				return;
			}
		}

		// Get clipboard data
		var RB_clipboard = localStorage.getObject('rb-options-clipboard') || {},
			clipboard = RB_clipboard[storage],
			timestamp = Math.floor(Date.now() / 1000);

		// Validate clipboard data
		if( ! clipboard || jQuery.isEmptyObject(clipboard.data) || clipboard.timestamp < timestamp - 60 * 60 * 3 ) {
			alert(RB_l10n.SBPasteError);
			return false;
		}

		// Iterate over all selected layers
		jQuery.each(RB_activeLayerIndexSet, function(index, layerIndex) {

			var layerData 	= RB_activeLayerDataSet[ index ],
				undoObj 	= {},
				redoObj 	= {};

			// Iterate over options, set new values
			$wrapper.find(':input').each(function() {
				if(this.name && this.name != 'top' && this.name != 'left') { // !!! don't paste left & top style

					var $this 	= jQuery(this),
						area 	= $this.hasClass('sublayerprop') ? 'transition' : 'styles',
						data 	= layerData[area];
						curVal 	= layerData[area][this.name],
						newVal 	= clipboard.data[area][this.name];

					if( this.name === 'style' ) { curVal = layerData[this.name]; }

					if( curVal != newVal ) {

						if( ! undoObj[ area ] ) { undoObj[ area ] = {}; }
						if( ! redoObj[ area ] ) { redoObj[ area ] = {}; }

						undoObj[ area ][ this.name ] = curVal;
						redoObj[ area ][ this.name ] = newVal;
					}

					// Handle custom CSS field separately
					if( this.name === 'style' ) { layerData.style = newVal; }
						else { data[this.name] = newVal; }
				}
			});

			updateInfo.push({
				itemIndex: layerIndex,
				undo: undoObj,
				redo: redoObj
			});

			RB_DataSource.buildLayer();

			// Update affected layer in preview
			// in case of style changes
			if( storage === 'rb-styles' ) {
				RbSlider.generatePreviewItem( layerIndex );
			}
		});

		// Add UndoManager action
		RB_UndoManager.add('layer.general', RB_l10n.SBUndoPasteSettings, updateInfo);


		$el.css('color', '#90ca77');
		setTimeout(function() { $el.css('color', '#00a0d2'); }, 1000);

	},


	updateSlideInterfaceItems: function() {

		var slideData 	= RB_activeSlideData.properties,
			imgSrc 		= slideData.backgroundThumb ? slideData.backgroundThumb : slideData.background;

		RB_GUI.updateImagePicker( 'background', imgSrc );
	},

	updateLayerInterfaceItems: function(layerIndex) {

		var $layer = jQuery('.rb-sublayer-pages'),
			$layerItem = jQuery('.rb-sublayers li').eq(layerIndex),
			layerData = RB_activeSlideData.sublayers[layerIndex];

		if( ! layerData ) { return; }

		// Image layer preview
		var imgSrc = layerData.imageThumb ? layerData.imageThumb : layerData.image;
		RB_GUI.updateImagePicker( 'image', imgSrc );

		// Video poster preview
		imgSrc = layerData.posterThumb ? layerData.posterThumb : layerData.poster;
		RB_GUI.updateImagePicker( 'poster', imgSrc );

		// Select layer and media type
		if(typeof layerData.media == 'undefined') {
			switch(layerData.type) {
				case 'img': layerData.media = 'img'; break;
				case 'div': layerData.media = 'html'; break;
				default: layerData.media = 'text';
			}
		}

		RbSlider.selectMediaType( $layer.find('.rb-layer-kind li[data-section="'+layerData.media+'"]'), layerIndex );
		RbSlider.selectElementType( $layer.find('.rb-sublayer-element > li[data-element="'+layerData.type+'"]'), layerIndex );

		// Skip
		if(layerData.skip) { jQuery('.rb-icon-eye', $layerItem).addClass('disabled'); }
			else { jQuery('.rb-icon-eye', $layerItem).removeClass('disabled'); }

		if(layerData.locked) { jQuery('.rb-icon-lock', $layerItem).removeClass('disabled'); }
			else { jQuery('.rb-icon-lock', $layerItem).addClass('disabled'); }
	},

	changeLayerScreenType: function( $button, updateLayer  ) {


		jQuery('.rb-set-screen-types button').each(function() {

			var layerData 	= RB_activeLayerDataSet[0],
				$item 		= jQuery(this),
				type 		= $item.data('type');

			if( $button && $button.is( $item ) ) {
				layerData['hide_on_'+type] = ! layerData['hide_on_'+type];
			}

			$item[ layerData['hide_on_'+type] ? 'removeClass' : 'addClass' ]('playing');
		});


		if( updateLayer ) {
			RbSlider.generatePreviewItem( RB_activeLayerIndexSet[0] );
			setTimeout(function() {
				RB_DataSource.buildLayersListItem( RB_activeLayerIndexSet[0] );
			}, 200);
		}
	},

	changeVideoType: function( event ) {

		var $input 			= jQuery('.rb-sublayer-basic input.bgvideo'),
			$options 		= jQuery('.rb-sublayer-basic .rb-media-options');
			$notification 	= jQuery('.rb-sublayer-basic .rb-bgvideo-options');

		if( $input.prop('checked') ) {
			$options.find('td').hide().filter('.volume,.overlay').show();
			$notification.show();

		} else {
			$options.find('td').show().filter('.overlay').hide();
			$notification.hide();
		}


		if( event && event.type === 'change' ) {
			RB_activeLayerDataSet[0].locked = $input.prop('checked') ? true : false;
			RB_DataSource.buildLayersListItem( RB_activeLayerIndexSet[0] );
		}
	},



	validateCustomCSS: function( $textarea ) {

		var keys = ['mix-blend-mode', 'filter'];

		for(var c = 0; c < keys.length; c++) {

			if( $textarea.val().indexOf(keys[c]) !== -1 ) {

				$textarea.val( $textarea.val().replace( new RegExp(keys[c], 'gi'), '') );

				TweenMax.to( jQuery('.rb-sublayer-style :input[name="'+keys[c]+'"]')[0], 0.15, {
					yoyo: true,
					repeat: 3,
					ease: Quad.easeInOut,
					scale: 1.2,
					backgroundColor: 'rgba(255, 0, 0, 0.2)'
				});
			}
		}
	},


	willGeneratePreview: function() {
		clearTimeout(RbSlider.timeout);
		RbSlider.timeout = setTimeout(function() {
				RbSlider.generatePreview();
		}, 1000);
	},


	generatePreview: function() {

		// –––––––––––––––––––––––––––––––––––––––––––––
		// READ-ONLY BLOCK
		//
		// Group DOM read/access operations together,
		// so the browser can cache and apply them in a
		// in a single pass, triggering only one reflow.
		// ———————————————————————————––––––––––––––––––

		// Slider data sets
	var sliderProps = window.rbSliderData.properties,
		sliderSize 	= RbSlider.getSliderSize(),
		slideIndex 	= RB_activeSlideIndex,
		slideData 	= RB_activeSlideData,
		slideProps 	= slideData.properties,
		layers 		= slideData.sublayers,
		$settings 	= jQuery('.rb-settings'),


		// Preview data
		width 		= sliderSize.width,
		height 		= sliderSize.height,
		bgColor 	= sliderProps.backgroundcolor,
		bgImage 	= sliderProps.backgroundimage,
		yourLogo 	= sliderProps.yourlogo,
		yourLogoStyle = sliderProps.yourlogostyle,
		posts 		= window.rbPostsJSON || [],
		postOffset 	= slideProps.post_offset,
		slideBG 	= slideProps.background,
		slideBGSize = slideProps.bgsize,
		slideBGPos 	= slideProps.bgposition,
		post;



		// --- Adjust default values ---
		height 		= (height.indexOf('%') !== -1) ? 400 : parseInt(height);
		postOffset 	= (postOffset == -1) ? slideIndex : postOffset;
		post 		= posts[ postOffset ] || {};

		RB_previewArea.css({
			width : width,
			height : height
		}).empty();

		jQuery('.rb-preview-size').css({
			width : width * RB_previewZoom,
			height : height * RB_previewZoom
		});

		// Make sure to follow preview area size changes
		jQuery('.rb-ruler').trigger('resize');
		RbSlider.autoFitPreview();


		// --- Set global background ---
		RB_previewHolder.css({
			backgroundColor : bgColor || 'transparent',
			backgroundImage : bgImage ? 'url('+bgImage+')' : 'none',
			backgroundRepeat: sliderProps.globalBGRepeat,
			backgroundAttachment: sliderProps.globalBGAttachment,
			backgroundPosition: sliderProps.globalBGPosition,
			backgroundSize: sliderProps.globalBGSize
		});

		// Empty preview items list, so we don't include beyond
		// array bounds objects from previous slide in case of
		// slide change.
		RB_previewItems = [];

		// Handle post content
		if(slideBG == '[image-url]') {
			slideBG = post['image-url'];
			RB_GUI.updateImagePicker( 'background', post['image-url'], { fromPost: true });
		}

		// -- Set slide background && empty previous content ---
		if( ! slideBGSize || slideBGSize === 'inherit') {
			slideBGSize = sliderProps.slideBGSize;
		}

		if( ! slideBGPos || slideBGPos === 'inherit') {
			slideBGPos = sliderProps.slideBGPosition;
		}

		RB_previewArea.css({
			backgroundImage: slideBG ? 'url('+slideBG+')' : 'none',
			backgroundSize: slideBGSize || 'auto',
			backgroundPosition: slideBGPos || 'center center',
			backgroundColor: slideProps.bgcolor || 'transparent',
			backgroundRepeat: 'no-repeat'
		});

		if( sliderProps.sliderclass ) {
			RB_previewArea.addClass( sliderProps.sliderclass );
		}


		// -- Set background on slide tab
		slideBG = slideBG || pluginPath+'img/admin/blank.gif';
		jQuery('#rb-layer-tabs a').eq(slideIndex).data('help', "<img src='"+slideBG+"'>");



		// --- Setup yourLogo ---
		RB_previewHolder.parent().find('.yourlogo').remove();
		if( yourLogo ) {

			var logo = jQuery('<img src="'+yourLogo+'" class="yourlogo">').prependTo( RB_previewHolder );
			logo.attr('style', yourLogoStyle);

			var oL, oR, oT, oB,
				logoLeft, logoRight, logoTop, logoBottom;
				oL = oR = oT = oB = 'auto';

			if( logo.css('left') != 'auto' ){
				logoLeft = logo[0].style.left;
			}
			if( logo.css('right') != 'auto' ){
				logoRight = logo[0].style.right;
			}
			if( logo.css('top') != 'auto' ){
				logoTop = logo[0].style.top;
			}
			if( logo.css('bottom') != 'auto' ){
				logoBottom = logo[0].style.bottom;
			}

			if( logoLeft && logoLeft.indexOf('%') != -1 ){
				oL = width / 100 * parseInt( logoLeft ) - logo.width() / 2;
			}else{
				oL = parseInt( logoLeft );
			}

			if( logoRight && logoRight.indexOf('%') != -1 ){
				oR = width / 100 * parseInt( logoRight ) - logo.width() / 2;
			}else{
				oR = parseInt( logoRight );
			}

			if( logoTop && logoTop.indexOf('%') != -1 ){
				oT = height / 100 * parseInt( logoTop ) - logo.height() / 2;
			}else{
				oT = parseInt( logoTop );
			}

			if( logoBottom && logoBottom.indexOf('%') != -1 ){
				oB = height / 100 * parseInt( logoBottom ) - logo.height() / 2;
			}else{
				oB = parseInt( logoBottom );
			}

			logo.css({
				left : oL,
				right : oR,
				top : oT,
				bottom : oB
			});
		}


		// --- Setup layers ---
		for(var c = 0, len = layers.length; c < len; c++) {
			RbSlider.generatePreviewItem( c, post);
		}

		// --- Setup static layers ---
		RbSlider.generateStaticPreview();
	},


	generateStaticPreview: function() {

		RB_previewArea.children('.rb-static-layer').remove();

		jQuery.each(RB_activeStaticLayersDataSet, function(idx, data) {
			RbSlider.generatePreviewItem( idx, false, {
				$targetArea: RB_previewArea,
				$layerItem: RB_previewArea.children('.rb-static-layer').eq(idx),
				layerData: data.layerData,
				isStatic: true
			});
		});
	},


	willGeneratePreviewItem: function(layerIndex) {
		clearTimeout(RbSlider.timeout);
		RbSlider.timeout = setTimeout(function() {
				RbSlider.generatePreviewItem(layerIndex);
		}, 150);
	},


	generateSelectedPreviewItems: function() {
		jQuery.each(RB_activeLayerIndexSet, function(index, layerIndex) {
			RbSlider.generatePreviewItem( layerIndex );
		});
	},


	generatePreviewItem: function(layerIndex, post, generateProperties) {

		if( jQuery.type( layerIndex ) === 'array' ) {
			layerIndex = layerIndex[0];
		}

		generateProperties = generateProperties || {};
		generateProperties = jQuery.extend({}, {
			$targetArea: RB_previewArea,
			$layerItem: RB_previewItems[layerIndex],
			layerData: RB_activeSlideData.sublayers[layerIndex],
			isStatic: false

		}, generateProperties);

		// Don't update the editor while live previews are active
		if( RbSlider.isLayerPreviewActive ) { return false; }

		// Remove affected item to replace with an updated one
		if( generateProperties.$layerItem ) {
			generateProperties.$layerItem.remove();
		}


		// Get layer data sets
		var layerData = generateProperties.layerData,
			layerCount 	= RB_activeSlideData.sublayers ? RB_activeSlideData.sublayers.length : 0,

			// Get layer attributes
			item,
			type 	= layerData.type,
			html 	= layerData.html,
			id 		= layerData.id,

			// Get style settings
			top 	= layerData.styles.top,
			left 	= layerData.styles.left,

			innerAttrs = layerData.innerAttributes || {},
			outerAttrs = layerData.outerAttributes || {};

		if( generateProperties.isStatic ) {
			layerIndex = layerCount + layerIndex;
		}

		switch( layerData.media ) {
			case 'img':
				type = 'img';
				break;

			case 'button':
				type = 'span';
				break;

			case 'media':
			case 'html':
				type = 'div';
				break;

			case 'post':
				type = 'post';
				break;
		}

		// Get post content if not passed
		if( ! post ) {
			var posts = window.rbPostsJSON || [],
				postOffset = RB_activeSlideData.properties.post_offset;

			if( postOffset == -1 ) {
				postOffset = RB_activeSlideIndex;
			}

			post = posts[postOffset] || {};
		}

		// Hidden layer
		if(layerData.skip || layerData['hide_on_'+RB_activeScreenType] ) {

			item = jQuery('<div class="rb-l">').appendToWithIndex(generateProperties.$targetArea, layerIndex).hide();
			if( ! generateProperties.isStatic ) {
				RB_previewItems[layerIndex] = item;
			}

			return true;
		}



		// Append element
		if(type == 'img') {
			var url = layerData.image;

			if(url == '[image-url]') {
				url = post['image-url'] || '';
				RB_GUI.updateImagePicker( 'image', post['image-url'], { fromPost: true } );
			}

			var tmpContent = url ? '<img src="'+url+'">' : '<div class="rb-layer-placeholder rb-image-placeholder"><span class="dashicons dashicons-format-image"></span><span>'+RB_l10n.SBPreviewImagePlaceholder+'</span></div>';
			item = jQuery(tmpContent).hide().appendToWithIndex(generateProperties.$targetArea, layerIndex);

		} else if(type == 'post') {

			var textlength = layerData.post_text_length;
			for(var key in post) {
				if(html && html.indexOf('['+key+']') !== -1) {
					var postVal = post[key];
					if( (key == 'title' || key == 'content' || key == 'excerpt') && textlength > 0) {
						postVal = RB_Utils.stripTags(postVal).substr(0, textlength);
						postVal = RB_Utils.nl2br(postVal);
					}
					html = html.replace('['+key+']', postVal);
				}
			}

			// Test for html wrapper
			html = jQuery.trim(html);

			var first = html.substr(0, 1),
				last = html.substr(html.length-1, 1);
			if(first == '<' && last == '>') {
				html = html.replace(/(\r\n|\n|\r)/gm,"");
				item = jQuery(html).appendToWithIndex(generateProperties.$targetArea, layerIndex);
			} else {
				item = jQuery('<div>').html(html).appendToWithIndex(generateProperties.$targetArea, layerIndex);
			}

		} else {
			// Empty media placeholder layer
			if( layerData.media === 'media' && html === '' ) {
				item = jQuery('<div class="rb-layer-placeholder rb-media-placeholder"><span class="dashicons dashicons-video-alt3"></span><span>'+RB_l10n.SBPreviewMediaPlaceholder+'</span></div>').appendToWithIndex(generateProperties.$targetArea, layerIndex);

			} else {

				item = jQuery('<'+type+'>').appendToWithIndex(generateProperties.$targetArea, layerIndex);
				if(html !== '') { item.html(html); }
			}
		}

		// Sublayer properties
		var transforms = {}, trKey, trVal, defVal;
		for( trKey in layerData.transition) {
			if( RB_transformStyles.indexOf( trKey ) !== -1) {

				trVal = layerData.transition[trKey];

				if( ! trVal && trVal !== 0 ) { continue; }

				trVal = trVal.toString();

				defVal 	= ( trKey.indexOf('scale') !== -1 ) ? 1 : 0;
				if( parseInt(trVal) !== defVal ) {
					transforms[ trKey ] = parseFloat( trVal );
				}
			}
		}

		// Styles
		var styles = { 'z-index': (100 + layerCount) - layerIndex };
		for(var sKey in layerData.styles) {
			var cssVal = layerData.styles[sKey];

			if( ! cssVal && cssVal !== 0 ) { continue; }

			cssVal = cssVal.toString();
			if( cssVal.slice(-1) == ';' ) { cssVal = cssVal.substring(0, cssVal.length - 1); }

			styles[sKey] = isNumber(cssVal) ? cssVal + 'px' : cssVal;

			if( ['z-index', 'font-weight', 'opacity'].indexOf( sKey )  !== -1 ) {
				styles[sKey] = cssVal;
			}
		}

		// Locked layer
		layerData.hasTransforms = ! jQuery.isEmptyObject( transforms );



		// Apply style settings and attributes
		item.attr( jQuery.extend({}, innerAttrs, outerAttrs) ).attr({
			id: id,
			style: layerData.style,
		}).css(styles).css({
			whiteSpace: !layerData.styles.wordwrap ? 'nowrap' : 'normal',
		}).addClass(layerData['class']);

		// Restore selection
		if( ! generateProperties.isStatic ) {
			RB_previewItems[layerIndex] = item;
			if(RB_activeLayerIndexSet.indexOf(layerIndex) !== -1) {
				item.addClass('ui-selected');
			} else {
				item.removeClass('ui-selected');
			}
		}

		// Add rb-l or static layer classes
		item.addClass( generateProperties.isStatic ? 'disabled rb-static-layer' : 'rb-l' );

		if( layerData.locked ) { item.addClass('disabled'); }
		if( layerData.hasTransforms ) { item.addClass('transformed'); }
		if( ~ location.href.indexOf('AdminRbSliderRevisions') ) {
			item.addClass('disabled');
		}

		// Iframes & media embeds
		var $iframe = item.children('iframe,video').eq(0);
		if( $iframe.length ) {

			if( layerData.transition.backgroundvideo ) {

				item.addClass('disabled bgvideo').css({
					pointerEvents: 'none'
				});

				if( layerData.transition.overlay ) {
					if( layerData.transition.overlayer !== 'disabled' ) {
						jQuery('<div>', {
							'class': 'video-overlay',
							'style': 'background-image: url('+layerData.transition.overlay+')'
						}).appendTo( item );
					}
				}

				// Exit script
				RbSlider.updatePreviewSelection();
				return;

			} else {

				var width 	= parseInt( $iframe.attr('width') ) || $iframe.width(),
					height 	= parseInt( $iframe.attr('height') ) || $iframe.height();

				if( ! layerData.styles.width ) {
					item.width( width );
				}

				if( ! layerData.styles.height ) {
					item.height( height );
				}
			}
		}

		// Make sure to override controls for media elements if set by media settings.
		if( layerData.media === 'media' && item.children('audio,video').length ) {
			if( layerData.transition.controls === 'enabled' ) {
				item.children('audio,video').prop('controls', true);
			} else if( layerData.transition.controls === 'disabled' ) {
				item.children('audio,video').prop('controls', false);
			}
		}

		if( item.is('img') ) {

			item.on( 'load', function(){
				RbSlider.setPositions(item, top, left);
				RbSlider.updatePreviewSelection();
				clearTimeout(RbSlider.selectableTimeout);
				RbSlider.selectableTimeout = setTimeout(function() {
					RbSlider.updatePreviewSelection();
				}, 100);
			}).attr('src',item.attr('src') );
		}else{
			RbSlider.setPositions(item, top, left);
			RbSlider.updatePreviewSelection();
		}

		// DO TRANSFORMS
		transforms.transformPerspective = 500;
		transforms.transformOrigin = layerData.transition.transformoriginin || '50% 50% 0';

		if( transforms.transformOrigin.indexOf( 'slider') !== -1 ){

			var sliderSize = RbSlider.getSliderSize(),
				sliderWidth = sliderSize.width,
				sliderHeight = sliderSize.height,
				itemLeft = parseFloat( item[0].style.left ),
				itemTop = parseFloat( item[0].style.top ),
				itemWidth = item.outerWidth(),
				itemHeight = item.outerHeight();

			transforms.transformOrigin = transforms.transformOrigin
			.replace( 'sliderleft', -itemLeft + 'px' )
			.replace( 'sliderright', sliderWidth - itemLeft + 'px' )
			.replace( 'slidercenter', sliderWidth / 2 - itemLeft + 'px' )
			.replace( 'slidermiddle', sliderHeight / 2 - itemTop + 'px' )
			.replace( 'slidertop', -itemTop + 'px' )
			.replace( 'sliderbottom', sliderHeight - itemTop + 'px' );
		}

		TweenMax.set( item[0], transforms );

		// Add draggable
		RbSlider.addDraggable();
	},

	setPositions: function(item, top, left, returnOnly) {

		item.show();

		var cssTop 	= top ? parseInt(top) : 0,
			cssLeft = left ? parseInt(left) : 0,
			style = item[0].style,
			marginLeft = parseInt( style.marginLeft ) || 0,
			marginTop = parseInt( style.marginTop ) || 0;

		// Position the element
		if( top && top.indexOf('%') !== -1 ) {

			if( cssTop === 0 ) {
				cssTop = 0 + marginTop;
			} else if( cssTop === 100 ) {
				cssTop = RB_previewArea.height() - item.outerHeight() + marginTop;
			} else {
				cssTop = RB_previewArea.height() / 100 * cssTop - item.outerHeight() / 2 + marginTop;
			}
		} else if( RB_activeLayerIndexSet.length === 1 ) {
			cssLeft += marginLeft;
		}

		if( left && left.indexOf('%') !== -1 ) {

			if( cssLeft === 0 ) {
				cssLeft =  0 + marginLeft;
			} else if( cssLeft === 100 ) {
				cssLeft = RB_previewArea.width() - item.outerWidth() + marginLeft;
			} else {
				cssLeft = RB_previewArea.width() / 100 * cssLeft - item.outerWidth() / 2 + marginLeft;
			}
		} else if( RB_activeLayerIndexSet.length === 1 ) {
			cssTop += marginTop;
		}

		if( returnOnly ) {
			return {
				top: cssTop,
				left: cssLeft
			};
		}

		item.css({ top: cssTop, left: cssLeft });
	},



	previewItemAtIndex: function(index) {
		return RB_previewArea.children('.rb-l').eq(index);
	},


	updatePreviewSelection: function() {

		// Hide lasso and stop execution
		// if there's no selected layers
		if( ! RB_activeLayerIndexSet.length ||
			! RB_activeSlideData.sublayers.length ||
			jQuery('.rb-editing').length) {
			$lasso.hide();
			return;
		}

		if( RB_activeLayerIndexSet.length === 1 ) {
			var layerData = RB_activeLayerDataSet[0];
			if ( layerData && ( layerData.hasTransforms || layerData.locked ) ) {
				$lasso.hide();
				return;
			}
		}

		var a = { left: Infinity, top: Infinity },
			b = { left: -Infinity, top: -Infinity };

		jQuery.each(RB_activeLayerIndexSet, function(idx, layerIndex) {
			var $item = RB_previewItems[layerIndex];
			if($item) {
				var p = $item.position(),
					q = {
						top: p.top + $item.outerHeight() * RB_previewZoom,
						left: p.left + $item.outerWidth() * RB_previewZoom
					};

				if( p.left < a.left ){ a.left = p.left; }
				if( p.top < a.top ){ a.top = p.top; }
				if( q.left > b.left ){ b.left = q.left; }
				if( q.top > b.top ){ b.top = q.top; }
			}
		});

		a.width = b.left - a.left;
		a.height = b.top - a.top;
		$lasso.css(a).show();

		if( ! $lasso.hasClass('rb-resizable-disabled') ) {
			$lasso.removeClass('ui-resizable-disabled').css(a).show();
		}

		if( RB_activeLayerIndexSet.length === 1 ) {
			var layerIndex = RB_activeLayerIndexSet[0];

			if( RB_previewItems[layerIndex] ) {
				if( RB_previewItems[layerIndex].hasClass('rb-layer-placeholder') ) {
					$lasso.addClass('ui-resizable-disabled');
				}
			}
		}

		// Mark the position of 0x0 px selection
		if( ! a.width || ! a.height ) {
			$lasso.addClass('ui-resizable-disabled');
		}
	},


	hidePreviewSelection: function() {
		jQuery('.rb-preview-wrapper').addClass('hide-selection');
	},


	showPreviewSelection: function() {
		jQuery('.rb-preview-wrapper').removeClass('hide-selection');
	},

	openMediaLibrary: function() {

		jQuery(document).on('click', '.rb-upload', function(e) {
			e.preventDefault();

			uploadInput = this;

			// Get library type
			var type = jQuery(this).hasClass('rb-insert-media') ? 'video,audio' : 'image';
			var multiple = jQuery(this).hasClass('rb-bulk-upload');

			// Media Library params
			var frame = wp.media({
				title : RB_l10n.SBMediaLibraryImage,
				multiple : multiple,
				library : { type : type },
				button : { text : 'Insert' }
			});

			// Runs on select
			frame.on('select',function() {

				// Get attachment(s) data
				var attachment 	= frame.state().get('selection').first().toJSON(),
					attachments = frame.state().get('selection').toJSON(),
					updateInfo 	= [],
					previewImg, newLayerData;



				// Slide image upload
				// -------------------------------------
				if(jQuery(uploadInput).hasClass('rb-slide-image') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Add action to UndoManager
					RB_UndoManager.add('slide.general', RB_l10n.SBUndoSlideImage, {
						itemIndex: RB_activeSlideIndex,
						undo: {
							background: RB_activeSlideData.properties.background,
							backgroundId: RB_activeSlideData.properties.backgroundId,
							backgroundThumb: RB_activeSlideData.properties.backgroundThumb
						},
						redo: {
							background: attachment.url,
							backgroundId: attachment.id,
							backgroundThumb: previewImg
						}
					});

					// Set current layer image
					RB_activeSlideData.properties.background = attachment.url;
					RB_activeSlideData.properties.backgroundId = attachment.id;
					RB_activeSlideData.properties.backgroundThumb = previewImg;


					// Set other images
					for(c = 1; c < attachments.length; c++) {

						// Get preview image url
						previewImg = !typeof attachments[c].sizes.thumbnail ? attachments[c].sizes.thumbnail.url : attachments[c].sizes.full.url;

						// Build new slide
						var newSlideData = jQuery.extend(true, {}, RB_DataSource.getDefaultSlideData());
							newSlideData.background = attachments[c].url;
							newSlideData.backgroundId = attachments[c].id;
							newSlideData.backgroundThumb = previewImg;

						// Add a layer
						newLayerData = jQuery.extend(true, {}, RB_DataSource.getDefaultLayerData());
						newLayerData.subtitle = RB_l10n.SBLayerTitle.replace('%d', '1');

						// Add new layer
						window.rbSliderData.layers.push({
							properties: newSlideData,
							sublayers: [newLayerData]
						});

						// Add new slide tab
						var newIndex 	= window.rbSliderData.layers.length + 1,
							title 		= RB_l10n.SBSlideTitle.replace('%d', newIndex),
							tab 		= jQuery('<a href="#"><span>'+title+'</span><img src="'+previewImg+'" ><span class="dashicons dashicons-dismiss"></span>').insertBefore('#rb-add-layer');
					}


				// Name new slide properly
				RbSlider.reindexSlides();


				// Slide thumbnail upload
				// -------------------------------------
				} else if(jQuery(uploadInput).hasClass('rb-slide-thumbnail') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Set current layer image
					RB_activeSlideData.properties.thumbnail = attachment.url;
					RB_activeSlideData.properties.thumbnailId = attachment.id;
					RB_activeSlideData.properties.thumbnailThumb = previewImg;


				// Layer image upload
				// -------------------------------------
				} else if(jQuery(uploadInput).hasClass('rb-layer-image') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Add action to UndoManager
					RB_UndoManager.add('layer.general', RB_l10n.SBUndoLayerImage, {
						itemIndex: RB_activeLayerIndexSet[0],
						undo: {
							image: RB_activeLayerDataSet[0].image,
							imageId: RB_activeLayerDataSet[0].imageId,
							imageThumb: RB_activeLayerDataSet[0].imageThumb
						},
						redo: {
							image: attachment.url,
							imageId: attachment.id,
							imageThumb: previewImg
						}
					});

					// Set current layer image
					RB_activeLayerDataSet[0].image = attachment.url;
					RB_activeLayerDataSet[0].imageId = attachment.id;
					RB_activeLayerDataSet[0].imageThumb = previewImg;

					// Set other images
					for(c = 1; c < attachments.length; c++) {

						// Get preview image url
						previewImg = !typeof attachments[c].sizes.thumbnail ? attachments[c].sizes.thumbnail.url : attachments[c].sizes.full.url;

						// Build new layer
						newLayerData = jQuery.extend(true, {}, RB_DataSource.getDefaultLayerData());
						newLayerData.image = attachments[c].url;
						newLayerData.imageId = attachments[c].id;
						newLayerData.imageThumb = previewImg;
						newLayerData.styles.top = (10*c)+'px';
						newLayerData.styles.left = (10*c)+'px';

						// Add new layer
						RB_activeSlideData.sublayers.unshift(newLayerData);
						updateInfo.push({
							itemIndex: 0,
							undo: { data: {} },
							redo: { data: newLayerData }
						});
					}

					// Rebuild layers list
					RB_DataSource.buildLayersList();

					// Maintain UndoManager
					if(updateInfo.length) {
						RB_UndoManager.add('slide.layers', RB_l10n.SBUndoNewLayers, updateInfo);
					}


				// Media (video/audio) image upload
				// -------------------------------------
				} else if( jQuery(uploadInput).hasClass('rb-media-image') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Add action to UndoManager
					RB_UndoManager.add('layer.general', RB_l10n.SBUndoVideoPoster, {
						itemIndex: RB_activeLayerIndexSet[0],
						undo: {
							poster: RB_activeLayerDataSet[0].poster,
							posterId: RB_activeLayerDataSet[0].posterId,
							posterThumb: RB_activeLayerDataSet[0].posterThumb
						},
						redo: {
							poster: attachment.url,
							posterId: attachment.id,
							posterThumb: previewImg
						}
					});

					// Set current layer poster
					RB_activeLayerDataSet[0].poster = attachment.url;
					RB_activeLayerDataSet[0].posterId = attachment.id;
					RB_activeLayerDataSet[0].posterThumb = previewImg;


				// Global slider background
				// -------------------------------------
				} else if( jQuery(uploadInput).hasClass('rb-global-background') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Store changes and update the preview
					window.rbSliderData.properties.backgroundimage = attachment.url;
					window.rbSliderData.properties.backgroundimageId = attachment.id;


				// YourLogo
				// -------------------------------------
				} else if( jQuery(uploadInput).hasClass('rb-yourlogo-upload') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Store changes and update the preview
					window.rbSliderData.properties.yourlogo = attachment.url;
					window.rbSliderData.properties.yourlogoId = attachment.id;


				// Slider Preview
				// -------------------------------------
				} else if( jQuery(uploadInput).hasClass('rb-slider-preview') ) {

					// Set image chooser preview
					previewImg = !typeof attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
					RB_GUI.updateImagePicker( jQuery(uploadInput),  previewImg);

					// Make sure that the meta object exits
					if( ! window.rbSliderData.meta ) {
						window.rbSliderData.meta = {};
					}

					// Store changes and update the preview
					window.rbSliderData.meta.preview = attachment.url;
					window.rbSliderData.meta.previewId = attachment.id;


				// Multimedia HTML
				} else if( jQuery(uploadInput).hasClass('rb-insert-media')) {

					var hasVideo 	= false,
						hasAudio 	= false,

						videos 		= [],
						audios 		= [],

						url 		= '',
						mediaHTML 	= '';

					// Iterate over selected items
					for(c = 0; c < attachments.length; c++) {
						url = '/' + attachments[c].url.split('/').slice(3).join('/');
						if(attachments[c].type === 'video') {
							hasVideo = true;
							videos.push({ url: url, mime: attachment.mime });

						} else if(attachments[c].type === 'audio') {
							hasAudio = true;
							audios.push({ url: url, mime: attachment.mime });
						}
					}

					// Insert multimedia
					if(hasVideo) {
						mediaHTML += '<video width="640" height="360" preload="metadata" controls>\r\n';
						for(c = 0; c < videos.length; c++) {
							mediaHTML += '\t<source src="'+videos[c].url+'" type="'+videos[c].mime+'">\r\n';
						}
						mediaHTML += '</video>';
					}

					if(hasAudio) {

						if(hasVideo) { mediaHTML += '\r\n\r\n'; }

						mediaHTML += '<audio preload="metadata" nocontrols>\r\n';
						for(c = 0; c < audios.length; c++) {
							mediaHTML += '\t<source src="'+audios[c].url+'" type="'+audios[c].mime+'">\r\n';
						}
						mediaHTML += '</audio>';
					}

					RB_activeLayerDataSet[0].html = mediaHTML;
					jQuery(uploadInput).prev().val(mediaHTML);

				// Image with input field
				} else {
					jQuery(uploadInput).val( attachment.url );
					if(jQuery(uploadInput).is('input[name="image"]')) {
						jQuery(uploadInput).prev().attr('src', attachment.url);
					}
				}

				// Generate preview
				RbSlider.generatePreview();
			});

			// Open ML
			frame.open();
		});
	},


	handleDroppedImages: function(event) {

		var oe 	= event.originalEvent,
			files = oe.dataTransfer.files,
			p = RB_previewArea.offset(),
			x = (jQuery(window).scrollLeft() + oe.clientX - p.left) / RB_previewZoom,
			y = (jQuery(window).scrollTop() + oe.clientY - p.top) / RB_previewZoom,
			updateInfo = [],
			layerDataSet = [],
			layerIndexSet = [],
			counter = 1;

		// Iterate over the dropped files
		jQuery.each(files, function(index, file) {
			RbSlider.uploadImageToMediaLibrary(file, function(data) {

				// Build new layer
				var layerData = jQuery.extend(true, {}, RB_DataSource.getDefaultLayerData());
				layerData.image = data.url;
				layerData.imageId = data.id;
				layerData.imageThumb = data.sizes.thumbnail ? data.sizes.thumbnail.url : data.url;
				layerData.subtitle = file.name;
				layerData.styles.left = x+'px';
				layerData.styles.top = y+'px';

				layerIndexSet.push(0);
				layerDataSet.push(layerData);

				// Increase next layer offsets
				x += 20;
				y += 20;

				// Add new layers when every image
				// has been uploaded
				if(counter++ === files.length) {
					RbSlider.addLayer( layerDataSet, layerIndexSet );
				}
			});
		});
	},


	uploadImageToMediaLibrary: function(file, callback) {
		if(file.type.indexOf('image') === 0) {

			// Build FormData object
			var formData = new FormData();
			formData.append('action', 'upload-attachment');
			formData.append('async-upload', file, file.name);
			formData.append('name', file.name);
			formData.append('_wpnonce', _wpPluploadSettings.defaults.multipart_params._wpnonce);

			jQuery.ajax({
				url: ajaxurl.replace('admin-ajax', 'async-upload'),
				method: 'POST',
				data: formData,
				dataType: 'json',
				processData: false,
				contentType: false,
				error: function(jqXHR, textStatus, errorThrown) {
					alert( RB_l10n.SBUploadErrorMessage.replace('%s', errorThrown) );
				},
				success: function(resp) {

					if(!resp || !resp.success) {
						alert(RB_l10n.SBUploadError);
						return;
					}

					if(typeof callback != "undefined") {
						callback(resp.data);
					}
				}
			});
		}
	},

	addLayerSortables: function() {

		// Bind sortable function
		jQuery('.rb-sublayer-sortable').sortable({

			handle : 'span.rb-sublayer-sortable-handle',
			containment : 'parent',
			tolerance : 'pointer',
			axis : 'y',

			start: function() {
				RbSlider.dragIndex = jQuery('.ui-sortable-placeholder').index() - 1;
			},

			change: function() {
				jQuery('.ui-sortable-helper').addClass('moving');
			},

			stop: function(event, ui) {

				// Get indexes
				var oldIndex = RbSlider.dragIndex;
				var index = jQuery('.moving').removeClass('moving').index();

				RB_UndoManager.add('layer.order', RB_l10n.SBUndoSortLayers, {
					itemIndex: null,
					undo: { from: index, to: oldIndex },
					redo: { from: oldIndex, to: index }
				});

				if( index > -1 ){
					RB_Utils.moveArrayItem(RB_activeSlideData.sublayers, oldIndex, index);
				}

				// Update active layer index
				RB_activeLayerIndexSet = [];
				jQuery('.rb-sublayers li.active').each(function() {
					RB_activeLayerIndexSet.push( jQuery(this).index() );
				});

				// Reindex layers
				RbSlider.reindexLayers();
				RbSlider.generatePreview();
			}
		});
	},


	addSlideSortables: function() {

		jQuery('#rb-layer-tabs').sortable({

			containment: 'parent',
			tolerance: 'pointer',
			items: 'a:not(.unsortable)',

			start: function() {
				RbSlider.dragIndex = jQuery('.ui-sortable-placeholder').index() - 1;
			},

			change: function() {
				jQuery('.ui-sortable-helper').addClass('moving');
			},

			stop: function(event, ui) {

				// Get indexes
				var oldIndex = RbSlider.dragIndex,
					index = jQuery('.moving').removeClass('moving').index();

				if( index > -1 ){
					RB_Utils.moveArrayItem(window.rbSliderData.layers, oldIndex, index);
				}

				// Update active slide index
				RB_activeSlideIndex = jQuery('#rb-layer-tabs a.active').index();

				// Add static layers
				RB_activeStaticLayersDataSet = RbSlider.staticLayersForSlide( RB_activeSlideIndex );

				// Reindex slides
				RbSlider.reindexSlides();
				RbSlider.reindexStaticLayers();
				RbSlider.generateStaticPreview();
				RB_DataSource.buildLayersList();
			}
		});
	},


	addDraggable: function() {

		// Add dragables and update settings
		// while and after dragging
		RB_previewArea.children('.rb-l').draggable({
			snap: true,
			snapTolerance: 10,
			cancel: '.disabled,.transformed',
			start: function(e, ui) {

				// Fix for deselect
				if( !ui.helper.hasClass('ui-selected') ){
					ui.helper.addClass('ui-selected').trigger('selectablestop.rb');
				}

				// Store selected layers & lasso originalPosition
				$lasso.data('originalPosition', $lasso.position());
				jQuery('.rb-preview .ui-selected').each(function() {
					var pos = jQuery(this).position();
					jQuery(this).data('originalPosition', {
						'top': pos.top / RB_previewZoom,
						'left': pos.left / RB_previewZoom,
					});
				});
			},

			drag: function(event, ui) {
				RbSlider.dragging(ui);
			},

			stop: function(event, ui) {

				var updateInfo = [];
				RbSlider.dragging(ui);

				jQuery('.rb-preview .ui-selected').each(function() {

					var $layer 			= jQuery(this),
						index 			= $layer.index(),
						position 		= $layer.position(),
						newTop 			= Math.round( position.top / RB_previewZoom ) +'px',
						newLeft 		= Math.round( position.left / RB_previewZoom ) +'px',
						origPosition 	= $layer.data('originalPosition');


					// Maintain changes in data source
					RB_activeSlideData.sublayers[index].styles.top  = newTop;
					RB_activeSlideData.sublayers[index].styles.left = newLeft;

					// Gather changes for undoing
					updateInfo.push({
						itemIndex: index,
						undo: { left: origPosition.left+'px', top: origPosition.top+'px' },
						redo: { left: newLeft, top: newTop }
					});
				});

				// Add changes to undoManager
				RB_UndoManager.add('layer.style', RB_l10n.SBUndoLayerPosition, updateInfo.reverse());
			}
		});
	},


	dragging: function(ui) {

		// Fix positions when zoomed
		ui.position.top = Math.round(ui.position.top  / RB_previewZoom );
		ui.position.left = Math.round(ui.position.left / RB_previewZoom );

		var index 	= ui.helper.index(),
			top 	= Math.round( ui.position.top ),
			left 	= Math.round( ui.position.left );

		// Update input field values if it's visible
		if(RB_activeLayerIndexSet.length === 1) {

			// Update input fields
			jQuery('.rb-sublayer-style input[name="top"]').val( ui.helper.position().top / RB_previewZoom + 'px');
			jQuery('.rb-sublayer-style input[name="left"]').val( ui.helper.position().left / RB_previewZoom + 'px');
		}
	},


	resizing: function(e, ui) {

		var rh = ui.size.height / ui.originalSize.height,
			rw = ui.size.width / ui.originalSize.width,
			uiRatio = ui.originalSize.width / ui.originalSize.height,
			tagNames = [], layer, $layer, layerIndex, layerData, width,
			height, op, os, r;

			if( !$lasso.data( 'dragDirection') ){
				$lasso.data( 'dragDirection', rh === 1 ? 'horizontal' : 'vertical' );
			}

		// Update layer data
		jQuery('.rb-preview .ui-selected').each(function() {

			layer 		= this;
			$layer 		= jQuery(this);
			layerIndex 	= $layer.index();
			layerData 	= RB_activeSlideData.sublayers[layerIndex];

			tagNames.push( layer.tagName.toLowerCase() );

			op = $layer.data('originalPosition');
			os = $layer.data('originalSize');

			layerData.styles.top 	= layer.style.top 	= Math.round( (op.top - Math.round( ui.originalPosition.top / RB_previewZoom ) ) * rh + Math.round( ui.position.top / RB_previewZoom ) ) + 'px';
			layerData.styles.left 	= layer.style.left 	= Math.round( (op.left - Math.round( ui.originalPosition.left / RB_previewZoom ) ) * rw + Math.round( ui.position.left / RB_previewZoom ) ) + 'px';

			width = Math.round(os.width * rw) + 'px';
			height = Math.round(os.height * rh) + 'px';

			if( layerData.styles.width || $layer.is('img,div') ) {
				layerData.styles.width 	= width;
			}

			if( layerData.styles.height || $layer.is('img,div') ) {
				layerData.styles.height = height;
			}

			$layer.outerWidth(width);
			$layer.outerHeight(height);


			// Font-size only
			if( ! $layer.is( 'img, iframe, video, audio' ) ) {
				r = ui.size.width / ui.originalSize.width;
				layerData.styles['font-size'] 	= layer.style.fontSize 	= Math.round( r * os.fontSize ) +'px';

				if( os.lineHeight ) {
					layerData.styles['line-height'] = layer.style.lineHeight = Math.round( r * os.lineHeight ) +'px';
				}
			}

			if(RB_activeLayerIndexSet.length === 1) {

				if( layerData.styles.width || $layer.is('img,div') ) {
					jQuery('.rb-sublayer-style input[name="width"]').val( layer.style.width);
				}

				if( layerData.styles.height || $layer.is('img,div') ) {
					jQuery('.rb-sublayer-style input[name="height"]').val( layer.style.height);
				}

				jQuery('.rb-sublayer-style input[name="top"]').val( layer.style.top);
				jQuery('.rb-sublayer-style input[name="left"]').val( layer.style.left);
				jQuery('.rb-sublayer-style input[name="font-size"]').val(layerData.styles['font-size']);
				if( os.lineHeight ) {
					jQuery('.rb-sublayer-style input[name="line-height"]').val( layerData.styles['line-height']+'px' );
				}
			}
		});

		if( tagNames.indexOf('img') === -1 && tagNames.indexOf('div') === -1 ) {
			switch( $lasso.data( 'dragDirection') ){
				case 'horizontal':
					ui.size.height = ui.size.width / uiRatio;
				break;
				case 'vertical':
					ui.size.width = ui.size.height * uiRatio;
				break;
			}
		}

		// Update lasso size info
		$lasso.attr({
			'data-info-0': 'w: ' + Math.round(ui.size.width) + 'px',
			'data-info-1': 'h: ' + Math.round(ui.size.height) + 'px'
		});
	},


	contextMenu: function(e) {

		// Bail out if preview is active or when using Revisions
		if( RbSlider.isSlidePreviewActive || RbSlider.isLayerPreviewActive || document.location.href.indexOf('rb-revisions') !== -1 ) {
			return;
		}

		// Vars to hold overlapping elements
		// and mouse position
		var items 	= [],
			mt 		= e.pageY;
			ml 		= e.pageX;


		RB_contextMenuTop = e.pageY - RB_previewArea.offset().top;
		RB_contextMenuLeft = e.pageX - RB_previewArea.offset().left;

		// Loop through layers list
		RB_previewArea.children('.rb-l').each(function(layerIndex) {

			// Get layer item and data
			var $layer 		= jQuery(this),
				layerData 	= RB_activeSlideData.sublayers[ $layer.index() ],

				// Get layer positions and dimensions
				t = RB_previewArea.offset().top + $layer.position().top,
				l = RB_previewArea.offset().left + $layer.position().left,
				w = $layer.outerWidth() * RB_previewZoom,
				h = $layer.outerHeight() * RB_previewZoom;

			if( (mt > t && mt < t+h) && (ml > l && ml < l+w) ) {
				items.push({ index: layerIndex, data: layerData });
			}
		});


		// Remove previous list (if any)
		jQuery('.rb-preview-context-menu').remove();

		// Create list
		var $list = jQuery( jQuery('#tmpl-rb-preview-context-menu').text() ).prependTo('body');
			$list.hide().css({ top: mt, left: ml }).fadeIn(100);

		// Close event
		jQuery('body').on('click.rb-context-menu', function() {
			jQuery('body').unbind('click.rb-context-menu');
			jQuery('.rb-preview-context-menu').animate({ opacity: 0 }, 200, function() {
				jQuery(this).remove();
			});
		});

		// Loop through intersecting elements (if any)
		if(items.length > 1) {
			jQuery.each(items, function(idx, data) {

				var layerIndex = data.index,
					layerData = data.data,

					$li = jQuery('<li><p></p><span>'+layerData.subtitle+'</span></li>').appendTo( $list.find('.rb-context-overlapping-layers ul') );
					$li.data('layerIndex', layerIndex);

				RbSlider.setLayerMedia( layerData.media,  jQuery('p', $li), layerData );
			});
		} else {
			$list.find('.rb-context-overlapping-layers').hide();
		}

		// Empty slide, no layers
		if( ! RB_activeSlideData.sublayers.length ) {
			jQuery('.rb-preview-context-menu > ul > li').not(':first-child, .rb-context-menu-paste-layer').hide();
		}
	},


	highlightPreviewItem: function(el) {

		// Get layer related data
		var layerIndex = jQuery(el).data('layerIndex');
		var $previewItem = RB_previewArea.children('.rb-l').eq(layerIndex);


		// Highlight item
		$previewItem.addClass('highlighted').siblings().addClass('lowlighted');

	},


	selectPreviewItem: function( layerIndex, event ) {

		// Remove layer highlights (if any)
		RB_previewArea.children().removeClass('highlighted lowlighted');

		if( ! event.ctrlKey && ! event.metaKey ) {
			if( JSON.stringify(RB_activeLayerIndexSet) !== '['+layerIndex+']' ) {
				return RbSlider.selectLayer( [ layerIndex ] );
			}

		} else {

			// Get layer
			var $previewItem = RB_previewArea.children().eq( layerIndex );

			// Select layer
			RB_previewHolder.triggerHandler(
				jQuery.Event('mousedown.rb', {
					target: $previewItem[0],
					which: 1,
					shiftKey: event.shiftKey,
					ctrlKey: event.ctrlKey,
					metaKey: event.metaKey
				})
			);
		}
	},


	editLayerToggle: function() {
		if(RB_activeLayerIndexSet.length === 1) {
			var $editing 	= jQuery('.rb-editing'),
				$layer 		= RB_previewItems[ RB_activeLayerIndexSet[0] ];

			if(!$editing.length) {
				this.editLayerStart($layer);
			} else {
				this.editLayerEnd($editing);
			}
		}
	},


	editLayerStart: function( $layer ) {

		// Bail out earily if it's an image layer
		if( $layer.is('img') || RB_activeLayerDataSet[0].media === 'img' ) {
			jQuery('.rb-layer-image').click();
			return false;

		} else if( RB_activeLayerDataSet[0].media === 'media' ) {
			return false;
		}

		RbSlider.selectLayer( [$layer.index() ] );

		// Get layer data
		var layerData = RB_activeLayerDataSet[0];

		// Bail out early if it's a locked layer
		if( $layer.hasClass('disabled') || layerData.locked) { return false; }

		// Enable editing
		$layer.addClass('disabled rb-editing')
			.prop('contenteditable', true)
			.focus();

		// Hide selectable/resizable
		$lasso.addClass('ui-resizable-disabled').hide();

		// Save current value for undoManager
		jQuery('.rb-html-code textarea').data('prevVal',layerData.html);

		// Select all text
		document.execCommand('selectAll');

		// End editing when clicking away
		jQuery(document).on('click.rb-editing', function(event) {
			if(!jQuery(event.target).hasClass('rb-editing')) {
				RbSlider.editLayerEnd( jQuery('.rb-editing') );
			}
		});
	},

	editLayer: function(e) {
		if((e.metaKey || e.ctrlKey || e.altKey) && e.which === 13) {
			e.preventDefault();
			document.execCommand('insertHTML', false, '\r\n&nbsp;');
		}
	},

	editLayerUpdate: function(layer) {
		var content 	= layer.textContent,
			$textarea 	= jQuery('.rb-html-code textarea'),
			styles 		= RB_activeLayerDataSet[0].styles;

		$textarea.val(content);
		RB_activeLayerDataSet[0].html = content;

		RbSlider.setPositions( jQuery(layer), styles.top, styles.left);
	},

	editLayerPaste: function(event) {
		event.preventDefault();
		document.execCommand('insertHTML', false,
			event.originalEvent.clipboardData.getData('text/plain')
		);
	},

	editLayerEnd: function($layer) {
		jQuery(document).off('click.rb-editing');
		$layer.prop('contenteditable', false).removeClass('disabled rb-editing');
		jQuery('.rb-html-code textarea').trigger('change');
		RbSlider.updatePreviewSelection();
	},

	reindexLayers: function(el) {

		var layerCount = RB_activeSlideData.sublayers.length;
			layerCount = layerCount ? layerCount : 0;

		// Reindex default layers' title
		jQuery('#rb-layers .rb-sublayers > li').each(function(index) {
			var layerTitle 	= jQuery(this).find('.rb-sublayer-title').val(),
				pattern 	= RB_l10n.SBLayerTitle.substring(0, RB_l10n.SBLayerTitle.length-2);

			if( layerTitle.indexOf(pattern) != -1 && layerTitle.indexOf('copy') == -1) {
				jQuery(this).find('.rb-sublayer-title').val( RB_l10n.SBLayerTitle.replace('%d', (layerCount-index) ) );
			}
		});
	},


	reindexSlides: function() {

		jQuery('#rb-layer-tabs a:not(.unsortable)').each(function(index) {

			var title 		= jQuery('span:first-child', this).text(),
				slideData 	= window.rbSliderData.layers[ index ],
				src 		= slideData.properties.backgroundThumb || pluginPath+'img/admin/blank.gif';


			if( title.indexOf('copy') === -1 && title.indexOf('Slide #') !== -1 ) {
				title = 'Slide #' + (index + 1);
			}

			jQuery(this)
				.attr({
					'data-help': "<div style='background-image: url("+src+");'></div>",
					'data-help-class': 'rb-slide-preview-tooltip popover-light',
					'data-help-delay': 1,
					'data-help-transition': false
				}).html('<span>'+title+'</span><span class="dashicons dashicons-dismiss"></span>');
		});
	},


	rebuildSlides: function() {

		// Remove tabs
		jQuery('#rb-layer-tabs a:not(.unsortable)').remove();

		jQuery.each(window.rbSliderData.layers, function(slideKey, slideData) {

			var title 	= slideData.properties.title || RB_l10n.SBSlideTitle.replace('%d', slideKey+1),
				src 	= slideData.properties.backgroundThumb || pluginPath+'img/admin/blank.gif';


			if( title.indexOf('copy') === -1 && title.indexOf('Slide #') !== -1 ) {
				title = 'Slide #' + (slideKey + 1);
			}

			$tab = jQuery('<a></a>').insertBefore('#rb-layer-tabs .unsortable:first');

			$tab.attr({
				'href': '#',
				'data-help': "<div style='background-image: url("+src+");'></div>",
				'data-help-class': 'rb-slide-preview-tooltip popover-light',
				'data-help-delay': 1,
				'data-help-transition': false
			}).html('<span>'+title+'</span><span class="dashicons dashicons-dismiss"></span>');
		});


		jQuery('#rb-layer-tabs a').eq( RB_activeSlideIndex ).addClass('active');
	},

	checkMediaAutoPlay: function( $textarea, prop, val ) {

		clearTimeout(RbSlider.mediaCheckTimeout);
		RbSlider.mediaCheckTimeout = setTimeout(function() {

			if( val.indexOf('autoplay') !== -1 ) {

				var $media = jQuery(val).filter('iframe'),
					autoplayDetected = false;

				 if( $media.is('iframe') ) {

					var URL = $media.attr('src').split('?'),
						targetIndex = -1;

					if( URL[1] ) {
						params = URL[1].split('&');
						jQuery.each(params, function(index, item) {
							if( item.indexOf('autoplay') !== -1 ) {
								autoplayDetected = true;
								targetIndex = index;
							}
						});

						if( targetIndex > -1 ) {
							params.splice(targetIndex, 1);
						}
					}

					if( typeof params !== 'undefined' ) {
						$media.attr('src', URL[0]+'?'+params.join('&') );
					}

				 } else if( $media.is('video') || $media.is('audio') ) {
					autoplayDetected = true;
					$media.removeAttr('autoplay');
				 }


				 if( autoplayDetected ) {

					$textarea.val( $media[0].outerHTML );
					$autoplay = jQuery('select[name="autoplay"]');

					jQuery('option', $autoplay)
						.prop('selected', false)
						.eq(1).prop('selected', true);

					TweenLite.to($autoplay[0], 0.2, {
						css: { scale: 1.3 },
						onComplete: function() {
							TweenLite.to($autoplay[0], 0.2, {
								css: { scale: 1 }
							});
						}
					});
				}
			}
		}, 100, $textarea, prop, val);
	},

	startSlidePreview: function( sliderOptions ) {

		// Stop **layer** preview if it's currently running
		// to prevent simultaneous instances
		this.stopLayerPreview(true);

		// Stop slide preview if it's currently running
		if(this.isSlidePreviewActive) {
			RbSlider.stopSlidePreview();
			return true;
		}

		this.isSlidePreviewActive = true;

		sliderOptions = sliderOptions || {};

		// Get slider settings and preview container
		var sliderProps = window.rbSliderData.properties,
			sliderSize 	= RbSlider.getSliderSize(),
			plugins 	= [];

		// Switch between preview and editor
		var $slider  = jQuery('#rb-layers .rb-real-time-preview').show();
			$slider  = jQuery('<div id="rb-preview-timeline" class="rb-wp-container">').appendTo( $slider );

		if( sliderProps.sliderclass ) {
			$slider.addClass( sliderProps.sliderclass );
		}

		jQuery('#rb-layers .rb-preview').hide();
		jQuery('#rb-layers .rb-preview-button').html('Stop').addClass('playing');

		RbSlider.hidePreviewSelection();

		// Empty the preview area to avoid ID collisions
		RB_previewArea.empty();

		// Append slides & layers
		this.populateSliderPreview( $slider, plugins );

		// Handle plugins
		if( sliderOptions && sliderOptions.plugins ) {
			sliderOptions.plugins = jQuery.merge(sliderOptions.plugins, plugins);
		}

		// Init RbSlider
		$slider.RbSlider( jQuery.extend( true, {
			type: 'responsive',
			width: sliderSize.width,
			height: sliderSize.height,
			skin: 'v6',
			skinsPath: pluginPath + 'css/rbthemeslider/skins/',
			firstSlide: RB_activeSlideIndex + 1,
			autoStart: true,
			pauseOnHover: false,
			startInViewport: false,
			autoPlayVideos: sliderProps.autoplayvideos ? true : false,
			slideBGSize: sliderProps.slideBGSize,
			slideBGPosition: sliderProps.slideBGPosition,
			globalBGColor: sliderProps.backgroundcolor,
			globalBGImage: sliderProps.backgroundimage,
			globalBGAttachment: sliderProps.globalBGAttachment,
			globalBGRepeat: sliderProps.globalBGRepeat,
			globalBGPosition: sliderProps.globalBGPosition,
			globalBGSize: sliderProps.globalBGSize,
			parallaxScrollReverse: sliderProps.parallaxScrollReverse,
			playByScroll: sliderProps.playByScroll ? true : false,
			playByScrollStart: sliderProps.playByScrollStart ? true : false,
			playByScrollSpeed: sliderProps.playByScrollSpeed || 1,
			navButtons: false,
			navStartStop: false,
			allowRestartOnResize: sliderProps.allowRestartOnResize ? true : false,
			preferBlendMode: sliderProps.preferBlendMode,
			plugins: plugins

		}, sliderOptions )).on('slideTimelineDidComplete', function( event, slider ) {
			// if( jQuery('.rb-timeline-switch li').eq(0).hasClass('active') ) {
			// 	slider.api('replay');
			// 	return false;
			// }

		}).on( 'slideTimelineDidCreate', function(){
			jQuery( '.rb-slidebar-slider' ).attr({
				'data-help': RB_l10n.SBDragMe,
				'data-km-ui-popover-once': 'true',
				'data-km-ui-popover-theme': 'red',
				'data-km-ui-popover-autoclose': 3,
				'data-km-ui-popover-distance': 20
			}).trigger( 'mouseenter' );
		});
	},



	stopSlidePreview: function() {

		if( this.isSlidePreviewActive ) {
			this.isSlidePreviewActive = false;

			// Show the editor
			jQuery('#rb-layers .rb-preview').show();

			// Stop RbSlider and empty the preview contents
			var RbSliders = jQuery('#rb-layers .rb-real-time-preview');
			RbSliders.find('.rb-container').RbSlider( 'destroy', true ).remove();
			RbSliders.hide();

			// Rewrote the Preview button text
			var btnText = ~ location.href.indexOf('AdminRbSliderRevisions') ? RB_l10n.SBPreviewSlide : RB_l10n.slideNoun;
			jQuery('#rb-layers .rb-preview-button').text( btnText ).removeClass('playing');

			RbSlider.generatePreview();
			RbSlider.showPreviewSelection();
			RbSlider.updatePreviewSelection();

			// Remove timeline
			jQuery('.rb-timeline-switch li:first-child').click();

			// SET: layer editor size
			kmUI.smartResize.set();
		}
	},


	startPopupPreview: function( sliderOptions, button ) {

		// Stop both layer & slide preview if they are active
		this.stopLayerPreview(true);
		this.stopSlidePreview();

		sliderOptions = sliderOptions || {};

		// Prevent pressing the Preview button multiple times
		jQuery(button).prop('disabled', true);
		setTimeout(function() {
			jQuery(button).prop('disabled', false);
		}, 1000);

		// Get slider settings and preview container
		var sliderProps = window.rbSliderData.properties,
			width 		= parseInt(sliderProps.popupWidth),
			height 		= parseInt(sliderProps.popupHeight),
			sliderCSS 	= sliderProps.sliderstyle,
			circleTimer = sliderProps.circletimer ? true : false,
			plugins 	= ['popup'];

		// Append live preview element
		var $slider  = jQuery('<div id="rb-popup-preview" class="rb-wp-container">').appendTo('body');

		if( sliderCSS ) {
			$slider.attr('style', sliderCSS);
		}

		if( sliderProps.sliderclass ) {
			$slider.addClass( sliderProps.sliderclass );
		}


		// Get popup init options
		jQuery('.rb-settings-popup .popup-prop').each(function() {
			if( this.name ) { sliderOptions[ this.name ] = window.rbSliderData.properties[ this.name ]; }
		});

		// Append slides & layers
		if( RbSlider.sliderIsEmpty( 1 ) ) {
			$slider.html( jQuery('#tmpl-popup-example-slider').text() );
			width = 700;
			height = 500;
			circleTimer = false;
			sliderOptions.popupCloseButtonStyle = 'top: 20px; left: 40px;';
			sliderOptions.popupPositionHorizontal = 'center';
			sliderOptions.popupPositionVertical = 'middle';
			sliderOptions.popupFitWidth = false;
			sliderOptions.popupFitHeight = false;
		} else {
			this.populateSliderPreview( $slider, plugins );
		}



		// Handle plugins
		if( sliderOptions && sliderOptions.plugins ) {
			sliderOptions.plugins = jQuery.merge(sliderOptions.plugins, plugins);
		}

		// Init RbSlider
		$slider.RbSlider( jQuery.extend( true, {
			type: 'popup',
			width: width,
			height: height,
			popupWidth: width,
			popupHeight: height,
			skin: sliderProps.skin,
			skinsPath: pluginPath + 'css/rbthemeslider/skins/',
			autoStart: sliderProps.autostart ? true : false,
			pauseOnHover: sliderProps.pauseonhover,
			firstSlide: sliderProps.firstlayer,
			shuffleSlideshow: sliderProps.randomslideshow ? true : false,
			navPrevNext: sliderProps.navprevnext ? true : false,
			hoverPrevNext: sliderProps.hoverprevnext ? true : false,
			navStartStop: sliderProps.navstartstop ? true : false,
			navButtons: sliderProps.navbuttons ? true : false,
			hoverBottomNav: sliderProps.hoverbottomnav ? true : false,
			showBarTimer: sliderProps.bartimer ? true : false,
			showCircleTimer: circleTimer,
			thumbnailNavigation: sliderProps.thumb_nav,
			tnContainerWidth: sliderProps.thumb_container_width,
			tnWidth: sliderProps.thumb_width,
			tnHeight: sliderProps.thumb_height,
			tnActiveOpacity: sliderProps.thumb_active_opacity,
			tnInactiveOpacity: sliderProps.thumb_inactive_opacity,
			startInViewport: false,
			autoPlayVideos: sliderProps.autoplayvideos ? true : false,
			slideBGSize: sliderProps.slideBGSize,
			slideBGPosition: sliderProps.slideBGPosition,
			globalBGColor: sliderProps.backgroundcolor,
			globalBGImage: sliderProps.backgroundimage,
			globalBGAttachment: sliderProps.globalBGAttachment,
			globalBGRepeat: sliderProps.globalBGRepeat,
			globalBGPosition: sliderProps.globalBGPosition,
			globalBGSize: sliderProps.globalBGSize,
			parallaxScrollReverse: sliderProps.parallaxScrollReverse,
			allowRestartOnResize: sliderProps.allowRestartOnResize ? true : false,
			preferBlendMode: sliderProps.preferBlendMode,
			plugins: plugins,

			// Popup Settings
			popupShowOnce: true,
			popupShowOnTimeout: 0.01,
			popupDisableOverlay: false,
			popupOverlayClickToClose: true

		}, sliderOptions ));
	},


	populateSliderPreview: function( $slider, plugins, sliderData ) {
		sliderData = sliderData || window.rbSliderData;
		var sliderProps = sliderData.properties,
			callbacks 	= sliderData.callbacks,
			posts 		= window.rbPostsJSON || [];

		// Iterate over the slides
		jQuery.each(sliderData.layers, function(slideIndex, slideData) {

			// Slide data
			var slideProps = slideData.properties,
				layers = slideData.sublayers.reverse();

			// Get post content if any
			var postOffset = slideProps.post_offset;
			if(postOffset == -1) { postOffset = slideIndex; }
			var post = posts[postOffset];

			// Slide attributes
			var properties = '', sKey, sVal;
			for( sKey in slideProps) {
				sVal = slideProps[ sKey ];
				if( sVal !== '' && sVal !== 'null' ) {

					// Slide BG inheritance
					if( sKey === 'bgsize' && sVal === 'inherit' ) {
						sVal = sliderProps.slideBGSize;

					} else if( sKey === 'bgposition' && sVal === 'inherit' ) {
						sVal = sliderProps.slideBGPosition;
					}

					if( sKey === 'transitionorigami' && sVal ) {
						if(plugins.indexOf('origami') === -1) {
							plugins.push('origami');
						}
					}

					properties += sKey+':'+sVal+';';
				}
			}

			// Build the Slide
			var layer = jQuery('<div class="rb-slide">')
							.attr('data-rb', properties)
							.appendTo( $slider );

			// Get background
			var background = slideProps.background;
			if(background === '[image-url]') {
				background = post['image-url'];
			}

			// Add background
			if(background) {
				jQuery('<img src="'+background+'" class="rb-bg">').appendTo(layer);
			}

			// Get selected transitions
			var tr2d = slideProps['2d_transitions'],
				tr3d = slideProps['3d_transitions'],
				tr2dcustom = slideProps.custom_2d_transitions,
				tr3dcustom = slideProps.custom_3d_transitions;

			// Apply transitions
			if(tr2d) layer.attr('data-rb', layer.attr('data-rb') + ' transition2d: '+tr2d+'; ');
			if(tr3d) layer.attr('data-rb', layer.attr('data-rb') + ' transition3d: '+tr3d+'; ');
			if(tr2dcustom) layer.attr('data-rb', layer.attr('data-rb') + ' customtransition2d: '+tr2dcustom+'; ');
			if(tr3dcustom) layer.attr('data-rb', layer.attr('data-rb') + ' customtransition3d: '+tr3dcustom+'; ');


			// Iterate over layers
			jQuery.each(layers, function(layerKey, layerData) {
				RbSlider.appendLivePreviewItem(layerKey, layerData, layer, post);
			});

			// Revert back to original layer order, as the reversed
			// layers list is only a visual thing on the admin UI.
			slideData.sublayers.reverse();
		});

		// Callbacks
		if( callbacks ) {
			for( var key in callbacks ) {

				var callback 	= callbacks[ key ],
					startIndex 	= callback.indexOf('{') + 1,
					endIndex 	= callback.length - 1;

					body 	= callback.substring(startIndex, endIndex);

				$slider.on(key, new Function('event', 'slider', body));
			}
		}
	},


	startLayerPreview: function(button, forceStop) {

		// Stop **slide** preview if it's currently running
		// to prevent simultaneous instances
		this.stopSlidePreview();

		// Stop or restart current preview session (if any)
		if(this.isLayerPreviewActive){
			RbSlider.stopLayerPreview(forceStop);

			if( !!forceStop ){
				return;
			}
		}


		// Check for Multi-Select
		if( RB_activeLayerDataSet.length > 1 ) {
			alert(RB_l10n.SBLayerPreviewMultiSelect);
			return;
		}

		// Change preview state
		this.isLayerPreviewActive = true;
		jQuery(button).addClass('playing').text( RB_l10n.stop );

		// Hide other layers
		RbSlider.hidePreviewSelection();
		RB_previewArea.children().addClass('rb-transparent');

		// Create container element
		var $wrapper = jQuery('<div>').addClass('rb-layer-preview-wrapper').appendTo('.rb-preview-wrapper');

		// Slide properties
		var slideProps = RB_activeSlideData.properties,
			postOffset = slideProps.post_offset;

		if(postOffset == -1) { postOffset = RB_activeSlideIndex; }
		var posts 	= window.rbPostsJSON || [];
		var post 	= posts[postOffset];

		// Slide attributes
		var properties = '', sKey, sVal;
		for( sKey in slideProps) {
			sVal = slideProps[ sKey ];

			// Don't allow empty values & force auto slide duration
			if( sVal !== '' && sVal !== 'null' && sKey !== 'slidedelay' ) {
				properties += sKey+':'+sVal+';';
			}
		}

		if( sliderProps.sliderclass ) {
			$wrapper.addClass( sliderProps.sliderclass );
		}

		// Add slide
		$s1 = jQuery('<div>').attr({
			'class': 'rb-slide',
			'data-rb': properties
		}).appendTo($wrapper);

		// Get layer data
		var item = RB_activeLayerDataSet[0],
			layerData = jQuery.extend(true, {}, item);
			layerData.transition.delayin = 100;


		RbSlider.appendLivePreviewItem(0, layerData, $s1, post);

		item.skip = true;
		RB_previewItems[ RB_activeLayerIndexSet[0] ].addClass('rb-invisible');

		var sliderSize = RbSlider.getSliderSize();

		// Initialize slider
		$wrapper.RbSlider({
			type: 'responsive',
			width: sliderSize.width,
			height: sliderSize.height,
			skin: 'v6',
			skinsPath: pluginPath + 'css/rbthemeslider/skins/',
			pauseOnHover: false,
			autoPlayVideos: false,
			startInViewport: false,
			keybNav: false,
			navButtons: false,
			navStartStop: false,
			navPrevNext: false
		}).on('slideTimelineDidComplete', function( event, slider ) {
			if( jQuery('.rb-timeline-switch li').eq(0).hasClass('active') ) {
				slider.api('replay');
				return false;
			}
		});

	},


	stopLayerPreview: function(forceStop){

		if(this.isLayerPreviewActive) {

			// Change preview state
			this.isLayerPreviewActive = false;
			RbSlider.showPreviewSelection();
			jQuery('.rb-layer-preview-button').removeClass('playing').text( RB_l10n.layer );

			jQuery.each(RB_activeLayerDataSet, function(index, item) {
				item.skip = false;
			});

			// Restore editing area
			// RB_activeLayerDataSet.skip = false;
			if( forceStop ) {
				RbSlider.generateSelectedPreviewItems();
			}

			jQuery('.rb-layer-preview-wrapper').RbSlider( 'destroy', true ).remove();
			RB_previewArea.children().removeClass('rb-transparent');
		}
	},


	appendLivePreviewItem: function(layerKey, layerData, $slide, post) {

		// Skip sublayer?
		if( !!layerData.skip || layerData['hide_on_'+RB_activeScreenType] ) {
			return true;
		}

		// Gather sublayer data
		var type = layerData.type;
		switch( layerData.media ) {
			case 'img':
				type = 'img';
				break;

			case 'button':
				type = 'span';
				break;

			case 'html':
			case 'media':
				type = 'div';
				break;

			case 'post':
				type = 'post';
				break;
		}

		var image = layerData.image,
			html = layerData.html,
			style = layerData.style,
			top = layerData.styles.top,
			left = layerData.styles.left,
			skip = layerData.hasOwnProperty('skip'),
			url = layerData.url,
			id = layerData.id,
			classes = layerData['class'],

			innerAttrs = layerData.innerAttributes || {},
			outerAttrs = layerData.outerAttributes || {};

		// Sublayer properties
		var sublayerprops = '', trKey, trVal;
		for( trKey in layerData.transition) {

			trVal = layerData.transition[ trKey ];

			if( trKey.indexOf('perspective') !== -1 &&  trVal.toString() === '500') {
				continue;

			}

			if( trKey === 'backgroundvideo' && ! trVal ) {
				continue;
			}

			if( trVal !== '' && trVal !== null && trVal !== 'null' && trVal !== 'inherit' ) {
				sublayerprops += trKey+':'+trVal+';';
			}
		}


		// Styles
		var styles = {}, cssProp, cssVal;
		for( cssProp in layerData.styles ) {
			cssVal = layerData.styles[cssProp];

			if( ! cssVal && cssVal !== 0 ) { continue; }
			cssVal = cssVal.toString();

			if(cssVal.slice(-1) == ';' ) {
				cssVal = cssVal.substring(0, cssVal.length - 1);
			}
			if (cssVal) { // !! fix for unused styles don't override Custom CSS
				styles[cssProp] = isNumber(cssVal) ? cssVal + 'px' : cssVal;

				if( ['z-index', 'font-weight', 'opacity'].indexOf( cssProp )  !== -1 ) {
					styles[cssProp] = cssVal;
				}
			}
		}

		// Build the sublayer
		var sublayer;
		if(type == 'img') {
			if(!image) { return true; }
			if(image == '[image-url]') { image = post['image-url']; }

			sublayer = jQuery('<img src="'+image+'" class="rb-l">').appendTo($slide);

		} else if(type == 'post') {

			// Parse post placeholders
			var textlength = layerData.post_text_length;
			for(var key in post) {
				if(html.indexOf('['+key+']') !== -1) {
					if( (key == 'title' || key == 'content' || key == 'excerpt') && textlength > 0) {
						post[key] = post[key].substr(0, textlength);
					}
					html = html.replace('['+key+']', post[key]);
				}
			}

			// Test html
			html = jQuery.trim(html);
			var first = html.substr(0, 1);
			var last = html.substr(html.length-1, 1);
			if(first == '<' && last == '>') {
				html = html.replace(/(\r\n|\n|\r)/gm,"");
				sublayer = jQuery(html).appendTo($slide).addClass('rb-l');
			} else {
				sublayer = jQuery('<div>').appendTo($slide).html(html).addClass('rb-l');
			}

		} else {
			sublayer = jQuery('<'+type+'>').appendTo($slide).html(html).addClass('rb-l');

			// Rewrite Youtube/Vimeo iframe src to data-src
			var $video = sublayer.find('iframe[src*="youtube-nocookie.com"], iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="player.vimeo"]');
			if( $video.length ) {
				$video.attr('data-src', $video.attr('src') ).removeAttr('src');
			}
		}

		// Apply styles
		sublayer
			.attr({ 'id': id, 'style': style })
			.css(styles)
			.css('white-space', !layerData.styles.wordwrap ? 'nowrap' : 'normal')
			.addClass(classes);

		// Apply attributes
		for( var iaKey in innerAttrs ) {
			if( iaKey.toLowerCase() === 'class' ) {
				sublayer.addClass( innerAttrs[iaKey] );
				continue;
			}

			sublayer[0].setAttribute(iaKey, innerAttrs[iaKey]);
		}

		// Position the element
		if(top.indexOf('%') != -1) { sublayer.css({ top : top });
			} else { sublayer.css({ top : parseInt(top) }); }

		if(left.indexOf('%') != -1) { sublayer.css({ left : left });
			} else { sublayer.css({ left : parseInt(left) }); }

		if( url ) {
			var anchor = jQuery('<a href="'+url+'" target="_blank"></a>');
				anchor.attr( outerAttrs );

			sublayer.wrap( anchor );
		} else {

			// Apply attributes
			for( var oaKey in outerAttrs ) {
				if( oaKey.toLowerCase() === 'class' ) {
					sublayer.addClass( outerAttrs[oaKey] );
					continue;
				}

				sublayer[0].setAttribute(oaKey, outerAttrs[oaKey]);
			}
		}

		sublayer.attr('data-rb', sublayerprops);
	},


	updatePopupNotifications: function() {

		var $wrapper 	= jQuery('#rb-popup-notifications'),
			$layout 	= jQuery('.rb-popup-layout-notification', $wrapper),
			$trigger 	= jQuery('.rb-popup-trigger-notification', $wrapper),
			sliderProps = window.rbSliderData.properties,
			layoutCond 	= sliderProps.type !== 'popup',
			triggerCond = jQuery.trim(sliderProps.popupShowOnTimeout) || jQuery.trim(sliderProps.popupShowOnIdle) || jQuery.trim(sliderProps.popupShowOnScroll) || sliderProps.popupShowOnLeave || jQuery.trim(sliderProps.popupShowOnClick);

		$layout[ layoutCond ? 'removeClass' : 'addClass' ]('rb-hidden');
		$trigger[ ! triggerCond ? 'removeClass' : 'addClass' ]('rb-hidden');

		$wrapper.children(':not(.rb-hidden):first').removeClass('rb-hidden').siblings().addClass('rb-hidden');
	},


	updatePopupPositionGrid: function() {

		var vPos = window.rbSliderData.properties.popupPositionVertical,
			hPos = window.rbSliderData.properties.popupPositionHorizontal;

		jQuery('.rb-popup-position td[data-move="'+vPos+' '+hPos+'"]').click();
	},


	updatePopupPreview: function() {

		var fitWidth 	= window.rbSliderData.properties.popupFitWidth,
			fitHeight 	= window.rbSliderData.properties.popupFitHeight,
			vPos 		= window.rbSliderData.properties.popupPositionVertical,
			hPos 		= window.rbSliderData.properties.popupPositionHorizontal,
			$preview 	= jQuery('.rb-settings-popup .rb-popup-layout-preview .rb-popup-layout-inner');

			$preview.attr('class', 'rb-popup-layout-inner rb-popup-'+vPos+' rb-popup-'+hPos);

			if( fitWidth ) { $preview.addClass('rb-popup-fitwidth'); }
			if( fitHeight ) { $preview.addClass('rb-popup-fitheight'); }
	},


	updateLayerPreview: function() {

		var $slider = jQuery('.rb-real-time-preview .rb-container'),
			$layer 	= jQuery('.rb-layer', $slider);



		$slider.RbSlider( 'updateLayerData', $layer, 'scalein: 2; rotatein: 360; scaleout: 2; rotateout: 360; rotate: -45;' );
	},



	openTransitionGallery: function() {

		kmUI.modal.open( '#tmpl-rb-transition-modal', { width: 900, height: 1500 } );

		// Append transitions
		RbSlider.appendTransition(0, '', '2d_transitions', RbSliderTransitions.t2d);
		RbSlider.appendTransition(1, '', '3d_transitions', RbSliderTransitions.t3d);

		// Append custom transitions
		if(typeof RbSliderCustomTransitions != "undefined") {
			if(RbSliderCustomTransitions.t2d.length) {
				RbSlider.appendTransition(2, '', 'custom_2d_transitions', RbSliderCustomTransitions.t2d);
			}
			if(RbSliderCustomTransitions.t3d.length) {
				RbSlider.appendTransition(3, '', 'custom_3d_transitions', RbSliderCustomTransitions.t3d);
			}
		}

		jQuery('#rb-transition-window .rb-select-special-transition').each(function() {
			var $this 	= jQuery(this),
				name 	= $this.data('name');


			$this.addClass( RB_activeSlideData.properties[ name ] ? 'on' : 'off' );
		});

		// Select proper tab
		jQuery('#rb-transition-window .filters li.active').click();
	},


	appendTransition: function(index, title, tbodyclass, transitions) {

		// Append new section
		var section = jQuery( '#rb-transitions-list section:eq('+index+') div' ).empty();

		// Get checked transitions
		var checked = RB_activeSlideData.properties[tbodyclass];
			checked = checked ? checked.split(',') : [];

		if( transitions && transitions.length ) {
			for( c = 0; c < transitions.length; c++ ){
				var addClass = '';
				if(checked.indexOf(''+(c+1)+'') != -1 || checked == 'all') {
					addClass = 'added';
				}
				section.append( jQuery( '<div class="tr-item '+addClass+'"data-key="' + ( c + 1 ) + '"><span><i>' + ( c + 1 ) + '</i><i class="dashicons dashicons-yes"></i></span><span>' + transitions[c].name + '</span></div>' ) );
			}
		}
	},


	selectAllTransition: function(index, check) {

		// Get checkbox and transition type
		var checkbox = jQuery('#rb-transition-window header i:last'),
			type = jQuery('#rb-transitions-list section').eq(index).data('tr-type');

		if(check) {

			jQuery( '#rb-transitions-list section:eq('+index+')' ).find('.tr-item').addClass('added');
			checkbox.attr('class', 'on').text( RB_l10n.deselectAll );
			RB_activeSlideData.properties[ type ] = 'all';

		} else {

			jQuery( '#rb-transitions-list section:eq('+index+')' ).find('.tr-item').removeClass('added');
			checkbox.attr('class', 'off').text( RB_l10n.selectAll);
			RB_activeSlideData.properties[ type ] = '';
		}
	},

	toggleTransition: function(el) {

		var $item 		= jQuery(el),
			$section 	= $item.closest('section'),
			$trs 		= $section.find('.tr-item'),
			type 		= $section.data('tr-type');

		// Toggle addded class
		$item.toggleClass('added');

		// All selected
		if($trs.filter('.added').length == $trs.length) {

			RbSlider.selectAllTransition( $section.index(), true );
			return;

		// Uncheck select all
		} else {

			// Check the checkbox
			jQuery('#rb-transition-window header i:last').attr('class', 'off').text( RB_l10n.selectAll );
		}

		// Gather checked selected transitions
		var checked = [];
		$trs.filter('.added').each(function() {
			checked.push( jQuery(this).data('key') );
		});

		// Set data
		RB_activeSlideData.properties[ type ] = checked.join(',');
	},


	save: function( saveProperties ) {

		saveProperties = saveProperties || {};

		// Bring all layers back in,
		// as it can mess with saving.
		this.stopLayerPreview(true);

		// Get the slider data
		var sliderData = jQuery.extend(true, {}, window.rbSliderData);

		// Temporary disable submit button
		jQuery('.rb-publish').addClass('saving').find('button').text( RB_l10n.saving ).attr('disabled', true);

		// Serialize slider settings to prevent jQuery form converting form data
		sliderData.properties = JSON.stringify(sliderData.properties);

		// 1. Iterate over the slides and encode them
		//    to workaround PHP's array size limitation.
		//
		// 2. Iterate over the styles object of layers
		//    to remove empty values added mistakenly.
		//
		// 3. Also check whether they use dynamic content.
		//
		// 4. Generate UUIDs on save for every layer for WPML
		//    and other purposes that requires a persistent ID.
		jQuery.each(sliderData.layers, function(slideIndex, slideData) {
			slideData.properties.post_content = false;
			jQuery.each(slideData.sublayers, function(layerIndex, layerData) {

				if( layerData.styles ) {
					jQuery.each(layerData.styles, function(cssIndex, cssVal) {
						if( cssVal === '' ) {
							delete layerData.styles[cssIndex];
						}
					});
				}

				layerData.transition 	= JSON.stringify(layerData.transition);
				layerData.styles 		= JSON.stringify(layerData.styles);

				if(slideData.properties.post_content === false && layerData.media == 'post') {
					slideData.properties.post_content = true;
				}

				var uuid = RB_DataSource.uuidForLayer( layerIndex, slideIndex);
				sliderData.layers[ slideIndex ].sublayers[ layerIndex ].uuid = uuid;
			});

			if (!window.rbSaveHistory) {
				delete slideData.history;
				slideData.meta && (delete slideData.meta.undoStackIndex);
			}

			// Reverse the list of layers, as it is only
			// a visual thing on the admin UI.
			slideData.sublayers.reverse();
			sliderData.layers[slideIndex] = JSON.stringify(slideData);
		});


		// Save slider
		jQuery.ajax({
			type: 'POST', url: ajaxurl, dataType: 'text',
			data: {
				_wpnonce: jQuery('#rb-slider-form input[name="_wpnonce"]').val(),
				_wp_http_referer: jQuery('#rb-slider-form input[name="_wp_http_referer"]').val(),
				action: 'rb_save_slider',
				id: RB_sliderID,
				sliderData: sliderData
			},
			error: function(jqXHR, textStatus, errorThrown) {
				jQuery('.rb-publish').removeClass('saving').addClass('failed').find('button').text( RB_l10n.error );
				setTimeout(function() {
					alert( RB_l10n.SBSaveError.replace('%s', errorThrown ) );
				}, 100);
			},
			success: function(jqXHR, textStatus) {
				try {
					var res = JSON.parse(jqXHR);
				} catch (ex) {
					jQuery('.rb-publish').removeClass('saving').addClass('failed').find('button').text( RB_l10n.error );
					if (~jqXHR.indexOf('name="submitLogin"')) {
						alert('Your session has expired, please login to continue!');
						jQuery('#wpwrap').css({ opacity: 0.3, pointerEvents: 'none' });
						document.cookie = 'rb-login=1';
						var win = jQuery('<iframe id="rb-login">').css({
							position: 'fixed',
							top: 'calc(50vh - 310px)',
							left: 'calc(50vw - 240px)',
							width: 480,
							height: 620,
							background: '#fff',
							border: '1px solid #dfe2e5',
							boxShadow: '0 3px 16px rgba(0,0,0,0.2)',
							zIndex: 9999
						}).appendTo(document.body)[0].contentWindow;
						win.document.write(jqXHR);
						win.history.pushState('', '', location.origin+location.pathname+'?controller=AdminLogin&redirect=AdminRbSlider');
					}
				}
				if (res && res.status == 'ok') {
					// Consider the editor as "clean", do not show
					// unsaved changes warning when leaving the page.
					RB_editorIsDirty = false;

					// Button feedback
					jQuery('.rb-publish').removeClass('saving').addClass('saved').find('button').text( RB_l10n.saved );

					// Display on screen notification when save
					// was initiated by a keyboard shortcut.
					if( saveProperties.usedShortcut && typeof rbScreenOptions !== 'undefined' && rbScreenOptions.useNotifyOSD === 'true' ) {
						kmUI.notify.show({
							icon: 'dashicons-yes',
							iconColor: '#7eb917',
							text: RB_l10n.notifySliderSaved
						});
					}
				}
			},
			complete: function(data) {

				setTimeout(function() {
					jQuery('.rb-publish').removeClass('saved failed').find('button').text( RB_l10n.save ).attr('disabled', false);
					kmUI.notify.hide();
				}, 2000);
			}
		});
	},
};



var RB_InsertIcons = {

	timeout: null,

	init: function() {
		jQuery('#rb-layers').on('click', '.rb-insert-icon', function(e) {
			e.preventDefault();
			RB_InsertIcons.showIcons();
		});

		jQuery('#rb-layers').on('click', '.rb-replace-icon', function(e) {
			e.preventDefault();

			var $textarea = jQuery('.rb-sublayer-page textarea[name="html"]');
				$textarea.val('');

			RB_InsertIcons.showIcons();
		});

		jQuery(document).on('click', '#rb-insert-icons-modal-window section div', function(e) {
			e.preventDefault();
			RB_InsertIcons.insert( this );
		});

		jQuery(document).on('input change', '#rb-insert-icons-modal-window input', function(e) {
			e.preventDefault();
			RB_InsertIcons.search( jQuery(this).val() );
		});
	},


	showIcons: function() {
		kmUI.modal.open( '#tmpl-insert-icons-modal', { width: 850, height: 900, clip: false } );
	},


	search: function( term ) {

		// No search term.
		// Make sure to display everything.
		if( ! term || term.length < 2 ) {
			jQuery('#rb-insert-icons-modal-window section').show().prev().show();
			jQuery('#rb-insert-icons-modal-window section div').show();


		// Filter
		} else {

			clearTimeout( RB_InsertIcons.timeout );
			RB_InsertIcons.timeout = setTimeout(function() {
				jQuery('#rb-insert-icons-modal-window section').each(function() {
					var hasMatch = false;
					jQuery('div', this).each(function() {
						if( jQuery(this).data('help').indexOf( term ) !== -1 ) {
							hasMatch = true;
						} else {
							jQuery(this).hide();
						}
					});

					// Hide the section if there are no matches
					if( ! hasMatch ) {
						jQuery(this).hide().prev().hide();
					}
				});
			}, 200);
		}
	},


	insert: function( icon ) {

		var $icon 		= jQuery( icon ),
			text 		= '<i class="fa fa-'+$icon.data('help')+'"></i>',
			element 	= jQuery('.rb-sublayer-page textarea[name="html"]')[0];


		element.value += text;


		jQuery(element).trigger('input').trigger('change');

		RB_InsertIcons.close();
	},


	close: function() {
		setTimeout(function() {
			kmUI.popover.close();
		}, 500);
		kmUI.modal.close();
		kmUI.overlay.close();
	}

};



var RB_ButtonPresets = {

	init: function() {

		jQuery('#rb-layers').on('click', '.rb-choose-button-preset', function(e) {
			e.preventDefault();
			RB_ButtonPresets.open();
		});
	},


	open: function() {

		kmUI.modal.open( '#tmpl-button-presets', { width: 850, height: 900, clip: false } );
	},


	close: function() {
		kmUI.modal.close();
		kmUI.overlay.close();
	}
};



var RB_ImportLayer = {

	init: function() {

		jQuery(document).on('click', '.rb-import-layer-sliders .slider-item', function() {
			RB_ImportLayer.selectSlider( this );
		});

		jQuery(document).on('click', '.rb-import-layer-slides .slider-item', function() {
			RB_ImportLayer.selectSlide( this );
		});

		jQuery(document).on('click', '.rb-import-layer-layers .layer-item', function() {
			RB_ImportLayer.selectLayer( this );
		});
	},


	open: function() {
		kmUI.modal.open( '#tmpl-import-layer', { width: 900, height: 1000, clip: false } );

		setTimeout(function() {
			RB_ImportLayer.loadSliders();
		}, 300);
	},


	loadSliders: function() {

		jQuery.getJSON( ajaxurl, { action: 'rb_get_mce_sliders' }, function( data ) {

			var $target = jQuery('#tmpl-import-layer-modal-window .rb-import-layer-sliders');

			if( ! data || ! data.length ) {
				$target.html(RB_l10n.SBImportLayerNoSlider);
				return;
			}

			$target.empty();

			jQuery.each(data, function(index, item) {

				var $item = jQuery('<div class="slider-item">\
						<div class="slider-item-wrapper">\
							<div class="preview">\
								<div class="no-preview">\
									<h5>'+RB_MCE_l10n.MCENoPreview+'</h5>\
								</div>\
							</div>\
							<div class="info">\
								<div class="name"></div>\
							</div>\
						</div>\
					</div>');

				$item.data({
					'id': item.id,
					'slug': item.slug
				});

				if( item.preview ) {
					jQuery('.preview', $item).empty().css({
						'background-image': 'url('+item.preview+')'
					});
				}

				jQuery('.name', $item).html( item.name );

				$item.appendTo( $target );
			});
		});
	},


	selectSlider: function( item ) {

		var $item = jQuery(item);

		$item.addClass('selected').siblings().removeClass('selected');

		jQuery('.rb-import-layer-layers').html( RB_l10n.SBImportLayerSelectSlide );

		RB_ImportLayer.loadSlides( $item.data('id') );
	},


	loadSlides: function( sliderID ) {

		jQuery.getJSON( ajaxurl, { action: 'rb_get_mce_slides', sliderID: sliderID }, function( data ) {

			var $target = jQuery('#tmpl-import-layer-modal-window .rb-import-layer-slides');

			if( ! data || ! data.length ) {
				$target.html(RB_l10n.SBImportLayerNoSlide);
				return;
			}

			$target.empty();

			jQuery.each(data, function(index, item) {

				var $item = jQuery('<div class="slider-item">\
						<div class="slider-item-wrapper">\
							<div class="preview">\
								<div class="no-preview">\
									<h5>'+RB_MCE_l10n.MCENoPreview+'</h5>\
								</div>\
							</div>\
							<div class="info">\
								<div class="name"></div>\
							</div>\
						</div>\
					</div>');


				if( item.preview ) {
					jQuery('.preview', $item).empty().css({
						'background-image': 'url('+item.preview+')'
					});
				}

				jQuery('.name', $item).html( item.name );

				$item.appendTo( $target );
			});
		});
	},


	selectSlide: function( item ) {

		var $item = jQuery(item);

		$item.addClass('selected').siblings().removeClass('selected');

		// Get Slider ID & slide index
		var sliderID 	= jQuery('.rb-import-layer-sliders .selected').data('id');
		var slideIndex 	=jQuery('.rb-import-layer-slides .selected').index();

		RB_ImportLayer.loadLayers( sliderID, slideIndex );
	},


	loadLayers: function( sliderID, slideIndex ) {

		jQuery.getJSON( ajaxurl, { action: 'rb_get_mce_layers', sliderID: sliderID, slideIndex: slideIndex }, function( data ) {

			var $holder = jQuery('#tmpl-import-layer-modal-window .rb-import-layer-layers');

			if( ! data || ! data.length ) {
				$holder.html(RB_l10n.SBImportLayerNoLayer);
				return;
			}

			$holder.html('<table><tbody></tbody></table>');
			var $target = jQuery('#tmpl-import-layer-modal-window .rb-import-layer-layers table tbody');

			jQuery.each(data, function(index, item) {

				var $item = jQuery('<tr class="layer-item">\
						<td class="preview">\
							<i class="dashicons"></i>\
						</td>\
						<td class="type"></td>\
						<td class="name">\
							<div>\
								<span></span>\
								<i class="dashicons dashicons-yes"></i>\
							</div>\
						</td>\
					</tr>');

				$item.data('layer-data', item);


				var mediaIcons = {
					img: 'dashicons-format-image',
					icon: 'dashicons-flag',
					text: 'dashicons-text',
					button: 'dashicons-marker',
					media: 'dashicons-video-alt3',
					html: 'dashicons-editor-code',
					post: 'dashicons-admin-post'
				};

				var mediaTypes = {
					img: RB_l10n.SBLayerTypeImg,
					icon: RB_l10n.SBLayerTypeIcon,
					text: RB_l10n.SBLayerTypeText,
					button: RB_l10n.SBLayerTypeButton,
					media: RB_l10n.SBLayerTypeMedia,
					html: RB_l10n.SBLayerTypeHTML,
					post: RB_l10n.SBLayerTypePost
				};

				jQuery('.preview .dashicons', $item).addClass( mediaIcons[ item.media ] );
				jQuery('.type', $item).html( mediaTypes[ item.media ] );
				jQuery('.name span', $item).html( item.name );

				if( item.media === 'img' && item.image ) {
					jQuery('.preview', $item).html('<img src="'+item.image+'">');
				}

				$item.appendTo( $target );
			});
		});
	},


	selectLayer: function( tr ) {

		$tr = jQuery( tr );

		// Highlight row
		$tr.addClass('added');

		// Add layer
		RbSlider.addLayer( [ $tr.data('layer-data') ] );
	},


	close: function() {
		kmUI.modal.close();
		kmUI.overlay.close();
	}
};

var RB_InsertIcons = {

	timeout: null,

	init: function() {
		jQuery('#rb-layers').on('click', '.rb-insert-icon', function(e) {
			e.preventDefault();
			RB_InsertIcons.showIcons();
		});

		jQuery(document).on('click', '#rb-insert-icons-modal-window section div', function(e) {
			e.preventDefault();
			RB_InsertIcons.insert( this );
		});

		jQuery(document).on('input change', '#rb-insert-icons-modal-window input', function(e) {
			e.preventDefault();
			RB_InsertIcons.search( jQuery(this).val() );
		});
	},


	showIcons: function() {
		kmUI.modal.open( '#tmpl-insert-icons-modal', { width: 850, height: 900, clip: false } );
	},


	search: function( term ) {

		// No search term.
		// Make sure to display everything.
		if( ! term || term.length < 2 ) {
			jQuery('#rb-insert-icons-modal-window section').show().prev().show();
			jQuery('#rb-insert-icons-modal-window section div').show();


		// Filter
		} else {

			clearTimeout( RB_InsertIcons.timeout );
			RB_InsertIcons.timeout = setTimeout(function() {
				jQuery('#rb-insert-icons-modal-window section').each(function() {
					var hasMatch = false;
					jQuery('div', this).each(function() {
						if( jQuery(this).data('help').indexOf( term ) !== -1 ) {
							hasMatch = true;
						} else {
							jQuery(this).hide();
						}
					});

					// Hide the section if there are no matches
					if( ! hasMatch ) {
						jQuery(this).hide().prev().hide();
					}
				});
			}, 200);
		}
	},


	insert: function( icon ) {

		var $icon 		= jQuery( icon ),
			text 		= '<i class="fa fa-'+$icon.data('help')+'"></i>',
			element 	= jQuery('.rb-sublayer-page textarea[name="html"]')[0];


		element.value += text;
		element.focus();

		jQuery(element).trigger('input').trigger('change');

		RB_InsertIcons.close();
	},


	close: function() {

		kmUI.modal.close();
		kmUI.overlay.close();
	}

};

var RB_PostOptions = {

	init: function() {

		jQuery('#rb-layers').on('click', '.rb-configure-posts', function(e) {
			e.preventDefault(); RB_PostOptions.open(this);
		});

		jQuery('.rb-configure-posts-modal .header a').click(function(e) {
			e.preventDefault(); RB_PostOptions.close();
		});

		jQuery('#rb-post-options select:not(.rb-post-taxonomy, .post_offset)').change(function() {
			window.rbSliderData.properties[ jQuery(this).attr('name') ] = jQuery(this).val();
			RB_PostOptions.change(this);
		});

		jQuery('#rb-post-options select.offset').change(function() {
			RB_activeSlideData.properties.post_offset = jQuery(this).val();
			RbSlider.willGeneratePreview();
		});

		jQuery('#rb-post-options select.rb-post-taxonomy').change(function() {
			window.rbSliderData.properties.post_taxonomy = jQuery(this).val();
			RB_PostOptions.getTaxonoies(this);
		});

		jQuery('#rb-layers').on('click', '.rb-post-placeholders li', function() {
			RB_PostOptions.insertPlaceholder(this);
		});
	},


	open: function(el) {

		// Create overlay
		jQuery('body').prepend(jQuery('<div>', { 'class' : 'rb-overlay'}));

		// Get slide's post offset
		var offset = parseInt(RB_activeSlideData.properties.post_offset) + 1;

		// Show modal window
		var modal = jQuery('#rb-post-options').show();
			modal.find('select.offset option').prop('selected', false).eq(offset).prop('selected', true);

		// Close event
		jQuery(document).one('click', '.rb-overlay', function() {
			RB_PostOptions.close();
		});

		// First open?
		if(modal.find('.rb-post-previews ul').children().length === 0) {
			RB_PostOptions.change( modal.find('select')[0] );
		}
	},


	getTaxonoies: function(select) {

		var target = jQuery(select).next().empty();

		if(jQuery(select).val() == 0) {
			RB_PostOptions.change(select);

		} else {

			jQuery.post(ajaxurl, jQuery.param({ action : 'rb_get_taxonomies', taxonomy : jQuery(select).val() }), function(data) {
				data = jQuery.parseJSON(data);
				for(c = 0; c < data.length; c++) {
					target.append( jQuery('<option>', { 'value' : data[c].term_id, 'text' : data[c].name }));
				}
			});
		}
	},


	change: function(el) {

		// Get options
		var items = {};
		jQuery('#rb-post-options').find('select').each(function() {
			items[ jQuery(this).data('param') ] = jQuery(this).val();
		});

		jQuery.post(ajaxurl, jQuery.param({ action: 'rb_get_post_details', params : items }), function(data) {

			// Handle data
			var parsed = jQuery.parseJSON(data);
			window.rbPostsJSON = parsed;

			// Update preview
			RbSlider.willGeneratePreview();
			RB_PostOptions.update(el, parsed );
		});
	},


	update: function(el, data) {

		var preview = jQuery('#rb-post-options').find('.rb-post-previews ul').empty();

		if(data.length === 0) {
			preview.append( jQuery('<li>')
				.append( jQuery('<h4>', { 'text' : RB_l10n.SBPostFilterWarning }) )
			);

		} else {
			for(c = 0; c < data.length; c++) {
				preview.append( jQuery('<li>')
					.append( jQuery('<span>', { 'class' : 'counter', 'text' : ''+(c+1)+'. ' }))
					.append( jQuery('<img>', { 'src' : data[c].thumbnail } ))
					.append( jQuery('<h3>', { 'html' : data[c].title } ))
					.append( jQuery('<p>', { 'html' : data[c].content } ))
					.append( jQuery('<span>', { 'class' : 'author', 'text' : data[c]['date-published']+' by '+data[c].author } ))
				);
			}
		}
	},


	close: function() {
		jQuery('#rb-post-options').hide();
		jQuery('.rb-overlay').remove();
	},


	insertPlaceholder: function(el) {

		var element = jQuery(el).closest('.rb-sublayer-page').find('textarea[name="html"]')[0];
		var text = (typeof jQuery(el).data('placeholder') != "undefined") ? jQuery(el).data('placeholder') : jQuery(el).children().text();

		if (document.selection) {
			element.focus();
			var sel = document.selection.createRange();
			sel.text = text;
			element.focus();
		} else if (element.selectionStart || element.selectionStart === 0) {
			var startPos = element.selectionStart;
			var endPos = element.selectionEnd;
			var scrollTop = element.scrollTop;
			element.value = element.value.substring(0, startPos) + text + element.value.substring(endPos, element.value.length);
			element.focus();
			element.selectionStart = startPos + text.length;
			element.selectionEnd = startPos + text.length;
			element.scrollTop = scrollTop;
		} else {
			element.value += text;
			element.focus();
		}

		jQuery(element).trigger('input').trigger('change');
	}
};




var RB_PostChooser = {

	timeout: null,
	data: null,
	opened: null,

	init: function() {

		jQuery('#rb-layers').on('click', '.rb-slide-link a.post', function(e) {
			e.preventDefault();

			RB_PostChooser.opener = this;
			RB_PostChooser.open();
		});

		jQuery(document).on('click', '#rb-post-chooser-modal-window li', function(e) {
			e.preventDefault();
			RB_PostChooser.select( jQuery(this) );
		});

		jQuery(document).on('keyup', '#rb-post-chooser-modal-window input', function(e) {
			RB_PostChooser.search();

		}).on('change', '#rb-post-chooser-modal-window select', function(e) {
			RB_PostChooser.search(1);

		}).on('submit', '#rb-post-chooser-modal-window form', function(e) {
			e.preventDefault();
			RB_PostChooser.search(1);
		});
	},

	open: function() {
		kmUI.modal.open( '#tmpl-post-chooser', { width: 850, height: 900, clip: false } );
		this.search();
	},

	search: function( timeout ) {

		timeout = timeout || 300;

		clearTimeout( RB_PostChooser.timeout );
		RB_PostChooser.timeout = setTimeout(function() {
			var $form = jQuery('#rb-post-chooser-modal-window form');
			jQuery.getJSON( ajaxurl, $form.serialize(), function( data ) {

				RB_PostChooser.data = data;

				jQuery('#rb-post-chooser-modal-window .rb-post-previews ul').empty();
				jQuery.each( data, function( index, item ) {

					jQuery('<li>\
						<img src="'+item['image-url']+'">\
						<h3>'+item.title+'</h3>\
						<div>'+item.content.substr(0, 200)+'</div>\
						<span class="author">'+item['date-published']+' by '+item.author+'</span>\
					</li>').appendTo('#rb-post-chooser-modal-window .rb-post-previews ul');
				});
			});
		}, timeout);
	},

	select: function( $li ) {

		var item 	= RB_PostChooser.data[ $li.index() ],
			l10nKey = 'SBLinkText'+ucFirst(item['post-type']),
			$holder = jQuery(RB_PostChooser.opener).closest('.rb-slide-link'),
			$input 	= jQuery('input.url', $holder);

		$holder.addClass('has-link');

		$input.val( RB_l10n[l10nKey].replace('%s', item.title) )
			.trigger( 'input' )
			.trigger( 'change' )
			.prop('disabled', true)

		.next()
			.val( item['post-id'] )

		.next()
			.val( item.title )

		.next()
			.val( item['post-type'] );

		kmUI.modal.close();
		kmUI.overlay.close();
	}
};



var RB_DataSource = {

	buildSlide: function() {

		var $slide = jQuery('#rb-layers .rb-layer-box');
		var $slideOptions = $slide.find('.rb-slide-options');

		// Reset checkboxes
		$slideOptions.find('.rb-checkbox').remove();
		$slideOptions.find('input:checkbox').prop('checked', false);

		// Get default slide options
		var defaults = RB_DataSource.getDefaultSlideData();

		// Loop through slide option form items
		var $formItems = jQuery($slideOptions.find('input,textarea,select'));
		RB_DataSource.setFormItemValues($formItems, RB_activeSlideData.properties, defaults);

		// Set checboxes and color picker
		$slideOptions.find('input:checkbox').customCheckbox();
		RbSlider.addColorPicker( $slideOptions.find('.rb-colorpicker') );

		// Set image placeholders
		RB_GUI.updateImagePicker( 'background', RB_activeSlideData.properties.backgroundThumb );
		RB_GUI.updateImagePicker( 'thumbnail', RB_activeSlideData.properties.thumbnailThumb );

		this.buildLayersList();
	},


	buildLayersList: function( buildProperties ) {

		buildProperties = buildProperties || { updateLayer: true };

		// Get the layer list and empty it (if any)
		var $layersList = jQuery('#rb-layers .rb-sublayers').empty();

		// Build layers
		var numOfLayers = !RB_activeSlideData.sublayers ? 0 : RB_activeSlideData.sublayers.length;
		var $template = jQuery(jQuery('#rb-layer-item-template').html());

		for(var c = 0; c < numOfLayers; c++) {

			var layerData = RB_activeSlideData.sublayers[c];
			var $layer = $template.clone();
			$layer.find('.rb-sublayer-number').text(c+1);
			$layer.find('.rb-sublayer-title').val(layerData.subtitle);

			// Hidden layer
			if(layerData.skip) { $layer.find('.rb-icon-eye').addClass('disabled'); }

			// Locked layer
			if(layerData.locked) { $layer.find('.rb-icon-lock').removeClass('disabled'); }

			// Not visible on current screen type
			$layer[ layerData['hide_on_'+RB_activeScreenType] ? 'addClass' : 'removeClass' ]('dim');

			RbSlider.setLayerMedia( layerData.media,  jQuery('.rb-sublayer-thumb', $layer), layerData );
			$layersList.append($layer);
		}


		// Reset static layers
		jQuery('.rb-layers-list .subheader').hide();
		jQuery('.rb-static-sublayers').empty();
		jQuery('.rb-sublayer-wrapper').removeClass('has-static-layers');

		// Add static layers (if any)
		if( RB_activeStaticLayersDataSet.length ) {

			jQuery('.rb-layers-list .subheader').show();
			jQuery('.rb-sublayer-wrapper').addClass('has-static-layers');

			$template = jQuery( jQuery('#rb-static-layer-item-template').html() );
			jQuery.each(RB_activeStaticLayersDataSet, function(idx, data) {

				var layerData = data.layerData,
					$layer = $template.clone();

					$layer.find('.rb-sublayer-number').text(idx+1);
					$layer.find('.rb-sublayer-title').text(layerData.subtitle);


				RbSlider.setLayerMedia( layerData.media,  jQuery('.rb-sublayer-thumb', $layer), layerData );
				$layer.appendTo('.rb-static-sublayers');
			});
		}

		// Select first layer
		jQuery.each(RB_activeLayerIndexSet, function(index, layerIndex) {
			$layersList.children().eq( layerIndex ).addClass('active');
		});

		if( buildProperties.updateLayer ) {
			this.buildLayer();
		}
	},


	buildLayersListItem: function( layerIndex ) {

		var layerData 	= RB_activeSlideData.sublayers[ layerIndex ],
			$template 	= jQuery(jQuery('#rb-layer-item-template').html()),
			$target 	= jQuery('#rb-layers .rb-sublayers li').eq( layerIndex );
			$layer 		= $template.clone();


		$layer.find('.rb-sublayer-number').text(layerIndex+1);
		$layer.find('.rb-sublayer-title').val(layerData.subtitle);

		// Hidden layer
		if(layerData.skip) { $layer.find('.rb-icon-eye').addClass('disabled'); }

		// Locked layer
		if(layerData.locked) { $layer.find('.rb-icon-lock').removeClass('disabled'); }

		// Not visible on current screen type
		$layer[ layerData['hide_on_'+RB_activeScreenType] ? 'addClass' : 'removeClass' ]('dim');

		// Active?
		if( RB_activeLayerIndexSet[0] === $target.index() ) {
			$layer.addClass('active');
		}

		RbSlider.setLayerMedia( layerData.media,  jQuery('.rb-sublayer-thumb', $layer), layerData );
		$target.replaceWith( $layer );
	},


	buildLayer: function() {

		// Bail out early if there's no layers on slide
		if( !RB_activeLayerDataSet.length ||
			!RB_activeSlideData.sublayers.length) {
				return false;
		}

		// Find active layer
		var $layerItem 	= jQuery('#rb-layers .rb-sublayers li.active'),
			$layer 		= jQuery('.rb-sublayer-pages'),
			layerIndex 	= RB_activeLayerIndexSet[0],
			layerData 	= RB_activeLayerDataSet[0];

		// Empty earlier layers and add new
		jQuery('.rb-sublayer-pages').empty();
		jQuery('.rb-sublayer-pages').html( jQuery('#rb-layer-template').html() );

		RbSlider.updateLayerInterfaceItems(layerIndex);

		// Reset checkboxes
		// $layer.find('.rb-checkbox').remove();
		// $layer.find('input:checkbox:not(.noreset)').prop('checked', false);

		var $formItems = jQuery('input,textarea,select', $layer).filter(':not(.auto,.sublayerprop)'),
			$styleItems = jQuery('input,textarea,select', $layer).filter('.auto'),
			$transitionItems = jQuery('input,textarea,select', $layer).filter('.sublayerprop');

		RB_DataSource.setFormItemValues($formItems, layerData);
		RB_DataSource.setFormItemValues($styleItems, layerData.styles);
		jQuery('.rb-border-padding input').each(function() {
			RbSlider.updateLayerBorderPadding( this );
		});

		// Backwards compatibility: put transitions settings into
		// the 'transition' object within the layer data
		if( ! layerData.transition || jQuery.isEmptyObject(layerData.transition) ) {
			this.restoreOldTransitionSettings( $transitionItems );
		}

		RB_DataSource.setFormItemValues($transitionItems, layerData.transition);
		RbSlider.updateLayerAttributes( layerData );


		// Set image placeholder
		RB_GUI.updateImagePicker('image', layerData.imageThumb );
		RB_GUI.updateImagePicker('poster', layerData.posterThumb );

		// Set static layer chooser
		RbSlider.setupStaticLayersChooser( $layer.find('.rb-sublayer-options select[name="static"]')[0] );


		// Init custom interface plugins
		$layer.find(':checkbox:not(.noreplace)').customCheckbox();
		RbSlider.addColorPicker( $layer.find('.rb-colorpicker') );
		RbSlider.changeLayerScreenType();
		RbSlider.changeVideoType();

		jQuery('#rb-layer-transitions section .rb-h-button input').each(function() {
			var $input 		= jQuery(this),
				$section 	= $input.closest('section'),
				index 		= $section.index(),
				$target 	= jQuery('#rb-transition-selector-table td:not(.rb-padding)');

			if( $input.prop('checked') && layerData.transition[ $input.attr('name') ] !== false ) {
				$target.eq( index ).addClass('active');

			} else if( $input.prop('checked') ) {
				$input.prop('checked', false);
				$input.next().removeClass('on');
			}
		});
		jQuery('#rb-transition-selector-table td:not(.rb-padding)').eq(RB_activeLayerTransitionTab).click();
		RbSlider.checkForOpeningTransition();

		// Select lastly viewed subpage
		RbSlider.selectLayerPage(RB_activeLayerPageIndex);

		if( RB_activeLayerIndexSet.length > 1 ) {
			RbSlider.startMultipleSelection();
		}
	},

	setFormItemValues: function($items, values, defaults) {

		// Bail out early if no value was specified
		if( ! $items || ! values || jQuery.isEmptyObject( values ) ) { return false; }

		// Iterate over items
		for(var itemIndex = 0; itemIndex < $items.length; itemIndex++) {

			var $item = jQuery($items[itemIndex]),
				value = values[ $item.attr('name') ];

			if( ! $item.attr('name') ) { continue; }

			if( ! value && value !== false ) {
				if( typeof defaults == 'undefined' ) {
					continue;
				}

				value = defaults[$item.attr('name')];
			}

			// Checkboxes
			if($item.is(':checkbox')) {
				$item.prop('checked', Boolean(value)).data('value', Boolean(value));

			// Input, textarea
			} else if($item.is('input,textarea')) {
				$item.val(value).data('value', value);

			// Select
			} else if($item.is('select')) {
				$item.children().prop('selected', false);
				$item.children('[value="'+value+'"]').prop('selected', true);
				$item.data('value', value);
			}
		}
	},


	readSliderSettings: function() {

		// Return previously stored data whenever it's possible
		if( !jQuery.isEmptyObject(RB_defaultSliderData) ) {
			return RB_defaultSliderData;
		}

		var settings = {};
		jQuery('.rb-slider-settings').find('input,textarea,select').each(function() {

			var item = jQuery(this),
				prop = item.attr('name'),
				 val = item.is(':checkbox') ? item.prop('checked') : item.val();

			if(prop && val !== false) { settings[ prop ] = val; }
		});

		return settings;
	},


	parseSliderSetting: function() {

		var settings = window.rbSliderData.properties,
			key,
			val;

		for( key in settings ) {

			switch( settings[key] ) {
				case 'on':
				case 'true':
					settings[key] = true;
					break;

				case 'off':
				case 'false':
					settings[key] = false;
					break;
			}
		}
	},


	getDefaultSlideData: function() {

		// Return previously stored data whenever it's possible
		if( ! jQuery.isEmptyObject(RB_defaultSlideData)) {
			return RB_defaultSlideData;
		}

		// Get slide template
		var $template = jQuery( jQuery('#rb-slide-template').text() );

		// Iterate over form items and add their values to RB_defaultSlideData
		jQuery('.rb-slide-options', $template).find('input, textarea, select').each(function() {

			var item = jQuery(this),
				prop = item.attr('name'),
				val  = item.is(':checkbox') ? item.prop('checked') : item.val();

			if( prop ) { RB_defaultSlideData[ prop ] = val; }
		});

		return RB_defaultSlideData;
	},


	getDefaultLayerData: function() {

		// Build the default data object if there's no
		// stored copy yet
		if( jQuery.isEmptyObject( RB_defaultLayerData ) ) {

			var $template 	= jQuery( jQuery('#rb-layer-template').text() ),
				$inputs 	= jQuery();

			// Transition and style options will be stored in a sub-object
			RB_defaultLayerData.transition = {};
			RB_defaultLayerData.styles = {};

			$template.each(function() {

				var $this = jQuery(this);

				if( $this.hasClass('rb-sublayer-options') ) {
					jQuery('section .toggle', this).filter(':checkbox:checked').each(function() {
						$inputs = $inputs.add( jQuery('input, textarea, select', jQuery(this).closest('section') ) );
					});
				} else {
					 $inputs =  $inputs.add( jQuery('input, textarea, select', $this) );
				}
			});

			// Iterate over form items and add their values to RB_defaultLayerData
			$inputs.each(function() {

				var item 	= jQuery(this),
					prop 	= item.attr('name'),
					val 	= item.is(':checkbox') ? item.prop('checked') : item.val();

				if( prop ) {

					if( item.hasClass('sublayerprop') ) {
						RB_defaultLayerData.transition[prop] = val;

					} else if( item.hasClass('auto') ) {
						if( val !== '' ) {
							RB_defaultLayerData.styles[prop] = val;
						}

					} else {
						RB_defaultLayerData[prop] = val;
					}
				}
			});
		}

		// Make sure to always override the layer title in the stored copy
		// to avoid name collisions and weird behaviors.
		var layerCount 	= RB_activeSlideData.sublayers ? RB_activeSlideData.sublayers.length : 0,
			layerName 	= RB_l10n.SBLayerTitle.replace('%d', layerCount+1);

		RB_defaultLayerData.subtitle = layerName;

		return RB_defaultLayerData;
	},


	uuidForSlide: function( slideIndex ) {

		slideIndex = slideIndex || RB_activeSlideIndex;
		return this.uuidForObject(
			window.rbSliderData.layers[slideIndex].properties
		);
	},


	slideForUUID: function( uuid ) {

		var slideIndex;

		jQuery.each(window.rbSliderData.layers, function(index, slide) {
			if( slide.properties.uuid && slide.properties.uuid == uuid ) {
				slideIndex = index;
				return false;
			}
		});

		return slideIndex;
	},


	uuidForLayer: function( layerIndex, slideIndex ) {

		if( typeof layerIndex === 'undefined' ) {
			layerIndex = RB_activeLayerIndexSet[0];
		}

		if( typeof slideIndex === 'undefined' ) {
			slideIndex = RB_activeSlideIndex;
		}


		var slideData = window.rbSliderData.layers[ slideIndex ];

		return this.uuidForObject( slideData.sublayers[ layerIndex ] );
	},


	layerForUUID: function( uuid ) {

	},


	uuidForObject: function( data ) {

		if( ! data.uuid || ! data.uuid.length ) {
			data.uuid = this.generateUUID();
		}

		return data.uuid;
	},


	generateUUID: function() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
			return v.toString(16);
		});
	},


	// Backwards compatibility: put transitions settings into
	// the 'transition' object within the layer data
	restoreOldTransitionSettings: function($inputs) {

		// Get transition option names
		var options = [];
		for(var i=0;typeof($inputs[i])!='undefined';options.push($inputs[i++].getAttribute('name')));

		jQuery.each(window.rbSliderData.layers, function(slideKey, slideData) {
			jQuery.each(slideData.sublayers, function(layerKey, layerData) {
				for(var l = 0; l < options.length; l++) {
					if(layerData[ options[l] ]) {
						layerData.transition[ options[l] ] = layerData[ options[l] ];
						delete layerData[ options[l] ];
					}
				}
			});
		});
	}
};


var initSliderBuilder = function() {

	jQuery('.km-tabs').kmTabs();

	// Set the DB ID of currently editing slider
	if( ! RB_sliderID ) {
		RB_sliderID = jQuery('#rb-slider-form input[name="slider_id"]').val();
	}

	RB_previewArea 		= jQuery('#rb-preview-layers');
	RB_previewHolder 	= RB_previewArea.parent();
	RB_previewWrapper 	= RB_previewHolder.parent();


	// Set a small delay to prevent unintentional
	// dragging operations when a user clicks on
	// tabs or Preview items
	jQuery.ui.draggable.prototype.options.distance = 3;
	jQuery.ui.sortable.prototype.options.distance = 3;


	// Add default slide data to data source if it's a new slider
	if(window.rbSliderData.properties.new) {
		window.rbSliderData.properties = RB_DataSource.readSliderSettings();
		window.rbSliderData.properties.createdWith = jQuery('input[name="sliderVersion"]').val();
		window.rbSliderData.layers = [{
			properties: jQuery.extend(true, {}, RB_DataSource.getDefaultSlideData()),
			sublayers: []
		}];

	// Extend existing slider data with defaults,
	// so we can guarantee that new options added in
	// future updates will always be present in the
	// data source object.
	} else {
		window.rbSliderData.properties = jQuery.extend( {},
			RB_DataSource.readSliderSettings(),
			window.rbSliderData.properties
		);
	}

	// Set callbacks
	var callbacks = window.rbSliderData.callbacks;
	jQuery('.rb-callback-box textarea:not([readonly])').each(function() {

		var $textarea 	= jQuery(this),
			name 		= $textarea.attr('name'),
			useData 	= $textarea.data('event-data');

		if( callbacks && callbacks[name] ) {
			$textarea.val( RB_Utils.stripslashes( callbacks[name] ) );
		}
	});

	RB_GUI.updateImagePicker( 'yourlogo', 'useCurrent' );
	RB_GUI.updateImagePicker( 'backgroundimage', 'useCurrent' );
	RB_GUI.updateImagePicker( 'preview', 'useCurrent' );
	RbSlider.selectSlide(RB_activeSlideIndex, { forceSelect: true });


	// URL rewrite after creating slider
	if( history.replaceState ) {
		if(document.location.href.indexOf('&showsettings=1') != -1) {
			var url = document.location.href.replace('&showsettings=1', '');
			history.replaceState(null, document.title, url);
		}
	}


	// Show "unsaved changes" warning
	jQuery( window ).on('beforeunload', function(e) {

		if( RB_editorIsDirty ) {
			var dialogText = RB_l10n.SBUnsavedChanges;
			e.returnValue = dialogText;
			return dialogText;
		}
	});


	// Main tab bar page select
	jQuery('#rb-main-nav-bar a:not(.unselectable)').click(function(e) {

		RbSlider.selectMainTab( this );

		if( jQuery(this).hasClass('layers') ) {
			$ruler.trigger('resize.rbRuler');
			RbSlider.generatePreview();
			RbSlider.updatePreviewSelection();
		}
	});

	// Settings sidebar
	jQuery('ul.rb-settings-sidebar > li').click(function() {
		RbSlider.selectSettingsTab(this);
	});

	// Deeplink Slider Settings
	if( document.location.hash ) { RB_GUI.deeplinkSection(); }
	jQuery(window).on('hashchange', function() {
		RB_GUI.deeplinkSection();
	});

	// Settings: checkboxes
	jQuery('.rb-settings :checkbox, .rb-layer-box :checkbox:not(.noreplace)').customCheckbox();

	// Settings: datepicker
	var datePickerInterval = 0,
		datepicker = jQuery('.rb-settings .rb-datepicker-input').datepicker({
		inline: true,
		classes: 'rb-datepicker',
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		timeFormat: 'hh:ii:00',
		todayButton: new Date(),
		clearButton: true,
		timepicker: true,
		keyboardNav: false,
		range: false,

		onSelect: function(formattedDate, date, inst) {
			inst.$el.prev().fadeOut(200);
			inst.$el.trigger('input');
		}

	}).on('input', function() {
		var $this 	= jQuery(this);
			val 	= jQuery.trim( $this.val() );

			$this.prev().fadeOut(200);

		clearTimeout(datePickerInterval);
		datePickerInterval = setTimeout(function() {

			if( val.length > 2 && ! val.match(/^\d{4}-\d{2}-\d{2}/) ) {
				jQuery.getJSON( ajaxurl, { action: 'rb_parse_date', date: val }, function(data) {
					if( ! data.errorCount && data.dateStr != '' ) {
						$this.prev().fadeIn(200).removeClass('error').children('span').text( data.dateStr );
					} else {
						$this.prev().fadeIn(200).addClass('error').children('span').text( RB_l10n.SBInvalidFormat );
					}
				});
			}
		}, 1000);

	}).each(function() {

		var $this 	= jQuery(this),
			key 	= jQuery(this).data('schedule-key');

		if( parseInt(window.rbSliderData.properties[ key ]) ) {
			startDate = new Date( window.rbSliderData.properties[ key ] * 1000 );
			$this.data('datepicker').selectDate( startDate );
			$this.trigger('keyup');
		}

	});


	// Settings: Popup Presets
	jQuery('.rb-settings-popup').on('click', '#tmpl-popup-presets-button', function(e) {
		e.preventDefault();
		kmUI.modal.open( '#tmpl-popup-presets-window', { width: 850, height: 900 } );


	// Settings: Popup Include Pages
	}).on('click', '.rb-popup-include-all-pages', function() {
		var $switch 	= jQuery(this),
			$targets 	= jQuery('.rb-popup-include-pages span:not(:first-child), .rb-popup-include-custom-pages');

		if( $switch.hasClass('on') ) {
			$targets.removeClass('rb-hidden');
		} else {
			$targets.addClass('rb-hidden');
		}
	// Settings: Popup Preview
	}).on('click', '.rb-popup-preview-button', function(e) {
		e.preventDefault();
		RbSlider.startPopupPreview({}, this);

	// Settings: Popup Position
	}).on('click', '.rb-popup-position td', function(e) {

		var $td 	= jQuery(this),
			$table 	= $td.closest('table'),
			moves 	= $td.data('move').split(' ');

		// Update UI
		$table.find('td').removeClass('active');
		$td.addClass('active');

		// Update settings
		jQuery('input[name="popupPositionVertical"]').val( moves[0] );
		jQuery('input[name="popupPositionHorizontal"]').val( moves[1] );
		window.rbSliderData.properties.popupPositionVertical = moves[0];
		window.rbSliderData.properties.popupPositionHorizontal = moves[1];

		// Update preview
		RbSlider.updatePopupPreview();

	}).on('click', '.rb-popup-fit-width, .rb-popup-fit-height', function() {
		setTimeout(function() {
			RbSlider.updatePopupPreview();
		}, 100);

	}).on('input change', '.rb-popup-triggers :input', function() {
		setTimeout(function() {
			RbSlider.updatePopupNotifications();
		}, 100);
	});

	if( jQuery('.rb-popup-include-all-pages').hasClass('on') ) {
		jQuery('.rb-popup-include-pages span:not(:first-child), .rb-popup-include-custom-pages').addClass('rb-hidden');
	}

	RbSlider.updatePopupPositionGrid();
	RbSlider.updatePopupPreview();


	// Settings: Popup presets
	jQuery(document).on('click', '#rb-popup-presets-modal-window .rb-layout-illustration-grid', function() {
		var $item 		= jQuery(this),
			$options 	= jQuery('.rb-settings-popup :input'),
			data 		= $item.data('options');


		if( typeof data === 'string' ) {
			data = JSON.parse( data );
		}

		for( var key in data ) {
			window.rbSliderData.properties[ key ] = data[key];
			var $input = $options.filter('[name="'+key+'"]');

			// Handle checkboxes
			if( typeof data[key] === 'boolean' ) {
				if( data[key] != $input.prop('checked') ) {
					$input.next().click();
				}
			} else {
				$input.val( data[key] );
			}
		}

		// Update settings
		RbSlider.updatePopupPositionGrid();
		RbSlider.updatePopupPreview();

		// Close modal
		kmUI.modal.close();
		kmUI.overlay.close();
	});

	// Uploads
	RbSlider.openMediaLibrary();

	// Clear uploaded image button
	jQuery(document).on({
		mouseenter: function() {
			if( jQuery(this).hasClass('has-image') ) {
				jQuery(this).addClass('hover');
			}
		},
		mouseleave: function() {
			jQuery(this).removeClass('hover');
		}
	}, '.rb-image');


	jQuery(document).on('click', '.rb-image a.aviary', function(e) {

		e.preventDefault();
		e.stopPropagation();

		// Set ID on the currently editing image
		var $parent = jQuery(this).parent(),
			$image 	= $parent.find('img').attr('id', 'cc-current-image'),
			imageURL;

		// Prevent popover to become visible after opening the editor
		jQuery('body').addClass('hidepopover');

		// Find image URL
		if( $parent.hasClass('rb-slide-image') ) {
			imageURL = RB_activeSlideData.properties.background;
		} else if( $parent.hasClass('rb-slide-thumbnail') ) {
			imageURL = RB_activeSlideData.properties.thumbnail;
		} else if( $parent.hasClass('rb-layer-image') ) {
			imageURL = RB_activeLayerDataSet[0].image;
		} else if( $parent.hasClass('rb-media-image') ) {
			imageURL = RB_activeLayerDataSet[0].poster;
		}

		// Load editor
		featherEditor.launch({
			image: 'cc-current-image',
			url: RB_Utils.toAbsoluteURL( imageURL )
		});
	});

	// Clear uploads
	jQuery(document).on('click', '.rb-image .dashicons-dismiss', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var $parent = jQuery(this).parent();

		$parent.removeClass('hover');
		$parent.prev().val('').prev().val('');
		RB_GUI.updateImagePicker( $parent, '' );

		// Global background
		if($parent.hasClass('rb-global-background')) {
			window.rbSliderData.properties.backgroundimage = '';
			window.rbSliderData.properties.backgroundimageId = '';
			window.rbSliderData.properties.backgroundimageThumb = '';

		} else if($parent.hasClass('rb-yourlogo-upload')) {
			window.rbSliderData.properties.yourlogo = '';
			window.rbSliderData.properties.yourlogoId = '';
			window.rbSliderData.properties.yourlogoThumb = '';

		} else if($parent.hasClass('rb-slider-preview')) {

			window.rbSliderData.meta.preview = '';
			window.rbSliderData.meta.previewId = '';

		} else if($parent.hasClass('rb-slide-image')) {

			RB_UndoManager.add('slide.general', RB_l10n.SBUndoRemoveSlideImage, {
				itemIndex: RB_activeSlideIndex,
				undo: {
					background: RB_activeSlideData.properties.background,
					backgroundId: RB_activeSlideData.properties.backgroundId,
					backgroundThumb: RB_activeSlideData.properties.backgroundThumb
				},
				redo: {
					background: '',
					backgroundId: '',
					backgroundThumb: ''
				}
			});

			RB_activeSlideData.properties.background = '';
			RB_activeSlideData.properties.backgroundId = '';
			RB_activeSlideData.properties.backgroundThumb = '';


		} else if($parent.hasClass('rb-slide-thumbnail')) {
			RB_activeSlideData.properties.thumbnail = '';
			RB_activeSlideData.properties.thumbnailId = '';
			RB_activeSlideData.properties.thumbnailThumb = '';

		} else if($parent.hasClass('rb-layer-image')) {

			RB_UndoManager.add('layer.general', RB_l10n.SBUndoRemoveLayerImage, {
				itemIndex: RB_activeLayerIndexSet[0],
				undo: {
					image: RB_activeLayerDataSet[0].image,
					imageId: RB_activeLayerDataSet[0].imageId,
					imageThumb: RB_activeLayerDataSet[0].imageThumb
				},
				redo: {
					image: '',
					imageId: '',
					imageThumb: ''
				}
			});

			RB_activeLayerDataSet[0].image = '';
			RB_activeLayerDataSet[0].imageId = '';
			RB_activeLayerDataSet[0].imageThumb = '';
			jQuery('.rb-sublayers li').eq(RB_activeLayerIndexSet[0])
				.find('.rb-sublayer-thumb').addClass('dashicons dashicons-format-image')
				.find('img').remove();


		} else if($parent.hasClass('rb-media-image')) {

			RB_UndoManager.add('layer.general', RB_l10n.SBUndoRemoveVideoPoster, {
				itemIndex: RB_activeLayerIndexSet[0],
				undo: {
					poster: RB_activeLayerDataSet[0].poster,
					posterId: RB_activeLayerDataSet[0].posterId,
					posterThumb: RB_activeLayerDataSet[0].posterThumb
				},
				redo: {
					poster: '',
					posterId: '',
					posterThumb: ''
				}
			});

			RB_activeLayerDataSet[0].poster = '';
			RB_activeLayerDataSet[0].posterId = '';
			RB_activeLayerDataSet[0].posterThumb = '';
		}


		RbSlider.generatePreview();

	}).on('click', '.rb-timeline-switch li', function(e) {
		e.preventDefault();

		// Bail out early if it's the active menu item
		if( jQuery(this).hasClass('active') ) { return false; }

		var $item = jQuery(this),
			$layerList = jQuery('.rb-sublayers');

		// Toogle switch
		$item.addClass('active').siblings().removeClass('active');

		if( $item.index() == 1 ){
			jQuery('.rb-layers-table').hide().next().show();
			jQuery('.rb-add-sublayer').hide();

			RbSlider.startSlidePreview({
				autoStart: false,
				pauseLayers: true,
				plugins: [{
					namespace: 'timeline',
					js: 'timeline/RbSlider.timeline.js',
					css: 'timeline/RbSlider.timeline.css',
					settings: {
						showLayersInfo: true
					}
				}]
			});


		} else {
			jQuery('.rb-layers-table').show().next().hide();
			jQuery('.rb-add-sublayer').show();

			RbSlider.stopSlidePreview();
		}


	// Select layer type
	}).on('click', '.rb-layer-types li', function() {
		RbSlider.addFormattedLayer( this );

	}).on('click', '.rb-context-add-layer li', function() {
		RbSlider.addFormattedLayer( this, {
			styles: {
				top: RB_contextMenuTop / RB_previewZoom,
				left: RB_contextMenuLeft / RB_previewZoom
			}
		});

	}).on('click', '.rb-context-menu-duplicate', function() {
		RbSlider.duplicateLayer();

	}).on('click', '.rb-context-menu-remove', function() {
		RbSlider.removeLayer();

	}).on('click', '.rb-context-menu-hide', function() {
		RbSlider.hideLayer();

	}).on('click', '.rb-context-menu-lock', function() {
		RbSlider.lockLayer();

	}).on('click', '.rb-context-menu-copy-styles', function() {
		RbSlider.copyLayerSettings( jQuery('.rb-sublayer-style .rb-h-actions .copy') );

	}).on('click', '.rb-context-menu-paste-styles', function() {
		RbSlider.pasteLayerSettings( jQuery('.rb-sublayer-style .rb-h-actions .paste') );

	}).on('click', '.rb-context-menu-copy-layer', function() {
		RbSlider.copyLayer( );

	}).on('click', '.rb-context-menu-paste-layer', function() {
		RbSlider.pasteLayer( );
	});


	// Settings: store any form element change in  data source
	jQuery('.rb-slider-settings').on('input change click', 'input,textarea,select', function(event) {

		// Bail out early if there was a click event
		// fired on a non-checkbox form item
		if(event.type === 'click') {
			if( !jQuery(this).is(':checkbox') ) {
				return false;
			}
		}

		// Get option data
		var item = jQuery(this),
			prop = item.attr('name'),
			val  = item.is(':checkbox') ? item.prop('checked') : item.val();

		if( prop === 'width' || prop === 'height' ) {

			if( val && ! val.toString().match(/^\d+$/) ) {
				val = parseInt(val) || '';
				item.val( val );
			}
		}

		// Set new setting
		window.rbSliderData.properties[ prop ] = val;

		// Mark unsaved changes on page
		RB_editorIsDirty = true;

		// Update preview
		if(item.is('select, :checkbox')) {
			RbSlider.generatePreview();
		} else {
			RbSlider.willGeneratePreview();
		}
	});

	// Settings: init slider size chooser
	jQuery('.rb-slider-dimensions').on('click', 'div', function(e) {

		var $this 	= jQuery(this),
			type 	= $this.data('type');

		$this.siblings('input[type="hidden"]').val( type );
		$this.addClass('active').siblings().removeClass('active');

		// Reset rows
		jQuery('.rb-settings-contents .rb-popup-hide').show();
		jQuery('.full-width-row, .full-size-row, .popup-row', jQuery('.rb-settings-contents')).hide();

		switch( type ) {
			case 'fullwidth':
				jQuery('.rb-settings-contents .full-width-row').css('display', 'table-row');
				break;

			case 'fullsize':
				jQuery('.rb-settings-contents .full-size-row').css('display', 'table-row');
				break;

			case 'popup':
				jQuery('.rb-settings-contents .rb-popup-hide').hide();
				jQuery('.rb-settings-contents .popup-row').css('display', 'table-row');
				break;
		}

		// Update data source & reload preview
		window.rbSliderData.properties.type = type;
		RbSlider.updatePopupNotifications();
		RbSlider.generatePreview();
	});

	jQuery('.rb-slider-dimensions div[data-type="'+window.rbSliderData.properties.type+'"]').click();

	jQuery('#container-height').on('change', function() {
		jQuery('#slider-height').val(this.value).change();
	});

	// Settings: reset button
	jQuery(document).on('click', '.rb-reset', function() {

		// Empty field
		jQuery(this).prev().val('');

		// Generate preview
		RbSlider.generatePreview();
	});


	// Callbacks: store any form element change in  data source
	jQuery('.rb-callback-page').on('updated.rb', 'textarea:not([readonly])', function( event, cm ) {

		if( typeof window.rbSliderData.callbacks !== 'object' ) {
			window.rbSliderData.callbacks = {};
		}


		var key 	= jQuery(this).attr('name'),
			val 	= jQuery(this).val(),
			test 	= val.match(/\{([\s\S]*)\}/m)[1].replace(/(\r\n|\n|\r)/gm, '');

		if( jQuery.trim( test ).length ) {
			window.rbSliderData.callbacks[ key ] = val;
		} else {
			delete window.rbSliderData.callbacks[ key ];
		}
	});


	// Add slide
	jQuery('#rb-add-layer').click(function(e) {
		e.preventDefault(); RbSlider.addSlide();
	});

	// Select slide
	jQuery('#rb-layer-tabs').on('click', 'a:not(.unsortable)', function(e) {
		e.preventDefault();
		if( ! jQuery(this).hasClass('active ') ) {
			RbSlider.selectSlide( jQuery(this).index(), { forceSelect: true } );
		}

	// Rename slide
	}).on('dblclick', 'a:not(.unsortable)', function(e) {
		e.preventDefault(); RbSlider.renameSlide(this);
	});

	// Duplicate slide
	jQuery('#rb-layers').on('click', 'button.rb-layer-duplicate', function(e){
		e.preventDefault(); e.stopPropagation();
		RbSlider.duplicateSlide(this);
	});

	// Initialize floating layout
	jQuery( document ).on( 'click', '#menu-set-float', function( e ){

		e.preventDefault();

		jQuery( '#rb-layers-settings-popout' ).removeClass( 'rb-layers-settings-normal' ).addClass( 'rb-layers-settings-floating' ).draggable({
			handle: '#rb-layers-settings-popout-handler',
			containment: '#rb-slider-form',
			scroll: false
		}).resizable({
			minHeight: 450,
			minWidth: 350,
			maxWidth: 1500,
			create: function(){
				kmUI.smartResize.set();
			},
			resize: function(){
				kmUI.smartResize.set();
			}
		});

		jQuery( '#rb-layers-settings-popout-handler' ).trigger( 'mouseenter' );
		jQuery( '.rb-preview-wrapper' ).addClass( 'rb-forceto-left' );

	}).on( 'click', '#menu-set-putback', function( e ){

		e.preventDefault();

		jQuery( '#rb-layers-settings-popout' )
			.addClass( 'rb-layers-settings-normal' )
			.removeClass( 'rb-layers-settings-floating' )
			.draggable( 'destroy' )
			.resizable( 'destroy' );

		jQuery( '.rb-preview-wrapper' ).removeClass( 'rb-forceto-left' );

		kmUI.smartResize.set();
	});

	// Enter URL
	jQuery('#rb-layers').on('click', '.rb-url-prompt', function(e){
		e.preventDefault();

		var url = prompt( RB_l10n.SBEnterImageURL );
		if( ! url ) { return false; }

		var $el 	= jQuery(this),
			$target = $el.parent().prev();

		// Slide image
		if($target.hasClass('rb-slide-image')) {
			RB_activeSlideData.properties.background = url;
			RB_activeSlideData.properties.backgroundId = '';
			RB_activeSlideData.properties.backgroundThumb = url;

		// Slide thumbnail
		} else if($target.hasClass('rb-slide-thumbnail')) {
			RB_activeSlideData.properties.thumbnail = url;
			RB_activeSlideData.properties.thumbnailId = '';
			RB_activeSlideData.properties.thumbnailThumb = url;

		// Image layer
		} else if($target.hasClass('rb-layer-image')) {
			RB_activeLayerDataSet[0].image = url;
			RB_activeLayerDataSet[0].imageId = '';
			RB_activeLayerDataSet[0].imageThumb = url;

		// Media image
		} else if($target.hasClass('rb-media-image')) {
			RB_activeLayerDataSet[0].poster = url;
			RB_activeLayerDataSet[0].posterId = '';
			RB_activeLayerDataSet[0].posterThumb = url;
		}

		RB_GUI.updateImagePicker( $target, url );
		RbSlider.generatePreview();
	}).on('click', '.rb-capture-slide', function( event ) {
		event.preventDefault();

		if( typeof rbScreenOptions !== 'undefined' && rbScreenOptions.useNotifyOSD === 'true' ) {

			kmUI.notify.show({
				icon: 'dashicons-camera',
				iconColor: '#f9a241',
				text: RB_l10n.notifyCaptureSlide
			});
		}

		// Hide preview selection and live slide UI elements
		RbSlider.hidePreviewSelection();
		jQuery('.rb-gui-element:visible').addClass('rb-hidden');

		// html2canvas freezes the browser completely,
		// not even animations will occur. Using setTimeout
		// to first render user feedback, then start the capture.
		setTimeout(function() {

			var $target = RbSlider.isSlidePreviewActive ? jQuery('.rb-real-time-preview') : jQuery('#rb-preview-layers');

			html2canvas( $target[0], {
				// backgroundColor: null,
				scale: 0.5

			}).then(function( canvas ) {

				// Restore preview selection and slider UI elements
				RbSlider.showPreviewSelection();
				jQuery('.rb-gui-element.rb-hidden').removeClass('rb-hidden');

				var imgName = 'rb-slider-'+RB_sliderID+'-slide-'+(RB_activeSlideIndex+1)+'.png',
					imgData = canvas.toDataURL( 'image/jpeg', 0.92 ),
					imgBlob = RB_Utils.dataURItoBlob( imgData, 'image/jpeg' );
					imgBlob.lastModifiedDate = new Date();
					imgBlob.name = imgName;
					imgBlob.filename = imgName;

				RbSlider.uploadImageToMediaLibrary(imgBlob, function(data) {

					// Save to data store
					RB_activeSlideData.properties.thumbnail = data.url;
					RB_activeSlideData.properties.thumbnailId = data.id;
					RB_activeSlideData.properties.thumbnailThumb = data.url;

					// Update UI
					RB_GUI.updateImagePicker( 'thumbnail',  data.url );

					kmUI.notify.hide();
				});
			});

		}, 1000);
	});

	// Slide options: input, textarea, select
	jQuery('#rb-layers').on('keyup change click', '.rb-slide-options input, .rb-slide-options textarea, .rb-slide-options select', function(event) {

		// Bail out early if there was a click event
		// fired on a non-checkbox form item
		if(event.type === 'click') {
			if( !jQuery(this).is(':checkbox') ) {
				return false;
			}
		}

		var item = jQuery(this),
			prop = item.attr('name'),
			val  = item.is(':checkbox') ? item.prop('checked') : item.val();

		RB_activeSlideData.properties[prop] = val;

		// Update preview when setting properties
		// related to the background image
		var updateKeys = [
			'bgsize', 'bgposition', 'bgcolor'
		];

		if( updateKeys.indexOf(prop) !== -1 ) {
			RbSlider.generatePreview();
		}
	});

	// Open Transition gallery
	jQuery('#rb-layers').on('click', '.rb-select-transitions', function(e) {
		e.preventDefault();
		RbSlider.openTransitionGallery();
	});

	// Origami banner
	jQuery(document).on('click', '#tryorigami', function() {
		jQuery('#transitionmenu li:last').click();

	// Enable/disable special effects
	}).on('click', '#rb-transition-window .rb-select-special-transition', function(e) {

		var $item = jQuery(this),
			checked;

		// Turn off
		if( $item.hasClass('on') ) {
			$item.removeClass('on').addClass('off');
			checked = false;

		// Turn on
		} else {
			$item.removeClass('off').addClass('on');
			checked = true;
		}

		RB_activeSlideData.properties[ $item.data('name') ] = checked;

	// Add/Remove layer transitions
	}).on('click', '#rb-transitions-list section .tr-item', function(e) {
		e.preventDefault();
		RbSlider.toggleTransition(this);

	// Select/Deselect all transitions
	}).on('click', '#rb-transition-window header i:last', function(e) {
		var check = jQuery(this).hasClass('off') ? true : false;
		jQuery('#rb-transitions-list section.active').each(function() {
			RbSlider.selectAllTransition( jQuery(this).index(), check );
		});

	// Apply on others
	}).on('click', '#rb-transition-window header i:not(:last)', function(e) {

		// Confirmation
		if( ! confirm( RB_l10n.SBTransitionApplyOthers ) ) {
			return false;
		}

		// Dim color briefly
		var button = jQuery(this);
		button.css('opacity', '.5');
		setTimeout(function() {
			button.css('opacity', '1');
		}, 2000);

		// Apply to other slides
		jQuery.each(window.rbSliderData.layers, function(slideIndex, slideData) {
			slideData.properties['3d_transitions'] 		= RB_activeSlideData.properties['3d_transitions'];
			slideData.properties['2d_transitions'] 		= RB_activeSlideData.properties['2d_transitions'];
			slideData.properties.custom_3d_transitions 	= RB_activeSlideData.properties.custom_3d_transitions;
			slideData.properties.custom_2d_transitions 	= RB_activeSlideData.properties.custom_2d_transitions;
			slideData.properties.transitionorigami 		= RB_activeSlideData.properties.transitionorigami;
		});

	}).on('click', '#rb-more-slide-options', function() {
		RbSlider.toggleAdvancedSlideOptions( this );

	// Show/Hide transition
	}).on('mouseenter', '#rb-transitions-list section .tr-item', function() {
		rbShowTransition( this );

	}).on('mouseleave', '#rb-transitions-list section .tr-item', function() {
		rbHideTransition( this );
	});



	// Remove layer
	jQuery('#rb-layer-tabs').on('click', 'a span:last-child', function(e) {
		e.preventDefault();
		e.stopPropagation();
		RbSlider.removeSlide(this);
	});

	// Add layer
	jQuery('#rb-layers').on('click', '.rb-add-sublayer', function(e) {
		e.preventDefault();

		// Show pointer and append overlay
		jQuery('.rb-layer-types').show().animate({ marginTop : 15, opacity : 1 }, 150);
		jQuery('<div>', { 'class' : 'rb-overlay dim'}).insertAfter('.rb-layer-types');

		// RbSlider.addLayer(null, null, {
		//     selectLayer: true,
		//     selectPage: 0
		// });


	// Close add layer modal
	}).on('click', '.rb-overlay.dim', function() {

		jQuery(this).remove();
		jQuery('.rb-layer-types').animate({ marginTop : 40, opacity : 0 }, 150, function() {
			jQuery(this).hide();
		});


	// Select layer
	}).on('click', '.rb-sublayers li', function( event ) {

		// Range Select
		if( event.shiftKey && RB_activeLayerDataSet.length === 1 ) {

			var val1 	= RB_lastSelectedLayerIndex || RB_activeLayerIndexSet[0],
				val2 	= jQuery(this).index(),

				start 	= Math.min(val1, val2),
				end 	= Math.max(val1, val2),

				indexes = [];

			for(var i = start; i <= end; i++) {
				indexes.push(i);
			}

			RbSlider.selectLayer( indexes );

		// Manual select
		} else {
			RbSlider.selectPreviewItem( jQuery(this).index(), event );
		}


	}).on('keyup', 'input[name="subtitle"]', function() {
		var index = jQuery(this).closest('li').index();
		RB_activeSlideData.sublayers[index].subtitle = jQuery(this).val();

	// Layer pages
	}).on('click', '.rb-sublayer-nav a', function(e) {
		e.preventDefault(); RbSlider.selectLayerPage( jQuery(this).index() );

	// Remove layer
	}).on('click', '.rb-sublayers a.remove', function(e) {
		e.preventDefault(); e.stopPropagation();
		RbSlider.removeLayer( jQuery(this).closest('li').index() );

	// Duplicate layer
	}).on('click', '.rb-sublayers a.duplicate', function(e) {
		e.preventDefault(); e.stopPropagation();
		RbSlider.duplicateLayer();

	}).on('click', '.rb-set-screen-types button', function(e) {
		e.preventDefault();
		RbSlider.changeLayerScreenType( jQuery(this), true );

	// Layer media type
	}).on('click', '.rb-layer-kind li:not(:first-child)', function(e) {
		e.preventDefault();
		var $item = jQuery(this);

		if( !$item.hasClass('active') ) {

			RB_UndoManager.add('layer.general', RB_l10n.SBUndoLayerMedia, {
				itemIndex: RB_activeLayerIndexSet[0],
				undo: { media: RB_activeLayerDataSet[0].media },
				redo: { media: $item.data('section') }
			});

			RbSlider.selectMediaType(this);
			RbSlider.generatePreviewItem( RB_activeLayerIndexSet[0] );

			jQuery('.rb-layer-kind').removeClass('hover');
		}

	}).on('mouseenter', '.rb-layer-kind', function() {
		jQuery(this).addClass('hover');

	// Layer element type
	}).on('click', '.rb-sublayer-element > li', function(e) {
		e.preventDefault();
		var $item = jQuery(this);

		RB_UndoManager.add('layer.general', RB_l10n.SBUndoLayerType, {
			itemIndex: RB_activeLayerIndexSet[0],
			undo: { type: RB_activeLayerDataSet[0].type },
			redo: { type: $item.data('element') }
		});

		RbSlider.selectElementType(this);
		RbSlider.generatePreviewItem( RB_activeLayerIndexSet[0] );

	// Layer options: input, textarea, select
	}).on('input change click', '.rb-sublayer-pages input, .rb-sublayer-pages textarea, .rb-sublayer-pages select', function(event) {

		// Ignore events triggered by UndoManager
		if(event.UndoManagerAction) { return false; }

		// Bail out early if there was a click event
		// fired on a non-checkbox form item
		if(event.type === 'click' && ! jQuery(this).is(':checkbox')) {
			return false;
		}

		// Prevent triggering the change event
		// on non-select form items
		if(event.type === 'change' && ! jQuery(this).is('select')) {
			return false;
		}

		var $item 	= jQuery(this),
			prop 	= $item.attr('name'),
			val  	= $item.is(':checkbox') ? $item.prop('checked') : $item.val();

		// Boolean conversion
		if( val === 'true' ) { val = true; }
		if( val === 'false' ) { val = false; }

		jQuery.each(RB_activeLayerDataSet, function(index, layerData) {

			var layerIndex 	= RB_activeLayerIndexSet[ index ],
				area 		= layerData;

			if($item.hasClass('sublayerprop') ) { area = area.transition; }
				else if($item.hasClass('auto') ) { area = area.styles; }

			// Null values indicate empty option.
			// We should remove them entirely from data source.
			if( val === null || val === 'null' || val === '' ) {
				delete area[ prop ];
			} else {
				area[ prop ] = val;
			}

			RbSlider.generatePreviewItem( layerIndex );
		});



		if( $item.closest('.rb-sublayer-style').length ) {
			RbSlider.updatePreviewSelection();
		}

		if( RB_activeLayerDataSet.length === 1 ) {

			// Check if media embed code contains autoplay setting
			if( prop === 'html' &&  RB_activeLayerDataSet[0].media === 'media' ) {
				RbSlider.checkMediaAutoPlay( $item, prop, val );
			}

			// Restart layer preview
			if( RbSlider.isLayerPreviewActive  ){
				RbSlider.startLayerPreview( jQuery('.rb-layer-preview-button') );
			}
		}

		// startAt
		var $li = $item.closest('.start-at-wrapper'),
			$ul = $li.parent();

		if( $li.length && ! $item.is('.start-at-calc') ) {

			var timing 	= jQuery('.start-at-timing', $ul).val(),
				operator 	= jQuery('.start-at-operator', $ul).val(),
				value 		= jQuery('.start-at-value', $ul).val(),
				$calcInput 	= jQuery('.start-at-calc', $ul);

			$calcInput.data('prevVal', $calcInput.val() );
			setTimeout(function() {
				$calcInput.val( timing +' '+ operator +' '+ value).trigger('input');
				RB_UndoManager.trackInputs( null, $calcInput );
			}, 100);
		}

	}).on('change', '.rb-sublayer-basic input.bgvideo', function( event ) {
		RbSlider.changeVideoType(event );

	}).on('input', '.rb-sublayer-style textarea.style', function() {
		RbSlider.validateCustomCSS( jQuery(this) );

	// Active transition sections
	}).on('click', '#rb-transition-selector-table td:not(.rb-padding)', function(event) {
		RbSlider.selectTransitionPage( this );

	}).on('change', '#rb-transition-selector', function(event) {
		jQuery( '#rb-transition-selector-table td:not(.rb-padding)' ).eq( jQuery(this).val() ).click();

	}).on('change', '#rb-layer-transitions .rb-h-button input', function(event) {
		RbSlider.enableTransitionPage( this );

	}).on('click', '#rb-layer-transitions .overlay', function(event) {
		var $this 		= jQuery(this),
			$section 	= $this.closest('section'),
			$checkbox 	= $section.find('.rb-h-button .rb-checkbox.toggle');

			if( $checkbox.hasClass('off') ) {

				if( $checkbox.data( 'tl' ) ){
					$checkbox.data( 'tl' ).progress(1).kill();
				}

				var tl = new TimelineMax();

				tl.to( $checkbox[0], 0.12, {
					yoyo: true,
					repeat: 3,
					ease: Quad.easeInOut,
					scale: 1.5,
					backgroundColor: '#ff1d1d'
				});

				$checkbox.data( 'tl', tl );
			}

	// Copy transition settings
	}).on('click', '.rb-h-actions .copy', function(event) {
		event.preventDefault();
		event.stopPropagation();
		RbSlider.copyLayerSettings(this);

	// Paste transition settings
	}).on('click', '.rb-h-actions .paste', function(event) {
		event.preventDefault();
		event.stopPropagation();
		RbSlider.pasteLayerSettings(this);
		jQuery('.rb-border-padding input').each(function() {
			RbSlider.updateLayerBorderPadding( this );
		});

	// Static select
	}).on('mouseenter', '.rb-sublayer-options select[name="static"]', function() {
		RbSlider.setupStaticLayersChooser( this );

	}).on('keyup', '.rb-sublayer-custom-attributes tr:last-child input', function() {

		if( jQuery(this).val() ) {
			var $tr = jQuery(this).closest('tr').removeClass('rb-hidden');
			$tr.clone().insertAfter( $tr ).find('input').val('');
		}

	}).on('keyup change', '.rb-sublayer-custom-attributes tr:not(:last-child) input', function( event ) {
		RbSlider.setLayerAttributes(event, this);

	}).on('input', '.rb-border-padding input', function() {
		RbSlider.updateLayerBorderPadding( this );




	// Pick static layer
	}).on('change', '.rb-sublayer-options select[name="static"]', function() {

		var $select = jQuery(this),
			value 	= $select.val(),
			index 	= parseInt( jQuery(this).val() ),
			uuid;

		if( value === 'null' || value === null || index === 0  ) {
			delete RB_activeLayerDataSet[0].transition.static;
			delete RB_activeLayerDataSet[0].transition.staticUUID;
			return;
		}

		if(index && index > 0) {
			uuid = RB_DataSource.uuidForSlide( index - 1 );
			RB_activeLayerDataSet[0].transition.staticUUID = uuid;
		}



	// Pick transformOrigin
	}).on('click', '#rb-layer-transitions .dashicons-search:not(.active)', function(event) {
		event.stopPropagation();

		var $this = jQuery(this).addClass('active'),
			$origin = $this.next(),
			$picker = jQuery('<div>').addClass('rb-origin-picker').appendTo('.rb-preview-wrapper');

		$picker.on('click', function(e) {

			var o = $picker.offset();
				x = e.pageX - o.left,
				y = e.pageY - o.top,
				$layer = RB_previewItems[ RB_activeLayerIndexSet[0] ],
				p = $layer.position(),
				ox = (x - p.left) / ( $layer.outerWidth() * RB_previewZoom ),
				oy = (y - p.top) / ( $layer.outerHeight() * RB_previewZoom ),

			$origin.val([
				Math.round(ox * 1000) / 10 + '%',
				Math.round(oy * 1000) / 10 + '%',
				$origin.val().split(/\s+/)[2] || ''
			].join(' ').trim());

			$origin.trigger('input');
		});

		jQuery(document).one('click', function() {
			jQuery('.rb-origin-picker').remove();
			jQuery('.dashicons-search.active').removeClass('active');
		});

		var origin = $origin.attr('name');
		jQuery.each(RB_previewItems, function(i, $sl) {

			var layerTransition = RB_activeSlideData.sublayers[i].transition;

			if( layerTransition && layerTransition[origin] ) {

				var o = layerTransition[origin].split(/\s+/),
					$layer = RB_previewItems[ RB_activeLayerIndexSet[0] ];

				if( o.length > 1 ) {

					var x = o[0] == 'left' ? '0' : (o[0] == 'right' ? '100%' : o[0]),
						y = o[1] == 'top' ? '0' : (o[1] == 'bottom' ? '100%' : o[1]),
						p = $sl.position();

					x = x.indexOf('%') < 0 ? parseInt(x) : parseFloat(x) / 100 * $sl.outerWidth();
					y = y.indexOf('%') < 0 ? parseInt(y) : parseFloat(y) / 100 * $sl.outerHeight();

					if ( ! isNaN( x ) && ! isNaN( y ) ) {
						jQuery('<div>')
							.addClass('rb-origin-point' + ($sl.is( $layer ) ? ' rb-origin-active' : ''))
							.css({
								left: p.left + (x * RB_previewZoom),
								top: p.top + (y * RB_previewZoom)
							}).appendTo($picker);
					}
				}
			}
		});
	});



	if( typeof Aviary !== 'undefined' ){
		var featherEditor = new Aviary.Feather({
			apiKey: '5cf23f4b299d4953bd257b881c8f37d7',
			maxSize: 3000,
			tools: ['enhance', 'effects', 'frames', 'overlays', 'orientation', 'crop', 'resize', 'lighting', 'color', 'sharpness', 'focus', 'vignette', 'blemish', 'whiten', 'redeye', 'draw', 'colorsplash', 'text'],
			fileFormat: 'png',

			onClose: function( isDirty ) {
				jQuery('#cc-current-image').removeAttr('id');
			},

			onSaveButtonClicked: function( imageID ) {
				featherEditor.showWaitIndicator();

				var $image 	= jQuery('#'+imageID).removeAttr('id');
					$parent = $image.closest('.rb-image'),

					imgName = 'aviary_'+Date.now()+'.png',
					imgData = jQuery('#avpw_canvas_element')[0].toDataURL(),
					imgBlob = RB_Utils.dataURItoBlob(imgData);
					imgBlob.lastModifiedDate = new Date();
					imgBlob.name = imgName;
					imgBlob.filename = imgName;

				RbSlider.uploadImageToMediaLibrary(imgBlob, function(data) {
					$image.attr('src', data.url);

					if( $parent.hasClass('rb-slide-image') ) {

						// Add action to UndoManager
						RB_UndoManager.add('slide.general', RB_l10n.SBUndoSlideImage, {
							itemIndex: RB_activeSlideIndex,
							undo: {
								background: RB_activeSlideData.properties.background,
								backgroundId: RB_activeSlideData.properties.backgroundId,
								backgroundThumb: RB_activeSlideData.properties.backgroundThumb
							},
							redo: {
								background: data.url,
								backgroundId: data.id,
								backgroundThumb: data.url
							}
						});

						RB_activeSlideData.properties.background = data.url;
						RB_activeSlideData.properties.backgroundId = data.id;
						RB_activeSlideData.properties.backgroundThumb = data.url;

						RbSlider.generatePreview();

					} else if( $parent.hasClass('rb-slide-thumbnail') ) {

						RB_activeSlideData.properties.thumbnail = data.url;
						RB_activeSlideData.properties.thumbnailId = data.id;
						RB_activeSlideData.properties.thumbnailThumb = data.url;


					} else if( $parent.hasClass('rb-layer-image') ) {

						// Add action to UndoManager
						RB_UndoManager.add('layer.general', RB_l10n.SBUndoLayerImage, {
							itemIndex: RB_activeLayerIndexSet[0],
							undo: {
								image: RB_activeLayerDataSet[0].image,
								imageId: RB_activeLayerDataSet[0].imageId,
								imageThumb: RB_activeLayerDataSet[0].imageThumb
							},
							redo: {
								image: data.url,
								imageId: data.id,
								imageThumb: data.url
							}
						});

						RB_activeLayerDataSet[0].image = data.url;
						RB_activeLayerDataSet[0].imageId = data.id;
						RB_activeLayerDataSet[0].imageThumb = data.url;

						RbSlider.generatePreviewItem( RB_activeLayerIndexSet[0] );


					} else if( $parent.hasClass('rb-media-image') ) {

						// Add action to UndoManager
						RB_UndoManager.add('layer.general', RB_l10n.SBUndoVideoPoster, {
							itemIndex: RB_activeLayerIndexSet[0],
							undo: {
								poster: RB_activeLayerDataSet[0].poster,
								posterId: RB_activeLayerDataSet[0].posterId,
								posterThumb: RB_activeLayerDataSet[0].posterThumb
							},
							redo: {
								poster: data.url,
								posterId: data.id,
								posterThumb: data.url
							}
						});

						RB_activeLayerDataSet[0].poster = data.url;
						RB_activeLayerDataSet[0].posterId = data.id;
						RB_activeLayerDataSet[0].posterThumb = data.url;
					}

					featherEditor.hideWaitIndicator();
					featherEditor.close();
				});

				return false;
			}
		});
	}

	// Sublayer: sortables, draggable, etc
	RbSlider.addSlideSortables();
	RbSlider.addLayerSortables();
	RbSlider.addDraggable();


	// Slide(r) Preview
	jQuery('#rb-layers').on('click', '.rb-preview-button', function(e) {
		e.preventDefault();
		RbSlider.startSlidePreview();
	});

	// Animate Layer
	jQuery('#rb-layers').on('click', '.rb-layer-preview-button', function(e) {
		e.preventDefault(); RbSlider.startLayerPreview(this, true);
	});


	// List intersecting preview items when right clicking on them
	RB_previewWrapper.on('contextmenu',function(e) {
		e.preventDefault(); RbSlider.contextMenu(e);
	});

	// Don't drag locked layers
	RB_previewArea.on('dragstart', '.disabled,.transformed', function(e) {
		e.preventDefault();

	}).on('dblclick', '> :not(.disabled,:input)', function() {
		RbSlider.editLayerStart( jQuery(this) );


	}).on('keydown', '.rb-editing', function(event) {
		RbSlider.editLayer(event);


	}).on('keyup', '.rb-editing', function() {
		RbSlider.editLayerUpdate(this);


	}).on('paste', '.rb-editing', function(event) {
		RbSlider.editLayerPaste(event);

	});

	// Highlight preview item when hovering the intersecting layers list
	jQuery(document).on({
		mouseenter: function() { RbSlider.highlightPreviewItem(this); },
		mouseleave: function() { RB_previewArea.children().removeClass('highlighted lowlighted'); },
		}, '.rb-context-overlapping-layers li'
	);

	// Select layer from intersecting layers list
	jQuery(document).on('click', '.rb-context-overlapping-layers li', function(event) {
		var layerIndex = jQuery(this).data('layerIndex');
		RbSlider.selectPreviewItem( layerIndex, event );
	});


	// Highlight dropable zone
	jQuery(document).on('dragover.rb', '.rb-preview-wrapper', function(e) {
		e.preventDefault();
		jQuery(this).addClass('rb-dragover');
	}).on('dragleave.rb drop.rb', '.rb-preview-wrapper', function(e) {
		e.preventDefault();
		jQuery(this).removeClass('rb-dragover');
	});

	// Handle dropped images
	jQuery('#rb-pages').on('drop.rb', '.rb-preview', function(event) {
		RbSlider.handleDroppedImages(event);
	});


	// Handle alignment buttons
	jQuery('#slider-editor-toolbar').on('click', '#rb-layer-alignment td', function(event) {

		var $selection 	= jQuery('.ui-selected-helper'),
			moves 		= jQuery(this).data('move').split(' '),
			selTop 		= $selection.position().top,
			selLeft 	= $selection.position().left,
			selWidth 	= $selection.width(),
			selHeight 	= $selection.height(),
			areaWidth 	= RB_previewArea.width() * RB_previewZoom,
			areaHeight 	= RB_previewArea.height() * RB_previewZoom,
			updateInfo 	= [],
			diffTop, diffLeft, x, xp, y, yp;

			// Reposition, calc diff
			for(var c = 0; c < moves.length; c++) {
				switch(moves[c]) {
					case 'left': 	x = 0; xp = '0%'; break;
					case 'center': 	x = areaWidth / 2 - selWidth / 2; xp = '50%'; break;
					case 'right': 	x = areaWidth - selWidth; xp = '100%'; break;

					case 'top': 	y = 0; yp = '0%'; break;
					case 'middle': 	y = areaHeight / 2 - selHeight / 2; yp = '50%'; break;
					case 'bottom': 	y = areaHeight - selHeight; yp = '100%'; break;
				}
			}

		diffTop 	= selTop  - y;
		diffLeft 	= selLeft - x;


		jQuery.each(RB_activeLayerIndexSet, function(idx, layerIndex) {

			// Get layer data
			var layerData = RB_activeSlideData.sublayers[layerIndex];

			// Bail out early if it's a locked layer
			if( layerData.locked ) { return false; }

			// Get preview item, current position & direction
			var $previewItem = RB_previewItems[layerIndex],
				position = $previewItem.position(),
				left = Math.round( (position.left - diffLeft) / RB_previewZoom ).toString(),
				top = Math.round( (position.top - diffTop) / RB_previewZoom ).toString();

			// Use percents when only one layer is selected
			if( RB_activeLayerIndexSet.length === 1 ) {
				left = xp;
				top = yp;
			}


			// Maintain history
			updateInfo.push({
				itemIndex: layerIndex,
				undo: { left: layerData.styles.left, top: layerData.styles.top },
				redo: { left: left, top: top }
			});

			// Set new value
			layerData.styles.left = left;
			layerData.styles.top = top;
			jQuery('.rb-sublayer-pages input[name=left]').val(left);
			jQuery('.rb-sublayer-pages input[name=top]').val(top);

			RbSlider.generatePreviewItem(layerIndex);
		});

		// Maintain history
		RbSlider.updatePreviewSelection();
		RB_UndoManager.add('layer.style', RB_l10n.SBUndoAlignLayer, updateInfo);

	}).on('click', '.rb-editor-layouts button', function(e) {
		e.preventDefault();

		RB_activeScreenType = jQuery(this).data('type');
		jQuery(this).addClass('playing').siblings().removeClass('playing');

		RB_DataSource.buildLayersList();

		if( RbSlider.isLayerPreviewActive ) {
			RbSlider.stopLayerPreview( true );
		}

		if( RbSlider.isSlidePreviewActive ) {
			RbSlider.stopSlidePreview();
			RbSlider.startSlidePreview();
		}

		RbSlider.generatePreview();
	});



	// GLOBAL SHORTCUTS
	var keyTimeout = null, oldX = {}, oldY = {},
		slidesItem = jQuery('#rb-main-nav-bar .layers');

	jQuery(document).on('keydown', function(e) {

		if( typeof rbScreenOptions !== 'undefined' && rbScreenOptions.useKeyboardShortcuts === 'false' ) {
			return;
		}

		if( ~ location.href.indexOf('AdminRbSliderRevisions') ) {
			return;
		}

		// Save slider when pressing Ctrl/Cmd + S
		if( (e.metaKey || e.ctrlKey) && e.which == 83 ) {
			if( ! e.altKey ) {
				e.preventDefault();
				RbSlider.save({ usedShortcut: true });
				return;
			}
		}

		// Disable keyboard shortcuts while the
		// main builder interface is not visible.
		if( ! slidesItem.length || ! slidesItem.hasClass('active') ) {
			return true;
		}

		var $target = jQuery(e.target);

		if(e.which == 13) {

			// Blur input fields when pressing enter
			if($target.is(':input:not(textarea)')) {
				e.preventDefault();
				e.target.blur();
				return;

			// Toggle layer editing
			} else if( !$target.is(':input') && !e.metaKey && !e.ctrlKey && !e.altKey ) {
				e.preventDefault();
				RbSlider.editLayerToggle();
				return;
			}
		}

		// Disable keyboard shortcuts while editing
		// a layer with the 'contenteditable' attribute.
		if(jQuery('.rb-editing').length) {
			return;
		}


		// Toggle layer preview with Shift/Alt/Ctrl + space bar
		if( (e.shiftKey || e.altKey || e.ctrlKey) && e.which == 32 && !jQuery(e.target).is(':input') ) {
			e.preventDefault();
			return jQuery('.rb-layer-preview-button').click();
		}


		// Toggle slide preview with the space bar
		if(e.which == 32 && !jQuery(e.target).is(':input')) {
			e.preventDefault();
			return jQuery('.rb-preview-button').click();
		}

		// Disable the other keyboard shortcuts while in preview mode
		if( RbSlider.isSlidePreviewActive || RbSlider.isLayerPreviewActive ) {
			return;
		}


		// Redo on Ctrl/Cmd + Shift + Z
		// or Ctrl/Cmd + Y
		if( ((e.metaKey || e.ctrlKey) && e.shiftKey && e.which == 90) ||
			((e.metaKey || e.ctrlKey) && e.which == 89) ) {
			if( !jQuery(e.target).is(':input') ) {
				e.preventDefault();
				return RB_UndoManager.redo();
			}
		}


		// Undo on Ctrl/Cmd + Z
		if( (e.metaKey || e.ctrlKey) && e.which == 90 ) {
			if( !jQuery(e.target).is(':input') ) {
				e.preventDefault();
				return RB_UndoManager.undo();
			}
		}


		// Remove selected layer when pressing del/backspace
		if(e.which == 8 || e.which == 46) {
			if( !jQuery(e.target).is(':input') ) {
				e.preventDefault();
				RbSlider.removeLayer();
				return;
			}
		}

		// Duplicate layer when pressing Ctrl/Cmd + D
		if( (e.metaKey || e.ctrlKey) && e.which == 68 ) {
			e.preventDefault();
			RbSlider.duplicateLayer();
			return;
		}

		// Cut layer when pressing Ctrl/Cmd + X
		if( (e.metaKey || e.ctrlKey) && e.which == 88 ) {
			if( !jQuery(e.target).is(':input') ) {
				e.preventDefault();
				RbSlider.copyLayer(true, RB_activeLayerDataSet, RB_activeLayerIndexSet, { shiftLayers: false });
				RbSlider.removeLayer(null, { requireConfirmation: false });
				return;
			}
		}

		// Copy layer when pressing Ctrl/Cmd + C
		if( (e.metaKey || e.ctrlKey) && e.which == 67 ) {

			// Copy only if there's no text selection
			if( ! document.getSelection().toString() ) {
				if( ! jQuery(e.target).is(':input') ) {
					e.preventDefault();
					RbSlider.copyLayer(true);
					return;
				}

			// Remove selection after copying text on page,
			// so future copy events on layers will be uninterrupted.
			} else {
				setTimeout(function() {
					RB_Utils.removeTextSelection();
				}, 300);
			}
		}

		// Paste layer when pressing Ctrl/Cmd + V
		if( (e.metaKey || e.ctrlKey) && e.which == 86 ) {
			if( !jQuery(e.target).is(':input') ) {
				e.preventDefault();
				RbSlider.pasteLayer();
				return;
			}
		}


		// Move layers in preview with arrow buttons
		if( [37,38,39,40].indexOf(e.which) !== -1 ) {
			if( ! jQuery(e.target).is(':input') ) {
				e.preventDefault();

				var updateInfo = [];

				jQuery.each(RB_activeLayerIndexSet, function(idx, layerIndex) {
					var layerData 	= RB_activeSlideData.sublayers[layerIndex],
						previewItem = RB_previewItems[layerIndex];

					if(layerData.locked ) { return true; }

					var x = Math.round( parseInt(layerData.styles.left) ),
						y = Math.round( parseInt(layerData.styles.top) );

					if( layerData.styles.left.indexOf('%') !== -1 || layerData.styles.top.indexOf('%') !== -1 ) {
						var positions = RbSlider.setPositions(previewItem, layerData.styles.top, layerData.styles.left, true);
						x = positions.left;
						y = positions.top;
					}

					if( ! oldX[layerIndex] ) { oldX[layerIndex] = x; }
					if( ! oldY[layerIndex] ) { oldY[layerIndex] = y; }

					var left = 0, top = 0;
					switch(e.which) {
						case 37: left--; break; // left
						case 38: top--;  break; // up
						case 39: left++;  break; // right
						case 40: top++;  break; // down
					}

					// Move horizontally
					if(left) {
						e.preventDefault();
						x += (e.shiftKey || e.altKey) ? left*10 : left;

						layerData.styles.left = x+'px';
						previewItem.css('left', x+'px');
						jQuery('.rb-sublayer-pages input[name=left]').val(x + 'px');
					}

					// Move vertically
					if(top) {
						e.preventDefault();
						y += (e.shiftKey || e.altKey) ? top*10 : top;

						layerData.styles.top = y+'px';
						previewItem.css('top', y+'px');
						jQuery('.rb-sublayer-pages input[name=top]').val(y + 'px');
					}

					updateInfo.push({
						itemIndex: layerIndex,
						undo: { left: oldX[layerIndex]+'px', top: oldY[layerIndex]+'px'},
						redo: { left: x+'px', top: y+'px'},
					});
				});

				clearTimeout(keyTimeout);
				keyTimeout = setTimeout(function() {
					RB_UndoManager.add('layer.style', RB_l10n.SBUndoLayerPosition, updateInfo.reverse());
					oldX = {}; oldY = {};
				}, 1000);

				RbSlider.updatePreviewSelection();
			}
		}
	});


	// Save changes
	jQuery('#rb-slider-form').submit(function(e) {
		e.preventDefault();
		RbSlider.save(this);
	});

	// Add color picker
	RbSlider.addColorPicker( jQuery('.rb-slider-settings input.rb-colorpicker') );


	// Show color picker on focus
	jQuery('.color').focus(function() {
		jQuery(this).next().slideDown();

	// Hide color picker on blur
	}).blur(function() {
		jQuery(this).next().slideUp();
	});

	// Jump to original layer
	jQuery('.rb-static-sublayers').on('click', '.rb-icon-jump', function(e) {
		e.preventDefault();
		e.stopPropagation();
		RbSlider.revealStaticLayer( this );
	});


	// Eye icon for layers
	jQuery('.rb-sublayers').on('click', '.rb-icon-eye', function(e) {
		e.stopPropagation();
		RbSlider.hideLayer(this);


	// Lock icon for layers
	}).on('click', '.rb-icon-lock', function(e) {
		e.stopPropagation();
		RbSlider.lockLayer(this);


	// Collapse layer before sorting
	}).on('mousedown', '.rb-sublayer-sortable-handle', function(){
		jQuery(this).closest('.rb-sublayers').addClass('dragging');


	// Expand layer after sorting
	}).on('mouseup', '.rb-sublayer-sortable-handle', function(){
		jQuery('#rb-layers .rb-layer-box.active .rb-sublayer-sortable').removeClass('dragging');
	});

	RB_PostOptions.init();
	RB_PostChooser.init();
	RB_InsertIcons.init();
	// RB_ButtonPresets.init();
	RB_ImportLayer.init();

	// Transitions gallery
	jQuery(document).on('click', '#transitionmenu ul li', function() {

		// Update navigation
		jQuery(this).siblings().removeClass('active');
		jQuery(this).addClass('active');

		// Update view
		jQuery('#rb-transitions-list section').removeClass('active');
		jQuery('#rb-transitions-list section').eq( jQuery(this).index() ).addClass('active');

		// Show the select all / deselect all button
		jQuery('#transitionmenu i:last-child').show();

		// Custom transitions
		if(jQuery(this).index() == 2) {
			jQuery('#rb-transitions-list section').eq(3).addClass('active');

		// Special effects
		} else if(jQuery(this).index() == 3) {
			jQuery('#rb-transitions-list section').eq(3).removeClass('active');
			jQuery('#rb-transitions-list section').eq(4).addClass('active');
			jQuery('#transitionmenu i:last-child').hide();
		}

		// Update 'Select all' button
		var trs = jQuery('#rb-transitions-list section.active').find('.tr-item');

		if(trs.filter('.added').length == trs.length) {
			jQuery('#rb-transition-window header i:last').attr('class', 'on').text( RB_l10n.deselectAll );
		} else {
			jQuery('#rb-transition-window header i:last').attr('class', 'off').text( RB_l10n.selectAll );
		}
	});

	// Link slide to post url
	jQuery('#rb-layers').on('click', '.rb-slide-link a.dyn', function(e) {
		e.preventDefault();

		var $holder = jQuery(this).closest('.rb-slide-link'),
			$input 	= jQuery('input.url', $holder);

		$input
			.val('[url]')
			.trigger('input')
			.trigger('change');

		// !!!!!!!! TODO: LATER

		// Add action to UndoManager
		// RB_UndoManager.add('slide.general', RB_l10n.SBUndoSlideImage, {
		// 	itemIndex: RB_activeSlideIndex,
		// 	undo: {
		// 		background: RB_activeSlideData.properties.background,
		// 		backgroundId: RB_activeSlideData.properties.backgroundId,
		// 		backgroundThumb: RB_activeSlideData.properties.backgroundThumb
		// 	},
		// 	redo: {
		// 		background: attachment.url,
		// 		backgroundId: attachment.id,
		// 		backgroundThumb: previewImg
		// 	}
		// });


		RB_GUI.updateLinkPicker( $input );


	// Empty linking field
	}).on('click', '.rb-slide-link a.change', function(e) {
		e.preventDefault();
		var $parent = jQuery(this).closest('.rb-slide-link');

		$parent.removeClass('has-link');

		$parent
			.find('input[type="text"]')
			.val('')
			.prop('disabled', false)
			.trigger('input')
			.trigger('change');

		$parent
			.find('input[type="hidden"]')
			.val('');
	});


	// Use post image as slide background
	jQuery('#rb-layers').on('click', '.slide-image .rb-post-image', function(e) {
		e.preventDefault();

		var imageHolder = jQuery(this).closest('.slide-image').find('.rb-image');

		// Slide image
		if( imageHolder.hasClass('rb-slide-image') ) {
			RB_activeSlideData.properties.background = '[image-url]';
			RB_activeSlideData.properties.backgroundId = '';
			RB_activeSlideData.properties.backgroundThumb = '';

			// Reset image field, generatePreview() will populate them
			// with the actual content (if any)
			RB_GUI.updateImagePicker( 'background', false );

		// Layer image
		} else if( imageHolder.hasClass('rb-layer-image') ) {
			RB_activeLayerDataSet[0].image = '[image-url]';
			RB_activeLayerDataSet[0].imageId = '';
			RB_activeLayerDataSet[0].imageThumb = '';

			// Reset image field, generatePreview() will populate them
			// with the actual content (if any)
			RB_GUI.updateImagePicker( 'image', false );
			jQuery('.rb-sublayers li').eq(RB_activeLayerIndexSet[0])
				.find('.rb-sublayer-thumb').addClass('dashicons dashicons-format-image')
				.find('img').remove();
		}

		RbSlider.generatePreview();
	});


	RB_DataSource.buildSlide();
	RbSlider.addPreviewSlider( jQuery('#rb-layers .rb-editor-slider'), 1 );
	RbSlider.generatePreview();

	var $ruler = jQuery('.rb-preview-td').rbRuler();

	// Undo
	jQuery('#rb-layers').on('click', '.rb-editor-undo:not(.disabled)', function() {
		RB_UndoManager.undo();

	// Redo
	}).on('click', '.rb-editor-redo:not(.disabled)', function() {
		RB_UndoManager.redo();

	// UndoManager track options
	}).on('click focus change', 'select, input, textarea', function(event) {
		RB_UndoManager.trackInputs( event, this );

	});

	$lasso = jQuery('<div>').resizable({
		handles: 'all'

	// keep aspect ratio when resize layer at corner
	}).on('mousedown.rb', '.ui-resizable-handle', function(e){
		if( e.which == 1 ){
			$lasso.data('ui-resizable')._aspectRatio = !!this.className.match(/-se|-sw|-ne|-nw/);
		}


	// store selected layers size & position
	}).on('resizestart.rb', function( event, ui ){

		var uiPos = ui.helper.position();

		ui.originalPosition.top = uiPos.top;
		ui.originalPosition.left = uiPos.left;

		jQuery('.rb-preview .ui-selected').each(function() {
			var $layer 	= jQuery(this),
				pos 	= $layer.position();

			$layer.data('originalPosition', {
				top: pos.top / RB_previewZoom,
				left: pos.left / RB_previewZoom
			}).data('originalSize', {
				width: $layer.outerWidth(),
				height: $layer.outerHeight(),
				fontSize: parseInt($layer.css('fontSize')),
				lineHeight: $layer.css('lineHeight').indexOf('px') !== -1 ? parseInt( $layer.css('lineHeight') ) : false
			});
		});


	// update selected layers size & position
	}).on('resize.rb', function(e, ui){
		RbSlider.resizing(e, ui);

	}).on('resizestop.rb', function(e, ui) {

		var updateInfo 	= [];
		RbSlider.resizing(e, ui);

		// Remove directio data from $lasso
		$lasso.removeData( 'dragDirection');

		jQuery('.rb-preview .ui-selected').each(function() {
			var $layer 		= jQuery(this),
				index 		= $layer.index(),
				layerData 	= RB_activeSlideData.sublayers[index],
				position 	= $layer.position(),
				size 		= { width: $layer.width(), height: $layer.height() },
				fontSize 	= parseInt($layer.css('font-size')),
				lineHeight 	= parseInt($layer.css('line-height')),
				origPos 	= $layer.data('originalPosition'),
				origSize 	= $layer.data('originalSize');

			var undoObj = {
				itemIndex: index,
				undo: {
					top: origPos.top+'px',
					left: origPos.left+'px',
					width: origSize.width+'px',
					height: origSize.height+'px',
					'font-size': origSize.fontSize+'px',
					'line-height': origSize.lineHeight+'px',
				},
				redo: {
					top: Math.round(position.top / RB_previewZoom)+'px',
					left: Math.round(position.left / RB_previewZoom)+'px',
					width: Math.round(size.width)+'px',
					height: Math.round(size.height)+'px',
					'font-size': Math.round(fontSize)+'px',
					'line-height': Math.round(lineHeight)+'px'
				}
			};


			if( ! layerData.styles.width && ! $layer.is('img,div') ) {
				$layer.width('auto');
				delete undoObj.undo.width;
				delete undoObj.redo.width;
			}

			if( ! layerData.styles.height && ! $layer.is('img,div') ) {
				$layer.height('auto');
				delete undoObj.undo.height;
				delete undoObj.redo.height;
			}


			updateInfo.push(undoObj);
		});

		RB_UndoManager.add('layer.style', RB_l10n.SBUndoLayerResize, updateInfo);
		RbSlider.updatePreviewSelection();

	}).addClass('ui-selected-helper').appendTo( RB_previewHolder );


	RB_previewHolder.on('mouseup.rb', function(e) {

		var $helper = jQuery('.ui-selectable-helper');
		if( $helper.length ) {

			var pos 		= $helper.position(),
				selTop 		= pos.top,
				selLeft 	= pos.left,
				selWidth  	= $helper.outerWidth(),
				selHeight 	= $helper.outerHeight(),
				items = [];

			// Loop through layers list
			RB_previewArea.children('.rb-l').each(function(layerIndex) {

				var $layer 	= jQuery(this),
					t = RB_previewArea.offset().top + $layer.position().top,
					l = RB_previewArea.offset().left + $layer.position().left,
					w = $layer.outerWidth() * RB_previewZoom,
					h = $layer.outerHeight() * RB_previewZoom;

				if(
					(t > selTop  &&  t+h < selTop+selHeight) &&
					(l > selLeft  &&  l+w < selLeft+selWidth)
				) {
					items.push(layerIndex);
				}
			});

			if(items.length) {
				RbSlider.selectLayer( items );
			}
		}


	}).selectable({
		tolerance: 'fit',
		filter: '.ui-draggable:not(.disabled,.transformed)',
		cancel: '.disabled,.transformed'

	// removeFrom | addTo selected layers

	}).on('mouseup.rb', '.ui-draggable', function(e) {

		// Allow selecting a single layer, even if it's
		// already part of the selection if it wasn't dragged
		if( e.which !== 3 && ! RB_layerWasDragged ) {
			if( ! e.ctrlKey && ! e.metaKey ) {

				var $layer 		=  jQuery(this),
					layerIndex 	= $layer.index(),
					layerData 	= RB_activeSlideData.sublayers[ layerIndex ];

				// Prevent locked layers to be selected
				if( ! layerData || layerData.locked ) { return false; }

				RbSlider.selectLayer( [ jQuery(this).index() ] );
				return;
			}
		}

	}).on('mousedown.rb', '.ui-draggable', function(e){

		RB_layerWasDragged = false;

		if( e.which == 1 ) {

			var $layer 		= jQuery(this),
				layerIndex 	= $layer.index(),
				layerData 	= RB_activeSlideData.sublayers[ layerIndex ];

			// Prevent locked layers to be selected
			if( ! layerData || layerData.locked ) { return false; }

			if( $layer.hasClass('ui-selected') ){
				if( e.ctrlKey || e.metaKey ){
					$layer.removeClass('ui-selected').trigger('selectablestop.rb');
				}
			} else {
				if( !e.ctrlKey && !e.metaKey ){
					$layer.siblings('.ui-selected').removeClass('ui-selected');
				}
				$layer.addClass('ui-selected').trigger('selectablestop.rb');
			}

		}

	// store selected layers, compute lasso position & size
	}).on('selectablestop.rb', function(e, ui){

		var layerIndexSet = [];
		jQuery('.rb-preview-td .ui-selected').each(function() {
			layerIndexSet.push( jQuery(this).index() );

		});

		if( ! layerIndexSet.length ) {
			layerIndexSet = RB_activeLayerIndexSet;
		}

		RbSlider.selectLayer(layerIndexSet);


	}).on( 'dragstart.rb', function(u, ui){

		RB_layerWasDragged = true;

		var snapEl = ui.helper.data('ui-draggable').snapElements,
			snapElLength = snapEl.length,
			$item, width, height;

		for( var s=0; s<snapElLength; s++ ) {

			$item = jQuery( snapEl[s].item );

			snapEl[s].width = $item.width() * RB_previewZoom;
			snapEl[s].height = $item.height() * RB_previewZoom;
		}

			ui.helper.data({
				originalWidth: ui.helper[0].style.width,
				originalHeight: ui.helper[0].style.height
			});

	}).on('dragstop.rb', function(e, ui) {

		ui.helper[0].style.width = ui.helper.data('originalWidth') || 'auto';
		ui.helper[0].style.height = ui.helper.data('originalHeight') || 'auto';

	}).on('drag.rb', function(e, ui){

		jQuery.data( ui.helper[0], 'ui-draggable' ).helperProportions = {
			width: ui.helper.width() * RB_previewZoom,
			height: ui.helper.height() * RB_previewZoom
		};

		var dy = ( ui.position.top - ui.originalPosition.top ) / RB_previewZoom,
			dx = ( ui.position.left - ui.originalPosition.left ) / RB_previewZoom;

		// Move only horizontally/vertically while pressing shift
		if( e.shiftKey ){
			if( Math.abs(dx) >= Math.abs(dy) ){
				dy = 0; ui.position.top = ui.originalPosition.top;
			}else{
				dx = 0; ui.position.left = ui.originalPosition.left;
			}
			ui.helper.css(ui.position);
		}

		// Disable snapTo while pressing ctrl/cmd key
		if( ui.helper.draggable('option', 'snap')){
			var d = ui.helper.data('ui-draggable');
			if( (e.ctrlKey || e.metaKey) && d.snapElements.length ){
				d._snapElements = d.snapElements; d.snapElements = [];
			}
			if( !(e.ctrlKey || e.metaKey) && !d.snapElements.length ){
				d.snapElements = d._snapElements;
			}
		}

		// Update selected layers position
		jQuery.each(RB_activeLayerIndexSet, function(idx, layerIndex) {
			var $item = RB_previewItems[layerIndex];
			var op = $item.data('originalPosition');
			$item[0].style.top = ( op.top + dy ) + 'px';
			$item[0].style.left = ( op.left + dx ) + 'px';
		});

		// Update lasso position & position info
		var op = $lasso.data('originalPosition');
		$lasso.css({
			top:  op.top + dy * RB_previewZoom + 'px',
			left: op.left + dx * RB_previewZoom + 'px'
		}).attr({
			'data-info-0': 'x: ' + $lasso.css('left'),
			'data-info-1': 'y: ' + $lasso.css('top')
		});

	});

	// km-ui smartResize init
	kmUI.smartResize.init( '#rb-layers-settings-popout' );


	RbSlider.updatePreviewSelection();
};

jQuery(document).ready(function() {

	// Initialize the interface only if the
	// rbSliderData variable is set.
	if( window.rbSliderData ) {
		initSliderBuilder();
	}
});


(function( $ ) {

	$.fn.rbRuler = function(unit) {
		unit = unit || 50;

		var $this = this.addClass('rb-ruler'),
			$preview = RB_previewWrapper;

		var offsetX = 0, offsetY = 0;
		var $info = $('<div class="rb-ruler-info">').appendTo(document.body);

		var onDragRulerLineX = function(e) {

			var y = parseFloat( $preview.data('rbRulerPos').y );
			$info.css({
				display: y > 0 ? 'block' : 'none',
				left: e.pageX + 15,
				top: e.pageY - 35,
			}).html('Y: '+ Math.round(y / RB_previewZoom) +' px');
		};

		var onDragRulerLineY = function(e) {
			var x = parseFloat( $preview.data('rbRulerPos').x );
			$info.css({
				display: x > 0 ? 'block' : 'none',
				left: e.pageX + 20,
				top: e.pageY - 40,
			}).html('X: '+ Math.round(x / RB_previewZoom) +' px');
		};


		var $x = $('<div class="rb-ruler-x">').draggable({
			axis: 'y',
			cursorAt: {top: 0},
			helper: function() {
				return $('<div class="rb-ruler-line-x">').appendTo(RB_previewWrapper);
			},
			drag: onDragRulerLineX,
			stop: function(e, ui) {
				$info.css('display', '');
				if (ui.position.top < 0) return;
				var $clone = ui.helper.clone().removeClass('ui-draggable-dragging');
					$clone.draggable({
						axis: 'y',
						start: function(e, ui) {
							offsetY = ui.offset.top - e.pageY;
						},
						drag: onDragRulerLineX,
						stop: function(e, ui) {
							offsetY = 0;
							$info.css('display', '');
							ui.position.top < 0 && ui.helper.remove();
						}
					}).data({
						originalTop: ui.position.top / RB_previewZoom,
						originalLeft: ui.position.left / RB_previewZoom
					}).appendTo($preview);
			}
		}).appendTo(RB_previewWrapper);

		var $y = $('<div class="rb-ruler-y">').draggable({
			axis: 'x',
			cursorAt: {left: 0},
			helper: function() {
				return $('<div class="rb-ruler-line-y">').appendTo(RB_previewWrapper);
			},
			drag: onDragRulerLineY,
			stop: function(e, ui) {
				$info.css('display', '');
				if (ui.position.left < 0) return;
				var $clone = ui.helper.clone().removeClass('ui-draggable-dragging');
					$clone.draggable({
						axis: 'x',
						start: function(e, ui) {
							offsetX = ui.offset.left - e.pageX;
						},
						drag: onDragRulerLineY,
						stop: function(e, ui) {
							offsetX = 0;
							$info.css('display', '');
							ui.position.left < 0 && ui.helper.remove();
						}
					}).data({
						originalTop: ui.position.top / RB_previewZoom,
						originalLeft: ui.position.left / RB_previewZoom
					}).appendTo($preview);
			}
		}).appendTo(RB_previewWrapper);

		var $xw = $('<div class="rb-ruler-wrapper">').appendTo($x),
			$yw = $('<div class="rb-ruler-wrapper">').appendTo($y),
			$xt = $('<div class="rb-ruler-tracker">').appendTo($x),
			$yt = $('<div class="rb-ruler-tracker">').appendTo($y);

		$this.on('zoom.rbRuler', function() {

			// Lower the number of ticks when zoomed out
			$this.toggleClass('disable-5px', RB_previewZoom < 0.75);

			// Resize ruler ticks
			$x.add($y).css({ fontSize: RB_previewZoom * unit });

			// Resize guide lines
			jQuery('.rb-ruler-line-x, .rb-ruler-line-y').each(function() {
				var top 	= jQuery(this).data('originalTop') * RB_previewZoom,
					left 	= jQuery(this).data('originalLeft') * RB_previewZoom;

				jQuery(this).css({ top: top, left: left });
			});

		}).on('resize.rbRuler', function() {

			$this.trigger('zoom.rbRuler');
			var xu = Math.ceil($preview.width() / RB_previewZoom / unit);
			var yu = Math.ceil($preview.height() / RB_previewZoom / unit);
			for (var i = $xw.children().length; i < xu; i++)
				$xw.append('<div class="rb-ruler-unit"><div class="rb-ruler-num">'+ i * unit);
			for (var j = $yw.children().length; j < yu; j++)
				$yw.append('<div class="rb-ruler-unit"><div class="rb-ruler-num">'+ j * unit);
		}).trigger('resize.rbRuler');

		$preview.on('mousemove.rbRuler', function(e) {
			var pos = {
				x: e.pageX + offsetX - Math.round($x.offset().left),
				y: e.pageY + offsetY - Math.round($y.offset().top)
			};
			$preview.data('rbRulerPos', pos);
			$xt.css('left', pos.x);
			$yt.css('top', pos.y);
		}).on('mouseleave.rbRuler', function() {
			$xt.css('left', '');
			$yt.css('top', '');
		});

		return $this;
	};

}( jQuery ));

var layerTransitionPreview = {

	create: function(){

		jQuery( '#rb-layers' ).on( 'mouseenter', '#rb-transition-selector-table .rb-tpreview-wrapper', function(){

			var _tl = new TimelineMax(),
				$el = jQuery(this);

			if( $el.data( 'rb-tpreview' ) ){
				$el.data( 'rb-tpreview' ).clear().kill();
				$el.removeData( 'rb-tpreview' );
			}

			switch( $el.attr('id').split( 'rb-tpreview-')[1] ){

				case 'in':
					_tl.fromTo( $el.find( '.rb-preview-layer' )[0], 1.5, {
						opacity: 1,
						x: -90
					},{
						ease: Quart.easeInOut,
						x: 0
					}).to( $el.find( '.rb-preview-layer' )[0], 0.25, {
						opacity: 0,
						onComplete: function(){
							_tl.progress( 0 );
						}
					});
				break;

				case 'out':
					_tl.to( $el.find( '.rb-preview-layer' )[0], 1.5, {
						ease: Quart.easeInOut,
						x: 90
					}).fromTo( $el.find( '.rb-preview-layer' )[0], 0.25, {
						immediateRender: false,
						x: 0,
						opacity: 0
					},{
						opacity: 1,
						onComplete: function(){
							_tl.progress( 0 );
						}
					});
				break;

				case 'textin':
					_tl.staggerFromTo( $el.find( '.rb-preview-layer_t' ).get(), 1, {
						opacity: 1,
						x: -100,
						rotation: -90
					},{
						ease: Quart.easeOut,
						x: 0,
						rotation: 0
					}, 0.15, null, function(){
						_tl.staggerTo( $el.find( '.rb-preview-layer_t' ).get(), 0.25, {
							opacity: 0
						}, 0, null, function(){
							_tl.progress( 0 );
						});
					});
				break;

				case 'textout':
					_tl.staggerTo( $el.find( '.rb-preview-layer_t' ).get(), 1, {
						x: 100,
						rotation: 90,
						ease: Quart.easeIn,
					}, 0.15, null, function(){
						_tl.staggerFromTo( $el.find( '.rb-preview-layer_t' ).get(), 0.25, {
							immediateRender: false,
							x: 0,
							opacity: 0,
							rotation: 0
						},{
							opacity: 1
						}, 0, null, function(){
							_tl.progress( 0 );
						});
					});
				break;

				case 'loop':
					_tl.to( $el.find( '.rb-preview-layer' )[0], 1.5, {
						rotation: 360,
						repeat: -1,
						ease: Linear.easeNone
					});
				break;

				case 'hover':
					_tl.to( $el.find( '.rb-preview-layer' )[0], .75, {
						scale: 1.5,
						repeat: -1,
						yoyo: true,
						ease: Quad.easeInOut
					});
				break;

				case 'parallax':
					_tl.to( $el.find( '.rb-preview-layer' )[0], 1, {
						x: -10,
						repeat: -1,
						yoyo: true,
						ease: Quad.easeInOut
					}, 0 );
					_tl.to( $el.find( '.rb-preview-layer_b' )[0], 1, {
						x: -15,
						repeat: -1,
						yoyo: true,
						ease: Quad.easeInOut
					}, 0 );
				break;
			}

			jQuery(this).data( 'rb-tpreview', _tl );
		});

		jQuery( '#rb-layers' ).on( 'mouseleave', '#rb-transition-selector-table .rb-tpreview-wrapper', function(){

			if( jQuery(this).data( 'rb-tpreview' ) ){
				jQuery(this).data( 'rb-tpreview' ).clear().kill();
				jQuery(this).removeData( 'rb-tpreview' );
				TweenMax.set( jQuery(this).find( '.rb-preview-layer, .rb-preview-layer_t' ).get(), {
					opacity: 1,
					rotation: 0,
					scale: 1,
					x: 0,
				});
			}
		});
	}
};


var prepTemplateForRelease = function() {

	var sliderData 	= window.rbSliderData,
		sliderProps = sliderData.properties;

	// Global BG & YourLogo
	if( sliderProps.backgroundimage ) { sliderProps.backgroundimage = RB_Utils.parse_url( sliderProps.backgroundimage, 'PHP_URL_PATH'); }
	if( sliderProps.yourlogo ) { sliderProps.yourlogo = RB_Utils.parse_url( sliderProps.yourlogo, 'PHP_URL_PATH'); }
	if( sliderProps.preview ) { sliderProps.preview = RB_Utils.parse_url( sliderProps.preview, 'PHP_URL_PATH'); }
	if( sliderData.meta && sliderData.meta.preview ) { sliderData.meta.preview = RB_Utils.parse_url( sliderData.meta.preview, 'PHP_URL_PATH'); }


	// Slides
	jQuery.each(window.rbSliderData.layers, function(slideIndex, slideData) {

		var slideProps = slideData.properties;

		slideData.history = [];

		if( slideData.meta && slideData.meta.undoStackIndex ) {
			slideData.meta.undoStackIndex = -1;
		}

		if( slideProps.background ) { slideProps.background = RB_Utils.parse_url( slideProps.background, 'PHP_URL_PATH'); }
		if( slideProps.backgroundThumb ) { slideProps.backgroundThumb = RB_Utils.parse_url( slideProps.backgroundThumb, 'PHP_URL_PATH'); }

		if( slideProps.thumbnail ) { slideProps.thumbnail = RB_Utils.parse_url( slideProps.thumbnail, 'PHP_URL_PATH'); }
		if( slideProps.thumbnailThumb ) { slideProps.thumbnailThumb = RB_Utils.parse_url( slideProps.thumbnailThumb, 'PHP_URL_PATH'); }

		// Layers
		jQuery.each(slideData.sublayers, function(layerIndex, layerData) {

			if( layerData.image ) { layerData.image = RB_Utils.parse_url( layerData.image, 'PHP_URL_PATH'); }
			if( layerData.imageThumb ) { layerData.imageThumb = RB_Utils.parse_url( layerData.imageThumb, 'PHP_URL_PATH'); }

			if( layerData.poster ) { layerData.poster = RB_Utils.parse_url( layerData.poster, 'PHP_URL_PATH'); }
			if( layerData.posterThumb ) { layerData.posterThumb = RB_Utils.parse_url( layerData.posterThumb, 'PHP_URL_PATH'); }
		});
	});

	RB_UndoManager.update();

	alert("All Done. Performed tasks:\r\n\r\n– Converted URLs to relative format\r\n– Emptied slides history\r\n\r\nManual save required.");
};
