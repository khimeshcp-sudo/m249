<?php

namespace Vendor\ContactUs\Model;

class ConfigProvider
{
    public function getConfig()
    {
        return [
            'contact_types' => ['sales', 'support', 'billing', 'general'],
        ];
    }
}