<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-modules-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436eafa6_21551534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9bd9cf87b8d774269959edc85d8004386e1408b' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-modules-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436eafa6_21551534 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
		<# } 
	#>
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<select data-setting="{{ data.name }}">
				<option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Module','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</option>
				<# _.each( data.options, function( module ) { #>
				<option value="{{ module.name }}">{{{ module.name }}}</option>
				<# } ); #>
			</select>
		</div>
	</div>
	<div class="rb-control-field">
		<label class="rb-control-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hook','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</label>
		<div class="rb-control-input-wrapper">
			<input type="text" class="rb-control-autocomplete-search" placeholder="{{ data.placeholder }}" />
		</div>
	</div>
</div><?php }
}
