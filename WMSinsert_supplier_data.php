<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
	if(!empty($_GET['name'])) { //must have at least a last name not = NULL
		$name = $_GET['name'];
		$address = $_GET['address'];
		$phone = $_GET['phone'];
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve largest cust_id
		$query = "SELECT MAX(SupplierID) FROM supplier_information";
		//No prepared statements because nothing is input from user for this query
		$result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result); //enumerated array this time instad of assosciative
		$newID = $row[0] + 1;

		$query2 = "INSERT INTO supplier_information(SupplierID, SName, Address, Phone) VALUES (?,?,?,?)";
		$stmt2 = mysqli_prepare($dbc, $query2);

		//second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_bind_param($stmt2, "isss", $newID, $name, $address, $phone);

		if(!mysqli_stmt_execute($stmt2)) { //it did not run successfully
			echo "<h2>We were unable to add the customer at this time.</h2>";
			mysqli_close($dbc);
			exit;
		}
		mysqli_close($dbc);
	}
	else {
		echo "<h2>You have reached this page in error</h2>";
		mysqli_close($dbc);
		exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wholesale Management System</title>
	<meta charset ="utf-8">
</head>
<body>
	<h2>Supplier <?php echo "$name";?> was successfully added</h2>
	<h3><a href="WMSadd_supplier.html">Add another customer</a><h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
