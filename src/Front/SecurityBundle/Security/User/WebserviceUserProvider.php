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

    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }

    public function loadUserByUsername($username)
    {
        /** @var array $data Provider */
        $data = $this->service->getLoginFromApi();

        if (isset($data['response']['message']['username']) && ($data['response']['message']['roles'] > 0)) {

            $users["username"] = $data['response']['message']['username'];
            $users["roles"] =  $data['response']['message']['roles'];
            $users["password"] =  $data['response']['message']['password'];
            $users["salt"] =  $data['response']['message']['salt'];

            return new WebserviceUser( $users["username"], $users["password"], $users["salt"],  $users["roles"]);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
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