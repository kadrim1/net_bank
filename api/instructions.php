<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div>
    <h2>How to use the payment API:</h2>
    <p>You should send a POST request with the following parameters: </p>
    <ol>
        <li>api_key - Your API key</li>
        <li>amount - any amount between 1.00 and 10000.00</li>
        <li>description - string (up to 120 characters)</li>
    </ol>
    <p>The API returns JSON. If the request is successful, you'll receive a banklink.</p>
</div>
</body>
</html>