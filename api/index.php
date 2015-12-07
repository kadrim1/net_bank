<?php

require_once "../classes/bank_operations.php";
require_once "../classes/api_operations.php";

$response = array();
$p = $_POST;

if (isset($_POST) && !empty($_POST)) {
    if (validate_request($_POST, $response)) {
        $response['status'] = 200;
        $response['banklink'] = 'valid.request.com';
    }
    else {
        $response['status'] = 400;
    }

    deliver_response($response);
}
else {
    http_response_code(400);
    echo "Bad request";
}