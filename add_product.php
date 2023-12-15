<?php
include 'connection.php';

// Query to get all categories
$sql = "SELECT * FROM category";
$category_result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"];
	$price = $_POST["price"];
	$category_id = $_POST["category_id"];
	$status = $_POST["status"];
	$description = $_POST["description"];

	//truy vấn
	$sql = "INSERT INTO product (name, category_id, status,price, description)
  VALUES ('$name', '$category_id', '$status','$price', '$description')";

	// Insert product into database
	//   if(empty($_POST['name']) || empty($_POST['price'])) {
	// 	echo "Vui lòng điền đầy đủ thông tin sản phẩm.";
	//   } else if($conn->query($sql) === TRUE){
	// 	// Thực hiện thêm sản phẩm vào cơ sở dữ liệu
	// 	header("Location: index.php");
	//     exit();

	//   }

	if (!$name) {
		// Thực hiện thêm sản phẩm vào cơ sở dữ liệu
		$_SESSION['add-category'] = "Enter title";
	} else if ($conn->query($sql) === TRUE) {
		// Hiển thị thông báo lỗi khi có trường thông tin bị bỏ trống
		header("Location: index.php");
		exit();
	}

	//   if ($conn->query($sql) === TRUE) {
	//     header("Location: index.php");
	//     exit();
	//   } else {
	//     echo "Error: " . $sql . "<br>" . $conn->error;
	//   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Add Product</title>
</head>

<body>
	<?php if (isset($_SESSION['add-category'])) : ?>
		<div class="alert__message error">
			<p>
				<?= $_SESSION['add-category'];
				unset($_SESSION['add-category']);
				?>
			</p>
		</div>
	<?php endif ?>
	<form method="post">
		<label>Name:</label>
		<input type="text" name="name"><br>
		<label>Price:</label>
		<input type="number" name="price"><br>

		<label>Category:</label>
		<select name="category_id">
			<?php
			if ($category_result->num_rows > 0) {
				// output data of each row
				while ($row = $category_result->fetch_assoc()) {
					echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
				}
			} else {
				echo "<option value=''>No categories found</option>";
			}
			?>
		</select><br>

		<label>Status:</label>
		<select name="status">
			<option value="1">Active</option>
			<option value="0">Inactive</option>
		</select><br>

		<label>Description:</label>
		<textarea name="description"></textarea><br>

		<input type="submit" value="Add Product">
	</form>
</body>

</html>