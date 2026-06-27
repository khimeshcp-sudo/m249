<?php

namespace CP\BannerSlider\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function getSkusArray(string $skus): array
    {
        $skusArray = array_unique(array_filter(array_map('trim', explode('\n', $skus))));
        return $skusArray;
    }
}
