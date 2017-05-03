<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/3/2017
 * Time: 03:37 PM
 */

session_start();

if (!isset ($_SESSION['adminLevel'])  || !$_SESSION['adminLevel']) {
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}

require ('header.php');
require ('../app/database.php');


$id = $_POST['adjust'];

$matches = $db_conn->prepare ("SELECT * FROM tbl_matches WHERE id = $id");
$matches->execute();
$matches = $matches->fetchAll(PDO::FETCH_ASSOC);

$teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
$teams->execute();
$teams = $teams->fetchAll(PDO::FETCH_ASSOC);


?>

                <?php
                foreach ($matches as $match)
                {
                    $id="{$match['id']}";

                    $name_team_a = $teams[$match['team_id_a']]['name'];
                    $name_team_b = $teams[$match['team_id_b']]['name'];


                    echo "
                        <div class='row text-center'>
                            <div class='col col-lg-2 col-md-2'></div>
                            <div class='col col-lg-3 col-md-4 col-sm-3'>
                                <h2>$name_team_a</h2>
                            </div>
                            <div class='col col-lg-2'>

                            </div>
                            <div class='col col-lg-3 col-md-4 col-sm-3'>
                                <h2>$name_team_b</h2>
                            </div>
                            <div class='col col-lg-2  col-md-2'></div>
                        </div>
                        ";
                };

                foreach ($matches as $match)
                {
                    $id="{$match['id']}";

//                    echo "<pre>";
//                    var_dump($match);
//                    echo "</pre>";

                    $score_team_a = $match['score_team_a'];
                    $score_team_b = $match['score_team_b'];

                    echo "
                        <div class='row text-center'>
                            <div class='col col-lg-3 col-md-2'></div>
                            <div class='col col-lg-2 col-md-4 col-sm-3'>
                                <h2>$score_team_a</h2>
                            </div>
                            <div class='col col-lg-2'>
                               <h2>-</h2>
                            </div>
                            <div class='col col-lg-2 col-md-4 col-sm-3'>
                                <h2>$score_team_b</h2>
                            </div>
                            <div class='col col-lg-3  col-md-2'></div>
                        </div>
                        ";
};
                ?>

                <?php
                $players = $db_conn->prepare( "SELECT * FROM tbl_players");
                $players->execute();
                $players = $players->fetchAll(PDO::FETCH_ASSOC);

                ?>

                    <div class="form-group col col-lg-5">
                        <label for="player">Players</label>
                        <select  class="form-control" name="player">
                            <?php

                            foreach ($players as $player)
                            {
                                echo "<option value=".$player['id']."> 
                                        
                                            <p>{$player['first_name']} {$player['last_name']}</p>        
                                            </option>";

                            }
                            ?>
                        </select>
                        <div class="col col-lg-4"></div>
                        <div class="col col-lg-1">
                            <form  action="../app/adjust_game_manager.php" method="POST">
                                <input value="add" type="submit" name="add" class="btn btn-danger">
                            </form>
                        </div>
                    </div>



<?php
require ('footer.php');
?>