<?php
class AuthMiddleware {
    public function handle($request, $next) {
      if (!isset($_SESSION['currentUser'])) {
          header('Location: /login');
          exit();
      }
      return $next($request);
    }
}
