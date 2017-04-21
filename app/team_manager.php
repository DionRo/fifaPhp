<?php
require('../public/header.php');
require('database.php');
?>
<?php

      $teamName         = trim($_POST['nameTeam']);
      $pouleID          = trim($_POST['pouleID']);

      $ErrorMessage = "<strong>U moet een team naam invullen!</strong>";
      if (empty($_POST['nameTeam'])){header("Location: ../public/createTeam.php?message=$ErrorMessage");die;}
      $ErrorMessage = "<strong>U moet een poule nummer invullen!</strong>";
      if (empty($_POST['pouleID'])){header("Location:  ../public/createTeam.php?message=$ErrorMessage");die;}


      $sqlAdd = "INSERT INTO " .$dbname . "." . $table . "(`name`, `poule_id`) VALUES ('" . $teamName . "','" . $pouleID . "')";
      $sqlAddObj = $db_conn->prepare($sqlAdd);
      $sqlAddObj->execute();
      $ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
      header("Location: ../public/createTeam.php?message=$ErrorMessage");

?>

<?php require('../public/footer.php'); ?>

