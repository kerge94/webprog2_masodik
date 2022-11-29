<?php

final class Request
{
    private array $params;

    public function __construct()
    {
        $this->params = $_REQUEST;
        $json = file_get_contents('php://input');
        $data = json_decode($json, true) ?? [];
        $this->params = array_merge($_REQUEST, $data);
    }

    public function getURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getParam(string $key): ?string
    {
        return $this->params[$key] ?? null;
    }

    public function getStrippedURI(): string
    {
        $cleanedURI = strtok($this->getURI(), '?');
        return trim($cleanedURI, '/');
    }
}
