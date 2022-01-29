<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-url-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724372ab45_59332698',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8373f3eb066ff8ea08ec4dcb7d0ca5475a3c5ca4' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-url-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f1724372ab45_59332698 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field rb-control-url-external-{{{ data.show_external ? 'show' : 'hide' }}}">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<input type="url"
				data-setting="url"
				placeholder="{{ data.placeholder }}"
				id="rb-control-url-field-{{ data._cid }}"
			/>
			<button class="rb-control-url-target tooltip-target"
				data-tooltip="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Open Link In New Tab','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Open Link In New Tab','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
			>
				<span class="rb-control-url-external"
					title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New Window','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
				>
					<i class="fa fa-external-link"></i>
				</span>
			</button>

			<button class="rb-control-url-media tooltip-target"
				data-tooltip="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Media Link','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose Media Link','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
			>
				<span class="rb-control-url-external" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Media Link','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
">
					<i class="fa fa-paperclip"></i>
				</span>
			</button>
		</div>
	</div>
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
