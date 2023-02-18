<?php
    session_start();
    include('header.php');
    unset($_SESSION['logged']);
    $dane = $_SESSION['me'];
    $data->doQuery("DELETE FROM aktywni WHERE dane='$dane'");
    header('Location: index.php');
?>