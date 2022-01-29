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

	var $selectedRevision 	= $('#rb-revisions-selected'),
		$revisionId 		= $('#revision-id');


	$('#rb-revisions-range').on('input', function() {

		// Update data source
		window.selectedRevision = window.rbRevisions[ ($(this).val()-1) ];
		window.rbSliderData = window.selectedRevision.data;

		if( (RB_activeSlideIndex+1) > window.rbSliderData.layers.length ) {
			RB_activeSlideIndex = window.rbSliderData.layers.length - 1;
		}

		window.RB_activeSlideData = window.rbSliderData.layers[ RB_activeSlideIndex ];
		window.RB_activeLayerIndexSet = [0];

		// Update revision details
		$('img', $selectedRevision).attr('src', window.selectedRevision.avatar);
		$('.author', $selectedRevision).text( window.selectedRevision.nickname );
		$('.time-diff', $selectedRevision).text( window.selectedRevision.time_diff );
		$('.date', $selectedRevision).text( window.selectedRevision.created );

		// Update revision ID
		$revisionId.val( window.selectedRevision.id );

		// Update UI
		RbSlider.rebuildSlides();
		RbSlider.stopSlidePreview();
		RbSlider.generatePreview();
	});

	$('.rb-revisions-options').click(function(e) {
		e.preventDefault();
		kmUI.modal.open('#tmpl-revisions-options', { width: 700, height: 560 });
		$('#rb-revisions-modal-window input:checkbox').customCheckbox();

		$('#rb-revisions-modal-window .rb-checkbox').click(function(e) {

			if( ! $(this).hasClass('off') ) {
				if( ! confirm( $(this).data('warning') ) ) {
					e.preventDefault();
					return false;
				}
			}
		});
	});
});