/**
* 2007-2020 PrestaShop
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
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
$(document).ready(function() {
	if ($('#product').length > 0) {
		scrollJs();
		ChangeQty();
		ChangeNumberQty();
		changeCombi();

		prestashop.on('updatedProduct', function() {
			var min = Number($('#add-to-cart-or-refresh input[name$="qty"]').attr('min'));
			var qty = Number($('#add-to-cart-or-refresh input[name$="qty"]').val());

			$('input[name$="qty"]').attr('min', min);
			$('input[name$="qty"]').val(qty);

			let html = $('#add-to-cart-or-refresh .product-variants').html();
			$('#rb-product-cart .product-variants').html('<div class="product-variants">'+html+'</div>');

			changeCombi();
			ChangeQty();
		});

		$('#rb-product-cart .add-to-cart').click(function() {
			$('#add-to-cart-or-refresh .add-to-cart').trigger('click');
		});
	}
});

function ChangeNumberQty()
{
	$('#rb-product-cart .btn-touchspin').mousedown(function() {
		var input = $(this).closest('.rb-product-add-to-cart').find('input[name$="qty"]');
		var num = Number(input.attr('min'));
		var qty = Number(input.val());

		if ($(this).hasClass('bootstrap-touchspin-up')) {
			qty = qty + num;

			$('input[name$="qty"]').val(qty);
		} else {
			if (qty <= num) {
				qty = num;
			} else {
				qty = qty - num;
			}

			$('input[name$="qty"]').val(qty);
		}
	});
}

function scrollJs()
{
	var offset = $('#add-to-cart-or-refresh .product-discounts').offset();
	var top = offset.top;

	$(window).scroll(function(event) {
		pos_body = $('html,body').scrollTop();

		if (pos_body > top) {
			$('#rb-product-cart').addClass('rb-active');
		} else {
			$('#rb-product-cart').removeClass('rb-active');
		}
	});
}

function ChangeQty()
{
	$('input[name$="qty"]').change(function() {
		var val = $(this).val();
		$('input[name$="qty"]').val(val);
	});

	$('#rb-product-cart input[name$="qty"]').keyup(function() {
		var val = $(this).val();
		$('input[name$="qty"]').val(val);
	});
}

function changeCombi()
{
	$('#rb-product-cart li input').click(function(e) {
		var val = $(this).val();

		$('#add-to-cart-or-refresh li input').each(function() {
			if (val == $(this).val()) {
				$(this).trigger('click');
			}
		});
	});

	var old_url = $('#add-to-cart-or-refresh').serialize();

	$('#rb-product-cart select').change(function(e) {
		var id = $(this).closest('select').attr('id');
		var val_s = $(this).val();
		$('#add-to-cart-or-refresh #' + id + ' option').attr('selected', false);

		$('#add-to-cart-or-refresh #' + id + ' option').each(function() {
			if ($(this).val() == val_s) {
				$(this).attr('selected', true);
			}
		});

		var new_url = $('#add-to-cart-or-refresh').serialize();

		$(document).ajaxSend(function(event, jqxhr, settings) {
			if (typeof settings.data != 'undefined' && settings.data.indexOf('ajax=1&action=refresh') != -1) {
				settings.url = settings.url.replace(old_url, new_url);
			}
		});
	});
}
