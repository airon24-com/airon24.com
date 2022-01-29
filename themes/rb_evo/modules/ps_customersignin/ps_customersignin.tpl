{* 
* @Module Name: AP Page Builder
* @Website: rubiktheme.com - prestashop template provider
* @author rubiktheme <rubiktheme@gmail.com>
* @copyright rubiktheme
* @description: Rb Theme Dream is module help you can build content for your shop
*}
<div id="user_info">
    {if $logged}
        <a
                class="account"
                href="{$urls.pages.my_account}"
                title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
                rel="nofollow"
        >
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>{$customer.firstname|truncate:15:'...'}</span>
        </a> <span class="text-faded"> / </span>
        <a
                class="logout"
                href="{$urls.actions.logout}"
                rel="nofollow"
        >
            <span >{l s='Sign out' d='Shop.Theme.Actions'}</span>
        </a>
    {else}
        <a
        href="{$urls.pages.my_account}"
                title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
                rel="nofollow"
        ><i class="fa fa-user" aria-hidden="true"></i>
            <span>{l s='Sign in' d='Shop.Theme.Actions'}</span>
        </a>
    {/if}
</div>
