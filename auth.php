<?php
session_start();
require 'db.php';

function login($username, $password) {
    global $pdo  ;
    $stmt = $pdo->prepare("SELECT * FROM dentist WHERE user_name = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    } else {
        return false;
    }
}

function register($username, $password) {
    global $pdo;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO dentist (user_name, password) VALUES (?, ?)");
    return $stmt->execute([$username, $passwordHash]);
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_destroy();
}
?>
