<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 29.10.2016
 * Time: 09:32
 */

namespace FrontApp\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractController extends Controller
{
    protected $params = array();
}