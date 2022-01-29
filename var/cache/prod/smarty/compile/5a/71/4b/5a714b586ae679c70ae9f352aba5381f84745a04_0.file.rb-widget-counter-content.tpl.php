<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-counter-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243787a79_50907521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a714b586ae679c70ae9f352aba5381f84745a04' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-counter-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243787a79_50907521 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'counter'), 0, false);
?>

<div class="rb-widget-container">
	<div class="rb-counter">
		<div class="rb-counter-number-wrapper">
			<#
			var prefix = '',
			suffix = '';

			if ( settings.prefix ) {
			prefix = '<span class="rb-counter-number-prefix">' + settings.prefix + '</span>';
		}

		var duration = '<span class="rb-counter-number" data-duration="' + settings.duration + '" data-to_value="' + settings.ending_number + '">' + settings.starting_number + '</span>';

		if ( settings.suffix ) {
		suffix = '<span class="rb-counter-number-suffix">' + settings.suffix + '</span>';
		}

		print( prefix + duration + suffix );
		#>
		</div>
		<# if ( settings.title ) { #>
			<div class="rb-counter-title">{{{ settings.title }}}</div>
		<# } #>
	</div>
</div><?php }
}
