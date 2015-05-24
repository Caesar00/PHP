<?php

session_start();
include 'connection.php';
if(!isset($_SESSION['eoiid'])){
header("Location: GRO_ViewEOI.php");}
$status_pen_query = "UPDATE eoi SET status='PENDING', groreason='$_SESSION[groreason]' WHERE eoi_id='$_SESSION[eoiid]'";

$uploadpen = mysql_query($status_pen_query) or die (mysql_error());
header( "Location: GRO_ListOfEOI.php" );
	
?>