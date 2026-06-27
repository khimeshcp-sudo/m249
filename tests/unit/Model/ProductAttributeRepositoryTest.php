<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use SprintMind\MgentoModule\Model\ProductAttributeRepository;
use Magento\Catalog\Model\Product\Repository as ProductRepository;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;

class ProductAttributeRepositoryTest extends TestCase
{
    private $productAttributeRepository;
    private $productRepository;

    protected function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->productAttributeRepository = new ProductAttributeRepository($this->productRepository);
    }

    public function testSetMsppEnable(): void
    {
        $productId = 1;
        $msppEnable = true;

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->expects($this->once())
            ->method('setData')
            ->with('mspp_enable', $msppEnable);

        $this->productRepository->expects($this->once())
            ->method('getById')
            ->with($productId)
            ->willReturn($productMock);

        $this->productRepository->expects($this->once())
            ->method('save')
            ->with($productMock)
            ->willReturn($productMock);

        $result = $this->productAttributeRepository->setMsppEnable($productId, $msppEnable);
        $this->assertSame($productMock, $result);
    }

    public function testGetMsppEnable(): void
    {
        $productId = 1;
        $expectedValue = true;

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->expects($this->once())
            ->method('getData')
            ->with('mspp_enable')
            ->willReturn($expectedValue);

        $this->productRepository->expects($this->once())
            ->method('getById')
            ->with($productId)
            ->willReturn($productMock);

        $result = $this->productAttributeRepository->getMsppEnable($productId);
        $this->assertSame($expectedValue, $result);
    }
}