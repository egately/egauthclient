<?php

namespace Egately\EgateAuthClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Egately\EgateAuthClient\EgateAuthClient
 */
class EgateAuthClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Egately\EgateAuthClient\EgateAuthClient::class;
    }
}
