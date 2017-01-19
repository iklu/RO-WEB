<?php

namespace Front\SecurityBundle\Forms;
use Front\CoreBundle\Helper\Flash\FlashHelperInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 19.01.2017
 * Time: 17:37
 */
class RegistrationForm
{
    public function __construct(FlashHelperInterface $flashHelper)
    {
    }

    public function submit(Request $request){

        $response = [];

        try{
            // Create a client with a base URI
            $client = new Client(['base_uri' => $this->getParameter("api_address")]);
            $post  = $client->request("POST", 'account/register/', [
                "form_params"=> [
                    "username" => $request->request->get("username"),
                    "email" => $request->request->get("email"),
                    "password"=> $request->request->get("password"),
                    "confirmPassword"=> $request->request->get("confirmPassword"),
                ],
                "headers"=>[
                    "Accept" =>"application/json"
                ]
            ]);

            if($post->getStatusCode() == Response::HTTP_OK && $post->hasHeader('Content-Length')){
                $body = (string) $post->getBody()->getContents();
                $response = \GuzzleHttp\json_decode($body , true);
            }

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $body =   (string)($e->getResponse()->getBody()->getContents());
                $response = \GuzzleHttp\json_decode($body , true);
                $e->getResponse()->getHeader('content-type');
                // $this->getFlashHelper()->addError($body);
            }
        }

        return $response;
    }
}