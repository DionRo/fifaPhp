<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/8/2017
 * Time: 02:31 PM
 */
require ('header.php');

require ('../app/database.php');
if (isset($_POST['play']))
{
    $id = $_POST['play'];
    $matches = $db_conn->prepare("
 
      SELECT * 
      FROM `tbl_matches`
      WHERE `id` = $id 
 
      ");
    $matches->execute();
    $matches = $matches->fetch(PDO::FETCH_ASSOC);
}

?>

<header class="page-header">
    <h2>Update Speeltijd!</h2>
</header>

<?php
echo "
<form action='../app/change_game_manager.php' method='POST'>
            <div class='form-group'>
                <label for=\"date\">Speeltijd (FORMAT: jjjj-mm-dd --:--:--):</label>
                <input type=\"hidden\" name=\"id\" value=\"$id\">
                <input type=\"datetime\" class=\"form-control\" name=\"date\" placeholder='jjjj-mm-dd --:--:--'>
            </div>
        ";
echo "<input type=\"submit\" value=\"Update uw speeltijd!\" class=\"btn btn-primary\">";
echo "</form>";
?>



<?php

if (isset($_GET['message']) != null)
{
    echo $_GET['message'];
}

?>

