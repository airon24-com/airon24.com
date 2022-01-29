<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:38:12
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00b54f09486_74299916',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7455a12110e3352479c975414754395cc0b23d8c' => 
    array (
      0 => 'module:rbthemedreamviewstemplate',
      1 => 1641242528,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00b54f09486_74299916 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8807412761f00b54f08945_77469540', 'rbthemedream');
}
/* {block 'rbthemedream'} */
class Block_8807412761f00b54f08945_77469540 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'rbthemedream' => 
  array (
    0 => 'Block_8807412761f00b54f08945_77469540',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php
}
}
/* {/block 'rbthemedream'} */
}
