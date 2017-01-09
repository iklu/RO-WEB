<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 22.11.2016
 * Time: 17:20
 */

namespace Front\SecurityBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityService
{
    /**
     * SecurityService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $user
     * @return UsernamePasswordToken
     */
    public function authenticate(array $user){

        /** @var  $token */
        $token = $this->getUsernamePasswordToken($user);

        /** Use Symfony service to authenticate */
        $this->container->get('security.token_storage')->setToken($token);

        $this->container->get('session')->set('_security_main',serialize($token));

        return $token;
    }

    public function getUsernamePasswordToken(UserInterface $user){

        /** @var  $token */
        $token = new UsernamePasswordToken($user->getUsername(), $user->getPassword(), 'secured_area', $user->getRoles());

        return $token;
    }
}