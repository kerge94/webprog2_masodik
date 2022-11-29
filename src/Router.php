<?php

final class Router
{
    public function handle(Request $request): void
    {
        $uri = $request->getStrippedURI();

        if (empty($uri)) {
            self::redirect(HOME_PAGE);
        }

        [$controllerClass, $method] = $this->splitURI($uri);
        try {
            $controller = new $controllerClass($request);
            $controller->$method();
        }
        catch (Throwable $e) {
            if (DEBUG_MODE) {
                throw $e;
            }
            self::redirect(ERROR_404_PAGE);
        }     
    }

    private function splitURI(string $uri): array
    {
        $splittedURI = explode('/', $uri);

        $method = array_pop($splittedURI);
        $controller = "Controllers\\" . ucfirst(array_pop($splittedURI));

        return [$controller, $method];
    }

    public static function redirect(string $to): never
    {
        header("Location: $to");
        exit;
    }
}
