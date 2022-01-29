<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-schemes-color.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724367d1f1_72693125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a523ee410a12eb6aa83c84cce363cbf67a24d1e' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-schemes-color.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724367d1f1_72693125 (Smarty_Internal_Template $_smarty_tpl) {
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
		<button class="rb-button rb-button-success" disabled>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</button>
	</div>
</div>

<div class="rb-panel-scheme-content rb-panel-box">
	<div class="rb-panel-heading">
		<div class="rb-panel-heading-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Color Palette','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
	</div>
	<div class="rb-panel-scheme-items rb-panel-box-content"></div>
</div>

<div class="rb-panel-scheme-colors-more-palettes rb-panel-box">
	<div class="rb-panel-heading">
		<div class="rb-panel-heading-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'More Palettes','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
	</div>
	<div class="rb-panel-box-content">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['schemes']->value, 'scheme', false, 'key_scheme');
$_smarty_tpl->tpl_vars['scheme']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key_scheme']->value => $_smarty_tpl->tpl_vars['scheme']->value) {
$_smarty_tpl->tpl_vars['scheme']->do_else = false;
?>
			<div class="rb-panel-scheme-color-system-scheme" data-scheme-name="<?php echo $_smarty_tpl->tpl_vars['key_scheme']->value;?>
">
				<div class="rb-panel-scheme-color-system-items">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['print_colors_index']->value, 'color_name');
$_smarty_tpl->tpl_vars['color_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['color_name']->value) {
$_smarty_tpl->tpl_vars['color_name']->do_else = false;
?>
						<?php $_tmp_array = isset($_smarty_tpl->tpl_vars['colors_to_print']) ? $_smarty_tpl->tpl_vars['colors_to_print']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array[$_smarty_tpl->tpl_vars['color_name']->value] = $_smarty_tpl->tpl_vars['scheme']->value['items'][$_smarty_tpl->tpl_vars['color_name']->value];
$_smarty_tpl->_assignInScope('colors_to_print', $_tmp_array);?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['colors_to_print']->value, 'color_value');
$_smarty_tpl->tpl_vars['color_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['color_value']->value) {
$_smarty_tpl->tpl_vars['color_value']->do_else = false;
?>
						<div class="rb-panel-scheme-color-system-item" style='background-color:<?php echo $_smarty_tpl->tpl_vars['color_value']->value;?>
'>
							
						</div>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>

				<div class="rb-title"><?php echo $_smarty_tpl->tpl_vars['scheme']->value['title'];?>
</div>
			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
</div><?php }
}
