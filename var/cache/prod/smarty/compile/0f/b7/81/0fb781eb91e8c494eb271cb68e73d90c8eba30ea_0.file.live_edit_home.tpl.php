<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/live_edit_home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243653d21_63674398',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fb781eb91e8c494eb271cb68e73d90c8eba30ea' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/live_edit_home.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./include/rb-panel.tpl' => 1,
    'file:./include/rb-panel-menu-item.tpl' => 1,
    'file:./include/rb-panel-header.tpl' => 1,
    'file:./include/rb-panel-footer-content.tpl' => 1,
    'file:./include/rb-mode-switcher-content.tpl' => 1,
    'file:./include/rb-live-content.tpl' => 1,
    'file:./include/rb-panel-schemes-typography.tpl' => 1,
    'file:./include/rb-panel-schemes-color.tpl' => 1,
    'file:./include/rb-panel-schemes-disabled.tpl' => 1,
    'file:./include/rb-panel-scheme-color-item.tpl' => 1,
    'file:./include/rb-panel-scheme-typography-item.tpl' => 1,
    'file:./include/rb-control-responsive-switchers.tpl' => 1,
    'file:./include/rb-panel-elements-category.tpl' => 1,
    'file:./include/rb-panel-element-languageselector.tpl' => 1,
    'file:./include/rb-panel-element-search.tpl' => 1,
    'file:./include/rb-element-library-element.tpl' => 1,
    'file:./include/rb-repeater-row.tpl' => 1,
    'file:./include/rb-template-library-header.tpl' => 1,
    'file:./include/rb-template-library-header-preview.tpl' => 1,
    'file:./include/rb-template-library-loading.tpl' => 1,
    'file:./include/rb-template-library-templates.tpl' => 1,
    'file:./include/rb-template-library-template-local.tpl' => 1,
    'file:./include/rb-template-library-save-template.tpl' => 1,
    'file:./include/rb-template-library-load-template.tpl' => 1,
    'file:./include/rb-template-library-templates-empty.tpl' => 1,
    'file:./rb-control.tpl' => 1,
    'file:./rb-widget.tpl' => 1,
    'file:./rb-element-column-content.tpl' => 1,
    'file:./rb-element-section-content.tpl' => 1,
    'file:./include/rb-panel-elements.tpl' => 1,
    'file:./include/rb-column.tpl' => 1,
    'file:./include/rb-section.tpl' => 1,
    'file:./include/rb-preview.tpl' => 1,
  ),
),false)) {
function content_61f17243653d21_63674398 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html class="no-js" <?php echo $_smarty_tpl->tpl_vars['full_cldr_language_code']->value;?>
>
 	<head>
  		<meta charset="utf-8" />
  		<link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
favicon.ico"/>
  		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
  		<title><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home Live Edit','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</title>
	  	<?php echo '<script'; ?>
 type="text/javascript">
	    var iso_user = '<?php echo addcslashes($_smarty_tpl->tpl_vars['iso_user']->value,'\'');?>
';
	    var full_language_code = '<?php echo addcslashes($_smarty_tpl->tpl_vars['full_language_code']->value,'\'');?>
';
	    var full_cldr_language_code = '<?php echo addcslashes($_smarty_tpl->tpl_vars['full_cldr_language_code']->value,'\'');?>
';
	    var country_iso_code = '<?php echo addcslashes($_smarty_tpl->tpl_vars['country_iso_code']->value,'\'');?>
';
	    var _PS_VERSION_ = '<?php echo addcslashes((defined('_PS_VERSION_') ? constant('_PS_VERSION_') : null),'\'');?>
';
	    var roundMode = <?php echo intval($_smarty_tpl->tpl_vars['round_mode']->value);?>
;
	    var token = '<?php echo addslashes($_smarty_tpl->tpl_vars['token']->value);?>
';
	    var youEditFieldFor = 'a';
	    var baseAdminDir = '<?php echo addslashes($_smarty_tpl->tpl_vars['baseDir']->value);?>
';
	    var from_msg ='a';
	    var token_admin_orders = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminOrders'),$_smarty_tpl ) );?>
';
	    var token_admin_customers = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomers'),$_smarty_tpl ) );?>
';
	    var token_admin_customer_threads = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomerThreads'),$_smarty_tpl ) );?>
';
	    var currentIndex = '<?php echo addcslashes($_smarty_tpl->tpl_vars['currentIndex']->value,'\'');?>
';
	    var employee_token = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminEmployees'),$_smarty_tpl ) );?>
';
	    var default_language = '<?php echo intval($_smarty_tpl->tpl_vars['default_language']->value);?>
';
	    var admin_modules_link = '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getAdminLink("AdminModulesSf",true,array('route'=>"admin_module_catalog_post")));?>
';
	    var tab_modules_list = '<?php if ((isset($_smarty_tpl->tpl_vars['tab_modules_list']->value)) && $_smarty_tpl->tpl_vars['tab_modules_list']->value) {
echo addslashes($_smarty_tpl->tpl_vars['tab_modules_list']->value);
}?>';
	  	<?php echo '</script'; ?>
>
	  	<?php if ((isset($_smarty_tpl->tpl_vars['css_files']->value))) {?>
		    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['css_files']->value, 'media', false, 'css_uri');
$_smarty_tpl->tpl_vars['media']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['css_uri']->value => $_smarty_tpl->tpl_vars['media']->value) {
$_smarty_tpl->tpl_vars['media']->do_else = false;
?>
		      <link href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['css_uri']->value,'html','UTF-8' ));?>
" rel="stylesheet" type="text/css"/>
		    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	  	<?php }?>
	</head>

	<body class="rb-live-active">
		<div id="rb-live-wrapper">
			<div id="rb-preview">
				<div id="rb-loading">
					<div class="rb-loader-wrapper">
						<div class="rb-loader">
							<div id="loadFacebookG">
								<div id="blockG_1" class="facebook_blockG"></div>
								<div id="blockG_2" class="facebook_blockG"></div>
								<div id="blockG_3" class="facebook_blockG"></div>
							</div>
						</div>
						<div class="rb-loading-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Loading','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</div>
					</div>
				</div>
				<div id="rb-preview-responsive-wrapper" class="rb-device-desktop rb-device-rotate-portrait">
					
				</div>
			</div>
			<div id="rb-panel"></div>
		</div>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-menu-item">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-menu-item.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-header">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-footer-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-footer-content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-mode-switcher-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-mode-switcher-content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-live-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-live-content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-schemes-typography">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-schemes-typography.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-schemes-color">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-schemes-color.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-schemes-disabled">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-schemes-disabled.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-scheme-color-item">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-scheme-color-item.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-scheme-typography-item">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-scheme-typography-item.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-control-responsive-switchers">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-control-responsive-switchers.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-elements-category">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-elements-category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-element-languageselector">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-element-languageselector.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-element-search">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-element-search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-element-library-element">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-element-library-element.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-repeater-row">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-repeater-row.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-logo">
			<i class="eicon-rb-square"></i>
			<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Library','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</span>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-save">
			<i class="eicon-save" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save Template','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"></i>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-load">
			<i class="icon-upload" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Load Template','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"></i>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-menu">
			<div id="rb-template-library-menu-my-templates" class="rb-template-library-menu-item" data-template-source="local">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'List Templates','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

			</div>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-preview">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-header-preview.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-header-back">
			<i class="eicon-"></i>
			<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back To library','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</span>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-loading">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-loading.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-templates">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-templates.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-template-local">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-template-local.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-save-template">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-save-template.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-load-template">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-load-template.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-templates-empty">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-template-library-templates-empty.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-template-library-preview">
			<iframe></iframe>
		<?php echo '</script'; ?>
>

		<?php $_smarty_tpl->_subTemplateRender('file:./rb-control.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php $_smarty_tpl->_subTemplateRender('file:./rb-widget.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<?php echo '<script'; ?>
 type="text/html" id="dd-rb-element-column-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./rb-element-column-content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/html" id="dd-rb-element-section-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./rb-element-section-content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-panel-elements">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-panel-elements.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/html" id="dd-rb-element-column-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-column.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/html" id="dd-rb-element-section-content">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-section.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-empty-preview">
			<div class="rb-first-add">
				<div class="rb-icon eicon-plus"></div>
			</div>
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/template" id="dd-rb-preview">
			<?php $_smarty_tpl->_subTemplateRender('file:./include/rb-preview.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php echo '</script'; ?>
>

		<?php if ((isset($_smarty_tpl->tpl_vars['js_def_vars']->value)) && is_array($_smarty_tpl->tpl_vars['js_def_vars']->value) && count($_smarty_tpl->tpl_vars['js_def_vars']->value)) {?>
			<?php echo '<script'; ?>
 type="text/javascript">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['js_def_vars']->value, 'def', false, 'k');
$_smarty_tpl->tpl_vars['def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['def']->value) {
$_smarty_tpl->tpl_vars['def']->do_else = false;
?>
			   		var <?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['def']->value ));?>
;
			    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php echo '</script'; ?>
>
		<?php }?>

		<?php if ((isset($_smarty_tpl->tpl_vars['js_files']->value)) && count($_smarty_tpl->tpl_vars['js_files']->value)) {?>
		  <?php $_smarty_tpl->_subTemplateRender(((defined('_PS_ALL_THEMES_DIR_') ? constant('_PS_ALL_THEMES_DIR_') : null)).("javascript.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php }?>
	</body>
</html><?php }
}
