<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 4/16/2017
 * Time: 03:56 PM
 */

require ("database.php");

if (isset($_GET['delete'])){
    $deleteId = $_GET['delete'];

    $sqlDel = "DELETE FROM producten WHERE id = '$deleteId'";
    $db_conn->query($sqlDel);

    $message = 'Item deleted';
    header("Location: ../public/beheer.php?message=$message");
}
else{
    $message = 'Failed to delete';
    header("Location: ../public/beheer.php?message=$message");
}