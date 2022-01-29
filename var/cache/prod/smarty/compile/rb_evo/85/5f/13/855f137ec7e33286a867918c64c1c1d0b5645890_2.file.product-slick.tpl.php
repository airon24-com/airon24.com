<?php
/* Smarty version 3.1.39, created on 2022-01-25 16:49:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f01c0754c471_35045838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '855f137ec7e33286a867918c64c1c1d0b5645890' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f01c0754c471_35045838 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_126266996661f01c07526fc4_30321226', 'product_miniature_item');
}
/* {block 'product_thumbnail'} */
class Block_67833102061f01c0752ad45_86874833 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail">
                  <img
                    class="img-fluid rb-image image-cover"
                    data-lazy = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
                    data-full-size-image-url = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
"
                  >

                  <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['images'])) {?>
                    <?php $_smarty_tpl->_assignInScope('count', 1);?>

                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['images'], 'image');
$_smarty_tpl->tpl_vars['image']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->do_else = false;
?>
                      <?php if ($_smarty_tpl->tpl_vars['count']->value == 1 && $_smarty_tpl->tpl_vars['image']->value['cover'] != 1 && $_smarty_tpl->tpl_vars['image']->value['id_image'] != $_smarty_tpl->tpl_vars['product']->value['cover']['id_image']) {?>
                        <div class="product-hover">
                          <img
                            class="img-fluid rb-image image-hover"
                            data-lazy = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
                            title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
"
                            width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['width'], ENT_QUOTES, 'UTF-8');?>
"
                            height="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['height'], ENT_QUOTES, 'UTF-8');?>
"
                          >
                        </div>

            <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);?>
            <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>

            <div class="rb-image-loading"></div>
          </a>
          <?php } else { ?>
          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail">
            <img data-lazy="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
">
            <div class="rb-image-loading"></div>
          </a>
          <?php }?>
          <?php
}
}
/* {/block 'product_thumbnail'} */
/* {block 'product_flags'} */
class Block_10008148761f01c075353e4_55058346 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <ul class="product-flags">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['flags'], 'flag');
$_smarty_tpl->tpl_vars['flag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['flag']->value) {
$_smarty_tpl->tpl_vars['flag']->do_else = false;
?>
            <li class="product-flag <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['type'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['label'], ENT_QUOTES, 'UTF-8');?>
</li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>

          </ul>
          <?php
}
}
/* {/block 'product_flags'} */
/* {block 'add_to_cart'} */
class Block_137131478561f01c07538267_51208845 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="product-add-cart">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbAddToCart','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            </div>
            <?php
}
}
/* {/block 'add_to_cart'} */
/* {block 'product-wishlist'} */
class Block_202437582761f01c07539454_97032319 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbWishListProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'product-wishlist'} */
/* {block 'quick_view'} */
class Block_132923589861f01c0753a4a6_18924710 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="product-quickview hidden-sm-down">
              <a class="rb-quick-view rb-btn-product" href="#" data-link-action="quickview">
                <i class="icon-Icon_Quick-view"></i>
                <span class="icon-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quick view','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
              </a>
            </div>

            <div class="product-quick-view" style="display:none;">
              <a class="quick-view rb-btn-product" href="#" data-link-action="quickview">
                <i class="icon-Icon_Quick-view search"></i>
                <span class="icon-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quick view','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
              </a>
            </div>
            <?php
}
}
/* {/block 'quick_view'} */
/* {block 'product_countdown'} */
class Block_83583745461f01c0753b4b6_07756871 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbProductCountDown','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product_countdown'} */
/* {block 'product-brand'} */
class Block_86560326461f01c0753bf72_92813097 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbBrandProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'product-brand'} */
/* {block 'product_reviews'} */
class Block_212604123561f01c0753d036_15729633 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbReviewProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'num_star'),$_smarty_tpl ) );?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'product_reviews'} */
/* {block 'product_name'} */
class Block_92442534361f01c0753e9f4_97727757 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'index') {?>
          <h3 class="h3 product-title" itemprop="name"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" itemprop="url"
              content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],40,'...' )), ENT_QUOTES, 'UTF-8');?>
</a></h3>
          <?php } else { ?>
          <h2 class="h3 product-title" itemprop="name"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" itemprop="url"
              content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],40,'...' )), ENT_QUOTES, 'UTF-8');?>
</a></h2>
          <?php }?>
          <?php
}
}
/* {/block 'product_name'} */
/* {block 'product_price_and_shipping'} */
class Block_136703801561f01c07543946_20721374 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
          <div class="product-price-and-shipping">
            <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>


            <span class="regular-price"
              aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Regular price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['regular_price'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'percentage') {?>
            <span class="discount-percentage discount-product"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_percentage'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'amount') {?>
            <span class="discount-amount discount-product"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_amount_to_display'], ENT_QUOTES, 'UTF-8');?>
</span>
            <?php }?>
            <?php }?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>


            <span class="price" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price'], ENT_QUOTES, 'UTF-8');?>
</span>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="invisible">
              <meta itemprop="priceCurrency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
" />
              <meta itemprop="price" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
" />
            </div>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'unit_price'),$_smarty_tpl ) );?>


            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'weight'),$_smarty_tpl ) );?>

          </div>
          <?php }?>
          <?php
}
}
/* {/block 'product_price_and_shipping'} */
/* {block 'product_miniature_item'} */
class Block_126266996661f01c07526fc4_30321226 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_126266996661f01c07526fc4_30321226',
  ),
  'product_thumbnail' => 
  array (
    0 => 'Block_67833102061f01c0752ad45_86874833',
  ),
  'product_flags' => 
  array (
    0 => 'Block_10008148761f01c075353e4_55058346',
  ),
  'add_to_cart' => 
  array (
    0 => 'Block_137131478561f01c07538267_51208845',
  ),
  'product-wishlist' => 
  array (
    0 => 'Block_202437582761f01c07539454_97032319',
  ),
  'quick_view' => 
  array (
    0 => 'Block_132923589861f01c0753a4a6_18924710',
  ),
  'product_countdown' => 
  array (
    0 => 'Block_83583745461f01c0753b4b6_07756871',
  ),
  'product-brand' => 
  array (
    0 => 'Block_86560326461f01c0753bf72_92813097',
  ),
  'product_reviews' => 
  array (
    0 => 'Block_212604123561f01c0753d036_15729633',
  ),
  'product_name' => 
  array (
    0 => 'Block_92442534361f01c0753e9f4_97727757',
  ),
  'product_price_and_shipping' => 
  array (
    0 => 'Block_136703801561f01c07543946_20721374',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <?php if ((isset($_smarty_tpl->tpl_vars['position']->value))) {?>
    <meta itemprop="position" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
    <article
      class="product-miniature js-product-miniature <?php if ((isset($_smarty_tpl->tpl_vars['row']->value)) && $_smarty_tpl->tpl_vars['row']->value == 1 && (isset($_smarty_tpl->tpl_vars['config']->value))) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value, ENT_QUOTES, 'UTF-8');
}?>"
      data-id-product="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" data-id-product-attribute="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], ENT_QUOTES, 'UTF-8');?>
" itemscope
      itemtype="http://schema.org/Product">
      <div class="thumbnail-container">
        <div class="product-image">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_67833102061f01c0752ad45_86874833', 'product_thumbnail', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10008148761f01c075353e4_55058346', 'product_flags', $this->tplIndex);
?>


            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/rb-ajax-load.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

          <div class="functional-buttons clearfix">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_137131478561f01c07538267_51208845', 'add_to_cart', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_202437582761f01c07539454_97032319', 'product-wishlist', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132923589861f01c0753a4a6_18924710', 'quick_view', $this->tplIndex);
?>


                      </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83583745461f01c0753b4b6_07756871', 'product_countdown', $this->tplIndex);
?>

        </div>


        <div class="product-meta">
          <div class="meta-top">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_86560326461f01c0753bf72_92813097', 'product-brand', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212604123561f01c0753d036_15729633', 'product_reviews', $this->tplIndex);
?>

          </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_92442534361f01c0753e9f4_97727757', 'product_name', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136703801561f01c07543946_20721374', 'product_price_and_shipping', $this->tplIndex);
?>

        </div>



              </div>
    </article>
  </div>
  <?php
}
}
/* {/block 'product_miniature_item'} */
}
