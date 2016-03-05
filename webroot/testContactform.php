<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config.php';

// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactory();

//Load required services
$di->set('FormController', function () use ($di) {
    $controller = new \Anax\Users\FormController();
    $controller->setDI($di);
    return $controller;
});

$app = new \Anax\MVC\CApplicationBasic($di);

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// On production server, set pretty urls and use rewrite in .htaccess
$app->url->setUrlType(
    ($_SERVER['SERVER_NAME']=='localhost') ?
    \Anax\Url\CUrl::URL_APPEND : \Anax\Url\CUrl::URL_CLEAN
);



// Load Contact Form Controller
$di->set('ContactformController', function () use ($di) {
    $controller = new \Fnlive\Contactform\ContactFormController();
    $controller->setDI($di);
    return $controller;
});


$app->router->add('', function () use ($app) {
    $app->theme->setTitle("Contact form");

    $app->views->add('default/page', [
        'title' => "Testing contact form",
        'content' => "Page for testing contact form. Click below link to administrate and view messages.",
        'links' => [
            [
                'href' => $app->url->create('contactformadmin/setup'),
                'text' => "Setup user table with test data (first time setup)",
            ],
            [
                'href' => $app->url->create('admin'),
                'text' => "Contact form administration",
            ],
        ],
    ]);

    $app->dispatcher->forward([
        'controller' => 'contactform',
        'action'     => 'display',
    ]);

});

// Load Contact Form controller
$di->set('ContactformadminController', function () use ($di) {
    $controller = new \Fnlive\Contactform\ContactFormAdminController();
    $controller->setDI($di);
    return $controller;
});

$app->router->add('admin', function () use ($app) {
    $app->theme->setTitle("Admin contacts");

    $app->views->add('default/page', [
        'title' => "Admin contacts",
        'content' => "Page for testing contact form message administration.",
        'links' => [
            [
                'href' => $app->url->create('contactformadmin/setup'),
                'text' => "Setup user table with test data",
            ],
            [
                'href' => $app->url->create(''),
                'text' => "Submit test message",
            ],
        ],
    ]);

    $app->dispatcher->forward([
        'controller' => 'contactformadmin',
        // 'controller' => 'ContactFormAdminController',
        'action'     => 'list',
        'title' => "Testing contact form",
    ]);

});



$app->router->handle();

// Render the response using theme engine.
$app->theme->render();
