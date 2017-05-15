
<?php
require ('database.php');
?>

<?php
        if ($_GET['action'] == 'login')  {
        $email = $_POST['email'];
        $wachtwoord = $_POST['pass'];
        $code       = sha1($wachtwoord);
        $pass       = crypt($code, 'ex');

        $query = 'SELECT * FROM tbl_users WHERE password=:password AND email=:email';
        $stmt = $db_conn->prepare($query);
        $stmt->execute(['password' => $pass, 'email' => $email]);
        $result = $stmt->rowCount();

        if ($result == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            session_start();

            $_SESSION['adminLevel']  = $user['adminLevel'];
            header("Location: ../public/beheer.php");
        } else {
            $ErrorMessage = "<strong>U heeft foutieve gegevens gebruikt, probeer het nog eens!</strong>";
            header("Location: ../index.php?message=$ErrorMessage");
        }
    }
?>


