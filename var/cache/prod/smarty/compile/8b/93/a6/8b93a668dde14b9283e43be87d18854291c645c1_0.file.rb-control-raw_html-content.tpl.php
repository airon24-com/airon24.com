<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-raw_html-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436fa621_65359770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b93a668dde14b9283e43be87d18854291c645c1' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-raw_html-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436fa621_65359770 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<# if ( data.label ) { #>
		<span class="rb-control-title">{{{ data.label }}}</span>
	<# } #>
	<div class="rb-control-raw-html {{ data.classes }}">{{{ data.raw }}}</div>
</div><?php }
}
