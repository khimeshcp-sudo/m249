<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getSkus(ScopeInterface $scope): array
    {
        $skus = $this->scopeConfig->getValue('homepage_product_slider/skus', $scope->getCode());
        return array_filter(array_map('trim', explode(',', $skus)));
    }

    public function getMaxProducts(ScopeInterface $scope): int
    {
        return (int)$this->scopeConfig->getValue('homepage_product_slider/max_products', $scope->getCode());
    }

    public function isHideOutOfStock(ScopeInterface $scope): bool
    {
        return (bool)$this->scopeConfig->getValue('homepage_product_slider/hide_out_of_stock', $scope->getCode());
    }
}