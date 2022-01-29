<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-structure-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243739875_89469909',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1752c6d17c2783a7590a8a586a9ae42c9fddf5b5' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-structure-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f17243739875_89469909 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
	<div class="rb-control-input-wrapper">
		<div class="rb-control-structure-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Structure','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
			<# var currentPreset = rb.presetsFactory.getPresetByStructure( data.controlValue ); #>
			<div class="rb-control-structure-preset rb-control-structure-current-preset">
				{{{ rb.presetsFactory.getPresetSVG( currentPreset.preset, 233, 72, 5 ).outerHTML }}}
			</div>
			<div class="rb-control-structure-reset">
				<i class="fa fa-undo"></i>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset Structure','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

			</div>
			<#
			var morePresets = getMorePresets();

			if ( morePresets.length > 1 ) { #>
				<div class="rb-control-structure-more-presets-title">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'More Structures','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

				</div>
				<div class="rb-control-structure-more-presets">
					<# _.each( morePresets, function( preset ) { #>
						<div class="rb-control-structure-preset-wrapper">
							<input id="rb-control-structure-preset-{{ data._cid }}-{{ preset.key }}" type="radio" name="rb-control-structure-preset-{{ data._cid }}" data-setting="structure" value="{{ preset.key }}">
							<label class="rb-control-structure-preset" for="rb-control-structure-preset-{{ data._cid }}-{{ preset.key }}">
								{{{ rb.presetsFactory.getPresetSVG( preset.preset, 102, 42 ).outerHTML }}}
							</label>
							<div class="rb-control-structure-preset-title">{{{ preset.preset.join( ', ' ) }}}</div>
						</div>
					<# } ); #>
				</div>
			<# } #>
		</div>
	</div>
		
	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
