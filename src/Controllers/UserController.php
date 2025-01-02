<?php

namespace App\Controllers;

use App\Models\User;
use App\Controller;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(){
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5; // Số bản ghi mỗi trang
        $keyword = $_GET['keyword'] ?? "";
        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $customers = $this->userModel->getPaginated($page, $limit, $keyword);
        $total = $this->userModel->getTotal($keyword);
        $pageTitle = 'Quản lý khách hàng';
        // Tính toán số trang
        $totalPages = ceil($total / $limit);

        // Gửi dữ liệu tới view
        $this->render('users/index', [
            'customers' => $customers,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'pageTitle' => $pageTitle
        ]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $pageTitle = 'Thêm mới khách hàng';
            $provinces = $this->userModel->getProvinces();
            $this->render('users\add', [
                'user' => [],
                'provinces' => $provinces,
                'pageTitle' => $pageTitle
            ]);
        }
    }

    private function processForm(){
        // Retrieve form data
        $customerName = $_POST['customerName'];
        $isLocked = $_POST['isLocked'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $province = $_POST['province'];

        if(!$customerName || !$isLocked || !$email || !$address || !$province) {
            $error = 'Vui lòng điền đầy đủ thông tin';
            $pageTitle = 'Thêm mới khách hàng';
            return $this->render('users\add', [
                'user' => [],
                'error' => $error,
                'pageTitle' => $pageTitle
            ]);
        }

        // Call the model to create a new user
        $user = $this->userModel->createUser($customerName, $email, $address, $province, $isLocked);

        if ($user) {
            // Redirect to the user list page or show a success message
            header('Location: /user/index');
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User creation failed.';
        }
    }
       

    public function update($userId)
    {
        if (empty($_SESSION['currentUser'])) return header("Location: /auth/login");
        // Handle form submission to update a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($userId);            
        } else {
            $pageTitle = 'Cập nhật khách hàng';
            // Fetch the user data and display the form to update
            $customer = $this->userModel->getUserById($userId);       
            $provinces = $this->userModel->getProvinces();
            $this->render('users\edit', [
                'customer' => $customer,
                'provinces' => $provinces,
                'pageTitle' => $pageTitle
            ]);
        }
    }
    
    private function processFormUpdate($userId){
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        // Retrieve form data
        $customerName = $_POST['customerName'];
        $isLocked = $_POST['isLocked'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $province = $_POST['province'];
       
        
        // Call the model to update the user
        $user = $this->userModel->updateUser($userId, $customerName, $email, $address, $province, $isLocked);

        if ($user) {
            // Redirect to the user list page or show a success message
            header('Location: /user/index');
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User update failed.';
        }
    }

    public function delete($userId)
    {
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->deleteUser($userId);
            header('Location: /index.php');    
        } else {
            $pageTitle = 'Xóa khách hàng';
            // Fetch the user data and display the form to update
            $customer = $this->userModel->getUserById($userId);       
            
            $this->render('users\delete', ['customer' => $customer,'pageTitle' => $pageTitle]);
        }
    }
}
