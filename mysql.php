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
}