<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

$user = current_user();
$title = $title ?? 'Admin Panel';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="layout">
    <?php if ($user): ?>
    <aside class="sidebar">
        <h2>My Admin</h2>
        <nav>
            <a href="/dashboard.php">Dashboard</a>
            <a href="/index.php?route=products/index">Products</a>
            <a href="/index.php?route=products/create">Add Product</a>
            <a href="/index.php?route=auth/logout">Logout</a>
        </nav>
    </aside>
    <?php endif; ?>
    <main class="content">
        <header class="topbar">
            <h1><?= e($title) ?></h1>
            <?php if ($user): ?>
                <div class="user-meta">Logged in as <?= e($user['name']) ?></div>
            <?php endif; ?>
        </header>
