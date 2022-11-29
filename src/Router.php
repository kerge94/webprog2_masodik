<?php

final class Router
{
    public function handle(Request $request): void
    {
        $uri = $request->getStrippedURI();

        if (empty($uri)) {
            self::redirect(HOME_PAGE);
        }

        [$controllerClass, $method] = self::splitURI($uri);
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

    public static function splitURI(string $uri): array
    {
        $splittedURI = explode('/', $uri);

        $controller = "Controllers\\" . ucfirst(array_shift($splittedURI));
        $method = array_shift($splittedURI);

        return [$controller, $method, $splittedURI];
    }

    public static function redirect(string $to): never
    {
        header("Location: $to");
        exit;
    }
}
