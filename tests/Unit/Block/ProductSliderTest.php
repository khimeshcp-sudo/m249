<?php

declare(strict_types=1);

namespace SprintMind\ProductTab\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
use SprintMind\ProductTab\Block\ProductSlider;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;

class ProductSliderTest extends TestCase
{
    private $productSlider;
    private $productFactory;
    private $productCollectionFactory;
    private $storeManager;
    private $registry;

    protected function setUp(): void
    {
        $this->productFactory = $this->createMock(ProductFactory::class);
        $this->productCollectionFactory = $this->createMock(CollectionFactory::class);
        $this->storeManager = $this->createMock(StoreManagerInterface::class);
        $this->registry = $this->createMock(Registry::class);

        $this->productSlider = new ProductSlider(
            $this->createMock(Template::class),
            $this->productFactory,
            $this->productCollectionFactory,
            $this->storeManager,
            $this->registry
        );
    }

    public function testGetProductsReturnsCorrectProducts(): void
    {
        // Arrange
        $this->productSlider->method('getConfigValue')->willReturn('SKU1,SKU2');
        $productCollection = $this->createMock(\Magento\Catalog\Model\ResourceModel\Product\Collection::class);
        $productCollection->method('getItems')->willReturn([]);
        $this->productCollectionFactory->method('create')->willReturn($productCollection);

        // Act
        $products = $this->productSlider->getProducts();

        // Assert
        $this->assertIsArray($products);
        $this->assertCount(0, $products);
    }
}
