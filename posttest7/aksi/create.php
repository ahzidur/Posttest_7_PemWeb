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

    <div class="form-container">
        <div class="form-buat" id="formulir">
            <h3>Tambah Barang Baru</h3>
            <form method="POST" enctype="multipart/form-data">
                <label for="">Nama barang<em>&#x2a;</em></label>
                <input class="create-input" type="text" name="barang" placeholder="Barang" required>
                    
                <label for="">Harga barang <em>&#x2a;</em></label>
                <input class="create-input" type="number" name="harga" placeholder="Harga" required>
                
                <div class="">
                    <label>Gambar<em>&#x2a;</em></label>
                    <input class="" name="gambar" type="file" accept=".jpg,.jpeg,.png" required>
                </div>

                <input type="submit" name="submit" value="Tambah" class="btn-buat" style="color: white;">
                <a href="../index.php" class="btn-aksi delete" style="color: white; width: 50%;">Batal</a>
            </form>

    <?php
    require('../koneksi.php');

    if(isset($_POST['submit'])){
        
        $nama = $_POST['barang'];
        $harga = $_POST['harga'];

        // Set File Gambar
        $format_file = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        $tipe = explode('.',$format_file);
        $rename = $tipe[0] . '.' . $tipe[1];
        // End Set File Gambar
        
        move_uploaded_file($tmp_name, './../assets/barang/' . $rename);
        $sql = "INSERT INTO barang VALUES(
            null, 
            '".$nama."', 
            '".$harga."', 
            '".$rename."'
        )";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            ?>
                <script>
                    alert("Data berhasil ditambahkan!");
                    window.location='../index.php';
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert("Data gagal ditambahkan!");
                </script>
            <?php
        }
    } ?>
        </div>
    </div>


</body>
</html>