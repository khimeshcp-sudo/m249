<?php

declare(strict_types=1);

namespace Magento\SliderBanner\Test\Unit\Model;

use Magento\SliderBanner\Model\SliderBanner;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SliderBannerTest extends TestCase
{

    public function testValidateDataModel()
    {
        $sliderBanner = new SliderBanner();
        $this->assertTrue($sliderBanner->validate());
    }

    public function testValidateDataModelWithInvalidData()
    {
        $sliderBanner = new SliderBanner();
        $sliderBanner->setTitle('');
        $this->assertFalse($sliderBanner->validate());
    }

}