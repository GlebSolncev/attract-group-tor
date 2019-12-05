<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 18:00
 *
 * Messager Api
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Messager\ShowMessage;
use App\Http\Controllers\Api\Messager\StoreMessage;
use Illuminate\Http\Request;

class MessagerController extends BaseController
{
    public function store($user_to_id, Request $request)
    {
        $messager = new StoreMessage($user_to_id, $request);

        return response()->json(
            $messager->getResponse(),
            200
        );
    }

    public function show($user_from_id)
    {
        $message = new ShowMessage($user_from_id);
        return response()->json(
            $message->getResponse(),
            200
        );
    }
}