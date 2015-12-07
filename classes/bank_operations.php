<?php
require "../mysql.php";

class bank_operations
{
    function transfer_Money($account_from, $account_to, $amount) {
        $mysql = new mysql();

        // We check the paying account exists
        if (!$mysql->verify_Account($account_from)){
            echo "The paying account is not in our database";
            return false;
        }

        // We check for funds
        if (!$mysql->check_Funds($account_from, $amount)) {
            echo "Insufficient funds";
            return false;
        }

        // We check the receiving account exists
        if (!$mysql->verify_Account($account_to)){
            echo "The receiving account is not in our database";
            return false;
        }

        $mysql->make_Payment($account_from, $account_to, $amount);
        echo "Your payment was executed";
    }
}