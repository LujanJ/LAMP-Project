<?php
	require_once('../mysqli_config.php'); //Connect to the database
   // $query= 'SELECT CustomerID FROM customer_information';
   //Doing a three table join on product, depleted product and transaction_detail
    $query = 'SELECT * FROM product a INNER JOIN depleted_product b ON a.ProductID = b.ProductID
    INNER JOIN transaction_detail c ON b.ProductID = c.ProductID;';
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

	<table>
		<tr>
            <th>Product ID</th>
            <th>Supplier ID</th>
            <th>PName</th>
            <th>Transaction Date</th>
			<th>Total Amount</th>

		</tr>
		<?php foreach ($result as $vendor) {
			echo "<tr>";
            echo "<td>".$vendor['ProductID']."</td>";
            echo "<td>".$vendor['SupplierID']."</td>";
            echo "<td>".$vendor['Pname']."</td>";
            echo "<td>".$vendor['Trans_Init_Date']."</td>";
            echo "<td>".$vendor['Total_Amount']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
