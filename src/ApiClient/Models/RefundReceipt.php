<?php

namespace olegfill\IKassa\ApiClient\Models;

use olegfill\IKassa\ApiClient\Models\Header\Header;
use olegfill\IKassa\ApiClient\Models\Modifier\Modifiers;
use olegfill\IKassa\ApiClient\Models\Payment\Payments;
use olegfill\IKassa\ApiClient\Models\Position\Positions;

class RefundReceipt
{
    private Header $header;
    private Positions $positions;
    private Payments $payments;

    public function __construct(Header $header, Positions $positions, Payments $payments)
    {
        $this->header = $header;
        $this->positions = $positions;
        $this->payments = $payments;
    }

    public function toJson(): string
    {
        $result = [
            'header' => $this->header->toArray(),
            'items' => $this->positions->toArray(),
            'payments' => $this->payments->toArray(),
        ];

        var_dump(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}