<?php


$dbname  = "project_fifa";
$table  = "producten";
$db_conn = new PDO('mysql:host=localhost;dbname=project_fifa','root','');

$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);