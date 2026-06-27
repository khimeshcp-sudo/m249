<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Cache\CacheTypeListInterface;
use Magento\Framework\Config\ScopeConfigInterface;

class ConfigSaveObserver implements ObserverInterface
{
    /**
     * @var CacheTypeListInterface
     */
    private $cacheTypeList;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param CacheTypeListInterface $cacheTypeList
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        CacheTypeListInterface $cacheTypeList,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->cacheTypeList = $cacheTypeList;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        // Refresh cache when configuration is saved
        $this->cacheTypeList->cleanType('full_page');
    }
}