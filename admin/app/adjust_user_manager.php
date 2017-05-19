<?php
    /**
     * Created by PhpStorm.
     * User: Lex
     * Date: 5/8/17
     * Time: 22:42
     */


    if(isset($_POST['name'])) {
        require_once('../app/database.php');

        $id         = $_POST['id'];

        $name       = $_POST['name'];
        $password   = $_POST['password'];
        $email      = $_POST['email'];
        $adminLevel = $_POST['adminLevel'];

        if ( $adminLevel <= 2 && $adminLevel >= 1 ) {
            if (empty($password)) {
                $query = 'UPDATE tbl_users SET name = :name, email = :email, adminLevel = :adminLevel WHERE id = :id';
                $stmt = $db_conn->prepare($query);
                $result = $stmt->execute(['name' => $name, 'email' => $email, 'adminLevel' => $adminLevel, 'id' => $id]);

            } else {
                $password = sha1($password);
                $password = crypt($password, 'ex');

                $query = 'UPDATE tbl_users SET name = :name, password = :password, email = :email, adminLevel = :adminLevel WHERE id = :id';
                $stmt = $db_conn->prepare($query);
                $result = $stmt->execute(['name' => $name, 'password' => $password, 'email' => $email, 'adminLevel' => $adminLevel, 'id' => $id]);

            }

            if ($result) {
                $message = '<strong>Edit succesvol</strong>';
            } else {
                $message = '<strong>Er is iets mis gegaan, neem contact op met de beheerder</strong>';
            }
        } else {
            $message = '<strong>Het ingevoerde admin level word niet geaccepteerd</strong>';
        }
    }

    header("Location: ../public/createUser.php?message=$message");

