<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-link-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437a4115_71308912',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b93508456693358cd9163faed6f8fbab329436f8' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-link-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437a4115_71308912 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'rb_links'), 0, false);
?>

<#
	if (settings.icon_list.length > 0) {
#>
	<div class="rb-widget-container">
		<div class="rb-link {{ settings.caption ? settings.caption : '' }}">
			<#
				_.each( settings.icon_list, function( item ) {
			#>
				<a href="{{ item.url_link ? item.url_link : ''}}">
					{{ item.title_link ? item.title_link : 'Link'}}
				</a>
			<#
				})
			#>
		</div>
	</div>
<#
	}
#><?php }
}
