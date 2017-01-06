<?php

namespace Front\CoreBundle\Helper\Security;
use Front\CoreBundle\Helper\Request\RequestHelperInterface;
use Front\SecurityBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 06.01.2017
 * Time: 14:53
 */
class SecurityHelper implements SecurityHelperInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RequestHelperInterface
     */
    private $requestHelper;

    /**
     * @var array|\Symfony\Component\HttpFoundation\RequestMatcher[]
     */
    private $firewallMap;

    /**
     * SecurityHelper constructor.
     *
     * @param TokenStorageInterface  $tokenStorage
     * @param RequestHelperInterface $requestHelper
     * @param array                  $firewallMap
     */
    public function __construct(TokenStorageInterface $tokenStorage, RequestHelperInterface $requestHelper, array $firewallMap = [])
    {
        $this->tokenStorage  = $tokenStorage;
        $this->requestHelper = $requestHelper;
        $this->firewallMap   = $firewallMap;
    }

    public function getCurrentUser()
    {
        $token = $this->tokenStorage->getToken();
        if (null !== $token) {
            return $token->getUser();
        }

        return null;
    }

    public function getCurrentClient()
    {
        $user = $this->getCurrentUser();

        return $user instanceof UserInterface ? $user : null;
    }

    public function getAuthenticatedClient() : UserInterface
    {
        return $this->getCurrentUser();
    }

    public function isActiveFirewall(string $name) : bool
    {
        $request = $this->requestHelper->getCurrentRequest();

        return $name === $this->getFirewallNameForRequest($request);
    }

    public function isActiveAdminFirewall() : bool
    {
        return $this->isActiveFirewall('admin');
    }

    public function getFirewallNameForRequest(Request $request)
    {
        foreach ($this->firewallMap as $firewallName => $requestMatcher) {
            if (null === $requestMatcher || $requestMatcher->matches($request)) {
                return $firewallName;
            }
        }

        return null;
    }

    public function generateRandomPassword(int $length = 8) : string
    {
        $chars    = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);

        return $password;
    }
}