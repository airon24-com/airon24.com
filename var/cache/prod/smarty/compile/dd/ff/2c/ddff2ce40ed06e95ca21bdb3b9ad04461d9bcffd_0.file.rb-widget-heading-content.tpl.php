<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-heading-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724375a262_55415102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ddff2ce40ed06e95ca21bdb3b9ad04461d9bcffd' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-heading-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f1724375a262_55415102 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'heading'), 0, false);
?>

<div class="rb-widget-container">
	<#
		if ( '' !== settings.title ) {
			var title_html = '<' + settings.header_size  + ' class="rb-heading-title rb-size-' + settings.size + ' ' +  settings.header_style + '"><span>' + settings.title + '</span></' + settings.header_size + '>';
		}
		
		if ( '' !== settings.link.url ) {
			var title_html = '<' + settings.header_size  + ' class="rb-heading-title rb-size-' + settings.size + ' ' +  settings.header_style + '"><a href="' + settings.link.url + '"><span>' + title_html + '</span></a></' + settings.header_size + '>';
		}

		print( title_html );
	#>
</div>
<?php }
}
