<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Elektronik</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsiveP.css">
</head>
<body>
    <header>
      <div class="Heads">
        <span class="header-kiri">
          <h1 onclick="document.location.href = 'index.php'">Ahzidur</h1>
        </span>
  
        <div id="header-kanan">
          <a href="pesanan.php" class="headK">Daftar Pesanan</a>
          <a href="#aboutme" class="headK">Pesan</a>
          <button onclick="darkmode()" class="headK" class = "modes">Mode</button>
          <?php
            session_start();
            $user = !isset($_SESSION['admin']) ? 'login' : 'logout';
          ?>
          <a href="admin/<?php echo $user ?>.php" class="headK">
            <?php echo $user ?>
          </a>
        </div>
      </div>
    </header>

    <table border="1" cellpadding="10" style="margin-top: 120px;" align="center">
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Barang</th>
            <th>Tanggal beli</th>
            <th>Aksi</th>
        </tr>
        <?php
            require('koneksi.php');
            $no = 1;
            $query = mysqli_query($conn, "SELECT * FROM pesanan");
            if(mysqli_num_rows($query) > 0) {
              while($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['telepon'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
            <?php
                $sql = "SELECT barang.nama FROM barang INNER JOIN pesanan on barang.id = ".$data['barang_id'].";";
                $read2 = mysqli_query($conn, $sql);
                $row2 = mysqli_fetch_array($read2);

                if(mysqli_num_rows($read2) > 0){
                    ?>
                    <td><?php echo $row2['nama']?></td>
                <?php } ?>
                    <td><?php echo $data['tanggal_beli'] ?></td>
                    <td>
                      <a href="aksi/update_pesanan.php?id=<?php echo $data['id']; ?>" class="btn-aksi update">Ubah</a>
                      <a href="aksi/delete_pesanan.php?id=<?php echo $data['id']; ?>" class="btn-aksi delete">Hapus</a>
                    </td>
                </tr>
              <?php
              $no++;
              }
            }
        ?>
    </table>

    
    <div class="footer-down" style="bottom: 0; position: absolute;">
      <h3 id="aboutme" style="margin: 0; padding-top: 10px;">About Me</h3>
      <p>Ahmad Zidan Maulidinnur</p>
      <p style="margin: 0; padding-bottom: 10px;">Copyright &copy 2022 All Rights Reserved</p>
    </div>
    
<script>
    function btnClick() {
        document.location.href = "result.php";
    }
</script>
<script src="script.js"></script>
<script src="jquery.js"></script>
</body>
</html>