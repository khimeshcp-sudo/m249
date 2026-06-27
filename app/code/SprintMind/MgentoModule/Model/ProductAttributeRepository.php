<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Model;

use Magento\Catalog\Model\Product\Repository as ProductRepository;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class ProductAttributeRepository
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Set mspp_enable attribute for a product
     *
     * @param int $productId
     * @param bool $msppEnable
     * @return ProductInterface
     * @throws LocalizedException
     */
    public function setMsppEnable(int $productId, bool $msppEnable): ProductInterface
    {
        $product = $this->productRepository->getById($productId);
        $product->setData('mspp_enable', $msppEnable);
        return $this->productRepository->save($product);
    }

    /**
     * Get mspp_enable attribute for a product
     *
     * @param int $productId
     * @return bool|null
     * @throws LocalizedException
     */
    public function getMsppEnable(int $productId): ?bool
    {
        $product = $this->productRepository->getById($productId);
        return $product->getData('mspp_enable');
    }
}