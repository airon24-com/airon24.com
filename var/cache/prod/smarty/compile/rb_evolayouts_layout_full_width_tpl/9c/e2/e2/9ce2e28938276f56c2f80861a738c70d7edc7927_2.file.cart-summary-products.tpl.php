<?php
/* Smarty version 3.1.39, created on 2022-01-25 16:47:42
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/cart-summary-products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f01b9ee21545_05373864',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ce2e28938276f56c2f80861a738c70d7edc7927' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/cart-summary-products.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:checkout/_partials/cart-summary-product-line.tpl' => 1,
  ),
),false)) {
function content_61f01b9ee21545_05373864 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

 <div class="cart-summary-products js-cart-summary-products">
  <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['summary_string'], ENT_QUOTES, 'UTF-8');?>
</p>

  <p>
    <a href="#" data-toggle="collapse" data-target="#cart-summary-product-list" class="js-show-details">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'show details','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

      <i class="material-icons">expand_more</i>
    </a>
  </p>

  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_63933051161f01b9ee1fb91_64716546', 'cart_summary_product_list');
?>

</div>
<?php }
/* {block 'cart_summary_product_list'} */
class Block_63933051161f01b9ee1fb91_64716546 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'cart_summary_product_list' => 
  array (
    0 => 'Block_63933051161f01b9ee1fb91_64716546',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="collapse" id="cart-summary-product-list">
      <ul class="media-list">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
          <li class="media"><?php $_smarty_tpl->_subTemplateRender('file:checkout/_partials/cart-summary-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?></li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    </div>
  <?php
}
}
/* {/block 'cart_summary_product_list'} */
}
