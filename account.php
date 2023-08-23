<?php
    //db connection setup
    $conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('p143a365') or die('Could not select database');
    session_start();

    $first = $_SESSION['firstName'];
	$last = $_SESSION['lastName'];

    //get user info from db
    $query = "SELECT * FROM Users NATURAL JOIN PhoneNumber NATURAL JOIN Address WHERE firstName = '{$_SESSION['firstName']}' and lastName='{$_SESSION['lastName']}'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo'
        <html>
            <head>
                <title>Account</title>
            </head>
            <body>
                <nav class="menu" id="menu">
                    <table>
                    <tr>
                    <td><img src="https://cdn.dribbble.com/users/64815/screenshots/1518220/attachments/229248/shop_logo_big.png?compress=1&resize=400x300&vertical=top" width="120" height="100"/></td>
                    </tr>
                    </table>
                    <div class="container container-nav-links">
                        <div class="links">
                            <a href="landingPostLogin.php">Back To Shop</a>
                            <a href="orders.php">Orders</a>
                            <a href="logout.php">Log Out</a>
                        </div>
                    </div>
                </nav>

                <div class="card">
                    <h1>' . $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] . '</h1>';

                    echo '<table class="styled-table">';
                    echo "<thead>\n";
                        echo '<tr>';
                            echo "<th>First Name</th>";
                            echo "<th>Middle Initial</th>";
                            echo "<th>Last Name</th>";
                            echo "<th>DOB</th>";
                            echo "<th>Phone Number</th>";
                            echo "<th>Card Number</th>";
                            echo "<th>Expiration</th>";
                            echo "<th>Address</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        echo '<tr>';
                            while($record = mysql_fetch_array($result, MYSQL_ASSOC)){
                                $UID=$line[0];
                                echo '<td>'. $record['firstName'] .' </td>';
                                echo '<td>'. $record['middleInitial'] .' </td>';
                                echo '<td>'. $record['lastName'] .' </td>';
                                echo '<td>'. $record['DOB'] .' </td>';
                                echo '<td>'. $record['phoneNumber'] .' </td>';
                                echo '<td>'. $record['cardNumber'] .' </td>';
                                echo '<td>'. $record['cardExpiration'] .' </td>';
                                echo '<td>'. $record['address'] .', '. $record['city'] .', '. $record['state'] .', '. $record['zip'] .', '. $record['country'] .' </td>';
                            }
                        echo'</tr>';

                    echo "</table>";
                echo '</div>';

                // phone number update
                echo" <h3> Update Phone Number:</h3>";
                echo'<form action="account.php" method="post">
                        <p>
                            <span style=" display: inline-block; width: 160px">New Phone Number:</span> <input type="text" name="phoneNumber" />
                        </p>
                        <input type="submit" value="Apply" />
                    </form>';
                if (isset($_POST['phoneNumber'])) {
                    $query = 'UPDATE PhoneNumber set phoneNumber = "' . $_POST['phoneNumber'] . '" WHERE userID = "' . $UID . '"';
                    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

                    echo "<br />";
                    echo "Updated Phone Number to " . $_POST['phoneNumber'] . ".";
                    echo "<br />";
                    //echo "Please refresh the page to see the changed phone number above.";
                    header("Location: account.php");
                    mysql_free_result($query);
                }
    echo'
            </body>
        </html>
    ';
?>

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
