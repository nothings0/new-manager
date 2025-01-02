<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $pageTitle ?> - XManager</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <style>
      :root {
        --header: 70px;
        --footer: 56px;
      }
      main {
        display: flex;
        flex-wrap: nowrap;
        min-height: 100vh;
        overflow-x: auto;
        overflow-y: hidden;
      }
      a:hover {
        color: #fff;
      }
      .navbar {
        display: flex;
        justify-content: flex-end;
        background: #d7dfe7;
        padding: 1rem;
      }
      .wrap{
        min-height: calc(100vh - var(--header));
        padding: 1rem;
      }
      footer {
        display: flex;
        justify-content: center;
        background: #d7dfe7;
        padding: 1rem;
      }
      .btn-default{
        background: #efefef;
      }
      .input-format{
        text-align: left !important;
      }
      .login_form{
        width: 400px;
        height: 320px;
        background: #efefef;
        padding: 10px;
      }
      .changepassword_form{
        width: 400px;
        height: 450px;
        background: #efefef;
        padding: 10px;
      }
      .error{
        color: red;
      }
      .link-white{
        color: #fff
      }
    </style>
  </head>

  <body>
    <main>
    <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 150px; background: #2c3b41">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-white text-decoration-none">
        <span class="fs-4 fw-bold">XManager</span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
        <a href="/" class="nav-link <?= (preg_match('/^\/($|user|\\?)/', $_SERVER['REQUEST_URI'])) ? 'active' : 'link-white'; ?>">
                Khách hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/product" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/product') === 0) ? 'active' : 'link-white'; ?>">
                Mặt hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/category" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/category') === 0) ? 'active' : 'link-white'; ?>">
                Loại hàng
            </a>
        </li>
        <li class="nav-item">
        <a href="/employee" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/employee') === 0) ? 'active' : 'link-white'; ?>">
                Nhân viên
            </a>
        </li>
    </ul>
</div>

      <div style="width: 100%">
          <nav class="navbar">
            <?php if (isset($_SESSION['currentUser'])): ?>
            <!-- Nếu có currentUser, hiển thị icon user -->
            <div class="dropdown">
              <a
                href="#"
                class="d-flex align-items-center text-decoration-none dropdown-toggle"
                id="userDropdown"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  src="/public/images/user.png"
                  alt="User Icon"
                  style="width: 30px; height: 30px; border-radius: 50%"
                />
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="userDropdown"
              >
                <li class="dropdown-item"><?= $_SESSION['currentUser']['EmployeeName'] ?></li>
                <li><a class="dropdown-item" href="/change-password">Đổi mật khẩu</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <form
                    action="/auth/logout"
                    method="post"
                    style="display: inline"
                  >
                    <button type="submit" class="dropdown-item btn btn-danger">
                      Đăng xuất
                    </button>
                  </form>
                </li>
              </ul>
            </div>

            <?php else: ?>
            <!-- Nếu không có currentUser, hiển thị nút đăng nhập -->
            <a class="btn btn-primary" href="/auth/login">Đăng nhập</a>
            <?php endif; ?>
          </nav>
          <div class="wrap">

          <?= $content ?>
          
        </div>
        <footer>
          <strong>Copyright &copy; 2024 <a href="#">Group2</a>
          </strong>
        </footer>
      </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.input-format').inputmask({
                alias: "numeric",
                groupSeparator: ",",       // Dấu phẩy phân cách phần nghìn
                autoGroup: true,           // Tự động thêm dấu phân cách
                digits: 0,                 // Không có chữ số thập phân
                removeMaskOnSubmit: true   // Loại bỏ ký tự phân cách phần nghìn khi submit form
            });
        })
    </script>
    </script>
  </body>
</html>
