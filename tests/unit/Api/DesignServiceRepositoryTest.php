<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Test\Unit\Api;

use PHPUnit\Framework\TestCase;
use SprintMind\MgentoModule\Api\DesignServiceRepositoryInterface;
use SprintMind\MgentoModule\Model\DesignServiceRepository;

class DesignServiceRepositoryTest extends TestCase
{
    public function testCreateDesignService(): void
    {
        $repository = $this->createMock(DesignServiceRepositoryInterface::class);
        $repository->method('create')->willReturn(true);

        $this->assertTrue($repository->create(new DesignService()));
    }
}
