<?php
function url_dasar()
{
    //$_SERVER['SERVER_NAME'] : alamat website, website.com
    //$_SERVER['SCRIPT_NAME'] : directory website, website.com/blog/ $_SERVER['SCRIPT_NAME'] : blog
    $url_dasar = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}

function ambil_lokasi($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['lokasi'];
    return $text;
}

function ambil_wo($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['wo'];
    return $text;
}

function ambil_deskripsi($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['deskripsi']);
    return $text;
}

function ambil_keterangan($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['keterangan']);
    return $text;
}

function ambil_status($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['status']);
    return $text;
}

function ambil_terima($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['terima']);
    return $text;
}

function ambil_selesai($id_tulisan)
{
    global $koneksi;
    $sql1   = "select * from main where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['selesai']);
    return $text;
}
