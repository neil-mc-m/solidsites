<?php
$app->get('/', 'Solidsites\\Controllers\\FrontendController::homeAction');
$app->get('/services', 'Solidsites\\Controllers\\FrontendController::servicesAction');
$app->get('/login', 'Solidsites\\Controllers\\LoginController::loginAction');
$app->get('/blog', 'Solidsites\\Controllers\\FrontendController::viewAllBlogPostsAction');
$app->post('/contact', 'Solidsites\\Controllers\\ContactFormController::sendContactFormAction');
$app->get('/{slug}', 'Solidsites\\Controllers\\FrontendController::viewPackageAction');

$app->get('/admin/dashboard', 'Solidsites\\Controllers\\LoginController::dashboardAction');
$app->get('/admin/packages', 'Solidsites\\Controllers\\PackageController::viewAction');
$app->get('/admin/packages/{slug}', 'Solidsites\\Controllers\\PackageController::packageDetailsAction');
$app->match('/admin/packages/edit/{slug}', 'Solidsites\\Controllers\\PackageController::editAction');

