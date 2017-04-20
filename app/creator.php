<?php
require('../public/header.php');
require('database.php');
?>
<?php

      $titel         = trim($_POST['titel']);
      $omschrijving  = trim($_POST['beschrijving']);
      $categorie     = trim($_POST['categorie']);
      $prijs         = trim($_POST['prijs']);

      $ErrorMessage = "<strong>U moet een titel invullen!</strong>";
      if (empty($_POST['titel'])){header("Location: ../public/create.php?message=$ErrorMessage");die;}
      $ErrorMessage = "<strong>U moet een beschrijving invullen!</strong>";
      if (empty($_POST['beschrijving'])){header("Location:  ../public/create.php?message=$ErrorMessage");die;}
      $ErrorMessage = "<strong>U moet een prijs invullen!</strong>";
      if (empty($_POST['prijs'])){header("Location:  ../public/create.php?message=$ErrorMessage");die;}


      $sqlAdd = "INSERT INTO " .$dbname . "." . $table . "(`titel`, `beschrijving`,`prijs`,`categorie_id`,`foto`) VALUES ('" . $titel . "','" . $omschrijving . "','" . $prijs . "',
      '" . $categorie . "','" . $target_file . "')";
      $sqlAddObj = $db_conn->prepare($sqlAdd);
      $sqlAddObj->execute();
      $ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
      header("Location: ../public/create.php?message=$ErrorMessage");



?>

<?php require('../public/footer.php'); ?>

