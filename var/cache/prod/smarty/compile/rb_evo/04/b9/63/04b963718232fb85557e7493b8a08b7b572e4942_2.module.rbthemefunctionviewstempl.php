<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:38:12
  from 'module:rbthemefunctionviewstempl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00b54d8dfc8_26589292',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04b963718232fb85557e7493b8a08b7b572e4942' => 
    array (
      0 => 'module:rbthemefunctionviewstempl',
      1 => 1641242528,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00b54d8dfc8_26589292 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_93491371461f00b54d86b81_97164742', 'product_add_to_cart');
}
/* {block 'product_availability'} */
class Block_46087568961f00b54d89fe0_47037287 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<span class="product-availability hidden">
									<?php if ($_smarty_tpl->tpl_vars['product']->value['show_availability'] && $_smarty_tpl->tpl_vars['product']->value['availability_message']) {?>
										<?php if ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'available') {?>
											<i class="material-icons product-available">available</i>
										<?php } elseif ($_smarty_tpl->tpl_vars['product']->value['availability'] == 'last_remaining_items') {?>
											<i class="material-icons product-last-items">last-items</i>
										<?php } else { ?>
											<i class="material-icons product-unavailable">unavailable</i>
										<?php }?>
									<?php }?>
								</span>
							<?php
}
}
/* {/block 'product_availability'} */
/* {block 'product_quantity'} */
class Block_95256446661f00b54d892f8_79207039 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<div class="product-quantity">
						<div class="add">
							<button class="btn rb-btn-product add-to-cart" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
" data-button-action="add-to-cart" type="submit">
	
								<span class="icon-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add To Cart','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
							</button>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_46087568961f00b54d89fe0_47037287', 'product_availability', $this->tplIndex);
?>

						</div>
					</div>
				<?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_minimal_quantity'} */
class Block_134188613461f00b54d8c230_10912271 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<p class="product-minimal-quantity hidden">
						<?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] > 1) {?>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum purchase order quantity for the product is %quantity%.','d'=>'Shop.Theme.Global','sprintf'=>array('%quantity%'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity'])),$_smarty_tpl ) );?>

						<?php }?>
					</p>
				<?php
}
}
/* {/block 'product_minimal_quantity'} */
/* {block 'product_add_to_cart'} */
class Block_93491371461f00b54d86b81_97164742 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_add_to_cart' => 
  array (
    0 => 'Block_93491371461f00b54d86b81_97164742',
  ),
  'product_quantity' => 
  array (
    0 => 'Block_95256446661f00b54d892f8_79207039',
  ),
  'product_availability' => 
  array (
    0 => 'Block_46087568961f00b54d89fe0_47037287',
  ),
  'product_minimal_quantity' => 
  array (
    0 => 'Block_134188613461f00b54d8c230_10912271',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="product-add-to-cart-rb">
		<?php if ($_smarty_tpl->tpl_vars['product']->value['availability'] != 'unavailable') {?>
			<?php if ((((Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY') == 1) && (!empty($_smarty_tpl->tpl_vars['product']->value['main_variants']))) || (Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY') == 1 || empty($_smarty_tpl->tpl_vars['product']->value['main_variants'])))) {?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_95256446661f00b54d892f8_79207039', 'product_quantity', $this->tplIndex);
?>


				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_134188613461f00b54d8c230_10912271', 'product_minimal_quantity', $this->tplIndex);
?>
	
			<?php }?>
		<?php }?>
	</div>
<?php
}
}
/* {/block 'product_add_to_cart'} */
}
