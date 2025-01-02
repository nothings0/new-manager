<?php ob_start(); ?>
    <h1><?= $pageTitle ?></h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="">Tên mặt hàng</label>
            <input type="text" name="productName" class="form-control" placeholder="Tên...">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Mô tả</label>
            <input type="text" name="productDescription" class="form-control" placeholder="Mô tả...">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Loại hàng</label>
            <select name="categoryID" class="form-select" aria-label="-- Chọn loạt hàng --">
                <option value="">-- Chọn loạt hàng --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['CategoryID']) ?>">
                        <?= htmlspecialchars($category['CategoryName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Giá bán</label>
            <input type="text" name="price" class="form-control input-format" placeholder="Giá bán...">
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Trạng thái</label>
            <select name="isSelling" class="form-select">
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="photo">Ảnh</label>
            <input type="file" id="photo" name="photo" class="form-control" placeholder="Chọn ảnh" accept="image/*" onchange="previewImage(event)">
            <img id="preview" src="" alt="Xem trước ảnh" class="mt-3 mx-auto" style="max-width: 200px; display: none;">
        </div>
        <p class="error"><?= $error ?? '' ?></p>
        <div class="d-flex gap-2 justify-content-end">
            <a class="btn btn-default" href="/product">Quay lại</a>
            <button class="btn btn-primary">Thêm</button>
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
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>
