<?php ob_start(); ?>
<div class="container d-flex align-item-center justify-content-center" style="min-height: calc(100vh - var(--header))">
    <form class="my-4 changepassword_form" method="post">
      <!-- Email input -->
      <input type="hidden" id="form2Example1" class="form-control" name="email" value="<?= $employee["Email"] ?>"/>
       <h1 class="text-center mb-4">Đổi mật khẩu</h1>
      <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form2Example1">Mật khẩu cũ</label>
        <input type="password" id="form2Example1" class="form-control" name="oldPassword" autofocus/>
      </div>
    
      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Mật khẩu mới</label>
        <input type="password" id="form2Example2" class="form-control" name="password"/>
      </div>

      <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form2Example2">Nhập lại mật khẩu</label>
        <input type="password" id="form2Example2" class="form-control" name="rePassword"/>
      </div>
      <p class="error"><?= $_SESSION['error-password'] ?? '' ?></p>
      <!-- Submit button -->
       <div class="text-center">
           <button type="submit" class="btn btn-primary mb-4">Đổi mật khẩu</button>
       </div>
    </form>
</div> 
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>