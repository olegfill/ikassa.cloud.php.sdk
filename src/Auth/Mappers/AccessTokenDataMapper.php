<?php

namespace olegfill\IKassa\Auth\Mappers;

use olegfill\IKassa\Auth\Models\AccessTokenData;

class AccessTokenDataMapper
{
    public static function newInstance(array $bindingData)
    {
        var_dump($bindingData);exit;
        return new AccessTokenData(
            $bindingData['access_token'],
            $bindingData['expires_in'],
            $bindingData['refresh_token']
        );
    }
}