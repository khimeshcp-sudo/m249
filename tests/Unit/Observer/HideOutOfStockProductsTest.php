<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Observer;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Observer\HideOutOfStockProducts;
use Magento\Framework\Event\Observer;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogInventory\Model\StockRegistryInterface;

class HideOutOfStockProductsTest extends TestCase
{
    private $observer;

    protected function setUp(): void
    {
        $collectionFactory = $this->createMock(CollectionFactory::class);
        $stockRegistry = $this->createMock(StockRegistryInterface::class);
        $this->observer = new HideOutOfStockProducts($collectionFactory, $stockRegistry);
    }

    public function testExecuteRemovesOutOfStockProducts(): void
    {
        // Arrange
        $collection = $this->createMock(\Magento\Catalog\Model\ResourceModel\Product\Collection::class);
        $observer = $this->createMock(Observer::class);
        $observer->method('getEvent')->willReturn((object) ['getCollection' => $collection]);

        // Act
        $this->observer->execute($observer);

        // Assert
        // Add assertions to verify that out-of-stock products are removed
    }
}
