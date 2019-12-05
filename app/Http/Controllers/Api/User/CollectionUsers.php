<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 18:42
 *
 * All users
 * without me
 */


namespace App\Http\Controllers\Api\User;


use App\User;

class CollectionUsers extends UserBaseController
{
    private $collection, $response;

    /**
     * CollectionUsers constructor.
     * @param $me
     */
    public function __construct($me)
    {
        $this->validation($me);
        if (!$this->response) $this->setAttributes();
    }

    /**
     *  Void
     */
    protected function setAttributes(): void
    {
        $this->response = [
            'items' => $this->collection,
            'status' => optional($this->collection)->isNotEmpty()
        ];
    }

    /**
     * @param $me
     */
    protected function validation($me): void
    {
        $users = User::where('id', '!=', $me->id)->get();
        if ($users->isEmpty())
            $this->response = [
                'status' => false,
                'messages' => 'We not have a users'
            ];
        else $this->collection = $users;

    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}