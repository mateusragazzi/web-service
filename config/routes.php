<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRou    teClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    
    /*************************/
    /*************************/
    /**                     **/
    /**     MÉTODO GET      **/
    /**                     **/
    /*************************/
    /*************************/

    $builder->get(
        '/alunos',
        ['controller' => 'Alunos', 'action' => 'index']
    );

    $builder->get(
        '/alunos/:id',
        ['controller' => 'Alunos', 'action' => 'view']
    )->setPatterns(['id' => '[0-9]+']);

    
    /*************************/
    /*************************/
    /**                     **/
    /**     MÉTODO POST     **/
    /**                     **/
    /*************************/
    /*************************/

    $builder->post(
        '/alunos',
        ['controller' => 'Alunos', 'action' => 'add']
    );

    $builder->post(
        '/alunos',
        ['controller' => 'Errors', 'action' => 'notFound']
    )->setPatterns(['id' => '[0-9]+']);
    

    /*************************/
    /*************************/
    /**                     **/
    /**     MÉTODO PUT      **/
    /**                     **/
    /*************************/
    /*************************/

    $builder->put(
        '/alunos',
        ['controller' => 'Errors', 'action' => 'notAllowed']
    );

    $builder->put(
        '/alunos',
        ['controller' => 'Alunos', 'action' => 'edit']
    )->setPatterns(['id' => '[0-9]+']);

    /*************************/
    /*************************/
    /**                     **/
    /**    MÉTODO DELETE    **/
    /**                     **/
    /*************************/
    /*************************/

    $builder->delete(
        '/alunos',
        ['controller' => 'Errors', 'action' => 'notAllowed']
    );

    $builder->delete(
        '/alunos',
        ['controller' => 'Alunos', 'action' => 'delete']
    )->setPatterns(['id' => '[0-9]+']);

    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
