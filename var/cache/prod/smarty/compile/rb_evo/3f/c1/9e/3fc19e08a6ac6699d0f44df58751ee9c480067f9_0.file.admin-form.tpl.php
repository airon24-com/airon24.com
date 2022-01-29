<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/admin-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d461929b86_62636156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fc19e08a6ac6699d0f44df58751ee9c480067f9' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/hook/admin-form.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d461929b86_62636156 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    var rb_img_dir ="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rb_img_dir']->value,'quotes','UTF-8' ));?>
";
    var rbBaseAdminUrl = "<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rbBaseAdminUrl']->value,'quotes','UTF-8' ));?>
";
    var rbCloseTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbOpenTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Open','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDeleteTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbEditTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDeleteTitleTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete this item','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbAddMenuTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbEditMenuTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbAddColumnTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbEditColumnTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDeleteColumnTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete this column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDeleteBlockTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete this block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbEditBlockTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit this block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbAddBlockTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDuplicateTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDuplicateMenuTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate this menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDuplicateColumnTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate this column','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbDuplicateBlockTxt = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duplicate this block','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rb_invalid_file = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Image is invalid','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
    var rbLabelDelete = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>

<div class="rb_megamenu rb_view_mode_tab <?php if ($_smarty_tpl->tpl_vars['rb_backend_layout']->value == 'rtl') {?>rb-dir-rtl backend-layout-rtl<?php } else { ?>rb-dir-ltr backend-layout-ltr<?php }?> <?php if ($_smarty_tpl->tpl_vars['multiLayout']->value) {?>rb_multi_layout<?php } else { ?>rb_single_layout<?php }?>">
    <div class="rb_menus">
        <?php if ($_smarty_tpl->tpl_vars['menus']->value) {?>
            <ul class="rb_menus_ul">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
                    <li class="rb_menus_li item<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
 <?php if (!$_smarty_tpl->tpl_vars['menu']->value['enabled']) {?>rb_disabled<?php }?>" data-id-menu="<?php echo intval($_smarty_tpl->tpl_vars['menu']->value['id_menu']);?>
" data-obj="menu">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbItemMenu','menu'=>$_smarty_tpl->tpl_vars['menu']->value),$_smarty_tpl ) );?>

                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        <?php }?>        
        <div class="rb_useful_buttons">
            <div class="rb_add_menu btn btn-default"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
            <?php if ($_smarty_tpl->tpl_vars['multiLayout']->value) {?>
                <div class="rb_layout_mode">                
                    <div data-title="&#xE236;" class="rb_layout_ltr rb_change_mode <?php if ($_smarty_tpl->tpl_vars['rb_backend_layout']->value != 'rtl') {?>active<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'LTR','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
                    <div data-title="&#xE237;" class="rb_layout_rlt rb_change_mode <?php if ($_smarty_tpl->tpl_vars['rb_backend_layout']->value == 'rtl') {?>active<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'RTL','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
                </div>
            <?php }?>
            <div class="rb_config_button btn btn-default" data-title="&#xE8B8;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
        </div>
    </div>
    <div class="rb_loading_icon"><img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rb_img_dir']->value,'html','UTF-8' ));?>
ajax-loader.gif" /></div>
    <!-- popup forms -->
    <div class="rb_forms hidden rb_popup_overlay">
        <div class="rb_menu_form hidden rb_pop_up">
            <div class="rb_close"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
            <div class="rb_form"></div>
        </div>
        <div class="rb_menu_form_new hidden"><?php echo $_smarty_tpl->tpl_vars['menuForm']->value;?>
</div>
        <div class="rb_tab_form_new hidden"><?php echo $_smarty_tpl->tpl_vars['tabForm']->value;?>
</div>
        <div class="rb_column_form_new hidden"><?php echo $_smarty_tpl->tpl_vars['columnForm']->value;?>
</div>
        <div class="rb_block_form_new hidden"><?php echo $_smarty_tpl->tpl_vars['blockForm']->value;?>
</div>
        <div class="rb_icon_form_new hidden"><?php echo $_smarty_tpl->tpl_vars['iconForm']->value;?>
</div>
    </div>
    <div class="rb_popup_overlay hidden">
        <div class="rb_config_form rb_pop_up">
            <div class="rb_close" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
            <div class="rb_config_form_content"><div class="rb_close"></div><?php echo $_smarty_tpl->tpl_vars['configForm']->value;?>
</div>
        </div>
    </div>
    <div class="rb_export_form hidden rb_popup_overlay">
        <div class="rb_close"></div>
        <div class="rb_export rb_pop_up hidden">
            <div data-title="&#xE14C;" class="rb_close"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
            <div class="rb_export_form_content">            
                <div class="rb_export_option">
                    <div class="export_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Export menu content','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
                    <a class="btn btn-default rb_export_menu" href="<?php echo $_smarty_tpl->tpl_vars['rbBaseAdminUrl']->value;?>
&exportMenu=1" target="_blank">
                        <i class="fa fa-download" data-title="&#xE864;"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Export menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

                    </a>
                    <p class="rb_export_option_note"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Export all menu data including images, text and configuration','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</p>
                </div>                       
                <div class="rb_import_option">
                    <div class="export_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Import menu data','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
                    <form action="<?php echo $_smarty_tpl->tpl_vars['rbBaseAdminUrl']->value;?>
" method="post" enctype="multipart/form-data" class="rb_import_option_form">
                        <div class="rb_import_option_updata">
                            <label for="sliderdata"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Menu data package','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</label>
                            <input id="image" type="file" name="sliderdata" id="sliderdata" />
                        </div>
                        <div class="rb_import_option_clean">
                            <input type="checkbox" value="1" id="importoverride" checked="checked" name="importoverride" />
                            <label for="importoverride"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear all menus before importing','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</label>
                        </div>
                        <div class="rb_import_option_button">
                            <input type="hidden" name="importMenu" value="1" />
                            <div class="rb_import_menu_loading"><img src="<?php echo $_smarty_tpl->tpl_vars['rb_img_dir']->value;?>
loader.gif" /><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Importing data','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</div>
                            <div class="rb_import_menu_submit">
                                <i class="fa fa-compress" data-title="&#xE0C3;"></i>
                                <input type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Import menu','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
" class="btn btn-default rb_import_menu"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div><?php }
}
