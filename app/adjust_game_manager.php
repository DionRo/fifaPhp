<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/3/2017
 * Time: 03:37 PM
 */

require ('../app/database.php');

$score_team;

$match_id   = $_POST['match_id'];   // 2
$player     = $_POST['player'];     // 5
$team       = $_POST['team'];       // a

if ($team == 'a') {
    $score_team_x = 'score_team_a';
}
else {
    $score_team_x = 'score_team_b';
}


$match = $db_conn->prepare("SELECT * FROM tbl_matches WHERE id = $match_id");
$match->execute();
$match = $match->fetch(PDO::FETCH_ASSOC);


$team_score = $match[$score_team_x] + 1;
echo '<pre>';
//$query = "INSERT INTO tbl_matches($score_team_x) VALUES ('$team_score') WHERE id = $match_id ";
$query = "  UPDATE `tbl_matches` 
            SET $score_team_x = '$team_score'  
            WHERE `id` = $match_id";

$stmt = $db_conn->prepare($query);
$stmt->execute();
header('location: http://localhost/fifaPhp/public/adjust_game.php?adjust=' . $match_id);