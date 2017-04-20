<?php
/**
 * Created by PhpStorm.
 * User: Dion
 * Date: 30-3-2017
 * Time: 11:05
 */

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
    <li role="presentation" class="active"><a href="beheer.php">Beheer</a></li>
    <li role="presentation"><a href="create.php">Teams</a></li>
    <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
    <li role="presentation"><a href="createPoules.php">Poules</a></li>
    <li role="presentation"><a href="createSchema.php">Maak Schema</a></li>
    <li role="presentation"><a href="logout.php">Logout</a></li>
</ul>
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



<section>

        <?php
        if (isset($_GET['message'])!= null )
        {
            echo $_GET['message'];
        }
        ?>

    </ul>
</section>

<?php require ('footer.php'); ?>
