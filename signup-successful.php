<?php

if(isset($_GET['apikey'])){
    $api_key = $_GET['apikey'];
}

if(isset($_GET['name'])){
    $name = $_GET['name'];
}

echo
(
    "<!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

        <link rel='stylesheet' href='css/signup-successfull.css'>
        <link rel='shortcut icon' href='img/favicon.png' type='image/png'>

        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap' rel='stylesheet'>

        <title>Sign Up Successfull</title>
    </head>

    <body>

        <div class='container'>

            <img src='img/cc_logo_t.png' alt='cc logo'>

            <h2>You are now Signed Up</h2>

            <p> $name,  this is your API Key, write it down or take a screenshot cause you will never see it again:</p>

            <h1>" . $api_key . "</h1>

            <p>Go back to home page <a href='index.php'>Home</a> </p>

        </div>

    </body>

    </html>"
);

?>