<?php
//    require('../public/header.php');
    require('database.php');


    $studentnummer      = trim($_POST['studentnummer']);
    $voornaam           = trim($_POST['voornaam']);
    $achternaam         = trim($_POST['achternaam']);
    $teamnummer         = trim($_POST['teamnummer']);

    $ErrorMessage = "<strong>U moet een studentnummer invullen!</strong>";
    if (empty($_POST['studentnummer'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}

    $ErrorMessage = "<strong>U moet een voornaam invullen!</strong>";
    if (empty($_POST['voornaam'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}

    $ErrorMessage = "<strong>U moet een achternaam invullen!</strong>";
    if (empty($_POST['achternaam'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}

    $ErrorMessage = "<strong>U moet een teamnummer invullen!</strong>";
    if (empty($_POST['teamnummer'])){header("Location: ../public/createPlayer.php?message=$ErrorMessage");die;}


    $sqlAdd = 'INSERT INTO tbl_players (`student_id`,`team_id`,`first_name`,`last_name`) VALUES (:studentnummer, :teamnummer, :voornaam, :achternaam)';
    $sqlAddObj = $db_conn->prepare($sqlAdd);

    try {
        $sqlAddObj->execute(['studentnummer' => $studentnummer, 'teamnummer' => $teamnummer, 'voornaam' => $voornaam, 'achternaam' => $achternaam]);
        $ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";

    } catch ( PDOException $e ) {
        $ErrorMessage = '<strong>Er is iets mis gegaan</strong>';

    }

    header("Location: ../public/createPlayer.php?message=$ErrorMessage");

//    require('../public/footer.php');
?>

