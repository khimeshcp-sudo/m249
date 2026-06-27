<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Block\ProductSlider;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\Product\Repository;

class Item extends Template
{
    /** @var ProductFactory */
    private $productFactory;

    /** @var Repository */
    private $productRepository;

    /**
     * @param Context $context
     * @param ProductFactory $productFactory
     * @param Repository $productRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        ProductFactory $productFactory,
        Repository $productRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    /**
     * Get product by SKU
     *
     * @param string $sku
     * @return mixed
     */
    public function getProductBySku(string $sku)
    {
        try {
            return $this->productRepository->get($sku);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Get product image URL
     *
     * @param $product
     * @return string
     */
    public function getProductImageUrl($product): string
    {
        return $product->getImageUrl();
    }

    /**
     * Get product price
     *
     * @param $product
     * @return string
     */
    public function getProductPrice($product): string
    {
        return $product->getPrice();
    }

    /**
     * Get product name
     *
     * @param $product
     * @return string
     */
    public function getProductName($product): string
    {
        return $product->getName();
    }

    /**
     * Check if product is in stock
     *
     * @param $product
     * @return bool
     */
    public function isProductInStock($product): bool
    {
        return $product->isInStock();
    }
}