<?php

function validate_request($request) {
    global $response;
    if (empty($request['api_key']) || strlen($request['api_key']) >= 120 ) {
        $response['message'] = "Invalid api key";
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
    elseif ($request['amount'] < 0) {
        $response['message'] = "The amount must be larger than zero";
        return false;
    }
    elseif ($request['amount'] > 10000) {
        $response['message'] = "The maximum amount is 10000";
        return false;
    }

    return true;
}

function deliver_response($response) {
    $json_response = json_encode($response);
    echo $json_response;
}