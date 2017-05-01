<?php

session_start();

if (!isset ($_SESSION['adminLevel'])  || !$_SESSION['adminLevel'])
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
        <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation" class="active"><a href="createPoules.php">Poules</a></li>
        <li role="presentation"><a href="createSchema.php">Maak Schema</a></li>
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
        <h2>Voeg hier uw nieuwe poules toe!</h2>
    </header>
<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>
<section>
    <form action="../app/poule_manager.php" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="poulname">Poulnaam:</label>
            <input type="text" class="form-control" name="poulname" placeholder="Vul hier uw titel in!">
        </div>
        <div class="form-group">
            <input type="submit" value="Creeër uw poule!" class="btn btn-primary" name="register">
        </div>
            <!-- alle datums in een optie veld -->
    </form>
    <header class="page-header">
        <h2>Huidige poules</h2>
    </header>
        <?php

        // Userinput
        $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
        $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=6  ?(int)$_GET['per-page'] : 6;

        //Positioning
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        //SQL
        $poules = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_poules  LIMIT {$start},{$perPage}");
        $poules->execute();
        $poules = $poules->fetchAll(PDO::FETCH_ASSOC);

        $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
        $pages = ceil($total /$perPage);
        ?>

        <ul class="list-group">
            <?php
            foreach ($poules as $poule)
            {
                $id="{$poule['id']}";
                echo "<ul class=\"agenda-item\">
                          <form action=\"../app/adjust_form.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"adjust\" value=\"{$poule['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>Poulnaam {{$poule['naam']}}</li>
                          <form action=\"../app/delete_manager.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"delete\" value=\"{$poule['id']}\">
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
</section>

<?php
 require ('footer.php');

?>