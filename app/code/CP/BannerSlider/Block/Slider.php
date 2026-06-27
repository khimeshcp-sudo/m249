<?php

namespace CP\BannerSlider\Block;

use Magento\Framework\View\Element\Template;
use CP\BannerSlider\Model\BannerSliderProvider;
use Magento\Framework\Registry;

class Slider extends Template
{
    protected $bannerSliderProvider;
    protected $registry;

    public function __construct(
        Template\Context $context,
        BannerSliderProvider $bannerSliderProvider,
        Registry $registry,
        array $data = []
    ) {
        $this->bannerSliderProvider = $bannerSliderProvider;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getProducts(): array
    {
        $skus = $this->getConfigData('cp_bannerslider/general/skus');
        $hideOutOfStock = (bool)$this->getConfigData('cp_bannerslider/general/hide_out_of_stock');
        return $this->bannerSliderProvider->getProducts(explode(',', $skus), $hideOutOfStock);
    }

    protected function getConfigData($path)
    {
        return $this->getScopeConfig()->getValue($path);
    }
}
