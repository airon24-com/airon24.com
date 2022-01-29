<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/product-list-mini.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d4619a1298_58059610',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72ffc6783093acc0fb5bb151daf3354d913a8c29' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/product-list-mini.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d4619a1298_58059610 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['products']->value)) && $_smarty_tpl->tpl_vars['products']->value) {?>
	<!-- Products list -->
	<ul<?php if ((isset($_smarty_tpl->tpl_vars['id']->value)) && $_smarty_tpl->tpl_vars['id']->value) {?> id="<?php echo intval($_smarty_tpl->tpl_vars['id']->value);?>
"<?php }?> class="product_list grid row<?php if ((isset($_smarty_tpl->tpl_vars['class']->value)) && $_smarty_tpl->tpl_vars['class']->value) {?> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['class']->value,'html','UTF-8' ));
}?>">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, NULL, 'products', array (
));
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>		
		<li class="ajax_block_product col-xs-12 col-sm-12">
			<div class="product-container" itemscope itemtype="https://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container">
						<a class="product_img_link" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['link'],'html','UTF-8' ));?>
" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' ));?>
" itemprop="url">
							<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['image_id']))) {
$_smarty_tpl->_assignInScope('imageLink', $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['image_id'],$_smarty_tpl->tpl_vars['imageType']->value));
} else {
$_smarty_tpl->_assignInScope('imageLink', $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],$_smarty_tpl->tpl_vars['imageType']->value));
}?>
                            <img class="replace-2x img-responsive" src="<?php if ((strpos($_smarty_tpl->tpl_vars['imageLink']->value,'http://') === false || strpos($_smarty_tpl->tpl_vars['imageLink']->value,'https://'))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['protocol_link']->value,'html','UTF-8' ));
}
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['imageLink']->value,'html','UTF-8' ));?>
" alt="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['legend'],'html','UTF-8' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' ));
}?>" title="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['legend'],'html','UTF-8' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' ));
}?>" <?php if ((isset($_smarty_tpl->tpl_vars['homeSize']->value))) {?> width="<?php echo floatval($_smarty_tpl->tpl_vars['homeSize']->value['width']);?>
" height="<?php echo floatval($_smarty_tpl->tpl_vars['homeSize']->value['height']);?>
"<?php }?> itemprop="image" />
						</a>
                    </div>
				</div>
				<div class="right-block">
					<h5 itemprop="name">
						<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['pack_quantity'])) && $_smarty_tpl->tpl_vars['product']->value['pack_quantity']) {
echo (intval($_smarty_tpl->tpl_vars['product']->value['pack_quantity'])).(' x ');
}?>
						<a class="product-name" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['link'],'html','UTF-8' ));?>
" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' ));?>
" itemprop="url" >
							<span class="product_name"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],45,'...' )),'html','UTF-8' ));?>
</span>
						</a>
                        <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['attributes'])) && $_smarty_tpl->tpl_vars['product']->value['attributes']) {?>
							<?php $_smarty_tpl->_assignInScope('ik2', 0);?>
							<span class="product_combination"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attributes'], 'attribute');
$_smarty_tpl->tpl_vars['attribute']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->value) {
$_smarty_tpl->tpl_vars['attribute']->do_else = false;
$_smarty_tpl->_assignInScope('ik2', $_smarty_tpl->tpl_vars['ik2']->value+1);
if ((isset($_smarty_tpl->tpl_vars['attribute']->value['group_name']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['attribute']->value['group_name'],80,'...',true )),'html','UTF-8' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['attribute']->value['group'],80,'...',true )),'html','UTF-8' ));
}?>-<?php if ((isset($_smarty_tpl->tpl_vars['attribute']->value['attribute_name']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['attribute']->value['attribute_name'],80,'...',true )),'html','UTF-8' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['attribute']->value['name'],80,'...',true )),'html','UTF-8' ));
}
if ($_smarty_tpl->tpl_vars['ik2']->value < count($_smarty_tpl->tpl_vars['product']->value['attributes'])) {?>, <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></span>
						<?php }?>
					</h5>   
                    <?php if ($_smarty_tpl->tpl_vars['block']->value['show_description']) {?>
                        <p class="product-desc" itemprop="description">
    						<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['description_short'])) && $_smarty_tpl->tpl_vars['product']->value['description_short']) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['description_short']),'html','UTF-8' )),60,'...' ));
}?>
    					</p> 
                    <?php }?>    
                    <?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && (((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])) && $_smarty_tpl->tpl_vars['product']->value['show_price']) || ((isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])) && $_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
						<div class="content_price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
							<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])) && $_smarty_tpl->tpl_vars['product']->value['show_price'] && !(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value))) {?>
								<span itemprop="price" class="price product-price">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>

									<?php if ((isset($_smarty_tpl->tpl_vars['priceDisplay']->value)) && !$_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl ) );
}?>
								</span>									
								<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['price_without_reduction'])) && $_smarty_tpl->tpl_vars['product']->value['price_without_reduction'] > 0 && (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices'])) && $_smarty_tpl->tpl_vars['product']->value['specific_prices'] && (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])) && $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'] > 0) {?>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>

									<span class="old-price product-price">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl ) );?>

									</span>
									<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type'] == 'percentage') {?>
										<span class="price-percent-reduction">-<?php echo floatval(($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*100));?>
%</span>
									<?php }?>
								<?php }?>								
							<?php }?>
						</div>
					<?php }?> 
                    <?php if ($_smarty_tpl->tpl_vars['block']->value['show_clock'] && (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices_to']))) {?>
                        <div class="panel-discount-countdown" data-countdown="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['specific_prices_to'],'html','UTF-8' ));?>
"></div>
                    <?php }?>           
				</div>				
			</div><!-- .product-container> -->
		</li>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php } else { ?>
	<span class="rb_alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No product available','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>
<?php }
}
}
