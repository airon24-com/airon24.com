<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/modules/rbthemedream/views/templates/hook/rb-social.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f009839346a3_93427580',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cbd05dcb470ac9646f7c0aefb09c8d45e20afaec' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/modules/rbthemedream/views/templates/hook/rb-social.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f009839346a3_93427580 (Smarty_Internal_Template $_smarty_tpl) {
?>	<div class="rb-social-block ">
		<h3 class="rb-title hidden-sm-down"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Follow us','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</h3>
		<div id="footer_social_block">
			<?php if ($_smarty_tpl->tpl_vars['facebook']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['facebook']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-facebook-square" aria-hidden="true"></i>
			</a>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['twitter']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['twitter']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-twitter-square" aria-hidden="true"></i>
			</a>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['instagram']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instagram']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-instagram" aria-hidden="true"></i>
			</a>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['pinterest']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pinterest']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-pinterest-square" aria-hidden="true"></i>
			</a>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['youtube']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['youtube']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-youtube-square" aria-hidden="true"></i>
			</a>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['vimeo']->value != '') {?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vimeo']->value, ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-vimeo-square" aria-hidden="true"></i>
			</a>
			<?php }?>
		</div>
	</div><?php }
}
