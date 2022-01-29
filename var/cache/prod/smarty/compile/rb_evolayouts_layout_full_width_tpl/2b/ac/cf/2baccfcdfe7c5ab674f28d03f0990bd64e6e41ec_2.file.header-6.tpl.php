<?php
/* Smarty version 3.1.39, created on 2022-01-28 12:32:54
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header/header-6.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f3d466566d22_42818641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2baccfcdfe7c5ab674f28d03f0990bd64e6e41ec' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header/header-6.tpl',
      1 => 1641242529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f3d466566d22_42818641 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

  <div class="rb-header header-v6">
    <div class="header-desktop hidden-md-down">
      <div class="header-wrapper" data-sticky_header="0">
        <div class="container container-large">
          <div class="row header-flex">
            <div class="col-xl-2 col-lg-1 col-md-6 col-sm-6 col-xs-6 header-left">
              <div class="show-menu">
                <i class="icon-Ico_Menu"></i>
                <span>Menu</span>
              </div>
              <div class="bg-over-lay"></div>
            </div>
            <div class="col-xl-8 col-lg-9 col-md-6 col-sm-6 col-xs-6 megamenu header-center">
              <div class="rbLogo">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
                  <img class="logo img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                </a>
              </div>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbMenu','type'=>'horizontal'),$_smarty_tpl ) );?>

            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6 header-right">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbSearch'),$_smarty_tpl ) );?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbTopLogin'),$_smarty_tpl ) );?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbTopCart'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
      </div>
      <div class="menu-sidebar">
        <div class="container-large">
          <div class="close-menubar">
            <span id="click_off_menu"></span>
          </div>
          <div class="megamenu">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbMenu','type'=>'vertical'),$_smarty_tpl ) );?>

          </div>
          <div class="sidebar-bottom">
            <div class="rb-lang">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbCurrency'),$_smarty_tpl ) );?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbLanguage'),$_smarty_tpl ) );?>

            </div>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbSocial'),$_smarty_tpl ) );?>

          </div>
        </div>
      </div>
    </div>
    <div class="header-mobile navbar-head hidden-lg-up">
      <div class="container">
        <div class="row header-flex">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-xs-3 megamenu header-left">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbMenu','type'=>'horizontal'),$_smarty_tpl ) );?>

          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6 header-center ">
            <div class="rbLogo">
              <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
                <img class="logo img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
              </a>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-xs-3 header-right">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbSearch'),$_smarty_tpl ) );?>

          </div>
        </div>
      </div>
      <div class="header-mobile-fixed">
        <div class="shop-page">
          <a href="/">
            <i class="icon-store"></i>
          </a>
        </div>
        <div class="my-account">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbTopLogin'),$_smarty_tpl ) );?>

        </div>
        <div class="home-index">
          <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
            <i class="icon-house"></i>
          </a>
        </div>
        <div class="wishlist-box">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbTopWishlist'),$_smarty_tpl ) );?>

        </div>
        <div class="my-cart">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbTopCart'),$_smarty_tpl ) );?>

        </div>
      </div>
    </div>
  </div>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_126886648561f3d466564226_72577583', 'header_banner');
?>


  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_42806254561f3d466564e14_02415627', 'header_nav');
?>


  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_141833499161f3d466565b14_18964009', 'header_top');
}
/* {block 'header_banner'} */
class Block_126886648561f3d466564226_72577583 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_126886648561f3d466564226_72577583',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div class="header-banner">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBanner'),$_smarty_tpl ) );?>

  </div>
  <?php
}
}
/* {/block 'header_banner'} */
/* {block 'header_nav'} */
class Block_42806254561f3d466564e14_02415627 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_42806254561f3d466564e14_02415627',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <nav class="header-nav">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2'),$_smarty_tpl ) );?>

  </nav>
  <?php
}
}
/* {/block 'header_nav'} */
/* {block 'header_top'} */
class Block_141833499161f3d466565b14_18964009 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_141833499161f3d466565b14_18964009',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNavFullWidth'),$_smarty_tpl ) );?>

  <?php
}
}
/* {/block 'header_top'} */
}
