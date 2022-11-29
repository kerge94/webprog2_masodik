<?php

namespace Controllers;

class Api extends BaseController
{
    public function szoftver(): void
    {
        switch ($this->request->getMethod()) {
            case 'GET': {
                $this->get();
                break;
            }
            case 'POST': {
                break;
            }
            case 'PUT': {
                break;
            }
            case 'DELETE': {
                break;
            }
            default: {

            }
        }
    }

    protected function get(): never
    {
        $this->sendJSON(null, 202);
    }
}