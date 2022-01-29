{* 
* @Module Name: AP Page Builder
* @Website: rubiktheme.com - prestashop template provider
* @author rubiktheme <rubiktheme@gmail.com>
* @copyright rubiktheme
* @description: Rb Theme Dream is module help you can build content for your shop
*}
<div id="header-user-btn" class="col col-auto header-btn-w header-user-btn-w">
    {if $logged}

        <a href="{$my_account_url}"
           title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
           rel="nofollow" class="header-btn header-user-btn">
            <i class="fa fa-user fa-fw icon" aria-hidden="true"></i>
            <span class="title">{$customer.firstname|truncate:15:'...'}</span>
        </a>
    {else}
        <a href="{$my_account_url}"
           title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
           rel="nofollow" class="header-btn header-user-btn">
            <i class="fa fa-user fa-fw icon" aria-hidden="true"></i>
            <span class="title">{l s='Sign in' d='Shop.Theme.Actions'}</span>
        </a>
    {/if}
</div>
