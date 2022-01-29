<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-column.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d461960c84_87883117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80a60eb221554474fa746856fffb58a50666f390' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-column.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d461960c84_87883117 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
    <li data-id-column="<?php echo intval($_smarty_tpl->tpl_vars['column']->value['id_column']);?>
" class="rb_columns_li item<?php echo intval($_smarty_tpl->tpl_vars['column']->value['id_column']);?>
 column_size_<?php echo intval($_smarty_tpl->tpl_vars['column']->value['column_size']);?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>rb_breaker<?php }?>" data-obj="column">
<?php }?>

<div class="rb_buttons">
    <span class="rb_column_delete" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
    <span class="rb_duplicate" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
    <span class="rb_column_edit" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
    <div class="rb_add_block btn btn-default" data-id-column="<?php echo intval($_smarty_tpl->tpl_vars['column']->value['id_column']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>    
</div>
<ul class="rb_blocks_ul">
    <?php if ((isset($_smarty_tpl->tpl_vars['column']->value['blocks'])) && $_smarty_tpl->tpl_vars['column']->value['blocks']) {?>                                                    
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value['blocks'], 'block');
$_smarty_tpl->tpl_vars['block']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->do_else = false;
?>
            <li data-id-block="<?php echo intval($_smarty_tpl->tpl_vars['block']->value['id_block']);?>
" class="rb_blocks_li <?php if (!$_smarty_tpl->tpl_vars['block']->value['enabled']) {?>rb_disabled<?php }?> item<?php echo intval($_smarty_tpl->tpl_vars['block']->value['id_block']);?>
" data-obj="block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbItemBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                                                    
    <?php }?>
</ul>

<?php if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
    </li>
<?php }
}
}
