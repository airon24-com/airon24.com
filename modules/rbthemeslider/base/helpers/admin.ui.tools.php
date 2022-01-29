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

function rbOptionRow($type, $default, $current, $attrs = array(), $trClasses = '', $forceOptionVal = false)
{

    $wrapperStart = '';
    $wrapperEnd = '';
    $control = '';

    if (! empty($default['advanced'])) {
        $trClasses .= ' rb-advanced rb-hidden';
        $wrapperStart = '<div><i class="dashicons dashicons-flag" data-help="'.rb__('Advanced option', 'rbthemeslider').'"></i>';
        $wrapperEnd = '</div>';
    }


    switch ($type) {
        case 'input':
            $control = rbGetInput($default, $current, $attrs, true);
            break;

        case 'checkbox':
            $control = rbGetCheckbox($default, $current, $attrs, true);
            break;

        case 'select':
            $control = rbGetSelect($default, $current, $attrs, $forceOptionVal, true);
            break;
    }

    $trClasses = ! empty($trClasses) ? ' class="'.$trClasses.'"' : '';

    echo '<tr'.$trClasses.'>
    <td>'.$wrapperStart.''.$default['name'].''.$wrapperEnd.'</td>
    <td>'.$control.'</td>
    <td class="desc">'.(isset($default['desc']) ? $default['desc'] : '').'</td>
</tr>';
}

function rbGetInput($default, $current, $attrs = array(), $return = false)
{

    // Markup
    $el = RbQuery::newDocumentHTML('<input>');
    $attributes = array();

    $attributes['value'] = $default['value'];
    $attributes['type']  = is_string($default['value']) ? 'text' : 'number';
    $attributes['name']  = $name = is_string($default['keys']) ? $default['keys'] : $default['keys'][0];

    $attrs = isset($default['attrs']) ? array_merge($default['attrs'], $attrs) : $attrs;
    if (! empty($attrs) && is_array($attrs)) {
        $attributes = array_merge($attributes, $attrs);
    }

    if (isset($default['tooltip'])) {
        $attributes['data-help'] = $default['tooltip'];
    }

    // Combo box
    if (! empty($attributes['data-options'])) {
        if (empty($attributes['class'])) {
            $attributes['class'] = '';
        }

        $attributes['class'] .= ' km-combo-input';
        // $attributes['autocomplete'] = 'off';
    }

    // Override the default
    if (isset($current[$name]) && $current[$name] !== '') {
        $attributes['value'] = htmlspecialchars(_ss($current[$name]));
    }

    $attributes['data-value'] = $attributes['value'];
    $el->attr($attributes);

    $ret = (string) $el;
    RbQuery::unloadDocuments();

    if ($return) {
        return $ret;
    } else {
        echo $ret;
    }
}

function rbGetCheckbox($default, $current, $attrs = array(), $return = false)
{

    // Markup
    $el = RbQuery::newDocumentHTML('<input>');
    $attributes = array();

    $attributes['value'] = $default['value'];
    $attributes['type']  = 'checkbox';
    $attributes['name']  = $name = is_string($default['keys']) ? $default['keys'] : $default['keys'][0];

    $attrs = isset($default['attrs']) ? array_merge($default['attrs'], $attrs) : $attrs;
    if (! empty($attrs) && is_array($attrs)) {
        $attributes = array_merge($attributes, $attrs);
    }

    if (isset($default['tooltip'])) {
        $attributes['data-help'] = $default['tooltip'];
    }

    // Checked?
    $attributes['data-value'] = false;
    if ($default['value'] === true && (! isset($current[$name]) || count($current) < 3)) {
        $attributes['checked'] = 'checked';
        $attributes['data-value'] = 'true';
    } elseif (isset($current[$name]) && $current[$name] != false && $current[$name] !== 'false') {
        $attributes['checked'] = 'checked';
        $attributes['data-value'] = 'true';
    }

    $attributes['value'] = $attributes['data-value'];
    $el->attr($attributes);

    $ret = (string) $el;
    RbQuery::unloadDocuments();

    if ($return) {
        return $ret;
    } else {
        echo $ret;
    }
}

function rbGetSelect($default, $current, $attrs = array(), $forceOptionVal = false, $return = false)
{

    // Var to hold data to print
    $el = RbQuery::newDocumentHTML('<select>');
    $attributes = array();
    $options     = array();
    $listItems  = array();

    $attributes['value'] = $value = $default['value'];
    $attributes['name']  = $name  = is_string($default['keys']) ? $default['keys'] : $default['keys'][0];

    // Attributes
    $attrs = isset($default['attrs']) ? array_merge($default['attrs'], $attrs) : $attrs;
    if (! empty($attrs) && is_array($attrs)) {
        $attributes = array_merge($attributes, $attrs);
    }

    // Get options
    if (isset($default['options']) && is_array($default['options'])) {
        $options = $default['options'];
    } elseif (isset($attrs['options']) && is_array($attrs['options'])) {
        $options = $attrs['options'];
    }

    // Override the default
    if (isset($current[$name]) && $current[$name] !== '') {
        $attributes['value'] = $value = $current[$name];
    }

    // Tooltip
    if (isset($default['tooltip'])) {
        $attributes['data-help'] = $default['tooltip'];
    }

    // Add options
    foreach ($options as $name => $val) {
        $name = (is_string($name) || $forceOptionVal) ? $name : $val;
        $name = ($name === 'zero') ? 0 : $name;


        $checked = ($name == $value) ? ' selected="selected"' : '';
        $listItems[] = "<option value=\"$name\" $checked>$val</option>";
    }

    $attributes['data-value'] = $attributes['value'];
    $el->append(implode('', $listItems))->attr($attributes);

    $ret = (string) $el;
    RbQuery::unloadDocuments();

    if ($return) {
        return $ret;
    } else {
        echo $ret;
    }
}
