<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\Data\Collection\Factory as CollectionFactory;
use Magento\Framework\Registry;
use SprintMind\MgentoModule\Model\ResourceModel\DesignServiceCollection;

class DesignServiceDataProvider extends AbstractDataProvider
{
    /**
     * @var DesignServiceCollection
     */
    protected $collection;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ContextInterface $context
     * @param CollectionFactory $collectionFactory
     * @param string|null $mainTable
     * @param string|null $resourceModel
     * @param Registry $registry
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        ContextInterface $context,
        CollectionFactory $collectionFactory,
        ?string $mainTable = null,
        ?string $resourceModel = null,
        Registry $registry
    ) {
        $this->collection = $collectionFactory->create();
        $this->registry = $registry;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $context, $collectionFactory, $mainTable, $resourceModel);
    }

    /**
     * Retrieve data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->collection->getData();
    }

    /**
     * Retrieve total count
     *
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->collection->getSize();
    }
}