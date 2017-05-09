<?php

require ('header.php');
require ('../app/database.php');
?>
    <header class="page-header">
        <h2>Voeg hier uw nieuwe teams toe!</h2>
    </header>
<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>
<section>
    <form action="../app/team_manager.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nameTeam">Naam Team:</label>
            <input type="text" class="form-control" name="nameTeam" placeholder="Vul hier uw teamnaam in!">
        </div>
        <?php
        $poules = $db_conn->prepare( "SELECT * FROM tbl_poules");
        $poules->execute();
        $poules = $poules->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="form-group">
            <label for="pouleID">Poule:</label>
            <select  class="form-control" name="pouleID">
                <?php

                foreach ($poules as $poule)
                {
                    echo "<option value=".$poule['id']."> 
                        
                            <p>".$poule['naam']."</p>        
                            </option>";

                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Creeër uw team!" class="btn btn-primary" name="register">
        </div>
            <!-- alle datums in een optie veld -->
    </form>

    <header class="page-header">
        <h2>Huidige teams</h2>
    </header>

        <?php

        // Userinput
        $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
        $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=4  ?(int)$_GET['per-page'] : 4;

        //Positioning
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        //SQL
        $teams = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_teams LIMIT {$start},{$perPage}");
        $teams->execute();
        $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

        $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
        $pages = ceil($total /$perPage);
        ?>

        <ul class="list-group">
            <?php
            foreach ($teams as $team)
            {
                $id="{$team['id']}";
                echo "<ul class=\"agenda-item\">
                          <form action=\"   adjust_team.php\" method=\"POST\">
                          <input type=\"hidden\" name=\"adjust\" value=\"{$team['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>{$team['name']}</li>
                          <form action=\"../app/delete_team_manager.php\" method=\"POST\">
                          <input type=\"hidden\" name=\"delete\" value=\"{$team['id']}\">
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