<?php
    session_start();

    if(!isset($_SESSION['admin'])) {
        echo '<script> alert("Anda harus login terlebih dahulu, untuk melakukan aksi ini!"); </script>';
        echo '<script>window.location="../pesanan.php"</script>';
        exit;
    } else {
        include "../koneksi.php";

        $id = $_GET["id"];
        $sql = "DELETE FROM pesanan WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            ?>
                <script>
                    alert("Data berhasil dihapus!");
                    window.location='../pesanan.php';
                </script>
            <?php
        }else {
            ?>
                <script>
                    alert("Data gagal dihapus!");
                    window.location='../pesanan.php';
                </script>
            <?php
        }
    }