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
        <li role="presentation"><a href="createUser.php">Creeër gebruiker</a></li>
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
    $sql = "SELECT * FROM tbl_poules";
    $poules = $db_conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $db_conn->query($sql);
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
                          <li>Poulenaam {{$poule['naam']}}   Poulenummer {{$poule['id']}}</li>
                          <form action=\"../app/delete_manager.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"delete\" value=\"{$poule['id']}\">
                          <input class=\"delete\" type=\"submit\" value=\"delete\">
                          </form>
                          </ul>";
        }
        ?>
</section>

<?php
 require ('footer.php');

?>