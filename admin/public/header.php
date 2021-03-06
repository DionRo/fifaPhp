<?php
    require_once __DIR__ . '/../app/init.php';


    session_start();

    if (!isset ($_SESSION['adminLevel'])  || !$_SESSION['adminLevel'])
    {
        $ErrorMessage = "<strong>U moet eerst inloggen voor dat u op deze pagina kan komen</strong>";
        header("Location: ../index.php?message=$ErrorMessage");
        die;
    }

    function checkActiveUrl($url)
    {
        $requestedUrl = $_SERVER['REQUEST_URI'];
        $split = explode('/', $requestedUrl);

        if (end($split) === $url )
        {
            return true;
        }

        return false;

    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beheerpagina Fifa</title>

    <link rel="stylesheet" href="../css/main.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script
            src="http://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>


</head>
<body>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php foreach($navMenu as $item): ?>
                            <?php if($item['level'] <= $_SESSION['adminLevel'] ): ?>
                                <?php echo checkActiveUrl($item['link']); ?>
                                <li class="<?php echo checkActiveUrl($item['link']) ? 'active' : '' ?>" role="presentation"><a href="<?= $item['link']; ?>"> <?= $item['label']; ?> </a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


