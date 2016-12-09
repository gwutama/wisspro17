<?php
include("config.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $aColumns = array( 'SGID', 'HSID', 'SGName', 'HSName', 'Vertiefung', 'Grad', 'Fachrichtung', 'Online', 'Aufnahmeverfahren', 'Zulassungsvoraussetzungen', 'Studienplaetze', 'Sprache', 'Studienbeginn', 'internationaleAusrichtung', 'konsekutiv', 'RegulaereStudienzeit', 'ECTS', 'Besonderheiten', 'Webseite');
     
    $sIndexColumn = "SGID";
     
    $sTable = "getStudiengaenge";
     
         function fatal_error ( $sErrorMessage = '' )
    {
        header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
        die( $sErrorMessage );
    }

    $mysqli = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);
     
    $sLimit = "LIMIT ".$_GET['start'].",".$_GET['length'];

    $sOrder = "ORDER BY ".$aColumns[$_GET['order'][0]['column']]." ".$_GET['order'][0]['dir'];
	
    $sWhere = "";
    if ( isset($_GET['search']['value']) && $_GET['search']['value'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {			
            if ( isset($_GET['columns'][$i]['searchable']) && $_GET['columns'][$i]['searchable'] == "true" )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($mysqli,$_GET['search']['value'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
    }
     
    $sQuery = "
        SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";
		
    $rResult = $mysqli->query($sQuery);
    $aResult = $rResult->fetch_array(MYSQLI_ASSOC);
     
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
        $sWhere
    ";
	
    $rResultFilterTotal = $mysqli->query($sQuery);
    $aResultFilterTotal = $rResultFilterTotal->fetch_array(MYSQLI_ASSOC);
	
    $iFilteredTotal = $aResultFilterTotal["COUNT(".$sIndexColumn.")"];
	
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = $mysqli->query($sQuery);
    $aResultTotal = $rResultTotal->fetch_array(MYSQLI_ASSOC);

    $iTotal = $aResultTotal["COUNT(".$sIndexColumn.")"];
	
    $output = array(
        "draw" => intval($_GET['draw']),
        "recordsTotal" => $iTotal,
        "recordsFiltered" => $iFilteredTotal,
        "data" => array()
    );
     
    while ( $aRow = $rResult->fetch_array(MYSQLI_ASSOC) )
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {			
            if ( $aColumns[$i] == "version" )
            {
				$row[$aColumns[$i]] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : utf8_encode ($aRow[ $aColumns[$i] ]);
            }
            else if ( $aColumns[$i] != ' ' )
            {
				$row[$aColumns[$i]] = utf8_encode ( $aRow[ $aColumns[$i] ]);
            }
        }		
        $output['data'][] = $row;
    }
     
    echo json_encode( $output );
?>