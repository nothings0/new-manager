<?php

namespace App\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Controller;

class EmployeeController extends Controller
{
    private $employeeModel;
    private $userModel;

    public function __construct()
    {
        $this->employeeModel = new Employee();
        $this->userModel = new User();
    }

    public function index(){
        // if (empty($_SESSION['currentEmployee'])) return header("Location: ../employee/signin");
        // $employees = $this->employeeModel->getAllEmployees();
        // $this->render('employees\index', ['employees' => $employees]);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5; // Số bản ghi mỗi trang
        $keyword = $_GET['keyword'] ?? "";
        $pageTitle = 'Quản lý nhân viên';
        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $employees = $this->employeeModel->getPaginated($page, $limit, $keyword);
        $total = $this->employeeModel->getTotal($keyword);

        // Tính toán số trang
        $totalPages = ceil($total / $limit);

        // Gửi dữ liệu tới view
        $this->render('employees/index', [
            'employees' => $employees,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'pageTitle' => $pageTitle
        ]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentEmployee'])) return header("Location: ../employee/signin");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $pageTitle = 'Thêm mới nhân viên';
            $provinces = $this->userModel->getProvinces();
            // Display the form for creating a new employee            
            $this->render('employees\add', [
                'employee' => [],
                'provinces' => $provinces,
                'pageTitle' => $pageTitle
            ]);
        }
        
    }

    private function processForm(){
            // Retrieve form data
            $employeeName = $_POST['employeeName'];
            $isWoking = $_POST['isWoking'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $province = $_POST['province'];

            if(!$email || !$isWoking || !$employeeName || !$address || !$province) {
                $error = 'Vui lòng điền đầy đủ thông tin';
                $pageTitle = 'Thêm mới nhân viên';
                return $this->render('employees\add', [
                    'employee' => [],
                    'error' => $error,
                    'pageTitle' => $pageTitle
                ]);
            }

            // Call the model to create a new employee
            $employee = $this->employeeModel->createEmployee($employeeName, $email, $address, $province, $isWoking);

            if ($employee) {
                // Redirect to the employee list page or show a success message
                header('Location: /employee/index');
                exit();
            } else {
                // Handle the case where the employee creation failed
                echo 'Employee creation failed.';
            }
    }
       

    public function update($employeeId)
    {
        // if (empty($_SESSION['currentEmployee'])) return header("Location: ../employee/signin");
        // Handle form submission to update a employee
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($employeeId);            
        } else {
            $pageTitle = 'Cập nhật nhân viên';
            // Fetch the employee data and display the form to update
            $employee = $this->employeeModel->getEmployeeById($employeeId);       
            $provinces = $this->userModel->getProvinces();
            $this->render('employees\edit', [
                'employee' => $employee,
                'provinces' => $provinces,
                'pageTitle' => $pageTitle
            ]);

        }
    }
    
    private function processFormUpdate($employeeId){
        // if (empty($_SESSION['currentEmployee'])) return header("Location: ../employee/signin");
        // Retrieve form data
        $employeeName = $_POST['employeeName'];
        $isWoking = $_POST['isWoking'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $province = $_POST['province'];
       
        
        // Call the model to update the employee
        $employee = $this->employeeModel->updateEmployee($employeeId, $employeeName, $email, $address, $province, $isWoking);

        if ($employee) {
            // Redirect to the employee list page or show a success message
            header('Location: /employee');
            exit();
        } else {
            // Handle the case where the employee creation failed
            echo 'Employee update failed.';
        }
    }

    public function delete($employeeId)
    {
        // if (empty($_SESSION['currentEmployee'])) return header("Location: ../employee/signin");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->employeeModel->deleteEmployee($employeeId);
            header('Location: /employee');    
        } else {
            $pageTitle = 'Xóa nhân viên';
            // Fetch the employee data and display the form to update
            $employee = $this->employeeModel->getEmployeeById($employeeId);       
            
            $this->render('employees\delete', ['employee' => $employee, 'pageTitle' => $pageTitle]);

        }
    }
}
