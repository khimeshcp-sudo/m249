<?php

declare(strict_types=1);

namespace Magento\SliderBanner\Test\E2E\SliderBanner;

use Magento\SliderBanner\Api\SliderBanner\Create;
use Magento\SliderBanner\Model\SliderBannerFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{

    public function testCreateSliderBanner()
    {
        $create = new Create();
        $sliderBannerFactory = $this->createMock(SliderBannerFactory::class);
        $sliderBannerFactory->expects($this->once())->method('create')->with(['title' => 'Test Title', 'description' => 'Test Description', 'image' => 'Test Image'])->willReturn($this->createMock(SliderBanner::class));
        $create->execute($sliderBannerFactory);
        $this->assertTrue(true);
    }

}