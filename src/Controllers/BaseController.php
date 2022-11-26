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

    public function test(): void
    {
        echo '<pre>';
        var_dump($this->request->getParams());
        echo '</pre>';
    }    
}