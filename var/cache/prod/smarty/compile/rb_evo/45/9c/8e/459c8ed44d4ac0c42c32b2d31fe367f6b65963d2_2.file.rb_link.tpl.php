<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/hook/rb_link.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00983948640_77296580',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '459c8ed44d4ac0c42c32b2d31fe367f6b65963d2' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/hook/rb_link.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00983948640_77296580 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['rb_links']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rb_links']->value, 'rb_link');
$_smarty_tpl->tpl_vars['rb_link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rb_link']->value) {
$_smarty_tpl->tpl_vars['rb_link']->do_else = false;
?>
	    <?php if ($_smarty_tpl->tpl_vars['rb_link']->value['hook'] == 'displayNav1' || $_smarty_tpl->tpl_vars['rb_link']->value['hook'] == 'displayNav2') {?>
	        <div class="block-rbthemedream block-rbthemedream-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_link']->value['id'], ENT_QUOTES, 'UTF-8');?>
 block-links-inline d-inline-block">
	            <ul>
	                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rb_link']->value['links'], 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
	                    <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['url'])) && (isset($_smarty_tpl->tpl_vars['link']->value['data']['title']))) {?>
	                        <li>
	                            <a
	                                href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['url'], ENT_QUOTES, 'UTF-8');?>
"
	                                <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['description']))) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['description'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
	                            >
	                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['title'], ENT_QUOTES, 'UTF-8');?>

	                            </a>
	                        </li>
	                    <?php }?>
	                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	            </ul>
	        </div>
	    <?php } elseif ($_smarty_tpl->tpl_vars['rb_link']->value['hook'] == 'displayLeftColumn' || $_smarty_tpl->tpl_vars['rb_link']->value['hook'] == 'displayRightColumn') {?>
	        <div class="block block-toggle block-rbthemedream block-rbthemedream-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_link']->value['id'], ENT_QUOTES, 'UTF-8');?>
 block-links js-block-toggle">
	            <h3 class="block-title"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_link']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span></h3>
	            <div class="block-content">
	                <ul>
	                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rb_link']->value['links'], 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
	                        <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['url'])) && (isset($_smarty_tpl->tpl_vars['link']->value['data']['title']))) {?>
	                            <li>
	                                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['url'], ENT_QUOTES, 'UTF-8');?>
"
	                                   	<?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['description']))) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['description'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
	                                >
	                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['title'], ENT_QUOTES, 'UTF-8');?>

	                                </a>
	                            </li>
	                        <?php }?>
	                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	                </ul>
	            </div>
	        </div>
	    <?php } else { ?>
	        <div class="links block RbBlockLink">
	            <p class="h3 title_block"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_link']->value['title'], ENT_QUOTES, 'UTF-8');?>
</p>
	            <ul>
	                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rb_link']->value['links'], 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
	                    <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['url'])) && (isset($_smarty_tpl->tpl_vars['link']->value['data']['title']))) {?>
	                        <li>
	                            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['url'], ENT_QUOTES, 'UTF-8');?>
" <?php if ((isset($_smarty_tpl->tpl_vars['link']->value['data']['description']))) {?>title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['description'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
	                            >
	                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value['data']['title'], ENT_QUOTES, 'UTF-8');?>

	                            </a>
	                        </li>
	                    <?php }?>
	                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	            </ul>
	        </div>
	    <?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
