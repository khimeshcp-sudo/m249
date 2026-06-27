<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Observer;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Observer\ConfigSaveObserver;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Cache\CacheTypeListInterface;
use Magento\Framework\Config\ScopeConfigInterface;

class ConfigSaveObserverTest extends TestCase
{
    private $observer;
    private $cacheTypeList;

    protected function setUp(): void
    {
        $this->cacheTypeList = $this->createMock(CacheTypeListInterface::class);
        $this->observer = new ConfigSaveObserver($this->cacheTypeList, null);
    }

    public function testExecuteCleansCacheOnConfigSave(): void
    {
        $this->cacheTypeList->expects($this->once())->method('cleanType')->with('full_page');
        $this->observer->execute(new Observer());
    }
}
