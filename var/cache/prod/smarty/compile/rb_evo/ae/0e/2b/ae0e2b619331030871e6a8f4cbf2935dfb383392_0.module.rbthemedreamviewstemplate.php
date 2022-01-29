<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172465b3d67_96390346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae0e2b619331030871e6a8f4cbf2935dfb383392' => 
    array (
      0 => 'module:rbthemedreamviewstemplate',
      1 => 1641242528,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172465b3d67_96390346 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="rb-widget-container rb-theme-slider">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sliders']->value, 'slider');
$_smarty_tpl->tpl_vars['slider']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['slider']->value) {
$_smarty_tpl->tpl_vars['slider']->do_else = false;
?>
		<div class="rb-slider-item" style="position:relative;">
			<img class="img-fluid" src=<?php echo $_smarty_tpl->tpl_vars['slider']->value['image'];?>
 />

			<?php if (!empty($_smarty_tpl->tpl_vars['slider']->value['layers'])) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slider']->value['layers'], 'layer');
$_smarty_tpl->tpl_vars['layer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['layer']->value) {
$_smarty_tpl->tpl_vars['layer']->do_else = false;
?>
					<?php if ((isset($_smarty_tpl->tpl_vars['layer']->value['text']))) {?>
						<div style="<?php echo $_smarty_tpl->tpl_vars['layer']->value['rb_styles'];?>
"><?php echo $_smarty_tpl->tpl_vars['layer']->value['text'];?>
</div>
					<?php }?>

					<?php if ((isset($_smarty_tpl->tpl_vars['layer']->value['button']))) {?>
						<button class="btn" style="<?php echo $_smarty_tpl->tpl_vars['layer']->value['rb_styles'];?>
">
							<?php echo $_smarty_tpl->tpl_vars['layer']->value['button'];?>

						</button>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
		</div>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>


	<?php echo '<script'; ?>
 type="text/javascript">
		$('.rb-theme-slider').slick({infinite:true});
	<?php echo '</script'; ?>
>
<?php }
}
