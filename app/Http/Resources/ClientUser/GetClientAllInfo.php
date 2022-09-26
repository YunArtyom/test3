<?php

namespace App\Http\Resources\Balance;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;


class GetClientAllInfo extends JsonResource
{
    /**
     * Формирование API Resource.
     * Отправка всей информации об обычном пользователе.
     *
     * @param $request
     * @return array
     */
    #[ArrayShape([
        'name' => "string",
        'balance' => "integer",
        'mobile_number' => "integer"
    ])]
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'balance' => $this->balance,
            'mobile_number' => $this->mobile_number
        ];
    }
}
