<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:31:33
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/errors/not-found.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f009c56f9521_81619980',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90b22b00b33a8b7698ab38e4ca701405a43f612b' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/errors/not-found.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f009c56f9521_81619980 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
  <section id="content" class="page-content page-not-found">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83930957561f009c56eebb3_94915435', 'page_content');
?>

  </section><?php }
/* {block "error_content"} */
class Block_190656190361f009c56ef495_16554850 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['errorContent']->value))) {?>
    <?php echo $_smarty_tpl->tpl_vars['errorContent']->value;?>

    <?php } else { ?>
    <h3>404</h3>
    <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>' Error .. page not found ','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</h4>
    <p><a class="back" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to home','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</a></p>
    <?php }?>
    <?php
}
}
/* {/block "error_content"} */
/* {block 'hook_not_found'} */
class Block_131124806261f009c56f8399_31041298 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNotFound'),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'hook_not_found'} */
/* {block 'page_content'} */
class Block_83930957561f009c56eebb3_94915435 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_83930957561f009c56eebb3_94915435',
  ),
  'error_content' => 
  array (
    0 => 'Block_190656190361f009c56ef495_16554850',
  ),
  'hook_not_found' => 
  array (
    0 => 'Block_131124806261f009c56f8399_31041298',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190656190361f009c56ef495_16554850', "error_content", $this->tplIndex);
?>

    
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_131124806261f009c56f8399_31041298', 'hook_not_found', $this->tplIndex);
?>


    <?php
}
}
/* {/block 'page_content'} */
}
