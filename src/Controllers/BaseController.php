<?php

namespace Controllers;

use Request;
use Router;
use Models\User;

class BaseController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function checkAccessLevel(int $minLevel): void
    {
        if (User::getAccessLevel() < $minLevel) {
            Router::redirect(ERROR_ACCESS_DENIED_PAGE);
        }
    }
}
