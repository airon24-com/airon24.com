<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-element-languageselector.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243696672_92673254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '088e7d2ec763de541e957e5f2f44be68d5424454' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-panel-element-languageselector.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243696672_92673254 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="rb-noname">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit:','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

	
	<select>
		<# _.each(rb.config.languages, function( language ) { #>
		<option value="{{{ language.id_lang }}}" <# if (rb.config.id_lang == language.id_lang) {#> selected <# } #> >{{{ language.name }}}</option>
		<# } ); #>
	</select>
</div>
<?php }
}
