<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from 'module:pscontactinfopscontactinf' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0098391d627_75789358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9992f3fe04dd41bcec1a2029cf07bead637caf4d' => 
    array (
      0 => 'module:pscontactinfopscontactinf',
      1 => 1641242529,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f0098391d627_75789358 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/daeovmkhla/domains/greenwat.eu/public_html/shop/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'/home/daeovmkhla/domains/greenwat.eu/public_html/shop/vendor/smarty/smarty/libs/plugins/function.mailto.php','function'=>'smarty_function_mailto',),));
?>

  <div class="block-contact block links">
    <h3 class="h3 title_block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contact','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</h3>
    <ul id="footer_block_contact">
      <li class="address"><span class="title">Address:</span><span> <?php echo $_smarty_tpl->tpl_vars['contact_infos']->value['address']['formatted'];?>
</span></li>
      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['phone']) {?>
      <li class="phone">
        <span class="title">Phone:</span>
                <?php ob_start();
echo htmlspecialchars(smarty_modifier_replace($_smarty_tpl->tpl_vars['contact_infos']->value['phone'],' ',''), ENT_QUOTES, 'UTF-8');
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'[1]%phone%[/1]','sprintf'=>array('[1]'=>"<a href='tel:".$_prefixVariable3."'>",'[/1]'=>'</a>','%phone%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['phone']),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

      </li>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['fax']) {?>
      <li class="fax">
        <span class="title">Fax:</span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'[1]%fax%[/1]','sprintf'=>array('[1]'=>'<span>','[/1]'=>'</span>','%fax%'=>$_smarty_tpl->tpl_vars['contact_infos']->value['fax']),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

      </li>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['contact_infos']->value['email'] && $_smarty_tpl->tpl_vars['display_email']->value) {?>
      <li class="email">
        <span class="title">Email:</span>
        <?php echo smarty_function_mailto(array('address'=>$_smarty_tpl->tpl_vars['contact_infos']->value['email'],'encode'=>"javascript"),$_smarty_tpl);?>

      </li>
      <?php }?>
    </ul>
  </div><?php }
}
