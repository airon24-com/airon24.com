<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-add-to-cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00983859518_84730840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad45367096f517ea099111875ac9b6cc0210b6fe' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-add-to-cart.tpl',
      1 => 1643120916,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00983859518_84730840 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="product-add-to-cart js-product-add-to-cart flex-yc flex-wrap space-between my-10">
  <?php if (!$_smarty_tpl->tpl_vars['configuration']->value['is_catalog']) {?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_47424828761f0098384ec80_52369501', 'product_quantity');
?>

    <div class="flex-yc max-w-200 my-10" style="max-width: 50%; justify-content: end;">
                        <img class="max-w-50 mr-15 js-iao-url-built lazyloaded" src="https://static.aero7.pl/imgv-webp-480x-width/assets/publicarea/images/poland-gradient-contour.png" data-src="https://static.aero7.pl/imgv-webp-480x-width/assets/publicarea/images/poland-gradient-contour.png" alt="">
                        <div class="fs-12px uppercase">Oferujemy montaż<br> w całej Polsce</div>
                    </div>

        
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_99962125861f00983856e67_97679488', 'product_minimal_quantity');
?>

  <?php }?>
</div>

<div class="flex-xyc flex-wrap gray-bg radius py-5 px-20 lh-1d5">
                <span class="fs-16px uppercase mx-10 my-5 text-center">Profesjonalna porada</span><img class="max-w-22 mr-10 ls-is-cached lazyloaded" src="http://greenwat.eu/shop/img/call.png" alt="call">
                <a class="c-phone-number mx-10 my-5 icube-icon-phone js-is-clickable js-send-google-event" href="tel:(+48) 22 487 55 27" title="Skontaktuj się z nami" data-eventcategory="phone" data-eventaction="phone_click" data-eventlabel="product_card_924_1020">(+48) 22 487 55 27</a>
            </div><?php }
/* {block 'product-compare'} */
class Block_21354911461f00983853660_67877831 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbWishListProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product-compare'} */
/* {block 'product-compare'} */
class Block_86331319161f00983854715_38694936 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbCompareProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product-compare'} */
/* {block 'product_quantity'} */
class Block_47424828761f0098384ec80_52369501 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_quantity' => 
  array (
    0 => 'Block_47424828761f0098384ec80_52369501',
  ),
  'product-compare' => 
  array (
    0 => 'Block_21354911461f00983853660_67877831',
    1 => 'Block_86331319161f00983854715_38694936',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div class="product-quantity clearfix flex-yc my-10">
        <div class="qty">
          <span class="control-label hidden-xl-down"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
          <input
            type="number"
            name="qty"
            id="quantity_wanted"
            inputmode="numeric"
            pattern="[0-9]*"
            <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity_wanted']) {?>
              value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['quantity_wanted'], ENT_QUOTES, 'UTF-8');?>
"
              min="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"
            <?php } else { ?>
              value="1"
              min="1"
            <?php }?>
            class="input-group"
            aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
"
          >
        </div>

        <div class="add">
          <button
            class="btn btn-primary add-to-cart"
            data-button-action="add-to-cart"
            type="submit"
            <?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url']) {?>
              disabled
            <?php }?>
          >
            <i class="rub-shopping-cart"></i>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

          </button>
	  <div class="page-loading-overlay add-to-cart-loading"></div>
      </div>
        </div>
        <div class="compare-wishlist-button">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21354911461f00983853660_67877831', 'product-compare', $this->tplIndex);
?>
  
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_86331319161f00983854715_38694936', 'product-compare', $this->tplIndex);
?>
   
        </div>
    <?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_minimal_quantity'} */
class Block_99962125861f00983856e67_97679488 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_minimal_quantity' => 
  array (
    0 => 'Block_99962125861f00983856e67_97679488',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <p class="product-minimal-quantity js-product-minimal-quantity">
        <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] > 1) {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum purchase order quantity for the product is %quantity%.','d'=>'Shop.Theme.Checkout','sprintf'=>array('%quantity%'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity'])),$_smarty_tpl ) );?>

        <?php }?>
      </p>
    <?php
}
}
/* {/block 'product_minimal_quantity'} */
}
