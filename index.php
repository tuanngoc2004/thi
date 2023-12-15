<?php
include 'connection.php';

// Query to get all products
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Management</title>
</head>
<body>
	 <div class="sidebar">
		<ul>
			<li><a href="add_product.php">Add Product</a></li>
		</ul>
	</div>
	 <div class="content">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Category</th>
					<th>Status</th>
          <th>Price</th>
					<th>Description</th>
          <th>Cập nhật</th>
              <th>Xóa</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				    echo "<tr>";
				    echo "<td>" . $row["id"]. "</td>";
				    echo "<td>" . $row["name"]. "</td>";
				    echo "<td>" . $row["category_id"]. "</td>";
				    echo "<td>" . $row["status"]. "</td>";
            echo "<td>" . $row["price"]. "</td>";
				    echo "<td>" . $row["description"]. "</td>";
            echo "<td><a href='edit_product.php?id=".$row['id']."'>Cập nhật</a></td>";
            echo "<td><a href='delete_product.php?id=".$row['id']."'>Xóa</a></td>";
            echo "<td><a href='detail_product.php?id=".$row['id']."'>Detail</a></td>";
				    echo "</tr>";
				  }
				} else {
				  echo "0 results";
				}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>