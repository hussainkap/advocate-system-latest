<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/auth.php';
require_auth();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /index.php?route=products/index');
    exit;
}

$stmt = db()->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: /index.php?route=products/index');
    exit;
}

$errors = [];
$old = [
    'name' => $product['name'],
    'description' => $product['description'] ?? '',
    'price' => (string) $product['price'],
];

if (is_post_request()) {
    $name = trim((string) ($_POST['name'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));
    $price = trim((string) ($_POST['price'] ?? ''));

    $old = ['name' => $name, 'description' => $description, 'price' => $price];

    if ($name === '' || mb_strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters.';
    }

    if (!is_numeric($price) || (float) $price < 0) {
        $errors[] = 'Price must be a valid positive number.';
    }

    $imageName = $product['image_path'];

    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image'];
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 2 * 1024 * 1024;

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $errors[] = 'Image upload failed.';
        } elseif (($file['size'] ?? 0) > $maxSize) {
            $errors[] = 'Image must be smaller than 2MB.';
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);
            if (!in_array($mime, $allowedMime, true)) {
                $errors[] = 'Only JPG, PNG, and WEBP images are allowed.';
            } else {
                $ext = match ($mime) {
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    default => 'webp',
                };

                $newName = bin2hex(random_bytes(16)) . '.' . $ext;
                $destination = dirname(__DIR__, 2) . '/assets/uploads/' . $newName;

                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    $errors[] = 'Unable to store uploaded file.';
                } else {
                    if ($imageName) {
                        $oldPath = dirname(__DIR__, 2) . '/assets/uploads/' . $imageName;
                        if (is_file($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                    $imageName = $newName;
                }
            }
        }
    }

    if (!$errors) {
        $updateStmt = db()->prepare('UPDATE products SET name = :name, description = :description, price = :price, image_path = :image_path, updated_at = NOW() WHERE id = :id');
        $updateStmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => (float) $price,
            'image_path' => $imageName,
            'id' => $id,
        ]);

        header('Location: /index.php?route=products/index');
        exit;
    }
}

$title = 'Edit Product';
require dirname(__DIR__, 2) . '/includes/header.php';
?>
<section class="panel">
    <?php if ($errors): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="form">
        <label>Name
            <input type="text" name="name" required value="<?= e($old['name']) ?>">
        </label>

        <label>Description
            <textarea name="description" rows="4"><?= e($old['description']) ?></textarea>
        </label>

        <label>Price
            <input type="number" step="0.01" min="0" name="price" required value="<?= e($old['price']) ?>">
        </label>

        <?php if (!empty($product['image_path'])): ?>
            <p>Current Image:</p>
            <img src="/assets/uploads/<?= e($product['image_path']) ?>" alt="Current product image" class="thumbnail">
        <?php endif; ?>

        <label>Replace Image
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
        </label>

        <button type="submit" class="btn">Update Product</button>
    </form>
</section>
<?php require dirname(__DIR__, 2) . '/includes/footer.php';
