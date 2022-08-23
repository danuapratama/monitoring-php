<?php include("inc_header.php") ?>
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from main where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}
?>
<div class="mt-5 pt-4">
    <h1>Dashboard</h1>
</div>

<?php
if ($sukses) {
?>
    <div class="alert alert-primary d-flex justify-content-between" role="alert">
        <?php echo $sukses ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Cari nomor WO" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari" class="btn btn-warning" />
    </div>
</form>
<div class="table-responsive mt-3 mb-3" style="max-height:25rem; overflow:auto;">
    <table class="table table-striped table-sm table-bordered border-secondary text-center">
        <thead class="table border-dark" style="background: #3DCAB5;">
            <tr>
                <th>No</th>
                <th style="padding:5px 50px;">Lokasi</th>
                <th>WO</th>
                <th style="padding:5px 50px;">Deskripsi</th>
                <th style="padding:5px 100px;">Keterangan</th>
                <th>Status</th>
                <th style="padding:5px 30px;">Terima</th>
                <th style="padding:5px 30px;">Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqltambahan = "";
            $per_halaman   = 50; //jumlah data perhalaman
            if ($katakunci != '') {
                $array_katakunci = explode(" ", $katakunci);
                for ($x = 0; $x < count($array_katakunci); $x++) {
                    $sqlcari[] = "(lokasi like '%" . $array_katakunci[$x] . "%' or wo like '%" . $array_katakunci[$x] . "%' or deskripsi like '%" . $array_katakunci[$x] . "%')";
                }
                $sqltambahan    = " where " . implode(" or ", $sqlcari);
            }
            $sql1   = "select * from main $sqltambahan";
            $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
            $q1     = mysqli_query($koneksi, $sql1);
            $total  = mysqli_num_rows($q1);
            $pages  = ceil($total / $per_halaman);
            $nomor  = $mulai + 1;
            $sql1   = $sql1 . "  order by id desc limit $mulai,$per_halaman";

            $q1     = mysqli_query($koneksi, $sql1);

            while ($r1  = mysqli_fetch_array($q1)) {
            ?>
                <tr>
                    <td><?php echo $nomor++ ?></td>
                    <td><?php echo $r1['lokasi'] ?></td>
                    <td><?php echo $r1['wo'] ?></td>
                    <td><?php echo $r1['deskripsi'] ?></td>
                    <td><?php echo $r1['keterangan'] ?></td>
                    <td><?php echo $r1['status'] ?></td>
                    <td><?php echo $r1['terima'] ?></td>
                    <td><?php echo $r1['selesai'] ?></td>
                    <td>
                        <div class="d-flex gap-1 d-md-flex justify-content-md-center">
                            <a href="main_input.php?op=edit&id=<?php echo $r1['id'] ?>">
                                <span class="badge bg-warning text-dark" style="width:50px;">Edit</span>
                            </a>

                            <a href="index.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Yakin ingin menghapus data?')">
                                <span class="badge bg-danger">Hapus</span>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<nav aria-label="page navigation example">
    <ul class="pagination">
        <?php
        $cari   = isset($_GET['cari']) ? $_GET['cari'] : "";

        for ($i = 1; $i <= $pages; $i++) {
        ?>
            <li class="page-item">
                <a class="page-link" href="index.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>
<p>
    <a href="main_input.php">
        <input type="button" class="btn btn" value="Tambah data &raquo;" style="background: #3DCAB5; margin-bottom: 5rem;" />
    </a>
</p>
<?php include("inc_footer.php") ?>