<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'PrestaShop\Module\PsEventbus\Provider\CustomPriceDataProvider' shared service.

return $this->services['PrestaShop\\Module\\PsEventbus\\Provider\\CustomPriceDataProvider'] = new \PrestaShop\Module\PsEventbus\Provider\CustomPriceDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsEventbus\\Repository\\CustomPriceRepository']) ? $this->services['PrestaShop\\Module\\PsEventbus\\Repository\\CustomPriceRepository'] : $this->load('getCustomPriceRepositoryService.php')) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsEventbus\\Decorator\\CustomPriceDecorator']) ? $this->services['PrestaShop\\Module\\PsEventbus\\Decorator\\CustomPriceDecorator'] : $this->load('getCustomPriceDecoratorService.php')) && false ?: '_'});
