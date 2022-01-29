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

$l10n_rb = array(
    // General
    'save' => rb__('Save changes', 'Rbthemeslider'),
    'saving' => rb__('Saving ...', 'Rbthemeslider'),
    'saved' => rb__('Saved', 'Rbthemeslider'),
    'error' => rb__('ERROR', 'Rbthemeslider'),
    'untitled' => rb__('Untitled', 'Rbthemeslider'),
    'working' => rb__('Working ...', 'Rbthemeslider'),
    'stop' => rb__('Stop', 'Rbthemeslider'),

    'slideNoun' => rb_x('Slide', 'noun', 'Rbthemeslider'),
    'slideVerb' => rb_x('Slide', 'verb', 'Rbthemeslider'),
    'layer' => rb__('Layer', 'Layer'),

    'selectAll' => rb__('Select all', 'Rbthemeslider'),
    'deselectAll' => rb__('Deselect all', 'Rbthemeslider'),

    // Notify OSD
    'notifySliderSaved' => rb__('Slider saved successfully'),
    'notifyCaptureSlide' => rb__('Capturing page. This might take a moment ...'),

    // Sliders list
    'SLRemoveSlider' => rb__('Are you sure you want to remove this slider?', 'Rbthemeslider'),
    'SLUploadSlider' => rb__('Uploading, please wait ...', 'Rbthemeslider'),
    'SLEnterCode' => rb__('Please enter a valid Item Purchase Code. For more information, please click on the “Where’s my purchase code?” button.', 'Rbthemeslider'),
    'SLDeactivate' => rb__('Are you sure you want to deactivate this site?', 'Rbthemeslider'),
    'SLPermissions' => rb__('WARNING: This option controls who can access to this plugin, you can easily lock out yourself by accident. Please, make sure that you have entered a valid capability without whitespaces or other invalid characters. Do you want to proceed?', 'Rbthemeslider'),
    'SLJQueryConfirm' => rb__("Do not enable this option unless you're  experiencing issues with jQuery on your site. This option can easily cause unexpected issues when used incorrectly. Do you want to proceed?", 'Rbthemeslider'),
    'SLJQueryReminder' => rb__('Do not forget to disable this option later on if it does not help, or if you experience unexpected issues. This includes your entire site, not just Rbthemeslider.', 'Rbthemeslider'),

    'SLImporting' => rb__('Importing, please wait...', 'Rbthemeslider'),
    'SLImportError' => rb__('It seems there is a server issue that prevented Rbthemeslider from importing your selected slider. Please check Rbthemeslider -> System Status for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues or contact your hosting provider to resolve server configuration problems. In many cases retrying to import the same slider can help.', 'Rbthemeslider'),
    'SLImportHTTPError' => rb__('It seems there is a server issue that prevented Rbthemeslider from importing your selected slider. Please check Rbthemeslider -> System Status for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues or contact your hosting provider to resolve server configuration problems. In many cases retrying to import the same slider can help. Your HTTP server thrown the following error: \n\n %s', 'Rbthemeslider'),

    // Template Store
    'TSImportWarningTitle' => rb__('Activate your site to access premium templates.', 'Rbthemeslider'),
    'TSImportWarningContent' => sprintf(rb__('This template is only available for activated sites. Please review the PRODUCT ACTIVATION section on the main Rbthemeslider screen or %sclick here%s for more information.', 'Rbthemeslider'), '<a href=\"https://support.kreaturamedia.com/docs/Rbthemesliderwp/documentation.html#activation\" target=\"_blank\">', '</a>'),
    'TSVersionWarningTitle' => rb__('Plugin update required', 'Rbthemeslider'),
    'TSVersionWarningContent' => sprintf(rb__('This slider template requires a newer version of Rbthemeslider in order to work properly. This is due to additional features introduced in a later version than you have. For updating instructions, please refer to our %sonline documentation%s.', 'Rbthemeslider'), '<a href="https://support.kreaturamedia.com/docs/Rbthemesliderwp/documentation.html#updating" target="_blank">', '</a>'),

    // Google Fonts
    'GFEmptyList' => rb__("You haven't added any Google Font to your collection yet.", 'Rbthemeslider'),
    'GFEmptyCharset' => rb__('You need to have at least one character set added. Please select another item before removing this one.', 'Rbthemeslider'),
    'GFFontFamily' => rb__('Choose a font family', 'Rbthemeslider'),
    'GFFontVariant' => rb__('Select %s font variants', 'Rbthemeslider'),

    // Slider Builder
    'SBSlideTitle' => rb__('Slide #%d', 'Rbthemeslider'),
    'SBSlideCopyTitle' => rb__('Slide #%d copy', 'Rbthemeslider'),
    'SBLayerTitle' => rb__('Layer #%d', 'Rbthemeslider'),
    'SBLayerCopyTitle' => rb__('Layer #%d copy', 'Rbthemeslider'),
    'SBUndoLayer' => rb__('Layer settings', 'Rbthemeslider'),
    'SBUndoSlide' => rb__('Slide settings', 'Rbthemeslider'),
    'SBUndoNewLayer' => rb__('New layer', 'Rbthemeslider'),
    'SBUndoNewLayers' => rb__('New layers', 'Rbthemeslider'),
    'SBUndoVideoPoster' => rb__('Video poster', 'Rbthemeslider'),
    'SBUndoRemoveVideoPoster' => rb__('Remove video poster', 'Rbthemeslider'),
    'SBUndoLayerPosition' => rb__('Layer position', 'Rbthemeslider'),
    'SBUndoRemoveLayer' => rb__('Remove layer(s)', 'Rbthemeslider'),
    'SBUndoHideLayer' => rb__('Hide layer', 'Rbthemeslider'),
    'SBUndoLockLayer' => rb__('Lock layer', 'Rbthemeslider'),
    'SBUndoPasteSettings' => rb__('Paste layer settings', 'Rbthemeslider'),
    'SBUndoSlideImage' => rb__('Slide image', 'Rbthemeslider'),
    'SBUndoLayerImage' => rb__('Layer image', 'Rbthemeslider'),
    'SBUndoSortLayers' => rb__('Sort layers', 'Rbthemeslider'),
    'SBUndoLayerType' => rb__('Layer type', 'Rbthemeslider'),
    'SBUndoLayerMedia' => rb__('Layer media', 'Rbthemeslider'),
    'SBUndoLayerResize' => rb__('Layer resize', 'Rbthemeslider'),
    'SBUndoAlignLayer' => rb__('Align layer(s)', 'Rbthemeslider'),
    'SBUndoRemoveSlideImage' => rb__('Remove slide image', 'Rbthemeslider'),
    'SBUndoRemoveLayerImage' => rb__('Remove layer image', 'Rbthemeslider'),
    'SBDragMe' => rb__('Drag me :)', 'Rbthemeslider'),
    'SBPreviewImagePlaceholder' => rb__('Double click to<br> set image', 'Rbthemeslider'),
    'SBPreviewMediaPlaceholder' => rb__('Add media or paste embed code', 'Rbthemeslider'),
    'SBPreviewTextPlaceholder' => rb__('Text Layer', 'Rbthemeslider'),
    'SBPreviewHTMLPlaceholder' => rb__('HTML Layer', 'Rbthemeslider'),
    'SBPreviewButtonPlaceholder' => rb__('Button Label', 'Rbthemeslider'),
    'SBPreviewSlide' => rb__('Preview Slide', 'Rbthemeslider'),
    'SBLayerPreviewMultiSelect' => rb__('Layer Preview is not available in Multiple Selection Mode. Select only one layer to use this feature. ', 'Rbthemeslider'),
    'SBStaticUntil' => rb__('Until the end of Slide #%d', 'Rbthemeslider'),
    'SBPasteLayerError' => rb__("There's nothing to paste. Copy a layer first!", 'Rbthemeslider'),
    'SBPasteError' => rb__('There is nothing to paste!', 'Rbthemeslider'),
    'SBRemoveSlide' => rb__('Are you sure you want to remove this slide?', 'Rbthemeslider'),
    'SBRemoveLayer' => rb__('Are you sure you want to remove this layer?', 'Rbthemeslider'),
    'SBMediaLibraryImage' => rb__('Pick an image to use it in Rbthemeslider WP', 'Rbthemeslider'),
    'SBUploadError' => rb__('Upload error', 'Rbthemeslider'),
    'SBUploadErrorMessage' => rb__('Upload error: %s', 'Rbthemeslider'),
    'SBInvalidFormat' => rb__('Invalid format', 'Rbthemeslider'),
    'SBEnterImageURL' => rb__('Enter an image URL', 'Rbthemeslider'),
    'SBTransitionApplyOthers' => rb__('Are you sure you want to apply the currently selected transitions and effects on the other slides?', 'Rbthemeslider'),
    'SBPostFilterWarning' => rb__('No posts were found with the current filters.', 'Rbthemeslider'),
    'SBSaveError' => rb__('It seems there is a server issue that prevented Rbthemeslider from saving your work. Please check Rbthemeslider -> System Status for potential errors, try to temporarily disable themes/plugins to rule out incompatibility issues or contact your hosting provider to resolve server configuration problems. Your HTTP server thrown the following error: \n\n %s', 'Rbthemeslider'),
    'SBUnsavedChanges' => rb__('You have unsaved changes on this page. Do you want to leave and discard the changes made since your last save?', 'Rbthemeslider'),
    'SBLinkTextPage' => rb__('Linked to WP Page: %s', 'Rbthemeslider'),
    'SBLinkTextPost' => rb__('Linked to WP Post: %s', 'Rbthemeslider'),
    'SBLinkTextAttachment' => rb__('Linked to WP Attachment: %s', 'Rbthemeslider'),
    'SBLinkPostDynURL' => rb__('Linked to: Post URL from Dynamic content', 'Rbthemeslider'),
    'SBImportLayerNoSlider' => rb__('No sliders found.', 'Rbthemeslider'),
    'SBImportLayerNoSlide' => rb__('No slides found.', 'Rbthemeslider'),
    'SBImportLayerNoLayer' => rb__('No layers found.', 'Rbthemeslider'),

    'SBImportLayerSelectSlide' => rb__('Select a slide first.', 'Rbthemeslider'),

    'SBLayerTypeImg' => rb__('Image', 'Rbthemeslider'),
    'SBLayerTypeIcon' => rb__('Icon', 'Rbthemeslider'),
    'SBLayerTypeText' => rb__('Text', 'Rbthemeslider'),
    'SBLayerTypeButton' => rb__('Button', 'Rbthemeslider'),
    'SBLayerTypeMedia' => rb__('Audio / Video', 'Rbthemeslider'),
    'SBLayerTypeHTML' => rb__('HTML', 'Rbthemeslider'),
    'SBLayerTypePost' => rb__('Dynamic', 'Rbthemeslider'),


    // Transition Builder
    'TBTransitionName' => rb__('Type transition name', 'Rbthemeslider'),
    'TBRemoveTransition' => rb__('Remove transition', 'Rbthemeslider'),
    'TBRemoveConfirmation' => rb__('Are you sure you want to remove this transition?', 'Rbthemeslider'),
);
