<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:54
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d46648fe62_75274127',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a641ac1d55dbc8db927079039326fd16671fbe7' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d46648fe62_75274127 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_34552362461f3d466483f14_93634340', 'product_miniature_item');
?>

<?php }
/* {block 'product_miniature_item'} */
class Block_34552362461f3d466483f14_93634340 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_34552362461f3d466483f14_93634340',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['rb_list']->value)) && $_smarty_tpl->tpl_vars['rb_list']->value != '') {?>
      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-list/product-".((string)$_smarty_tpl->tpl_vars['rb_list']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php } elseif (Configuration::get('RBTHEMEDREAM_PRODUCT_LIST') != '') {?>
      <?php $_smarty_tpl->_assignInScope('rb_list', Configuration::get('RBTHEMEDREAM_PRODUCT_LIST'));?>

      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-list/product-".((string)$_smarty_tpl->tpl_vars['rb_list']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-list/product-1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php }
}
}
/* {/block 'product_miniature_item'} */
}
