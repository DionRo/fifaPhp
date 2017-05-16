<?php


$dbname  = "project_fifa";
$table   = "tbl_teams";
$table2  = "tbl_users";
$table3  = "tbl_poules";
$table4  = "tbl_players";
$table5  = "tbl_matches";

$db_conn = new PDO('mysql:host=localhost;dbname=project_fifa','root','');

$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);