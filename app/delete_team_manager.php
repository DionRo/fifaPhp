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
    $db_conn->query($sqlDel);

    $message = '<strong>Item deleted</strong>';
    header("Location: ../public/createTeam.php?message=$message");
}
else{
    $message = '<strong>Failed to delete</strong>';
    header("Location: ../public/createTeam.php?message=$message");
}