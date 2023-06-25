<?php

include_once "config.php";

session_start();

global $conn;
$email = $_POST['email'];
$password = $_POST['password'];
$conn = Database::instance()->connect();

if (usernameExists())
{
    if (passwordMatches())
    {
        $_SESSION['email'] = $email;
        setcookie("apikey", getAPIKey(), 0);

        header('Location: index.php');
        exit();
    }
    else
    {
        header("Location: login.php?error=Incorrect password");
        exit;
    }
}
else
{
    header("Location: login.php?error=Username not found");
    exit;
}

function usernameExists()
{
    global $conn, $email;
    $query = "SELECT email FROM users WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows == 1;
}

function passwordMatches()
{
    global $conn, $email, $password;
    $query = "SELECT password FROM users WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $hashed_password = $row['password'];

    return password_verify($password, $hashed_password);
}

function getAPIKey()
{
    global $conn, $email;
    $query = "SELECT apikey FROM users WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['apikey'];
}

?>