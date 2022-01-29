<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-prestashop-widget-newsletter-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172437af418_03468007',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e958bc1151bf9734cc678f6abad9380439fbd74' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-prestashop-widget-newsletter-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f172437af418_03468007 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'prestashop-widget-newsletter'), 0, false);
?>

<div class="rb-widget-container">
	<div class="block_newsletter col-lg-8 col-md-12 col-sm-12">
	    <div class="row">
	        <p id="block-newsletter-label" class="col-md-5 col-xs-12">
	            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Get our latest news and special sales','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

	        </p>

	        <div class="col-md-7 col-xs-12">
	            <form action="#footer" method="post">
	                <input type="hidden" value="displayHome" name="blockHookName" />
	                
	                <div class="row">
	                    <div class="col-xs-12">
	                        <input
	                            class="btn btn-primary float-xs-right hidden-xs-down"
	                            name="submitNewsletter"
	                            type="submit"
	                            value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subscribe','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
	                        >
	                        <input
	                            class="btn btn-primary float-xs-right hidden-sm-up"
	                            name="submitNewsletter"
	                            type="submit"
	                            value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OK','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
	                        >
	                        <div class="input-wrapper">
	                            <input
	                            name="email"
	                            type="email"
	                            placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your email address','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
	                            aria-labelledby="block-newsletter-label"
	                        ></div>
	                        <input type="hidden" name="action" value="0">
	                        <div class="clearfix"></div>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div><?php }
}
