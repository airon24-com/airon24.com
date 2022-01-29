<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0098366be66_06505151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b31067b0db835fc0a72b24cfee37d153f1be451' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/header/header-".((string)$_smarty_tpl->tpl_vars[\'id_header\']->value).".tpl' => 1,
    'file:_partials/header/header-2.tpl' => 1,
    'file:_partials/header/header-3.tpl' => 1,
    'file:_partials/header/header-4.tpl' => 1,
    'file:_partials/header/header-5.tpl' => 1,
    'file:_partials/header/header-6.tpl' => 1,
    'file:_partials/header/header-7.tpl' => 1,
    'file:_partials/header/header-1.tpl' => 1,
  ),
),false)) {
function content_61f0098366be66_06505151 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['id_header']->value)) && $_smarty_tpl->tpl_vars['id_header']->value != '') {?>
	<?php $_smarty_tpl->_subTemplateRender("file:_partials/header/header-".((string)$_smarty_tpl->tpl_vars['id_header']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 2) {?>
  	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-2.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 3) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-3.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 4) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-4.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 5) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-5.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 6) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-6.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif (Configuration::get('RBTHEMEDREAM_HEADER') == 7) {?>
	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-7.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
  	<?php $_smarty_tpl->_subTemplateRender('file:_partials/header/header-1.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
