<?php

include("../config.php");

$fields = "";
foreach ($_POST as $key => $value)
{
	if($value != "") 
	{
		$fields .= ",".mysqli_real_escape_string($conn,$key)."='".mysqli_real_escape_string($conn,$value)."'";
	}
}
$ID = $_POST["id"];

$fields = ltrim($fields, ',');

$sql = "UPDATE Hochschulen SET ".$fields." WHERE ID=".$ID;
mysqli_query($conn, $sql);
?>