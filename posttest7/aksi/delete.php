<?php
    session_start();

    if(!isset($_SESSION['admin'])) {
        echo '<script> alert("Anda harus login terlebih dahulu, untuk melakukan aksi ini!"); </script>';
        echo '<script>window.location="../index.php"</script>';
        exit;
    } else {
        include "../koneksi.php";
    
        $id = $_GET["id"];
        $sql = "DELETE FROM barang WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            ?>
                <script>
                    alert("Data berhasil dihapus!");
                    window.location='../index.php';
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert("Barang gagal dihapus!\nBarang ini sedang ada pada daftar pesanan.\n(kosongkan data untuk menghapus barang ini)");
                    window.location='../index.php';
                </script>
            <?php
        }
    }
