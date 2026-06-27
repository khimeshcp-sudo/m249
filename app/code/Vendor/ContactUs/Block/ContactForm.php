<?php

namespace Vendor\ContactUs\Block;

use Magento\Framework\View\Element\Template;
use Vendor\ContactUs\Model\Config\Source\ContactType;

class ContactForm extends Template
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        // Additional setup if needed
    }

    public function getContactTypes()
    {
        $contactTypeModel = new ContactType();
        return $contactTypeModel->toOptionArray();
    }
}
