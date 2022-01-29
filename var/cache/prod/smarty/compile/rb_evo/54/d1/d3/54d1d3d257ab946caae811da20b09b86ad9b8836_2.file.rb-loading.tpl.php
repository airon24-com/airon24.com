<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-loading.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0098365e404_73456597',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54d1d3d257ab946caae811da20b09b86ad9b8836' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-loading.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f0098365e404_73456597 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-loading" style="background: <?php if ((isset($_smarty_tpl->tpl_vars['color_back']->value)) && $_smarty_tpl->tpl_vars['color_back']->value != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['color_back']->value, ENT_QUOTES, 'UTF-8');
} else { ?>#f1f1f1<?php }?>">
	<div id="loadFacebookG">
		<img class="logo img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_img']->value, ENT_QUOTES, 'UTF-8');?>
">
		<div id="blockG_1" class="facebook_blockG"></div>
		<div id="blockG_2" class="facebook_blockG"></div>
		<div id="blockG_3" class="facebook_blockG"></div>
	</div>
</div><?php }
}
