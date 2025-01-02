-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 10:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Description`, `created_at`) VALUES
(1, 'Điện tử', 'Danh mục các sản phẩm điện tử như điện thoại, máy tính, thiết bị gia dụng, máy móc', '2024-12-30 03:04:00'),
(2, 'Quần áo', 'Danh mục các sản phẩm quần áo, giày dép, phụ kiện thời trang.', '2024-12-30 03:04:00'),
(3, 'Sách', 'Danh mục các loại sách, giáo trình, tài liệu học tập.', '2024-12-30 03:04:00'),
(9, 'Thời trang nam nữ', 'Danh mục các sản phẩm thời trang nam, nữ và trẻ em', '2025-01-02 04:11:32'),
(10, 'Đồ gia dụng', 'Danh mục các sản phẩm sử dụng trong gia đình như nồi cơm, máy hút bụi, quạt điện', '2025-01-02 04:11:32'),
(11, 'Sách và Văn phòng phẩm', 'Danh mục các loại sách, truyện, văn phòng phẩm', '2025-01-02 04:11:32'),
(12, 'Đồ chơi và Đồ trẻ em', 'Danh mục đồ chơi trẻ em và các sản phẩm dành cho trẻ sơ sinh', '2025-01-02 04:11:32'),
(13, 'Thực phẩm và Đồ uống', 'Danh mục thực phẩm tươi sống, đóng gói và các loại đồ uống', '2025-01-02 04:11:32'),
(14, 'Sức khỏe và Làm đẹp', 'Danh mục các sản phẩm chăm sóc sức khỏe và làm đẹp', '2025-01-02 04:11:32'),
(15, 'Thể thao và Dã ngoại', 'Danh mục các sản phẩm phục vụ thể thao và hoạt động dã ngoại', '2025-01-02 04:11:32'),
(16, 'Ô tô và Xe máy', 'Danh mục các sản phẩm liên quan đến ô tô, xe máy và phụ kiện', '2025-01-02 04:11:32'),
(17, 'Vật nuôi và Cây cảnh', 'Danh mục các sản phẩm chăm sóc thú cưng và cây cảnh', '2025-01-02 04:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Province` varchar(150) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `IsLocked` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CustomerName`, `Username`, `Email`, `Province`, `Address`, `Password`, `IsLocked`, `created_at`) VALUES
(1, 'Nguyen Van Anh', 'Nguyen Van Anh', 'nguyenvananh@example.com', 'Tuyên Quang', '123 Hoang Hoa Tham', 'password123', 0, '2024-12-30 02:41:47'),
(2, 'Tran Thi B', 'tranthib', 'tranthib@example.com', 'Vĩnh Long', '456 Le Loi', 'pass456', 1, '2024-12-30 02:41:47'),
(3, 'Le Van C', 'levanc', 'levanc@example.com', 'Đà Nẵng', '789 Nguyen Van Linh', 'secure789', 1, '2024-12-30 02:41:47'),
(4, 'Pham Thi D', 'phamthid', 'phamthid@example.com', 'Hai Phong', '101 Tran Hung Dao', 'admin2023', 1, '2024-12-30 02:41:47'),
(5, 'Do Van E', 'dovane', 'dovane@example.com', 'Bình Thuận', '202 Le Duan', 'qwertyui', 1, '2024-12-30 02:41:47'),
(7, 'Phạm Văn Nhân', '', 'nhanphamx3@gmail.com', 'Hà Nội', '215 Tran Phu, P Truong An, Tp Hue', '1', 1, '2024-12-31 16:52:35'),
(8, 'Nguyen Van An', 'nguyenan', 'nguyenan@example.com', 'Hanoi', '101 Hoang Dieu', '123456', 1, '2025-01-02 04:01:57'),
(9, 'Tran Thi Bich', 'tranbich', 'tranbich@example.com', 'HCM', '56 Tran Hung Dao', '123456', 1, '2025-01-02 04:01:57'),
(10, 'Pham Van Canh', 'phamcanh', 'phamcanh@example.com', 'Da Nang', '78 Nguyen Van Cu', '123456', 1, '2025-01-02 04:01:57'),
(11, 'Hoang Thi Diep', 'hoangdiep', 'hoangdiep@example.com', 'Hai Phong', '123 Nguyen Trai', '123456', 1, '2025-01-02 04:01:57'),
(12, 'Le Van Dung', 'ledung', 'ledung@example.com', 'Hue', '45 Le Loi', '123456', 1, '2025-01-02 04:01:57'),
(13, 'Nguyen Thi Ha', 'nguyenha', 'nguyenha@example.com', 'Vinh', '67 Phan Chu Trinh', '123456', 1, '2025-01-02 04:01:57'),
(14, 'Tran Van Hieu', 'tranhieu', 'tranhieu@example.com', 'Quang Ninh', '90 Hang Bong', '123456', 1, '2025-01-02 04:01:57'),
(15, 'Do Thi Khanh', 'dokhanh', 'dokhanh@example.com', 'Thanh Hoa', '34 Bach Dang', '123456', 1, '2025-01-02 04:01:57'),
(16, 'Vu Van Lam', 'vulam', 'vulam@example.com', 'Bac Ninh', '77 Le Thanh Ton', '123456', 1, '2025-01-02 04:01:57'),
(17, 'Bui Thi Mai', 'buimai', 'buimai@example.com', 'Hai Duong', '89 Tran Phu', '1234560', 1, '2025-01-02 04:01:57'),
(18, 'Hoang Van Nam', 'hoangnam', 'hoangnam@example.com', 'Can Tho', '101 Dien Bien Phu', '1234561', 1, '2025-01-02 04:01:57'),
(19, 'Pham Thi Oanh', 'phamoanh', 'phamoanh@example.com', 'Quang Nam', '56 Nguyen Thi Minh Khai', '1234562', 1, '2025-01-02 04:01:57'),
(20, 'Nguyen Van Phuc', 'nguyenphuc', 'nguyenphuc@example.com', 'Hanoi', '202 Hoang Hoa Tham', '1234563', 1, '2025-01-02 04:01:57'),
(21, 'Le Thi Quyen', 'lequyen', 'lequyen@example.com', 'HCM', '78 Phan Dinh Phung', '1234564', 1, '2025-01-02 04:01:57'),
(22, 'Tran Van Sang', 'transang', 'transang@example.com', 'Da Nang', '45 Dong Da', '1234565', 1, '2025-01-02 04:01:57'),
(23, 'Vu Thi Thao', 'vuthao', 'vuthao@example.com', 'Hai Phong', '90 Tran Quoc Toan', '1234566', 1, '2025-01-02 04:01:57'),
(24, 'Pham Van Tien', 'phamtien', 'phamtien@example.com', 'Hue', '12 Ngo Quyen', '1234567', 1, '2025-01-02 04:01:57'),
(25, 'Nguyen Thi Uyen', 'nguyenuyen', 'nguyenuyen@example.com', 'Vinh', '67 Phan Dinh Phung', '1234568', 1, '2025-01-02 04:01:57'),
(26, 'Le Van Vu', 'levanvu', 'levanvu@example.com', 'Cà Mau', '56 Hang Bac', '1234569', 1, '2025-01-02 04:01:57'),
(27, 'Tran Thi Xuan', 'tranxuan', 'tranxuan@example.com', 'Thanh Hoa', '89 Nguyen Du', '1234560', 1, '2025-01-02 04:01:57'),
(28, 'Phạm Văn Nhân', '', 'nhanphamx3@gmail.com', 'Cà Mau', '215 Tran Phu, P Truong An, Tp Hue', NULL, 1, '2025-01-02 08:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Province` varchar(150) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Role` varchar(150) DEFAULT NULL,
  `IsWorking` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `EmployeeName`, `Email`, `Province`, `Address`, `Password`, `Role`, `IsWorking`, `created_at`) VALUES
(1, 'Nguyễn Văn Tý', 'admin@gmail.com', 'Hà Nội', 'Số 10, Phố Láng Hạ', '123', 'Admin', 1, '2024-12-30 03:00:58'),
(4, 'Phạm Thanh D', 'nhanvien@gmail.com', 'Hải Phòng', 'Số 40, Đường Lạch Tray', '123456', 'Employee', 1, '2024-12-30 03:00:58'),
(5, 'Hoàng Thị E', 'hoangthie@example.com', 'Cần Thơ', 'Số 50, Đường Lê Lợi', 'password202', 'Employee', 0, '2024-12-30 03:00:58'),
(8, 'Nguyễn Văn B', 'nguyenvanb@example.com', 'Hồ Chí Minh', 'Số 20, Đường Nguyễn Huệ', '123456', 'Employee', 1, '2025-01-02 04:13:16'),
(9, 'Trần Thị C', 'tranthic@example.com', 'Đà Nẵng', 'Số 15, Đường Hùng Vương', 'abcdef', 'Employee', 1, '2025-01-02 04:13:16'),
(10, 'Lê Văn D', 'levand@example.com', 'Hải Phòng', 'Số 8, Đường Trần Phú', 'qwerty', 'Employee', 1, '2025-01-02 04:13:16'),
(11, 'Phạm Thị E', 'phamthie@example.com', 'Cần Thơ', 'Số 18, Đường 30/4', 'password', 'Employee', 1, '2025-01-02 04:13:16'),
(12, 'Hoàng Văn F', 'hoangvanf@example.com', 'Vĩnh Long', 'Số 25, Đường Phạm Ngọc Thạch', '123qwe', 'Employee', 1, '2025-01-02 04:13:16'),
(13, 'Đỗ Thị G', 'dothig@example.com', 'Huế', 'Số 12, Đường Lê Lợi', 'zxcvbn', 'Employee', 1, '2025-01-02 04:13:16'),
(14, 'Ngô Văn H', 'ngovanh@example.com', 'Quảng Ninh', 'Số 9, Đường Bãi Cháy', 'asdfgh', 'Employee', 1, '2025-01-02 04:13:16'),
(15, 'Bùi Thị I', 'buithii@example.com', 'Nha Trang', 'Số 14, Đường Trần Phú', '123abc', 'Employee', 1, '2025-01-02 04:13:16'),
(16, 'Phan Văn J', 'phanvanj@example.com', 'Bình Dương', 'Số 5, Đường Nguyễn Văn Tiết', '987654', 'Employee', 1, '2025-01-02 04:13:16'),
(17, 'Dương Thị K', 'duongthik@example.com', 'Thanh Hóa', 'Số 30, Đường Lam Sơn', 'abcdefg', 'Employee', 1, '2025-01-02 04:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `ProductDescription` varchar(250) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Photo` varchar(100) NOT NULL,
  `IsSelling` tinyint(1) DEFAULT 0,
  `CategoryID` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `ProductDescription`, `Price`, `Photo`, `IsSelling`, `CategoryID`, `created_at`) VALUES
(2, 'iPhone 15 Pro Max', 'Điện thoại thông minh cao cấp của Apple', '33000000.00', '', 1, 1, '2024-12-30 03:05:55'),
(3, 'Sony WH-1000XM5', 'Tai nghe chống ồn đỉnh cao', '6990000.00', '', 1, 1, '2024-12-30 03:05:55'),
(4, 'Samsung Galaxy Watch 6', 'Đồng hồ thông minh cao cấp của Samsung', '28000000.00', '', 1, 1, '2024-12-30 03:05:55'),
(5, 'Canon EOS R5', 'Máy ảnh không gương lật chuyên nghiệp', '95000.00', 'R.jpg', 1, 1, '2024-12-30 03:05:55'),
(6, 'Laptop Dell XPS 13 NEW', 'Laptop Dell XPS 13', '2999999.00', '', 1, 1, '2024-12-30 09:35:15'),
(7, 'Laptop Dell XPS 13 NEW', 'Laptop Dell XPS 13', '3434343.00', 'ao.jpg', 1, 1, '2024-12-30 09:39:15'),
(8, 'Quần áo phao', 'Quần áo phao', '290000.00', 'ao.jfif', 0, 2, '2024-12-30 09:55:21'),
(9, 'Laptop Dell XPS 13 NEW', 'Laptop Dell XPS 13', '9000000.00', 'xe-2.jfif', 1, 1, '2025-01-01 16:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `ProvinceName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`ProvinceName`) VALUES
('An Giang'),
('Bà Rịa - Vũng Tàu'),
('Bắc Giang'),
('Bắc Kạn'),
('Bạc Liêu'),
('Bắc Ninh'),
('Bến Tre'),
('Bình Định'),
('Bình Dương'),
('Bình Phước'),
('Bình Thuận'),
('Cà Mau'),
('Cần Thơ'),
('Cao Bằng'),
('Đà Nẵng'),
('Đắk Lắk'),
('Đắk Nông'),
('Điện Biên'),
('Đồng Nai'),
('Đồng Tháp'),
('Gia Lai'),
('Hà Giang'),
('Hà Nam'),
('Hà Nội'),
('Hà Tĩnh'),
('Hải Dương'),
('Hải Phòng'),
('Hậu Giang'),
('Hòa Bình'),
('Hưng Yên'),
('Khánh Hòa'),
('Kiên Giang'),
('Kon Tum'),
('Lai Châu'),
('Lâm Đồng'),
('Lạng Sơn'),
('Lào Cai'),
('Long An'),
('Nam Định'),
('Nghệ An'),
('Ninh Bình'),
('Ninh Thuận'),
('Phú Thọ'),
('Phú Yên'),
('Quảng Bình'),
('Quảng Nam'),
('Quảng Ngãi'),
('Quảng Ninh'),
('Quảng Trị'),
('Sóc Trăng'),
('Sơn La'),
('Tây Ninh'),
('Thái Bình'),
('Thái Nguyên'),
('Thanh Hóa'),
('Thành phố Hồ Chí Minh'),
('Thừa Thiên Huế'),
('Tiền Giang'),
('Trà Vinh'),
('Tuyên Quang'),
('Vĩnh Long'),
('Vĩnh Phúc'),
('Yên Bái');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `fk_category` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
