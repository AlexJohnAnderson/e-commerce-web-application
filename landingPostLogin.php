<?php
    //db connection setup
    $conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
        or die('Could not connect: ' . mysql_error());
    mysql_select_db('p143a365') or die('Could not select database');

    // query: get products from products table
    $query = 'SELECT * FROM Products ORDER BY RAND()';
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());


    // pre login navbar
    echo '
    <!doctype html>
    <html>
        <head>
            <title>Shop</title>
        </head>
        <body>
            <nav class="menu" id="menu">
                <table>
                <tr>
                <td><img src="https://cdn.dribbble.com/users/64815/screenshots/1518220/attachments/229248/shop_logo_big.png?compress=1&resize=400x300&vertical=top" width="120" height="100"/></td>
                </tr>
                </table>
                <div class="container container-nav-links">
                    <p></p>
                    <div class="links">
                        <a href="filtersPagePostLogin.html">Search Shop</a>
                        <a href="account.php">Account</a>
                        <a href="orders.php">Orders</a>
                        <a href="logout.php">Log Out</a>
                    </div>
                </div>
            </nav>';

    // products component
    echo '<div class="productComp">';
        while($col = mysql_fetch_array($result, MYSQL_ASSOC)){
            echo'
                <div class="card">
                    <img src="'.$col['imageUrl'].'" style="width:100%">
                    <h1>'.$col['productName'].'</h1>
                    <p class="price">$'.$col['cost'].'</p>
                    <p>Some text about the product..</p>
                    <p><button>Add to Cart</button></p>
                </div>
            ';
        }

    echo '
            </div>
        </body>
    </html>';
?>

<style>
    body {
    background-color: #EAEDED;
    font-family: Arial, sans-serif;
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

    .table{
    margin-left: auto;
    margin-right: auto;
    }
    th, td {
    padding: 20px;
    }
    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    font-family: arial;
    }

    .price {
    color: grey;
    font-size: 22px;
    }

    .card button {
    border: none;
    outline: 0;
    padding: 12px;
    color: white;
    background-color: #c94225;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    }

    .card button:hover {
    opacity: 0.7;
    }

    /** Product Component **/
    .productComp {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    }
</style>
