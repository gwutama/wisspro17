<?php
include("config.php");

$ID = mysqli_real_escape_string($conn,$_GET["id"]);

$sql = "SELECT ID, Name, idStudiengang FROM Schwerpunkte WHERE ID = ".$ID." Limit 1";
$result = mysqli_query($conn, $sql);
			
$elem = mysqli_fetch_assoc($result); 
?>

<html>
	<head>
	<style>
	input[type="text"] {
		margin: 0;
	}
	</style>
	</head>
	<body>	
	<input type="hidden" id="id" value="<?php echo $elem["ID"]; ?>">
	<table>
		<tbody>			
			<tr>
			<td>Studiengang</td>
			<td>
				<select id="studiengang">
					<?php	$sql = "SELECT Studiengaenge.Id, Studiengaenge.Name AS SGName, Hochschulen.Name AS HSName FROM Studiengaenge LEFT JOIN Hochschulen ON Studiengaenge.idHochschule = Hochschulen.ID";
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option value=\"".$row["Id"]."\" ";
								if($row["Id"] == $elem["idStudiengang"]) echo "selected";
								echo " >".$row["HSName"]." - " . $row["SGName"]. "</option>";
							}
						} 
					?>
				</select>
			</td>
			</tr>
			
			<tr>
			<td>Schwerpunkt</td>
			<td><input type="text" id="schwerpunkt" value="<?php echo $elem["Name"]; ?>"></td>
			</tr>
		</tbody>
	</table>
	</body>
</html>