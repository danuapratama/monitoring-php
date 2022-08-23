<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data-s";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Gagal terkoneksi");
}
