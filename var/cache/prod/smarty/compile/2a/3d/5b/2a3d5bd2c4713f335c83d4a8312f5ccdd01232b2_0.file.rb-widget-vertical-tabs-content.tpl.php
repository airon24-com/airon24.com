<?php
/* Smarty version 3.1.39, created on 2022-01-26 17:09:39
  from '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-vertical-tabs-content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f17243792f94_01659295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a3d5bd2c4713f335c83d4a8312f5ccdd01232b2' => 
    array (
      0 => '/home/daeovmkhla/domains/greenwat.eu/public_html/shop/modules/rbthemedream/views/templates/admin/widget/rb-widget-vertical-tabs-content.tpl',
      1 => 1641242528,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./rb-base.tpl' => 1,
  ),
),false)) {
function content_61f17243792f94_01659295 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:./rb-base.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>'vertical-tabs'), 0, false);
?>

<div class="rb-widget-container">
  <div class="rb-vertical-tab-wrapper rb-align-center">
    <# if ( settings.tabs.length > 0 ) { #>
      <div class="row">
        <div class="col-md-3">
          <ul class="nav nav-pills flex-column" role="tablist">
            <#
              let ran_id = (Math.random() + 1).toString(36).substring(7)
              let counter = 1;
              _.each(settings.tabs, function(item) {
            #>
              <a
                class="nav-link {{ counter == 1 ? 'active' : '' }}"
                id="{{ ran_id }}_{{ counter }}-tab"
                data-toggle="tab"
                href="#{{ ran_id }}_{{ counter }}"
                role="tab"
                aria-controls="{{ ran_id }}_{{ counter }}"
                aria-selected="true"
              >
                {{{ item.tab_title }}}
              </a>
            <#
                counter++;
              });
            #>
          </ul>
        </div>

        <div class="col-md-9">
          <div class="tab-content">
            <#
              let counter_1 = 1;
              _.each(settings.tabs, function(item) {
            #>
              <div
                class="tab-pane {{ counter_1 == 1 ? 'active' : '' }}"
                id="{{ ran_id }}_{{ counter_1 }}"
                role="tabpanel"
                aria-labelledby="{{ ran_id }}_{{ counter_1 }}-tab"
              >
                {{{ item.tab_content }}}
              </div>
            <#
                counter_1++;
              });
            #>
          </div>
        </div>
      </div>
    <# } else { #>
      <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No tabs','mod'=>'rbthemedream'),$_smarty_tpl ) );?>
</h2>
    <# } #>
  </div>
</div><?php }
}
