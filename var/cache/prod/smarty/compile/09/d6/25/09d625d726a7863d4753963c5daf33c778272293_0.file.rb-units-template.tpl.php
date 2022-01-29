<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-units-template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724370cc17_73642688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09d625d726a7863d4753963c5daf33c778272293' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-units-template.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724370cc17_73642688 (Smarty_Internal_Template $_smarty_tpl) {
?><# if ( data.size_units.length > 1 ) { #>
	<div class="rb-units-choices">
		<# _.each( data.size_units, function( unit ) { #>
		<input id="rb-choose-{{ data._cid + data.name + unit }}" type="radio" name="rb-choose-{{ data.name }}" data-setting="unit" value="{{ unit }}">
		<label class="rb-units-choices-label" for="rb-choose-{{ data._cid + data.name + unit }}">{{{ unit }}}</label>
		<# } ); #>
	</div>
<# } #><?php }
}
