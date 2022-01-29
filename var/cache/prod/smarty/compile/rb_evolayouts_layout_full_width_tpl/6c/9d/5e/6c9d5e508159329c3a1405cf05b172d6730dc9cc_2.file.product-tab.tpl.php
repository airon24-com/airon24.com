<?php
/* Smarty version 3.1.39, created on 2022-01-28 17:58:10
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f420a22c40d1_30808630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c9d5e508159329c3a1405cf05b172d6730dc9cc' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/themes/rb_evo/templates/catalog/_partials/product-tab.tpl',
      1 => 1643389088,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/product-details.tpl' => 1,
  ),
),false)) {
function content_61f420a22c40d1_30808630 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="product-tabs tabs">
	<ul class="nav nav-tabs" role="tablist">
		<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?>
			<li class="nav-item">
				<a
				class="nav-link<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> active<?php }?>"
				data-toggle="tab"
				href="#description"
				role="tab"
				aria-controls="description"
				<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> aria-selected="true"<?php }?>>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Description','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

				</a>
			</li>
		<?php }?>

		<li class="nav-item">
			<a
			class="nav-link<?php if (!$_smarty_tpl->tpl_vars['product']->value['description']) {?> active<?php }?>"
			data-toggle="tab"
			href="#product-details"
			role="tab"
			aria-controls="product-details"
			<?php if (!$_smarty_tpl->tpl_vars['product']->value['description']) {?> aria-selected="true"<?php }?>>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Details','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

			</a>
		</li>

		<?php if ($_smarty_tpl->tpl_vars['product']->value['attachments']) {?>
			<li class="nav-item">
				<a
				class="nav-link"
				data-toggle="tab"
				href="#attachments"
				role="tab"
				aria-controls="attachments"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Attachments','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
			</li>
		<?php }?>

		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['extraContent'], 'extra', false, 'extraKey');
$_smarty_tpl->tpl_vars['extra']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['extraKey']->value => $_smarty_tpl->tpl_vars['extra']->value) {
$_smarty_tpl->tpl_vars['extra']->do_else = false;
?>
			<li class="nav-item">
				<a
				class="nav-link"
				data-toggle="tab"
				href="#extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
"
				role="tab"
				aria-controls="extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value['title'], ENT_QUOTES, 'UTF-8');?>
</a>
			</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		<li class="nav-item" id="rb_li_review">
			<a
			class="nav-link"
			data-toggle="tab"
			href="#rb_review"
			role="tab"
			aria-controls="rb_review">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Review','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbReviewProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'number'),$_smarty_tpl ) );?>

			</a>
		</li>
	</ul>

	<div class="tab-content" id="tab-content">
		<div class="tab-pane fade in<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> active<?php }?>" id="description" role="tabpanel">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_66981235461f420a22b6751_98900286', 'product_description');
?>

			<section class="sec-block" id="opinie">
			<div class="fixed-bg light-bg"></div>
			<div class="container">
				<div class="review-section-head">
					<h3 class="sc-title float-none">Oceny i recenzje</h3>
					<div class="row">
						<div class="col-lg-6">
							<div class="review-head">
								<h2>4.8<sub>%</sub></h2>
								<div class="review-count">
									<h3>33 reviews</h3>
									<ul class="rating">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
								</div>
							</div>
							<!--review-head end-->
						</div>
						<div class="col-lg-6">
							<div class="av-div">
								<h3> Rekomenduje ten produkt </h3>
								<div class="progress">
									<div class="progress-bar" role="progressbar" data-width="95" style="width: 95%;"></div>
								</div>
								<div class="coun-dv">
									<h2>95<small>%</small></h2>
									<p>konsumentów poleca ten produkt. Dołącz do tego grona! </p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--review-section-head end-->
				<div class="review-main-section">
					<ul class="comments-list">
						<li>
							<div class="comment">
								<div class="cm-thumb">
									<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
								</div>
								<div class="cm-details">
									<h3>Mous Lloyd <span>4 hours ago</span></h3>
									<p>Ipsum curae curabitur dapibus netus dolor ante ut laoreet, turpis faucibus
										sodales euismod conubia taciti quisque vestibulum, vitae adipiscing bibendum
										himenaeos.</p>
									<ul class="rating">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
								</div>
							</div>
							<!--comment end-->
						</li>
						<li>
							<div class="comment">
								<div class="cm-thumb">
									<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
								</div>
								<div class="cm-details">
									<h3>Fresy Clock <span>4 hours ago</span></h3>
									<p>Ipsum curae curabitur dapibus netus dolor ante ut laoreet, turpis faucibus
										sodales euismod conubia taciti quisque vestibulum, vitae adipiscing bibendum
										himenaeos.</p>
									<div class="images-list">
										<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
										<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
										<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
									</div>
									<ul class="rating">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
								</div>
							</div>
							<!--comment end-->
						</li>
						<li>
							<div class="comment">
								<div class="cm-thumb">
									<img load="lazy" src="http://greenwat.eu/shop/img/60x60.png" alt="">
								</div>
								<div class="cm-details">
									<h3>Fresy Clock <span>4 hours ago</span></h3>
									<p>Ipsum curae curabitur dapibus netus dolor ante ut laoreet, turpis faucibus
										sodales euismod conubia taciti quisque vestibulum, vitae adipiscing bibendum
										himenaeos.</p>
									<ul class="rating">
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
										<li><i class="fa fa-star"></i></li>
									</ul>
								</div>
							</div>
							<!--comment end-->
						</li>
					</ul>
					<div class="post-comments">
						<h3 class="sc-title float-none"> Oceń to urządzenie </h3>
						<form method="post" action="#" id="contact-form">
							<div class="form-group">
								<div class="response"></div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="name" class="form-control name" placeholder="Antho_">
									</div>
									<!--form-group end-->
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="email" name="email" class="form-control email" placeholder="E.g., a.octavian@gmail.com">
									</div>
									<!--form-group end-->
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<textarea name="message" class="form-control" placeholder="Your review"></textarea>
									</div>
									<!--form-group end-->
								</div>
								<div class="col-lg-12">
									<button type="button" class="btn-primary submit btn-default" id="submit"> Zaloguj
										się by dodać opinię <span></span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!--review-main-section end-->
			</div>
		</section>
		</div>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129342470161f420a22b7c16_64822757', 'product_details');
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149723887061f420a22bceb6_43493272', 'product_attachments');
?>


		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['extraContent'], 'extra', false, 'extraKey');
$_smarty_tpl->tpl_vars['extra']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['extraKey']->value => $_smarty_tpl->tpl_vars['extra']->value) {
$_smarty_tpl->tpl_vars['extra']->do_else = false;
?>
			<div class="tab-pane fade in <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value['attr']['class'], ENT_QUOTES, 'UTF-8');?>
" id="extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
" role="tabpanel" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extra']->value['attr'], 'val', false, 'key');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value, ENT_QUOTES, 'UTF-8');?>
"<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>>
				<?php echo $_smarty_tpl->tpl_vars['extra']->value['content'];?>

			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		<div class="tab-pane fade in" id="rb_review" role="tabpanel">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRbReviewProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'content'),$_smarty_tpl ) );?>

		</div>
	</div>  
</div><?php }
/* {block 'product_description'} */
class Block_66981235461f420a22b6751_98900286 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_description' => 
  array (
    0 => 'Block_66981235461f420a22b6751_98900286',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<div class="product-description"><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</div>
			<?php
}
}
/* {/block 'product_description'} */
/* {block 'product_details'} */
class Block_129342470161f420a22b7c16_64822757 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_details' => 
  array (
    0 => 'Block_129342470161f420a22b7c16_64822757',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-details.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php
}
}
/* {/block 'product_details'} */
/* {block 'product_attachments'} */
class Block_149723887061f420a22bceb6_43493272 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_attachments' => 
  array (
    0 => 'Block_149723887061f420a22bceb6_43493272',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php if ($_smarty_tpl->tpl_vars['product']->value['attachments']) {?>
				<div class="tab-pane fade in" id="attachments" role="tabpanel">
					<section class="product-attachments">
						<p class="h5 text-uppercase"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</p>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attachments'], 'attachment');
$_smarty_tpl->tpl_vars['attachment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['attachment']->value) {
$_smarty_tpl->tpl_vars['attachment']->do_else = false;
?>
						<div class="attachment">
							<h4>
								<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'attachment','params'=>array('id_attachment'=>$_smarty_tpl->tpl_vars['attachment']->value['id_attachment'])),$_smarty_tpl ) );?>
">
									<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['name'], ENT_QUOTES, 'UTF-8');?>

								</a>
							</h4>
							<p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['description'], ENT_QUOTES, 'UTF-8');?>
</p
								<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'attachment','params'=>array('id_attachment'=>$_smarty_tpl->tpl_vars['attachment']->value['id_attachment'])),$_smarty_tpl ) );?>
">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['file_size_formatted'], ENT_QUOTES, 'UTF-8');?>
)
								</a>
							</div>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</section>
				</div>
			<?php }?>
		<?php
}
}
/* {/block 'product_attachments'} */
}
