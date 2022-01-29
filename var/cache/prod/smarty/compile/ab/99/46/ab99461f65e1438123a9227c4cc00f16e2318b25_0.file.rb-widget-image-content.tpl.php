<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243761b82_99044755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab99461f65e1438123a9227c4cc00f16e2318b25' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-image-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243761b82_99044755 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'image'), 0, false);
?>

<div class="rb-widget-container">
	<# if ( '' !== settings.image.url ) { #>
        <div class="rb-image{{ settings.shape ? ' rb-image-shape-' + settings.shape : '' }}">
            <#
           	var imgClass = '', image_html = '',
                hasCaption = '' !== settings.caption,
                image_html = '';

           	if ( '' !== settings.hover_animation ) {
                imgClass = 'rb-animation-' + settings.hover_animation;
            }

            image_html = '<img src="' + settings.image.url + '" class="' + imgClass + '" alt="' + settings.caption + '" />';
                
            var link_url;
            if ( 'custom' === settings.link_to ) {
                link_url = settings.link.url;
            }
                
            if ( 'file' === settings.link_to ) {
                link_url = settings.image.url;
            }
                
            if ( link_url ) {
                image_html = '<a href="' + link_url + '">' + image_html + '</a>';
            }

            print( image_html );
            #>
        </div>
    <# } #>
</div><?php }
}
