<?php
	require_once('../mysqli_config.php'); //Connect to the database
   // $query= 'SELECT CustomerID FROM customer_information';
    $query = 'SELECT a.TransactionID AS transID1, b.TransactionID AS transID2
    FROM transaction_detail a, transaction_detail b
    WHERE a.TransactionID <> b.TransactionID';
 # WHERE a.ProductID <> b.ProductID';
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
			<th>Transaction ID 1</th>
			<th>Transaction ID 2</th>
		</tr>
		<?php foreach ($result as $vendor) {
			echo "<tr>";
			echo "<td>".$vendor['transID1']."</td>";
			echo "<td>".$vendor['transID2']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
