<?php
// Connect to MySQL server, select database
	$conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
    		or die('Could not connect: ' . mysql_error());
	mysql_select_db('p143a365') or die('Could not select database');
    session_start();

    if (!isset($_SESSION['firstName'])) {
        $_SESSION['firstName'] = $_POST['firstName'];
    }

    if (!isset($_SESSION['lastName'])) {
        $_SESSION['lastName'] = $_POST['lastName'];
    }

    if (!isset($_SESSION['password'])) {
        $_SESSION['password'] = $_POST['password'];
    }

// Send SQL query
	$query = 'SELECT * FROM Users WHERE firstName = "' . $_POST['firstName'] . '" AND lastName = "' . $_POST['lastName'] . '" AND password = "' . $_POST['password'] . '"';
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

    echo'<div class="card">';
    if (mysql_num_rows($result) == 1) {
        echo "<p>User " . $_POST['firstName'] . " " . $_POST['lastName'] . " successfully authenticated.</p>\n";
        echo "<a href='landingPostLogin.php'> Continue Shopping </a>\n"; 
    } else {
        echo "<p>First Name/Last Name/Password combination is invalid.  Please go back and try again with different credentials.</p>\n";
        echo "<a href='login.html' alt='Back to Login Page' />Back To Login Page</a>\n"; 
    }
    echo'</div>';

// Free resultset
	mysql_free_result($result);

// Close connection
	mysql_close($link);
?>

<style>
        body{
        background-color: #EAEDED;
        font-family: Arial, sans-serif;
        }
        .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        height: 200px;
        margin: auto;
        text-align: center;
        font-family: arial;
        }
    </style>