<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/database.php';

function current_user(): ?array
{
    if (empty($_SESSION['user_id'])) {
        return null;
    }

    static $cachedUser = null;

    if ($cachedUser !== null) {
        return $cachedUser;
    }

    $stmt = db()->prepare('SELECT id, name, email, created_at FROM users WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => (int) $_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        unset($_SESSION['user_id']);
        return null;
    }

    $cachedUser = $user;

    return $cachedUser;
}

function require_auth(): void
{
    if (current_user() === null) {
        header('Location: /index.php?route=auth/login');
        exit;
    }
}

function redirect_if_authenticated(): void
{
    if (current_user() !== null) {
        header('Location: /dashboard.php');
        exit;
    }
}
