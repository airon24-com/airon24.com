<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-map-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437aafb6_55033195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4075c8ca06a2268d855030003412b33e6d2996' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-map-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437aafb6_55033195 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'google_maps'), 0, false);
?>

<div class="rb-widget-container">
	<#
		if (settings.address && settings.address != '') {
			let zoom = Number(settings.zoom.size) == 0 ? 10 : Number(settings.zoom.size);
			let map = settings.height.size && settings.height.size != '' ? settings.height.size + settings.height.unit : '400px';
	#>
	<div class="rb-custom-embed">
		<iframe
			height="{{ map }}"
			frameborder="0"
			scrolling="{{ settings.prevent_scroll }}"
			marginheight="0"
			marginwidth="0"
			src="https://maps.google.com/maps?q={{ encodeURI(settings.address) }}&amp;t=m&amp;z={{ Number(settings.zoom.size) }}&amp;output=embed&amp;iwloc=near"
		></iframe>
	</div>
	<#
		}
	#>
</div><?php }
}
