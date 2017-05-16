<?php
    /**
     * Created by PhpStorm.
     * User: Lex
     * Date: 5/8/17
     * Time: 23:06
     */

    if ( isset($_POST['delete']) ) {
        require_once('database.php');

        $id = $_POST['delete'];

        $query = 'DELETE FROM tbl_users WHERE id = :id';
        $stmt = $db_conn->prepare($query);
        $result = $stmt->execute(['id' => $id]);

        if ( $result ) {
            $message = '<strong>Verwijderd succesvol</strong>';
        } else {
            $message = '<strong>Er is iets mis gegaan, neem contact op met de beheerder</strong>';
        }
    }

    header("Location: ../public/createUser.php?message=$message");