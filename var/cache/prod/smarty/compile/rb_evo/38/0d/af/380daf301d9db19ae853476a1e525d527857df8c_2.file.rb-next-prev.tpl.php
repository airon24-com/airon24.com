<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-next-prev.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f009837ddc21_19413455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '380daf301d9db19ae853476a1e525d527857df8c' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemefunction/views/templates/hook/rb-next-prev.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f009837ddc21_19413455 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="product-button-next-prev">
	<div class="product-button-prev">
		<?php if ((isset($_smarty_tpl->tpl_vars['productPrev']->value)) && !empty($_smarty_tpl->tpl_vars['productPrev']->value)) {?>
			<a class="btn btn-default button button-prev" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productPrev']->value['url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productPrev']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-angle-left"></i>
            </a>

            <div class="button-hover">
            	<img class="img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productPrev']->value['image'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productPrev']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
            	<h5><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productPrev']->value['name'], ENT_QUOTES, 'UTF-8');?>
</h5>
            </div>
		<?php }?>
	</div>

	<div class="product-button-next">
		<?php if ((isset($_smarty_tpl->tpl_vars['productNext']->value)) && !empty($_smarty_tpl->tpl_vars['productNext']->value)) {?>
			<a class="btn btn-default button button-prev" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productNext']->value['url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productNext']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
				<i class="fa fa-angle-right"></i>
            </a>

            <div class="button-hover">
            	<img class="img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productNext']->value['image'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productNext']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
            	<h5><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productNext']->value['name'], ENT_QUOTES, 'UTF-8');?>
</h5>
            </div>
		<?php }?>
	</div>
</div><?php }
}
