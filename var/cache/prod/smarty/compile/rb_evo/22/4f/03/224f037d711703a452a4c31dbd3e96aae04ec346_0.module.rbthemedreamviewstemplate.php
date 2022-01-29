<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172468e5bd4_60241798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '224f037d711703a452a4c31dbd3e96aae04ec346' => 
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
function content_61f172468e5bd4_60241798 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['testimonials_lists']->value)) && !empty($_smarty_tpl->tpl_vars['testimonials_lists']->value)) {?>
	<div class="rb-testimonial-carousel-wrapper rb-slick-slider">
		<div class="rb-testimonial-carousel" data-slider_options='<?php echo $_smarty_tpl->tpl_vars['slick_options']->value;?>
'>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['testimonials_lists']->value, 'testimonials_list');
$_smarty_tpl->tpl_vars['testimonials_list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['testimonials_list']->value) {
$_smarty_tpl->tpl_vars['testimonials_list']->do_else = false;
?>
				<div class="rb-testimonial-meta-inner">
					<?php if ($_smarty_tpl->tpl_vars['testimonials_list']->value['image']['url'] != '') {?>
						<div class="rb-testimonial-image">
							<img class="" data-lazy="<?php echo $_smarty_tpl->tpl_vars['testimonials_list']->value['image']['url'];?>
">
							<div class="rb-image-loading"></div>
						</div>
					<?php }?>

					<div class="rb-testimonial-details">
						<div class="rb-testimonial-name"><?php echo $_smarty_tpl->tpl_vars['testimonials_list']->value['name'];?>
</div>
						<div class="rb-testimonial-job"><?php echo $_smarty_tpl->tpl_vars['testimonials_list']->value['job'];?>
</div>
					</div>
					
					<?php if ($_smarty_tpl->tpl_vars['testimonials_list']->value['content'] != '') {?>
						<div class="rb-testimonial-content"><?php echo $_smarty_tpl->tpl_vars['testimonials_list']->value['content'];?>
</div>
					<?php }?>	
				</div>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</div>
<?php }
}
}
