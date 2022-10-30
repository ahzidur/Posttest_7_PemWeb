<?php
    session_start();

    if(!isset($_SESSION['admin'])) {
        echo '<script> alert("Anda harus login terlebih dahulu, untuk melakukan aksi ini!"); </script>';
        echo '<script>window.location="../index.php"</script>';
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
		$sql = "SELECT * FROM barang WHERE id ='$id'";
		$query = mysqli_query($conn,$sql);
		$data = mysqli_fetch_array($query);
	?>

    <div class="form-container">
        <div class="form-buat" id="formulir">
            <h3>Ubah Barang</h3>
            <form method="POST" enctype="multipart/form-data">
                <label for="">Nama barang<em>&#x2a;</em></label>
                <input class="" type="text" name="barang" placeholder="Barang" value="<?php echo $data['nama'] ?>" required>
                    
                <label for="">Harga barang <em>&#x2a;</em></label>
                <input class="" type="number" name="harga" placeholder="Harga" value="<?php echo $data['harga'] ?>" required>
                
                <div>
                    <label>Gambar baru</label>
                    <input class="" name="gambar" type="file" accept=".jpg,.jpeg,.png">
                </div>
                <div>
                    <label for="">Gambar Default:</label>
                    <br>
                    <img src="../assets/barang/<?php echo $data['gambar'] ?>" alt="gambar barang" style="width: 80px;">
                </div>

                <input type="submit" name="submit" value="Ubah" class="btn-aksi update" style="color: white;">
                <a href="../index.php" class="btn-aksi delete" style="color: white; width: 50%;">Batal</a>
            </form>

    <?php
    require('../koneksi.php');

    if(isset($_POST['submit'])){
        
        $nama = $_POST['barang'];
        $harga = $_POST['harga'];

        // Set File Gambar
        $rename = $data['gambar'];
        if($_FILES['gambar']['size'] != 0) {
            $format_file = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];
    
            $tipe = explode('.',$format_file);
            $rename = $tipe[0] . '.' . $tipe[1];
            move_uploaded_file($tmp_name, './../assets/barang/' . $rename);
        }
        // End Set File Gambar
        
        $sql2 = "UPDATE barang SET nama = '$nama', harga = '$harga', gambar = '$rename' WHERE id = '$id'";
        $query2 = mysqli_query($conn, $sql2);
        
        if($query){
            ?>
                <script>
                    alert("Data berhasil diubah!");
                    window.location='../index.php';
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert("Data gagal diubah!");
                </script>
            <?php
        }
    } ?>
        </div>
    </div>
    
</body>
</html>