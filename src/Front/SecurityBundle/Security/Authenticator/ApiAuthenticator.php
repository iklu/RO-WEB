<?php

namespace Front\SecurityBundle\Security\Authenticator;
use Front\DataBundle\Services\ApiService;
use Front\SecurityBundle\Services\SecurityService;
use Front\SecurityBundle\Services\UserSession;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\SimpleAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 24.11.2016
 * Time: 10:00
 */
class ApiAuthenticator implements SimpleFormAuthenticatorInterface
{
    /**
     * @var SecurityService
     */
    private $security;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * ApiAuthenticator constructor.
     * @param SecurityService $security
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(SecurityService $security, UserPasswordEncoderInterface $encoder)
    {
        $this->security = $security;
        $this->encoder = $encoder;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {

        $user = $userProvider->loadUserByUsername($token->getUsername());

        $passwordValid = $this->encoder->isPasswordValid($user, $token->getCredentials());

        if ($passwordValid) {
            $login = $this->security;
            $initiate = $login->getUsernamePasswordToken($user);

            return $initiate;
        }

        throw new CustomUserMessageAuthenticationException('Invalid username or password');
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof UsernamePasswordToken
        && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $username, $password, $providerKey)
    {
        return new UsernamePasswordToken($username, $password, $providerKey);
    }
}