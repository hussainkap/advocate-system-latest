<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/auth.php';
require_auth();

$stmt = db()->query('SELECT id, name, description, price, image_path, created_at FROM products ORDER BY id DESC');
$products = $stmt->fetchAll();

$title = 'Products';
require dirname(__DIR__, 2) . '/includes/header.php';
?>
<section class="panel">
    <div class="panel-header">
        <h2>Product List</h2>
        <a class="btn" href="/index.php?route=products/create">Add Product</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!$products): ?>
                <tr><td colspan="6">No products yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= e((string) $product['id']) ?></td>
                    <td>
                        <?php if (!empty($product['image_path'])): ?>
                            <img src="/assets/uploads/<?= e($product['image_path']) ?>" alt="Product image" class="thumbnail">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= e($product['name']) ?></td>
                    <td>$<?= e(number_format((float) $product['price'], 2)) ?></td>
                    <td><?= e($product['created_at']) ?></td>
                    <td>
                        <a href="/index.php?route=products/edit&id=<?= e((string) $product['id']) ?>">Edit</a> |
                        <a href="/index.php?route=products/delete&id=<?= e((string) $product['id']) ?>" onclick="return confirm('Delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require dirname(__DIR__, 2) . '/includes/footer.php';
