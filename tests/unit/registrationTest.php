<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    public function testModuleRegistration(): void
    {
        $this->assertTrue(class_exists('SprintMind\\MgentoModule\\registration'));
    }
}
