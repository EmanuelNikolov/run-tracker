<?php
declare(strict_types=1);

namespace RunTracker\FrontPage\Presentation;


use RunTracker\Framework\Rendering\TemplateRenderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FrontPageController
{

    /**
     * @var TemplateRenderer
     */
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response
    {
        $content = 'Hi, ' . $request->get('name', 'Anonymous');

        return new Response($content);
    }
}
