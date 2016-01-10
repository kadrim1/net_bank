<?php
session_start();
$_SESSION["authenticated"] = 'false';
$msg = (isset($_SESSION["failed"])) ? 'Incorrect username or password!' : '';
if ($msg !== '') {
    unset($_SESSION["failed"]);
}
//require_once 'Db.php';
//require_once 'Banking.php';
if (isset($_SESSION["banklink"])) { ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PSEUDO BANK</title>
        <!-- Style CSS -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div>
        <div style="width: 40px;
            height: 40px;
            background-size: 100%;
            background-repeat: no-repeat;
            display: inline-block;
    ">
        </div>

        <div class="container">
            <h2 style="color: #ffa102">PSEUDO BANK</h2>
            <h5 style="color: #4382f8">BANKLINK</h5>

            <form class="form-signin" action="confirmation.php" method="post">
                <h3 class="form-signin-heading">Please sign in</h3>

                <p class="form-signin-heading" id="errorMsg" style="color: red"><?= $msg ?></p>
                <label for="inputAccountID" class="sr-only">Account ID</label>
                <input name="username" id="Account ID" class="form-control" placeholder="Account ID"
                       required autofocus>
                <br/>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                       required>
                <br/>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
        <!-- /container -->
    </div>
    </body>
    </html>
<?php } ?>