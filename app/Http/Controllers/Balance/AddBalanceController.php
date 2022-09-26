<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallbackCloseInitialRequest;
use App\Http\Requests\CreateInitialRequest;
use App\Http\Resources\CreateInitialPaymentInfo;
use App\Http\Resources\GetCallbackInitialInfo;
use App\Services\Balance\AddBalanceService;
use App\Services\Order\CreateOrderService;
use Illuminate\Http\JsonResponse;


class AddBalanceController extends Controller
{
    protected CreateOrderService $orderService;
    protected AddBalanceService $balanceService;

    public function __construct(CreateOrderService $orderService, AddBalanceService $balanceService) {
        $this->orderService = $orderService;
        $this->balanceService = $balanceService;
    }


    /**
     * Инициализация оплаты.
     *
     * @param CreateInitialRequest $request
     * @return JsonResponse|CreateInitialPaymentInfo
     */
    public function createInitial(CreateInitialRequest $request): JsonResponse|CreateInitialPaymentInfo
    {
        try {
            $orderId = $this->orderService->create($request->user(), $request->amount);
            $createInitial  = $this->balanceService->createInitial($orderId, $request->amount);

            return (new CreateInitialPaymentInfo($createInitial))->additional(['status' => 201]);
        }
        catch (\Throwable) {
            return response()->json(['message' => 'Произошла ошибка при формировании запроса на оплату!']);
        }
    }

    /**
     * Коллбэк рузультата оплаты.
     *
     * @param CallbackCloseInitialRequest $request
     * @return JsonResponse|GetCallbackInitialInfo
     */
    public function callbackCloseInitial(CallbackCloseInitialRequest $request): JsonResponse|GetCallbackInitialInfo
    {
        try {
            $closeInitial = $this->balanceService->closeInitial($request->validated());

            return (new GetCallbackInitialInfo($closeInitial))->additional(['status' => 200]);
        }
        catch (\Throwable) {
            return response()->json(['message' => 'Произошла ошибка при завершении оплаты.']);
        }
    }
}
