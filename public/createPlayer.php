<?php

session_start();

if (!isset ($_SESSION['adminLevel']) || !$_SESSION['adminLevel'])
{
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}

require ('header.php');
require ('../app/database.php');
?>
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="beheer.php">Beheer</a></li>
        <li role="presentation"><a href="createTeam.php">Teams</a></li>
        <li role="presentation" class="active"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation"><a href="createGame.php">Wedstrijd data</a></li>
        <?php
        if ( $_SESSION['adminLevel'] == "2" ) {
            echo "
                        <li role=\"presentation\"><a href=\"createUser.php\">Creeër gebruiker</a></li>
                ";
        }
        ?>
        <li role="presentation"><a href="logout.php">Logout</a></li>
    </ul>

    <header class="page-header">
        <h2>Voeg hier uw nieuwe spelers toe!</h2>
    </header>
<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>
<section>
    <form action="../app/player_manager.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="studentnummer">Studentnummer:</label>
            <input type="text" class="form-control" name="studentnummer" placeholder="Vul hier uw studentnummer in!">
        </div>
        <div class="form-group">
            <label for="voornaam">Voornaam:</label>
            <input type="text" class="form-control" name="voornaam" placeholder="Vul hier uw voornaam in!">
        </div>
        <div class="form-group">
            <label for="achternaam">Achternaam:</label>
            <input type="text" class="form-control" name="achternaam" placeholder="Vul hier uw achternaam in!">
        </div>

        <?php
        $teamsPlayers = $db_conn->prepare( "SELECT * FROM tbl_teams");
        $teamsPlayers->execute();
        $teamsPlayers = $teamsPlayers->fetchAll(PDO::FETCH_ASSOC);

        ?>

            <div class="form-group">
                <label for="teamnummer">team</label>
                <select  class="form-control" name="teamnummer">
                    <?php

                    foreach ($teamsPlayers as $teamsPlayer)
                    {
                      echo "<option value=".$teamsPlayer['id']."> 
                        
                            <p>".$teamsPlayer['name']."</p>        
                            </option>";

                    }
                    ?>
                </select>
            </div>


            <div class="form-group">
            <input type="submit" value="Creeër uw speler!" class="btn btn-primary" name="register">
        </div>
            <!-- alle datums in een optie veld -->
    </form>
    <header class="page-header">
        <h2>Huidige spelers</h2>
    </header>


    <?php

    // Userinput
    $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
    $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=5 ?(int)$_GET['per-page'] : 5;

    //Positioning
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    //SQL
    $players = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_players ORDER BY team_id ASC LIMIT {$start},{$perPage}");
    $players->execute();
    $players = $players->fetchAll(PDO::FETCH_ASSOC);

    $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
    $pages = ceil($total /$perPage);
    ?>

    <ul class="list-group">
        <?php
        foreach ($players as $player)
        {
            $id="{$player['id']}";
            echo "<ul class=\"agenda-item\">
                          <form action=\"../app/adjust_game.php\" method=\"POST\">
                          <input type=\"hidden\" name=\"adjust\" value=\"{$player['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>Studentnummer {{$player['student_id']}}   Voornaam {{$player['first_name']}} Achternaam {{$player['last_name']}}
                          teamnummer {{$player['team_id']}}</li>
                          <form action=\"../app/delete_manager.php\" method=\"POST\">
                          <input type=\"hidden\" name=\"delete\" value=\"{$player['id']}\">
                          <input class=\"delete\" type=\"submit\" value=\"delete\">
                          </form>
                          </ul>";
        }


        ?>
    </ul>
    <div class="pagenation">
<?php  for ($x =1; $x <= $pages; $x++) :?>
    <a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage ?>"><?php  echo $x; ?></a>
<?php endfor; ?>
    </div>
</section>

<?php
 require ('footer.php');

?>