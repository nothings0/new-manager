<?php ob_start(); ?>    
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST">
    <div class="mb-3">
            <label class="form-label" for="">Họ Tên</label>
            <input type="text" name="employeeName" class="form-control" placeholder="Tên..." autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email...">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Tỉnh/Thành</label>
            <select name="province" class="form-select" aria-label="-- Chọn tỉnh/thành --">
                <option value="">-- Chọn tỉnh/thành --</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= htmlspecialchars($province['ProvinceName']) ?>">
                        <?= htmlspecialchars($province['ProvinceName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Địa chỉ</label>
            <input type="text" name="address" class="form-control" placeholder="Địa chỉ...">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select name="isWorking" class="form-select">
            <option value="0">Đang làm việc</option>
            <option value="1">Đã nghỉ việc</option>
            </select>
        </div>
        <p class="error"><?= $error ?? '' ?></p>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/employee">Quay lại</a>
            <button class="btn btn-primary">Thêm mới</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>