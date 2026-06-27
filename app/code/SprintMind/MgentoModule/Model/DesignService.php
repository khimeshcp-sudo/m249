<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Model;

use Magento\Framework\Model\AbstractModel;
use SprintMind\MgentoModule\Model\ResourceModel\DesignService as DesignServiceResource;

class DesignService extends AbstractModel
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'cp_desingservice';

    /**
     * @var DesignServiceResource
     */
    protected $resource;

    /**
     * Constructor
     *
     * @param DesignServiceResource $resource
     * @param mixed $data
     */
    public function __construct(DesignServiceResource $resource, array $data = [])
    {
        $this->resource = $resource;
        parent::__construct($data);
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return (string) $this->getData('first_name');
    }

    /**
     * Set first name
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName)
    {
        return $this->setData('first_name', $firstName);
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName(): string
    {
        return (string) $this->getData('last_name');
    }

    /**
     * Set last name
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName)
    {
        return $this->setData('last_name', $lastName);
    }

    /**
     * Get business name
     *
     * @return string
     */
    public function getBusinessName(): string
    {
        return (string) $this->getData('business_name');
    }

    /**
     * Set business name
     *
     * @param string $businessName
     * @return $this
     */
    public function setBusinessName(string $businessName)
    {
        return $this->setData('business_name', $businessName);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->getData('email');
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        return $this->setData('email', $email);
    }

    /**
     * Get phone number
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return (string) $this->getData('phone_number');
    }

    /**
     * Set phone number
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        return $this->setData('phone_number', $phoneNumber);
    }

    /**
     * Get design type
     *
     * @return string
     */
    public function getDesignType(): string
    {
        return (string) $this->getData('design_type');
    }

    /**
     * Set design type
     *
     * @param string $designType
     * @return $this
     */
    public function setDesignType(string $designType)
    {
        return $this->setData('design_type', $designType);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->getData('created_at');
    }

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->getData('updated_at');
    }

    /**
     * Save the model
     *
     * @return $this
     */
    public function save()
    {
        $this->setData('updated_at', date('Y-m-d H:i:s'));
        return parent::save();
    }
}