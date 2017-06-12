<?php
/**
     * Created by PhpStorm.
     * User: lexkr
     * Date: 5/10/17
     * Time: 14:01
     */

require ('database.php');

define('NUMBER_OF_POULES', 4);
define('STARTING_TEAMS', 8);
define('BEST_OF_EIGHT',4);

$query = 'SELECT * FROM tbl_teams';
$stmt = $db_conn->prepare($query);
$stmt->execute();

if ( $stmt->rowCount() < STARTING_TEAMS ) {
    header('Location: ../public/createGame.php?message=<strong>Er bestaan nog niet genoeg teams om te spelen (minimum is 8)</strong>');
    die;
}

$query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 0';
$stmt = $db_conn->prepare($query);
$stmt->execute();
$played_matches = $stmt->rowCount();

$query = 'SELECT * FROM tbl_matches WHERE isPlayed = 0 AND matchType = 0';
$stmt = $db_conn->prepare($query);
$stmt->execute();
$unplayed_matches = $stmt->rowCount();



if($played_matches == 0)
{
    $db_conn->query("DELETE FROM tbl_matches");

    $poules = [
        [
            'name' => 'Poule A',
            'teams' => [],
            'id' => 1
        ],
        [
            'name' => 'Poule B',
            'teams' => [],
            'id' => 2
        ],
        [
            'name' => 'Poule C',
            'teams' => [],
            'id' => 3
        ],
        [
            'name' => 'Poule D',
            'teams' => [],
            'id' => 4
        ],
    ];

    $query = 'SELECT * FROM tbl_teams';
    $stmt = $db_conn->prepare($query);
    $stmt->execute();

    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count_teams = count($teams); // 10
    $count_teams -= STARTING_TEAMS; // 2

    $teams_per_poule = ceil($count_teams / NUMBER_OF_POULES); // 0.5 -> 1

    // Hier vullen we de poules op met een minimum van 2 teams
    $j = 0;
    for ( $i = 0; $i < NUMBER_OF_POULES; $i++ ) {
        $poules[$i]['teams'][0] = $teams[$j];
        $j++;
        $poules[$i]['teams'][1] = $teams[$j];
        $j++;
    }

    // Hier worden de al toegevoegde teams out het $teams[] gehaald
    for ( $i = 0; $i < STARTING_TEAMS; $i++ ) {
        array_shift($teams);
    }

    // Hier word ervoor gezorgd dat de overige teams aan een poule nummer worden toegekent
    $j = 0;
    for ( $i = 0; $i < count($teams); $i++ ) {
        array_push($poules[$i]['teams'], $teams[$j]);
        $j++;
        if ( $i == 3 ) {
            $i = -1;
        }
        if ( $j > count($teams) - 1 ) {
            break;
        }
    }

    //Hier wordt een query vastgelegd die wordt doorgestuurd naar de DB
    $query = 'UPDATE `tbl_teams` SET `poule_id` = :poule_id WHERE id = :id';
    //Hier wordt geloopt over alle poules en wordt opgeslagen in variable poule
    foreach($poules as $poule)
    {
        //Hier wordt geloopt over  alle teams die in de $poule zitten
        foreach($poule['teams'] as $team)
        {
            //Hier worden de gegevens ingevult en doorgestuurd naar de database
            $stmt = $db_conn->prepare($query);
            $stmt->execute([
                'poule_id'  => $poule['id'],
                'id'        => $team['id']
            ]);
        }


    }

    for ( $h = 1; $h <= NUMBER_OF_POULES; $h++ ) {
    //  Binnen halen poules
        $query = 'SELECT * FROM `tbl_teams` WHERE `poule_id` = :id';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['id'=>$h]);
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $matches = [];


        $team_count = count($teams);
        $amount_of_matches = $team_count * ($team_count - 1);


        for ($i = 0; $i < $team_count; $i++) {
            for ($j = 0; $j < $team_count; $j++) {
                if ($i != $j) {
                    array_push($matches, [$teams[$i], $teams[$j]]);
                }
            }
        }

        $query = 'INSERT INTO tbl_matches (`team_id_a`,`team_id_b`) VALUES (:team_id_a, :team_id_b)';

        for ($i = 0; $i < $amount_of_matches; $i++) {
            $stmt = $db_conn->prepare($query);
            $stmt->execute(['team_id_a' => $matches[$i][0]['id'], 'team_id_b' => $matches[$i][1]['id']]);
        }
        $message = "<strong>Nieuw poule schema gegenereerd</strong>";
    }
} else if ( $played_matches != 0 ) {
    if ( $unplayed_matches == 0 ) {
        $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 1';
        $stmt = $db_conn->prepare($query);
        $stmt->execute();
        $played_matches = $stmt->rowCount();

        $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 0 AND matchType = 1';
        $stmt = $db_conn->prepare($query);
        $stmt->execute();
        $unplayed_matches = $stmt->rowCount();

        if ( $played_matches == 0 ) {
            $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 0';
            $stmt = $db_conn->prepare($query);
            $stmt->execute();
            $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $poule_winners = [];
            for ($i = 1; $i <= NUMBER_OF_POULES; $i++) {

                $query = "SELECT * FROM `tbl_teams` WHERE poule_id = ".$i." ORDER BY points DESC, totalGoals DESC LIMIT 2;";
                $stmt = $db_conn->query($query);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                array_push($poule_winners, $results);

            }

            $query = 'INSERT INTO tbl_matches (`team_id_a`,`team_id_b`,`matchType`) VALUES (:team_id_a, :team_id_b, :matchType)';
            for ($i = 0; $i < BEST_OF_EIGHT; $i++) {
                $team_id_a = $poule_winners[$i][0]['id'];
                $team_id_b = $poule_winners[$i][1]['id'];

                $stmt = $db_conn->prepare($query);
                $stmt->execute(['team_id_a' => $team_id_a, 'team_id_b' => $team_id_b, 'matchType' => 1]);

            }

            $message = "<strong>Nieuw eliminatie schema gegenereerd</strong>";

        } else if ( $played_matches != 0 ) {
            if ( $unplayed_matches == 0 ) {
                $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 2';
                $stmt = $db_conn->prepare($query);
                $stmt->execute();
                $played_matches = $stmt->rowCount();

                $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 0 AND matchType = 2';
                $stmt = $db_conn->prepare($query);
                $stmt->execute();
                $unplayed_matches = $stmt->rowCount();

                if ( $played_matches == 0 ) {
                    $best_of_eight_winners = [];

                    $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 1';
                    $stmt = $db_conn->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $query = 'SELECT * FROM tbl_teams';
                    $stmt = $db_conn->prepare($query);
                    $stmt->execute();
                    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ( $results as $result ) {
                        if ( $result['score_team_a'] > $result['score_team_b'] ) {
                            $team_a = [];

                            foreach ( $teams as $team ) {
                                if ( $result['team_id_a'] == $team['id'] ) {
                                    $team_a = $team;

                                }
                            }

                            array_push($best_of_eight_winners, $team_a);

                        } else if ( $result['score_team_b'] > $result['score_team_a'] ) {
                            $team_b = [];

                            foreach ( $teams as $team ) {
                                if ( $result['team_id_b'] == $team['id'] ) {
                                    $team_b = $team;

                                }
                            }

                            array_push($best_of_eight_winners, $team_b);

                        }
                    }

                    $matches = [
                        [
                            $best_of_eight_winners[0],
                            $best_of_eight_winners[1],
                        ],
                        [
                            $best_of_eight_winners[2],
                            $best_of_eight_winners[3],
                        ],
                    ];

                    $query = 'INSERT INTO tbl_matches (team_id_a, team_id_b, matchType) VALUES (:team_id_a, :team_id_b, 2)';
                    foreach ( $matches as $match ) {
                        $stmt = $db_conn->prepare($query);
                        $stmt->execute(['team_id_a' => $match[0]['id'], 'team_id_b' => $match[1]['id']]);
                    }

                    $message = '<strong>New best of 4 created</strong>';
                } else if ( $played_matches != 0 ) {
                    if ( $unplayed_matches == 0 ) {
                        $query = 'SELECT * FROM tbl_matches WHERE isPlayed = 1 AND matchType = 2';
                        $stmt = $db_conn->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $query = 'SELECT * FROM tbl_teams';
                        $stmt = $db_conn->prepare($query);
                        $stmt->execute();
                        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $best_of_four_winners = [];

                        foreach ( $results as $result ) {
                            echo 'a';
                            if ($result['score_team_a'] > $result['score_team_b']) {
                                $team_a = [];

                                foreach ($teams as $team) {
                                    if ($result['team_id_a'] == $team['id']) {
                                        $team_a = $team;
                                    }
                                }

                                array_push($best_of_four_winners, $team_a);

                            } else {
                                $team_b = [];

                                foreach ($teams as $team) {
                                    if ($result['team_id_b'] == $team['id']) {
                                        $team_b = $team;
                                    }
                                }

                                array_push($best_of_four_winners, $team_b);

                            }
                        }

                        $match = [
                            $best_of_four_winners[0],
                            $best_of_four_winners[1],
                        ];

                        $query = 'INSERT INTO tbl_matches (team_id_a, team_id_b, matchType) VALUES (:team_id_a, :team_id_b, 3)';
                        $stmt = $db_conn->prepare($query);
                        $stmt->execute(['team_id_a' => $match[0]['id'], 'team_id_b' => $match[1]['id']]);

                        $message = '<strong>Finale is gegenereerd</strong>';

                    } else {
                        $message = '<strong>Er is al een wedstrijd gespeel, het schema kan niet meer worden aangepast</strong>';
                    }
                }

            } else {
                $message = "<strong>Er is al een match gespeeld het schema kan niet meer worden veranderd</strong>";

            }
        }
    } else {
        $message = "<strong>Er is al een match gespeeld het schema kan niet meer worden veranderd</strong>";
    }
}
header('location: ../public/createGame.php?message='.$message);

