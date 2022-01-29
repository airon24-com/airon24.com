<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:54
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d466352797_34548851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c02ca648752e3bc365af6f8f715b89caf998ee7' => 
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
function content_61f3d466352797_34548851 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-icon-box-wrapper">
	<div class="rb-icon-box-icon">
		<<?php echo implode(' ',array($_smarty_tpl->tpl_vars['icon_tag']->value,$_smarty_tpl->tpl_vars['icon_attributes']->value,$_smarty_tpl->tpl_vars['link_attributes']->value));?>
>
		<i <?php echo $_smarty_tpl->tpl_vars['rb_i']->value;?>
></i>
		</<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['icon_tag']->value, ENT_QUOTES, 'UTF-8');?>
>
	</div>
	<div class="rb-icon-box-content">
		<<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instance']->value['title_size'], ENT_QUOTES, 'UTF-8');?>
 class="rb-icon-box-title">
		<<?php echo htmlspecialchars(implode(' ',array($_smarty_tpl->tpl_vars['icon_tag']->value,$_smarty_tpl->tpl_vars['link_attributes']->value)), ENT_QUOTES, 'UTF-8');?>
><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instance']->value['title_text'], ENT_QUOTES, 'UTF-8');?>
</<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['icon_tag']->value, ENT_QUOTES, 'UTF-8');?>
>
		</<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instance']->value['title_size'], ENT_QUOTES, 'UTF-8');?>
>
		<div class="rb-icon-box-description"><?php echo $_smarty_tpl->tpl_vars['instance']->value['description_text'];?>
</div>
	</div>
</div><?php }
}
