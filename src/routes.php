<?php
declare(strict_types=1);

use RunTracker\FrontPage\Presentation\FrontPageController;
use RunTracker\Submission\Presentation\SubmissionController;

return [
  [
    'GET',
    '/',
    FrontPageController::class . '#show',
  ],
  [
    'GET',
    '/submit',
    SubmissionController::class . '#show',
  ],
];
