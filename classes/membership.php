<?php
require "bank_operations.php";

//Add timeout later
class membership
{
    function validate_user($un, $pwd)
    {
        $mysql = new verify();
        $ensure_credentials = $mysql->verify_Username_and_Pass($un, $pwd);

        if ($ensure_credentials && $_SESSION['payment']) {
            $_SESSION['status'] = 'authorized';
            header("location: banklink/Banklink.php");
        } elseif ($ensure_credentials) {
            $_SESSION['status'] = 'authorized';
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