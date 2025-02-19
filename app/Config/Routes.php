<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Front\HomeController::index');
$routes->get('/rooms', 'Front\RoomController::index');


//PANEL
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'Admin\DashboardController::index');

    //kullanıcı yönetimi
    $routes->get('users', 'Admin\UserController::index');
    $routes->post('user-add', 'Admin\UserController::user_add');
    $routes->post('user-get-single','Admin\UserController::user_get_single');
    $routes->post('user-update', 'Admin\UserController::user_update');
    $routes->post('user-delete', 'Admin\UserController::delete');

    //kullanıcılara yetki atama
    $routes->get('user-permissions', 'Admin\PermissionController::index');
    $routes->post('user-save-permissions', 'Admin\PermissionController::userSavePermissions');

    //yetki düzenleme
    $routes->get('permissions','Admin\PermissionController::permissionList');
    $routes->post('permission-add','Admin\PermissionController::store');
    $routes->post('permission-get-single','Admin\PermissionController::get_single');
    $routes->post('permission-update','Admin\PermissionController::update');
    $routes->post('permission-delete', 'Admin\PermissionController::delete');

    //kullanıcı gurubu işlemleri
    $routes->get('user-groups','Admin\UserGroupController::index');
    $routes->post('user-group-add','Admin\UserGroupController::store');
    $routes->post('group-get-single','Admin\UserGroupController::get_single');
    $routes->post('group-update','Admin\UserGroupController::update');
    $routes->post('user-group-delete','Admin\UserGroupController::delete');

});


//giriş işlemleri
$routes->get('admin/login','Auth\AuthController::index');
$routes->post('admin/login','Auth\AuthController::login');
$routes->get('admin/logout','Auth\AuthController::logout');



