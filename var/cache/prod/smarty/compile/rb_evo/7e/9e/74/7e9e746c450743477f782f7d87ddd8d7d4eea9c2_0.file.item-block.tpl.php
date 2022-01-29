<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d46196af67_18394153',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e9e746c450743477f782f7d87ddd8d7d4eea9c2' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-block.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d46196af67_18394153 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
    <li data-id-block="<?php echo intval($_smarty_tpl->tpl_vars['block']->value['id_block']);?>
" class="rb_blocks_li <?php if (!$_smarty_tpl->tpl_vars['block']->value['enabled']) {?>rb_disabled<?php }?> item<?php echo intval($_smarty_tpl->tpl_vars['block']->value['id_block']);?>
" data-obj="block">
<?php }?>

<div class="rb_buttons">
    <span class="rb_block_delete" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
    <span class="rb_duplicate" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
    <span class="rb_block_edit" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
</div>

<div class="rb_block_wrapper">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

</div>

<?php if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
    </li>
<?php }
}
}
