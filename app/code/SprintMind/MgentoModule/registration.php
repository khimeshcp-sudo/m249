<?php

declare(strict_types=1);

namespace SprintMind\MgentoModule;

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'SprintMind_MgentoModule',
    __DIR__
);
