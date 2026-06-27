<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private const XML_PATH_SKUS = 'homepage_product_slider/skus';
    private const XML_PATH_MAX_PRODUCTS = 'homepage_product_slider/max_products';
    private const XML_PATH_ENABLE_SLIDER = 'homepage_product_slider/enable_slider';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getSkus(string $scopeCode = null): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_SKUS, ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    public function getMaxProducts(string $scopeCode = null): int
    {
        return (int)$this->scopeConfig->getValue(self::XML_PATH_MAX_PRODUCTS, ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    public function isSliderEnabled(string $scopeCode = null): bool
    {
        return (bool)$this->scopeConfig->getValue(self::XML_PATH_ENABLE_SLIDER, ScopeInterface::SCOPE_STORE, $scopeCode);
    }
}