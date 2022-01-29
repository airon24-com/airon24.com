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

if (defined('RB_INCLUDE')) {
    $rbDefaults = null;
    $slider = null;
}

$sDefs  =& $rbDefaults['slider'];
$sProps =& $slider['properties'];
?>

<!-- Slider title -->
<div class="rb-slider-titlewrap">
    <?php $sliderName = !empty($sProps['title']) ? htmlspecialchars(_ss($sProps['title'])) : ''; ?>
    <input type="text" name="title" value="<?php echo $sliderName ?>" id="title" autocomplete="off" placeholder="<?php rb_e('Type your slider name here', 'RbthemeSlider') ?>">
    <div class="rb-slider-slug">
        <?php rb_e('Slider slug', 'RbthemeSlider') ?>:<input type="text" name="slug" value="<?php echo !empty($sProps['slug']) ? $sProps['slug'] : '' ?>" autocomplete="off" placeholder="<?php rb_e('e.g. homepageslider', 'RbthemeSlider') ?>" data-help="Set a custom slider identifier to use in shortcodes instead of the database ID. Needs to be unique, and can contain only alphanumeric characters. This setting is optional.">
    </div>
</div>

<!-- Slider settings -->
<div class="rb-box rb-settings">
    <h3 class="header medium">
        <?php rb_e('Slider Settings', 'RbthemeSlider') ?>
        <div class="rb-slider-settings-advanced">
            <?php rb_e('Show advanced settings', 'RbthemeSlider') ?> <input type="checkbox" data-toggleitems=".rb-settings-contents .rb-advanced">
        </div>
    </h3>
    <div class="inner">
        <ul class="rb-settings-sidebar">
            <li data-deeplink="publish">
                <i class="dashicons dashicons-calendar-alt"></i>
                <strong><?php rb_e('Publish', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="layout" class="active">
                <i class="dashicons dashicons-editor-distractionfree"></i>
                <strong><?php rb_e('Layout', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="mobile">
                <i class="dashicons dashicons-smartphone"></i>
                <strong><?php rb_e('Mobile', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="slideshow">
                <i class="dashicons dashicons-editor-video"></i>
                <strong><?php rb_e('Slideshow', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="appearance">
                <i class="dashicons dashicons-admin-appearance"></i>
                <strong><?php rb_e('Appearance', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="navigation">
                <i class="dashicons dashicons-image-flip-horizontal"></i>
                <strong><?php rb_e('Navigation Area', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="thumbnav">
                <i class="dashicons dashicons-screenoptions"></i>
                <strong><?php rb_e('Thumbnail Navigation', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="videos">
                <i class="dashicons dashicons-video-alt3"></i>
                <strong><?php rb_e('Videos', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="yourlogo">
                <i class="dashicons dashicons-admin-post"></i>
                <strong><?php rb_e('YourLogo', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="transition">
                <i class="dashicons dashicons-admin-settings"></i>
                <strong><?php rb_e('Default Options', 'RbthemeSlider') ?></strong>
            </li>
            <li data-deeplink="misc">
                <i class="dashicons dashicons-admin-generic"></i>
                <strong><?php rb_e('Misc', 'RbthemeSlider') ?></strong>
            </li>

        </ul>
        <div class="rb-settings-contents">
            <input type="hidden" name="sliderVersion" value="<?php echo RB_PLUGIN_VERSION ?>">
            <table>
                <!-- Publish -->
                <tbody>
                    <tr><th colspan="2"><?php echo $sDefs['status']['name'] ?></th></tr>
                    <tr>
                        <td colspan="2" class="hero">
                            <p>
                                <?php rbGetCheckbox($sDefs['status'], $sProps, array('class' => 'hero rb-publish-checkbox')); ?>
                                <?php echo $sDefs['status']['desc'] ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th class="half"><?php echo $sDefs['scheduleStart']['name'] ?></th>
                        <th class="half"><?php echo $sDefs['scheduleEnd']['name'] ?></th>
                    </tr>
                    <tr>
                        <td class="half">
                            <div class="rb-datepicker-wrapper">
                                <label><?php rb_e('Interpreted as:', 'RbthemeSlider') ?> <span></span></label>
                                <?php rbGetInput($sDefs['scheduleStart'], $sProps, array('class' => 'rb-datepicker-input', 'data-schedule-key' => 'schedule_start')); ?>
                            </div>
                        </td>
                        <td class="half">
                            <div class="rb-datepicker-wrapper">
                                <label><?php rb_e('Interpreted as:', 'RbthemeSlider') ?> <span></span></label>
                                <?php rbGetInput($sDefs['scheduleEnd'], $sProps, array('class' => 'rb-datepicker-input', 'data-schedule-key' => 'schedule_end')); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="hero">
                            <div class="rb-schedule-desc"><?php echo $sDefs['scheduleStart']['desc'] ?></div>
                        </td>
                    </tr>
                </tbody>

                <!-- Layout -->
                <tbody class="active">
                    <tr>
                        <td><?php echo $sDefs['hook']['name'] ?></td>
                        <td>
                            <?php rbGetInput($sDefs['hook'], $sProps, array()); ?>
                            <a href="#misc"><i class="dashicons dashicons-admin-generic rb-conf"></i><?php rb_e('Configure') ?></a>
                        </td>
                        <td class="desc"><?php echo $sDefs['hook']['desc'] ?></td>
                    </tr>
                    <tr><th colspan="3"><?php rb_e('Slider type & dimensions', 'RbthemeSlider') ?></th></tr>
                    <tr>
                        <td colspan="3" class="rb-slider-dimensions">
                            <div data-type="fixedsize">
                                <img src="<?php echo RB_VIEWS_URL.'img/admin/layout-fixed.png' ?>">
                                <span><?php rb_e('Fixed size', 'RbthemeSlider') ?></span>
                            </div>

                            <div data-type="responsive">
                                <img src="<?php echo RB_VIEWS_URL.'img/admin/layout-responsive.png' ?>">
                                <span><?php rb_e('Responsive', 'RbthemeSlider') ?></span>
                            </div>

                            <div data-type="fullwidth">
                                <img src="<?php echo RB_VIEWS_URL.'img/admin/layout-full-width.png' ?>">
                                <span><?php rb_e('Full width', 'RbthemeSlider') ?></span>
                            </div>

                            <div data-type="fullsize">
                                <img src="<?php echo RB_VIEWS_URL.'img/admin/layout-full-screen.png' ?>">
                                <span><?php rb_e('Full size', 'RbthemeSlider') ?></span>
                            </div>
                            <?php rbGetInput($sDefs['type'], $sProps); ?>
                        </td>
                    </tr>
                    <?php
                    rbOptionRow('input', $sDefs['width'], $sProps, array(), 'rb-popup-hide');
                    rbOptionRow('input', $sDefs['height'], $sProps, array(), 'rb-popup-hide');
                    rbOptionRow('input', $sDefs['maxWidth'], $sProps, array(), 'rb-popup-hide');
                    rbOptionRow('input', $sDefs['responsiveUnder'], $sProps, array(), 'full-width-row rb-popup-hide');
                    rbOptionRow('select', $sDefs['fullSizeMode'], $sProps, array(), 'full-size-row rb-popup-hide');
                    rbOptionRow('checkbox', $sDefs['fitScreenWidth'], $sProps, array(), 'full-width-row full-size-row rb-popup-hide');
                    rbOptionRow('checkbox', $sDefs['allowFullscreen'], $sProps, array(), 'rb-popup-hide')
                    ?>

                    <tr class="rb-advanced rb-hidden"><th colspan="3"><?php rb_e('Other settings', 'RbthemeSlider') ?></th></tr>
                    <?php rbOptionRow('input', $sDefs['maxRatio'], $sProps); ?>
                    <tr class="rb-advanced rb-hidden">
                        <td style="vertical-align: top; padding-top: 10px;">
                            <div>
                                <i class="dashicons dashicons-flag" data-help="Advanced option"></i>
                                <?php echo $sDefs['insertMethod']['name'] ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                rbGetSelect($sDefs['insertMethod'], $sProps);
                                rbGetInput($sDefs['insertSelector'], $sProps);
                            ?>
                        </td>
                        <td class="desc"><?php echo $sDefs['insertMethod']['desc'] ?></td>
                    </tr>
                    <?php
                    rbOptionRow('select', $sDefs['clipSlideTransition'], $sProps);
                    rbOptionRow('checkbox', $sDefs['preventSliderClip'], $sProps, array(), 'full-width-row full-size-row');
                    ?>
                </tbody>


                <!-- Mobile -->
                <tbody>
                    <?php
                    rbOptionRow('checkbox', $sDefs['slideOnSwipe'], $sProps);
                    rbOptionRow('checkbox', $sDefs['optimizeForMobile'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Control display by user agent', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['disableOnMobile'], $sProps);
                    rbOptionRow('checkbox', $sDefs['disableOnTablet'], $sProps);
                    rbOptionRow('checkbox', $sDefs['disableOnDesktop'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Control display by device width', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['hideUnder'], $sProps);
                    rbOptionRow('input', $sDefs['hideOver'], $sProps);
                    ?>
                </tbody>

                <!-- Slideshow -->
                <tbody>
                    <tr><th colspan="3"><?php rb_e('Slideshow behavior', 'RbthemeSlider') ?></th></tr>
                    <tr>
                        <td><?php echo $sDefs['firstSlide']['name'] ?></td>
                        <td><?php rbGetInput($sDefs['firstSlide'], $sProps) ?></td>
                        <td class="desc"><?php echo $sDefs['firstSlide']['desc'] ?></td>
                    </tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['autoStart'], $sProps);
                    rbOptionRow('checkbox', $sDefs['pauseLayers'], $sProps);
                    rbOptionRow('checkbox', $sDefs['startInViewport'], $sProps);
                    rbOptionRow('select', $sDefs['pauseOnHover'], $sProps);
                    rbOptionRow('checkbox', $sDefs['hashChange'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Slideshow navigation', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['keybNavigation'], $sProps);
                    rbOptionRow('checkbox', $sDefs['touchNavigation'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Play By Scroll', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['playByScroll'], $sProps);
                    rbOptionRow('checkbox', $sDefs['playByScrollStart'], $sProps);
                    rbOptionRow('input', $sDefs['playByScrollSpeed'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Cycles', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['loops'], $sProps);
                    rbOptionRow('checkbox', $sDefs['forceLoopNumber'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Other settings', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['twoWaySlideshow'], $sProps);
                    rbOptionRow('checkbox', $sDefs['shuffle'], $sProps);
                    ?>
                </tbody>

                <!-- Appearance -->
                <tbody>
                    <tr><th colspan="3"><?php rb_e('Slider appearance', 'RbthemeSlider') ?></th></tr>
                    <tr>
                        <td><?php rb_e('Skin', 'RbthemeSlider') ?></td>
                        <td>
                            <select name="skin">
                            <?php $sProps['skin'] = empty($sProps['skin']) ? $sDefs['skin']['value'] : $sProps['skin'] ?>
                            <?php $skins = RbSources::getSkins(); ?>
                            <?php foreach ($skins as $skin) : ?>
                                <?php $selected = ($skin['handle'] == $sProps['skin']) ? ' selected="selected"' : '' ?>
                                <option value="<?php echo $skin['handle'] ?>"<?php echo $selected ?>>
                                    <?php
                                    echo $skin['name'];
                                    if (!empty($skin['info']['note'])) {
                                        echo ' - ' . $skin['info']['note'];
                                    }
                                    ?>
                                </option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="desc"><?php echo $sDefs['skin']['desc'] ?></td>
                    </tr>
                    <?php
                    rbOptionRow('input', $sDefs['sliderFadeInDuration'], $sProps);
                    rbOptionRow('input', $sDefs['sliderClasses'], $sProps);
                    ?>
                    <tr>
                        <td><?php rb_e('Custom slider CSS', 'RbthemeSlider') ?></td>
                        <td colspan="2"><textarea name="sliderstyle" cols="30" rows="10"><?php echo !empty($sProps['sliderstyle']) ? $sProps['sliderstyle'] : $sDefs['sliderStyle']['value'] ?></textarea></td>
                    </tr>

                    <tr><th colspan="3"><?php rb_e('Slider global background', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['globalBGColor'], $sProps, array('class' => 'input rb-colorpicker minicolors-input'));
                    ?>
                    <tr>
                        <td><?php rb_e('Background image', 'RbthemeSlider') ?></td>
                        <td>
                            <?php $bgImage = !empty($sProps['backgroundimage']) ? $sProps['backgroundimage'] : null; ?>
                            <?php $bgImageId = !empty($sProps['backgroundimageId']) ? $sProps['backgroundimageId'] : null; ?>
                            <input type="hidden" name="backgroundimageId" value="<?php echo !empty($sProps['backgroundimageId']) ? $sProps['backgroundimageId'] : '' ?>">
                            <input type="hidden" name="backgroundimage" value="<?php echo !empty($sProps['backgroundimage']) ? $sProps['backgroundimage'] : '' ?>">
                            <div class="rb-image rb-global-background rb-upload" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>">
                                <div><img src="<?php echo rb_apply_filters('rb_get_thumbnail', $bgImageId, $bgImage) ?>" alt=""></div>
                                <a href="#" class="dashicons dashicons-dismiss"></a>
                            </div>
                        </td>
                        <td class="desc"><?php echo $sDefs['globalBGImage']['desc'] ?></td>
                    </tr>
                    <?php
                    rbOptionRow('select', $sDefs['globalBGRepeat'], $sProps);
                    rbOptionRow('select', $sDefs['globalBGAttachment'], $sProps);
                    rbOptionRow('input', $sDefs['globalBGPosition'], $sProps, array('class' => 'input'));
                    ?>
                    <tr>
                        <td><?php echo $sDefs['globalBGSize']['name'] ?></td>
                        <td><?php rbGetInput($sDefs['globalBGSize'], $sProps, array('class' => 'input')) ?></div>
                        </td>
                        <td class="desc"><?php echo $sDefs['globalBGSize']['desc'] ?></td>
                    </tr>

                </tbody>

                <!-- Navigation Area -->
                <tbody>
                    <tr><th colspan="3"><?php rb_e('Show navigation buttons', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['navPrevNextButtons'], $sProps);
                    rbOptionRow('checkbox', $sDefs['navStartStopButtons'], $sProps);
                    rbOptionRow('checkbox', $sDefs['navSlideButtons'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Navigation buttons on hover', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['hoverPrevNextButtons'], $sProps);
                    rbOptionRow('checkbox', $sDefs['hoverSlideButtons'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Slideshow timers', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('checkbox', $sDefs['barTimer'], $sProps);
                    rbOptionRow('checkbox', $sDefs['circleTimer'], $sProps);
                    rbOptionRow('checkbox', $sDefs['slideBarTimer'], $sProps);
                    ?>
                </tbody>

                <!-- Thumbnail navigation -->
                <tbody>
                    <tr><th colspan="3"><?php rb_e('Appearance', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('select', $sDefs['thumbnailNavigation'], $sProps);
                    rbOptionRow('input', $sDefs['thumbnailAreaWidth'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Thumbnail dimensions', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['thumbnailWidth'], $sProps);
                    rbOptionRow('input', $sDefs['thumbnailHeight'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Thumbnail appearance', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['thumbnailActiveOpacity'], $sProps);
                    rbOptionRow('input', $sDefs['thumbnailInactiveOpacity'], $sProps);
                    ?>
                </tbody>

                <!-- Videos -->
                <tbody>
                    <?php
                    rbOptionRow('checkbox', $sDefs['autoPlayVideos'], $sProps);
                    rbOptionRow('select', $sDefs['autoPauseSlideshow'], $sProps);
                    rbOptionRow('select', $sDefs['youtubePreviewQuality'], $sProps);
                    ?>
                </tbody>


                <!-- YourLogo -->
                <tbody>
                    <tr>
                        <td><?php echo $sDefs['yourLogoImage']['name'] ?></td>
                        <td>
                            <?php $sProps['yourlogo'] = !empty($sProps['yourlogo']) ? $sProps['yourlogo'] : null; ?>
                            <?php $sProps['yourlogoId'] = !empty($sProps['yourlogoId']) ? $sProps['yourlogoId'] : null; ?>
                            <input type="hidden" name="yourlogoId" value="<?php echo !empty($sProps['yourlogoId']) ? $sProps['yourlogoId'] : '' ?>">
                            <input type="hidden" name="yourlogo" value="<?php echo !empty($sProps['yourlogo']) ? $sProps['yourlogo'] : '' ?>">
                            <div class="rb-image rb-upload rb-yourlogo-upload not-set" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>">
                                <div><img src="<?php echo rb_apply_filters('rb_get_thumbnail', $sProps['yourlogoId'], $sProps['yourlogo']) ?>" alt=""></div>
                                <a href="#" class="dashicons dashicons-dismiss"></a>
                            </div>
                        </td>
                        <td class="desc"><?php echo $sDefs['yourLogoImage']['desc'] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $sDefs['yourLogoStyle']['name'] ?></td>
                        <td colspan="2">
                            <textarea name="yourlogostyle" cols="30" rows="10"><?php echo !empty($sProps['yourlogostyle']) ? $sProps['yourlogostyle'] : $sDefs['yourLogoStyle']['value'] ?></textarea>
                        </td>
                    </tr>
                    <?php
                    rbOptionRow('input', $sDefs['yourLogoLink'], $sProps);
                    rbOptionRow('select', $sDefs['yourLogoTarget'], $sProps);
                    ?>
                </tbody>

                <!-- Transition Defaults -->
                <tbody>
                    <tr><th colspan="3"><?php rb_e('Slide background defaults', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('select', $sDefs['slideBGSize'], $sProps);
                    rbOptionRow('select', $sDefs['slideBGPosition'], $sProps);
                    ?>
                    <tr><th colspan="3"><?php rb_e('Parallax defaults', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['parallaxSensitivity'], $sProps);
                    rbOptionRow('select', $sDefs['parallaxCenterLayers'], $sProps);
                    rbOptionRow('input', $sDefs['parallaxCenterDegree'], $sProps);
                    rbOptionRow('checkbox', $sDefs['parallaxScrollReverse'], $sProps);
                    ?>
                    <tr class="rb-advanced rb-hidden"><th colspan="3"><?php rb_e('Misc', 'RbthemeSlider') ?></th></tr>
                    <?php
                    rbOptionRow('input', $sDefs['forceLayersOutDuration'], $sProps);
                    ?>
                </tbody>

                <!-- Misc -->
                <tbody>
                    <?php
                    rbOptionRow('checkbox', $sDefs['allowRestartOnResize'], $sProps);
                    rbOptionRow('select', $sDefs['preferBlendMode'], $sProps);
                    ?>
                    <tr>
                        <td><?php rb_e('Slider preview image', 'RbthemeSlider') ?></td>
                        <td>
                            <?php $preview = !empty($slider['meta']['preview']) ? $slider['meta']['preview'] : null; ?>
                            <?php $previewId = !empty($slider['meta']['previewId']) ? $slider['meta']['previewId'] : null; ?>
                            <input type="hidden" name="previewId" value="<?php echo !empty($slider['meta']['previewId']) ? $slider['meta']['previewId'] : '' ?>">
                            <input type="hidden" name="preview" value="<?php echo !empty($slider['meta']['preview']) ? $slider['meta']['preview'] : '' ?>">
                            <div class="rb-image rb-slider-preview rb-upload" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>">
                                <div><img src="<?php echo rb_apply_filters('rb_get_thumbnail', $previewId, $preview) ?>" alt=""></div>
                                <a href="#" class="dashicons dashicons-dismiss"></a>
                            </div>
                        </td>
                        <td class="desc"><?php rb_e('The preview image you can see in your list of sliders.', 'RbthemeSlider') ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="clear"></div>
    </div>
</div>