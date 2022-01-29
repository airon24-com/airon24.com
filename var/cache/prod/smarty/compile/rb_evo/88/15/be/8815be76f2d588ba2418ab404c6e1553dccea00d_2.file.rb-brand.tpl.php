<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:38:12
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-brand.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00b54d9eb88_92757529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8815be76f2d588ba2418ab404c6e1553dccea00d' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-brand.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00b54d9eb88_92757529 (Smarty_Internal_Template $_smarty_tpl) {
?><h3 class="h3 product-brand" itemprop="brand">
	<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brand: ','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>
</span>
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value, ENT_QUOTES, 'UTF-8');?>
" tabindex="0"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
</h3><?php }
}
