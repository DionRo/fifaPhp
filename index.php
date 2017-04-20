<?php
/**
 * Created by PhpStorm.
 * User: Crucial Designs (Dion Rodie & Youri van der Sande)
 * Date: 04/06/2017
 * Time: 1:09 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Fifa, Beheerpagina</title>
</head>
<body class="BG">
<header class="login-header center">
    <div class="menu-container container">
        <h1><span class="title-span">Beh</span>eer <span class="title-span">Fif</span>a</h1>
        <div class="forms">
            <div class="form-choose center">
                <ul>
                    <li onclick="currentMenu(2)">Login</li>
                </ul>
            </div>
            <div class="menu"></div>
            <form class="login menu" action="app/account_manager.php?action=login" method="POST">
                <div class="form-group">
                    <label for="email"></label>
                    <input type="email" name="email" id="usermail" placeholder="email" required>
                </div>
                <div class="form-group">
                    <label for="pass"></label>
                    <input type="password" name="pass" id="password" placeholder="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="login" class="submit">
                </div>
            </form>
            <?php

            if (isset($_GET['message'])){
                echo "<p class=\"message\"> {$_GET['message']} </p>";
            }
            ?>
        </div>
    </div>
</header>
<script>
    var menuIndex = 1;
    showMenu(menuIndex);

    function plusMenu(n) {
        showMenu(menuIndex += n);
    }

    function currentMenu(n) {
        showMenu(menuIndex = n);
    }

    function showMenu(n) {
        var i;
        var x = document.getElementsByClassName("menu");
        if (n > x.length) {menuIndex = 1}
        if (n < 1) {menuIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[menuIndex-1].style.display = "block";
    }
</script>






</body>
</html>
