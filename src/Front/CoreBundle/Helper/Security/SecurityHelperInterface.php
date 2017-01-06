<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 06.01.2017
 * Time: 14:54
 */

namespace Front\CoreBundle\Helper\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

interface SecurityHelperInterface
{
    public function getCurrentUser();

    public function getAuthenticatedClient() : UserInterface;

    public function isActiveFirewall(string $name) : bool;

    public function isActiveAdminFirewall() : bool;

    public function getFirewallNameForRequest(Request $request);

    public function generateRandomPassword(int $length = 8) : string;
}