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
jQuery(document.documentElement).addClass('rbthemeslider');

window.rbDefaultTr = [{
	transitionin: true,
	delayin: 0,
	durationin: 1000,
	easingin: "easeInOutQuint",
	fadein: true,
	offsetxin: 0,
	offsetyin: 0,
	rotatein: 0,
	rotatexin: 0,
	rotateyin: 0,
	scalexin: 1,
	scaleyin: 1,
	skewxin: 0,
	skewyin: 0,
	transformoriginin: "50% 50% 0",
	transformperspectivein: 500,
	clipin: "",
	widthin: "",
	heightin: "",
	radiusin: "",
	colorin: "",
	bgcolorin: "",
	filterin: "",
	texttransitionin: false,
	texttypein: "", // "chars_asc",
	textstartatin: "transitioninend",
	textdurationin: "", // 1000,
	texteasingin: "easeInOutQuint",
	textfadein: "true",
	textshiftin: 50,
	textoffsetxin: 0,
	textoffsetyin: 0,
	textrotatein: 0,
	textrotatexin: 0,
	textrotateyin: 0,
	textscalexin: 1,
	textscaleyin: 1,
	textskewxin: 0,
	textskewyin: 0,
	texttransformoriginin: "50% 50% 0",
	texttransformperspectivein: 500,
	static: "none"
}, {
	transitionout: true,
	startatout: "slidechangeonly + 0",
	durationout: 1000,
	easingout: "easeInOutQuint",
	fadeout: true,
	offsetxout: 0,
	offsetyout: 0,
	rotateout: 0,
	rotatexout: 0,
	rotateyout: 0,
	scalexout: 1,
	scaleyout: 1,
	skewxout: 0,
	skewyout: 0,
	transformoriginout: "50% 50% 0",
	transformperspectiveout: 500,
	clipout: "",
	widthout: "",
	heightout: "",
	radiusout: "",
	colorout: "",
	bgcolorout: "",
	filterout: ""
}, {
	loop: false,
	loopcount: 1,
	loopstartat: "allinend + 0",
	looprepeatdelay: 0,
	loopduration: 1000,
	loopeasing: "linear",
	loopopacity: 1,
	loopoffsetx: 0,
	loopoffsety: 0,
	looprotate: 0,
	looprotatex: 0,
	looprotatey: 0,
	loopscalex: 1,
	loopscaley: 1,
	loopskewx: 0,
	loopskewy: 0,
	looptransformorigin: "50% 50% 0",
	looptransformperspective: 500,
	loopclip: "",
	loopfilter: "",
	loopyoyo: false
}, {
	hover: false,
	hoverdurationin: 500,
	hovereasingin: "easeInOutQuint",
	hoverdurationout: "",
	hovereasingout: "",
	hovercolor: "",
	hoverbgcolor: "",
	hoverborderradius: "",
	hoveroffsetx: 0,
	hoveroffsety: 0,
	hoveropacity: "",
	hoverrotate: 0,
	hoverrotatex: 0,
	hoverrotatey: 0,
	hoverscalex: 1,
	hoverscaley: 1,
	hoverskewx: 0,
	hoverskewy: 0,
	hovertransformorigin: "50% 50% 0",
	hovertransformperspective: 500,
	hoveralwaysontop: true
}];

// LISTING PAGE - SUGGESTED MODULES
if (location.search.match(/\bcontroller=AdminRbthemesliderSlider\b(?!.*\baction=edit\b)/i)) {
	window.onLoadSuggestedModules = function(data) {
		if (window.localStorage) {
			localStorage.rbSuggestedModules = data;
			localStorage.rbSuggestedModulesExp = Date.now() + 3600*24*1000;
		}
		jQuery(function($) {
			var $mods = $('.rb-suggested-modules');
			var $chld = $mods.children().remove();
			$(data).each(function() {
				if (!PS_Modules[this.id]) $(this).css('visibility', $mods.children().length ? 'hidden' : '').appendTo($mods);
			});
			$mods.children().length || $mods.append($chld.css('display', ''));

			var tw, twDur = 0.5, autoDur = 8000;
			$mods.prev().on('click.rb', '.dashicons-arrow-left, .dashicons-arrow-right', function() {
				if (tw && tw.ratio != 1) return;
				var dir = $(this).hasClass('dashicons-arrow-left') ? 1 : -1;
				var $old = $mods.children('.active');
				var $new = $($mods[0].children[ ($old.index() + dir + $mods[0].children.length) % $mods[0].children.length ]);
				if (!$old[0] || $old[0] == $new[0]) return;
				TweenLite.to($old[0], twDur, {
					xPercent: 100 * dir,
					onComplete: function() {
						$new.addClass('active');
						$old.removeClass('active');
					}
				});
				tw = TweenLite.fromTo($new[0], twDur, {
					visibility: '',
					xPercent: -100 * dir
				}, {xPercent: 0});
			});

			var autoplay = function() {
				$mods.prev().find('.dashicons-arrow-right').trigger('click.rb');
			};
			var interval = setInterval(autoplay, autoDur);
			$mods.parent().on('mouseenter.rb', function() {
				clearInterval(interval);
			}).on('mouseleave.rb', function() {
				interval = setInterval(autoplay, autoDur);
			});
		});
	};
	if (window.localStorage && localStorage.rbSuggestedModulesExp > Date.now()) {
		onLoadSuggestedModules(localStorage.rbSuggestedModules);
	} else {
		$.ajax('https://rubiktheme.com/suggestion.php', {cache: true, dataType: "script"});
	}
}

['html', 'text'].forEach(function(plg) {
	// unwrap CDATA in case of <script type="text/html">
  jQuery.fn[plg] = (function(parent) {
  	return function() {
  		var res = parent.apply(this, arguments);
  		if (!arguments.length && this.is('script[type="text/html"]')) {
  			res = res.replace(/^\/\*<!\[CDATA\[\*\//i, '', res);
  			res = res.replace(/\/\*\]\]>\*\/$/, '', res);
  		}
  		return res;
  	};
  })(jQuery.fn[plg]);
});

jQuery(function($) {

	var $document = $(document),
			$window = $(window),
			$body = $(document.body);

	var root = location.pathname.split('/');
	root.length -= 2;
	root = root.join('/');
	var token = (location.search.match(/[?&]token=([^&]+)/) || [,''])[1];

	// put admin inside a div#wpwrap
	var $wpwrap = $('<div id="wpwrap">').appendTo($body);
	$wpwrap.siblings().appendTo($wpwrap);

	// remove message param from URL
	var message = location.href.match(/&message=[^&]*/);
	if (message && history.pushState) {
		history.pushState('', '', location.pathname + location.search.replace(message[0], ''));
	}

	// Update sliders per page fix
	$('#rb-screen-options-form').submit(function(e) {
		e.preventDefault();
		e.stopPropagation();
		var options = {};
		$(this).find('input').each(function() {
			if( $(this).is(':checkbox')) {
				options[$(this).attr('name')] = $(this).prop('checked');
			} else {
				options[$(this).attr('name')] = $(this).val();
			}
		});

		// Save settings
		$.post(ajaxurl, $.param({ action : 'rb_save_screen_options', options : options }), function() {
			location.href = location.href;
		});
	});

	// filtering sliders fix
	$('<input>', {name: 'token', value: token, type: 'hidden'}).prependTo('#rb-slider-filters');
	$('<input>', {name: 'controller', value: 'AdminRbthemesliderSlider', type: 'hidden'}).prependTo('#rb-slider-filters');
	// auto submit on change select
  $('#rb-slider-filters').on('change', 'select', function() { this.form.submit() });

	$('body').on('click', '#btn-connect-ps', function() {
		kmUI.modal.close();
		kmUI.overlay.close();
		setTimeout(function() {
			$('#modal_addons_connect').modal('show');
		}, 500);
	});

	// post settings
	var $basic = $('.rb-post-basic').change(function(e) {
		$adv.find('select[name=post_type]').val(0);
		$adv.find('select[name=post_categories]').val(0);
		$adv.find('select[name=post_tags]').val(0);
		$adv.find('select[name=post_offset]').val(-1);
		$adv.find('select[name=post_order]').val('DESC');
		RB_PostOptions.change( $adv.find('select[name=post_orderby]').val(e.target.value) );
	});
	var $adv = $('.rb-post-advanced').change(function() {
		$basic.find('input[name=post_basic]').attr('checked', false);
	})
	$('#rb-post-settings-adv').attr('checked', !!localStorage.rbPostSettingsAdv).customCheckbox().change(function() {
		if (this.checked) {
			localStorage.rbPostSettingsAdv = 1;
			$basic.slideUp();
			$adv.slideDown();
		} else {
			localStorage.rbPostSettingsAdv = '';
			$basic.slideDown();
			$adv.slideUp();
		}
	}).change();

	// Import sample sliders
	var key = '', errorMsg = '';
	var $ts = $('#rb-import-samples-button').click(function(e) {
		e.stopImmediatePropagation();
		e.preventDefault();

		if ($('#password_addons').length) {
			return kmUI.modal.open('#tmpl-template-store', { width: 500, height: 250 });
		}

		var popup = $('#rb-import-sliders-template');
		if (!popup.length) popup = $('<div id="rb-import-sliders-template">').appendTo($body);
		var top = $('#content').offset().top;
		popup.attr('style', 'position: fixed !important;').css({
			top : top,
			opacity: 0,
			width: '100%',
			height: 'calc(100vh - '+top+'px)',
			zIndex: 9999991,
			overflowY: 'scroll'
		}).show().animate({ opacity: 1 }, 300);

		popup.on('click', '.rb-import-close', function() {
			popup.hide();
			$body.css('overflow', '').off('keyup.rbimport');
		});

		$body.css('overflow', 'hidden').on('keyup.rbimport', function(e) {
			if (e.keyCode == 27) $('.rb-import-close').click();
		});

		if (!popup.children().length) {
			var domain = location.protocol+'//';
			$.ajax({
				url: domain+'/explore-sliders',
				dataType: 'jsonp',
				success: function(data) {
					data.css.forEach(function(src) {
						$('<link type="text/css" rel="stylesheet">')
							.appendTo(document.head)
							.attr('href', src);
					});
					popup.html(data.html);
					popup.find('.filter-options').css('visibility', 'hidden'); // hide filters while loading
					popup.find('.btn__import').css('display', ''); // show import buttons
					popup.find('.href-overlay, .picture-item__like').remove(); // remove likes
					popup.find('a[target]').each(function() { // update slide links
						$(this).attr({
							target: '_blank',
							href: domain + this.attributes.href.value
						});
					});
					popup.children().css('min-height', '100%'); // css fix
					$x = $('<i class="flaticon-delete rb-import-close">').css({color: '#2f3d46', top: 10}).appendTo(popup);
					popup.scroll(function() { $x.css('top', popup.scrollTop() + 10) });
					$.ajax(data.js[0], {
						dataType: 'script',
						cache: true,
						complete: function() {
							popup.find('.filter-options').css('visibility', ''); // reveal tags
							$.post(ajaxurl, {action: 'rb_test_template_store'}, function(data) {
								data = JSON.parse(data);
								data.success ? key = data.key : rbImportError(errorMsg = data.msg);
							});
						}
					});
				},
				error: function() {
					console.log(arguments)
				}
			});
			popup.on('click', 'a[data-import]', function onImport() {
				if (!key) {
					return rbImportError(errorMsg);
				}
				var $figure = $(this).closest('figure').addClass('loading');
				$('.logoload').css({
					position: 'absolute',
					display: 'block',
					opacity: 1
				}).appendTo($figure);
				$.getScript(location.protocol+'//offlajn.com/index2.php?option=com_rb_import&task=psrequest&ver='+rbVersion+'&slider='+$(this).data('import')+'&key='+key);
			});
			var slideDur = 400;
			popup.on('click', '.rb-warning-close', function closeWarning() {
				$(this).closest('.rb-warning-cont').slideUp(slideDur, function() { $(this).remove() });
			});
			function scrollUp() {
				var scroll = { y: popup.scrollTop() };
				scroll.y && TweenLite.to(scroll, 0.3, { y: 0, onUpdate: function() { popup.scrollTop(scroll.y) } });
			}
			window.rbImportError = function(msg) {
				scrollUp();
				$('.rb-warning-close').click();
				$('figure.loading').removeClass('loading').find('.logoload').hide();
				$('<div class="rb-warning-cont"><h3 class="flaticon-warning">' +
					'<p>'+msg+'</p><i class="flaticon-delete rb-warning-close"/>')
					.insertBefore('#grid').slideUp(0).slideDown(slideDur);
			};
		}
	});

	// init addons connect
	if (~location.search.indexOf('&conf=32')) {
		history.pushState && history.pushState('', '', location.pathname + location.search.replace('&conf=32', ''));
		$ts.click();
	}
	// init edit
	if (~location.search.indexOf('&edited=1')) {
		history.pushState && history.pushState('', '', location.pathname + location.search.replace('&edited=1', ''));
	}

	var $video = $('#rb-revisions-welcome video');
	if ($video.length) $video[0].play();

	function createParamSelect(data, value, active) {
		$select = $('<select>', {name: data.name});
		if (value) {
			data.opts.forEach(function(opt) {
				if (opt.active == active) $('<option>', { value: opt[value], html: opt.option || opt.name }).appendTo($select);
			});
		} else {
			for (var key in data.opts) {
				$('<option>', { value: key, html: data.opts[key] }).appendTo($select);
			}
		}
		return $select;
	}

	function createParamTr(data, $param) {
		$tr = $('<tr>');
		$('<td>', {html: data.title}).appendTo($tr);
		$param.wrap('<td>').parent().appendTo($tr);
		$('<td>', {html: data.desc, 'class': 'desc'}).appendTo($tr);
		return $tr;
	}

	if (location.search.match(/\bcontroller=AdminRbthemesliderSlider\b/i)) {
    // replace shortcode
    $('.rb-save-shortcode span:last-child').each(function() {
      this.innerHTML = '[rbthe'+ this.innerHTML.slice(6);
      return false;
    });
    $('.rb-shortcode').each(function() {
      this.value = '[rbthe'+ this.value.slice(6);
    });

	}

	$(document.body).on('input', '.km-combo-input[data-hook]', function onChangeHook() {
		$(this).siblings('.rb-hook-update').removeClass('dashicons-yes').toggleClass('rb-visible', this.value != $(this).data('hook'));
	}).on('click', '.rb-hook-update', function onClickHookUpdate() {
		var $this = $(this);
		var $hook = $this.siblings('.km-combo-input');
		var rotate = TweenMax.to(this, 1, {
			rotation: 360,
			repeat: -1,
			ease: Linear.easeNone
		});
		var id = $this.closest('[data-id]').data('id');
		$.post(ajaxurl, {
			action: 'rb_update_hook',
			id: id,
			hook: $hook.val()
		}, function onUpdateHook(data) {
			rotate.kill();
			TweenLite.set($this[0], { rotation: 0 });
			data = JSON.parse(data);
			if (data.success) {
				$('[data-id='+id+'] [data-hook]').val(data.hook).attr('data-hook', data.hook).data('hook', data.hook);
				$this.addClass('dashicons-yes').removeClass('rb-visible');
			} else {
				alert(data.errorMsg);
			}
		});
	});

	$('.rb-slider-list-form').on('click', '.embed', function() {
		var id = $(this).data('id');
		var hook = $('[data-id='+id+'] [data-hook]').data('hook') || '';
		setTimeout(function() {
			$('.rb-modpos').attr('data-id', id).data('id', id)
				.find('.km-combo-input').val(hook).data({value: hook, hook: hook});
			// update shortcode
      $('.shortcode').each(function() {
        this.value = '[creative'+ this.value.slice(6);
      });
		}, 1);
	});

	var imgs = '/img/';

	if (window.rbSliderData) { // EDIT VIEW
		// Schedule Slide
		var datepicker = $('.rb-slide-options .rb-datepicker-input').datepicker({
			position: 'right top',
			classes: 'rb-datepicker',
			dateFormat: 'yyyy-mm-dd',
			timeFormat: 'hh:ii',
			todayButton: new Date(),
			clearButton: true,
			timepicker: true,
			keyboardNav: false,
			range: false,

			onSelect: function(formattedDate, date, inst) {
				inst.$el.trigger('change');
			}

		}).each(function() {
			var $this = $(this),
					key = $(this).data('schedule-key'),
					startDate = new Date(rbSliderData.layers[RB_activeSlideIndex].properties[ key ]);
			if (startDate.getTime()) {
				$this.data('datepicker').selectDate(startDate);
				$this.trigger('keyup');
			}

		}).attr('pattern', '\\d{4}-\\d\\d?-\\d\\d?( \\d\\d?:\\d\\d?)?|');


		// EASY MODE
		var rbForm = $('#rb-slider-form')[0];
		var $easy = $('<a class="rb-checkbox small"><span>');

		$('#rb-easy-view').on('click', function onClickEasyMode(e) {
			e.stopImmediatePropagation();
			var easyOn = $easy.hasClass('on');
			$easy.addClass(easyOn ? 'off' : 'on').removeClass(!easyOn ? 'off' : 'on');
			window.localStorage && (localStorage.rbEasyMode = easyOn ? 'off' : 'on');
			runEasyMode();
		});

		function runEasyMode() {
			var easyOn = $easy.hasClass('on') && RB_activeLayerDataSet.length == 1;
			$easy.parent().css('display', RB_activeLayerDataSet.length == 1 ? '' : 'none');
			$('.rb-adv').css('display', !easyOn ? '' : 'none');
			$('.rb-easy').css('display', easyOn ? '' : 'none');

			if (easyOn) {
				var tr = RB_activeLayerDataSet[0].transition;
				var $col = $('.rb-easy-tr > ul');
				var include = [
					tr.transitionin === false ? [] : ['delayin', 'durationin', 'fadein'],
					['startatout', 'durationout', 'fadeout'],
					['loopcount', 'loopduration'],
					['hoverdurationin', 'hovercolor', 'hoverbgcolor']
				];
				rbDefaultTr.forEach(function(def, index) {
					if (
						index == 0 && tr.transitionin === false && !tr.texttransitionin ||
						index == 1 && tr.transitionout === false ||
						'loop' in def && !tr.loop || 'hover' in def && !tr.hover
					) {
						// show close icon after transition title / hide turned off transition properties
						return $col.eq(index).parent().addClass('rb-tr-off');
					}
					var easyTr = {};
					include[index].forEach(function(prop) {
						easyTr[prop] = prop in tr ? tr[prop] : def[prop];
					});
					for (var prop in def) {
						if (prop in tr && def[prop] !== (typeof def[prop] === 'number' ? Number(tr[prop]) : tr[prop])) {
							easyTr[prop] = tr[prop];
						}
						// leave cycle when text transition is turned off
						if (prop == 'texttransitionin' && !tr[prop]) break;
					}
					var $ul = $col.eq(index).html('');
					$ul.parent().removeClass('rb-tr-off');
					for (var prop in easyTr) {
						var $li = $(rbForm[prop]).closest('li');
						$li.clone().toggleClass('rb-easy-prop', !/fade|duration|startat|count|yoyo/.test(prop)).appendTo($ul);
						var $clone = $(rbForm[prop]).eq(0).val(easyTr[prop]);
						if ($clone.hasClass('rb-colorpicker')) {
							// init colorpicker
							$clone.parent().before($clone).remove();
							RbSlider.addColorPicker($clone);
						} else if (~prop.indexOf('startat')) {
							// clone with modifier
							$li.next().clone().appendTo($ul);
						}
					}
					if (!index) {
						// highlight texttypein|parallaxlevel|static property if exists
						$(rbForm.texttypein).closest('.rb-easy-prop').addClass('rb-main-tr');
						if (tr.parallax) {
							$(rbForm.parallaxlevel).closest('li').clone().addClass('rb-easy-prop rb-main-tr').appendTo($ul);
						}
						if (tr.static && tr.static != 'none') {
							var staticLayer = $(rbForm.static.parentNode).prev().text();
							$li = $('<li><div>'+staticLayer+'</div></li>').addClass('rb-easy-prop rb-main-tr').appendTo($ul);
							$(rbForm.static).clone().val( $(rbForm.static).val() ).appendTo($li).wrap('<div>');
						}
					}
				});
			}
		}

		$(function initEasyMode() {
			$easy.addClass(window.localStorage && localStorage.rbEasyMode || 'on').prependTo('#rb-easy-view');

			$(RbSlider).on('afterStartMultipleSelection', function() {
				$easy.parent().css('display', 'none');
				if (window.localStorage && localStorage.rbEasyMode != 'off') {
					$('.rb-easy').css('display', 'none');
					$('.rb-adv').css('display', '');
				}
			}).on('afterStopMultipleSelection', function() {
				$easy.removeClass('indeterminate').addClass(window.localStorage && localStorage.rbEasyMode || 'on')
					.parent().css('display', '');
			}).on('afterSelectMediaType', runEasyMode);

			$(RB_UndoManager).on('afterExecuteItem', function(e, cmd) {
				if (cmd === 'layer.transition' && $easy.hasClass('on')) {
					runEasyMode();
				}
			});
			runEasyMode();
		});

		$(document).on('click', '.rb-tr-off', function onClickAddTrType() {
			var prop = $(this).data('prop');
			$(rbForm[prop]).next().click();
			runEasyMode();

		}).on('click', '.rb-easy-tr .dashicons-no', function onClickRemoveTrType() {
			var prop = $(this).closest('.rb-easy-tr').data('prop');
			$(rbForm[prop]).next().click();
			runEasyMode();

		}).on('focus', '.rb-add-tr-prop', function onFocusTrPropList() {
			var tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
			var $ul = $(this).prev();
			var index = $(this.parentNode).index();
			var group = ([
				{ transitionin: 1, texttransitionin: !/img|media/.test(RB_activeLayerDataSet[0].media) },
				{ transitionout: 1 },
				{ loop: 1 },
				{ hover: 1 }
			])[index];
			this.innerHTML = this.children[0].outerHTML;
			for (var prop in rbDefaultTr[index]) {
				if (group[prop]) {
					var optgroup = $(rbForm[prop]).closest('header').prev().text();
					optgroup && $('<optgroup>', { label: optgroup }).appendTo(this);
				} else if (rbForm[prop].name) {
					var opt = $(rbForm[prop]).closest('li').children(':first').text();
					opt && $('<option>', { value: prop, html: tab + opt }).appendTo(this);
				}
			}
			if (!index) {
				// Other Settings
				$('<optgroup>', { label: $('#rb-layer-transitions+.rb-separator').text() }).appendTo(this);
				rbForm.parallaxlevel.name && $('<option>', {
					value: 'parallaxlevel',
					html: tab + $(rbForm.parallaxlevel.parentNode).prev().text()
				}).appendTo(this);
				rbForm.static.name && $('<option>', {
					value: 'static',
					html: tab + $(rbForm.static.parentNode).prev().text()
				}).appendTo(this);
			}

		}).on('change', '.rb-add-tr-prop', function onAddTrProp() {
			var index = $(this).closest('.rb-easy-tr').index();
			var prop = $(this).val();
			var openingTrs = {transitionin: 0, texttransitionin: 1};
			for (var tr in openingTrs) {
				if (!index && prop.startsWith('text') == openingTrs[tr] && !rbForm[tr].checked) {
					// turn on opening|text transition & insert default properties
					$(rbForm[tr]).next('.off').click();
					runEasyMode();
					if (!rbForm[prop].name) {
						// don't clone property later, it was autoincluded
						var $clone = $(rbForm[prop][0]);
					}
				}
			}
			if (!$clone) {
				var $prev, $li = $(rbForm[prop]).closest('li');
				for (var p in rbDefaultTr[index]) {
					// search for prev property
					if (p == prop) break;
					if (!rbForm[p].name) $prev = $(rbForm[p][0]).closest('li');
				}
				$li.clone().toggleClass('rb-easy-prop', !/fade|duration/.test(prop)).insertAfter($prev)
					.toggleClass('rb-main-tr', /texttypein|parallaxlevel/.test(prop));
				$clone = $(rbForm[prop][0]);
				if ($clone.hasClass('rb-colorpicker')) {
					// init colorpicker
					$clone.parent().before($clone).remove();
					RbSlider.addColorPicker($clone);
				} else if (~prop.indexOf('startat')) {
					// insert startatoperator & startatvalue too
					$li.next().clone().insertAfter($prev.next());
				}
			}
			if (prop == 'parallaxlevel') {
				$(rbForm.parallax).next('.off').click();
			} else if (prop == 'static') {
				// create static property
				var staticLayer = $(rbForm.static.parentNode).prev().text();
				$li = $('<li><div>'+staticLayer+'</div></li>').addClass('rb-easy-prop rb-main-tr').appendTo(this.previousElementSibling);
				$(rbForm.static).val('forever').change()
					.clone().val('forever').appendTo($li).wrap('<div>');
			}
			this.selectedIndex = 0;
			this.blur();
			$clone[0].select ? $clone[0].select() : $clone[0].focus();

		}).on('click', '.rb-easy-prop', function onRemoveTrProp(e) {
			if (e.target != this) return;
			// click on ::before (x)
			var prop = $(':input[name]', this).prop('name');
			var xProp = { transitionin: 'delayin', texttransitionin: 'texttypein', parallax: 'parallaxlevel' };
			for (var p in xProp) {
				if (prop == xProp[p]) {
					// turn off opening|text|parallax transition when property is removed
					$(rbForm[p]).next('.on').click();
					return runEasyMode();
				}
			}
			var undoObj = {}, redoObj = {};
			var def = rbDefaultTr[ $(this).closest('.rb-easy-tr').index() ];
			undoObj[prop] = $(rbForm[prop][1]).val();
			redoObj[prop] = def[prop];
			if (~prop.indexOf('startat')) {
				// remove startatoperator & startatvalue too
				$(':input[name]', this.nextElementSibling).each(function() {
					undoObj[this.name] = $(rbForm[this.name][1]).val();
					redoObj[this.name] = def[this.name]
				});
			}
			if (undoObj[prop] != redoObj[prop]) {
				var updateInfo = [{
					itemIndex: RB_activeLayerIndexSet[0],
					undo: undoObj,
					redo: redoObj
				}];
				$.extend(RB_activeLayerDataSet[0].transition, redoObj);
				RB_DataSource.buildLayer();
				RB_UndoManager.add('layer.transition', RB_l10n.SBUndoPasteSettings, updateInfo);
			}
			runEasyMode();

		}).on('input', '.rb-easy :input', function onSyncAdvProp() {
			// synchronize easy property value with advanced property
			this.name && $(rbForm[this.name][1]).val( $(this).val() );

		}).on('click', '.rb-easy .rb-checkbox', function onSyncAdvCheckbox() {
			if (this.previousSibling.name) {
				$(rbForm[this.previousSibling.name][1]).next().click();
			}
		});

		$(document).on('click', '.rb-sublayer-options .rb-preset', function onClickOpenPresets() {
			kmUI.modal.open('#tmpl-rb-layer-presets', {
				width: 795,
				height: 482,
				direction: '',
				animate: 'fade',
				theme: 'blue'
			});
			var title = document.createTextNode( $(this).prev().text() );
			kmUI.modal.$window.find('.header b').before(title);

			// check selected layer(s) media type
			var noTextTr = RB_activeLayerDataSet.some(function(layer) {
				return layer.media == 'img' || layer.media == 'media';
			});

			// build accordion menu
			var $menu = kmUI.modal.$window.find('.rb-side-menu');
			var presetIndex = $(this.parentNode).index();
			var presets = ([rbOpeningPresets, rbClosingPresets, rbLoopPresets, rbHoverPresets])[presetIndex];
			presets.layers.forEach(function(slide, i) {
				if (noTextTr && slide.sublayers[0].transition.texttransitionin) return;
				var $item = $('<div class="rb-menu-wrapper"><a class="rb-menu-item">'+slide.properties.title+'</a>').appendTo($menu);
				if (slide.sublayers.length > 1) {
					$item.children().append('<i class="dashicons dashicons-arrow-right">');
					var $submenu = $('<div class="rb-submenu">').appendTo($item);
				}
				slide.sublayers.forEach(function(layer, j) {
					if (~layer.subtitle.indexOf('color') && noTextTr) return;
					layer.image = rbTrImgPath + (layer.transition.hover ? 'sample_slide_2_hover.png' : 'sample_slide_2.png');
					layer.media = noTextTr ? 'img' : 'text';
					noTextTr ? layer.styles.padding = 0 : delete layer.styles.padding;
					if (slide.sublayers.length > 1) {
						$('<div class="rb-menu-wrapper"><a class="rb-menu-item">'+layer.subtitle+'</a>').appendTo($submenu);
					}
				});
			});

			// build sample slider
			var $slider = kmUI.modal.$window.find('.rb-container');
			RbSlider.populateSliderPreview($slider, [], presets);
			$slider.rbSlider({
				type: 'responsive',
				width: 530,
				height: 360,
				autoStart: false,
				pauseOnHover: false,
				navButtons: false,
				navStartStop: false,
				showCircleTimer: false,
				skinsPath: pluginPath + 'css/rbthemeslider/skins/'
			}).one('pageTimelineDidStart', function() {
				$menu.find('.rb-menu-wrapper:first').click();
			});

			var rb = _RbSliders[$slider.data('rbSliderUID')];
			$menu.on('click', '>.rb-menu-wrapper', function onClickPresetMainItem() {
				var $item = $(this).addClass('active');
				var $prev = $item.siblings('.active').removeClass('active');
				if ($item[0] != $prev[0]) {
					$item.find('.rb-submenu').slideDown(300);
					$prev.find('.rb-submenu').slideUp(300);
				}
				$item.find('.rb-menu-wrapper:first').addClass('active').siblings('.active').removeClass('active');

			}).on('click', '.rb-submenu .rb-menu-wrapper', function onClickPresetSubItem(e) {
				e.stopPropagation();
				$(this).addClass('active').siblings('.active').removeClass('active');

			}).on('click', '.rb-menu-wrapper', function onClickPresetMenuItem() {
				var $parent = $(this.parentNode).closest('.rb-menu-wrapper');
				var index = $parent.length ? $parent.index() : $(this).index();
				var subindex = $parent.length ? $(this).index() : 0;
				$slider.one('slideChangeDidStart', function() {
					var $layers = rb.layers.$all.filter('[data-rb-slidein='+index+']');
					var wrapper = $layers.data()._RB.hover.enabled ? '.rb-wrapper' : '*';
					$layers.closest(wrapper).addClass('rb-hidden');
					$layers.eq($layers.length - 1 - subindex).closest(wrapper).removeClass('rb-hidden');
					rb.functions.resetSlideTimelines();
					rb.transitions.layers.timeline.create(true);
				}).rbSlider(index);
				rb.slides.current.index == index && $slider.trigger('slideChangeDidStart');
			});

			$('#rb-choose-tr').click(function onClickChoosePreset() {
				var $active = $menu.find('>.active, >.active .active');
				var index = $active.eq(0).index() - 1;
				var subindex = $active.length > 1 ? $active.eq(1).index() : 0;
				var tr = $.extend({}, rbDefaultTr[presetIndex], presets.layers[index].sublayers[subindex].transition);
				// don't override start at options except textstartatin
				delete tr.delayin, delete tr.startatout, delete tr.loopstartat;

				var updateInfo = [];
				RB_activeLayerIndexSet.forEach(function(layerIndex, i) {
					var layerData = RB_activeLayerDataSet[i];
					var undoObj = {};
					var redoObj = $.extend({}, tr);
					for (var prop in redoObj) {
						undoObj[prop] = layerData.transition[prop];
					}

					updateInfo.push({
						itemIndex: layerIndex,
						undo: undoObj,
						redo: redoObj
					});

					$.extend(layerData.transition, redoObj);
					RB_DataSource.buildLayer();
				});

				RB_UndoManager.add('layer.transition', RB_l10n.SBUndoPasteSettings, updateInfo);

				$slider.rbSlider('destroy');
				kmUI.overlay.$element.click();
				runEasyMode();
			});
		});

		// load MISC options
		$.getJSON(ajaxurl, {action: 'rb_get_shop_params'}, function(params) {
			rbSliderData.properties.position = 'position' in rbSliderData.properties ? rbSliderData.properties.position : 10;
			$position = $('<input>', { name: 'position', type: 'number', value: rbSliderData.properties.position });
			createParamTr(params.position, $position).prependTo('.rb-settings-contents tbody:last');

			rbSliderData.properties.groups = typeof rbSliderData.properties.groups == 'string' ? JSON.parse(rbSliderData.properties.groups) : rbSliderData.properties.groups || [0];
			$groups = createParamSelect(params.groups, 'id_group').attr('multiple', true).val(rbSliderData.properties.groups).css('height', '100%');
			createParamTr(params.groups, $groups).prependTo('.rb-settings-contents tbody:last');

			$tr = $('<tr>');
			$('<td>', {html: params.cats.title}).appendTo($tr);
			$td = $('<td colspan="2">').appendTo($tr);
			rbSliderData.properties.cats = typeof rbSliderData.properties.cats == 'string' ? JSON.parse(rbSliderData.properties.cats) : rbSliderData.properties.cats || ['all'];
			createParamSelect(params.cats, 'value').attr({ multiple: true, style: 'width:auto; height:250px;' }).val(rbSliderData.properties.cats).appendTo($td);
			rbSliderData.properties.pages = typeof rbSliderData.properties.pages == 'string' ? JSON.parse(rbSliderData.properties.pages) : rbSliderData.properties.pages || ['all'];
			createParamSelect(params.pages, 'value').attr({ multiple: true, style: 'width:auto; height:250px;' }).val(rbSliderData.properties.pages).appendTo($td);
			$('<br/><p>'+params.cats.desc+'</p>').appendTo($td);
			$tr.prependTo('.rb-settings-contents tbody:last');

			rbSliderData.properties.lang = parseInt(rbSliderData.properties.lang) || 0;
			$lang = createParamSelect(params.lang, 'id_lang', 1).val(rbSliderData.properties.lang);
			createParamTr(params.lang, $lang).prependTo('.rb-settings-contents tbody:last');
			rbSliderData.properties.shop = parseInt(rbSliderData.properties.shop) || 0;
			$shop = createParamSelect(params.shop, 'id_shop', 1).val(rbSliderData.properties.shop);
			createParamTr(params.shop, $shop).prependTo('.rb-settings-contents tbody:last');
		});

		// v5.x compatibility fix: add root to image URLs, init thumbs, position fix
		var posFix = false, parallax = {};
		if (rbSliderData.properties) {
			var props = rbSliderData.properties;
			if (props.pauseonhover === true) $('select[name=pauseonhover]').val(props.pauseonhover = 'enabled');
			if (props.pauseonhover === false) $('select[name=pauseonhover]').val(props.pauseonhover = 'disabled');
			if (root && props.backgroundimage && props.backgroundimage.indexOf(imgs) == 0) {
				props.backgroundimage = root + props.backgroundimage;
			}
			props.backgroundimageThumb = props.backgroundimage;
			// slider background compatibility fixes
			if (props.background_size) props.globalBGSize = props.background_size, delete props.background_size;
			if (props.background_repeat) props.globalBGRepeat = props.background_repeat, delete props.background_repeat;
			if (props.background_position) props.globalBGPosition = props.background_position, delete props.background_position;
			if (props.background_behaviour) props.globalBGAttachment = props.background_behaviour, delete props.background_behaviour;
		}
		for (var i = 0; i < rbSliderData.layers.length; i++) {
			var slide = rbSliderData.layers[i];
			if (!slide.properties && !rbSliderData.layers[i]) {
				// last slide data is null in db
				rbSliderData.layers.pop();
				break;
			}
			if (root && slide.properties && slide.properties.background && slide.properties.background.indexOf(imgs) == 0) {
				slide.properties.background = root + slide.properties.background;
			}
			slide.properties.backgroundThumb = slide.properties.background;
			for (var j = 0; j < slide.sublayers.length; j++) {
				var layer = slide.sublayers[j];
				if (root && layer.image && layer.image.indexOf(imgs) == 0) {
					layer.image = root + layer.image;
				}
				if (posFix && layer.styles.top.indexOf('%') > 0 && layer.styles.left.indexOf('%') > 0) {
					layer.transition.position = 'fixed';
				}
				layer.imageThumb = layer.image;
			}
		}

		// wrap slideprops title to span
		$('.rb-slide-options .row-helper :input:first-child').each(function() {
			if (this.previousSibling && !this.previousElementSibling && this.previousSibling.textContent.trim()) {
				$(this.previousSibling).wrap('<span class="slideproptitle">');
			}
		});

		var $prev = $('<div class="rb-prev-slide button"><span class="dashicons dashicons-controls-skipback">');
		var $next = $('<div class="rb-next-slide button"><span class="dashicons dashicons-controls-skipforward">');
		var $preview = $('<div class="rb-preview-btn button">\
			<svg viewbox="40 40 60 60" class="rb-preview-icon" style="width:16px; height: 16px;">\
				<polygon points="50,40 100,70 100,70 50,100, 50,40" fill="#fff">\
					<animate begin="indefinite" fill="freeze" attributeName="points" dur="500ms" calcMode="spline"\
						to="45,45 95,45 95,95, 45,95 45,45" keyTimes="0; 0.22; 0.33; 0.55; 0.66; 0.88; 1"\
						keySplines="0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1" />\
					<animate begin="indefinite" fill="freeze" attributeName="points" dur="500ms" calcMode="spline"\
						to="50,40 100,70 100,70 50,100, 50,40" keyTimes="0; 0.22; 0.33; 0.55; 0.66; 0.88; 1"\
						keySplines="0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1; 0.1 0.8 0.2 1" />');
		$('<div class="rb-preview-nav">').append($prev, $preview, $next).appendTo('.rb-preview-td');
		var $animate = $preview.find('animate');

		$preview.click(function() {
			$('.rb-preview-button').click();
		});

		$prev.click(function() {
			if ($preview.hasClass('playing')) {
				$('#rb-preview-timeline .rb-nav-prev').click();
			} else {
				$('#rb-layer-tabs .active').prev().click().length || $('#rb-layer-tabs a:not(.unsortable):last').click();
			}
		});

		$next.click(function() {
			if ($preview.hasClass('playing')) {
				$('#rb-preview-timeline .rb-nav-next').click();
			} else {
				$('#rb-layer-tabs .active').next('a:not(.unsortable)').click().length || $('#rb-layer-tabs :first').click();
			}
		});

		new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.attributeName == 'class') {
					var playing = $preview.hasClass('playing') ? 1 : 0;
					setTimeout(function() {
						$animate[playing].beginElement();
						TweenLite.fromTo($preview[0].children[0], 0.3, {rotation: -90 * playing}, {rotation: '+=90'});
					}, 100 * playing + 1);
					$preview.toggleClass('playing');
				}
			});
		}).observe($('.rb-preview-button')[0], {attributes: true});
	}

	// Skin/CSS Editor
	if(location.href.indexOf('controller=AdminRbthemesliderSkin') != -1) {
		$('select[name="skin"]').change(function(e) {
			e.stopImmediatePropagation();
			location.href = 'index.php?controller=AdminRbthemesliderSkin&token='+token+'&skin=' + $(this).children(':selected').val();
		});
	}

	/**
	 * Screen Options tab
	 */
	screenMeta = {
		element: null, // #screen-meta
		toggles: null, // .screen-meta-toggle
		page:    null, // #wpcontent

		init: function() {
			this.element = $('#screen-meta');
			this.toggles = $( '#screen-meta-links' ).find( '.show-settings' );
			this.page    = $('#wpcontent');

			this.toggles.click( this.toggleEvent );
		},

		toggleEvent: function() {
			var panel = $( '#' + $( this ).attr( 'aria-controls' ) );

			if ( !panel.length )
				return;

			if ( panel.is(':visible') )
				screenMeta.close( panel, $(this) );
			else
				screenMeta.open( panel, $(this) );
		},

		open: function( panel, button ) {

			$( '#screen-meta-links' ).find( '.screen-meta-toggle' ).not( button.parent() ).css( 'visibility', 'hidden' );

			panel.parent().show();
			panel.slideDown( 'fast', function() {
				panel.focus();
				button.addClass( 'screen-meta-active' ).attr( 'aria-expanded', true );
			});

			$document.trigger( 'screen:options:open' );
		},

		close: function( panel, button ) {
			panel.slideUp( 'fast', function() {
				button.removeClass( 'screen-meta-active' ).attr( 'aria-expanded', false );
				$('.screen-meta-toggle').css('visibility', '');
				panel.parent().hide();
			});

			$document.trigger( 'screen:options:close' );
		}
	};

	$(function() { screenMeta.init() });

	/**
	 * Help tabs.
	 */
	$('.contextual-help-tabs').delegate('a', 'click', function(e) {
		var link = $(this),
			panel;

		e.preventDefault();

		// Don't do anything if the click is for the tab already showing.
		if ( link.is('.active a') )
			return false;

		// Links
		$('.contextual-help-tabs .active').removeClass('active');
		link.parent('li').addClass('active');

		panel = $( link.attr('href') );

		// Panels
		$('.help-tab-content').not( panel ).removeClass('active').hide();
		panel.addClass('active').show();
	});

});

function rbCloseMediaWindow() {
	var $m = jQuery('#rb-media-window');
	$m.prev().remove();
	$m.remove();
}

/**
 * Fake object to simulate WP's media manager
 */

imgpath= '';

function rbInsertImage(src) {
	wpMediaFrame._state.selection.data = [{
		id: '',
		url: src,
		sizes: {
			full: { url: src }
		}
	}];

	var folder = src.match(/\/images\/(.*\/|)/);
	if (folder) imgpath = folder[1];

	wpMediaFrame.trigger('select');
	rbCloseMediaWindow();
}

wpMediaFrame = {
	open: function() {
		$imgInput = jQuery(this).prev();
		$imgNode = jQuery(this).children().children();
		// Create window
		jQuery('body').prepend( jQuery('<div>', { 'id': 'rb-media-window', 'class': 'rb-modal rb-box' })
			.append( jQuery('<h1>', { 'class': 'header', 'text': 'Image Manager' })
				.append( jQuery('<a>', { 'class': 'dashicons dashicons-no', 'style': 'margin-top:4px;' }).click(rbCloseMediaWindow))
			)
			.append( jQuery('<div>')
				.css('overflow', 'hidden')
				.append( jQuery('<iframe>').attr({
					width: '100%',
					height: '531',
					src: mediamanagerurl
				}).css('border', 'none'))
			)
		);

		// Create overlay
		jQuery('body').prepend( jQuery('<div>', { 'class' : 'rb-overlay'}).click(rbCloseMediaWindow));
	},
	on: function(event, handler) {
		this['on'+event] = handler;
	},
	trigger: function(event) {
		this['on'+event]();
	},
	state: function() {
		return this._state;
	},
	_state: {
		get: function(name) {
			return this[name];
		},
		selection: {
			first: function() {
				this._first = true;
				return this;
			},
			toJSON: function() {
				var first = this._first;
				this._first = false;
				return first ? this.data[0] : this.data;
			},
			data: []
		}
	}
};

wp = {
	media: function() {
		return wpMediaFrame;
	}
};