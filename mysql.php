<?php
require_once 'Db.php';

class mysql
{
    function check_Funds($account_number, $amount)
    {
        $db = Db::getInstance()->getConnection();

        $query = "SELECT amount FROM users WHERE account_number = $account_number";
        $result = $db->query($query)->fetch_assoc();
        if ($result["amount"] >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    function make_Payment($account_from, $account_to, $amount)
    {
        $db = Db::getInstance()->getConnection();

        $query = "INSERT INTO transaction (origin_account, destination_account, date, description, amount)
                    VALUES ($account_from, $account_to, NOW(), 'Payment', $amount)";
        $db->query($query) or die ("Transfer unsuccessful");
    }
}