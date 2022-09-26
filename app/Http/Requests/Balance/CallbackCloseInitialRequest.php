<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;


class CallbackCloseInitialRequest extends FormRequest
{
    /**
     * Валидация callback`а заверешния оплаты.
     *
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'status' => ['integer', 'required'],
            'transaction_id' => ['integer', 'required'],
            'secret_key' => ['string', 'required'],
            'reference_id' => ['string', 'required'],
            'masked_pan' => ['string', 'required'],
            'description' => ['string', 'required'],
            'bank_id' => ['integer', 'required']
        ];
    }
}
