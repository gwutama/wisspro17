<?php
include("config.php");

$SGID = mysqli_real_escape_string($conn,$_GET["sgid"]);

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
								if($SGID == $row["Id"]) echo "selected";
								echo " >".$row["HSName"]." - " . $row["SGName"]. "</option>";
							}
						} 
					?>
				</select>
			</td>
			</tr>
			
			<tr>
			<td>Schwerpunkt</td>
			<td><input type="text" id="schwerpunkt"></td>
			</tr>
		</tbody>
	</table>
	</body>
</html>