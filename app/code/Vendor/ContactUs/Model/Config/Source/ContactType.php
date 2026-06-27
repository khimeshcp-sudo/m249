<?php

namespace Vendor\ContactUs\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class ContactType implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'sales', 'label' => __('Sales')],
            ['value' => 'support', 'label' => __('Support')],
            ['value' => 'billing', 'label' => __('Billing')],
            ['value' => 'general', 'label' => __('General')],
        ];
    }
}
