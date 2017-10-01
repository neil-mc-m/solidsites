<?php
$app->get('/', 'Solidsites\\Controllers\\FrontendController::HomeAction');
$app->get('/packages/{name}', 'Solidsites\\Controllers\\FrontendController::packageAction');

