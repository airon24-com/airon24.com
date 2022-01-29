<?php

class Pack extends PackCore {};
abstract class PaymentModule extends PaymentModuleCore {};
class PrestaShopBackup extends PrestaShopBackupCore {};
class ImageType extends ImageTypeCore {};
class Language extends LanguageCore {};
class Translate extends TranslateCore {};
class State extends StateCore {};
class ImageManager extends ImageManagerCore {};
class WarehouseAddress extends WarehouseAddressCore {};
class AdminController extends AdminControllerCore {};
abstract class ProductListingFrontController extends ProductListingFrontControllerCore {};
class ModuleFrontController extends ModuleFrontControllerCore {};
abstract class Controller extends ControllerCore {};
class FrontController extends FrontControllerCore {};
abstract class ModuleAdminController extends ModuleAdminControllerCore {};
abstract class ProductPresentingFrontController extends ProductPresentingFrontControllerCore {};
class Attribute extends AttributeCore {};
class ConfigurationKPI extends ConfigurationKPICore {};
class HTMLTemplateOrderSlip extends HTMLTemplateOrderSlipCore {};
class HTMLTemplateSupplyOrderForm extends HTMLTemplateSupplyOrderFormCore {};
class HTMLTemplateInvoice extends HTMLTemplateInvoiceCore {};
class HTMLTemplateDeliverySlip extends HTMLTemplateDeliverySlipCore {};
class PDFGenerator extends PDFGeneratorCore {};
class PDF extends PDFCore {};
abstract class HTMLTemplate extends HTMLTemplateCore {};
class HTMLTemplateOrderReturn extends HTMLTemplateOrderReturnCore {};
class CMS extends CMSCore {};
class ConditionsToApproveFinder extends ConditionsToApproveFinderCore {};
class PaymentOptionsFinder extends PaymentOptionsFinderCore {};
class CartChecksum extends CartChecksumCore {};
abstract class AbstractCheckoutStep extends AbstractCheckoutStepCore {};
class CheckoutSession extends CheckoutSessionCore {};
class CheckoutAddressesStep extends CheckoutAddressesStepCore {};
class CheckoutPersonalInformationStep extends CheckoutPersonalInformationStepCore {};
class AddressValidator extends AddressValidatorCore {};
class CheckoutDeliveryStep extends CheckoutDeliveryStepCore {};
class DeliveryOptionsFinder extends DeliveryOptionsFinderCore {};
class CheckoutProcess extends CheckoutProcessCore {};
class CheckoutPaymentStep extends CheckoutPaymentStepCore {};
class Risk extends RiskCore {};
abstract class AbstractLogger extends AbstractLoggerCore {};
class FileLogger extends FileLoggerCore {};
class Employee extends EmployeeCore {};
class CMSCategory extends CMSCategoryCore {};
class ProductSale extends ProductSaleCore {};
class Group extends GroupCore {};
class SpecificPriceFormatter extends SpecificPriceFormatterCore {};
class Uploader extends UploaderCore {};
class Mail extends MailCore {};
class CartRule extends CartRuleCore {};
abstract class ModuleGraphEngine extends ModuleGraphEngineCore {};
abstract class Module extends ModuleCore {};
abstract class CarrierModule extends CarrierModuleCore {};
abstract class ModuleGraph extends ModuleGraphCore {};
abstract class ModuleGridEngine extends ModuleGridEngineCore {};
abstract class ModuleGrid extends ModuleGridCore {};
class Tools extends ToolsCore {};
class Connection extends ConnectionCore {};
class Access extends AccessCore {};
class ValidateConstraintTranslator extends ValidateConstraintTranslatorCore {};
class StockManager extends StockManagerCore {};
abstract class StockManagerModule extends StockManagerModuleCore {};
class Warehouse extends WarehouseCore {};
class Stock extends StockCore {};
class StockMvtWS extends StockMvtWSCore {};
class StockManagerFactory extends StockManagerFactoryCore {};
class SupplyOrder extends SupplyOrderCore {};
class SupplyOrderDetail extends SupplyOrderDetailCore {};
class WarehouseProductLocation extends WarehouseProductLocationCore {};
class SupplyOrderHistory extends SupplyOrderHistoryCore {};
class StockMvtReason extends StockMvtReasonCore {};
class StockAvailable extends StockAvailableCore {};
class SupplyOrderState extends SupplyOrderStateCore {};
class StockMvt extends StockMvtCore {};
class SupplyOrderReceiptHistory extends SupplyOrderReceiptHistoryCore {};
class HelperTreeCategories extends HelperTreeCategoriesCore {};
class HelperKpiRow extends HelperKpiRowCore {};
class HelperView extends HelperViewCore {};
class Helper extends HelperCore {};
class HelperImageUploader extends HelperImageUploaderCore {};
class HelperOptions extends HelperOptionsCore {};
class HelperCalendar extends HelperCalendarCore {};
class HelperForm extends HelperFormCore {};
class HelperKpi extends HelperKpiCore {};
class HelperTreeShops extends HelperTreeShopsCore {};
class HelperUploader extends HelperUploaderCore {};
class HelperList extends HelperListCore {};
class HelperShop extends HelperShopCore {};
class Hook extends HookCore {};
class SupplyOrderStateLang extends SupplyOrderStateLangCore {};
class AttributeGroupLang extends AttributeGroupLangCore {};
class DataLang extends DataLangCore {};
class ProfileLang extends ProfileLangCore {};
class QuickAccessLang extends QuickAccessLangCore {};
class GroupLang extends GroupLangCore {};
class RiskLang extends RiskLangCore {};
class TabLang extends TabLangCore {};
class CmsCategoryLang extends CmsCategoryLangCore {};
class ConfigurationLang extends ConfigurationLangCore {};
class ThemeLang extends ThemeLangCore {};
class FeatureLang extends FeatureLangCore {};
class OrderStateLang extends OrderStateLangCore {};
class CategoryLang extends CategoryLangCore {};
class CarrierLang extends CarrierLangCore {};
class StockMvtReasonLang extends StockMvtReasonLangCore {};
class GenderLang extends GenderLangCore {};
class OrderReturnStateLang extends OrderReturnStateLangCore {};
class OrderMessageLang extends OrderMessageLangCore {};
class FeatureValueLang extends FeatureValueLangCore {};
class ContactLang extends ContactLangCore {};
class AttributeLang extends AttributeLangCore {};
class MetaLang extends MetaLangCore {};
abstract class TreeToolbarButton extends TreeToolbarButtonCore {};
class TreeToolbarLink extends TreeToolbarLinkCore {};
class TreeToolbarSearchCategories extends TreeToolbarSearchCategoriesCore {};
class TreeToolbar extends TreeToolbarCore {};
class Tree extends TreeCore {};
class TreeToolbarSearch extends TreeToolbarSearchCore {};
class Meta extends MetaCore {};
class ManufacturerAddress extends ManufacturerAddressCore {};
class Country extends CountryCore {};
class CustomerMessage extends CustomerMessageCore {};
class Notification extends NotificationCore {};
class TemplateFinder extends TemplateFinderCore {};
class SmartyResourceModule extends SmartyResourceModuleCore {};
class SmartyDevTemplate extends SmartyDevTemplateCore {};
class SmartyResourceParent extends SmartyResourceParentCore {};
class SmartyCustomTemplate extends SmartyCustomTemplateCore {};
class SmartyCustom extends SmartyCustomCore {};
class PhpEncryptionLegacyEngine extends PhpEncryptionLegacyEngineCore {};
class Supplier extends SupplierCore {};
class SearchEngine extends SearchEngineCore {};
class Curve extends CurveCore {};
class Product extends ProductCore {};
class CacheMemcached extends CacheMemcachedCore {};
class CacheApc extends CacheApcCore {};
class CacheXcache extends CacheXcacheCore {};
class CacheMemcache extends CacheMemcacheCore {};
abstract class Cache extends CacheCore {};
class PrestaShopObjectNotFoundException extends PrestaShopObjectNotFoundExceptionCore {};
class PrestaShopException extends PrestaShopExceptionCore {};
class PrestaShopDatabaseException extends PrestaShopDatabaseExceptionCore {};
class PrestaShopModuleException extends PrestaShopModuleExceptionCore {};
class PrestaShopPaymentException extends PrestaShopPaymentExceptionCore {};
class CMSRole extends CMSRoleCore {};
class Cookie extends CookieCore {};
class Guest extends GuestCore {};
abstract class TaxManagerModule extends TaxManagerModuleCore {};
class TaxRulesTaxManager extends TaxRulesTaxManagerCore {};
class TaxCalculator extends TaxCalculatorCore {};
class TaxRule extends TaxRuleCore {};
class Tax extends TaxCore {};
class TaxRulesGroup extends TaxRulesGroupCore {};
class TaxConfiguration extends TaxConfigurationCore {};
class TaxManagerFactory extends TaxManagerFactoryCore {};
class ProductPresenterFactory extends ProductPresenterFactoryCore {};
class ProductSupplier extends ProductSupplierCore {};
class Cart extends CartCore {};
class Page extends PageCore {};
class Context extends ContextCore {};
class Currency extends CurrencyCore {};
class Contact extends ContactCore {};
class Alias extends AliasCore {};
class Profile extends ProfileCore {};
abstract class ObjectModel extends ObjectModelCore {};
class LinkProxy extends LinkProxyCore {};
class Media extends MediaCore {};
class CustomerAddress extends CustomerAddressCore {};
class Message extends MessageCore {};
class Customization extends CustomizationCore {};
class CSV extends CSVCore {};
class Manufacturer extends ManufacturerCore {};
class ConfigurationTest extends ConfigurationTestCore {};
class GroupReduction extends GroupReductionCore {};
class PhpEncryption extends PhpEncryptionCore {};
class Tab extends TabCore {};
class TranslatedConfiguration extends TranslatedConfigurationCore {};
class AddressFormat extends AddressFormatCore {};
class QqUploadedFileForm extends QqUploadedFileFormCore {};
class Zone extends ZoneCore {};
class Feature extends FeatureCore {};
class AttributeGroup extends AttributeGroupCore {};
class Upgrader extends UpgraderCore {};
class Category extends CategoryCore {};
class ProductDownload extends ProductDownloadCore {};
class SpecificPrice extends SpecificPriceCore {};
class Image extends ImageCore {};
class Validate extends ValidateCore {};
class ProductAssembler extends ProductAssemblerCore {};
class FeatureValue extends FeatureValueCore {};
class Gender extends GenderCore {};
class Link extends LinkCore {};
class PhpEncryptionEngine extends PhpEncryptionEngineCore {};
class Configuration extends ConfigurationCore {};
class Search extends SearchCore {};
class Shop extends ShopCore {};
class ShopGroup extends ShopGroupCore {};
class ShopUrl extends ShopUrlCore {};
class CustomizationField extends CustomizationFieldCore {};
class OrderCarrier extends OrderCarrierCore {};
class OrderCartRule extends OrderCartRuleCore {};
class OrderDetail extends OrderDetailCore {};
class Order extends OrderCore {};
class OrderState extends OrderStateCore {};
class OrderDiscount extends OrderDiscountCore {};
class OrderPayment extends OrderPaymentCore {};
class OrderMessage extends OrderMessageCore {};
class OrderReturn extends OrderReturnCore {};
class OrderInvoice extends OrderInvoiceCore {};
class OrderHistory extends OrderHistoryCore {};
class OrderSlip extends OrderSlipCore {};
class OrderReturnState extends OrderReturnStateCore {};
class Tag extends TagCore {};
class RequestSql extends RequestSqlCore {};
class Chart extends ChartCore {};
class QuickAccess extends QuickAccessCore {};
class SupplierAddress extends SupplierAddressCore {};
class Combination extends CombinationCore {};
class CustomerThread extends CustomerThreadCore {};
class Dispatcher extends DispatcherCore {};
class Customer extends CustomerCore {};
class LocalizationPack extends LocalizationPackCore {};
class Carrier extends CarrierCore {};
class ConnectionsSource extends ConnectionsSourceCore {};
class Attachment extends AttachmentCore {};
class QqUploadedFileXhr extends QqUploadedFileXhrCore {};
class Windows extends WindowsCore {};
class FileUploader extends FileUploaderCore {};
class DbQuery extends DbQueryCore {};
class DbPDO extends DbPDOCore {};
class DbMySQLi extends DbMySQLiCore {};
abstract class Db extends DbCore {};
class DateRange extends DateRangeCore {};
class CustomerSession extends CustomerSessionCore {};
class Address extends AddressCore {};
class PrestaShopCollection extends PrestaShopCollectionCore {};
class Delivery extends DeliveryCore {};
class SpecificPriceRule extends SpecificPriceRuleCore {};
class CssMinifier extends CssMinifierCore {};
class JsMinifier extends JsMinifierCore {};
class JavascriptManager extends JavascriptManagerCore {};
class StylesheetManager extends StylesheetManagerCore {};
abstract class AbstractAssetManager extends AbstractAssetManagerCore {};
class CccReducer extends CccReducerCore {};
class Referrer extends ReferrerCore {};
class AddressChecksum extends AddressChecksumCore {};
class PrestaShopLogger extends PrestaShopLoggerCore {};
class RangePrice extends RangePriceCore {};
class RangeWeight extends RangeWeightCore {};
class WebserviceKey extends WebserviceKeyCore {};
class WebserviceSpecificManagementSearch extends WebserviceSpecificManagementSearchCore {};
class WebserviceException extends WebserviceExceptionCore {};
class WebserviceOutputBuilder extends WebserviceOutputBuilderCore {};
class WebserviceRequest extends WebserviceRequestCore {};
class WebserviceOutputXML extends WebserviceOutputXMLCore {};
class WebserviceOutputJSON extends WebserviceOutputJSONCore {};
class WebserviceSpecificManagementImages extends WebserviceSpecificManagementImagesCore {};
class WebserviceSpecificManagementAttachments extends WebserviceSpecificManagementAttachmentsCore {};
class FormField extends FormFieldCore {};
class CustomerPersister extends CustomerPersisterCore {};
class CustomerAddressForm extends CustomerAddressFormCore {};
class CustomerForm extends CustomerFormCore {};
class CustomerAddressFormatter extends CustomerAddressFormatterCore {};
class CustomerFormatter extends CustomerFormatterCore {};
class CustomerLoginForm extends CustomerLoginFormCore {};
class CustomerLoginFormatter extends CustomerLoginFormatterCore {};
abstract class AbstractForm extends AbstractFormCore {};
class CustomerAddressPersister extends CustomerAddressPersisterCore {};
class Store extends StoreCore {};
class EmployeeSession extends EmployeeSessionCore {};
