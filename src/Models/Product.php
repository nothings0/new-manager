<?php

namespace App\Models;
//require_once(__DIR__ . '/../../config.php');

class Product
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

        // Check mysqli
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getProductById($productId)
    {
        $productId = $this->mysqli->real_escape_string($productId);
        $result = $this->mysqli->query("SELECT * FROM products WHERE ProductID = $productId");

        return $result->fetch_assoc();
    }

    public function createProduct($productName, $productDescription,$price,$photo,$isSelling,$categoryID)
    {
        $productName = $this->mysqli->real_escape_string($productName);
        $productDescription = $this->mysqli->real_escape_string($productDescription);
        $price = $this->mysqli->real_escape_string($price);
        $photo = $this->mysqli->real_escape_string($photo);
        $isSelling = $this->mysqli->real_escape_string($isSelling);
        $categoryID = $this->mysqli->real_escape_string($categoryID);

        return $this->mysqli->query("INSERT INTO products (ProductName, ProductDescription, Price, Photo, IsSelling, CategoryID) VALUES ('$productName', '$productDescription','$price','$photo','$isSelling','$categoryID')");
    }

    public function updateProduct($productId, $productName, $productDescription, $price, $photo,$isSelling, $categoryID)
    {
        $productId = $this->mysqli->real_escape_string($productId);
        $productName = $this->mysqli->real_escape_string($productName);
        $productDescription = $this->mysqli->real_escape_string($productDescription);
        $price = $this->mysqli->real_escape_string($price);
        $photo = $this->mysqli->real_escape_string($photo);
        $isSelling = $this->mysqli->real_escape_string($isSelling);
        $categoryID = $this->mysqli->real_escape_string($categoryID);
        

        return $this->mysqli->query("UPDATE products SET ProductName='$productName', ProductDescription='$productDescription', Price='$price', Photo='$photo', IsSelling='$isSelling', CategoryID='$categoryID' WHERE ProductID=$productId");
    }

    public function deleteProduct($productId)
    {
        $productId = $this->mysqli->real_escape_string($productId);
        $this->mysqli->query("DELETE FROM products WHERE ProductID=$productId");
    }
    public function getPaginated($page, $limit, $keyword)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->mysqli->prepare("SELECT * FROM products WHERE ProductName LIKE '%$keyword%' LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset); // Tránh SQL Injection
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword)
    {
        $stmt = $this->mysqli->prepare("SELECT COUNT(*) AS total FROM products WHERE ProductName LIKE '%$keyword%'");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
}
