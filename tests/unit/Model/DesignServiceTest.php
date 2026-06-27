<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use SprintMind\MgentoModule\Model\DesignService;

class DesignServiceTest extends TestCase
{
    public function testCreateDesignService(): void
    {
        $designService = new DesignService();
        $designService->setFirstName('John');
        $designService->setLastName('Doe');
        $designService->setBusinessName('Doe Designs');
        $designService->setEmail('john.doe@example.com');
        $designService->setPhoneNumber('1234567890');
        $designService->setDesignType('Logo');

        $this->assertEquals('John', $designService->getFirstName());
        $this->assertEquals('Doe', $designService->getLastName());
        $this->assertEquals('Doe Designs', $designService->getBusinessName());
        $this->assertEquals('john.doe@example.com', $designService->getEmail());
        $this->assertEquals('1234567890', $designService->getPhoneNumber());
        $this->assertEquals('Logo', $designService->getDesignType());
    }
}
