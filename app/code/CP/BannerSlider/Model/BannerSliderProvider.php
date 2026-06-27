<?php

namespace CP\BannerSlider\Model;

use Magento\Catalog\Model\ProductRepository;
use Magento\Store\Model\StoreManagerInterface;
use CP\BannerSlider\Helper\Data;

class BannerSliderProvider
{
    private $productRepository;
    private $storeManager;
    private $helper;

    public function __construct(ProductRepository $productRepository, StoreManagerInterface $storeManager, Data $helper)
    {
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    public function getProducts(array $skus, bool $hideOutOfStock): array
    {
        $products = [];
        foreach ($skus as $sku) {
            try {
                $product = $this->productRepository->get($sku);
                if ($product->isVisibleInSiteVisibility() && $product->getStatus() == 1) {
                    if ($hideOutOfStock && !$product->isInStock()) {
                        continue;
                    }
                    $products[] = $product;
                }
            } catch (NoSuchEntityException $e) {
                continue;
            }
        }
        return $products;
    }
}
