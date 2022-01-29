<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header/header-7.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f00983676ed3_44240692',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '732289fec5af8cabafc0a0689e1f8457738e8b6a' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/_partials/header/header-7.tpl',
      1 => 1643018648,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f00983676ed3_44240692 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

  <div class="rb-header header-v7 <?php if ($_smarty_tpl->tpl_vars['category']->value->id == 2) {?>hero-inner<?php }?>">
    <div class="header-desktop hidden-md-down">
      <div class="header-wrapper" data-sticky_header="0">
        <div class="container container-large">
          <div class="row header-flex">
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6 header-left">
              <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'index' || $_smarty_tpl->tpl_vars['page']->value['page_name'] == 'module-rbthemedream-live') {?>
                <div class="rbLogo">
                  <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
                    <img class="logo img-fluid" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
themes/rb_evo/assets/img/logo_white.png"
                      alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                  </a>
                </div>
              <?php } else { ?>
                <div class="rbLogo">
                  <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['base_url'], ENT_QUOTES, 'UTF-8');?>
">
                    <img class="logo img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['logo'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
                  </a>
                </div>
              <?php }?>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-xs-6 megamenu header-center">
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_161971435361f00983674be4_75821433', 'header_banner');
?>


  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_130559749561f009836756e5_10366453', 'header_nav');
?>


  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135506587161f00983676399_48810958', 'header_top');
}
/* {block 'header_banner'} */
class Block_161971435361f00983674be4_75821433 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_banner' => 
  array (
    0 => 'Block_161971435361f00983674be4_75821433',
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
class Block_130559749561f009836756e5_10366453 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_130559749561f009836756e5_10366453',
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
class Block_135506587161f00983676399_48810958 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_135506587161f00983676399_48810958',
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
