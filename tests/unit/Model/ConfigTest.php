<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigTest extends TestCase
{
    private $scopeConfig;
    private $config;

    protected function setUp(): void
    {
        $this->scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $this->config = new Config($this->scopeConfig);
    }

    public function testGetSkusReturnsArray(): void
    {
        $scope = $this->createMock(ScopeInterface::class);
        $scope->method('getCode')->willReturn('default');
        $this->scopeConfig->method('getValue')->willReturn('sku1, sku2, sku3');

        $result = $this->config->getSkus($scope);
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertEquals(['sku1', 'sku2', 'sku3'], $result);
    }

    public function testGetMaxProductsReturnsInteger(): void
    {
        $scope = $this->createMock(ScopeInterface::class);
        $scope->method('getCode')->willReturn('default');
        $this->scopeConfig->method('getValue')->willReturn('5');

        $result = $this->config->getMaxProducts($scope);
        $this->assertIsInt($result);
        $this->assertEquals(5, $result);
    }

    public function testIsHideOutOfStockReturnsBoolean(): void
    {
        $scope = $this->createMock(ScopeInterface::class);
        $scope->method('getCode')->willReturn('default');
        $this->scopeConfig->method('getValue')->willReturn('1');

        $result = $this->config->isHideOutOfStock($scope);
        $this->assertIsBool($result);
        $this->assertTrue($result);
    }
}