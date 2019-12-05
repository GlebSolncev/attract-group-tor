<?php
/**
 * To attract group
 * Created by: 5-HT.
 * Date: 05.12.2019 20:33
 */


namespace App\Http\Controllers\Api\Messager;


use App\Http\Controllers\Api\BaseController;

abstract class MessagerBaseController extends BaseController
{
    abstract protected function setAttributes(): void;

    abstract protected function validation(): void;

    abstract public function getResponse();
}