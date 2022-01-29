<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick/product-slick-1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172468b3328_22712922',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4ba056e46f942838eaa993a4f37cb30def3ed7e' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick/product-slick-1.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f172468b3328_22712922 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
  <?php $_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_50394353861f1724687c9e5_72534445', 'product_miniature_item');
}
/* {block 'product_thumbnail'} */
class Block_133518531261f17246880879_24073033 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
          <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
" class="thumbnail product-thumbnail">
            <img 
              class="img-fluid rb-image image-cover" 
              data-lazy="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['url'];?>
"
              alt = "<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['cover']['legend'])) {
echo $_smarty_tpl->tpl_vars['product']->value['cover']['legend'];
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' ));
}?>"
              data-full-size-image-url="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'];?>
"
              width="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['width'];?>
"
              height="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['height'];?>
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
                data-lazy="<?php echo $_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['url'];?>
"
                alt = "<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['cover']['legend'])) {
echo $_smarty_tpl->tpl_vars['product']->value['cover']['legend'];
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' ));
}?>"
                title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' ));?>
" 
                width="<?php echo $_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['width'];?>
"
                height="<?php echo $_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['height'];?>
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
          <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
" class="thumbnail product-thumbnail">
            <img 
              data-lazy="<?php echo $_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['home_default']['url'];?>
"
              alt = "<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['cover']['legend'])) {
echo $_smarty_tpl->tpl_vars['product']->value['cover']['legend'];
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' ));
}?>"
              width="<?php echo $_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['home_default']['width'];?>
"
              height="<?php echo $_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['home_default']['height'];?>
"
            >
            <div class="rb-image-loading"></div>
          </a>
          <?php }?>
          <?php
}
}
/* {/block 'product_thumbnail'} */
/* {block 'product_flags'} */
class Block_28594942361f172468998b5_24000907 extends Smarty_Internal_Block
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
            <li class="product-flag <?php echo $_smarty_tpl->tpl_vars['flag']->value['type'];?>
"><?php echo $_smarty_tpl->tpl_vars['flag']->value['label'];?>
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
class Block_44002766461f1724689da25_67307746 extends Smarty_Internal_Block
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
class Block_11704067961f1724689f0c3_33573114 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbWishListProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'product-wishlist'} */
/* {block 'quick_view'} */
class Block_197677219761f172468a02d7_23970932 extends Smarty_Internal_Block
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
class Block_74540143761f172468a1c82_86502208 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbProductCountDown','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product_countdown'} */
/* {block 'product-brand'} */
class Block_19307346161f172468a2e24_25932032 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbBrandProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'product-brand'} */
/* {block 'product_reviews'} */
class Block_91925162761f172468a3f94_69940596 extends Smarty_Internal_Block
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
class Block_212871804861f172468a5993_32040943 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'index') {?>
          <h3 class="h3 product-title" itemprop="name"><a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
" itemprop="url"
              content="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],40,'...' ));?>
</a></h3>
          <?php } else { ?>
          <h2 class="h3 product-title" itemprop="name"><a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
" itemprop="url"
              content="<?php echo $_smarty_tpl->tpl_vars['product']->value['url'];?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],40,'...' ));?>
</a></h2>
          <?php }?>
          <?php
}
}
/* {/block 'product_name'} */
/* {block 'product_price_and_shipping'} */
class Block_96631420561f172468ab147_20849340 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
          <div class="product-price-and-shipping">
            <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>


            <span class="regular-price"
              aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Regular price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['regular_price'];?>
</span>
                        <?php }?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>


            <span class="price" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</span>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="invisible">
              <meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['currency']->value['iso_code'];?>
" />
              <meta itemprop="price" content="<?php echo $_smarty_tpl->tpl_vars['product']->value['price_amount'];?>
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
class Block_50394353861f1724687c9e5_72534445 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_50394353861f1724687c9e5_72534445',
  ),
  'product_thumbnail' => 
  array (
    0 => 'Block_133518531261f17246880879_24073033',
  ),
  'product_flags' => 
  array (
    0 => 'Block_28594942361f172468998b5_24000907',
  ),
  'add_to_cart' => 
  array (
    0 => 'Block_44002766461f1724689da25_67307746',
  ),
  'product-wishlist' => 
  array (
    0 => 'Block_11704067961f1724689f0c3_33573114',
  ),
  'quick_view' => 
  array (
    0 => 'Block_197677219761f172468a02d7_23970932',
  ),
  'product_countdown' => 
  array (
    0 => 'Block_74540143761f172468a1c82_86502208',
  ),
  'product-brand' => 
  array (
    0 => 'Block_19307346161f172468a2e24_25932032',
  ),
  'product_reviews' => 
  array (
    0 => 'Block_91925162761f172468a3f94_69940596',
  ),
  'product_name' => 
  array (
    0 => 'Block_212871804861f172468a5993_32040943',
  ),
  'product_price_and_shipping' => 
  array (
    0 => 'Block_96631420561f172468ab147_20849340',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <?php if ((isset($_smarty_tpl->tpl_vars['position']->value))) {?>
    <meta itemprop="position" content="<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
" /><?php }?>
    <article
      class="product-miniature js-product-miniature <?php if ((isset($_smarty_tpl->tpl_vars['row']->value)) && $_smarty_tpl->tpl_vars['row']->value == 1 && (isset($_smarty_tpl->tpl_vars['config']->value))) {
echo $_smarty_tpl->tpl_vars['config']->value;
}?>"
      data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" data-id-product-attribute="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
" itemscope
      itemtype="http://schema.org/Product">
      <div class="thumbnail-container">
        <div class="product-image">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133518531261f17246880879_24073033', 'product_thumbnail', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28594942361f172468998b5_24000907', 'product_flags', $this->tplIndex);
?>


          <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/rb-ajax-load.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

          <div class="functional-buttons clearfix">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44002766461f1724689da25_67307746', 'add_to_cart', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11704067961f1724689f0c3_33573114', 'product-wishlist', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_197677219761f172468a02d7_23970932', 'quick_view', $this->tplIndex);
?>


                      </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_74540143761f172468a1c82_86502208', 'product_countdown', $this->tplIndex);
?>

        </div>


        <div class="product-meta">
          <div class="meta-top">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19307346161f172468a2e24_25932032', 'product-brand', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_91925162761f172468a3f94_69940596', 'product_reviews', $this->tplIndex);
?>

          </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212871804861f172468a5993_32040943', 'product_name', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96631420561f172468ab147_20849340', 'product_price_and_shipping', $this->tplIndex);
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
