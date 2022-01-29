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

class AdminRbthemesliderTransitionController extends ModuleAdminController
{
    public function postProcess()
    {
        parent::postProcess();
        if (isset($this->context->cookie->rb_error)) {
            $this->errors[] = $this->context->cookie->rb_error;
            unset($this->context->cookie->rb_error);
        }
    }

    public function initPageHeaderToolbar()
    {
        // hide header toolbar
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        $GLOBALS['rb_token'] = $this->token;
        $GLOBALS['rb_screen'] = (object) array(
          'id' => 'rbthemeslider_page_rb-transition-builder',
          'base' => 'rbthemeslider_page_rb-transition-builder'
        );
        // simulate wp page
        ${'_GET'}['page'] = 'rb-transition-builder';

        require_once _PS_MODULE_DIR_.$this->module->name.'/helper.php';
        require_once _PS_MODULE_DIR_.'rbthemeslider/views/default.php';
    }

    public function display()
    {
        $this->context->smarty->assign(array('content' => $this->content));
        $this->display_footer = false;

        parent::display();
    }
}
