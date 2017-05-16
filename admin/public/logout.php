<?php
/**
 * Created by PhpStorm.
 * User: Dion
 * Date: 30-3-2017
 * Time: 12:16
 */
session_start();
session_destroy();
$ErrorMessage = "<strong>U bent succesvol uitgelogd</strong>";
header("Location: ../index.php?message=$ErrorMessage");
