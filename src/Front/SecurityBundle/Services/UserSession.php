<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 22.11.2016
 * Time: 17:02
 */

namespace Front\SecurityBundle\Services;

use AppBundle\Model\Common;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Model\Curl;
use AppBundle\Model\WSSE;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class UserSession
{
    /**
     * @var
     */
    private $session;

    /**
     * @var
     */
    private $request;

    /**
     * @var Cookie
     */
    private $cookies;

    /**
     * UserSession constructor.
     * @param Session $session
     * @param RequestStack $request
     */
    public function __construct(Session $session, RequestStack $request)
    {
        $this->session  = $session;
        $this->request  = $request;
        $this->response = new Response();
        $this->cookies  =  $this->response->headers;
        $this->session->start();
    }


    /**
     * @param array $data
     * @return $this
     */
    public function setLoginUserData(array $data)
    {

        if (is_array($data) && !empty($data)) {

            $this->session->set('user_id', $data['response']['message']['id']);
            $this->session->set('email', $data['response']['message']['username']);
            $this->session->set('isEnabled', $data['response']['message']['enabled']);
            $this->session->set('token', $data['response']['message']['token']);
            $this->session->set('name', $data['response']['message']['firstName'] . " " . $data['response']['message']['lastName']);
            $this->session->set('firstName', $data['response']['message']['firstName']);
            $this->session->set('lastName', $data['response']['message']['lastName']);
            $this->session->set('phone', $data['response']['message']['phone']);
            $cardNumber = $data['response']['message']['cardNumber'] != "" ? str_repeat("X", strlen($data['response']['message']['cardNumber']) - 4) . substr($data['response']['message']['cardNumber'], -4) : "";
            $this->session->set('cardNumber', $cardNumber);
            $this->session->set('loyaltyPointsBalance', $data['response']['message']['loyaltyPointsBalance']);
        }

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setUserData(array $data)
    {

        //set values in session
        $this->session->set('name', $data['response']['message']['firstName'] . " " . $data['response']['message']['lastName']);
        $this->session->set('firstName', $data['response']['message']['firstName']);
        $this->session->set('lastName', $data['response']['message']['lastName']);
        $this->session->set('phone', $data['response']['message']['phone']);
        $this->session->set('isEnabled', $data['response']['message']['enabled']);
        $this->session->set('my_meineke', ($data['response']['message']['myMeineke'] != NULL or $data['response']['message']['myMeineke'] != '') ? $data['response']['message']['myMeineke'] : NULL);
        $this->session->set('token', $data['response']['message']['token']);
        $this->session->set('email', $data['response']['message']['username']);
        $this->session->set('user_id', $data['response']['message']['id']);
        if ($this->session->has("emailConfirm")) {
            $this->session->remove("emailConfirm");
        }

        return $this;
    }

    /**
     * @param $api
     * @param array $data
     * @return $this
     */
    public function setMyMeineke($api, array $data)
    {

        if ($this->cookies->has('my_meineke')) {
            $this->cookies->clearCookie('my_meineke');
            $this->response->send();
        }

        if ($data['response']['message']['myMeineke']) {

            $this->session->remove("my_meineke");
            $data['response']['message']['myMeineke']["rawSemCamPhone"] = base64_encode($data['response']['message']['myMeineke']["rawSemCamPhone"]);
            $data['response']['message']['myMeineke']["semCamPhone"] = base64_encode($data['response']['message']['myMeineke']["semCamPhone"]);
            //Set Cookie for Coords
            Common::setCoords($data['response']['message']['myMeineke']["latitude"], $data['response']['message']['myMeineke']["longitude"]);

            //GetServices for this store
            $services = Common::getServicesById($api, $data['response']['message']['myMeineke']["storeId"]); //Get Services by storeId

            //Set Info in Session
            $this->session->set("services", $services);

            // The store is closed update user account
            if ($data['response']['message']['myMeineke']['locationStatus'] == 'CLOSED') {
                $postValues = array("storeId" => 0);
                $header = WSSE::generateWsse($data['response']['message']['token'], $data['response']['message']['username']);
                Curl::curl($api . "secured/account/meineke/" . $data['response']['message']['id'] . "/", $postValues, "PUT", $header);
            } else {
                $this->session->set('my_meineke', $data['response']['message']['myMeineke']);
            }
        }

        return $this;
    }


    /**
     * @param $api
     * @return $this
     */
    public function setTransactionUserData($api)
    {

        $email = $this->session->get('email');
        $token = $this->session->get('token');
        $user_id = $this->session->get('user_id');

        if (isset($email) && isset($token)) {
            $header = WSSE::generateWsse($token, $email);
            $curl = Curl::curl($api . "secured/account/profile/" . $user_id . "/", NULL, "GET", $header);
            $transaction30 = Curl::curl($api . "secured/account/transactions/" . $user_id . "/?period=30", NULL, "GET", $header);
            $transaction60 = Curl::curl($api . "secured/account/transactions/" . $user_id . "/?period=60", NULL, "GET", $header);
            if (NULL !== $this->session->get("my_meineke")
                && $this->session->get("my_meineke")["storeId"] != ''
                && $curl["response"]["message"]["myMeineke"] != ""
                && $this->session->get("my_meineke")["storeId"] != $curl["response"]["message"]["myMeineke"]["storeId"]
                && empty($curl['response']['message']['lastVisitedStoreId'])
            ) {
                if ($curl['response']['message']['myMeineke']['locationStatus'] == 'CLOSED') {
                    $postValues = array("storeId" => 0);
                    $header = WSSE::generateWsse($token, $email);
                    Curl::curl($api . "secured/account/meineke/" . $user_id . "/", $postValues, "PUT", $header);
                } else {
                    $this->session->set('my_meineke', $curl['response']['message']['myMeineke']);
                }
            }
            //Clutch data.
            $cardNumber = $curl['response']['message']['cardNumber'] != "" ? str_repeat("X", strlen($curl['response']['message']['cardNumber']) - 4) . substr($curl['response']['message']['cardNumber'], -4) : "";
            $this->session->set('cardNumber', $cardNumber);
            $this->session->set('customCardNumber', $curl['response']['message']['customCardNumber']);
            $this->session->set('loyaltyPointsBalance', $curl['response']['message']['loyaltyPointsBalance']);
            $this->session->set('lastVisitedStoreId', $curl['response']['message']['lastVisitedStoreId']);
            $this->session->set('vehicles', $curl['response']['message']['vehicles']);
            $this->session->set('serviceReminders', $curl['response']['message']['serviceReminders']);
            $this->session->set('futureAppointments', $curl['response']['message']['futureAppointments']);
            $this->session->set('myRewards', $curl['response']['message']['myRewards']);
            if (!empty($transaction30)) {
                $this->session->set('transaction30', $transaction30['response']['message']);
            }
            if (!empty($transaction60)) {
                $this->session->set('transaction60', $transaction60['response']['message']);
            }
            $this->session->set('historyTransactions', $curl['response']['message']['historyTransactions']);

            if(isset($curl['response']['message']['myMeineke']['storeId'])) {
                //Get Services for this store limit 3
                $services = Common::getServicesById($api, $curl['response']['message']['myMeineke']['storeId']);
                $this->session->set("services", $services);
            }
            $this->session->set('isEnabled', $curl['response']['message']['enabled']);

        }

        return $this;
    }

    /**
     * @param FacebookAuthentication $data
     * @return $this
     */
    public function setFacebookLoginUserData(FacebookAuthentication $data)
    {

        $name = $data->getFacebookUserName();
        $id = $data->getFacebookUserId();
        $email = $data->getFacebookUserEmail();
        $this->session->set('email', $email);
        $this->session->set('name', $name);
        $this->session->set('facebookId', $id);

        return $this;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmailConfirm($email){
        $this->session->set("emailConfirm", $email);
        return $this;
    }

    /**
     * @param $type
     * @param $message
     * @return $this
     */
    public function setFlashMessage($type, $message) {
        $this->session->getFlashBag()->add($type, $message);
        return $this;
    }
}