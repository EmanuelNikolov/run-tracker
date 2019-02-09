<?php declare(strict_types=1);

namespace RunTracker\Framework\Rendering;


final class TwigTemplateRendererFactory
{

    /**
     * @var TemplateDirectory
     */
    private $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    public function create(): TwigTemplateRenderer
    {
        $templateDirectory = $this->templateDirectory->toString();
        $loader = new \Twig_Loader_Filesystem([$templateDirectory]);
        $twigEnv = new \Twig_Environment($loader);

        return new TwigTemplateRenderer($twigEnv);
    }
}
