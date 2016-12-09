<?php
include("../config.php");
$ID = mysqli_real_escape_string($conn,$_POST["id"]);

$sql = "DELETE FROM `Schwerpunkte` WHERE IdStudiengang = ".$ID.";";
mysqli_query($conn, $sql);
$sql = "DELETE FROM `Studiengaenge` WHERE `ID` = ".$ID.";";
mysqli_query($conn, $sql);
?>