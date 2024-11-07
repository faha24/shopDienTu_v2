<?php

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DetailController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductController;
use App\Models\Product;
use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

// filter check đăng nhập
$router->filter('auth', function () {
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        header('location: ' . BASE_URL . 'login');
        die;
    }
});

// khu vực cần quan tâm -----------
// bắt đầu định nghĩa ra các đường dẫn
$router->get('/', function () {
    return "trang chủ";
});
$router->get('login', function () {
    return "trang chủ";
});
$router->group(['prefix' => 'admin'], function ($router) {
    $router->get('', [DashboardController::class, 'index']);
    $router->group(['prefix' => 'products'], function ($router) {

        $router->get('', [ProductController::class, 'index']);
        $router->get('listTrash', [ProductController::class, 'listTrash']);
        $router->post('create', [ProductController::class, 'create']);
        $router->post('update', [ProductController::class, 'update']);
        $router->get('destroy/{id}', [ProductController::class, 'destroy']);
        $router->get('rollback/{id}', [ProductController::class, 'rollback']);

        $router->group(['prefix' => 'detail'], function ($router) {
            $router->get('', [DetailController::class, 'index']);
            $router->post('create', [DetailController::class, 'create']);
            $router->get('destroy/{id}', [DetailController::class, 'destroy']);
        });
        
    });
    $router->group(['prefix' => 'categories'], function ($router) {
        
        $router->get('', [CategoryController::class, 'index']);
        $router->post('create', [CategoryController::class, 'create']);
        $router->post('update', [CategoryController::class, 'update']);
        $router->get('destroy/{id}', [CategoryController::class, 'destroy']);
        
    });
});
$router->group(['prefix' => 'api'], function ($router) {

    $router->get('{id}/getPr', [ProductController::class, 'get']);
    $router->get('{id}/getCate', [CategoryController::class, 'get']);
});


// ['before' => 'auth']

// $router->get('add-product', [ProductController:: class ,'addProductView']);
// $router->get('edit-product/{id}', [ProductController:: class ,'editProductView']);
// $router->get('delete-product/{id}', [ProductController:: class ,'destroy']);
// $router->post('add-product', [ProductController:: class ,'store'] );
// $router->post('edit-product/{id}', [ProductController:: class ,'update']);


// //cate 
// $router->get('list-cate', [CategoryController:: class ,'index'] );
// $router->get('add-cate', [CategoryController:: class ,'addCateView']);

// $router->get('edit-cate/{id}', [CategoryController:: class ,'editCateView']);
// $router->get('delete-cate/{id}', [CategoryController:: class ,'destroy']);
// $router->post('add-cate', [CategoryController:: class ,'store'] );
// $router->post('edit-cate/{id}', [CategoryController:: class ,'update']);
// // khu vực cần quan tâm -----------
//$router->get('test', [App\Controllers\ProductController::class, 'index']);

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;
