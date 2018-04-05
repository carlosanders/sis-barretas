<?php
// Application middleware
// e.g: $app->add(new \Slim\Csrf\Guard);

$container = $app->getContainer();

if ($container->get("settings")["displayErrorDetails"]) {
    $app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);
};
