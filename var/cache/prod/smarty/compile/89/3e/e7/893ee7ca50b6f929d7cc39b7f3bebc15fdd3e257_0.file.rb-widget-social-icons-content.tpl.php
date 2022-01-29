<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-social-icons-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724379a268_95113541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '893ee7ca50b6f929d7cc39b7f3bebc15fdd3e257' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-social-icons-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f1724379a268_95113541 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'social-icons'), 0, false);
?>

<div class="rb-widget-container">
	<div class="rb-social-icons-wrapper">
		<# _.each( settings.social_icon_list, function( item ) {
			var link = item.link ? item.link.url : '',
				social = item.social.replace( 'fa fa-', '' ); #>
			<a class="rb-icon rb-social-icon rb-social-icon-{{ social }}" href="{{ link }}">
				<i class="{{ item.social }}"></i>
			</a>
		<# } ); #>
	</div>
</div><?php }
}
