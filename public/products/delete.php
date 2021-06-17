<?php

/** @var \PDO */
require_once '../../database.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM products WHERE prodid = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');
