 <?php
include("config.php");

$sql = "SELECT ID, Name FROM `Hochschulen`";
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