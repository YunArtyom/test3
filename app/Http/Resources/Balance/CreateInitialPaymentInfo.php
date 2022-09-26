<?php

namespace App\Http\Resources\Balance;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;


class CreateInitialPaymentInfo extends JsonResource
{
    /**
     * Формирование API Resource.
     * Отправка информации инициализации оплаты.
     *
     * @param $request
     * @return array
     */
    #[ArrayShape([
        'success' => "boolean",
        'redirect_url' => "string",
        'error_code' => "string"
    ])]
    public function toArray($request): array
    {
        return [
            'success' => $this->success,
            'redirect_url' => $this->redirect_url,
            'error_code' => $this->error_code
        ];
    }
}
