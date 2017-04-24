<?php
require('../public/header.php');
require('database.php');
?>
<?php

$studentnummer      = trim($_POST['studentnummer']);
$voornaam           = trim($_POST['voornaam']);
$achternaam         = trim($_POST['achternaam']);
$teamnummer         = trim($_POST['teamnummer']);

$ErrorMessage = "<strong>U moet een studentunmmer invullen!</strong>";
if (empty($_POST['studentnummer'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een voornaam invullen!</strong>";
if (empty($_POST['voornaam'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een achternaam invullen!</strong>";
if (empty($_POST['achternaam'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een teamnummer invullen!</strong>";
if (empty($_POST['teamnummer'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}


$sqlAdd = "INSERT INTO " .$dbname . "." . $table4 . "(`student_id`,`team_id`,`first_name`,`last_name`) VALUES ('" . $studentnummer . "',
'" . $teamnummer . "','" . $voornaam . "','" . $achternaams . "')";
$sqlAddObj = $db_conn->prepare($sqlAdd);
$sqlAddObj->execute();
$ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
header("Location: ../public/createPlayer.php?message=$ErrorMessage");

?>

<?php require('../public/footer.php'); ?>

