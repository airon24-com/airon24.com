<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/categories-tree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d461a8c8e4_06652911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc2635cce10c2e88689ec800a644a98eae4dfde8' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/categories-tree.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d461a8c8e4_06652911 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['categories']->value)) && $_smarty_tpl->tpl_vars['categories']->value) {?>
    <ul class="rb_categories">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
            <li <?php if ((isset($_smarty_tpl->tpl_vars['category']->value['sub'])) && $_smarty_tpl->tpl_vars['category']->value['sub']) {?>class="has-sub"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getCategoryLink(intval($_smarty_tpl->tpl_vars['category']->value['id_category']));?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['category']->value['name'],'html','UTF-8' ));?>
</a>
                <?php if ((isset($_smarty_tpl->tpl_vars['category']->value['sub'])) && $_smarty_tpl->tpl_vars['category']->value['sub']) {?>
                    <span class="arrow closed"></span>
                    <?php echo $_smarty_tpl->tpl_vars['category']->value['sub'];?>

                <?php }?>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php }
}
}
