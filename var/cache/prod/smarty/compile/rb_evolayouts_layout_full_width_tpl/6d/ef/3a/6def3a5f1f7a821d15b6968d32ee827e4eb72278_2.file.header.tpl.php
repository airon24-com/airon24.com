<?php
/* Smarty version 3.1.39, created on 2022-01-25 16:47:42
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f01b9ebd9096_77070821',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6def3a5f1f7a821d15b6968d32ee827e4eb72278' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/checkout/_partials/header.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/header/header-2.tpl' => 1,
    'file:_partials/header/header-3.tpl' => 1,
    'file:_partials/header/header-4.tpl' => 1,
    'file:_partials/header/header-5.tpl' => 1,
    'file:_partials/header/header-6.tpl' => 1,
    'file:_partials/header/header-7.tpl' => 1,
    'file:_partials/header/header-1.tpl' => 1,
  ),
),false)) {
function content_61f01b9ebd9096_77070821 (Smarty_Internal_Template $_smarty_tpl) {
if (Configuration::get('RBTHEMEDREAM_HEADER') == 2) {?>
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
