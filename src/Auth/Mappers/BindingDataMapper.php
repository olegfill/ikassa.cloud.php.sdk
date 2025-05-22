<?php

namespace olegfill\IKassa\Auth\Mappers;

use olegfill\IKassa\Auth\Models\BindingData;

class BindingDataMapper
{
    public static function newInstance(array $bindingData)
    {
        return new BindingData($bindingData['device_code'], $bindingData['expires_in'], $bindingData['user_code']);
    }
}