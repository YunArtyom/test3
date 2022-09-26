<?php

namespace App\Http\Requests\Balance;

use Illuminate\Foundation\Http\FormRequest;


class SendBalanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'send_balance' => ['integer', 'min:10000', 'max:10000000', 'required'],
            'mobile_number' => ['integer', 'required', 'exists:client_users']
        ];
    }
}
