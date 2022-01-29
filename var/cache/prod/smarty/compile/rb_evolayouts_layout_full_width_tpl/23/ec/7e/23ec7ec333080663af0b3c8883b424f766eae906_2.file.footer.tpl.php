<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00983904ad5_66983129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23ec7ec333080663af0b3c8883b424f766eae906' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/footer.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/footer/footer-".((string)$_smarty_tpl->tpl_vars[\'id_footer\']->value).".tpl' => 1,
    'file:_partials/footer/footer-2.tpl' => 1,
    'file:_partials/footer/footer-3.tpl' => 1,
    'file:_partials/footer/footer-4.tpl' => 1,
    'file:_partials/footer/footer-5.tpl' => 1,
    'file:_partials/footer/footer-6.tpl' => 1,
    'file:_partials/footer/footer-7.tpl' => 1,
    'file:_partials/footer/footer-1.tpl' => 1,
  ),
),false)) {
function content_61f00983904ad5_66983129 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['id_footer']->value)) && $_smarty_tpl->tpl_vars['id_footer']->value != '') {?>
	<?php $_smarty_tpl->_subTemplateRender("file:_partials/footer/footer-".((string)$_smarty_tpl->tpl_vars['id_footer']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} elseif (Configuration::get('RBTHEMEDREAM_FOOTER') == 2) {?>
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
