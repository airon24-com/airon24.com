<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-repeater-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724372e045_63061111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8791e6632f564cf638db0d9d28e41b07efea6c38' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-repeater-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724372e045_63061111 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<label>
		<span class="rb-control-title">{{{ data.label }}}</span>
	</label>

	<div class="rb-repeater-fields"></div>

	<div class="rb-button-wrapper">
		<button class="rb-button rb-repeater-add">
			<span class="eicon-plus"></span>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Item','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</button>
	</div>
</div><?php }
}
