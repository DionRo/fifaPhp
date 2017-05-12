<?php

require ('../app/database.php');
require ('header.php');
?>
    <header class="page-header">
        <h2>Bekijk hier uw wedstrijd data!</h2>
    </header>

    <?php if ( $_SESSION['adminLevel'] >= 2 ) :?>
        <h4>Selecteer match type</h4>

        <form action="../app/create_game_manager.php" method="POST">
<!--            <div class="radio">-->
<!--                <label><input type="radio" name="matchType" value="1">Poule</label>-->
<!--            </div>-->
<!--            <div class="radio">-->
<!--                <label><input type="radio" name="matchType" value="2">Best of 16</label>-->
<!--            </div>-->
<!--            <div class="radio">-->
<!--                <label><input type="radio" name="matchType" value="3">Best of 32</label>-->
<!--            </div>-->
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Genereer">
            </div>
        </form>
    <?php endif; ?>

<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>

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
            $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=5 ?(int)$_GET['per-page'] : 5;

            //Positioning
            $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

            //SQL
            $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = FALSE LIMIT {$start},{$perPage}");
            $matches->execute();
            $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

            $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $pages = ceil($total /$perPage);

            $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
            $teams->execute();
            $teams = $teams->fetchAll(PDO::FETCH_ASSOC);


            ?>

            <ul class="list-group">
                <?php
                    foreach ($matches as $match)
                    {
                        $id = $match['id'];

                        $team_id_a = $match['team_id_a'];
                        $team_id_b = $match['team_id_b'];

                        foreach ($teams as $team) {
                            if ($team_id_a == $team['id']) {
                                $name_team_a    = $team['name'];
                                $id_team_a      = $team['id'];
                            }
                            else if ($team_id_b == $team['id'])
                            {
                                $name_team_b = $team['name'];
                                $id_team_b = $team['id'];
                            }
                            else
                            {
                                if (!isset($name_team_a) && !isset($id_team_a)) {
                                    $name_team_a    = "ERROR";
                                    $id_team_a      = "-1";
                                }
                                else if (!isset($name_team_b) && !isset($id_team_b)) {
                                    $name_team_b    = "ERROR";
                                    $id_team_b      = "-1";
                                }
                            }
                        }

                        echo "<ul class=\"agenda-item\">
                                  <form action=\"adjust_game.php\" method=\"GET\">
                                      <input type=\"hidden\" name=\"adjust\" value=\"{$match['id']}\">
                                      <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                                         </form>
                                      <li>
                                        (MATCH: $id) $name_team_a (TEAM_ID: $id_team_a) - $name_team_b (TEAM_ID: $id_team_b)
                                      </li>
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
            $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=8 ?(int)$_GET['per-page'] : 8;

            //Positioning
            $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

            //SQL
            $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = TRUE LIMIT {$start},{$perPage}");
            $matches->execute();
            $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

            $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $pages = ceil($total /$perPage);

            $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
            $teams->execute();
            $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <ul class="list-group">
                <?php
                foreach ($matches as $match)
                {
                    $id = $match['id'];

                    $team_id_a = $match['team_id_a'];
                    $team_id_b = $match['team_id_b'];

                    foreach ($teams as $team) {
                        if ($team_id_a == $team['id']) {
                            $name_team_a    = $team['name'];
                            $id_team_a      = $team['id'];
                        }
                        else if ($team_id_b == $team['id'])
                        {
                            $name_team_b = $team['name'];
                            $id_team_b = $team['id'];
                        }
                        else
                        {
                            if (!isset($name_team_a) && !isset($id_team_a)) {
                                $name_team_a    = "ERROR";
                                $id_team_a      = "-1";
                            }
                            else if (!isset($name_team_b) && !isset($id_team_b)) {
                                $name_team_b    = "ERROR";
                                $id_team_b      = "-1";
                            }
                        }
                    }

                    $matchA = $match['score_team_a'];
                    $matchB = $match['score_team_b'];

                    echo "<ul class=\"agenda-item\">  
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
            <div class="row">
                <div class="col col-lg-5"></div>
                <div class="col col-lg-3 col-sm-3 col-md-3">
                    <?php

                    $tops = $db_conn->prepare("SELECT * FROM tbl_players ORDER BY goals DESC LIMIT 5");
                    $tops->execute();
                    $tops = $tops->fetchAll(PDO::FETCH_ASSOC);

                    echo "<h2>Topscoorders</h2>";

                    echo "  <table class=\"table\">
                            <tr>
                            <th>Spelernaam</th>
                            <th>Aantal goals</th> 
                            </tr>";

                    foreach($tops as $top){
                        echo "<tr><td>{$top['first_name']}{$top['last_name']}</td> <td>{$top['goals']}</td></tr>";
                    }

                    echo "</table>";
                    ?>
            </div>
        </div>
    </div>
</div>
<?php require ('footer.php'); ?>