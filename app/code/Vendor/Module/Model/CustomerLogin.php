<?php

namespace Vendor\Module\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Customer\PasswordHash;
use Magento\Framework\Exception\LocalizedException;

class CustomerLogin
{
    protected $customerFactory;
    protected $customerRepository;
    protected $customerSession;
    protected $passwordHash;

    public function __construct(
        CustomerFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        Session $customerSession,
        PasswordHash $passwordHash
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
        $this->passwordHash = $passwordHash;
    }

    public function login($email, $password)
    {
        try {
            $customer = $this->customerRepository->get($email);
            if (!$this->passwordHash->validate($customer->getPasswordHash(), $password)) {
                throw new LocalizedException(__('Invalid password.'));
            }
            $this->customerSession->setCustomerAsLoggedIn($customer);
            return true;
        } catch (LocalizedException $e) {
            throw new LocalizedException(__('Login failed: %1', $e->getMessage()));
        }
    }
}
