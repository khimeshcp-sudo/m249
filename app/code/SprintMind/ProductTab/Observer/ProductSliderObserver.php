<?php

declare(strict_types=1);

namespace SprintMind\ProductTab\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\Product\Repository as ProductRepository;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product\Status;

class ProductSliderObserver implements ObserverInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var Visibility
     */
    private $visibility;

    /**
     * @var Status
     */
    private $status;

    /**
     * @param ProductRepository $productRepository
     * @param Visibility $visibility
     * @param Status $status
     */
    public function __construct(
        ProductRepository $productRepository,
        Visibility $visibility,
        Status $status
    ) {
        $this->productRepository = $productRepository;
        $this->visibility = $visibility;
        $this->status = $status;
    }

    /**
     * Execute method for the observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $productIds = $this->getConfiguredProductIds();
        $products = [];

        foreach ($productIds as $productId) {
            try {
                $product = $this->productRepository->getById($productId);
                if ($this->isProductVisible($product)) {
                    $products[] = $product;
                }
            } catch (NoSuchEntityException $e) {
                // Log or handle the exception as needed
            }
        }

        // Pass the filtered products to the slider block or wherever needed
        $observer->getData('products')->setData('slider_products', $products);
    }

    /**
     * Get configured product SKUs from system configuration
     *
     * @return array
     */
    private function getConfiguredProductIds(): array
    {
        // Logic to retrieve SKUs from system configuration
        // This should return an array of product IDs based on the configured SKUs
        return []; // Placeholder for actual implementation
    }

    /**
     * Check if the product is visible and in stock
     *
     * @param $product
     * @return bool
     */
    private function isProductVisible($product): bool
    {
        return $product->getStatus() === Status::STATUS_ENABLED &&
               $product->getVisibility() === $this->visibility->getVisibleInCatalog() &&
               $product->getStockItem()->getIsInStock();
    }
}
