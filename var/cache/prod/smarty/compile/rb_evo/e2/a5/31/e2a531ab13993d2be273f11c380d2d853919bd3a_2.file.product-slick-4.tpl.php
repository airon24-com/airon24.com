<?php
/* Smarty version 3.1.39, created on 2022-01-28 06:05:54
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick/product-slick-4.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f379b28ce6b4_23388175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2a531ab13993d2be273f11c380d2d853919bd3a' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/miniatures/product-slick/product-slick-4.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f379b28ce6b4_23388175 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
  <?php $_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88507012461f379b28b7838_96337851', 'product_miniature_item');
}
/* {block 'product_thumbnail'} */
class Block_176873517561f379b28b9c71_49130811 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail">
            <img class="img-fluid rb-image image-cover" data-lazy="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
              data-full-size-image-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
">

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
              <img class="img-fluid rb-image image-hover" data-lazy="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['url'], ENT_QUOTES, 'UTF-8');?>
"
                title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
" width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['width'], ENT_QUOTES, 'UTF-8');?>
"
                height="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['bySize']['home_default']['height'], ENT_QUOTES, 'UTF-8');?>
">
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
class Block_164452917361f379b28c1478_36277264 extends Smarty_Internal_Block
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
/* {block 'product-wishlist'} */
class Block_21502062061f379b28c38b2_95546711 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbWishListProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product-wishlist'} */
/* {block 'add_to_cart'} */
class Block_64791128861f379b28c45a8_03812934 extends Smarty_Internal_Block
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
/* {block 'quick_view'} */
class Block_203984565261f379b28c4f95_06460383 extends Smarty_Internal_Block
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
/* {block 'rb_compare'} */
class Block_213412055861f379b28c5d29_41686694 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="product-compare">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbCompareProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

            </div>
            <?php
}
}
/* {/block 'rb_compare'} */
/* {block 'product_countdown'} */
class Block_132524834261f379b28c66b5_96160057 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbProductCountDown','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'product_countdown'} */
/* {block 'product_name'} */
class Block_165918654661f379b28c7131_95427438 extends Smarty_Internal_Block
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
class Block_109280030861f379b28ca0a4_16893753 extends Smarty_Internal_Block
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
class Block_88507012461f379b28b7838_96337851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_88507012461f379b28b7838_96337851',
  ),
  'product_thumbnail' => 
  array (
    0 => 'Block_176873517561f379b28b9c71_49130811',
  ),
  'product_flags' => 
  array (
    0 => 'Block_164452917361f379b28c1478_36277264',
  ),
  'product-wishlist' => 
  array (
    0 => 'Block_21502062061f379b28c38b2_95546711',
  ),
  'add_to_cart' => 
  array (
    0 => 'Block_64791128861f379b28c45a8_03812934',
  ),
  'quick_view' => 
  array (
    0 => 'Block_203984565261f379b28c4f95_06460383',
  ),
  'rb_compare' => 
  array (
    0 => 'Block_213412055861f379b28c5d29_41686694',
  ),
  'product_countdown' => 
  array (
    0 => 'Block_132524834261f379b28c66b5_96160057',
  ),
  'product_name' => 
  array (
    0 => 'Block_165918654661f379b28c7131_95427438',
  ),
  'product_price_and_shipping' => 
  array (
    0 => 'Block_109280030861f379b28ca0a4_16893753',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="product-style4" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_176873517561f379b28b9c71_49130811', 'product_thumbnail', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164452917361f379b28c1478_36277264', 'product_flags', $this->tplIndex);
?>


          <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/rb-ajax-load.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21502062061f379b28c38b2_95546711', 'product-wishlist', $this->tplIndex);
?>


          <div class="functional-buttons clearfix">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64791128861f379b28c45a8_03812934', 'add_to_cart', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_203984565261f379b28c4f95_06460383', 'quick_view', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_213412055861f379b28c5d29_41686694', 'rb_compare', $this->tplIndex);
?>

          </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132524834261f379b28c66b5_96160057', 'product_countdown', $this->tplIndex);
?>

        </div>


        <div class="product-meta">
          
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_165918654661f379b28c7131_95427438', 'product_name', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_109280030861f379b28ca0a4_16893753', 'product_price_and_shipping', $this->tplIndex);
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
