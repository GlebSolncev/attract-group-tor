<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 18:33
 *
 * you can add message to user
 */


namespace App\Http\Controllers\Api\Messager;


use App\Models\Messager;
use Auth;
use Validator;

class StoreMessage extends MessagerBaseController
{
    private $request, $user_to_id, $response;

    /**
     * StoreMessage constructor.
     * @param $user_to_id
     * @param $request
     */
    public function __construct($user_to_id, $request)
    {
        $this->request = optional($request)->all();
        $this->user_to_id = $user_to_id;
        $this->validation();
        if(!$this->response)
            $this->setAttributes();
    }

    /**
     * Void
     */
    protected function setAttributes(): void
    {
        $user = Auth::user();
        $user_from_id = optional($user)->id;

        $messager = new Messager;
        $messager->create([
            'text' => $this->request['message'],
            'user_from_id' => $user_from_id,
            'user_to_id' => $this->user_to_id
        ]);
        $items = $messager
            ->where('user_to_id', $this->user_to_id)
            ->where('user_from_id', $user_from_id)
            ->get();

        $this->response = [
            'items' => $items,
            'status' => optional($items)->isNotEmpty()
        ];
    }

    /**
     *  Void
     */
    protected function validation():void
    {
        $validation = Validator::make($this->request,[
            'message' => 'required|min:2',
        ], [
            'message.required'=>'Message required!',
            'message.min:2'=>'Message min length: 5',
        ]);

        if($validation->fails())
            $this->response = [
                'status' => false,
                'message' => $validation->messages()
            ];
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}