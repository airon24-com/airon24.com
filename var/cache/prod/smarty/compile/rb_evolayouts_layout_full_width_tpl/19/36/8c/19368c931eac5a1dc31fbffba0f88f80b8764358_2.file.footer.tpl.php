<?php
/* Smarty version 3.1.39, created on 2022-01-25 16:47:42
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f01b9ee3e3b8_02390683',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19368c931eac5a1dc31fbffba0f88f80b8764358' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/footer.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/footer/footer-2.tpl' => 1,
    'file:_partials/footer/footer-3.tpl' => 1,
    'file:_partials/footer/footer-4.tpl' => 1,
    'file:_partials/footer/footer-5.tpl' => 1,
    'file:_partials/footer/footer-6.tpl' => 1,
    'file:_partials/footer/footer-7.tpl' => 1,
    'file:_partials/footer/footer-1.tpl' => 1,
  ),
),false)) {
function content_61f01b9ee3e3b8_02390683 (Smarty_Internal_Template $_smarty_tpl) {
if (Configuration::get('RBTHEMEDREAM_FOOTER') == 2) {?>
  	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-2.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 3) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-3.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 4) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-4.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 5) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-5.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 6) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-6.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 7) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-7.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
  	<?php $_smarty_tpl->_subTemplateRender('file:_partials/footer/footer-1.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
