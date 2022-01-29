<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-switcher-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436f0766_90583876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56eb9a855ef3c6cc44d3986ce18ac7223767d141' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-switcher-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436f0766_90583876 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<label class="rb-switch">
				<input type="checkbox" data-setting="{{ data.name }}" class="rb-switch-input" value="{{ data.return_value }}">
				<span class="rb-switch-label" data-on="{{ data.label_on }}" data-off="{{ data.label_off }}"></span>
				<span class="rb-switch-handle"></span>
			</label>
		</div>
	</div>
	
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
