<?php header("Content-Type: text/html; charset=ISO-8859-1"); ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<style>
		td.details-control {
		background: url('/wordpress/wp-content/plugins/impl/datatables/img/details_open.png') no-repeat center center;
		cursor: pointer;
		}
		tr.shown td.details-control {
			background: url('/wordpress/wp-content/plugins/impl/datatables/img/details_close.png') no-repeat center center;
		}
	</style>
</head>
<body> 
<a class='row_button create_hs'>neue Hochschule erstellen</a><br/><br/>
<a class='row_button create_sg'>neuen Studiengang erstellen</a><br/><br/>
<div id="dialog" title="">
  <p></p>
</div>

<table id="example" class="display" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th></th>
			<th>Studiengang</th>
			<th>Hochschule</th>
			<th>Vertiefung</th>
			<th>Akad. Grad</th>
			<th>Fachrichtung</th>
			<th>Online</th>
			<th>Sprache</th>
			<th>Studienbeginn</th>
			<th>konsekutiv</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th></th>
			<th>Studiengang</th>
			<th>Hochschule</th>
			<th>Vertiefung</th>
			<th>Akad. Grad</th>
			<th>Fachrichtung</th>
			<th>Online</th>
			<th>Sprache</th>
			<th>Studienbeginn</th>
			<th>konsekutiv</th>
		</tr>
	</tfoot>
</table>

<script>
$(document).ready(function() {	
	var base_path="/wordpress/wp-content/plugins/impl/datatables/";
	$( "#dialog" ).dialog({
      autoOpen: false,
	  width: 'auto',
	  autoResize:true 
    });
	
	$(".create_hs").button({ icons: { primary: "ui-icon-plus", secondary: null } }).click(
	function () { 
		$( "#dialog" )
		.dialog( "open" )
		.dialog( "option","title", "Eintrag erstellen" )
		.dialog({
		  modal: true,
		  buttons: {
				"Speichern": function() { 
					var name = $(this).find("#name").val();
					var ort = $(this).find("#ort").val();
					var bundesland = $(this).find("#bundesland").val();
					var land = $(this).find("#land").val();
					var privat = $(this).find("#privat").val();
					var semestergebuehr = $(this).find("#semestergebuehr").val();				
						
					$.ajax({ method: "POST", url: base_path+"/action/create_hs.php", data: { name:name,ort:ort,bundesland:bundesland,land:land,privat:privat,semestergebuehr:semestergebuehr }});

					table.ajax.reload();
				$( this ).dialog( "close" );
				},
				"Abbrechen": function() { $( this ).dialog( "close" );}
			}
		  })
		.load( base_path+"add_hs.php" ); 
		return false; 
	});
	
	$(".create_sg").button({ icons: { primary: "ui-icon-plus", secondary: null } }).click(
	function () { 
		$( "#dialog" )
		.dialog( "open" )
		.dialog( "option","title", "Eintrag erstellen" )
		.dialog({
		  modal: true,
		  buttons: {
				"Speichern": function() { 
								
					var hochschule = $(this).find("#hochschule").val();
					var studiengang = $(this).find("#studiengang").val();
					var vertiefung = $(this).find("#vertiefung").val();
					var grad = $(this).find("#grad").val();
					var fachrichtung = $(this).find("#fachrichtung").val();
					var online = $(this).find("#online").val();
					var aufnahmeverfahren = $(this).find("#aufnahmeverfahren").val();
					var zulassungsvoraussetzungen = $(this).find("#zulassungsvoraussetzungen").val();
					var studienplaetze = $(this).find("#studienplaetze").val();
					var sprache = $(this).find("#sprache").val();
					var studienbeginn = $(this).find("#studienbeginn").val();
					var internationaleausrichtung = $(this).find("#internationaleausrichtung").val();
					var konsekutiv = $(this).find("#konsekutiv").val();
					var regulaerestudienzeit = $(this).find("#regulaerestudienzeit").val();
					var ects = $(this).find("#ects").val();
					var besonderheiten = $(this).find("#besonderheiten").val();
					var webseite = $(this).find("#webseite").val();					
						
					$.ajax({ method: "POST", url: base_path+"/action/create_sg.php", data: { idhochschule:hochschule, name:studiengang,vertiefung:vertiefung,grad:grad,fachrichtung:fachrichtung,online:online,aufnahmeverfahren:aufnahmeverfahren,
zulassungsvoraussetzungen:zulassungsvoraussetzungen,studienplaetze:studienplaetze,sprache:sprache,studienbeginn:studienbeginn,internationaleausrichtung:internationaleausrichtung,konsekutiv:konsekutiv,regulaerestudienzeit:regulaerestudienzeit,
ects:ects,besonderheiten:besonderheiten,webseite:webseite}});
						
					table.ajax.reload();				
				$( this ).dialog( "close" );
				},
				"Abbrechen": function() { $( this ).dialog( "close" );}
			}
		  })
		.load( base_path+"add_sg.php" ); 
		return false; 
	});
	
    var table = $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": base_path+"get.php",
        "fnDrawCallback": function (oSettings) {
		},
		"columns": [{
				"className":      'details-control',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},				
            { "data": "SGName" },			
            { "data": "HSName" },
			{ "data": "Vertiefung" },  
			{ "data": "Grad" },
			{ "data": "Fachrichtung" },
			{ "data": "Online" },  
			{ "data": "Sprache" },
			{ "data": "Studienbeginn" },
			{ "data": "konsekutiv" }
			]
    });
	
	function format ( row, tr ) {	
	//console.log(d);
		var d = row.data();
		$.ajax({ method: "POST", url: base_path+"/list_sp.php", data: { IdStudiengang:d.SGID }})
		.done(function( newdata ) {	
		var ret = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
			'<tr>'+
				'<td>Aufnahmeverfahren:</td>'+
				'<td colspan=2>'+d.Aufnahmeverfahren+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Zulassungsvoraussetzungen:</td>'+
				'<td colspan=2>'+d.Zulassungsvoraussetzungen+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Studienplätze:</td>'+
				'<td colspan=2>'+d.Studienplaetze+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>internationale Ausrichtung:</td>'+
				'<td colspan=2>'+d.internationaleAusrichtung+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Reguläre Studienzeit:</td>'+
				'<td colspan=2>'+d.RegulaereStudienzeit+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>ECTS:</td>'+
				'<td colspan=2>'+d.ECTS+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Besonderheiten:</td>'+
				'<td colspan=2>'+d.Besonderheiten+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Webseite:</td>'+
				'<td colspan=2>'+d.Webseite+'</td>'+
			'</tr>';			
		
		var i = 1;
			$.each($.parseJSON(newdata), function(id, obj) {
				$.each(obj, function(idx, elem) {
				ret += '<tr>'+
						'<td>Schwerpunkt '+(i++)+':</td>'+
						'<td>' + elem.Name + '</td>'+
						'<td>'+
						'<a class=\'row_button edit_sp\' id='+elem.ID+'>Editieren</a>'+
						'<a class=\'row_button delete_sp\' id='+elem.ID+'>Löschen</a>'+
						'</td>'+
					'</tr>';
				});	
			});	
		ret += '<tr>'+
				'<td></td>'+
				'<td colspan=2>'+
				'<a class=\'row_button create_sp\' sgid='+d.SGID+'>neuen Schwerpunkt erstellen</a>'+
				'</td>'+
				'</tr>';
			
		ret += '<tr>'+
				'<td>Studiengang:</td>'+
				'<td colspan=2>'+
				'<a class=\'row_button edit_sg\' id='+d.SGID+'>Editieren</a>'+
				'<a class=\'row_button delete_sg\' id='+d.SGID+'>Löschen</a>'+
				'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Hochschule:</td>'+
				'<td colspan=2>'+
				'<a class=\'row_button edit_hs\' id='+d.HSID+'>Editieren</a>'+
				'</td>'+
			'</tr>'+		
		'</table>';
		
		row.child( ret ).show();
		tr.addClass('shown');
		
		$(".create_sp").button({ icons: { primary: "ui-icon-plus", secondary: null } }).click(
			function () { 
			var sgid = $(this).attr("sgid");
				$( "#dialog" )
				.dialog( "open" )
				.dialog( "option","title", "Eintrag erstellen" )
				.dialog({
				  modal: true,
				  buttons: {
						"Speichern": function() { 					
						var studiengang = $(this).find("#studiengang").val();
						var schwerpunkt = $(this).find("#schwerpunkt").val();			
						
						$.ajax({ method: "POST", url: base_path+"/action/create_sp.php", data: { IdStudiengang:studiengang,name:schwerpunkt }});
						
						table.ajax.reload();
						$( this ).dialog( "close" );				
						},
						"Abbrechen": function() { $( this ).dialog( "close" );}
					}
				  })
				.load( base_path+"add_sp.php?sgid="+sgid ); 
				return false; 
			});
		
		$(".edit_sg").button({ icons: { primary: "ui-icon-pencil", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
				.dialog("open" )
				.dialog( "option","title", "Eintrag ändern" )
				.dialog({
				  modal: true,
				  buttons: {
						"Speichern": function() { 				

						var hochschule = $(this).find("#hochschule").val();
						var studiengang = $(this).find("#studiengang").val();
						var vertiefung = $(this).find("#vertiefung").val();
						var grad = $(this).find("#grad").val();
						var fachrichtung = $(this).find("#fachrichtung").val();
						var online = $(this).find("#online").val();
						var aufnahmeverfahren = $(this).find("#aufnahmeverfahren").val();
						var zulassungsvoraussetzungen = $(this).find("#zulassungsvoraussetzungen").val();
						var studienplaetze = $(this).find("#studienplaetze").val();
						var sprache = $(this).find("#sprache").val();
						var studienbeginn = $(this).find("#studienbeginn").val();
						var internationaleausrichtung = $(this).find("#internationaleausrichtung").val();
						var konsekutiv = $(this).find("#konsekutiv").val();
						var regulaerestudienzeit = $(this).find("#regulaerestudienzeit").val();
						var ects = $(this).find("#ects").val();
						var besonderheiten = $(this).find("#besonderheiten").val();
						var webseite = $(this).find("#webseite").val();
						
						$.ajax({ method: "POST", url: base_path+"/action/edit_sg.php", data: { id: id, idhochschule:hochschule, name:studiengang,vertiefung:vertiefung,grad:grad,fachrichtung:fachrichtung,online:online,aufnahmeverfahren:aufnahmeverfahren,
zulassungsvoraussetzungen:zulassungsvoraussetzungen,studienplaetze:studienplaetze,sprache:sprache,studienbeginn:studienbeginn,internationaleausrichtung:internationaleausrichtung,konsekutiv:konsekutiv,regulaerestudienzeit:regulaerestudienzeit,
ects:ects,besonderheiten:besonderheiten,webseite:webseite}});
						
						table.ajax.reload();
						$( this ).dialog( "close" );
						},
						"Abbrechen": function() { $( this ).dialog( "close" );}
					}
				  })
				.load( base_path+"edit_sg.php?id="+id ); 
				return false; 
			});
            
			$(".delete_sg").button({ icons: { primary: "ui-icon-trash", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
					.dialog( "open" )
					.dialog( "option","title", "Eintrag löschen" )
					.dialog({
					  modal: true,
					  buttons: {
							"Löschen": function() { 
							$.ajax({ method: "POST", url: base_path+"/action/delete_sg.php", data: { id: id }});
							
							table.ajax.reload()
							$( this ).dialog( "close" ); 
							},
							"Abbrechen": function() { $( this ).dialog( "close" );}
						}
					  })
					.load( base_path+"delete_sg.php" ); 
			return false; 
			});
			
			$(".edit_hs").button({ icons: { primary: "ui-icon-pencil", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
				.dialog("open" )
				.dialog( "option","title", "Eintrag ändern" )
				.dialog({
				  modal: true,
				  buttons: {
						"Speichern": function() { 		
						
						var name = $(this).find("#name").val();
						var ort = $(this).find("#ort").val();
						var bundesland = $(this).find("#bundesland").val();
						var land = $(this).find("#land").val();
						var privat = $(this).find("#privat").val();
						var semestergebuehr = $(this).find("#semestergebuehr").val();				
						
						$.ajax({ method: "POST", url: base_path+"/action/edit_hs.php", data: { id:id,name:name,ort:ort,bundesland:bundesland,land:land,privat:privat,semestergebuehr:semestergebuehr }});
						
						table.ajax.reload();						
						$( this ).dialog( "close" );
						},
						"Abbrechen": function() { $( this ).dialog( "close" );}
					}
				  })
				.load( base_path+"edit_hs.php?id="+id ); 
				return false; 
			});
            
			$(".delete_hs").button({ icons: { primary: "ui-icon-trash", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
					.dialog( "open" )
					.dialog( "option","title", "Eintrag löschen" )
					.dialog({
					  modal: true,
					  buttons: {
							"Löschen": function() { 							
							$.ajax({ method: "POST", url: base_path+"/action/delete_hs.php", data: { id: id }});
							
							table.ajax.reload()
							$( this ).dialog( "close" );
							},
							"Abbrechen": function() { $( this ).dialog( "close" );}
						}
					  })
					.load( base_path+"delete_hs.php" ); 
			return false; 
			});
			
			$(".edit_sp").button({ icons: { primary: "ui-icon-pencil", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
				.dialog("open" )
				.dialog( "option","title", "Eintrag ändern" )
				.dialog({
				  modal: true,
				  buttons: {
						"Speichern": function() { 					
							var studiengang = $(this).find("#studiengang").val();
							var schwerpunkt = $(this).find("#schwerpunkt").val();			
							
							$.ajax({ method: "POST", url: base_path+"/action/edit_sp.php", data: { id:id,IdStudiengang:studiengang,name:schwerpunkt }});
							
							table.ajax.reload();
							$( this ).dialog( "close" );
							},
						"Abbrechen": function() { $( this ).dialog( "close" );}
					}
				  })
				.load( base_path+"edit_sp.php?id="+id ); 
				return false; 
			});
            
			$(".delete_sp").button({ icons: { primary: "ui-icon-trash", secondary: null } }).click(
			function () { 
			var id = $(this).attr("id");
				$( "#dialog" )
					.dialog( "open" )
					.dialog( "option","title", "Eintrag löschen" )
					.dialog({
					  modal: true,
					  buttons: {
							"Löschen": function() { 							
							$.ajax({ method: "POST", url: base_path+"/action/delete_sp.php", data: { id: id }});
							
							table.ajax.reload()
							$( this ).dialog( "close" );
							},
							"Abbrechen": function() { $( this ).dialog( "close" );}
						}
					  })
					.load( base_path+"delete_sp.php" ); 
			return false; 
			});
		
		});	
	}
	
	$('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {			
			format(row,tr);
        }
    } );
 
} );
</script>
</body>
</html>