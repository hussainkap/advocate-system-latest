<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/auth.php';
require_auth();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $stmt = db()->prepare('SELECT image_path FROM products WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();

    if ($product) {
        $deleteStmt = db()->prepare('DELETE FROM products WHERE id = :id');
        $deleteStmt->execute(['id' => $id]);

        if (!empty($product['image_path'])) {
            $imagePath = dirname(__DIR__, 2) . '/assets/uploads/' . $product['image_path'];
            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }
    }
}

header('Location: /index.php?route=products/index');
exit;
