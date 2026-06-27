<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Block\ProductSlider;
use Magento\Framework\View\Element\Template;

class ProductSliderTest extends TestCase
{
    private $block;

    protected function setUp(): void
    {
        $this->block = new ProductSlider();
    }

    public function testGetProductsReturnsArray(): void
    {
        $this->block->setProducts([['name' => 'Product 1'], ['name' => 'Product 2']]);
        $result = $this->block->getProducts();
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    public function testGetMaxProductsReturnsConfiguredValue(): void
    {
        $this->block->setMaxProducts(5);
        $result = $this->block->getMaxProducts();
        $this->assertEquals(5, $result);
    }
}