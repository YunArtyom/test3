<?php

namespace App\Services\Balance;

use App\Models\BusinessUser;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class AddBalanceService
{
    /**
     * Инициализация оплаты с переданными параметрами пользователя.
     *
     * @param int $orderId
     * @param int $amount
     * @return array (Результат инициализации)
     */
    public function createInitial(int $orderId, int $amount): array
    {
        $response = Http::post('api.tarlanpayments.kz/invoice/create', [
            'merchant_id' => 1,
            'amount' => $amount,
            'description' => 'Test',
            'back_url' => 'https://google.com',
            'request_url' => 'https://yandex.com',
            'reference_id' => $orderId,
            'secret_key' => '123456',
            'is_test' => true
        ]);

        return ['success' => $response['success'], 'redirect_url' => $response['redirect_url'], 'error_code' => $response['error_code']];
    }

    /**
     * Обработка callback с платёжной системы.
     *
     * @param array $request
     * @return array (Результат оплаты)
     */
    public function closeInitial(array $request): array
    {
        if ($request['status'] === 1) {
            try {
                $order = Order::where('number', '=', $request['reference_id'])->first();
                $order->is_payed = 1;
                $businessUser = BusinessUser::first($order->business_user_id);
                $businessUser->balance = $businessUser->balance + $order->amount;

                DB::transaction(function () use ($order, $businessUser) {
                    $order->save();
                    $businessUser->save();
                });
            }
            catch (\Throwable) {
                DB::rollBack();
                throw new \Exception('BalanceService: ошибка во время обработки callback.');
            }
            $data = ['status' => true, 'number' => $order->number, 'balance' => $businessUser->balance];
        } else {
            $data = ['status' => false];
        }

        return $data;
    }
}
