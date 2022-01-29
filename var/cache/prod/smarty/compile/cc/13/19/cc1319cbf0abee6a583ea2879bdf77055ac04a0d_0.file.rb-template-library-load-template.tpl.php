<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-template-library-load-template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172436c15d0_89146890',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc1319cbf0abee6a583ea2879bdf77055ac04a0d' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-template-library-load-template.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172436c15d0_89146890 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-template-library-blank-title">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Load Template From File','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

</div>

<div class="rb-template-library-blank-excerpt">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Import .json Design File From Your PC','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

</div>

<form id="rb-template-library-load-template-form">
	<div id="rb-template-library-load-wrapper">
		<button id="rb-template-library-load-btn-file">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select template .json file','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

		</button>
		<input id="rb-template-library-load-template-file" type="file" name="file" required>
	</div>
	<button id="rb-template-library-load-template-submit" class="rb-button rb-button-success">
		<span class="rb-state-icon">
			<i class="fa fa-spin fa-circle-o-notch "></i>
		</span>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Load','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

	</button>
</form><?php }
}
