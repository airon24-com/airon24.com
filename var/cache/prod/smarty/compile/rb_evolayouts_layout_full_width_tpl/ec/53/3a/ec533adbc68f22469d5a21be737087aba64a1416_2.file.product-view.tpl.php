<?php
/* Smarty version 3.1.39, created on 2022-01-28 20:55:20
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f44a28092dc1_10743516',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec533adbc68f22469d5a21be737087aba64a1416' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-view.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f44a28092dc1_10743516 (Smarty_Internal_Template $_smarty_tpl) {
?><a class="rb-view-button btn btn-primary" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View more','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" rel="nofollow">
	<div class="hover_fly_btn_inner">
		<span><?php if ((isset($_smarty_tpl->tpl_vars['is_select_options']->value)) && $_smarty_tpl->tpl_vars['is_select_options']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select options','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View more','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );
}?></span>
	</div>
</a><?php }
}
