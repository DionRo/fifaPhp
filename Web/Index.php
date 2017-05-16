<?php
/**
 * Created by PhpStorm.
 * User: kutay
 * Date: 5/1/2017
 * Time: 14:03
 */

    require ('app/database.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="Scripts/scroll.js"></script>
    <link rel="stylesheet" href="Style/Main_Web_CSS.css">
    <title>FiFa Tournament</title>
</head>
<body>
<header id="Top-Header">

    <div class="main-head" id="main-head">
        <div class="logo">
            <h1 ">FIFA Radius College Tournament</h1>
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
                <p>World's First Radius College FiFa Tournament</p>
                <p>The FiFa tournament is a competition of students de parted in 14 to 16 teams that will compete each other to win the Big prize.</p>
                <p>The players of the tournament are forming a team of 4 to 5 players. one keeper and 3~4 player on the field.</p>
                &nbsp;
                <p>There is also a betting place. If you interested you can bet on you're favorite Team. you can make profit of it so try you luck and who ones.</p>
                <p>The bedding role is also a foundation for a charity for research of illnesses that need proper founding to make treatments for those terrible diseases.</p>
                &nbsp;
                <p>We hope that you ride along of this Tournament. Even if you are in for the game or for the joy of a bedding game.</p>
                <p>We hope we see at the Game.</p>
                <p>Radius College</p>
            </div>

            <div class="extra">

                <h3>Extra</h3>
                <p>Time's, Date's Place's and all what looks around.</p>
                <ul>
                    <li>Date:&emsp;&emsp;&emsp;&emsp;&emsp;22 - 06 - 2017</li>
                    <li>Time:&emsp;&emsp;&emsp;&emsp;&emsp;10:00 ~ 16:00</li>
                    <li>Game:&emsp;&emsp;&emsp;&emsp;&emsp;20 Min</li>
                    <li>Minimum Player:&emsp;4 Members</li>
                    <li>Maximim Player:&emsp;5 Members (Where 1 is reserve)</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="Group" id="Group">
        <h2>Groep 3</h2>

        <div class="information">

            <h3>Who we are</h3>
            <p>We are Group 3 Company. whe are a 3 man company that are specialized in creating web application's an software application's.</p>
            <p>When we here asked to take this project we where pleased that we where the first person to call. When we took on the job we begin te think how we going to make this so grade to rise a good amount of founding for the charity</p>
            &nbsp;
            <p>The design did we took of the world problems that we all have and can have, weird right if it isn't effecting us it will affect our friends an family around us.</p>
            <p>We thought how we going to make a amazing application's to this project.</p>
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

        <?php
            $poules = [];
            $i = 0;

            $query = 'SELECT * FROM tbl_teams WHERE poule_id = 1 ORDER BY DESC';
            $stmt = $db_conn->prepare($query);
            $stmt->execute();
            $poule_a = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = 'SELECT * FROM tbl_teams WHERE poule_id = 2 ORDER BY DESC';
            $stmt = $db_conn->prepare($query);
            $stmt->execute();
            $poule_b = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = 'SELECT * FROM tbl_teams WHERE poule_id = 3 ORDER BY DESC';
            $stmt = $db_conn->prepare($query);
            $stmt->execute();
            $poule_c = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = 'SELECT * FROM tbl_teams WHERE poule_id = 4 ORDER BY DESC';
            $stmt = $db_conn->prepare($query);
            $stmt->execute();
            $poule_d = $stmt->fetchAll(PDO::FETCH_ASSOC);

            array_push($poules, $poule_a, $poule_b, $poule_c, $poule_d);
        ?>
        <div class="poules">
            <?php foreach ( $poules as $poule ): ?>
                <div class="item">
                    <?php
                        switch ($i) {
                            case 0:
                                echo '<h3>Poule A</h3>';
                                break;
                            case 1:
                                echo '<h3>Poule B</h3>';
                                break;
                            case 2:
                                echo '<h3>Poule C</h3>';
                                break;
                            case 3:
                                echo '<h3>Poule D</h3>';
                                break;
                            default:
                                echo '<h3>Oh oh</h3>';
                                break;
                        }

                        $i++;
                    ?>
                    <table>
                        <tr>
                            <th>Team</th>
                            <th>Points</th>
                        </tr>
                        <?php foreach ( $poule as $team ): ?>
                            <tr>
                                <td><?php echo $team['name']; ?></td>
                                <td><?php echo $team['points']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="matches">
            <div class="match">
                <?php
                    // Userinput
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 8 ? (int)$_GET['per-page'] : 8;

                    //Positioning
                    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

                    //SQL
                    $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = TRUE AND start_time IS NOT NULL ORDER BY start_time ASC LIMIT {$start},{$perPage}");
                    $matches->execute();
                    $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

                    $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
                    $pages = ceil($total /$perPage);

                    $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
                    $teams->execute();
                    $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <h3>Played matches</h3>

                <table>
                    <tr>
                        <th>naam team a</th>
                        <th>score team a</th>
                        <th>naam team b</th>
                        <th>score team b</th>
                        <th>speeltijd</th>
                    </tr>
                    <?php foreach ( $matches as $match ): ?>
                        <tr>
                            <td>
                                <?php
                                    foreach ( $teams as $team ) {
                                        if ( $team['id'] == $match['team_id_a'] ) {
                                            echo $team['name'];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $match['score_team_a'] ?></td>
                            <td>
                                <?php
                                    foreach ( $teams as $team ) {
                                        if ( $team['id'] == $match['team_id_b']) {
                                            echo $team['name'];
                                        }
                                    }
                                ?>
                            </td>
                            <td><?= $match['score_team_b'] ?></td>
                            <td><?= $match['start_time'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="pagenation">
                    <?php  for ($x =1; $x <= $pages; $x++) :?>
                        <a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage ?>"><?php  echo $x; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="match">
                <?php
                // Userinput
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 8 ? (int)$_GET['per-page'] : 8;

                //Positioning
                $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

                //SQL
                $matches = $db_conn->prepare ("SELECT SQL_CALC_FOUND_ROWS * FROM tbl_matches WHERE isPlayed = FALSE AND start_time IS NOT NULL ORDER BY start_time ASC LIMIT {$start},{$perPage}");
                $matches->execute();
                $matches = $matches->fetchAll(PDO::FETCH_ASSOC);

                $total = $db_conn->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
                $pages = ceil($total /$perPage);

                $teams = $db_conn->prepare ("SELECT * FROM tbl_teams");
                $teams->execute();
                $teams = $teams->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <h3>Unplayed matches</h3>

                <table>
                    <tr>
                        <th>naam team a</th>
                        <th>score team a</th>
                        <th>naam team b</th>
                        <th>score team b</th>
                        <th>speeltijd</th>
                    </tr>
                    <?php foreach ( $matches as $match ): ?>
                        <tr>
                            <td>
                                <?php
                                foreach ( $teams as $team ) {
                                    if ( $team['id'] == $match['team_id_a'] ) {
                                        echo $team['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $match['score_team_a'] ?></td>
                            <td>
                                <?php
                                foreach ( $teams as $team ) {
                                    if ( $team['id'] == $match['team_id_b']) {
                                        echo $team['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $match['score_team_b'] ?></td>
                            <td><?= $match['start_time'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <div class="pagenation">
                    <?php  for ($x =1; $x <= $pages; $x++) :?>
                        <a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage ?>"><?php  echo $x; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>