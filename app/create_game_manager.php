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

$db_conn->query("TRUNCATE tbl_matches");

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

for ($h = 1; $h <= NUMBER_OF_POULES; $h++) {
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

}
echo '<pre>';
var_dump($matches);