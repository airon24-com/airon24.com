<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-choose-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243715fe3_73895119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7c39288c6dd6f98eebfa26328cdbf658ffc4d63' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-choose-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243715fe3_73895119 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>
		<div class="rb-control-input-wrapper">
			<div class="rb-choices">
				<# _.each( data.options, function( options, value ) { #>
				<input id="rb-choose-{{ data._cid + data.name + value }}" type="radio" name="rb-choose-{{ data.name }}" value="{{ value }}">
				<label class="rb-choices-label tooltip-target" for="rb-choose-{{ data._cid + data.name + value }}" data-tooltip="{{ options.title }}" title="{{ options.title }}">
					<i class="fa fa-{{ options.icon }}"></i>
				</label>
				<# } ); #>
			</div>
		</div>
	</div>

	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
