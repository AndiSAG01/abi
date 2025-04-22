<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdmTransaction;
use App\Controllers\Admin\BankController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ClassificationController;
use App\Controllers\Admin\ItemController;
use App\Controllers\Admin\ReportController;
use App\Controllers\Admin\TourController;
use App\Controllers\Admin\UserController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Customer\CartController;
use App\Controllers\Customer\LoginController as CustomerLoginController;
use App\Controllers\Customer\ProfileController;
use App\Controllers\Customer\RegisterController as CustomerRegisterController;
use App\Controllers\Customer\TransactionController;
use App\Controllers\Home;
use App\Controllers\ResetPasswordController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('', ['filter' => 'login'], function ($routes) {

    $routes->get('/admins-index', [AdminController::class, 'pages']);

    $routes->get('/admins/pelanggan', [UserController::class, 'index']);

    $routes->get('/admins/kategori', [CategoryController::class, 'index']);
    $routes->post('/admins/kategori/store', [CategoryController::class, 'store']);
    $routes->get('/admins/kategori/edit/(:num)', [CategoryController::class, 'edit']);
    $routes->post('/admins/kategori/update/(:num)', [CategoryController::class, 'update']);
    $routes->get('/admins/kategori/delete/(:num)', [CategoryController::class, 'delete']);


    $routes->get('/admins/klasifikasi', [ClassificationController::class, 'index']);
    $routes->post('/admins/klasifikasi/store', [ClassificationController::class, 'store']);
    $routes->get('/admins/klasifikasi/edit/(:num)', [ClassificationController::class, 'edit']);
    $routes->post('/admins/klasifikasi/update/(:num)', [ClassificationController::class, 'update']);
    $routes->get('/admins/klasifikasi/delete/(:num)', [ClassificationController::class, 'delete']);


    $routes->get('/admins/item', [ItemController::class, 'index']);
    $routes->post('/admins/item/store', [ItemController::class, 'store']);
    $routes->get('/admins/item/edit/(:num)', [ItemController::class, 'edit']);
    $routes->post('/admins/item/update/(:num)', [ItemController::class, 'update']);
    $routes->get('/admins/item/delete/(:num)', [ItemController::class, 'delete']);

    $routes->get('/admins/tour', [TourController::class, 'index']);
    $routes->get('/admins/tour/create', [TourController::class, 'create']);
    $routes->post('/admins/tour/store', [TourController::class, 'store']);
    $routes->get('/admins/tour/show/(:num)', [TourController::class, 'show']);
    $routes->get('/admins/tour/edit/(:num)', [TourController::class, 'edit']);
    $routes->post('/admins/tour/update/(:num)', [TourController::class, 'update']);
    $routes->get('/admins/tour/delete/(:num)', [TourController::class, 'delete']);

    #transaction-admin
    $routes->get('/transaction-admin', [AdmTransaction::class, 'index']);
    $routes->get('check-payment/(:num)', [AdmTransaction::class, 'check_payment']);
    $routes->post('confirmation/(:num)', [AdmTransaction::class, 'confirmation']);
    $routes->get('/transaction-admin/Sedang-Dalam-Perjalanan', [AdmTransaction::class, 'otw']);
    $routes->post('end/(:num)', [AdmTransaction::class, 'end']);
    $routes->get('/transaction-admin/Selesai', [AdmTransaction::class, 'finished']);
    $routes->post('cancel/(:num)', [AdmTransaction::class, 'cancelled']);
    $routes->get('/transaction-admin/Dibatalkan', [AdmTransaction::class, 'canceled']);

    #end-transaction-admin

    #laporan
    #laporan customer
    $routes->get('/Laporan-pelanggan', [ReportController::class, 'customer']);
    $routes->get('laporan/customer/pdf', [ReportController::class, 'customerPdf']);
    #laporan-transaksi
    $routes->get('/Laporan-transaksi', [ReportController::class, 'transaction']);
    $routes->get('Laporan/transaksi/pdf', [ReportController::class, 'TransactionPdf']);
    #end-laporan

    #bank
    $routes->get('/admins/bank', [BankController::class, 'index']);
    $routes->post('/admins/bank/store', [BankController::class, 'store']);
    $routes->get('/admins/bank/edit/(:num)', [BankController::class, 'edit']);
    $routes->post('/admins/bank/update/(:num)', [BankController::class, 'update']);
    $routes->get('/admins/bank/delete/(:num)', [BankController::class, 'delete']);
    #end-bank
    //end admin routes

});
#customer
$routes->group('', ['filter' => 'login'], function ($routes) {

    $routes->get('/profile', [ProfileController::class, 'index']);
    $routes->post('/profile/update', [ProfileController::class, 'update']);
    #cart
    $routes->post('/transactions/add', [CartController::class, 'add_list']);
    $routes->get('/transactions/delete/(:num)', [CartController::class, 'delete_list']);
    #endcart

    #transactions
    $routes->get('/transaction', [TransactionController::class, 'index']);
    $routes->post('/transactions/store', [TransactionController::class, 'store']);
    $routes->get('/getBookingDates', [TransactionController::class, 'getBookingDates']);
    #endtransactions

    #transaction-tabel
    $routes->get('/transactions-table', [TransactionController::class, 'table']);
    $routes->get('transaction-pay/(:num)', [TransactionController::class, 'payment']);
    $routes->post('payment/store', [TransactionController::class, 'payment_store']);
    $routes->get('/transaction/delete/(:num)', [TransactionController::class, 'deleteTransaction']);
    $routes->get('unduh-kwitansi/(:num)', [TransactionController::class, 'kwitansiPdf']);
    #end-transaction-tabel

    //Auth routes
    //end costumers route
});
$routes->get('/', [Home::class, 'index']);
$routes->get('/about', [Home::class, 'about']);
$routes->get('/destination', [Home::class, 'destination']);
$routes->get('/destination/detail/(:num)', [Home::class, 'destination_detail']);
