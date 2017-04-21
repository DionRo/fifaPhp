<?php
require('../public/header.php');
require('database.php');
?>
<?php

$poulName         = trim($_POST['poulname']);

$ErrorMessage = "<strong>U moet een team naam invullen!</strong>";
if (empty($_POST['poulname'])){header("Location: ../public/createPoules.php?message=$ErrorMessage");die;}


$sqlAdd = "INSERT INTO " .$dbname . "." . $table3 . "(`naam`) VALUES ('" . $poulName . "')";
$sqlAddObj = $db_conn->prepare($sqlAdd);
$sqlAddObj->execute();
$ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
header("Location: ../public/createPoules.php?message=$ErrorMessage");

?>

<?php require('../public/footer.php'); ?>

