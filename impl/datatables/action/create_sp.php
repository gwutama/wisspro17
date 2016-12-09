<?php

include("../config.php");

$fields = "";
$values = "";
foreach ($_POST as $key => $value)
{
	if($value != "") 
	{
		$fields .= ",".mysqli_real_escape_string($conn,$key);
		$values .= ",'".mysqli_real_escape_string($conn,$value)."'";
	}
}


$fields = ltrim($fields, ',');
$values = ltrim($values, ',');

$sql = "INSERT INTO Schwerpunkte (".$fields.") VALUES (".$values.")";
mysqli_query($conn, $sql);

echo $sql;
?>