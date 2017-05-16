<?php
/**
 * Created by PhpStorm.
 * User: Dion
 * Date: 30-3-2017
 * Time: 11:05
 */

require ('header.php');
require ('../app/database.php');

?>
<?php var_dump($_SESSION); ?>

<header class="page-header">
    <h2>Welkom bij de beheerpgagina van FIFA</h2>
</header>
<?php
    $sqlCounter = "SELECT COUNT(id) AS total FROM tbl_teams";
    $results = $db_conn->query($sqlCounter);
    $db_conn->query($sqlCounter);

    foreach ($results as $result)
    {
        echo '<li class="list-group-item li-content center">Er zijn momenteel '.$result['total'].' teams aanwezig in de database!</li>';
    }
?>
<br>
<?php
$sqlCounter2 = "SELECT COUNT(id) AS total FROM tbl_players";
$results = $db_conn->query($sqlCounter2);
$db_conn->query($sqlCounter);

foreach ($results as $result)
{
    echo '<li class="list-group-item li-content center">Er zijn momenteel '.$result['total'].' spelers aanwezig in de database!</li>';
}
?>
<br>
<?php
$sqlCounter3 = "SELECT COUNT(id) AS total FROM tbl_poules";
$results = $db_conn->query($sqlCounter3);
$db_conn->query($sqlCounter);

foreach ($results as $result)
{
    echo '<li class="list-group-item li-content center">Er zijn momenteel '.$result['total'].' poules aanwezig in de database!</li>';
}
?>
<br>
<?php
$sqlCounter4 = "SELECT COUNT(id) AS total FROM tbl_matches";
$results = $db_conn->query($sqlCounter4);
$db_conn->query($sqlCounter);

foreach ($results as $result)
{
    echo '<li class="list-group-item li-content center">Er zijn momenteel '.$result['total'].' matches aanwezig in database!</li>';
}
?>
    <div class="row">

        <form class="col col-lg-2" action="../app/beheer_manager.php" method="post" name="upload_excel"
              enctype="multipart/form-data">
            <div class="form-group">
                <div class="">
                    <input type="submit" name="export-matches" class="btn btn-success" value="Exporteer matches"/>
                </div>
            </div>
        </form>
        <form class="col col-lg-2" action="../app/beheer_manager.php" method="post" name="upload_excel"
              enctype="multipart/form-data">
            <div class="form-group">
                <div class="">
                    <input type="submit" name="export-teams" class="btn btn-success" value="Exporteer Teams"/>
                </div>
            </div>
        </form>
        <form class="col col-lg-2" action="../app/beheer_manager.php" method="post" name="upload_excel"
              enctype="multipart/form-data">
            <div class="form-group">
                <div class="">
                    <input type="submit" name="export-players" class="btn btn-success" value="Exporteer Players"/>
                </div>
            </div>
        </form>
        <form class="col col-lg-2" action="../app/beheer_manager.php" method="post" name="upload_excel"
              enctype="multipart/form-data">
            <div class="form-group">
                <div class="">
                    <input type="submit" name="export-users" class="btn btn-success" value="Exporteer Users"/>
                </div>
            </div>
        </form>
    </div>

        <?php
        if (isset($_GET['message'])!= null )
        {
            echo $_GET['message'];
        }
        ?>
<?php require ('footer.php'); ?>
