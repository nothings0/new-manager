<?php

namespace App\Models;


class User
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

    public function getAllUsers()
    {
        $result = $this->mysqli->query("SELECT * FROM customers");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM customers WHERE CustomerID = $userId");

        return $result->fetch_assoc();
    }
    
    public function getUserByUsername($username)
    {
        $userId = $this->mysqli->real_escape_string($username);
        $result = $this->mysqli->query("SELECT * FROM customers WHERE username = '$username'");

        return $result->fetch_assoc();
    }

    public function createUser($customerName, $email, $address, $province, $isLocked)
    {
        
        $customerName = $this->mysqli->real_escape_string($customerName);
        $email = $this->mysqli->real_escape_string($email);
        $address = $this->mysqli->real_escape_string($address);
        $province = $this->mysqli->real_escape_string($province);
        $isLocked = $this->mysqli->real_escape_string($isLocked);

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("INSERT INTO customers (CustomerName, Email, Province, Address, Islocked) VALUES ('$customerName', '$email', '$province', '$address', '$isLocked')");
    }

    public function updateUser($userId, $customerName, $email, $address, $province, $isLocked)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $customerName = $this->mysqli->real_escape_string($customerName);
        $email = $this->mysqli->real_escape_string($email);
        $address = $this->mysqli->real_escape_string($address);
        $province = $this->mysqli->real_escape_string($province);
        $isLocked = $this->mysqli->real_escape_string($isLocked);

        return $this->mysqli->query("UPDATE customers SET CustomerName='$customerName', isLocked='$isLocked', Email='$email', address='$address', Province='$province' WHERE CustomerID=$userId");
    }

    public function deleteUser($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $this->mysqli->query("DELETE FROM customers WHERE CustomerID=$userId");
    }

    public function getProvinces()
    {
        return $this->mysqli->query("SELECT * FROM provinces");
    }

    public function getPaginated($page, $limit, $keyword)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->mysqli->prepare("SELECT * FROM customers WHERE CustomerName LIKE '%$keyword%' LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset); // Tránh SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) AS total FROM customers WHERE CustomerName LIKE '%$keyword%'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

}
