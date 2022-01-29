<?php
/**
* 2007-2019 PrestaShop
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
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once _PS_MODULE_DIR_ . 'rbsizeguide/classes/RbsizeguideList.php';

class AdminRbsizeguideListController extends ModuleAdminController
{
    public function __construct()
    {
        $this->context = Context::getContext();
        $this->bootstrap = true;
        $this->table = 'rbsizeguide_list';
        $this->identifier = 'id_rbsizeguide_list';
        $this->className = 'RbsizeguideList';
        $this->lang = true;
        $this->bootstrap = true;
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        parent::__construct();

        $this->fields_list = array(
            'id_rbsizeguide_list' => array('title' => $this->l('ID'), 'width' => 100),
            'title' => array('title' => $this->l('Title'), 'width' => 100),
            'active' => array(
                'title' => $this->l('Status'),
                'width' => 100,
                'type' => 'bool',
                'active' => 'status'
            ),
        );
    }

    public function renderForm()
    {
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Rbsizeguide List'),
                'icon' => 'icon-folder-close'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'title',
                    'required' => true,
                    'lang' => true,
                    'col' => 4,
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Content'),
                    'name' => 'content',
                    'required' => true,
                    'lang' => true,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30,
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Active'),
                    'name' => 'active',
                    'is_bool' => true,
                    'required' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            ),
            'buttons' => array(
                'save-and-stay' => array(
                    'title' => $this->l('Save and Stay'),
                    'name' => 'submitAdd'.$this->table.'AndStay',
                    'type' => 'submit',
                    'class' => 'btn btn-default pull-right',
                    'icon' => 'process-icon-save'
                )
            )
        );

        return parent::renderForm();
    }

    public function processAdd()
    {
        $title = Tools::getValue('title_' . $this->context->language->id);
        $content = Tools::getValue('content_' . $this->context->language->id);

        if ($title == '') {
            $this->errors[] = $this->l('Title Not Empty');
        }

        if ($content == '') {
            $this->errors[] = $this->l('Content Not Empty');
        }

        if ($title == '' || $content == '') {
            return false;
        } else {
            return parent::processAdd();
        }
    }

    public function processUpdate()
    {
        $title = Tools::getValue('title_' . $this->context->language->id);
        $content = Tools::getValue('content_' . $this->context->language->id);

        if ($title == '') {
            $this->errors[] = $this->l('Title Not Empty');
        }

        if ($content == '') {
            $this->errors[] = $this->l('Content Not Empty');
        }

        if ($title == '' || $content == '') {
            return false;
        } else {
            return parent::processUpdate();
        }
    }
}
