<?php declare(strict_types=1);

namespace RunTracker\Framework\Rendering;


final class TwigTemplateRendererFactory
{

    public function create(): TwigTemplateRenderer
    {
        $loader = new \Twig_Loader_Filesystem([]);
        $twigEnv = new \Twig_Environment($loader);

        return new TwigTemplateRenderer($twigEnv);
    }
}
