<?php ob_start(); ?>    
    <h1 class="text-center" style="color: red"><?= $pageTitle ?></h1>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../layouts/layout.php'); ?>