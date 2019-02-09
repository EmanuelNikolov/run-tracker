<?php declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

\Tracy\Debugger::enable();

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = \FastRoute\cachedDispatcher(
  function (\FastRoute\RouteCollector $collector) {
      $routes = include(ROOT_DIR . '/src/routes.php');

      foreach ($routes as $route) {
          $collector->addRoute(...$route);
      }
  }, [
    'cacheFile' => ROOT_DIR . '/tmp/cache/routes.cache',
    'cacheDisabled' => \Tracy\Debugger::isEnabled(),
  ]
);

$routeInfo = $dispatcher->dispatch(
  $request->getMethod(),
  $request->getPathInfo()
);

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response = new Response(
          'Not Found',
          404
        );
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new Response(
          'Method Not Allowed',
          405
        );
        break;
    case \FastRoute\Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $params = $routeInfo[2];

        $injector = include(ROOT_DIR . '/src/dependencies.php');

        $controller = $injector->make($controllerName);
        $response = $controller->$method($request, $params);
        break;
}

if (!$response instanceof Response) {
    throw new \Exception('Controller must return Response object.');
}

$response->prepare($request);
$response->send();
