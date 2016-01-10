<?php
session_start();
require_once 'classes/membership.php';
require_once 'classes/bank_operations.php';
$membership = new membership();
$payment = new transaction();

if (isset($_GET['status']) && $_GET['status'] == 'logged_out') {
    $membership->log_User_Out();
}

if ($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
    $response = $membership->validate_user($_POST['username'], $_POST['pwd']);
}

if ($_POST && !empty($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/pic/logo_BANK.ico">
    <title>NBank</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]        On see ka vajalik, või on niisama>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="Account ID" class="sr-only">Account ID</label>
        <input type="text" name="username" class="form-control" placeholder="Account ID" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="pwd" class="form-control" placeholder="Password" required>
        <!--On see vajalik?<div class="checkbox"><label><input type="checkbox" value="remember-me"> Remember me</label></div>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    <?php if (isset($response)) {
        echo "<h4 class=alert>" . $response . "</h4>";
    } ?>
</div>
</body>