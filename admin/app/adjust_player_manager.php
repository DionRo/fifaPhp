<?php

/**

 * Created by PhpStorm.

 * User: lexkr

 * Date: 5/8/17

 * Time: 15:52

 */



require_once('database.php');



if(isset($_POST['id'])) {

    $id = $_POST['id'];
    $student_id = $_POST['student_id'];
    $team_id = $_POST['teamnummer'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $query = 'UPDATE tbl_players SET student_id = :student_id, team_id = :team_id, first_name = :first_name, last_name = :last_name WHERE id = :id';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['student_id' => $student_id, 'team_id' => $team_id, 'first_name' => $first_name, 'last_name' => $last_name, 'id' => $id]);

    $message = '<strong>Update succesvol</strong>';

} else {

    $message = '<strong>Update failed</strong>';

}



header("Location: ../public/createPlayer.php?message=$message");

die;

?>

