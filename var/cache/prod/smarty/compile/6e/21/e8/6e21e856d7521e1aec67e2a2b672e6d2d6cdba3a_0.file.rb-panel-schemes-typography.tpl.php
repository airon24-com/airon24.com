<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-schemes-typography.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243673b20_03716802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e21e856d7521e1aec67e2a2b672e6d2d6cdba3a' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-schemes-typography.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243673b20_03716802 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-panel-scheme-buttons">
	<div class="rb-panel-scheme-button-wrapper rb-panel-scheme-reset">
		<button class="rb-button">
			<i class="fa fa-undo"></i>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</button>
	</div>
	<div class="rb-panel-scheme-button-wrapper rb-panel-scheme-discard">
		<button class="rb-button">
			<i class="fa fa-times"></i>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discard','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</button>
	</div>
	<div class="rb-panel-scheme-button-wrapper rb-panel-scheme-save">
		<button class="rb-button rb-button-success" disabled><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</button>
	</div>
</div>
<div class="rb-panel-scheme-items"></div><?php }
}
