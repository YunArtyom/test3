<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Support\Str;


class CreateOrderService
{
    /**
     * Создание ордера на пополение баланса.
     *
     * @param int $businessUser
     * @param int $amount
     * @return int (ID созданного ордера)
     */
    public function create(int $businessUser, int $amount): int
    {
        $order = new Order;
        $order->number = time() . Str::random(10);
        $order->amount = $amount;
        $order->is_payed = false;
        $order->business_user_id = $businessUser;
        $order->save();

        return $order->id;
    }
}
