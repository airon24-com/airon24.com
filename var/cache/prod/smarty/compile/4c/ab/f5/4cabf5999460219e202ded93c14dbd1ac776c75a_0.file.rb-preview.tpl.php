<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-preview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437d9e91_51806287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cabf5999460219e202ded93c14dbd1ac776c75a' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/include/rb-preview.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172437d9e91_51806287 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="rb-section-wrap"></div>
<div id="rb-add-section" class="rb-visible-desktop">
	<div id="rb-add-section-inner">
		<div id="rb-add-new-section">
			<button id="rb-add-section-button" class="rb-button"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add New Section','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</button>

			<div id="rb-add-section-drag-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Or drag widget here','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
		</div>
		<div id="rb-select-preset">
			<div id="rb-select-preset-close">
				<i class="fa fa-times"></i>
			</div>
			<div id="rb-select-preset-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select your Structure','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			<ul id="rb-select-preset-list">
	          	
		          	<#
		                var structures = [ 10, 20, 30, 40, 21, 22, 31, 32, 33, 50, 60, 34 ];
		                _.each( structures, function(structure) {
		                var preset = rb.presetsFactory.getPresetByStructure(structure);
		            #>
		            <li class="rb-preset rb-column rb-col-16"
		                data-structure="{{ structure }}">
		              	{{{ rb.presetsFactory.getPresetSVG( preset.preset ).outerHTML }}}
		            </li>
		            
		            <# 
		        		});
		            #>
              	
			</ul>
		</div>
	</div>
</div><?php }
}
