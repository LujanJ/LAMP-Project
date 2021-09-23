<?php
	require_once('../mysqli_config.php'); //Connect to the database
   // $query= 'SELECT CustomerID FROM customer_information';
    $query = 'SELECT TransactionID, Amount_Paid, Mode, Transaction_Date
    FROM payment
    WHERE (Mode = "credit card") GROUP BY TransactionID HAVING (Amount_Paid > "500")
    ORDER BY TransactionID DESC
    ';
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
			<th>Transaction ID</th>
			<th>Amount Paid</th>
			<th>Mode</th>
			<th>Transaction Date</th>
		</tr>
		<?php foreach ($result as $vendor) {
			echo "<tr>";
			echo "<td>".$vendor['TransactionID']."</td>";
			echo "<td>".$vendor['Amount_Paid']."</td>";
			echo "<td>".$vendor['Mode']."</td>";
			echo "<td>".$vendor['Transaction_Date']."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
