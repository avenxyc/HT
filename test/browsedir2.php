<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$dir = dir("./pics/");
	
	echo "<p> Handle is $dir->handle</p>";
	echo "<p> Upload directory is $dir->path</p>";
	echo '<p> Directory Listing: </p><ul>';
	
	while(false !== ($file = $dir->read()))
	  if($file != "." && $file != "..")
		{
			echo "<li>$file</li>";
		}
		echo '</ul>';
		$dir->close();
?>

</body>
</html>