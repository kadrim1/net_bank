<?php
require_once 'config.php';

class mysql
{
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli(DATABASE_HOSTNAME, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_DATABASE)
        or die("There was a problem connecting to the database");
    }

    function verify_Username_and_Pass($un, $pwd)
    {
        $query = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";

        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("ss", $un, $pwd);
            $stmt->execute();

            if ($stmt->fetch()) {
                $stmt->close();
                return true;
            }
        }
    }

    function show_Balance($username)
    {
        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Konto number: " . $row["account_number"] . "<br />" . "Konto seis: " . $row["amount"] . "<br>";
            }
        }
    }

    function verify_Account($account_number) {
        $query = "SELECT * FROM users WHERE account_number = $account_number";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function check_Funds($account_number, $amount) {
        $query = "SELECT amount FROM users WHERE account_number = $account_number";
        $result = $this->conn->query($query)->fetch_assoc();
        if ($result["amount"] >= $amount) {
            return true;
        }
        else {
            return false;
        }
    }

    function make_Payment($account_from, $account_to, $amount) {
        $query = "INSERT INTO transaction (origin_account, destination_account, date, description, amount)
                    VALUES ($account_from, $account_to, NOW(), 'Payment', $amount)";
        $this->conn->query($query) or die ("Transfer unsuccessful");
    }
}