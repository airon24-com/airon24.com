{* 
* @Module Name: AP Page Builder
* @Website: rubiktheme.com - prestashop template provider
* @author rubiktheme <rubiktheme@gmail.com>
* @copyright rubiktheme
* @description: Rb Theme Dream is module help you can build content for your shop
*}
{if isset($listing.rendered_facets)}
    <div id="facets_search_wrapper">
        <div id="search_filters_wrapper" class="hidden-sm-down">
            <div id="search_filter_controls" class="hidden-md-up">
                <button data-search-url="" class="btn btn-secondary btn-sm js-search-filters-clear-all">
                        <i class="fa fa-times" aria-hidden="true"></i>{l s='Clear all' d='Shop.Theme.Actions'}
                </button>
                <button class="btn btn-primary btn-lg ok">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    {l s='OK' d='Shop.Theme.Actions'}
                </button>
            </div>
            <div class="block block-facets">
                {$listing.rendered_facets nofilter}
            </div>
        </div>
    </div>
{/if}
