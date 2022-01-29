<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-brand.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172468efe08_42757276',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d7930f16bbfec133dc8958f60f33d954f7d1384' => 
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
function content_61f172468efe08_42757276 (Smarty_Internal_Template $_smarty_tpl) {
?><h3 class="h3 product-brand" itemprop="brand">
	<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brand: ','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>
</span>
	<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" tabindex="0"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a>
</h3><?php }
}
