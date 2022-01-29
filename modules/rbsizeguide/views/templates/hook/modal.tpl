{*
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="modal rbsizeguide-modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-header">
            	<div class="modal-body">
            		{if isset($show_img) && $show_img == 1 && $url_img != ''}
            			<div class="row">
            				{if !empty($lists) || $show_default == 1}
	            				<div class="col-md-6">
	            					<img src="{$url_img}" style="max-width:100%;height:auto;">
	            				</div>

	            				<div class="col-md-6">
	            					<ul class="nav nav-tabs">
		            					{if $show_default == 1}
		            						<li class="nav-item">
		            							<a
		            								class="nav-link active"
		            								href="#rb_sizeguide"
		            								title="{l s='Size Guide' mod='rbsizeguide'}"
		            								data-toggle="tab"
		            							>
													<h5>{l s='Size Guide' mod='rbsizeguide'}</h5>
												</a>
		            						</li>
		            					{/if}

		            					{if !empty($lists)}
		            						{$count_title = 1}

		            						{foreach from=$lists item=list}
			            						<li class="nav-item">
			            							<a 
			            								class="nav-link{if $show_default != 1 && $count_title == 1} active{/if}"
			            								href="#rb_sizeguide_{$count_title}"
			            								title="{$list.title}"
			            								data-toggle="tab"
			            							>
			            								<h5>{$list.title}</h5>
			            							</a>	
			            						</li>

			            						{$count_title = $count_title + 1}
		            						{/foreach}
		            					{/if}
	            					</ul>
	            					<div class="tab-content">
	            						{if $show_default == 1}
	            							<div id="rb_sizeguide"  class="tab-pane rte fade active in">
	            								{$content_default nofilter}
	            							</div>
	            						{/if}

	            						{if !empty($lists)}
	            							{$count_content = 1}

	            							{foreach from=$lists item=list}
	            								<div
	            									id="rb_sizeguide_{$count_content}"
	            									class="tab-pane rte fade {if $show_default != 1 && $count_title == 1} active in{/if}"
	            								>
	            									{$list.content nofilter}
	            								</div>

	            								{$count_content = $count_content + 1}
	            							{/foreach}
	            						{/if}
	            					</div>
	            				</div>
	            			{else}
	            				<div class="col-md-12">
	            					<img src="{$url_img}" style="max-width:100%;height:auto;">
	            				</div>	
            				{/if}
            			</div>
            		{else}
            			<div class="row">
            				<div class="col-md-12">
	            				<ul class="nav nav-tabs">
		            				{if $show_default == 1}
		            					<li class="nav-item">
		            						<a
		            							class="nav-link active"
		            							href="#rb_sizeguide"
		            							title="{l s='Size Guide' mod='rbsizeguide'}"
		            							data-toggle="tab"
		            						>
												<h5>{l s='Size Guide' mod='rbsizeguide'}</h5>
											</a>
		            					</li>
		            				{/if}

		            				{if !empty($lists)}
		            					{$count_title = 1}

		            					{foreach from=$lists item=list}
			            					<li class="nav-item">
			            						<a 
			            							class="nav-link{if $show_default != 1 && $count_title == 1} active{/if}"
			            							href="#rb_sizeguide_{$count_title}"
			            							title="{$list.title}"
			            							data-toggle="tab"
			            						>
			            							<h5>{$list.title}</h5>
			            						</a>	
			            					</li>

			            					{$count_title = $count_title + 1}
		            					{/foreach}
		            				{/if}
	            				</ul>
	            				<div class="tab-content">
	            					{if $show_default == 1}
	            						<div id="rb_sizeguide"  class="tab-pane rte fade active in">
	            							{$content_default nofilter}
	            						</div>
	            					{/if}

	            					{if !empty($lists)}
	            						{$count_content = 1}

	            						{foreach from=$lists item=list}
	            							<div
	            								id="rb_sizeguide_{$count_content}"
	            								class="tab-pane rte fade {if $show_default != 1 && $count_title == 1} active in{/if}"
	            							>
	            								{$list.content nofilter}
	            							</div>

	            							{$count_content = $count_content + 1}
	            						{/foreach}
	            					{/if}
	            				</div>
	            			</div>
            			</div>
            		{/if}
            	</div>
            </div>
		</div>
	</div>
</div>