<?php

namespace YourVendor\YourModule\Model\Resolver;

use Magento\GraphQl\Model\Resolver\AbstractResolver;
use YourVendor\YourModule\Model\Login\Api\LoginInterface;

class CustomerLogin extends AbstractResolver
{
    private $login;

    public function __construct(LoginInterface $login)
    {
        $this->login = $login;
    }

    public function resolve($source, $args, $context, $info)
    {
        return $this->login->login($args['email'], $args['password']);
    }
}
