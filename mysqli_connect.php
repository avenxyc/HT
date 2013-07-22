<?php //To build up the connection between website and database

//Define the infomation required to log in the database
DEFINE('Username','aven');
DEFINE('Password','aven');
DEFINE('Host','localhost');
DEFINE('Database','rp');


//set up the connection
$dbc = @mysqli_connect(Host,Username,Password,rp) OR die('Unable to connect to the database '. mysqli_connect_error());

?>