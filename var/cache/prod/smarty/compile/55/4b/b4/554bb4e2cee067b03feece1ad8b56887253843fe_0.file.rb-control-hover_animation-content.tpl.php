<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-hover_animation-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724374d277_40627631',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '554bb4e2cee067b03feece1ad8b56887253843fe' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-hover_animation-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724374d277_40627631 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<select data-setting="{{ data.name }}">
				<option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'None','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</option>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hover_animations']->value, 'animation_title', false, 'animation_name');
$_smarty_tpl->tpl_vars['animation_title']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['animation_name']->value => $_smarty_tpl->tpl_vars['animation_title']->value) {
$_smarty_tpl->tpl_vars['animation_title']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['animation_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['animation_title']->value;?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</select>
		</div>
	</div>

	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
