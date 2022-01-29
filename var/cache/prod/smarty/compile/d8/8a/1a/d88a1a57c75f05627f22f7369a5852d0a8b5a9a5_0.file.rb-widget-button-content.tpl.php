<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-button-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243768f16_95059458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd88a1a57c75f05627f22f7369a5852d0a8b5a9a5' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-button-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243768f16_95059458 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'button'), 0, false);
?>

<div class="rb-widget-container">
	<div class="rb-button-wrapper">
		<a class="rb-button btn btn-{{ settings.button_type }} rb-size-{{ settings.size }} rb-animation-{{ settings.hover_animation }} btn-{{ settings.view }}" href="{{ settings.link.url }}">
			<span class="rb-button-content-wrapper">
				<# if ( settings.icon ) { #>
				<span class="rb-button-icon rb-align-icon-{{ settings.icon_align }}">
					<i class="{{ settings.icon }}"></i>
				</span>
				<# } #>
				<span class="rb-button-text">{{{ settings.text }}}</span>
			</span>
		</a>
	</div>
</div><?php }
}
