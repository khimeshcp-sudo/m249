<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Block\ProductSlider;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;

class ProductSliderTest extends TestCase
{
    private $productSlider;

    protected function setUp(): void
    {
        $context = $this->createMock(Context::class);
        $productFactory = $this->createMock(ProductFactory::class);
        $productCollectionFactory = $this->createMock(CollectionFactory::class);
        $storeManager = $this->createMock(StoreManagerInterface::class);
        $registry = $this->createMock(Registry::class);

        $this->productSlider = new ProductSlider(
            $context,
            $productFactory,
            $productCollectionFactory,
            $storeManager,
            $registry
        );
    }

    public function testGetMaxProductsReturnsConfiguredValue(): void
    {
        // Arrange
        $this->productSlider->_scopeConfig = $this->createMock(\Magento\Framework\App\Config\ScopeConfigInterface::class);
        $this->productSlider->_scopeConfig->method('getValue')->willReturn(5);

        // Act
        $maxProducts = $this->productSlider->getMaxProducts();

        // Assert
        $this->assertSame(5, $maxProducts);
    }

    public function testGetProductSkusReturnsConfiguredSkus(): void
    {
        // Arrange
        $this->productSlider->_scopeConfig = $this->createMock(\Magento\Framework\App\Config\ScopeConfigInterface::class);
        $this->productSlider->_scopeConfig->method('getValue')->willReturn('SKU1,SKU2,SKU3');

        // Act
        $skus = $this->productSlider->getProductSkus();

        // Assert
        $this->assertSame(['SKU1', 'SKU2', 'SKU3'], $skus);
    }
}
