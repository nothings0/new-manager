<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>&keyword=<?= $_GET['keyword'] ?? "" ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>