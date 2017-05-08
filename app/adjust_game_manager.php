<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/3/2017
 * Time: 03:37 PM
 */

require ('../app/database.php');

if(isset($_POST['add'])){
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

// Hierin worden de scores van de matches geupdate
    $match = $db_conn->prepare("SELECT * FROM tbl_matches WHERE id = $match_id");
    $match->execute();
    $match = $match->fetch(PDO::FETCH_ASSOC);

    $team_score = $match[$score_team_x] + 1;

    $query = "  UPDATE `tbl_matches` 
            SET $score_team_x = '$team_score'  
            WHERE `id` = $match_id";

    $stmt = $db_conn->prepare($query);
    $stmt->execute();

// Hierin worden de scores van spelers  geupdate
    $players = $db_conn->prepare("SELECT * FROM tbl_players WHERE id = $player");
    $players->execute();
    $players = $players->fetch(PDO::FETCH_ASSOC);

    $team_score = $players['goals'] + 1;

    $query = "  UPDATE `tbl_players` 
            SET `goals` = '$team_score'  
            WHERE `id` = $player";

    $stmt = $db_conn->prepare($query);
    $stmt->execute();

}elseif (isset($_POST['remove'])){
    $score_team;

    $match_id   = $_POST['match_id'];
    $player     = $_POST['player'];
    $team       = $_POST['team'];

    if ($team == 'a') {
        $score_team_x = 'score_team_a';
    }
    else {
        $score_team_x = 'score_team_b';
    }

// Hierin worden de scores van de matches geupdate
    $match = $db_conn->prepare("SELECT * FROM tbl_matches WHERE id = $match_id");
    $match->execute();
    $match = $match->fetch(PDO::FETCH_ASSOC);

    $team_score = $match[$score_team_x] - 1;

    $query = "  UPDATE `tbl_matches` 
            SET $score_team_x = '$team_score'  
            WHERE `id` = $match_id";

    $stmt = $db_conn->prepare($query);
    $stmt->execute();

// Hierin worden de scores van spelers  geupdate
    $players = $db_conn->prepare("SELECT * FROM tbl_players WHERE id = $player");
    $players->execute();
    $players = $players->fetch(PDO::FETCH_ASSOC);

    $team_score = $players['goals'] - 1;

    $query = "  UPDATE `tbl_players` 
            SET `goals` = '$team_score'  
            WHERE `id` = $player";

    $stmt = $db_conn->prepare($query);
    $stmt->execute();


}

header('location: http://localhost/fifaPhp/public/adjust_game.php?adjust=' . $match_id);