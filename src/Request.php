<?php

final class Request
{
    public function getHost(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

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

    public function getParam(string $key): ?string
    {
        return $_REQUEST[$key] ?? null;
    }

    public function getStrippedURI(): string
    {
        $cleanedURI = strtok($this->getURI(), '?');
        return trim($cleanedURI, '/');
    }
}
