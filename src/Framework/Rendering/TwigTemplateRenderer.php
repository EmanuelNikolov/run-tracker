<?php

namespace RunTracker\Framework\Rendering;


final class TwigTemplateRenderer implements TemplateRenderer
{

    /**
     * @var \Twig_Environment
     */
    private $twigEnv;

    public function __construct(\Twig_Environment $twigEnv)
    {
        $this->twigEnv = $twigEnv;
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twigEnv->render($template, $data);
    }
}
