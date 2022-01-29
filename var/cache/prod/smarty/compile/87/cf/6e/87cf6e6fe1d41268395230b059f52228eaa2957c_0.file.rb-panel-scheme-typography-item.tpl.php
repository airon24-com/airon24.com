<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-scheme-typography-item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724368c654_96371355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87cf6e6fe1d41268395230b059f52228eaa2957c' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-scheme-typography-item.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724368c654_96371355 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-panel-heading">
	<div class="rb-panel-heading-toggle">
		<i class="fa"></i>
	</div>
	<div class="rb-panel-heading-title">{{{ title }}}</div>
</div>

<div class="rb-panel-scheme-typography-items rb-panel-box-content">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['scheme_fields']->value, 'option', false, 'option_name');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option_name']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
		<div class="rb-panel-scheme-typography-item">
			<div class="rb-panel-scheme-item-title rb-control-title"><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</div>
			<div class="rb-panel-scheme-typography-item-value">
				<?php if ($_smarty_tpl->tpl_vars['option']->value['type'] == 'select') {?>
					<select name="<?php echo $_smarty_tpl->tpl_vars['option_name']->value;?>
" class="rb-panel-scheme-typography-item-field">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['option']->value['options'], 'field_value', false, 'field_key');
$_smarty_tpl->tpl_vars['field_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_key']->value => $_smarty_tpl->tpl_vars['field_value']->value) {
$_smarty_tpl->tpl_vars['field_value']->do_else = false;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['field_key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['field_value']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				<?php } elseif ($_smarty_tpl->tpl_vars['option']->value['type'] == 'font') {?>
					<select name="<?php echo $_smarty_tpl->tpl_vars['option_name']->value;?>
" class="rb-panel-scheme-typography-item-field">
						<option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
></option>
						<optgroup label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'System','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['font_systems']->value, 'system', false, 'key_system');
$_smarty_tpl->tpl_vars['system']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key_system']->value => $_smarty_tpl->tpl_vars['system']->value) {
$_smarty_tpl->tpl_vars['system']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['key_system']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key_system']->value;?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</optgroup>

						<optgroup label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Google','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['font_googles']->value, 'google', false, 'key_google');
$_smarty_tpl->tpl_vars['google']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key_google']->value => $_smarty_tpl->tpl_vars['google']->value) {
$_smarty_tpl->tpl_vars['google']->do_else = false;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['key_google']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key_google']->value;?>
</option>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</optgroup>
					</select>
				<?php } elseif ($_smarty_tpl->tpl_vars['option']->value['type'] == 'text') {?>
					<input name="<?php echo $_smarty_tpl->tpl_vars['option_name']->value;?>
" class="rb-panel-scheme-typography-item-field"/>
				<?php }?>
			</div>
		</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
