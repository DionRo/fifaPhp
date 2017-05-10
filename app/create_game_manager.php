<?php
    /**
     * Created by PhpStorm.
     * User: lexkr
     * Date: 5/10/17
     * Time: 14:01
     */

    if ( isset($_POST['matchType']) ) {
        // POULES
        if ( $_POST['matchType'] == 1 ) {
            echo 'POULES';
        }
        // BEST OF 16
        else if ( $_POST['matchType'] == 2 ) {
            echo 'BEST OF 16';
        }
        // BEST OF 32
        else if ( $_POST['matchType'] == 3 ) {
            echo 'BEST OF 32';
        }
    }