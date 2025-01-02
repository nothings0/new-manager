<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="">Họ Tên</label>
            <input type="text" name="customerName" class="form-control" placeholder="Tên..." value="<?= $customer["CustomerName"]; ?>" autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email..." value="<?= $customer["Email"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Tỉnh/Thành</label>
            <select name="province" class="form-select" aria-label="-- Chọn tỉnh/thành --">
                <option value="">-- Chọn tỉnh/thành --</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= htmlspecialchars($province['ProvinceName']) ?>" 
                        <?= isset($customer['Province']) && $customer['Province'] == $province['ProvinceName'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($province['ProvinceName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Địa chỉ</label>
            <input type="text" name="address" class="form-control" placeholder="Địa chỉ..." value="<?= $customer["Address"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select name="isLocked" class="form-select">
                <option value="0" <?= $customer['IsLocked'] == 0 ? 'selected' : ''; ?>>Đã khóa</option>
                <option value="1" <?= $customer['IsLocked'] == 1 ? 'selected' : ''; ?>>Hoạt động</option>
            </select>
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/">Quay lại</a>
            <button class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
