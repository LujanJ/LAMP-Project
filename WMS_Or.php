<?php
	require_once('../mysqli_config.php'); //Connect to the database
    $query = 'SELECT * FROM product WHERE CategoryID = "1" OR SupplierID = "2"';
	$result = mysqli_query($dbc, $query);
	//Fetch all rows of result as an associative array
	if($result)
		mysqli_fetch_all($result, MYSQLI_ASSOC); //get the result as an associative, 2-dimensional array
	else {
		echo "<h2>We are unable to process this request right now.</h2>";
		echo "<h3>Please try again later.</h3>";
		exit;
	}
	mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>WMS</title>
	<meta charset ="utf-8">
</head>
<body>
    <h2>Wholesale Management System</h2>
    <h3>Table containing products with a Category ID of 1 or a Supplier ID of 2</h3>

	<table>
		<tr>
			<th>Product ID</th>
			<th>Product Name</th>
			<th>Category ID</th>
            <th>Supplier ID</th>
            <th>Quantity in Stock</th>
            <th>Unit Price</th>

		</tr>
		<?php foreach ($result as $vendor) {
			echo "<tr>";
			echo "<td>".$vendor['ProductID']."</td>";
			echo "<td>".$vendor['Pname']."</td>";
			echo "<td>".$vendor['CategoryID']."</td>";
            echo "<td>".$vendor['SupplierID']."</td>";
            echo "<td>".$vendor['Quantity_in_stock']."</td>";
			echo "<td>".$vendor['UnitPrice']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
