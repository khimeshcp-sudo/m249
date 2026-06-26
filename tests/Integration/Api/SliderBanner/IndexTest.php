<?php

declare(strict_types=1);

namespace Magento\SliderBanner\Test\Integration\Api\SliderBanner;

use Magento\SliderBanner\Api\SliderBanner\Index;
use Magento\SliderBanner\Model\SliderBannerFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{

    public function testIndexSliderBanner()
    {
        $index = new Index();
        $sliderBannerFactory = $this->createMock(SliderBannerFactory::class);
        $sliderBannerFactory->expects($this->once())->method('create')->with(['title' => 'Test Title', 'description' => 'Test Description', 'image' => 'Test Image'])->willReturn($this->createMock(SliderBanner::class));
        $index->execute($sliderBannerFactory);
        $this->assertTrue(true);
    }

}