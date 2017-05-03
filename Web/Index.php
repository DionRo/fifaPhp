<?php
/**
 * Created by PhpStorm.
 * User: kutay
 * Date: 5/1/2017
 * Time: 14:03
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="scripts/scroll.js"></script>
    <link rel="stylesheet" href="style/Main_Web_CSS.css">
    <title>FiFa Toernooi</title>
</head>
<body>
<header id="Top-Header">

    <div class="main-head" id="main-head">
        <div class="logo">
            <h1 ">FIFA Radius College Toernooi</h1>
        </div>

        <nav>

            <a href="">Home</a>
            <a href="#intro">Intro</a>
            <a href="#Group">Groep 3</a>
            <a href="#Tournement">Toernooi</a>
            <a href="">Teams</a>
            <a href="../index.php">Login</a>
        </nav>
    </div>
</header>

<div class="container">

    <div class="intro" id="intro">
        <h2>Welcome</h2>

        <div class="Content">

            <div class="description">

                <h3>Description</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ex nemo voluptates. Delectus dolorem facilis, ipsam laudantium nihil sapiente ullam vero voluptas. Asperiores dignissimos iure molestias nam nobis quam soluta.</p>
            </div>

            <div class="extra">

                <h3>Extra</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam aperiam cupiditate debitis dignissimos dolor doloremque doloribus, eveniet, iusto nostrum perferendis possimus quibusdam repudiandae saepe totam unde vitae! Explicabo, mollitia.</p>
            </div>
        </div>

        <h2>Some Picture</h2>

        <div class="w3-content w3-section" style="max-width:500px" style="max-height: 300px">
            <img class="mySlides" src="Img/Slideshow/slide_01.jpg" style="width:100%">
            <img class="mySlides" src="Img/Slideshow/slide_02.jpg" style="width:100%">
            <img class="mySlides" src="Img/Slideshow/slide_03.jpg" style="width:100%">
        </div>

        <script>
            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}
                x[myIndex-1].style.display = "block";
                setTimeout(carousel, 2000); // Change image every 2 seconds
            }
        </script>

    </div>

    <div class="Group" id="Group">
        <h2>Groep 3</h2>

        <div class="information">

            <h3>Who we are</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis cumque dolorum minus nostrum quisquam. Ab error facilis repellat vitae voluptatum! Ducimus explicabo impedit ipsum nemo qui! Adipisci asperiores tempore voluptates.</p>
        </div>

        <div class="Engineers">

            <h2>The Brains Behind</h2>

            <div class="team">

                <div class="member">

                    <h4>Name</h4>
                    <img src="Img/Profile_Picture/Placeholder_Profile_Pic.png" alt="a profile picture of one of the creators">

                    <div class="describe_Member">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias corporis dolorem expedita fugit nam nisi reiciendis totam. Dolorum et laborum quos temporibus? Impedit labore molestiae nihil optio praesentium, quasi similique!</p>
                    </div>
                </div>

                <div class="member">

                    <h4>Name</h4>
                    <img src="Img/Profile_Picture/Placeholder_Profile_Pic.png" alt="a profile picture of one of the creators">

                    <div class="describe_Member">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias corporis dolorem expedita fugit nam nisi reiciendis totam. Dolorum et laborum quos temporibus? Impedit labore molestiae nihil optio praesentium, quasi similique!</p>
                    </div>
                </div>

                <div class="member">

                    <h4>Name</h4>
                    <img src="Img/Profile_Picture/Placeholder_Profile_Pic.png" alt="a profile picture of one of the creators">

                    <div class="describe_Member">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias corporis dolorem expedita fugit nam nisi reiciendis totam. Dolorum et laborum quos temporibus? Impedit labore molestiae nihil optio praesentium, quasi similique!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="Tournament" id="Tournement">

        <h2>The Big Tournement</h2>

        <div class="description">

        </div>

        <div class="rules">

        </div>

        <div class="Play">

        </div>
    </div>
</div>
</body>
</html>
