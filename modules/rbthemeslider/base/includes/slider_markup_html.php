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
    $sliderStyleAttr = null;
    $slides = null;
    $slider = null;
    $rbContainer = null;
    $sliderID = 0;
    $rbPlugins = null;
    $rbMarkup = null;
    $layerAttributes = null;
    $innerAttributes = null;
    $id = 0;
    $rbDefaults = null;
}

// Get slider style
$sliderStyleAttr[] = 'max-width:100%;';
$sliderStyleAttr[] = 'width:'.rbthemeslider_check_unit($slides['properties']['props']['width']).';';

if ((!empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'fullsize') && (empty($slides['properties']['attrs']['fullSizeMode']) || $slides['properties']['attrs']['fullSizeMode'] !== 'fitheight')) {
    $sliderStyleAttr[] = 'height:100vh;';
} else {
    $sliderStyleAttr[] = 'height:'.rbthemeslider_check_unit($slides['properties']['props']['height']).';';
}

if (!empty($slides['properties']['props']['maxwidth'])) {
    $sliderStyleAttr[] = 'max-width:'.rbthemeslider_check_unit($slides['properties']['props']['maxwidth']).';';
}

$sliderStyleAttr[] = 'margin:0 auto;';
if (isset($slides['properties']['props']['sliderStyle'])) {
    $sliderStyleAttr[] = $slides['properties']['props']['sliderStyle'];
}

// Before slider content hook
if (rb_has_action('rbthemeslider_before_slider_content')) {
    rb_do_action('rbthemeslider_before_slider_content');
}

$customClasses = '';
if (!empty($slides['properties']['props']['sliderclass'])) {
    $customClasses = ' '.$slides['properties']['props']['sliderclass'];
}

// Start of slider container
$rbContainer[] = '<div id="'.$sliderID.'" class="rb-wp-container fitvidsignore'.$customClasses.'" style="'.implode('', $sliderStyleAttr).'">';

// Add slides
if (!empty($slider['slides']) && is_array($slider['slides'])) {
    foreach ($slider['slides'] as $slidekey => $slide) {
        // Skip this slide?
        if (!empty($slide['props']['skip']) ||
            !empty($slide['props']['schedule_start']) && strtotime($slide['props']['schedule_start']) > time() ||
            !empty($slide['props']['schedule_end']) && strtotime($slide['props']['schedule_end']) < time()) {
            continue;
        }

        // Get slide attributes
        $slideId = !empty($slide['props']['id']) ? ' id="'.$slide['props']['id'].'"' : '';
        $slideAttrs = !empty($slide['attrs']) ? rb_array_to_attr($slide['attrs']) : '';
        $postContent = false;


        // Check for the origami plugin
        if (! empty($slide['attrs']['transitionorigami'])) {
            $rbPlugins[] = 'origami';
        }

        // Post content
        //if (!isset($slide['props']['post_content']) || $slide['props']['post_content']) {
        $queryArgs = array(
            'post_status' => 'publish',
            'limit' => 1,
            'posts_per_page' => 1,
            'suppress_filters' => false,
            'img_size' => null,
        );

        if (isset($slide['props']['post_offset'])) {
            if ($slide['props']['post_offset'] == -1) {
                $slide['props']['post_offset'] = $slidekey;
            }

            $queryArgs['offset'] = $slide['props']['post_offset'];
        }

        if (!empty($slides['properties']['props']['post_type'])) {
            $queryArgs['post_type'] = $slides['properties']['props']['post_type'];
        }

        if (!empty($slides['properties']['props']['post_orderby'])) {
            $queryArgs['orderby'] = $slides['properties']['props']['post_orderby'];
        }

        if (!empty($slides['properties']['props']['post_order'])) {
            $queryArgs['order'] = $slides['properties']['props']['post_order'];
        }

        if (!empty($slides['properties']['props']['post_categories'][0])) {
            $queryArgs['category__in'] = $slides['properties']['props']['post_categories'];
        }

        if (!empty($slides['properties']['props']['post_tags'][0])) {
            $queryArgs['tag__in'] = $slides['properties']['props']['post_tags'];
        }

        if (!empty($slides['properties']['props']['post_tax_terms'])) {
            $queryArgs['img_size'] = $slides['properties']['props']['post_tax_terms'];
        }

        $postContent = RBPosts::find($queryArgs);
        //}

        // Start of slide
        $slideAttrs = !empty($slideAttrs) ? 'data-rb="'.$slideAttrs.'"' : '';
        $rbMarkup[] = '<div class="rb-slide"'.$slideId.' '.$slideAttrs.'>';

        // Add slide background
        if (! empty($slide['props']['background'])) {
            $rbBG = '';
            $alt = empty($slide['props']['alt']) ? 'Slide background' : $slide['props']['alt'];
            $title = empty($slide['props']['title']) ? '' : 'title="'.$slide['props']['title'].'"';

            if (! empty($slide['props']['backgroundId'])) {
                $rbBG = rb_get_attachment_image($slide['props']['backgroundId'], 'full', false, array('class' => 'rb-bg'));
            } elseif ($slide['props']['background'] == '[image-url]') {
                $src = $postContent->getWithFormat($slide['props']['background']);

                if (is_object($postContent->post)) {
                    $attchID = rb_get_post_thumbnail_id($postContent->post->ID);
                    $rbBG = rb_get_attachment_image($attchID, 'full', false, array('class' => 'rb-bg'));
                }
            } else {
                $src = $slide['props']['background'];
            }

            if (! empty($rbBG)) {
                $rbMarkup[] = $rbBG;
            } elseif (! empty($src)) {
                $rbMarkup[] = '<img src="'.$src.'" class="rb-bg" alt="'.$alt.'" '.$title.'/>';
            }
        }

        // Add slide thumbnail
        if (!isset($slides['properties']['attrs']['thumbnailNavigation']) || $slides['properties']['attrs']['thumbnailNavigation'] != 'disabled') {
            if (!empty($slide['props']['thumbnail'])) {
                $src = !empty($slide['props']['thumbnailId']) ? rb_apply_filters('rb_get_image', $slide['props']['thumbnailId'], $slide['props']['thumbnail']) : $slide['props']['thumbnail'];
                $rbMarkup[] = '<img src="'.$src.'" class="rb-tn" alt="Slide thumbnail" />';
            } elseif (empty($slide['props']['background'])) {
                $skin = isset($slides['properties']['attrs']['skin']) ? $slides['properties']['attrs']['skin'] : 'v6';
                $src = _MODULE_DIR_.'rbthemeslider/views/img/rbthemeslider/skins/'.(Tools::strpos($skin, 'dark') !== false ? 'nothumb-dark.png' : 'nothumb.png');
                $rbMarkup[] = '<img src="'.rb_get_media_link($src).'" class="rb-tn" alt="Slide thumbnail" />';
            }
        }

        // Add layers
        if (!empty($slide['layers']) && is_array($slide['layers'])) {
            foreach ($slide['layers'] as $layerkey => $layer) {
                // Skip this slide?
                if (!empty($layer['props']['skip'])) {
                    continue;
                }

                unset($layerAttributes);
                unset($innerAttributes);
                $layerAttributes = array('style' => '', 'class' => 'rb-l');
                $innerAttributes = array('style' => '', 'class' => '');

                if (empty($layer['props']['url'])) {
                    $innerAttributes =& $layerAttributes;
                }
                isset($layer['props']['html']) or $layer['props']['html'] = '';

                // Get layer type
                $layer['props']['media'] = !empty($layer['props']['media']) ? $layer['props']['media'] : '';
                if (!empty($layer['props']['media'])) {
                    switch ($layer['props']['media']) {
                        case 'img':
                            $layer['props']['type'] = 'img';
                            break;
                        case 'button':
                            $layer['props']['type'] = 'span';
                            break;
                        case 'html':
                        case 'media':
                            $layer['props']['type'] = 'div';
                            break;
                        case 'post':
                            $layer['props']['type'] = 'div';
                            break;
                    }
                }

                // Post layer
                if (!empty($layer['props']['media']) && $layer['props']['media'] == 'post') {
                    $layer['props']['post_text_length'] = !empty($layer['props']['post_text_length']) ? $layer['props']['post_text_length'] : 0;
                    $layer['props']['html'] = $postContent->getWithFormat($layer['props']['html'], $layer['props']['post_text_length']);
                }

                // Skip image layer without src
                if ($layer['props']['type'] == 'img' && empty($layer['props']['image'])) {
                    continue;
                }

                // Create layer
                $first = Tools::substr($layer['props']['html'], 0, 1);
                $last = Tools::substr($layer['props']['html'], -1);

                // Image layer
                $layerIMG = false;
                if ($layer['props']['type'] == 'img') {
                    if (! empty($layer['props']['imageId'])) {
                        $layerIMG = rb_get_attachment_image((int)$layer['props']['imageId'], 'full', false, array('class' => 'rb-l'));
                    } elseif ($layer['props']['image'] == '[image-url]') {
                        if (is_object($postContent->post)) {
                            $attchID = rb_get_post_thumbnail_id($postContent->post->ID);
                            $layerIMG = rb_get_attachment_image($attchID, 'full', false, array('class' => 'rb-l'));
                        } else {
                            $innerAttributes['src'] = $postContent->getWithFormat($layer['props']['image']);
                        }
                    } else {
                        $innerAttributes['src'] = $layer['props']['image'];

                        if (!empty($layer['props']['alt'])) {
                            $innerAttributes['alt'] = $layer['props']['alt'];
                        } else {
                            $innerAttributes['alt'] = '';
                        }
                    }
                }

                if ($layer['props']['media'] == 'post' && ($first == '<' && $last == '>')) {
                    $type = $layer['props']['html'];
                } else {
                    $type = ! empty($layerIMG) ? $layerIMG : '<'.$layer['props']['type'].'>';
                }

                if (! empty($layer['props']['url'])) {
                    $el = RbQuery::newDocumentHTML('<a>');
                    if ($layer['props']['url'] == '[url]') {
                        $layer['props']['url'] = $postContent->getWithFormat($layer['props']['url']);
                    }
                    $layerAttributes['href'] = $layer['props']['url'];
                    if (!empty($layer['props']['target'])) {
                        $layerAttributes['target'] =  $layer['props']['target'];
                    }

                    $inner = $el->append($type)->children();
                } else {
                    $el = $inner = RbQuery::newDocumentHTML($type);
                }

                // HTML attributes
                $layerAttributes['class'] = 'rb-l';
                if (!empty($layer['props']['id'])) {
                    $innerAttributes['id'] = $layer['props']['id'];
                }
                if (!empty($layer['props']['class'])) {
                    $innerAttributes['class'] .= ' '.$layer['props']['class'];
                }
                if (!empty($layer['props']['url'])) {
                    if (!empty($layer['props']['rel'])) {
                        $layerAttributes['rel'] = $layer['props']['rel'];
                    }
                    if (!empty($layer['props']['title'])) {
                        $layerAttributes['title'] = $layer['props']['title'];
                    }
                } else {
                    if (!empty($layer['props']['title'])) {
                        $innerAttributes['title'] = $layer['props']['title'];
                    }
                }

                if (isset($layer['attrs']) && isset($layer['props']['transition'])) {
                    $layerAttributes['data-rb'] = rb_array_to_attr($layer['attrs']);
                } elseif (isset($layer['attrs'])) {
                    $layerAttributes['style'] .= rb_array_to_attr($layer['attrs']);
                }

                if (!empty($layer['props']['style'])) {
                    if (Tools::substr($layer['props']['style'], -1) != ';') {
                        $layer['props']['style'] .= ';';
                    }
                    $innerAttributes['style'] .= preg_replace('/\s\s+/', ' ', $layer['props']['style']);
                }

                if (! empty($layer['props']['wordwrap']) || ! empty($layer['props']['styles']['wordwrap'])) {
                    $innerAttributes['style'] .= 'white-space: normal;';
                }

                if (!empty($layer['props']['styles'])) {
                    unset($layer['props']['styles']['wordwrap']);
                    $innerAttributes['style'] .= rb_array_to_attr($layer['props']['styles'], 'css');
                }

                // Text / HTML layer
                if ($layer['props']['media'] != 'post' || ($first != '<' && $last != '>')) {
                    $inner->html(_ss($layer['props']['html']));
                }

                // Rewrite Youtube/Vimeo iframe src to data-src
                $video = $inner->find('iframe[src*="youtube-nocookie.com"], iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="player.vimeo"]');
                if ($video->length) {
                    $video->attr('data-src', $video->attr('src'));
                    $video->removeAttr('src');
                }

                // Device dependent responsive classes
                if (! empty($layer['props']['hide_on_desktop'])) {
                    $layerAttributes['class'] .=  ' rb-hide-desktop';
                }

                if (! empty($layer['props']['hide_on_tablet'])) {
                    $layerAttributes['class'] .= ' rb-hide-tablet';
                }

                if (! empty($layer['props']['hide_on_phone'])) {
                    $layerAttributes['class'] .= ' rb-hide-phone';
                }

                $el->attr($layerAttributes);
                $inner->attr($innerAttributes);

                if (! empty($layer['props']['outerAttributes'])) {
                    foreach ($layer['props']['outerAttributes'] as $key => $val) {
                        if ($key === 'class') {
                            $el->addClass($val);
                        }
                        $el->attr($key, $val);
                    }
                }

                if (! empty($layer['props']['innerAttributes'])) {
                    foreach ($layer['props']['innerAttributes'] as $key => $val) {
                        if ($key === 'class') {
                            $inner->addClass($val);
                        }
                        $inner->attr($key, $val);
                    }
                }

                $rbMarkup[] = $el;
                RbQuery::unloadDocuments();
            }
        }

        // Link this slide
        if (!empty($slide['props']['linkUrl'])) {
            if (!empty($slide['props']['linkTarget'])) {
                $target = ' target="'.$slide['props']['linkTarget'].'"';
            } else {
                $target = '';
            }

            if ($slide['props']['linkUrl'] == '[url]') {
                $slide['props']['linkUrl'] = $postContent->getWithFormat($slide['props']['linkUrl']);
            }

            $linkClass = 'rb-link';
            if (empty($slide['props']['linkType']) || $slide['props']['linkType'] === 'over') {
                $linkClass .= ' rb-link-on-top';
            }

            $rbMarkup[] = '<a href="'.$slide['props']['linkUrl'].'"'.$target.' class="'.$linkClass.'"></a>';
        }

        // End of slide
        $rbMarkup[] = '</div>';
    }
}

// End of slider container
$rbMarkup[] = '</div>';

// After slider content hook
if (rb_has_action('rbthemeslider_after_slider_content')) {
    rb_do_action('rbthemeslider_after_slider_content');
}
