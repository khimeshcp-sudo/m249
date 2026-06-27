<?php

declare(strict_types=1);

namespace SprintMind\HomepageProductSlider\Test\Unit\Controller\Index;

use PHPUnit\Framework\TestCase;
use SprintMind\HomepageProductSlider\Controller\Index\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Store\Model\StoreManagerInterface;

class IndexTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        $context = $this->createMock(Context::class);
        $pageFactory = $this->createMock(PageFactory::class);
        $productFactory = $this->createMock(ProductFactory::class);
        $collectionFactory = $this->createMock(CollectionFactory::class);
        $productRepository = $this->createMock(ProductRepository::class);
        $storeManager = $this->createMock(StoreManagerInterface::class);

        $this->controller = new Index($context, $pageFactory, $productFactory, $collectionFactory, $productRepository, $storeManager);
    }

    public function testExecuteReturnsResultPage(): void
    {
        $resultPage = $this->createMock(\Magento\Framework\View\Result\Page::class);
        $this->controller->execute();
        $this->assertInstanceOf(\Magento\Framework\View\Result\Page::class, $resultPage);
    }
}
