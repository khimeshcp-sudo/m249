<?php

namespace Vendor\ContactUs\Observer;

use Magento\Framework\Event\ObserverInterface;

class TrackAnalytics implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Logic for tracking Adobe Analytics event
    }
}