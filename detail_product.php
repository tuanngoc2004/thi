<?php
// Lấy ID sản phẩm từ tham số trên URL
include 'connection.php';
$id = $_GET['id'];

// Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm và tên danh mục
$sql = "SELECT p.*, c.name AS category_name FROM product p JOIN category c ON p.category_id = c.id WHERE p.id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Hiển thị thông tin sản phẩm và tên danh mục
echo "<h1>{$product['name']}</h1>";
echo "<p>Price: {$product['price']}</p>";
echo "<p>Category: {$product['category_name']}</p>";
echo "<p>Description: {$product['description']}</p>";
?>