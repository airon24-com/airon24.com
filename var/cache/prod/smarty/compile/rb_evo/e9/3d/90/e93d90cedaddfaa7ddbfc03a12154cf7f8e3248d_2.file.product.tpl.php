<?php
/* Smarty version 3.1.39, created on 2022-01-26 07:52:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbproductdetail/views/templates/hook/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0efabc427f1_85206474',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e93d90cedaddfaa7ddbfc03a12154cf7f8e3248d' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbproductdetail/views/templates/hook/product.tpl',
      1 => 1643179940,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/product-prices.tpl' => 1,
    'file:catalog/_partials/product-variants.tpl' => 1,
    'file:catalog/_partials/product-discounts.tpl' => 1,
  ),
),false)) {
function content_61f0efabc427f1_85206474 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div id="rb-product-cart" class="rb-hidden-detail hidden-md-down">
  <div class="container">
    <div class="rb-product-thumb">
      <div class="product-cover-img">
        <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
              <img
                class="js-qv-product-cover img img-thumb"
                src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['small_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
                alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
"
                title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['legend'], ENT_QUOTES, 'UTF-8');?>
"
                itemprop="image"
              >
            <?php } else { ?>
              <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['small_default']['url'], ENT_QUOTES, 'UTF-8');?>
">
            <?php }?>
      </div>

      <div class="rb-description-sticky">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_31732760661f0efabc365e7_44549582', 'page_header');
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_118751343161f0efabc381b1_81591441', 'product_prices');
?>

      </div>
    </div>
      
    <div class="product-actions">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58611074561f0efabc3da61_98702448', 'product_variants');
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_144728774861f0efabc3e526_33841483', 'product_add_to_cart');
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170997174361f0efabc41cd6_02085509', 'product_discounts');
?>
    
    </div>
  </div>
</div><?php }
/* {block 'page_title'} */
class Block_75075710961f0efabc36c34_43523856 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'page_title'} */
/* {block 'page_header'} */
class Block_31732760661f0efabc365e7_44549582 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header' => 
  array (
    0 => 'Block_31732760661f0efabc365e7_44549582',
  ),
  'page_title' => 
  array (
    0 => 'Block_75075710961f0efabc36c34_43523856',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <h1 class="h1 product-detail-name" itemprop="name">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75075710961f0efabc36c34_43523856', 'page_title', $this->tplIndex);
?>

          </h1>
        <?php
}
}
/* {/block 'page_header'} */
/* {block 'product_prices'} */
class Block_118751343161f0efabc381b1_81591441 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_prices' => 
  array (
    0 => 'Block_118751343161f0efabc381b1_81591441',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-prices.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'product_prices'} */
/* {block 'product_variants'} */
class Block_58611074561f0efabc3da61_98702448 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_variants' => 
  array (
    0 => 'Block_58611074561f0efabc3da61_98702448',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-variants.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'product_variants'} */
/* {block 'product_add_to_cart'} */
class Block_144728774861f0efabc3e526_33841483 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_add_to_cart' => 
  array (
    0 => 'Block_144728774861f0efabc3e526_33841483',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <div class="rb-product-add-to-cart">
            <span class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','mod'=>'rbproductdetail'),$_smarty_tpl ) );?>
</span>

            <div class="rb-product-quantity clearfix">
              <div class="qty">
               <div class="input-group bootstrap-touchspin">
                  <input
                    type="number"
                    name="qty"
                    id="quantity_wanted"
                    value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"
                    class="input-group form-control"
                    min="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"
                    aria-label="Quantity"
                  >

                  <span class="input-group-btn-vertical">
                    <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">
                      <i class="material-icons touchspin-up"></i>
                    </button>
                    <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">
                      <i class="material-icons touchspin-down"></i>
                    </button>
                  </span>
                </div>
              </div>

              <div class="add">
                <a class="btn btn-primary add-to-cart">
                  <i class="material-icons shopping-cart"></i>
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','mod'=>'rbproductdetail'),$_smarty_tpl ) );?>

                </a>
              </div>
            </div>
          </div>
        <?php
}
}
/* {/block 'product_add_to_cart'} */
/* {block 'product_discounts'} */
class Block_170997174361f0efabc41cd6_02085509 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_discounts' => 
  array (
    0 => 'Block_170997174361f0efabc41cd6_02085509',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-discounts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'product_discounts'} */
}
