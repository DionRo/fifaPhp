<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/8/2017
 * Time: 02:31 PM
 */

require ('header.php');
require ('../app/database.php');

if(isset($_POST['adjust'])){
    $id = $_POST['adjust'];
    $team = $db_conn->prepare("
      SELECT * 
      FROM `tbl_teams`
      WHERE `id` = $id 
      ");
    $team->execute();
    $team = $team->fetch(PDO::FETCH_ASSOC);


}
?>

    <header class="page-header">
        <h2>Update Teams!</h2>
    </header>
<?php
echo  "<form action=\"../app/adjust_team_manager.php\" method=\"POST\">
    <div class=\"form-group\">
        <input type=\"hidden\" name=\"id\" value=\"$id\">
        <label for=\"nameTeam\">Naam Team:</label>
        <input type=\"text\" class=\"form-control\" name=\"nameTeam\" value=\"{$team['name']}\">
    </div>";


$poules = $db_conn->prepare( "SELECT * FROM tbl_poules");
$poules->execute();
$poules = $poules->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
echo "  <input type=\"submit\" value=\"Update uw team!\" class=\"btn btn-primary\" name=\"update\">
        ";
echo "</form>";
?>

<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>
