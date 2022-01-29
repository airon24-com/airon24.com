<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-user-rating-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437c0948_86137304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb0a190dd7a61e895acaeb0d1b73021016882252' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-user-rating-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437c0948_86137304 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'user-rating'), 0, false);
?>

<#
	let star_5 = settings.star_5 != '' ? settings.star_5 : 0;
	let star_4 = settings.star_4 != '' ? settings.star_4 : 0;
	let star_3 = settings.star_3 != '' ? settings.star_3 : 0;
	let star_2 = settings.star_2 != '' ? settings.star_2 : 0;
	let star_1 = settings.star_1 != '' ? settings.star_1 : 0;
	let total = Number(star_5) + Number(star_4) + Number(star_3) + Number(star_2) + Number(star_1);
	let medium = (star_5 * 5 + star_4 * 4 + star_3 * 3 + star_2 * 2 + Number(star_1)) / total;
	medium = medium.toFixed(1);
#>

<div class="rb-widget-container">
	<div class="rb-user-rating-wrapper rb-align-center">
		<span class="heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'User Rating','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</span>
		
		<# for (i=1; i<=5; i ++) { #>
			<# if (i <= medium) { #>
				<span class="fa fa-star checked"></span>
			<# } else { #>
				<span class="fa fa-star"></span>
			<# } #>
		<# } #>

		<p>
			{{ medium }} <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'average based on','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
 {{ total }} <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'reviews.','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</p>

		<hr style="border:3px solid #f1f1f1">

		<div class="row content">
			<div class="side col-md-3">
				<div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'5 star','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>

			<div class="middle col-md-6">
			    <div class="bar-container">
			      <div class="bar-5" style="width:{{ star_5/total * 100 }}%; background:{{ settings.star_color_5 }}"></div>
			    </div>
			</div>

			<div class="side right col-md-3">
    			<div>{{ star_5 }}</div>
  			</div>

  			<div class="side col-md-3">
				<div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'4 star','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>

			<div class="middle col-md-6">
			    <div class="bar-container">
			      <div class="bar-4" style="width:{{ star_4/total * 100 }}%; background:{{ settings.star_color_4 }}"></div>
			    </div>
			</div>

			<div class="side right col-md-3">
    			<div>{{ star_4 }}</div>
  			</div>

  			<div class="side col-md-3">
				<div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'3 star','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>

			<div class="middle col-md-6">
			    <div class="bar-container">
			      <div class="bar-3" style="width:{{ star_3/total * 100 }}%; background:{{ settings.star_color_3 }}"></div>
			    </div>
			</div>

			<div class="side right col-md-3">
    			<div>{{ star_3 }}</div>
  			</div>

  			<div class="side col-md-3">
				<div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'2 star','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>

			<div class="middle col-md-6">
			    <div class="bar-container">
			      <div class="bar-2" style="width:{{ star_2/total * 100 }}%; background:{{ settings.star_color_2 }}"></div>
			    </div>
			</div>

			<div class="side right col-md-3">
    			<div>{{ star_2 }}</div>
  			</div>

  			<div class="side col-md-3">
				<div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 star','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			</div>

			<div class="middle col-md-6">
			    <div class="bar-container">
			      <div class="bar-1" style="width:{{ star_1/total * 100 }}%; background:{{ settings.star_color_1 }}"></div>
			    </div>
			</div>

			<div class="side right col-md-3">
    			<div>{{ star_1 }}</div>
  			</div>
		</div>
	</div>
</div><?php }
}
