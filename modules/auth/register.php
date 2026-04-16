<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/auth.php';
redirect_if_authenticated();

$errors = [];
$old = ['name' => '', 'email' => ''];

if (is_post_request()) {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    $old['name'] = $name;
    $old['email'] = $email;

    if ($name === '' || mb_strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Password confirmation does not match.';
    }

    if (!$errors) {
        $stmt = db()->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $errors[] = 'Email is already registered.';
        }
    }

    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO users (name, email, password_hash, created_at, updated_at) VALUES (:name, :email, :password_hash, NOW(), NOW())');
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $_SESSION['user_id'] = (int) db()->lastInsertId();
        header('Location: /dashboard.php');
        exit;
    }
}

$title = 'Register';
require dirname(__DIR__, 2) . '/includes/header.php';
?>
<section class="panel auth-panel">
    <?php if ($errors): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>Name
            <input type="text" name="name" required value="<?= e($old['name']) ?>">
        </label>

        <label>Email
            <input type="email" name="email" required value="<?= e($old['email']) ?>">
        </label>

        <label>Password
            <input type="password" name="password" required minlength="8">
        </label>

        <label>Confirm Password
            <input type="password" name="confirm_password" required minlength="8">
        </label>

        <button type="submit" class="btn">Register</button>
        <p>Already have an account? <a href="/index.php?route=auth/login">Login</a></p>
    </form>
</section>
<?php require dirname(__DIR__, 2) . '/includes/footer.php';
