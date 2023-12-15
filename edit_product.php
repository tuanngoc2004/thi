<?php
include 'connection.php';

// Query to get all categories
$sql = "SELECT * FROM category";
$category_result = $conn->query($sql);

// Query to get product by ID
$id = $_GET["id"];
$sql = "SELECT * FROM product WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $category_id = $_POST["category_id"];
  $status = $_POST["status"];
  $description = $_POST["description"];

  // Update product in database
  $sql = "UPDATE product SET name='$name', category_id='$category_id', status='$status', description='$description' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	>Edit Product</title>
</head>
<body>
	<form method="post">
		<label>Name:</label>
		<input type="text" name="name" value="<?php echo $row["name"]; ?>"><br>

		<label>Category:</label>
		<select name="category_id">
			<?php
			if ($category_result->num_rows > 0) {
			  // output data of each row
			  while($category_row = $category_result->fetch_assoc()) {
			    $selected = ($category_row["id"] == $row["category_id"]) ? "selected" : "";
			    echo "<option value='" . $category_row["id"] . "' " . $selected . ">" . $category_row["name"] . "</option>";
			  }
			} else {
			  echo "<option value=''>No categories found</option>";
			}
			?>
		</select><br>

		<label>Status:</label>
		<select name="status">
			<option value="1" <?php if ($row["status"] == 1) echo "selected"; ?>>Active</option>
			<option value="0" <?php if ($row["status"] == 0) echo "selected"; ?>>Inactive</option>
		</select><br>

		<label>Description:</label>
		<textarea name="description"><?php echo $row["description"]; ?></textarea><br>

		<input type="submit" value="Update Product">
	</form>
</body>
</html>