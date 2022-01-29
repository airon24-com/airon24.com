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
(function($){

	window._RbSlider.plugins.origami = function( rb, $slider, sliderUID, userSettings ){

		var or = this;

		or.pluginData = {
			name: 'Origami Slide Transition Plugin for RbThemeSlider',
			version: '1.1',
			requiredRBVersion: '6.6.0',
			authorName: 'Kreatura',
			releaseDate: '2017. 10. 04.'
		};

		or.pluginDefaults = {
			eventNamespace: 'OR',
			opacity : 0.25,
			maxTiles : 4
		};

		or.init = function(){
			or.extendRbSlider();
		};

		or.extendRbSlider = function(){

			rb.transitions.slide.origami = {

				start: function(){

					rb.slider.ceilRatio = Math.ceil( rb.slider.width / rb.slider.height );
					this.blocksNum = rb.slider.ceilRatio > or.pluginDefaults.maxTiles ? or.pluginDefaults.maxTiles : rb.slider.ceilRatio;
					this.blocksNum = Math.floor( Math.random() * this.blocksNum ) + 1;

					this.addBlocks();
				},

				getDirection: function( index ){

					var curDir = this.lastDir;

					while( this.lastDir == curDir ){

						if( this.blocksNum > 1 ){

							if( index === 0 ){
								curDir = ['right','top','right','bottom'][Math.floor( Math.random()*4 )];
							}else if( index == this.blocksNum - 1 ){
								curDir = ['left','top','left','bottom'][Math.floor( Math.random()*4 )];
							}else{
								curDir = ['top','bottom'][Math.floor( Math.random()*2 )];
							}
						}else{
							curDir = ['left','top','right','bottom'][Math.floor( Math.random()*4 )];
						}
					}

					this.lastDir = curDir;
					return curDir;
				},

				addBlocks: function(){

					// CREATE: blocks with even number of width
					var	newWidth = rb.slider.width % 2 === 0 ? rb.slider.width : rb.slider.width + 1,
						blockWidth = newWidth / this.blocksNum % 2 === 0 ? newWidth / this.blocksNum : newWidth / this.blocksNum - newWidth / this.blocksNum % 2,
						blockHeight = rb.slider.height % 2 === 0 ? rb.slider.height : rb.slider.height + 1,
						curBlockLeft = 0;

					for( var index=0; index<this.blocksNum; index++ ){

						var	zIndex = this.blocksNum - Math.abs( Math.floor( this.blocksNum / 2 ) - index ) - Math.floor( this.blocksNum / 2 ),
							curDir = this.getDirection( index ),
							curBlockWidth = blockWidth;

						if( newWidth / this.blocksNum % 2 !== 0 && index % 2 === 0 ){
							if( ( newWidth - blockWidth * this.blocksNum ) / 2 < this.blocksNum ){
								curBlockWidth += 2;
							}
						}

						// last block
						if( index === this.blocksNum - 1 && curBlockLeft + curBlockWidth !== newWidth ){
							curBlockWidth = newWidth - curBlockLeft;
						}

						if( index === this.blocksNum - 1 && newWidth !== rb.slider.width ){
							curBlockLeft -= 1;
						}

						var curBlock = rb.transitions.slide.origami.createBlock( 'rb-origami-' + curDir, curBlockWidth, blockHeight, curBlockLeft, 0 ).data( { 'direction' : curDir } );

						curBlock.css({
							zIndex: zIndex
						});

						this.appendTiles( curBlock, curBlockLeft, curDir, index );

						curBlockLeft += curBlockWidth;
					}

					// START: origami slide transition
					rb.transitions.slide.start();
				},

				createBlock: function( className, width, height, left, top ){

					var curBlock = $('<div>').addClass( 'rb-origami-block ' + className ).css({
						width : width,
						height : height,
						left : left,
						top : top
					}).appendTo( rb.transitions.slide.$wrapper );

					return curBlock;
				},

				appendTiles: function( curBlock, curBlockLeft, curDir, index ){

					// APPEND: slide transition wrapper into layers wrapper
					rb.transitions.slide.$wrapper.prependTo( rb.slider.$layersWrapper );

					var style;

					switch( curDir ){
						case 'left':
						case 'right':
							style = { width : curBlock.width() / 2 };
						break;
						case 'top':
						case 'bottom':
							style = { height : curBlock.height() / 2 };
						break;
					}

					// CREATE: four tiles in every block
					var	t1 = $( '<div>' ).css( style ).addClass( 'rb-origami-tile rb-origami-cur' ).appendTo( curBlock ),
						t2 = $( '<div>' ).css( style ).addClass( 'rb-origami-tile rb-origami-cur' ).appendTo( t1 ),
						t3 = $( '<div>' ).css( style ).addClass( 'rb-origami-tile rb-origami-next' ).appendTo( t2 ),
						t4 = $( '<div>' ).css( style ).addClass( 'rb-origami-tile rb-origami-next' ).appendTo( t3 );

					curBlock.find( '.rb-origami-tile' ).each(function(){

						var	curNext = $(this).hasClass( 'rb-origami-next' ) ? 'next' : 'current',
							curImgHolder = $('<div>').addClass( 'rb-origami-image-holder' ).appendTo( $(this) );

						// SET: slide background image positions iside tiles
						if( rb.slides[curNext].data.$background ){

							var	p = $(this).parent(),
								marginLeft,
								marginTop;

							switch( curBlock.data( 'direction' ) ){

								case 'left':
									switch( curNext ){
										case 'current':
											marginLeft = $(this).position().left;
											while( !p.is( '.rb-origami-block' ) ){
												marginLeft += p.position().left;
												p = p.parent();
											}
										break;
										case 'next':
											marginLeft = 0;
											while( !p.is( '.rb-origami-cur' ) ){
												marginLeft += p.position().left;
												p = p.parent();
											}
										break;
									}
									marginLeft = -curBlockLeft - marginLeft;
								break;

								case 'right':
									switch( curNext ){
										case 'current':
											marginLeft = - $(this).position().left;
											while( !p.is( '.rb-origami-block' ) ){
												marginLeft -= p.position().left;
												p = p.parent();
											}
										break;
										case 'next':
											marginLeft = $(this).position().left;
											while( !p.is( '.rb-origami-cur' ) ){
												marginLeft -= p.position().left;
												p = p.parent();
											}
										break;
									}
									marginLeft =  -curBlockLeft + marginLeft;
								break;

								case 'top':
									switch( curNext ){
										case 'current':
											marginTop = - $(this).position().top;
											while( !p.is( '.rb-origami-block' ) ){
												marginTop -= p.position().top;
												p = p.parent();
											}
										break;
										case 'next':
										marginTop = 0;
											while( !p.is( '.rb-origami-cur' ) ){
												marginTop -= p.position().top;
												p = p.parent();
											}
										break;
									}
									marginLeft = -curBlockLeft;
								break;

								case 'bottom':
									switch( curNext ){
										case 'current':
											marginTop = - $(this).position().top;
											while( !p.is( '.rb-origami-block' ) ){
												marginTop -= p.position().top;
												p = p.parent();
											}
										break;
										case 'next':
											marginTop = $(this).position().top;
											while( !p.is( '.rb-origami-cur' ) ){
												marginTop -= p.position().top;
												p = p.parent();
											}
										break;
									}
									marginLeft = -curBlockLeft;
								break;
							}

							// APPLY: style settings
							var	kbFromTo = rb.o.playByScroll && rb.device.scroll.direction === 'up' ? 'to' : 'from',
								curNextSlide = curNext === 'current' ? rb.transitions.curSlide : rb.transitions.nextSlide,
								slideBGData = curNextSlide.data.$background.data( rb.defaults.init.dataKey ),
								slideBGKenBurnsData = slideBGData.kenBurns[kbFromTo],
								BGSrc = curNextSlide.data.$background ? rb.functions.getURL( curNextSlide.data.$background ) : false,
								curImg = $( '<img>' ).appendTo( curImgHolder ).attr( 'src', BGSrc ).css({
									width: slideBGData.responsive.width,
									height: slideBGData.responsive.height,
									'-webkit-filter': slideBGData.responsive.filter,
									filter: slideBGData.responsive.filter,
									marginLeft: marginLeft,
									marginTop: marginTop,
									outline: '1px solid transparent'
								});

								switch( curNext ){
									case 'current':
										curImg.css({
											'-ms-transform': 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px)' + slideBGData.responsive.kbRotation + slideBGData.responsive.kbScale,
											'-webkit-transform': 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px)' + slideBGData.responsive.kbRotation + slideBGData.responsive.kbScale,
											transform: 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px)' + slideBGData.responsive.kbRotation + slideBGData.responsive.kbScale
										});
									break;
									case 'next':
										curImg.css({
											'-ms-transform': 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px) rotate(' + slideBGKenBurnsData.rotation + 'deg) scale(' + slideBGKenBurnsData.scale + ')',
											'-webkit-transform': 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px) rotate(' + slideBGKenBurnsData.rotation + 'deg) scale(' + slideBGKenBurnsData.scale + ')',
											transform: 'translateX(' + ( slideBGData.responsive.x ) + 'px) translateY(' + ( slideBGData.responsive.y ) + 'px) rotate(' + slideBGKenBurnsData.rotation + 'deg) scale(' + slideBGKenBurnsData.scale + ')'
										});
									break;
								}

							// APPEND: element for emulating shadows / lights
							$( '<div>' ).addClass( 'rb-light' ).appendTo( curImgHolder );
						}
					});

					this.setTransition( curBlock, curDir, t1, t2, t3, t4, index );
				},

				setTransition: function( curBlock, curDir, t1, t2, t3, t4, index ){

					var	tl = curBlock.find( '.rb-light' ).addClass( 'rb-black' ),
						t1l = t1.find( '> .rb-origami-image-holder > img' ),
						t2l = t2.find( '> .rb-origami-image-holder > img' ),
						t3l = t3.find( '> .rb-origami-image-holder > img' ),
						t4l = t4.find( '> .rb-origami-image-holder > img' ),
						duration = 2,
						halfDuration = duration / 2,
						easing = rb.gsap.Cubic.easeInOut,
						o = or.pluginDefaults.opacity,
						o2 = o * 1.5;

					switch( curDir ){

						case 'left':

							// Transition of tiles
							rb.transitions._slideTransition.to( t1[0], duration, {
								ease: easing,
								rotationY: 90
							}, 0 ).to( t2[0], duration, {
								ease: easing,
								rotationY: -180
							}, 0 ).fromTo( t3[0], duration, {
								rotationY: 130
							},{
								ease: easing,
								rotationY: 90
							}, 0 ).fromTo( t4[0], duration, {
								rotationY: 90
							},{
								ease: easing,
								rotationY: 0
							}, halfDuration );

						break;

						case 'right':

							// Transition of tiles
							rb.transitions._slideTransition.to( t1[0], duration, {
								ease: easing,
								rotationY: -90
							}, 0 ).to( t2[0], duration, {
								ease: easing,
								rotationY: 180
							}, 0 ).fromTo( t3[0], duration, {
								rotationY: -130
							},{
								ease: easing,
								rotationY: -90
							}, 0 ).fromTo( t4[0], duration, {
								rotationY: -90
							},{
								ease: easing,
								rotationY: 0
							}, halfDuration );

						break;

						case 'top':

							// Transition of tiles
							rb.transitions._slideTransition.to( t1[0], duration, {
								ease: easing,
								rotationX: -90
							}, 0 ).to( t2[0], duration, {
								ease: easing,
								rotationX: 180
							}, 0 ).fromTo( t3[0], duration, {
								rotationX: -130
							},{
								ease: easing,
								rotationX: -90
							}, 0 ).fromTo( t4[0], duration, {
								rotationX: -90
							},{
								ease: easing,
								rotationX: 0
							}, halfDuration );

						break;

						case 'bottom':

							// Transition of tiles
							rb.transitions._slideTransition.to( t1[0], duration, {
								ease: easing,
								rotationX: 90
							}, 0 ).to( t2[0], duration, {
								ease: easing,
								rotationX: -180
							}, 0 ).fromTo( t3[0], duration, {
								rotationX: 130
							},{
								ease: easing,
								rotationX: 90
							}, 0 ).fromTo( t4[0], duration, {
								rotationX: 90
							},{
								ease: easing,
								rotationX: 0
							}, halfDuration );

						break;
					}

					// Transition of lights
					rb.transitions._slideTransition.to( t1l[0], duration, {
						ease: easing,
						opacity: o2
					}, 0 ).to( t2l[0], duration, {
						ease: easing,
						opacity: o
					}, 0 ).fromTo( t3l[0], duration, {
						opacity: o2
					},{
						ease: easing,
						opacity: 1
					}, 0 ).fromTo( t4l[0], duration, {
						opacity: o2
					},{
						ease: easing,
						opacity: 1
					}, halfDuration );
				}
			};

			rb.transitions.slide.select.slideTransitionType = function(){
				if( rb.slides.next.data.transitionorigami && rb.browser.supports3D ){
					if( ( rb.transitions.nextSlide.data.transition3d || rb.transitions.nextSlide.data.transition2d ) && ( Math.floor(Math.random() * 2) + 1 ) === 1 ){
						rb.transitions.slide.normal.select.transitionType();
					}else{
						rb.transitions.slide.origami.start();
					}
				}else{
					rb.transitions.slide.normal.select.transitionType();
				}
			};
		};
	};

})(jQuery, undefined);
