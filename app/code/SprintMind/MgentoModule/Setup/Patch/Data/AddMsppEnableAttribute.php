<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule\Setup\Patch\Data;

use Magento\Catalog\Model\ResourceModel\Product\Attribute\Group; 
use Magento\Catalog\Model\ResourceModel\Product\Attribute\Set;
use Magento\Catalog\Setup\CatalogSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\AttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Catalog\Model\Product;

class AddMsppEnableAttribute implements DataPatchInterface
{
    /** @var CatalogSetupInterface */
    private $catalogSetup;

    /** @var EavSetup */
    private $eavSetup;

    /**
     * @param CatalogSetupInterface $catalogSetup
     * @param EavSetup $eavSetup
     */
    public function __construct(CatalogSetupInterface $catalogSetup, EavSetup $eavSetup)
    {
        $this->catalogSetup = $catalogSetup;
        $this->eavSetup = $eavSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(): void
    {
        $this->catalogSetup->startSetup();

        $this->eavSetup->addAttribute(Product::ENTITY, 'mspp_enable', [
            'type' => 'int',
            'label' => 'MSPP Enable',
            'input' => 'boolean',
            'required' => false,
            'visible' => true,
            'user_defined' => true,
            'default' => 0,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'sort_order' => 100,
            'group' => 'General',
            'backend' => '',
            'frontend' => '',
            'note' => 'Enable or disable MSPP for the product',
        ]);

        $this->catalogSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function setDependencies(array $dependencies): void
    {
        // No dependencies
    }
}