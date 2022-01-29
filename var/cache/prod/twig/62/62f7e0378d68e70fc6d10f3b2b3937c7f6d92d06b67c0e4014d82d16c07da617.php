<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__2a18d0e1711aab298ced4bb78a169307e9c380352c6c4b76abebabdca0dba75c */
class __TwigTemplate_a7c7937c8568384a7320768dc629b10a3e696fee50cb5161df5d14190c7f6aef extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"pl\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/shop/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/shop/img/app_icon.png\" />

<title>Produkt • airon24</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminProducts';
    var iso_user = 'pl';
    var lang_is_rtl = '0';
    var full_language_code = 'pl';
    var full_cldr_language_code = 'pl-PL';
    var country_iso_code = 'PL';
    var _PS_VERSION_ = '1.7.8.2';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'Złożono nowe zamówienie w Twoim sklepie.';
    var order_number_msg = 'Numer zamówienia: ';
    var total_msg = 'Razem: ';
    var from_msg = 'Od: ';
    var see_order_msg = 'Zobacz to zamówienie';
    var new_customer_msg = 'Nowy klient zarejestrował się w Twoim sklepie.';
    var customer_name_msg = 'Nazwa klienta: ';
    var new_msg = 'Nowa wiadomość pojawiła się w Twoim sklepie.';
    var see_msg = 'Przeczytaj tą wiadomość';
    var token = '7472725fa1e49e772f2995851d8f6832';
    var token_admin_orders = tokenAdminOrders = '1f1a1c8baa70e47f1bb19dfb6236ee0c';
    var token_admin_customers = '9fcf19d4be2347201d41e65a41d68ac9';
    var token_admin_customer_threads = tokenAdminCustomerThreads = '4df0bed6dbf5f941732125684ce246aa';
    var currentIndex = 'index.php?controller=AdminProducts';
    var employee_token = '8d5b259f8dfdcc3fefe751d9d3048665';
    var choose_language_translate = 'Wybierz język:';
    var default_language = '1';
    var admin_modules_link = '/shop/admin671dxwfsm/index.php/improve/modules/catalog/recommended?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0';
    var admin_notification_get_link = '/shop/admin671dxwfsm/index.php/common/notifications?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0';
    var admin_notification_push_link = adminNotificationPushLink = '/shop/admin671dxwfsm/index.php/common/notifications/ack?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0';
    var tab_modules_list = '';
    var update_success_msg = 'Aktualizacja powiodła się';
    var errorLogin = 'PrestaShop nie mógł zalogować się do Dodatków, sprawdź swoje uprawnienia i połączenie internetowe.';
    var search_product_msg = 'Szukaj produktu';
  </script>

      <link href=\"/shop/admin671dxwfsm/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/admin671dxwfsm/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/modules/gamification/views/css/gamification.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/modules/ps_mbo/views/css/recommended-modules.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/modules/rbthemedream/views/css/lib/rb-font-awesome.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/shop/modules/rbthemefunction/views/css/back.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/shop\\/admin671dxwfsm\\/\";
var baseDir = \"\\/shop\\/\";
var changeFormLanguageUrl = \"\\/shop\\/admin671dxwfsm\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\";
var currency = {\"iso_code\":\"PLN\",\"sign\":\"z\\u0142\",\"name\":\"Z\\u0142oty polski\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"PLN\",\"currencySymbol\":\"z\\u0142\",\"numberSymbols\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.00\\u00a0\\u00a4\",\"negativePattern\":\"-#,##0.00\\u00a0\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\",\",\"\\u00a0\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":false};
var show_new_customers = \"1\";
var show_new_messages = \"1\";
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/shop/admin671dxwfsm/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/shop/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/shop/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/shop/js/admin.js?v=1.7.8.2\"></script>
<script type=\"text/javascript\" src=\"/shop/admin671dxwfsm/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/shop/js/tools.js?v=1.7.8.2\"></script>
<script type=\"text/javascript\" src=\"/shop/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/shop/admin671dxwfsm/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/shop/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/shop/modules/ps_mbo/views/js/recommended-modules.js?v=2.0.1\"></script>
<script type=\"text/javascript\" src=\"/shop/admin671dxwfsm/themes/default/js/bundle/module/module_card.js?v=1.7.8.2\"></script>
<script type=\"text/javascript\" src=\"/shop/modules/rbthemefunction/views/js/back.js\"></script>

  

";
        // line 87
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>

<body
  class=\"lang-pl adminproducts\"
  data-base-url=\"/shop/admin671dxwfsm/index.php\"  data-token=\"de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminDashboard&amp;token=e1053bffd3fe46cb4c3fec19609cceb1\"></a>
      <span id=\"shop_version\">1.7.8.2</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Szybki dostęp
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php/sell/catalog/categories/new?token=9ebeaa6d56f8eb8d507e853cc2ed1bd0\"
                 data-item=\"Nowa kategoria\"
      >Nowa kategoria</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=ee09d6746d6f3740f5fb3df56e8760fa\"
                 data-item=\"Nowy kupon\"
      >Nowy kupon</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php/sell/catalog/products/new?token=9ebeaa6d56f8eb8d507e853cc2ed1bd0\"
                 data-item=\"Nowy produkt\"
      >Nowy produkt</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=81ab88a1999880989122238c48bc5688\"
                 data-item=\"Ocena katalogu\"
      >Ocena katalogu</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php/improve/modules/manage?token=9ebeaa6d56f8eb8d507e853cc2ed1bd0\"
                 data-item=\"Zainstalowane moduły\"
      >Zainstalowane moduły</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminOrders&amp;token=1f1a1c8baa70e47f1bb19dfb6236ee0c\"
                 data-item=\"Zamówienia\"
      >Zamówienia</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"30\"
        data-icon=\"icon-AdminCatalog\"
        data-method=\"add\"
        data-url=\"index.php/sell/catalog/products/4?-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\"
        data-post-link=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminQuickAccesses&token=eaae36b92f75f501cfea0adee614ef63\"
        data-prompt-text=\"Proszę podać nazwę tego skrótu:\"
        data-link=\"Produkty - Lista\"
      >
        <i class=\"material-icons\">add_circle</i>
        Dodaj aktualną stronę do Szybkiego dostępu
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminQuickAccesses&token=eaae36b92f75f501cfea0adee614ef63\">
      <i class=\"material-icons\">settings</i>
      Zarządzaj Szybkiem dostępem
    </a>
  </div>
</div>
      </div>
      <div class=\"component\" id=\"header-search-container\">
        <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/shop/admin671dxwfsm/index.php?controller=AdminSearch&amp;token=feec1c474260b6571a6cead16ca4967a\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Szukaj (np.: indeks produktu, nazwa klienta...)\" aria-label=\"Wyszukiwarka\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Wszędzie
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Wszędzie\" href=\"#\" data-value=\"0\" data-placeholder=\"Czego szukasz?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Wszędzie</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Katalog\" href=\"#\" data-value=\"1\" data-placeholder=\"Nazwa produktu, odniesienie itp.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Katalog</a>
        <a class=\"dropdown-item\" data-item=\"Klienci Wg nazwy\" href=\"#\" data-value=\"2\" data-placeholder=\"Nazwa\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Klienci Wg nazwy</a>
        <a class=\"dropdown-item\" data-item=\"Klienci wg adresu IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Klienci wg adresu IP</a>
        <a class=\"dropdown-item\" data-item=\"Zamówienia\" href=\"#\" data-value=\"3\" data-placeholder=\"ID zamówienia\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Zamówienia</a>
        <a class=\"dropdown-item\" data-item=\"Faktury\" href=\"#\" data-value=\"4\" data-placeholder=\"Numer faktury\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Faktury</a>
        <a class=\"dropdown-item\" data-item=\"Koszyki\" href=\"#\" data-value=\"5\" data-placeholder=\"ID Koszyka\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Koszyki</a>
        <a class=\"dropdown-item\" data-item=\"Moduły\" href=\"#\" data-value=\"7\" data-placeholder=\"Nazwa modułu\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Moduły</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">WYSZUKIWANIE</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
      </div>

      
      
              <div class=\"component\" id=\"header-shop-list-container\">
            <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://greenwat.eu/shop/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      <span>Zobacz sklep</span>
    </a>
  </div>
        </div>
                    <div class=\"component header-right-component\" id=\"header-notifications-container\">
          <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Zamówienia<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Klienci<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Wiadomości<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych zamówień :(<br>
              Czy sprawdziłeś <strong><a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=8ef2f7697ef9664f3a2ae3db18cbaa46\">porzucone koszyki</a></strong>?<br>Może znajdziesz tam swoje następne zamówienie!
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych klientów :(<br>
              Czy jesteś aktywny w mediach społecznościowych?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              Obecnie brak nowych wiadomości.<br>
              Wydaje się, wszyscy Twoi klienci są zadowoleni :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      od <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - zarejestrowany <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
        </div>
      
      <div class=\"component\" id=\"header-employee-container\">
        <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">

      <span class=\"employee-avatar\"><img class=\"avatar rounded-circle\" src=\"http://greenwat.eu/shop/img/pr/default.jpg\" /></span>
      <span class=\"employee_profile\">Witaj ponownie Admin</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/shop/admin671dxwfsm/index.php/configure/advanced/employees/1/edit?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\">
      <i class=\"material-icons\">edit</i>
      <span>Twój profil</span>
    </a>
    </div>

    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/pl/zasoby/dokumentacja\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">book</i> Materiały</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/training?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=training-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">school</i> Trening</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/pl/eksperci\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">person_pin_circle</i> Znajdź eksperta</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com/pl/?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">extension</i> PrestaShop Marketplace</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=help-center-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">help</i> Centrum pomocy</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminLogin&amp;logout=1&amp;token=d78533e16a8567dedc94fc430e1ae911\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Wyloguj się</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/shop/admin671dxwfsm/index.php/configure/advanced/employees/toggle-navigation?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
      <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone\" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminDashboard&amp;token=e1053bffd3fe46cb4c3fec19609cceb1\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Pulpit</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title link-active\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sprzedaż</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/shop/admin671dxwfsm/index.php/sell/orders/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Zamówienia
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/orders/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Zamówienia
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/orders/invoices/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Faktury
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/orders/credit-slips/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Druki kredytowe
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/orders/delivery-slips/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Druk wysyłki
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCarts&amp;token=8ef2f7697ef9664f3a2ae3db18cbaa46\" class=\"link\"> Koszyki zakupowe
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu link-active open ul-open\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/shop/admin671dxwfsm/index.php/sell/catalog/products?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Katalog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo link-active\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/catalog/products?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Produkty
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/catalog/categories?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Kategorie
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/catalog/monitoring/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Monitorowanie
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminAttributesGroups&amp;token=b3fd8dc6b8469de286e495f71c8ab628\" class=\"link\"> Atrybuty &amp; Cechy
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/catalog/brands/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Marki &amp; Dostawcy
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/attachments/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Pliki
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCartRules&amp;token=ee09d6746d6f3740f5fb3df56e8760fa\" class=\"link\"> Rabaty
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/stocks/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Magazyn
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/shop/admin671dxwfsm/index.php/sell/customers/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Klienci
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/customers/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Klienci
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/addresses/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Adresy
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCustomerThreads&amp;token=4df0bed6dbf5f941732125684ce246aa\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Obsługa klienta
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCustomerThreads&amp;token=4df0bed6dbf5f941732125684ce246aa\" class=\"link\"> Obsługa klienta
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/shop/admin671dxwfsm/index.php/sell/customer-service/order-messages/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Wiadomości zamówienia
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminReturn&amp;token=d97fd98eab8b2815307cdd4bb9eb1301\" class=\"link\"> Zwroty produktów
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminLegacyStatsMetrics&amp;token=f49debe2ad3778c2df866161b16c8de3\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Statystyki
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"149\" id=\"subtab-AdminLegacyStatsMetrics\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminLegacyStatsMetrics&amp;token=f49debe2ad3778c2df866161b16c8de3\" class=\"link\"> Statystyki
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"150\" id=\"subtab-AdminMetricsStats\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminMetricsStats&amp;token=5bc1df5b4639020b6fd392bee8711dd7\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Ulepszenia</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/shop/admin671dxwfsm/index.php/improve/modules/manage?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Moduły
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/modules/manage?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Menedżer modułów
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/shop/admin671dxwfsm/index.php/modules/addons/modules/catalog?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Katalog
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/shop/admin671dxwfsm/index.php/improve/design/themes/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Wygląd
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"130\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/design/themes/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Szablony
                                </a>
                              </li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"140\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/shop/admin671dxwfsm/index.php/modules/addons/themes/catalog?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Katalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/design/mail_theme/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Szablon maila
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/design/cms-pages/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Strony
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/design/modules/positions/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Pozycje
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminImages&amp;token=ab2886bcd084fc4c8f492f087229b188\" class=\"link\"> Zdjęcia
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCarriers&amp;token=0621fc0a3ee49f8327cdc78afa0c418f\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Wysyłka
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-60\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"61\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminCarriers&amp;token=0621fc0a3ee49f8327cdc78afa0c418f\" class=\"link\"> Przewoźnicy
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/shipping/preferences/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Preferencje
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/shop/admin671dxwfsm/index.php/improve/payment/payment_methods?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Płatność
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-63\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"64\" id=\"subtab-AdminPayment\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/payment/payment_methods?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Płatności
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/payment/preferences?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Preferencje
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/shop/admin671dxwfsm/index.php/improve/international/localization/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      Międzynarodowy
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-66\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"67\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/international/localization/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Lokalizacja
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/international/zones/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Położenie
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/international/taxes/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Podatki
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/shop/admin671dxwfsm/index.php/improve/international/translations/settings?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Tłumaczenia
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"151\" id=\"subtab-Marketing\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminPsfacebookModule&amp;token=0e3574f433e76ec05feba99d2e736194\" class=\"link\">
                      <i class=\"material-icons mi-campaign\">campaign</i>
                      <span>
                      Marketing
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-151\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"152\" id=\"subtab-AdminPsfacebookModule\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminPsfacebookModule&amp;token=0e3574f433e76ec05feba99d2e736194\" class=\"link\"> Facebook
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"154\" id=\"subtab-AdminPsxMktgWithGoogleModule\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=ddfdcd0c4adcd2b65c78adb1520be514\" class=\"link\"> Google
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"157\" id=\"subtab-AdminRbthemedreamManagement\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemedreamHome&amp;token=5bc7a1b07e60e317e2c67f86c727b19b\" class=\"link\">
                      <i class=\"material-icons mi-dashboard\">dashboard</i>
                      <span>
                      Rb Theme Dream
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-157\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"158\" id=\"subtab-AdminRbthemedreamHome\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemedreamHome&amp;token=5bc7a1b07e60e317e2c67f86c727b19b\" class=\"link\"> Home
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"159\" id=\"subtab-AdminRbthemedreamLink\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemedreamLink&amp;token=008a68445d92f1e20249114fa8b00b17\" class=\"link\"> Link
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"160\" id=\"subtab-AdminRbthemedreamSetting\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemedreamSetting&amp;token=730bb45b92334566e0d2c9051f41f71c\" class=\"link\"> Setting
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"162\" id=\"subtab-AdminRbthemeblogManagement\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogCategories&amp;token=022dbafb235ad711654a10c98dd61a7d\" class=\"link\">
                      <i class=\"material-icons mi-ac_unit\">ac_unit</i>
                      <span>
                      Rb Theme Blog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-162\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"163\" id=\"subtab-AdminRbthemeblogCategories\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogCategories&amp;token=022dbafb235ad711654a10c98dd61a7d\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"164\" id=\"subtab-AdminRbthemeblogPost\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogPost&amp;token=9fc9a21d3262f9c73e65fea5b8b98016\" class=\"link\"> Posts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"165\" id=\"subtab-AdminRbthemeblogComment\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogComment&amp;token=b4d173f255a60e608d9a644ddb85ad3d\" class=\"link\"> Comments
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"166\" id=\"subtab-AdminRbthemeblogTag\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogTag&amp;token=9ff31d57a7138da26cbfdb7dfb996bdf\" class=\"link\"> Tags
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"167\" id=\"subtab-AdminRbthemeblogSetting\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemeblogSetting&amp;token=a957ffd5254dfda0865e3cd3607db497\" class=\"link\"> Settings
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"168\" id=\"subtab-AdminRbthemefunctionManagement\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemefunctionSetting&amp;token=b35d182af7246683579bb38930802035\" class=\"link\">
                      <i class=\"material-icons mi-functions\">functions</i>
                      <span>
                      Rb Theme Function
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-168\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"169\" id=\"subtab-AdminRbthemefunctionSetting\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemefunctionSetting&amp;token=b35d182af7246683579bb38930802035\" class=\"link\"> Setting
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"170\" id=\"subtab-AdminRbthemefunctionReview\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemefunctionReview&amp;token=3e8e76395f8fffe6c558243dbac3fd92\" class=\"link\"> Review
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"171\" id=\"subtab-AdminRbthememenuSetting\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthememenuSetting&amp;token=483787fe0f647efe3e0ee4a6bfca03e4\" class=\"link\">
                      <i class=\"material-icons mi-menu\">menu</i>
                      <span>
                      Rb Theme Menu
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"172\" id=\"subtab-AdminRbthemesliderManagement\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemesliderSlider&amp;token=8dfe742d707c1767982c9bebd5ab2cac\" class=\"link\">
                      <i class=\"material-icons mi-collections\">collections</i>
                      <span>
                      Rb Theme Slider
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-172\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"173\" id=\"subtab-AdminRbthemesliderSlider\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemesliderSlider&amp;token=8dfe742d707c1767982c9bebd5ab2cac\" class=\"link\"> Sliders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"175\" id=\"subtab-AdminRbthemesliderTransition\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemesliderTransition&amp;token=1e9311a3c34bb3aab2a63fc5e017e213\" class=\"link\"> Transition
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"176\" id=\"subtab-AdminRbthemesliderSkin\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemesliderSkin&amp;token=e598f5476b1a3b116f9b36656fa0aa13\" class=\"link\"> Skin Css
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"177\" id=\"subtab-AdminRbthemesliderStyle\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbthemesliderStyle&amp;token=94270319a6538c0fdf005de0eca9bf38\" class=\"link\"> Custom Css
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"178\" id=\"subtab-AdminRbsizeguideManagement\">
                    <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbsizeguideSetting&amp;token=975d13884957714fcb7bb955a6633cc2\" class=\"link\">
                      <i class=\"material-icons mi-show_chart\">show_chart</i>
                      <span>
                      Rb Size Guize
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-178\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"179\" id=\"subtab-AdminRbsizeguideSetting\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbsizeguideSetting&amp;token=975d13884957714fcb7bb955a6633cc2\" class=\"link\"> Setting
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"180\" id=\"subtab-AdminRbsizeguideList\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminRbsizeguideList&amp;token=fb8f24234cf81c01c78ab8463d5faf77\" class=\"link\"> List
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Konfiguruj</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/preferences/preferences?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Preferencje
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/preferences/preferences?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Ogólny
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/order-preferences/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Zamówienia
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/product-preferences/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Produkty
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/customer-preferences/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Klienci
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/contacts/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Kontakt
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/shop/seo-urls/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Ruch
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminSearchConf&amp;token=7d0b45cf674859e4fe259599b12694a9\" class=\"link\"> Szukaj
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"134\" id=\"subtab-AdminGamification\">
                                <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminGamification&amp;token=c56b4f2310c4c6b61c4bfe54b3963942\" class=\"link\"> Merchant Expertise
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/system-information/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Zaawansowane
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/system-information/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Informacja
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/performance/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Wydajność
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/administration/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Administracja
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/emails/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Adres e-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/import/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Importuj
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/employees/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Zespół
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/sql-requests/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Baza danych
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/logs/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Logi
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/webservice-keys/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> API
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"120\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/shop/admin671dxwfsm/index.php/configure/advanced/feature-flags/?_token=de_fvmj-R7sAnQRBkyBvjIs7h3iiTc20HmZuR4Yw0o0\" class=\"link\"> Funkcje eksperymentalne
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>

<div id=\"main-div\">
                
      <div class=\"content-div -notoolbar \">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1297
        $this->displayBlock('content_header', $context, $blocks);
        // line 1298
        echo "                 ";
        $this->displayBlock('content', $context, $blocks);
        // line 1299
        echo "                 ";
        $this->displayBlock('content_footer', $context, $blocks);
        // line 1300
        echo "                 ";
        $this->displayBlock('sidebar_right', $context, $blocks);
        // line 1301
        echo "
            
          </div>
        </div>

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>O nie!</h1>
  <p class=\"mt-3\">
    Wersja mobilna tej strony nie jest jeszcze dostępna.
  </p>
  <p class=\"mt-2\">
    Prosimy korzystać z komputera stacjonarnego, aby uzyskać dostęp do tej strony, dopóki nie zostanie zoptymalizowana pod kątem urządzeń mobilnych.
  </p>
  <p class=\"mt-2\">
    Dziękujemy.
  </p>
  <a href=\"http://greenwat.eu/shop/admin671dxwfsm/index.php?controller=AdminDashboard&amp;token=e1053bffd3fe46cb4c3fec19609cceb1\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Wstecz
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      <div class=\"modal fade\" id=\"modal_addons_connect\" tabindex=\"-1\">
\t<div class=\"modal-dialog modal-md\">
\t\t<div class=\"modal-content\">
\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\"><i class=\"icon-puzzle-piece\"></i> <a target=\"_blank\" href=\"https://addons.prestashop.com/?utm_source=back-office&utm_medium=modules&utm_campaign=back-office-PL&utm_content=download\">PrestaShop Addons</a></h4>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<!--start addons login-->
\t\t\t<form id=\"addons_login_form\" method=\"post\" >
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://addons.prestashop.com/pl/login?email=admin%40airon24.com&amp;firstname=Admin&amp;lastname=Airon&amp;website=http%3A%2F%2Fgreenwat.eu%2Fshop%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-PL&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/shop/admin671dxwfsm/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Połącz swój sklep z rynkiem PrestaShop, żeby automatycznie importować wszystkie zakupione dodatki.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Nie masz konta ?</h4>
\t\t\t\t\t\t<p class='text-justify'>Odkryj siłę PrestaShop Addons! Przeglądaj Oficjalny Rynek PrestaShop i znajdź ponad 3500 innowacyjnych modułów i szablonów, które optymalizują stopnie konwersji, zwiększają ruch, budują lojalność klientów i zwiększają Twoją produktywność</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Połącz się z PrestaShop Addons</h4>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-user\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"username_addons\" name=\"username_addons\" type=\"text\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-key\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"password_addons\" name=\"password_addons\" type=\"password\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a class=\"btn btn-link float-right _blank\" href=\"//addons.prestashop.com/pl/forgot-your-password\">Zapomniałem hasła</a>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row row-padding-top\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/pl/login?email=admin%40airon24.com&amp;firstname=Admin&amp;lastname=Airon&amp;website=http%3A%2F%2Fgreenwat.eu%2Fshop%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-PL&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tUtwórz konto
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"icon-unlock\"></i> Zaloguj się
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"addons_loading\" class=\"help-block\"></div>

\t\t\t</form>
\t\t\t<!--end addons login-->
\t\t\t</div>


\t\t\t\t\t</div>
\t</div>
</div>

    </div>
  
";
        // line 1408
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>
</html>";
    }

    // line 87
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1297
    public function block_content_header($context, array $blocks = [])
    {
    }

    // line 1298
    public function block_content($context, array $blocks = [])
    {
    }

    // line 1299
    public function block_content_footer($context, array $blocks = [])
    {
    }

    // line 1300
    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1408
    public function block_javascripts($context, array $blocks = [])
    {
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "__string_template__2a18d0e1711aab298ced4bb78a169307e9c380352c6c4b76abebabdca0dba75c";
    }

    public function getDebugInfo()
    {
        return array (  1498 => 1408,  1493 => 1300,  1488 => 1299,  1483 => 1298,  1478 => 1297,  1469 => 87,  1461 => 1408,  1352 => 1301,  1349 => 1300,  1346 => 1299,  1343 => 1298,  1341 => 1297,  127 => 87,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__2a18d0e1711aab298ced4bb78a169307e9c380352c6c4b76abebabdca0dba75c", "");
    }
}
