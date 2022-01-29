<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-checkbox-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436edc70_99995773',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '916a49a59d2fe3f48dcb75cdfe00a128afda749f' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-checkbox-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436edc70_99995773 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<label class="rb-control-title">
		<span>{{{ data.label }}}</span>
		<input type="checkbox" data-setting="{{ data.name }}" />
	</label>
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
