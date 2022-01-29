<?php
/* Smarty version 3.1.39, created on 2022-01-26 07:42:36
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/admin/setting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0ed5c239d35_91698013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19f3a425f124116b8de5104f4803cc2a6add0626' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/admin/setting.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f0ed5c239d35_91698013 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="rbthemefunction-group" data-url="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="icon-cogs"></i>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Config','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

		</div>

		<div class="panel-content" id="rbthemefunction-setting">
			<ul class="nav nav-tabs rbthemefunction-tablist" role="tablist">
				<li class="nav-item active">
					<a class="nav-link" href="#fieldset_0" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings General','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_1_1" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings Facebook','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_2_2" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings Popup','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_3_3" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings Slick Thumb','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_4_4" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings Zoom Product','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_5_5" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facebook Timeline','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#fieldset_6_6" role="tab" data-toggle="tab">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Twitter Timeline','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>

					</a>
				</li>
			</ul>
			
			<div class="tab-content">
				<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

			</div>
		</div>
	</div>
</div>

<style type="text/css">
	#rbthemefunction-setting .panel {
		display: none;
	}
	#rbthemefunction-setting .active {
		display: block;
	}
</style><?php }
}
