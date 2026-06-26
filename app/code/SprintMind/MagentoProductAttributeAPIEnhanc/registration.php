<?php
/**
 * Auto-generated for: Magento Product Attribute API Enhancement
 * Create a new custom product attribute product_badge using Magento Data Patch.

Requirements:
- Attribute type should be text
- Attribute should be visible in admin product edit page
- Add attribute value in existing product REST API response for headless frontend
- Do not create any frontend files
- Follow Magento 2 coding standards
 */
use Magento\Framework\Component\ComponentRegistrar;
ComponentRegistrar::register(ComponentRegistrar::MODULE, 'SprintMind_MagentoProductAttributeAPIEnhanc', __DIR__);
