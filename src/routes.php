<?php
declare(strict_types=1);

return [
  [
    \Symfony\Component\HttpFoundation\Request::METHOD_GET,
    '/',
    \RunTracker\FrontPage\Presentation\FrontPageController::class . '#show',
  ],
  [
    \Symfony\Component\HttpFoundation\Request::METHOD_GET,
    '/submit',
    \RunTracker\Submission\Presentation\SubmissionController::class . '#show',
  ],
];
