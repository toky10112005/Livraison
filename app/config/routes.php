<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router; 
//use app\controllers\ApiExampleController;

/** 
 * @var Router $router 
 * @var Engine $app 
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	// $router->get('/', function() use ($app) {
	// 	$app->render('welcome', [ 'message' => 'tafiditra ato conf/routes' ]);
	// });

	$router->get('/', function() use ($app) {
		$controller=new ApiExampleController($app);
		 $product=$controller -> AllBenefice(); 
	});

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	$router->group('/api', function() use ($router) {
		// $router->get('/product', [ ApiExampleController::class, 'getProduct' ]);
		// $router->get('/produit/@id:[0-9]', [ ApiExampleController::class, 'getSingleProduct' ]);
		
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});

	//$Welcome_Controller=new ApiExampleController($app);
	
}, [ SecurityHeadersMiddleware::class ]);