# CLone code

### git clone https://github.com/nothings0/manager.git

### Vào xampp tạo database "shop"

### import file shop.sql

# Terminal

### composer dump-autoload

### php -S localhost:8000

# Phân việc

## Nhân: Module User

## Thái: Module Product

## Ngọc: Module Category

## Trang: Module Employee

⛔ Chỉ sửa file có liên quan
1 Module(file /Controller/...Controller.php, /Views/...php, /Models/...php)

# Thuyết trình

### Xác thực

Nhân viên chưa login sẽ không vào được hệ thống.

Case: - Đăng nhập sai thông báo lỗi ra màn login - Đăng nhập đúng thì trở về trang quản lý khách hàng

### Phân quyền

Case: - Nhân viên (role Employee) chỉ xem được trang quản lý nhân viên (không thêm sửa xóa nhân viên được) - Nhân viên (role Admin) thực hiện đầy đủ các chức năng

### Quản lý

Case: - Phân trang - Tìm kiếm

      (2 trường hợp: 1 case không nhập đầy đủ thông tin thì thông báo lỗi, case còn nhập đầy đủ hợp lệ thì quay về trang quản lý)
      - Thêm mới
      - Cập nhật
      - Xóa

### Đổi mật khẩu

Case: - Nhập thiếu | không đúng => Log lỗi màn changepassword - Nhập đúng đầy đủ => Logout()
