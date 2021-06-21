<?php
    if (!isset($_SESSION['login'])) {
        echo "<script>alert('Login Dahulu');</script>";
        echo "<script>window.location.replace('../login/login.php');</script>";
    }

    unset($_SESSION['login']);

    echo "<script>alert('Berhasil Logout');</script>";
    echo "<script>window.location.replace('../admin/login/login.php');</script>";

?>