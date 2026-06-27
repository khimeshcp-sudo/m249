<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Block\ProductSlider;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

class ProductSliderTest extends TestCase
{
    private $block;
    private $productCollectionFactory;

    protected function setUp(): void
    {
        $this->productCollectionFactory = $this->createMock(CollectionFactory::class);
        $context = $this->createMock(Context::class);
        $registry = $this->createMock(Registry::class);
        $storeManager = $this->createMock(StoreManagerInterface::class);

        $this->block = new ProductSlider($context, null, $this->productCollectionFactory, $registry, $storeManager);
    }

    public function testGetProductsReturnsExpectedCollection(): void
    {
        $expectedProducts = [
            (object) ['name' => 'Product 1', 'price' => 100, 'image' => 'image1.jpg'],
            (object) ['name' => 'Product 2', 'price' => 200, 'image' => 'image2.jpg']
        ];

        $this->productCollectionFactory->method('create')->willReturn($this->createMockProductCollection($expectedProducts));

        $products = $this->block->getProducts();

        $this->assertCount(2, $products);
        $this->assertSame('Product 1', $products[0]->name);
        $this->assertSame('Product 2', $products[1]->name);
    }

    private function createMockProductCollection(array $products)
    {
        $mockCollection = $this->createMock(\Magento\Catalog\Model\ResourceModel\Product\Collection::class);
        $mockCollection->method('getItems')->willReturn($products);
        return $mockCollection;
    }
}
