<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->setAutoRoute(value: false);
$routes->get('/', to: 'Home::index');
$routes->get('/about', to: 'Page::about');
$routes->get('/contact', to: 'Page::contact');
$routes->get('/faqs', to: 'Page::faqs');
$routes->get('/news', 'News::index');
$routes->get('/news/(:any)', 'News::viewNews/$1');