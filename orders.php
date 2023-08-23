<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style.css" type="text/css" />
	<title>Orders</title>
</head>
<body>
    
<?php
	session_start();
// Connect to MySQL server, select database
	$conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
    		or die('Could not connect: ' . mysql_error());
	mysql_select_db('p143a365') or die('Could not select database');

	$first = $_SESSION['firstName'];

	$last = $_SESSION['lastName'];

	$pass = $_SESSION['password'];

	// Send SQL session query
	$sessionQuery = 'SELECT * FROM Users WHERE Users.password ="'.$_SESSION['password'].'"';
	$sessionQueryResult = mysql_query($sessionQuery) or die('Query failed: ' . mysql_error());

	$test = '';
	while ($line = mysql_fetch_array($sessionQueryResult)) {

				$UID=$line[0];
	}

	// Send SQL orders queries
	$productQuery = 'SELECT Products.productName FROM Orders, Products, Users WHERE Orders.productID = Products.productID AND Users.userID = "'.$UID.'"';
    $productResult = mysql_query($productQuery) or die('Query failed: ' . mysql_error());

	$quantityQuery = 'SELECT Orders.quantity FROM Orders';
	$quantityResult = mysql_query($quantityQuery) or die('Query failed: ' . mysql_error());

	$costQuery = 'SELECT sum(Orders.fees + Products.cost)*Orders.quantity FROM Orders, Products WHERE Orders.productID = Products.productID GROUP BY Products.productName';
	$costResult = mysql_query($costQuery) or die('Query failed: ' . mysql_error());

	$paymentQuery = 'SELECT Orders.paymentOption FROM Orders, Products WHERE Orders.productID = Products.productID';
	$paymentResult = mysql_query($paymentQuery) or die('Query failed: ' . mysql_error());

	$locationQuery = 'SELECT Orders.deliveryLocation FROM Orders, Products WHERE Orders.productID = Products.productID';
	$locationResult = mysql_query($locationQuery) or die('Query failed: ' . mysql_error());

	$dateQuery = 'SELECT Orders.deliveryDate FROM Orders';
	$dateResult = mysql_query($dateQuery) or die('Query failed: ' . mysql_error());

    echo' <nav class="menu" id="menu">
        <table>
        <tr>
        <td><img src="https://cdn.dribbble.com/users/64815/screenshots/1518220/attachments/229248/shop_logo_big.png?compress=1&resize=400x300&vertical=top" width="120" height="100"/></td>
        </tr>
        </table>
        <div class="container container-nav-links">
            <div class="links">
                <a href="landingPostLogin.php">Back To Shop</a>
                <a href="account.php">Account</a>
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </nav>';

    echo '<h3>Your Orders:</h3>';

// Print results in HTML
		echo "<script>\n";
		echo "function DeleteRowFunction(o) {\n";
		echo "var p=o.parentNode.parentNode;\n";
		echo "p.parentNode.removeChild(p);\n";
		echo "</script>\n";
		echo '<table class="styled-table">';
		echo "<thead>\n";
    //Echoing columns
    echo '<tr>';
		echo "<th>Product</th>\n";
		echo "<th>Quantity</th>\n";
		echo "<th>Total Price</th>\n";
		echo "<th>Payment Option</th>\n";
		echo "<th>Delivery Location</th>\n";
		echo "<th>Delivery Date</th>\n";
    echo "\t</tr>\n";
		echo "</thead>\n";
		echo "<tbody>\n";
    // End Echoing columns
	while ($line1 = mysql_fetch_array($productResult, MYSQL_ASSOC) AND
				 $line2 = mysql_fetch_array($quantityResult, MYSQL_ASSOC) AND
			 	 $line3 = mysql_fetch_array($costResult, MYSQL_ASSOC) AND
			 	 $line4 = mysql_fetch_array($paymentResult, MYSQL_ASSOC) AND
		 	 	 $line5 = mysql_fetch_array($locationResult, MYSQL_ASSOC) AND
	 		 	 $line6 = mysql_fetch_array($dateResult, MYSQL_ASSOC)) {

    		echo "\t<tr>\n";
    		foreach ($line1 as $col_value) {
        		echo "\t\t<td>$col_value</td>\n";
    		}// Send SQL query
				foreach ($line2 as $col_value) {
				 		echo "\t\t<td>$col_value</td>\n";
				}
				foreach ($line3 as $col_value) {
						echo "\t\t<td>$col_value</td>\n";
			 	}
				foreach ($line4 as $col_value) {
				 		echo "\t\t<td>$col_value</td>\n";
				}
				foreach ($line5 as $col_value) {
				 		echo '<td>'.$col_value.'</td>';
			 	}
			    foreach ($line6 as $col_value) {
				 		echo '<td>'.$col_value.'</td>';
				}
				echo "\t</tr>\n";

	}

	echo "</table>\n";

    // Orders by Product
    $query = 'SELECT Products.productID, productName, SUM(quantity) AS quantitySold FROM Orders JOIN Products ON Products.productID = Orders.productID GROUP BY Products.productID, productName';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo "<h3>Orders By Product: </h3>\n";
    // Print results in HTML
	echo '<table class = "styled-table">';
    //Echoing columns
    echo "<thead>\n";
    echo "\t<tr>\n";
    echo "\t\t<th>Product ID</td>\n";
    echo "\t\t<th>Product Name</td>\n";
    echo "\t\t<th>Total Quantity Sold</td>\n";
    echo "\t</tr>\n";
    echo "</thead>\n";
    echo "<tbody>\n";
    // End Echoing columns
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    		echo "\t<tr>\n";
    		foreach ($line as $col_value) {
        		echo "\t\t<td>$col_value</td>\n";
    		}
    		echo "\t</tr>\n";
	}
	echo "</table>\n";

// Free resultset
	mysql_free_result($productResult);
	mysql_free_result($quantityResult);
	mysql_free_result($costResult);
	mysql_free_result($paymentResult);
	mysql_free_result($locationResult);
	mysql_free_result($quantityResult);
	mysql_free_result($dateResult);

// Close connection
	mysql_close($link);
	session_abort();
?>
</body>
</html>


<style type="text/css">
    body{
    background-color: #EAEDED;
    font-family: Arial, sans-serif;
    }

    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    height: 250px;
    margin: auto;
    text-align: left;
    font-family: arial;
    }

    /** SEARCH BAR**/
    input{
    vertical-align:top;
    margin-top:10px;
    border-radius:10px;
    height:20px;
    width:500px;
    }
    /** --------------------
        NAV AND NAV-LINKS
    -------------------- **/
    .menu {
    background: #232F3E;
    padding: 5px 0;
    margin-bottom: 20px;
    }

    .menu .container-nav-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .menu .container-nav-links .links a {
    color: #CCC;
    border: 1px solid transparent;
    padding: 7px;
    border-radius: 3px;
    font-size: 14px;
    }

    .menu .container-nav-links .links a:hover {
    border: 1px solid rgba(255,255,255, .4);
    }

    .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
    background-color: #c94225;
    color: #ffffff;
    text-align: left;
    }

    .styled-table th,
    .styled-table td {
    padding: 20px 30px;
    }

    .styled-table tbody tr {
    border-bottom: 1px solid #c94225;
    }

    .styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #c94225;
    }
</style>