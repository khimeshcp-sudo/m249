<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ModuleXmlTest extends TestCase
{
    public function testModuleXmlExists(): void
    {
        $this->assertTrue(file_exists(__DIR__ . '/../app/code/SprintMind/MgentoModule/etc/module.xml'));
    }
}
