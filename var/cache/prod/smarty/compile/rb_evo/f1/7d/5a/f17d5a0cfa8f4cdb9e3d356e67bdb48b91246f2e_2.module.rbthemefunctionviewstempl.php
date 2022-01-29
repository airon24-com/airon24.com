<?php
/* Smarty version 3.1.39, created on 2022-01-25 15:30:27
  from 'module:rbthemefunctionviewstempl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f0098354d214_88530995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f17d5a0cfa8f4cdb9e3d356e67bdb48b91246f2e' => 
    array (
      0 => 'module:rbthemefunctionviewstempl',
      1 => 1641242528,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:rbthemefunction/views/templates/rb-ajax-loading.tpl' => 1,
  ),
),false)) {
function content_61f0098354d214_88530995 (Smarty_Internal_Template $_smarty_tpl) {
?><div
	class="rb-popup-container"
	style="width:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_width']->value, ENT_QUOTES, 'UTF-8');?>
px;
	height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_height']->value, ENT_QUOTES, 'UTF-8');?>
px;<?php if ($_smarty_tpl->tpl_vars['rb_img']->value == 1) {?>
	background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rb_url_img']->value, ENT_QUOTES, 'UTF-8');?>
');<?php }?>
	background-position: center"
>
	<div class="rb-popup-flex">
		<div id="rb_newsletter_popup" class="rb-block">
			<div class="rb-block-content">
				<form action="" method="POST">
					<div class="rb-popup-text">
    					<?php echo $_smarty_tpl->tpl_vars['rb_text']->value;?>

                    </div>

                    <?php if ($_smarty_tpl->tpl_vars['rb_form']->value == 1) {?>
	                    <div class="rb-relative-input relative">
	                    	<input class="inputNew" id="rb-newsletter-popup" type="email" name="email" required="" value="" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'your@email.com','mod'=>'rbthemefunction'),$_smarty_tpl ) );?>
" />
	                    	<button class="rb-send-email">
	                    		<i class="material-icons">trending_flat</i>
	                    	</button>
	                    </div>

	                    <div class="rb-email-alert">
	                    	<?php $_smarty_tpl->_subTemplateRender('module:rbthemefunction/views/templates/rb-ajax-loading.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	                    	<p class="rb-email rb-email-success alert alert-success"></p>
	                    	<p class="rb-email rb-email-error alert alert-danger"></p>
	                    </div>
                    <?php }?>
				</form>
			</div>
		</div>
	</div>
</div><?php }
}
