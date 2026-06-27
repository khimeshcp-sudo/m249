<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Block;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

class ProductSlider extends Template
{
    protected $productFactory;
    protected $productCollectionFactory;
    protected $registry;
    protected $storeManager;
    protected $skus;
    protected $maxProducts;

    public function __construct(
        Template\Context $context,
        ProductFactory $productFactory,
        CollectionFactory $productCollectionFactory,
        Registry $registry,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->registry = $registry;
        $this->storeManager = $storeManager;
        $this->skus = $this->getConfigSkus();
        $this->maxProducts = $this->getMaxProducts();
    }

    public function getProducts(): array
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name', 'price', 'image']);
        $collection->addAttributeToFilter('sku', ['in' => $this->skus]);
        $collection->addAttributeToFilter('status', ['eq' => 1]); // Enabled
        $collection->addAttributeToFilter('visibility', ['neq' => 1]); // Not Not Visible Individually
        $collection->addAttributeToFilter('is_in_stock', ['eq' => 1]); // In Stock
        $collection->setPageSize($this->maxProducts);
        return $collection->getItems();
    }

    protected function getConfigSkus(): array
    {
        // Fetch SKUs from configuration
        return explode(',', $this->getScopeConfigValue('homepage_product_slider/general/skus'));
    }

    protected function getMaxProducts(): int
    {
        // Fetch maximum products from configuration
        return (int)$this->getScopeConfigValue('homepage_product_slider/general/max_products');
    }

    public function getAddToCartUrl($product): string
    {
        return $this->getUrl('checkout/cart/add', ['product' => $product->getId()]);
    }
}
