<?php
include("config.php");

$ID = mysqli_real_escape_string($conn,$_GET["id"]);

$sql = "SELECT ID, Name, IdHochschule, Vertiefung, Grad, Fachrichtung, Online, Aufnahmeverfahren, Zulassungsvoraussetzungen, Studienplaetze, Sprache, Studienbeginn, internationaleAusrichtung, konsekutiv, RegulaereStudienzeit, ECTS, Besonderheiten, Webseite FROM Studiengaenge WHERE ID = ".$ID." Limit 1";
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
			<td>Hochschule</td>
			<td>
				<select id="hochschule">
					<?php	
						$sql = "SELECT Id, Name FROM Hochschulen";
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option value=\"".$row["Id"]."\"";
								if($elem["idHochschule"] == $row["Id"]) echo " selected ";
								echo ">".$row["Name"]."</option>";
							}
						} 
					?>
				</select>
			</td>
			</tr>
			
			<tr>
			<td>Studiengang</td>
			<td><input type="text" id="studiengang" value="<?php echo $elem["Name"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Vertiefung</td>
			<td><input type="text" id="vertiefung" value="<?php echo $elem["Vertiefung"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Akademischer Grad</td>
			<td><input type="text" id="grad" value="<?php echo $elem["Grad"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Fachrichtung</td>
			<td><input type="text" id="fachrichtung" value="<?php echo $elem["Fachrichtung"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Online-Studiengang</td>
			<td>
				<select id="online">
					<option value="true" <?php if($elem["Online"] == 1) echo "selected"; ?>>Ja</option>
					<option value="false" <?php if($elem["Online"] == 0) echo "selected"; ?>>Nein</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Aufnahmeverfahren</td>
			<td><input type="text" id="aufnahmeverfahren" value="<?php echo $elem["Aufnahmeverfahren"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Zulassungsvoraussetzungen</td>
			<td><input type="text" id="zulassungsvoraussetzungen" value="<?php echo $elem["Zulassungsvoraussetzungen"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Anzahl Studienplätze</td>
			<td><input type="text" id="studienplaetze" value="<?php echo $elem["Studienplaetze"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Sprache</td>
			<td>				
				<select id="sprache">
					<option value="1" <?php if($elem["Sprache"] == 1) echo "selected"; ?>>Deutsch</option>
					<option value="2 <?php if($elem["Sprache"] == 2) echo "selected"; ?>">Englisch</option>
					<option value="3" <?php if($elem["Sprache"] == 3) echo "selected"; ?>>Deutsch / Englisch</option>
					<option value="4" <?php if($elem["Sprache"] == 4) echo "selected"; ?>>Deutsch / Französisch</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Studienbeginn</td>
			<td>				
				<select id="studienbeginn">
					<option value="1" <?php if($elem["Studienbeginn"] == 1) echo "selected"; ?>>WS</option>
					<option value="2" <?php if($elem["Studienbeginn"] == 2) echo "selected"; ?>>SS</option>
					<option value="3" <?php if($elem["Studienbeginn"] == 3) echo "selected"; ?>>HS</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>internationaleAusrichtung</td>
			<td><input type="text" id="internationaleausrichtung" value="<?php echo $elem["internationaleAusrichtung"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>konsekutiv</td>
			<td>				
				<select id="konsekutiv">
						<option value="true" <?php if($elem["konsekutiv"] == 1) echo "selected"; ?>>Ja</option>
						<option value="false" <?php if($elem["konsekutiv"] == 0) echo "selected"; ?>>Nein</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Reguläre Studienzeit</td>
			<td><input type="text" id="regulaerestudienzeit" value="<?php echo $elem["RegulaereStudienzeit"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>ECTS-Punkte</td>
			<td><input type="text" id="ects" value="<?php echo $elem["ECTS"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Besonderheiten</td>
			<td><input type="text" id="besonderheiten" value="<?php echo $elem["Besonderheiten"]; ?>"></td>
			</tr>	
			
			<tr>
			<td>Webseite</td>
			<td><input type="text" id="webseite" value="<?php echo $elem["Webseite"]; ?>"></td>
			</tr>	
		</tbody>
	</table>
	
	</body>
</html>