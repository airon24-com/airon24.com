<?php
/* Smarty version 3.1.39, created on 2022-01-28 20:55:20
  from 'module:rbthemefunctionviewstempl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f44a2807fd46_23610630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0a2e88a32c4110ca7f8f94f68e1eec695b19c3f' => 
    array (
      0 => 'module:rbthemefunctionviewstempl',
      1 => 1641242528,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:rbthemefunction/views/templates/hook/rb-cart.tpl' => 1,
  ),
),false)) {
function content_61f44a2807fd46_23610630 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['cart'], ENT_QUOTES, 'UTF-8');?>
" method="post" class="add-to-cart-or-refresh">
	<input type="hidden" name="token" value="<?php if (((isset($_smarty_tpl->tpl_vars['static_token']->value)))) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');
}?>">
	<input type="hidden" name="id_product" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" class="product_page_product_id">
	<input type="hidden" name="qty" value="1">

	<?php $_smarty_tpl->_subTemplateRender('module:rbthemefunction/views/templates/hook/rb-cart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</form><?php }
}
