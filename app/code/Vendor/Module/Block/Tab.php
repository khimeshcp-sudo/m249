<?php

namespace Vendor\Module\Block;

use Magento\Framework\View\Element\Template;

class Tab extends Template
{
    public function getTabs()
    {
        // Call the TabProvider to get the tabs for this product
        return [];
    }
}