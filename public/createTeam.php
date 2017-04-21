<?php

session_start();

if (!isset($_SESSION['LoggedIn']) || !$_SESSION['LoggedIn']){
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}

require ('header.php');
require ('../app/database.php');
?>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="beheer.php">Beheer</a></li>
        <li role="presentation" class="active"><a href="createTeam.php">Teams</a></li>
        <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation"><a href="createPoules.php">Poules</a></li>
        <li role="presentation"><a href="createSchema.php">Maak Schema</a></li>
        <li role="presentation"><a href="logout.php">Logout</a></li>
    </ul>
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
        <div class="form-group">
            <label for="pouleID">Poule nummer:</label>
            <input type="number" class="form-control" name="pouleID" placeholder="Vul hier het poule nummer in in!">
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
    $sql = "SELECT * FROM tbl_teams";
    $teams = $db_conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $db_conn->query($sql);
    ?>

    <ul class="list-group">
        <?php
        foreach ($teams as $team)
        {
            $id="{$team['id']}";
            echo "<ul class=\"agenda-item\">
                          <form action=\"../app/adjust_form.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"adjust\" value=\"{$team['id']}\">
                          <input type=\"hidden\" name=\"adjust\" value=\"{$team['name']}\">
                          <input type=\"hidden\" name=\"adjust\" value=\"{$team['poule_id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                          </form>
                          <li>{$team['name']}</li>
                          <form action=\"../app/delete_manager.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"delete\" value=\"{$team['id']}\">
                          <input class=\"delete\" type=\"submit\" value=\"delete\">
                          </form>
                          </ul>";
        }
        ?>
</section>

<?php
 require ('footer.php');

?>