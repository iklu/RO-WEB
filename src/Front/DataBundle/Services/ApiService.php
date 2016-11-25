<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 24.11.2016
 * Time: 10:20
 */

namespace Front\DataBundle\Services;


use Front\DataBundle\Utils\Curl;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var object
     */
    private $request;

    /**
     * @var mixed
     */
    private $api;

    /**
     * ApiService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = $this->container->get("request_stack");
        $this->api = $this->container->getParameter("api_address");
    }

    /**
     * @return array
     */
    public function getLoginFromApi(){

        $request = $this->request->getCurrentRequest();

        $username = $request->request->get("_username");
        $password = $request->request->get("_password");

        $postValues = array(
            "email" => $username,
            "password" => $password
        );

        $curl  = Curl::curl($this->api ."account/login/", $postValues, "POST");

        return $curl;
    }
}