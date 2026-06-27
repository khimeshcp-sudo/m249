<?php

declare(strict_types=1);

namespace SprintMind\ProductTab\Block\ProductSlider;

use Magento\Catalog\Model\Product\Repository as ProductRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product\ProductList\ProductListInterface;

class Slider extends Template
{
    protected $productRepository;
    protected $registry;
    protected $productList;
    protected $maxProducts;
    protected $skus;

    public function __construct(
        Template\Context $context,
        ProductRepository $productRepository,
        Registry $registry,
        ProductListInterface $productList,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
        $this->registry = $registry;
        $this->productList = $productList;
        $this->maxProducts = (int) $this->getConfigValue('product_slider/general/max_products');
        $this->skus = explode(',', $this->getConfigValue('product_slider/general/skus'));
    }

    public function getProducts(): array
    {
        $products = [];
        foreach ($this->skus as $sku) {
            try {
                $product = $this->productRepository->get($sku);
                if ($product->isInStock() && count($products) < $this->maxProducts) {
                    $products[] = $product;
                }
            } catch (NoSuchEntityException $e) {
                // Product not found, skip
            }
        }
        return $products;
    }

    public function getConfigValue(string $path)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
