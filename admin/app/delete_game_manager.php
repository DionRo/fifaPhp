<?php
    /**
     * Created by PhpStorm.
     * User: lexkr
     * Date: 5/16/17
     * Time: 13:16
     */

    require 'database.php';

    $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();
    $result = $stmt->rowCount();

    if ( $result == 0 ) {
        $query = 'TRUNCATE tbl_matches';
        $stmt = $db_conn->prepare($query);
        $result = $stmt->execute();

        if ( $result ) {
            $message = '<strong>Alle wedstrijden zijn verwijderd</strong>';
        } else {
            $message = '<strong>Er ging iets fout bij het verwijderen van de wedstrijden</strong>';
        }
    } else {
        $message = '<strong>Er is al een wedstrijd gespeeld, hierdoor kunt u geen wedstrijden meer verwijderen</strong>';
    }

    header("Location: ../public/createGame.php?message=$message");