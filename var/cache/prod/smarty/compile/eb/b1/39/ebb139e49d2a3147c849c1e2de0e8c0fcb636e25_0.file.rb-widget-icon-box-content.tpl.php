<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-icon-box-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724377d1e5_92965934',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebb139e49d2a3147c849c1e2de0e8c0fcb636e25' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-icon-box-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f1724377d1e5_92965934 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'icon-box'), 0, false);
?>

<div class="rb-widget-container">
	<# var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
		iconTag = link ? 'a' : 'span'; #>
	<div class="rb-icon-box-wrapper">
		<div class="rb-icon-box-icon">
			<{{{ iconTag + ' ' + link }}} class="rb-icon rb-animation-{{ settings.hover_animation }}">
			<i class="{{ settings.icon }}"></i>
			</{{{ iconTag }}}>
		</div>
		<div class="rb-icon-box-content">
			<{{{ settings.title_size }}} class="rb-icon-box-title">
			<{{{ iconTag + ' ' + link }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
			</{{{ settings.title_size }}}>
			<div class="rb-icon-box-description">{{{ settings.description_text }}}</div>
		</div>
	</div>
</div><?php }
}
