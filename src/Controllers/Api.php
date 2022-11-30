<?php

namespace Controllers;

use Throwable;
use Models\Software;

class Api extends BaseController
{
    public function szoftver(): void
    {
        try {
            switch ($this->request->getMethod()) {
                case 'GET': {
                    $this->get();
                    break;
                }
                case 'POST': {
                    $this->post();
                    break;
                }
                case 'PUT': {
                    $this->put();
                    break;
                }
                case 'DELETE': {
                    $this->delete();
                    break;
                }
                default: {
                    $this->sendJSON(null, 405);
                }
            }
        }
        catch (Throwable $e) {
            if (DEBUG_MODE) {
                throw $e;
            }
            $this->sendJSON(null, 500);
        }        
    }

    protected function get(): never
    {
        $responseCode = 200;
        $result = null;
        $id = $this->getResourceId();

        if ($id !== null) {
            $result = Software::get($id)[0];
            if (!$result) {
                $responseCode = 404;
            }
        }
        else {
            $result = Software::getAll();
        }        
        $this->sendJSON($result, $responseCode);
    }

    protected function post(): never
    {
        $responseCode = 201;
        $result = null;
        $nev = $this->request->getParam('nev');
        $kategoria = $this->request->getParam('kategoria');

        if ($nev === null || $kategoria === null) {
            $responseCode = 400;
        }
        else {
            $result = ['id' => Software::create($nev, $kategoria)];
        }
        $this->sendJSON($result, $responseCode);
    }

    protected function put(): never
    {
        $responseCode = 200;
        $id = $this->getResourceId();
        $nev = $this->request->getParam('nev');
        $kategoria = $this->request->getParam('kategoria');

        if (!Software::get($id)[0]) {
            $responseCode = 404;
        }
        elseif ($nev === null || $kategoria === null) {
            $responseCode = 400;
        }
        else {
            Software::update($id, $nev, $kategoria);
        }
        $this->sendJSON(null, $responseCode);
    }

    protected function delete(): never
    {
        $responseCode = 200;
        $id = $this->getResourceId();

        if (!Software::get($id)[0]) {
            $responseCode = 404;
        }
        else {
            Software::delete($id);
        }
        $this->sendJSON(null, $responseCode);
    }
}