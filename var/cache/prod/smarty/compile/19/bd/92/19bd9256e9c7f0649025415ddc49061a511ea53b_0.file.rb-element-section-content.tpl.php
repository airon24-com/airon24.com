<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/rb-element-section-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437ca346_92274666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19bd9256e9c7f0649025415ddc49061a511ea53b' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/rb-element-section-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172437ca346_92274666 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-element-overlay"></div>

<# if ( 'video' === settings.background_background ) {
    var videoLink = settings.background_video_link;

	if ( videoLink ) {
        var videoID = rb.helpers.getYoutubeIDFromURL( settings.background_video_link ); #>

        <div class="rb-background-video-container rb-hidden-phone">
           <# if ( videoID ) { #>
                <div class="rb-background-video" data-video-id="{{ videoID }}"></div>
            <# } else { #>
                <video class="rb-background-video" src="{{ videoLink }}" autoplay loop muted></video>
            <# } #>
        </div>
<# }

    if ( settings.background_video_fallback ) { #>
        <div class="rb-background-video-fallback" style="background-image: url({{ settings.background_video_fallback.url }})"></div>
    <# }
 }

if ( -1 !== [ 'classic', 'gradient' ].indexOf( settings.background_overlay_background ) ) { #>
    <div class="rb-background-overlay"></div>
<# } #>

<div class="rb-container rb-column-gap-{{ settings.gap }}" <# if ( settings.get_render_attribute_string ) { #>{{{ settings.get_render_attribute_string( 'wrapper' ) }}} <# } #> >
    <div class="rb-row"></div>
</div><?php }
}
