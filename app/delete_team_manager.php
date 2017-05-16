<?php
/**
<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 4/16/2017
 * Time: 03:56 PM
 */

require ("database.php");

if (isset($_POST['delete'])){
    $deleteId = $_POST['delete'];

    $sqlDel = "DELETE FROM tbl_teams WHERE id = '$deleteId'";
    try {
        $db_conn->query($sqlDel);
        $message = '<strong>Item deleted</strong>';

    } catch ( PDOException $e ) {
        $message = '<strong>Je kan dit team niet verwijderen want het team word al gebruikt</strong>';

    }
} else {
    $message = '<strong>Failed to delete</strong>';
}

header("Location: ../public/createTeam.php?message=$message");
