<?php
include 'connection.php';

// Query to delete product by ID
$id = $_GET["id"];
$sql = "DELETE FROM product WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("Location: index.php");
  exit();
} else {
  echo "Error deleting record: " . $conn->error;
}
?>