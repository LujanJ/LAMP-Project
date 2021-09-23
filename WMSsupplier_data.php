<?php
	//Check to determine if this page was called with a vend_id set and so assume it is from find_vendor.php
	if(!empty($_GET['SName'])) {
		$supplier_id = $_GET['SName'];
		require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
		//Retrieve specific vendor data using prepared statements:
		$query = "SELECT * from supplier_information where SupplierID = ?";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_bind_param($stmt, "i", $supplier_id); //second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if($result){ //it ran successfully
			$supplier= mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
			//Assign the array variable to scalar variables to simplify output statements
			$name = $supplier['SName'];
			$address = $supplier['Address'];
			$phone = $supplier['Phone'];
		}
		else {
			echo "That Supplier was not found";
			mysqli_close($dbc);
			exit;
		}
	} // end isset
	else {
		echo "You have reached this page in error";
		exit;
	}
	//Vendor found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wholesale Management System</title>
	<meta charset ="utf-8">
</head>
<body>
	<h2>Supplier Data:</h2>
	<?php
		echo "<h3>Supplier Name: $name</h3>";
		echo "<h3>Supplier Address: $address</h3>";
		echo "<h3>Supplier Phone: $phone</h3>";
	?>
	<br>
	<h3><a href="WMSfind_supplier.php">Lookup another supplier</a></h3>
	<h3><a href="index.html">Back to Home</a></h3>
</body>
</html>
