<?php

session_start();

if (!isset ($_SESSION['adminLevel'])  || !$_SESSION['adminLevel'])
{
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}
require ('../app/database.php');
require ('header.php');
?>
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="beheer.php">Beheer</a></li>
        <li role="presentation"><a href="createTeam.php">Teams</a></li>
        <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation" class="active"><a href="createGame.php">Wedstrijd data</a></li>
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
        <h2>Bekijk hier uw wedstrijd data!</h2>
    </header>

    <ul class="nav nav-tabs" id="filter" role="tablist">
        <li role="presentation" class="active">
            <a href="#score" id="score-tab" role="tab" data-toggle="tab" aria-controls="score" aria-expanded="true">Score</a>
        </li>
        <li role="presentation" class="">
            <a href="#results" role="tab" id="results-tab" data-toggle="tab" aria-controls="results" aria-expanded="false">Results</a>
        </li>
        <li role="presentation" class="">
            <a href="#poule-results" role="tab" id="poule-results-tab" data-toggle="tab" aria-controls="poule-results" aria-expanded="false">Poule results</a>
        </li>
    </ul>
    <div class="tab-content" id="tab-content">
        <div class="tab-pane active" id="score">
            <?php

            // Userinput
            $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
            $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=4 ?(int)$_GET['per-page'] : 4;

            //Positioning
            $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

            //SQL
            $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = FALSE LIMIT {$start},{$perPage}");
            $matches->execute();
            $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

            $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
            $teams->execute();
            $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

            $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $pages = ceil($total /$perPage);
            ?>

            <ul class="list-group">
                <?php
                foreach ($matches as $match)
                {
                    $id="{$match['id']}";

                    $name_team_a = $teams[$match['team_id_a']]['name'];
                    $name_team_b = $teams[$match['team_id_b']]['name'];


                    echo "<ul class=\"agenda-item\">
                          <form action=\"adjust_game.php\" method=\"POST\">
                          <input type=\"hidden\" name=\"adjust\" value=\"{$match['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>$name_team_a - $name_team_b</li>
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
        </div>
        <div class="tab-pane fade" id="results">
            <?php

            // Userinput
            $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
            $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=4 ?(int)$_GET['per-page'] : 4;

            //Positioning
            $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

            //SQL
            $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = TRUE LIMIT {$start},{$perPage}");
            $matches->execute();
            $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

            $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
            $teams->execute();
            $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

            $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $pages = ceil($total /$perPage);
            ?>

            <ul class="list-group">
                <?php
                foreach ($matches as $match)
                {
                    $id="{$match['id']}";

                    $name_team_a = $teams[$match['team_id_a']]['name'];
                    $name_team_b = $teams[$match['team_id_b']]['name'];

                    $matchA = $match['score_team_a'];
                    $matchB = $match['score_team_b'];

                    echo ">
                             </form>
                          <li>$name_team_a {.$matchA.} - $name_team_b {.$matchB.}</li>
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
        </div>
        <div class="tab-pane fade" id="poule-results">
            <div class="row">
                <div class="col col-lg-3 col-sm-3 col-md-3">

                    <?php
                    $pouleA = $db_conn->prepare ("SELECT * FROM tbl_poules WHERE naam = 'Poule A'");
                    $pouleA->execute();
                    $pouleA = $pouleA->fetchAll(PDO::FETCH_ASSOC);

                    $teamsPoulesA = $db_conn->prepare("SELECT * FROM tbl_teams WHERE poule_id = 1 ORDER BY points DESC");
                    $teamsPoulesA->execute();
                    $teamsPoulesA = $teamsPoulesA->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>{$pouleA[0]['naam']}</h2>";

                    echo "  <table class=\"table\">
                            <tr>
                            <th>Team</th>
                            <th>Points</th> 
                            </tr>";

                    foreach($teamsPoulesA as $teams){
                        echo "<tr><td>{$teams['name']}</td> <td>{$teams['points']}</td></tr>";
                    }

                    echo "</table>";
                    ?>


                </div>
                <div class="col col-lg-3 col-sm-3 col-md-3">
                    <?php
                    $pouleB = $db_conn->prepare ("SELECT * FROM tbl_poules WHERE naam = 'Poule B'");
                    $pouleB->execute();
                    $pouleB = $pouleB->fetchAll(PDO::FETCH_ASSOC);

                    $teamsPoulesB = $db_conn->prepare("SELECT * FROM tbl_teams WHERE poule_id = 2 ORDER BY points DESC");
                    $teamsPoulesB->execute();
                    $teamsPoulesB = $teamsPoulesB->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>{$pouleB[0]['naam']}</h2>";

                    echo "  <table class=\"table\">
                            <tr>
                            <th>Team</th>
                            <th>Points</th> 
                            </tr>";

                    foreach($teamsPoulesB as $teams){
                        echo "<tr><td>{$teams['name']}</td> <td>{$teams['points']}</td></tr>";
                    }

                    echo "</table>";
                    ?>


                </div>
                <div class="col col-lg-3 col-sm-3 col-md-3">
                    <?php
                    $pouleC = $db_conn->prepare ("SELECT * FROM tbl_poules WHERE naam = 'Poule C'");
                    $pouleC->execute();
                    $pouleC = $pouleC->fetchAll(PDO::FETCH_ASSOC);


                    $teamsPoulesC = $db_conn->prepare("SELECT * FROM tbl_teams WHERE poule_id = 3 ORDER BY points DESC");
                    $teamsPoulesC->execute();
                    $teamsPoulesC = $teamsPoulesC->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>{$pouleC[0]['naam']}</h2>";

                    echo "  <table class=\"table\">
                            <tr>
                            <th>Team</th>
                            <th>Points</th> 
                            </tr>";

                    foreach($teamsPoulesC as $teams){
                        echo "<tr><td>{$teams['name']}</td> <td>{$teams['points']}</td></tr>";
                    }

                    echo "</table>";
                    ?>

                </div>

                <div class="col col-lg-3 col-sm-3 col-md-3">
                    <?php
                    $pouleD = $db_conn->prepare ("SELECT * FROM tbl_poules WHERE naam = 'Poule D'");
                    $pouleD->execute();
                    $pouleD = $pouleD->fetchAll(PDO::FETCH_ASSOC);


                    $teamsPoulesD = $db_conn->prepare("SELECT * FROM tbl_teams WHERE poule_id = 4 ORDER BY points DESC");
                    $teamsPoulesD->execute();
                    $teamsPoulesD = $teamsPoulesD->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>{$pouleD[0]['naam']}</h2>";

                    echo "  <table class=\"table\">
                            <tr>
                            <th>Team</th>
                            <th>Points</th> 
                            </tr>";

                    foreach($teamsPoulesD as $teams){
                        echo "<tr><td>{$teams['name']}</td> <td>{$teams['points']}</td></tr>";
                    }

                    echo "</table>";
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['message'])!= null )
    {
        echo $_GET['message'];
    }
    ?>
</section>

<?php
 require ('footer.php');

?>