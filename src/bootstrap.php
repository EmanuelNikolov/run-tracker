<?php
declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

\Tracy\Debugger::enable();

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = \FastRoute\simpleDispatcher(
  function (\FastRoute\RouteCollector $collector) {
      $routes = include (ROOT_DIR . 'src/routes.php');

      foreach ($routes as $route) {
          $collector->addRoute(...$route);
      }
  }
);

$routeInfo = $dispatcher->dispatch(
  $request->getMethod(),
  $request->getPathInfo()
);

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $httpCode = \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND;
        $response = new \Symfony\Component\HttpFoundation\Response(
          \Symfony\Component\HttpFoundation\Response::$statusTexts[$httpCode],
          $httpCode
        );
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $httpCode = \Symfony\Component\HttpFoundation\Response::HTTP_METHOD_NOT_ALLOWED;
        $response = new \Symfony\Component\HttpFoundation\Response(
          \Symfony\Component\HttpFoundation\Response::$statusTexts[$httpCode],
          $httpCode
        );
        break;
    case \FastRoute\Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $params = $routeInfo[2];

        $controller = new $controllerName;
        $response = $controller->$method($request, $params);
        break;
}

if (!$response instanceof \Symfony\Component\HttpFoundation\Response) {
    throw new \Exception('Controller must return Response object.');
}

$response->prepare($request);
$response->send();
