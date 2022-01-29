<?php
/* Smarty version 3.1.39, created on 2022-01-28 19:52:05
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f43b55940c99_05794461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f89034a9170cfe4f2fc21218030dc7012f67cb65' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/product.tpl',
      1 => 1643395922,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/microdata/product-jsonld.tpl' => 1,
    'file:catalog/_partials/product-cover-thumbnails.tpl' => 1,
    'file:catalog/_partials/product-customization.tpl' => 1,
    'module:rbthemefunction/views/templates/rb-ajax-loading.tpl' => 1,
    'file:catalog/_partials/product-variants.tpl' => 1,
    'file:catalog/_partials/miniatures/pack-product.tpl' => 1,
    'file:catalog/_partials/product-discounts.tpl' => 1,
    'file:catalog/_partials/product-prices.tpl' => 1,
    'file:catalog/_partials/product-add-to-cart.tpl' => 1,
    'file:catalog/_partials/product-additional-info.tpl' => 1,
    'file:catalog/_partials/product-tab.tpl' => 1,
    'file:catalog/_partials/miniatures/product-slick.tpl' => 1,
    'file:catalog/_partials/product-images-modal.tpl' => 1,
  ),
),false)) {
function content_61f43b55940c99_05794461 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_94441673861f43b55908cf5_26744920', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_154057072261f43b55913a72_04670447', 'head_microdata_special');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_157178985461f43b55919b20_77448975', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'head'} */
class Block_94441673861f43b55908cf5_26744920 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_94441673861f43b55908cf5_26744920',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <meta property="og:type" content="product">
  <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
    <meta property="og:image" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
    <meta property="product:pretax_price:amount" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_tax_exc'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:pretax_price:currency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:price:amount" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:price:currency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }?>
  <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['weight'])) && ($_smarty_tpl->tpl_vars['product']->value['weight'] != 0)) {?>
  <meta property="product:weight:value" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['weight'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:weight:units" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['weight_unit'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }
}
}
/* {/block 'head'} */
/* {block 'head_microdata_special'} */
class Block_154057072261f43b55913a72_04670447 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_microdata_special' => 
  array (
    0 => 'Block_154057072261f43b55913a72_04670447',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php $_smarty_tpl->_subTemplateRender('file:_partials/microdata/product-jsonld.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block 'head_microdata_special'} */
/* {block 'product_flags'} */
class Block_67851708761f43b5591ab93_44770544 extends Smarty_Internal_Block
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
          </ul>
          <?php
}
}
/* {/block 'product_flags'} */
/* {block 'product_cover_thumbnails'} */
class Block_11309608161f43b55923943_24918744 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-cover-thumbnails.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          <?php
}
}
/* {/block 'product_cover_thumbnails'} */
/* {block 'page_content'} */
class Block_21935272561f43b5591a821_56069442 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_67851708761f43b5591ab93_44770544', 'product_flags', $this->tplIndex);
?>


          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11309608161f43b55923943_24918744', 'product_cover_thumbnails', $this->tplIndex);
?>

          <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_3829784461f43b5591a498_17386978 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <section class="page-content" id="content">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21935272561f43b5591a821_56069442', 'page_content', $this->tplIndex);
?>

        </section>
        <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'product_discounts'} */
class Block_207349488161f43b55924932_65180293 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNextPrevProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'product_discounts'} */
/* {block 'page_title'} */
class Block_177854649461f43b55928312_41420783 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'page_title'} */
/* {block 'page_header'} */
class Block_76002800161f43b55927578_75208056 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <p><?php if ($_smarty_tpl->tpl_vars['category']->value->id == 2) {?>KLIMATYZATOR<?php }?></p>
        <h1 class="h1 product-detail-name"><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_177854649461f43b55928312_41420783', 'page_title', $this->tplIndex);
?>
</h1>
        <?php
}
}
/* {/block 'page_header'} */
/* {block 'page_header_container'} */
class Block_208785730761f43b55927192_62301812 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_76002800161f43b55927578_75208056', 'page_header', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'product_countdown'} */
class Block_89164628261f43b55929579_74892060 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbProductCountDown','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'product_countdown'} */
/* {block 'product-review'} */
class Block_97110831261f43b5592a089_29895373 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbReviewProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'edit'),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'product-review'} */
/* {block 'product_customization'} */
class Block_124199890761f43b5592b820_55576395 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php $_smarty_tpl->_subTemplateRender("file:catalog/_partials/product-customization.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('customizations'=>$_smarty_tpl->tpl_vars['product']->value['customizations']), 0, false);
?>
          <?php
}
}
/* {/block 'product_customization'} */
/* {block 'product_variants'} */
class Block_38154937361f43b55930c75_42956033 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-variants.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                  <?php
}
}
/* {/block 'product_variants'} */
/* {block 'product_miniature'} */
class Block_64492483861f43b55932ff4_41429726 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/pack-product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product_pack']->value,'showPackProductsPrice'=>$_smarty_tpl->tpl_vars['product']->value['show_price']), 0, true);
?>
                          <?php
}
}
/* {/block 'product_miniature'} */
/* {block 'product_pack'} */
class Block_201790833261f43b559316a2_12242233 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php if ($_smarty_tpl->tpl_vars['packItems']->value) {?>
                      <section class="product-pack">
                        <p class="h4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This pack contains','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</p>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['packItems']->value, 'product_pack');
$_smarty_tpl->tpl_vars['product_pack']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product_pack']->value) {
$_smarty_tpl->tpl_vars['product_pack']->do_else = false;
?>
                          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64492483861f43b55932ff4_41429726', 'product_miniature', $this->tplIndex);
?>

                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </section>
                    <?php }?>
                  <?php
}
}
/* {/block 'product_pack'} */
/* {block 'product_discounts'} */
class Block_26884142661f43b559346c6_02708335 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-discounts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                  <?php
}
}
/* {/block 'product_discounts'} */
/* {block 'product_description_short'} */
class Block_44225947861f43b55935057_78355172 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <div id="product-description-short-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" class="product-description"><?php echo $_smarty_tpl->tpl_vars['product']->value['description_short'];?>
</div>
          <?php
}
}
/* {/block 'product_description_short'} */
/* {block 'product_prices'} */
class Block_212289718661f43b559360e0_82087219 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-prices.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'product_prices'} */
/* {block 'product_add_to_cart'} */
class Block_2278336961f43b55936ae5_63023800 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-add-to-cart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                  <?php
}
}
/* {/block 'product_add_to_cart'} */
/* {block 'product_additional_info'} */
class Block_30512980261f43b55937430_38120213 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-additional-info.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                  <?php
}
}
/* {/block 'product_additional_info'} */
/* {block 'product-print'} */
class Block_44198701561f43b55937d61_29240334 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php if (Configuration::get('RBTHEMEFUNCTION_BUTTON_PRINT') == 1) {?>
              <a class="rb-print rb-btn-product" href="javascript:print();">
                <i class="fa fa-print"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Print','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

              </a>
              <?php }?>
              <?php
}
}
/* {/block 'product-print'} */
/* {block 'product-print'} */
class Block_130190808461f43b55939244_06490944 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTagCateProduct','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

              <?php
}
}
/* {/block 'product-print'} */
/* {block 'product_refresh'} */
class Block_155848233361f43b55939dc3_60890505 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'product_refresh'} */
/* {block 'product_buy'} */
class Block_66665822061f43b5592f4c7_51922254 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['cart'], ENT_QUOTES, 'UTF-8');?>
" method="post" id="add-to-cart-or-refresh">
              <input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
">
              <input type="hidden" name="id_product" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" id="product_page_product_id">
                  <input type="hidden" name="id_customization" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" id="product_customization_id" class="js-product-customization-id">

                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_38154937361f43b55930c75_42956033', 'product_variants', $this->tplIndex);
?>


                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_201790833261f43b559316a2_12242233', 'product_pack', $this->tplIndex);
?>


                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26884142661f43b559346c6_02708335', 'product_discounts', $this->tplIndex);
?>


                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44225947861f43b55935057_78355172', 'product_description_short', $this->tplIndex);
?>

                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212289718661f43b559360e0_82087219', 'product_prices', $this->tplIndex);
?>


        <div class="m-accordion is-variation-1 mt-10">
                            <h3 class="m-accordion-header js-toggle is-active" data-id="accordion-1" data-animation="200" data-watcher-off="true">Usługa montażu klimatyzacji</h3>
                            <div id="accordion-1" class="m-accordion-contents">
                                <div class="fs-14px text-left mb-5 mt-5"><p>W skład poniższych cen wchodzi wybrany klimatyzator&nbsp;z <strong>usługą montażu&nbsp;podstawowego.</strong> Termin montażu do 14 dni.&nbsp;Skontaktujemy się do 48 godzin po złożeniu zamówienia w celu ustalenia dogodnego terminu.</p>

<p><a class="primary-color" href="#" target="_self" title="Sprawdź warunki usługi">Sprawdź cennik i warunki świadczenia usług</a></p>
</div>
                                <div class="flex flex-wrap mx-n10">
                                    <div class="col-6">
                                    <div class="m-checkable-tile">
                                        <input id="extraServiceForm-1_2" type="radio" value="1_2" name="service_ids[1][]">
                                        <label for="extraServiceForm-1_2" class="m-checkable-tile-inner-box">
                                            <p class="fs-16px text-left mb-5"><b>Montaż B2C</b></p>
                                            <p class="fs-14px text-left"><b class="fs-18px">3 945,46</b> zł</p>
                                            <div class="fs-12px gray-3 text-left mt-5"><p>klimatyzator z&nbsp;montażem&nbsp;dla konsumenta (8% VAT)</p>
</div>   
                                        </label>
                                    </div>
                                </div><div class="col-6">
                                    <div class="m-checkable-tile">
                                        <input id="extraServiceForm-1_3" type="radio" value="1_3" name="service_ids[1][]">
                                        <label for="extraServiceForm-1_3" class="m-checkable-tile-inner-box">
                                            <p class="fs-16px text-left mb-5"><b>Montaż B2B</b></p>
                                            <p class="fs-14px text-left"><b class="fs-18px">4 493,49</b> zł</p>
                                            <div class="fs-12px gray-3 text-left mt-5"><p>klimatyzator&nbsp;z montażem&nbsp;dla firmy (23% VAT)</p>
</div>   
                                        </label>
                                    </div>
                                </div>
                                </div>
                                <label class="c-radio primary-theme flex align-center">
                                <input class="c-radio-input" type="radio" value="1_1" name="service_ids[1][]">
                                <span class="c-radio-label fs-14px">Bez montażu (wymagane oświadczenie z nr F-GAZ instalatora) (2 899,00 zł)</span>
                            </label>
                            </div>
                        </div>

                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2278336961f43b55936ae5_63023800', 'product_add_to_cart', $this->tplIndex);
?>


                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30512980261f43b55937430_38120213', 'product_additional_info', $this->tplIndex);
?>


              <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44198701561f43b55937d61_29240334', 'product-print', $this->tplIndex);
?>

              <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_130190808461f43b55939244_06490944', 'product-print', $this->tplIndex);
?>


                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_155848233361f43b55939dc3_60890505', 'product_refresh', $this->tplIndex);
?>

            </form>
            <?php
}
}
/* {/block 'product_buy'} */
/* {block 'hook_display_reassurance'} */
class Block_85713268761f43b5593a818_18127142 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayReassurance'),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'hook_display_reassurance'} */
/* {block 'product_tabs'} */
class Block_129467390361f43b5593b158_67089702 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-tab.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php
}
}
/* {/block 'product_tabs'} */
/* {block 'product_miniature'} */
class Block_147811272361f43b5593d239_23481301 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/product-slick.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product_accessory']->value,'position'=>$_smarty_tpl->tpl_vars['position']->value), 0, true);
?>
        <?php
}
}
/* {/block 'product_miniature'} */
/* {block 'product_accessories'} */
class Block_19281512361f43b5593bab4_49709482 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['accessories']->value) {?>
    <section class="product-accessories clearfix mt-3">
      <p class="h5 products-section-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You might also like','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</p>
      <div class="products featured-products-slick" itemscope itemtype="http://schema.org/ItemList">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accessories']->value, 'product_accessory', false, 'position');
$_smarty_tpl->tpl_vars['product_accessory']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['position']->value => $_smarty_tpl->tpl_vars['product_accessory']->value) {
$_smarty_tpl->tpl_vars['product_accessory']->do_else = false;
?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_147811272361f43b5593d239_23481301', 'product_miniature', $this->tplIndex);
?>
 
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
    </section>
    <?php }?>
    <?php
}
}
/* {/block 'product_accessories'} */
/* {block 'product_footer'} */
class Block_70512193561f43b5593e535_00358220 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'category'=>$_smarty_tpl->tpl_vars['category']->value),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'product_footer'} */
/* {block 'product_images_modal'} */
class Block_71442828661f43b5593f162_42610473 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-images-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php
}
}
/* {/block 'product_images_modal'} */
/* {block 'page_footer'} */
class Block_26366253161f43b5593fec4_83901548 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <!-- Footer content -->
      <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_44597036961f43b5593fad8_16826922 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <footer class="page-footer">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26366253161f43b5593fec4_83901548', 'page_footer', $this->tplIndex);
?>

    </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_157178985461f43b55919b20_77448975 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_157178985461f43b55919b20_77448975',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_3829784461f43b5591a498_17386978',
  ),
  'page_content' => 
  array (
    0 => 'Block_21935272561f43b5591a821_56069442',
  ),
  'product_flags' => 
  array (
    0 => 'Block_67851708761f43b5591ab93_44770544',
  ),
  'product_cover_thumbnails' => 
  array (
    0 => 'Block_11309608161f43b55923943_24918744',
  ),
  'product_discounts' => 
  array (
    0 => 'Block_207349488161f43b55924932_65180293',
    1 => 'Block_26884142661f43b559346c6_02708335',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_208785730761f43b55927192_62301812',
  ),
  'page_header' => 
  array (
    0 => 'Block_76002800161f43b55927578_75208056',
  ),
  'page_title' => 
  array (
    0 => 'Block_177854649461f43b55928312_41420783',
  ),
  'product_countdown' => 
  array (
    0 => 'Block_89164628261f43b55929579_74892060',
  ),
  'product-review' => 
  array (
    0 => 'Block_97110831261f43b5592a089_29895373',
  ),
  'product_customization' => 
  array (
    0 => 'Block_124199890761f43b5592b820_55576395',
  ),
  'product_buy' => 
  array (
    0 => 'Block_66665822061f43b5592f4c7_51922254',
  ),
  'product_variants' => 
  array (
    0 => 'Block_38154937361f43b55930c75_42956033',
  ),
  'product_pack' => 
  array (
    0 => 'Block_201790833261f43b559316a2_12242233',
  ),
  'product_miniature' => 
  array (
    0 => 'Block_64492483861f43b55932ff4_41429726',
    1 => 'Block_147811272361f43b5593d239_23481301',
  ),
  'product_description_short' => 
  array (
    0 => 'Block_44225947861f43b55935057_78355172',
  ),
  'product_prices' => 
  array (
    0 => 'Block_212289718661f43b559360e0_82087219',
  ),
  'product_add_to_cart' => 
  array (
    0 => 'Block_2278336961f43b55936ae5_63023800',
  ),
  'product_additional_info' => 
  array (
    0 => 'Block_30512980261f43b55937430_38120213',
  ),
  'product-print' => 
  array (
    0 => 'Block_44198701561f43b55937d61_29240334',
    1 => 'Block_130190808461f43b55939244_06490944',
  ),
  'product_refresh' => 
  array (
    0 => 'Block_155848233361f43b55939dc3_60890505',
  ),
  'hook_display_reassurance' => 
  array (
    0 => 'Block_85713268761f43b5593a818_18127142',
  ),
  'product_tabs' => 
  array (
    0 => 'Block_129467390361f43b5593b158_67089702',
  ),
  'product_accessories' => 
  array (
    0 => 'Block_19281512361f43b5593bab4_49709482',
  ),
  'product_footer' => 
  array (
    0 => 'Block_70512193561f43b5593e535_00358220',
  ),
  'product_images_modal' => 
  array (
    0 => 'Block_71442828661f43b5593f162_42610473',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_44597036961f43b5593fad8_16826922',
  ),
  'page_footer' => 
  array (
    0 => 'Block_26366253161f43b5593fec4_83901548',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">
    <meta content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
">

    <div class="row js-product-container">
      <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3829784461f43b5591a498_17386978', 'page_content_container', $this->tplIndex);
?>

      </div>
      <div class="detail-padding-left col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_207349488161f43b55924932_65180293', 'product_discounts', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_208785730761f43b55927192_62301812', 'page_header_container', $this->tplIndex);
?>

        

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89164628261f43b55929579_74892060', 'product_countdown', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97110831261f43b5592a089_29895373', 'product-review', $this->tplIndex);
?>


        <div class="product-information">
          

          <?php if ($_smarty_tpl->tpl_vars['product']->value['is_customizable'] && count($_smarty_tpl->tpl_vars['product']->value['customizations']['fields'])) {?>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_124199890761f43b5592b820_55576395', 'product_customization', $this->tplIndex);
?>

          <?php }?>

            <div class="product-actions js-product-actions">
            <?php $_smarty_tpl->_subTemplateRender('module:rbthemefunction/views/templates/rb-ajax-loading.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_66665822061f43b5592f4c7_51922254', 'product_buy', $this->tplIndex);
?>


            </div>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85713268761f43b5593a818_18127142', 'hook_display_reassurance', $this->tplIndex);
?>

        </div>
      </div>

      <div class="col-xs-12">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129467390361f43b5593b158_67089702', 'product_tabs', $this->tplIndex);
?>

      </div>
    </div>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19281512361f43b5593bab4_49709482', 'product_accessories', $this->tplIndex);
?>



    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_70512193561f43b5593e535_00358220', 'product_footer', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_71442828661f43b5593f162_42610473', 'product_images_modal', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44597036961f43b5593fad8_16826922', 'page_footer_container', $this->tplIndex);
?>

    <div class="page-loading-overlay main-product-details-loading"></div>
  </section>

  <?php
}
}
/* {/block 'content'} */
}
