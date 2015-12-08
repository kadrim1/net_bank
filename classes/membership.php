<?php
require "mysql.php";

//Add timeout later
class membership
{
    function validate_user($un, $pwd)
    {
        $mysql = new mysql();
        $ensure_credentials = $mysql->verify_Username_and_Pass($un, $pwd); //Bcrypt or md5 to hash md5($pwd)
        //Although it would be much safer with bcrypt if you're paranoid, increase workload as much as you want!
        if ($ensure_credentials) {
            $_SESSION['status'] = 'authorized';
            //Where do you want the user directed to if correct
            header("location: index.php");
        } else {
            return "Please enter correct username and password!";
        }
    }

    function log_User_Out()
    {
        if (isset($_SESSION['status'])) {
            unset($_SESSION['status']);

            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 10000);
                session_destroy();
            }
        }
    }

    function confirm_Member()
    {
        session_start();
        if ($_SESSION['status'] != 'authorized') {
            //Change as necessary
            header("location:login.php");
        }
    }
}
