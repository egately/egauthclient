<?php

// config for Egately/EgateAuthClient
return [

    'enable_logs' => env('EGATE_AUTH_ENABLE_LOGS', false),

    'egate_auth_url' => env('EGATE_AUTH_URL'),

    'egate_app_key' => env('EGATE_APP_KEY'),


    /*
     * The name of the column  that stores the users egate access token.
     */
    'users_table_access_token_attribute' => 'access_token',


];
