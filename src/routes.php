<?php
$app->get('/', 'Solidsites\\Controllers\\FrontendController::HomeAction');
$app->get('/login', 'Solidsites\\Controllers\\LoginController::loginAction');
$app->get('/admin/dashboard', 'Solidsites\\Controllers\\LoginController::dashboardAction');
$app->get('/admin/packages', 'Solidsites\\Controllers\\PackageController::viewAction');
$app->get('/admin/packages/{slug}', 'Solidsites\\Controllers\\PackageController::viewPackageDetailsAction');
$app->match('/admin/packages/edit/{slug}', 'Solidsites\\Controllers\\PackageController::editAction');

