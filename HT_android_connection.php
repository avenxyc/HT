
<? //PHP script for android app connection

//Define the infomation required to log in the database
DEFINE('Username','112574xdbuser');
DEFINE('Password','b9823tgdQK');
DEFINE('Host','127.0.0.1');
DEFINE('Database','112574xdb');

//set up the connection
$dbc = @mysqli_connect(Host,Username,Password,Database) OR die('Unable to connect to the database '. mysqli_connect_error());

$upccode = $_GET['upccode'];

echo $upccode;



mysql_query("SET CHARACTER SET utf8");
$query = "	SELECT  DISTINCT  products.upccode, weight, product_name, last_updated from constituents, products, prod_const, regions_recyclability 
				   where products.upccode = prod_const.upccode and products.upccode = $upccode"; 

$sth = mysqli_query($dbc,$query);// Run the query.
$num = mysqli_num_rows($r);// get the number of row

echo "this is: ".$num;

if (mysqli_errno($dbc)) {
    header("HTTP/1.1 500 Internal Server Error");
    echo $query.'\n';
    echo mysqli_error($dbc);
}
else
{
    $rows = array();
    while($r = mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
        $rows[] = $r;
    }
    print json_encode($rows);
}
?>