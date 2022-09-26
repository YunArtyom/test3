<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;


class GetCallbackInitialInfo extends JsonResource
{
    /**
     * Формирование API Resource.
     * Отправка информации результата оплаты.
     *
     * @param $request
     * @return array
     */
    #[ArrayShape([
        'status' => "boolean",
        'number' => "string", "null",
        'balance' => "integer", "null"
    ])]
    public function toArray($request): array
    {
        return [
            'status' => $this->status,
            'number' => $this->number ?? null,
            'balance' => $this->balance ?? null
        ];
    }
}
