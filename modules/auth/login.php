<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/includes/auth.php';
redirect_if_authenticated();

$error = '';
$email = '';

if (is_post_request()) {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Invalid email or password.';
    } else {
        $stmt = db()->prepare('SELECT id, password_hash FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $error = 'Invalid email or password.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            header('Location: /dashboard.php');
            exit;
        }
    }
}

$title = 'Login';
require dirname(__DIR__, 2) . '/includes/header.php';
?>
<section class="panel auth-panel">
    <?php if ($error !== ''): ?>
        <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" class="form">
        <label>Email
            <input type="email" name="email" required value="<?= e($email) ?>">
        </label>

        <label>Password
            <input type="password" name="password" required>
        </label>

        <button type="submit" class="btn">Login</button>
        <p>New user? <a href="/index.php?route=auth/register">Register</a></p>
    </form>
</section>
<?php require dirname(__DIR__, 2) . '/includes/footer.php';
