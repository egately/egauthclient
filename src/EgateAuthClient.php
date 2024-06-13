<?php

namespace Egately\EgateAuthClient;

class EgateAuthClient
{

    public function __construct()
    {
        //
    }

    public function Login($username, $password)
    {

        return app('EgateClass')->LoginAndGetToken($username, $password);
    }

    public function Register($name, $email, $phone, $password)
    {

        return app('EgateClass')->RegisterNewUser($name, $email, $phone, $password);
    }

}
