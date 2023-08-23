<!-- Product Card -->

<?php
// Connect to MySQL server, select database
$conn = mysql_connect('mysql.eecs.ku.edu', 'p143a365', 'Eevie7op')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('p143a365') or die('Could not select database');

// $query = 'SELECT COUNT(*) as total FROM Products';
// $result = mysql_query($query) or die('Query failed: ' . mysql_error());

// while($row = mysql_fetch_array($result)){
//     echo "<h1>" . $row['total'] . '</h1>';
// }

$query = 'SELECT * FROM Products';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
//     // If you want to display all results from the query at once:
//     echo '<p>' . $row['productName'] . '</p>';
//     echo '<p>' . $row['cost'] . '</p>';
//     // print_r($row);
//     // printf("\n");
// }

echo'
    <!doctype HTML>
    <html>
        <body>
            <table class="table">';
            // //for ($rows = 0; $count < $productCount; $count++)
            // for ($rows = 0; $count < 4; $count++)
            // {
            //     echo'<tr>';

            //     for($cols=0; $cols<3; $cols++){
            //         echo'
            //             <td>
            //                 <div class="card">
            //                     <img src="jeans3.jpg" alt="Denim Jeans" style="width:100%">
            //                     <h1>Tailored Jeans</h1>
            //                     <p class="price">$19.99</p>
            //                     <p>Some text about the jeans..</p>
            //                     <p><button>Add to Cart</button></p>
            //                 </div> 
            //             </td>
            //         ';
            //     } 

            //     echo'</tr>';
            // }
            for($rows=0; $rows < 2; $rows++){
                echo'<tr>';
                while($col = mysql_fetch_array($result, MYSQL_ASSOC)){
                    echo'
                        <td>
                            <div class="card">
                                <img src="'.$col['imageUrl'].'" style="width:100%">
                                <h1>'.$col['productName'].'</h1>
                                <p class="price">$'.cost.'</p>
                                <p>Some text about the product..</p>
                                <p><button>Add to Cart</button></p>
                            </div> 
                        </td>
                    ';
                }
                echo'</tr>';
            }
echo'    
            </table>
        </body>
    </html>
';

?>

<style>
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
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    }

    .card button:hover {
    opacity: 0.7;
    }
</style>