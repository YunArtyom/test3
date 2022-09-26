<?php

namespace App\Http\Resources\Balance;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;


class StatusResource extends JsonResource
{
    /**
     * Формирование API Resource.
     * Отправка информации о статусе выполнения.
     *
     * @param $request
     * @return array
     */
    #[ArrayShape([
        'message' => "string",
        'success' => "boolean"
    ])]
    public function toArray($request): array
    {
        return [
            'message' => $this->message,
            'success' => $this->boolean
        ];
    }
}
