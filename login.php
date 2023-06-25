<?php

if(isset($_GET['error'])){
    $error = $_GET['error'];
}

echo
(
    "<!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

        <link rel='stylesheet' href='css/login.css'>
        <link rel='shortcut icon' href='img/favicon.png' type='image/png'>

        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap' rel='stylesheet'>

        <script src='https://kit.fontawesome.com/c8a9f34c0a.js' crossorigin='anonymous'></script>
        <script src='https://code.jquery.com/jquery-3.6.4.js'
            integrity='sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=' crossorigin='anonymous'></script>

        <title>Login</title>
    </head>

    <body>

        <div class='container'>

            <img src='img/cc_logo_t.png' alt='cc logo'>

            <p style='color: red;'>" . $error . "</p>

            <h1>Login</h1>

            <form action='validate-login.php' method='post'>

                <div class='question'>
                    <i class='fa-solid fa-envelope'></i>
                    <input id='email' type='email' name='email' placeholder='Email' required>
                </div>

                <div class='question'>
                    <i class='fa-solid fa-lock'></i>
                    <input id='password' type='password' name='password' placeholder='Password' required>
                </div>

                <input type='submit' value='Login' class='submitbtn'>

            </form>

            <p>Don't have an account? <a href='signup.php'>Sign Up</a> </p>

        </div>

    </body>

    </html>"
);

?>