<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigTest extends TestCase
{
    private $config;

    protected function setUp(): void
    {
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $this->config = new Config($scopeConfig);
    }

    public function testGetMaxProductsReturnsConfiguredValue(): void
    {
        // Arrange
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->method('getValue')->willReturn(10);
        $this->config = new Config($scopeConfig);

        // Act
        $maxProducts = $this->config->getMaxProducts();

        // Assert
        $this->assertSame(10, $maxProducts);
    }

    public function testIsSliderEnabledReturnsTrueWhenEnabled(): void
    {
        // Arrange
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->method('getValue')->willReturn(1);
        $this->config = new Config($scopeConfig);

        // Act
        $isEnabled = $this->config->isSliderEnabled();

        // Assert
        $this->assertTrue($isEnabled);
    }
}
