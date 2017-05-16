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
        $query = 'DELETE FROM tbl_matches';
        $message = '<strong>Alle wedstrijden zijn verwijderd</strong>';

        $stmt = $db_conn->prepare($query);

        try {
            $stmt->execute();
        } catch ( PDOException $e ) {
            $message = '<strong>Je kan geen wedstrijd meer verwijderen als er al een gespeeld is</strong>';
           echo $e;
        }
    } else {
        $message = '<strong>Er is al een wedstrijd gespeeld, hierdoor kunt u geen wedstrijden meer verwijderen</strong>';
    }

    header("Location: ../public/createGame.php?message=$message");