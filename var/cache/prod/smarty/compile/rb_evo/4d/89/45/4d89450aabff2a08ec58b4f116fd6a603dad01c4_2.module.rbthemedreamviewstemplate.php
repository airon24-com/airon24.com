<?php
/* Smarty version 3.1.39, created on 2022-01-28 06:05:54
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f379b2940d30_63309420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d89450aabff2a08ec58b4f116fd6a603dad01c4' => 
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
function content_61f379b2940d30_63309420 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-image-hotspots-wrapper">
	<?php $_smarty_tpl->_assignInScope('has_caption', !empty($_smarty_tpl->tpl_vars['instance']->value['caption']));?>

	<?php echo $_smarty_tpl->tpl_vars['image_html']->value;?>


	<div class="rb-image-hotspots">
		<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

	</div>
</div><?php }
}
