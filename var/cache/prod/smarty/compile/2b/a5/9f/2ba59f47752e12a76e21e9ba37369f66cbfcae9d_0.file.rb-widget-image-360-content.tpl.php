<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-360-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437b3aa1_71952164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ba59f47752e12a76e21e9ba37369f66cbfcae9d' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-360-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437b3aa1_71952164 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'rb-image-360'), 0, false);
?>

<#
	if (settings.images_list.length > 0) {
#>
	<div class="rb-widget-container">
		<div class="rb-image-360-wrapper">
			<div class="row">
	        	<#
	        		_.each( settings.images_list, function(item) {
	        	#>
	        		<div class="col-md-3">
	        			<img style="height: {{ settings.image_height }}px !important" 
	        				src="{{ item.image.url }}"
	        				width="{{ settings.image_width }}"
	        			>
	        		</div>
	        	<#		
					})
				#>
			</div>
		</div>
	</div>
<#
	} else {
#>
	<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Image 360','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</h3>
<#		
	}
#><?php }
}
