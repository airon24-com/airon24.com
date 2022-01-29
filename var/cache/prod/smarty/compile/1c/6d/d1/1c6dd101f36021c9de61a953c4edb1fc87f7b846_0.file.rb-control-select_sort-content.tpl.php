<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select_sort-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436e2f16_21554646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c6dd101f36021c9de61a953c4edb1fc87f7b846' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-select_sort-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436e2f16_21554646 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>

		<select class="rb-select-sort-selector" <# if ( data.multiple ) { #> multiple <# } #>>
			<# _.each( data.options, function( option_title, option_value ) {
				if (!_.contains(data.controlValue, option_value)){
				#>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
				<#
			}}); #>
		</select>
	</div>

	<button class="rb-button rb-value-add">
		<i class="fa fa-angle-down"></i>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

	</button>

	<div class="rb-control-field">
		<label class="rb-control-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Selected','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</label>
	</div>

	<div class="rb-control-field">
		<div class="rb-control-selected-preview">
			<# _.each( data.controlValue, function(option_value) {
			if (!_.isEmpty(data.options[option_value])){#>
			<div class="rb-selected-value-preview" data-value-text="{{{ data.options[option_value]  }}}" data-value-id="{{ option_value }}"><div class="rb-repeater-row-handle-sortable"><i class="fa fa-ellipsis-v"></i></div>
			<div class="selected-value-preview-info">{{{ data.options[option_value]  }}}<button data-value-id="{{ option_value }}" data-value-text="{{{ data.options[option_value]  }}}" class="rb-selected-value-remove selected-value-remove{{ option_value }}"><i class="fa fa-remove"></i></button></div></div>
			<# }} ); #>
		</div>

		<div class="rb-control-input-wrapper rb-control-type-select_sort">
			<select class="rb-select-sort" data-setting="{{ data.name }}" <# if ( data.multiple ) { #> multiple <# } #>>
				<# _.each( data.controlValue, function(option_value) {
				if (!_.isEmpty(data.options[option_value])){
				#>
					<option value="{{ option_value }}">{{{ data.options[option_value]}}}</option>
				<# }} ); #>
			</select>
		</div>

	</div>

	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div>
<?php }
}
