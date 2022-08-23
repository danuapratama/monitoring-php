<?php
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <title>Monitoring Data</title>

  <!--=============== CUSTOM FONTS ===============-->
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
</head>

<body class="container">

  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background: #8d5cff">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          Monitoring WO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <div class="dropdown">
              <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Lainnya
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin-top: 1rem;">
                <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                <li><a class="dropdown-item" href="#">Keluar &raquo;</a></li>
              </ul>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <?php
  $sukses = "";
  $katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
  if (isset($_GET['op'])) {
    $op = $_GET['op'];
  } else {
    $op = "";
  }
  ?>
  <!-- <div class="mt-5 pt-4">
    <h1>Data Monitoring</h1>
  </div> -->

  <form class="row g-3 mt-5 pt-4" method="get">
    <div class="col-auto">
      <input type="text" class="form-control" placeholder="Cari nomor WO" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
      <input type="submit" name="cari" value="Cari" class="btn btn-warning" />
    </div>
  </form>
  <div class="table-responsive mt-3 mb-3" style="max-height:25rem; overflow:auto;">
    <table class="table table-striped table-bordered border-secondary table-hover table-sm text-center">
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
        </tr>
      </thead>
      <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman   = 30; //jumlah data perhalaman
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
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <p class="text-secondary" style="font-style: italic;">*data ter-update setiap hari</p>
  <nav aria-label="page navigation example">
    <ul class="pagination mb-5 pb-5">
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

  <footer class="bg-light">
    <div class="fixed-bottom text-center p-2" style="background: #d3d3d3; color:#8d5cff; font-size:14px; font-weight:bold;">
      &#169;<script type='text/javascript'>
        var creditsyear = new Date();
        document.write(creditsyear.getFullYear());
      </script> Dibuat oleh Danu
    </div>
  </footer>

</body>

</html>