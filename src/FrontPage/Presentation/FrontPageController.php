<?php
declare(strict_types=1);

namespace RunTracker\FrontPage\Presentation;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontPageController
{

    public function show(Request $request): Response
    {
        $content = 'Hi, ' . $request->get('name', 'Anonymous');

        return new Response($content);
    }
}
