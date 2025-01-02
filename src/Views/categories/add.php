<?php ob_start(); ?>    
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="">Tên loại hàng</label>
            <input type="text" name="categoryName" class="form-control" placeholder="Tên..." autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Mô tả</label>
            <input type="text" name="description" class="form-control" placeholder="Mô tả...">
        </div>
        <p class="error"><?= $error ?? '' ?></p>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/category">Quay lại</a>
            <button class="btn btn-primary">Thêm</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>