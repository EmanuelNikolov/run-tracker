<?php

namespace RunTracker\Submission\Presentation;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController
{

    public function show(Request $request): Response
    {
        $content = 'Submission Controller';

        return new Response($content);
    }
}
