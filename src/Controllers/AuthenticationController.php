<?php
namespace App\Controllers;
require_once 'bootstrap.php';  // Khởi động session từ file bootstrap

use App\Models\Employee;
use App\Controller;

class AuthenticationController extends Controller {
    
    private $employeeModel;
    public function __construct(){
        $this->employeeModel = new Employee();
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new Employee())->getEmployeeByEmail($email);
            if ($password == $user['Password']) {
                // Employee authenticated, save user to session
                // session_start();
                $_SESSION['currentUser'] = $user;
    
                // Redirect to index.php
                $_SESSION['flash_message'] = "Login was successful";
                header("Location: /");
                exit();
            } else {
                // Authentication failed, redirect to signin.php
                $_SESSION['flash_message'] = "Đăng nhập thất bại";
                header("Location: /auth/login");
                exit();
            }
        }else{
            $pageTitle = 'Đăng nhập tài khoản';

            $this->render('employees\login', ['pageTitle' => $pageTitle]);
        }
    }
    public function accessdenined(){
        $pageTitle = 'Không có quyền truy cập';
        $this->render('layouts\403', ['pageTitle' => $pageTitle]);
    }

    public function logout(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // session_start();
            if(isset($_SESSION['currentUser'])){
                unset($_SESSION['currentUser']);
                session_destroy();
                header("Location: /");
                exit();
            }
        }
    }

    public function changePassword(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $oldPassword = $_POST['oldPassword'];
            $password = $_POST['password'];
            $rePassword = $_POST['rePassword'];

            if($password !== $rePassword || $password === "") {
                $_SESSION['error-password'] = "Nhập lại mật khẩu không đúng";
                header("Location: /change-password");
                exit();
            }

            if($oldPassword !== $_SESSION['currentUser']["Password"]) {
                $_SESSION['error-password'] = "Mật khẩu không đúng";
                header("Location: /change-password");
                exit();
            }

            $result = $this->employeeModel->changePassword($email, $oldPassword, $password);
            
            if ($result === false) {
                $_SESSION['error-password'] = "Mật khẩu không đúng";
                header("Location: /change-password");
                exit();
            }

            if(isset($_SESSION['currentUser'])){
                unset($_SESSION['currentUser']);
                session_destroy();
                header("Location: /");
                exit();
            }
        } else {
            $pageTitle = 'Đổi mật khẩu';
            $employee = $_SESSION['currentUser'];
            $this->render('employees\changePassword', [
                'employee' => $employee,
                'pageTitle' => $pageTitle
            ]);

        }
    }
}