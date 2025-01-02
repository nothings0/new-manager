<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="">Tên mặt hàng</label>
            <input type="text" name="productName" class="form-control" placeholder="Tên..." value="<?= $product["ProductName"]; ?>" autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Mô tả</label>
            <input type="text" name="productDescription" class="form-control" placeholder="Mô tả..." value="<?= $product["ProductDescription"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Loại hàng</label>
            <select name="categoryID" class="form-select" aria-label="-- Chọn loạt hàng --">
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
            <input type="text" name="price" class="form-control input-format" placeholder="Giá bán..." value="<?= $product["Price"]; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select name="isSelling" class="form-select">
                <option value="0" <?= $product['IsSelling'] == 0 ? 'selected' : ''; ?>>Đã khóa</option>
                <option value="1" <?= $product['IsSelling'] == 1 ? 'selected' : ''; ?>>Hoạt động</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="photo">Ảnh</label>
            <input type="file" id="photo" name="photo" class="form-control" placeholder="Chọn ảnh" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="<?= htmlspecialchars($product['Photo'] ? '/public/images/' . htmlspecialchars($product['Photo'], ENT_QUOTES, 'UTF-8') : '/public/images/nophoto.png', ENT_QUOTES, 'UTF-8'); ?>" 
                alt="Xem trước ảnh" class="mt-3 mx-auto" style="max-width: 200px; display: block;">
        </div>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/product">Quay lại</a>
            <button class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
    <script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = ''; // Nếu không có file được chọn, xóa ảnh xem trước
            preview.style.display = 'none';
        }
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
