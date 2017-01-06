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
     * @var ApiService
     */
    private $service;

    /**
     * @var SecurityService
     */
    private $security;

    /**
     * @var UserSession
     */
    private $userSession;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var
     */
    private $apiAddress;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * ApiAuthenticator constructor.
     * @param ApiService $service
     * @param SecurityService $security
     * @param UserSession $userSession
     * @param RequestStack $request
     * @param $apiAddress
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(ApiService $service, SecurityService $security, UserSession $userSession, RequestStack $request, $apiAddress, UserPasswordEncoderInterface $encoder)
    {
        $this->request = $request->getCurrentRequest();
        $this->service = $service;
        $this->security = $security;
        $this->userSession = $userSession;
        $this->apiAddress = $apiAddress;
        $this->encoder = $encoder;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {

        $user = $userProvider->loadUserByUsername($token->getUsername());
//        try {
//            $user = $userProvider->loadUserByUsername($token->getUsername());
//        } catch (UsernameNotFoundException $e) {
//            // CAUTION: this message will be returned to the client
//            // (so don't put any un-trusted messages / error strings here)
//            throw new CustomUserMessageAuthenticationException('Username not found');
//        }



        $passwordValid = $this->encoder->isPasswordValid($user, $token->getCredentials());

        if (!$passwordValid) {
            exit;
            throw new CustomUserMessageAuthenticationException('U');
        }





        return new UsernamePasswordToken(
            $user->getUsername(),
            $user->getPassword(),
            $providerKey,
            $user->getRoles()
        );

        /** @var array $data Provider */
        $data = $this->service->getLoginFromApi();

        /** @var  $sessionData */
        $sessionData = $this->userSession;

        if (isset($data['response']['message']['username']) && ($data['response']['message']['roles'] > 0)) {

            $users["username"] = $data['response']['message']['username'];
            $users["roles"] =  $data['response']['message']['roles'];

            //Set MyMeineke session
            $sessionData->setMyMeineke($this->apiAddress, $data);

            //Set user session
            $sessionData->setLoginUserData($data);
            
            $login = $this->security;
            $initiate = $login->getUsernamePasswordToken($users);
            return $initiate;
        } else {

            if(isset($data['status']) && $data['status'] == 404){

                $sessionData->setFlashMessage('warning', 'The email and password you entered don\'t match');

            }elseif(isset($data['status']) && $data['status'] != 200){

                //Set Email in session for Resend Activation Link
                $sessionData->setEmailConfirm($this->request->get("email"));
                $message = $data['response']['message'];
                throw new CustomUserMessageAuthenticationException($message);
            }
        }
        throw new AuthenticationException('Invalid username or password');
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