<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/4/2017
 * Time: 01:41 PM
 */

require ('database.php');
$match_id = $_POST['match_id'];

if (isset($_POST['back']))
{
    header('location: ../public/createGame.php');
}elseif(isset($_POST['submit'])){
    $matches = $db_conn->prepare
                ("
                UPDATE `tbl_matches` 
                SET isPlayed = 1
                WHERE `id` = \"$match_id\" 
                ");
    $matches->execute();

    $Message = "<strong>Updaten is succesvol!</strong>";
    header("Location: ../public/createGame.php?message=$Message");
}