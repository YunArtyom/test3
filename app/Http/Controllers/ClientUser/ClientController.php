<?php

namespace App\Http\Controllers\ClientUser;

use App\Http\Controllers\Controller;
use App\Http\Resources\Balance\GetClientAllInfo;
use App\Models\ClientUser;
use Illuminate\Http\JsonResponse;


class ClientController extends Controller
{
    /**
     * Получение пользователя по номеру телфона.
     *
     * @param ClientUser $user
     * @return JsonResponse|GetClientAllInfo (404 обрабатывается в routes)
     */
    public function get(ClientUser $user): JsonResponse|GetClientAllInfo
    {
        try {
            return (new GetClientAllInfo($user))->additional(['status' => 200]);
        }
        catch (\Throwable) {
            return response()->json(['message' => 'Произошла ошибка во время отображения всей информации пользователя!']);
        }
    }
}
