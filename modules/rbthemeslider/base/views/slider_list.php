<?php
/**
* 2007-2021 PrestaShop
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
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

defined('_PS_VERSION_') or exit;

// Get screen options
$rbScreenOptions = rb_get_option('rb-screen-options', '0');
$rbScreenOptions = ($rbScreenOptions == 0) ? array() : $rbScreenOptions;
$rbScreenOptions = is_array($rbScreenOptions) ? $rbScreenOptions : unserialize($rbScreenOptions);

// Defaults
if (!isset($rbScreenOptions['showTooltips'])) {
    $rbScreenOptions['showTooltips'] = 'true';
}
if (!isset($rbScreenOptions['numberOfSliders'])) {
    $rbScreenOptions['numberOfSliders'] = '25';
}

// Get current page
$curPage = (!empty(${'_GET'}['paged']) && is_numeric(${'_GET'}['paged'])) ? (int) ${'_GET'}['paged'] : 1;
// $curPage = ($curPage >= $maxPage) ? $maxPage : $curPage;

// Set filters
$userFilters = false;
$showAllSlider = false;

$urlParamFilter = 'published';
$urlParamOrder     = 'date_c';
$urlParamTerm     = '';

$filters = array(
    'orderby' => 'date_c',
    'order' => 'DESC',
    'page' => $curPage,
    'limit' => (int) $rbScreenOptions['numberOfSliders']
);

if (! empty(${'_GET'}['filter']) && ${'_GET'}['filter'] === 'all') {
    $userFilters = true;
    $showAllSlider = true;
    $urlParamFilter = htmlentities(${'_GET'}['filter']);
    $filters['exclude'] = array();
}

if (! empty(${'_GET'}['order'])) {
    $userFilters = true;
    $urlParamOrder = ${'_GET'}['order'];
    $filters['orderby'] = htmlentities(${'_GET'}['order']);

    if (${'_GET'}['order'] === 'name') {
        $filters['order'] = 'ASC';
    }
}

if (! empty(${'_GET'}['term'])) {
    $userFilters = true;
    $urlParamTerm = htmlentities(${'_GET'}['term']);
    $filters['where'] = "name LIKE '%".rb_esc_sql(${'_GET'}['term'])."%' OR slug LIKE '%".rb_esc_sql(${'_GET'}['term'])."%'";
}

// Find sliders
$sliders = RbSliders::find($filters);

// Pager
$maxItem = RbSliders::$count;
$maxPage = ceil($maxItem / (int) $rbScreenOptions['numberOfSliders']);
$maxPage = $maxPage ? $maxPage : 1;

$layout = rb_get_user_meta(rb_get_current_user_id(), 'rb-sliders-layout', true);

// Custom capability
$custom_capability = $custom_role = rb_get_option('RbthemeSlider_custom_capability', 'manage_options');
$default_capabilities = array('manage_network', 'manage_options', 'publish_pages', 'publish_posts', 'edit_posts');

if (in_array($custom_capability, $default_capabilities)) {
    $custom_capability = '';
} else {
    $custom_role = 'custom';
}


// Site activation
$code         = rb_get_option('RbthemeSlider-purchase-code', '');
$validity     = rb_get_option('RbthemeSlider-authorized-site', false);
$channel     = rb_get_option('RbthemeSlider-release-channel', 'stable');

// Purchase code
$codeFormatted = '';
if (!empty($code)) {
    $start = Tools::substr($code, 0, -6);
    $end = Tools::substr($code, -6);
    $codeFormatted = preg_replace("/[a-zA-Z0-9]/", '●', $start) . $end;
    $codeFormatted = str_replace('-', ' ', $codeFormatted);
}

// Google Fonts
$googleFonts         = rb_get_option('rb-google-fonts', array());
$googleFontScripts     = rb_get_option('rb-google-font-scripts', array('latin', 'latin-ext'));


// Template store data
$rbStoreUpdate         = rb_get_option('rb-store-last-updated', 0);
$rbStoreData         = rb_get_option('rb-store-data', false);
$rbStoreInterval     = ! empty($rbStoreData) ? DAY_IN_SECONDS : HOUR_IN_SECONDS;
$rbStoreLastViewed     = rb_get_user_meta(rb_get_current_user_id(), 'rb-store-last-viewed', true);

// Update last visited date
if (empty($rbStoreLastViewed)) {
    $rbStoreLastViewed = time();
    rb_update_user_meta(rb_get_current_user_id(), 'rb-store-last-viewed', date('Y-m-d'));
}

// Update store data
if ($rbStoreUpdate < time() - $rbStoreInterval) {
    // Refresh update time
    rb_update_option('rb-store-last-updated', time());
    $rbStoreUpdate = time();

    // Set update data
    $data = rb_remote_retrieve_body(rb_remote_get(sprintf('%ssliders/', RB_REPO_BASE_URL, RB_MARKETPLACE_ID)));
    $rbStoreData = ! empty($data) ? Tools::jsonDecode($data, true) : array();
    rb_update_option('rb-store-data', $rbStoreData, false);
}

$rbStoreHasUpdate = !empty($rbStoreData['last_updated']) && $rbStoreLastViewed < $rbStoreData['last_updated'];

$importSliderCount = !empty(${'_GET'}['sliderCount']) ? (int)${'_GET'}['sliderCount'] : 0;

// Notification messages
$notifications = array(

    'cacheEmpty' => rb__('Successfully emptied Rb Theme Slider caches.', 'RbthemeSlider'),
    'updateStore' => rb__('Successfully updated the Template Store library.', 'RbthemeSlider'),

    'removeSelectError' => rb__('No sliders were selected to remove.', 'RbthemeSlider'),
    'removeSuccess' => rb__('The selected sliders were removed.', 'RbthemeSlider'),

    'duplicateSuccess' => rb__('The selected sliders were duplicated.', 'RbthemeSlider'),

    'deleteSelectError' => rb__('No sliders were selected.', 'RbthemeSlider'),
    'deleteSuccess' => rb__('The selected sliders were permanently deleted.', 'RbthemeSlider'),
    'mergeSelectError' => rb__('You need to select at least 2 sliders to merge them.', 'RbthemeSlider'),
    'mergeSuccess' => rb__('The selected items were merged together as a new slider.', 'RbthemeSlider'),
    'restoreSelectError' => rb__('No sliders were selected.', 'RbthemeSlider'),
    'restoreSuccess' => rb__('The selected sliders were restored.', 'RbthemeSlider'),

    'exportNotFound' => rb__('No sliders were found to export.', 'RbthemeSlider'),
    'exportSelectError' => rb__('No sliders were selected to export.', 'RbthemeSlider'),
    'exportZipError' => rb__('The PHP ZipArchive extension is required to import .zip files.', 'RbthemeSlider'),

    'importSelectError' => rb__('Choose a file to import sliders.', 'RbthemeSlider'),
    'importFailed' => rb__('The import file seems to be invalid or corrupted.', 'RbthemeSlider'),
    'importSuccess' => sprintf(rb_n('%d slider has been successfully imported.', '%d sliders has been successfully imported.', $importSliderCount, 'RbthemeSlider'), $importSliderCount),

    'permissionError' => rb__('Your account does not have the necessary permission you have chosen, and your settings have not been saved in order to prevent locking yourself out of the plugin.', 'RbthemeSlider'),
    'permissionSuccess' => rb__('Permission changes has been updated.', 'RbthemeSlider'),
    'googleFontsUpdated' => rb__('Your Google Fonts library has been updated.', 'RbthemeSlider'),
    'generalUpdated' => rb__('Your settings has been updated.', 'RbthemeSlider')
);
?>

<script type="text/javascript">
    window.rbSiteActivation = <?php echo ! empty($validity) ? 'true' : 'false' ?>;
</script>

<div id="rb-screen-options" class="metabox-prefs hidden">
    <div id="screen-options-wrap" class="hidden">
        <form id="rb-screen-options-form" method="post" novalidate>
            <?php rb_nonce_field('rb-save-screen-options'); ?>
            <h5><?php rb_e('Show on screen', 'RbthemeSlider') ?></h5>
            <label><input type="checkbox" name="showTooltips"<?php echo $rbScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php rb_e('Tooltips', 'RbthemeSlider') ?></label><br><br>

            <?php rb_e('Show me', 'RbthemeSlider') ?> <input type="number" name="numberOfSliders" min="8" step="4" value="<?php echo $rbScreenOptions['numberOfSliders'] ?>"> <?php rb_e('sliders per page', 'RbthemeSlider') ?>
            <button class="button"><?php rb_e('Apply', 'RbthemeSlider') ?></button>
        </form>
    </div>
    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="show-settings-link" class="button show-settings" aria-controls="screen-options-wrap" aria-expanded="false"><?php rb_e('Screen Options', 'RbthemeSlider') ?></button>
    </div>
</div>


<div id="rb-guides" class="metabox-prefs">
    <div id="rb-guides-wrap" class="hidden">
        <h5><?php rb_e('Interactive guides coming soon!', 'RbthemeSlider') ?></h5>
        <p><?php rb_e("Interactive step-by-step tutorial guides will shortly arrive to help you get started using RbthemeSlider.", 'RbthemeSlider') ?></p>
    </div>
    <div id="show-guides-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="show-guides-link" class="button show-settings" aria-controls="rb-guides-wrap" aria-expanded="false"><?php rb_e('Guides', 'RbthemeSlider') ?></button>
    </div>
</div>

<!-- WP hack to place notification at the top of page -->
<div class="wrap rb-wp-hack">
    <h2></h2>

    <!-- Error messages -->
    <?php if (isset(${'_GET'}['message'])) : ?>
        <div class="rb-notification large <?php echo isset(${'_GET'}['error']) ? 'error' : 'updated' ?>">
            <div><?php echo $notifications[ ${'_GET'}['message'] ] ?></div>
        </div>
    <?php endif; ?>
    <!-- End of error messages -->
</div>

<div class="wrap" id="rb-list-page">
    <h2>Rb Theme Slider - <?php rb_e('Your sliders', 'RbthemeSlider') ?></h2>

    <!-- Beta version -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-beta-feedback.php'; ?>

    <!-- Add slider template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-add-slider-list.php'; ?>
    <?php include RB_ROOT_PATH . '/templates/tmpl-add-slider-grid.php'; ?>

    <!-- Import sample sliders template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-import-templates.php'; ?>

    <!-- Importing template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-importing.php'; ?>

    <!-- Import sample sliders template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-upload-sliders.php'; ?>

    <!-- Embed slider template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-embed-slider.php'; ?>

    <!-- Share sheet template -->
    <?php include RB_ROOT_PATH . '/templates/tmpl-share-sheet.php'; ?>



    <!-- Slider Filters -->
    <form method="get" id="rb-slider-filters">
        <input type="hidden" name="page" value="RbthemeSlider">
        <div class="layout">
            <a href="?page=AdminRbthemesliderSlider&amp;action=layout&amp;type=list" data-help="<?php rb_e('List View', 'RbthemeSlider') ?>" class="dashicons dashicons-list-view"></a>
            <a href="?page=AdminRbthemesliderSlider&amp;action=layout&amp;type=grid" data-help="<?php rb_e('Grid View', 'RbthemeSlider') ?>" class="dashicons dashicons-grid-view"></a>
        </div>
        <div class="filter">
            <?php rb_e('Show', 'RbthemeSlider') ?>
            <select name="filter">
                <option value="published"><?php rb_e('published', 'RbthemeSlider') ?></option>
                <option value="all" <?php echo $showAllSlider ? 'selected' : '' ?>><?php rb_e('all', 'RbthemeSlider') ?></option>
            </select>
            <?php rb_e('sliders', 'RbthemeSlider') ?>
        </div>
        <div class="sort">
            <?php rb_e('Sort by', 'RbthemeSlider') ?>
            <select name="order">
                <option value="name" <?php echo ($filters['orderby'] === 'name') ? 'selected' : '' ?>><?php rb_e('name', 'RbthemeSlider') ?></option>
                <option value="date_c" <?php echo ($filters['orderby'] === 'date_c') ? 'selected' : '' ?>><?php rb_e('date created', 'RbthemeSlider') ?></option>
                <option value="date_m" <?php echo ($filters['orderby'] === 'date_m') ? 'selected' : '' ?>><?php rb_e('date modified', 'RbthemeSlider') ?></option>
                <option value="schedule_start" <?php echo ($filters['orderby'] === 'schedule_start') ? 'selected' : '' ?>><?php rb_e('date scheduled', 'RbthemeSlider') ?></option>
            </select>
        </div>

        <div class="right">
            <input type="search" name="term" placeholder="<?php rb_e('Filter by name', 'RbthemeSlider') ?>" value="<?php echo ! empty(${'_GET'}['term']) ? htmlentities(${'_GET'}['term']) : '' ?>">
            <button class="button"><?php rb_e('Search', 'RbthemeSlider') ?></button>
        </div>
    </form>

    <form method="post" class="rb-slider-list-form">
        <input type="hidden" name="rb-bulk-action" value="1">
        <?php rb_nonce_field('bulk-action'); ?>

        <div>

        <!-- List View -->
        <?php if ($layout === 'list') : ?>
            <div class="rb-sliders-list">

                <a class="button import-templates <?php echo $rbStoreHasUpdate ? 'has-updates' : '' ?>" href="#" id="rb-import-samples-button">
                    <i class="import dashicons dashicons-star-filled"></i>
                    <span><?php rb_e('Template Store', 'RbthemeSlider') ?></span>
                </a>

                <a class="button" href="#" id="rb-import-button">
                    <i class="import dashicons dashicons-upload"></i>
                    <span><?php rb_e('Import Sliders', 'RbthemeSlider') ?></span>
                </a>

                <a class="button" href="#" id="rb-add-slider-button">
                    <i class="add dashicons dashicons-plus"></i>
                    <span><?php rb_e('Add New Slider', 'RbthemeSlider') ?></span>
                </a>

                <?php if (! empty($sliders)) : ?>
                    <?php $hooks = rb_get_hook_list(); ?>
                    <div class="rb-box">
                        <table>
                            <thead class="header">
                                <tr>
                                    <td></td>
                                    <td><?php rb_e('ID', 'RbthemeSlider') ?></td>
                                    <td class="preview-td"><?php rb_e('Slider preview', 'RbthemeSlider') ?></td>
                                    <td><?php rb_e('Name', 'RbthemeSlider') ?></td>
                                    <td><?php rb_e('Module Position', 'RbthemeSlider') ?></td>
                                    <td class="center"><?php rb_e('Shortcode', 'RbthemeSlider') ?></td>
                                    <td><?php rb_e('Slides', 'RbthemeSlider') ?></td>
                                    <td><?php rb_e('Created', 'RbthemeSlider') ?></td>
                                    <td><?php rb_e('Modified', 'RbthemeSlider') ?></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($sliders as $key => $item) :
                                $class = ($item['flag_deleted'] == '1') ? ' dimmed' : '';
                                $preview = rb_apply_filters('rb_preview_for_slider', $item); ?>
                                <tr class="slider-item<?php echo $class ?>" data-id="<?php echo $item['id'] ?>" data-slug="<?php echo htmlentities($item['slug']) ?>">
                                    <td><input type="checkbox" name="sliders[]" value="<?php echo $item['id'] ?>"></td>
                                    <td><span><?php echo $item['id'] ?></span></td>
                                    <td class="preview-td">
                                        <a class="preview" style="background-image: url(<?php echo  ! empty($preview) ? $preview : RB_VIEWS_URL . 'img/admin/blank.gif' ?>);" href="?page=AdminRbthemesliderSlider&action=edit&id=<?php echo $item['id'] ?>">

                                        </a>
                                    </td>
                                    <td class="name">
                                        <a href="?page=AdminRbthemesliderSlider&action=edit&id=<?php echo $item['id'] ?>">
                                            <?php echo rb_apply_filters('rb_slider_title', _ss($item['name']), 40) ?>
                                        </a>
                                    </td>
                                    <td class="hook">
                                        <?php $hook = isset($item['data']['properties']['hook']) ? $item['data']['properties']['hook'] : '' ?>
                                        <input type="text" placeholder="<?php rb_e('- None -') ?>" class="km-combo-input" value="<?php echo $hook ?>" data-value="<?php echo $hook ?>" data-options='<?php echo $hooks ?>' data-hook="<?php echo $hook ?>" />
                                        <i class="dashicons dashicons-update rb-hook-update"></i>
                                    </td>
                                    <td class="center"><input type="text" class="rb-shortcode" value="[RbthemeSlider id=&quot;<?php echo !empty($item['slug']) ? $item['slug'] : $item['id'] ?>&quot;]" readonly></td>
                                    <td><span><?php echo isset($item['data']['layers']) ? count($item['data']['layers']) : 0 ?></span></td>
                                    <td><span><?php echo date('d/m/y', $item['date_c']) ?></span></td>
                                    <td><span><?php echo rb_human_time_diff($item['date_m']) ?> <?php rb_e('ago', 'RbthemeSlider') ?></span></td>
                                    <td class="center">
                                    <?php if (!$item['flag_deleted']) : ?>
                                        <span class="slider-actions dashicons dashicons-arrow-down-alt2"
                                            data-id="<?php echo $item['id'] ?>"
                                            data-slug="<?php echo htmlentities($item['slug']) ?>"
                                            data-export-url="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=export&id='.$item['id'], 'export-sliders') ?>"
                                            data-duplicate-url="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=duplicate&id='.$item['id'], 'duplicate_'.$item['id']) ?>"
                                            data-revisions-url="<?php echo rb_admin_url('admin.php?page=rb-revisions&id='.$item['id']) ?>"
                                            data-remove-url="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=remove&id='.$item['id'], 'remove_'.$item['id']) ?>">
                                        </span>
                                    <?php else : ?>
                                        <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=restore&id='.$item['id'], 'restore_'.$item['id']) ?>">
                                            <span class="dashicons dashicons-backup" data-help="<?php rb_e('Restore removed slider', 'RbthemeSlider') ?>"></span>
                                        </a>
                                    <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Slider actions template -->
                        <div id="rb-slider-actions-template" class="rb-pointer rb-box rb-hidden">
                            <span class="rb-mce-arrow"></span>
                            <ul class="inner">
                                <li>
                                    <a href="#" class="embed">
                                        <i class="dashicons dashicons-plus"></i>
                                        <?php rb_e('Embed Slider', 'RbthemeSlider') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="dashicons dashicons-share-alt2"></i>
                                        <?php rb_e('Export', 'RbthemeSlider') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="dashicons dashicons-admin-page"></i>
                                        <?php rb_e('Duplicate', 'RbthemeSlider') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="dashicons dashicons-backup"></i>
                                        <?php rb_e('Revisions', 'RbthemeSlider') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="remove">
                                        <i class="dashicons dashicons-trash"></i>
                                        <?php rb_e('Remove', 'RbthemeSlider') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End of Slider actions template -->
                    </div>
                <?php endif ?>
            </div>
        <?php else : ?>
            <!-- Slider List -->
            <div class="rb-sliders-grid clearfix">

                <div class="slider-item hero import-templates <?php echo $rbStoreHasUpdate ? 'has-updates' : '' ?>">
                    <div class="slider-item-wrapper">
                        <a href="#" id="rb-import-samples-button" class="preview import-templates <?php echo $rbStoreHasUpdate ? 'has-updates' : '' ?>">
                            <i class="import dashicons dashicons-star-filled"></i>
                            <span><?php rb_e('Template Store', 'RbthemeSlider') ?></span>
                        </a>
                    </div>
                </div>
                <div class="slider-item hero">
                    <div class="slider-item-wrapper">
                        <a href="#" id="rb-import-button" class="preview">
                            <i class="import dashicons dashicons-upload"></i>
                            <span><?php rb_e('Import Sliders', 'RbthemeSlider') ?></span>
                        </a>
                    </div>
                </div>
                <div class="slider-item hero">
                    <div class="slider-item-wrapper">
                        <a href="#" id="rb-add-slider-button" class="preview">
                            <i class="add dashicons dashicons-plus"></i>
                            <span><?php rb_e('Add New Slider', 'RbthemeSlider') ?></span>
                        </a>
                    </div>
                </div>
                <?php if (! empty($sliders)) : ?>
                    <?php foreach ($sliders as $key => $item) :
                        $class = ($item['flag_deleted'] == '1') ? 'dimmed' : '';
                        $preview = rb_apply_filters('rb_preview_for_slider', $item); ?>
                        <div class="slider-item <?php echo $class ?>">
                            <div class="slider-item-wrapper">
                                <input type="checkbox" name="sliders[]" class="checkbox rb-hover" value="<?php echo $item['id'] ?>">
                                <?php if (!$item['flag_deleted']) : ?>
                                    <span class="rb-hover slider-actions dashicons dashicons-arrow-down-alt2"></span>
                                <?php else : ?>
                                    <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=restore&id='.$item['id'], 'restore_'.$item['id']) ?>">
                                        <span class="rb-hover dashicons dashicons-backup" data-help="<?php rb_e('Restore removed slider', 'RbthemeSlider') ?>"></span>
                                    </a>
                                <?php endif; ?>
                                <a class="preview" style="background-image: url(<?php echo  ! empty($preview) ? $preview : RB_VIEWS_URL . 'img/admin/blank.gif' ?>);" href="<?php echo rb_admin_url('?page=AdminRbthemesliderSlider&action=edit&id='.$item['id']) ?>">
                                <?php if (empty($preview)) : ?>
                                    <div class="no-preview">
                                        <h5><?php rb_e('No Preview', 'RbthemeSlider') ?></h5>
                                        <small><?php rb_e('Previews are automatically generated from slide images in sliders.', 'RbthemeSlider') ?></small>
                                    </div>
                                <?php endif ?>
                                </a>
                                <div class="info">
                                    <div class="name">
                                        <?php echo rb_apply_filters('rb_slider_title', _ss($item['name']), 40) ?>
                                    </div>
                                </div>

                                <ul class="slider-actions-sheet rb-hidden">
                                    <li>
                                        <a href="#" class="embed" data-id="<?php echo $item['id'] ?>" data-slug="<?php echo htmlentities($item['slug']) ?>">
                                            <i class="dashicons dashicons-plus" data-hook="<?php echo isset($item['data']['properties']['hook']) ? $item['data']['properties']['hook'] : '' ?>"></i>
                                            <?php rb_e('Embed Slider', 'RbthemeSlider') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=export&id='.$item['id'], 'export-sliders') ?>">
                                            <i class="dashicons dashicons-share-alt2"></i>
                                            <?php rb_e('Export', 'RbthemeSlider') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=duplicate&id='.$item['id'], 'duplicate_'.$item['id']) ?>">
                                            <i class="dashicons dashicons-admin-page"></i>
                                            <?php rb_e('Duplicate', 'RbthemeSlider') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo rb_admin_url('admin.php?page=rb-revisions&id='.$item['id']) ?>">
                                            <i class="dashicons dashicons-backup"></i>
                                            <?php rb_e('Revisions', 'RbthemeSlider') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=remove&id='.$item['id'], 'remove_'.$item['id']) ?>" class="remove">
                                            <i class="dashicons dashicons-trash"></i>
                                            <?php rb_e('Remove', 'RbthemeSlider') ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <!-- No Slider Notification -->
        <?php if (empty($sliders)) : ?>
            <div id="rb-no-sliders">
                <div class="rb-notification-info">
                    <i class="dashicons dashicons-info"></i>
                    <?php if ($userFilters) : ?>
                        <span><?php echo sprintf(rb__('No sliders found with the current filters set. %sClick here%s to reset filters.', 'RbthemeSlider'), '<a href="?page=AdminRbthemesliderSlider">', '</a>') ?></span>
                    <?php else : ?>
                        <span><?php echo sprintf(rb__('Add a new slider or check out the %sTemplate Store%s to get started using RbthemeSlider.', 'RbthemeSlider'), '<a href="#" class="rb-open-template-store"><i class="dashicons dashicons-star-filled"></i>', '</a>') ?></span>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
        </div>



        <?php if (! empty($sliders)) : ?>
            <div>
                <div class="rb-bulk-actions">
                    <select name="action">
                        <option value="0"><?php rb_e('Bulk Actions', 'RbthemeSlider') ?></option>
                        <option value="export"><?php rb_e('Export selected', 'RbthemeSlider') ?></option>
                        <option value="remove"><?php rb_e('Remove selected', 'RbthemeSlider') ?></option>
                        <option value="delete"><?php rb_e('Delete permanently', 'RbthemeSlider') ?></option>
                        <?php if ($showAllSlider) : ?>
                            <option value="restore"><?php rb_e('Restore selected', 'RbthemeSlider') ?></option>
                        <?php endif; ?>
                        <option value="merge"><?php rb_e('Merge selected as new', 'RbthemeSlider') ?></option>
                    </select>
                    <button class="button"><?php rb_e('Apply', 'RbthemeSlider') ?></button>
                </div>
                <div class="rb-pagination bottom">
                    <div class="tablenav-pages">
                        <span class="displaying-num"><?php echo sprintf(rb_n('%d slider', '%d sliders', $maxItem, 'RbthemeSlider'), $maxItem) ?></span>
                        <span class="pagination-links">
                            <a class="button first-page<?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the first page" href="admin.php?page=AdminRbthemesliderSlider&amp;filter=<?php echo $urlParamFilter ?>&amp;term=<?php echo $urlParamTerm ?>&amp;order=<?php echo $urlParamOrder ?>">«</a>
                            <a class="button prev-page <?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the previous page" href="admin.php?page=AdminRbthemesliderSlider&amp;paged=<?php echo ($curPage-1) ?>&amp;filter=<?php echo $urlParamFilter ?>&amp;term=<?php echo $urlParamTerm ?>&amp;order=<?php echo $urlParamOrder ?>">‹</a>

                            <span class="total-pages"><?php echo sprintf(rb__('%1$d of %2$d', 'RbthemeSlider'), $curPage, $maxPage) ?> </span>

                            <a class="button next-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the next page" href="admin.php?page=AdminRbthemesliderSlider&amp;paged=<?php echo ($curPage+1) ?>&amp;filter=<?php echo $urlParamFilter ?>&amp;term=<?php echo $urlParamTerm ?>&amp;order=<?php echo $urlParamOrder ?>">›</a>
                            <a class="button last-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the last page" href="admin.php?page=AdminRbthemesliderSlider&amp;paged=<?php echo $maxPage ?>&amp;filter=<?php echo $urlParamFilter ?>&amp;term=<?php echo $urlParamTerm ?>&amp;order=<?php echo $urlParamOrder ?>">»</a>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </form>


    <div class="km-tabs rb-plugin-settings-tabs">
        <a href="#" class="active"><?php rb_e('Google Fonts', 'RbthemeSlider') ?></a>
        <a href="#"><?php rb_e('Advanced', 'RbthemeSlider') ?></a>
    </div>
    <div class="km-tabs-content rb-plugin-settings">

        <!-- Google Fonts -->
        <div class="active">
            <figure><?php rb_e('Choose from hundreds of custom fonts faces provided by Google Fonts', 'RbthemeSlider') ?></figure>
            <form method="post" class="rb-box km-tabs-inner rb-google-fonts">
                <?php rb_nonce_field('save-google-fonts'); ?>
                <input type="hidden" name="rb-save-google-fonts" value="1">

                <!-- Google Fonts list -->
                <div class="inner">
                    <ul class="rb-font-list">
                        <li class="rb-hidden">
                            <a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
                            <input type="text" data-name="urlParams" readonly>
                            <input type="checkbox" data-name="onlyOnAdmin">
                            <?php rb_e('Load only on admin interface', 'RbthemeSlider') ?>
                        </li>
                        <?php if (is_array($googleFonts) && !empty($googleFonts)) : ?>
                            <?php foreach ($googleFonts as $item) : ?>
                                <li>
                                    <a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
                                    <input type="text" data-name="urlParams" value="<?php echo htmlspecialchars($item['param']) ?>" readonly>
                                    <input type="checkbox" data-name="onlyOnAdmin" <?php echo $item['admin'] ? ' checked="checked"' : '' ?>>
                                    <?php rb_e('Load only on admin interface', 'RbthemeSlider') ?>
                                </li>
                            <?php endforeach ?>
                        <?php else : ?>
                            <li class="rb-notice"><?php rb_e("You haven't added any Google font to your library yet.", "RbthemeSlider") ?></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="inner rb-font-search">

                    <input type="text" placeholder="<?php rb_e('Enter a font name to add to your collection', 'RbthemeSlider') ?>">
                    <button class="button"><?php rb_e('Search', 'RbthemeSlider') ?></button>

                    <!-- Google Fonts search pointer -->
                    <div class="rb-box rb-pointer">
                        <h3 class="header"><?php rb_e('Choose a font family', 'RbthemeSlider') ?></h3>
                        <div class="fonts">
                            <ul class="inner"></ul>
                        </div>
                        <div class="variants">
                            <ul class="inner"></ul>
                            <div class="inner">
                                <button class="button add-font"><?php rb_e('Add font', 'RbthemeSlider') ?></button>
                                <button class="button right"><?php rb_e('Back to results', 'RbthemeSlider') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Fonts search bar -->
                <div class="inner footer">
                    <button type="submit" class="button"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
                    <?php
                    $scripts = array(
                        'arabic' => rb__('Arabic', 'RbthemeSlider'),
                        'bengali' => rb__('Bengali', 'RbthemeSlider'),
                        'cyrillic' => rb__('Cyrillic', 'RbthemeSlider'),
                        'cyrillic-ext' => rb__('Cyrillic Extended', 'RbthemeSlider'),
                        'devanagari' => rb__('Devanagari', 'RbthemeSlider'),
                        'greek' => rb__('Greek', 'RbthemeSlider'),
                        'greek-ext' => rb__('Greek Extended', 'RbthemeSlider'),
                        'gujarati' => rb__('Gujarati', 'RbthemeSlider'),
                        'gurmukhi' => rb__('Gurmukhi', 'RbthemeSlider'),
                        'hebrew' => rb__('Hebrew', 'RbthemeSlider'),
                        'kannada' => rb__('Kannada', 'RbthemeSlider'),
                        'khmer' => rb__('Khmer', 'RbthemeSlider'),
                        'latin' => rb__('Latin', 'RbthemeSlider'),
                        'latin-ext' => rb__('Latin Extended', 'RbthemeSlider'),
                        'malayalam' => rb__('Malayalam', 'RbthemeSlider'),
                        'myanmar' => rb__('Myanmar', 'RbthemeSlider'),
                        'oriya' => rb__('Oriya', 'RbthemeSlider'),
                        'sinhala' => rb__('Sinhala', 'RbthemeSlider'),
                        'tamil' => rb__('Tamil', 'RbthemeSlider'),
                        'telugu' => rb__('Telugu', 'RbthemeSlider'),
                        'thai' => rb__('Thai', 'RbthemeSlider'),
                        'vietnamese' => rb__('Vietnamese', 'RbthemeSlider')
                    );
                    ?>
                    <div class="right">
                        <div>
                            <select>
                                <option><?php rb_e('Select new', 'RbthemeSlider') ?></option>
                                <?php foreach ($scripts as $key => $val) : ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <ul class="rb-google-font-scripts">
                            <li class="rb-hidden">
                                <span></span>
                                <a href="#" class="dashicons dashicons-dismiss" title="<?php rb_e('Remove character set', 'RbthemeSlider') ?>"></a>
                                <input type="hidden" name="scripts[]" value="">
                            </li>
                            <?php if (!empty($googleFontScripts) && is_array($googleFontScripts)) : ?>
                                <?php foreach ($googleFontScripts as $item) : ?>
                                    <li>
                                        <span><?php echo $scripts[$item] ?></span>
                                        <a href="#" class="dashicons dashicons-dismiss" title="<?php rb_e('Remove character set', 'RbthemeSlider') ?>"></a>
                                        <input type="hidden" name="scripts[]" value="<?php echo $item ?>">
                                    </li>
                                <?php endforeach ?>
                            <?php else : ?>
                                <li>
                                    <span>Latin</span>
                                    <a href="#" class="dashicons dashicons-dismiss" title="<?php rb_e('Remove character set', 'RbthemeSlider') ?>"></a>
                                    <input type="hidden" name="scripts[]" value="latin">
                                </li>
                            <?php endif ?>
                        </ul>
                        <div><?php rb_e('Use character sets:', 'RbthemeSlider') ?></div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Advanced -->
        <div class="rb-global-settings">
            <figure>
                <?php rb_e('Troubleshooting &amp; Advanced Settings', 'RbthemeSlider') ?>
                <span class="warning"><?php rb_e("Don't change these options without experience, incorrect settings might break your site.", "RbthemeSlider") ?></span>
            </figure>
            <form method="post" class="rb-box km-tabs-inner">
                <?php rb_nonce_field('save-advanced-settings'); ?>
                <input type="hidden" name="rb-save-advanced-settings">

                <table>
                    <tr class="rb-cache-options">
                        <td><?php rb_e('Use slider markup caching', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="use_cache" <?php echo rb_get_option('rb_use_cache', true) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc">
                            <?php rb_e('Enabled caching can drastically increase the plugin performance and spare your server from unnecessary load.', 'RbthemeSlider') ?>
                            <a href="<?php echo rb_nonce_url('?page=AdminRbthemesliderSlider&action=empty_caches', 'empty_caches') ?>" class="button button-small"><?php rb_e('Empty caches', 'RbthemeSlider') ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Save slide histories', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="save_history" <?php echo rb_get_option('rb_save_history', false) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e("Save slide histories (undo, redo) with slider data. Isn't recommanded when post_max_size is small.", 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Load uncompressed JS files', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="load_unpacked" <?php echo rb_get_option('rb_load_unpacked', false) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e('Enable this option if you want to debug the code.', 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Load FontAwesome library', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="load_fontawesome" <?php echo rb_get_option('rb_load_fontawesome', true) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e('Disable this option if the FontAwesome library is already loaded by another addon, to prevent duplicated loading.', 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Use multiple GreenSock (GSAP) compatibility mode', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="gsap_sandboxing" <?php echo rb_get_option('rb_gsap_sandboxing', false) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e('Enabling multiple GreenSock compatibility mode can solve issues when other modules/theme are using another/outdated versions of this library.', 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('RocketScript compatibility', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="rocketscript_ignore" <?php echo rb_get_option('rb_rocketscript_ignore', false) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e('Enable this option to ignore files by CloudFront’s Rocket Loader, which can help overcoming potential issues.', 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Force load Origami plugin', 'RbthemeSlider') ?></td>
                        <td><input type="checkbox" name="force_load_origami" <?php echo rb_get_option('rb_force_load_origami', false) ? 'checked="checked"' : '' ?>></td>
                        <td class="desc"><?php rb_e('Enable this option if your theme does not load the Origami effect.', 'RbthemeSlider') ?></td>
                    </tr>
                    <tr>
                        <td><?php rb_e('Scripts priority', 'RbthemeSlider') ?></td>
                        <td><input name="scripts_priority" value="<?php echo rb_get_option('rb_scripts_priority', 50) ?>" placeholder="3"></td>
                        <td class="desc"><?php rb_e('Used to specify the order in which scripts are loaded. Lower numbers correspond with earlier execution.', 'RbthemeSlider') ?></td>
                    </tr>
                </table>
                <div class="footer">
                    <button type="submit" class="button"><?php rb_e('Save changes', 'RbthemeSlider') ?></button>
                </div>
            </form>
        </div>

    </div>

    <div class="columns clearfix">
        <!-- Suggested Modules -->
        <div class="third">
            <h2>
                <?php rb_e('Suggested modules for your store') ?>
                <a class="button dashicons-arrow-right"></a>
                <a class="button dashicons-arrow-left"></a>
            </h2>
            <div class="rb-box rb-product-banner rb-suggested-modules">
                <div class="inner active no-offer" style="display:none">
                    <img src="../modules/rbthemeslider/views/img/admin/handshake.png" alt="Icon">
                    <h3><?php rb_e('Congratulations!') ?></h3>
                    <span class="dev"><?php rb_e('You have all of our suggested modules!') ?></span>
                </div>
            </div>
        </div>
        <!-- Kreatura Newsletter -->
        <div class="third">
            <h2><?php rb_e('Subscribe to our newsletter', 'RbthemeSlider') ?></h2>
            <div class="rb-box rb-product-banner rb-newsletter">
                <div class="inner">
                    <ul>
                        <li>
                            <i class="dashicons dashicons-megaphone"></i>
                            <strong><?php rb_e('Stay Updated', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('News about the latest features and other product info.', 'RbthemeSlider') ?></small>
                        </li>
                        <li>
                            <i class="dashicons dashicons-heart"></i>
                            <strong><?php rb_e('Sneak Peak on Product Updates', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('Access to all the cool new features before anyone else.', 'RbthemeSlider') ?></small>
                        </li>
                        <li>
                            <i class="dashicons dashicons-smiley"></i>
                            <strong><?php rb_e('Provide Feedback', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('Participate in various programs and help us improving RbthemeSlider.', 'RbthemeSlider') ?></small>
                        </li>
                    </ul>
                    <form method="post" action="#" target="_blank">
                        <input type="hidden" name="submitNewsletter" value="Subscribe">
                        <div class="email">
                            <input type="text" name="email" placeholder="<?php rb_e('Enter your email address', 'RbthemeSlider') ?>">
                            <button class="button"><?php rb_e('Subscribe', 'RbthemeSlider') ?></button>
                        </div>
                        <input type="hidden" name="action" value="0">
                    </form>
                </div>
            </div>
        </div>
        <!-- Product Support  -->
        <div class="third">
            <h2><?php rb_e('Product Support', 'RbthemeSlider') ?></h2>
            <div class="rb-box rb-product-banner rb-product-support">
                <div class="inner">
                    <ul>
                        <li>
                            <i class="dashicons dashicons-book"></i>
                            <strong><?php rb_e('Read the documentation', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('Get started with using RbthemeSlider.', 'RbthemeSlider') ?></small>
                        </li>
                        <li>
                            <i class="dashicons dashicons-sos"></i>
                            <strong><?php rb_e('Browse the FAQs', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('Find answers for common questions.', 'RbthemeSlider') ?></small>
                        </li>
                        <li>
                            <i class="dashicons <?php echo $validity ? 'dashicons-groups' : 'dashicons-lock' ?>"></i>
                            <strong><?php rb_e('Direct Support', 'RbthemeSlider') ?></strong>
                            <small><?php rb_e('Get in touch with our Support Team.', 'RbthemeSlider') ?></small>
                        </li>
                    </ul>
                    <a href="#" target="_blank" class="button"><?php rb_e('Contact the developer', 'RbthemeSlider') ?></a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Help menu WP Pointer -->
<?php
if (rb_get_user_meta(rb_get_current_user_id(), 'RbthemeSlider_help_wp_pointer', true) != '1') {
    rb_add_user_meta(rb_get_current_user_id(), 'RbthemeSlider_help_wp_pointer', '1'); ?>
    <script type="text/javascript">

        // Help
        jQuery(document).ready(function() {
            jQuery('#contextual-help-link-wrap').pointer({
                pointerClass : 'rb-help-pointer',
                pointerWidth : 320,
                content: '<h3><?php rb_e('The documentation is here', 'RbthemeSlider') ?></h3><div class="inner"><?php rb_e('Open this help menu to quickly access to our online documentation.', 'RbthemeSlider') ?></div>',
                position: {
                    edge : 'top',
                    align : 'right'
                }
            }).pointer('open');
        });
    </script>
    <?php
} ?>
<script type="text/javascript">
    var rbScreenOptions = <?php echo Tools::jsonEncode($rbScreenOptions) ?>;
</script>
