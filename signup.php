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

        <link rel='stylesheet' href='css/signup.css'>
        <link rel='shortcut icon' href='img/favicon.png' type='image/png'>

        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap' rel='stylesheet'>

        <script src='https://kit.fontawesome.com/c8a9f34c0a.js' crossorigin='anonymous'></script>
        <script src='https://code.jquery.com/jquery-3.6.4.js'
            integrity='sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=' crossorigin='anonymous'></script>

        <title>Sign Up</title>
    </head>

    <body>


        <div class='container'>

            <img src='img/cc_logo_t.png' alt='cc logo'>

            <p style='color: red;'>" . $error . "</p>

            <h1>Sign Up</h1>

            <form action='validate-signup.php' method='post'>

                <div class='question'>
                    <i class='fa-solid fa-user'></i>
                    <input id='name' type='text' name='name' placeholder='Name' required>
                </div>

                <div class='question'>
                    <i class='fa-solid fa-user'></i>
                    <input id='surname' type='text' name='surname' placeholder='Surname' required>
                </div>

                <div class='question'>
                    <i class='fa-solid fa-envelope'></i>
                    <input id='email' type='email' name='email' placeholder='Email' required>
                </div>

                <div class='question'>
                    <i class='fa-solid fa-lock'></i>
                    <input id='password' type='password' name='password' placeholder='Password' required>
                </div>

                <div class='question'>
                    <i class='fa-solid fa-lock'></i>
                    <input id='confirmpassword' type='password' name='confirmpassword' placeholder='Confirm password' required>
                </div>

                <input type='submit' value='Sign Up' class='submitbtn'>

            </form>

            <p>Already have an account? <a href='login.php'>Login</a> </p>

        </div>

        <script src='js/signup.js'></script>

    </body>

    </html>"
);

?>