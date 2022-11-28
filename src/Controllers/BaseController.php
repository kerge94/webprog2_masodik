<?php

namespace Controllers;

use Request;

class BaseController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }   
}
