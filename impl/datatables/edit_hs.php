<?php
include("config.php");

$ID = mysqli_real_escape_string($conn,$_GET["id"]);

$sql = "SELECT ID, Name, Ort, Bundesland, Land, Privat, Semestergebuehr FROM Hochschulen";
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
			<td>Name</td>
			<td><input type="text" id="name" value="<?php echo $elem["Name"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Ort</td>
			<td><input type="text" id="ort" value="<?php echo $elem["Ort"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Bundesland</td>
			<td><input type="text" id="bundesland" value="<?php echo $elem["Bundesland"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Land</td>
			<td><input type="text" id="land" value="<?php echo $elem["Land"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Privat</td>
			<td>
				<select id="privat">
					<option value="true" <?php if($elem["Privat"] == 1) echo "selected"; ?>>Ja</option>
					<option value="false" <?php if($elem["Privat"] == 0) echo "selected"; ?>>Nein</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Semestergebühr</td>
			<td><input type="text" id="semestergebuehr" value="<?php echo $elem["Semestergebuehr"]; ?>"></td>
			</tr>	
		</tbody>
	</table>
	</body>
</html>