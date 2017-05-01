<?php
require('../public/header.php');
require('database.php');
?>
<?php

$naam             = trim($_POST['name']);
$email            = trim($_POST['email']);
$password         = trim($_POST['password']);
$adminlevel       = trim($_POST['adminlevel']);
$code             = sha1($password);
$pass             = crypt($code,'ex');

$ErrorMessage = "<strong>U moet een naam invullen!</strong>";
if (empty($_POST['name'])){header("Location: ../public/createUser.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een email invullen!</strong>";
if (empty($_POST['email'])){header("Location: ../public/createUser.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een wachtwoord invullen!</strong>";
if (empty($_POST['password'])){header("Location: ../public/createUser.php?message=$ErrorMessage");die;}
$ErrorMessage = "<strong>U moet een adminlevel invullen (1,2)!</strong>";
if (empty($_POST['adminlevel']) || $_POST['adminlevel'] > 2 || $_POST['adminlevel'] < 0){header("Location: ../public/createUser.php?message=$ErrorMessage");die;}



$qry="SELECT `email` FROM `tbl_users` ORDER BY `email`";
$qryObj = $db_conn->prepare($qry);
$qryObj->execute();

$resultArr = $qryObj->fetchAll(PDO::FETCH_ASSOC);

foreach($resultArr as $row)
{
    if ($email === $row['email']) {
        $ErrorMessage = "<strong>Deze email bestaat al</strong>";
        header("Location: ../public/createUser.php?message=$ErrorMessage");die;
    }
}

$sqlAdd = "INSERT INTO " .$dbname . "." . $table2 . "(`name`,`email`,`password`,`adminLevel`) VALUES ('" .$naam . "',
'" . $email . "','" . $pass . "','" . $adminlevel . "')";
$sqlAddObj = $db_conn->prepare($sqlAdd);
$sqlAddObj->execute();
$ErrorMessage = "<strong>Toevoegen was succesvol!</strong>";
header("Location: ../public/createUser.php?message=$ErrorMessage");

?>

<?php require('../public/footer.php'); ?>

