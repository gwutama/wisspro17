 <?php
include("config.php");

$ID = mysqli_real_escape_string($conn,$_POST["IdStudiengang"]);

$sql = "SELECT ID, Name FROM `Schwerpunkte` WHERE IdStudiengang=".$ID;
$result = mysqli_query($conn, $sql);
$output = array();

    while ( $elem = mysqli_fetch_assoc($result) )	
	{
        $row = array();
		$row["ID"] = $elem["ID"];
		$row["Name"] = $elem["Name"];
        $output['data'][] = $row;
    }
    echo json_encode( $output );
?>