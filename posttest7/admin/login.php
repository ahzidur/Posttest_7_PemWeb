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
      <h3>Login</h3>
      <form method="POST">
        <div class="input">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="inputan" placeholder="Username" required>
        </div>
        <div class="input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="inputan" placeholder="Password" required>
        </div>

        <button name="admin" type="submit">Login</button>
        <p>Belum punya akun? <a href="regis.php">daftar sekarang!</a></p>
      </form>
    </div>

    <?php
        include('../koneksi.php');
        session_start();

        if(isset($_POST['admin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hasil = mysqli_query($conn, "SELECT username, password FROM admin WHERE username = '$username'");

            if(mysqli_num_rows($hasil) === 1) {
                $row = mysqli_fetch_assoc($hasil);
                
                if(password_verify($password, $row['password'])) {
                    $_SESSION['admin'] = $row;
                    header('location: ../index.php');
                    exit;
                } else {
                    ?>
                        <script>
                            alert('Password anda salah!');
                        </script>
                    <?php
                }
            } else {
                ?>
                    <script>
                        alert('Akun tidak ditemukan!');
                    </script>
                <?php
            }
        } 
    ?>
</body>
</html>