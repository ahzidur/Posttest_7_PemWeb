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
        <h3>Registrasi</h3>
        <form method="POST">
            <div class="input">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="inputan" placeholder="Nama" required>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="inputan" placeholder="Email" required>
            </div>
            <div class="input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="inputan" placeholder="Username" required>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="inputan" placeholder="Password" required>
            </div>
            <div class="input">
                <label for="confirm-password">Konfirmasi Password</label>
                <input type="password" name="confirm-password" id="confirm-password" class="inputan" placeholder="Konfirmasi Password" required>
            </div>

            <button name="register" type="submit">Daftar</button>
            <p>Sudah punya akun? <a href="login.php">login disini</a></p>
        </form>
    </div>

    <?php
    require('../koneksi.php');
    
    if(isset($_POST['register'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cPassword = $_POST['confirm-password'];

        if($password === $cPassword) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $hasil = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
            if(mysqli_fetch_assoc($hasil)) {
                echo '<script>
                    alert("Username sudah digunakan!");
                    document.location.href = "regis.php";
                </script>';
            } else {
                $push_data = mysqli_query($conn, "INSERT INTO admin (nama, email, username, password) VALUES ('$nama', '$email', '$username', '$password');");
                
                if(mysqli_affected_rows($conn) > 0) {
                    echo '<script>
                        alert("Registrasi berhasil");
                        document.location.href = "login.php";
                    </script>';
                } else {
                    echo '<script>
                        alert("Registrasi gagal");
                    </script>';
                    $result = mysqli_query($conn, $push_data) or trigger_error("Query Failed! SQL: $push_data - Error: ".mysqli_error($conn), E_USER_ERROR);
                    echo $result;
                }
            }
        } else {
            echo '<script>
                alert("Konfirmasi password anda beda");
                document.location.href = "regis.php";
            </script>';
        }
    } ?>
</body>
</html>