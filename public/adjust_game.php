<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/3/2017
 * Time: 03:37 PM
 */
session_start();

if (!isset($_SESSION['adminLevel']) || !$_SESSION['adminLevel'])
{
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}

require ('header.php');

require ('../app/database.php');

$id = $_GET['adjust'];
$matches = $db_conn->prepare("SELECT * FROM tbl_matches WHERE id = $id");
$matches->execute();
$matches = $matches->fetchAll(PDO::FETCH_ASSOC);


$teams = $db_conn->prepare("SELECT * FROM tbl_teams");
$teams->execute();
$teams = $teams->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

foreach($matches as $match)
{
$id = "{$match['id']}";

    foreach ( $teams as $team ) {
        if ( $team['id'] == $match['team_id_a'] ) {
            $name_team_a = $team['name'];
        } else if ( $team['id'] == $match['team_id_b'] ) {
            $name_team_b = $team['name'];
        }
    }

//    $name_team_a = $teams[$match['team_id_a']]['name'];
//      $name_team_b = $teams[$match['team_id_b']]['name'];

$team_id_a = intval($match['team_id_a']);
$team_id_b = intval($match['team_id_b']);
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

foreach($matches as $match)
{
    $id = "{$match['id']}";
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
$players = $db_conn->prepare("SELECT * FROM tbl_players WHERE team_id = $team_id_a");
$players->execute();
$players = $players->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col col-lg-2"></div>
    <div class="form-group col col-lg-5">
        <label for="player">Players <?php echo $name_team_a ?></label>
        <form  action="../app/adjust_game_manager.php" method="POST" class="form-inline">
            <select  class="form-control" name="player">
                <?php

                foreach($players as $player)
                {
                    echo "<option value=" . $player['id'] . ">                          
                        <p>{$player['first_name']} {$player['last_name']}</p>        
                        </option>";
                }

                ?>
            </select>
            <?php echo "<input type=\"hidden\" name=\"match_id\" value=\"$id\">"; ?>
            <input type="hidden" name="team" value="a">
            <input value="add" type="submit" name="add" class="btn btn-danger">
            <input value="remove" type="submit" name="remove" class="btn btn-danger">
        </form>
    </div>
    <?php
    $players = $db_conn->prepare("SELECT * FROM tbl_players WHERE team_id = $team_id_b");
    $players->execute();
    $players = $players->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="form-group col col-lg-5">
        <label for="player">Players <?php echo $name_team_b ?></label>
        <form  action="../app/adjust_game_manager.php" method="POST" class="form-inline">
            <select  class="form-control" name="player">
                <?php

                foreach($players as $player)
                {
                    echo "<option value=" . $player['id'] . ">                          
                        <p>{$player['first_name']} {$player['last_name']}</p>        
                        </option>";
                }

                ?>
            </select>
            <?php echo "<input type=\"hidden\" name=\"match_id\" value=\"$id\">"; ?>
            <input type="hidden" name="team" value="b">
            <input value="add" type="submit" name="add" class="btn btn-danger">
            <input value="remove" type="submit" name="remove" class="btn btn-danger">
        </form>
    </div>
</div>
    <div class="row">
        <div class="col col-lg-5"></div>
            <div class="submit-button col col-lg-2">
                <form action="../app/button_manager.php" METHOD="POST">
                    <?php echo "<input type=\"hidden\" name=\"match_id\" value=\"$id\">"; ?>
                    <input value="Terug" type="submit" name="back" class="btn btn-danger">
                    <input value="Submit" type="submit" name="submit" class="btn btn-danger" >
                </form>
            </div>
        <div class="col col-lg-5"></div>
    </div>


<?php
require ('footer.php');

?>
