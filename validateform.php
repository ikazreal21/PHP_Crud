<?php

$title = $_POST['title'];
$desc = $_POST['description'];
$price = $_POST['price'];

if (!$title) {
    $errors[] = 'Product Title is Required';
}

if (!$desc) {
    $errors[] = 'Product Description is Required';
}
