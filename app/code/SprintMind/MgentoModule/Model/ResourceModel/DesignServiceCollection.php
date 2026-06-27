<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\DbCollection;
use SprintMind\MgentoModule\Model\DesignService;

class DesignServiceCollection extends DbCollection
{
    /**
     * Initialize collection model
     */
    protected function _construct()
    {
        $this->_init(DesignService::class, DesignServiceResource::class);
    }
}