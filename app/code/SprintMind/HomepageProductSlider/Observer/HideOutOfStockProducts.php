<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogInventory\Model\StockRegistryInterface;

class HideOutOfStockProducts implements ObserverInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var StockRegistryInterface
     */
    private $stockRegistry;

    /**
     * @param CollectionFactory $collectionFactory
     * @param StockRegistryInterface $stockRegistry
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        StockRegistryInterface $stockRegistry
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->stockRegistry = $stockRegistry;
    }

    /**
     * Execute method for the observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $collection = $observer->getEvent()->getCollection();
        $collection->addAttributeToFilter('status', 1); // Only enabled products
        $collection->addAttributeToFilter('visibility', [
            \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH,
            \Magento\Catalog\Model\Product\Visibility::VISIBILITY_IN_CATALOG
        ]);

        $collection->addAttributeToFilter('sku', ['in' => $this->getConfiguredSkus()]);

        foreach ($collection as $product) {
            $stockItem = $this->stockRegistry->getStockItem($product->getId());
            if (!$stockItem->getIsInStock()) {
                $collection->removeItemByKey($product->getId());
            }
        }
    }

    /**
     * Get configured SKUs from the system configuration
     *
     * @return array
     */
    private function getConfiguredSkus(): array
    {
        // This method should retrieve the SKUs from the configuration
        // Assuming a method exists in a Config model to fetch SKUs
        return explode(',', 'SKU1,SKU2,SKU3'); // Replace with actual config retrieval
    }
}