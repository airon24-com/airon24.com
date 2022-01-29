<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:42
  from 'module:rbthemedreamviewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17246934452_46887889',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bc8f1b3b65ef87922345ca426935fd3af1c29b6' => 
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
function content_61f17246934452_46887889 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/daeovmkhla/domains/greenwat.eu/public_html/shop/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['blog_title']->value)) && $_smarty_tpl->tpl_vars['blog_title']->value != '') {?>
    <h4 class="title_block"><?php echo $_smarty_tpl->tpl_vars['blog_title']->value;?>
</h4>
<?php }?>

<?php if ((isset($_smarty_tpl->tpl_vars['blog_sub_title']->value)) && $_smarty_tpl->tpl_vars['blog_sub_title']->value != '') {?>
    <p class="sub_title_block"><?php echo $_smarty_tpl->tpl_vars['blog_sub_title']->value;?>
</p>
<?php }?>

<?php if ((isset($_smarty_tpl->tpl_vars['posts']->value)) && count($_smarty_tpl->tpl_vars['posts']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['view']->value == 'carousel') {?>
        <section class="rb-blog-posts rb-blog-posts-carousel rb-slick-slider rbthemeblog">
            <div class="rb-blog-carousel simpleblog-posts <?php echo $_smarty_tpl->tpl_vars['classes']->value;?>
" data-slider_options='<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['options']->value ));?>
'>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
                    <div class="simpleblog-posts-column">
                        <div class="blog-content">
                            <?php if ((isset($_smarty_tpl->tpl_vars['post']->value['banner_thumb']))) {?>
                                <div class="rb-left-block">
                                    <div class="rb-blog-image-container">
                                        <a class="rb-blog-img-link" href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" itemprop="url">
                                            <img class="img-fluid slick-loading" data-lazy="<?php echo $_smarty_tpl->tpl_vars['post']->value['banner_thumb'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" itemprop="image">
                                            <div class="rb-image-loading"></div>
                                        </a>
                                    </div>
                                </div>
                            <?php }?>

                            <div class="right-block">
                                <div class="rb-blog-meta">
                                    <h5 class="rb-blog-title" itemprop="name">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
                                    </h5>

                                    <div class="rb-date-block">
                                        <i class="material-icons">date_range</i>

                                        <span class="cate">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['category_rewrite'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['category'];?>
">#<?php echo $_smarty_tpl->tpl_vars['post']->value['category'];?>
,</a>       
                                        </span>

                                        <span class="month">
                                            <?php $_smarty_tpl->_assignInScope('blog_month', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%b"));?>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_month']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>

                                        </span>

                                        <span class="day">
                                            <?php $_smarty_tpl->_assignInScope('blog_day', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%e"));?>    
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_day']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>
,           
                                        </span>

                                        <span class="year">
                                            <?php $_smarty_tpl->_assignInScope('blog_year', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%Y"));?>       
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_year']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>

                                        </span>
                                    </div>

                                    <div class="rb-blog-desc" itemprop="description">
                                        <?php echo $_smarty_tpl->tpl_vars['post']->value['short_content'];?>

                                    </div>

                                    <div class="rb-more">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" class="post-btn-more"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </section>
    <?php } else { ?>
        <section class="rb-blog-posts rb-blog-posts-grid rbthemeblog">
            <div class="row simpleblog-posts">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
                    <div class="simpleblog-posts-column <?php echo $_smarty_tpl->tpl_vars['options']->value['gridClasses'];?>
">
                        <div class="simpleblog-posts-column">
                            <div class="blog-content">
                                <?php if ((isset($_smarty_tpl->tpl_vars['post']->value['banner_thumb']))) {?>
                                    <div class="rb-left-block">
                                        <div class="rb-blog-image-container">
                                            <a class="rb-blog-img-link" href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" itemprop="url">
                                                <img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['post']->value['banner_thumb'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" itemprop="image">
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>

                                <div class="right-block">
                                    <div class="rb-blog-meta">
                                        <h5 class="rb-blog-title" itemprop="name">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
                                        </h5>

                                        <div class="rb-blog-desc" itemprop="description">
                                            <?php echo $_smarty_tpl->tpl_vars['post']->value['short_content'];?>

                                        </div>


                                        <div class="rb-date-block">
                                            <i class="material-icons">date_range</i>

                                            <span class="cate">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['category_rewrite'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['category'];?>
">#<?php echo $_smarty_tpl->tpl_vars['post']->value['category'];?>
,</a>       
                                            </span>

                                            <span class="month">
                                                <?php $_smarty_tpl->_assignInScope('blog_month', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%b"));?>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_month']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>

                                            </span>

                                            <span class="day">
                                                <?php $_smarty_tpl->_assignInScope('blog_day', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%e"));?>    
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_day']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>
           
                                            </span>

                                            <span class="year">
                                                <?php $_smarty_tpl->_assignInScope('blog_year', smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['post']->value['date_add']),"%Y"));?>       
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['blog_year']->value,'mod'=>'rbthemeblog'),$_smarty_tpl ) );?>

                                            </span>
                                        </div>

                                        <div class="rb-more">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" class="post-btn-more"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read More','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </section>
    <?php }?>
    <div>
        <div class="blog-viewall">
            <a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['rb_list_blog']->value;?>
" title="View All"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View All','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</a>
        </div>
    </div>
<?php }
}
}
