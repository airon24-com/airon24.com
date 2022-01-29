<?php
/**
 * 2007-2021 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2021 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

defined('_PS_VERSION_') or exit;

class AdminRbthemesliderSliderController extends ModuleAdminController
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
          'id' => 'toplevel_page_rbthemeslider',
          'base' => 'toplevel_page_rbthemeslider'
        );
        // simulate wp page
        ${'_GET'}['page'] = 'rbthemeslider';

        require_once _PS_MODULE_DIR_.$this->module->name.'/helper.php';

        if (isset(${'_COOKIE'}['rb-login'])) {
            $this->content = '<script>
                var doc = window.parent.document, $ = window.parent.jQuery;
                doc.cookie = "rb-login=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                $(".rb-publish button").click();
                $(doc.getElementById("wpwrap")).css({ opacity: "", pointerEvents: "" });
                $(doc.getElementById("rb-login")).remove();
            </script>';
        } else {
            require_once _PS_MODULE_DIR_.'rbthemeslider/views/default.php';
        }

        $this->context->smarty->unregisterFilter('output', 'smartyPackJSinHTML');
    }

    public function display()
    {
        $tmpl = '<script type="text/html" id="tmpl-template-store">
            <div id="rb-importing-modal-window">
                <header>
                    <h1>'.rb__('Template Store', 'Rbthemeslider').'</h1>
                    <b class="dashicons dashicons-no"></b>
                </header>
                <div class="km-ui-modal-scrollable">
                    <p>
                        '.rb__('Premium templates are only available after you connected your site with PrestaShop\'s marketplace.', 'Rbthemeslider').'
                        <a href="https://www.youtube.com/watch?v=SLFFWyY2NYM" target="_blank" style="font-size:13px">'.rb__('Check this video for more details.').'</a>
                    </p>
                    <button class="button button-primary button-hero" id="btn-connect-ps">'.rb__('Connect to PrestaShop Addons', 'Rbthemeslider').'</button>
                </div>
            </div>
        </script>';
        $this->context->smarty->assign(array('content' => $tmpl.$this->content));
        $this->display_footer = false;

        parent::display();
    }
}
