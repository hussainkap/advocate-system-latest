<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_auth();

$pdo = db();
$productCount = (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$userCount = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();

$title = 'Dashboard';
require __DIR__ . '/includes/header.php';
?>
<section class="cards">
    <article class="card">
        <h3>Total Users</h3>
        <p><?= e((string) $userCount) ?></p>
    </article>
    <article class="card">
        <h3>Total Products</h3>
        <p><?= e((string) $productCount) ?></p>
    </article>
</section>

<section class="panel">
    <h2>Quick Actions</h2>
    <div class="actions">
        <a class="btn" href="/index.php?route=products/create">Add Product</a>
        <a class="btn btn-secondary" href="/index.php?route=products/index">Manage Products</a>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php';
