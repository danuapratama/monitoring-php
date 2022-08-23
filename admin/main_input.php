<?php include("inc_header.php") ?>
<?php
$lokasi      = "";
$wo          = "";
$deskripsi   = "";
$keterangan  = "";
$status      = "";
$terima      = "";
$selesai     = "";

$id = "";
$error      = "";
$sukses     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from main where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $lokasi     = $r1['lokasi'];
    $wo         = $r1['wo'];
    $deskripsi  = $r1['deskripsi'];
    $keterangan = $r1['keterangan'];
    $status     = $r1['status'];
    $terima     = $r1['terima'];
    $selesai    = $r1['selesai'];

    if ($lokasi == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $lokasi         = $_POST['lokasi'];
    $deskripsi      = $_POST['deskripsi'];
    $wo             = $_POST['wo'];
    $keterangan     = $_POST['keterangan'];
    $status         = $_POST['status'];
    $terima         = $_POST['terima'];
    $selesai        = $_POST['selesai'];

    if ($lokasi == '' or $deskripsi == '') {
        $error     = "Silakan masukkan data lokasi dan deskripsi";
    }

    // if ($lokasi && $wo && $deskripsi && $keterangan && $status && $terima && $selesai) {
    //     if ($op == 'edit') {
    //         $sql1   = "update main set lokasi='$lokasi',wo='$wo',deskripsi='$deskripsi',keterangan='$keterangan',status='$status',terima='$terima',selesai='$selesai' where id = '$id'";
    //         $q1     = mysqli_query($koneksi,$sql1);
    //         if($q1){
    //             $sukses = "Sukses mengubah data";
    //         }else{
    //             $error  = "Gagal mengubah data";
    //         }
    //     } else {
    //         $sql1   = "insert into main(lokasi,wo,deskripsi,keterangan,status,terima,selesai) values ('$lokasi','$wo','$deskripsi','$keterangan','$status','$terima','$selesai')";
    //         $q1     = mysqli_query($koneksi, $sql1);
    //         if ($q1) {
    //             $sukses     = "Sukses menyimpan data";
    //         } else {
    //             $error      = "Gagal menyimpan data";
    //         }
    //     } 
    // }

    if (empty($error)) {
        if ($id != "") {
            $sql1   = "update main set lokasi='$lokasi',wo='$wo',deskripsi='$deskripsi',keterangan='$keterangan',status='$status',terima='$terima',selesai='$selesai' where id = '$id'";
        } else {
            $sql1   = "insert into main(lokasi,wo,deskripsi,keterangan,status,terima,selesai) values ('$lokasi','$wo','$deskripsi','$keterangan','$status','$terima','$selesai')";
        }

        $q1     = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses     = "Sukses menyimpan data";
        } else {
            $error      = "Gagal menyimpan data";
        }
    }
}

?>
<div class="mt-5 pt-4 mb-3">
    <h1>Input Data</h1>
</div>
<div class="mb3 row mb-3">
    <a style="color:#8d5cff; text-decoration:none" href="index.php"> &laquo; Kembali ke Dashboard</a>
</div>

<?php
if ($error) {
?>
    <div class="alert alert-danger d-flex justify-content-between" role="alert">
        <?php echo $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<?php
if ($sukses) {
?>
    <div class="alert alert-success d-flex justify-content-between" role="alert">
        <?php echo $sukses ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lokasi" value="<?php echo $lokasi ?>" name="lokasi">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="wo" class="col-sm-2 col-form-label">No. WO</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="wo" value="<?php echo $wo ?>" name="wo">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="deskripsi" value="<?php echo $deskripsi ?>" name="deskripsi">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="keterangan" value="<?php echo $keterangan ?>" name="keterangan">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="status" value="<?php echo $status ?>" name="status">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="terima" class="col-sm-2 col-form-label">Terima</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="terima" value="<?php echo $terima ?>" name="terima">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="selesai" class="col-sm-2 col-form-label">Selesai</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="selesai" value="<?php echo $selesai ?>" name="selesai">
            <p class="text-secondary mt-3" style="font-style: italic;">*cek kembali sebelum data disimpan</p>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10 mb-5 pb-5">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn" style="background: #3DCAB5;" />
        </div>
    </div>

</form>
<?php include("inc_footer.php") ?>