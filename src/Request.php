<?php

final class Request
{
    public function getURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getParams(): array
    {
        return $_REQUEST;
    }
}
