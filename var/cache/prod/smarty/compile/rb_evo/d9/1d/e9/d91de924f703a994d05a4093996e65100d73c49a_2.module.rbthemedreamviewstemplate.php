<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:38:12
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00b54b6ace1_73489862',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd91de924f703a994d05a4093996e65100d73c49a' => 
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
function content_61f00b54b6ace1_73489862 (Smarty_Internal_Template $_smarty_tpl) {
?><div <?php echo $_smarty_tpl->tpl_vars['attribute_string']->value;?>
>
	<div
		class="<?php if ((isset($_smarty_tpl->tpl_vars['instance']->value['layout'])) && $_smarty_tpl->tpl_vars['instance']->value['layout'] != 'full_width') {?>container <?php }
if ((isset($_smarty_tpl->tpl_vars['instance']->value['rb_class_container'])) && $_smarty_tpl->tpl_vars['instance']->value['rb_class_container'] != '') {
echo $_smarty_tpl->tpl_vars['instance']->value['rb_class_container'];?>
 <?php }?>rb-container rb-column-gap-<?php echo htmlspecialchars(Tools::safeOutput($_smarty_tpl->tpl_vars['instance']->value['gap']), ENT_QUOTES, 'UTF-8');?>
"
	>
        <div class="row"><?php }
}
