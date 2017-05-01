<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/1/2017
 * Time: 11:15 AM
 */
session_start();
require ('header.php');

if (!isset ($_SESSION['adminLevel']) ||  $_SESSION['adminLevel'] != "2")
{

    $ErrorMessage = "<strong>U bent geen beheerder, vraag de Elton boekhout voor een upgrade</strong>";
    header("Location:  beheer.php?message=$ErrorMessage");
    die;
}


require ('../app/database.php');
?>
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="beheer.php">Beheer</a></li>
        <li role="presentation"><a href="createTeam.php">Teams</a></li>
        <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation"><a href="createPoules.php">Poules</a></li>
        <li role="presentation"><a href="createSchema.php">Maak Schema</a></li>
        <?php
            if ( $_SESSION['adminLevel'] == "2" ) {
                echo "
                        <li role=\"presentation\" class=\"active\"><a href=\"createUser.php\">Creeër gebruiker</a></li>
                ";
            }
        ?>
        <li role="presentation"><a href="logout.php">Logout</a></li>
    </ul>
    <header class="page-header">
        <h2>Voeg hier uw nieuwe gebruikers toe!</h2>
    </header>
<?php
if (isset($_GET['message'])!= null )
{
    echo $_GET['message'];
}
?>
    <section>
        <form action="../app/user_manager.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" class="form-control" name="name" placeholder="Vul hier de naam van de persoon in!">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" placeholder="Vul hier de email van de persoon in!">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" class="form-control" name="password" placeholder="Vul hier het wachtwoord van de persoon in!">
            </div>
            <div class="form-group">
                <label for="adminlevel">Admin level:</label>
                <input type="number" min="1" max="2" class="form-control" name="adminlevel" placeholder="adminlevel (2 is dezelfde rechten als u 1 is standaart recht)">
            </div>


            <div class="form-group">
                <input type="submit" value="Creeër een gebruiker!" class="btn btn-primary" name="register">
            </div>
            <!-- alle datums in een optie veld -->
        </form>
        <header class="page-header">
            <h2>Huidige gebruikers</h2>
        </header>


        <?php

        // Userinput
        $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
        $perPage = isset($_GET['per-page'])&& $_GET['per-page'] <=4  ?(int)$_GET['per-page'] : 4;

        //Positioning
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        //SQL
        $users = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_users LIMIT {$start},{$perPage}");
        $users->execute();
        $users = $users->fetchAll(PDO::FETCH_ASSOC);

        $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
        $pages = ceil($total /$perPage);
        ?>


        <ul class="list-group">
            <?php
            foreach ($users as $user)
            {
                $id="{$user['id']}";
                echo "<ul class=\"agenda-item\">
                          <form action=\"../app/adjust_form.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"adjust\" value=\"{$user['id']}\">
                          <input class=\"adjust\" type=\"submit\" value=\"adjust\">
                             </form>
                          <li>Gebruikersemail {{$user['email']}}</li>
                          <form action=\"../app/delete_manager.php\" method='\"POST\"'>
                          <input type=\"hidden\" name=\"delete\" value=\"{$user['id']}\">
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

