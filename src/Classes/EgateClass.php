<?php

namespace Egately\EgateAuthClient\Classes;

use App\Models\User;
use Egately\EgateAuthClient\Exceptions\EgateAuthException;

class EgateClass extends EgateApiClass
{

    protected $User;

    public function __construct(User $user = null)
    {
        parent::__construct();
        $this->User = $user;
    }

    public function LoginAndGetToken(string $email,string $password)
    {
        $Payload = [
            'email' => $email,
            'password' => $password,
        ];
        $ApiResponse = $this->Post($Payload,'customer/login');

        if(isset($ApiResponse['status']) && $ApiResponse['status'] == 200){
            return $ApiResponse['data'];
        }else{
            throw new EgateAuthException($ApiResponse['message'], $ApiResponse['status']);
        }
    }


    public function RegisterNewUser($name,$email,$phone,$password)
    {
        $Payload = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
        ];
        $ApiResponse = $this->Post($Payload,'customer/register');

        if(isset($ApiResponse['status']) && $ApiResponse['status'] == 200){
            return $ApiResponse['data'];
        }else{
            throw new EgateAuthException($ApiResponse['message'], $ApiResponse['status']);
        }
    }





}
