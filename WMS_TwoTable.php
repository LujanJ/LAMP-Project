<?php
	require_once('../mysqli_config.php'); //Connect to the database
    $query = 'SELECT customer_information.CustomerID, customer_information.Name, transaction_information.TransactionID, transaction_information.Trans_Init_Date
    FROM customer_information INNER JOIN transaction_information
    ON customer_information.CustomerID = transaction_information.CustomerID';
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
			<th>CustomerID</th>
			<th>Customer Name</th>
			<th>Transaction ID</th>
			<th>TransactionDate</th>
		</tr>
		<?php foreach ($result as $vendor) {
			echo "<tr>";
			echo "<td>".$vendor['CustomerID']."</td>";
			echo "<td>".$vendor['Name']."</td>";
			echo "<td>".$vendor['TransactionID']."</td>";
			echo "<td>".$vendor['Trans_Init_Date']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
