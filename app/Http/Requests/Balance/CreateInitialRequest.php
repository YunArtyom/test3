<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;


class CreateInitialRequest extends FormRequest
{
    /**
     * Валидация запроса инициализтрования оплаты.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['integer', 'min:10000', 'max:10000000', 'required']
        ];
    }
}
