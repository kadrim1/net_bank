<?php
//Necessary to validate user, can't view page when not user
require_once 'classes/membership.php';
$membership = new membership();
$membership->confirm_Member();
$result = new bank_operations();
//$result->show_Balance($_SESSION['username']);
list ($konto_nr, $summa) = $result->show_Balance($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div class="container">
    <p><?php echo "Konto number: " . $konto_nr . "<br />" . "Konto summa: " . $summa; ?></p>
    <a href="login.php?status=logged_out">Log out</a>
</div>
</body>
</html>