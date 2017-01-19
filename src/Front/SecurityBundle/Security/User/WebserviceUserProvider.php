<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 06.01.2017
 * Time: 16:58
 */

namespace Front\SecurityBundle\Security\User;

use Front\DataBundle\Services\ApiService;
use Front\SecurityBundle\Security\User\WebserviceUser;
use Front\SecurityBundle\Services\UserSession;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class WebserviceUserProvider implements UserProviderInterface
{
    /**
     * @var ApiService
     */
    private $service;

    /**
     * @var UserSession
     */
    private $userSession;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var
     */
    private $apiAddress;

    /**
     * WebserviceUserProvider constructor.
     * @param ApiService $service
     * @param UserSession $userSession
     * @param RequestStack $request
     * @param $apiAddress
     */
    public function __construct(ApiService $service, UserSession $userSession, RequestStack $request, $apiAddress)
    {
        $this->service = $service;
        $this->request = $request->getCurrentRequest();
        $this->service = $service;
        $this->userSession = $userSession;
        $this->apiAddress = $apiAddress;
    }

    public function loadUserByUsername($username)
    {
        /** @var array $data Provider */
        $data = $this->service->getLoginFromApi();

        /** @var  $sessionData */
        $sessionData = $this->userSession;

        if (isset($data['response']['message']['username']) && !empty($data['response']['message']['roles'])) {
            $users["username"] = $data['response']['message']['username'];
            $users["roles"] =  $data['response']['message']['roles'];
            $users["password"] =  $data['response']['message']['password'];
            $users["salt"] =  $data['response']['message']['salt'];

            //Set MyMeineke session
            $sessionData->setMyMeineke($this->apiAddress, $data);

            //Set user session
            $sessionData->setLoginUserData($data);

            return new WebserviceUser( $users["username"], $users["password"], $users["salt"],  $users["roles"]);
        } else {
            if(isset($data['status']) && $data['status'] == 404){

                $sessionData->setFlashMessage('warning', 'The email and password you entered don\'t match');

            }elseif(isset($data['status']) && $data['status'] != 200){

                //Set Email in session for Resend Activation Link
                $sessionData->setEmailConfirm($this->request->get("email"));
                $message = $data['response']['message'];
                throw new CustomUserMessageAuthenticationException($message);
            }elseif(empty($data['response']['message']['roles'])){
                throw new CustomUserMessageAuthenticationException('Not sufficient privileges.');
            }
        }
        
        throw new CustomUserMessageAuthenticationException('Error authenticating.');

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return WebserviceUser::class === $class;
    }
}