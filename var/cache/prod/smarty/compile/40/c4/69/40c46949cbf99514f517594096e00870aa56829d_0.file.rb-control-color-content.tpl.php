<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-color-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243702460_97042561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40c46949cbf99514f517594096e00870aa56829d' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-color-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243702460_97042561 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<# var defaultValue = '', dataAlpha = '';
	if ( data.default ) {
	if ( '#' !== data.default.substring( 0, 1 ) ) {
	defaultValue = '#' + data.default;
	} else {
	defaultValue = data.default;
	}
	defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
	}
	if ( data.alpha ) {
	dataAlpha = ' data-alpha=true';
	} #>

	<div class="rb-control-field">
			<label class="rb-control-title">
				<# if ( data.label ) { #>
					{{{ data.label }}}
					<# } #>
						<# if ( data.description ) { #>
							<span class="rb-control-description">{{{ data.description }}}</span>
						<# } #>
			</label>

			<div class="rb-control-input-wrapper">
				<input data-setting="{{ name }}" class="color-picker-hex" type="text" maxlength="7" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hex Value','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
" {{ defaultValue }}{{ dataAlpha }} />
			</div>
		</div>
</div><?php }
}
