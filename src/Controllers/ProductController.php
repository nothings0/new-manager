<?php
namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Controller;
require_once 'bootstrap.php';  // Khởi động session từ file bootstrap

class ProductController extends Controller
{
    private $productModel;
    private $categoryModel;
    
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $keyword = $_GET['keyword'] ?? "";
        $limit = 5; // Số bản ghi mỗi trang

        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $products = $this->productModel->getPaginated($page, $limit, $keyword);
        $total = $this->productModel->getTotal($keyword);

        // Tính toán số trang
        $totalPages = ceil($total / $limit);
        $pageTitle = 'Quản lý sản phẩm';
        $this->render('products\index', ['products' => $products, 'pageTitle' => $pageTitle,
        'totalPages' => $totalPages,
        'currentPage' => $page]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentUser'])) {
        //     header("Location: ../category/signin");
        //     exit();
        // }
        $pageTitle = 'Thêm sản phẩm';
        // Handle form submission to create a new product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];
            $isSelling = $_POST['isSelling'];
            $categoryID = $_POST['categoryID'];

            if(!$productName || !$productDescription || !$price || !$isSelling || !$categoryID) {
                $error = 'Vui lòng điền đầy đủ thông tin';
                $pageTitle = 'Thêm mới mặt hàng';
                return $this->render('products\add', [
                    'product' => [],
                    'error' => $error,
                    'pageTitle' => $pageTitle
                ]);
            }
            // Handle file upload
            $photo = '';
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/';
                $tmpName = $_FILES['photo']['tmp_name'];
                $fileName = basename($_FILES['photo']['name']);
                $filePath = $uploadDir . $fileName;

                // Move the uploaded file to the images folder
                if (move_uploaded_file($tmpName, $filePath)) {
                    $photo = $fileName;  // Save the file name to store in the database
                } else {
                    echo 'Failed to upload image.';
                    exit();
                }
            }

            // Call the model to create a new product
            $product = $this->productModel->createProduct($productName, $productDescription, $price, $photo, $isSelling, $categoryID);

            if ($product) {
                header('Location: /product');
                exit();
            } else {
                echo 'Product creation failed.';
            }
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $this->render('products\add', [
                'product' => [],
                'categories' => $categories,
                'pageTitle' => $pageTitle
            ]);
        }
    }

    public function update($productId)
    {
        $pageTitle = 'Chỉnh sửa sản phẩm';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];
            $isSelling = $_POST['isSelling'];
            $categoryID = $_POST['categoryID'];

            // Lấy thông tin sản phẩm hiện tại từ DB
            $product = $this->productModel->getProductById($productId);

            $photo = $product['Photo']; // Lấy ảnh cũ từ DB
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/';
                $tmpName = $_FILES['photo']['tmp_name'];
                $fileName = basename($_FILES['photo']['name']);
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $filePath)) {
                    $photo = $fileName; // Cập nhật ảnh mới nếu upload thành công
                } else {
                    echo 'Failed to upload image.';
                    exit();
                }
            }

            // Cập nhật sản phẩm
            $productUpdated = $this->productModel->updateProduct($productId, $productName, $productDescription, $price, $photo, $isSelling, $categoryID);

            if ($productUpdated) {
                header('Location: /product');
                exit();
            } else {
                echo 'Product update failed.';
            }
        } else {
            $product = $this->productModel->getProductById($productId);
            $categories = $this->categoryModel->getAllCategories();

            $this->render('products\edit', [
                'product' => $product,
                'categories' => $categories,
                'pageTitle' => $pageTitle
            ]);
        }
    }


    public function delete($productId)
    {
        // if (empty($_SESSION['currentUser'])) {
        //     header("Location: ../product/signin");
        //     exit();
        // }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->deleteProduct($productId);
            header('Location: /product');    
        } else {
            $pageTitle = "Xóa mặt hàng";
            $product = $this->productModel->getProductById($productId);
            $categories = $this->categoryModel->getAllCategories();
            $this->render('products\delete', [
                'product' => $product,
                'categories' => $categories,
                'pageTitle' => $pageTitle
            ]);
        }
    }
}