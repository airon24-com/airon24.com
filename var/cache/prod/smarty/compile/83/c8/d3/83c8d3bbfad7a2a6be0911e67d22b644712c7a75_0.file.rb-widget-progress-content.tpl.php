<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-progress-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f1724378b261_79749761',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83c8d3bbfad7a2a6be0911e67d22b644712c7a75' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-progress-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f1724378b261_79749761 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'progress'), 0, false);
?>

<div class="rb-widget-container">
	<# if ( settings.title ) { #>
		<span class="rb-title">{{{ settings.title }}}</span><#
	} #>

	<div class="rb-progress-wrapper progress-{{ settings.progress_type }}" role="timer">
		<div class="rb-progress-bar" data-max="{{ settings.percent.size }}">
			<span class="rb-progress-text">{{{ settings.inner_text }}}</span>
			<# if ( 'hide' !== settings.display_percentage ) { #>
			<span class="rb-progress-percentage">{{{ settings.percent.size }}}%</span>
			<# } #>
		</div>
	</div>
</div><?php }
}
