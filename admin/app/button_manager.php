<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/4/2017
 * Time: 01:41 PM
 */

require ('database.php');

$match_id = $_POST['match_id'];

if ( isset($_POST['back']) ) {
    header('location: ../public/createGame.php');
    die;

} else if ( isset($_POST['submit']) ) {
    $matches = $db_conn->prepare("UPDATE `tbl_matches` SET isPlayed = 1 WHERE `id` = \"$match_id\" ");
    $matches->execute();

    $query = 'SELECT * FROM tbl_matches WHERE id = :id';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['id' => $match_id]);
    $match = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = 'SELECT * FROM tbl_teams WHERE id = :id';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['id' => $match['team_id_a']]);
    $team_a = $stmt->fetch(PDO::FETCH_ASSOC);

    $query = 'SELECT * FROM tbl_teams WHERE id = :id';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['id' => $match['team_id_b']]);
    $team_b = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( $match['score_team_a'] > $match['score_team_b']) {
        $new_score = $team_a['points'] + 3;

        $query = 'UPDATE tbl_teams SET points = :points WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['points' => $new_score,'id' => $team_a['id']]);

    } else if ( $match['score_team_a'] < $match['score_team_b'] ) {
        $new_score = $team_b['points'] + 3;

        $query = 'UPDATE tbl_teams SET points = :points WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['points' => $new_score, 'id' => $team_b['id']]);

    } else if ( $match['score_team_a'] == $match['score_team_b'] ) {
        $new_score_a = $team_a['points'] + 1;
        $new_score_b = $team_b['points'] + 1;

        $query = 'UPDATE tbl_teams SET points = :points WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['points' => $new_score_a, 'id' => $team_a['id']]);

        $query = 'UPDATE tbl_teams SET points = :points WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['points' => $new_score_b, 'id' => $team_b['id']]);
    }

    $score_team_a = $match['score_team_a'];
    $score_team_b = $match['score_team_b'];

    $id_team_a = $match['team_id_a'];
    $id_team_b = $match['team_id_b'];

    $query = 'SELECT * FROM tbl_teams WHERE id = :id';
    $stmt = $db_conn->prepare($query);

    $stmt->execute(['id' => $id_team_a]);
    $old_team_a = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->execute(['id' => $id_team_b]);
    $old_team_b = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $old_team_a['totalGoals'] += $score_team_a;
    $old_team_b['totalGoals'] += $score_team_b;

    $query = 'UPDATE tbl_teams SET `totalGoals` = :goals   WHERE id = :id';
    $stmt = $db_conn->prepare($query);

    $stmt->execute(['goals' => $score_team_a, 'id' => $id_team_a]);
    $stmt->execute(['goals' => $score_team_b, 'id' => $id_team_b]);

    $Message = "<strong>Updaten is succesvol!</strong>";
    header("Location: ../public/createGame.php?message=$Message");
}