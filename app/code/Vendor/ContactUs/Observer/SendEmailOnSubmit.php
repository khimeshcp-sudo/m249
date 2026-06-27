<?php

namespace Vendor\ContactUs\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\ObjectManager;

class SendEmailOnSubmit implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        // Handling email sending based on contact type
        $contactData = $observer->getContactData();
        $email = $this->getEmailForType($contactData['contact_type']);
        // Logic to send the email
    }

    protected function getEmailForType($contactType)
    {
        // Logic to retrieve email address based on contact type
    }
}
