<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-live-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243670603_17610134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ed2e04dbf7086fbf3c0d66a3c9b87b2493ac547' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-live-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243670603_17610134 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-tabs-controls">
	<ul>
		<# _.each( elementData.tabs_controls, function( tabTitle, tabSlug ) { #>
			<# if (tabSlug == 'content') { #>
				<li class="rb-tab-control-{{ tabSlug }}">
					<a href="#" data-tab="{{ tabSlug }}">
						{{{ tabTitle }}}
					</a>
				</li>
			<# } #>
		<# } ); #>
	</ul>
</div>
<div class="rb-controls"></div><?php }
}
