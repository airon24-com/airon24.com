<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from 'module:pssearchbarpssearchbar.tp' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f009836d6982_92267464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '110ec72aa9921d2c382ad628bdb2f0bc5105a617' => 
    array (
      0 => 'module:pssearchbarpssearchbar.tp',
      1 => 1641242529,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f009836d6982_92267464 (Smarty_Internal_Template $_smarty_tpl) {
?>	<div id="search-widget" class="search-widget popup-over">
		<a id="click_show_search" href="javascript:void(0)" data-toggle="dropdown" class="float-xs-right popup-title">
			<i class="icon-Ico_Search"></i>
		</a>
		<div class="rb-search-name popup-content">
			<div class="container">
				<div class="search-top">
					<h2>what are you looking for?</h2>
					<div class="close-search">close<i class="icon_close"></i></div>
				</div>
				<div class="search-box">
					<div class="rb-search-widget">
						<form method="get" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
							<input type="text" name="s" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
"
								class="rb-search" autocomplete="off">
							<button class="rb-search-btn" type="submit">
								<i class="icon_search"></i>
								<span class="hidden-xl-down"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
							</button>
							<div class="cssload-container rb-ajax-loading">
								<div class="cssload-double-torus"></div>
							</div>
						</form>
					</div>

					<div class="resuilt-search">
						<div class="rb-resuilt"></div>
					</div>
					<p class="rb-resuilt-error"></p>
				</div>
			</div>
		</div>
	</div><?php }
}
