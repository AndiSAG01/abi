<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ClassificationController;
use App\Controllers\Admin\ItemController;
use App\Controllers\Admin\TourController;
use App\Controllers\Admin\UserController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Customer\LoginController as CustomerLoginController;
use App\Controllers\Customer\ProfileController;
use App\Controllers\Customer\RegisterController as CustomerRegisterController;
use App\Controllers\Customer\TransactionController;
use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */




//Admin routes
$routes->group('register', function($routes){
    $routes->get('/', [RegisterController::class,'index']);
    $routes->post('/', [RegisterController::class,'store']);
});

$routes->group('login', function ($routes) {
    $routes->get('/', [LoginController::class,'index']);
    $routes->post('/', [LoginController::class,'login']);
});


$routes->group('logout', function ($routes) {
    $routes->get('/', [LogoutController::class,'index']);
});
$routes->get('/admins-index',[AdminController::class,'pages']);

$routes->get('/admins/pelanggan',[UserController::class,'index']);

$routes->get('/admins/kategori',[CategoryController::class,'index']);
$routes->post('/admins/kategori/store',[CategoryController::class,'store']);
$routes->get('/admins/kategori/edit/(:num)', [CategoryController::class,'edit']);
$routes->post('/admins/kategori/update/(:num)', [CategoryController::class,'update']);
$routes->get('/admins/kategori/delete/(:num)', [CategoryController::class,'delete']);


$routes->get('/admins/klasifikasi',[ClassificationController::class,'index']);
$routes->post('/admins/klasifikasi/store',[ClassificationController::class,'store']);
$routes->get('/admins/klasifikasi/edit/(:num)', [ClassificationController::class,'edit']);
$routes->post('/admins/klasifikasi/update/(:num)', [ClassificationController::class,'update']);
$routes->get('/admins/klasifikasi/delete/(:num)', [ClassificationController::class,'delete']);


$routes->get('/admins/item',[ItemController::class,'index']);
$routes->post('/admins/item/store',[ItemController::class,'store']);
$routes->get('/admins/item/edit/(:num)', [ItemController::class,'edit']);
$routes->post('/admins/item/update/(:num)', [ItemController::class,'update']);
$routes->get('/admins/item/delete/(:num)', [ItemController::class,'delete']);

$routes->get('/admins/tour',[TourController::class,'index'] );
$routes->get('/admins/tour/create',[TourController::class,'create'] );
$routes->post('/admins/tour/store',[TourController::class,'store'] );
$routes->get('/admins/tour/show/(:num)',[TourController::class,'show'] );
$routes->get('/admins/tour/edit/(:num)',[TourController::class,'edit'] );
$routes->post('/admins/tour/update/(:num)',[TourController::class,'update'] );
$routes->get('/admins/tour/delete/(:num)',[TourController::class,'delete'] );
//end admin routes



//costumers routes
$routes->group('register_costumer', function($routes){
    $routes->get('/', [\App\Controllers\Customer\RegisterController::class,'index']);
    $routes->post('/', [\App\Controllers\Customer\RegisterController::class,'store']);
});
$routes->group('logins', function ($routes) {
    $routes->get('/', [\App\Controllers\Customer\LoginController::class,'index']);
    $routes->post('/', [\App\Controllers\Customer\LoginController::class,'login']);
});

$routes->group('logouts', function ($routes) {
    $routes->get('/', [\App\Controllers\Customer\LogoutController::class,'index']);
});





$routes->get('/', [Home::class,'index']);
$routes->get('/about',[Home::class,'about']);
$routes->get('/destination',[Home::class,'destination']);
$routes->get('/destination/detail/(:num)',[Home::class,'destination_detail']);
$routes->get('/booking/(:num)',[Home::class,'booking']);

$routes->get('/profile',[ProfileController::class,'index']);
$routes->post('/profile/update',[ProfileController::class,'update']);

$routes->get('/transaction',[TransactionController::class,'index']);
$routes->post('/transactions/add',[TransactionController::class,'add_list']);
$routes->get('/transactions/delete/(:num)',[TransactionController::class,'delete_list']);
$routes->post('/transactions/update/(:num)',[TransactionController::class,'updateTransaction']);


$routes->get('/transactions-table',[TransactionController::class,'table']);
//Auth routes
//end costumers route


