<?php

include_once "config.php";

session_start();

$name = sanitizeInput("name");
$surname = sanitizeInput("surname");
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = sanitizeInput("password");

validateInput($email, $password);

$db = Database::instance();
$database = $db->connect();

checkUserExists($email, $database);
addNewUser($name, $surname, $email, $password, $database);

$database->close();

function sanitizeInput($input)
{
    return filter_input(INPUT_POST, $input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function validateInput($email, $password)
{
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $passwordRegex = "/^(?=.*\d)(?=.*[!@#$%^&])(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

    if (!preg_match($emailRegex, $email)) {
        header("Location: signup.php?error=Invalid email address");
        exit;
    }

    if (!preg_match($passwordRegex, $password)) {
        header("Location: signup.php?error=Password should have atleast 8 characters, contain upper and lower case letters, at least one digit and one symbol");
        exit;
    }
}

function checkUserExists($email, $database)
{
    $sql_check_if_exists = "SELECT * FROM users WHERE email = ?";

    $stmt = $database->prepare($sql_check_if_exists);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: signup.php?error=User already exists");
        exit;
    }
}

function generateAPIKey($database)
{
    $apikey_length = 20;
    $apikey = base64_encode(random_bytes(ceil($apikey_length * 3 / 4)));
    $apikey = substr($apikey, 0, $apikey_length);

    if (checkAPIKeyExists($apikey, $database)) {
        generateAPIKey($database);
    } else {
        return $apikey;
    }
}

function checkAPIKeyExists($apikey, $database)
{
    $sql_check_if_exists = "SELECT apikey FROM users WHERE apikey = ?";

    $stmt = $database->prepare($sql_check_if_exists);
    $stmt->bind_param("s", $apikey);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function addNewUser($name, $surname, $email, $password, $database)
{
    $apikey = generateAPIKey($database);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_add_user = "INSERT INTO users (name, surname, email, password, apikey) VALUES (?, ?, ?, ?, ?)";

    $stmt = $database->prepare($sql_add_user);
    $stmt->bind_param("sssss", $name, $surname, $email, $hashed_password, $apikey);
    $stmt->execute();
    $stmt->close();

    $_SESSION['email'] = $email;

    setcookie("apikey", $apikey, 0);

    header("Location: signup-successful.php?apikey=" . $apikey . "&name=" . $name);
}

// @shleyK321