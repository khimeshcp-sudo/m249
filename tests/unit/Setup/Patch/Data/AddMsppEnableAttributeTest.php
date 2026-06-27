<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Test\Unit\Setup\Patch\Data;

use PHPUnit\Framework\TestCase;
use SprintMind\MgentoModule\Setup\Patch\Data\AddMsppEnableAttribute;
use Magento\Catalog\Setup\CatalogSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleContextInterface;

class AddMsppEnableAttributeTest extends TestCase
{
    private $catalogSetup;
    private $eavSetup;
    private $addMsppEnableAttribute;

    protected function setUp(): void
    {
        $this->catalogSetup = $this->createMock(CatalogSetupInterface::class);
        $this->eavSetup = $this->createMock(EavSetup::class);
        $this->addMsppEnableAttribute = new AddMsppEnableAttribute($this->catalogSetup, $this->eavSetup);
    }

    public function testApply(): void
    {
        $this->catalogSetup->expects($this->once())
            ->method('startSetup');
        $this->catalogSetup->expects($this->once())
            ->method('endSetup');

        $this->eavSetup->expects($this->once())
            ->method('addAttribute')
            ->with(
                'catalog_product',
                'mspp_enable',
                $this->callback(function (array $attributeData) {
                    return $attributeData['label'] === 'MSPP Enable';
                })
            );

        $this->addMsppEnableAttribute->apply();
    }
}