<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/8/2017
 * Time: 02:17 PM
 */

require ('../app/database.php');


$teamName         = trim($_POST['nameTeam']);
$id               = trim($_POST['id']);

$ErrorMessage = "<strong>U moet een team naam invullen!</strong>";
if (empty($_POST['nameTeam'])){header("Location: ../public/adjust_team.php?message=$ErrorMessage");die;}


$sqlUpdate = "UPDATE  $table SET `name` = :teamName WHERE `id` = :id ";
$sqlUpdateObj = $db_conn->prepare($sqlUpdate);
$sqlUpdateObj->execute(['teamName' => $teamName, 'id' => $id]);
$ErrorMessage = "<strong>Update was succesvol!</strong>";
header("Location: ../public/createTeam.php?message=$ErrorMessage");

?>