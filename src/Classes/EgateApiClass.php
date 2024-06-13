<?php

namespace Egately\EgateAuthClient\Classes   ;

use Egately\EgateAuthClient\Exceptions\EgateAuthException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EgateApiClass
{


    protected $Clinet;

    protected $url;

    protected $endpoint;

    protected $LogEnabled;

    public function __construct()
    {
        $headers = [
            'Accept' => 'application/json',
            'app-key' => config('egauthclient.egate_app_key'),

        ];
        if ($this->User) {
            if (!isset($User->{config('egauthclient.users_table_access_token_attribute')})
                || !$User->{config('egauthclient.users_table_access_token_attribute')}) {
                throw new EgateAuthException('User Access Token Not Found', 401);
            }
            $headers['Authorization'] = 'Bearer ' . $User->{config('egauthclient.users_table_access_token_attribute')};
        }
        $this->Clinet = Http::timeout(30)->withHeaders($headers);


        $this->url = config('egauthclient.egate_auth_url');

        $this->LogEnabled = config('egauthclient.enable_logs', false);

    }

    public function Post($payload, $endpoint)
    {

        $payload = $this->AddFixedParameters($payload);
        $url = $this->url . $endpoint;
        try {
            $resposne = $this->Clinet->post($url, $payload);

            return $this->respond($resposne);
        } catch (\Exception $exception) {
            throw new EgateAuthException($exception->getMessage(), $exception->getCode());
        }
    }


    public function Get( $endpoint)
    {
        $url = $this->url . $endpoint;
        try {
            $resposne = $this->Clinet->get($url );

            return $this->respond($resposne);
        } catch (\Exception $exception) {
            throw new EgateAuthException($exception->getMessage(), $exception->getCode());
        }
    }

    public function Put($payload, $endpoint)
    {
        $payload = $this->AddFixedParameters($payload);
        $url = $this->url . $endpoint;
        try {
            $resposne = $this->Clinet->put($url, $payload);

            return $this->respond($resposne);
        } catch (\Exception $exception) {
            throw new EgateAuthException($exception->getMessage(), $exception->getCode());
        }
    }

    public function Delete($payload, $endpoint)
    {
        return 'Hello World';
    }

    public function Patch($payload, $endpoint)
    {
        $payload = $this->AddFixedParameters($payload);
        $url = $this->url . $endpoint;
        try {
            $resposne = $this->Clinet->patch($url);

            return $this->respond($resposne);
        } catch (\Exception $exception) {
            throw new EgateAuthException($exception->getMessage(), $exception->getCode());
        }

    }

    public function AddFixedParameters($parameters)
    {
       return array_merge($parameters,  config('egauthclient.api_fixed_parameters'));
    }



    private function respond($response)
    {
        if ($this->LogEnabled) {
            Log::info('EgateApiClass Line:84 ' . json_encode(['response' => $response->body()]));
        }
        if ($response->successful()) {
            $Response = $response->json();
            if ($this->LogEnabled) {
                Log::info('EgateApiClass Line:89 response body' . json_encode(['Jsonresponse' => $response->json()]));
            }
            return $Response;
        }

        // Determine if the response has a 400 level status code...
        if ($response->clientError()) {
            if ($this->LogEnabled) {
                Log::info('EgateApiClass 97 clientError response->body' . $response->body());
            }

            throw new EgateAuthException($response->body());

        }
        // Determine if the response has a 500 level status code...
        if ($response->serverError()) throw new EgateAuthException($response->body());;

        throw new EgateAuthException('Error In Response', 500);
    }
}
