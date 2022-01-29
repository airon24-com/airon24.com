<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-image_dimensions-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243723315_10658968',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c169125ad6e016f181c00eb47e46c94577d45ab' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-image_dimensions-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243723315_10658968 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<div class="rb-image-dimensions-field">
				<input type="text" data-setting="width" />
				<div class="rb-image-dimensions-field-description"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Width','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>
			<div class="rb-image-dimensions-separator">x</div>
			<div class="rb-image-dimensions-field">
				<input type="text" data-setting="height" />
				<div class="rb-image-dimensions-field-description"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Height','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>
			<button class="rb-button rb-button-success rb-image-dimensions-apply-button"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</button>
		</div>
	</div>
</div><?php }
}
