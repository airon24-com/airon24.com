<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-gallery-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243735375_48890089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9819871b9fbfc878d655f5ca5c42ad3760a7e810' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-gallery-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243735375_48890089 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<div class="rb-control-input-wrapper">
			<# if ( data.description ) { #>
				<div class="rb-control-description">{{{ data.description }}}</div>
			<# } #>
			<div class="rb-control-media">
				<div class="rb-control-gallery-status">
					<span class="rb-control-gallery-status-title">
						<# if ( data.controlValue.length ) {
						print( rb.translate( 'gallery_images_selected', [ data.controlValue.length ] ) );
						} else { #>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Images Selected','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

						<# } #>
					</span>
					<span class="rb-control-gallery-clear">(<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</span>
				</div>
				<div class="rb-control-gallery-thumbnails">
					<# _.each( data.controlValue, function( image ) { #>
						<div class="rb-control-gallery-thumbnail" style="background-image: url({{ image.url }})"></div>
					<# } ); #>
				</div>
				<button class="rb-button rb-control-gallery-add"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Images','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
></button>
			</div>
		</div>
<	/div>
</div><?php }
}
