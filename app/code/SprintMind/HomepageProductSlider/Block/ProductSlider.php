<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Block;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;

class ProductSlider extends Template
{
    protected $productFactory;
    protected $productCollectionFactory;
    protected $storeManager;
    protected $registry;

    public function __construct(
        Template\Context $context,
        ProductFactory $productFactory,
        CollectionFactory $productCollectionFactory,
        StoreManagerInterface $storeManager,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->storeManager = $storeManager;
        $this->registry = $registry;
    }

    public function getProductSkus(): array
    {
        return explode(',', $this->_scopeConfig->getValue('vendor/productslider/skus'));
    }

    public function getMaxProducts(): int
    {
        return (int)$this->_scopeConfig->getValue('vendor/productslider/max_products');
    }

    public function getProducts(): array
    {
        $skus = $this->getProductSkus();
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name', 'price', 'image']);
        $collection->addAttributeToFilter('sku', ['in' => $skus]);
        $collection->addAttributeToFilter('status', ['eq' => 1]); // Enabled products
        $collection->addAttributeToFilter('visibility', ['neq' => 1]); // Not catalog only
        $collection->setPageSize($this->getMaxProducts());

        return $collection->getItems();
    }

    public function isProductInStock($product): bool
    {
        return $product->isInStock();
    }
}