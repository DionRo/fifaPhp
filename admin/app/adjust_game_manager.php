<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/3/2017
 * Time: 03:37 PM
 */

require ('../app/database.php');

if(isset($_POST['add'])){
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


// Hierin worden de gegevens in tbl_scores gestopt
    $query = 'INSERT INTO tbl_scores (`player_id`,`match_id`) VALUES (:player, :match_id)';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['player' => $player , 'match_id' => $match_id]);




}elseif (isset($_POST['remove'])){
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

    $query = 'DELETE FROM tbl_scores WHERE player_id = :player_id AND match_id = :match_id LIMIT 1';
    $stmt = $db_conn->prepare($query);
    $stmt->execute(['player_id' => $player, 'match_id' => $match_id]);
}

header("Location: ../public/adjust_game.php?adjust=$match_id");