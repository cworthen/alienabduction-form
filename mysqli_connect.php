
<?php



/**
 * Created by PhpStorm.
 * User: candace
 * Date: 3/28/16
 * Time: 6:00 PM
 */

// Set the database access information as constants
// asterisks put to conceal database login info

DEFINE ('DB_HOST','localhost');
DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD','*******');
DEFINE ('DB_DATABASE','*******');

//Make the connection
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) OR die
('Could not connect to MySQL: '.mysql_connect_error());

//Set the encoding
mysqli_set_charset($dbc, 'utf8');



?>
