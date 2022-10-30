<?php
    session_start();

    if(!isset($_SESSION['admin'])) {
        echo '<script> alert("Anda harus login terlebih dahulu, untuk melakukan aksi ini!"); </script>';
        echo '<script>window.location="../pesanan.php"</script>';
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Elektronik</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsiveP.css">
</head>
<body>
    <?php
        require('../koneksi.php');

		$id = $_GET['id'];
		$sql = "SELECT * FROM pesanan WHERE id ='$id'";
		$query = mysqli_query($conn,$sql);
		$data = mysqli_fetch_array($query);
	?>

    <div class="form-container">
      <h3>Ubah Pesanan</h3>
      <form method="POST">
        <div class="input">
          <label for="">Nama</label>
          <input type="text" name="nama" id="" value="<?php echo $data['nama'] ?>">
        </div>
        <div class="input">
          <label for="">Telepon</label>
          <input type="number" name="phone" id="" value="<?php echo $data['telepon'] ?>">
        </div>

        <div class="input">
          <label for="">Barang</label>
          <select name="item">
            <?php
              $query = mysqli_query($conn, "SELECT * FROM barang");
              if(mysqli_num_rows($query) > 0) {
                while($barang = mysqli_fetch_array($query)) {
                ?>
                  <option value="<?php echo $barang['nama'] ?>"><?php echo $barang['nama'] ?></option>
                <?php
                }
              }
            ?>
          </select>
        </div>

        <div class="input">
          <label for="">Alamat</label>
          <textarea name="address"><?php echo $data['alamat'] ?></textarea>
        </div>

        <button name="submit" class="btn-aksi update" style="color: white;">Ubah</button>
        <a href="../pesanan.php" class="btn-aksi delete" style="color: white;">Batal</a>
      </form>
    </div>

    <?php
        require('../koneksi.php');
        
        if(isset($_POST['submit'])){
            $nama = $_POST['nama'];
            $telepon =  $_POST['phone'];
            $barang =  $_POST['item'];
            $alamat =  $_POST['address'];

            $sql = "SELECT id FROM barang WHERE nama = '$barang'";
            $query = mysqli_query($conn, $sql);
            $barang = mysqli_fetch_array($query);
            $id_barang = $barang['id'];
            
            $sql = "UPDATE pesanan SET nama = '$nama', telepon = '$telepon', alamat = '$alamat', barang_id = '$id_barang' WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);

            
            if($query){
                ?>
                    <script>
                        alert("Data berhasil diubah!");
                        window.location='../pesanan.php';
                    </script>
                <?php
            }else {
                ?>
                    <script>
                        alert("Data gagal diubah!");
                    </script>
                <?php
            }
        }
    ?>
    
</body>
</html>