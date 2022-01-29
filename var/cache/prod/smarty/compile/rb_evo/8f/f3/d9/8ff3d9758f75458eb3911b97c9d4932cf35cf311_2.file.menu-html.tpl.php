<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/menu-html.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f009836b7011_96483399',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ff3d9758f75458eb3911b97c9d4932cf35cf311' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/menu-html.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f009836b7011_96483399 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['menus']->value)) && $_smarty_tpl->tpl_vars['menus']->value) {?>
    <ul class="rb_menus_ul <?php if ((isset($_smarty_tpl->tpl_vars['rb_config']->value['RBTHEMEMENU_CLICK_TEXT_SHOW_SUB'])) && $_smarty_tpl->tpl_vars['rb_config']->value['RBTHEMEMENU_CLICK_TEXT_SHOW_SUB']) {?> clicktext_show_submenu<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['rb_config']->value['RBTHEMEMENU_SHOW_ICON_VERTICAL'])) && !$_smarty_tpl->tpl_vars['rb_config']->value['RBTHEMEMENU_SHOW_ICON_VERTICAL']) {?> hide_icon_vertical<?php }?>" >
        <li class="close_menu">
            <div class="pull-left">
                <span class="rb_menus_back">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

            </div>
            <div class="pull-right">
                <span class="rb_menus_back_icon"></span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

            </div>
        </li>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
            <li  class="rb_menus_li<?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?> rb_menus_li_tab<?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_hidden_border']) {?> rb_no_border<?php }
if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?> menu_ver_alway_show_sub<?php }
}
if ($_smarty_tpl->tpl_vars['menu']->value['custom_class']) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['custom_class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['menu']->value['sub_menu_type']) {?> rb_sub_align_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['menu']->value['sub_menu_type']),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?> rb_has_sub<?php }
if ($_smarty_tpl->tpl_vars['menu']->value['display_tabs_in_full_width'] && $_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?> display_tabs_in_full_width<?php }?>" <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>style="width: <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>"<?php }?>>
               <a <?php if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_open_new_tab'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_open_new_tab'] == 1) {?> target="_blank"<?php }?> href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="<?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {
if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color']) {?>color:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value['menu_ver_text_color'], ENT_QUOTES, 'UTF-8');?>
;<?php }
if ((isset($_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color'])) && $_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color']) {?>background-color:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value['menu_ver_background_color'], ENT_QUOTES, 'UTF-8');?>
;<?php }
}
if (Configuration::get('RBTHEMEMENU_HEADING_FONT_SIZE')) {?>font-size:<?php echo htmlspecialchars(intval(Configuration::get('RBTHEMEMENU_HEADING_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }?>">
                    <span class="rb_menu_content_title">
                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_img_link']) {?>
                            <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_img_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="" alt="" width="20" />
                        <?php } elseif ($_smarty_tpl->tpl_vars['menu']->value['menu_icon']) {?>
                            <i class="fa <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['menu_icon'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></i>
                        <?php }?>
                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?><span class="rb_arrow"></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_text']) {?><span class="rb_bubble_text" style="background: <?php if ($_smarty_tpl->tpl_vars['menu']->value['bubble_background_color']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_background_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'],'html','UTF-8' ))) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value['bubble_text_color'], ENT_QUOTES, 'UTF-8');
} else { ?>#ffffff<?php }?>;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value['bubble_text'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                    </span>
                </a>
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabs']) {?>
                        <span class="arrow closed"></span>
                    <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['menu']->value['enabled_vertical']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['tabs']) {?>
                        <ul class="rb_columns_ul rb_columns_ul_tab <?php if ($_smarty_tpl->tpl_vars['menu']->value['menu_ver_alway_show']) {?> rb_columns_ul_tab_content<?php }?>" style="width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['sub_menu_max_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php if (Configuration::get('RBTHEMEMENU_TEXT_FONT_SIZE')) {?> font-size:<?php echo htmlspecialchars(intval(Configuration::get('RBTHEMEMENU_TEXT_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }?>">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['tabs'], 'tab', false, 'key');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
                                <li class="rb_tabs_li<?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?> <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>open <?php }?>rb_tabs_has_content<?php }
if (!$_smarty_tpl->tpl_vars['tab']->value['tab_sub_content_pos']) {?> rb_tab_content_hoz<?php }?>">
                                    <div class="rb_tab_li_content closed" style="width: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>">
                                        <span class="rb_tab_name rb_tab_toggle<?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?> rb_tab_has_child<?php }?>">
                                            <span class="rb_tab_toggle_title">
                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['url']) {?>
                                                    <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['tab_img_link']) {?>
                                                    <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_img_link'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="" alt="" width="20" />
                                                <?php } elseif ($_smarty_tpl->tpl_vars['tab']->value['tab_icon']) {?>
                                                    <i class="fa <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_icon'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"></i>
                                                <?php }?>
                                                <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['bubble_text']) {?><span class="rb_bubble_text" style="background: <?php if ($_smarty_tpl->tpl_vars['tab']->value['bubble_background_color']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_background_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#FC4444<?php }?>; color: <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['bubble_text_color'],'html','UTF-8' ))) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['bubble_text_color'], ENT_QUOTES, 'UTF-8');
} else { ?>#ffffff<?php }?>;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['bubble_text'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['tab']->value['url']) {?>
                                                    </a>
                                                <?php }?>
                                            </span>
                                        </span>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['tab']->value['columns']) {?>
                                        <ul class="rb_columns_contents_ul " style="<?php if ($_smarty_tpl->tpl_vars['tab']->value['tab_sub_width']) {?>width: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['tab_sub_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php } else {
if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {?> width:calc(100% - <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?> + 2px);<?php }?> left: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>;right: <?php if ($_smarty_tpl->tpl_vars['menu']->value['tab_item_width']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['tab_item_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>230px<?php }?>;<?php if ($_smarty_tpl->tpl_vars['tab']->value['background_image']) {?> background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['background_image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tab']->value['position_background'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab']->value['columns'], 'column');
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
?>
                                                <li class="rb_columns_li column_size_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['column']->value['column_size']), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>rb_breaker<?php }?> <?php if ($_smarty_tpl->tpl_vars['column']->value['blocks']) {?>rb_has_sub<?php }?>">
                                                    <?php if ((isset($_smarty_tpl->tpl_vars['column']->value['blocks'])) && $_smarty_tpl->tpl_vars['column']->value['blocks']) {?>
                                                        <ul class="rb_blocks_ul">
                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value['blocks'], 'block');
$_smarty_tpl->tpl_vars['block']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->do_else = false;
?>
                                                                <li data-id-block="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['block']->value['id_block']), ENT_QUOTES, 'UTF-8');?>
" class="rb_blocks_li">
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

                                                                </li>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </ul>
                                                    <?php }?>
                                                </li>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </ul>
                                    <?php }?>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                        </ul>
                    <?php }?>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?><span class="arrow closed"></span><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['columns']) {?>
                            <ul class="rb_columns_ul" style=" width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['sub_menu_max_width'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php if (Configuration::get('RBTHEMEMENU_TEXT_FONT_SIZE')) {?> font-size:<?php echo htmlspecialchars(intval(Configuration::get('RBTHEMEMENU_TEXT_FONT_SIZE')), ENT_QUOTES, 'UTF-8');?>
px;<?php }
if (!$_smarty_tpl->tpl_vars['menu']->value['enabled_vertical'] && $_smarty_tpl->tpl_vars['menu']->value['background_image']) {?> background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['background_image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['position_background'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['columns'], 'column');
$_smarty_tpl->tpl_vars['column']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['column']->value) {
$_smarty_tpl->tpl_vars['column']->do_else = false;
?>
                                    <li class="rb_columns_li column_size_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['column']->value['column_size']), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['column']->value['is_breaker']) {?>rb_breaker<?php }?> <?php if ($_smarty_tpl->tpl_vars['column']->value['blocks']) {?>rb_has_sub<?php }?>">
                                        <?php if ((isset($_smarty_tpl->tpl_vars['column']->value['blocks'])) && $_smarty_tpl->tpl_vars['column']->value['blocks']) {?>
                                            <ul class="rb_blocks_ul">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value['blocks'], 'block');
$_smarty_tpl->tpl_vars['block']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->do_else = false;
?>
                                                    <li data-id-block="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['block']->value['id_block']), ENT_QUOTES, 'UTF-8');?>
" class="rb_blocks_li">
                                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBlock','block'=>$_smarty_tpl->tpl_vars['block']->value),$_smarty_tpl ) );?>

                                                    </li>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </ul>
                                        <?php }?>
                                    </li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                    <?php }?>
                <?php }?>     
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomMenu','home'=>'1'),$_smarty_tpl ) );?>

<?php }
}
}
