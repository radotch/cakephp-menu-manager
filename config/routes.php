<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'MenuManager',
    ['path' => '/menu-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::prefix('admin', [], function (RouteBuilder $routes) {
    $routes->plugin(
        'MenuManager',
        ['path' => '/menu-manager'],
        function (RouteBuilder $routes) {
            $routes->connect('/', ['controller' => 'Menus', 'action' => 'index']);

            $routes->fallbacks(DashedRoute::class);
        });
    $routes->fallbacks(DashedRoute::class);
});
