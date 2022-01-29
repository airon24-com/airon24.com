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

require_once(_PS_MODULE_DIR_.'rbthemedream/lib/control/rb-control.php');

class RbDownload extends RbControl
{
    public $module;

    public function __construct()
    {
        parent::__construct();

        $this->module = new Rbthemedream();
        $this->setControl();
    }

    public function setControl()
    {
        $this->addControl(
            'section_download',
            array(
                'label' => $this->module->l('Download'),
                'type' => 'section',
            )
        );

        $this->addControl(
            'link_download',
            array(
                'label' => $this->module->l('The link download'),
                'type' => 'text',
                'placeholder' => $this->module->l('Link download'),
                'label_block' => true,
                'section' => 'section_download',
            )
        );
    }

    public function getDataDownLoad()
    {
        $controls = $this->getControls();

        $data = array(
            'title' => 'Download',
            'controls' => $controls,
            'tabs_controls' => $this->tabs_controls,
            'categories' => array('basic'),
            'keywords' => '',
            'icon' => 'download'
        );

        return $data;
    }

    public function rbRender($instance = array())
    {   
        if (isset($instance['link_download']) && $instance['link_download'] != '') {
            $this->context->smarty->assign(array(
                'rb_link_download' => $instance,
            ));

            return $this->module->fetch('module:rbthemedream/views/templates/widget/rb-download.tpl');
        }

        return;
    }
}