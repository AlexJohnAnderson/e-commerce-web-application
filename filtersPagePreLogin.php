<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style.css" type="text/css" />
	<title>Search Shop</title>
</head>
<body>
<?php
// Connect to MySQL server, select database
	$conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
    		or die('Could not connect: ' . mysql_error());
	mysql_select_db('p143a365') or die('Could not select database');

// Send SQL query
	$query = 'SELECT ProductID, productName, cost, quantityInStock, averageRating, manufacturer, category FROM Products';

    $hasParams = false;
    if ($_POST['productName'] != '') {
        $query = $query . " WHERE productName LIKE '%" . $_POST['productName'] . "%'";
        $hasParams = true;
    }

    if ($_POST['cost'] != '') {
        if ($hasParams) {
            $query = $query . " AND cost = " . $_POST['cost'];
        } else {
            $query = $query . " WHERE cost = " . $_POST['cost'];
            $hasParams = true;
        }
    }

    if ($_POST['quantity'] != '') {
        if ($hasParams) {
            $query = $query . " AND quantityInStock = " . $_POST['quantity'];
        } else {
            $query = $query . " WHERE quantityInStock = " . $_POST['quantity'];
            $hasParams = true;
        }
    }

    if ($_POST['rating'] != '') {
        if ($hasParams) {
            $query = $query . " AND averageRating = " . $_POST['rating'];
        } else {
            $query = $query . " WHERE averageRating = " . $_POST['rating'];
            $hasParams = true;
        }
    }

    if ($_POST['manufacturer'] != '') {
        if ($hasParams) {
            $query = $query . " AND manufacturer LIKE '%" . $_POST['manufacturer'] . "%'";
        } else {
            $query = $query . " WHERE manufacturer LIKE '%" . $_POST['manufacturer'] . "%'";
            $hasParams = true;
        }
    }

    if ($_POST['category'] != '') {
        if ($hasParams) {
            $query = $query . " AND category LIKE '%" . $_POST['category'] . "%'";
        } else {
            $query = $query . " WHERE category LIKE '%" . $_POST['category'] . "%'";
            $hasParams = true;
        }
    }

    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

		echo "<a href='./filtersPagePreLogin.html'/>Back</a>\n";

    echo "<h3>Selected Product Info:</h3>";

// Print results in HTML
		echo '<table class = "styled-table">';
    //Echoing columns
		echo "<thead>";
    echo "\t<tr>\n";
    echo "\t\t<td>Product ID</td>\n";
    echo "\t\t<td>Product Name</td>\n";
    echo "\t\t<td>Product Cost</td>\n";
    echo "\t\t<td>Product Quantity</td>\n";
    echo "\t\t<td>Product Rating</td>\n";
    echo "\t\t<td>Product Manufacturer</td>\n";
    echo "\t\t<td>Product Category</td>\n";
    echo "\t</tr>\n";
		echo "</thead>";
		echo "<tbody>";
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
	mysql_free_result($result);

    // New Query
    $query = 'SELECT Products.productID, productName, SUM(quantity) AS quantitySold FROM Orders JOIN Products ON Products.productID = Orders.productID GROUP BY Products.productID, productName';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Close connection
	mysql_close($link);
?>
</body>
</html>

<style>
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
