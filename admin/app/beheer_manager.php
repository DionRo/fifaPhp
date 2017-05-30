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
    fputcsv($output, array('Game_id', 'HomeTeam', 'AwayTeam', 'HomeTeamScore', 'AwayTeamScore'));

    $query = 'SELECT `id`,`team_id_a`,`team_id_b`,`score_team_a`,`score_team_b` FROM tbl_matches';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}

