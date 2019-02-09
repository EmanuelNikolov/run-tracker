<?php declare(strict_types=1);

use Auryn\Injector;
use RunTracker\Framework\Rendering\TemplateDirectory;
use RunTracker\Framework\Rendering\TemplateRenderer;
use RunTracker\Framework\Rendering\TwigTemplateRendererFactory;

$injector = new Injector();

$injector->define(TemplateDirectory::class, [':rootDirectory' => ROOT_DIR]);
$injector->delegate(
  TemplateRenderer::class,
  function () use ($injector): TemplateRenderer {
      $factory = $injector->make(TwigTemplateRendererFactory::class);

      return $factory->create();
  }
);

return $injector;
