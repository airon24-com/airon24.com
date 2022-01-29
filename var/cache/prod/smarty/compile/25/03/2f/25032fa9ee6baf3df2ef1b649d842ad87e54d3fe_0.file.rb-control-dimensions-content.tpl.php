<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-dimensions-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437121e4_86816359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25032fa9ee6baf3df2ef1b649d842ad87e54d3fe' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/control/rb-control-dimensions-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-units-template.tpl' => 1,
  ),
),false)) {
function content_61f172437121e4_86816359 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-control-content">
	<div class="rb-control-field">
		<label class="rb-control-title">{{{ data.label }}}</label>

		<?php $_smarty_tpl->_subTemplateRender('file:./rb-units-template.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<div class="rb-control-input-wrapper">
			<ul class="rb-control-dimensions">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dimensions']->value, 'dimension_title', false, 'dimension_key');
$_smarty_tpl->tpl_vars['dimension_title']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dimension_key']->value => $_smarty_tpl->tpl_vars['dimension_title']->value) {
$_smarty_tpl->tpl_vars['dimension_title']->do_else = false;
?>
					<li class="rb-control-dimension">
						<input type="number" 
							data-setting="<?php echo $_smarty_tpl->tpl_vars['dimension_key']->value;?>
"
							placeholder="<#
						       if ( _.isObject( data.placeholder ) ) {
						        if ( ! _.isUndefined( data.placeholder.<?php echo $_smarty_tpl->tpl_vars['dimension_key']->value;?>
 ) ) {
						            print( data.placeholder.<?php echo $_smarty_tpl->tpl_vars['dimension_key']->value;?>
 );
						        }
						       } else {
						        print( data.placeholder );
						       } #>"
							<# if ( -1 === _.indexOf( allowed_dimensions, "<?php echo $_smarty_tpl->tpl_vars['dimension_key']->value;?>
" ) ) { #>
								disabled
								<# } #>
						/>
						<span><?php echo $_smarty_tpl->tpl_vars['dimension_title']->value;?>
</span>
					</li>		
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

				<li>
					<button class="rb-link-dimensions tooltip-target"
						data-tooltip="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Link Values Together','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
					>
						<span class="rb-linked"><i class="fa fa-link"></i></span>
						<span class="rb-unlinked"><i class="fa fa-chain-broken"></i></span>
					</button>
				</li>
			</ul>
		</div>
	</div>

	<# if ( data.description ) { #>
		<div class="rb-control-description">{{{ data.description }}}</div>
	<# } #>
</div><?php }
}
