
<?php
require ('database.php');
?>

<?php
        if ($_GET['action'] == 'login')  {
        $email = $_POST['email'];
        $wachtwoord = $_POST['pass'];
        $code       = sha1($wachtwoord);
        $pass       = crypt($code, 'ex');

        $sql = "SELECT * FROM tbl_users WHERE password = '$pass' AND email = '$email'";
        $result = $db_conn->query($sql)->rowCount();

        if ($result == 1)
        {
            session_start();
            $_SESSION['LoggedIn'] = true;
            header("Location: ../public/beheer.php");
        }
        else{
            $ErrorMessage = "<strong>U heeft foutieve gegevens gebruikt, probeer het nog eens!</strong>";
            header("Location: ../index.php?message=$ErrorMessage");
        }
    }

?>


