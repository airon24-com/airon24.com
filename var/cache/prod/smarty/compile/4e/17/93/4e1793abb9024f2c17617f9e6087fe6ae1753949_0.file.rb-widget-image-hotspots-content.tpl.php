<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-hotspots-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243780db2_16229928',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e1793abb9024f2c17617f9e6087fe6ae1753949' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-hotspots-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243780db2_16229928 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'image-hotspots'), 0, false);
?>

<div class="rb-widget-container">
	<# if ( '' !== settings.image.url ) { #>
		<div class="rb-image-hotspots-wrapper">
			<div class="rb-hotspot-image{{ settings.shape ? ' rb-image-shape-' + settings.shape : '' }}">
				<#
				var imgClass = '', image_html = '',
				hasCaption = '' !== settings.caption,
				image_html = '';

				if ( '' !== settings.hover_animation ) {
				imgClass = 'rb-animation-' + settings.hover_animation;
			}

			image_html = '<img src="' + settings.image.url + '" class="' + imgClass + '" alt="' + settings.caption + '" />';

			print( image_html );
			#>
		</div>
		<div class="rb-image-hotspots">
			<#
			if ( settings.icon_list ) {
			_.each( settings.icon_list, function( item ) { #>
			<div class="rb-hotspot" style="top: {{ item.top }}%; left: {{ item.left }}%;" >
				<# if ( item.link && item.link.url ) { #>
				<a href="{{ item.link.url }}">
					<# } #>
					<span class="rb-hotspot-icon">
						<i class="{{ item.icon }}"></i>
					</span>
					<span class="rb-hotspot-text">{{{ item.text }}}</span>
					<# if ( item.link && item.link.url ) { #>
				</a>
				<# } #>
			</div>
			<#
				});
			} #>
	</div>
</div>
    <# } #>
</div><?php }
}
