<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-icon-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243779949_98199156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27720db4096b540105ebd7a750199dcef9b953e6' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-icon-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243779949_98199156 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'icon'), 0, false);
?>

<div class="rb-widget-container">
	<# var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
	iconTag = link ? 'a' : 'div'; #>
	<div class="rb-icon-wrapper">
		<{{{ iconTag }}} class="rb-icon rb-animation-{{ settings.hover_animation }}" {{{ link }}}>
			<i class="{{ settings.icon }}"></i>
		</{{{ iconTag }}}>
	</div>
</div><?php }
}
