<?php

final class Router
{
    public function handle(Request $request): void
    {
        [$controllerClass, $method] = $this->splitURI($request->getStrippedURI());
        $controller = new $controllerClass($request);
        $controller->$method();
    }

    private function splitURI(string $uri): array
    {
        $splittedURI = explode('/', $uri);

        $method = array_pop($splittedURI);
        $controller = "Controllers\\" . ucfirst(array_pop($splittedURI));

        return [$controller, $method];
    }
}
