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
?>
<script type="text/html" id="tmpl-rb-transition-modal">
    <div id="rb-transition-window">
        <header>
            <h1><?php rb_e('Select slide transitions', 'RbthemeSlider') ?></h1>
            <b class="dashicons dashicons-no"></b>
            <div id="tryorigami">
                <img src="<?php echo RB_VIEWS_URL ?>img/admin/origami.png" alt="Try the Origami Effect!">
            </div>
            <div id="transitionmenu" class="filters">
                <span><?php rb_e('Show transitions:', 'RbthemeSlider') ?></span>
                <ul>
                    <li class="active"><?php rb_e('2D', 'RbthemeSlider') ?></li>
                    <li><?php rb_e('3D', 'RbthemeSlider') ?></li>
                    <li><?php rb_e('Custom 2D &amp; 3D', 'RbthemeSlider') ?></li>
                    <li><?php rb_e('Special Effects', 'RbthemeSlider') ?></li>
                </ul>
                <i><?php rb_e('Apply to others', 'RbthemeSlider') ?></i>
                <i class="off"><?php rb_e('Select all', 'RbthemeSlider') ?></i>
            </div>
        </header>
        <div class="km-ui-modal-scrollable inner">
            <div id="rb-transitions-list">

                <!-- 2D -->
                <section data-tr-type="2d_transitions">
                    <div></div>
                </section>

                <!-- 3D -->
                <section data-tr-type="3d_transitions">
                    <div></div>
                </section>

                <!-- Custom 2D -->
                <section data-tr-type="custom_2d_transitions">
                    <h4><?php rb_e('Custom 2D transitions', 'RbthemeSlider') ?></h4>
                    <div>
                        <p><?php rb_e("You haven't created any custom 2D transitions yet.", 'RbthemeSlider') ?></p>
                    </div>
                </section>

                <!-- Custom 3D -->
                <section data-tr-type="custom_3d_transitions">
                    <h4><?php rb_e('Custom 3D transitions', 'RbthemeSlider') ?></h4>
                    <div>
                        <p><?php rb_e("You haven't created any custom 3D transitions yet.", 'RbthemeSlider') ?></p>
                    </div>
                </section>

                <!-- Special Effects -->
                <section data-tr-type="special_effects" id="rb-special-effects">

                <p class="rb-description">
                    <small>
                        <?php rb_e('Special effects are like regular slide transitions and they work in the same way. You can set them on each slide individually. Mixing them with other transitions on other slides is perfectly fine. You can also apply them on all of your slides at once by pressing the "Apply to others" button above. In case of 3D special effects, selecting additional 2D transitions can ensure backward compatibility for older browsers.', 'RbthemeSlider') ?>
                    </small>
                </p>

                    <div class="separated">

                        <table>
                            <tr>
                                <td>
                                    <h4><?php rb_e('Origami transition', 'RbthemeSlider') ?><a class="dashicons dashicons-star-filled" target="_blank" href="https://support.kreaturamedia.com/docs/RbthemeSliderwp/documentation.html#activation" data-help="Premium feature. Click to learn more."></a></h4>
                                </td>
                                <td rowspan="2">
                                    <p>
                                        <?php rb_e('Share your gorgeous photos with the world or your loved ones in a truly inspirational way and create sliders with stunning effects with Origami.', 'RbthemeSlider') ?>
                                    </p>
                                    <small>
                                        <?php rb_e('Origami is a form of 3D transition and it works in the same way as regular slide transitions do. Besides Internet Explorer, Origami works in all the modern browsers (including Edge).', 'RbthemeSlider') ?>
                                    </small>
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <div class="rb-select-special-transition" data-name="transitionorigami">
                                        <span class="dashicons dashicons-yes"></span>
                                        <?php rb_e('Use it on this slide', 'RbthemeSlider') ?>
                                    </div>
                                    <div class="center rb-example-link">
                                        <a href="#" target="_blank"><?php rb_e('Click here for live example', 'RbthemeSlider') ?></a>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>

                    <div class="separated rb-future">
                        <h4><?php rb_e('More effects are coming soon', 'RbthemeSlider') ?></h4>
                    </div>

                </section>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="tmpl-rb-layer-presets">
    <h3 class="header">
        <b class="rb-close dashicons dashicons-no-alt"></b>
    </h3>
    <div class="rb-side-menu">
        <a class="rb-menu-heading">Choose preset</a>
    </div>
    <div class="rb-right-side">
        <div class="rb-container" style="height: 357px;"></div>
        <div class="footer">
            <button id="rb-choose-tr" class="button rb-green-button"><?php rb_e('Choose') ?></button>
        </div>
    </div>
</script>

<script src="<?php echo RB_VIEWS_URL.'js/admin/rb-layer-presets.js' ?>"></script>