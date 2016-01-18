<?php
$db = Db::getInstance()->getConnection();
function get_user_details($username)
{
    global $db;
    $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
    $query_result = mysqli_query($db, $sql)->fetch_assoc();
    return $query_result;
}
function get_user_statement($username)
{
    global $db;
    $sql = "SELECT transaction.`date`,transaction.`description`, transaction.`amount`,
    (SELECT users.owner_name FROM users WHERE transaction.`origin_account`=users.account_number) AS 'FROM',
    (SELECT users.owner_name FROM users WHERE transaction.`destination_account`=users.account_number) AS 'TO'
    FROM `transaction`
    WHERE
    (transaction.`origin_account`= (SELECT account_number FROM users WHERE username=" . "'" . $username . "'" . "))
    OR
    (transaction.`destination_account`= (SELECT account_number FROM users WHERE username=" . "'" . $username . "'" . "))
    ORDER BY `transaction`.`date` DESC
    ";
    $query_result = mysqli_query($db, $sql);
    return $query_result;
}