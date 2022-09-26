<?php

namespace App\Http\Controllers\Balance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Balance\SendBalanceRequest;
use App\Http\Resources\Balance\StatusResource;
use App\Services\Balance\SendBalanceService;
use Illuminate\Http\JsonResponse;


class SendBalanceController extends Controller
{
    protected SendBalanceService $sendBalanceService;

    public function __construct(SendBalanceService $sendBalanceService) {
        $this->sendBalanceService = $sendBalanceService;
    }


    /**
     * Отправка баланса пользователю по номеру телефона.
     *
     * @param SendBalanceRequest $request
     * @return JsonResponse|StatusResource
     */
    public function send(SendBalanceRequest $request): JsonResponse|StatusResource
    {
        try {
            $success = $this->sendBalanceService->send($request->user()->balance, $request->send_balance, $request->mobile_number);
            if ($success === true) {
                $data = ['message' => 'Вы успешно отправили пользователю средства!', 'success' => true];
            } else {
                $data = ['message' => 'На вашем счету недостаточно средств!', 'success' => false];
            }

            return (new StatusResource($data))->additional(['status' => 200]);
        }
        catch (\Throwable) {
            return response()->json(['message' => 'Произошла ошибка при отправке баланса пользователю!']);
        }
    }
}
