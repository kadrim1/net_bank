<?php
//Necessary to validate user, can't view page when not user
require_once 'classes/membership.php';
$membership = new membership();
$membership->confirm_Member();
//Necessary to get data from database, replace in the future
require_once 'mysql.php';
$result = new mysql();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div class="container">
    <p><?php $result->show_Balance($_SESSION['username']); ?></p>
    <a href="login.php?status=loggedout">Log out</a>
</div>
</body>
</html>