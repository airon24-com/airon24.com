<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select2-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724373cc01_32093680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58e8824d89496a6e1b11eda8c543c8110bedcf00' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select2-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724373cc01_32093680 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
			<select class="rb-select2" type="select2" {{ multiple }} data-setting="{{ data.name }}">
				<# _.each( data.options, function( option_title, option_value ) {
				var value = data.controlValue;
				if ( typeof value == 'string' ) {
				var selected = ( option_value === value ) ? 'selected' : '';
				} else {
				var selected = ( -1 !== value.indexOf( option_value ) ) ? 'selected' : '';
				}
				#>
					<option {{ selected }} value="{{ option_value }}">{{{ option_title }}}</option>
				<# } ); #>
			</select>
		</div>
	</div>
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
