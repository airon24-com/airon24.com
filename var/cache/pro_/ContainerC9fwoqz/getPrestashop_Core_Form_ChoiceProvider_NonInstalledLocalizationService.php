<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.core.form.choice_provider.non_installed_localization' shared service.

return $this->services['prestashop.core.form.choice_provider.non_installed_localization'] = new \PrestaShop\PrestaShop\Core\Form\ChoiceProvider\NonInstalledLocalizationChoiceProvider(${($_ = isset($this->services['prestashop.core.language.pack.loader.remote']) ? $this->services['prestashop.core.language.pack.loader.remote'] : $this->load('getPrestashop_Core_Language_Pack_Loader_RemoteService.php')) && false ?: '_'}->getLanguagePackList(), ${($_ = isset($this->services['prestashop.adapter.language.validator']) ? $this->services['prestashop.adapter.language.validator'] : ($this->services['prestashop.adapter.language.validator'] = new \PrestaShop\PrestaShop\Adapter\Language\LanguageValidator())) && false ?: '_'}, ${($_ = isset($this->services['prestashop.adapter.data_provider.language']) ? $this->services['prestashop.adapter.data_provider.language'] : ($this->services['prestashop.adapter.data_provider.language'] = new \PrestaShop\PrestaShop\Adapter\Language\LanguageDataProvider())) && false ?: '_'});