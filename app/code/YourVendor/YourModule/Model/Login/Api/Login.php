<?php

namespace YourVendor\YourModule\Model\Login\Api;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Customer;  
use Magento\Framework\Exception\LocalizedException;

class Login implements LoginInterface
{
    private $customerRepository;
    private $accountManagement;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        AccountManagement $accountManagement
    ) {
        $this->customerRepository = $customerRepository;
        $this->accountManagement = $accountManagement;
    }

    public function login($email, $password)
    {
        try {
            $customer = $this->customerRepository->getByEmail($email);
            $this->accountManagement->authenticate($email, $password);
            return ['message' => 'Login successful', 'customerId' => $customer->getId()];
        } catch (LocalizedException $e) {
            return ['message' => $e->getMessage()];
        }
    }
}
