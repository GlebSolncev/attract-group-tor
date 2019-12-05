<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 19:55
 */


namespace App\Http\Controllers\Api\Messager;


use App\Models\Messager;
use Auth;

class ShowMessage extends MessagerBaseController
{
    private $user_from_id, $user, $response, $messager;

    /**
     * ShowMessage constructor.
     * @param $user_from_id
     */
    public function __construct($user_from_id)
    {
        $this->user = Auth::user();
        $this->user_from_id = (int)$user_from_id;
        $this->messager = new Messager();

        $this->validation();
        if (!$this->response)
            $this->setAttributes();
    }

    /**
     * Void
     */
    protected function setAttributes(): void
    {
        $messages = $this->messager
            ->where([
                ['user_to_id', '=', optional($this->user)->id],
                ['user_from_id', '=', $this->user_from_id]
            ])->get();
        $this->response = [
            'items' => $messages,
            'status' => $messages->isNotEmpty(),
        ];
    }

    /**
     *  Void
     */
    protected function validation(): void
    {
        if (!strpos(optional($this->user)->email, '@'))
            $this->response = [
                'status' => false,
                'messages' => 'User not correctly'
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