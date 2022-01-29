<?php
/* Smarty version 3.1.39, created on 2022-01-28 06:05:54
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f379b28abac1_16392311',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ea966a076baf8870d4ff7458d422e271ce22c0f' => 
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
function content_61f379b28abac1_16392311 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('theme_dir', _PS_THEME_DIR_);?>

<section id="products" class="rb-products rb-products-list <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'sly') {?>scroll-list<?php }?>">
    <?php if ((isset($_smarty_tpl->tpl_vars['products']->value['title'])) && $_smarty_tpl->tpl_vars['products']->value['title'] != '') {?>
        <h4 class="title_block"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['title'], ENT_QUOTES, 'UTF-8');?>
</h4>
    <?php }?>

    <?php if ((isset($_smarty_tpl->tpl_vars['products']->value['sub_title'])) && $_smarty_tpl->tpl_vars['products']->value['sub_title'] != '') {?>
        <p class="sub_title_block"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['sub_title'], ENT_QUOTES, 'UTF-8');?>
</p>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'carousel') {?>
        <div
            class="products rb-products-carousel slick-products-carousel products-grid slick-arrows-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['arrows_position'], ENT_QUOTES, 'UTF-8');?>
"  data-slider_options='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['products']->value['options'] ));?>
'
        >
    <?php } elseif ($_smarty_tpl->tpl_vars['products']->value['view'] == 'sly') {?>
        <div
            class="products rb-products-sly products-sly"
            data-desktop="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['sly_to_show'], ENT_QUOTES, 'UTF-8');?>
"
            data-tablet="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['sly_to_show_tablet'], ENT_QUOTES, 'UTF-8');?>
"
            data-mobile="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['sly_to_show_mobile'], ENT_QUOTES, 'UTF-8');?>
"
            data-options_sly="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['options_sly'], ENT_QUOTES, 'UTF-8');?>
"
        >
            <div class="product-content products-list products-list-sly grid">    
    <?php } else { ?>
        <div class="products row <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'list') {?>products-list<?php } else { ?>products-grid<?php }?>">
    <?php }?>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
        <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'list') {?>
            <div class="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['use_animation'])) && $_smarty_tpl->tpl_vars['products']->value['use_animation'] == 1) {?>rb-animation<?php }?>">
               <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['products']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['products']->value['row'],'rb_list'=>$_smarty_tpl->tpl_vars['products']->value['product_list']), 0, true);
?>
            </div>
        <?php } elseif ($_smarty_tpl->tpl_vars['products']->value['view'] == 'sly') {?>
            <?php $_smarty_tpl->_assignInScope('product_list_sly', $_smarty_tpl->tpl_vars['products']->value['product_list_sly']);?>

            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-sly/product-sly-".((string)$_smarty_tpl->tpl_vars['product_list_sly']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['products']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['products']->value['row']), 0, true);
?>
        <?php } else { ?>
            <?php if ((isset($_smarty_tpl->tpl_vars['products']->value['product_list_carousel'])) && $_smarty_tpl->tpl_vars['products']->value['product_list_carousel'] != '') {?>
                <?php $_smarty_tpl->_assignInScope('product_list_carousel', $_smarty_tpl->tpl_vars['products']->value['product_list_carousel']);?>

                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-slick/product-slick-".((string)$_smarty_tpl->tpl_vars['product_list_carousel']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['products']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['products']->value['row']), 0, true);
?>
            <?php } else { ?>
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['theme_dir']->value)."/templates/catalog/_partials/miniatures/product-slick.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'config'=>$_smarty_tpl->tpl_vars['products']->value['products_col'],'row'=>$_smarty_tpl->tpl_vars['products']->value['row']), 0, true);
?>
            <?php }?>
        <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'sly') {?>
        </div>
    <?php }?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['products']->value['view'] == 'sly') {?>
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

    <?php if ((isset($_smarty_tpl->tpl_vars['products']->value['load_more'])) && $_smarty_tpl->tpl_vars['products']->value['load_more'] == 1 && $_smarty_tpl->tpl_vars['products']->value['view'] == 'list' && (isset($_smarty_tpl->tpl_vars['products']->value['show_more_button'])) && $_smarty_tpl->tpl_vars['products']->value['show_more_button'] == 1) {?>
        <div class="rb-show-more">
            <a
                class="btn"
                href="javascript:void(0)"
                title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
"
                data-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url_ajax']->value, ENT_QUOTES, 'UTF-8');?>
"
                data-token="<?php echo htmlspecialchars(Tools::getToken(false), ENT_QUOTES, 'UTF-8');?>
"
                data-list="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['product_list'], ENT_QUOTES, 'UTF-8');?>
"
                data-col="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['products_col'], ENT_QUOTES, 'UTF-8');?>
"
                data-row="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['row'], ENT_QUOTES, 'UTF-8');?>
"
                data-page="2"
                data-animation="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['use_animation'])) && $_smarty_tpl->tpl_vars['products']->value['use_animation'] == 1) {?>1<?php } else { ?>0<?php }?>"
                data-source="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['source'])) && $_smarty_tpl->tpl_vars['products']->value['source'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['source'], ENT_QUOTES, 'UTF-8');
}?>"
                data-orderBy="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['orderBy'])) && $_smarty_tpl->tpl_vars['products']->value['orderBy'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['orderBy'], ENT_QUOTES, 'UTF-8');
}?>"
                data-orderWay="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['order_way'])) && $_smarty_tpl->tpl_vars['products']->value['order_way'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['order_way'], ENT_QUOTES, 'UTF-8');
}?>"
                data-brand_list="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['brand_list'])) && $_smarty_tpl->tpl_vars['products']->value['brand_list'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['brand_list'], ENT_QUOTES, 'UTF-8');
}?>"
                data-limit="<?php if ((isset($_smarty_tpl->tpl_vars['products']->value['limit'])) && $_smarty_tpl->tpl_vars['products']->value['limit'] != '') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['products']->value['limit'], ENT_QUOTES, 'UTF-8');
} else { ?>10<?php }?>"
            >
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>

        </a>
        
        </div>
    <?php }?>
</section><?php }
}
