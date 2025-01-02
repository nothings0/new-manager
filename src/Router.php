<?php
namespace App;

class Router {
    private $routes = [];

    public function addRoute($pattern, $callback, $middlewares = []) {
        $this->routes[$pattern] = [
            'callback' => $callback,
            'middlewares' => $middlewares
        ];
    }

    public function addAuthRoute($pattern, $callback) {
        // Sử dụng middleware kiểm tra đăng nhập
        $this->addRoute($pattern, $callback, ['auth']);
    }

    public function addAuthAdminRoute($pattern, $callback) {
        // Sử dụng middleware kiểm tra đăng nhập
        $this->addRoute($pattern, $callback, ['authAdmin']);
    }

    public function match($uri) {
        // Sắp xếp các routes theo độ dài (pattern dài hơn sẽ được kiểm tra trước)
        uksort($this->routes, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Loại bỏ phần tử đầu tiên (match đầy đủ)
                
                // Kiểm tra middleware
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareResult = $this->$middleware($matches);
                    if (!$middlewareResult) {
                        return; // Nếu middleware trả về false, dừng lại (có thể thực hiện chuyển hướng, thông báo lỗi, v.v.)
                    }
                }

                // Gọi callback sau khi middleware thành công
                call_user_func_array($route['callback'], $matches);
                return;
            }
        }
    }

    // Middleware kiểm tra đăng nhập
    private function auth($matches) {
        if (!isset($_SESSION['currentUser'])) {
            header('Location: /auth/login');
            exit();
        }
        // If the user is already logged in and tries to visit the auth/login page, redirect them elsewhere
        if ($_SERVER['REQUEST_URI'] == '/auth/login') {
            header('Location: /');  // Or wherever the user should go if they are logged in
            exit();
        }
        return true;
    }
    private function authAdmin($matches) {
        if (!isset($_SESSION['currentUser'])) {
            header('Location: /auth/login');
            exit();
        }
        // If the user is already logged in and tries to visit the auth/login page, redirect them elsewhere
        if ($_SERVER['REQUEST_URI'] == '/auth/login') {
            header('Location: /');  // Or wherever the user should go if they are logged in
            exit();
        }

        if($_SESSION['currentUser']['Role'] == 'Admin'){
            return true;
        }else{
            header('Location: /403');
            exit();
        }
    }
    
}
