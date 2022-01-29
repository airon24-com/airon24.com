<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d461951062_74032686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad710d9e7c0a26291edfad8fae332a804c9b829f' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/item-menu.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d461951062_74032686 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
    <li class="rb_menus_li item<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
 <?php if (!$_smarty_tpl->tpl_vars['menu']->value['enabled']) {?>rb_disabled<?php }?>" data-id-menu="<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
" data-obj="menu">
<?php }?>                        
    <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>
        <div class="rb_menus_li_content" style="width: <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_item_width']) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_item_width'],'html','UTF-8' ));
} else { ?>230px<?php }?>">
            <span class="rb_menu_name rb_menu_toggle">
                <span class="rb_menu_content_title">
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_img_link']) {?>
                        <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_img_link'],'html','UTF-8' ));?>
" title="" alt="" width="20" />
                    <?php } elseif ($_smarty_tpl->tpl_vars['menu']->value['menu_icon']) {?>
                        <i class="fa <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_icon'],'html','UTF-8' ));?>
"></i>
                    <?php }?>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'html','UTF-8' ));?>

                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_text']) {?><span class="rb_bubble_text" style="background: <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_background_color']) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_background_color'],'html','UTF-8' ));
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'],'html','UTF-8' ))) {
echo $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'];
} else { ?>#ffffff<?php }?>;"><?php echo $_smarty_tpl->tpl_vars['menu']->value['bubble_text'];?>
</span><?php }?>
                </span>
            </span>
            <div class="rb_buttons button_add_tab">
                <span class="rb_menu_delete" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>  
                <span class="rb_duplicate" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>                      
                <span class="rb_menu_edit" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>                
                <span class="rb_menu_toggle rb_menu_toggle_arrow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span> 
                <div class="rb_add_tab btn btn-default" data-id-menu="<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add tab','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add tab','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div> 
            </div> 
        </div>
        
        <div class="rb_tabs_ul">
            <ul class="rb_tabs_ul_content">
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabs']) {?>                            
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['tabs'], 'tab');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
                        <li data-id-tab="<?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>
" class="rb_tabs_li item<?php echo intval($_smarty_tpl->tpl_vars['tab']->value['id_tab']);?>
 <?php if (!$_smarty_tpl->tpl_vars['tab']->value['enabled']) {?>rb_disabled<?php }?>" data-obj="tab">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbItemTab','tab'=>$_smarty_tpl->tpl_vars['tab']->value),$_smarty_tpl ) );?>

                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                            
                <?php }?>
            </ul>
        </div>
    <?php } else { ?>
        <div class="rb_menus_li_content">
            <span class="rb_menu_name rb_menu_toggle">
                <span class="rb_menu_content_title">
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_img_link']) {?>
                        <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_img_link'],'html','UTF-8' ));?>
" title="" alt="" width="20" />
                    <?php } elseif ($_smarty_tpl->tpl_vars['menu']->value['menu_icon']) {?>
                        <i class="fa <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_icon'],'html','UTF-8' ));?>
"></i>
                    <?php }?>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'html','UTF-8' ));?>

                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_text']) {?><span class="rb_bubble_text" style="background: <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_background_color']) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_background_color'],'html','UTF-8' ));
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'],'html','UTF-8' ))) {
echo $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'];
} else { ?>#ffffff<?php }?>;"><?php echo $_smarty_tpl->tpl_vars['menu']->value['bubble_text'];?>
</span><?php }?>
                </span>
            </span>
            <div class="rb_buttons">
                <span class="rb_menu_delete" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>  
                <span class="rb_duplicate" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>                      
                <span class="rb_menu_edit" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span>                
                <span class="rb_menu_toggle rb_menu_toggle_arrow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</span> 
                <div class="rb_add_column btn btn-default" data-id-menu="<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div> 
            </div> 
        </div>
        <ul class="rb_columns_ul">
            <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?>                            
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['columns'], 'column');
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
?>
                    <li data-id-column="<?php echo intval($_smarty_tpl->tpl_vars['column']->value['id_column']);?>
" class="rb_columns_li item<?php echo intval($_smarty_tpl->tpl_vars['column']->value['id_column']);?>
 column_size_<?php echo intval($_smarty_tpl->tpl_vars['column']->value['column_size']);?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>rb_breaker<?php }?>" data-obj="column">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbItemColumn','column'=>$_smarty_tpl->tpl_vars['column']->value),$_smarty_tpl ) );?>

                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                            
            <?php }?>  
        </ul> 
    <?php }?> 
<?php if ($_smarty_tpl->tpl_vars['have_li']->value) {?>
</li>
<?php }
}
}
