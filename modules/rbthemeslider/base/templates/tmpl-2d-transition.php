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
<script type="text/html" id="rb-2d-transition-template">
    <div class="rb-transition-item">
        <table class="box rb-tr-settings bottomborder">
            <thead>
                <tr>
                    <td colspan="2"><?php rb_e('Preview', 'RbthemeSlider') ?></td>
                    <td colspan="2"><?php rb_e('Tiles', 'RbthemeSlider') ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="rb-builder-preview rb-transition-preview">
                            <img src="<?php echo RB_VIEWS_URL ?>img/admin/sample_slide_1.png" alt="preview image">
                        </div>
                    </td>
                    <td colspan="2">
                        <table class="tiles">
                            <tbody>
                                <tr>
                                    <td class="right"><?php rb_e('Rows', 'RbthemeSlider') ?></td>
                                    <td><input type="text" name="rows" value="1" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many rows of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                    <td class="right"><?php rb_e('Cols', 'RbthemeSlider') ?></td>
                                    <td><input type="text" name="cols" value="1" data-help="<?php rb_e('<i>number</i> or <i>min,max</i> If you specify a value greater than 1, RbthemeSlider will cut your slide into tiles. You can specify here how many columns of your transition should have. If you specify two numbers separated with a comma, RbthemeSlider will use that as a range and pick a random number between your values.', 'RbthemeSlider') ?>"></td>
                                </tr>
                            </tbody>
                            <tbody class="tile">
                                <tr>
                                    <td class="right"><?php rb_e('Delay', 'RbthemeSlider') ?></td>
                                    <td><input type="text" name="delay" value="75" data-help="<?php rb_e('You can apply a delay between the tiles and postpone their animation relative to each other.', 'RbthemeSlider') ?>"></td>
                                    <td class="right"><?php rb_e('Sequence', 'RbthemeSlider') ?></td>
                                    <td>
                                        <select name="sequence" data-help="<?php rb_e('You can control the animation order of the tiles here.', 'RbthemeSlider') ?>">
                                            <option value="forward"><?php rb_e('Forward', 'RbthemeSlider') ?></option>
                                            <option value="reverse"><?php rb_e('Reverse', 'RbthemeSlider') ?></option>
                                            <option value="col-forward"><?php rb_e('Col-forward', 'RbthemeSlider') ?></option>
                                            <option value="col-reverse"><?php rb_e('Col-reverse', 'RbthemeSlider') ?></option>
                                            <option value="random"><?php rb_e('Random', 'RbthemeSlider') ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <td colspan="4"><?php rb_e('Transition', 'RbthemeSlider') ?></td>
                </tr>
            </thead>
            <tbody class="transition">
                <tr>
                    <td class="right"><?php rb_e('Duration', 'RbthemeSlider') ?></td>
                    <td><input type="text" name="duration" value="1000" data-help="<?php rb_e('The duration of the animation. This value is in millisecs, so the value 1000 measn 1 second.', 'RbthemeSlider') ?>"></td>
                    <td class="right"><a href="http://easings.net/" target="_blank"><?php rb_e('Easing', 'RbthemeSlider') ?></a></td>
                    <td>
                        <select name="easing" data-help="<?php rb_e('The timing function of the animation. With this function you can manipulate the movement of the animated object. Please click on the link next to this select field to open easings.net for more information and real-time examples.', 'RbthemeSlider') ?>">
                            <option>linear</option>
                            <option>swing</option>
                            <option>easeInQuad</option>
                            <option>easeOutQuad</option>
                            <option>easeInOutQuad</option>
                            <option>easeInCubic</option>
                            <option>easeOutCubic</option>
                            <option>easeInOutCubic</option>
                            <option>easeInQuart</option>
                            <option>easeOutQuart</option>
                            <option>easeInOutQuart</option>
                            <option>easeInQuint</option>
                            <option>easeOutQuint</option>
                            <option selected="selected">easeInOutQuint</option>
                            <option>easeInSine</option>
                            <option>easeOutSine</option>
                            <option>easeInOutSine</option>
                            <option>easeInExpo</option>
                            <option>easeOutExpo</option>
                            <option>easeInOutExpo</option>
                            <option>easeInCirc</option>
                            <option>easeOutCirc</option>
                            <option>easeInOutCirc</option>
                            <option>easeInElastic</option>
                            <option>easeOutElastic</option>
                            <option>easeInOutElastic</option>
                            <option>easeInBack</option>
                            <option>easeOutBack</option>
                            <option>easeInOutBack</option>
                            <option>easeInBounce</option>
                            <option>easeOutBounce</option>
                            <option>easeInOutBounce</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="right"><?php rb_e('Type', 'RbthemeSlider') ?></td>
                    <td>
                        <select name="type" data-help="<?php rb_e('The type of the animation, either slide, fade or both (mixed).', 'RbthemeSlider') ?>">
                            <option value="slide"><?php rb_e('Slide', 'RbthemeSlider') ?></option>
                            <option value="fade"><?php rb_e('Fade', 'RbthemeSlider') ?></option>
                            <option value="mixed"><?php rb_e('Mixed', 'RbthemeSlider') ?></option>
                        </select>
                    </td>
                    <td class="right"><?php rb_e('Direction', 'RbthemeSlider') ?></td>
                    <td>
                        <select name="direction" data-help="<?php rb_e('The direction of the slide or mixed animation if you\'ve chosen this type in the previous settings.', 'RbthemeSlider') ?>">
                            <option value="top"><?php rb_e('Top', 'RbthemeSlider') ?></option>
                            <option value="right"><?php rb_e('Right', 'RbthemeSlider') ?></option>
                            <option value="bottom"><?php rb_e('Bottom', 'RbthemeSlider') ?></option>
                            <option value="left"><?php rb_e('Left', 'RbthemeSlider') ?></option>
                            <option value="random"><?php rb_e('Random', 'RbthemeSlider') ?></option>
                            <option value="topleft"><?php rb_e('Top left', 'RbthemeSlider') ?></option>
                            <option value="topright"><?php rb_e('Top right', 'RbthemeSlider') ?></option>
                            <option value="bottomleft"><?php rb_e('Bottom left', 'RbthemeSlider') ?></option>
                            <option value="bottomright"><?php rb_e('Bottom right', 'RbthemeSlider') ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="right"><?php rb_e('RotateX', 'RbthemeSlider') ?></td>
                    <td><input type="text" name="rotateX" value="0" data-help="<?php rb_e('The initial rotation of the individual tiles which will be animated to the default (0deg) value around the X axis. You can use negatuve values.', 'RbthemeSlider') ?>"></td>
                    <td class="right"><?php rb_e('RotateY', 'RbthemeSlider') ?></td>
                    <td><input type="text" name="rotateY" value="0" data-help="<?php rb_e('The initial rotation of the individual tiles which will be animated to the default (0deg) value around the Y axis. You can use negatuve values.', 'RbthemeSlider') ?>"></td>
                </tr>
                <tr>
                    <td class="right"><?php rb_e('RotateZ', 'RbthemeSlider') ?></td>
                    <td><input type="text" name="rotate" value="0" data-help="<?php rb_e('The initial rotation of the individual tiles which will be animated to the default (0deg) value around the Z axis. You can use negatuve values.', 'RbthemeSlider') ?>"></td>
                    <td class="right"><?php rb_e('Scale', 'RbthemeSlider') ?></td>
                    <td><input type="text" name="scale" value="1.0" data-help="<?php rb_e('The initial scale of the individual tiles which will be animated to the default (1.0) value.', 'RbthemeSlider') ?>"></td>
                </tr>
            </tbody>
        </table>
    </div>
</script>