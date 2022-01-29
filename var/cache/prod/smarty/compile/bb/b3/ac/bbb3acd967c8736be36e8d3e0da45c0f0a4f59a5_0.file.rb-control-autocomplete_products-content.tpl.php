<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-autocomplete_products-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436e6e65_49301503',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bbb3acd967c8736be36e8d3e0da45c0f0a4f59a5' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-autocomplete_products-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436e6e65_49301503 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<input type="text" class="rb-control-autocomplete-search" placeholder="{{ data.placeholder }}" <# if ( data.single ) { #> data-single="true" <# } #> />

			<div class="rb-control-content rb-selected-products-wrapper">
				<div class="rb-control-field">
					<label class="rb-control-title"> <# if ( data.single ) { #> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Selected Product','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
<# } else { #> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Selected Product','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
<# } #></label>
					<div class="rb-control-input-wrapper">
						<div class="rb-control-selected-preview"></div>
						<select class="rb-control-selected-options" multiple="multiple"  data-setting="{{ data.name }}">
							<# _.each( data.controlValue, function(product) { #>
								<option value="{{ product }}">{{{ product }}}</option>
							<# } ); #>
						</select>
					</div>
				</div>
			</div>

		</div>
	</div>

	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
