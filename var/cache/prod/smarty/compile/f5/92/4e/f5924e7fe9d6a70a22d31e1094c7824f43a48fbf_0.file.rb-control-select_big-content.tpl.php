<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select_big-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436dfa14_73153781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5924e7fe9d6a70a22d31e1094c7824f43a48fbf' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select_big-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436dfa14_73153781 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<select data-setting="{{ data.name }}" 	<# if ( data.multiple ) { #> multiple <# } #>>
				<# _.each( data.options, function( option_title, option_value ) { #>
				<option value="{{ option_value }}">{{{ option_title }}}</option>
				<# } ); #>
			</select>
		</div>
	</div>

	<# if ( data.description ) { #>
	<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
