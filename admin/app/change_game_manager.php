<?php
/**
 * Created by PhpStorm.
 * User: Dion Rodie
 * Date: 5/15/2017
 * Time: 03:21 PM
 */

    require ('database.php');

    if ( isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['id']) && !empty($_POST['id']) ) {
        // Het maken van een goede tijd string voor de mySQL database
        $date = $_POST['date'];
        $date = str_replace('T', ' ', $date);
        $date = $date . ':00';

        $id = $_POST['id'];

        $query = 'UPDATE tbl_matches SET start_time = :date WHERE id = :id';
        $stmt = $db_conn->prepare($query);

        try {
            $stmt->execute(['date' => $date, 'id' => $id]);
            $message = '<strong>Match succesvol aangepast</strong>';

        } catch ( PDOException $e ) {
            $message = '<strong>Er is iets mis gegaan</strong>';

        }
    }

    header("Location: ../public/createGame.php?message=$message");
    die;
?>


//define('COUNT', 19);
//
//$id = $_POST['id'];
//$time = $_POST['date'];
//
//$split = str_split($time);
//
//echo $time;
//
//if ( count($split) == COUNT ) {
//    $correct = TRUE;
//
//    for ( $i = 0; $i < COUNT; $i++ ) {
//        switch ($i) {
//            case 4:
//                if ( $split[$i] != '-' ) {
//                    $correct = FALSE;
//                }
//                break;
//            case 7:
//                if ( $split[$i] != '-' ) {
//                    $correct = FALSE;
//                }
//                break;
//            case 10:
//                if ( $split[$i] != ' ' ) {
//                    $correct = FALSE;
//                }
//                break;
//            case 13:
//                if ( $split[$i] != ':' ) {
//                    $correct = FALSE;
//                }
//                break;
//            case 16:
//                if ( $split[$i] != ':' ) {
//                    $correct = FALSE;
//                }
//                break;
//        }
//    }
//
//    if ($correct) {
////
////        $match = $db_conn->prepare("SELECT * FROM tbl_matches WHERE id = $id");
////        $match->execute();
////        $match = $match->fetch(PDO::FETCH_ASSOC);
//
//        $query = "  UPDATE `tbl_matches`
//            SET `start_time` = '$time'
//            WHERE `id` = $id";
//
//        $stmt = $db_conn->prepare($query);
//        $result = $stmt->execute();
//
//        if ($result)
//            echo 'k';
//        else
//            echo 'n';
//
//        $message = '<strong>Tijd is succesvol aangepast</strong>';
//    } else {
//        $message = '<strong>Je hebt je niet aan het format gehouden, probeer het opnieuw (JJJJ-MM-DD UU:MM:SS)</strong>';
//    }
//} else {
//    $message = '<strong>Je hebt je niet aan het format gehouden, probeer het opnieuw (JJJJ-MM-DD UU:MM:SS)</strong>';
//}
//
//echo $message;
//header("Location: ../public/createGame.php?message=$message");