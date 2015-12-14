<?php
require "../Db.php";

class bank_operations
{
    function transfer_Money($account_from, $account_to, $amount)
    {
        $verify = new verify();

        // We check if the paying account exists
        if (!$verify->verify_Account($account_from)) {
            echo "The paying account is not in our database";
            return false;
        }

        // We check for funds
        if (!$verify->check_Funds($account_from, $amount)) {
            echo "Insufficient funds";
            return false;
        }

        // We check if the receiving account exists
        if (!$verify->verify_Account($account_to)) {
            echo "The receiving account is not in our database";
            return false;
        }

        $this->make_Payment($account_from, $account_to, $amount);
        echo "Your payment was executed";
    }

    function make_Payment($account_from, $account_to, $amount)
    {
        $db = Db::getInstance()->getConnection();

        $query = "INSERT INTO transaction (origin_account, destination_account, date, description, amount)
                    VALUES ($account_from, $account_to, NOW(), 'Payment', $amount)";
        $db->query($query) or die ("Transfer unsuccessful");
    }

    function show_Balance($username)
    {
        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $db = Db::getInstance()->getConnection();
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Konto number: " . $row["account_number"] . "<br />" . "Konto seis: " . $row["amount"] . "<br>";
            }
        }
    }
}

class verify
{

    function verify_Username_and_Pass($un, $pwd)
    {
        $db = Db::getInstance()->getConnection();

        $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";

        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("ss", $un, $pwd);
            $stmt->execute();

            if ($stmt->fetch()) {
                $stmt->close();
                return true;
            }
        }
    }

    function verify_Account($account_number)
    {
        $db = Db::getInstance()->getConnection();

        $query = "SELECT * FROM users WHERE account_number = $account_number";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

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

    function verify_Token($token) {
        $db = Db::getInstance()->getConnection();

        $query = "SELECT * FROM tokens WHERE token = '" . mysqli_real_escape_string($db, $token) . "'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
