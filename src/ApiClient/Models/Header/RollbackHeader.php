<?php

namespace olegfill\IKassa\ApiClient\Models\Header;

class RollbackHeader implements IHeader
{
    private string $cashier;
    private object $attrs;

    public function __construct(string $cashier, object $attrs = null)
    {
        $this->cashier = $cashier;
        $this->attrs = $attrs ?: new \stdClass();
    }

    public function toArray(): array
    {
        return [
            'cashier' => $this->cashier,
            '@attrs' => $this->attrs
        ];
    }
}