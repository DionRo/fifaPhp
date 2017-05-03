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
        <li role="presentation" class="active"><a href="createGame.php">Maak Schema</a></li>
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
        <h2>Voeg hier uw nieuwe producten toe!</h2>
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
            $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=5 ?(int)$_GET['per-page'] : 5;

            //Positioning
            $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

            //SQL
            $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches LIMIT {$start},{$perPage}");
            $matches->execute();
            $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

//            echo '$matches:';
//            var_dump($matches);

            $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
            $teams->execute();
            $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

//            echo '$teams:';
//            var_dump($teams);

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
                          <form action=\"../app/adjust_form.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"adjust\" value=\"{$match['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>$name_team_a - $name_team_b</li>
                          <form action=\"../app/delete_manager.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"delete\" value=\"{$match['id']}\">
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
        </div>
        <div class="tab-pane fade" id="results">
        </div>
        <div class="tab-pane fade" id="poule-results">
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