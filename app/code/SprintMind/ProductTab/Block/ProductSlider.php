<?php

declare(strict_types=1);

namespace SprintMind\ProductTab\Block;

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
    protected $maxProducts;
    protected $skus;

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
        $this->maxProducts = (int)$this->getConfigValue('productslider/general/max_products');
        $this->skus = explode(',', $this->getConfigValue('productslider/general/skus'));
    }

    public function getProducts(): array
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name', 'price', 'image']);
        $collection->addAttributeToFilter('sku', ['in' => $this->skus]);
        $collection->addAttributeToFilter('status', 1);
        $collection->addAttributeToFilter('visibility', [2, 3, 4]); // Catalog, Search, Catalog, Search
        $collection->addAttributeToFilter('is_in_stock', 1);
        $collection->setPageSize($this->maxProducts);
        return $collection->getItems();
    }

    public function getConfigValue(string $path)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
