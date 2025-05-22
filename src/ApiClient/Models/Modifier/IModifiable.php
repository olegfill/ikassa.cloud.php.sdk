<?php

namespace olegfill\IKassa\ApiClient\Models\Modifier;

interface IModifiable
{
    public function toModifier(): Modifier;
}