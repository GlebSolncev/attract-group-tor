<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 18:15
 *
 * You can take token.
 */


namespace App\Http\Controllers\Api\User;


use Auth;
use Validator;

class LoginUser extends UserBaseController
{
    private $response, $email, $password;

    /**
     * Login constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->email = $request->email;
        $this->password = $request->password;

        $this->validation($request);
        $this->setAttributes();
    }

    /**
     * Void
     */
    protected function setAttributes(): void
    {
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password]) && !$this->response) {
            $user = Auth::user();
            $response['token'] = optional($user)->createToken('MyApp')->accessToken;
            $response['status'] = true;
        } else $response['status'] = false;


        $this->response = $response;
    }

    /**
     * @param $request
     */
    protected function validation($request)
    {
        $validation = Validator::make(optional($request)->all(), [
            'email' => 'required|min:5|exists:users',
            'password' => 'required',
        ], [
            'email.required' => 'Email required!',
            'email.min:5' => 'Email min length: 5',
            'email.exists' => 'Email not exists',
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