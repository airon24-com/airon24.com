<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-accordion-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437a7ab4_29459587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbfab84f21970bbc11c69126f137dbc9490155d5' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-accordion-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437a7ab4_29459587 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'accordion'), 0, false);
?>

<div class="rb-widget-container" >
	<#
		if (settings.active_first && settings.active_first != '') {
			let counter = 1;
	#>
	<div class="rb-accordion" data-active-first="{{ settings.active_first }}">
		<#
			_.each( settings.tabs, function(item) {
		#>
		<div class="rb-accordion-item">
			<div class="rb-accordion-title" data-section="{{ counter }}">
				<span class="rb-accordion-icon rb-accordion-icon-{{ settings.icon_align }}">
					<i class="material-icons rb-open">add</i>
				</span>

				{{ item.tab_title }}
			</div>

			<div class="rb-accordion-content" data-section="{{ counter }}">
				{{ item.tab_content }}
			</div>
		</div>
		<#
				counter++;
			})
		#>
	</div>
	<#
		}
	#>
</div><?php }
}
