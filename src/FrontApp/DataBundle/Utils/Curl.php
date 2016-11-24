<?php

namespace DataBundle\Utils;
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 14.09.2016
 * Time: 10:50
 */
class Curl
{
    /**
     * @param $link
     * @param null $parameters
     * @param string $method
     * @param null $headers
     * @param null $file
     * @return array
     */
    public static function curl($link, $parameters = NULL, $method = 'GET', $headers = NULL, $file = NULL)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        //curl_setopt($curl, CURLOPT_URL, 'https://meineke'. trim($request->get('storeId')) . '.fullslate.com/api/bookings');
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($headers != NULL){
            curl_setopt($curl,CURLOPT_HTTPHEADER,array($headers));
        }
        if(($method == 'POST' or $method == 'PUT') AND $parameters != NULL){
            if($file){
                curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
            }else{
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
            }
        }
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($curl);
        $info = curl_getinfo($curl)["http_code"];

        $arr = array();
        $arr['status'] = $info;
        $arr['response'] = json_decode($response, true);

        return $arr;

    }
}