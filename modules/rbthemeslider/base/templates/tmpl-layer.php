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
    $googleFonts = null;
}
?>
<script type="text/html" id="rb-layer-template">
    <div class="rb-sublayer-page rb-sublayer-basic active">


        <div class="rb-set-screen-types">
            <?php rb_e('Show this layer on the following devices:', 'RbthemeSlider') ?>

                <button data-type="desktop" class="button dashicons dashicons-desktop playing" data-help="Show this layer on desktop."></button><!--
            --><button data-type="tablet" class="button dashicons dashicons-tablet" data-help="Show this layer on tablets."></button><!--
            --><button data-type="phone" class="button dashicons dashicons-smartphone" data-help="Show this layer on mobile phones."></button>

        </div>


        <input type="hidden" name="media" value="img">
        <div class="rb-layer-kind">
            <ul>
                <li data-section="img" class="active"><span class="dashicons dashicons-format-image"></span><?php rb_e('Image', 'RbthemeSlider') ?></li>
                <li data-section="text" data-placeholder="<?php rb_e('Enter text only content here ...', 'RbthemeSlider') ?>"><span class="dashicons dashicons-text"></span><?php rb_e('Text', 'RbthemeSlider') ?></li>
                <li data-section="button" data-placeholder="<?php rb_e('Enter the label of your button', 'RbthemeSlider') ?>"><span class="dashicons dashicons-marker"></span><?php rb_e('Button', 'RbthemeSlider') ?></li>
                <li data-section="media" data-placeholder="<?php rb_e('Paste embed code here   or   add self-hosted media ...', 'RbthemeSlider') ?>">
                    <span class="dashicons dashicons-video-alt3"></span><?php rb_e('Video / Audio', 'RbthemeSlider') ?>
                </li>
                <li data-section="html" data-placeholder="<?php rb_e('Enter custom HTML code, which will appear on your front-office pages ...', 'RbthemeSlider') ?>"><span class="dashicons dashicons-editor-code "></span><?php rb_e('HTML', 'RbthemeSlider') ?></li>
                <li data-section="post" data-placeholder="<?php rb_e('You can enter both post placeholders and custom content here (including HTML) ...', 'RbthemeSlider') ?>"><span class="dashicons dashicons-admin-post"></span><?php rb_e('Dynamic content', 'RbthemeSlider') ?></li>
            </ul>
        </div>
        <!-- End of Layer Media Type -->

        <!-- Layer Element Type -->
        <input type="hidden" name="type" value="p">
        <ul class="rb-sublayer-element rb-hidden">
            <li class="rb-type active" data-element="p"><?php rb_e('Paragraph', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h1"><?php rb_e('H1', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h2"><?php rb_e('H2', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h3"><?php rb_e('H3', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h4"><?php rb_e('H4', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h5"><?php rb_e('H5', 'RbthemeSlider') ?></li>
            <li class="rb-type" data-element="h6"><?php rb_e('H6', 'RbthemeSlider') ?></li>
        </ul>
        <!-- End of Layer Element Type -->

        <div class="rb-layer-sections">

            <!-- Image Layer -->
            <div class="rb-image-uploader slide-image clearfix">
                <input type="hidden" name="imageId">
                <input type="hidden" name="image">
                <div class="rb-image rb-upload rb-bulk-upload rb-layer-image not-set" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>">
                    <div><img src="<?php echo RB_VIEWS_URL.'img/admin/blank.gif' ?>" alt=""></div>
                    <a href="#" class="aviary dashicons dashicons-image-crop"></a>
                    <a href="#" class="dashicons dashicons-dismiss"></a>
                </div>
                <p>
                    <?php rb_e('Click on the image preview to open Image Manager or', 'RbthemeSlider') ?>
                    <a href="#" class="rb-url-prompt"><?php rb_e('insert from URL', 'RbthemeSlider') ?></a> or
                    <a href="#" class="rb-post-image"><?php rb_e('use product img', 'RbthemeSlider') ?></a>.
                </p>
            </div>

            <!-- Text/HTML/Video Layer -->
            <div class="rb-html-code rb-hidden">
                <div class="rb-html-textarea">
                    <textarea name="html" cols="50" rows="5" placeholder="Enter layer content here"></textarea>
                    <button type="button" class="button rb-insert-icon">
                        <span class="fa fa-star"></span>
                        <?php rb_e('Add Icon', 'RbthemeSlider') ?>
                    </button>
                    <button type="button" class="button rb-upload rb-bulk-upload rb-insert-media">
                        <span class="dashicons dashicons-admin-media"></span>
                        <?php rb_e('Add Media', 'RbthemeSlider') ?>
                    </button>
                </div>
                <div class="rb-options">

                    <div class="rb-image-uploader slide-image clearfix">
                        <table>
                            <tr>
                                <td>
                                    <input type="hidden" name="posterId">
                                    <input type="hidden" name="poster">
                                    <div class="rb-image rb-upload rb-bulk-upload rb-media-image not-set" data-l10n-set="<?php rb_e('Click to set', 'RbthemeSlider') ?>" data-l10n-change="<?php rb_e('Click to change', 'RbthemeSlider') ?>">
                                        <div><img src="<?php echo RB_VIEWS_URL.'img/admin/blank.gif' ?>" alt=""></div>
                                        <a href="#" class="aviary dashicons dashicons-image-crop"></a>
                                        <a href="#" class="dashicons dashicons-dismiss"></a>
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        <?php rb_e('Insert a video poster image from your Image Manager or ', 'RbthemeSlider') ?>
                                        <a href="#" class="rb-url-prompt"><?php rb_e('insert from URL', 'RbthemeSlider') ?></a>.
                                    </p>
                                </td>
                                <td>
                                    <?php rbGetCheckbox($rbDefaults['layers']['mediaBackgroundVideo'], null, array('class' => 'sublayerprop hero bgvideo')) ?>
                                    <?php echo $rbDefaults['layers']['mediaBackgroundVideo']['name'] ?>
                                </td>
                            </tr>
                        </table>

                        <div class="rb-bgvideo-options rb-notification-info">
                            <i class="dashicons dashicons-info"></i>
                            <?php rb_e('Please note, the slide background image (if any) will cover the video.', 'RbthemeSlider') ?>
                        </div>
                    </div>

                    <div class="rb-separator"><span><?php rb_e('options', 'RbthemeSlider') ?></span></div>
                    <table class="rb-media-options">
                        <tr>
                            <td>
                                <?php echo $rbDefaults['layers']['mediaAutoPlay']['name'] ?> <br>
                                <?php rbGetSelect($rbDefaults['layers']['mediaAutoPlay'], null, array('class' => 'sublayerprop')) ?>
                            </td>
                            <td>
                                <?php echo $rbDefaults['layers']['mediaFillMode']['name'] ?> <br>
                                <?php rbGetSelect($rbDefaults['layers']['mediaFillMode'], null, array('class' => 'sublayerprop')) ?>
                            </td>
                            <td>
                                <?php echo $rbDefaults['layers']['mediaControls']['name'] ?> <br>
                                <?php rbGetSelect($rbDefaults['layers']['mediaControls'], null, array('class' => 'sublayerprop')) ?>
                            </td>
                            <td>
                                <?php echo $rbDefaults['layers']['mediaInfo']['name'] ?> <br>
                                <?php rbGetSelect($rbDefaults['layers']['mediaInfo'], null, array('class' => 'sublayerprop')) ?>
                            </td>
                            <td class="volume">
                                <?php echo $rbDefaults['layers']['mediaVolume']['name'] ?> <br>
                                <?php rbGetInput($rbDefaults['layers']['mediaVolume'], null, array('class' => 'sublayerprop')) ?>
                            </td>
                            <td class="overlay">
                                <?php echo $rbDefaults['layers']['mediaOverlay']['name']; ?><br>
                                <?php

                                $location = RB_VIEWS_URL.'img/RbthemeSlider/overlays/*';
                                $overlays = array('disabled' => 'No overlay image');

                                foreach (glob($location) as $file) {
                                    $basename = basename($file);
                                    $url = RB_VIEWS_URL.'img/RbthemeSlider/overlays/'.$basename;

                                    $overlays[$url] = $basename;
                                }

                                rbGetSelect($rbDefaults['layers']['mediaOverlay'], null, array('class' => 'sublayerprop', 'options' => $overlays ));
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Dynamic Layer -->
            <div class="rb-post-section rb-hidden">
                <div class="rb-posts-configured">
                    <ul class="rb-post-placeholders clearfix">
                        <li><span>[id]</span></li>
                        <li><span>[url]</span></li>
                        <li><span>[date-published]</span></li>
                        <li><span>[date-modified]</span></li>
                        <li><span>[image]</span></li>
                        <li><span>[image-url]</span></li>
                        <li><span>[name]</span></li>
                        <li><span>[price]</span></li>
                        <li><span>[old-price]</span></li>
                        <li><span>[description]</span></li>
                        <li><span>[description-short]</span></li>
                        <!--li data-placeholder="<a href=&quot;[url]&quot;>Read more</a>"><span>[link]</span></li-->
                        <li><span>[manufacturer]</span></li>
                        <li><span>[category]</span></li>
                        <li><span>[breadcrumbs]</span></li>
                    </ul>
                    <p>
                        <?php rb_e("Click on one or more post placeholders to insert them into your layer's content. Post placeholders act like shortcodes, and they will be filled with the actual content from your dynamic content.", "RbthemeSlider") ?><br>
                        <?php rb_e('Limit text length (if any)', 'RbthemeSlider') ?>
                        <input type="number" name="post_text_length">
                        <button type="button" class="button rb-configure-posts"><span class="dashicons dashicons-admin-post"></span><?php rb_e('Configure dynamic content', 'RbthemeSlider') ?></button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="rb-sublayer-page rb-sublayer-options">
        <div class="rb-easy">
            <ul class="layer-properties-box clearfix">
                <li class="rb-easy-tr" data-prop="transitionin">
                    <h6><?php rb_e('Add opening transition') ?></h6>
                    <h5><span><?php rb_e('Opening transition') ?></span></h5>
                    <button type="button" class="button rb-blue-button rb-preset">
                        <i class="dashicons dashicons-admin-settings"></i>
                        <?php rb_e('Choose preset') ?>
                    </button>
                    <ul></ul>
                    <select class="rb-add-tr-prop"><option value="">&#10010;&nbsp;&nbsp;&nbsp;<?php rb_e('Add property') ?></option></select>
                </li>
                <li class="rb-easy-tr" data-prop="transitionout">
                    <h6><?php rb_e('Add ending transition') ?></h6>
                    <h5><span><?php rb_e('Ending transition') ?></span><i class="dashicons dashicons-no"></i></h5>
                    <button type="button" class="button rb-blue-button rb-preset">
                        <i class="dashicons dashicons-admin-settings"></i>
                        <?php rb_e('Choose preset') ?>
                    </button>
                    <ul></ul>
                    <select class="rb-add-tr-prop"><option value="">&#10010;&nbsp;&nbsp;&nbsp;<?php rb_e('Add property') ?></option></select>
                </li>
                <li class="rb-easy-tr" data-prop="loop">
                    <h6><?php rb_e('Add loop transition') ?></h6>
                    <h5><span><?php rb_e('Loop transition') ?></span><i class="dashicons dashicons-no"></i></h5>
                    <button type="button" class="button rb-blue-button rb-preset">
                        <i class="dashicons dashicons-admin-settings"></i>
                        <?php rb_e('Choose preset') ?>
                    </button>
                    <ul></ul>
                    <select class="rb-add-tr-prop"><option value="">&#10010;&nbsp;&nbsp;&nbsp;<?php rb_e('Add property') ?></option></select>
                </li>
                <li class="rb-easy-tr" data-prop="hover">
                    <h6><?php rb_e('Add hover transition') ?></h6>
                    <h5><span><?php rb_e('Hover transition') ?></span><i class="dashicons dashicons-no"></i></h5>
                    <button type="button" class="button rb-blue-button rb-preset">
                        <i class="dashicons dashicons-admin-settings"></i>
                        <?php rb_e('Choose preset') ?>
                    </button>
                    <ul></ul>
                    <select class="rb-add-tr-prop"><option value="">&#10010;&nbsp;&nbsp;&nbsp;<?php rb_e('Add property') ?></option></select>
                </li>
            </ul>
        </div>
        <div class="rb-adv">
            <select id="rb-transition-selector">
                <option value="0"><?php rb_e('Opening Transition properties', 'RbthemeSlider') ?></option>
                <option value="1"><?php rb_e('Opening Text Transition properties', 'RbthemeSlider') ?></option>
                <option value="2"><?php rb_e('Loop or Middle Transition properties', 'RbthemeSlider') ?></option>
                <option value="3"><?php rb_e('Ending Text Transition properties', 'RbthemeSlider') ?></option>
                <option value="4"><?php rb_e('Ending Transition properties', 'RbthemeSlider') ?></option>
                <option value="5"><?php rb_e('Hover Transition properties', 'RbthemeSlider') ?></option>
                <option value="6"><?php rb_e('Parallax Transition properties', 'RbthemeSlider') ?></option>
            </select>

            <table id="rb-transition-selector-table">
                <tr>
                    <td class="rb-padding"></td>
                    <td class="rb-opening-transition">
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-in">
                                <div class="rb-preview-layer"></div>
                            </div>
                            <span><?php rb_e('Opening<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding rb-only-with-text-layers"></td>
                    <td class="rb-opening-transition rb-only-with-text-layers">
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-textin">
                                <span class="rb-preview-layer_t rb-preview-layer_t4">t</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t3">x</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t2">e</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t1">t</span>
                            </div>
                            <span><?php rb_e('Opening Text<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding"></td>
                    <td>
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-loop">
                                <div class="rb-preview-layer"></div>
                            </div>
                            <span><?php rb_e('Loop or Middle<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding rb-only-with-text-layers"></td>
                    <td class="rb-only-with-text-layers">
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-textout">
                                <span class="rb-preview-layer_t rb-preview-layer_t4">t</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t3">x</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t2">e</span>
                                <span class="rb-preview-layer_t rb-preview-layer_t1">t</span>
                            </div>
                            <span><?php rb_e('Ending Text<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding"></td>
                    <td>
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-out">
                                <div class="rb-preview-layer"></div>
                            </div>
                            <span><?php rb_e('Ending<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding"></td>
                    <td>
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-hover">
                                <div class="rb-preview-layer"></div>
                            </div>
                            <span><?php rb_e('Hover<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding"></td>
                    <td>
                        <div>
                            <div class="rb-tpreview-wrapper" id="rb-tpreview-parallax">
                                <div class="rb-preview-layer"></div>
                                <div class="rb-preview-layer rb-preview-layer_b"></div>
                            </div>
                            <span><?php rb_e('Parallax<br>Transition', 'RbthemeSlider') ?></span>
                        </div>
                    </td>
                    <td class="rb-padding"></td>
                </tr>
            </table>

            <div id="rb-transition-warning">
                <div class="rb-notification-info">
                    <i class="dashicons dashicons-info"></i>
                    <?php rb_e('Layers require an opening transition in order to become visible during the slideshow. Enable either <mark>Opening Transition</mark> or <mark>Opening Text Transition</mark> to make this layer visible again.', 'RbthemeSlider') ?>
                </div>
            </div>

            <div id="rb-layer-transitions">

                <!-- Opening Transition -->
                <section data-storage="rb-tr-in">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Opening Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['transitionIn'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('The following are the initial options from which this layer animates toward the appropriate values set under the Styles tab when it enters into the slider canvas.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInOffsetX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInOffsetX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInOffsetY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInOffsetY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInScaleX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInScaleX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInScaleY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInScaleY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInWidth']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInWidth'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInHeight']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInHeight'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation, Skew &amp; Mask', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInRotate']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInRotate'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInRotateX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInRotateY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInSkewX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInSkewY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInClip']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInClip'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInDelay']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInDelay'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInDuration']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInDuration'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['transitionInEasing']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['transitionInEasing'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInTransformOrigin']['name'] ?>
                                        </div>
                                        <div>
                                            <i class="dashicons dashicons-search"></i><?php rbGetInput($rbDefaults['layers']['transitionInTransformOrigin'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInPerspective']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInPerspective'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <!-- <li>
                                        <div>
                                            Perspective
                                        </div>
                                        <div>
                                            <?php //rbGetInput($rbDefaults['layers']['transitionInTransformPerspective'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li> -->
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInFade']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetCheckbox($rbDefaults['layers']['transitionInFade'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInColor']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInBGColor']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInBGColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionInRadius']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInRadius'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                     <li>
                                        <div>
                                            <a href="https://developer.mozilla.org/en/docs/Web/CSS/filter#Functions" target="_blank"><?php echo $rbDefaults['layers']['transitionInFilter']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionInFilter'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                 </ul>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Opening Text Transition -->
                <section class="rb-text-transition" data-storage="rb-tr-text-in">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Opening Text Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['textTransitionIn'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('The following options specify the initial state of each text fragments before they start animating toward the joint whole word.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Type, Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textTypeIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textTypeIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textOffsetXIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textOffsetXIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textOffsetYIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textOffsetYIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textScaleXIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textScaleXIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textScaleYIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textScaleYIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation &amp; Skew', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateIn'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateXIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateXIn'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateYIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateYIn'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textSkewXIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textSkewXIn'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textSkewYIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textSkewYIn'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Sets the starting time for this transition. Select one of the pre-defined options from this list to control timing in relation with other transition types. Additionally, you can shift starting time with the modifier controls below.', 'RbthemeSlider') ?>">
                                        <div><?php rb_e('Start when', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textStartAtIn'], null, array('class' => 'sublayerprop start-at-calc undomanager-merge')) ?>
                                            <?php rbGetSelect($rbDefaults['layers']['textStartAtInTiming'], null, array('class' => 'sublayerprop start-at-timing')) ?>
                                        </div>
                                    </li>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Shifts the above selected starting time by performing a custom operation. For example, &quot;- 1000&quot; will advance the animation by playing it 1 second (1000 milliseconds) earlier.', 'RbthemeSlider') ?>">
                                        <div><?php rb_e('with modifier', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textStartAtInOperator'], null, array('class' => 'sublayerprop start-at-operator')) ?>
                                            <?php rbGetInput($rbDefaults['layers']['textStartAtInValue'], null, array('class' => 'sublayerprop start-at-value')) ?>  ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textDurationIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textDurationIn'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textShiftIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textShiftIn'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['textEasingIn']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textEasingIn'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textTransformOriginIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textTransformOriginIn'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textPerspectiveIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textPerspectiveIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textFadeIn']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetCheckbox($rbDefaults['layers']['textFadeIn'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Loop or Middle Transition -->
                <section data-storage="rb-tr-loop">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Loop / Middle Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['loop'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('Repeats a transition based on the options below. If you set the Loop Count to 1, it can also act as a middle transition in the chain of animation lifecycles.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopOffsetX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopOffsetX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopOffsetY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopOffsetY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopScaleX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopScaleX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopScaleY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopScaleY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation, Skew &amp; Mask', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopRotate']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopRotate'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopRotateX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopRotateY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopSkewX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopSkewY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopClip']['name'] ?><br>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopClip'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Sets the starting time for this transition. Select one of the pre-defined options from this list to control timing in relation with other transition types. Additionally, you can shift starting time with the modifier controls below.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('Start when', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopStartAt'], null, array('class' => 'sublayerprop start-at-calc undomanager-merge')) ?>
                                            <?php rbGetSelect($rbDefaults['layers']['loopStartAtTiming'], null, array('class' => 'sublayerprop start-at-timing')) ?>
                                        </div>
                                    </li>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Shifts the above selected starting time by performing a custom operation. For example, &quot;- 1000&quot; will advance the animation by playing it 1 second (1000 milliseconds) earlier.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('with modifier', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['loopStartAtOperator'], null, array('class' => 'sublayerprop start-at-operator')) ?>
                                            <?php rbGetInput($rbDefaults['layers']['loopStartAtValue'], null, array('class' => 'sublayerprop start-at-value')) ?>  ms
                                        </div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['loopDuration']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['loopDuration'], null, array('class' => 'sublayerprop')) ?> ms</div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['loopEasing']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['loopEasing'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopCount']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopCount'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopWait']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopWait'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopYoyo']['name'] ?>
                                        </div>
                                        <div>
                                            <label style="display:inline" data-help="<?php echo $rbDefaults['layers']['loopYoyo']['tooltip'] ?>"><?php rbGetCheckbox($rbDefaults['layers']['loopYoyo'], null, array('class' => 'sublayerprop')) ?></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopTransformOrigin']['name'] ?>
                                        </div>
                                        <div>
                                            <i class="dashicons dashicons-search"></i><?php rbGetInput($rbDefaults['layers']['loopTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopPerspective']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopPerspective'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>


                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['loopOpacity']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopOpacity'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                     <li>
                                        <div>
                                            <a href="https://developer.mozilla.org/en/docs/Web/CSS/filter#Functions" target="_blank"><?php echo $rbDefaults['layers']['loopFilter']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['loopFilter'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Ending Text Transition -->
                <section class="rb-text-transition" data-storage="rb-tr-text-out">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Ending Text Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['textTransitionOut'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('Each text fragment will animate from the joint whole word to the options you specify here.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Type, Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textTypeOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textTypeOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textOffsetXOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textOffsetXOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textOffsetYOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textOffsetYOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textScaleXOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textScaleXOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textScaleYOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textScaleYOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation &amp; Skew', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateOut'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateXOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateXOut'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textRotateYOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textRotateYOut'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textSkewXOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textSkewXOut'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textSkewYOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textSkewYOut'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Sets the starting time for this transition. Select one of the pre-defined options from this list to control timing in relation with other transition types. Additionally, you can shift starting time with the modifier controls below.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('Start when', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textStartAtOut'], null, array('class' => 'sublayerprop start-at-calc undomanager-merge')) ?>
                                            <?php rbGetSelect($rbDefaults['layers']['textStartAtOutTiming'], null, array('class' => 'sublayerprop start-at-timing')) ?>
                                        </div>
                                    </li>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Shifts the above selected starting time by performing a custom operation. For example, &quot;- 1000&quot; will advance the animation by playing it 1 second (1000 milliseconds) earlier.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('with modifier', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textStartAtOutOperator'], null, array('class' => 'sublayerprop start-at-operator')) ?>
                                            <?php rbGetInput($rbDefaults['layers']['textStartAtOutValue'], null, array('class' => 'sublayerprop start-at-value')) ?>  ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textDurationOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textDurationOut'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textShiftOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textShiftOut'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['textEasingOut']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['textEasingOut'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textTransformOriginOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textTransformOriginOut'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textPerspectiveOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['textPerspectiveOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['textFadeOut']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetCheckbox($rbDefaults['layers']['textFadeOut'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Ending Transition -->
                <section data-storage="rb-tr-out">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Ending Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['transitionOut'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('The following options will be the end values where this layer animates toward when it leaves the slider canvas.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutOffsetX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutOffsetX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutOffsetY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutOffsetY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutScaleX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutScaleX'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutScaleY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutScaleY'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutWidth']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutWidth'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutHeight']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutHeight'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation, Skew &amp; Mask', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutRotate']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutRotate'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutRotateX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutRotateY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutSkewX']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutSkewY']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutClip']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutClip'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Sets the starting time for this transition. Select one of the pre-defined options from this list to control timing in relation with other transition types. Additionally, you can shift starting time with the modifier controls below.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('Start when', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutStartAt'], null, array('class' => 'sublayerprop start-at-calc undomanager-merge')) ?>
                                            <?php rbGetSelect($rbDefaults['layers']['transitionOutStartAtTiming'], null, array('class' => 'sublayerprop start-at-timing')) ?>
                                        </div>
                                    </li>
                                    <li class="start-at-wrapper" data-help="<?php rb_e('Shifts the above selected starting time by performing a custom operation. For example, &quot;- 1000&quot; will advance the animation by playing it 1 second (1000 milliseconds) earlier.', 'RbthemeSlider'); ?>">
                                        <div><?php rb_e('with modifier', 'RbthemeSlider') ?></div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['transitionOutStartAtOperator'], null, array('class' => 'sublayerprop start-at-operator')) ?>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutStartAtValue'], null, array('class' => 'sublayerprop start-at-value')) ?>  ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutDuration']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutDuration'], null, array('class' => 'sublayerprop')) ?> ms
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['transitionOutEasing']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetSelect($rbDefaults['layers']['transitionOutEasing'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutTransformOrigin']['name'] ?>
                                        </div>
                                        <div>
                                            <i class="dashicons dashicons-search"></i><?php rbGetInput($rbDefaults['layers']['transitionOutTransformOrigin'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutPerspective']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutPerspective'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <!-- <li>
                                        <div>
                                            Perspective
                                        </div>
                                        <div>
                                            <?php //rbGetInput($rbDefaults['layers']['transitionOutTransformPerspective'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?>
                                        </div>
                                    </li> -->
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutFade']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetCheckbox($rbDefaults['layers']['transitionOutFade'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutColor']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutBGColor']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutBGColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <?php echo $rbDefaults['layers']['transitionOutRadius']['name'] ?>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutRadius'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                     <li>
                                        <div>
                                            <a href="https://developer.mozilla.org/en/docs/Web/CSS/filter#Functions" target="_blank"><?php echo $rbDefaults['layers']['transitionOutFilter']['name'] ?></a>
                                        </div>
                                        <div>
                                            <?php rbGetInput($rbDefaults['layers']['transitionOutFilter'], null, array('class' => 'sublayerprop')) ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>


                <!-- Hover Transition -->
                <section data-storage="rb-tr-hover">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Hover Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['hover'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('Plays a transition based on the options below when the user moves the mouse cursor over this layer.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    </div>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix">
                            <li>
                                <h5><span><?php rb_e('Position &amp; Dimensions', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverOffsetX']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverOffsetX'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverOffsetY']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverOffsetY'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverScaleX']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverScaleX'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverScaleY']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverScaleY'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Rotation, Skew &amp; Mask', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverRotate']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverRotateX']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverRotateY']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverSkewX']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverSkewY']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverInDuration']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverInDuration'], null, array('class' => 'sublayerprop')) ?> ms</div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverOutDuration']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverOutDuration'], null, array('class' => 'sublayerprop')) ?> ms</div>
                                    </li>
                                    <li>
                                        <div><a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['hoverInEasing']['name'] ?></a></div>
                                        <div><?php rbGetSelect($rbDefaults['layers']['hoverInEasing'], null, array('class' => 'sublayerprop', 'options' => $rbDefaults['easings'])) ?></div>
                                    </li>
                                    <li>
                                        <div><a href="http://easings.net/" target="_blank"><?php echo $rbDefaults['layers']['hoverOutEasing']['name'] ?></a></div>
                                        <div><?php rbGetSelect($rbDefaults['layers']['hoverOutEasing'], null, array('class' => 'sublayerprop', 'options' => array_merge(array('' => '- Same easing -'), $rbDefaults['easings']))) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverTransformOrigin']['name'] ?></div>
                                        <div><i class="dashicons dashicons-search"></i><?php rbGetInput($rbDefaults['layers']['hoverTransformOrigin'], null, array('class' => 'sublayerprop', 'style' => 'width:130px')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverTransformPerspective']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverTransformPerspective'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Style properties', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverOpacity']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverOpacity'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverColor']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverBGColor']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverBGColor'], null, array('class' => 'sublayerprop rb-colorpicker')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverBorderRadius']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['hoverBorderRadius'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['hoverTopOn']['name'] ?></div>
                                        <div><?php rbGetCheckbox($rbDefaults['layers']['hoverTopOn'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>




                <!-- Parallax Transition -->
                <section data-storage="rb-tr-parallax">
                    <div>
                        <div class="rb-separator"><span><?php rb_e('Parallax Transition properties', 'RbthemeSlider') ?></span></div>
                        <header>
                            <div class="rb-h-enabled"><?php rb_e('ENABLED', 'RbthemeSlider') ?></div>
                            <div class="rb-h-button"><?php rbGetCheckbox($rbDefaults['layers']['parallax'], null, array('class' => 'sublayerprop large toggle')) ?></div>
                            <div class="rb-h-description"><?php rb_e('Select a parallax type and event, then set the Parallax Level option to enable parallax layers.', 'RbthemeSlider') ?></div>
                            <div class="rb-h-actions">
                                <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy transition properties', 'RbthemeSlider') ?></a>
                                <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste transition properties', 'RbthemeSlider') ?></a>
                            </div>
                        </header>
                    <div class="overlay">
                        <ul class="layer-properties-box clearfix col-3">
                            <li>
                                <h5><span><?php rb_e('Basic Settings', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxLevel']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxLevel'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxType']['name'] ?></div>
                                        <div><?php rbGetSelect($rbDefaults['layers']['parallaxType'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxEvent']['name'] ?></div>
                                        <div><?php rbGetSelect($rbDefaults['layers']['parallaxEvent'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxAxis']['name'] ?></div>
                                        <div><?php rbGetSelect($rbDefaults['layers']['parallaxAxis'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Distance &amp; Rotation', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxDistance']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxDistance'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxRotate']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxRotate'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h5><span><?php rb_e('Timing &amp; Transform', 'RbthemeSlider') ?></span></h5>
                                <ul>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxDurationMove']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxDurationMove'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxDurationLeave']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxDurationLeave'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxTransformOrigin']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxTransformOrigin'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                    <li>
                                        <div><?php echo $rbDefaults['layers']['parallaxPerspective']['name'] ?></div>
                                        <div><?php rbGetInput($rbDefaults['layers']['parallaxPerspective'], null, array('class' => 'sublayerprop')) ?></div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="rb-separator"><span><?php rb_e('Other settings', 'RbthemeSlider') ?></span></div>

            <div class="rb-layer-other-settings clearfix">
                <div>
                    <div>
                        <?php echo $rbDefaults['layers']['transitionStatic']['name'] ?>
                    </div>
                    <div>
                        <?php rbGetSelect($rbDefaults['layers']['transitionStatic'], null, array('class' => 'sublayerprop')) ?>
                    </div>
                </div>


                <div class="clearfix">
                     <div>
                        <?php echo $rbDefaults['layers']['transitionKeyframe']['name'] ?>
                    </div>
                    <div>
                        <?php rbGetCheckbox($rbDefaults['layers']['transitionKeyframe'], null, array('class' => 'sublayerprop')) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="rb-sublayer-page rb-sublayer-link">
        <h3 class="subheader"><?php rb_e('Linking', 'RbthemeSlider') ?></h3>
        <div class="rb-slide-link clearfix">
            <div>
                <?php rbGetInput($rbDefaults['layers']['linkURL'], null, array('class' => 'url', 'placeholder' => $rbDefaults['layers']['linkURL']['name'])) ?>
                <input type="hidden" name="linkId">
                <input type="hidden" name="linkName">
                <input type="hidden" name="linkType">
                <a href="#" class="change">
                    <span class="dashicons dashicons-editor-unlink"></span>
                    <?php rb_e('Change Link', 'RbthemeSlider') ?>
                </a>
                <span><a href="#" class="dyn"><?php rb_e('Use Dynamic post URL', 'RbthemeSlider') ?></a></span>
            </div>
            <?php rbGetSelect($rbDefaults['layers']['linkTarget'], null) ?>
        </div>

        <h3 class="subheader"><?php rb_e('Common Attributes', 'RbthemeSlider') ?></h3>
        <div class="rb-sublayer-attributes">
            <table class="rb-sublayer-common-attributes">
                <tbody>
                    <tr data-help="<?php echo $rbDefaults['layers']['ID']['tooltip'] ?>">
                        <td class="first"><input type="text" value="id" disabled></td>
                        <td class="second"><input type="text" name="id"></td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. Some attributes will be applied on the wrapper (if any), which is desirable in many cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. If the pre-defined option doesn't fit your needs, use custom attributes below to override it.", 'RbthemeSlider') ?>">
                            <?php rb_e('On layer', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                    <tr data-help="<?php echo $rbDefaults['layers']['class']['tooltip'] ?>">
                        <td class="first"><input type="text" value="class" disabled></td>
                        <td class="second"><input type="text" name="class"></td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. Some attributes will be applied on the wrapper (if any), which is desirable in many cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. If the pre-defined option doesn't fit your needs, use custom attributes below to override it.", 'RbthemeSlider') ?>">
                            <?php rb_e('On layer', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                    <tr data-help="<?php echo $rbDefaults['layers']['title']['tooltip'] ?>">
                        <td class="first"><input type="text" value="title" disabled></td>
                        <td class="second"><input type="text" name="title"></td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. Some attributes will be applied on the wrapper (if any), which is desirable in many cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. If the pre-defined option doesn't fit your needs, use custom attributes below to override it.", 'RbthemeSlider') ?>">
                            <?php rb_e('On parent', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                    <tr data-help="<?php echo $rbDefaults['layers']['alt']['tooltip'] ?>">
                        <td class="first"><input type="text" value="alt" disabled></td>
                        <td class="second"><input type="text" name="alt"></td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. Some attributes will be applied on the wrapper (if any), which is desirable in many cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. If the pre-defined option doesn't fit your needs, use custom attributes below to override it.", 'RbthemeSlider') ?>">
                            <?php rb_e('On layer', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                    <tr class="rb-adv" data-help="<?php echo $rbDefaults['layers']['rel']['tooltip'] ?>">
                        <td class="first"><input type="text" value="rel" disabled></td>
                        <td class="second"><input type="text" name="rel"></td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. Some attributes will be applied on the wrapper (if any), which is desirable in many cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. If the pre-defined option doesn't fit your needs, use custom attributes below to override it.", 'RbthemeSlider') ?>">
                            <?php rb_e('On parent', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 class="subheader rb-adv"><?php rb_e('Custom Attributes', 'RbthemeSlider') ?></h3>
        <div class="rb-sublayer-attributes rb-adv">
            <table class="rb-sublayer-custom-attributes">
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p><?php echo $rbDefaults['layers']['innerAttributes']['desc']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="first">
                            <input type="text" placeholder="<?php rb_e('Attribute name', 'RbthemeSlider') ?>">
                        </td>
                        <td class="second">
                            <input type="text" placeholder="<?php rb_e('Attribute value', 'RbthemeSlider') ?>">
                        </td>
                        <td class="third" data-help="<?php rb_e("In some cases your layers may be wrapped by another element. For example, an ＜A＞ tag when you use layer linking. By default, new attributes will be applied on the wrapper (if any), which is desirable in most cases (e.g. lightbox plugins). If there is no wrapper element, attributes will be automatically applied on the layer itself. Uncheck this option when you need to apply this attribute on the layer element in all cases.", 'RbthemeSlider') ?>">
                            <input type="checkbox" class="small noreset" checked> <?php rb_e('On parent', 'RbthemeSlider') ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="rb-sublayer-page rb-sublayer-style clearfix" data-storage="rb-styles">

        <div>

            <div>
                <div>
                    <h5><?php rb_e('Layout', 'RbthemeSlider') ?> <span>| <?php rb_e('sizing & position', 'RbthemeSlider') ?></span></h5>
                    <div class="rb-layer-visual-box">
                        <div class="rb-layer-position">
                            <div>
                                <?php rbGetInput($rbDefaults['layers']['top'], null, array('class' => 'auto rb-layer-top')) ?>
                                <?php rbGetInput($rbDefaults['layers']['left'], null, array('class' => 'auto rb-layer-left')) ?>
                                <span class="rb-layer-top"><?php echo $rbDefaults['layers']['top']['name'] ?></span>
                                <span class="rb-layer-left"><?php echo $rbDefaults['layers']['left']['name'] ?></span>
                            </div>
                            <div class="rb-layer-border">
                                <?php rb_e('border', 'RbthemeSlider') ?>
                                <b class="rb-border-top-value">–</b>
                                <b class="rb-border-right-value">–</b>
                                <b class="rb-border-bottom-value">–</b>
                                <b class="rb-border-left-value">–</b>
                                <div class="rb-layer-padding">
                                    <?php rb_e('padding', 'RbthemeSlider') ?>
                                    <b class="rb-padding-top-value">–</b>
                                    <b class="rb-padding-right-value">–</b>
                                    <b class="rb-padding-bottom-value">–</b>
                                    <b class="rb-padding-left-value">–</b>
                                    <div class="rb-layer-size">
                                        <?php rbGetInput($rbDefaults['layers']['width'], null, array('class' => 'auto', 'placeholder' => 'auto')) ?><span class="rb-x">x</span><?php rbGetInput($rbDefaults['layers']['height'], null, array('class' => 'auto', 'placeholder' => 'auto')) ?>
                                        <br>
                                        <span class="rb-wh"><?php echo $rbDefaults['layers']['width']['name'] ?></span><span class="rb-wh"><?php echo $rbDefaults['layers']['height']['name'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-holder rb-position rb-adv">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $rbDefaults['layers']['position']['name'] ?>
                                    </td>
                                    <td>
                                        <?php rbGetSelect($rbDefaults['layers']['position'], null, array('class' => 'sublayerprop')) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $rbDefaults['layers']['zIndex']['name'] ?>
                                    </td>
                                    <td>
                                        <?php rbGetInput($rbDefaults['layers']['zIndex'], null, array('class' => 'auto')) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-holder rb-border-padding">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="rb-bptable-1"></td>
                                    <td class="rb-bptable-2"><?php rb_e('Border', 'RbthemeSlider') ?></td>
                                    <td class="rb-bptable-3"><?php rb_e('Padding', 'RbthemeSlider') ?></td>
                                </tr>
                                <tr data-edge="top">
                                    <td><?php rb_e('Top', 'RbthemeSlider') ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['borderTop'], null, array('class' => 'auto')) ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['paddingTop'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr data-edge="right">
                                    <td><?php rb_e('Right', 'RbthemeSlider') ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['borderRight'], null, array('class' => 'auto')) ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['paddingRight'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr data-edge="bottom">
                                    <td><?php rb_e('Bottom', 'RbthemeSlider') ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['borderBottom'], null, array('class' => 'auto')) ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['paddingBottom'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr data-edge="left">
                                    <td><?php rb_e('Left', 'RbthemeSlider') ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['borderLeft'], null, array('class' => 'auto')) ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['paddingLeft'], null, array('class' => 'auto')) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div>

            <div class="rb-h-actions">
                <div>
                    <h5><?php rb_e('Actions', 'RbthemeSlider') ?></h5>
                    <div class="table-holder">
                        <a href="#" class="copy"><i class="dashicons dashicons-clipboard"></i> <?php rb_e('Copy layer styles', 'RbthemeSlider') ?></a>
                        <a href="#" class="paste"><i class="dashicons dashicons-admin-page"></i> <?php rb_e('Paste layer styles', 'RbthemeSlider') ?></a>
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <h5><?php rb_e('Text', 'RbthemeSlider') ?> <span>| <?php rb_e('font &amp; style', 'RbthemeSlider') ?></span></h5>
                    <div class="table-holder">
                        <table>
                            <tbody>

                                <?php
                                $fontList = array(
                                    array('name' => 'Arial', 'font' => true),
                                    array('name' => 'Helvetica', 'font' => true),
                                    array('name' => 'Georgia', 'font' => true),
                                    array('name' => 'Comic Sans MS', 'value' => "'Comic Sans MS'", 'font' => true),
                                    array('name' => 'Impact', 'font' => true),
                                    array('name' => 'Tahoma', 'font' => true),
                                    array('name' => 'Verdana', 'font' => true),
                                );

                                foreach ($googleFonts as $font) : ?>
                                    <?php list($family) = explode(':', $font['param']); ?>
                                    <?php $item = array('font' => true); ?>
                                    <?php
                                    if (strpos($family, '+')) : ?>
                                        <?php $family = str_replace('+', ' ', $family); ?>
                                        <?php $item['value'] = "'{$family}'"; ?>
                                    <?php
                                    endif; ?>

                                    <?php $item['name'] = $family; ?>
                                    <?php $fontList[] = $item; ?>
                                <?php
                                endforeach; ?>
                                <tr>
                                    <td class="right"><?php echo $rbDefaults['layers']['fontFamily']['name'] ?></td>
                                    <td>
                                            <?php rbGetInput($rbDefaults['layers']['fontFamily'], null, array(
                                                'class' => 'auto',
                                                'data-options' => Tools::jsonEncode($fontList)
                                            )) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['fontSize']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['fontSize'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['lineHeight']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['lineHeight'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['textAlign']['name'] ?></td>
                                    <td><?php rbGetSelect($rbDefaults['layers']['textAlign'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['fontWeight']['name'] ?></td>
                                    <td><?php rbGetSelect($rbDefaults['layers']['fontWeight'], null, array('class' => 'auto'), true) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['fontStyle']['name'] ?></td>
                                    <td><?php rbGetSelect($rbDefaults['layers']['fontStyle'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['textDecoration']['name'] ?></td>
                                    <td><?php rbGetSelect($rbDefaults['layers']['textDecoration'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['letterSpacing']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['letterSpacing'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['color']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['color'], null, array('class' => 'auto rb-colorpicker')) ?></td>
                                </tr>
                                <tr class="rb-adv">
                                    <td><?php echo $rbDefaults['layers']['minFontSize']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['minFontSize'], null, array('class' => 'sublayerprop')) ?></td>
                                </tr>
                                <tr class="rb-adv">
                                    <td><?php echo $rbDefaults['layers']['minMobileFontSize']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['minMobileFontSize'], null, array('class' => 'sublayerprop')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php rb_e('Word-wrap', 'RbthemeSlider') ?></td>
                                    <td><?php rbGetCheckbox($rbDefaults['layers']['wordWrap'], null, array('class' => 'auto')) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    <h5><?php rb_e('Misc', 'RbthemeSlider') ?> <span>| <?php rb_e('other settings', 'RbthemeSlider') ?></span></h5>
                    <div class="table-holder">
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['background']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['background'], null, array('class' => 'auto rb-colorpicker')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['opacity']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['opacity'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $rbDefaults['layers']['borderRadius']['name'] ?></td>
                                    <td><?php rbGetInput($rbDefaults['layers']['borderRadius'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr class="rb-adv">
                                    <td>
                                        <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/blend-mode" target="_blank">
                                            <?php echo $rbDefaults['layers']['blendMode']['name'] ?>
                                        </a>
                                    </td>
                                    <td><?php rbGetSelect($rbDefaults['layers']['blendMode'], null, array('class' => 'auto')) ?></td>
                                </tr>
                                <tr class="rb-adv">
                                    <td>
                                        <a href="https://developer.mozilla.org/en/docs/Web/CSS/filter#Functions" target="_blank">
                                            <?php echo $rbDefaults['layers']['filter']['name'] ?>
                                        </a>
                                    </td>
                                    <td><?php rbGetInput($rbDefaults['layers']['filter'], null, array('class' => 'auto')) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="rb-adv">
                <div>
                    <h5><?php rb_e('Transforms', 'RbthemeSlider') ?> <span>| <?php rb_e('between transitions', 'RbthemeSlider') ?></span></h5>
                    <div class="textarea-helper">
                        <table>
                            <tr>
                                <td class="right"><?php echo $rbDefaults['layers']['rotate']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['rotate'], null, array('class' => 'sublayerprop transforms')) ?> &deg;</td>
                                <td class="right"><?php echo $rbDefaults['layers']['scaleX']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['scaleX'], null, array('class' => 'sublayerprop transforms')) ?></td>
                            </tr>
                            <tr>
                                <td class="right"><?php echo $rbDefaults['layers']['rotateX']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['rotateX'], null, array('class' => 'sublayerprop transforms')) ?> &deg;</td>
                                <td class="right"><?php echo $rbDefaults['layers']['scaleY']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['scaleY'], null, array('class' => 'sublayerprop transforms')) ?></td>
                            </tr>
                            <tr>
                                <td class="right"><?php echo $rbDefaults['layers']['rotateY']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['rotateY'], null, array('class' => 'sublayerprop transforms')) ?> &deg;</td>
                                <td class="right"><?php echo $rbDefaults['layers']['skewX']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['skewX'], null, array('class' => 'sublayerprop transforms')) ?> &deg;</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="right"><?php echo $rbDefaults['layers']['skewY']['name'] ?></td>
                                <td><?php rbGetInput($rbDefaults['layers']['skewY'], null, array('class' => 'sublayerprop transforms')) ?> &deg;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="rb-adv">
                <h5><?php rb_e('Custom CSS', 'RbthemeSlider') ?> <span>| <?php rb_e('write your own code', 'RbthemeSlider') ?></span></h5>
                <div class="textarea-helper">
                    <textarea rows="5" cols="50" name="style" class="style" data-help="<?php rb_e('If you want to set style settings other then above, you can use here any CSS codes. Please make sure to write valid markup.', 'RbthemeSlider') ?>"></textarea>
                </div>
            </div>
        </div>

    </div>
</script>
