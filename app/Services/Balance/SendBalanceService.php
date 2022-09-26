<?php

namespace App\Services\Balance;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class SendBalanceService
{
    /**
     * Проверка на кол-во нужного баланса для отправки.
     *
     * @param int $userBalance
     * @param int $sendBalance
     * @return bool (Есть ли нужное кол-во)
     */
    protected function check(int $userBalance, int $sendBalance): bool
    {
        $success = false;
        if ($userBalance > $sendBalance) {
            $success = true;
        }
        return $success;
    }

    /**
     * Отправка баланса пользователю.
     *
     * @param int $userBalance
     * @param int $sendBalance
     * @param int $mobile_number
     * @return bool
     */
    public function send(int $userBalance, int $sendBalance, int $mobile_number): bool
    {
        $hasBalance = $this->check($userBalance, $sendBalance);
        if ($hasBalance === true) {
            try {
                $user = User::where('mobile_number', $mobile_number)->first();
                $user->balance = $user->balance + $sendBalance;
                DB::transaction(function () use ($user) {
                    $user->save();
                });
            }
            catch (\Throwable) {
                DB::rollBack();
                throw new \Exception('SendBalanceService: ошибка начисления баланса.');
            }
        }
        return $hasBalance;
    }
}
