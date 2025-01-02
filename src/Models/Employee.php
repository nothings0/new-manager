<?php

namespace App\Models;


class Employee
{
    private $mysqli;

    public function __construct()
    {
        // Replace these values with your actual database configuration
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->mysqli = new \mysqli($host, $username, $password, $database);

        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getAllEmployees()
    {
        $result = $this->mysqli->query("SELECT * FROM employees");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmployeeById($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM employees WHERE EmployeeID = $userId");

        return $result->fetch_assoc();
    }
    

    public function createEmployee($employeeName, $email, $address, $province, $isWorking)
    {
        
        $employeeName = $this->mysqli->real_escape_string($employeeName);
        $email = $this->mysqli->real_escape_string($email);
        $address = $this->mysqli->real_escape_string($address);
        $province = $this->mysqli->real_escape_string($province);
        $isWorking = $this->mysqli->real_escape_string($isWorking);

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("INSERT INTO employees (EmployeeName, Email, Province, Address, isWorking) VALUES ('$employeeName', '$email', '$province', '$address', '$isWorking')");
    }

    public function updateEmployee($userId, $employeeName, $email, $address, $province, $isWorking)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $employeeName = $this->mysqli->real_escape_string($employeeName);
        $email = $this->mysqli->real_escape_string($email);
        $address = $this->mysqli->real_escape_string($address);
        $province = $this->mysqli->real_escape_string($province);
        $isWorking = $this->mysqli->real_escape_string($isWorking);

        return $this->mysqli->query("UPDATE employees SET EmployeeName='$employeeName', isWorking='$isWorking', Email='$email', Address='$address', Province='$province' WHERE EmployeeID=$userId");
    }

    public function deleteEmployee($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $this->mysqli->query("DELETE FROM employees WHERE EmployeeID=$userId");
    }

    public function getEmployeeByEmail($email)
    {
        $userId = $this->mysqli->real_escape_string($email);
        $result = $this->mysqli->query("SELECT * FROM employees WHERE email = '$email'");

        return $result->fetch_assoc();
    }

    public function getPaginated($page, $limit, $keyword)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->mysqli->prepare("SELECT * FROM employees WHERE EmployeeName LIKE '%$keyword%' LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset); // Tránh SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) AS total FROM employees WHERE EmployeeName LIKE '%$keyword%'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function changePassword($email, $oldPassword, $password)
    {
        $email = $this->mysqli->real_escape_string($email);
        $oldPassword = $this->mysqli->real_escape_string($oldPassword);
        $password = $this->mysqli->real_escape_string($password);

        $result = $this->mysqli->query("
                        UPDATE Employees 
                        SET `Password` = '$password' 
                        WHERE Email = '$email' AND `Password` = '$oldPassword'
                    ");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
