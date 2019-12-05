<?php
/**
 * To attract group
 * Created by: 5-HT.
 ** Date: 05.12.2019 17:54
 *
 * Create user
 */


namespace App\Http\Controllers\Api\User;


use App\User;
use Validator;

class RegisterUser extends UserBaseController
{
    private $request, $response, $status;

    /**
     * Register constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = optional($request)->all();
        $this->validation($request);

        if (!$this->response)
            $this->setAttributes();
    }

    /**
     * Void
     */
    protected function setAttributes(): void
    {
        $user = User::create(collect($this->request)->map(function ($item, $name) {
            return ($name == "password") ? bcrypt($item) : $item;
        })->toArray());

        $this->response = [
            'token' => $user->createToken('MyApp')->accessToken,
            'name' => $user->name,
        ];
    }

    /**
     * @param $request
     */
    protected function validation($request)
    {
        $validation = Validator::make(optional($request)->all(), [
            'email' => 'required|min:5|unique:users',
            'password' => 'required',
        ], [
            'email.required' => 'Email required!',
            'email.min:5' => 'Email min length: 5',
            'email.unique' => 'The email has already been taken!',
            'password.required' => 'Password empty!',
        ]);

        $this->validation = $validation;
        if ($validation->fails()) {
            $this->status = 301;
            $this->response = [
                'status' => false,
                'messages' => $validation->messages()
            ];
        }
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}