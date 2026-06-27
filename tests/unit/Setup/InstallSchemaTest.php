<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Test\Unit\Setup;

use PHPUnit\Framework\TestCase;
use SprintMind\MgentoModule\Setup\InstallSchema;

class InstallSchemaTest extends TestCase
{
    public function testInstallSchema(): void
    {
        $installSchema = new InstallSchema();
        $this->assertNotNull($installSchema);
    }
}
