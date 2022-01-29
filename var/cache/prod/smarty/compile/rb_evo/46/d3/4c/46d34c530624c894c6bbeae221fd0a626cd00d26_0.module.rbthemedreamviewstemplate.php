<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f172468719b6_55373899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46d34c530624c894c6bbeae221fd0a626cd00d26' => 
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
function content_61f172468719b6_55373899 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>

<?php if ((isset($_smarty_tpl->tpl_vars['rb_ajax']->value)) && $_smarty_tpl->tpl_vars['rb_ajax']->value == 1) {?>
    <?php if (!empty($_smarty_tpl->tpl_vars['products']->value)) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="<?php if ((isset($_smarty_tpl->tpl_vars['use_animation']->value)) && $_smarty_tpl->tpl_vars['use_animation']->value == 1) {?>rb-animation<?php }?>">
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page'=>$_smarty_tpl->tpl_vars['page']->value,'rb_list'=>$_smarty_tpl->tpl_vars['product_list']->value,'product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['products_col']->value,'row'=>$_smarty_tpl->tpl_vars['row']->value), 0, true);
?>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }
} else { ?>
    <?php if ((isset($_smarty_tpl->tpl_vars['tabs']->value['tabs']))) {?>
        <div class="tabs rb-products-tabs">
            <ul class="nav nav-tabs">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tabs']->value['tabs'], 'tab', false, NULL, 'productTabs', array (
  'first' => true,
  'iteration' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['index'];
?>
                    <li class="nav-item">
                        <a
                            class="nav-link<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first'] : null)) {?> active<?php }?>"
                            data-toggle="tab"
                            href="#ie-<?php echo $_smarty_tpl->tpl_vars['tab']->value['uid'];?>
-ptab-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration'] : null);?>
"
                        >
                            <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['select_type_icon']))) {?>
                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['select_type_icon'] == 'icon') {?>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['type_icon'])) && $_smarty_tpl->tpl_vars['tab']->value['type_icon'] != '') {?>
                                        <i class="<?php echo $_smarty_tpl->tpl_vars['tab']->value['type_icon'];?>
"></i>
                                    <?php }?>
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['select_type_icon'] == 'image') {?>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['type_image'])) && $_smarty_tpl->tpl_vars['tab']->value['type_image'] != '') {?>
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['tab']->value['type_image'];?>
" >
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                            
                            <?php echo $_smarty_tpl->tpl_vars['tab']->value['title'];?>

                        </a>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>

            <div id="products" class="tab-content">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tabs']->value['tabs'], 'tab', false, NULL, 'productTabs', array (
  'first' => true,
  'iteration' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['index'];
?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'sly') {?>scroll-list<?php }?> rb-products-list tab-pane <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['first'] : null)) {?> active<?php }?>" id="ie-<?php echo $_smarty_tpl->tpl_vars['tab']->value['uid'];?>
-ptab-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_productTabs']->value['iteration'] : null);?>
">
                        <?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'carousel') {?>
                            <div class="products rb-products-carousel slick-products-carousel products-grid slick-arrows-<?php echo $_smarty_tpl->tpl_vars['tab']->value['arrows_position'];?>
"  data-slider_options='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['options'] ));?>
'>
                        <?php } elseif ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'sly') {?>
                            <div
                                class="products rb-products-sly products-sly"
                                data-desktop="<?php echo $_smarty_tpl->tpl_vars['tab']->value['sly_to_show'];?>
"
                                data-tablet="<?php echo $_smarty_tpl->tpl_vars['tab']->value['sly_to_show_tablet'];?>
"
                                data-mobile="<?php echo $_smarty_tpl->tpl_vars['tab']->value['sly_to_show_mobile'];?>
"
                                data-options_sly="<?php echo $_smarty_tpl->tpl_vars['tab']->value['options_sly'];?>
"
                            >
                                <div class="product-content products-list products-list-sly grid">        
                        <?php } else { ?>
                            <div class="products row <?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'list') {?>products-list<?php } else { ?>products-grid <?php }?>">
                        <?php }?>
                                <?php if (!empty($_smarty_tpl->tpl_vars['tab']->value['products'])) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'list') {?>
                                            <div class="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['use_animation'])) && $_smarty_tpl->tpl_vars['tab']->value['use_animation'] == 1) {?>rb-animation<?php }?>">
                                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('rb_list'=>$_smarty_tpl->tpl_vars['tab']->value['product_list'],'product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['tab']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['tab']->value['row']), 0, true);
?>
                                            </div>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'sly') {?>
                                            <?php $_smarty_tpl->_assignInScope('product_list_sly', $_smarty_tpl->tpl_vars['tab']->value['product_list_sly']);?>

                                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-sly/product-sly-".((string)$_smarty_tpl->tpl_vars['product_list_sly']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['tab']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['tab']->value['row']), 0, true);
?>    
                                        <?php } else { ?>
                                            <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['product_list_carousel'])) && $_smarty_tpl->tpl_vars['tab']->value['product_list_carousel'] != '') {?>
                                                <?php $_smarty_tpl->_assignInScope('product_list_carousel', $_smarty_tpl->tpl_vars['tab']->value['product_list_carousel']);?>

                                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-slick/product-slick-".((string)$_smarty_tpl->tpl_vars['product_list_carousel']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['tab']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['tab']->value['row']), 0, true);
?>
                                            <?php } else { ?>
                                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-slick.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['tab']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['tab']->value['row']), 0, true);
?>
                                            <?php }?>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'sly') {?>
                                </div>
                                <?php }?>
                            </div>

                            <?php if ($_smarty_tpl->tpl_vars['tab']->value['view'] == 'sly') {?>
                                <div class="scrollbar">
                                    <div class="handle">
                                        <div class="mousearea">
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Scroll Me','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

                                            <span class="material-icons">arrow_forward</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="controls">
                                    <button class="btn prev">
                                        <span class="material-icons">keyboard_arrow_left</span>
                                    </button>

                                    <button class="btn next">
                                        <span class="material-icons">keyboard_arrow_right</span>
                                    </button>
                                </div>
                            <?php }?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['load_more'])) && $_smarty_tpl->tpl_vars['tab']->value['load_more'] == 1 && $_smarty_tpl->tpl_vars['tab']->value['view'] == 'list' && (isset($_smarty_tpl->tpl_vars['tab']->value['show_more_button'])) && $_smarty_tpl->tpl_vars['tab']->value['show_more_button'] == 1) {?>
                                <div class="rb-show-more">
                                    <a
                                        class="btn"
                                        href="javascript:void(0)"
                                        title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
                                        data-url="<?php echo $_smarty_tpl->tpl_vars['url_ajax']->value;?>
"
                                        data-token="<?php echo Tools::getToken(false);?>
"
                                        data-list="<?php echo $_smarty_tpl->tpl_vars['tab']->value['product_list'];?>
"
                                        data-col="<?php echo $_smarty_tpl->tpl_vars['tab']->value['products_col'];?>
"
                                        data-row="<?php echo $_smarty_tpl->tpl_vars['tab']->value['row'];?>
"
                                        data-page="2"
                                        data-animation="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['use_animation'])) && $_smarty_tpl->tpl_vars['tab']->value['use_animation'] == 1) {?>1<?php } else { ?>0<?php }?>"
                                        data-source="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['source'])) && $_smarty_tpl->tpl_vars['tab']->value['source'] != '') {
echo $_smarty_tpl->tpl_vars['tab']->value['source'];
}?>"
                                        data-orderBy="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['orderBy'])) && $_smarty_tpl->tpl_vars['tab']->value['orderBy'] != '') {
echo $_smarty_tpl->tpl_vars['tab']->value['orderBy'];
}?>"
                                        data-orderWay="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['order_way'])) && $_smarty_tpl->tpl_vars['tab']->value['order_way'] != '') {
echo $_smarty_tpl->tpl_vars['tab']->value['order_way'];
}?>"
                                        data-brand_list="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['brand_list'])) && $_smarty_tpl->tpl_vars['tab']->value['brand_list'] != '') {
echo $_smarty_tpl->tpl_vars['tab']->value['brand_list'];
}?>"
                                        data-limit="<?php if ((isset($_smarty_tpl->tpl_vars['tab']->value['limit'])) && $_smarty_tpl->tpl_vars['tab']->value['limit'] != '') {
echo $_smarty_tpl->tpl_vars['tab']->value['limit'];
} else { ?>10<?php }?>"
                                    >
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

                                    </a>
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
}
