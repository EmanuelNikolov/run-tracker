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
        $submissions = [
          ['url' => 'http://google.com', 'title' => 'Google'],
          ['url' => 'http://bing.com', 'title' => 'Bing'],
        ];
        $content = $this->templateRenderer->render('FrontPage/show.html.twig', [
          'submissions' => $submissions,
        ]);

        return new Response($content);
    }
}
