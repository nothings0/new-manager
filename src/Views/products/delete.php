<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="">Tên mặt hàng</label>
            <input disabled readonly type="text" name="productName" class="form-control" placeholder="Tên..." value="<?= $product["ProductName"]; ?>" autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Mô tả</label>
            <input disabled readonly type="text" name="productDescription" class="form-control" placeholder="Mô tả..." value="<?= $product["ProductDescription"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Loại hàng</label>
            <select disabled readonly name="categoryID" class="form-select" aria-label="-- Chọn loạt hàng --">
                <option value="">-- Chọn loạt hàng --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['CategoryID']) ?>" 
                        <?= isset($product['CategoryID']) && $product['CategoryID'] == $category['CategoryID'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['CategoryName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Giá bán</label>
            <input disabled readonly type="text" name="price" class="form-control input-format" placeholder="Giá bán..." value="<?= $product["Price"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select disabled readonly name="isSelling" class="form-select">
                <option value="0" <?= $product['IsSelling'] == 0 ? 'selected' : ''; ?>>Hết hàng</option>
                <option value="1" <?= $product['IsSelling'] == 1 ? 'selected' : ''; ?>>Còn hàng</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="photo">Ảnh</label>
            <img src="<?= htmlspecialchars($product['Photo'] ? '/public/images/' . htmlspecialchars($product['Photo'], ENT_QUOTES, 'UTF-8') : '/public/images/nophoto.png', ENT_QUOTES, 'UTF-8'); ?>" alt="Xem trước ảnh" style="max-width: 200px; display: block;" class="mx-auto">
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/product">Quay lại</a>
            <button class="btn btn-danger">Xóa</button>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
