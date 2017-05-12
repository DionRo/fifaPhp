<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/12/2017
 * Time: 09:06 AM
 */

require ('database.php');

if(isset($_POST["export-matches"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=matches.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'team_id_a', 'team_id_b', 'score_id_b', 'score_id_b','isPlayed','matchType'));

    $query = 'SELECT * FROM tbl_matches';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}elseif (isset($_POST["export-teams"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=teams.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'poule_id', 'name', 'points','created_at'));

    $query = 'SELECT * FROM tbl_teams';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}elseif (isset($_POST["export-players"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=players.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'student_id', 'team_id', 'first_name', 'last_name','goals'));

    $query = 'SELECT * FROM tbl_players';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}elseif (isset($_POST["export-users"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=users.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('id', 'name', 'password', 'email', 'adminLevel'));

    $query = 'SELECT * FROM tbl_users';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();



    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}