{**
 *  PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright  PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div class="product-tabs tabs">
	<ul class="nav nav-tabs" role="tablist">
		{if $product.description}
			<li class="nav-item">
				<a
				class="nav-link{if $product.description} active{/if}"
				data-toggle="tab"
				href="#description"
				role="tab"
				aria-controls="description"
				{if $product.description} aria-selected="true"{/if}>
					{l s='Description' d='Shop.Theme.Catalog'}
				</a>
			</li>
		{/if}

		<li class="nav-item">
			<a
			class="nav-link{if !$product.description} active{/if}"
			data-toggle="tab"
			href="#product-details"
			role="tab"
			aria-controls="product-details"
			{if !$product.description} aria-selected="true"{/if}>
				{l s='Product Details' d='Shop.Theme.Catalog'}
			</a>
		</li>

		{if $product.attachments}
			<li class="nav-item">
				<a
				class="nav-link"
				data-toggle="tab"
				href="#attachments"
				role="tab"
				aria-controls="attachments">{l s='Attachments' d='Shop.Theme.Catalog'}</a>
			</li>
		{/if}

		{foreach from=$product.extraContent item=extra key=extraKey}
			<li class="nav-item">
				<a
				class="nav-link"
				data-toggle="tab"
				href="#extra-{$extraKey}"
				role="tab"
				aria-controls="extra-{$extraKey}">{$extra.title}</a>
			</li>
		{/foreach}

		<li class="nav-item" id="rb_li_review">
			<a
			class="nav-link"
			data-toggle="tab"
			href="#rb_review"
			role="tab"
			aria-controls="rb_review">
				{l s='Review' d='Shop.Theme.Catalog'}
				{hook h='displayRbReviewProduct' product=$product type='number'}
			</a>
		</li>
	</ul>

	<div class="tab-content" id="tab-content">
		<div class="tab-pane fade in{if $product.description} active{/if}" id="description" role="tabpanel">
			{block name='product_description'}
				<div class="product-description">{$product.description nofilter}</div>
			{/block}
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

		{block name='product_details'}
			{include file='catalog/_partials/product-details.tpl'}
		{/block}

		{block name='product_attachments'}
			{if $product.attachments}
				<div class="tab-pane fade in" id="attachments" role="tabpanel">
					<section class="product-attachments">
						<p class="h5 text-uppercase">{l s='Download' d='Shop.Theme.Actions'}</p>
						{foreach from=$product.attachments item=attachment}
						<div class="attachment">
							<h4>
								<a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
									{$attachment.name}
								</a>
							</h4>
							<p>{$attachment.description}</p
								<a href="{url entity='attachment' params=['id_attachment' => $attachment.id_attachment]}">
									{l s='Download' d='Shop.Theme.Actions'} ({$attachment.file_size_formatted})
								</a>
							</div>
						{/foreach}
					</section>
				</div>
			{/if}
		{/block}

		{foreach from=$product.extraContent item=extra key=extraKey}
			<div class="tab-pane fade in {$extra.attr.class}" id="extra-{$extraKey}" role="tabpanel" {foreach $extra.attr as $key => $val} {$key}="{$val}"{/foreach}>
				{$extra.content nofilter}
			</div>
		{/foreach}

		<div class="tab-pane fade in" id="rb_review" role="tabpanel">
			{hook h='displayRbReviewProduct' product=$product type='content'}
		</div>
	</div>  
</div>