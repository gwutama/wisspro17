<?php
include("config.php");

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
			<td>Hochschule</td>
			<td>
				<select id="hochschule">
					<?php	$sql = "SELECT Id, Name FROM Hochschulen";
						$result = mysqli_query($conn, $sql);
						
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option value=\"".$row["Id"]."\">" . $row["Name"]. "</option>";
							}
						} 
					?>
				</select>
			</td>
			</tr>
			
			<tr>
			<td>Studiengang</td>
			<td><input type="text" id="studiengang"></td>
			</tr>	
			
			<tr>
			<td>Vertiefung</td>
			<td><input type="text" id="vertiefung"></td>
			</tr>	
			
			<tr>
			<td>Akademischer Grad</td>
			<td><input type="text" id="grad"></td>
			</tr>	
			
			<tr>
			<td>Fachrichtung</td>
			<td><input type="text" id="fachrichtung"></td>
			</tr>	
			
			<tr>
			<td>Online-Studiengang</td>
			<td>
				<select id="online">
					<option value="true">Ja</option>
					<option value="false">Nein</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Aufnahmeverfahren</td>
			<td><input type="text" id="aufnahmeverfahren"></td>
			</tr>	
			
			<tr>
			<td>Zulassungsvoraussetzungen</td>
			<td><input type="text" id="zulassungsvoraussetzungen"></td>
			</tr>	
			
			<tr>
			<td>Anzahl Studienplätze</td>
			<td><input type="text" id="studienplaetze"></td>
			</tr>	
			
			<tr>
			<td>Sprache</td>
			<td>				
				<select id="sprache">
					<option value="1">Deutsch</option>
					<option value="2">Englisch</option>
					<option value="3">Deutsch / Englisch</option>
					<option value="4">Deutsch / Französisch</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Studienbeginn</td>
			<td>				
				<select id="studienbeginn">
					<option value="1">WS</option>
					<option value="2">SS</option>
					<option value="3">HS</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>internationaleAusrichtung</td>
			<td><input type="text" id="internationaleausrichtung"></td>
			</tr>	
			
			<tr>
			<td>konsekutiv</td>
			<td>				
				<select id="konsekutiv">
						<option value="true">Ja</option>
						<option value="false">Nein</option>
				</select>
			</td>
			</tr>	
			
			<tr>
			<td>Reguläre Studienzeit</td>
			<td><input type="text" id="regulaerestudienzeit"></td>
			</tr>	
			
			<tr>
			<td>ECTS-Punkte</td>
			<td><input type="text" id="ects"></td>
			</tr>	
			
			<tr>
			<td>Besonderheiten</td>
			<td><input type="text" id="besonderheiten"></td>
			</tr>	
			
			<tr>
			<td>Webseite</td>
			<td><input type="text" id="webseite"></td>
			</tr>	
		</tbody>
	</table>
	</body>
</html>