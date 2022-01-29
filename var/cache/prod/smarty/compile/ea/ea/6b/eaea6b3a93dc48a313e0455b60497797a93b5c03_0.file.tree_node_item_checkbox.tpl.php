<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/admin671dxwfsm/themes/default/template/helpers/tree/tree_node_item_checkbox.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d4616c33e4_85724990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaea6b3a93dc48a313e0455b60497797a93b5c03' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/admin671dxwfsm/themes/default/template/helpers/tree/tree_node_item_checkbox.tpl',
      1 => 1641225152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d4616c33e4_85724990 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="tree-item<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> tree-item-disable<?php }?>">
	<span class="tree-item-name<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> tree-item-name-disable<?php }?>">
		<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['node']->value['id_category'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> disabled="disabled"<?php }?> />
		<i class="tree-dot"></i>
		<label class="tree-toggler"><?php echo $_smarty_tpl->tpl_vars['node']->value['name'];?>
</label>
	</span>
</li>
<?php }
}
