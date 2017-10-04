<?php
$app->get('/', 'Solidsites\\Controllers\\FrontendController::HomeAction');
$app->get('/login', 'Solidsites\\Controllers\\LoginController::loginAction');

