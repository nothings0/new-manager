<?php

use App\Controllers\AuthenticationController;
use App\Router;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\EmployeeController;

// Usage:
$router = new Router();

// Add routes
$router->addAuthRoute('/\//', [new UserController(), 'index']);

$router->addAuthRoute('/\/product/', [new ProductController(), 'index']);
$router->addAuthRoute('/\/product\/show\/(\d+)/', [new ProductController(), 'show']);
$router->addAuthRoute('/\/product\/create/', [new ProductController(), 'create']);
$router->addAuthRoute('/\/product\/update\/(\d+)/', [new ProductController(), 'update']);
$router->addAuthRoute('/\/product\/delete\/(\d+)/', [new ProductController(), 'delete']);

$router->addAuthRoute('/\/user\/show\/(\d+)/', [new UserController(), 'show']);
$router->addAuthRoute('/\/user\/create/', [new UserController(), 'create']);
$router->addAuthRoute('/\/user\/update\/(\d+)/', [new UserController(), 'update']);
$router->addAuthRoute('/\/user\/delete\/(\d+)/', [new UserController(), 'delete']);

$router->addRoute('/\/auth\/login/', [new AuthenticationController(), 'login']);
$router->addRoute('/\/change-password/', [new AuthenticationController(), 'changePassword']);
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
$router->addRoute('/\/403/', [new AuthenticationController(), 'accessdenined']);
$router->addAuthRoute('/\/auth\/logout/', [new AuthenticationController(), 'logout']);

$router->addAuthRoute('/\/category/', [new CategoryController(), 'index']);
$router->addAuthRoute('/\/category\/create/', [new CategoryController(), 'create']);
$router->addAuthRoute('/\/category\/update\/(\d+)/', [new CategoryController(), 'update']);
$router->addAuthRoute('/\/category\/delete\/(\d+)/', [new CategoryController(), 'delete']);

$router->addAuthRoute('/\/employee/', [new EmployeeController(), 'index']);
$router->addAuthRoute('/\/employee\/index/', [new EmployeeController(), 'index']);
$router->addAuthAdminRoute('/\/employee\/create/', [new EmployeeController(), 'create']);
$router->addAuthAdminRoute('/\/employee\/update\/(\d+)/', [new EmployeeController(), 'update']);
$router->addAuthAdminRoute('/\/employee\/delete\/(\d+)/', [new EmployeeController(), 'delete']);