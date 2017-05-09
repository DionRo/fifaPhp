<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/8/2017
 * Time: 02:31 PM
 */
require ('header.php');

require ('../app/database.php');

if (isset($_POST['adjust']))
{
    $id = $_POST['adjust'];
    $player = $db_conn->prepare("
 
      SELECT * 
 
      FROM `tbl_players`
 
      WHERE `id` = $id 
 
      ");
    $player->execute();
    $player = $player->fetch(PDO::FETCH_ASSOC);
}

?>



<header class="page-header">
    <h2>Update Players!</h2>
</header>

<?php
echo "
 
<form action=\"../app/adjust_player_manager.php\" method=\"POST\">
    <div class=\"form-group\">
        <input type=\"hidden\" name=\"id\" value=\"$id\">
    </div>
    <div class='form-group'>
        <label for=\"student_id\">studenten ID speler:</label>
        <input type=\"text\" class=\"form-control\" name=\"student_id\" value=\"{$player['student_id']}\">
    </div>
 
    ";
$teamsPlayers = $db_conn->prepare("SELECT * FROM tbl_teams");
$teamsPlayers->execute();
$teamsPlayers = $teamsPlayers->fetchAll(PDO::FETCH_ASSOC);

$playersTeam = $db_conn->prepare("SELECT * FROM tbl_teams WHERE id = {$player['team_id']}");
$playersTeam->execute();
$playersTeam = $playersTeam->fetch(PDO::FETCH_ASSOC);
?>

<div class="form-group">

    <label for="teamnummer">team</label>
    <select  class="form-control" name="teamnummer">
        <?php
        echo "
 
                    <option value=" . $playersTeam['id'] . ">
 
                        <p>" . $playersTeam['name'] . "</p>
 
                    </option>
 
                ";

        foreach($teamsPlayers as $teamsPlayer)
        {
            if ($teamsPlayer['id'] != $playersTeam['id'])
            {
                echo "
                            <option value=" . $teamsPlayer['id'] . "> 
                                <p>" . $teamsPlayer['name'] . "</p>        
                            </option>";
            }
        }

        ?>
    </select>

</div>

<?php
echo "
 
            <div class='form-group'>
                <label for=\"first_name\">Voornaam speler:</label>
                <input type=\"text\" class=\"form-control\" name=\"first_name\" value=\"{$player['first_name']}\">
            </div>
            <div class='form-group'>
                <label for=\"last_name\">Achternaam speler:</label>
                <input type=\"text\" class=\"form-control\" name=\"last_name\" value=\"{$player['last_name']}\">
            </div>
        ";
echo "<input type=\"submit\" value=\"Update uw team!\" class=\"btn btn-primary\">";
echo "</form>";
?>



<?php

if (isset($_GET['message']) != null)
{
    echo $_GET['message'];
}

?>

