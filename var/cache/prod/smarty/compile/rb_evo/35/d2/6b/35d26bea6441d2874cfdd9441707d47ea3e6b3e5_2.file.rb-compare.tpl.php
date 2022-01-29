<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/modules/rbthemefunction/views/templates/hook/rb-compare.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00983877034_72423011',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d26bea6441d2874cfdd9441707d47ea3e6b3e5' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/modules/rbthemefunction/views/templates/hook/rb-compare.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00983877034_72423011 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_compare']->value['url'], ENT_QUOTES, 'UTF-8');?>
" data-id_product="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Comparison','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" class="rb-compare-link rb-btn-product <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_class']->value, ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">
	<i class="icon-Icon_Compare"></i>
	<span class="icon-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Compare','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
</a><?php }
}
