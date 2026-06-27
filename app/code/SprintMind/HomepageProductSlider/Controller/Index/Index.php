<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Store\Model\StoreManagerInterface;

class Index extends Action
{
    /** @var PageFactory */
    private $resultPageFactory;

    /** @var ProductFactory */
    private $productFactory;

    /** @var CollectionFactory */
    private $productCollectionFactory;

    /** @var ProductRepository */
    private $productRepository;

    /** @var StoreManagerInterface */
    private $storeManager;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ProductFactory $productFactory,
        CollectionFactory $productCollectionFactory,
        ProductRepository $productRepository,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->prepareProductSlider($resultPage);
        return $resultPage;
    }

    private function prepareProductSlider($resultPage)
    {
        $config = $this->getConfig();
        $skus = explode(',', $config['skus']);
        $maxProducts = (int)$config['max_products'];

        $productCollection = $this->productCollectionFactory->create()
            ->addAttributeToSelect(['name', 'price', 'image'])
            ->addAttributeToFilter('sku', ['in' => $skus])
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', [2, 3, 4])
            ->addAttributeToFilter('is_in_stock', 1)
            ->setPageSize($maxProducts);

        $resultPage->getLayout()->getBlock('homepage.product.slider')->setProductCollection($productCollection);
    }

    private function getConfig(): array
    {
        // Fetch configuration values from the system configuration
        return [
            'skus' => 'product-sku-1,product-sku-2', // Example SKUs
            'max_products' => 5
        ];
    }
}
