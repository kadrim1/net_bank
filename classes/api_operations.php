<?php

require_once "bank_operations.php";

function validate_request($request) {
    global $response;

    if (empty($request['api_key'])) {
        $response['message'] = "The request must include a valid api key";
        return false;
    }
    $verify = new verify();
    if (!$verify->verify_Token($request['api_key'])) {
        $response['message'] = "Invalid api key provided";
        return false;
    }
    if (empty($request['description'])) {
        $response['message'] = "The request must include a description";
        return false;
    }
    elseif (strlen($request['description']) >= 120) {
        $response['message'] = "The description must be at most 120 characters";
        return false;
    }
    if (empty($request['amount'])) {
        $response['message'] = "The request must include an amount";
        return false;
    }
    elseif ($request['amount'] < 1) {
        $response['message'] = "The amount must be larger than one";
        return false;
    }
    elseif ($request['amount'] > 10000) {
        $response['message'] = "The maximum amount is 10000";
        return false;
    }

    return true;
}

function deliver_response($response) {
    header('Content-type: application/json; charset=utf-8');
    $json_response = json_encode($response, JSON_UNESCAPED_SLASHES);
    echo $json_response;
}

function generateRandomString($length = 60)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function create_banklink($token, $amount, $description) {
    $db = Db::getInstance()->getConnection();

    $banklink = generateRandomString();
    $query = "INSERT INTO banklinks (banklink, user_id, amount, description, timestamp)
                    VALUES ('" . $banklink . "', (SELECT user_id FROM tokens WHERE token= '"
        . mysqli_real_escape_string($db, $token) . "'), $amount, '$description', NOW())";
    $db->query($query) or die ("Couldn't create banklink");
    return $banklink;
}