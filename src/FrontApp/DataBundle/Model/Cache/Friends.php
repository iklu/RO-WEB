<?php

namespace AppBundle\DataBundle\Model\Cache;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 01.11.2016
 * Time: 11:19
 */
class Friends
{
    public $friends;

    public function setFriends($friends){
        $this->friends = $friends;
    }

    public function getFriends(){
        return $this->friends;
    }
}