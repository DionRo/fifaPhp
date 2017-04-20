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



$target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $ErrorMessage = "<strong>Het bestand is te groot! Probeer een kleinere afbeelding</strong>";
    if ($_FILES["fileToUpload"]["size"] > 500000)
        {header("Location: ../public/create.php?message=$ErrorMessage"); $uploadOk = 0;die;}

    $ErrorMessage = "<strong>Sorry, alleen JPG, JPEG, PNG en GIF files zijn toegestaan</strong>";
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" )
        {header("Location: ../public/create.php?message=$ErrorMessage"); $uploadOk = 0;die;}
    $ErrorMessage = "<strong>Er is iets fout gegaan met het uploaden van de afbeelding! Probeer het later nog eens!</strong>";
    if ($uploadOk == 0)
    {
        header("Location: ../public/create.php?message=$ErrorMessage");
        $uploadOk = 0;
    }
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

      $sqlAdd = "INSERT INTO " .$dbname . "." . $table . "(`titel`, `beschrijving`,`prijs`,`categorie_id`,`foto`) VALUES ('" . $titel . "','" . $omschrijving . "','" . $prijs . "',
      '" . $categorie . "','" . $target_file . "')";
      $sqlAddObj = $db_conn->prepare($sqlAdd);
      $sqlAddObj->execute();
      $ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
      header("Location: ../public/create.php?message=$ErrorMessage");



?>

<?php require('../public/footer.php'); ?>

