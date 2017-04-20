<?php

session_start();

if (!isset($_SESSION['LoggedIn']) || !$_SESSION['LoggedIn']){
    $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
    header("Location: ../index.php?message=$ErrorMessage");
    die;
}

require ('header.php');
?>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="beheer.php">Beheer</a></li>
        <li role="presentation" class="active"><a href="create.php">Teams</a></li>
        <li role="presentation"><a href="createPlayer.php">Spelers</a></li>
        <li role="presentation"><a href="createPoules.php">Poules</a></li>
        <li role="presentation"><a href="createSchema.php">Maak Schema</a></li>
        <li role="presentation"><a href="logout.php">Logout</a></li>
    </ul>
    <header class="page-header">
        <h2>Voeg hier uw nieuwe producten toe!</h2>
    </header>
<section>
    <form action="../app/creator.php" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="titel">Titel:</label>
            <input type="text" class="form-control" name="titel" placeholder="Vul hier uw titel in!">
        </div>
        <div class="form-group">
            <label for="prijs">Prijs:</label>
            <input type="text" class="form-control" name="prijs" placeholder="Vul hier uw prijs in!">
        </div>
        <div class="form-group">
            <label for="categorie">Categorie</label>
            <select  class="form-control" name="categorie">
                <option value="0">Selecteer hier uw categorie</option>
                <option value="1">Sigaren</option>
                <option value="2">E-Sigaret</option>
                <option value="3">E-Sigaret Vloeistof</option>
                <option value="4">E-Sigaret Accessoires</option>
                <option value="5">Wol</option>
                <option value="6">Overige</option>
            </select>
        </div>
        <div class="form-group">
            <label for="beschrijving">Beschrijving:</label>
            <textarea type="text" class="form-control" name="beschrijving" placeholder="Vul hier uw beschrijving!"></textarea>
        </div>
        <div class="form-group">
            <label for="fileToUpload">Upload uw foto:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" value="Creeër uw product!" class="btn btn-primary" name="register">
        </div>
            <!-- alle datums in een optie veld -->
    </form>
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