<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 17:53
 */


namespace App\Http\Controllers\Api\User;


abstract class UserBaseController
{

    abstract protected function setAttributes(): void;

    abstract protected function validation($request);

    abstract public function getResponse();
}