<?php

namespace App\Models;


class Category
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

    public function getAllCategories()
    {
        $result = $this->mysqli->query("SELECT * FROM categories");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($categoryId)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $result = $this->mysqli->query("SELECT * FROM categories WHERE CategoryID = $categoryId");

        return $result->fetch_assoc();
    }

    public function createCategory($customerName, $description)
    {
        $customerName = $this->mysqli->real_escape_string($customerName);
        $description = $this->mysqli->real_escape_string($description);

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("INSERT INTO categories (CategoryName, Description) VALUES ('$customerName', '$description')");
    }

    public function updateCategory($categoryId, $customerName, $description)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $customerName = $this->mysqli->real_escape_string($customerName);
        $description = $this->mysqli->real_escape_string($description);

        $query = "UPDATE categories SET CategoryName='$customerName', Description='$description' WHERE CategoryID=$categoryId";

        if ($this->mysqli->query($query)) {
            return true; // Thành công
        } else {
            return $this->mysqli->error; // Trả về lỗi
        }
    }


    public function deleteCategory($categoryId)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);

        if ($this->InUsed($categoryId) === 1) {
            return false; // Không thể xóa vì đang được sử dụng
        }

        $query = "DELETE FROM categories WHERE CategoryID = $categoryId";
        if ($this->mysqli->query($query)) {
            return true; // Xóa thành công
        } else {
            return false; // Lỗi khi xóa
        }
    }


    public function getPaginated($page, $limit, $keyword)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->mysqli->prepare("SELECT * FROM categories WHERE CategoryName LIKE '%$keyword%' LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset); // Tránh SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) AS total FROM categories WHERE CategoryName LIKE '%$keyword%'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function InUsed($categoryId)
    {
        $categoryId = $this->mysqli->real_escape_string($categoryId);
        $query = "SELECT COUNT(*) AS count FROM Products WHERE CategoryID = $categoryId";

        $result = $this->mysqli->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0 ? 1 : 0;
        }

        return 0; // Lỗi truy vấn
    }

}
