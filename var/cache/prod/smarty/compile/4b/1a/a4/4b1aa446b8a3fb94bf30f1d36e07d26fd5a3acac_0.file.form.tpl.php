<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:49
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/admin/_configure/helpers/form/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d461740ba4_54098241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b1aa446b8a3fb94bf30f1d36e07d26fd5a3acac' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthememenu/views/templates/admin/_configure/helpers/form/form.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d461740ba4_54098241 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129961315061f3d4616fc623_11219062', "label");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26948458261f3d461702032_34016223', "input");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28661791661f3d461724c69_61425608', "field");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105289015561f3d46172be46_12257816', "footer");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_49698675961f3d46173c886_41213107', "input_row");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "label"} */
class Block_129961315061f3d4616fc623_11219062 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'label' => 
  array (
    0 => 'Block_129961315061f3d4616fc623_11219062',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['showRequired'])) && $_smarty_tpl->tpl_vars['input']->value['showRequired']) {?>
        <label class="control-label col-lg-3 required"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['label'],'html','UTF-8' ));?>
</label>
    <?php } else { ?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>
 
    <?php }
}
}
/* {/block "label"} */
/* {block "input"} */
class Block_26948458261f3d461702032_34016223 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_26948458261f3d461702032_34016223',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'checkbox') {?>
            <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['values']['query'])) && $_smarty_tpl->tpl_vars['input']->value['values']['query']) {?>
                <?php $_smarty_tpl->_assignInScope('id_checkbox', (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).('all'));?>
                <?php $_smarty_tpl->_assignInScope('checkall', true);?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['values']['query'], 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
    				<?php if (!((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) && is_array($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) && $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] && in_array($_smarty_tpl->tpl_vars['value']->value['value'],$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]))) {?> 
                        <?php $_smarty_tpl->_assignInScope('checkall', false);?>
                    <?php }?>
    			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
                <div class="checkbox_all checkbox">
					<label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_checkbox']->value,'html','UTF-8' ));?>
"><input type="checkbox" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
[]" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_checkbox']->value,'html','UTF-8' ));?>
" <?php if ((isset($_smarty_tpl->tpl_vars['value']->value['value']))) {?> value="0"<?php }
if ($_smarty_tpl->tpl_vars['checkall']->value) {?> checked="checked"<?php }?> /><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select/Unselect all','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</label>
				</div>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['values']['query'], 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
    				<?php $_smarty_tpl->_assignInScope('id_checkbox', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).($_smarty_tpl->tpl_vars['value']->value[$_smarty_tpl->tpl_vars['input']->value['values']['id']]),'html','UTF-8' )));?>
    				<div class="checkbox<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['expand'])) && strtolower($_smarty_tpl->tpl_vars['input']->value['expand']['default']) == 'show') {?> hidden<?php }?>">
    					<label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_checkbox']->value,'html','UTF-8' ));?>
"><input type="checkbox" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
[]" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_checkbox']->value,'html','UTF-8' ));?>
" <?php if ((isset($_smarty_tpl->tpl_vars['value']->value['value']))) {?> value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value['value'],'html','UTF-8' ));?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) && is_array($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]) && $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] && in_array($_smarty_tpl->tpl_vars['value']->value['value'],$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) {?> checked="checked"<?php }?> /><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value[$_smarty_tpl->tpl_vars['input']->value['values']['name']],'html','UTF-8' ));?>
</label>
    				</div>
    			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
            <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'search') {?>
        <div class="rb_search_product_form">
            <input class="rb_search_product" name="rb_search_product" <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['placeholder']))) {?>placeholder="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['placeholder'],'html','utf-8' ));?>
"<?php }?> autocomplete="off" type="text" />
            <input class="rb_product_ids" name="id_products" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']],'html','utf-8' ));?>
" type="hidden" />
            <ul class="rb_products">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbProductList','ids'=>$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']]),$_smarty_tpl ) );?>

                <li class="rb_product_loading"></li>
            </ul>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'radios') {?>
        <?php if ((isset($_smarty_tpl->tpl_vars['input']->value['values'])) && $_smarty_tpl->tpl_vars['input']->value['values']) {?>
            <ul class="rb_product_type">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['values'], 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                <?php $_smarty_tpl->_assignInScope('id_radio', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).($_smarty_tpl->tpl_vars['value']->value['value']),'html','UTF-8' )));?>
                <li class="rb_type_item <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value['value'],'html','UTF-8' ));?>
">
                    <label for="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_radio']->value,'html','UTF-8' ));?>
">
                        <input type="radio" name="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['name'],'html','UTF-8' ));?>
" id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_radio']->value,'html','UTF-8' ));?>
" <?php if ((isset($_smarty_tpl->tpl_vars['value']->value['value']))) {?> value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value['value'],'html','UTF-8' ));?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) && $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] && ($_smarty_tpl->tpl_vars['value']->value['value'] == $_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']])) {?> checked="checked"<?php }?> />
                        <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value['label'],'html','UTF-8' ));?>

                    </label>
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['input']->value['class'] == 'rb_browse_icon' && $_smarty_tpl->tpl_vars['input']->value['type'] == 'text') {?>
        <div class="dummyfile input-group">
            <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

            <span class="input-group-btn rb_browse_icon">
                <button type="button" name="submitAddBrowseIcon" class="btn btn-default">
                    <i class="icon-search"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Browse icon','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

                </button>
            </span>
        </div>
    <?php } else { ?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>
 
        <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'RBTHEMEMENU_CACHE_LIFE_TIME') {?>
            <a class="rb_clear_cache" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rb_clear_cache_url']->value,'html','UTF-8' ));?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clear menu cache','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</a>
        <?php }?>               
    <?php }?>            
<?php
}
}
/* {/block "input"} */
/* {block "field"} */
class Block_28661791661f3d461724c69_61425608 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'field' => 
  array (
    0 => 'Block_28661791661f3d461724c69_61425608',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['input']->value['name']) {?>
        <?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

    	<?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'file' && (isset($_smarty_tpl->tpl_vars['input']->value['display_img'])) && $_smarty_tpl->tpl_vars['input']->value['display_img']) {?>
            <label class="control-label col-lg-3 uploaded_image_label" style="font-style: italic;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Uploaded image: ','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</label>
            <div class="col-lg-9 uploaded_img_wrapper">
        		<a  class="rb_fancy" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['display_img'],'html','UTF-8' ));?>
"><img title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to see full size image','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
" style="display: inline-block; max-width: 200px;" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['display_img'],'html','UTF-8' ));?>
" /></a>
                <?php if ((!(isset($_smarty_tpl->tpl_vars['input']->value['hide_delete'])) || (isset($_smarty_tpl->tpl_vars['input']->value['hide_delete'])) && !$_smarty_tpl->tpl_vars['input']->value['hide_delete']) && (isset($_smarty_tpl->tpl_vars['input']->value['img_del_link'])) && $_smarty_tpl->tpl_vars['input']->value['img_del_link'] && !((isset($_smarty_tpl->tpl_vars['input']->value['required'])) && $_smarty_tpl->tpl_vars['input']->value['required'])) {?>
                    <a class="delete_url" style="display: inline-block; text-decoration: none!important;" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['input']->value['img_del_link'],'html','UTF-8' ));?>
"><span style="color: #666"><i style="font-size: 20px;" class="process-icon-delete"></i></span></a>
                <?php }?>
            </div>        
        <?php }?>    
    <?php }
}
}
/* {/block "field"} */
/* {block "footer"} */
class Block_105289015561f3d46172be46_12257816 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_105289015561f3d46172be46_12257816',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/daeovmkhla/domains/greenwat.eu/public_html/shop/vendor/smarty/smarty/libs/plugins/function.counter.php','function'=>'smarty_function_counter',),));
?>

    <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'form_submit_btn', null, null);
echo smarty_function_counter(array('name'=>'form_submit_btn'),$_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>      
	<?php if ((isset($_smarty_tpl->tpl_vars['fieldset']->value['form']['submit'])) || (isset($_smarty_tpl->tpl_vars['fieldset']->value['form']['buttons']))) {?>
		<div class="panel-footer">
            <?php if ((isset($_smarty_tpl->tpl_vars['reset_default']->value)) && $_smarty_tpl->tpl_vars['reset_default']->value) {?>
                <span class="btn btn-default rb_reset_default" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Only reset configuration to default. Menu data won\'t be lost','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
">
                    <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_baseurl']->value,'html','UTF-8' ));?>
loader.gif" />
                    <i class="process-icon-refresh"></i>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

                </span>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['fieldset']->value['form']['submit'])) && !empty($_smarty_tpl->tpl_vars['fieldset']->value['form']['submit'])) {?>
            <div class="img_loading_wrapper hidden">
                <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_baseurl']->value,'html','UTF-8' ));?>
ajax-loader.gif" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Loading','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
" class="rb_megamenu_loading" />
            </div>
            <input type="hidden" name="rb_object" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['rb_object']->value,'html','UTF-8' ));?>
" />
            <?php if ((isset($_smarty_tpl->tpl_vars['list_item']->value)) && $_smarty_tpl->tpl_vars['list_item']->value) {?>
                <input type="hidden" name="itemId" value="<?php echo intval($_smarty_tpl->tpl_vars['item_id']->value);?>
" />
                <input type="hidden" name="rb_form_submitted" value="1" />
            <?php } else { ?>
                <input type="hidden" name="rb_config_submitted" value="1" />
            <?php }?>
            <div class="rb_save_wrapper">
    			<button type="submit" value="1"	class="rb_save_button <?php if ((isset($_smarty_tpl->tpl_vars['list_item']->value)) && $_smarty_tpl->tpl_vars['list_item']->value) {?>rb_save<?php } else { ?>rb_config_save<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['fieldset']->value['form']['submit']['class']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fieldset']->value['form']['submit']['class'],'html','UTF-8' ));
} else { ?>btn btn-default pull-right<?php }?>">
    				<i class="<?php if ((isset($_smarty_tpl->tpl_vars['fieldset']->value['form']['submit']['icon']))) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fieldset']->value['form']['submit']['icon'],'html','UTF-8' ));
} else { ?>process-icon-save<?php }?>"></i> <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['fieldset']->value['form']['submit']['title'],'html','UTF-8' ));?>

    			</button>
                <div class="rb_saving">
                    <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_baseurl']->value,'html','UTF-8' ));?>
loader.gif" /><br />
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Saving','mod'=>'rbthememenu'),$_smarty_tpl ) );?>

                </div>
            </div>
			<?php }?>
            
		</div>
	<?php }?>    
<?php
}
}
/* {/block "footer"} */
/* {block "input_row"} */
class Block_49698675961f3d46173c886_41213107 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input_row' => 
  array (
    0 => 'Block_49698675961f3d46173c886_41213107',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'RBTHEMEMENU_HOOK_TO') {?>
        <div class="rb_config_form_tab_div">
            <ul class="rb_config_form_tab">
                <li class="rb_config_genneral active" data-tab="general"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'General','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</li>
                <li class="rb_config_design" data-tab="design"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Design','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</li>
                <li class="rb_config_extra_features" data-tab="extra_features"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra features','mod'=>'rbthememenu'),$_smarty_tpl ) );?>
</li>
            </ul>
        </div>
        <div class="rb_config_forms">
            <div class="rb_config_general active">
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'RBTHEMEMENU_LAYOUT') {?>
        </div>
        <div class="rb_config_design">
    <?php }?>    
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'RBTHEMEMENU_DISPLAY_SHOPPING_CART') {?>
        </div>
        <div class="rb_config_extra_features">
    <?php }?>
    <div class="form-group-wrapper row_<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( strtolower($_smarty_tpl->tpl_vars['input']->value['name']),'html','UTF-8' ));?>
"><?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>
</div>
    <?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'RBTHEMEMENU_CUSTOM_HTML_TEXT') {?>
        </div>
        </div>
    <?php }
}
}
/* {/block "input_row"} */
}
