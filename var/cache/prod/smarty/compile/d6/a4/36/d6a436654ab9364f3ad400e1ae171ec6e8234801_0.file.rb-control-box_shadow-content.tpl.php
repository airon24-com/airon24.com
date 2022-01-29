<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-box_shadow-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243742f54_07834555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6a436654ab9364f3ad400e1ae171ec6e8234801' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-box_shadow-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243742f54_07834555 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<#
		var defaultColorValue = '';
		if ( data.default.color ) {
			if ( '#' !== data.default.color.substring( 0, 1 ) ) {
				defaultColorValue = '#' + data.default.color;
			} else {
				defaultColorValue = data.default.color;
			}
			defaultColorValue = ' data-default-color=' + defaultColorValue; // Quotes added automatically.
		}
	#>

	<div class="rb-control-field">
		<label class="rb-control-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Color','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</label>
			<div class="rb-control-input-wrapper">
			<input data-setting="color"
				class="rb-box-shadow-color-picker"
				type="text" maxlength="7"
				placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hex Value','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
				data-alpha="true"{{{ defaultColorValue }}}
			/>
		</div>
	</div>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sliders']->value, 'slider');
$_smarty_tpl->tpl_vars['slider']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['slider']->value) {
$_smarty_tpl->tpl_vars['slider']->do_else = false;
?>
		<div class="rb-box-shadow-slider">
			<label class="rb-control-title"><?php echo $_smarty_tpl->tpl_vars['slider']->value['label'];?>
</label>
			<div class="rb-control-input-wrapper">
				<div class="rb-slider" data-input="<?php echo $_smarty_tpl->tpl_vars['slider']->value['type'];?>
"></div>
				<div class="rb-slider-input">
					<input type="number"
						min="<?php echo $_smarty_tpl->tpl_vars['slider']->value['min'];?>
"
						max="<?php echo $_smarty_tpl->tpl_vars['slider']->value['max'];?>
"
						step="{{ data.step }}"
						data-setting="<?php echo $_smarty_tpl->tpl_vars['slider']->value['type'];?>
"
					/>
				</div>
			</div>
		</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
