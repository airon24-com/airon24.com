{*
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($blog_title) && $blog_title != ''}
    <h4 class="title_block">{$blog_title}</h4>
{/if}

{if isset($blog_sub_title) && $blog_sub_title != ''}
    <p class="sub_title_block">{$blog_sub_title}</p>
{/if}

{if isset($posts) && count($posts)}
    {if $view == 'carousel'}
        <section class="rb-blog-posts rb-blog-posts-carousel rb-slick-slider rbthemeblog">
            <div class="rb-blog-carousel simpleblog-posts {$classes nofilter}" data-slider_options='{$options|@json_encode nofilter}'>
                {foreach $posts as $post}
                    <div class="simpleblog-posts-column">
                        <div class="blog-content">
                            {if isset($post.banner_thumb)}
                                <div class="rb-left-block">
                                    <div class="rb-blog-image-container">
                                        <a class="rb-blog-img-link" href="{$post.url}" title="{$post.title}" itemprop="url">
                                            <img class="img-fluid slick-loading" data-lazy="{$post.banner_thumb}" alt="{$post.title}" itemprop="image">
                                            <div class="rb-image-loading"></div>
                                        </a>
                                    </div>
                                </div>
                            {/if}

                            <div class="right-block">
                                <div class="rb-blog-meta">
                                    <h5 class="rb-blog-title" itemprop="name">
                                        <a href="{$post.url}" title="{$post.title}">{$post.title}</a>
                                    </h5>

                                    <div class="rb-date-block">
                                        <i class="material-icons">date_range</i>

                                        <span class="cate">
                                            <a href="{$post.category_rewrite}" title="{$post.category}">#{$post.category},</a>       
                                        </span>

                                        <span class="month">
                                            {assign var='blog_month' value=strtotime($post.date_add)|date_format:"%b"}
                                            {l s=$blog_month mod='rbthemeblog'}
                                        </span>

                                        <span class="day">
                                            {assign var='blog_day' value=strtotime($post.date_add)|date_format:"%e"}    
                                            {l s=$blog_day mod='rbthemeblog'},           
                                        </span>

                                        <span class="year">
                                            {assign var='blog_year' value=strtotime($post.date_add)|date_format:"%Y"}       
                                            {l s=$blog_year mod='rbthemeblog'}
                                        </span>
                                    </div>

                                    <div class="rb-blog-desc" itemprop="description">
                                        {$post.short_content nofilter}
                                    </div>

                                    <div class="rb-more">
                                        <a href="{$post.url}" title="{$post.title}" class="post-btn-more">{l s='Read More' mod='rbthemedream'}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        </section>
    {else}
        <section class="rb-blog-posts rb-blog-posts-grid rbthemeblog">
            <div class="row simpleblog-posts">
                {foreach $posts as $post}
                    <div class="simpleblog-posts-column {$options.gridClasses nofilter}">
                        <div class="simpleblog-posts-column">
                            <div class="blog-content">
                                {if isset($post.banner_thumb)}
                                    <div class="rb-left-block">
                                        <div class="rb-blog-image-container">
                                            <a class="rb-blog-img-link" href="{$post.url}" title="{$post.title}" itemprop="url">
                                                <img class="img-fluid" src="{$post.banner_thumb}" alt="{$post.title}" itemprop="image">
                                            </a>
                                        </div>
                                    </div>
                                {/if}

                                <div class="right-block">
                                    <div class="rb-blog-meta">
                                        <h5 class="rb-blog-title" itemprop="name">
                                            <a href="{$post.url}" title="{$post.title}">{$post.title}</a>
                                        </h5>

                                        <div class="rb-blog-desc" itemprop="description">
                                            {$post.short_content nofilter}
                                        </div>


                                        <div class="rb-date-block">
                                            <i class="material-icons">date_range</i>

                                            <span class="cate">
                                                <a href="{$post.category_rewrite}" title="{$post.category}">#{$post.category},</a>       
                                            </span>

                                            <span class="month">
                                                {assign var='blog_month' value=strtotime($post.date_add)|date_format:"%b"}
                                                {l s=$blog_month mod='rbthemeblog'}
                                            </span>

                                            <span class="day">
                                                {assign var='blog_day' value=strtotime($post.date_add)|date_format:"%e"}    
                                                {l s=$blog_day mod='rbthemeblog'}           
                                            </span>

                                            <span class="year">
                                                {assign var='blog_year' value=strtotime($post.date_add)|date_format:"%Y"}       
                                                {l s=$blog_year mod='rbthemeblog'}
                                            </span>
                                        </div>

                                        <div class="rb-more">
                                            <a href="{$post.url}" title="{$post.title}" class="post-btn-more">{l s='Read More' mod='rbthemedream'}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        </section>
    {/if}
    <div>
        <div class="blog-viewall">
            <a class="btn" href="{$rb_list_blog}" title="View All">{l s='View All' mod='rbthemedream'}</a>
        </div>
    </div>
{/if}