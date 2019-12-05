<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\User\CollectionUsers;
use App\Http\Controllers\Api\User\LoginUser;
use App\Http\Controllers\Api\User\ProfileUser;
use App\Http\Controllers\Api\User\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $login = new LoginUser($request);

        return response()->json(
            $login->getResponse(),
            200
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $register = new RegisterUser($request);

        return response()->json(
            $register->getResponse(),
            200
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $me = Auth::user();
        $collection = new CollectionUsers($me);

        return response()->json(
            $collection->getResponse(),
            200
        );

    }
}
