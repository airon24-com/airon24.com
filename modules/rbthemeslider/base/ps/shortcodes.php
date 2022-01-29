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

$GLOBALS['rbLoadPlugins'] = array();

class RbShortcode
{

    // List of already included sliders on page.
    // Using to identify duplicates and give them
    // a unique slider ID to avoid issues with caching.
    public static $slidersOnPage = array();

    private function __construct()
    {
    }

    public static function registerShortcode()
    {
        if (!rb_shortcode_exists('rbthemeslider')) {
            rb_add_shortcode('rbthemeslider', array(__CLASS__, 'handleShortcode'));
        }
    }


    /**
     * Handles the shortcode workflow to display the
     * appropriate content.
     *
     * @since 5.3.3
     * @access public
     * @param array $atts Shortcode attributes
     * @return bool True on successful validation, false otherwise
     */

    public static function handleShortcode($atts = array())
    {
        if (self::validateFilters($atts)) {
            $output = '';
            $item = self::validateShortcode($atts);

            // Show error messages (if any)
            if (! empty($item['error'])) {
                // Bail out early if the visitor has no permission to see error messages
                if (! rb_current_user_can(rb_get_option('rbthemeslider_custom_capability', 'manage_options'))) {
                    return '';
                }

                $output .= $item['error'];
            }

            if ($item['data']) {
                $output .= self::processShortcode($item['data'], $atts);
            }

            return $output;
        }
    }


    /**
     * Validates the provided shortcode filters (if any).
     *
     * @since 5.3.3
     * @access public
     * @param array $atts Shortcode attributes
     * @return bool True on successful validation, false otherwise
     */

    public static function validateFilters($atts = array())
    {
        if (empty($atts['filters'])) {
            return true;
        }

        return false;
    }


    /**
     * Validates the shortcode parameters and checks
     * the references slider.
     *
     * @since 5.3.3
     * @access public
     * @param array $atts Shortcode attributes
     * @return bool True on successful validation, false otherwise
     */

    public static function validateShortcode($atts = array())
    {
        $error = false;
        $slider = false;

        // Has ID attribute
        if (!empty($atts['id'])) {
            $sliderID = $atts['id'];

            // Attempt to retrieve the pre-generated markup
            // set via the Transients API
            if (rb_get_option('rb_use_cache', true)) {
                if ($slider = rb_get_transient('rb-slider-data-'.$sliderID)) {
                    $slider['id'] = $sliderID;
                    $slider['_cached'] = true;
                }
            }

            // Slider exists and isn't deleted
            if (empty($slider)) {
                $slider = RbSliders::find($sliderID);
            }

            // ERROR: No slider with ID was found
            if (empty($slider)) {
                $error = self::generateErrorMarkup(
                    rb__('The slider cannot be found', 'Rbthemeslider'),
                    null
                );

            // ERROR: The slider is not published
            } elseif ((int)$slider['flag_hidden']) {
                $error = self::generateErrorMarkup(
                    rb__('Unpublished slider', 'Rbthemeslider'),
                    sprintf(rb__("The slider you've inserted here is yet to be published, thus it won't be displayed to your visitors. You can publish it by enabling the appropriate option in %sSlider Settings -> Publish%s. ", 'Rbthemeslider'), '<a href="'.rb_admin_url('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.(int)$slider['id'].'&showsettings=1#publish').'" target="_blank">', '</a>.'),
                    'dashicons-hidden'
                );

            // ERROR: The slider was removed
            } elseif ((int)$slider['flag_deleted']) {
                $error = self::generateErrorMarkup(
                    rb__('Removed slider', 'Rbthemeslider'),
                    sprintf(rb__("The slider you've inserted here was removed in the meantime, thus it won't be displayed to your visitors. This slider is still recoverable on the admin interface. You can enable listing removed sliders with the Screen Options -> Removed sliders option, then choose the Restore option for the corresponding item to reinstate this slider, or just click %shere%s.", 'Rbthemeslider'), '<a href="'.rb_nonce_url('?page=AdminRbthemesliderSlider&action=restore&id='.$slider['id'].'&ref='.urlencode(rb_get_permalink()), 'restore_'.$slider['id']).'">', '</a>'),
                    'dashicons-trash'
                );

            // ERROR: Scheduled/disabled sliders
            } else {
                $tz = date_default_timezone_get();
                $siteTz = rb_get_option('timezone_string', 'UTC');
                $siteTz = $siteTz ? $siteTz : 'UTC';
                date_default_timezone_set($siteTz);

                if (! empty($slider['schedule_start']) && (int) $slider['schedule_start'] > time()) {
                    $error = self::generateErrorMarkup(
                        sprintf(rb__('This slider is scheduled to display on %s', 'Rbthemeslider'), date('Y-m-d H:i:s', (int) $slider['schedule_start'])),
                        '',
                        'dashicons-calendar-alt',
                        'scheduled'
                    );
                } elseif (! empty($slider['schedule_end']) && (int) $slider['schedule_end'] < time()) {
                    $error = self::generateErrorMarkup(
                        sprintf(rb__('This slider was scheduled to hide on %s ', 'Rbthemeslider'), date('Y-m-d H:i:s', (int) $slider['schedule_end'])),
                        sprintf(rb__('Due to scheduling, this slider is no longer visible to your visitors. If you wish to reinstate this slider, just remove the schedule in %sSlider Settings -> Publish%s.', 'Rbthemeslider'), '<a href="'.rb_admin_url('admin.php?page=AdminRbthemesliderSlider&action=edit&id='.(int) $slider['id'].'&showsettings=1#publish').'" target="_blank">', '</a>'),
                        'dashicons-no-alt',
                        'dead'
                    );
                }

                date_default_timezone_set($tz);

                $context = Context::getContext();
                if (method_exists($context, 'getMobileDetect')) {
                    $context->getMobileDetect();
                } elseif (!$context->mobile_detect) {
                    require_once(_PS_TOOL_DIR_.'mobile_Detect/Mobile_Detect.php');
                    $context->mobile_detect = new Mobile_Detect();
                }
                $device = $context->mobile_detect;
                if (!empty($slider['data']['properties']['disableonmobile']) && $device->isMobile() && !$device->isTablet() ||
                    !empty($slider['data']['properties']['disableontablet']) && $device->isTablet() ||
                    !empty($slider['data']['properties']['disableondesktop']) && !$device->isMobile()) {
                    $error = true;
                }
            }

        // ERROR: No slider ID was provided
        } else {
            $error = self::generateErrorMarkup();
        }

        return array(
            'error' => $error,
            'data' => $slider
        );
    }


    public static function processShortcode($slider, $embed = array())
    {

        // Slider ID
        $sID = 'rbthemeslider_'.$slider['id'];

        // Include init code in the footer?
        $condsc = rb_get_option('rb_conditional_script_loading', false) ? true : false;
        $footer = rb_get_option('rb_include_at_footer', false) ? true : false;
        $footer = $condsc ? true : $footer;

        if (!empty($slider['_cached'])) {
            $output = $slider;
        } else {
            $output = self::generateSliderMarkup($slider, $embed);

            $output['id'] = $slider['id'];
            $output['schedule_start'] = $slider['schedule_start'];
            $output['schedule_end'] = $slider['schedule_end'];
            $output['flag_hidden'] = $slider['flag_hidden'];
            $output['flag_deleted'] = $slider['flag_deleted'];
            $output['data'] = array(
                'properties' => array(
                    'disableonmobile' => !empty($slider['data']['properties']['disableonmobile']),
                    'disableontablet' => !empty($slider['data']['properties']['disableontablet']),
                    'disableondesktop' => !empty($slider['data']['properties']['disableondesktop']),
                ),
            );
            rb_set_transient('rb-slider-data-'.$slider['id'], $output, HOUR_IN_SECONDS * 6);
        }

        // Replace slider ID to avoid issues with enabled caching when
        // adding the same slider to a page in multiple times
        if (array_key_exists($slider['id'], self::$slidersOnPage)) {
            $sliderCount = ++self::$slidersOnPage[ $slider['id'] ];
            $output['init'] = str_replace($sID, $sID.'_'.$sliderCount, $output['init']);
            $output['container'] = str_replace($sID, $sID.'_'.$sliderCount, $output['container']);

            $sID = $sID.'_'.$sliderCount;
        } else {
            // Add current slider ID to identify duplicates later on
            // and give them a unique slider ID to avoid issues with caching.
            self::$slidersOnPage[ $slider['id'] ] = 1;
        }

        // Override firstSlide if it is specified in embed params
        if (! empty($embed['firstslide'])) {
            $output['init'] = str_replace('[firstSlide]', $embed['firstslide'], $output['init']);
        }

        // Filter to override the printed JavaScript init code
        if (rb_has_filter('rbthemeslider_slider_init')) {
            $output['init'] = rb_apply_filters('rbthemeslider_slider_init', $output['init'], $slider, $sID);
        }

        // Unify the whole markup after any potential string replacement
        $output['markup'] = $output['container'].$output['markup'];

        // Filter to override the printed HTML markup
        if (rb_has_filter('rbthemeslider_slider_markup')) {
            $output['markup'] = rb_apply_filters('rbthemeslider_slider_markup', $output['markup'], $slider, $sID);
        }

        // Origami
        if (!empty($output['plugins'])) {
            $GLOBALS['rbLoadPlugins'] = array_merge($GLOBALS['rbLoadPlugins'], $output['plugins']);
            foreach ($output['plugins'] as $plg) {
                rb_enqueue_script('rbthemeslider-'.$plg);
                rb_enqueue_style('rbthemeslider-'.$plg);
            }
        }

        if ($footer) {
            $GLOBALS['rbSliderInit'][] = $output['init'];
            return $output['markup'];
        } else {
            return $output['init'].$output['markup'];
        }
    }


    public static function generateSliderMarkup($slider = null, $embed = array())
    {
        // Bail out early if no params received
        if (!$slider) {
            return array('init' => '', 'container' => '', 'markup' => '');
        }

        // Slider and markup data
        $id = $slider['id'];
        $sliderID = 'rbthemeslider_'.$id;
        $slides = $slider['data'];

        // Store generated output
        $rbInit = array();
        $rbContainer = array();
        $rbMarkup = array();
        $rbPlugins = array();

        // Include slider file
        if (is_array($slides)) {
            // Get phpQuery
            if (! defined('RB_PHPQUERY')) {
                libxml_use_internal_errors(true);
                include RB_ROOT_PATH.'/helpers/phpQuery.php';
            }

            $GLOBALS['rbPremiumNotice'] = array();

            include RB_ROOT_PATH.'/config/defaults.php';
            include RB_ROOT_PATH.'/includes/slider_markup_setup.php';
            include RB_ROOT_PATH.'/includes/slider_markup_html.php';
            include RB_ROOT_PATH.'/includes/slider_markup_init.php';

            // Admin notice when using premium features on non-activated sites
            if (! empty($GLOBALS['rbPremiumNotice'])) {
                array_unshift($rbContainer, self::generateErrorMarkup(
                    rb__('Premium features is available for preview purposes only.', 'Rbthemeslider'),
                    sprintf(rb__("We've detected that you're using premium features in this slider, but you have not yet activated your copy of Rbthemeslider. Premium features in your sliders will not be available for your visitors without activation. %sClick here to learn more%s. Detected features: %s", 'Rbthemeslider'), '<a href="https://support.kreaturamedia.com/docs/Rbthemesliderwp/documentation.html#activation" target="_blank">', '</a>', implode(', ', $GLOBALS['rbPremiumNotice'])),
                    'dashicons-star-filled',
                    'info'
                ));
            }



            $rbInit = implode('', $rbInit);
            $rbContainer = implode('', $rbContainer);
            $rbMarkup = implode('', $rbMarkup);
        }

        // Concatenate output
        if (rb_get_option('rb_concatenate_output', false)) {
            $rbInit = trim(preg_replace('/\s+/u', ' ', $rbInit));
            $rbContainer = trim(preg_replace('/\s+/u', ' ', $rbContainer));
            $rbMarkup = trim(preg_replace('/\s+/u', ' ', $rbMarkup));
        }

        // Bug fix in v5.4.0: Use self closing tag for <source>
        $rbMarkup = str_replace('></source>', ' />', $rbMarkup);

        // Return formatted data
        return array(
            'init' => $rbInit,
            'container' => $rbContainer,
            'markup' => $rbMarkup,
            'plugins' => array_unique($rbPlugins)
        );
    }


    public static function generateErrorMarkup($title = null, $description = null, $logo = 'dashicons-warning', $customClass = '')
    {

        if (! $title) {
            $title = rb__('encountered a problem while it tried to show your slider.', 'Rbthemeslider');
        }

        if (is_null($description)) {
            $description = rb__("Please make sure that you've used the right shortcode or method to insert the slider, and check if the corresponding slider exists and it wasn't deleted previously.", "Rbthemeslider");
        }

        if ($description) {
            $description .= '<br><br>';
        }

        $logo = $logo ? '<i class="rbwp-notification-logo dashicons '.$logo.'"></i>' : '';
        $notice = rb__('Only you and other administrators can see this to take appropriate actions if necessary.', 'Rbthemeslider');

        $classes = array('error', 'info', 'scheduled', 'dead');
        if (! empty($customClass) && ! in_array($customClass, $classes)) {
            $customClass = '';
        }


        return '<div class="clearfix rbwp-notification '.$customClass.'">
                    '.$logo.'
                    <strong>'.$title.'</strong>
                    <span>'.$description.'</span>
                    <small>
                        <i class="dashicons dashicons-lock"></i>
                        '.$notice.'
                    </small>
                </div>';
    }
}
