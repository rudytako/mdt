<?php
if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
    header('Location: index.php');
    exit();
}

include('header.php');

$login =  htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$pass =  htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

$result = $data->getData("SELECT haslo, dane FROM funkcjonariusze WHERE login='$login'");
if ($result == null) {
    header('Location: index.php');
    $_SESSION['error'] = 'Nieprawidłowy login!';

    exit();
}
if ($result['haslo'] != $pass) {
    header("Location: index.php");
    $_SESSION['error'] = 'Nieprawidłowe hasło!';
    exit();
}

$dane = $result['dane'];
$data->doQuery("INSERT INTO aktywni (login, dane, status) VALUES ('$login', '$dane', 'status 1')");
$_SESSION['me'] = $result['dane'];
$_SESSION['logged'] = true;
header('Location: home.php');